<?php
/**
 * 
 * @package kcdd
 */
namespace Inc\Data;

use Inc\Base\BaseController;

class Table
{

    public function __construct() {

        add_action( 'plugins_loaded', array ( $this, 'my_plugin_override' ) );
    }

    public function my_plugin_override() {
        
        if ( false === ( $transactions_results = get_transient( 'transactions_results' ) ) ) {

            $passcode = json_encode( array( 'email' => 'laurencebahiirwa@gmail.com', 'password' => 'Kampala123' ) );

            $response = wp_remote_post( $this->LOGIN_URL, 
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