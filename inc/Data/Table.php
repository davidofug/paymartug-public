<?php
/**
 * 
 * @package kcdd
 */
namespace Inc\Data;

class Table
{
    public $pay_email;

	public $pay_password;

    public $collection_account;
    
    public function __construct() {

        $tempoptions = get_option('widget_widget_paymart')[2];

		if ( !empty( $tempoptions ) ) {
			foreach ( $tempoptions as $key => $option )
			$this->pay_email;
			$this->pay_password;
			$this->collection_account;
		}

        add_action( 'plugins_loaded', array ( $this, 'my_plugin_override' ) );
    }

    public function my_plugin_override() {
        
        if ( false === ( $transactions_results = get_transient( 'transactions_results' ) ) ) {

            $passcode = json_encode( array( 'email' => $this->pay_email, 'password' => $this->pay_password ) );

            $response = wp_remote_post( 'https://app.ugmart.ug/api/login', 
                array ( 
                    'method' => 'POST', 
                    'headers' => array( 'Content-Type' => 'application/json' ), 
                    'body' => $passcode  
                ) 
            );

            if ( is_wp_error( $response ) ) {

                $error_message = $response->get_error_message();
                echo "Something went wrong: $error_message";
                
            } else {

                $rep = json_decode( $response['body'], true );
                $auth = 'Bearer ' . $rep['token'];
        
                $new_response = wp_remote_post( 'https://app.ugmart.ug/api/transactions', 
                    array(
                        'method'   => 'GET',
                        'headers'  => array( 'Content-Type' => 'application/json', 'Authorization' => $auth ),
                        'body'     => $req_body
                    ) 
                );
        
                if ( is_wp_error( $new_response ) ) {

                    $error_message = $new_response->get_error_message();
                    echo "Something went wrong: $error_message";

                } else {

                    $transactions_results = $new_response['body']; // use the content

                    set_transient( 'transactions_results', $transactions_results, 5 * MINUTE_IN_SECONDS );
                }

            }
        }
    }     
}