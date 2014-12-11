<?php
/***************************************************************************
*
*	Walleto - copyright (c) - sitemile.com
*	The best wordpress premium theme for having a marketplace. Sell and buy all kind of products, including downloadable goods. 
*	Have a niche marketplace website in minutes. Turn-key solution.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/products/walleto-wordpress-marketplace-theme/
*	since v1.0.1
*
*	Dedicated to my wife: Alexandra
*
***************************************************************************/


if(!function_exists('walleto_pay_4_item_virt_content_area_function'))
{
function walleto_pay_4_item_virt_content_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	$oid = $_GET['oid'];
	$sk = get_permalink(get_option('Walleto_my_account_page_id'));
?>	
<div id="content">
			<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php echo sprintf(__("Pay for Order by Virtual Currency - #%s",'Walleto'), $oid); ?></div>
                <div class="box_content">   
                <?php
                 
			if(isset($_GET['confirm']))
			{
				$sk = get_permalink(get_option('Walleto_my_account_page_id'));
				global $wpdb;
				
				
				
				$s = "select * from ".$wpdb->prefix."walleto_orders where id='$oid'";
				$r = $wpdb->get_results($s);
				$row = $r[0];
				$buyer_user = $row->uid;
				$Walleto_get_credits = Walleto_get_credits($buyer_user);
				
				if($row->paid == 0)
				{
					$totalprice = walleto_left_to_pay_for_order($row->id); //$row->totalprice + $row->shipping;
					if($Walleto_get_credits >= $totalprice)
					{
					
						$pd = current_time('timestamp',0);
						$s = "update ".$wpdb->prefix."walleto_orders set paid='1', paid_on='$pd' where id='$oid'";
						$wpdb->query($s);
						
						$s = "update ".$wpdb->prefix."walleto_order_contents set paid='1', paid_on='$pd' where orderid='$oid'";
						$wpdb->query($s);
						
						
						$ttl = walleto_left_to_pay_for_order($oid);
						Walleto_update_credits($buyer_user, $Walleto_get_credits - $ttl);
						
						$reason = sprintf(__("Payment for order #%s.","Walleto"), $oid); 
						walleto_add_history_log('0', $reason, $ttl, $row->uid);	
							
						//----------	
						
						$s1 = "select distinct ord.*, posts.post_author from ".$wpdb->prefix."walleto_order_contents ord, $wpdb->posts posts where ord.orderid='$oid' AND ord.pid=posts.ID";
						$r1 = $wpdb->get_results($s1);
						
						foreach($r1 as $row1)
						{
							$Walleto_get_credits_TMP 	= Walleto_get_credits($row1->uid);
							$prcs 						= $row1->price * $row1->quant;	
							$pids 						= $row1->pid; 
							$pids_post 					= get_post($pids);
							$digital_good 				= get_post_meta($pids, 'digital_good',true);
							
							if($digital_good == "1")
							{
								$tm = current_time('timestamp',0);
								$er_s = "update ".$wpdb->prefix."walleto_order_contents set shipped='1', shipped_on='$tm' where orderid='$oid' and pid='$pids' ";
								$wpdb->query($er_s);
								
								$er_s = "update ".$wpdb->prefix."walleto_orders set shipped_on='$tm', partially_shipped='1', fully_shipped='1' where id='$oid'";
								$wpdb->query($er_s);
								 
							}
							
							//---------------
							
							walleto_prepare_rating($row->uid, $row1->post_author, $oid);
							walleto_prepare_rating($row1->post_author, $row->uid, $oid);
							
							
							$Walleto_get_credits_TMP2 	= Walleto_get_credits($pids_post->post_author);							 
				 
							
							
							$reason = sprintf(__("Payment received for product <b>%s</b> (#%s). Quantity: %s.","Walleto"), $pids_post->post_title, $pids, $row1->quant); 
							walleto_add_history_log('1', $reason, $prcs, $row1->post_author, $row->uid);
							Walleto_update_credits($pids_post->post_author, $Walleto_get_credits_TMP2 + $prcs);	
							
							$shp = get_post_meta($pids,'shipping',true);
							if($shp > 0)
							{
								$reason = sprintf(__("Payment for shipping product <b>%s</b> (#%s). Quantity: %s.","Walleto"), $pids_post->post_title, $pids, $row1->quant); 
								walleto_add_history_log('1', $reason, $shp, $row1->post_author, $row->uid);
								Walleto_update_credits($pids_post->post_author, $Walleto_get_credits_TMP2 + $prcs + $shp);	
							}
							
							//---------------
							
							$walleto_how_much_to_get_as_custom_percent = walleto_how_much_to_get_as_custom_percent($prcs);
							if($walleto_how_much_to_get_as_custom_percent > 0)
							{
								$Walleto_get_credits_TMP = Walleto_get_credits($row1->post_author);
								
								$reason = sprintf(__("Payment fee paid for selling the product %s (%s). Quantity: %s.","Walleto"), $pids_post->post_title, $pids, $row1->quant); 
								walleto_add_history_log('0', $reason, $walleto_how_much_to_get_as_custom_percent, $row1->post_author);
								Walleto_update_credits($pids_post->post_author, $Walleto_get_credits_TMP - $walleto_how_much_to_get_as_custom_percent);
								
							}
							
						}
						
						do_action('Walleto_check_after_products_were_paid_credits', $oid);
						
					} else { $no_money = 1; }
				}
			?>
            	<?php
						
						if($no_money == 1){ $sk1 = get_permalink(get_option('Walleto_my_account_my_finances_page_id'));
							?>
                            
                            <div class="error"><?php echo sprintf(__('You dont have enough money into your account. <a href="%s">Deposit More Money</a>.','Walleto'), $sk1); ?></div>
                            
                            <?php
								
						}else { 
						
				?>
            	<span class="pay_4_item"><?php echo sprintf(__('Your item has been paid. <a href="%s">Return to your account</a>.','Walleto'), $sk); ?></span>
            
            <?php	
						}
			}
			else
			{
				 
			$ttl = walleto_left_to_pay_for_order($oid); 
			echo '<span class="pay_4_item">'.sprintf(__('You are about to pay <b>%s</b> for this order using virtual currency. Click confirm to finish the payment. If you do not have enough money into your account, you will be redirected to deposit more money.','Walleto'), walleto_get_show_price($ttl)) . '</span>';
			
			global $wpdb;
			$s = "select * from ".$wpdb->prefix."walleto_orders where id='$oid'";
			$r = $wpdb->get_results($s);
			$row = $r[0];
			$Walleto_get_credits = Walleto_get_credits($uid);
			$totalprice = $row->totalprice;
			
			if($Walleto_get_credits >= $totalprice)
			{
						
			?>
			<p class="payment_links_holder">
            
            <a href="<?php echo walleto_show_payment_link_for_order_virtual_currency($oid, '1') ?>" class="btns_pay"><?php _e('Confirm Payment','Walleto'); ?></a>
            
            </p>
            
            <?php }
			else
			{
					$sk2 = get_permalink(get_option('Walleto_my_account_my_finances_page_id'));
			?>
            
            <?php 
			echo '<div class="error">';
			echo sprintf(__('You do not seem to have enough balance in your account. To make the payment you must deposit more. <b><a href="%s">Click here</a></b> for deposit.',''), $sk2); 
			echo '</div>';
			
			?>
            
            
            <?php
			
			}} ?>
            
			</div>
			</div>
			
			<div class="clear10"></div>
			
			
		 
			
			
			
		</div> <!-- end div content -->


<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
