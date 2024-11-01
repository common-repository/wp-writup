<?php 
	if ( ! function_exists( 'wpw_assets_svg_code' ) ) {
		/**
		 * Permet de récuperer le contenu d'un fichier svg
		 */
		function wpw_assets_svg_code($a){
			return file_get_contents(wpw_plugin_folder.'/assets/svg/'.$a.'.svg');
		}
	}