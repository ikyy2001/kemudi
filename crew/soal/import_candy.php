<?php
require_once __DIR__ . "/../../config/config.default.php";
require_once __DIR__ . "/../../config/config.function.php";

$autoload_path = __DIR__ . "/../../vendor/autoload.php";
if (file_exists($autoload_path)) {
    require_once $autoload_path;
}
require_once __DIR__ . "/../../config/excel_reader2.php";

if (isset($_SESSION['id_pengawas']) || isset($_SESSION['id_user']) || !empty($_POST['id_mapel']) || ($token == $token1)) {
    if (isset($_FILES['file']['name']) && !empty($_FILES['file']['tmp_name'])) {
        $id_mapel = isset($_POST['id_mapel']) ? trim($_POST['id_mapel']) : '';
        $file = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if ($ext !== 'xls' && $ext !== 'xlsx') {
            echo "Harap pilih file excel berformat .xls atau .xlsx";
            exit;
        }

        $rows = array();
        // Method 1: PhpSpreadsheet (supports both .xlsx and .xls)
        if (class_exists('\PhpOffice\PhpSpreadsheet\IOFactory')) {
            try {
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temp);
                $sheet = $spreadsheet->getActiveSheet();
                $sheetData = $sheet->toArray(null, true, true, false);
                if (!empty($sheetData) && count($sheetData) > 1) {
                    // Convert 0-indexed to 1-indexed for standard processing
                    foreach ($sheetData as $r_idx => $r_val) {
                        if ($r_idx === 0) continue; // Skip header
                        $rows[] = array(
                            'no'      => isset($r_val[0]) ? trim((string)$r_val[0]) : '',
                            'soal'    => isset($r_val[1]) ? trim((string)$r_val[1]) : '',
                            'pilA'    => isset($r_val[2]) ? trim((string)$r_val[2]) : '',
                            'pilB'    => isset($r_val[3]) ? trim((string)$r_val[3]) : '',
                            'pilC'    => isset($r_val[4]) ? trim((string)$r_val[4]) : '',
                            'pilD'    => isset($r_val[5]) ? trim((string)$r_val[5]) : '',
                            'pilE'    => isset($r_val[6]) ? trim((string)$r_val[6]) : '',
                            'jawaban' => isset($r_val[7]) ? strtoupper(trim((string)$r_val[7])) : '',
                            'jenis'   => isset($r_val[8]) ? trim((string)$r_val[8]) : '1',
                            'file1'   => isset($r_val[9]) ? trim((string)$r_val[9]) : '',
                            'file2'   => isset($r_val[10]) ? trim((string)$r_val[10]) : '',
                            'fileA'   => isset($r_val[11]) ? trim((string)$r_val[11]) : '',
                            'fileB'   => isset($r_val[12]) ? trim((string)$r_val[12]) : '',
                            'fileC'   => isset($r_val[13]) ? trim((string)$r_val[13]) : '',
                            'fileD'   => isset($r_val[14]) ? trim((string)$r_val[14]) : '',
                            'fileE'   => isset($r_val[15]) ? trim((string)$r_val[15]) : '',
                        );
                    }
                }
            } catch (Exception $e) {
                // Fallback will be attempted
            }
        }

        // Method 2: Spreadsheet_Excel_Reader fallback for .xls
        if (empty($rows) && $ext === 'xls') {
            error_reporting(0);
            $data = new Spreadsheet_Excel_Reader($temp);
            $hasildata = $data->rowcount(0);
            for ($i = 2; $i <= $hasildata; $i++) {
                $rows[] = array(
                    'no'      => trim((string)$data->val($i, 1)),
                    'soal'    => trim((string)$data->val($i, 2)),
                    'pilA'    => trim((string)$data->val($i, 3)),
                    'pilB'    => trim((string)$data->val($i, 4)),
                    'pilC'    => trim((string)$data->val($i, 5)),
                    'pilD'    => trim((string)$data->val($i, 6)),
                    'pilE'    => trim((string)$data->val($i, 7)),
                    'jawaban' => strtoupper(trim((string)$data->val($i, 8))),
                    'jenis'   => trim((string)$data->val($i, 9)),
                    'file1'   => trim((string)$data->val($i, 10)),
                    'file2'   => trim((string)$data->val($i, 11)),
                    'fileA'   => trim((string)$data->val($i, 12)),
                    'fileB'   => trim((string)$data->val($i, 13)),
                    'fileC'   => trim((string)$data->val($i, 14)),
                    'fileD'   => trim((string)$data->val($i, 15)),
                    'fileE'   => trim((string)$data->val($i, 16)),
                );
            }
        }

        if (empty($rows)) {
            echo "Gagal membaca isi file excel atau file excel kosong!";
            exit;
        }

        $sukses = 0;
        $gagal = 0;
        $id_mapel_esc = mysqli_real_escape_string($koneksi, $id_mapel);

        // Bersihkan soal lama dari mapel ini
        mysqli_query($koneksi, "DELETE FROM soal WHERE id_mapel='$id_mapel_esc'");
        mysqli_query($koneksi, "DELETE FROM file_pendukung WHERE id_mapel='$id_mapel_esc'");

        foreach ($rows as $idx => $r) {
            $nomor_soal = !empty($r['no']) ? mysqli_real_escape_string($koneksi, $r['no']) : ($idx + 1);
            $soal = mysqli_real_escape_string($koneksi, $r['soal']);
            $pilA = mysqli_real_escape_string($koneksi, $r['pilA']);
            $pilB = mysqli_real_escape_string($koneksi, $r['pilB']);
            $pilC = mysqli_real_escape_string($koneksi, $r['pilC']);
            $pilD = mysqli_real_escape_string($koneksi, $r['pilD']);
            $pilE = mysqli_real_escape_string($koneksi, $r['pilE']);
            $jawaban = mysqli_real_escape_string($koneksi, $r['jawaban']);
            $jenis = !empty($r['jenis']) ? mysqli_real_escape_string($koneksi, $r['jenis']) : '1';
            $file1 = mysqli_real_escape_string($koneksi, $r['file1']);
            $file2 = mysqli_real_escape_string($koneksi, $r['file2']);
            $fileA = mysqli_real_escape_string($koneksi, $r['fileA']);
            $fileB = mysqli_real_escape_string($koneksi, $r['fileB']);
            $fileC = mysqli_real_escape_string($koneksi, $r['fileC']);
            $fileD = mysqli_real_escape_string($koneksi, $r['fileD']);
            $fileE = mysqli_real_escape_string($koneksi, $r['fileE']);

            if (!empty($soal)) {
                $query = "INSERT INTO soal (id_mapel,nomor,soal,pilA,pilB,pilC,pilD,pilE,jawaban,jenis,file,file1,fileA,fileB,fileC,fileD,fileE) 
                          VALUES ('$id_mapel_esc','$nomor_soal','$soal','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban','$jenis','$file1','$file2','$fileA','$fileB','$fileC','$fileD','$fileE')";
                $exec = mysqli_query($koneksi, $query);
                if ($exec) {
                    $sukses++;
                    $file_list = array($file1, $file2, $fileA, $fileB, $fileC, $fileD, $fileE);
                    foreach ($file_list as $f) {
                        if (!empty($f)) {
                            mysqli_query($koneksi, "INSERT INTO file_pendukung (nama_file,id_mapel) VALUES ('$f','$id_mapel_esc')");
                        }
                    }
                } else {
                    $gagal++;
                }
            } else {
                $gagal++;
            }
        }

        // Hapus cache redis
        if (class_exists('Db')) {
            $db_inst = new Db();
            if (method_exists($db_inst, 'DelRedisAll')) {
                $db_inst->DelRedisAll();
            }
        }

        $total = count($rows);
        echo "Berhasil: $sukses | Gagal: $gagal | Total: $total";
    } else {
        echo "Gagal: file tidak ditemukan!";
    }
} else {
    jump("$homeurl");
}
