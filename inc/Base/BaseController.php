<?php 
/**
 * @package kcdd
 */
namespace Inc\Base;

class BaseController
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	// public $pay_email;

	// public $pay_password;

	// public $collection_account;

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/paymartug.php';

		// $tempoptions = get_option('widget_widget_paymart')[2];

		// if ( !empty( $tempoptions ) ) {
		// 	foreach ( $tempoptions as $key => $option )
		// 	$this->pay_email;
		// 	$this->pay_password;
		// 	$this->collection_account;
		// }
	}
}