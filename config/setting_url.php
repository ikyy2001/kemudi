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

$homeurl = "http://" . $_SERVER['HTTP_HOST'] . $relative_path;

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