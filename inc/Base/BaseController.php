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
	public $API_URL = 'https://app.ugmart.ug/api';
	public $pay_email = 'davidwampamba@gmail.com';
	public $pay_password = 'S!tuk@!8';
	public $collection_account = 'davidofug';
	public $account_code ='UGM1545038493';

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/paymartug.php';

/* 		$tempoptions = get_option('widget_widget_paymart')[2];

		if ( !empty( $tempoptions ) ) {
			foreach ( $tempoptions as $key => $option )
				$this->pay_email = $option['pay_email'];
				$this->pay_password = $option['pay_password'];
				$this->collection_account = $option['collection_account'];
		} */

	}

	public function remoteConnect($url,$data) {

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		$dataString = json_encode($data);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Content-Length: ' . strlen($dataString)
		]);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$result = curl_exec($ch);
		curl_close($ch);

		return $result;
	}

	public function getJWTToken() {

		$response = wp_remote_post( $this->API_URL.'/login', 
            array ( 
                'method' => 'POST', 
                'headers' => array( 'timeout' => 3000000,  ), 
                'body' => json_encode(['email' => $this->pay_email, 'password' => $this->pay_password ])
            ) 
		);
		
		if(!is_wp_error($response)) :
			$decodedJSONBody = json_decode( $response['body'], true );
			return $decodedJSONBody['token'];
		endif;

		return false;
	}
}