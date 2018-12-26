<?php
/**
 * 
 * @package kcdd
 */
    namespace Inc\Orders;
    use Inc\Base\BaseController;

    class ProcessPayout extends BaseController {
        public function __construct() {
            add_action('wp_ajax_payout',[$this,'sendPayment']);
            add_action('admin_footer',[$this,'handleAjax']);
        }
        
        private function Auth(){
            return true;
        }

        private function getBalance() {
            return 10000; //Fake balance
        }

        public function sendPayment() {
             if( $this->Auth() ) :
                if(isset($_POST)) :
                    $data = (object) $_POST;
                    if($data->action == 'payout') :

                        $name = sanitize_text_field($data->name);
                        $phone = sanitize_text_field($data->phone);
                        $amount = sanitize_text_field($data->amount);
                        $reason = sanitize_text_field($data->reason);

                        if(!empty($name) AND !empty($phone) AND !empty($amount)):
                            if($amount >= 1000 AND $amount <= 1000000 ):
                                //Insert post
                                //Send to API
                                echo json_encode(['result' => 'successful']);
                            else:
                                echo json_encode([
                                    'result' => 'error',
                                    'msg' => 'UGX'. $amount . ' is '.(($amount < 1000 ) ? 'below limit.':'above limit').' Note: UGX1,000 - UGX1,000,000'
                                ]);
                            endif;
                        else:
                            echo json_encode([
                                'result' => 'error',
                                'msg' => 'Make sure all required fields and not empty!'
                            ]);  
                        endif;
                            
                    else:
                        echo json_encode([
                            'result' => 'error',
                            'msg' => 'No Action specified!'
                        ]); 
                    endif;
                else:
                    echo json_encode([
                        'result' => 'error',
                        'msg' => 'Nothing submitted!'
                    ]);  
                endif;
            else:
                echo json_encode([
                    'result' => 'error',
                    'msg' => 'Wrong Key'
                ]);
            endif;

            wp_die();
        }

        public function handleAjax(){ ?>
	        <script type="text/javascript" >
                let sendPayment = () => {
                    let data = {
                        'action': 'payout',
                        'name': jQuery('#name').val(),
                        'phone': jQuery('#phone_number').val(),
                        'amount': jQuery('#amount').val(),
                        'reason': jQuery('#reason').val()
                    }

                    jQuery.post(ajaxurl, data, function(response) {
                        console.log('Got this from the server: ' + response)
                        console.log('Name: ', jQuery('#name').val())
                    })
                }
            </script>
        <?php
        }
    }