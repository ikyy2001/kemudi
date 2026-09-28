<?php
include 'config/config.database.php';
$result = mysqli_query($koneksi, 'SELECT * FROM setting');
$row = mysqli_fetch_assoc($result);
echo 'db_token: ' . $row['db_token'] . ' db_token1: ' . $row['db_token1'] . PHP_EOL;
?>