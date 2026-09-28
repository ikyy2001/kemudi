<?php 

//-------------Jika di Localhost-----------------
$uri = $_SERVER['REQUEST_URI'];
$pageurl = explode("/", $uri);

$project_root_raw = str_replace('\\', '/', realpath(dirname(__DIR__)));
$project_root = strtolower($project_root_raw);
$doc_root = strtolower(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])));
$doc_root = rtrim($doc_root, '/');

$relative_path = '';
if (strpos($project_root, $doc_root) === 0) {
    $relative_path = substr($project_root_raw, strlen($doc_root));
}
$relative_path = '/' . ltrim(str_replace('\\', '/', $relative_path), '/');
$relative_path = rtrim($relative_path, '/');

// Deteksi protokol HTTPS
$is_https = false;
if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
    $is_https = true;
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
    $is_https = true;
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && strtolower($_SERVER['HTTP_X_FORWARDED_SSL']) === 'on') {
    $is_https = true;
} elseif (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
    $is_https = true;
} elseif (!empty($_SERVER['HTTP_CF_VISITOR']) && strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false) {
    $is_https = true;
}

// Deteksi Host dari HTTP_HOST atau X-Forwarded-Host
$host = !empty($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (!empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');

// Cek apakah lingkungan lokal (localhost / IP LAN)
$is_local = preg_match('/^(localhost|127\.0\.0\.1|192\.168\.|10\.|172\.(1[6-9]|2[0-9]|3[0-1]))/i', $host);

if (!$is_local) {
    // Pada domain publik (seperti dash.kabingroup.my.id), hapus port internal seperti :4136
    $host = preg_replace('/:\d+$/', '', $host);
    // Domain publik default ke HTTPS
    $protocol = "https://";
} else {
    $protocol = $is_https ? "https://" : "http://";
}

$homeurl = $protocol . $host . $relative_path;

$subdirs = array_filter(explode('/', $relative_path));
$shift = count($subdirs);

(isset($pageurl[1 + $shift])) ? $pg = $pageurl[1 + $shift] : $pg = '';
(isset($pageurl[2 + $shift])) ? $ac = $pageurl[2 + $shift] : $ac = '';
(isset($pageurl[3 + $shift])) ? $id = $pageurl[3 + $shift] : $id = 0;


//-------------Jika di Localhost-----------------

//---Matikan Salah Satu 

//-------------Jika di Hosting-----------------
//$uri = $_SERVER['REQUEST_URI'];
//$pageurl = explode("/",$uri);

//$homeurl = "http://".$_SERVER['HTTP_HOST']; //---tambah s pada http jika web sudah mendukung https
//(isset($pageurl[1])) ? $pg = $pageurl[1] : $pg = '';
//(isset($pageurl[2])) ? $ac = $pageurl[2] : $ac = '';
//(isset($pageurl[3])) ? $id = $pageurl[3] : $id = 0;
//-------------Jika di Hosting-----------------

if (!function_exists('WaktuLamaCache2')) {
	function WaktuLamaCache2(){ // ganti untuk lama waktu cache
		return 3600; //dalam detik
		//1 jam 3600, 30 menit = 1800,10 menit=600,20 menit = 1200,5 menit = 300
	}
}
require_once "config.database.php";

$setting = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM setting WHERE id_setting='1'"));

//time CBT ------------------------------------
$no = $jam = $mnt = $dtk = 0;
$info = '';
$waktu = date('H:i:s');
$tanggal = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
//------------------------------------


?>