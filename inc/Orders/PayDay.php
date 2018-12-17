<?php
/**
 * 
 * @package kcdd
 */
namespace Inc\Orders;

class PayDay
{
    public function __construct() {

        add_action( 'plugins_loaded', array ( $this, 'my_plugin_override' ) );
    }

    public function my_plugin_override() {
        // Get JWT back from login ping
        $passcode = json_encode( array( 'email' => getenv( 'LOGIN_EMAIL' ), 'password' => getenv( 'LOGIN_PASS' ) ) );
        $response = wp_remote_post( 'https://app.ugmart.ug/api/login', 
            array(
                'method'   => 'POST',
                'headers' => array( 'Content-Type' => 'application/json' ),
                'body' => $passcode
            ) 
        );

        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            echo "Something went wrong: $error_message";
        } else {

            echo 'Response:<pre>';
                print_r( $response );
                echo '</pre>';

        //    // your code here
        //     $url = 'https://app.ugmart.ug/api/request-payment';
    
        //     $response = wp_remote_post( $url, 
        //         array(
        //             'method'   => 'POST',
        //             'headers'  => array(
        //                 'Content-Type' => 'application/json'
        //             ),
        //             'body'     => array(
        //                 'account_code' => 'UGM1544934936',
        //                 'transaction_id' => 'UGM1544934936test',
        //                 'provider_id' => 'mtn_mobile_money',
        //                 'msisdn' => '256782886702',
        //                 'currency' => 'UGX',
        //                 'amount' => 1000,
        //                 'application' => 'Acme',
        //                 'description' => 'Payment Request Test.'
        //             )
        //         ) 
        //     );
    
        //     if ( is_wp_error( $response ) ) {
        //         $error_message = $response->get_error_message();
        //         echo "Something went wrong: $error_message";
        //     } else {
        //         echo 'Response:<pre>';
        //         print_r( $response );
        //         echo '</pre>';
        //     }
        }

         

    }     
}