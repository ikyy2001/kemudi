<?php
require("../config/config.candy2.php");
$id_level = isset($_POST['level']) ? trim($_POST['level']) : '';

if ($id_level === '' || $id_level === 'semua') {
	$sql = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY id_kelas ASC");
} else {
	$id_level_esc = mysqli_real_escape_string($koneksi, $id_level);
	$sql = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_level='$id_level_esc' ORDER BY id_kelas ASC");
}

echo "<option value='semua'>Semua Kelas</option>";
echo "<option value='khusus'>Khusus</option>";
while ($data = mysqli_fetch_array($sql)) {
	echo "<option value='$data[id_kelas]'>$data[id_kelas]</option>";
}

