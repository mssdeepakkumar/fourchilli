<?php
	define("IPN_SECURITY_CODE", "");
	define("MY_MERCHANT_EMAIL", "");

	//Setting information about the transaction
	$receivedSecurityCode = $_POST['ap_securitycode'];
	$receivedMerchantEmailAddress = $_POST['ap_merchant'];	
	$transactionStatus = $_POST['ap_status'];
	$testModeStatus = $_POST['ap_test'];	 
	$purchaseType = $_POST['ap_purchasetype'];
	$totalAmountReceived = $_POST['ap_totalamount'];
	$feeAmount = $_POST['ap_feeamount'];
    $netAmount = $_POST['ap_netamount'];
	$transactionReferenceNumber = $_POST['ap_referencenumber'];
	$currency = $_POST['ap_currency']; 	
	$transactionDate= $_POST['ap_transactiondate'];
	$transactionType= $_POST['ap_transactiontype'];
	
	//Setting the customer's information from the IPN post variables
	$customerFirstName = $_POST['ap_custfirstname'];
	$customerLastName = $_POST['ap_custlastname'];
	$customerAddress = $_POST['ap_custaddress'];
	$customerCity = $_POST['ap_custcity'];
	$customerState = $_POST['ap_custstate'];
	$customerCountry = $_POST['ap_custcountry'];
	$customerZipCode = $_POST['ap_custzip'];
	$customerEmailAddress = $_POST['ap_custemailaddress'];
	
	//Setting information about the purchased item from the IPN post variables
	$myItemName = $_POST['ap_itemname'];
	$myItemCode = $_POST['ap_itemcode'];
	$myItemDescription = $_POST['ap_description'];
	$myItemQuantity = $_POST['ap_quantity'];
	$myItemAmount = $_POST['ap_amount'];
	
	//Setting extra information about the purchased item from the IPN post variables
	$additionalCharges = $_POST['ap_additionalcharges'];
	$shippingCharges = $_POST['ap_shippingcharges'];
	$taxAmount = $_POST['ap_taxamount'];
	$discountAmount = $_POST['ap_discountamount'];
	 
	//Setting your customs fields received from the IPN post variables
	$myCustomField_1 = $_POST['apc_1'];
	$myCustomField_2 = $_POST['apc_2'];
	$myCustomField_3 = $_POST['apc_3'];
	$myCustomField_4 = $_POST['apc_4'];
	$myCustomField_5 = $_POST['apc_5'];
	$myCustomField_6 = $_POST['apc_6'];

				
if ($transactionStatus == "Success") {
		
		$c  	= $myCustomField_1;
		$c 		= explode('|',$c);
		
		$pid				= $c[0];
		$uid				= $c[1];
		$datemade 			= $c[2];		
		
		//---------------------------------------------------

			global $wpdb;
			$pref = $wpdb->prefix;
		
			//--------------------------------------------
		
			update_post_meta($pid, "paid", 				"1");
			update_post_meta($pid, "paid_listing_date", current_time('timestamp',0));
			update_post_meta($pid, "closed", 			"0");
			
			//--------------------------------------------
			
			update_post_meta($pid, 'base_fee_paid', '1');
			
			$featured = get_post_meta($pid,'featured',true);	
			if($featured == "1") update_post_meta($pid, 'featured_paid', '1');
			
 
			//--------------------------------------------
			do_action('ClassifiedTheme_moneybookers_listing_response', $pid);
			
			$ClassifiedTheme_admin_approves_each_project = get_option('ClassifiedTheme_admin_approves_each_project');
			
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
			
			//---------------------------
}
	
?>