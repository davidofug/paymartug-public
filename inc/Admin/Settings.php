<?php

/**
 * Plugin settings page to store the needed information for querying the API
 *  
 */

namespace Inc\Admin;

class Settings
{

    public function register() {
        add_action( 'admin_menu', array ( $this, 'subPageMenu') );
    }

    public function subPageMenu() {
        add_submenu_page( 'paymartug', 'Credential Settings', 'Credential Settings', 'manage_options', 'paymartug-settings', [ $this, 'storeCredentials' ] );
    }

    public function storeCredentials(){
        ?>
        <div class="wrap">
            <div class="paymartug-container postbox">
                <h2>Pay Mart UG Credential Settings</h2>
                
                <p id="heading-errors"></p>
               
                <form class="form" method="post" action="#">

                    <div class="field">
                        <label for="account_email">Account Email</label>
                        <input type="email" id="account_email" placeholder="Name" />
                        <p class="instructions">MTN Uganda/Airtel Uganda Passwords allowed. Format 2567XXXXXXXX</p>
                        <p class="msg-error"></p>
                    </div>

                    <div class="field">
                        <label for="account_password">Account Password</label>
                        <input type="password" id="account_password" placeholder="Password" />
                        <p class="msg-error"></p>
                    </div>

                    <div class="field">
                        <label for="account_code">Collection Account</label>
                        <input type="text" name="account_code" id="account_code" placeholder="Collection Account" />
                        <p class="instructions">Will appear in the transactions history.</p>
                        <p class="msg-error"></p>
                    </div>

                    <div class="field">
                        <input id="payout" type="submit" class="button button-primary button-large" value="Pay Now" />
                    </div>

                </form>
            </div>

        </div><!--div.wrap-->

        <?php
    }
}