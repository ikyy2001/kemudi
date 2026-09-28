<?php
$active_page = 'about';
$nav_class = 'scrolled scrolled-fixed';
include 'landing_header.php';
?>

  <!-- ─── PAGE HERO ─── -->
  <section class="page-hero">
    <div class="ph-container reveal">
      <span class="ph-tag">TENTANG KAMI</span>
      <h1>Mengubah Masa Depan <span>Pendidikan Indonesia</span></h1>
      <p class="ph-desc">KEMUDI berdedikasi untuk menciptakan ekosistem pembelajaran digital yang inklusif, aman, dan mempermudah kolaborasi antara pendidik, siswa, serta lembaga sekolah.</p>
    </div>
  </section>

  <!-- ─── VISION & MISSION ─── -->
  <section class="vision-mission">
    <div class="vm-grid">
      <div class="vm-card reveal">
        <div class="vm-icon"><i class="fa fa-eye"></i></div>
        <h3>Visi Kami</h3>
        <p>Menjadi platform manajemen sekolah & ujian berbasis cloud nomor satu di Indonesia yang menjembatani kesenjangan digital dan mewujudkan sistem pendidikan yang transparan serta efisien.</p>
      </div>
      <div class="vm-card reveal">
        <div class="vm-icon"><i class="fa fa-bullseye"></i></div>
        <h3>Misi Kami</h3>
        <p>Menyediakan perkakas kelas virtual berkinerja tinggi, sistem pengawasan ujian (CBT) yang anti-curang, serta visualisasi data perkembangan siswa secara real-time demi mempermudah tugas guru.</p>
      </div>
    </div>
  </section>

  <!-- ─── DETAILED ABOUT US ─── -->
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
        <p class="about-tag">NILAI UTAMA KAMI</p>
        <h2 class="section-title">Nilai-Nilai yang <span>Mendorong Kami</span></h2>
        <p class="section-desc">Dalam melayani ribuan sekolah dan universitas di Indonesia, tim KEMUDI selalu dipandu oleh prinsip kerja yang kuat untuk memberikan pengalaman pengguna yang terbaik.</p>
        
        <div class="about-values">
          <div class="value-item">
            <div class="value-icon" style="background: rgba(73, 187, 189, 0.1); color: var(--primary);">
              <i class="fa fa-heart"></i>
            </div>
            <div class="value-text">
              <h4>Fokus pada Guru & Siswa</h4>
              <p>Setiap fitur didesain berdasarkan masukan dari pendidik aktif di lapangan agar benar-benar menyelesaikan tantangan mengajar sehari-hari.</p>
            </div>
          </div>
          <div class="value-item">
            <div class="value-icon" style="background: rgba(244, 140, 6, 0.1); color: var(--secondary);">
              <i class="fa fa-shield"></i>
            </div>
            <div class="value-text">
              <h4>Integritas & Kejujuran akademik</h4>
              <p>Membantu menegakkan keadilan selama evaluasi belajar melalui algoritma acak soal dan lock-browser yang kuat.</p>
            </div>
          </div>
          <div class="value-item">
            <div class="value-icon" style="background: rgba(91, 114, 238, 0.1); color: #5B72EE;">
              <i class="fa fa-globe"></i>
            </div>
            <div class="value-text">
              <h4>Aksesibilitas Luas</h4>
              <p>Dioptimalkan untuk jaringan internet minim di daerah pelosok sehingga tetap dapat digunakan dengan lancar di perangkat seluler.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── LEADERSHIP TEAM ─── -->
  <section class="team-section">
    <div class="section-header reveal" style="text-align: center; margin-bottom: 50px;">
      <p class="section-tag" style="text-transform: uppercase; letter-spacing: 2px; font-size: 14px; font-weight: 600; color: var(--primary); margin-bottom: 10px;">TIM KEMUDI</p>
      <h2 class="section-title">Bertemu dengan <span>Para Inovator</span></h2>
      <p class="section-desc" style="margin: 0 auto;">Orang-orang hebat di balik pengembangan sistem pembelajaran digital interaktif KEMUDI.</p>
    </div>
    
    <div class="team-grid">
      <div class="team-card reveal">
        <div class="team-avatar-wrap">
          <img src="image/avatar.png" alt="Sashi Kirana" />
        </div>
        <h4>Sashi Kirana Salsabila</h4>
        <span class="team-role">Educational Advisor</span>
        <p class="team-bio">Menjembatani inovasi teknologi dengan metode belajar yang efektif. Memastikan setiap fitur interaktif yang dikembangkan di KEMUDI tidak hanya canggih secara teknis, tetapi juga tepat sasaran dan selaras dengan nilai pendidikan di sekolah agar pengalaman belajar jadi lebih bermakna.</p>
      </div>

      <div class="team-card reveal">
        <div class="team-avatar-wrap">
          <img src="image/avatar.png" alt="Muhammad Rizki" />
        </div>
        <h4>Muhammad Rizki Pratama</h4>
        <span class="team-role">Head of UX Design</span>
        <p class="team-bio">Arsitek di balik kenyamanan interaksi di dalam KEMUDI. Menyelaraskan tampilan visual dengan kemudahan navigasi, sehingga setiap tombol yang ditekan dan halaman yang dibuka memberikan pengalaman belajar yang mulus, logis, dan anti-ribet.</p>
      </div>
    </div>

    <div class="team-card reveal">
        <div class="team-avatar-wrap">
          <img src="image/avatar.png" alt="Muhammad Rizki" />
        </div>
        <h4>Joseph</h4>
        <span class="team-role">Head of UX Design</span>
        <p class="team-bio">Arsitek di balik kenyamanan interaksi di dalam KEMUDI. Menyelaraskan tampilan visual dengan kemudahan navigasi, sehingga setiap tombol yang ditekan dan halaman yang dibuka memberikan pengalaman belajar yang mulus, logis, dan anti-ribet.</p>
      </div>
    </div>
  </section>

<?php
include 'landing_footer.php';
?>
