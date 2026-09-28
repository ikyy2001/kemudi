<?php
/**
 * Data Management / Data Cleanup Page
 * Kemudi LMS - Administrator Panel
 */

if (!defined('APLIKASI')) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['level']) || $_SESSION['level'] !== 'admin' || empty($_SESSION['id_pengawas'])) {
        http_response_code(403);
        header('HTTP/1.1 403 Forbidden');
        die('<!DOCTYPE html><html><head><title>403 Forbidden</title></head><body style="font-family:sans-serif; text-align:center; padding:50px;"><h1>403 Forbidden</h1><p>Akses ditolak. Halaman ini hanya untuk role Administrator.</p></body></html>');
    }
} else {
    cek_session_admin();
}

// Fetch live counts for summary cards and tab badges
$cnt_kelas = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM kelas"));
$cnt_siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM siswa"));
$cnt_guru = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM pengawas WHERE level='guru'"));
$cnt_mapel = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM mata_pelajaran"));
$cnt_akun = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM pengawas"));
$cnt_banksoal = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM mapel"));
$cnt_nilai = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM nilai"));
$cnt_tugas = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM tugas"));
$cnt_materi = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM materi2"));
$cnt_log = mysqli_num_rows(mysqli_query($koneksi, "SELECT 1 FROM log"));
?>

<style>
/* Custom scoped styling for Data Cleanup */
.cleanup-hero {
    background: linear-gradient(135deg, #1f4e5b 0%, #0d2830 100%);
    color: #ffffff;
    border-radius: 16px;
    padding: 24px 28px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.12);
}
.cleanup-hero::after {
    content: "\f12d";
    font-family: "FontAwesome";
    position: absolute;
    right: 20px;
    bottom: -25px;
    font-size: 130px;
    color: rgba(255, 255, 255, 0.05);
    pointer-events: none;
}
.cleanup-stat-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    padding: 18px 20px;
    box-shadow: 0 4px 15px -2px rgba(15, 23, 42, 0.04);
    transition: all 0.25s ease;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.cleanup-stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px -3px rgba(15, 23, 42, 0.08);
}
.cleanup-stat-num {
    font-size: 26px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.1;
}
.cleanup-stat-title {
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}
.cleanup-icon-circle {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.cleanup-tabs-nav {
    background: #ffffff;
    border-radius: 14px;
    padding: 8px;
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    border: 1px solid #e2e8f0;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
}
.cleanup-tabs-nav > li {
    float: none;
    margin: 0;
}
.cleanup-tabs-nav > li > a {
    border-radius: 10px !important;
    padding: 10px 16px !important;
    font-weight: 600 !important;
    color: #475569 !important;
    border: none !important;
    margin: 0 !important;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}
.cleanup-tabs-nav > li.active > a,
.cleanup-tabs-nav > li > a:hover {
    background: #1f4e5b !important;
    color: #ffffff !important;
}
.cleanup-tabs-nav > li.active > a .badge {
    background: rgba(255, 255, 255, 0.25) !important;
    color: #ffffff !important;
}
.cleanup-tab-badge {
    border-radius: 999px;
    padding: 2px 8px;
    font-size: 11px;
    font-weight: 700;
    background: #f1f5f9;
    color: #475569;
}
.cleanup-box {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
    overflow: hidden;
    margin-bottom: 30px;
}
.cleanup-toolbar {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 16px 20px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}
.cleanup-table-wrapper {
    max-height: 580px;
    overflow-y: auto;
    position: relative;
}
.cleanup-table {
    margin-bottom: 0 !important;
    width: 100%;
}
.cleanup-table thead th {
    background: #f8fafc;
    color: #334155;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #e2e8f0 !important;
    position: sticky;
    top: 0;
    z-index: 10;
    padding: 12px 14px !important;
}
.cleanup-table tbody tr {
    transition: background-color 0.15s ease;
}
.cleanup-table tbody tr:hover {
    background-color: #f1f5f9 !important;
}
.cleanup-table tbody td {
    padding: 12px 14px !important;
    vertical-align: middle !important;
    border-top: 1px solid #f1f5f9 !important;
    font-size: 13px;
    color: #1e293b;
}
.cleanup-btn-delete {
    background: #ef4444 !important;
    color: #ffffff !important;
    border: none !important;
    font-weight: 700 !important;
    border-radius: 10px !important;
    padding: 8px 18px !important;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.cleanup-btn-delete:hover:not(:disabled) {
    background: #dc2626 !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(239, 68, 68, 0.35);
}
.cleanup-btn-delete:disabled {
    background: #cbd5e1 !important;
    color: #94a3b8 !important;
    box-shadow: none !important;
    cursor: not-allowed !important;
}
.pill-count {
    background: #e2e8f0;
    color: #0f172a;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
}
.admin-protected-row {
    background-color: #f8fafc !important;
}
.admin-badge {
    background: #0284c7;
    color: #ffffff;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.security-notice {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 12px;
    padding: 14px 18px;
    margin-bottom: 20px;
    color: #1e40af;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}
</style>

<!-- Banner Header -->
<div class="cleanup-hero">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:16px;">
        <div>
            <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.15); padding:4px 12px; border-radius:999px; font-size:12px; font-weight:700; margin-bottom:10px;">
                <i class="fa fa-shield"></i> KHUSUS ROLE ADMINISTRATOR
            </div>
            <h2 style="font-weight:800; font-size:26px; margin:0 0 6px 0; color:#fff;">Data Management & Cleanup</h2>
            <p style="font-size:14px; color:rgba(255,255,255,0.8); margin:0; max-width:650px;">
                Pusat manajemen dan pembersihan data utama sistem (Kelas, Siswa, Guru, Mata Pelajaran, Akun Pengguna, dan Data Terkait). Dilengkapi proteksi akun Admin, transaksi database aman, serta validasi relasi.
            </p>
        </div>
        <div style="text-align:right;">
            <button onclick="location.reload()" class="btn btn-default btn-sm" style="border-radius:10px; font-weight:600; padding:8px 14px;">
                <i class="fa fa-refresh"></i> Refresh Halaman
            </button>
        </div>
    </div>
</div>

<!-- Security Alert Notice -->
<div class="security-notice">
    <i class="fa fa-lock" style="font-size:22px; color:#2563eb; margin-top:2px;"></i>
    <div>
        <strong style="font-size:14px;">Proteksi Keamanan Sistem & Akun Administrator Aktif</strong>
        <div style="font-size:13px; color:#1e3a8a; margin-top:2px;">
            Sistem secara ketat <strong>melarang penghapusan Akun Administrator</strong>, baik secara individu maupun melalui fitur <em>Select All</em>. Seluruh proses penghapusan dilindungi transaksi database terpadu (ACID) untuk mencegah data orphan atau kerusakan relasi.
        </div>
    </div>
</div>

<!-- Quick Statistics Summary Row -->
<div class="row" style="margin-bottom:20px;">
    <div class="col-md-3 col-sm-6" style="margin-bottom:15px;">
        <div class="cleanup-stat-card">
            <div>
                <div class="cleanup-stat-title">Total Kelas</div>
                <div class="cleanup-stat-num" id="stat-kelas"><?= number_format($cnt_kelas) ?></div>
            </div>
            <div class="cleanup-icon-circle" style="background:#e0f2fe; color:#0369a1;">
                <i class="fa fa-building"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom:15px;">
        <div class="cleanup-stat-card">
            <div>
                <div class="cleanup-stat-title">Total Siswa</div>
                <div class="cleanup-stat-num" id="stat-siswa"><?= number_format($cnt_siswa) ?></div>
            </div>
            <div class="cleanup-icon-circle" style="background:#dcfce7; color:#15803d;">
                <i class="fa fa-graduation-cap"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom:15px;">
        <div class="cleanup-stat-card">
            <div>
                <div class="cleanup-stat-title">Total Guru</div>
                <div class="cleanup-stat-num" id="stat-guru"><?= number_format($cnt_guru) ?></div>
            </div>
            <div class="cleanup-icon-circle" style="background:#fef3c7; color:#b45309;">
                <i class="fa fa-user-tie"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom:15px;">
        <div class="cleanup-stat-card">
            <div>
                <div class="cleanup-stat-title">Mata Pelajaran</div>
                <div class="cleanup-stat-num" id="stat-mapel"><?= number_format($cnt_mapel) ?></div>
            </div>
            <div class="cleanup-icon-circle" style="background:#f3e8ff; color:#7e22ce;">
                <i class="fa fa-book"></i>
            </div>
        </div>
    </div>
</div>

<!-- Nav Tabs -->
<ul class="nav nav-tabs cleanup-tabs-nav" role="tablist" id="cleanupTabs">
    <li role="presentation" class="active">
        <a href="#tab-kelas" aria-controls="tab-kelas" role="tab" data-toggle="tab">
            <i class="fa fa-building"></i> Kelas 
            <span class="badge cleanup-tab-badge" id="badge-kelas"><?= $cnt_kelas ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-siswa" aria-controls="tab-siswa" role="tab" data-toggle="tab">
            <i class="fa fa-graduation-cap"></i> Siswa 
            <span class="badge cleanup-tab-badge" id="badge-siswa"><?= $cnt_siswa ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-guru" aria-controls="tab-guru" role="tab" data-toggle="tab">
            <i class="fa fa-user-tie"></i> Guru 
            <span class="badge cleanup-tab-badge" id="badge-guru"><?= $cnt_guru ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-mapel" aria-controls="tab-mapel" role="tab" data-toggle="tab">
            <i class="fa fa-book"></i> Mata Pelajaran 
            <span class="badge cleanup-tab-badge" id="badge-mapel"><?= $cnt_mapel ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-akun" aria-controls="tab-akun" role="tab" data-toggle="tab">
            <i class="fa fa-users"></i> Akun / User 
            <span class="badge cleanup-tab-badge" id="badge-akun"><?= $cnt_akun ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-banksoal" aria-controls="tab-banksoal" role="tab" data-toggle="tab">
            <i class="fa fa-folder-open"></i> Bank Soal 
            <span class="badge cleanup-tab-badge" id="badge-banksoal"><?= $cnt_banksoal ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-nilai" aria-controls="tab-nilai" role="tab" data-toggle="tab">
            <i class="fa fa-award"></i> Hasil Nilai 
            <span class="badge cleanup-tab-badge" id="badge-nilai"><?= $cnt_nilai ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-tugas" aria-controls="tab-tugas" role="tab" data-toggle="tab">
            <i class="fa fa-tasks"></i> Tugas & Materi 
            <span class="badge cleanup-tab-badge" id="badge-tugas"><?= $cnt_tugas + $cnt_materi ?></span>
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-log" aria-controls="tab-log" role="tab" data-toggle="tab">
            <i class="fa fa-history"></i> Log Aktivitas 
            <span class="badge cleanup-tab-badge" id="badge-log"><?= $cnt_log ?></span>
        </a>
    </li>
</ul>

<!-- Tab Panes Container -->
<div class="tab-content">

    <!-- ==================== TAB 1: KELAS ==================== -->
    <div role="tabpanel" class="tab-pane active" id="tab-kelas" data-type="kelas" data-title="Kelas">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-kelas">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-kelas" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-kelas" placeholder="Cari data kelas..." style="width:220px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="kelas" data-title="Data Kelas" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-kelas">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-kelas">
                            </th>
                            <th width="60">ID</th>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Level / Tingkat</th>
                            <th>Jurusan / PK</th>
                            <th>Jumlah Siswa Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_kls = mysqli_query($koneksi, "
                            SELECT k.*, 
                            (SELECT COUNT(*) FROM siswa s WHERE s.id_kelas = k.id_kelas) as jml_siswa 
                            FROM kelas k ORDER BY k.idkls ASC
                        ");
                        if (mysqli_num_rows($q_kls) == 0) :
                        ?>
                            <tr><td colspan="7" class="text-center text-muted" style="padding:30px !important;">Tidak ada data kelas ditemukan.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_kls)) :
                        ?>
                            <tr id="row-kelas-<?= $r['idkls'] ?>" data-search="<?= strtolower($r['id_kelas'] . ' ' . $r['nama'] . ' ' . $r['id_level'] . ' ' . $r['id_pk']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['idkls'] ?>" data-name="<?= htmlspecialchars($r['nama']) ?> (<?= $r['id_kelas'] ?>)">
                                </td>
                                <td><?= $r['idkls'] ?></td>
                                <td><span class="label label-info" style="font-size:12px;"><?= $r['id_kelas'] ?></span></td>
                                <td style="font-weight:600;"><?= $r['nama'] ?></td>
                                <td><?= !empty($r['id_level']) ? $r['id_level'] : '-' ?></td>
                                <td><?= !empty($r['id_pk']) ? $r['id_pk'] : '-' ?></td>
                                <td>
                                    <span class="badge" style="background:#e2e8f0; color:#334155; font-size:12px;">
                                        <?= $r['jml_siswa'] ?> Siswa
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 2: SISWA ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-siswa" data-type="siswa" data-title="Siswa">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-siswa">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-siswa" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-siswa" placeholder="Cari nama, NIS, nomor peserta..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="siswa" data-title="Data Siswa" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-siswa">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-siswa">
                            </th>
                            <th width="120">No. Peserta</th>
                            <th width="100">NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Sesi / Ruang</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_siswa = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY id_siswa ASC");
                        if (mysqli_num_rows($q_siswa) == 0) :
                        ?>
                            <tr><td colspan="8" class="text-center text-muted" style="padding:30px !important;">Tidak ada data siswa ditemukan.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_siswa)) :
                        ?>
                            <tr id="row-siswa-<?= $r['id_siswa'] ?>" data-search="<?= strtolower($r['no_peserta'] . ' ' . $r['nis'] . ' ' . $r['nama'] . ' ' . $r['id_kelas'] . ' ' . $r['username']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['id_siswa'] ?>" data-name="<?= htmlspecialchars($r['nama']) ?> (<?= $r['nis'] ?>)">
                                </td>
                                <td><code><?= $r['no_peserta'] ?></code></td>
                                <td><?= $r['nis'] ?></td>
                                <td style="font-weight:600; color:#0f172a;"><?= $r['nama'] ?></td>
                                <td><span class="label label-default"><?= $r['id_kelas'] ?></span></td>
                                <td><?= !empty($r['idpk']) ? $r['idpk'] : '-' ?></td>
                                <td>Sesi <?= $r['sesi'] ?> / Ruang <?= $r['ruang'] ?></td>
                                <td><?= $r['username'] ?></td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 3: GURU ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-guru" data-type="guru" data-title="Guru">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-guru">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-guru" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-guru" placeholder="Cari nama, NIP, username guru..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="guru" data-title="Data Guru" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-guru">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-guru">
                            </th>
                            <th width="120">NIP</th>
                            <th>Nama Guru</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Bank Soal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_guru = mysqli_query($koneksi, "
                            SELECT p.*,
                            (SELECT COUNT(*) FROM mapel m WHERE m.idguru = p.id_pengawas) as jml_mapel 
                            FROM pengawas p WHERE p.level='guru' ORDER BY p.id_pengawas ASC
                        ");
                        if (mysqli_num_rows($q_guru) == 0) :
                        ?>
                            <tr><td colspan="6" class="text-center text-muted" style="padding:30px !important;">Tidak ada data guru ditemukan.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_guru)) :
                        ?>
                            <tr id="row-guru-<?= $r['id_pengawas'] ?>" data-search="<?= strtolower($r['nip'] . ' ' . $r['nama'] . ' ' . $r['username'] . ' ' . $r['jabatan']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['id_pengawas'] ?>" data-name="<?= htmlspecialchars($r['nama']) ?> (<?= $r['username'] ?>)">
                                </td>
                                <td><?= !empty($r['nip']) ? $r['nip'] : '-' ?></td>
                                <td style="font-weight:600; color:#0f172a;">
                                    <i class="fa fa-user-circle" style="color:#64748b; margin-right:4px;"></i>
                                    <?= $r['nama'] ?>
                                </td>
                                <td><code><?= $r['username'] ?></code></td>
                                <td><?= !empty($r['jabatan']) ? $r['jabatan'] : 'Guru Mata Pelajaran' ?></td>
                                <td>
                                    <span class="badge" style="background:#e0f2fe; color:#0369a1;">
                                        <?= $r['jml_mapel'] ?> Bank Soal
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 4: MATA PELAJARAN ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-mapel" data-type="matapelajaran" data-title="Mata Pelajaran">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-mapel">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-mapel" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-mapel" placeholder="Cari kode atau nama mapel..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="matapelajaran" data-title="Mata Pelajaran" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-mapel">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-mapel">
                            </th>
                            <th width="80">ID</th>
                            <th width="150">Kode Mapel</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Level / Tingkat</th>
                            <th>Terkait Bank Soal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_mp = mysqli_query($koneksi, "
                            SELECT mp.*,
                            (SELECT COUNT(*) FROM mapel m WHERE m.KodeMapel = mp.kode_mapel) as jml_banksoal 
                            FROM mata_pelajaran mp ORDER BY mp.idmapel ASC
                        ");
                        if (mysqli_num_rows($q_mp) == 0) :
                        ?>
                            <tr><td colspan="6" class="text-center text-muted" style="padding:30px !important;">Tidak ada data mata pelajaran ditemukan.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_mp)) :
                        ?>
                            <tr id="row-matapelajaran-<?= $r['idmapel'] ?>" data-search="<?= strtolower($r['kode_mapel'] . ' ' . $r['nama_mapel'] . ' ' . $r['kode_level']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['idmapel'] ?>" data-name="<?= htmlspecialchars($r['nama_mapel']) ?> (<?= $r['kode_mapel'] ?>)">
                                </td>
                                <td><?= $r['idmapel'] ?></td>
                                <td><span class="label label-success" style="font-size:12px;"><?= $r['kode_mapel'] ?></span></td>
                                <td style="font-weight:600;"><?= $r['nama_mapel'] ?></td>
                                <td><?= !empty($r['kode_level']) ? $r['kode_level'] : 'Semua Level' ?></td>
                                <td>
                                    <span class="badge" style="background:#f1f5f9; color:#475569;">
                                        <?= $r['jml_banksoal'] ?> Bank Soal
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 5: AKUN / USER (WITH STRICT ADMIN PROTECTION) ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-akun" data-type="pengawas" data-title="Akun Pengguna">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-akun">
                        <span>Pilih Semua Akun yang Dapat Dihapus</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-akun" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                    <span style="font-size:12px; color:#0369a1; background:#e0f2fe; padding:3px 10px; border-radius:6px; font-weight:600;">
                        <i class="fa fa-info-circle"></i> Akun Administrator otomatis dikunci dan tidak dapat dipilih.
                    </span>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-akun" placeholder="Cari nama, username, role..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="pengawas" data-title="Akun Pengguna" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-akun">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-akun">
                            </th>
                            <th width="60">ID</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role / Level</th>
                            <th>Status Keamanan</th>
                            <th>Terdaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_akun = mysqli_query($koneksi, "SELECT * FROM pengawas ORDER BY (level='admin') DESC, id_pengawas ASC");
                        if (mysqli_num_rows($q_akun) == 0) :
                        ?>
                            <tr><td colspan="7" class="text-center text-muted" style="padding:30px !important;">Tidak ada akun ditemukan.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_akun)) :
                                $is_admin = ($r['level'] === 'admin' || $r['username'] === 'admin' || $r['id_pengawas'] == $_SESSION['id_pengawas']);
                        ?>
                            <tr id="row-pengawas-<?= $r['id_pengawas'] ?>" class="<?= $is_admin ? 'admin-protected-row' : '' ?>" data-search="<?= strtolower($r['nama'] . ' ' . $r['username'] . ' ' . $r['level']) ?>">
                                <td class="text-center">
                                    <?php if ($is_admin) : ?>
                                        <input type="checkbox" disabled="disabled" class="row-check-disabled" title="Akun Administrator dilindungi oleh sistem keamanan">
                                    <?php else : ?>
                                        <input type="checkbox" class="row-check" value="<?= $r['id_pengawas'] ?>" data-name="<?= htmlspecialchars($r['nama']) ?> (<?= $r['username'] ?>)">
                                    <?php endif; ?>
                                </td>
                                <td><?= $r['id_pengawas'] ?></td>
                                <td style="font-weight:600; color:#0f172a;">
                                    <?php if ($is_admin) : ?>
                                        <i class="fa fa-shield text-blue" style="margin-right:4px;"></i>
                                    <?php else : ?>
                                        <i class="fa fa-user text-muted" style="margin-right:4px;"></i>
                                    <?php endif; ?>
                                    <?= $r['nama'] ?>
                                </td>
                                <td><code><?= $r['username'] ?></code></td>
                                <td>
                                    <?php if ($r['level'] === 'admin') : ?>
                                        <span class="label label-danger" style="font-size:11px; font-weight:700;"><i class="fa fa-star"></i> ADMINISTRATOR</span>
                                    <?php elseif ($r['level'] === 'guru') : ?>
                                        <span class="label label-primary" style="font-size:11px;">GURU</span>
                                    <?php else : ?>
                                        <span class="label label-warning" style="font-size:11px;"><?= strtoupper($r['level']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($is_admin) : ?>
                                        <span class="admin-badge"><i class="fa fa-lock"></i> DILINDUNGI SISTEM</span>
                                    <?php else : ?>
                                        <span class="text-muted"><i class="fa fa-check-circle text-green"></i> Dapat Dihapus</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted" style="font-size:12px;">
                                    <?= !empty($r['pengawas_created']) ? $r['pengawas_created'] : '-' ?>
                                </td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 6: BANK SOAL ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-banksoal" data-type="banksoal" data-title="Bank Soal">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-banksoal">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-banksoal" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-banksoal" placeholder="Cari nama bank soal, mapel..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="banksoal" data-title="Bank Soal" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-banksoal">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-banksoal">
                            </th>
                            <th width="60">ID</th>
                            <th>Nama Bank Soal</th>
                            <th>Kode Mapel</th>
                            <th>Jumlah Soal (PG / Esai)</th>
                            <th>Level / Kelas Target</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_bs = mysqli_query($koneksi, "SELECT * FROM mapel ORDER BY id_mapel DESC");
                        if (mysqli_num_rows($q_bs) == 0) :
                        ?>
                            <tr><td colspan="6" class="text-center text-muted" style="padding:30px !important;">Tidak ada bank soal ditemukan.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_bs)) :
                        ?>
                            <tr id="row-banksoal-<?= $r['id_mapel'] ?>" data-search="<?= strtolower($r['nama'] . ' ' . $r['KodeMapel'] . ' ' . $r['level']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['id_mapel'] ?>" data-name="<?= htmlspecialchars($r['nama']) ?>">
                                </td>
                                <td><?= $r['id_mapel'] ?></td>
                                <td style="font-weight:600; color:#0f172a;"><?= $r['nama'] ?></td>
                                <td><span class="label label-info"><?= $r['KodeMapel'] ?></span></td>
                                <td><?= $r['jml_soal'] ?> PG / <?= $r['jml_esai'] ?> Esai</td>
                                <td>Level: <?= $r['level'] ?> (<?= substr(strip_tags($r['kelas']), 0, 30) ?>)</td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 7: HASIL NILAI ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-nilai" data-type="nilai" data-title="Hasil Nilai">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-nilai">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-nilai" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-nilai" placeholder="Cari data nilai..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="nilai" data-title="Hasil Nilai Ujian" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-nilai">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-nilai">
                            </th>
                            <th width="60">ID</th>
                            <th>ID Siswa / Nama</th>
                            <th>Kode Mapel</th>
                            <th>Skor / Total</th>
                            <th>Waktu Ujian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_nil = mysqli_query($koneksi, "
                            SELECT n.*, s.nama as nama_siswa 
                            FROM nilai n 
                            LEFT JOIN siswa s ON n.id_siswa = s.id_siswa 
                            ORDER BY n.id_nilai DESC LIMIT 200
                        ");
                        if (mysqli_num_rows($q_nil) == 0) :
                        ?>
                            <tr><td colspan="6" class="text-center text-muted" style="padding:30px !important;">Tidak ada riwayat hasil nilai ujian.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_nil)) :
                        ?>
                            <tr id="row-nilai-<?= $r['id_nilai'] ?>" data-search="<?= strtolower($r['nama_siswa'] . ' ' . $r['KodeMataPelajaran'] . ' ' . $r['kode_ujian']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['id_nilai'] ?>" data-name="Nilai ID <?= $r['id_nilai'] ?> - <?= htmlspecialchars($r['nama_siswa']) ?>">
                                </td>
                                <td><?= $r['id_nilai'] ?></td>
                                <td style="font-weight:600;"><?= !empty($r['nama_siswa']) ? $r['nama_siswa'] : 'ID Siswa: ' . $r['id_siswa'] ?></td>
                                <td><span class="label label-info"><?= $r['KodeMataPelajaran'] ?></span></td>
                                <td><strong><?= $r['skor'] ?></strong> (Benar: <?= $r['jml_benar'] ?>, Salah: <?= $r['jml_salah'] ?>)</td>
                                <td class="text-muted" style="font-size:12px;"><?= $r['ujian_mulai'] ?> s/d <?= $r['ujian_selesai'] ?></td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 8: TUGAS & MATERI ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-tugas" data-type="tugas" data-title="Tugas">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-tugas">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-tugas" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-tugas" placeholder="Cari judul tugas / materi..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="tugas" data-title="Data Tugas" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-tugas">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-tugas">
                            </th>
                            <th width="60">ID</th>
                            <th>Judul Tugas</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas Target</th>
                            <th>Tgl Mulai / Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_tug = mysqli_query($koneksi, "SELECT * FROM tugas ORDER BY id_tugas DESC");
                        if (mysqli_num_rows($q_tug) == 0) :
                        ?>
                            <tr><td colspan="6" class="text-center text-muted" style="padding:30px !important;">Tidak ada data tugas ditemukan.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_tug)) :
                        ?>
                            <tr id="row-tugas-<?= $r['id_tugas'] ?>" data-search="<?= strtolower($r['judul'] . ' ' . $r['mapel'] . ' ' . $r['kelas']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['id_tugas'] ?>" data-name="<?= htmlspecialchars($r['judul']) ?>">
                                </td>
                                <td><?= $r['id_tugas'] ?></td>
                                <td style="font-weight:600; color:#0f172a;"><?= $r['judul'] ?></td>
                                <td><span class="label label-warning"><?= $r['mapel'] ?></span></td>
                                <td><?= $r['kelas'] ?></td>
                                <td class="text-muted" style="font-size:12px;"><?= $r['tgl_mulai'] ?> s/d <?= $r['tgl_selesai'] ?></td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ==================== TAB 9: LOG AKTIVITAS ==================== -->
    <div role="tabpanel" class="tab-pane" id="tab-log" data-type="log" data-title="Log Aktivitas">
        <div class="cleanup-box">
            <div class="cleanup-toolbar">
                <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
                    <label style="margin:0; font-weight:700; cursor:pointer; display:flex; align-items:center; gap:6px;">
                        <input type="checkbox" class="select-all-check" data-target="tab-log">
                        <span>Pilih Semua (Select All)</span>
                    </label>
                    <span class="pill-count"><span class="selected-count">0</span> data dipilih</span>
                    <button type="button" class="btn btn-default btn-xs btn-deselect-all" data-target="tab-log" style="border-radius:6px;">
                        Batal Pilihan
                    </button>
                </div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div style="position:relative;">
                        <input type="text" class="form-control input-sm tab-search-input" data-target="tab-log" placeholder="Cari catatan log..." style="width:240px; border-radius:8px; padding-left:28px;">
                        <i class="fa fa-search" style="position:absolute; left:10px; top:8px; color:#94a3b8;"></i>
                    </div>
                    <button type="button" class="cleanup-btn-delete" data-type="log" data-title="Log Aktivitas" disabled="disabled">
                        <i class="fa fa-trash"></i> Hapus Data Terpilih
                    </button>
                </div>
            </div>
            <div class="cleanup-table-wrapper">
                <table class="table cleanup-table" id="table-log">
                    <thead>
                        <tr>
                            <th width="40" class="text-center">
                                <input type="checkbox" class="select-all-check" data-target="tab-log">
                            </th>
                            <th width="60">ID</th>
                            <th>ID Siswa / Pengguna</th>
                            <th>Jenis Log</th>
                            <th>Deskripsi / Aktivitas</th>
                            <th>Waktu Pencatatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_lg = mysqli_query($koneksi, "SELECT * FROM log ORDER BY id_log DESC LIMIT 200");
                        if (mysqli_num_rows($q_lg) == 0) :
                        ?>
                            <tr><td colspan="6" class="text-center text-muted" style="padding:30px !important;">Tidak ada riwayat log aktivitas.</td></tr>
                        <?php else :
                            while ($r = mysqli_fetch_assoc($q_lg)) :
                        ?>
                            <tr id="row-log-<?= $r['id_log'] ?>" data-search="<?= strtolower($r['type'] . ' ' . $r['text']) ?>">
                                <td class="text-center">
                                    <input type="checkbox" class="row-check" value="<?= $r['id_log'] ?>" data-name="Log #<?= $r['id_log'] ?> (<?= htmlspecialchars($r['type']) ?>)">
                                </td>
                                <td><?= $r['id_log'] ?></td>
                                <td>User ID: <?= $r['id_siswa'] ?></td>
                                <td><span class="label label-default"><?= $r['type'] ?></span></td>
                                <td><?= htmlspecialchars($r['text']) ?></td>
                                <td class="text-muted" style="font-size:12px;"><?= $r['date'] ?></td>
                            </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="modalCleanupConfirm" tabindex="-1" role="dialog" aria-labelledby="modalCleanupLabel" data-backdrop="static">
    <div class="modal-dialog" role="document" style="max-width:540px;">
        <div class="modal-content" style="border-radius:18px; border:none; box-shadow: 0 20px 40px rgba(0,0,0,0.2); overflow:hidden;">
            <div class="modal-header" style="background:#fee2e2; border-bottom:1px solid #fecaca; padding:18px 24px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:24px; color:#991b1b; opacity:0.8;">&times;</button>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:42px; height:42px; border-radius:50%; background:#fef2f2; color:#dc2626; display:flex; align-items:center; justify-content:center; font-size:20px; border:2px solid #fca5a5;">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h4 class="modal-title" id="modalCleanupLabel" style="font-weight:800; color:#991b1b; margin:0;">
                            Konfirmasi Penghapusan Data
                        </h4>
                        <span style="font-size:12px; color:#b91c1c;">Tindakan pembersihan data sistem</span>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="padding:22px 24px;">
                <p style="font-size:15px; color:#1e293b; margin-bottom:14px;">
                    Anda akan menghapus <strong id="modal-delete-count" style="color:#dc2626; font-size:16px;">0</strong> data dari kategori <strong id="modal-delete-type" style="color:#0f172a;"></strong>.
                </p>

                <!-- High Impact / Select All Extra Warning Banner -->
                <div id="modal-extra-warning" style="display:none; background:#fff1f2; border:1px solid #fda4af; border-radius:12px; padding:12px 16px; margin-bottom:16px;">
                    <div style="display:flex; gap:10px; align-items:flex-start;">
                        <i class="fa fa-exclamation-circle" style="color:#e11d48; font-size:20px; margin-top:2px;"></i>
                        <div>
                            <strong style="color:#9f1239; font-size:13px;">PERINGATAN PENGHAPUSAN BESAR:</strong>
                            <div style="font-size:12px; color:#881337; margin-top:2px;">
                                Tindakan ini bersifat <strong>PERMANEN</strong> dan data yang dihapus <strong>TIDAK DAPAT DIPULIHKAN KEMBALI</strong>! Pastikan Anda telah memiliki cadangan data jika diperlukan.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preview of selected items -->
                <div style="margin-bottom:16px;">
                    <label style="font-size:12px; font-weight:700; color:#64748b; text-transform:uppercase;">Daftar Data Terpilih (Pratinjau):</label>
                    <div id="modal-preview-list" style="max-height:140px; overflow-y:auto; background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:10px 14px; font-size:12px; color:#334155; line-height:1.6;">
                    </div>
                </div>

                <div style="background:#f1f5f9; border-radius:10px; padding:10px 14px; font-size:12px; color:#475569; display:flex; align-items:center; gap:8px;">
                    <i class="fa fa-shield" style="color:#0284c7;"></i>
                    <span>Akun Administrator otomatis dilindungi oleh sistem dan tidak akan ikut terhapus.</span>
                </div>
            </div>
            <div class="modal-footer" style="background:#f8fafc; border-top:1px solid #e2e8f0; padding:16px 24px; display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius:10px; font-weight:600; padding:8px 18px;">
                    Batal
                </button>
                <button type="button" class="btn btn-danger" id="btn-execute-delete" style="border-radius:10px; font-weight:700; padding:8px 20px; background:#dc2626; border:none; box-shadow:0 4px 12px rgba(220,38,38,0.3);">
                    <i class="fa fa-trash"></i> Ya, Hapus Data Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var activeDeleteConfig = {
        type: '',
        title: '',
        targetTabId: '',
        ids: [],
        names: []
    };

    // Helper: update selection state for a specific tab
    function updateTabSelectionState(tabId) {
        var $tab = $('#' + tabId);
        var $allCheckboxes = $tab.find('tbody .row-check:not(:disabled)');
        var $checkedCheckboxes = $tab.find('tbody .row-check:checked');
        var selectedCount = $checkedCheckboxes.length;

        $tab.find('.selected-count').text(selectedCount);

        var $delBtn = $tab.find('.cleanup-btn-delete');
        if (selectedCount > 0) {
            $delBtn.prop('disabled', false);
        } else {
            $delBtn.prop('disabled', true);
        }

        // Update header Select All checkbox state
        var $selectAll = $tab.find('.select-all-check');
        if ($allCheckboxes.length > 0 && selectedCount === $allCheckboxes.length) {
            $selectAll.prop('checked', true);
        } else {
            $selectAll.prop('checked', false);
        }
    }

    // Row checkbox change
    $(document).on('change', '.row-check', function() {
        var tabId = $(this).closest('.tab-pane').attr('id');
        updateTabSelectionState(tabId);
    });

    // Select All Checkbox change
    $(document).on('change', '.select-all-check', function() {
        var tabId = $(this).data('target');
        var isChecked = $(this).is(':checked');
        var $tab = $('#' + tabId);

        // Only check enabled checkboxes (skips disabled Admin rows)
        $tab.find('tbody .row-check:not(:disabled)').prop('checked', isChecked);
        $tab.find('.select-all-check').prop('checked', isChecked);
        updateTabSelectionState(tabId);
    });

    // Deselect All button
    $(document).on('click', '.btn-deselect-all', function() {
        var tabId = $(this).data('target');
        var $tab = $('#' + tabId);
        $tab.find('tbody .row-check').prop('checked', false);
        $tab.find('.select-all-check').prop('checked', false);
        updateTabSelectionState(tabId);
    });

    // Live search filter per tab
    $(document).on('keyup', '.tab-search-input', function() {
        var query = $(this).val().toLowerCase().trim();
        var tabId = $(this).data('target');
        var $tab = $('#' + tabId);

        $tab.find('tbody tr').each(function() {
            var searchData = $(this).data('search');
            if (!searchData) return;
            if (query === '' || searchData.indexOf(query) !== -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Open Confirmation Modal on Delete Selected Click
    $(document).on('click', '.cleanup-btn-delete', function() {
        var type = $(this).data('type');
        var title = $(this).data('title');
        var $tab = $(this).closest('.tab-pane');
        var tabId = $tab.attr('id');

        var selectedIds = [];
        var selectedNames = [];

        $tab.find('tbody .row-check:checked').each(function() {
            selectedIds.push($(this).val());
            var name = $(this).data('name') || ('ID: ' + $(this).val());
            selectedNames.push(name);
        });

        if (selectedIds.length === 0) {
            if (window.toastr) {
                toastr.warning('Silahkan pilih data yang ingin dihapus terlebih dahulu.');
            } else {
                alert('Silahkan pilih data terlebih dahulu.');
            }
            return;
        }

        activeDeleteConfig.type = type;
        activeDeleteConfig.title = title;
        activeDeleteConfig.targetTabId = tabId;
        activeDeleteConfig.ids = selectedIds;
        activeDeleteConfig.names = selectedNames;

        // Populate modal
        $('#modal-delete-count').text(selectedIds.length);
        $('#modal-delete-type').text(title);

        var previewHtml = '<ol style="padding-left:18px; margin:0;">';
        var limit = Math.min(selectedNames.length, 30);
        for (var i = 0; i < limit; i++) {
            previewHtml += '<li>' + selectedNames[i] + '</li>';
        }
        if (selectedNames.length > 30) {
            previewHtml += '<li><em>... dan ' + (selectedNames.length - 30) + ' data lainnya.</em></li>';
        }
        previewHtml += '</ol>';
        $('#modal-preview-list').html(previewHtml);

        // Show extra warning if large deletion (>= 5 items)
        if (selectedIds.length >= 5) {
            $('#modal-extra-warning').show();
        } else {
            $('#modal-extra-warning').hide();
        }

        $('#modalCleanupConfirm').modal('show');
    });

    // Execute Delete Action via AJAX
    $('#btn-execute-delete').on('click', function() {
        var $btn = $(this);
        var origText = $btn.html();

        $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menghapus...');

        $.ajax({
            url: 'data_cleanup_act.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'delete',
                type: activeDeleteConfig.type,
                ids: activeDeleteConfig.ids
            },
            success: function(response) {
                $btn.prop('disabled', false).html(origText);
                $('#modalCleanupConfirm').modal('hide');

                if (response.status === 'success') {
                    // Success notification
                    if (window.toastr) {
                        toastr.success(response.message, 'Berhasil!');
                    }

                    if (window.Swal) {
                        Swal.fire({
                            title: 'Pembersihan Selesai!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#1f4e5b',
                            confirmButtonText: 'OK'
                        });
                    }

                    // Remove rows with animation
                    var targetTabId = activeDeleteConfig.targetTabId;
                    var type = activeDeleteConfig.type;
                    var deletedIds = activeDeleteConfig.ids;

                    for (var i = 0; i < deletedIds.length; i++) {
                        $('#row-' + type + '-' + deletedIds[i]).fadeOut(300, function() {
                            $(this).remove();
                        });
                    }

                    // Update badge count
                    var $badge = $('#badge-' + targetTabId.replace('tab-', ''));
                    var currentCount = parseInt($badge.text()) || 0;
                    var newCount = Math.max(0, currentCount - response.deleted_count);
                    $badge.text(newCount);

                    // Update stat card if matching
                    var $stat = $('#stat-' + targetTabId.replace('tab-', ''));
                    if ($stat.length) {
                        $stat.text(newCount);
                    }

                    // Reset selection in tab
                    setTimeout(function() {
                        updateTabSelectionState(targetTabId);
                    }, 350);

                } else {
                    if (window.toastr) {
                        toastr.error(response.message || 'Gagal menghapus data.', 'Error');
                    }
                    if (window.Swal) {
                        Swal.fire({
                            title: 'Gagal Menghapus Data',
                            text: response.message || 'Terjadi kesalahan sistem saat memproses penghapusan.',
                            icon: 'error',
                            confirmButtonColor: '#dc2626'
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                $btn.prop('disabled', false).html(origText);
                $('#modalCleanupConfirm').modal('hide');

                var errorMsg = 'Terjadi kesalahan jaringan atau server.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (xhr.status === 403) {
                    errorMsg = '403 Forbidden: Akses ditolak. Hanya Administrator yang diizinkan.';
                }

                if (window.toastr) {
                    toastr.error(errorMsg, 'Gagal');
                }
                if (window.Swal) {
                    Swal.fire({
                        title: 'Penghapusan Gagal',
                        text: errorMsg,
                        icon: 'error',
                        confirmButtonColor: '#dc2626'
                    });
                }
            }
        });
    });
});
</script>
