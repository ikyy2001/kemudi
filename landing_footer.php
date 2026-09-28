  <!-- ─── FOOTER ─── -->
  <footer>
    <div class="footer-top">
      <div class="footer-logo-row">
        <a href="<?= $homeurl ?>" class="nav-logo">
          <div class="nav-logo-icon">K</div>
          <span class="nav-logo-text">KE<span>MUDI</span></span>
        </a>
        <div class="footer-divider-logo"></div>
        <div style="font-size:18px; font-weight:600; color:#B2B3CF; letter-spacing: 0.5px;">Virtual Class</div>
      </div>
      <div class="footer-tagline">Subscribe to get our Newsletter</div>
      <div class="footer-newsletter">
        <input type="email" placeholder="Your Email" />
        <button type="button">Subscribe Now</button>
      </div>
    </div>
    <div class="footer-bottom">
      <ul class="footer-links">
        <li><a href="<?= $homeurl ?>/careers.php">Careers</a></li>
        <li><a href="<?= $homeurl ?>/about.php">Privacy Policy</a></li>
        <li><a href="<?= $homeurl ?>/about.php">Terms & Conditions</a></li>
      </ul>
      <div class="footer-copy">© 2026 KEMUDI. Hak cipta dilindungi undang-undang.</div>
    </div>
  </footer>

  <!-- ─── LOGIN MODAL ─── -->
  <div class="modal-overlay" id="login-modal">
    <div class="modal-box">
      <button class="modal-close" id="close-login-btn">&times;</button>
      <div class="login-card-header">
        <div class="login-card-logo">K</div>
        <h3 class="login-card-title">Login ke <?= $setting['aplikasi'] ?></h3>
        <p class="login-card-subtitle">Silakan pilih peran Anda untuk masuk</p>
      </div>

      <div class="login-tabs">
        <button class="login-tab active" data-target="login-siswa"><i class="fa fa-user"></i> Siswa</button>
        <button class="login-tab" data-target="login-guru"><i class="fa fa-graduation-cap"></i> Guru</button>
        <button class="login-tab" data-target="login-admin"><i class="fa fa-user-secret"></i> Admin</button>
      </div>

      <!-- Siswa Login Form -->
      <div class="login-pane active" id="login-siswa">
        <?php if($setting['LoginSiswaMainten'] == 1) { ?>
          <div class="alert alert-warning text-center" style="background:#FFF3E5; color:#F48C06; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #FFE4C4;">
            <strong>Mohon Maaf!</strong> Sistem sedang pemeliharaan (maintenance). Silakan coba lagi nanti.
          </div>
        <?php } else { ?>
          <form id="formlogin" action="ceklogin.php" method="POST">
            <div class="form-group">
              <label class="form-label">Username</label>
              <div class="form-input-wrap">
                <i class="fa fa-user form-icon" style="padding-top: 15px;"></i>
                <input type="text" name="username" class="form-input" placeholder="Masukkan Username" required />
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Password</label>
              <div class="form-input-wrap">
                <i class="fa fa-lock form-icon" style="padding-top: 15px;"></i>
                <input type="password" name="password" class="form-input" placeholder="Masukkan Password" required />
              </div>
            </div>
            <blockquote class="blockquote text-center" style="border: none; padding: 0; margin-bottom: 15px;">
              <p class="mb-0" style="font-size: 12px; color: var(--text-muted);"><?= $setting['IsiPesanSingkat'];?></p>
              <footer class="blockquote-footer" style="font-size: 11px;"><cite title="Source Title"><?= $setting['JudulPesanSingkat'];?></cite></footer>
            </blockquote>
            <button type="submit" class="btn-login" style="background-color: var(--primary);">Login</button>
          </form>
        <?php } ?>
      </div>

      <!-- Guru Redirect -->
      <div class="login-pane" id="login-guru" style="display:none; text-align:center;">
        <div style="padding: 20px 0;">
          <div style="font-size:40px; color:var(--primary); margin-bottom:15px;"><i class="fa fa-graduation-cap"></i></div>
          <h4 style="font-weight: 700; margin-bottom: 5px;">Portal Guru</h4>
          <p style="color:var(--text-muted); font-size:13px; margin-bottom:20px;">Kelola materi pembelajaran, kuis, tugas, dan nilai siswa.</p>
          <a href="<?= $homeurl ?>/guru/index.php" class="btn-login" style="display:block; text-decoration:none; line-height:2.6; background-color: var(--primary); color: white;">Buka Portal Guru</a>
        </div>
      </div>

      <!-- Admin Redirect -->
      <div class="login-pane" id="login-admin" style="display:none; text-align:center;">
        <div style="padding: 20px 0;">
          <div style="font-size:40px; color:var(--secondary); margin-bottom:15px;"><i class="fa fa-user-secret"></i></div>
          <h4 style="font-weight: 700; margin-bottom: 5px;">Portal Administrator</h4>
          <p style="color:var(--text-muted); font-size:13px; margin-bottom:20px;">Manajemen sekolah, master data kelas/siswa, dan kontrol ujian daring.</p>
          <a href="<?= $homeurl ?>/crew/login.php" class="btn-login" style="display:block; text-decoration:none; line-height:2.6; background-color: var(--secondary); color: white;">Buka Portal Admin</a>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= $homeurl ?>/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
  <script>
    $(document).ready(function() {
      // ─── LOGIN MODAL OPEN/CLOSE ───
      $('#open-login-btn').click(function() {
        $('#login-modal').addClass('open');
      });
      $('#close-login-btn').click(function() {
        $('#login-modal').removeClass('open');
      });
      $(window).click(function(e) {
        if ($(e.target).is('#login-modal')) {
          $('#login-modal').removeClass('open');
        }
      });

      // ─── TAB SWITCHING ───
      $('.login-tab').click(function() {
        $('.login-tab').removeClass('active');
        $(this).addClass('active');
        
        var target = $(this).data('target');
        $('.login-pane').hide();
        $('#' + target).show();
      });

      // ─── STUDENT AJAX LOGIN ───
      $(document).on('submit', '#formlogin', function(e) {
        var homeurl = '<?= $homeurl ?>';
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: '<?= $homeurl ?>/ceklogin.php',
          data: $(this).serialize(),
          success: function(data) {
            if (data == "ok") {
              window.location = homeurl;
            } else if (data == "nopass") {
              swal({
                position: 'top-end',
                type: 'warning',
                title: 'Password Salah',
                showConfirmButton: false,
                timer: 1500
              });
            } else if (data == "td") {
              swal({
                position: 'top-end',
                type: 'warning',
                title: 'Siswa tidak terdaftar',
                showConfirmButton: false,
                timer: 1500
              });
            } else if (data == "nologin") {
              swal({
                position: 'top-end',
                type: 'warning',
                title: 'Siswa sudah aktif',
                showConfirmButton: false,
                timer: 1500
              });
            } else {
              swal({
                position: 'top-end',
                type: 'error',
                title: 'Gagal Login: ' + data,
                showConfirmButton: false,
                timer: 1500
              });
            }
          }
        });
        return false;
      });

      // Smooth scroll for nav anchor links
      $('a[href^="#"]').on('click', function(e) {
        var target = this.hash;
        if (target) {
          var $target = $(target);
          if($target.length) {
            e.preventDefault();
            $('html, body').stop().animate({
              'scrollTop': $target.offset().top - 90
            }, 800, 'swing');
          }
        }
      });
    });

    // ─── NAVBAR SCROLL EFFECT ───
    window.addEventListener('scroll', function() {
      const navbar = document.getElementById('landing-navbar');
      if (!navbar) return;
      if (window.scrollY > 50) {
        navbar.classList.remove('not-scrolled');
        navbar.classList.add('scrolled');
      } else {
        // Only make transparent if it's not predefined as scrolled
        if (!navbar.classList.contains('scrolled-fixed')) {
          navbar.classList.remove('scrolled');
          navbar.classList.add('not-scrolled');
        }
      }
    });

    // ─── SCROLL REVEAL ───
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.classList.add('visible');
          }, (entry.target.dataset.delay || 0));
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });

    reveals.forEach((el, i) => {
      el.dataset.delay = (i % 4) * 80;
      observer.observe(el);
    });

    // ─── COUNTER ANIMATION ───
    function animateCounters() {
      document.querySelectorAll('.stat-number').forEach(el => {
        const text = el.textContent;
        const num = parseFloat(text.replace(/[^0-9.]/g, ''));
        const suffix = text.replace(/[0-9.]/g, '');
        let start = 0;
        const duration = 1800;
        const step = (timestamp) => {
          if (!start) start = timestamp;
          const progress = Math.min((timestamp - start) / duration, 1);
          const eased = 1 - Math.pow(1 - progress, 3);
          el.textContent = (num > 100 ? Math.round(eased * num) : (eased * num).toFixed(0)) + suffix;
          if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
      });
    }

    const statsSection = document.querySelector('.success-stats');
    const statsObserver = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        animateCounters();
        statsObserver.disconnect();
      }
    }, { threshold: 0.5 });
    if (statsSection) statsObserver.observe(statsSection);
  </script>
</body>
</html>
