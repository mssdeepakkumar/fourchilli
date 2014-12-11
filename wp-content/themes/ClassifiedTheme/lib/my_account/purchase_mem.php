<?php

function ClassifiedTheme_purchase_mem_page_disp()
{
global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	global $wpdb,$wp_rewrite,$wp_query;
	$id = $_GET['id'];
	
	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
    
        
        
            
            <div class="my_box3">
 
            
            	<div class="box_title"><?php _e("Get Membership Packs", "ClassifiedTheme"); ?></div>
                <div class="box_content">    
			
            
            	<?php
	
	$ss2 = "select * from ".$wpdb->prefix."ad_packs where id='$id'";
	///mysql_query($ss2) or die(mysql_error());
	$rf = $wpdb->get_results($ss2);
	
	if(count($rf) == 0)
		echo __('No such pack.','ClassifiedTheme');
	else
	{
		$row = $rf[0];
		$cst = classifiedtheme_get_show_price($row->pack_cost,2);
		
		printf(__('You are about to pay for a membership pack. Cost: %s. Use the payment methods listed below.','ClassifiedTheme'), $cst); 
		echo '<br/><br/>';
		
		//--------------------------------
		
						$ClassifiedTheme_paypal_enable 		= get_option('ClassifiedTheme_paypal_enable');
						$ClassifiedTheme_alertpay_enable 		= get_option('ClassifiedTheme_alertpay_enable');
						$ClassifiedTheme_moneybookers_enable 	= get_option('ClassifiedTheme_moneybookers_enable');
						
						
						if($ClassifiedTheme_paypal_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=paypal_mem&id='.$id.'" class="post_bid_btn">'.__('Pay by PayPal','ClassifiedTheme').'</a>';
						
						if($ClassifiedTheme_moneybookers_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=mb_mem&id='.$id.'" class="post_bid_btn">'.__('Pay by MoneyBookers/Skrill','ClassifiedTheme').'</a>';
						
						if($ClassifiedTheme_alertpay_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=payza_mem&id='.$id.'" class="post_bid_btn">'.__('Pay by Payza','ClassifiedTheme').'</a>';
						
						$ClassifiedTheme_offline_payments = get_option('ClassifiedTheme_offline_payments');
						if($ClassifiedTheme_offline_payments == "yes")
						{
							$opt = get_option('ClassifiedTheme_offline_payment_dets');
							echo sprintf(__('Bank Details: %s','ClassifiedTheme'), $opt);	
							
						}
						
						do_action('ClassifiedTheme_add_payment_options_to_memberships', $id);
		
		
	}
	?>
            		
             
           </div>
           </div>     
            
    
    <!-- ############################################# -->
    </div>
    
    <?php
	
	classifiedTheme_get_users_links();	
	
}

?>