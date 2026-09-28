<?php
$active_page = 'pricing';
$nav_class = 'scrolled scrolled-fixed';
include 'landing_header.php';
?>

  <!-- ─── PAGE HERO ─── -->
  <section class="page-hero">
    <div class="ph-container reveal">
      <span class="ph-tag">PAKET BERLANGGANAN</span>
      <h1>Skalakan Pembelajaran dengan <span>Rencana Fleksibel</span></h1>
      <p class="ph-desc">Pilih paket terbaik yang dirancang khusus untuk memenuhi kebutuhan bimbingan belajar, sekolah formal, maupun kustomisasi platform skala enterprise.</p>
    </div>
  </section>

  <!-- ─── PRICING GRID ─── -->
  <section class="pricing" id="pricing" style="background: transparent;">
    <div class="pricing-grid">
      <!-- Katalog 1: Bimbel -->
      <div class="pricing-card reveal">
        <div class="pc-header">
          <h3>KEMUDI LMS For Bimbel</h3>
          <p class="pc-desc">Solusi cerdas untuk bimbingan belajar dan kursus. Dirancang untuk evaluasi cepat, latihan soal interaktif, dan pemantauan progres.</p>
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
        <a href="mailto:sales@kemudilms.my.id?subject=Pemesanan%20KEMUDI%20LMS%20For%20Bimbel" class="btn-pricing" style="display:block; text-align:center;">Pesan Sekarang</a>
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
        <a href="mailto:sales@kemudilms.my.id?subject=Pemesanan%20KEMUDI%20LMS%20For%20School" class="btn-pricing" style="display:block; text-align:center;">Hubungi Sales</a>
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
        <a href="mailto:sales@kemudilms.my.id?subject=Konsultasi%20KEMUDI%20LMS%20Custom" class="btn-pricing" style="display:block; text-align:center;">Konsultasi Sekarang</a>
      </div>
    </div>
  </section>

  <!-- ─── PRICING FAQs ─── -->
  <section class="pricing-faqs reveal" style="max-width: 900px; margin: 0 auto 80px; padding: 0 20px;">
    <h3 style="font-size: 24px; font-weight: 700; text-align: center; margin-bottom: 40px; color: var(--text-dark);">Pertanyaan Sering Diajukan</h3>
    <div style="display: flex; flex-direction: column; gap: 20px;">
      <div style="background: var(--white); padding: 24px; border-radius: 16px; box-shadow: var(--card-shadow);">
        <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: var(--text-dark);">Apakah ada biaya tersembunyi setelah aktivasi?</h4>
        <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6;">Tidak ada biaya tersembunyi. Biaya bulanan yang tercantum di atas mencakup seluruh fitur yang tertera, hosting data cloud, dan pemeliharaan server berkala.</p>
      </div>
      <div style="background: var(--white); padding: 24px; border-radius: 16px; box-shadow: var(--card-shadow);">
        <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: var(--text-dark);">Bagaimana cara melakukan pembayaran bulanan?</h4>
        <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6;">Pembayaran dapat dilakukan melalui transfer bank, kartu kredit sekolah, virtual account (Mandiri, BNI, BCA), atau dompet digital yang bekerjasama dengan platform kami.</p>
      </div>
      <div style="background: var(--white); padding: 24px; border-radius: 16px; box-shadow: var(--card-shadow);">
        <h4 style="font-size: 16px; font-weight: 700; margin-bottom: 8px; color: var(--text-dark);">Apakah kami dapat membatalkan atau mengubah paket sewaktu-waktu?</h4>
        <p style="font-size: 14px; color: var(--text-muted); line-height: 1.6;">Tentu saja. Anda bisa melakukan upgrade dari paket Free ke Pro kapan saja. Jika Anda melakukan downgrade, perubahan paket akan aktif pada siklus tagihan bulan berikutnya.</p>
      </div>
    </div>
  </section>

<?php
include 'landing_footer.php';
?>
