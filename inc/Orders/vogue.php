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
        // your code here
        $url = 'https://app.ugmart.ug/api/request-payment';

        $response = wp_remote_post( $url, array(
            'body'    => $data,
            'headers' => array(
                'Content-Type: application/json',
                'Authorization' => 'Basic ' . base64_encode( $username . ':' . $password ),
            ),
            'body'        => array(
                'account_code' => 'UGM1544934936',
                'transaction_id' => 'UGM1544934936test',
                'provider_id' => 'mtn_mobile_money',
                'msisdn' => '256782886702',
                'currency' => 'UGX',
                'amount' => 1000,
                'application' => 'Acme',
                'description' => 'Payment Request Test.'
            ),
        ) );

        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            echo "Something went wrong: $error_message";
        } else {
            echo 'Response:<pre>';
            print_r( $response );
            echo '</pre>';
        }
    }     
}