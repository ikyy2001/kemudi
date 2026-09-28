<?php
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/config.default.php';
if (!isset($koneksi)) {
	require_once __DIR__ . '/../config/config.database.php';
}
if (!isset($setting) && isset($koneksi)) {
	$setting = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting='1'"));
}

$kode_sekolah = isset($setting['kode_sekolah']) ? $setting['kode_sekolah'] : '';
$cacheKey = "siswaall" . $kode_sekolah;

$jsonResult = null;
$Redis = null;

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
	require_once __DIR__ . '/../vendor/autoload.php';
	try {
		if (class_exists('RedisClient\RedisClient')) {
			$Redis = new \RedisClient\RedisClient();
			if ($kode_sekolah !== '' && $Redis->exists($cacheKey)) {
				$cached = $Redis->get($cacheKey);
				if (!empty($cached)) {
					$jsonResult = $cached;
				}
			}
		}
	} catch (\Throwable $e) {
		$Redis = null;
	}
}

if ($jsonResult === null) {
	$dataSiswa = [];
	if (isset($koneksi)) {
		$query = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY nama ASC");
		if ($query) {
			while ($row = mysqli_fetch_assoc($query)) {
				$dataSiswa[] = $row;
			}
		}
	}

	$jsonResult = json_encode(['data' => $dataSiswa], JSON_UNESCAPED_UNICODE);
	if ($jsonResult === false) {
		$jsonResult = '{"data":[]}';
	}

	if ($Redis !== null && $kode_sekolah !== '') {
		try {
			$Redis->set($cacheKey, $jsonResult);
			$Redis->expire($cacheKey, 60);
		} catch (\Throwable $e) {
			// Redis cache failure ignored
		}
	}
}

echo $jsonResult;
exit;
