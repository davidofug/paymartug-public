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
		// enqueue all our scripts
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/css/tables.css' );
		wp_enqueue_style( 'mypluginstyle', $this->plugin_url . 'assets/css/mystyle.css' );

		wp_enqueue_script( 'pay-table', $this->plugin_url . 'assets/js/tables.js', array( 'jquery' ), true  );
		wp_enqueue_script( 'pay-script', $this->plugin_url . 'assets/js/myscript.js', array( 'jquery', 'pay-table' ), true );
	}
}