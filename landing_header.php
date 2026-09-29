<?php
error_reporting(0);
ini_set('display_errors', 0);
// Ensure session and config are loaded if not already included
if (!class_exists('Login')) {
    require("config/config.login_siswa.php");
}
if (!isset($koneksi)) {
    require("config/config.function.php");
    require("config/functions.crud.php");
    require("config/config.candy2.php");
}
$dbb = new Login(); 
$daa1 = $dbb->CacheSetting();
foreach ($daa1 as $value) {
    $setting = $value;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $setting['aplikasi'] ?>: Kelas Elektronik & Manajemen Ujian Digital Interaktif</title>
  <meta name="description" content="<?= $setting['aplikasi'] ?> — Kelas Elektronik & Manajemen Ujian Digital Interaktif">
  <link rel="icon" type="image/png" href="<?= $homeurl ?>/dist/img/logo55.png" />
  <link rel="shortcut icon" href="<?= $homeurl ?>/dist/img/logo55.png" />
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet" />
  <!-- Stylesheets -->
  <link href="<?= $homeurl ?>/style.css" rel="stylesheet" type="text/css" />
  <link href="<?= $homeurl ?>/plugins/fontawesome/css/all.css" rel="stylesheet" type="text/css" />
  <link href="<?= $homeurl ?>/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <!-- jQuery 2.2.3 -->
  <script src="<?= $homeurl ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
</head>
<body>
  <!-- ─── NAVBAR ─── -->
  <nav class="<?= isset($nav_class) ? $nav_class : 'not-scrolled' ?>" id="landing-navbar">
    <a href="<?= $homeurl ?>" class="nav-logo">
      <div class="nav-logo-icon">K</div>
      <span class="nav-logo-text">KE<span>MUDI</span></span>
    </a>
    <ul class="nav-links">
      <li><a href="<?= $homeurl ?>" class="<?= ($active_page == 'home') ? 'active-nav' : '' ?>">Home</a></li>
      <li><a href="<?= $homeurl ?>/about.php" class="<?= ($active_page == 'about') ? 'active-nav' : '' ?>">About Us</a></li>
      <li><a href="<?= $homeurl ?>/features.php" class="<?= ($active_page == 'features') ? 'active-nav' : '' ?>">Features</a></li>
      <li><a href="<?= $homeurl ?>/pricing.php" class="<?= ($active_page == 'pricing') ? 'active-nav' : '' ?>">Pricing</a></li>
      <li><a href="<?= $homeurl ?>/careers.php" class="<?= ($active_page == 'careers') ? 'active-nav' : '' ?>">Careers</a></li>
      <li><a href="<?= $homeurl ?>/contact.php" class="<?= ($active_page == 'contact') ? 'active-nav' : '' ?>">Contact</a></li>
    </ul>
    <div class="nav-actions">
      <button class="btn-nav-login" id="open-login-btn">Login</button>
    </div>
  </nav>
