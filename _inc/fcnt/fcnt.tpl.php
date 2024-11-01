<?php 
    if ( ! function_exists( 'wpw_tpl' ) ) {
		/**
		 * Récupération automatique des élements du template
		 */
			function wpw_tpl($tpl_data){
				$wpw_folder = $tpl_data["folder"];
				
				$ctd = new wpw_template(wpw_plugin_folder."/tpl/".$wpw_folder."/contained.tpl");

				/**
				 * Charge le scripts
				 */ 
				if(file_exists(wpw_plugin_folder."/tpl/".$wpw_folder."/_root.php")){
					require wpw_plugin_folder."/tpl/".$wpw_folder."/_root.php";
				}

				return $ctd->output();
			}
	}