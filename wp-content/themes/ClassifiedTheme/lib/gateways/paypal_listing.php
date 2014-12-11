<?php

include 'paypal.class.php';


	global $wp_query, $wpdb, $current_user;
	$pid = $wp_query->query_vars['pid'];
	get_currentuserinfo();
	$uid = $current_user->ID;
	$post = get_post($pid);

$action = $_GET['action'];
$business = trim(get_option('ClassifiedTheme_paypal_email'));
if(empty($business)) die('Error. Admin, please add your paypal email in backend!');

$p = new paypal_class;             // initiate an instance of the class
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';   // testing paypal url

//--------------

	$ClassifiedTheme_paypal_enable_sdbx = get_option('ClassifiedTheme_paypal_enable_sdbx');
	if($ClassifiedTheme_paypal_enable_sdbx == "yes")
	$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';     // paypal url

//--------------

$this_script = get_bloginfo('siteurl').'/?a_action=paypal_listing&pid='.$pid;

if(empty($action)) $action = 'process';   



switch ($action) {

    

   case 'process':      // Process and order...
		
			$features_not_paid = array();		
			$catid = ClassifiedTheme_get_item_primary_cat($pid);
			$ClassifiedTheme_get_images_cost_extra = ClassifiedTheme_get_images_cost_extra($pid);
			$payment_arr = array();
			
			//-----------------------------------
			
			$base_fee_paid 	= get_post_meta($pid, 'base_fee_paid', true);
			$base_fee 		= get_option('ClassifiedTheme_new_listing_listing_fee');

			
			$custom_set = get_option('ClassifiedTheme_enable_custom_posting');
			if($custom_set == 'yes')
			{
				$base_fee = get_option('ClassifiedTheme_theme_custom_cat_'.$catid);
				if(empty($base_fee)) $base_fee = 0;		
			}
			
			//----------------------------------------------------------
			
			if($base_fee_paid != "1" && $base_fee > 0)
			{

				$my_small_arr = array();
				$my_small_arr['fee_code'] 		= 'base_fee';
				$my_small_arr['show_me'] 		= true;
				$my_small_arr['amount'] 		= $base_fee;
				$my_small_arr['description'] 	= __('Base Fee','ClassifiedTheme');
				array_push($payment_arr, $my_small_arr);
				
			}
			
			//----------------------------------------------------------
			
				$my_small_arr = array();
				$my_small_arr['fee_code'] 		= 'extra_img';
				$my_small_arr['show_me'] 		= true;
				$my_small_arr['amount'] 		= $ClassifiedTheme_get_images_cost_extra;
				$my_small_arr['description'] 	= __('Extra Images Fee','ClassifiedTheme');
				array_push($payment_arr, $my_small_arr);
			
			
			//-------- Featured Project Check --------------------------
			
			
			$featured 		= get_post_meta($pid, 'featured', true);
			$featured_paid 	= get_post_meta($pid, 'featured_paid', true);
			$feat_charge 	= get_option('ClassifiedTheme_new_listing_feat_listing_fee');
			
			if($featured == "1" && $featured_paid != "1" && $feat_charge > 0)
			{
				
				$my_small_arr = array();
				$my_small_arr['fee_code'] 		= 'feat_fee';
				$my_small_arr['show_me'] 		= true;
				$my_small_arr['amount'] 		= $feat_charge;
				$my_small_arr['description'] 	= __('Featured Fee','ClassifiedTheme');
				array_push($payment_arr, $my_small_arr);
				
			}
			
			//---------------------
			
			$payment_arr = apply_filters('ClassifiedTheme_filter_payment_array', $payment_arr, $pid);
		
		 		
			$my_total = 0;
			foreach($payment_arr as $payment_item):
				if($payment_item['amount'] > 0):
					$my_total += $payment_item['amount'];
				endif;
			endforeach;			
			
		 
			
			$my_total = apply_filters('ClassifiedTheme_filter_payment_total', $my_total, $pid);

//----------------------------------------------
	$additional_paypal = 0;
	$additional_paypal = apply_filters('ClassifiedTheme_filter_paypal_listing_additional', $additional_paypal, $pid);
	
	//$ClassifiedTheme_get_show_price = ClassifiedTheme_get_show_price($pid);
	$total = $my_total + $additional_paypal;
	
	$title_post = $post->post_title;
	$title_post = apply_filters('ClassifiedTheme_filter_paypal_listing_title', $title_post, $pid);
	  
	 
	  
//---------------------------------------------	
 
      //$p->add_field('business', 'sitemile@sitemile.com');
      $p->add_field('business', $business);
	  
	  $p->add_field('currency_code', get_option('ClassifiedTheme_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name', $title_post);
	  $p->add_field('custom', $pid.'|'.$uid.'|'.current_time('timestamp',0));
      $p->add_field('amount', ClassifiedTheme_formats_special($total,2));

      $p->submit_paypal_post(); // submit the fields to paypal

      break;

   case 'success':      // Order was successful...
	case 'ipn':
	

	
	if(isset($_POST['custom']))
	{

		$cust 					= $_POST['custom'];
		$cust 					= explode("|",$cust);
		
		$pid					= $cust[0];
		$uid					= $cust[1];
		$datemade 				= $cust[2];
		
		//--------------------------------------------
		
		update_post_meta($pid, "paid", 				"1");
		update_post_meta($pid, "closed", 			"0");
		
		//--------------------------------------------
		
		update_post_meta($pid, 'base_fee_paid', '1');
		
		$featured = get_post_meta($pid,'featured',true);	
		if($featured == "1") update_post_meta($pid, 'featured_paid', '1');
	 
		//--------------------------------------------
		
		do_action('ClassifiedTheme_paypal_listing_response', $pid);
		
		$ClassifiedTheme_admin_approves_each_project = get_option('ClassifiedTheme_admin_approves_each_project');
		$paid_listing_date = get_post_meta($pid,'paid_listing_date',true);
		
		if(empty($paid_listing_date))
		{
			
			if($ClassifiedTheme_admin_approves_each_project != "yes")
			{
				wp_publish_post( $pid );	
				$post_new_date = date('Y-m-d h:s',current_time('timestamp',0));  
				
				$post_info = array(  "ID" 	=> $pid,
				  "post_date" 				=> $post_new_date,
				  "post_date_gmt" 			=> $post_new_date,
				  "post_status" 			=> "publish"	);
				
				wp_update_post($post_info);
				
				ClassifiedTheme_send_email_posted_item_approved($pid);
				ClassifiedTheme_send_email_posted_item_not_approved_admin($pid);
				
			}
			else
			{ 
		
				ClassifiedTheme_send_email_posted_item_not_approved($pid);
				ClassifiedTheme_send_email_posted_item_approved_admin($pid);			
				//ClassifiedTheme_send_email_subscription($pid);	
				
			}
			
			update_post_meta($pid, "paid_listing_date", current_time('timestamp',0));
		}
	}

	
	wp_redirect(get_permalink($pid));
   break;

   case 'cancel':       // Order was canceled...

	wp_redirect(get_bloginfo('siteurl'));

       break;
     



 }     

?>