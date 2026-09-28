<?php
/**
 * Backend Controller for Data Management & Data Cleanup
 * Strict Role Authorization: ADMIN ONLY
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');

// 1. STRICT BACKEND AUTHORIZATION
if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin' || empty($_SESSION['id_pengawas'])) {
    http_response_code(403);
    echo json_encode([
        'status' => 'error',
        'code' => 403,
        'message' => '403 Forbidden: Akses ditolak. Hanya role Administrator yang memiliki izin untuk melakukan tindakan ini.'
    ]);
    exit();
}

require_once __DIR__ . '/../config/config.candy2.php';
require_once __DIR__ . '/../config/config.function.php';
require_once __DIR__ . '/../config/functions.crud.php';

// Include Budut / Model if available
if (file_exists(__DIR__ . '/../config/m_admin.php')) {
    include_once __DIR__ . '/../config/m_admin.php';
    if (class_exists('Budut')) {
        $db = new Budut();
    }
}

// 2. VERIFY REQUEST METHOD
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'code' => 405,
        'message' => 'Metode HTTP tidak diizinkan. Gunakan POST.'
    ]);
    exit();
}

$action = isset($_POST['action']) ? trim($_POST['action']) : '';
$type = isset($_POST['type']) ? trim($_POST['type']) : '';
$ids = isset($_POST['ids']) ? $_POST['ids'] : [];

if ($action !== 'delete') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Aksi tidak valid.'
    ]);
    exit();
}

if (empty($ids) || !is_array($ids)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Tidak ada data yang dipilih untuk dihapus.'
    ]);
    exit();
}

// Clean and sanitize IDs (escape string or integer)
$sanitized_ids = [];
foreach ($ids as $id) {
    $id_clean = mysqli_real_escape_string($koneksi, trim($id));
    if ($id_clean !== '') {
        $sanitized_ids[] = $id_clean;
    }
}

if (empty($sanitized_ids)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Daftar ID data tidak valid.'
    ]);
    exit();
}

$ids_sql_string = "'" . implode("','", $sanitized_ids) . "'";
$current_admin_id = $_SESSION['id_pengawas'];

// Start database transaction
mysqli_begin_transaction($koneksi);

try {
    $deleted_count = 0;
    $type_label = '';

    switch ($type) {
        case 'kelas':
            $type_label = 'Kelas';
            // Get class codes (id_kelas) and IDs (idkls)
            $q_kelas = mysqli_query($koneksi, "SELECT idkls, id_kelas FROM kelas WHERE idkls IN ($ids_sql_string)");
            $class_codes = [];
            $class_ids = [];
            while ($row = mysqli_fetch_assoc($q_kelas)) {
                $class_ids[] = "'" . mysqli_real_escape_string($koneksi, $row['idkls']) . "'";
                $class_codes[] = "'" . mysqli_real_escape_string($koneksi, $row['id_kelas']) . "'";
            }

            if (!empty($class_ids)) {
                $cls_ids_str = implode(',', $class_ids);
                $cls_codes_str = implode(',', $class_codes);

                // Preserve students! Only unassign class so students are not deleted
                mysqli_query($koneksi, "UPDATE siswa SET id_kelas='' WHERE id_kelas IN ($cls_codes_str)");

                // Clean class attendance safely
                mysqli_query($koneksi, "DELETE FROM absensi_mapel_anggota WHERE amaIdKelas IN ($cls_ids_str)");
                mysqli_query($koneksi, "DELETE FROM absensi_mapel WHERE amKelas IN ($cls_ids_str)");
                mysqli_query($koneksi, "DELETE FROM absensi WHERE absIdKelas IN ($cls_ids_str)");

                // Delete class records
                $exec = mysqli_query($koneksi, "DELETE FROM kelas WHERE idkls IN ($cls_ids_str)");
                if (!$exec) {
                    throw new Exception("Gagal menghapus kelas: " . mysqli_error($koneksi));
                }
                $deleted_count = mysqli_affected_rows($koneksi);
            }
            break;

        case 'siswa':
            $type_label = 'Siswa';
            // Delete dependent records first to satisfy foreign keys
            mysqli_query($koneksi, "DELETE FROM jawaban_tugas WHERE id_siswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_siswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM nilai WHERE id_siswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM nilai_pindah WHERE id_siswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM materi_view WHERE mtrViewIdSiswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM absensi_mapel_anggota WHERE amaIdSiswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM absensi WHERE absIdSiswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM siswa_susulan WHERE suIdSiswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM login WHERE id_siswa IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM log WHERE id_siswa IN ($ids_sql_string)");

            // Delete siswa
            $exec = mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa IN ($ids_sql_string)");
            if (!$exec) {
                throw new Exception("Gagal menghapus siswa: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        case 'guru':
            $type_label = 'Guru';
            // CRITICAL: NEVER ALLOW ADMIN ACCOUNT TO BE DELETED
            $q_check = mysqli_query($koneksi, "SELECT id_pengawas, username, level FROM pengawas WHERE id_pengawas IN ($ids_sql_string)");
            $valid_teacher_ids = [];
            while ($row = mysqli_fetch_assoc($q_check)) {
                if ($row['level'] === 'admin' || $row['username'] === 'admin' || $row['id_pengawas'] == $current_admin_id) {
                    continue; // Skip admin account!
                }
                $valid_teacher_ids[] = "'" . mysqli_real_escape_string($koneksi, $row['id_pengawas']) . "'";
            }

            if (empty($valid_teacher_ids)) {
                throw new Exception("Tindakan dibatalkan: Akun Administrator dilindungi dan tidak dapat dihapus!");
            }

            $teachers_str = implode(',', $valid_teacher_ids);

            // Handle related teacher records safely
            mysqli_query($koneksi, "DELETE FROM jawaban_tugas WHERE id_guru IN ($teachers_str)");
            mysqli_query($koneksi, "DELETE FROM tugas WHERE id_guru IN ($teachers_str)");
            
            // Delete materi_view for materi authored by these teachers
            mysqli_query($koneksi, "DELETE FROM materi_view WHERE mtrViewIdMateri IN (SELECT materi2_id FROM materi2 WHERE id_guru IN ($teachers_str))");
            mysqli_query($koneksi, "DELETE FROM materi2 WHERE id_guru IN ($teachers_str)");

            // Delete absensi_mapel_anggota and absensi_mapel
            mysqli_query($koneksi, "DELETE FROM absensi_mapel_anggota WHERE amaIdAbsenMapel IN (SELECT amId FROM absensi_mapel WHERE amIdGuru IN ($teachers_str))");
            mysqli_query($koneksi, "DELETE FROM absensi_mapel WHERE amIdGuru IN ($teachers_str)");
            mysqli_query($koneksi, "DELETE FROM telegram_bot WHERE tlIdGuru IN ($teachers_str)");
            mysqli_query($koneksi, "DELETE FROM pengumuman WHERE user IN ($teachers_str)");

            // Delete question banks (mapel) authored by these teachers
            $q_mapel = mysqli_query($koneksi, "SELECT id_mapel, nama FROM mapel WHERE idguru IN ($teachers_str)");
            $teacher_mapels = [];
            $teacher_mapel_names = [];
            while ($mr = mysqli_fetch_assoc($q_mapel)) {
                $teacher_mapels[] = "'" . mysqli_real_escape_string($koneksi, $mr['id_mapel']) . "'";
                $teacher_mapel_names[] = "'" . mysqli_real_escape_string($koneksi, $mr['nama']) . "'";
            }

            if (!empty($teacher_mapels)) {
                $tm_str = implode(',', $teacher_mapels);
                $tmn_str = implode(',', $teacher_mapel_names);
                mysqli_query($koneksi, "DELETE FROM nilai WHERE id_mapel IN ($tm_str)");
                mysqli_query($koneksi, "DELETE FROM nilai_pindah WHERE id_mapel IN ($tm_str)");
                mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_mapel IN ($tm_str)");
                mysqli_query($koneksi, "DELETE FROM soal WHERE id_mapel IN ($tm_str)");
                mysqli_query($koneksi, "DELETE FROM ujian WHERE nama IN ($tmn_str)");
                mysqli_query($koneksi, "DELETE FROM file_pendukung WHERE id_mapel IN ($tm_str)");
                mysqli_query($koneksi, "DELETE FROM mapel WHERE id_mapel IN ($tm_str)");
            }

            // Finally delete teacher accounts (extra safety: ensure level != 'admin')
            $exec = mysqli_query($koneksi, "DELETE FROM pengawas WHERE id_pengawas IN ($teachers_str) AND level != 'admin'");
            if (!$exec) {
                throw new Exception("Gagal menghapus data guru: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        case 'matapelajaran':
            $type_label = 'Mata Pelajaran';
            $q_mp = mysqli_query($koneksi, "SELECT idmapel, kode_mapel FROM mata_pelajaran WHERE idmapel IN ($ids_sql_string)");
            $mp_ids = [];
            $mp_codes = [];
            while ($row = mysqli_fetch_assoc($q_mp)) {
                $mp_ids[] = "'" . mysqli_real_escape_string($koneksi, $row['idmapel']) . "'";
                $mp_codes[] = "'" . mysqli_real_escape_string($koneksi, $row['kode_mapel']) . "'";
            }

            if (!empty($mp_ids)) {
                $mp_ids_str = implode(',', $mp_ids);
                $mp_codes_str = implode(',', $mp_codes);

                // Clean attendance linked to subject
                mysqli_query($koneksi, "DELETE FROM absensi_mapel_anggota WHERE amaIdMapel IN ($mp_ids_str)");
                mysqli_query($koneksi, "DELETE FROM absensi_mapel WHERE amIdMapel IN ($mp_ids_str)");

                // Clean materi linked to subject
                mysqli_query($koneksi, "DELETE FROM materi_view WHERE mtrViewIdMateri IN (SELECT materi2_id FROM materi2 WHERE materi2_mapel IN ($mp_codes_str))");
                mysqli_query($koneksi, "DELETE FROM materi2 WHERE materi2_mapel IN ($mp_codes_str)");

                // Clean question banks (mapel) linked to subject
                $q_mapel = mysqli_query($koneksi, "SELECT id_mapel, nama FROM mapel WHERE KodeMapel IN ($mp_codes_str)");
                $mapel_ids = [];
                $mapel_names = [];
                while ($mr = mysqli_fetch_assoc($q_mapel)) {
                    $mapel_ids[] = "'" . mysqli_real_escape_string($koneksi, $mr['id_mapel']) . "'";
                    $mapel_names[] = "'" . mysqli_real_escape_string($koneksi, $mr['nama']) . "'";
                }

                if (!empty($mapel_ids)) {
                    $m_str = implode(',', $mapel_ids);
                    $mn_str = implode(',', $mapel_names);
                    mysqli_query($koneksi, "DELETE FROM nilai WHERE id_mapel IN ($m_str)");
                    mysqli_query($koneksi, "DELETE FROM nilai_pindah WHERE id_mapel IN ($m_str)");
                    mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_mapel IN ($m_str)");
                    mysqli_query($koneksi, "DELETE FROM soal WHERE id_mapel IN ($m_str)");
                    mysqli_query($koneksi, "DELETE FROM ujian WHERE nama IN ($mn_str)");
                    mysqli_query($koneksi, "DELETE FROM file_pendukung WHERE id_mapel IN ($m_str)");
                    mysqli_query($koneksi, "DELETE FROM mapel WHERE id_mapel IN ($m_str)");
                }

                // Delete mata_pelajaran
                $exec = mysqli_query($koneksi, "DELETE FROM mata_pelajaran WHERE idmapel IN ($mp_ids_str)");
                if (!$exec) {
                    throw new Exception("Gagal menghapus mata pelajaran: " . mysqli_error($koneksi));
                }
                $deleted_count = mysqli_affected_rows($koneksi);
            }
            break;

        case 'pengawas': // Users / Pengguna Sistem
            $type_label = 'Akun Pengguna';
            // CRITICAL: NEVER ALLOW ADMIN ACCOUNT TO BE DELETED
            $q_check = mysqli_query($koneksi, "SELECT id_pengawas, username, level FROM pengawas WHERE id_pengawas IN ($ids_sql_string)");
            $valid_user_ids = [];
            $skipped_admin_count = 0;

            while ($row = mysqli_fetch_assoc($q_check)) {
                if ($row['level'] === 'admin' || $row['username'] === 'admin' || $row['id_pengawas'] == $current_admin_id) {
                    $skipped_admin_count++;
                    continue; // Skip admin account!
                }
                $valid_user_ids[] = "'" . mysqli_real_escape_string($koneksi, $row['id_pengawas']) . "'";
            }

            if (empty($valid_user_ids)) {
                throw new Exception("Tindakan dibatalkan: Seluruh akun yang dipilih adalah akun Administrator yang DILINDUNGI oleh sistem!");
            }

            $users_str = implode(',', $valid_user_ids);

            // Handle related teacher/proctor records safely
            mysqli_query($koneksi, "DELETE FROM jawaban_tugas WHERE id_guru IN ($users_str)");
            mysqli_query($koneksi, "DELETE FROM tugas WHERE id_guru IN ($users_str)");
            mysqli_query($koneksi, "DELETE FROM materi_view WHERE mtrViewIdMateri IN (SELECT materi2_id FROM materi2 WHERE id_guru IN ($users_str))");
            mysqli_query($koneksi, "DELETE FROM materi2 WHERE id_guru IN ($users_str)");
            mysqli_query($koneksi, "DELETE FROM absensi_mapel_anggota WHERE amaIdAbsenMapel IN (SELECT amId FROM absensi_mapel WHERE amIdGuru IN ($users_str))");
            mysqli_query($koneksi, "DELETE FROM absensi_mapel WHERE amIdGuru IN ($users_str)");
            mysqli_query($koneksi, "DELETE FROM telegram_bot WHERE tlIdGuru IN ($users_str)");
            mysqli_query($koneksi, "DELETE FROM pengumuman WHERE user IN ($users_str)");

            // Delete question banks (mapel)
            $q_mapel = mysqli_query($koneksi, "SELECT id_mapel, nama FROM mapel WHERE idguru IN ($users_str)");
            $user_mapels = [];
            $user_mapel_names = [];
            while ($mr = mysqli_fetch_assoc($q_mapel)) {
                $user_mapels[] = "'" . mysqli_real_escape_string($koneksi, $mr['id_mapel']) . "'";
                $user_mapel_names[] = "'" . mysqli_real_escape_string($koneksi, $mr['nama']) . "'";
            }

            if (!empty($user_mapels)) {
                $um_str = implode(',', $user_mapels);
                $umn_str = implode(',', $user_mapel_names);
                mysqli_query($koneksi, "DELETE FROM nilai WHERE id_mapel IN ($um_str)");
                mysqli_query($koneksi, "DELETE FROM nilai_pindah WHERE id_mapel IN ($um_str)");
                mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_mapel IN ($um_str)");
                mysqli_query($koneksi, "DELETE FROM soal WHERE id_mapel IN ($um_str)");
                mysqli_query($koneksi, "DELETE FROM ujian WHERE nama IN ($umn_str)");
                mysqli_query($koneksi, "DELETE FROM file_pendukung WHERE id_mapel IN ($um_str)");
                mysqli_query($koneksi, "DELETE FROM mapel WHERE id_mapel IN ($um_str)");
            }

            // Delete accounts (only where level != 'admin')
            $exec = mysqli_query($koneksi, "DELETE FROM pengawas WHERE id_pengawas IN ($users_str) AND level != 'admin'");
            if (!$exec) {
                throw new Exception("Gagal menghapus akun pengguna: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        case 'banksoal':
            $type_label = 'Bank Soal';
            // Get mapel names for ujian
            $q_mapel = mysqli_query($koneksi, "SELECT id_mapel, nama FROM mapel WHERE id_mapel IN ($ids_sql_string)");
            $mapel_names = [];
            while ($row = mysqli_fetch_assoc($q_mapel)) {
                $mapel_names[] = "'" . mysqli_real_escape_string($koneksi, $row['nama']) . "'";
            }

            mysqli_query($koneksi, "DELETE FROM nilai WHERE id_mapel IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM nilai_pindah WHERE id_mapel IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_mapel IN ($ids_sql_string)");
            mysqli_query($koneksi, "DELETE FROM soal WHERE id_mapel IN ($ids_sql_string)");
            if (!empty($mapel_names)) {
                $mn_str = implode(',', $mapel_names);
                mysqli_query($koneksi, "DELETE FROM ujian WHERE nama IN ($mn_str)");
            }
            mysqli_query($koneksi, "DELETE FROM file_pendukung WHERE id_mapel IN ($ids_sql_string)");

            $exec = mysqli_query($koneksi, "DELETE FROM mapel WHERE id_mapel IN ($ids_sql_string)");
            if (!$exec) {
                throw new Exception("Gagal menghapus bank soal: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        case 'nilai':
            $type_label = 'Hasil Nilai';
            // Clean answers for these exam scores
            mysqli_query($koneksi, "DELETE FROM jawaban WHERE id_ujian IN (SELECT id_ujian FROM nilai WHERE id_nilai IN ($ids_sql_string))");
            mysqli_query($koneksi, "DELETE FROM nilai_pindah WHERE id_nilai IN ($ids_sql_string)");

            $exec = mysqli_query($koneksi, "DELETE FROM nilai WHERE id_nilai IN ($ids_sql_string)");
            if (!$exec) {
                throw new Exception("Gagal menghapus data nilai: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        case 'tugas':
            $type_label = 'Tugas';
            mysqli_query($koneksi, "DELETE FROM jawaban_tugas WHERE id_tugas IN ($ids_sql_string)");
            $exec = mysqli_query($koneksi, "DELETE FROM tugas WHERE id_tugas IN ($ids_sql_string)");
            if (!$exec) {
                throw new Exception("Gagal menghapus data tugas: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        case 'materi':
            $type_label = 'Materi';
            mysqli_query($koneksi, "DELETE FROM materi_view WHERE mtrViewIdMateri IN ($ids_sql_string)");
            $exec = mysqli_query($koneksi, "DELETE FROM materi2 WHERE materi2_id IN ($ids_sql_string)");
            if (!$exec) {
                throw new Exception("Gagal menghapus data materi: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        case 'log':
            $type_label = 'Log Aktivitas';
            $exec = mysqli_query($koneksi, "DELETE FROM log WHERE id_log IN ($ids_sql_string)");
            if (!$exec) {
                throw new Exception("Gagal menghapus data log: " . mysqli_error($koneksi));
            }
            $deleted_count = mysqli_affected_rows($koneksi);
            break;

        default:
            throw new Exception("Kategori data '$type' tidak dikenali.");
    }

    // Commit the transaction
    mysqli_commit($koneksi);

    // Clear Redis Cache silently if available
    if (isset($db) && method_exists($db, 'DelRedisAll')) {
        ob_start();
        @$db->DelRedisAll();
        ob_end_clean();
    }

    // Log deletion event to system log (text column is varchar(20))
    $log_text = substr("Del $type_label: $deleted_count", 0, 20);
    @mysqli_query($koneksi, "INSERT INTO log (id_siswa, type, text, date) VALUES ('0', 'cleanup', '" . mysqli_real_escape_string($koneksi, $log_text) . "', NOW())");

    $response = [
        'status' => 'success',
        'code' => 200,
        'message' => "Berhasil menghapus $deleted_count data $type_label secara aman.",
        'deleted_count' => $deleted_count,
        'type' => $type
    ];

    if (isset($skipped_admin_count) && $skipped_admin_count > 0) {
        $response['message'] .= " ($skipped_admin_count akun Administrator dilindungi dan tidak dihapus).";
    }

    echo json_encode($response);
    exit();

} catch (Exception $e) {
    // Rollback changes safely
    mysqli_rollback($koneksi);

    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'code' => 500,
        'message' => 'Proses dibatalkan: ' . $e->getMessage()
    ]);
    exit();
}
