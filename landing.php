<?php
$active_page = 'home';
$nav_class = 'not-scrolled';
include 'landing_header.php';
?>

  <!-- ─── HERO ─── -->
<section class="hero" id="hero">
  <div class="hero-container">
    <div class="hero-left">
      <p class="hero-badge-subtitle" style="text-transform: uppercase; letter-spacing: 2px; font-size: 14px; font-weight: 600; opacity: 0.95; margin-bottom: 10px;">
         KEMUDI: Kelas Elektronik & Manajemen Ujian Digital Interaktif      </p>
      <h1><span class="accent-orange">Studying</span> Online is now much easier</h1>
      <p>Ujian Online Berbasis Komputer</p>
      <div class="hero-cta">
        <a href="pricing.php" class="btn-hero-join">Join for free</a>
        <a href="#fitur" class="btn-play-wrap">
          <div class="btn-play">
            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          </div>
          Watch how it works
        </a>
      </div>
    </div>
    <div class="hero-right">
      <div class="hero-image-wrap">
        <!-- Main Hero image -->
        <img src="image/hero_student.png" class="hero-main-img" alt="Student thinking" />
        
        <!-- Floating Cards -->
        <div class="floating-card fc-students">
          <div class="fc-icon">📅</div>
          <div class="fc-text">
            <b>250k</b>
            <span>Assisted Student</span>
          </div>
        </div>

        <div class="floating-card fc-congratulations">
          <div class="fc-icon">✉️</div>
          <div class="fc-text">
            <b>Congratulations</b>
            <span>Your admission completed</span>
          </div>
        </div>

        <div class="floating-card fc-class">
          <img src="image/avatar.png" class="fc-class-avatar" alt="Avatar" />
          <div class="fc-class-details">
            <div class="fc-class-title">User Experience Class</div>
            <div class="fc-class-subtitle">Today at 12.00 PM</div>
          </div>
          <button class="btn-fc-join" onclick="window.location.href='pricing.php';">Join Now</button>
        </div>

        <div class="fc-mini-chart">
          <i class="fa fa-bar-chart" aria-hidden="true" style="font-size: 18px;"></i>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Wave divider at bottom -->
  <div class="wave-divider">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
    </svg>
  </div>
</section>

<!-- ─── OUR SUCCESS ─── -->
<section class="our-success" id="success">
  <h2 class="section-title" style="text-align: center;">Our Success</h2>
  <p class="section-desc" style="text-align: center; margin: 0 auto 50px;">Platform digital terpadu untuk sekolah – mengelola kelas, materi pelajaran, dan ujian online secara komprehensif.</p>
  
  <div class="success-stats">
    <div class="stat-box">
      <div class="stat-number">15K+</div>
      <div class="stat-desc">Students</div>
    </div>
    <div class="stat-box">
      <div class="stat-number">75%</div>
      <div class="stat-desc">Total success</div>
    </div>
    <div class="stat-box">
      <div class="stat-number">35</div>
      <div class="stat-desc">Main questions</div>
    </div>
    <div class="stat-box">
      <div class="stat-number">26</div>
      <div class="stat-desc">Chief experts</div>
    </div>
    <div class="stat-box">
      <div class="stat-number">16</div>
      <div class="stat-desc">Years of experience</div>
    </div>
  </div>
</section>

<!-- ─── ALL-IN-ONE CLOUD SOFTWARE ─── -->
<section class="all-in-one" id="fitur">
  <h2 class="section-title">All-In-One <span>Cloud Software.</span></h2>
  <p class="section-desc" style="margin: 0 auto 50px;">KEMUDI menyatukan semua fitur pembelajaran dan manajemen ujian yang dibutuhkan oleh institusi modern.</p>

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

<!-- ─── WHAT IS KEMUDI ─── -->
<section class="what-is" id="what-is">
  <h2 class="section-title" style="text-align: center;">What is <span>KEMUDI?</span></h2>
  <p class="section-desc" style="text-align: center; margin: 0 auto 50px;">KEMUDI adalah platform canggih yang memungkinkan institusi pendidikan membuat kelas virtual, mendistribusikan materi, dan menyelenggarakan ujian digital dengan mudah.</p>

  <div class="wi-grid">
    <div class="wi-card reveal">
      <img src="image/for_instructors.png" alt="Instructors" />
      <h3 class="wi-title">FOR INSTRUCTORS</h3>
      <a href="pricing.php" class="wi-btn">Start a class today</a>
    </div>

    <div class="wi-card reveal">
      <img src="image/for_students.png" alt="Students" />
      <h3 class="wi-title">FOR STUDENTS</h3>
      <a href="features.php" class="wi-btn filled">Enter access code</a>
    </div>
  </div>
</section>

<!-- ─── PHYSICAL CLASSROOM COMPARISON ─── -->
<section class="classroom-section" id="cara-kerja">
  <div class="cr-left reveal">
    <h2 class="section-title">Everything you can do in a physical classroom, <span>you can do with KEMUDI</span></h2>
    <p class="section-desc">KEMUDI menghadirkan kolaborasi pembelajaran tatap muka ke dalam dunia digital. Guru dapat mempresentasikan slide, membagikan modul, berinteraksi langsung, dan mengawasi ujian secara komprehensif dari mana saja.</p>
    <a href="features.php" class="cr-learn-more">Learn more</a>
  </div>
  <div class="cr-right reveal">
    <div class="cr-decor-1"></div>
    <div class="cr-decor-2"></div>
    <div class="cr-image-frame">
      <img src="image/classroom_activities.png" alt="Classroom Presentation" />
      <div class="cr-play-btn" onclick="window.location.href='features.php';"></div>
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
        <button class="of-btn-present" onclick="window.location.href='features.php';">Present</button>
        <button class="of-btn-call" onclick="window.location.href='about.php';"><i class="fa fa-phone"></i> Hubungkan</button>
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

<!-- ─── TOOLS FOR TEACHERS AND LEARNERS ─── -->
<section class="tools-section" id="tools">
  <div class="tools-left reveal">
    <h2 class="section-title">Tools For Teachers <span>And Learners</span></h2>
    <p class="section-desc">KEMUDI dilengkapi dengan kumpulan tool interaktif yang dirancang khusus untuk mempermudah instruktur dalam menyampaikan pelajaran dan membantu murid menyerap materi secara optimal.</p>
    <ul class="of-list">
      <li class="of-list-item" style="margin-bottom:15px;">
        <div class="of-list-icon" style="width:36px; height:36px; font-size: 14px;"><i class="fa fa-check"></i></div>
        <div class="of-list-text">
          <p style="font-size:15px; color: var(--text-dark); font-weight:500;">Papan Tulis Digital (Whiteboard) Interaktif</p>
        </div>
      </li>
      <li class="of-list-item" style="margin-bottom:15px;">
        <div class="of-list-icon" style="width:36px; height:36px; font-size: 14px;"><i class="fa fa-check"></i></div>
        <div class="of-list-text">
          <p style="font-size:15px; color: var(--text-dark); font-weight:500;">Sistem Pembagian Kelompok (Breakout Rooms)</p>
        </div>
      </li>
      <li class="of-list-item" style="margin-bottom:15px;">
        <div class="of-list-icon" style="width:36px; height:36px; font-size: 14px;"><i class="fa fa-check"></i></div>
        <div class="of-list-text">
          <p style="font-size:15px; color: var(--text-dark); font-weight:500;">Chat Kelas & Fitur Berbagi File Seketika</p>
        </div>
      </li>
    </ul>
  </div>
  <div class="tools-right reveal">
    <div class="tools-image-wrap">
      <img src="image/hero_student.png" alt="Student Girl" />
    </div>
  </div>
</section>

<!-- ─── ASSESSMENTS, QUIZZES, TESTS ─── -->
<section class="assessments-section" id="assessments">
  <div class="assessments-left reveal">
    <div class="quiz-mock-card">
      <div class="quiz-badge">Question 1</div>
      <div class="quiz-question">True or false? This play takes place in Italy.</div>
      <div class="quiz-img-container">
        <!-- Render a nice default classroom activities image for the quiz mock -->
        <img src="image/classroom_activities.png" alt="Italy Quiz Image" />
      </div>
      <div class="quiz-success-alert">
        <div class="quiz-success-icon"><i class="fa fa-paper-plane"></i></div>
        <div class="quiz-success-text">
          <b>Your answer was sent</b>
          <span>successfully</span>
        </div>
      </div>
    </div>
  </div>
  <div class="assessments-right reveal">
    <h2 class="section-title">Assessments, <span>Quizzes,</span> Tests</h2>
    <p class="section-desc">Buat dan luncurkan kuis, tugas, serta ujian utama secara langsung. KEMUDI mendukung acak soal, batas waktu, pengawasan ketat, dan hasil ujian langsung masuk ke buku nilai digital secara otomatis.</p>
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
        <button class="gb-btn-export" onclick="showToast('📊 Mengekspor laporan buku nilai...', 'info');">Export</button>
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
      <div class="gb-row">
        <div><img src="image/avatar.png" class="gb-avatar" alt="Avatar" /></div>
        <div class="gb-name">Anita Wijaya</div>
        <div><div class="gb-bar-wrap"><div class="gb-bar" style="width:85%; background:#38BDF8"></div></div></div>
        <div class="gb-score" style="color:#38BDF8">85</div>
      </div>
    </div>
  </div>
</section>

<!-- ─── ONE-ON-ONE DISCUSSIONS ─── -->
<section class="one-on-one-section" id="discussion">
  <div class="one-on-one-left reveal">
    <div class="discussion-mock-card">
      <div class="disc-grid">
        <div class="disc-video">
          <img src="image/for_instructors.png" alt="Instructor Discussion" />
          <div class="disc-label">Guru (Utama)</div>
        </div>
        <div class="disc-video">
          <img src="image/hero_student.png" alt="Student Discussion" style="height: 120px; object-fit: cover;" />
          <div class="disc-avatar-overlay">
            <img src="image/avatar.png" alt="Avatar" />
          </div>
          <div class="disc-label">Siswa A</div>
        </div>
      </div>
    </div>
  </div>
  <div class="one-on-one-right reveal">
    <h2 class="section-title">One-on-One <span>Discussions</span></h2>
    <p class="section-desc">Guru dan asisten pengajar dapat melakukan diskusi private (One-on-One) dengan murid secara langsung di luar kelas utama untuk memberikan bimbingan khusus atau membahas hasil belajar.</p>
  </div>
</section>

<!-- ─── ABOUT US ─── -->
<section class="about-us" id="about-us">
  <div class="about-container">
    <div class="about-left reveal">
      <div class="about-img-wrap">
        <img src="image/classroom_activities.png" alt="KEMUDI Team & Classroom Activities" class="about-main-img" />
        <div class="about-badge-floating">
          <span class="ab-num">10+</span>
          <span class="ab-txt">Tahun Inovasi Pendidikan</span>
        </div>
      </div>
    </div>
    <div class="about-right reveal">
      <p class="about-tag">TENTANG KEMUDI</p>
      <h2 class="section-title">Mentransformasi Pendidikan melalui <span>Teknologi Digital</span></h2>
      <p class="section-desc">KEMUDI (Kelas Elektronik & Manajemen Ujian Digital Interaktif) hadir sebagai solusi komprehensif bagi institusi pendidikan modern. Kami berkomitmen untuk menyederhanakan manajemen kelas, distribusi materi, serta pelaksanaan ujian daring yang aman dan terpercaya.</p>
      
      <div class="about-values">
        <div class="value-item">
          <div class="value-icon" style="background: rgba(73, 187, 189, 0.1); color: var(--primary);">
            <i class="fa fa-lightbulb-o"></i>
          </div>
          <div class="value-text">
            <h4>Inovasi Berkelanjutan</h4>
            <p>Terus memperbarui fitur pembelajaran interaktif mengikuti standar kurikulum global.</p>
          </div>
        </div>
        <div class="value-item">
          <div class="value-icon" style="background: rgba(244, 140, 6, 0.1); color: var(--secondary);">
            <i class="fa fa-shield"></i>
          </div>
          <div class="value-text">
            <h4>Keamanan & Integritas</h4>
            <p>Menjamin kerahasiaan data serta integritas hasil ujian dengan sistem pengawasan CBT terenkripsi.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── PRICING ─── -->
<section class="pricing" id="pricing">
  <div class="pricing-header reveal" style="text-align: center; margin-bottom: 50px;">
    <p class="pricing-tag" style="text-transform: uppercase; letter-spacing: 2px; font-size: 14px; font-weight: 600; color: var(--primary); margin-bottom: 10px;">PAKET BERLANGGANAN</p>
    <h2 class="section-title">Pilih Paket yang Sesuai untuk <span>Sekolah & Lembaga Anda</span></h2>
    <p class="section-desc" style="margin: 0 auto;">Dapatkan akses penuh ke platform KEMUDI dengan opsi yang disesuaikan untuk bimbingan belajar, sekolah formal, maupun kustomisasi khusus.</p>
  </div>
  
  <div class="pricing-grid">
    <!-- Katalog 1: Bimbel -->
    <div class="pricing-card reveal">
      <div class="pc-header">
        <h3>KEMUDI LMS For Bimbel</h3>
        <p class="pc-desc">Solusi cerdas untuk lembaga bimbingan belajar dan kursus. Dirancang khusus untuk evaluasi cepat, latihan soal interaktif, dan pemantauan progres.</p>
        <div class="pc-price" style="display: flex; align-items: center; justify-content: center; gap: 10px; flex-wrap: wrap;">
          <span style="font-size: 16px; text-decoration: line-through; color: var(--text-muted); font-weight: 500;">Rp 149.000</span>
          <span>Rp 99.000<span style="font-size: 14px; font-weight: 500; color: var(--text-muted);">/ bulan</span></span>
        </div>
        <span class="pc-discount" style="display:inline-block; font-size:11px; color:var(--secondary); font-weight:700; background:var(--secondary-light); padding:2px 8px; border-radius:4px; margin-top:5px;">Promo Diskon | Max 50 Siswa</span>
      </div>
      <p style="font-size:12px; color:var(--text-dark); font-weight:600; background:rgba(73,187,189,0.08); padding:10px; border-radius:8px; margin-bottom:20px; border-left:3px solid var(--primary);"><i class="fa fa-rocket"></i> Lebih interaktif, mendongkrak nilai tryout, dan tanpa beban koreksi manual.</p>
      <ul class="pc-features">
        <li><i class="fa fa-check"></i> Hingga 50 Siswa Aktif</li>
        <li><i class="fa fa-check"></i> Modul Tryout Intensif (UTBK/SNBT)</li>
        <li><i class="fa fa-check"></i> Bank Soal & Kuis Cepat</li>
        <li><i class="fa fa-check"></i> Analitik Progres Siswa (Grafik)</li>
        <li><i class="fa fa-check"></i> Akses Ringan dari Smartphone</li>
      </ul>
      <a href="mailto:sales@kemudilms.my.id?subject=Pemesanan%20KEMUDI%20LMS%20For%20Bimbel" class="btn-pricing">Pesan Sekarang</a>
    </div>

    <!-- Katalog 2: School (Featured) -->
    <div class="pricing-card featured reveal">
      <div class="pc-badge">POPULER</div>
      <div class="pc-header">
        <h3>KEMUDI LMS For School</h3>
        <p class="pc-desc">Platform resmi dan terstruktur untuk memenuhi standar administrasi sekolah formal (SMP/SMA/SMK). Tangguh untuk ujian massal.</p>
        <div class="pc-price">Rp 5.000<span>/ siswa / semester</span></div>
      </div>
      <p style="font-size:12px; color:var(--text-dark); font-weight:600; background:rgba(244,140,6,0.08); padding:10px; border-radius:8px; margin-bottom:20px; border-left:3px solid var(--secondary);"><i class="fa fa-rocket"></i> Meringankan 80% beban administrasi guru, hemat cetak kertas, & sangat stabil.</p>
      <ul class="pc-features">
        <li><i class="fa fa-check"></i> Siswa Terdaftar Sekolah</li>
        <li><i class="fa fa-check"></i> CBT Terpusat (Anti-Curang & Acak Soal)</li>
        <li><i class="fa fa-check"></i> Manajemen Kelas & Guru Terstruktur</li>
        <li><i class="fa fa-check"></i> Rekap Presensi Digital Realtime</li>
        <li><i class="fa fa-check"></i> Ekspor Rapor 1-Klik ke Excel</li>
      </ul>
      <a href="mailto:sales@kemudilms.my.id?subject=Pemesanan%20KEMUDI%20LMS%20For%20School" class="btn-pricing">Hubungi Sales</a>
    </div>

    <!-- Katalog 3: Custom/Enterprise -->
    <div class="pricing-card reveal">
      <div class="pc-header">
        <h3>KEMUDI LMS Custom</h3>
        <p class="pc-desc">Kustomisasi tanpa batas untuk institusi yang menginginkan eksklusivitas. Bangun identitas digital sendiri sesuai SOP Anda.</p>
        <div class="pc-price">Hubungi Kami</div>
        <span class="pc-discount" style="display:inline-block; font-size:11px; color:#5B72EE; font-weight:700; background:rgba(91,114,238,0.1); padding:2px 8px; border-radius:4px; margin-top:5px;">Min. langganan 3 bulan</span>
      </div>
      <p style="font-size:12px; color:var(--text-dark); font-weight:600; background:rgba(91,114,238,0.08); padding:10px; border-radius:8px; margin-bottom:20px; border-left:3px solid #5B72EE;"><i class="fa fa-rocket"></i> Sistem 100% mengikuti aturan Anda. Tampil lebih profesional dan prestisius.</p>
      <ul class="pc-features">
        <li><i class="fa fa-check"></i> Custom Domain & White-label (Logo Sendiri)</li>
        <li><i class="fa fa-check"></i> Bebas Request Tambahan Fitur Spesifik</li>
        <li><i class="fa fa-check"></i> Dedicated Server (Performa Maksimal)</li>
        <li><i class="fa fa-check"></i> Desain UI/UX Khusus Sesuai Branding</li>
        <li><i class="fa fa-check"></i> Setup Awal Cepat</li>
      </ul>
      <a href="mailto:sales@kemudilms.my.id?subject=Konsultasi%20KEMUDI%20LMS%20Custom" class="btn-pricing">Konsultasi Sekarang</a>
    </div>
  </div>
</section>

<!-- ─── CAREERS ─── -->
<section class="careers" id="careers">
  <div class="careers-header reveal" style="text-align: center; margin-bottom: 50px;">
    <p class="careers-tag" style="text-transform: uppercase; letter-spacing: 2px; font-size: 14px; font-weight: 600; color: var(--primary); margin-bottom: 10px;">BERKEMBANG BERSAMA KAMI</p>
    <h2 class="section-title">Karir di <span>KEMUDI</span></h2>
    <p class="section-desc" style="margin: 0 auto;">Kami mencari talenta berbakat yang antusias untuk merevolusi masa depan teknologi pendidikan di Indonesia.</p>
  </div>
  
  <div class="careers-grid">
    <div class="career-card reveal">
      <div class="cc-header">
        <span class="cc-tag">Engineering</span>
        <h4>Frontend Web Developer (Vue/React)</h4>
      </div>
      <p class="cc-desc">Membangun antarmuka kelas virtual yang responsif, interaktif, dan mudah digunakan bagi siswa dan guru.</p>
      <div class="cc-footer">
        <span class="cc-loc"><i class="fa fa-map-marker"></i> Jakarta / Remote</span>
        <a href="mailto:support@kemudilms.my.id?subject=Lamaran%20Frontend%20Developer" class="btn-career-apply">Lamar Posisi</a>
      </div>
    </div>

    <div class="career-card reveal">
      <div class="cc-header">
        <span class="cc-tag">Product</span>
        <h4>UI/UX Designer</h4>
      </div>
      <p class="cc-desc">Merancang pengalaman pengguna (UX) dan visual antarmuka (UI) untuk aplikasi ujian digital (CBT) yang bebas stres.</p>
      <div class="cc-footer">
        <span class="cc-loc"><i class="fa fa-map-marker"></i> Remote (WFA)</span>
        <a href="mailto:support@kemudilms.my.id?subject=Lamaran%20UI/UX%20Designer" class="btn-career-apply">Lamar Posisi</a>
      </div>
    </div>

    <div class="career-card reveal">
      <div class="cc-header">
        <span class="cc-tag">Education</span>
        <h4>Education Consultant</h4>
      </div>
      <p class="cc-desc">Menjalin hubungan baik dengan sekolah-sekolah di Indonesia dan membantu proses implementasi sistem KEMUDI.</p>
      <div class="cc-footer">
        <span class="cc-loc"><i class="fa fa-map-marker"></i> Bandung / On-site</span>
        <a href="mailto:support@kemudilms.my.id?subject=Lamaran%20Education%20Consultant" class="btn-career-apply">Lamar Posisi</a>
      </div>
    </div>
  </div>
</section>

<!-- ─── CONTACT SECTION ─── -->
<section class="contact-section-brief" id="contact">
  <div class="contact-brief-container">
    <div class="contact-brief-left reveal">
      <p class="contact-tag" style="text-transform: uppercase; letter-spacing: 2px; font-size: 14px; font-weight: 600; color: var(--primary); margin-bottom: 10px;">HUBUNGI KAMI</p>
      <h2 class="section-title">Ada Pertanyaan? <span>Diskusikan dengan Tim Kami</span></h2>
      <p class="section-desc">Punya pertanyaan mengenai implementasi KEMUDI LMS di sekolah atau bimbingan belajar Anda? Kirim pesan singkat atau kunjungi halaman kontak detail kami untuk informasi lengkap.</p>
      <div class="contact-brief-info" style="display:flex; flex-direction:column; gap:12px; margin-top:15px; font-weight:500;">
        <p><i class="fa fa-envelope" style="color:var(--primary); margin-right:10px; font-size:16px;"></i> sales@kemudilms.my.id</p>
        <p><i class="fa fa-whatsapp" style="color:var(--secondary); margin-right:10px; font-size:18px;"></i> +62 878-9760-0086</p>
      </div>
      <a href="contact.php" class="btn-pricing" style="display:inline-block; margin-top:20px; border-color:var(--primary); background:var(--primary); color:var(--white); text-decoration:none;">Buka Halaman Kontak Detail</a>
    </div>
    
    <div class="contact-brief-right reveal">
      <div class="contact-brief-methods" style="display:flex; flex-direction:column; gap:20px; width:100%;">
        <!-- WhatsApp Method -->
        <a href="https://wa.me/6287897600086" target="_blank" class="contact-method-card">
          <div class="contact-method-icon" style="background:rgba(73, 187, 189, 0.1); color:var(--primary);">
            <i class="fa fa-whatsapp"></i>
          </div>
          <div class="contact-method-text">
            <h4>Hubungi via WhatsApp</h4>
            <p>Chat langsung untuk respon instan & cepat.</p>
          </div>
        </a>

        <!-- Email Method -->
        <a href="mailto:sales@kemudilms.my.id?subject=Tanya%20KEMUDI%20LMS" class="contact-method-card">
          <div class="contact-method-icon" style="background:rgba(244, 140, 6, 0.1); color:var(--secondary);">
            <i class="fa fa-envelope-o"></i>
          </div>
          <div class="contact-method-text">
            <h4>Hubungi via Email</h4>
            <p>Kirim surat elektronik untuk kemitraan formal.</p>
          </div>
        </a>

        <!-- Instagram Method -->
        <a href="https://instagram.com/kemudilms" target="_blank" class="contact-method-card">
          <div class="contact-method-icon" style="background:rgba(91, 114, 238, 0.1); color:#5B72EE;">
            <i class="fa fa-instagram"></i>
          </div>
          <div class="contact-method-text">
            <h4>Direct Message Instagram</h4>
            <p>Pantau berita & DM kami di @kemudilms.</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<?php
include 'landing_footer.php';
?>
