<?php
error_reporting(0);
ini_set('display_errors', 0);
include("core/c_user.php"); 
require("config/config.function.php");
require("config/functions.crud.php");
require("config/config.candy2.php");


(isset($_SESSION['id_siswa'])) ? $id_siswa = $_SESSION['id_siswa'] : $id_siswa = 0;
if ($id_siswa == 0) {
	include "landing.php";
	exit();
}
($pg == 'testongoing') ? $sidebar = 'sidebar-collapse' : $sidebar = '';
($pg == 'testongoing') ? $disa = '' : $disa = 'offcanvas';
//agar navbar hiden saat ujian
if ($pg == 'testongoing') { $navbarhide='style="display: none;"'; }else{ $navbarhide=''; }

$siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa='$id_siswa'"));
$kelasdb = fetch($koneksi, 'kelas', array('id_kelas' => $siswa['id_kelas']));
$idkelas = $kelasdb['idkls'];

$idsesi = $siswa['sesi'];
$idpk = $siswa['idpk'];
$level = $siswa['level'];
$pk = fetch($koneksi, 'pk', array('id_pk' => $idpk));
$tglsekarang = time();
?>
<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet" />
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <title><?= $setting['aplikasi'] ?></title>
  <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
  <link rel='shortcut icon' href='<?= $homeurl ?>/dist/img/logo55.png' />
  <link rel='icon' type='image/png' href='<?= $homeurl ?>/dist/img/logo55.png' />
  <link rel='stylesheet' href='<?= $homeurl ?>/dist/bootstrap/css/bootstrap.min.css' />
  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/fontawesome/css/all.css' />
  <link rel='stylesheet' href='<?= $homeurl ?>/dist/css/AdminLTE.min.css' />
  <link rel='stylesheet' href='<?= $homeurl ?>/dist/css/skins/skin-green-light.min.css' />
  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/iCheck/square/green.css' />
  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/animate/animate.min.css'>
  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/sweetalert2/dist/sweetalert2.min.css'>
  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/slidemenu/jquery-slide-menu.css'>
  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/toastr/toastr.min.css'>
  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/radio/css/style.css'>

  <link rel='stylesheet' href='<?= $homeurl ?>/plugins/datatables/dataTables.bootstrap.css' />
  <link href="<?= $homeurl ?>/plugins/summernote/summernote-bs4.css" rel="stylesheet">
  <script src='<?= $homeurl ?>/plugins/jQuery/jquery-2.2.3.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/datatables/jquery.dataTables.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/datatables/dataTables.bootstrap.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/tinymce/tinymce.min.js'></script>
  <script src="<?= $homeurl ?>/plugins/summernote/summernote-bs4.js"></script>
  <script src='<?= $homeurl ?>/plugins/datatables/jquery.dataTables.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/datatables/dataTables.bootstrap.min.js'></script>
 

  <style type="text/css">
    .rapih{
      position: relative;
      display: inline-block;
      width: 20rem;

    }       
    .btn {
      display: inline-block;
      /*padding: 6px 12px;*/
      margin-bottom: 3px;
      font-size: 14px;
      font-weight: 400;
      line-height: 1.42857143;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      -ms-touch-action: manipulation;
      touch-action: manipulation;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      background-image: none;
      border: 1px solid transparent;
      border-radius: 15px;
    }
    .btn-app>.badge {
      position: absolute;
      top: -3px;
      right: -10px;
      font-size: 10px;
      font-weight: 400;
    }
    .btn .badge {
      
      top: -1px;
    }
    .badge {
      display: inline-block;
      min-width: 10px;
      padding: 3px 7px;
      font-size: 12px;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      background-color: #777;
      border-radius: 10px;
    }
    .soal img {
      max-width: 100%;
      height: auto;
    }

    .main-header .sidebar-baru {
      float: left;
      color: white;
      padding: 15px 15px;
      cursor: pointer;
    }

    .callout {
      border-left: 0px;
    }

    .btn {
      border-radius: 20em;
    }

    .btn.btn-flat {
      border-radius: 20em;
    }

    .skin-red-light .sidebar-menu>li:hover>a,
    .skin-red-light .sidebar-menu>li.active>a {
      color: #fff;
      background: #e111e8;
    }
    /* Note: fontSize changes are applied via JS, not CSS */

    .wrapper-page {
      margin: 7.5% auto;
      width: 360px;
    }
    .wrapper-page .form-control-feedback {
      left: 15px;
      top: 3px;
      color: rgba(76, 86, 103, 0.4);
      font-size: 20px;
    }
    .logo {
      color: #3bafda !important;
      font-size: 18px;
      font-weight: 700;
      letter-spacing: .02em;
      line-height: 70px;
    }
    .logo-lg {
      font-size: 28px !important;
    }
    .logo i {
      color: red;
    }
    .skin-green-light .sidebar-menu>li:hover>a, .skin-green-light .sidebar-menu>li.active>a{
      color: #fff;
      background:#0030a7;
      <?php 
      if($setting['jenjang'] =='SMK' ){
        echo "color: #fff;";
        //echo "background:#00a896;";
        echo"background-color: #1fc8db;background-image: linear-gradient(141deg, #9fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);color: white;opacity: 0.95;";
      }
      elseif($setting['jenjang'] =='SMP'){
        echo "color: #fff;";
        echo "background:#0030a7;";
      }
      elseif($setting['jenjang'] =='SD'){
        echo "color: #fff;";
        echo "background:#c74230;";
      }
      else{
        echo "color: #fff;";
        echo "background:#00a896;";
      }
      ?>
    }
    /*Mode Gelap*/
    .theme-switch-wrapper {
      display: flex;
      margin-top: 0;
      /*margin-left: 2em;*/
    }
    em {
      margin-top: 0.5em;
      margin-left: 1em;
      font-size: 1rem;
    }
    .theme-switch {
      display: inline-block;
      height: 34px;
      position: relative;
      width: 60px;
    }

    .theme-switch input {
      display:none;
    }

    .slider {
      background-color: #ccc;
      bottom: 0;
      cursor: pointer;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      transition: .4s;
    }

    .slider:before {
      background-color: #fff;
      bottom: 4px;
      content: "";
      height: 26px;
      left: 4px;
      position: absolute;
      transition: .4s;
      width: 26px;
    }

    input:checked + .slider {
      background-color: #66bb6a;
    }

    input:checked + .slider:before {
      transform: translateX(26px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
    .footer {
       position: fixed;
       left: 0;
       bottom: 0;
       width: 100%;
       text-align: center;
    }
    .loading {
      position: absolute;
      left: 50%;
      top: 70%;
      transform: translate(-50%,-50%);
      font: 14px arial;
      }
    </style>
    <link rel='stylesheet' href='<?= $homeurl ?>/dist/css/costum.css' />
    <link rel='stylesheet' href='<?= $homeurl ?>/dist/css/jawara-theme.css?v=<?= time() ?>' />
     <script type="text/javascript">
       $(document).ready(function(){
        $('.loader').fadeOut('slow');
      });
    </script>
</head>

<body class='hold-transition skin-green-light sidebar-mini fixed <?= $sidebar ?>' >
  <div id='pesan'></div>
  <div class='loader'>
    <div class="loading">
     <p id="pesanku" >Harap Tunggu</p>
    </div>
  </div>
  <span id='livetime'></span>
  <?php if($pg=='testongoing'){ $hilang='style="display: none;"'; $displayn=""; }else{ $hilang=''; $displayn="content-wrapper"; }  ?>
  <div class='wrapper'>
    <header class='main-header' <?= $hilang ?>>
      <?php
      $student_logo = (!empty($setting['logo']) && file_exists(__DIR__ . '/' . $setting['logo'])) 
          ? ($homeurl . '/' . $setting['logo']) 
          : ($homeurl . '/dist/img/logo55.png');
      ?>
      <a class='logo' style='background-color:#ffffff; border-bottom:1px solid #eef2f6; border-right:1px solid #eef2f6;'>
        <span class='logo-mini'>
          <img src="<?= $student_logo ?>" height="30px" style="border-radius: 6px; object-fit: contain;" alt="Logo" onerror="this.src='<?= $homeurl ?>/dist/img/logo55.png'">
        </span>
        <span class='logo-lg' style="display:flex; align-items:center; justify-content:center; gap:8px; font-weight:800; color:#0f172a; font-size:16px;">
          <img src="<?= $student_logo ?>" height="34px" style="border-radius: 8px; object-fit: contain;" alt="Logo" onerror="this.src='<?= $homeurl ?>/dist/img/logo55.png'"> 
          <span><?= !empty($setting['aplikasi']) ? $setting['aplikasi'] : 'JawaraCBT' ?></span>
        </span>
      </a>

      <nav <?= $navbarhide;?> class='navbar navbar-static-top navbarhiden' style='background:#ffffff; border-bottom:1px solid #eef2f6;' role='navigation'>
        <a href='javascript:void(0)' class='sidebar-baru' data-toggle='<?= $disa ?>' role='button' title="Toggle Menu" style="color:#475569; padding: 15px 18px; font-size:16px;">
          <i class="fa fa-bars"></i>
        </a>

        <div class='navbar-custom-menu'>
          <ul class='nav navbar-nav' style="display:flex; align-items:center; margin-right:15px; gap:8px;">
            <li class='hidden-xs'>
              <span class="navbar-badge-pill" style="margin-top:10px; display:inline-flex;">
                <i class="fa fa-school" style="color:#0284c7;"></i>
                <?= $setting['sekolah'] ?>
              </span>
            </li>
            <li class='dropdown user user-menu'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown' style="display:flex; align-items:center; gap:8px; padding: 10px 14px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:9999px; margin-top:5px;">
                <?php
                if (!empty($siswa['foto']) && file_exists("foto/fotosiswa/$siswa[foto]")) :
                  echo "<img src='$homeurl/foto/fotosiswa/$siswa[foto]' class='img-circle' alt='User' style='width:28px; height:28px; object-fit:cover;'>";
                else :
                  echo "<img src='$homeurl/dist/img/avatar_default.png' class='img-circle' alt='User' style='width:28px; height:28px; object-fit:cover;'>";
                endif;
                ?>
                <span class='hidden-xs' style="font-weight:700; color:#1e293b; font-size:13px;"><?= $siswa['nama'] ?></span>
                <i class='fa fa-chevron-down' style="font-size:10px; color:#94a3b8;"></i>
              </a>
              <ul class='dropdown-menu' style="border-radius:14px; border:1px solid #e2e8f0; box-shadow:0 10px 25px rgba(0,0,0,0.08); overflow:hidden; min-width:240px; margin-top:8px;">
                <li class='user-header' style="background:#1f4e5b; color:#ffffff; padding:20px; text-align:center;">
                  <?php
                  if (!empty($siswa['foto']) && file_exists("foto/fotosiswa/$siswa[foto]")) :
                    echo "<img src='$homeurl/foto/fotosiswa/$siswa[foto]' class='img-circle' style='width:60px; height:60px; border:2px solid #ffffff; object-fit:cover; margin:0 auto 10px;' alt='User Image'>";
                  else :
                    echo "<img src='$homeurl/dist/img/avatar_default.png' class='img-circle' style='width:60px; height:60px; border:2px solid #ffffff; object-fit:cover; margin:0 auto 10px;' alt='User Image'>";
                  endif;
                  ?>
                  <p style="margin:0; font-weight:700; font-size:15px; color:#ffffff;">
                    <?= $siswa['nama'] ?>
                    <small style="display:block; color:#99f6e4; font-size:12px; margin-top:4px;">Kelas <?= $siswa['id_kelas'] ?> &bull; <?= $siswa['idpk'] ?></small>
                  </p>
                </li>
                <li class='user-footer' style="background:#f8fafc; padding:12px 16px; display:flex; justify-content:flex-end;">
                  <a href='<?= $homeurl ?>/logout.php' class='btn btn-xs btn-danger'><i class='fa fa-sign-out'></i> Keluar</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class='main-sidebar' <?= $hilang ?>>
      <section class='sidebar'>
        <ul class='sidebar-menu tree' data-widget='tree'>
          <li class="header jawara-nav-section">GENERAL</li>
          <li class="<?= ($pg == '') ? 'active' : '' ?>">
            <a href='<?= $homeurl ?>' title="Overview">
              <i class='fa fa-home'></i>
              <span>Overview</span>
            </a>
          </li>

          <?php if($setting['izin_ujian'] == 1) : ?>
            <li class="<?= ($pg == 'ujian') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/ujian' title="Ujian Sekolah">
                <i class='fa fa-laptop'></i>
                <span>Ujian Sekolah</span>
              </a>
            </li>
            <li class="<?= ($pg == 'hasil') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/hasil' title="Hasil Ujian">
                <i class='fa fa-trophy'></i>
                <span>Hasil Ujian</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if($setting['izin_absen'] == 1) : ?>
            <li class="<?= ($pg == 'absen') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/absen/' title="Absen Sekolah">
                <i class='fa fa-calendar-check'></i>
                <span>Absen Sekolah</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if($setting['izin_absen_mapel'] == 1) : ?>
            <li class="<?= ($pg == 'absen_mapel') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/absen_mapel/' title="Absen Mapel">
                <i class='fa fa-clock'></i>
                <span>Absen Mapel</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if($setting['izin_materi'] == 1) : ?>
            <li class="<?= ($pg == 'materi') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/materi/' title="Materi Belajar">
                <i class='fa fa-book'></i>
                <span>Materi Belajar</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if($setting['izin_tugas'] == 1) : ?>
            <li class="<?= ($pg == 'tugassiswa') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/tugassiswa' title="Tugas Siswa">
                <i class='fa fa-tasks'></i>
                <span>Tugas Siswa</span>
              </a>
            </li>
          <?php endif; ?>

          <li class="header jawara-nav-section">OTHERS</li>

          <?php if($setting['izin_info'] == 1) : ?>
            <li class="<?= ($pg == 'pengumuman') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/pengumuman' title="Pengumuman">
                <i class='fa fa-bullhorn'></i>
                <span>Pengumuman</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if($setting['izin_pass'] == 1) : ?>
            <li class="<?= ($pg == 'pass') ? 'active' : '' ?>">
              <a href='<?= $homeurl ?>/pass' title="Ganti Password">
                <i class='fa fa-key'></i>
                <span>Ganti Password</span>
              </a>
            </li>
          <?php endif; ?>

          <li>
            <a href='<?= $homeurl ?>/brocandycbt.apk' title="Exambro APK">
              <i class='fa fa-mobile'></i>
              <span>Exambro APK</span>
            </a>
          </li>
        </ul>

        <!-- Student Profile Footer in Sidebar -->
        <div class="jawara-sidebar-footer">
          <?php
          if (!empty($siswa['foto']) && file_exists("foto/fotosiswa/$siswa[foto]")) :
            echo "<img src='$homeurl/foto/fotosiswa/$siswa[foto]' class='jawara-user-avatar' alt='Avatar'>";
          else :
            echo "<img src='$homeurl/dist/img/avatar_default.png' class='jawara-user-avatar' alt='Avatar'>";
          endif;
          ?>
          <div class="jawara-user-info footer-user-details">
            <div class="jawara-user-name">
              <span><?= $siswa['nama'] ?></span>
              <span class="jawara-role-pill">siswa</span>
            </div>
            <div class="jawara-user-sub">Kelas <?= $siswa['id_kelas'] ?> &bull; Sesi <?= $siswa['sesi'] ?></div>
          </div>
          <a href="<?= $homeurl ?>/logout.php" class="btn-jawara-details footer-action-btn" title="Keluar" style="padding: 6px 10px;">
            <i class="fa fa-sign-out"></i>
          </a>
        </div>
      </section>
    </aside>

    <div class='<?= $displayn ?>'>
      <section class='content-header' style="display:<?= ($pg == '') ? 'none' : 'block' ?>; padding: 20px 20px 0 20px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:15px;">
          <h1 style="font-size:22px; font-weight:800; color:#0f172a; margin:0;">
            <?= !empty($pg) ? strtoupper(str_replace('_', ' ', $pg)) : 'DASHBOARD' ?>
          </h1>
          <div style="display:flex; gap:8px; align-items:center;">
            <span class="navbar-badge-pill"><i class="fa fa-calendar"></i> <?= buat_tanggal('D, d M Y') ?></span>
            <span class="navbar-badge-pill"><i class="fa fa-clock"></i> <span id="waktu"><?= $waktu ?></span></span>
          </div>
        </div>
      </section>

      <!-- Halaman Dashboard Siswa -->
      <section class='content' style="padding: 20px;">
        <?php if ($pg == '') : ?>
          <!-- JawaraCBT Campus Hero Banner -->
          <div class="jawara-hero-wrapper">
            <div class="jawara-hero-banner">
              <img src="<?= $homeurl ?>/dist/img/campus_banner.jpg" alt="Campus">
              <div class="jawara-hero-overlay">
                <h2 class="jawara-hero-title">Selamat Datang, <?= $siswa['nama'] ?></h2>
                <div class="jawara-hero-sub">Kelas <?= $siswa['id_kelas'] ?> &bull; <?= $setting['sekolah'] ?></div>
              </div>
            </div>
            <!-- Search Bar -->
            <div class="jawara-search-wrapper">
              <i class="fa fa-search jawara-search-icon"></i>
              <input type="text" id="siswaSearch" class="jawara-search-input" placeholder="Search exams, subjects, materials, tasks, reports..." onkeyup="filterJawaraDashboard(this.value)">
            </div>
          </div>

          <!-- Main Stat Cards & Quick Actions -->
          <div class="row">
            <div class="col-lg-9 col-md-8">
              <div class="row">
                <!-- Status Siswa -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 20px;">
                  <div class="jawara-card" style="min-height: 190px;">
                    <div class="jawara-stat-top">
                      <h4 class="jawara-stat-label">Status Siswa</h4>
                      <div class="jawara-icon-badge lime">
                        <i class="fa fa-id-card"></i>
                      </div>
                    </div>
                    <div>
                      <div class="jawara-stat-value"><?= ($siswa['status_siswa'] == 1) ? 'AKTIF' : 'OFF' ?></div>
                      <div class="jawara-stat-desc">Status partisipasi ujian CBT</div>
                      <div class="jawara-stat-trend <?= ($siswa['status_siswa'] == 1) ? 'up' : 'neutral' ?>">
                        <i class="fa fa-circle"></i> <?= ($siswa['status_siswa'] == 1) ? 'Akun Terverifikasi' : 'Hubungi Admin' ?>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Ujian Hari Ini -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 20px;">
                  <div class="jawara-card" style="min-height: 190px;">
                    <div class="jawara-stat-top">
                      <h4 class="jawara-stat-label">Active Exams</h4>
                      <div class="jawara-icon-badge lime">
                        <i class="fa fa-laptop-code"></i>
                      </div>
                    </div>
                    <div>
                      <div class="jawara-stat-value">CBT Ready</div>
                      <div class="jawara-stat-desc">Sesi Ujian: <?= $siswa['sesi'] ?></div>
                      <div class="jawara-stat-trend up">
                        <i class="fa fa-calendar-check"></i> Ruang: <?= $siswa['ruang'] ?>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Kehadiran -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 20px;">
                  <div class="jawara-card" style="min-height: 190px;">
                    <div class="jawara-stat-top">
                      <h4 class="jawara-stat-label">Presensi</h4>
                      <div class="jawara-icon-badge teal">
                        <i class="fa fa-calendar-alt"></i>
                      </div>
                    </div>
                    <div>
                      <div class="jawara-stat-value">Absensi</div>
                      <div class="jawara-stat-desc">Sekolah & Mata Pelajaran</div>
                      <div class="jawara-stat-trend up">
                        <i class="fa fa-check"></i> Hadir Hari Ini
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Materi Belajar -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 20px;">
                  <div class="jawara-card" style="min-height: 190px;">
                    <div class="jawara-stat-top">
                      <h4 class="jawara-stat-label">Materi Belajar</h4>
                      <div class="jawara-icon-badge orange">
                        <i class="fa fa-book-open"></i>
                      </div>
                    </div>
                    <div>
                      <div class="jawara-stat-value">E-Learning</div>
                      <div class="jawara-stat-desc">Modul ajar dari bapak/ibu guru</div>
                      <div class="jawara-stat-trend up">
                        <i class="fa fa-cloud-download-alt"></i> Materi Tersedia
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Tugas Siswa -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 20px;">
                  <div class="jawara-card" style="min-height: 190px;">
                    <div class="jawara-stat-top">
                      <h4 class="jawara-stat-label">Tugas Terstruktur</h4>
                      <div class="jawara-icon-badge purple">
                        <i class="fa fa-tasks"></i>
                      </div>
                    </div>
                    <div>
                      <div class="jawara-stat-value">Latihan</div>
                      <div class="jawara-stat-desc">Kumpulkan tugas tepat waktu</div>
                      <div class="jawara-stat-trend neutral">
                        <i class="fa fa-pencil-alt"></i> Tugas Terstruktur
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Hasil Ujian -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 20px;">
                  <div class="jawara-card" style="min-height: 190px;">
                    <div class="jawara-stat-top">
                      <h4 class="jawara-stat-label">Hasil Ujian</h4>
                      <div class="jawara-icon-badge blue">
                        <i class="fa fa-award"></i>
                      </div>
                    </div>
                    <div>
                      <div class="jawara-stat-value">Nilai</div>
                      <div class="jawara-stat-desc">Rekapitulasi skor evaluasi</div>
                      <div class="jawara-stat-trend up">
                        <i class="fa fa-chart-line"></i> Hasil Nilai CBT
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Quick Actions for Siswa -->
            <div class="col-lg-3 col-md-4 col-sm-12" style="margin-bottom: 20px;">
              <div class="jawara-quick-actions-card" style="min-height: 410px;">
                <h4 class="jawara-quick-title">Quick Actions</h4>
                
                <?php if ($setting['izin_ujian'] == 1 && $siswa['status_siswa'] == 1) : ?>
                  <a href="<?= $homeurl ?>/ujian" class="btn-jawara-primary-action">
                    <i class="fa fa-play-circle"></i> Mulai Ujian Sekolah
                  </a>
                <?php else : ?>
                  <button disabled class="btn-jawara-primary-action" style="background:#94a3b8 !important; box-shadow:none;">
                    <i class="fa fa-lock"></i> Ujian Belum Aktif
                  </button>
                <?php endif; ?>

                <?php if ($setting['izin_absen'] == 1) : ?>
                  <a href="<?= $homeurl ?>/absen/" class="btn-jawara-secondary-action">
                    <i class="fa fa-calendar-check"></i> Absen Sekolah
                  </a>
                <?php endif; ?>

                <?php if ($setting['izin_absen_mapel'] == 1) : ?>
                  <a href="<?= $homeurl ?>/absen_mapel/" class="btn-jawara-secondary-action">
                    <i class="fa fa-clock"></i> Absen Mapel
                  </a>
                <?php endif; ?>

                <?php if ($setting['izin_materi'] == 1) : ?>
                  <a href="<?= $homeurl ?>/materi/" class="btn-jawara-secondary-action">
                    <i class="fa fa-book"></i> Materi Pelajaran
                  </a>
                <?php endif; ?>

                <?php if ($setting['izin_tugas'] == 1) : ?>
                  <a href="<?= $homeurl ?>/tugassiswa" class="btn-jawara-secondary-action">
                    <i class="fa fa-tasks"></i> Tugas Siswa
                  </a>
                <?php endif; ?>

                <?php if ($setting['izin_ujian'] == 1) : ?>
                  <a href="<?= $homeurl ?>/hasil" class="btn-jawara-secondary-action">
                    <i class="fa fa-award"></i> Hasil Ujian
                  </a>
                <?php endif; ?>

                <div style="margin-top:auto; padding-top:16px; border-top:1px solid #f1f5f9; text-align:center;">
                  <small style="color:#94a3b8; font-weight:600;">Pilih menu untuk memulai aktivitas Anda</small>
                </div>
              </div>
            </div>
          </div>

          <!-- Bottom Cards: Informasi & Profil Peserta -->
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="jawara-list-card">
                <div class="jawara-list-header">
                  <h4 class="jawara-list-title"><i class="fa fa-bullhorn" style="color:#fa4a19; margin-right:8px;"></i> Petunjuk Ujian & Pengumuman</h4>
                  <?php if ($setting['izin_info'] == 1) : ?>
                    <a href="<?= $homeurl ?>/pengumuman" class="jawara-view-all">View All</a>
                  <?php endif; ?>
                </div>
                <div class="jawara-list-body" style="padding: 10px 0;">
                  <div style="background:#f8fafc; border-radius:12px; padding:16px; border:1px solid #eef2f6; margin-bottom:12px;">
                    <div style="font-weight:700; color:#1e293b; margin-bottom:6px;"><i class="fa fa-info-circle" style="color:#0284c7;"></i> Petunjuk Pelaksanaan Ujian:</div>
                    <ul style="padding-left:18px; color:#475569; font-size:13px; margin:0; line-height:1.7;">
                      <li>Tombol ujian akan aktif saat jadwal ujian telah dimulai.</li>
                      <li>Pastikan Anda telah mengisi absen sebelum memulai ujian.</li>
                      <li>Tekan tombol F5 atau refresh browser jika ujian belum muncul saat waktu ujian sudah tiba.</li>
                      <li>Dilarang membuka tab/aplikasi lain selama ujian berlangsung.</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="jawara-list-card">
                <div class="jawara-list-header">
                  <h4 class="jawara-list-title"><i class="fa fa-id-badge" style="color:#1f4e5b; margin-right:8px;"></i> Identitas Peserta Ujian</h4>
                  <span class="label label-success">Terverifikasi</span>
                </div>
                <div class="jawara-list-body" style="padding: 10px 0;">
                  <div class="row">
                    <div class="col-xs-6" style="margin-bottom:12px;">
                      <small style="color:#94a3b8; font-weight:700; text-transform:uppercase;">Nomor Peserta / Username</small>
                      <div style="font-weight:700; color:#1e293b; font-size:14px;"><?= $siswa['username'] ?></div>
                    </div>
                    <div class="col-xs-6" style="margin-bottom:12px;">
                      <small style="color:#94a3b8; font-weight:700; text-transform:uppercase;">NISN</small>
                      <div style="font-weight:700; color:#1e293b; font-size:14px;"><?= !empty($siswa['nisn']) ? $siswa['nisn'] : '-' ?></div>
                    </div>
                    <div class="col-xs-6" style="margin-bottom:12px;">
                      <small style="color:#94a3b8; font-weight:700; text-transform:uppercase;">Kelas & Jurusan</small>
                      <div style="font-weight:700; color:#1e293b; font-size:14px;"><?= $siswa['id_kelas'] ?> &bull; <?= $siswa['idpk'] ?></div>
                    </div>
                    <div class="col-xs-6" style="margin-bottom:12px;">
                      <small style="color:#94a3b8; font-weight:700; text-transform:uppercase;">Sesi & Ruangan</small>
                      <div style="font-weight:700; color:#1e293b; font-size:14px;">Sesi <?= $siswa['sesi'] ?> &bull; Ruang <?= $siswa['ruang'] ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
  <?php elseif ($pg == 'ujian') : ?>
    <div id="boxtampil" class='col-md-12'>
      <div id='formjadwalujian' class='box box-solid'>
        <div class="row">
          <div class="col-md-4">
            <a href='<?= $homeurl ?>/logout.php' class='btn btn-sm btn-danger'><i class="fa fa-sign-out" aria-hidden="true"></i> Keluar Dari Ujian</a>
          </div>
        </div>
        <div class='box-header with-border'>
          <h3 class='box-title'><i class="fas fa-calendar-alt"></i> Jadwal Ujian Hari ini</h3>
          <div class='box-tools'>
            <button class='btn btn-flat btn-primary'><span id='waktu' style="font-family:'OCR A Extended'"><?= $waktu ?> </span></button>
          </div>
        </div><!-- /.box-header -->
        <div class='box-body'>
          <!-- mryes untuk meanmpilkan jadwal pada halaman dashbor siswa -->
          <?php
          $id_siswa = $siswa['id_siswa'];
          $agamaSiswa = $siswa['agama'];
          $idKelas = $siswa['id_kelas'];
          $paketSoalSiswa = $siswa['soalPaket'];
          $mapelQ = $dbb->JadwalUjian($idpk,$level,$idsesi,$id_siswa,$agamaSiswa,$idKelas,$paketSoalSiswa);
          //var_dump($mapelQ);
          ?>
          <span class="btn btn-primary">Paket Anda <?= $paketSoalSiswa ?></span><br><br>
          <div class="table-responsive ">
            <table class="table table-bordered">
              <thead style="background-color: #337ab7;border-color:#337ab7;color:#fff;">
                <tr>
                  <th>No</th>
                  <th>Aksi</th>
                  <th>Nama Ujian</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                </tr>
              </thead>
              <tbody>
                <style type="text/css">.btn {
                  border-radius: 5px;
                  -webkit-box-shadow: none;
                  box-shadow: none;
                  border: 1px solid transparent;
                }</style>
                <?php $no=1; foreach ($mapelQ as $dataUjian) { ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $dataUjian['tombol'];?></td>
                    <td><b><?= $dataUjian['slagNama'];?></b></td>
                    <td><label class="badge bg-blue"><?= $dataUjian['tgl_ujian'];?></label></td>
                    <td><label class="badge bg-green"><?= $dataUjian['tgl_selesai'];?></label></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script>
      //tampilkan halaman Komfirmasi Untuk Ujian
      $(document).on('click', '.btnmulaitest', function() {
        var idm = $(this).data('id');
        var ids = $(this).data('ids');
        console.log(idm + '-' + ids);

        $.ajax({
          type: 'POST',
          url: 'konfirmasi.php',
          data: 'idm=' + idm + '&ids=' + ids,
          success: function(response) {
            $('#formjadwalujian').hide();
            $('#boxtampil').html(response).slideDown();

          }
        });

      });
    </script>
  <?php elseif ($pg == 'absen') : ?>
      <?php include "absen.php" ?>
  <?php elseif ($pg == 'absen_mapel') : ?>
      <?php include "absen_mapel.php" ?>
  <?php elseif ($pg == 'materi') : ?>
      <?php include "materi.php" ?>
    <?php elseif ($pg == 'pass') : ?>
      <?php include "pass.php" ?>
    <?php elseif ($pg == 'tugassiswa') : ?>
      <?php include "tugas.php" ?>
  <?php elseif ($pg == 'lihattugas') : ?>
    <?php include "lihattugas.php" ?>
  <?php elseif ($pg == 'daftarnilaitugas') : ?>
     <?php include "daftar_nilai_tugas.php" ?>
  <?php elseif ($pg == 'pengumuman') : ?>
    <?php include "pengumuman.php" ?>       
  <?php elseif ($pg == 'lihathasil') : ?>
    <?php include "hlihathasil.php" ?>
  <?php elseif ($pg == 'hasil') : ?>
    <?php include "hhasil.php" ?>     
        <!-- masuk ke soal tampilan soal -->
        <?php elseif ($pg == 'testongoing') : ?>
          <?php
          $qcek = mysqli_query($koneksi, "select * from nilai where id_ujian='$ac' and id_siswa='$id'");
          $cek = mysqli_num_rows($qcek);
          if ($cek <> 0) :
            $query = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ujian WHERE id_ujian='$ac'"));
            $idmapel = $query['id_mapel'];
            $jenisSoal = $query['jenisSoalUjian'];
            $id_mapel = $idmapel;

            $id_siswa = $id;

            // $where = array(
            //   'id_siswa' => $id_siswa,
            //   'id_mapel' => $id_mapel
            // );
            $where22 = array(
              'id_siswa' => $id_siswa,
              'id_mapel' => $id_mapel,
              'id_ujian' => $ac
            );
            $mapel = fetch($koneksi, 'ujian', array('id_mapel' => $id_mapel, 'id_ujian' => $ac));
            //$soal = fetch($koneksi, 'soal', array('id_mapel' => $id_mapel, 'id_soal' => $pengacak[$no_soal]));

            //$jawab = fetch($koneksi, 'jawaban', array('id_siswa' => $id_siswa, 'id_mapel' => $id_mapel, 'id_soal' => $soal['id_soal'], 'id_ujian' => $ac));
 
            // update timer waktu ujian --------------
            update($koneksi, 'nilai', array('ujian_berlangsung' => $datetime), $where22);
            
            $nilai = fetch($koneksi, 'nilai', $where22);
            $habis = strtotime($nilai['ujian_berlangsung']) - strtotime($nilai['ujian_mulai']);
            $detik = ($mapel['lama_ujian'] * 60) - $habis;
            $dtk = $detik % 60;
            $mnt = floor(($detik % 3600) / 60);
            $jam = floor(($detik % 86400) / 3600);
            $ujianselesai = $nilai['ujian_selesai'];
            // update timer waktu ujian --------------

            if($nilai['selesai']==1){ //jiksa sudah selesai atau selesai paksa di lempar ke home
              jump("$homeurl"."/ujian");
            }
            else{
          ?>
<!-- bagian ujian ------------------------------------------------------------>
            <div class='row' style='margin-right:-25px;margin-left:-25px;'>
              <div class='col-md-12'>      <!--style="background-color: #0f0f17; color: #cccccc"-->
                  <div class='box box-solid' id="thema" style=" ">
                    <div class='box-header with-border'>
                      <style type="text/css">
                        .affix {
                            top:50px;
                            position: fixed;
                            width: 100%;
                          background-color:white;
                          z-index:777;
                        }
                      </style>
                      
                      <div class="row" ><!-- data-spy="affix" data-offset-top="50" -->
                        <div class="col-md-12">
                          <table class="table" >
                            <tr>
                              <td>
                                <div class="theme-switch-wrapper">
                                  <label class="theme-switch" for="checkbox">
                                    <input type="checkbox" id="checkbox" />
                                    <div class="slider round"></div>
                                  </label>
                                  <em id="modeag">Gelap / Terang</em>
                                </div>
                              </td>
                              <td>
                                <button style="margin-left: 2px;" id="fullscreen" onclick="openFullscreen();" class='btn btn-flat btn-primary'><i class="fa fa-expand "></i></button>
                              </td>
                              <td>
                                <div class='box-title pull-right'>
                                  <i class="fa fa-clock fa-lg hidden-xs "></i>
                                  <style type="text/css">
                                    .merah{
                                      color:red;
                                    }
                                  </style>
                                  <div id="waktu_ujian_user" class='btn-group'>
                                    <!-- waktu berjalan mryes -->
                                    <span style=" font-family:'OCR A Extended';font-size:35px" id='countdown'><span id='htmljam'><?= $jam ?></span>:<span id='htmlmnt'><?= $mnt ?></span>:<span id='htmldtk'><?= $dtk ?></span></span>
                                  </div>
                                  <div class='btn-group'>
                                    <!-- aksi tombol selesai ujian -->
                                      <input type='text' id="siswaid" name='siswaid' value="<?= $_SESSION['id_siswa'];?>" style="display: none;"  />
                                      <input type='text' id="ujianid" name='ujianid' value="<?= $ac;?>" style="display: none;"  />
                                      <input type='text' id="jenissoalid" name='jenissoalid' value="<?= $jenisSoal;?>" style="display: none;"  />
                                      <input type='text' id="mapelid" name='mapelid' value="<?= $idmapel;?>" style="display: none;"  />
                                      <input type='submit' name='done' style="display: none;" id='done-submit' />
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div id="laod_soal" style="color: black;">
                      
                      </div>
                      <script type="text/javascript">
                        $('#done-submit').click(function(e) {
                          e.preventDefault();
                          var siswaid = $('#siswaid').val();
                          var ujianid = $('#ujianid').val();
                          var mapelid = $('#mapelid').val();
                          var jenissoalid = $('#jenissoalid').val();
                          $.ajax({
                            type: 'POST',
                            url:'../../c_jawaban.php?jawaban=proses_nilai',
                            data: {siswaid:siswaid,ujianid:ujianid,mapelid:mapelid,jenissoalid:jenissoalid},
                            success: function(response) {
                              console.log(response);
                              if(response==1){
                                toastr.success('Ujian Berhasil Di Selesaikan');
                                setTimeout(function () {
                                  window.location.replace(window.location.href + "/ujian");
                                  
                                }, 1000);
                                localStorage.clear();
                              }
                              else if(response==0){
                                toastr.error('Gagal Update Nilai');
                              }
                              else if(response==99){
                                toastr.error('Gagal Hapus Pengacak');
                              }
                              else if(response==90){
                                toastr.error('Upsss Siswa Sudah Di Isi Nilainya');
                              }
                              
                              else{
                                toastr.error('Upsss Sistem');
                              }
                            }
                          });
                        });
                        function loadsoalpg(nosoal,jenis) {
                          $('#myModal').modal('hide');
                          let opsi = localStorage.getItem('opsi');
                          let jumlahsoal = localStorage.getItem('jumlahsoal');
                          let jumlahsoalesai = localStorage.getItem('jumlahsoalesai');
                          let idmapel = localStorage.getItem('idmapel');
                          let idsiswa = <?= $_SESSION['id_siswa']; ?>;
                          let jenissoal = localStorage.getItem('jenissoal');
                          let urutansoal = nosoal; 
                          let homeurl = '<?= $homeurl ?>';
                          let idujian = '<?= $ac;?>';
                          let modejawab = '<?= $setting['mode_jawab'];?>';

                          if(jenissoal==1){ var geturl = homeurl + '/soal.php'; }
                          else if(jenissoal==2){ var geturl = homeurl + '/soalesai.php'; }
                          else if(jenissoal==3){ var geturl = homeurl + '/soalpgesai.php'; }
                          else{ }
                            $.ajax({
                              type: 'POST',
                              url: geturl,
                              data: {
                                homeurl:homeurl,opsi:opsi,idmapel:idmapel,idsiswa:idsiswa,jumlahsoal:jumlahsoal,urutansoal:urutansoal,jenissoal:jenissoal,homeurl:homeurl,idujian:idujian,modejawab:modejawab,jumlahsoalesai:jumlahsoalesai,
                              },
                             
                              success: function(response) {
                              $('#laod_soal').html(response);
                              $('#myModal').modal('hide');
                              $(".modal-backdrop.in").hide();
                              //$('.modal-backdrop').remove();
                              document.getElementsByTagName("body")[0].style.overflowY = "auto";
                              }
                            });
                          
                        };

                        <?php /*saat di refres tampilkan soal no 1 */?>
                        $(document).ready(function(){
                          
                          let opsi = localStorage.getItem('opsi');
                          let jumlahsoal = localStorage.getItem('jumlahsoal');
                          let idmapel = localStorage.getItem('idmapel');
                          let jenissoal = localStorage.getItem('jenissoal');
                          let idsiswa = <?= $_SESSION['id_siswa']; ?>; 
                          let urutansoal = 0;

                          let homeurl = '<?= $homeurl ?>';
                          let idujian = '<?= $ac;?>';
                          let modejawab = '<?= $setting['mode_jawab'];?>';

                          if(jenissoal==1){ var geturl = homeurl + '/soal.php'; }
                          else if(jenissoal==2){ var geturl = homeurl + '/soalesai.php'; }
                          else if(jenissoal==3){ var geturl = homeurl + '/soalpgesai.php'; }
                          else{ alert("Opsss Jenis Soal Tidak di Ketahui !!! "); }
                          
                          $.ajax({
                            type: 'POST',
                            url: geturl,
                            data: {homeurl:homeurl,opsi:opsi,idmapel:idmapel,idsiswa:idsiswa,jumlahsoal:jumlahsoal,urutansoal:urutansoal,jenissoal:jenissoal,homeurl:homeurl,idujian:idujian,modejawab:modejawab,
                            },
                            success: function(response) {
                              $('#laod_soal').html(response);
                            }
                          });

                        });
                      </script>
                    </div>
                  </div>
              </div>
            </div>
<!-- end bagian ujian -------------------------------------------------------->
            <?php } ?>
          <?php else : ?>
            <?php jump($homeurl); ?>
          <?php endif; ?>
        <?php else : ?>
          <?php jump($homeurl); ?>
        <?php endif;  ?>

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    
    <footer class='main-footer hidden-xs' <?= $hilang; ?>>
      <div class='container'>
        <div class='pull-left hidden-xs'>
          <strong>
            <span id='end-sidebar'>
              &copy; 2020 <?= APLIKASI . " " . VERSI . " " . REVISI ?>
            </span>
          </strong>
        </div>
      </div>
    </footer>
   
    <footer class='footer hidden-lg' <?= $hilang; ?>>
      <style type="text/css">.btn {
        border-radius: 3px;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid transparent;
      }</style>
      <div class='pull-right hidden-lg' style="padding-right: 10px; padding-bottom: 5px;">
        <div class="text-center">
          <a href="<?= $homeurl?>" class="btn btn-success"><i class="fa fa-home"></i> MENU</a>
        </div>
      </div>
      <div class='pull-left hidden-lg' style="padding-left: 10px; padding-bottom: 5px;">
        <div class="text-center">
          <a class="btn btn-success " onclick="location.reload();"><i class="fa fa-spinner fa-spin "></i> Refres</a>
        </div>
    </footer>
    

  </div><!-- ./wrapper -->



  <script src='<?= $homeurl ?>/dist/bootstrap/js/bootstrap.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/slimScroll/jquery.slimscroll.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/iCheck/icheck.min.js'></script>
  <script src='<?= $homeurl ?>/dist/js/app.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/sweetalert2/dist/sweetalert2.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/slidemenu/jquery-slide-menu.js'></script>
  <script src='<?= $homeurl ?>/plugins/mousetrap/mousetrap.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/MathJax-2.7.3/MathJax.js?config=TeX-AMS_HTML-full'></script>
  <script src='<?= $homeurl ?>/plugins/toastr/toastr.min.js'></script>
  <script src='<?= $homeurl ?>/plugins/zoom-master/jquery.zoom.js'></script>
  
  <script>
    var url = window.location;
    $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
    }).parent().addClass('active');
    // for treeview
    $('ul.treeview-menu a').filter(function() {
      return this.href == url;
    }).closest('.treeview').addClass('active');
    <?php 
    if($setting['izin_ujian']==1){
    ?>

    <?php }else{ } ?>
  </script>
  <?php if ($pg == 'testongoing') : ?>
    <?php //disabel tombol back history ?>
    ​<script type = "text/javascript" > 
      history.pushState(null, null, location.href); 
      history.back(); 
      history.forward(); 
      window.onpopstate = function () { history.go(1); }; 
    
      var homeurl;
      homeurl = '<?= $homeurl ?>';


      /* Font Adjusments */
      let defaultFontSize = 16;
      let fontSize = 0;
      fontSize = localStorage.getItem('fontSize');
      if (!fontSize) {
        fontSize = defaultFontSize;
        localStorage.setItem('fontSize', fontSize);
      }
      soalFont(fontSize);

      function soalFont(fontSize) {
        $('div.soal > p > span').css({
          fontSize: fontSize + 'pt'
        });
        $('span.soal > p > span').css({
          fontSize: fontSize + 'pt'
        });
        $('.soal').css({
          fontSize: fontSize + 'pt'
        })
        $('.callout soal').css({
          fontSize: fontSize + 'pt'
        })
      }

/* Function to open fullscreen mode */
        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
                /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                /* IE/Edge */
                elem = window.top.document.body; //To break out of frame in IE
                elem.msRequestFullscreen();
            }
        }
        swal({
            title: 'Peraturan Ujian',
            html: 'Kerjakan soal dengan benar dan teliti<br>Dilarang Mencontek',
           
            // showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Saya Bersedia',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                openFullscreen();
            }
        })
        
        if (document.addEventListener) {
            document.addEventListener('fullscreenchange', exitHandler, false);
            document.addEventListener('mozfullscreenchange', exitHandler, false);
            document.addEventListener('MSFullscreenChange', exitHandler, false);
            document.addEventListener('webkitfullscreenchange', exitHandler, false);
        }
		
    </script>
    <?php //Bagian Js Tombol Selesai dan Timer ?>
    <script type="text/javascript">
    $(document).ready(function() {
        //cek dulu sebelum tekan tombol selesai
        //Tombol proses nilai ----
        $(document).on('click', '.done-btn', function() {
          let jenissoal = JSON.parse(localStorage.getItem("jenissoal"));
          let belum=[];let sudah=[];
          let belum1;let sudah1;
          if(jenissoal==1){
            var jawab_all2 = JSON.parse(localStorage.getItem("jwbs"));
          }
          else if(jenissoal==2){
            var jawab_all2 = JSON.parse(localStorage.getItem("jwbesai"));
          }
          else if(jenissoal==3){
            let jawab_all = JSON.parse(localStorage.getItem("jwbs"));
            let jawab_allesai = JSON.parse(localStorage.getItem("jwbesai"));
            var jawab_all2 = jawab_all.concat(jawab_allesai);
          }
          else{

          }

          jawab_all2.map(function(item,index){
            if(item.status != 1){ 
              belum ++;
            }
            else{
              sudah ++;
            }
            if(belum == ""){ belum1 = 0; }else{ belum1 = belum;  }
            if(sudah == ""){ sudah1 = 0; }else{ sudah1 = sudah;  }
          });
          swal({
            title: 'Apakah Kamu Yakin Ingin Menyelesaikan Ujian Ini ?',
            html: '<B>Pastikan Jawaban Sudah Terkirim Semua !</B><br>Jawaban Sudah Terkirim : <b style="color:blue;">'+sudah1+'</b> Soal<br>Jawaban Belum Terkirim : <b style="color:red;">'+belum1+'</b> Soal',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya'
          }).then((result) => {
            if (result.value) {
              window.onbeforeunload = null;
              let send =[];
              if(jenissoal==1){
                var jawabanall = JSON.parse(localStorage.getItem("jwbs"));
                var url_jawaban= 'kirim_jawaban';
              }
              else if(jenissoal==2){
                var jawabanall = JSON.parse(localStorage.getItem("jwbesai"));
                var url_jawaban= 'kirim_jawabanesai';
              }
              else if(jenissoal==3){
                let jawab_all = JSON.parse(localStorage.getItem("jwbs"));
                let jawab_allesai = JSON.parse(localStorage.getItem("jwbesai"));
                var jawabanall = jawab_all.concat(jawab_allesai);
                var url_jawaban= 'kirim_jawabanpgesai';
              }
              else{

              }
              
              jawabanall.map(function(item,index){
                if(item.status != 1){ 
                  send.push(item);
                }
              });
              $.ajax({
                type: 'POST',
                url:'../../c_jawaban.php?siswa='+url_jawaban,
                data: {nilai:send},
                beforeSend: function() {
                  $('#selesa_ujian').html('<i class="fa fa-spinner fa-spin "> </i>Loding');
                },
                success: function(response) {
                  $('#done-submit').click();
                }
              });
              
            }
          })
          
        });

        var jam = $('#htmljam').html();
        var menit = $('#htmlmnt').html();
        var detik = $('#htmldtk').html();

      function hitung() {
          setTimeout(hitung, 1000);
          $('#countdown').html(jam + ':' + menit + ':' + detik);
          detik--;
          if (detik < 0) {
            detik = 59;
            menit--;
            if(menit < 18){
              $("#waktu_ujian_user").addClass("merah");
            }
            if (menit < 0) {
              menit = 59;
              jam--;
              if (jam < 0) {
                jam = 0;
                menit = 0;
                detik = 0;
                waktuhabis();
              }
            }
          }
      }
      hitung();
      });
      function cekwaktu() {
        $('#divujian').load(window.location.href + ' #divujian');
        var status = $('#htmlujianselesai').html();
        if (status != '') {
          location = homeurl;
        }
      }

      function waktuhabis() {

        swal({
          title: 'Oooo Oooww!',
          text: 'Waktu Ujian Telah Habis',
          timer: 1000,
          onOpen: () => {
            swal.showLoading()
          }
        }).then((result) => {
          let send =[];
          let jenissoal = JSON.parse(localStorage.getItem("jenissoal"));
          if(jenissoal==1){
            var jawabanall = JSON.parse(localStorage.getItem("jwbs"));
            var url_jawaban= 'kirim_jawaban';
          }
          else if(jenissoal==2){
            var jawabanall = JSON.parse(localStorage.getItem("jwbesai"));
            var url_jawaban= 'kirim_jawabanesai';
          }
          else if(jenissoal==3){
            let jawab_all = JSON.parse(localStorage.getItem("jwbs"));
            let jawab_allesai = JSON.parse(localStorage.getItem("jwbesai"));
            var jawabanall = jawab_all.concat(jawab_allesai);
            var url_jawaban= 'kirim_jawabanpgesai';
          }
          else{

          }
          jawabanall.map(function(item,index){
            if(item.status != 1){ 
              send.push(item);
            }
          });
          $.ajax({
            type: 'POST',
            url:'../../c_jawaban.php?siswa='+url_jawaban,
            data: {nilai:send},
            beforeSend: function() {
              $('#finis').html('<i class="fa fa-spinner fa-spin "> </i>Loding');
            },
            success: function(response) {
              console.log(response);
              $('#done-submit').click();
            }
          });
          
        });
      }
    </script>
    <?php //----------Timer Waktu tombol selesai muncul -------- ?>
      <script type="text/javascript">
        $(document).ready(function() {
          if ("counter" in sessionStorage) {
            if (sessionStorage.getItem("counter") === null || sessionStorage.getItem("counter") === 'NaN' || localStorage.getItem("counter")=='undefined') {
              $(".done-btn").removeAttr("disabled");
              clearInterval(interval);
            }
          } 

          let counter = function(){
            let value = sessionStorage.getItem("counter");
            value2 = parseInt(value);
            if(value == 0 ){
              $(".done-btn").removeAttr("disabled");
              clearInterval(interval);
            }

            else{
              value3 = value2 - 1;
              sessionStorage.setItem("counter", value3);
              let x = value3 % 3600;
              let jam = Math.floor(value3 / 3600);
              let menit = Math.floor(x / 60);
              let detik = Math.floor(x % 60);

              $("#divCounter").html(jam+' Jam '+menit+' Menit '+detik+' Detik');
            }

          }
          var interval = setInterval(counter, 1000); 
         });
      </script>
    <?php //----------Timer Waktu tombol selesai muncul -------- ?>
    <?php //-------kirim Jawaban Otomatis ---------------- ?>
      <script type="text/javascript">
        $(document).ready(function() {
          setInterval(function(){
            let send =[];
            let jenissoal = JSON.parse(localStorage.getItem("jenissoal")); 
              if(jenissoal==1){
                var jawabanall = JSON.parse(localStorage.getItem("jwbs"));
                var url_jawaban= 'kirim_jawaban';
              }
              else if(jenissoal==2){
                var jawabanall = JSON.parse(localStorage.getItem("jwbesai"));
                var url_jawaban= 'kirim_jawabanesai';
              }
              else if(jenissoal==3){
                let jawab_all = JSON.parse(localStorage.getItem("jwbs"));
                let jawab_allesai = JSON.parse(localStorage.getItem("jwbesai"));
                var jawabanall = jawab_all.concat(jawab_allesai);
                var url_jawaban= 'kirim_jawabanpgesai';
              }
              else{ }
              if(jawabanall.length > 0){
                jawabanall.map(function(item,index){
                  if(item.status == 0){ 
                    send.push(item);
                  }
                });
                $.ajax({
                  type: 'POST',
                  url:'../../c_jawaban.php?siswa='+url_jawaban,
                  data: {nilai:send},
                  
                  success: function(response) {
                    console.log(response);
                    function get(item) {
                      return JSON.parse(localStorage.getItem(item));
                    }
                    function getPanjang(item) {
                      return JSON.parse(localStorage.getItem(item)).length;
                    }
                    if (response == 1) {
                      // tantai jawaban pg sudah di kirim ------------------- 
                      let jawab_all2 = JSON.parse(localStorage.getItem("jwbs"));
                      let jawaban_ganti = [];
                      let jawaban_ganti2 = [];
                      let gabung = [];
                      let arr= [];
                      let arr2= [];
                      let jwb = getPanjang('jwbs');
                      if(jwb > 0){ 
                        jawab_all2.map(function(item,index){
                          if(item.status != 1){ 
                            arr = {"idsoal":item.idsoal, "jawaban":item.jawaban, "status":1,"idsiswa":item.idsiswa,"idmapel":item.idmapel,"idujian":item.idujian,"jenissoal":item.jenissoal};
                            jawaban_ganti.push(arr);
                          }
                          else{
                            arr2 = item;
                            jawaban_ganti2.push(arr2);
                          }
                        });
                         gabung = jawaban_ganti.concat(jawaban_ganti2);
                         localStorage.setItem('jwbs', JSON.stringify(gabung));
                      }  

                      // tantai jawaban esai sudah di kirim  -------------------
                      let otojawabesai = JSON.parse(localStorage.getItem("jwbesai"));
                      let otojwbesai = getPanjang('jwbesai');
                      let otojawaban_ganti = [];
                      let otojawaban_ganti2 = [];
                      let otogabung = [];
                      let otoarr= [];
                      let otoarr2= [];
                      if(otojwbesai > 0){ 
                        otojawabesai.map(function(item,index){
                          if(item.status != 1){ 
                            arr = {"idsoal":item.idsoal, "jawaban":item.jawaban, "status":1,"idsiswa":item.idsiswa,"idmapel":item.idmapel,"idujian":item.idujian,"jenissoal":item.jenissoal};
                            otojawaban_ganti.push(arr);
                          }
                          else{
                            otoarr2 = item;
                            otojawaban_ganti2.push(otoarr2);
                          }
                        });
                         otogabung = otojawaban_ganti.concat(otojawaban_ganti2);
                         localStorage.setItem('jwbesai', JSON.stringify(otogabung));
                      }

                    }
                    else{

                    }
                  }
                });
              }
              else{
                console.log("kosong");
              }

            }, 300000);
            //30000 = 30 detik, 300000 = 5 menit, 3000 = 3 detik, 60000 = 1 Menit
        });
      </script>
    <?php //-------kirim Jawaban Otomatis ---------------- ?>
    <?php endif; ?>
    <script>
      function filterJawaraDashboard(query) {
        query = query.toLowerCase();
        $('.jawara-card, .btn-jawara-secondary-action').each(function() {
          var text = $(this).text().toLowerCase();
          if (text.indexOf(query) !== -1 || query === '') {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      }
    </script>
</body>

</html>