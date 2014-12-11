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


if(!function_exists('Walleto_my_account_display_home_page'))
{
function Walleto_my_account_display_home_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>
	
        
           
        <!--row start-->
        <div class="middle_text_section_row">
	<div class="product_list_heading"> <span class="heading_text">My Account Home <br><span class="p_awating">Awaiting Shipping</span></span> </div>
		<div class="middle_text_description">
		<div class="responsive_table" id="">
		
		<table class="shopping_cart table_white" width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
			<tr class="head">
                            <td>Product</td> 
                                   
                            <td><div class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></div></td>
                            <td><div class="my_order_price"><?php echo __('Order Total','Walleto'); ?></div></td>
                            <td><div class="my_order_details"><?php echo __('Paid On','Walleto'); ?></div></td>
                            
			    <td><div class="my_order_buttons"><?php echo __('Options','Walleto'); ?></div></td>
                        </tr>
		</thead>   
              
                <tbody>	
            
            	
               
                 <?php
                 
			global $wpdb;
			$s = "select distinct cnt.orderid from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 
			ord.paid='1' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND cnt.shipped='0' and posts.post_author='$uid' order by ord.id desc limit 3";
			
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
		
               
                
                
            
            
		<?php
				foreach($r as $row)
				{
					$s1 = "select * from ".$wpdb->prefix."walleto_orders where id='{$row->orderid}'";
					$r1 = $wpdb->get_results($s1);
					$row1 = $r1[0];
					
					walleto_display_awaiting_shipping_for_seller($row1);				
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
                </div>
		</div>
	
	
	
		<div class="middle_text_section_row">
            	<div class="product_list_heading"> <span class="heading_text"><?php _e("Outstanding Payments",'Walleto'); ?></span> </div>
                
		
		<div class="middle_text_description">
		<div class="responsive_table" id="">
		
		<table class="shopping_cart table_white" width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
		<td><div class="my_order_id"><?php echo __('Product','Walleto'); ?></div></td>
                <td><div class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></div></td>
                <td><div class="my_order_price"><?php echo __('Order Total','Walleto'); ?></div></td>
                <td><div class="my_order_left_to_pay"><?php echo __('Left to Pay','Walleto'); ?></div></td>
                <td><div class="my_order_buttons"><?php echo __('Options','Walleto'); ?></div></td>
		</thead>
                <?php
                 
			global $wpdb;
			$s = "select * from ".$wpdb->prefix."walleto_orders where uid='$uid' AND paid='0' order by id desc limit 3";
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
            	
		
                
		
            
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

	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}} ?>
