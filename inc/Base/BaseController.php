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
	public $API_URL = 'https://app.ugmart.ug/api/';

	public $pay_email;
	public $pay_password;
	public $collection_account;

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/paymartug.php';

		$tempoptions = get_option('widget_widget_paymart')[2];

		if ( !empty( $tempoptions ) ) {
			foreach ( $tempoptions as $key => $option )
				$this->pay_email = $option['pay_email'];
				$this->pay_password = $option['pay_password'];
				$this->collection_account = $option['collection_account'];
		}
	}

	public function getJWTToken() {
		$authDetails = json_encode( ['email' => $this->pay_email, 'password' => $this->pay_password ] );

        $response = wp_remote_post( $this->API_URL, 
            array ( 
                'method' => 'POST', 
                'headers' => array( 'Content-Type' => 'application/json', 'timeout' => 3000000,  ), 
                'body' => $authDetails  
            ) 
		);
		
		if(!is_wp_error($response)) :
			$decodedJSONBody = json_decode( $response['body'], true );
			return $decodedJSONBody['token'];
		endif;

		return false;
	}
}