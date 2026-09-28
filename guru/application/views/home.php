<section class='content' style="padding: 20px;">
	<!-- JawaraCBT Campus Hero Banner -->
	<div class="jawara-hero-wrapper">
		<div class="jawara-hero-banner">
			<img src="<?= base_url('../dist/img/campus_banner.jpg') ?>" alt="Campus">
			<div class="jawara-hero-overlay">
				<h2 class="jawara-hero-title"><?= $setting['sekolah'] ?></h2>
				<div class="jawara-hero-sub"><?= $setting['aplikasi'] ?> - Portal Guru & Tenaga Pendidik</div>
			</div>
		</div>
		<!-- Search Bar -->
		<div class="jawara-search-wrapper">
			<i class="fa fa-search jawara-search-icon"></i>
			<input type="text" id="guruSearch" class="jawara-search-input" placeholder="Search students, subjects, exams, materials, tasks..." onkeyup="filterJawaraDashboard(this.value)">
		</div>
	</div>

	<!-- Main Stat Cards & Quick Actions -->
	<div class="row">
		<div class="col-lg-9 col-md-8">
			<div class="row">
				<!-- Card 1: Data Siswa -->
				<div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom: 20px;">
					<div class="jawara-card" style="min-height: 190px;">
						<div class="jawara-stat-top">
							<h4 class="jawara-stat-label">Total Students</h4>
							<div class="jawara-icon-badge lime">
								<i class="fa fa-user-graduate"></i>
							</div>
						</div>
						<div>
							<div class="jawara-stat-value" id="total_siswa_view">Siswa Aktif</div>
							<div class="jawara-stat-desc">Peserta didik terdaftar</div>
							<div class="jawara-stat-trend up">
								<i class="fa fa-check"></i> Terhubung ke sistem
							</div>
						</div>
					</div>
				</div>

				<!-- Card 2: Materi -->
				<div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom: 20px;">
					<div class="jawara-card" style="min-height: 190px;">
						<div class="jawara-stat-top">
							<h4 class="jawara-stat-label">Materi Pembelajaran</h4>
							<div class="jawara-icon-badge teal">
								<i class="fa fa-book-reader"></i>
							</div>
						</div>
						<div>
							<div class="jawara-stat-value" id="jml_materi">-</div>
							<div class="jawara-stat-desc">Total bahan ajar diunggah</div>
							<div class="jawara-stat-trend up">
								<i class="fa fa-cloud-upload-alt"></i> E-Learning aktif
							</div>
						</div>
					</div>
				</div>

				<!-- Card 3: Tugas -->
				<div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom: 20px;">
					<div class="jawara-card" style="min-height: 190px;">
						<div class="jawara-stat-top">
							<h4 class="jawara-stat-label">Tugas Terstruktur</h4>
							<div class="jawara-icon-badge orange">
								<i class="fa fa-tasks"></i>
							</div>
						</div>
						<div>
							<div class="jawara-stat-value" id="jml_tugas">-</div>
							<div class="jawara-stat-desc">Tugas & latihan siswa</div>
							<div class="jawara-stat-trend up">
								<i class="fa fa-clock"></i> Aktif untuk kelas
							</div>
						</div>
					</div>
				</div>

				<!-- Card 4: Soal Ujian -->
				<div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom: 20px;">
					<div class="jawara-card" style="min-height: 190px;">
						<div class="jawara-stat-top">
							<h4 class="jawara-stat-label">Bank Soal & Ujian</h4>
							<div class="jawara-icon-badge purple">
								<i class="fa fa-file-alt"></i>
							</div>
						</div>
						<div>
							<div class="jawara-stat-value">CBT Ready</div>
							<div class="jawara-stat-desc">Manajemen soal dan penilaian</div>
							<div class="jawara-stat-trend neutral">
								<i class="fa fa-layer-group"></i> Bank Soal Terpadu
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Quick Actions for Guru -->
		<div class="col-lg-3 col-md-4 col-sm-12" style="margin-bottom: 20px;">
			<div class="jawara-quick-actions-card" style="min-height: 400px;">
				<h4 class="jawara-quick-title">Quick Actions</h4>
				
				<a href="<?= base_url('soal/daftar_soal'); ?>" class="btn-jawara-primary-action">
					<i class="fa fa-plus"></i> Kelola Bank Soal
				</a>

				<a href="<?= base_url('admin/materi'); ?>" class="btn-jawara-secondary-action">
					<i class="fa fa-book"></i> Materi Belajar
				</a>

				<a href="<?= base_url('admin/tugas'); ?>" class="btn-jawara-secondary-action">
					<i class="fa fa-edit"></i> Tugas Siswa
				</a>

				<a href="<?= base_url('admin/daftar_ujian'); ?>" class="btn-jawara-secondary-action">
					<i class="fa fa-award"></i> Download Nilai
				</a>

				<a href="<?= base_url('admin/status_peserta'); ?>" class="btn-jawara-secondary-action">
					<i class="fa fa-desktop"></i> Status Peserta Ujian
				</a>

				<div style="margin-top:auto; padding-top:16px; border-top:1px solid #f1f5f9; text-align:center;">
					<a href="clear_cache" class="btn btn-xs btn-default" style="width:100%; border-radius:8px;">
						<i class="fa fa-sync-alt"></i> Clear Cache
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- School Details Card -->
	<div class="row">
		<div class="col-md-12">
			<div class="jawara-card">
				<div class="jawara-list-header">
					<h4 class="jawara-list-title"><i class="fa fa-school" style="color:#1f4e5b; margin-right:8px;"></i> Informasi Sekolah & Kontak</h4>
				</div>
				<div class="row" style="padding-top: 10px;">
					<div class="col-md-4" style="margin-bottom:12px;">
						<strong style="color:#1e293b;"><i class="fa fa-building"></i> Nama Sekolah:</strong>
						<div style="color:#64748b; margin-top:4px;"><?= $setting['sekolah'] ?></div>
					</div>
					<div class="col-md-4" style="margin-bottom:12px;">
						<strong style="color:#1e293b;"><i class="fa fa-map-marker-alt"></i> Alamat:</strong>
						<div style="color:#64748b; margin-top:4px;"><?= !empty($setting['alamat']) ? $setting['alamat'] : '-' ?></div>
					</div>
					<div class="col-md-4" style="margin-bottom:12px;">
						<strong style="color:#1e293b;"><i class="fa fa-phone"></i> Telepon & Kontak:</strong>
						<div style="color:#64748b; margin-top:4px;"><?= !empty($setting['telp']) ? $setting['telp'] : '-' ?> | <?= !empty($setting['email']) ? $setting['email'] : '-' ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$.getJSON('<?= base_url('admin/materi_json')?>', function(data) {
		$.each(data, function(index,objek){
			$('#jml_materi').html(objek);
		});        
	});
	$.getJSON('<?= base_url('admin/tugas_json')?>', function(data) {
		$.each(data, function(index,objek){
			$('#jml_tugas').html(objek);
		});        
	});

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
