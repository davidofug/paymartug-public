<?php
/**
 * 
 * @package kcdd
 */
namespace Inc\Orders;

class RequestPayment
{

    public function __construct() {

        // add_action( 'plugins_loaded', array ( $this, 'my_plugin_override' ) );

    }

    public function my_plugin_override() {
        
        date_default_timezone_set("Africa/Kampala"); 

        // Get JWT back from login ping
        $passcode = json_encode( array( 'email' => LOGIN_EMAIL, 'password' => LOGIN_PASS ) );

        $response = wp_remote_post( LOGIN_URL, 
            array ( 
                'method' => 'POST', 
                'headers' => array( 'Content-Type' => 'application/json', 'timeout' => 3000000,  ), 
                'body' => $passcode  
            ) 
        );

        if ( is_wp_error( $response ) ) {

            $error_message = $response->get_error_message();
            echo "Something went wrong: $error_message";
            
        } else {

            $rep = json_decode( $response['body'], true );
            $auth = 'Bearer ' . $rep['token'];

            $transaction_id = time();

            $req_body = json_encode( 
                array ( 
                    'account_code' => account_code,
                    'transaction_id' => $transaction_id,
                    'provider_id' => 'mtn_mobile_money', //mtn_mobile_money, visa_mastercard, airtel_money
                    'msisdn' => msisdn,
                    'currency' => 'UGX',
                    'amount' => 1500,
                    'application' => 'laurence',
                    'description' => 'Payment Request Test.'
                ) 
            );
    
            $new_response = wp_remote_post( PAY_URL, 
                array(
                    'method'   => 'POST',
                    'headers'  => array( 'Content-Type' => 'application/json', 'timeout' => 3000000, 'Authorization' => $auth ),
                    'body'     => $req_body
                ) 
            );
    
            if ( is_wp_error( $new_response ) ) {
                $error_message = $new_response->get_error_message();
                echo "Something went wrong: $error_message";
            } else {

               dd( $new_response );

            }
        }
    }     
}