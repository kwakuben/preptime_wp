<?php
session_start();
  global $woocommerce;
  
 // require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'https://www.didiii.com//wp-json/wc/v2',
    'ck_ed51b251dbac2c542cd9f30efd8dc3a3afa12461',
    'cs_c8b15b54d8f739390a73df2d9ed2b5358ccad9e4',
    [
        'wp_api' => true,
        'version' => 'wc/v2'
    ]
);


print_r($woocommerce->get('')); 
  
  $order = wc_get_order(11);
$items = $order->get_items();

 print_r($woocommerce->get('https://www.didiii.com//wp-json/wc/v2')); 


        if(isset($_REQUEST['txnid'])  && isset($_REQUEST['orderkey']) && isset($_REQUEST['statusCode']) && isset($_REQUEST['refCode']) && isset($_REQUEST['clientref'])){
            
            
            
            
            $txnid = $_SESSION['txnid'];
            
            
            $order_id_time = $_REQUEST['txnid'];
            $order_id = $_REQUEST['clientref'];
           // $order_id = (int)$order_id[0];
            
            if($order_id != '' && $txnid ==$_REQUEST['txnid']){
                
                try{
                    $myghpayamount=$_SESSION['myghpayamount'];
                    $myghpayitemname=$_SESSION['myghpayshopname'];
                    $myghpayclientref=$_SESSION['myghpayclientref'];
                    $myghpayclientsecret=$_SESSION['myghpayclientsecret'];
                    $myghpayclientid=$_SESSION['myghpayclientid'];
                    $myghpaybaseurl=$_SESSION['myghpaybaseurl'];
                    $myghpayreturnurl=$_SESSION['myghpayreturnurl'];
                    $shopname =	$_SESSION['myghpayshopname'];
        
        
                    global $woocommerce;
                    
                    $order="";
                    $order = new WC_Order('$order_id');
                    
                    /*
                    function my_init(){
                        $order = new WC_Order('$order_id');
                    }
                    add_action('init', 'my_init', 1);
                    */
                    
        
                    //$order = new WC_Order('$order_id');
                   // $merchant_id = $_REQUEST['key'];
                    //$amount = $_REQUEST['Amount'];
                    $orderkey = $_REQUEST['orderkey'];
                    
                    $str = $myghpayclientsecret.$myghpayclientref.$myghpayclientid;
                    $checkhash = hash('sha512', $str);
 
                    $status = $_REQUEST['statusCode'];
                    
                    
                    $transauthorised = false;
                    if($order -> status !==''){
                        
                        if($orderkey == $checkhash)
                        {
 
                          //$status = strtolower($status);
 
                            if($status=="1") {//success
                                
                                $transauthorised = true;
                                $this -> msg['message'] = "Thank you for shopping with us. Your account has been charged and your transaction is successful. We will be shipping your order to you soon.";
                                $this -> msg['class'] = 'woocommerce_message';
                                if($order -> status == 'processing'){
 
                                }else{
                                    $order -> payment_complete();
                                    $order -> add_order_note('myghpay payment successful<br/>Unnique Id from myghpay: '.$_REQUEST['refCode']);
                                    $order -> add_order_note($this->msg['message']);
                                    $woocommerce -> cart -> empty_cart();
                                }
                            }else if($status=="pending"){
                                $this -> msg['message'] = "Thank you for shopping with us. Right now your payment staus is pending, We will keep you posted regarding the status of your order through e-mail";
                                $this -> msg['class'] = 'woocommerce_message woocommerce_message_info';
                                $order -> add_order_note('myghpay payment status is pending<br/>Unnique Id from myghpay: '.$_REQUEST['mihpayid']);
                                $order -> add_order_note($this->msg['message']);
                                $order -> update_status('on-hold');
                                $woocommerce -> cart -> empty_cart();
                            }
                            else{
                                $this -> msg['class'] = 'woocommerce_error';
                                $this -> msg['message'] = "Thank you for shopping with us. However, the transaction has been declined.";
                                $order -> add_order_note('Transaction Declined: '.$_REQUEST['Error']);
                                //Here you need to put in the routines for a failed
                                //transaction such as sending an email to customer
                                //setting database status etc etc
                            }
                        }else{
                            $this -> msg['class'] = 'error';
                            $this -> msg['message'] = "Security Error. Illegal access detected";
 
                            //Here you need to simply ignore this and dont need
                            //to perform any operation in this condition
                        }
                        
                        if($transauthorised==false){
                            $order -> update_status('failed');
                            $order -> add_order_note('Failed');
                            $order -> add_order_note($this->msg['message']);
                        }
                        add_action('the_content', array(&$this, 'showMessage'));
                    } else{
                        
                        //payment failed
                    }
                    
                }catch(Exception $e){
                        // $errorOccurred = true;
                        $msg = "Error";
                    }
 
            } else {
                 echo "badaa".$txnid."<br>".$_REQUEST['clientref'];
            }
 
 
 
        } else {
    
            $url ="https://".$_SERVER['SERVER_NAME'];
            //header("Location: $url");
        //die();
        
        echo "badsss".$txnid."<br>".$_REQUEST['clientref'];
            
        }

?>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>