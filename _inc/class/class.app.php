<?php

	/**
	 * Verification de santé du plugin
	 */
		function wpw_health_check(){
			global $wpdb;
			// Verifie que les base de donnés existe
			$find_database = false;

			$wp_table_app = $wpdb->prefix.wpw_bdd_table_app;
		    if($wpdb->get_var("show tables like '{$wp_table_app}'") == $wp_table_app) 
		    {        
		    	$find_database = true;
		    }
		    if($find_database){
		    	wpw_delect_base();
		    }

		    // Désactive WP Writup si Rank4Win est activé
		    wpw_disabled_ext();

		}
		add_filter( 'init', 'wpw_health_check' );

		/**
		 * Nettoyage de la base de donnée
		 */
		function wpw_delect_base(){
			global $wpdb;
			$wp_table_app = $wpdb->prefix.wpw_bdd_table_app;
		    $req_sql = "DROP TABLE IF EXISTS " . $wp_table_app. ";";
		    $wpdb->query($req_sql);
		}

		/**
		 * Permet de rechercher et de désactiver certaine extention 
		 */
		function wpw_disabled_ext(){
			$active_plugins = get_option('active_plugins');
			// Ext : WP Writup
			$search_rank4win = array_search('rank4win/rank4win.php',$active_plugins);
			if($search_rank4win OR $search_rank4win === 0){
				$wpw_id = array_search('wp-writup/wpwritup.php',$active_plugins);
				unset($active_plugins[$wpw_id]);
				update_option('active_plugins',$active_plugins);
			}
		}
	/**
	 * Chargement des fichiers langue
	 */
		function wpw_load_textdomain() {
		  load_plugin_textdomain( 'app_wpwritup', false, wpw_plugin_name. '/languages' ); 
		}
		add_action( 'init', 'wpw_load_textdomain' );

	/**
	 * Récupération des scripts, fonctions, librairies est feuilles de styles
	 */
		function wpw_hook_enqueue( $hook ) {		
			/**
			 * Charge les librairies javascript
			 */
			foreach (glob(wpw_plugin_folder."/assets/js/lib/lib.*.js") as $file_name) {
			    if (is_file($file_name)) {
			    	if(stripos(strtolower(basename($file_name)),'jquery') !== false){
			        	wp_enqueue_script( md5(basename($file_name)), wpw_plugin_url .'assets/js/lib/'. basename($file_name), array( 'jquery' ), md5("1.2.0"), true );
			        }else{
			        	wp_enqueue_script( md5(basename($file_name)), wpw_plugin_url .'assets/js/lib/'. basename($file_name), array(), md5("1.2.0"), true );
			        }
			    }
			}

			/**
			 * Charge les functions javascript
			 */
			foreach (glob(wpw_plugin_folder."/assets/js/fcnt/fcnt.*.js") as $file_name) {
			    if (is_file($file_name)) {
			    	if(stripos(strtolower(basename($file_name)),'jquery') !== false){
			    		$exp_file_name = explode('.js', basename($file_name));
			    		$wpw_file_name = str_replace('.', '_', $exp_file_name[0]);
						$wpw_translation_javascript = wpw_fcnt_locale($wpw_file_name);

					    wp_register_script( md5(basename($file_name)), wpw_plugin_url .'assets/js/fcnt/'. basename($file_name),array( 'jquery' ), '1.0.0', true);
					    wp_localize_script( md5(basename($file_name)), 'localize_'.$wpw_file_name, $wpw_translation_javascript);
					    wp_enqueue_script( md5(basename($file_name)) );
			       	}else{
			    		$exp_file_name = explode('.js', basename($file_name));
			    		$wpw_file_name = str_replace('.', '_', $exp_file_name[0]);
						$wpw_translation_javascript = wpw_fcnt_locale($wpw_file_name);

					    wp_register_script( md5(basename($file_name)), wpw_plugin_url .'assets/js/fcnt/'. basename($file_name));
					    wp_localize_script( md5(basename($file_name)), 'localize_'.$wpw_file_name, $wpw_translation_javascript);
					    wp_enqueue_script( md5(basename($file_name)) );
			       	}
			    }
			}

			/**
			 * Charge les librairies stylesheet
			 */
			foreach (glob(wpw_plugin_folder."/assets/css/lib/lib.*.css") as $file_name) {
			    if (is_file($file_name)) {
			    	 wp_enqueue_style( md5(basename($file_name)), wpw_plugin_url .'assets/css/lib/'. basename($file_name), array(), md5("1.2.0"));
			    }
			}

			/**
			 * Ajoute les stylesheet indispensable
		 	 */
		    $files_name = [
		        'stylesheet.css'
		    ];
		    foreach ($files_name as $file_name) {
		        wp_enqueue_style( md5(basename($file_name)), wpw_plugin_url .'assets/css/'. basename($file_name),array(), md5("1.2.0"));
		    }

		    $glob_tpl = glob(wpw_plugin_folder."/tpl/*/style.css");

			/**
			 * Charge le stylesheet des templates
			 */ 
		    foreach ($glob_tpl as $wpw_folder) {
		    	preg_match('#tpl/(.*?)/style.css#', $wpw_folder, $matches);
				wp_enqueue_style( md5($wpw_folder.'/style.css'), wpw_plugin_url .'tpl/'.$matches[1].'/style.css', array(), md5("1.2.0"));
		    }
		}
		add_action( 'admin_enqueue_scripts', 'wpw_hook_enqueue' );

	/**
	 * Box Keywords
	 */
		function wpw_box_finish(){
			add_meta_box(
			    'f60ee7b9-86a6-467e-a050-8bdb32a592f5',
			    'WP Writup',
				function() { wpw_callback("box_finish"); },          
			    'post',
			    'side',
			    'high'
			);
			add_meta_box(
			    'f60ee7b9-86a6-467e-a050-8bdb32a592f5',
			    'WP Writup',
				function() { wpw_callback("box_finish"); },          
			    'page',
			    'side',
			    'high'
			);
		}
		add_action( 'add_meta_boxes', 'wpw_box_finish');

	/**
	 * Récupère le template de la page
	 */
		function wpw_callback($a) {
			$arr = [
				"folder" => $a
			];
			echo wpw_tpl($arr);
		}
