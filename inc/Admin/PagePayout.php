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
        }

        public function register() {
            add_action( 'admin_menu', array ( $this, 'sub_admin_menu') );
        }
    
        public function sub_admin_menu() {
            add_submenu_page( 'paymartug', 'Pay Out', 'Pay Out', 'manage_options', 'paymartug-payout', [ $this, 'payoutForm' ] );
        }


        private function getBalance() {
            return 100000; //Change for actual balance
        }

        public function payoutForm() {
            ?>
            <div class="paymartug-container postbox">
                <h2>Send Payment</h2>
                <p>Current balance: <span class="balance">UGX <?php echo number_format($this->ugMartBalance,2,'.',','); ?>/=</span> <a href="#">Refresh</a></p>
                <h4>To begin the process, please provide beneficiary details.</h4>
                <p id="heading-errors"></p>
                <?php 
            
                    if ( $this->ugMartBalance ) :
                ?>       
                        <form class="form" method="post" action="#">

                            <div class="field">
                                <label for="name">Beneficiary's Name</label>
                                <input type="text" id="name" placeholder="Name" />
                                <p class="msg-error"></p>
                            </div>

                            <div class="field">
                                <label for="phone_number">Phone Number</label>
                                <input type="telephone" id="phone_number" placeholder="Phone number" />
                                <p class="instructions">MTN Uganda/Airtel Uganda Phone numbers allowed. Format 2567XXXXXXXX</p>
                                <p class="msg-error"></p>
                            </div>

                            <div class="field">
                                <label for="amount">Amount to Send</label>
                                <input type="number" id="amount" placeholder="Amount" />
                                <p class="instructions">Minimum: UGX 1,000/=, Maximum: UGX 1,000,000/=</p>
                                <p class="msg-error"></p>
                            </div>

                            <div class="field">
                                <label for="reason">Reason for sending</label>
                                <input type="text" name="reason" id="reason" placeholder="Reason" ></textarea>
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
                            <div class="field">
                                <input id="payout" type="submit" class="button button-primary button-large" value="Pay Now" />
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