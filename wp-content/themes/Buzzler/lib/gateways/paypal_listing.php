<?php

include 'paypal.class.php';


	global $wp_query, $wpdb, $current_user;
	$pid = $wp_query->query_vars['pid'];
	$planid = $_GET['plan'];
	
	get_currentuserinfo();
	$uid = $current_user->ID;
	$post = get_post($pid);

$action = $_GET['action'];
$business = trim(get_option('Buzzler_paypal_email'));
if(empty($business)) die('Error. Admin, please add your paypal email in backend!');

$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url

//--------------

	$Buzzler_paypal_enable_sdbx = get_option('Buzzler_paypal_enable_sdbx');
	if($Buzzler_paypal_enable_sdbx == "yes")
	$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

//--------------

$this_script = get_bloginfo('siteurl').'/?b_action=paypal_listing&pid='.$pid.'&plan='.$planid;

if(empty($action)) $action = 'process';   



switch ($action) {

    

   case 'process':      // Process and order...
		
			
			
	$total = get_post_meta($planid,'price',true);
	
	$title_post = $post->post_title;
	$title_post = apply_filters('Buzzler_filter_paypal_listing_title', $title_post, $pid);
	  
	 
	  
//---------------------------------------------	
 
      //$p->add_field('business', 'sitemile@sitemile.com');
      $p->add_field('business', $business);
	  
	  $p->add_field('currency_code', get_option('Buzzler_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name', $title_post);
	  $p->add_field('custom', $pid.'|'.$planid.'|'.current_time('timestamp',0));
      $p->add_field('amount', Buzzler_formats_special($total,2));

      $p->submit_paypal_post(); // submit the fields to paypal

      break;

   case 'success':      // Order was successful...
	case 'ipn':
	

	
	if(isset($_POST['custom']))
	{

		$cust 					= $_POST['custom'];
		$cust 					= explode("|",$cust);
		
		$pid					= $cust[0];
		$planid					= $cust[1];
		$datemade 				= $cust[2];
		
		//--------------------------------------------
		
		$days = get_post_meta($planid, "days", 				true);
		$featured = get_post_meta($planid, "days", 				true);
		
		//--------------------------------------------
		
		 	
		if($featured == "1") update_post_meta($pid, 'featured_paid', '1');
		else update_post_meta($pid, 'featured_paid', '0');
	 
		//--------------------------------------------
		
		do_action('Buzzler_paypal_listing_response', $pid);
		
		$Buzzler_admin_approves_each_project = get_option('Buzzler_admin_approves_each_project');
		$paid_listing_date = get_post_meta($pid,'paid_listing_date',true);
		
		if(empty($paid_listing_date))
		{
			
			if($Buzzler_admin_approves_each_project != "yes")
			{
				wp_publish_post( $pid );	
				$post_new_date = date('Y-m-d h:s',current_time('timestamp',0));  
				
				$post_info = array(  "ID" 	=> $pid,
				  "post_date" 				=> $post_new_date,
				  "post_date_gmt" 			=> $post_new_date,
				  "post_status" 			=> "publish"	);
				
				wp_update_post($post_info);
				
				Buzzler_send_email_posted_item_approved($pid);
				Buzzler_send_email_posted_item_not_approved_admin($pid);
				
			}
			else
			{ 
		
				Buzzler_send_email_posted_item_not_approved($pid);
				Buzzler_send_email_posted_item_approved_admin($pid);			
				//Buzzler_send_email_subscription($pid);	
				
			}
			
			update_post_meta($pid, "paid_listing_date", current_time('timestamp',0));
			update_post_meta($pid, "ending", current_time('timestamp',0) + 24*3600*$days);
		}
	}

	
	wp_redirect(get_permalink($pid));
   break;

   case 'cancel':       // Order was canceled...

	wp_redirect(get_bloginfo('siteurl'));

       break;
     



 }     

?>