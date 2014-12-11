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

$id = $_GET['id'];

$ss2 = "select * from ".$wpdb->prefix."ad_packs where id='$id'";
$rf = $wpdb->get_results($ss2);
$row = $rf[0];

$this_script = get_bloginfo('siteurl').'/?a_action=paypal_mem&id='.$id;

if(empty($action)) $action = 'process';   



switch ($action) {

    

   case 'process':      // Process and order...
		
	$total = $row->pack_cost;		
	 
	  
//---------------------------------------------	
 
      //$p->add_field('business', 'sitemile@sitemile.com');
      $p->add_field('business', $business);
	  
	  $p->add_field('currency_code', get_option('ClassifiedTheme_currency'));
	  $p->add_field('return', $this_script.'&action=success');
      $p->add_field('cancel_return', $this_script.'&action=cancel');
      $p->add_field('notify_url', $this_script.'&action=ipn');
      $p->add_field('item_name', __('Membership Pack','ClassifiedTheme'));
	  $p->add_field('custom', $id.'|'.$uid.'|'.current_time('timestamp',0));
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
		
				global $wpdb;
				
				$opt = get_user_meta($uid, 'classifiedtheme_mem_'.$datemade , true);
				
				if(empty($opt)):
					
					update_user_meta($uid, 'classifiedtheme_mem_'.$datemade , "done");
					
					$ss2 		= "select * from ".$wpdb->prefix."ad_packs where id='$pid'";
					$rf 		= $wpdb->get_results($ss2);
					$row 		= $rf[0];
					$tot_ads 	= $row->ads_number;
					
					$total_nr 			= get_user_meta($uid, 'normal_ads_pack',true); 		if(empty($total_nr)) 			$total_nr = 0;
					$total_featured_nr 	= get_user_meta($uid, 'featured_ads_pack',true); 	if(empty($total_featured_nr)) 	$total_featured_nr = 0;
		
					//--------------------------------
					
					if($row->featured_free == 1)
					{
						$tot_ads += $total_featured_nr;
						update_user_meta($uid, 'featured_ads_pack', $tot_ads);		
					}
					else
					{
						$tot_ads += $total_nr;
						update_user_meta($uid, 'normal_ads_pack', $tot_ads);		
					}
				
				endif;
	}

	
	wp_redirect(get_permalink(get_option('ClassifiedTheme_my_account_mem_pks_id')));
   break;

   case 'cancel':       // Order was canceled...

	
	wp_redirect(get_permalink(get_option('ClassifiedTheme_my_account_mem_pks_id')));
	
       break;
     



 }     

?>