<?php
/**
 * 
 * @package kcdd
 */
    namespace Inc\Orders;

    class ProcessPayout {
        
        private $apiURL;
        private $userName;
        private $key;

        public function __construct() {
        }
        
        private function Auth(){
            return true;
        }

        private function getBalance() {
            return 10000; //Fake balance
        }

        private function makePayOut() {
            if( $this->Auth() ) :
                //Payment
                return json_encode(['result' => 'successful']);
            endif;
        }

    }

/*     $payout = new Payout([
        'apiURL' => 'https://app.ugmart.ug/api',
        'userName' => 'davidwampamba@gmail.com',
        'key' => 'S!tuk@!8'
    ]); */