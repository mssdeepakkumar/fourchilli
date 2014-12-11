<?php

include 'paypal.class.php';

global $wp_query, $wpdb, $current_user;


$oid 		= $_GET['pay_order_by_paypal'];
$owner_uid 	= $_GET['uid'];

$action = $_GET['action'];

 

$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url

//---------------------

$Walleto_paypal_enable_sdbx = get_option('Walleto_paypal_enable_sdbx');
if($Walleto_paypal_enable_sdbx == "yes")
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

//--------------------
 
$this_script = get_bloginfo('siteurl').'/?pay_order_by_paypal='.$oid.'&uid='.$owner_uid;

$post = get_post($pid);
$paypal_email = get_user_meta($owner_uid, 'paypal_email', true);


	$opt = get_option('Walleto_only_admins_post_auctions');
	if($opt == "yes")
	{
		$paypal_email = get_option('Walleto_paypal_email');
	}


if(empty($paypal_email)) { die('ERROR-DEBUG-> Missing Paypal Email of user.'); exit; }

if(empty($action)) $action = 'process';   

 

switch ($action) {


   case 'process':      // Process and order...
	
	get_currentuserinfo();
	$total = walleto_get_total_of_order_for_user($oid, $owner_uid);
	
	$shipping = get_post_meta($pid, 'shipping', true);
	if(is_numeric($shipping) && $shipping > 0 && !empty($shipping))
			$shipping = $shipping;
					else $shipping = 0;
	 
	 $total += $shipping; 
//------------------------------------------------------
	
		
      $p->add_field('business', $paypal_email);
	  
	  $p->add_field('currency_code', get_option('Walleto_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name', sprintf(__('Payment for Order #%s','Walleto'), $oid));
	  $p->add_field('custom', $oid.'|'. $owner_uid. '|'.current_time('timestamp',0)."|".$current_user->ID );
      $p->add_field('amount', Walleto_formats_special($total,2));
	  $p->add_field('invoice', rand(0,999).$oid.$owner_uid);

      $p->submit_paypal_post(); // submit the fields to paypal

     break;

   case 'success':      // Order was successful...
	
	WALLETO_ipn_notif_news();
	
	$using_perm 	= Walleto_using_permalinks();
	$paid_items_id 	= get_option('Walleto_my_account_not_shipped_page_id');
			
	if($using_perm)	$paid_itms_m = get_permalink($paid_items_id). "?";
	else $paid_itms_m = get_bloginfo('siteurl'). "/?page_id=". $paid_items_id. "&";	

	global $me_new_thing;
	
	
	
	wp_redirect($paid_itms_m . "paid_ok=1");
	
	
	break;
	
	case 'ipn':
	

	
	WALLETO_ipn_notif_news();

		
   break;

   case 'cancel':       // Order was canceled...

	wp_redirect(walleto_show_payment_link_for_order($oid));
	
       break;
     



 } 
 
 function WALLETO_ipn_notif_news()
 {
	 
	parse_str(file_get_contents("php://input"), $_POST);
	 
	if(isset($_POST['custom']))
	{
 
		if($_POST['payment_status'] == "Completed" or $_POST['payment_status'] == "Pending")
		{
 
		global $wpdb;
		
		$cust 					= $_POST['custom'];
		$cust 					= explode("|",$cust);
		$oid					= $cust[0];
		$uid 					= $cust[1];
		$datemade 				= $cust[2];
		$the_buyer 				= $cust[3];
 
		$s = "select * from ".$wpdb->prefix."walleto_order_contents cnt, $wpdb->posts posts where cnt.orderid='$oid' AND cnt.paid='0' AND posts.post_author='$uid' AND posts.ID=cnt.pid";
		$r = $wpdb->get_results($s);	
		
		foreach($r as $row)
		{
			$idso = $row->orderid;
			$idso2 = $row->id;
			$wpdb->query("update ".$wpdb->prefix."walleto_order_contents  set paid='1', paid_on='$datemade' where id='$idso2'");
			
			$pids 	= $row->pid;
			$oid 	= $idso;
			$digital_good = get_post_meta($pids, 'digital_good',true);
							
			if($digital_good == "1")
			{
				$tm = current_time('timestamp',0);
				$er_s = "update ".$wpdb->prefix."walleto_order_contents set shipped='1', shipped_on='$tm' where orderid='$oid' and pid='$pids' ";
				$wpdb->query($er_s);
								
				$er_s = "update ".$wpdb->prefix."walleto_orders set shipped_on='$tm', partially_shipped='1', fully_shipped='1' where id='$oid'";
				$wpdb->query($er_s);
								 
			}
		}
		
		
		$walleto_check_if_order_is_paid_fully = walleto_check_if_order_is_paid_fully($oid);
		
		if($walleto_check_if_order_is_paid_fully == false)
		{
			$wpdb->query("update ".$wpdb->prefix."walleto_orders set paid='0', partially_paid='1' where id='$oid'");	
		}
		else
		{
			$wpdb->query("update ".$wpdb->prefix."walleto_orders set paid='1', partially_paid='1', paid_on='$datemade'  where id='$oid'");
		}
		
		$opt = get_option('my_updated_walleto_paid_' .$datemade. $oid);
		
		if(empty($opt))
		{
			Walleto_send_email_when_item_is_paid_seller($oid, 	$uid, $the_buyer);
			Walleto_send_email_when_item_is_paid_buyer($oid, 	$the_buyer, $uid);
			update_option('my_updated_walleto_paid_' .$datemade. $oid , "1");
			
			walleto_prepare_rating($uid, $the_buyer, $oid);
			walleto_prepare_rating($the_buyer, $uid, $oid);
			
		}
		
		$owner_uid = $uid;
		do_action('Walleto_check_after_products_were_paid', $oid, $owner_uid);
		
	}  }
	
	do_action('Walleto_see_if_digital_goods_in_this_order', $oid);
	
 }
     

?>