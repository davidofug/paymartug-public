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
	public $ACCOUNT_EMIAL;
	public $ACCOUNT_PASSWORD;
	public $COLLECTION_ACCOUNT;
	public $ACCOUNT_CODE;

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/paymartug.php';

	/* 	$tempoptions = get_option('widget_widget_paymart')[2];

		if ( !empty( $tempoptions ) ) {
			foreach ( $tempoptions as $key => $option )
				$this->pay_email = $option['pay_email'];
				$this->pay_password = $option['pay_password'];
				$this->collection_account = $option['collection_account'];
		} */

	}

	protected function customCrypt( $string, $action = 'e' ) {

		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', 'K7zdju(er`s{Uo7CdF#fX3%aX_S#Rj' );
		$iv = substr( hash( 'sha256', '-1Amq>8?bR?$Vsh$F}l|eidfm_ENzwA.|""MnnUCpQbv3*`rHr0#9<~PRnf_N>]' ), 0, 16 );

		return ( $action == 'e' ) ? base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) ) : openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
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
            [
                'method' => 'POST', 
                'headers' => array( 'timeout' => 3000000,  ), 
                'body' => json_encode(['email' => $this->pay_email, 'password' => $this->pay_password ])
			]
		);
		
		if(!is_wp_error($response)) :
			$decodedJSONBody = json_decode( $response['body'], true );
			return $decodedJSONBody['token'];
		endif;

		return false;
	}

	public function randomString($length = 10) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		$charactersLength = strlen($characters);
		for($i=0;$i<$length;$i++)
			$randomString .= $characters[mt_rand(0,$charactersLength-1)];

		return $randomString;
	}

}