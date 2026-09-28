<?php
include("core/c_admin.php"); 

(isset($_SESSION['id_pengawas'])) ? $id_pengawas = $_SESSION['id_pengawas'] : $id_pengawas = 0;
($id_pengawas==0) ? header('location:index.php') : null;

$where = ['id_setting' => 1];

if (isset($_POST['serial']) || isset($_POST['sekolah'])) {
    $data = [
        'lisensiId'           => $db->con->real_escape_string($_POST['serial']),
        'server'              => $db->con->real_escape_string($_POST['status_server']),
        'izin_pass'           => $db->con->real_escape_string($_POST['izin_pass']),
        'izin_materi'         => $db->con->real_escape_string($_POST['izin_materi']),
        'izin_tugas'          => $db->con->real_escape_string($_POST['izin_tugas']),
        'izin_info'           => $db->con->real_escape_string($_POST['izin_info']),
        'izin_ujian'          => $db->con->real_escape_string($_POST['izin_ujian']),
        'izin_sinkron'        => $db->con->real_escape_string($_POST['izin_sinkron']),
        'aplikasi'            => $db->con->real_escape_string($_POST['aplikasi']),
        'namapjj'             => $db->con->real_escape_string($_POST['pjj']),
        'izin_absen'          => $db->con->real_escape_string($_POST['izin_absen']),
        'izin_absen_mapel'    => $db->con->real_escape_string($_POST['izin_absen_mapel']),
        'izi_foto_absen'      => $db->con->real_escape_string($_POST['izi_foto_absen']),
        'sekolah'             => $db->con->real_escape_string($_POST['sekolah']),
        'kode_sekolah'        => $db->con->real_escape_string($_POST['kode']),
        'elerning'            => $db->con->real_escape_string($_POST['elerning']),
        'LoginSiswaMainten'   => $db->con->real_escape_string($_POST['mainten']),
        'ip_server'           => $db->con->real_escape_string($_POST['ipserver']),
        'waktu'               => $db->con->real_escape_string($_POST['waktu']),
        'jenjang'             => $db->con->real_escape_string($_POST['jenjang']),
        'db_token'            => $db->con->real_escape_string($_POST['db_token']),
        'db_token1'           => $db->con->real_escape_string($_POST['db_token1']),
        'kepsek'              => $db->con->real_escape_string($_POST['kepsek']),
        'nip'                 => $db->con->real_escape_string($_POST['nip']),
        'protek'              => $db->con->real_escape_string($_POST['protek']),
        'nip_protek'          => $db->con->real_escape_string($_POST['nip_protek']),
        'alamat'              => $db->con->real_escape_string($_POST['alamat']),
        'kota'                => $db->con->real_escape_string($_POST['kab1']),
        'kecamatan'           => $db->con->real_escape_string($_POST['kec1']),
        'telp'                => $db->con->real_escape_string($_POST['telp']),
        'fax'                 => $db->con->real_escape_string($_POST['fax']),
        'web'                 => $db->con->real_escape_string($_POST['web']),
        'email'               => $db->con->real_escape_string($_POST['email']),
        'JudulPesanSingkat'   => $db->con->real_escape_string($_POST['judul_pesan']),
        'IsiPesanSingkat'     => $db->con->real_escape_string($_POST['isi_pesan']),
        'header'              => $db->con->real_escape_string($_POST['header']),
        'namaSekolah'         => $db->con->real_escape_string($_POST['namaSekolah'])
    ];
    $update = $db->update('setting', $data, $where);

    if ($update) {
        echo 1;
        $extensionList = ['png', 'jpg', 'jpeg'];

        if ($_FILES['logo']['name'] <> '') {
            $logo = $_FILES['logo']['name'];
            $temp = $_FILES['logo']['tmp_name'];
            $ext1 = explode('.', $logo);
            $ext = end($ext1);
            $ekstensi = strtolower($ext);
            if (in_array($ekstensi, $extensionList)) {
                $dest = 'dist/img/logo' . rand(1, 100) . '.' . $ext;
                $upload = move_uploaded_file($temp, '../' . $dest);
                if ($upload) {
                    $db->update('setting', ['logo' => $dest], $where);
                }
            }
        }
        if ($_FILES['ttd']['name'] <> '') {
            $logo = $_FILES['ttd']['name'];
            $temp = $_FILES['ttd']['tmp_name'];
            $ext1 = explode('.', $logo);
            $ext = end($ext1);
            $ekstensi = strtolower($ext);
            if (in_array($ekstensi, $extensionList)) {
                $dest = 'dist/img/ttd.png';
                move_uploaded_file($temp, '../' . $dest);
            }
        }
        if ($_FILES['instansi']['name'] <> '') {
            $logo = $_FILES['instansi']['name'];
            $temp = $_FILES['instansi']['tmp_name'];
            $ext1 = explode('.', $logo);
            $ext = end($ext1);
            $ekstensi = strtolower($ext);
            if (in_array($ekstensi, $extensionList)) {
                $dest = 'dist/img/logo2.png';
                move_uploaded_file($temp, '../' . $dest);
            }
        }
        if ($_FILES['login_admin']['name'] <> '') {
            $logo = $_FILES['login_admin']['name'];
            $temp = $_FILES['login_admin']['tmp_name'];
            $ext1 = explode('.', $logo);
            $ext = end($ext1);
            $ekstensi = strtolower($ext);
            if (in_array($ekstensi, $extensionList) || $ekstensi == 'jpg') {
                $dest = 'dist/img/loginadmin.jpg';
                move_uploaded_file($temp, '../' . $dest);
            }
        }
        if ($_FILES['login_siswa']['name'] <> '') {
            $logo = $_FILES['login_siswa']['name'];
            $temp = $_FILES['login_siswa']['tmp_name'];
            $ext1 = explode('.', $logo);
            $ext = end($ext1);
            $ekstensi = strtolower($ext);
            if (in_array($ekstensi, $extensionList) || $ekstensi == 'jpg') {
                $dest = 'dist/img/loginsiswa.jpg';
                move_uploaded_file($temp, '../' . $dest);
            }
        }
    } else {
        echo "Gagal menyimpan data ke database";
    }
} else {
    echo "No Data to Save";
}
?>
