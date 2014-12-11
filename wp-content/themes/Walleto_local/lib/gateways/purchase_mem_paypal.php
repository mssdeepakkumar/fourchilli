<?php

include 'paypal.class.php';


	global $wp_query, $wpdb, $current_user;

	get_currentuserinfo();
	$uid = $current_user->ID;


	$action = $_GET['action'];
	$business = trim(get_option('Walleto_paypal_email'));
	if(empty($business)) die('<strong>Error. Admin, please add your paypal email in backend!</strong>');

	$p = new paypal_class;             // initiate an instance of the class
	$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url

//--------------

	$Walleto_paypal_enable_sdbx = get_option('Walleto_paypal_enable_sdbx');
	if($Walleto_paypal_enable_sdbx == "yes")
	$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

//--------------
$mem = $_GET['mem'];
$this_script = get_bloginfo('siteurl').'/?w_action=purchase_mem_paypal&mem='.$mem;
$cost = get_option('Walleto_shop_'.$_GET['mem'].'_fee');
	
$pers 	= walleto_get_period_from_code($_GET['mem']);
$months = walleto_get_period_from_code_numeric($_GET['mem']);

$title_post = sprintf(__('Shop Membership: %s','Walleto'), $pers);

if(empty($action)) $action = 'process';   



switch ($action) {

    

   case 'process':      // Process and order...
		
			 
 
      //$p->add_field('business', 'sitemile@sitemile.com');
      $p->add_field('business', $business);
	  
	  $p->add_field('currency_code', get_option('Walleto_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name', $title_post);
	  $p->add_field('custom', $mem.'|'.$uid.'|'.current_time('timestamp',0));
      $p->add_field('amount', Walleto_formats_special($cost,2));

      $p->submit_paypal_post(); // submit the fields to paypal

      break;

   case 'success':      // Order was successful...
	case 'ipn':
	

	
	if(isset($_POST['custom']))
	{

		$cust 					= $_POST['custom'];
		$cust 					= explode("|",$cust);
		
		$mem					= $cust[0];
		$uid					= $cust[1];
		$datemade 				= $cust[2];
		$months = walleto_get_period_from_code_numeric($mem);
		
		walleto_update_membership_for_shop($uid, $months);
	
	}

	
	wp_redirect(get_permalink(get_option('Walleto_my_account_shop_setup_page_id')));
   break;

   case 'cancel':       // Order was canceled...

	wp_redirect(get_permalink(get_option('Walleto_my_account_shop_setup_page_id')));

       break;
     



 }     

?>