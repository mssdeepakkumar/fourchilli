<?php

	global $wp_query, $wpdb, $current_user;
	$pid = $wp_query->query_vars['pid'];
	get_currentuserinfo();
	$uid = $current_user->ID;
	$post = get_post($pid);

	$id = $_GET['id'];

	$business = get_option('ClassifiedTheme_moneybookers_email');
	if(empty($business)) die('ERROR. Please input your Moneybookers email.');
	//-------------------------------------------------------------------------
	
	$ss2 	= "select * from ".$wpdb->prefix."ad_packs where id='$id'";
	$rf 	= $wpdb->get_results($ss2);
	$row 	= $rf[0];

	//---------------------------------

	
	$tm 			= current_time('timestamp',0);
	$cancel_url 	= get_bloginfo("siteurl").'/?a_action=mb_mem_response&pid='.$id;
	$response_url 	= get_bloginfo('siteurl').'/?a_action=mb_mem_response';
	$ccnt_url		= ClassifiedTheme_my_account_link();
	$currency 		= get_option('ClassifiedTheme_currency');
	
?>


<html>
<head><title>Processing Skrill Payment...</title></head>
<body onLoad="document.form_mb.submit();">
<center><h3><?php _e('Please wait, your order is being processed...', 'ClassifiedTheme'); ?></h3></center>

	
    <form name="form_mb" action="https://www.moneybookers.com/app/payment.pl">
    <input type="hidden" name="pay_to_email" value="<?php echo get_option('ClassifiedTheme_moneybookers_email'); ?>">
    <input type="hidden" name="payment_methods" value="ACC,OBT,GIR,DID,SFT,ENT,EBT,SO2,IDL,PLI,NPY,EPY">
    
    <input type="hidden" name="recipient_description" value="<?php bloginfo('name'); ?>">
    
    <input type="hidden" name="cancel_url" value="<?php echo $cancel_url; ?>">
    <input type="hidden" name="status_url" value="<?php echo $response_url; ?>">
    
    <input type="hidden" name="language" value="EN">
    
    <input type="hidden" name="merchant_fields" value="field1">
    <input type="hidden" name="field1" value="<?php echo $id.'|'.$uid.'|'.$tm; ?>">
    
    <input type="hidden" name="amount" value="<?php echo $row->pack_cost; ?>">
    <input type="hidden" name="currency" value="<?php echo $currency ?>">
    
    <input type="hidden" name="detail1_description" value="Product: ">
    <input type="hidden" name="detail1_text" value="<?php echo __('Membership Pack','ClassifiedTheme'); ?>">
    
    <input type="hidden" name="return_url" value="<?php echo $ccnt_url; ?>">
    
    
    </form>


</body>
</html>
