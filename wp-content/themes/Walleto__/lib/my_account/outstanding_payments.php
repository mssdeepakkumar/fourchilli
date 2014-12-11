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


if(!function_exists('Walleto_my_account_display_outstanding_pay_page'))
{
function Walleto_my_account_display_outstanding_pay_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	

			
            
            	<div class="middle_text_section_row">
            	<div class="product_list_heading"> <span class="heading_text"><?php _e("Outstanding Payments",'Walleto'); ?></span> </div>
                
		
		<div class="middle_text_description">
		<div class="responsive_table" id="">
		
		<table class="shopping_cart table_white" width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
		<td><div class="my_order_id"><?php echo __('Order ID','Walleto'); ?></div></td>
                <td><div class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></div></td>
                <td><div class="my_order_price"><?php echo __('Order Total','Walleto'); ?></div></td>
                <td><div class="my_order_left_to_pays"><?php echo __('Left to Pay','Walleto'); ?></div></td>
                <td><div class="my_order_buttons"><?php echo __('Options','Walleto'); ?></div></td>
		</thead>
               
                <?php
                 
			global $wpdb;
			$s = "select * from ".$wpdb->prefix."walleto_orders where uid='$uid' AND paid='0' order by id desc";
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
            	
             
              
                <tbody>	
            
            
            <?php
				foreach($r as $row)
				{
					walleto_display_unpaid_order_for_buyer($row);				
				}
			
			
			}
			else
			{
				_e('There are no outstanding orders.','Walleto');	
			}
			
			?>

		</tbody>
		</table>	
		</div>
                </div>
		</div>
			
			
			
			
			
		 
			
			
			
		


<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
