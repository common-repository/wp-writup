<?php
/*
 * Plugin Name:  WP Writup
 * Plugin URI:   https://wp-writup.fr
 * Description:  WP Writup becomes rank4win, powerful, with new tools. Available in the plugins library, we invite you to download it. When rank4win is activated this plugin is automatically disabled.
 * Version:      1.2.0
 * Author:       WP Writup
 * Author URI:   https://wp-writup.fr
 * Text Domain:  app_wpwritup
 * Domain Path:  /languages/
*/

    /**
     *  Quitter si on y accède directement
     */
        if ( ! defined( 'ABSPATH' ) ) {
            exit;
        }

    /**
     * Récupération des constante définit
     */
        require_once("_inc/config.php");

    /**
     * Récupération automatique des fonctions
     */
        foreach (glob( dirname(__FILE__)."/_inc/fcnt/fcnt.*.php") as $require_file) {
            if (is_file($require_file)) {
                require_once($require_file);
            }
        }

    /**
     * Récupération automatique des class
     */
        foreach (glob( dirname(__FILE__)."/_inc/class/class.*.php") as $require_file) {
            if (is_file($require_file)) {
                require_once($require_file);
            }
        }