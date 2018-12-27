<?php
/**
 * Payout Admin page
 * @package kcdd
 */
namespace Inc\Admin;
use Inc\Orders\ProcessPayout;

    class PagePayout extends ProcessPayout {
        private $ugMartBalance;

        public function __construct() {

            $this->ugMartBalance = $this->getBalance();

            add_action( 'admin_menu', function(){
                add_submenu_page( 'paymartug', 'Payout', 'Payout','manage_options', 'paymartug-payout', [$this,'payoutForm']);
            });

        }

        private function getBalance() {
            return 100000; //Change for actual balance
        }

        public function payoutForm() {
            ?>
            <div class="paymartug-container postbox">
                <p>Current balance: <span class="balance">UGX<?php echo number_format($this->ugMartBalance,2,'.',','); ?>/=</span><a href="#">Refresh</a></p>
                <h2>Send Payment</h2>
                <h4>Provide beneficiary details.</h4>
                <p id="result"></p>
                <p id="heading-errors"></p>
                <?php 
            
                    if ( $this->ugMartBalance ) :
                ?>       
                        <form class="form" method="post" action="#">

                            <div class="field">
                                <input type="text" id="name" placeholder="Name" />
                                <p class="msg-error"></p>
                            </div>

                            <div class="field">
                                <input type="text" id="phone_number" placeholder="Phone number" />
                                <p class="instructions">MTN Uganda/Airtel Uganda Phone numbers allowed. Format 07XXXXXXXX</p>
                                <p class="msg-error"></p>
                            </div>

                            <div class="field">
                                <input type="text" id="amount" placeholder="Amount" />
                                <p class="instructions">Minimum: UGX1,000/=, Maximum: UGX1,000,000/=</p>
                                <p class="msg-error"></p>
                            </div>

                            <div class="field">
                                <textarea id="reason" placeholder="Reason" ></textarea>
                                <p class="instructions">Will appear in the transactions history.</p>
                                <p class="msg-error"></p>
                            </div>
            
                            <!-- <div class="field">
                                <b>Send as</b><br/>
                                <input type="radio" name="send_as"  value="mobile_money" /> Mobile Money <br/>
                                <input type="radio" name="send_as"  value="airtime" /> Airtime <br/>
                                <input type="radio" name="send_as"  value="go_tv" /> Go TV <br/>
                                <input type="radio" name="send_as"  value="yakka" /> Yakka <br/>
                            </div> -->
                            <div class="field right">
                                <input id="payout" type="submit" class="button button-primary button-large" value="Send Now" />
                            </div>

                        </form>
                    </div>
                <?php
                    else:
                    ?>
                        <h3>Available balance: UGX: <?php echo $this->ugMartBalance; ?> is below payout limit.</h3>
                <?php
                    endif;
                    ?>        
            </div><!--div.wrap-->
            <?php
        }
    }