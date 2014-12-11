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


if(!function_exists('Walleto_my_account_display_all_orders_page'))
{
function Walleto_my_account_display_all_orders_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	

		<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("All My Orders",'Walleto'); ?></div>
               
                <?php
                 
			global $wpdb;
			$s = "select * from ".$wpdb->prefix."walleto_orders where uid='$uid' order by id desc";
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
            	
            <div class="responsive_table">
		<table class="shopping_cart" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="head">
                <td class="my_order_id"><?php echo __('Order ID','Walleto'); ?></td>
                <td class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></td>
                <td class="my_order_price"><?php echo __('Order Total','Walleto'); ?></td>
		 <td class="my_order_price"><?php echo __('Left to Pay','Walleto'); ?></td>
                <td class="my_order_buttons"><?php echo __('Options','Walleto'); ?></td>
		</tr>
		
            
            <?php
				foreach($r as $row)
				{
					if($row->paid == 0 and $row->shipped == 0)
					walleto_display_unpaid_order_for_buyer($row);
					
					if($row->paid == 1 and $row->shipped == 0)
					walleto_display_unshipped_order_for_buyer($row);	
					
					if($row->paid == 1 and $row->shipped == 1)
					walleto_display_shipped_order_for_buyer($row);				
				}
			 
			
			}
			else
			{
				_e('There are no orders yet.','Walleto');	
			}
			
			?>
			</tbody>
			</table>
			</div>
			
			
			
			
			
		 
<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
