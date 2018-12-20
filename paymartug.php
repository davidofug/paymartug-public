<?php
/**
 * @package kcdd
 */
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

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Cheating? Huh!' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
	$dotenv = new Dotenv\Dotenv( dirname( __DIR__ ) . '/paymartug/' );
	$dotenv->load();
}

define( 'LOGIN_URL', getenv( LOGIN_URL ) );
define( 'LOGIN_EMAIL', getenv( LOGIN_EMAIL ) );
define( 'LOGIN_PASS', getenv( LOGIN_PASS ) );
define( 'PAY_URL', getenv( PAY_URL ) );
define( 'account_code', getenv( account_code ) );
define( 'msisdn', getenv( msisdn ) );

/**
 * The code that runs during plugin activation
 */
function activate_kcdd_plugin() {
	Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_kcdd_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_kcdd_plugin() {
	Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_kcdd_plugin' );


/**
 * Initialize all the core classes of the plugin if WooCommerce Exists
 */
// if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	if ( class_exists( 'Inc\\Init' ) ) {
		Inc\Init::register_services();
	}			
//} 
/**
 * Admin Notice to require WooCommerce Install
 */
// else {

// 	function my_error_notice() {
//		<div class="error notice">
// 			<p><?php _e( 'Please Install WooCommerce before activating this plugin.', 'kcdd' ); </p>
// 		</div>
// 	}

// 	add_action( 'admin_notices', 'my_error_notice' );
// }