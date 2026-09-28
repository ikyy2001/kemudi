<!DOCTYPE html>
<?php

require("../config/config.login_admin.php");
require("../config/config.function.php");
require("../config/config.candy2.php");
$cekdb = mysqli_query($koneksi, "SELECT 1 FROM pengawas LIMIT 1");
if ($cekdb == false) {
	header("Location: ../install.php");
}

$ceks = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM setting"));
$token_bot = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM bot_telegram"));

$namaaplikasi = $ceks['aplikasi'];
$namasekolah = $ceks['sekolah'];
$dbtoken = $ceks['db_token'];


$dbb= new Login(); 
$daa1=$dbb->CacheSetting();
foreach ($daa1 as $value) {
	$setting = $value;
}
?>
<html lang="en">

<head>
	<title>Login Admin | <?= APLIKASI . " - " . REVISI ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../plugins/font-awesome/css/font-awesome.css">

	<link rel="stylesheet" type="text/css" href="../plugins/animate/animate.min.css">

	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/util.css">
	<link rel="stylesheet" type="text/css" href="../dist/bootstrap/css/main.css">
	<style>
		.judul {
			position: absolute;
			right: 20px;
			top: 20px;
			z-index: 2;
			color: #000;
		}
		.judul2 {
			position: absolute;
			right: 380px;
			top: 20px;
			z-index: 2;
			color: #000;
		}

		.logo {
			position: absolute;
			left: 20px;
			top: 20px;
			z-index: 2;
			color: #000;
			-webkit-filter: drop-shadow(5px 5px 5px #222);
			filter: drop-shadow(5px 5px 5px #222);
		}

		.candy {
			position: absolute;
			left: 20px;
			bottom: 20px;
			z-index: 3;
			opacity: 0.8;
			transition: opacity 0.2s ease;
		}

		.candy:hover {
			opacity: 1.0;
		}

		.wrap-login100-form-btn {
			display: block;
			position: relative;
			z-index: 1;
			border-radius: 0px;
			overflow: hidden;
		}
	</style>
</head>

<body style="background-color: #999999;">

	<div class="limiter">
		<div class="container-login100">
			<!-- <div class='judul2'>
					<b class="txt2 hov1"><?= MOD ?></b>
			</div> -->
			
			<div class='logo hidden-xs'><img class='img img-responsive' style='max-width:200px;' src="<?php echo "$homeurl/$setting[logo]"; ?>" width='150'></div>
			<div class='candy hidden-xs'>
				<img src="<?= $homeurl ?>/dist/img/logo55.png" style="width: 50px; height: 50px; object-fit: contain;" alt="Logo">
			</div>
			<div class="login100-more" style="background-image: url(<?php echo $homeurl.'/dist/img/loginadmin.jpg'.'?date='.time(); ?>);"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50" style="background-image: url('../dist/img/b.jpg');">
				<form action='' method='post' class="validate-form">
					<span class="animated flipInX login100-form-title">
						<?php echo	$namaaplikasi; ?>
					</span>
					<small class="animated flipInX p-b-50">
						<?php echo	"$ceks[kecamatan] - $ceks[kota] - $ceks[web]"; ?>
					</small>

					<div class="wrap-input100 validate-input p-t-50" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Username...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="*************">
						<span class="focus-input100"></span>
					</div>



					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button name='submit' class="login100-form-btn">
								Login Masuk
							</button>
						</div>


					</div>
				</form>
				
				<footer class='main-footer ' style="padding-top: 50px;">
					<div >&copy; 
						<a href="http://candycbt.id" class="txt2 hov1">
							<b><?= APLIKASI . " " . VERSI ." ". REVISI ?></b>
						</a>
					</div>
				</footer>
			</div>

		</div>

	</div>

	<script src='../plugins/jQuery/jquery-3.2.1.min.js'></script>
	<script src='../dist/bootstrap/js/bootstrap.min.js'></script>

	<script src="../plugins/jQuery/main.js"></script>
	<?php 
	if (isset($_POST['submit'])) {


	$username = htmlspecialchars($_POST['username'], ENT_QUOTES);
	$password = htmlspecialchars($_POST['password'], ENT_QUOTES);
	$query = mysqli_query($koneksi, "SELECT * FROM pengawas WHERE username='$username'");

	$cek = mysqli_num_rows($query);
	$user = mysqli_fetch_array($query);


	if ($cek <> 0) {

		if ($user['level'] == 'admin') {
			if (!password_verify($password, $user['password'])) {
				$info = info("Password salah!", "NO");
			} else {
				
				$_SESSION['id_pengawas'] = $user['id_pengawas'];
				$_SESSION['level'] = 'admin';
				// validasi session token
				$_SESSION['token'] = $ceks['db_token'];
				$_SESSION['token1'] = $ceks['db_token1'];
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['password'] = $_POST['password'];
				$_SESSION['token_bot_telegram'] = $token_bot['botToken'];
				echo "<script>location.href = '.';</script>";
			}
		} 
		elseif ($user['level'] == 'peng') {
			if (!password_verify($password, $user['password'])) {
				$info = info("Password salah!", "NO");
			} else {
				$_SESSION['id_pengawas'] = $user['id_pengawas'];
				$_SESSION['level'] = 'peng';

				// validasi session token
				$_SESSION['token'] = $ceks['db_token'];
				$_SESSION['token1'] = $ceks['db_token1'];
				$_SESSION['token_bot_telegram'] = $token_bot['botToken'];
				echo "<script>location.href = '.';</script>";
			}
		}
		elseif ($user['level'] == 'guru') {

			if ($password == $user['password']) {
				$_SESSION['id_pengawas'] = $user['id_pengawas'];
				$_SESSION['level'] = 'guru';
				$_SESSION['jrs'] = $user['id_jrs'];
				$_SESSION['kls'] = $user['id_kls'];
				$_SESSION['jabatan'] = $user['jabatan'];
				// validasi session token
				$_SESSION['token'] = $ceks['db_token'];
				$_SESSION['token1'] = $ceks['db_token1'];
				$_SESSION['token_bot_telegram'] = $token_bot['botToken'];

				echo "<script>location.href = '.';</script>";
			} else {
				$info = info("Password salah!", "NO");
			}
		}
	} elseif ($cek == 0 or $cekguru == 0) {
		echo "<script>alert('Pengguna tidak terdaftar');</script>";
	}
}

	?>

</body>

</html>