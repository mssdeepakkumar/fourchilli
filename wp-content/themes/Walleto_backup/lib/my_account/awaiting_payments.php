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


if(!function_exists('Walleto_my_account_display_awa_pay_page'))
{
function Walleto_my_account_display_awa_pay_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
<div id="content">
			<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Awaiting Payments",'Walleto'); ?></div>
                <div class="box_content">   
              <?php
                 
			global $wpdb;
			$s = "select distinct cnt.orderid  from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 
			ord.paid='0' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND posts.post_author='$uid' order by ord.id desc";
			
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
            	
            <div class="my_order header_side">
                <div class="my_order_id"><?php echo __('Order ID','Walleto'); ?></div>
                <div class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></div>
                <div class="my_order_price"><?php echo __('Order Total','Walleto'); ?></div>
                <div class="my_order_buttons"><?php echo __('Options','Walleto'); ?></div>
            </div>
            
            <?php
				foreach($r as $row)
				{
					$s1 = "select * from ".$wpdb->prefix."walleto_orders where id='{$row->orderid}'";
					$r1 = $wpdb->get_results($s1);
					$row1 = $r1[0];
					
					walleto_display_awaiting_payments_for_seller($row1);				
				}
			 
			
			}
			else
			{
				_e('There are no orders yet.','Walleto');	
			}
			
			?>

			</div>
			</div>
			
			<div class="clear10"></div>
			
			
		 
			
			
			
		</div> <!-- end div content -->


<?php

	echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>