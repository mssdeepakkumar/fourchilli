<?php

if($_POST['status'] > -1)
{
		
		$c  	= $_POST['field1'];
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