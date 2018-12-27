<?php
/*
Plugin Name: Pay Mart UG
Plugin URI: http://paymartug.com
Description: WordPress plugin will enable you process payments from both momo and visa cards.
Version: 0.1.0
Author: paymartug
Author URI: http://paymartug.com
License: GPLv2 or later
Text Domain: paymartug
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Cheating? Huh!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activatePaymartPlugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activatePaymartPlugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivatePaymartPlugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivatePaymartPlugin' );

/**
 * Initialize all the core classes
 */
if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}			