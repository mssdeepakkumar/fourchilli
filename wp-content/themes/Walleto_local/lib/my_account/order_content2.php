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


if(!function_exists('walleto_get_my_order_content_area_function2'))
{
function walleto_get_my_order_content_area_function2()
{

	ob_start();
	
	$oid = $_GET['oid'];
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	

		<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php echo sprintf(__("Order Content %s",'Walleto'), '#'.$oid); ?></div>
                 
                <?php
				
					global $wpdb;
					$s = "select distinct ord.* from ".$wpdb->prefix."walleto_order_contents ord, $wpdb->posts posts where ord.orderid='$oid' and ord.pid=posts.ID and posts.post_author='$uid' order by ord.id desc";
					$r = $wpdb->get_results($s);
					
					if(count($r) > 0)
					{
					?>
						
		<div class="responsive_table" id="">
		<table class="shopping_cart table_white" width="100%" border="0" cellspacing="0" cellpadding="0">
                <thead>
			<tr class="head">
			<td class="my_prod_pic"><?php echo __('Picture','Walleto'); ?></td>
			<td class="my_prod_title"><?php echo __('Item','Walleto'); ?></td>
                        <td class="my_prod_owner"><?php echo __('Seller','Walleto'); ?></td>
			<td class="my_prod_price"><?php echo __('Item Price','Walleto'); ?></td>
			<td class="my_prod_quant"><?php echo __('Quantity','Walleto'); ?></td>
                        <td class="my_prod_sts"><?php echo __('Shipped','Walleto'); ?></td>
                        <td class="my_prod_sts2"><?php echo __('Paid','Walleto'); ?></td>
			</tr>
		</thead>   
		<tbody>	 			
					<?php
						
						foreach($r as $row)
						{
							 $post_au = get_post($row->pid);
							 $owner = get_userdata($post_au->post_author);
							?>
                            
                            	<tr class="my_order">
                                    <td class="my_prod_pic"><?php echo walleto_get_first_post_image($row->pid,75,65); ?></td>
                                    <td class="my_prod_title"><a href="<?php echo get_permalink($row->pid); ?>"><?php echo $post_au->post_title; ?></a></td>                                    
                                    <td class="my_prod_owner"><?php echo ($owner->user_login); ?></td>
                                    <td class="my_prod_price"><?php echo walleto_get_show_price($row->price); ?></td>
                                    <td class="my_prod_quant"><?php echo $row->quant; ?></td>
                                    <td class="my_prod_sts"><?php echo ($row->shipped == 0 ? __('No','Walleto') : __('Yes','Walleto')); ?></td>
                                    <td class="my_prod_sts2"><?php echo ($row->paid == 0 ? __('No','Walleto') : __('Yes','Walleto')); ?></td>
                                </tr>
                            </tbody></table>
                            <?php			
						}
					
					
					}
					else
					{
						_e('There are no outstanding orders.','Walleto');	
					}
					
				
				?>

			
			
		 
			
			
			
		</div> <!-- end div box3 -->


<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
