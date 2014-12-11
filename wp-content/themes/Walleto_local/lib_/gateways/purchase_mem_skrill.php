<?php

	global $wp_query, $wpdb, $current_user;
	$pid = $wp_query->query_vars['pid'];
	get_currentuserinfo();
	$uid = $current_user->ID;
	$post = get_post($pid);

	$business = get_option('Walleto_moneybookers_email');
	if(empty($business)) die('ERROR. Please input your Moneybookers email.');
	//-------------------------------------------------------------------------
	$mem = $_GET['mem'];
	$cost = get_option('Walleto_shop_'.$_GET['mem'].'_fee');
	$total = $cost;
	
	$pers 	= walleto_get_period_from_code($_GET['mem']);
	$months = walleto_get_period_from_code_numeric($_GET['mem']);
	
	$title_post = sprintf(__('Shop Membership: %s','Walleto'), $pers);
	
	
	//---------------------------------

	
	$tm 			= current_time('timestamp',0);
	$cancel_url 	= get_bloginfo("siteurl");
	$response_url 	= get_bloginfo('siteurl').'/?w_action=skrill_mem_response';
	$ccnt_url		= Walleto_my_account_link();
	$currency 		= get_option('Walleto_currency');
	
?>


<html>
<head><title>Processing Skrill Payment...</title></head>
<body onLoad="document.form_mb.submit();">
<center><h3><?php _e('Please wait, your order is being processed...', 'Walleto'); ?></h3></center>

	
    <form name="form_mb" action="https://www.moneybookers.com/app/payment.pl">
    <input type="hidden" name="pay_to_email" value="<?php echo get_option('Walleto_moneybookers_email'); ?>">
    <input type="hidden" name="payment_methods" value="ACC,OBT,GIR,DID,SFT,ENT,EBT,SO2,IDL,PLI,NPY,EPY">
    
    <input type="hidden" name="recipient_description" value="<?php bloginfo('name'); ?>">
    
    <input type="hidden" name="cancel_url" value="<?php echo $cancel_url; ?>">
    <input type="hidden" name="status_url" value="<?php echo $response_url; ?>">
    
    <input type="hidden" name="language" value="EN">
    
    <input type="hidden" name="merchant_fields" value="field1">
    <input type="hidden" name="field1" value="<?php echo $mem.'|'.$uid.'|'.$tm; ?>">
    
    <input type="hidden" name="amount" value="<?php echo $total; ?>">
    <input type="hidden" name="currency" value="<?php echo $currency ?>">
    
    <input type="hidden" name="detail1_description" value="Product: ">
    <input type="hidden" name="detail1_text" value="<?php echo $title_post; ?>">
    
    <input type="hidden" name="return_url" value="<?php echo $ccnt_url; ?>">
    
    
    </form>


</body>
</html>
