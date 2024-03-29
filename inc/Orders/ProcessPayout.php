<?php
/**
 * 
 * @package kcdd
 */
namespace Inc\Orders;
use Inc\Base\BaseController;

class ProcessPayout extends BaseController {
    
    public function register() {
        add_action('wp_ajax_payout',[$this,'sendPayment']);
        add_action('admin_footer',[$this,'handlePayoutAjax']);
    }

    private function getBalance() {
        return 10000; //Fake balance
    }

    public function sendPayment() {
        $token = $this->getJWTToken();
            if( !$token AND !empty($token)) :
            $auth = 'Bearer '.$token;
            if(isset($_POST)) :
                $data = (object) $_POST;
                
                if($data->action == 'payout') :

                    $name = sanitize_text_field($data->name);
                    $phone = sanitize_text_field($data->phone);
                    $amount = sanitize_text_field($data->amount);
                    $reason = sanitize_text_field($data->reason);

                    if(!empty($name) AND !empty($phone) AND !empty($amount)):
                        if($amount >= 1000 AND $amount <= 1000000 ):
                            $id = wp_post_insert([
                                'title' => $this->randomString(8),
                                'post_type' => 'paymart-transaction',
                                'post_status' => 'publish'
                            ]);

                            if($id) :
                                update_post_meta($id,'name',$name);
                                update_post_meta($id,'phone',$phone);
                                update_post_meta($id,'amount',$amount);
                                update_post_meta($id,'reason',!empty($reason) ? $reason : 'Payout, UGX'.$amount.' to: '.$name);

                                $response = wp_remote_post($this->API_URL.'/payout', 
                                    [ 
                                        'method' => 'POST', 
                                        'headers' => ['timeout' => 3000000,'Authorization' => $auth], 
                                        'body' => json_encode([
                                            'account_code' => $this->ACCOUNT_CODE,
                                            'transaction_id' => time(),
                                            'msisdn' => strpos($phone,'256') ? $phone : '256'+$phone,
                                            'currency'=>'UGX',
                                            'amount' => $amount,
                                            'application' => 'Acme',
                                            'description' => !empty($reason) ? $reason : 'Payout, UGX'.$amount.' to: '.$name,
                                            'recipient_name' => $name
                                        ])
                                    ]
                                );

                                if(!is_wp_error($response)) :
                                    echo json_encode([
                                        'result' => 'successful',
                                    ]);
                                else:
                                    echo json_encode([
                                        'result' => 'error',
                                        'msg' => $response->get_error_message()
                                    ]);

                                endif;

                            else:
                                echo json_encode([
                                    'result' => 'error',
                                    'msg' => 'Technical error: Post can\'t be created'
                                ]);
                            endif;
                            
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
                'msg' => 'Missing key'
            ]);
        endif;

        wp_die();
    }

    public function handlePayoutAjax(){ ?>
        <script type="text/javascript" >
            let sendPayment = () => {

                let formData = new FormData()
                formData.append('action','payout')
                formData.append('name',jQuery('#name').val())
                formData.append('phone',jQuery('#phone_number').val())
                formData.append('amount',jQuery('#amount').val())
                formData.append('reason',jQuery('#reason').val())
                
                fetch(ajaxurl,{
                    method:'POST',
                    body:formData

                }).then( res => res,json() ).then( data => {

                    if( data.result == 'successful' )
                        jQuery('#result').text( 'Payment made successfully' )
                    else
                        console.log( data.msg )

                }).catch( error => {
                    console.log(error)
                })

            }
        </script>
    <?php
    }
}