<?php
$active_page = 'features';
$nav_class = 'scrolled scrolled-fixed';
include 'landing_header.php';
?>

  <!-- ─── PAGE HERO ─── -->
  <section class="page-hero">
    <div class="ph-container reveal">
      <span class="ph-tag">FITUR UNGGULAN</span>
      <h1>Semua Fitur Kelas & Ujian <span>Dalam Satu Platform</span></h1>
      <p class="ph-desc">Jelajahi berbagai modul interaktif, sistem manajemen nilai otomatis, dan pengawasan ujian canggih yang dirancang khusus untuk kenyamanan guru dan siswa.</p>
    </div>
  </section>

  <!-- ─── ALL-IN-ONE CLOUD SOFTWARE ─── -->
  <section class="all-in-one" id="fitur">
    <h2 class="section-title" style="text-align: center;">All-In-One <span>Cloud Software.</span></h2>
    <p class="section-desc" style="margin: 0 auto 50px; text-align: center;">KEMUDI menyatukan semua fitur pembelajaran dan manajemen ujian yang dibutuhkan oleh institusi modern.</p>

    <div class="aio-grid">
      <div class="aio-card reveal">
        <div class="aio-icon-wrap" style="background: #5B72EE; box-shadow: 0 10px 20px rgba(91,114,238,0.2);">
          <i class="fa fa-file-text-o"></i>
        </div>
        <h3 class="aio-title">Online Billing, Invoicing, & Contracts</h3>
        <p class="aio-desc">Kelola administrasi sekolah, modul berbayar, hingga kontrak siswa dengan proses digital yang terenkripsi aman.</p>
      </div>

      <div class="aio-card reveal">
        <div class="aio-icon-wrap" style="background: #00C1B4; box-shadow: 0 10px 20px rgba(0,193,180,0.2);">
          <i class="fa fa-calendar-check-o"></i>
        </div>
        <h3 class="aio-title">Easy Scheduling & Attendance Tracking</h3>
        <p class="aio-desc">Atur jadwal materi pelajaran, jadwal ujian, serta pantau kehadiran guru dan siswa secara realtime otomatis.</p>
      </div>

      <div class="aio-card reveal">
        <div class="aio-icon-wrap" style="background: #29B9E7; box-shadow: 0 10px 20px rgba(41,185,231,0.2);">
          <i class="fa fa-users"></i>
        </div>
        <h3 class="aio-title">Customer Tracking</h3>
        <p class="aio-desc">Pantau perkembangan kompetensi siswa, kirim pengumuman otomatis, dan jalin komunikasi erat dengan wali murid.</p>
      </div>
    </div>
  </section>

  <!-- ─── OUR FEATURES REDESIGN ─── -->
  <section class="our-features-section" id="fitur-detail">
    <div class="of-left reveal">
      <div class="of-visual-card">
        <div class="of-video-grid">
          <div class="of-video-item">
            <img src="image/for_instructors.png" alt="Instructor Profile" />
            <div class="of-video-label">Instructor (Guru)</div>
          </div>
          <div class="of-video-item">
            <img src="image/for_students.png" alt="Student Profile" />
            <div class="of-video-label">Siswa A</div>
          </div>
          <div class="of-video-item">
            <img src="image/hero_student.png" alt="Student Profile" style="height: 120px; object-fit: cover;" />
            <div class="of-video-label">Siswa B</div>
          </div>
          <div class="of-video-item" style="background: #252641; display:flex; align-items:center; justify-content:center; color:#fff; font-size: 11px;">
            <span>+24 Lainnya</span>
          </div>
        </div>
        <div class="of-controls">
          <button class="of-btn-present" onclick="window.location.href='#fitur';">Present</button>
          <button class="of-btn-call" onclick="window.location.href='#fitur';"><i class="fa fa-phone"></i> Hubungkan</button>
        </div>
      </div>
    </div>
    <div class="of-right reveal">
      <h2 class="section-title">A <span>user interface</span> designed for the classroom</h2>
      <ul class="of-list">
        <li class="of-list-item">
          <div class="of-list-icon"><i class="fa fa-th-large"></i></div>
          <div class="of-list-text">
            <h4>Dedicated Podium Space</h4>
            <p>Guru mendapatkan ruang utama/podium visual agar penjelasan materi dan instruksi ujian selalu terlihat jelas oleh semua siswa.</p>
          </div>
        </li>
        <li class="of-list-item">
          <div class="of-list-icon"><i class="fa fa-users"></i></div>
          <div class="of-list-text">
            <h4>Co-Host & Presenter Control</h4>
            <p>Asisten guru atau perwakilan siswa dapat dipromosikan sebagai co-host untuk membantu jalannya kelas interaktif.</p>
          </div>
        </li>
        <li class="of-list-item">
          <div class="of-list-icon"><i class="fa fa-eye"></i></div>
          <div class="of-list-text">
            <h4>Real-time Student Monitoring</h4>
            <p>Guru dapat melihat keaktifan dan progress pengerjaan tugas atau ujian siswa secara langsung di satu dashboard terintegrasi.</p>
          </div>
        </li>
      </ul>
    </div>
  </section>

  <!-- ─── CLASS MANAGEMENT ─── -->
  <section class="class-mgmt-section" id="management">
    <div class="class-mgmt-left reveal">
      <h2 class="section-title">Class Management <span>Tools for Educators</span></h2>
      <p class="section-desc">KEMUDI menyediakan kemudahan dalam mengelola data siswa, membuat rekap presensi, mempublikasikan nilai ujian, serta mengekspor data laporan ke format Excel hanya dengan satu klik.</p>
    </div>
    <div class="class-mgmt-right reveal">
      <div class="gradebook-mock">
        <div class="gb-header">
          <div class="gb-title">GradeBook</div>
          <button class="gb-btn-export" onclick="alert('📊 Mengekspor laporan buku nilai...');">Export</button>
        </div>
        <div class="gb-row header-row">
          <div></div>
          <div>Nama</div>
          <div>Progress</div>
          <div style="text-align:right">Nilai</div>
        </div>
        <div class="gb-row">
          <div><img src="image/avatar.png" class="gb-avatar" alt="Avatar" /></div>
          <div class="gb-name">Siti Rahayu</div>
          <div><div class="gb-bar-wrap"><div class="gb-bar" style="width:90%; background:#49BBBD"></div></div></div>
          <div class="gb-score" style="color:#49BBBD">90</div>
        </div>
        <div class="gb-row">
          <div><img src="image/avatar.png" class="gb-avatar" alt="Avatar" /></div>
          <div class="gb-name">Budi Santoso</div>
          <div><div class="gb-bar-wrap"><div class="gb-bar" style="width:75%; background:#F48C06"></div></div></div>
          <div class="gb-score" style="color:#F48C06">75</div>
        </div>
      </div>
    </div>
  </section>

<?php
include 'landing_footer.php';
?>
