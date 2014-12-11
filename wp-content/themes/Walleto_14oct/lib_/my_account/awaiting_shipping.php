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


if(!function_exists('Walleto_my_account_display_awa_shp_page'))
{
function Walleto_my_account_display_awa_shp_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	

		<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Awaiting Shipping",'Walleto'); ?></div>
                  
                <?php
                 
			global $wpdb;
			
			//------------------------
			
			$post_per_page = 8;				
			$page = $_GET['pj'];
			if(empty($page)) $page = 1;
			
			$s1 = "select count(distinct cnt.orderid) cnts from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 
			ord.paid='1' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND cnt.shipped='0' AND posts.post_author='$uid' order by ord.id desc";
			$r1 = $wpdb->get_results($s1);
			$rws = $r1[0];
			
			$total_count 	= $rws->cnts;
			$totalPages 	= ($total_count > 0 ? ceil($total_count / $post_per_page) : 0);
	 
			//-----------------------
			
			$s = "select distinct cnt.orderid from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 
			ord.paid='1' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND cnt.shipped='0' AND posts.post_author='$uid' order by ord.id desc LIMIT ".($post_per_page * ($page - 1) ).",". $post_per_page;
			
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
		<div class="responsive_table" id="">
		
		<table class="shopping_cart table_white" width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
		<tr class="head">
                <td class="my_order_id"><?php echo __('Order ID','Walleto'); ?></td>
                <td class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></td>
                <td class="my_order_price"><?php echo __('Order Total','Walleto'); ?></td>
                <td class="my_order_details"><?php echo __('Paid On','Walleto'); ?></td>
                <td class="my_order_buttons"><?php echo __('Options','Walleto'); ?></td>
		</tr>
		</thead>
		<tbody>
            
		<?php
				foreach($r as $row)
				{
					$s1 = "select * from ".$wpdb->prefix."walleto_orders where id='{$row->orderid}'";
					$r1 = $wpdb->get_results($s1);
					$row1 = $r1[0];
					
					walleto_display_awaiting_shipping_for_seller($row1);				
				}
		?>
            
             
                <?php 
			
			}
			else
			{
				_e('There are no orders yet.','Walleto');	
			}
			
			?>

		</tbody>
		</table>	
		</div>	
			
		 
			
			
			
		</div> <!-- end div content -->


<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
