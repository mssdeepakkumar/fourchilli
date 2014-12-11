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


if(!function_exists('walleto_get_my_order_content_area_function'))
{
function walleto_get_my_order_content_area_function()
{

	ob_start();
	
	$oid = $_GET['oid'];
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
<div id="content">
			<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php echo sprintf(__("Order Content %s",'Walleto'), '#'.$oid); ?></div>
                <div class="box_content">   
                <?php
				
					global $wpdb;
					$s = "select * from ".$wpdb->prefix."walleto_order_contents where orderid='$oid' order by id desc";
					$r = $wpdb->get_results($s);
					
					if(count($r) > 0)
					{
					?>
						
					<div class="my_order header_side">
						<div class="my_prod_pic"><?php echo __('Picture','Walleto'); ?></div>
						<div class="my_prod_title"><?php echo __('Item','Walleto'); ?></div>
                        <div class="my_prod_owner"><?php echo __('Seller','Walleto'); ?></div>
						<div class="my_prod_price"><?php echo __('Item Price','Walleto'); ?></div>
						<div class="my_prod_quant"><?php echo __('Quantity','Walleto'); ?></div>
                        <div class="my_prod_sts"><?php echo __('Shipped','Walleto'); ?></div>
                        <div class="my_prod_sts"><?php echo __('Paid','Walleto'); ?></div>
					</div>
					
					<?php
						
						foreach($r as $row)
						{
							 $post_au = get_post($row->pid);
							 $owner = get_userdata($post_au->post_author);
							 
							?>
                            
                            	<div class="my_order">
                                    <div class="my_prod_pic"><?php echo walleto_get_first_post_image($row->pid,75,65); ?></div>
                                    <div class="my_prod_title"><a href="<?php echo get_permalink($row->pid); ?>"><?php echo $post_au->post_title; ?></a></div>
                                    <div class="my_prod_owner"><?php echo ($owner->user_login); ?></div>
                                    <div class="my_prod_price"><?php echo walleto_get_show_price($row->price); ?></div>
                                    <div class="my_prod_quant"><?php echo $row->quant; ?></div>
                                    <div class="my_prod_sts"><?php echo ($row->shipped == 0 ? __('No','Walleto') : __('Yes','Walleto')); ?></div>
                                    <div class="my_prod_sts2"><?php echo ($row->paid == 0 ? __('No','Walleto') : __('Yes','Walleto')); ?></div>
                                </div>
                            	<div class="downloads-as">
                                	<?php do_action('walleto_post_content_after_buttons_fnc', $row->pid); ?>
                                </div>
                            <?php			
						}
					
					
					}
					else
					{
						_e('There are no outstanding orders.','Walleto');	
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