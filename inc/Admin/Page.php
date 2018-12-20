<?php

/**
 * Transactions Admin page
 * @package kcdd
 */
namespace Inc\Admin;

class Page
{

    public function register() {
        add_action( 'admin_menu', array ( $this, 'my_admin_menu') );
    }

    public function my_admin_menu() {
        add_menu_page( 
            'Pay Mart UG Transactions', 
            'PayMart', 
            'manage_options', 
            'paymartug/admin.php', 
            array( $this, 'transactions_tables' ), 
            'dashicons-tickets', 6  );
    }

    public function transactions_tables(){
        ?>
        <div class="wrap">
            <h2>Welcome To My Plugin</h2>
            <?php 
                if ( true === ( $transactions_results = get_transient( 'transactions_results' ) ) ) {
                    return;
                } else {
        
                    $json = json_decode( $transactions_results, true );

                    // echo 'Response:<pre>';
                    // print_r( $json );
                    // echo '</pre>'; 
                        
                    echo '<table id="paymart-table" class="display" style="width:100%">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th>Wallet Name</th>';
                                echo '<th>transaction_id</th>';
                                echo '<th>Payee Number</th>';
                                echo '<th>amount</th>';
                                echo '<th>payment provider</th>';
                                echo '<th>description</th>';
                                echo '<th>status</th>';
                                echo '<th>transaction Date</th>';
                                echo '<th>completed Date</th>';
                            echo '<tr>';
                        echo '<thead>';
                        echo '<tbody>';
                            foreach ($json['data'] as $key => $value) {

                                echo '<tr>';
                                    echo '<td>' . $value['application'] . '</td>';
                                    echo '<td>' . $value['transaction_id'] . '</td>';
                                    echo '<td>' . $value['msisdn'] . '</td>';
                                    echo '<td>' . $value['currency'] . ' ' .$value['amount'] . '</td>';
                                    echo '<td>' . $value['payment_provider']['name'] . '</td>';
                                    echo '<td>' . $value['description'] . '</td>';
                                    echo '<td><span>' . $value['status'] . '<span></td>';
                                    echo '<td>' . date('Y-m-d h:i:s', strtotime($value['transaction_date'])) . '</td>';
                                    echo '<td>' . date('Y-m-d h:i:s', strtotime($value['completed_on'])) . '</td>';
                                echo '<tr>';
                            }
                        echo '</tbody>';
                    echo '</table>';
                }
            ?>

        </div><!--div.wrap-->

        <?php
    }
}