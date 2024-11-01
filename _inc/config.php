<?php
	/**
	 * Définie l'application
	 */
		define("wpw_plugin_name", basename(dirname(__DIR__)));
		define("wpw_plugin_url", plugins_url(basename(dirname(__DIR__)).'/'));
		define("wpw_plugin_base", dirname(__DIR__));
		define("wpw_plugin_file", dirname(__DIR__).'/'.basename(dirname(__DIR__)).'.php');
		define("wpw_plugin_folder", dirname(__DIR__));

	/**
	 * Base de donnée
	 */
		define("wpw_bdd_table_app", "wp_writup"); 