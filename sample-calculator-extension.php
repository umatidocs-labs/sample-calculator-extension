<?php

/*
Plugin Name: sample calculator
Plugin URI:
Description: A sample calculator for simplelender wordpress plugin.
Author: 
Version: 1.0.00
Author URI:
*/

/*
*   Customize the array below to fit you calculators' name
*
*   $sl_init['affiliate_link'] -> get your  affiiate link  from simplelender plugin menu on your wordpress website(simplender wordpress plugin needs to be activated)
*   $sl_init['custom_admin_filter'] -> this is a custom filter that will be called when toyr calculator is selected on loan products settings
*   $sl_init['calculator_admin_title'] -> The name to be displayed on product settings on simplelender plugin
*
*/

$sl_init=array(
    'affiliate_link'=>'https://wordpress.org/plugins/simplelender-by-umatidocs-com/',
    'custom_admin_filter'=>'custom_admin_filter',
    'calculator_admin_title'=>'calculator_admin_title',
);


/*  
*   [nothing needs to do here] add affiliate link to earn money
*
*/
function simplelender_plugin_active( $plugin ) {
    return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}

function simplelender_child_plugin_activate(){
    if ( ! simplelender_plugin_active("simplelender-by-umatidocs-com/simplelender-by-umatidocs-com.php") ){
        wp_die('This plugin requires <a href="'.$sl_init['affiliate_link'].'"> simplelender wordpress plugin</a>  to be installed and active.');
    }
}

register_activation_hook( __FILE__, 'simplelender_child_plugin_activate' );
register_deactivation_hook( __FILE__, 'simplelender_child_plugin_activate' );
if (function_exists('simplelender_calculator_connector')) {
    simplelender_calculator_connector($sl_init);
}

/*
*   1.) Customize function sample_return_calculator_htlm() to return your calculator html
*   2.) Change the bunction name sample_return_calculator_htlmI() to on filter and on function name to avoid same name conflicts
*
*/


add_filter($sl_init['custom_admin_filter'],'sample_return_calculator_htlm');

function sample_return_calculator_htlm($product_id=''){
    /*
    *   Get objet with loan productdetails e.g.
    *   $object->name
    *   $object->period_unit  d/w/m/y
    *   $object->interest_rate ->fixed if period_unit is daily or weekly ->on reducing(monthly) balance if period_unit monthly or yaerly
    *   $object->currency 
    *   $object->max_amount
    *
    */

    $object = apply_filters('sl_get_loan_product',$product_id);

    /*
    *
    *   Add the following IDs into the html feilds and it will be picked by simplelender to complete the loan application the IDs are for;
    *   the loan amount being applyed for, 
    *   term of the loan(in this format 2d, 2w, 2m, 2y representing  days, weeks, months, years respectively)
    *   the spending goal e.g. car, home, etc.
    *
    */
    $sl_html_amount_id='sl_loan_app_amount_'.$product_id;
    $sl_html_amount_terms='sl_loan_app_period_'.$product_id;
    $sl_html_spending_goal_id='sl_loan_app_goal_'.$product_id;
    $sl_loan_name=$object->name;
    $sl_currency=$object->currency;

      
    $calculator_html = '';
     /*
     *  Replace this function with your function that will return a html of your loan calculator, use the Html IDs above.
     *  $calculator_html = function_to_be_replaced();
     *
     */

     return $calculator_html;
}