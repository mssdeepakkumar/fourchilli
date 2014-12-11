<?php

	global $wp_query, $wpdb, $current_user;
	$pid = $wp_query->query_vars['pid'];
	get_currentuserinfo();
	$uid = $current_user->ID;
	$post = get_post($pid);

	$business = get_option('ClassifiedTheme_alertpay_email');
	if(empty($business)) die('ERROR. Please input your Payza email.');
	//-------------------------------------------------------------------------
	
			$features_not_paid 	= array();		
			$payment_arr 		= array();
			$base_fee_paid 		= get_post_meta($pid, 'base_fee_paid', true);
			$base_fee 			= get_option('ClassifiedTheme_new_listing_listing_fee');
			
			///----custom fee check--------------
			
			$catid = ClassifiedTheme_get_listing_primary_cat($pid);
			$ClassifiedTheme_get_images_cost_extra = ClassifiedTheme_get_images_cost_extra($pid);
			
			$custom_set = get_option('ClassifiedTheme_enable_custom_posting');
			if($custom_set == 'yes')
			{
				$base_fee = get_option('ClassifiedTheme_theme_custom_cat_'.$catid);
				if(empty($base_fee)) $base_fee = 0;		
			}
			
			//----------------------------------
			
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


	//----------------------------------------------
	$additional_paypal = 0;
	$additional_paypal = apply_filters('ClassifiedTheme_filter_paypal_listing_additional', $additional_paypal, $pid);

	$total = $my_total + $additional_paypal;
	
	$title_post = $post->post_title;
	$title_post = apply_filters('ClassifiedTheme_filter_paypal_listing_title', $title_post, $pid);
	
	//---------------------------------

	
	$tm 			= current_time('timestamp',0);
	$cancel_url 	= get_bloginfo("siteurl").'/?a_action=payza_listing_response&pid='.$pid;
	$response_url 	= get_bloginfo('siteurl').'/?a_action=payza_listing_response';
	$ccnt_url		= ClassifiedTheme_my_account_link();
	$currency 		= get_option('ClassifiedTheme_currency');
	
?>


<html>
<head><title>Processing Payza Payment...</title></head>
<body onLoad="document.form_mb.submit();">
<center><h3><?php _e('Please wait, your order is being processed...', 'ClassifiedTheme'); ?></h3></center>


 <form name="form_mb" action="https://secure.payza.com/checkout" method="post" >
        <input name="ap_purchasetype" type="hidden" value="item-goods" >
        <input name="ap_merchant" type="hidden" value="<?php echo get_option('ClassifiedTheme_moneybookers_email'); ?>" >
        <input name="ap_itemname" type="hidden" value="<?php echo $title_post; ?>" >
        <input name="ap_description" type="hidden" value="<?php echo $title_post; ?>" > 
        <input name="ap_cancelurl" type="hidden" value="<?php echo $cancel_url; ?>" >
        <input name="ap_returnurl" type="hidden" value="<?php echo $ccnt_url ?>" >
        <input name="ap_quantity" type="hidden" value="1" >
        <input name="ap_currency" type="hidden" value="<?php echo $currency ?>" >
        <input name="ap_itemcode" type="hidden" value="<?php echo $pid.'_'.$uid.'_'.$tm; ?>" >
        <input name="ap_shippingcharges" type="hidden" value="0" >
       <input name="ap_alerturl" type="hidden" value="<?php echo $response_url; ?>" >
        <input name="apc_1" type="hidden" value="<?php echo $pid.'|'.$uid.'|'.$tm; ?>" >
        
        
        
        <input name="ap_amount" type="hidden" value="<?php echo $total; //($price + $hst_cost + $ncfg_cost); ?>" >
        
                            </form>

	 

</body>
</html>
