<?php

/*
Plugin Name: WooCommerce myghpay Payment Gateway
Plugin URI: https://wordpress.org/plugins/woo-myghpay-payment-gateway/
Description: myghpay Payment gateway for woocommerce
Version: 1.7
Author: Emmanuel Adu-Asare
Author URI: http://adu-asare.browsegh.com
*/


add_action('plugins_loaded', 'woocommerce_myghpay_client_init', 0);

function woocommerce_myghpay_client_init(){
	
  if(!class_exists('WC_Payment_Gateway')) return;

  class WC_myghpay_client extends WC_Payment_Gateway{
      
    public function __construct(){
      $this -> id = 'myghpay';
	  $this -> icon = 'http://adu-asare.browsegh.com/paymentgt.png';
      $this -> medthod_title = 'myghpay Client Integration';
      $this -> has_fields = false;

      $this -> init_form_fields();
      $this -> init_settings();

      $this -> title = $this -> settings['title'];
      $this -> description = $this -> settings['description'];
      $this -> clientid = $this -> settings['clientid'];
      $this -> clientsecret = $this -> settings['clientsecret'];
      $this -> redirect_page_id = $this -> settings['redirect_page_id'];
      $this -> baseurl = $this -> settings['baseurl'];
      $this -> shopname = $this -> settings['shopname'];
      $this -> securehash = $this -> settings['securehash'];


      $this -> msg['message'] = "";
      $this -> msg['class'] = "";
      
      
      

      add_action('init', array(&$this, 'check_myghpay_response'));
      if ( version_compare( WOOCOMMERCE_VERSION, '2.0.0', '>=' ) ) {
                add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( &$this, 'process_admin_options' ) );
             } else {
                add_action( 'woocommerce_update_options_payment_gateways', array( &$this, 'process_admin_options' ) );
            }
      add_action('woocommerce_receipt_myghpay', array(&$this, 'receipt_page'));
   }
   
   
    function init_form_fields(){

       $this -> form_fields = array(
                'enabled' => array(
                    'title' => __('Enable/Disable', 'client'),
                    'type' => 'checkbox',
                    'label' => __('Enable myghpay Payment Module.', 'client'),
                    'default' => 'no'),
                'title' => array(
                    'title' => __('Title:', 'client'),
                    'type'=> 'text',
                    'description' => __('This controls the title which the user sees during checkout.', 'client'),
                    'default' => __('myghpay', 'client')),
                'description' => array(
                    'title' => __('Description:', 'client'),
                    'type' => 'textarea',
                    'description' => __('This controls the description which the user sees during checkout.', 'client'),
                    'default' => __('Pay securely by Credit , Debit card, GTBank Account or Mobile Money through myghpay Secure Servers.', 'client')),
				'baseurl' => array(
                    'title' => __('Base URL:', 'client'),
                    'type' => 'text',
                    'description' => __('The base url for myghpay client payment. Test URL: https://196.216.228.28/myghpayclient/
', 'client'),
                    'default' => __('https://myghpay.com/myghpayclient/', 'client')),
                
                'clientid' => array(
                    'title' => __('Client ID', 'client'),
                    'type' => 'text',
                    'description' => __('Given to Merchant by myghpay."')),
                'clientsecret' => array(
                    'title' => __('Client Secret', 'client'),
                    'type' => 'text',
                    'description' =>  __('Given to Merchant by myghpay', 'client'),
                ),
                'shopname' => array(
                    'title' => __('Shop Name', 'client'),
                    'type' => 'text',
                    'description' =>  __('Enter your shop name. this will be displayed on myghpay payment engine', 'client'),
                ),
                'securehash' => array(
                    'title' => __('Secure Hash', 'client'),
                    'type' => 'text',
                    'description' =>  __('Given to Merchant by myghpay', 'client')
                ),
                
                'redirect_page_id' => array(
                    'title' => __('Return Page'),
                    'type' => 'select',
                    'options' => $this -> get_pages('Select Page'),
                    'description' => "URL of success page"
                )
                
            );
    }

       public function admin_options(){
        echo '<h3>'.__('myghpay Payment Gateway', 'client').'</h3>';
        echo '<p>'.__('myghpay is most popular payment gateway for online shopping in Ghana').'</p>';
        echo '<table class="form-table">';
        // Generate the HTML For the settings form.
        $this -> generate_settings_html();
        echo '</table>';

    }

    /**
     *  There are no payment fields for myghpay, but we want to show the description if set.
     **/
    function payment_fields(){
        if($this -> description) echo wpautop(wptexturize($this -> description));
    }
    /**
     * Receipt Page
     **/
    function receipt_page($order){
        echo '<p>'.__('Thank you for your order, please click the button below to pay with myghpay.', 'client').'</p>';
        echo $this -> generate_myghpay_form($order);
    }
    /**
     * Generate myghpay button link
     **/
    public function generate_myghpay_form($order_id){

       global $woocommerce;
    	$order = new WC_Order( $order_id );
        $txnid = $order_id.'_'.date("ymds");

        $redirect_url = ($this -> baseurl);

        $productinfo = "Order $order_id";

        $str = "$this->clientid|$txnid|$order->order_total|$productinfo|$order->billing_first_name|$order->billing_email|||||||||||$this->clientsecret";
        $hash = hash('sha512', $str);

        $raw_string=$order->order_total.'&'.$productinfo.'&'.$order_id.'&'.$this -> clientsecret.'&'.$this -> clientid;
        $sechash=$this -> securehash;

        $secure_hash=hash_hmac('sha256', $raw_string,$sechash);

        $myghpay_args = array(
          'key' => $this -> clientid,
          'txnid' => $txnid,
          'amount' => $order -> order_total,
          'itemname' => $productinfo,
          'clientref' => $order_id,
          'clientsecret' => $this -> clientsecret,
          'clientid' => $this -> clientid,
          'returnurl' => $this -> redirect_url,          
          'hash' => $hash,
          'securehash'=>$secure_hash
          );
		  
			

    }
    /**
     * Process the payment and return the result
     **/
    function process_payment($order_id){
       global $woocommerce;
    	$order = new WC_Order( $order_id );
		
		$pluginbase = plugin_dir_url( __FILE__ );
		$pluginbasepost = $pluginbase. "postpayment.php";
		
		$tempreturnurl =get_site_url()."/"."?page_id=". $this -> redirect_page_id;
	
		
		session_start();
        
    $_SESSION['myghpayamount'] = $order -> order_total;
		$_SESSION['myghpayitemname'] = "Order -  $order_id";
		$_SESSION['myghpayclientref'] =  $order_id;
		$_SESSION['myghpayclientsecret'] = $this -> clientsecret;
		$_SESSION['myghpayclientid'] = $this -> clientid;
		$_SESSION['myghpaybaseurl'] = $this -> baseurl;
		$_SESSION['myghpayshopname'] = $this -> shopname;
		$_SESSION['myghpayreturnurl'] = $pluginbase. "processresponse.php";
		$_SESSION['redirect_page_id'] = $tempreturnurl;
    $_SESSION['myghpayclientsecurehash'] = $this -> securehash;
		
		
		
		// Mark as on-hold (we're awaiting the cheque)
        //$order->update_status('on-hold', __( 'Awaiting myghpay payment confirmation', 'woocommerce' ));
		 $order->update_status('on-hold');
    
        // Reduce stock levels
        $order->reduce_order_stock();
    
        // Remove cart
        $woocommerce->cart->empty_cart();
	
		
		return array('result' => 'success', 'redirect' => add_query_arg('order',
            $order->id, add_query_arg('key', $order->order_key, $pluginbasepost))
        );
	//	include($pluginbasepost);
		
    }

    

    function showMessage($content){
            return '<div class="box '.$this -> msg['class'].'-box">'.$this -> msg['message'].'</div>'.$content;
        }
     // get all pages
    function get_pages($title = false, $indent = true) {
        $wp_pages = get_pages('sort_column=menu_order');
        $page_list = array();
        if ($title) $page_list[] = $title;
        foreach ($wp_pages as $page) {
            $prefix = '';
            // show indented child pages?
            if ($indent) {
                $has_parent = $page->post_parent;
                while($has_parent) {
                    $prefix .=  ' - ';
                    $next_page = get_page($has_parent);
                    $has_parent = $next_page->post_parent;
                }
            }
            // add to page list array array
            $page_list[$page->ID] = $prefix . $page->post_title;
        }
        return $page_list;
    }
}
   /**
     * Add the Gateway to WooCommerce
     **/
    function woocommerce_add_myghpay_client_gateway($methods) {
        $methods[] = 'WC_myghpay_client';
        return $methods;
    }

    add_filter('woocommerce_payment_gateways', 'woocommerce_add_myghpay_client_gateway' );
}

