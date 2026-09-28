<?php
// Active menu helper
$current_pg = isset($_GET['pg']) ? $_GET['pg'] : '';
$is_overview = ($current_pg == '');
$is_users = in_array($current_pg, ['siswa', 'siswa_tidak_ujian', 'siswa_tidak_ujian_banksoal', 'siswa_sesi', 'siswa_ruang', 'siswa_kelas', 'siswa_jurusan', 'guru', 'pengawas']);
$is_schools = in_array($current_pg, ['importmaster', 'matapelajaran', 'jenisujian', 'pk', 'kelas', 'ruang', 'level', 'sesi', 'dataserver']);
$is_projects = in_array($current_pg, ['token_telegram', 'materi_pb', 'tugas_pb']);
$is_exams = in_array($current_pg, ['banksoal', 'jadwal']);
$is_grades = in_array($current_pg, ['pindah_nilai', 'nilai2', 'nilai_mapel', 'nilai_mata_pelajaran', 'semuanilai_banksoal', 'nilai3']);
$is_analytics = in_array($current_pg, ['anso', 'anso_nilai', 'anso_ranking', 'anso_perbaikan']);
$is_settings = in_array($current_pg, ['pengaturan', 'sinkronmkks', 'sinkron', 'sinkronset', 'sinkrondapo', 'data_cleanup']);
$is_reports = in_array($current_pg, ['absen', 'kartu', 'berita', 'laporan', 'leger']);
$is_security = in_array($current_pg, ['status2', 'reset', 'token', 'pengacak', 'susulan']);
$is_attendance = in_array($current_pg, ['absen_tahun', 'absen_jam', 'absen_total', 'absen_detail', 'absen_permapel', 'absen_permapel_detail', 'absen_siswamapel', 'absen_izin']);
?>

<section class='sidebar'>
	<ul class='sidebar-menu tree' data-widget='tree'>
		<!-- Section: GENERAL -->
		<li class="header jawara-nav-section">GENERAL</li>
		
		<li class="<?= $is_overview ? 'active' : '' ?>">
			<a href='?'>
				<i class="fa fa-home"></i>
				<span>Overview</span>
			</a>
		</li>

		<?php if ($pengawas['level'] == 'admin') : ?>
			<li class='treeview <?= $is_users ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-users"></i>
					<span>Users</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'siswa') ? 'active' : '' ?>"><a href='?pg=siswa'><i class='fa fa-circle-notch'></i> Data Siswa</a></li>
					<li class="<?= ($current_pg == 'guru') ? 'active' : '' ?>"><a href='?pg=guru'><i class='fa fa-circle-notch'></i> Data Guru</a></li>
					<li class="<?= ($current_pg == 'pengawas') ? 'active' : '' ?>"><a href='?pg=pengawas'><i class='fa fa-circle-notch'></i> Administrator</a></li>
					<li class="<?= ($current_pg == 'siswa_kelas') ? 'active' : '' ?>"><a href='?pg=siswa_kelas'><i class='fa fa-circle-notch'></i> Siswa Per Kelas</a></li>
					<li class="<?= ($current_pg == 'siswa_sesi') ? 'active' : '' ?>"><a href='?pg=siswa_sesi'><i class='fa fa-circle-notch'></i> Siswa Per Sesi</a></li>
					<li class="<?= ($current_pg == 'siswa_ruang') ? 'active' : '' ?>"><a href='?pg=siswa_ruang'><i class='fa fa-circle-notch'></i> Siswa Per Ruang</a></li>
					<li class="<?= ($current_pg == 'siswa_tidak_ujian') ? 'active' : '' ?>"><a href='?pg=siswa_tidak_ujian'><i class='fa fa-circle-notch'></i> Tidak Ujian</a></li>
				</ul>
			</li>

			<li class='treeview <?= $is_schools ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-school"></i>
					<span>Schools</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'matapelajaran') ? 'active' : '' ?>"><a href='?pg=matapelajaran'><i class='fa fa-circle-notch'></i> Mata Pelajaran</a></li>
					<li class="<?= ($current_pg == 'kelas') ? 'active' : '' ?>"><a href='?pg=kelas'><i class='fa fa-circle-notch'></i> Data Kelas</a></li>
					<li class="<?= ($current_pg == 'ruang') ? 'active' : '' ?>"><a href='?pg=ruang'><i class='fa fa-circle-notch'></i> Data Ruangan</a></li>
					<li class="<?= ($current_pg == 'sesi') ? 'active' : '' ?>"><a href='?pg=sesi'><i class='fa fa-circle-notch'></i> Data Sesi</a></li>
					<li class="<?= ($current_pg == 'level') ? 'active' : '' ?>"><a href='?pg=level'><i class='fa fa-circle-notch'></i> Data Level</a></li>
					<li class="<?= ($current_pg == 'jenisujian') ? 'active' : '' ?>"><a href='?pg=jenisujian'><i class='fa fa-circle-notch'></i> Jenis Ujian</a></li>
					<?php if ($setting['jenjang'] == 'SMK') : ?>
						<li class="<?= ($current_pg == 'pk') ? 'active' : '' ?>"><a href='?pg=pk'><i class='fa fa-circle-notch'></i> Data Jurusan</a></li>
					<?php endif; ?>
					<li class="<?= ($current_pg == 'importmaster') ? 'active' : '' ?>"><a href='?pg=importmaster'><i class='fa fa-circle-notch'></i> Import Master</a></li>
				</ul>
			</li>

			<?php if ($setting['elerning'] == 1) : ?>
				<li class='treeview <?= $is_projects ? 'active' : '' ?>'>
					<a href='#'>
						<i class="fa fa-tasks"></i>
						<span>Projects</span>
						<span class='pull-right-container'>
							<i class='fa fa-angle-down pull-right'></i>
						</span>
					</a>
					<ul class='treeview-menu'>
						<?php if ($setting['izin_materi'] == 1) : ?>
							<li class="<?= ($current_pg == 'materi_pb') ? 'active' : '' ?>"><a href='?pg=materi_pb'><i class='fa fa-circle-notch'></i> Materi Pembelajaran</a></li>
						<?php endif; ?>
						<?php if ($setting['izin_tugas'] == 1) : ?>
							<li class="<?= ($current_pg == 'tugas_pb') ? 'active' : '' ?>"><a href='?pg=tugas_pb'><i class='fa fa-circle-notch'></i> Tugas Terstruktur</a></li>
						<?php endif; ?>
						<li><a href='?pg=token_telegram'><i class='fa fa-circle-notch'></i> Token Telegram</a></li>
					</ul>
				</li>
			<?php endif; ?>

			<li class='treeview <?= $is_exams ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-file-alt"></i>
					<span>Exams</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'banksoal') ? 'active' : '' ?>"><a href='?pg=banksoal'><i class='fa fa-circle-notch'></i> Bank Soal</a></li>
					<li class="<?= ($current_pg == 'jadwal') ? 'active' : '' ?>"><a href='?pg=jadwal'><i class='fa fa-circle-notch'></i> Jadwal Ujian</a></li>
				</ul>
			</li>

			<li class='treeview <?= $is_grades ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-award"></i>
					<span>Grades</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'nilai2') ? 'active' : '' ?>"><a href='?pg=nilai2'><i class='fa fa-circle-notch'></i> Hasil Nilai</a></li>
					<li class="<?= ($current_pg == 'nilai_mapel') ? 'active' : '' ?>"><a href='?pg=nilai_mapel'><i class='fa fa-circle-notch'></i> Nilai / Jadwal</a></li>
					<li class="<?= ($current_pg == 'nilai_mata_pelajaran') ? 'active' : '' ?>"><a href='?pg=nilai_mata_pelajaran'><i class='fa fa-circle-notch'></i> Nilai / Mapel</a></li>
					<li class="<?= ($current_pg == 'semuanilai_banksoal') ? 'active' : '' ?>"><a href='?pg=semuanilai_banksoal'><i class='fa fa-circle-notch'></i> Semua Nilai / Jadwal</a></li>
					<li class="<?= ($current_pg == 'pindah_nilai') ? 'active' : '' ?>"><a href='?pg=pindah_nilai'><i class='fa fa-circle-notch'></i> Pindah Nilai Ujian</a></li>
				</ul>
			</li>
		<?php else : // Guru role in crew ?>
			<li class="<?= ($current_pg == 'siswa') ? 'active' : '' ?>">
				<a href='?pg=siswa'>
					<i class="fa fa-users"></i>
					<span>Data Siswa</span>
				</a>
			</li>
			<li class="<?= ($current_pg == 'banksoal') ? 'active' : '' ?>">
				<a href='?pg=banksoal'>
					<i class="fa fa-folder-open"></i>
					<span>Bank Soal</span>
				</a>
			</li>
			<li class="<?= ($current_pg == 'jadwal') ? 'active' : '' ?>">
				<a href='?pg=jadwal'>
					<i class="fa fa-calendar-alt"></i>
					<span>Jadwal Ujian</span>
				</a>
			</li>
			<li class="<?= ($current_pg == 'nilai2') ? 'active' : '' ?>">
				<a href='?pg=nilai2'>
					<i class="fa fa-award"></i>
					<span>Hasil Nilai</span>
				</a>
			</li>
		<?php endif; ?>

		<!-- Section: OTHERS -->
		<li class="header jawara-nav-section">OTHERS</li>

		<?php if ($pengawas['level'] == 'admin') : ?>
			<li class='treeview <?= $is_analytics ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-chart-line"></i>
					<span>Analytics</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'anso') ? 'active' : '' ?>"><a href='?pg=anso'><i class='fa fa-circle-notch'></i> Analisa Per Soal</a></li>
					<li class="<?= ($current_pg == 'anso_nilai') ? 'active' : '' ?>"><a href='?pg=anso_nilai'><i class='fa fa-circle-notch'></i> Analisa Nilai Mapel</a></li>
					<li class="<?= ($current_pg == 'anso_ranking') ? 'active' : '' ?>"><a href='?pg=anso_ranking'><i class='fa fa-circle-notch'></i> Analisa Ranking</a></li>
					<li class="<?= ($current_pg == 'anso_perbaikan') ? 'active' : '' ?>"><a href='?pg=anso_perbaikan'><i class='fa fa-circle-notch'></i> Perbaikan Nilai</a></li>
				</ul>
			</li>

			<li class='treeview <?= $is_settings ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-cog"></i>
					<span>Settings</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'pengaturan') ? 'active' : '' ?>"><a href='?pg=pengaturan'><i class='fa fa-circle-notch'></i> Pengaturan Sistem</a></li>
					<?php if ($setting['izin_sinkron'] == 1) : ?>
						<li class="<?= ($current_pg == 'sinkronmkks') ? 'active' : '' ?>"><a href='?pg=sinkronmkks'><i class='fa fa-circle-notch'></i> Sinkron Pusat MKKS</a></li>
					<?php endif; ?>
					<li class="<?= ($current_pg == 'dataserver') ? 'active' : '' ?>"><a href='?pg=dataserver'><i class='fa fa-circle-notch'></i> Data Server</a></li>
					<li class="<?= ($current_pg == 'data_cleanup') ? 'active' : '' ?>"><a href='?pg=data_cleanup'><i class='fa fa-circle-notch'></i> Data Management / Cleanup</a></li>
				</ul>
			</li>

			<li class="<?= ($current_pg == 'data_cleanup') ? 'active' : '' ?>">
				<a href='?pg=data_cleanup' style="<?= ($current_pg == 'data_cleanup') ? 'background: #fef2f2 !important; color: #b91c1c !important;' : '' ?>">
					<i class="fa fa-broom" style="color: #ef4444;"></i>
					<span style="font-weight: 600;">Data Cleanup</span>
					<span class='pull-right-container'>
						<small class='label pull-right' style="background: #ef4444; color: #fff; border-radius: 9999px; font-size: 10px; font-weight: 700; padding: 2px 7px;">ADMIN</small>
					</span>
				</a>
			</li>

			<li class='treeview <?= $is_reports ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-file-invoice"></i>
					<span>Exam Reports</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'absen') ? 'active' : '' ?>"><a href='?pg=absen'><i class='fa fa-circle-notch'></i> Daftar Hadir</a></li>
					<li class="<?= ($current_pg == 'kartu') ? 'active' : '' ?>"><a href='?pg=kartu'><i class='fa fa-circle-notch'></i> Cetak Kartu</a></li>
					<li class="<?= ($current_pg == 'berita') ? 'active' : '' ?>"><a href='?pg=berita'><i class='fa fa-circle-notch'></i> Berita Acara</a></li>
					<li class="<?= ($current_pg == 'laporan') ? 'active' : '' ?>"><a href='?pg=laporan'><i class='fa fa-circle-notch'></i> Format Nilai</a></li>
					<li class="<?= ($current_pg == 'leger') ? 'active' : '' ?>"><a href='?pg=leger'><i class='fa fa-circle-notch'></i> Leger Nilai</a></li>
				</ul>
			</li>

			<li class='treeview <?= $is_security ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-shield-alt"></i>
					<span>System Security</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<li class="<?= ($current_pg == 'status2') ? 'active' : '' ?>"><a href='?pg=status2'><i class='fa fa-circle-notch'></i> Status Peserta</a></li>
					<li class="<?= ($current_pg == 'reset') ? 'active' : '' ?>"><a href='?pg=reset'><i class='fa fa-circle-notch'></i> Reset Login</a></li>
					<li class="<?= ($current_pg == 'token') ? 'active' : '' ?>"><a href='?pg=token'><i class='fa fa-circle-notch'></i> Rilis Token</a></li>
					<li class="<?= ($current_pg == 'pengacak') ? 'active' : '' ?>"><a href='?pg=pengacak'><i class='fa fa-circle-notch'></i> Pengacak Soal PG</a></li>
					<li class="<?= ($current_pg == 'susulan') ? 'active' : '' ?>"><a href='?pg=susulan'><i class='fa fa-circle-notch'></i> Belum Ujian</a></li>
				</ul>
			</li>
		<?php endif; ?>

		<?php if ($setting['izin_absen'] == 1 || $setting['izin_absen_mapel'] == 1) : ?>
			<li class='treeview <?= $is_attendance ? 'active' : '' ?>'>
				<a href='#'>
					<i class="fa fa-calendar-check"></i>
					<span>Absensi</span>
					<span class='pull-right-container'>
						<i class='fa fa-angle-down pull-right'></i>
					</span>
				</a>
				<ul class='treeview-menu'>
					<?php if ($setting['izin_absen'] == 1) : ?>
						<li><a href='?pg=absen_total'><i class='fa fa-circle-notch'></i> Absen Sekolah Total</a></li>
						<li><a href='?pg=absen_detail'><i class='fa fa-circle-notch'></i> Absen Sekolah Detail</a></li>
					<?php endif; ?>
					<?php if ($setting['izin_absen_mapel'] == 1) : ?>
						<li><a href='?pg=absen_permapel'><i class='fa fa-circle-notch'></i> Absen Mapel</a></li>
						<li><a href='?pg=absen_permapel_detail'><i class='fa fa-circle-notch'></i> Absen Mapel Detail</a></li>
					<?php endif; ?>
				</ul>
			</li>
		<?php endif; ?>
	</ul>

	<!-- User Profile Card at Sidebar Bottom -->
	<div class="jawara-sidebar-footer">
		<?php if (!empty($pengawas['foto_pengawas']) && file_exists("../guru/fotoguru/$pengawas[id_pengawas]/$pengawas[foto_pengawas]")) : ?>
			<img src='<?= $homeurl ?>/guru/fotoguru/<?= $pengawas['id_pengawas'] ?>/<?= $pengawas['foto_pengawas'] ?>' class='jawara-user-avatar' alt='Avatar'>
		<?php else : ?>
			<img src='<?= $homeurl ?>/dist/img/avatar-6.png' class='jawara-user-avatar' alt='Avatar'>
		<?php endif; ?>
		<div class="jawara-user-info footer-user-details">
			<div class="jawara-user-name">
				<span><?= $pengawas['nama'] ?></span>
				<span class="jawara-role-pill"><?= $pengawas['level'] ?></span>
			</div>
			<div class="jawara-user-sub"><?= !empty($pengawas['username']) ? $pengawas['username'] : 'admin@jawara.com' ?></div>
		</div>
		<a href="logout.php" class="btn-jawara-details footer-action-btn" title="Keluar" style="padding: 6px 10px;">
			<i class="fa fa-sign-out"></i>
		</a>
	</div>
</section>