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


if(!function_exists('walleto_pay_4_item_content_area_function'))
{
function walleto_pay_4_item_content_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	$oid = $_GET['oid'];
	//$shop_id = walleto_get_shop_id($uid);
	//print_r($shop_id);
?>	
<div id="content">
			<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php echo sprintf(__("Pay for Order - #%s",'Walleto'), $oid); ?></div>
                <div class="box_content">   
                <?php
                 
			$ttl = walleto_left_to_pay_for_order($oid); 
			echo '<span class="pay_4_item">'.sprintf(__('You are about to pay <b>%s</b> for this order. Please choose from one of the below payment methods.','Walleto'), walleto_get_show_price($ttl)) . '</span>';
			
			?>
			<p class="payment_links_holder">
            
            <!--a href="<?php// echo walleto_show_payment_link_for_order_virtual_currency($oid) ?>" class="btns_pay"><?php //_e('Pay by Virtual Currency','Walleto'); ?></a-->
            
            <input type="hidden" class="oid" value="<?php echo $oid;?>" />
            <input type="hidden" class="uid" value="<?php echo $uid;?>" />
            <?php global $wpdb;
			$p_id_arr = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$oid'";
			$p_id = $wpdb->get_results($p_id_arr);								
			$pid = $p_id[0]->pid;
			$own_id_arr = "select post_author from ".$wpdb->prefix."posts where ID = '$pid'";
			$own_id = $wpdb->get_results($own_id_arr);
			$ownid = $own_id[0]->post_author;
			?>
			<a href="http://fourchillies.com/my-account/private-messages/?priv_act=send&pid=<?php echo $pid; ?>&uid=<?php echo $ownid; ?>&paythis" class="btns_pay" ><?php _e('Pay by Bank Transfer/ Cash on Delivery','Walleto'); ?></a>
            </p>
            <script>
            //console.log($(".oid").val());
            
            </script>
            <?php
			
				$Walleto_paypal_enable = get_option('Walleto_paypal_enable');
				if($Walleto_paypal_enable == "yes"):
			
			?>
            
				<?php
				
					global $wpdb;
					$s = "select distinct posts.post_author from ".$wpdb->prefix."walleto_order_contents cnt, $wpdb->posts posts where cnt.orderid='$oid' AND cnt.paid='0' AND posts.ID=cnt.pid";
					$r = $wpdb->get_results($s);

					
					foreach($r as $row)
					{
						$userdata = get_userdata($row->post_author);
						$sk = $userdata->user_login;
						$sm = walleto_get_show_price(walleto_get_total_of_order_for_user($oid, $row->post_author));
						echo '<a href="'.get_bloginfo('siteurl').'/?pay_order_by_paypal='.$oid.'&uid='.$row->post_author.'" class="btns_pay">'.sprintf(__('Pay %s by PayPal to %s','Walleto'), $sm, $sk).'</a>';	
					}
				
				?>            
            
            <?php endif; ?>
            
            
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
