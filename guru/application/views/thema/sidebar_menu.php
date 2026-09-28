<?php
$ci_uri = $this->uri->segment(2);
$is_home = empty($ci_uri) || $ci_uri == 'index';
?>
<section class='sidebar'>
	<ul class='sidebar-menu tree' data-widget='tree'>
		<!-- Section: GENERAL -->
		<li class="header jawara-nav-section">GENERAL</li>

		<li class="<?= $is_home ? 'active' : '' ?>">
			<a href='<?= base_url('admin/'); ?>'>
				<i class="fa fa-home"></i>
				<span>Overview</span>
			</a>
		</li>

		<li class="<?= ($ci_uri == 'v_siswa') ? 'active' : '' ?>">
			<a href='<?= base_url('admin/v_siswa'); ?>'>
				<i class="fa fa-user-graduate"></i>
				<span>Data Siswa</span>
			</a>
		</li>

		<?php if($setting['izin_materi'] == 1) : ?>
			<li class='treeview <?= in_array($ci_uri, ['materi', 'tugas']) ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-tasks"></i>
					<span>E-Learning</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($ci_uri == 'materi') ? 'active' : '' ?>"><a href='<?= base_url('admin/materi'); ?>'><i class='fa fa-circle-notch'></i> Materi Belajar</a></li>
					<li class="<?= ($ci_uri == 'tugas') ? 'active' : '' ?>"><a href='<?= base_url('admin/tugas'); ?>'><i class='fa fa-circle-notch'></i> Tugas Siswa</a></li>
				</ul>
			</li>
		<?php endif; ?>

		<li class='treeview <?= in_array($ci_uri, ['daftar_soal']) ? 'active' : '' ?>'>
			<a href='#'>
				<i class="fa fa-file-alt"></i>
				<span>Bank Soal</span>
				<span class='pull-right-container'>
					<i class='fa fa-angle-down pull-right'></i>
				</span>
			</a>
			<ul class='treeview-menu'>
				<li><a href='<?= base_url('soal/daftar_soal'); ?>'><i class='fa fa-circle-notch'></i> Daftar Soal Ujian</a></li>
			</ul>
		</li>

		<li class="<?= ($ci_uri == 'daftar_ujian') ? 'active' : '' ?>">
			<a href='<?= base_url('admin/daftar_ujian'); ?>'>
				<i class="fa fa-award"></i>
				<span>Download Nilai</span>
			</a>
		</li>

		<li class="<?= ($ci_uri == 'status_peserta') ? 'active' : '' ?>">
			<a href='<?= base_url('admin/status_peserta'); ?>'>
				<i class="fa fa-shield-alt"></i>
				<span>Status Peserta</span>
			</a>
		</li>

		<!-- Section: OTHERS -->
		<li class="header jawara-nav-section">OTHERS</li>

		<li class='treeview'>
			<a href='#'>
				<i class="fa fa-chart-line"></i>
				<span>Analisa</span>
				<span class='pull-right-container'>
					<i class='fa fa-angle-down pull-right'></i>
				</span>
			</a>
			<ul class='treeview-menu'>
				<li><a href='<?= base_url('anso/daftar_soal'); ?>'><i class='fa fa-circle-notch'></i> Analisa Per Soal</a></li>
			</ul>
		</li>

		<li class="<?= ($ci_uri == 'no_ujian') ? 'active' : '' ?>">
			<a href='<?= base_url('admin/no_ujian'); ?>'>
				<i class="fa fa-user-times"></i>
				<span>Siswa Tidak Ujian</span>
			</a>
		</li>
	</ul>

	<!-- User Profile at bottom -->
	<div class="jawara-sidebar-footer">
		<img src='<?= base_url('../dist/img/avatar-01.jpg') ?>' class='jawara-user-avatar' alt='Avatar'>
		<div class="jawara-user-info footer-user-details">
			<div class="jawara-user-name">
				<span>Guru Pengajar</span>
				<span class="jawara-role-pill">guru</span>
			</div>
			<div class="jawara-user-sub"><?= $setting['sekolah'] ?></div>
		</div>
		<a href="<?= base_url('login/log_out') ?>" class="btn-jawara-details footer-action-btn" title="Keluar" style="padding: 6px 10px;">
			<i class="fa fa-sign-out"></i>
		</a>
	</div>
</section>