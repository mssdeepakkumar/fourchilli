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


if(!function_exists('Walleto_my_account_display_shipped_orders_page'))
{
function Walleto_my_account_display_shipped_orders_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	// this page shows for the seller/shop owner
?>	

		<div class="my_box3">
		<div class="middle_text_section_row">
            	<div class="box_title my_account_title"><?php _e("Shipped Orders",'Walleto'); ?></div>
                
            
			<?php
                 
			global $wpdb;
			$s = "select distinct cnt.orderid from ".$wpdb->prefix."walleto_order_contents cnt, $wpdb->posts posts where 
			cnt.paid='1' and cnt.shipped='1' AND posts.ID=cnt.pid AND posts.post_author='$uid' order by cnt.id desc";
			
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
            	
            <div class="responsive_table">
		<table class="shopping_cart" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tbody>
		<tr class="head">
                <td class="my_order_id"><?php echo __('Order ID','Walleto'); ?></td>
		<td class="my_order_id"><?php echo __('Buyer','Walleto'); ?></td>
                <td class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></td>
                <td class="my_order_price"><?php echo __('Order Total','Walleto'); ?></td>
                <td class="my_order_buttons"><?php echo __('Options','Walleto'); ?></td>
		</tr>
            
            <?php  
				foreach($r as $row)
				{
					$s1 = "select * from ".$wpdb->prefix."walleto_orders where id='{$row->orderid}'";
					$r1 = $wpdb->get_results($s1);   
					$row1 = $r1[0];  
					
					walleto_display_done_payments_for_seller($row1); 				
				}
	   ?>
	        </tbody>
		</table>
		</div>
		<?php 	
			}
			else
			{
				_e('There are no orders yet.','Walleto');	
			}
			
		?>
            
			
			
			
			
			
		 
			
			
			
		</div> <!-- end div content -->
		</div> 

<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>