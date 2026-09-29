<?php
$app_logo = (!empty($setting['logo']) && file_exists(__DIR__ . '/../../' . $setting['logo'])) 
    ? ($homeurl . '/' . $setting['logo']) 
    : ($homeurl . '/dist/img/logo55.png');
?>
<a href='?' class='logo' style='background-color:#ffffff; border-bottom: 1px solid #eef2f6; border-right: 1px solid #eef2f6;'>
	<span class='logo-mini'>
		<img src="<?= $app_logo ?>" height="30px" style="border-radius: 6px; object-fit: contain;" alt="Logo" onerror="this.src='<?= $homeurl ?>/dist/img/logo55.png'">
	</span>
	<span class='logo-lg' style="display:flex; align-items:center; justify-content:center; gap:8px; font-weight:800; color:#0f172a; font-size:16px;">
		<img src="<?= $app_logo ?>" height="34px" style="border-radius: 8px; object-fit: contain;" alt="Logo" onerror="this.src='<?= $homeurl ?>/dist/img/logo55.png'"> 
		<span><?= !empty($setting['aplikasi']) ? $setting['aplikasi'] : 'JawaraCBT' ?></span>
	</span>
</a>

<nav class='navbar navbar-static-top' style='background:#ffffff; border-bottom:1px solid #eef2f6;' role='navigation'>
	<a href='#' class='sidebar-baru' data-toggle='offcanvas' role='button' title="Toggle Menu" style="color:#475569; padding: 15px 18px; font-size:16px;">
		<i class="fa fa-bars"></i>
	</a>
	<div class='navbar-custom-menu'>
		<ul class='nav navbar-nav' style="display:flex; align-items:center; margin-right:15px; gap:8px;">
			<li class='hidden-xs'>
				<span class="navbar-badge-pill" style="margin-top:10px; display:inline-flex;">
					<i class="fa fa-microchip" style="color:#0284c7;"></i>
					<?= round(memory_get_usage()/1048576,2) ?> MB
				</span>
			</li>

			<?php if ($pengawas['level'] == 'admin') : ?>
				<li class='hidden-xs'>
					<span class="navbar-badge-pill" style="margin-top:10px; display:inline-flex;" data-toggle="tooltip" title="Status Redis Cache">
						<?php
							try {
								$Redis->ping();
								echo '<span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#10b981; margin-right:4px;"></span> Redis Aktif';
							} catch (Exception $e) {
								echo '<span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#ef4444; margin-right:4px;"></span> Redis Offline';
							}
						?>
					</span>
				</li>

				<li class='hidden-xs'>
					<span class="navbar-badge-pill" style="margin-top:10px; display:inline-flex;">
						<i class="fa fa-server" style="color:#8b5cf6;"></i>
						<?= strtoupper($setting['server']) ?>
					</span>
				</li>

				<li>
					<a href='?pg=pengaturan' style="padding: 14px 10px; color:#475569;" title="Pengaturan">
						<i class="fa fa-cog fa-lg"></i>
					</a>
				</li>
				<li>
					<a href='?pg=pengumuman' style="padding: 14px 10px; color:#475569;" title="Pengumuman">
						<i class="fa fa-bullhorn fa-lg"></i>
					</a>
				</li>
			<?php endif; ?>

			<li class='dropdown user user-menu'>
				<a href='#' class='dropdown-toggle' data-toggle='dropdown' style="display:flex; align-items:center; gap:8px; padding: 10px 14px; background:#f8fafc; border:1px solid #e2e8f0; border-radius:9999px; margin-top:5px;">
					<?php if (!empty($pengawas['foto_pengawas']) && file_exists("../guru/fotoguru/$pengawas[id_pengawas]/$pengawas[foto_pengawas]")) : ?>
						<img src='<?= $homeurl ?>/guru/fotoguru/<?= $pengawas['id_pengawas'] ?>/<?= $pengawas['foto_pengawas'] ?>' class='img-circle' alt='User' style="width:28px; height:28px; object-fit:cover;">
					<?php else : ?>
						<img src='<?= $homeurl ?>/dist/img/avatar-6.png' class='img-circle' alt='User' style="width:28px; height:28px; object-fit:cover;">
					<?php endif; ?>
					<span class='hidden-xs' style="font-weight:700; color:#1e293b; font-size:13px;"><?= $pengawas['nama'] ?></span>
					<i class='fa fa-chevron-down' style="font-size:10px; color:#94a3b8;"></i>
				</a>
				
				<ul class='dropdown-menu' style="border-radius:14px; border:1px solid #e2e8f0; box-shadow:0 10px 25px rgba(0,0,0,0.08); overflow:hidden; min-width:240px; margin-top:8px;">
					<li class='user-header' style="background:#1f4e5b; color:#ffffff; padding:20px; text-align:center;">
						<?php if (!empty($pengawas['foto_pengawas']) && file_exists("../guru/fotoguru/$pengawas[id_pengawas]/$pengawas[foto_pengawas]")) : ?>
							<img src='<?= $homeurl ?>/guru/fotoguru/<?= $pengawas['id_pengawas'] ?>/<?= $pengawas['foto_pengawas'] ?>' class='img-circle' style="width:60px; height:60px; border:2px solid #ffffff; object-fit:cover; margin:0 auto 10px;" alt='User Image'>
						<?php else : ?>
							<img src='<?= $homeurl ?>/dist/img/avatar-6.png' class='img-circle' style="width:60px; height:60px; border:2px solid #ffffff; object-fit:cover; margin:0 auto 10px;" alt='User Image'>
						<?php endif; ?>
						<p style="margin:0; font-weight:700; font-size:15px; color:#ffffff;">
							<?= $pengawas['nama'] ?>
							<small style="display:block; color:#99f6e4; font-size:12px; margin-top:4px;">Level: <?= strtoupper($pengawas['level']) ?></small>
						</p>
					</li>
					<li class='user-footer' style="background:#f8fafc; padding:12px 16px; display:flex; justify-content:space-between; align-items:center;">
						<div>
							<?php if ($pengawas['level'] == 'admin') : ?>
								<a href='?pg=pengaturan' class='btn btn-xs btn-default'><i class='fa fa-cog'></i> Setting</a>
							<?php elseif ($pengawas['level'] == 'guru') : ?>
								<a href='?pg=editguru' class='btn btn-xs btn-default'><i class='fa fa-user'></i> Profil</a>
							<?php endif; ?>
						</div>
						<div>
							<a href='logout.php' class='btn btn-xs btn-danger'><i class='fa fa-sign-out'></i> Keluar</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>