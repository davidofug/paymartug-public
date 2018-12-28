<?php

/**
 * Plugin settings page to store the needed information for querying the API
 *  
 */

namespace Inc\Admin;
use Inc\Base\BaseController;

class PageSettings extends BaseController
{

    public function register() {
        add_action( 'admin_menu', array ( $this, 'subPageMenu') );
    }

    public function subPageMenu() {
        add_submenu_page( 'paymartug', 'Pay Mart UG Settings', 'Settings', 'manage_options', 'paymartug-settings', [ $this, 'settingsRender' ] );
    }

    public function settingsRender(){
        ?>
        <div class="wrap">
            <div class="paymartug-container postbox">
                <h2 id="result">Pay Mart UG Credential Settings</h2>
                
                <p id="heading-errors"></p>
               
                <form class="form" method="post" action="#">

                    <div class="field">
                        <label for="account_email">Account Email</label>
                        <input type="email" id="account_email" placeholder="Account Email" value="<?php echo get_option('account_email'); ?>" />
                        <p class="instructions">Provide Email address used at UGMART</p>
                        <p class="msg-error"></p>
                    </div>

                    <div class="field">
                        <label for="account_password">Account Password</label>
                        <input type="password" id="account_password" placeholder="Account Password" value="<?php echo $this->customCrypt(get_option('account_password'),''); ?>" />
                        <p class="instructions">Used to login to UGMART</p>
                        <p class="msg-error"></p>
                    </div>

                    <div class="field">
                        <label for="account_code">Account Code</label>
                        <input type="text" name="account_code" id="account_code" placeholder="Account Code" value="<?php echo get_option('account_code'); ?>"/>
                        <p class="instructions">Login to UGMART and pick your account code.</p>
                        <p class="msg-error"></p>
                    </div>
                    <div class="field">
                        <label for="collection_account">Collection Account</label>
                        <input type="text" name="collection_account" id="collection_account" placeholder="Collection Account" value="<?php echo get_option('collection_account'); ?>" />
                        <p class="msg-error"></p>
                    </div>

                    <div class="field">
                        <input id="save-settings" type="submit" class="button button-primary button-large" value="Save" />
                    </div>

                </form>
            </div>

        </div><!--div.wrap-->

        <?php
    }
}