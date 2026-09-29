<?php
$guru_logo_file = (!empty($setting['logo']) && file_exists(FCPATH . '../' . $setting['logo'])) 
    ? base_url('../' . $setting['logo']) 
    : base_url('../dist/img/logo55.png');
?>
<a href='<?= base_url('admin/') ?>' class='logo' style='background-color:#ffffff; border-bottom: 1px solid #eef2f6; border-right: 1px solid #eef2f6;'>
	<span class='logo-mini'>
		<img src="<?= $guru_logo_file ?>" height="30px" style="border-radius: 6px; object-fit: contain;" alt="Logo" onerror="this.src='/dist/img/logo55.png'">
	</span>
	<span class='logo-lg' style="display:flex; align-items:center; justify-content:center; gap:8px; font-weight:800; color:#0f172a; font-size:16px;">
		<img src="<?= $guru_logo_file ?>" height="34px" style="border-radius: 8px; object-fit: contain;" alt="Logo" onerror="this.src='/dist/img/logo55.png'"> 
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
					<i class="fa fa-school" style="color:#0284c7;"></i>
					<?= $setting['sekolah'] ?>
				</span>
			</li>
			<li>
				<a href='<?= base_url('login/log_out') ?>' class="btn btn-xs btn-danger" style="margin-top:10px; color:#ffffff !important; border-radius:8px; padding:6px 12px;" title="Keluar">
					<i class="fa fa-sign-out"></i> Keluar
				</a>
			</li>
		</ul>
	</div>
</nav>