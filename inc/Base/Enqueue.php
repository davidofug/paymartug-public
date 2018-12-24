<?php 
/**
 * @package kcdd
 */
namespace Inc\Base;

use \Inc\Base\BaseController;

/**
* 
*/
class Enqueue extends BaseController
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}
	
	function enqueue() {
		wp_enqueue_style( 'paymartug-table', $this->plugin_url . 'assets/css/tables.css' );
		wp_enqueue_style( 'paymartug-style', $this->plugin_url . 'assets/css/paymartug-style.css' );

		wp_enqueue_script( 'pay-table', $this->plugin_url . 'assets/js/tables.js', array( 'jquery' ), true  );
		wp_enqueue_script( 'pay-script', $this->plugin_url . 'assets/js/paymartug.plugin.js', array( 'jquery', 'pay-table' ), true );
	}
}