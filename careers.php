<?php
$active_page = 'careers';
$nav_class = 'scrolled scrolled-fixed';
include 'landing_header.php';
?>

  <!-- ─── PAGE HERO ─── -->
  <section class="page-hero">
    <div class="ph-container reveal">
      <span class="ph-tag">TUMBUH BERSAMA KAMI</span>
      <h1>Bangun Masa Depan <span>EdTech Indonesia</span></h1>
      <p class="ph-desc">KEMUDI mencari individu kreatif dan berdedikasi tinggi yang ingin ikut berperan nyata dalam mendemokrasikan kualitas pendidikan digital.</p>
    </div>
  </section>

  <!-- ─── WHY JOIN US ─── -->
  <section class="why-join" style="padding-bottom: 50px;">
    <h2 class="section-title" style="text-align: center;">Mengapa Bergabung dengan <span>KEMUDI?</span></h2>
    <p class="section-desc" style="margin: 0 auto 50px; text-align: center;">Kesejahteraan dan perkembangan karir tim kami adalah prioritas utama.</p>
    
    <div class="aio-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
      <div class="aio-card reveal" style="padding: 30px;">
        <div class="aio-icon-wrap" style="background: #F48C06; box-shadow: 0 10px 20px rgba(244,140,6,0.2); width:50px; height:50px; font-size:18px;">
          <i class="fa fa-home"></i>
        </div>
        <h3 class="aio-title" style="font-size: 16px;">Kerja Fleksibel (WFA)</h3>
        <p class="aio-desc">Kami percaya produktivitas tidak dibatasi oleh sekat kantor. Nikmati kebebasan bekerja dari mana saja sesuai ritme hidup Anda.</p>
      </div>

      <div class="aio-card reveal" style="padding: 30px;">
        <div class="aio-icon-wrap" style="background: #49BBBD; box-shadow: 0 10px 20px rgba(73,187,189,0.2); width:50px; height:50px; font-size:18px;">
          <i class="fa fa-shield"></i>
        </div>
        <h3 class="aio-title" style="font-size: 16px;">Asuransi & Benefit Kesehatan</h3>
        <p class="aio-desc">Perlindungan kesehatan penuh bagi Anda dan keluarga terdekat untuk menjamin rasa aman selama berkarir.</p>
      </div>

      <div class="aio-card reveal" style="padding: 30px;">
        <div class="aio-icon-wrap" style="background: #5B72EE; box-shadow: 0 10px 20px rgba(91,114,238,0.2); width:50px; height:50px; font-size:18px;">
          <i class="fa fa-graduation-cap"></i>
        </div>
        <h3 class="aio-title" style="font-size: 16px;">Dana Pengembangan Diri</h3>
        <p class="aio-desc">Mendukung Anda mengikuti sertifikasi, seminar, atau membeli buku referensi penunjang keahlian professional.</p>
      </div>
    </div>
  </section>

  <!-- ─── JOB OPENINGS ─── -->
  <section class="careers-list" style="padding-top: 50px;">
    <h3 style="font-size: 24px; font-weight: 700; text-align: center; margin-bottom: 40px; color: var(--text-dark);">Lowongan Pekerjaan Aktif</h3>
    
    <div class="careers-grid">
      <!-- Job 1 -->
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

      <!-- Job 2 -->
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

      <!-- Job 3 -->
      <div class="career-card reveal">
        <div class="cc-header">
          <span class="cc-tag">Education</span>
          <h4>Education Consultant</h4>
        </div>
        <p class="cc-desc">Menjalin hubungan baik dengan yayasan sekolah di Indonesia, mendengarkan kebutuhan mereka, serta merumuskan implementasi platform KEMUDI.</p>
        <div class="cc-footer">
          <span class="cc-loc"><i class="fa fa-map-marker"></i> Bandung / On-site</span>
          <a href="mailto:support@kemudilms.my.id?subject=Lamaran%20Education%20Consultant" class="btn-career-apply">Lamar Posisi</a>
        </div>
      </div>
    </div>

    <!-- General Application -->
    <div class="reveal" style="text-align: center; margin-top: 50px; background: var(--white); padding: 40px; border-radius: 20px; box-shadow: var(--card-shadow);">
      <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 10px; color: var(--text-dark);">Tidak menemukan posisi yang cocok?</h4>
      <p style="font-size: 14px; color: var(--text-muted); max-width: 600px; margin: 0 auto 20px; line-height: 1.6;">Kami selalu menyambut talenta yang memiliki motivasi tinggi. Kirim CV dan Portfolio umum Anda kepada tim HR kami.</p>
      <a href="mailto:support@kemudilms.my.id?subject=Lamaran%20Umum" class="btn-pricing" style="display:inline-block; width:auto; padding: 12px 35px; border-color:var(--primary); background:var(--primary); color:var(--white); text-decoration:none;">Kirim Lamaran Umum</a>
    </div>
  </section>

<?php
include 'landing_footer.php';
?>
