<?php
namespace Inc\Base;
use Inc\Base\BaseController;

class Settings extends BaseController {

    public function register() {
        $this->retrieveSettings();
        add_action('wp_ajax_settings',[$this,'saveSettings']);
        add_action('admin_footer',[$this,'handleSettingsAjax']);
    }
    
    public function saveSettings() {
        
        if(isset($_POST)) :
            $data = $_POST;

            $account_email = sanitize_text_field($data['account_email']);
            if (isset($account_email) AND !empty($account_email))
                !empty( get_option('account_email') ) ? update_option('account_email', $account_email) : add_option('account_email', $account_email);

            $account_password = sanitize_text_field($data['account_password']);
            if (isset($account_password) AND !empty($account_password))
                !empty( get_option('account_password') ) ? update_option('account_password', $this->customCrypt($account_password,'e')) : update_option('account_password', $this->customCrypt($account_password,'e'));

            $account_code = sanitize_text_field($data['account_code']);
            if(isset($account_code) AND !empty($account_code))
                !empty( get_option('account_code') ) ? update_option('account_code', $account_code) : add_option('account_code', $account_code);

            $collection_account= sanitize_text_field($data['collection_account']);
            if(isset($collection_account) AND !empty($collection_account))
                !empty( get_option('collection_account') ) ? update_option('collection_account', $collection_account)  : add_option('collection_account', $collection_account ) ;
            
            echo json_encode(array('result' => 'successful'));
        else:
            echo json_encode(array('result' => 'error'));
        endif;

        wp_die();
    }

    private function retrieveSettings() {
        $this->ACCOUNT_EMAIL = get_option('account_email');
        $this->ACCOUNT_PASSWORD = $this->customCrypt( get_option('account_password'),'d' );
        $this->ACCOUNT_CODE = get_option('account_code');
        $this->COLLECTION_ACCOUNT = get_option('collection_account');
    }

    public function handleSettingsAjax(){
?>
    <script type="text/javascript" >

        jQuery(document).ready(function($) {
            let fields_settings = ['#account_email','#account_code','#account_password','#collection_account']
            let errors = 0
            //Check empty on fields blur
            fields_settings.forEach(field => {
                $(field).on('blur', () => {
                    if($(field).val() == '' ) {
                        errors++
                        $(field).addClass('has-error')
                        $('<p class="msg-error">Required!</p>').insertAfter(field)
                    }else{
                        errors--
                        $(field).removeClass('has-error')
                        $(field).closest('.msg-error').remove()
                    }
                })
            })
            $('#save-settings').on('click', e => {
                e.preventDefault()
                //Check empty on submit
                fields_settings.forEach( field => {
                if($(field).val() == '' || typeof $(field).val() == 'undefined') {
                    $(field).addClass('has-error')
                    errors++
                    $('<p class="msg-error">Required!</p>').insertAfter(field)
                } else {
                    $(field).removeClass('has-error')
                //$(field).sibling('.msg-error').text('')
                    errors--
                } 
                })

                if( errors <= 0 ) 
                    saveSettings()
            })
        })

        let saveSettings = () => {

            let formData = new FormData()
            formData.append('action','settings')
            formData.append('account_email',jQuery('#account_email').val())
            formData.append('account_password',jQuery('#account_password').val())
            formData.append('account_code',jQuery('#account_code').val())
            formData.append('collection_account',jQuery('#collection_account').val())
            
            fetch(ajaxurl,{
                method:'POST',
                body:formData,
            }).then( res => res.json()).then( data => {
                if( data.result == 'successful' )
                    jQuery('#result').addClass('msg-success').text( 'Settings saved' )
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