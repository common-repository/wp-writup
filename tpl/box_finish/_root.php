<?php
	global $wpdb;
	$ctd->set('logo_r4w', wpw_plugin_url.'assets/img/logo_r4w.png' );
	$ctd->set('url_about_r4w', admin_url( 'admin.php?page=wpw_about_r4w' ) );
	$ctd->set('url_download_r4w', admin_url( 'plugin-install.php?s=rank4win&tab=search&type=term' ) );
	$ctd->set("javascript_modal", '<script type="text/javascript">jQuery(document).ready(function(){jQuery("#r4w_box_finish").modal();})</script>');