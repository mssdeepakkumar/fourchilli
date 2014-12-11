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

	 
	global $wpdb, $current_user, $wp_query;
	$oid 	=  $_GET['oid'];
	
	$s = "select * from ".$wpdb->prefix."walleto_orders where id='$oid'";
	$r = $wpdb->get_results($s);
	$row = $r[0];
	
	//----------------------------------------------------------------------
 
	function Walleto_filter_ttl($title){ global $post_au; return sprintf(__("Mark as Shipped - Order #%s",'Walleto'), $oid); }
	add_filter( 'wp_title', 'Walleto_filter_ttl', 10, 3 );	
	
	if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }   
	   
	
	get_currentuserinfo();   

	$uid 	= $current_user->ID;
	$cid 	= $current_user->ID;
	$rrr = 0;
	
	global $wpdb;
	$s = "select distinct posts.post_author from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 
				ord.paid='1' and ord.shipped='0' AND ord.id=cnt.orderid and cnt.orderid='$oid' AND posts.ID=cnt.pid order by ord.id desc";
	$r = $wpdb->get_results($s);
	
	foreach($r as $rww)
	{
		if($uid == $rww->post_author) { $rrr = 1; break; }	
	}
	
	if($rrr == 0) { echo 'oups. no rights. not your order.'; exit; }
	
	//=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	
			global $wpdb,$wp_rewrite,$wp_query;
		
			if(isset($_POST['no_confirm']))
			{
					$acc = get_permalink(get_option('Walleto_my_account_aw_shp_page_id'));
					wp_redirect($acc);
					exit;
			}
 
			
			
//-------------------------------------

	get_header();
	
 
	
?>


	<div id="content" >
        	
            <div class="my_box3">
            
            	<div class="box_title my_account_title"><?php printf(__("Mark Order Shipped - #%s", "Walleto"), $oid); ?></div>
                <div class="box_content"> 
            	
                <?php
				
				if(isset($_POST['yes_confirm']))
				{
					$acc 		= get_permalink(get_option('Walleto_my_account_shp_ord_page_id'));
					$datemade 	= current_time('timestamp',0);
					
					//******************************
					
					global $wpdb;
					
					$s = "select * from ".$wpdb->prefix."walleto_order_contents cnt, $wpdb->posts posts where cnt.orderid='$oid' AND cnt.shipped='0' AND posts.post_author='$uid' AND posts.ID=cnt.pid";
					$r = $wpdb->get_results($s);	
					
					 
					foreach($r as $row)
					{
						$idso = $row->id;
						$wpdb->query("update ".$wpdb->prefix."walleto_order_contents set shipped='1', shipped_on='$datemade' where id='$idso'");
					}
					
					//------------------------------
					
					$walleto_check_if_order_is_shipped_fully = walleto_check_if_order_is_shipped_fully($oid);
		
					if($walleto_check_if_order_is_shipped_fully == false)
					{
						$wpdb->query("update ".$wpdb->prefix."walleto_orders set shipped='0', partially_shipped='1' where id='$oid'");	
					}
					else
					{
						$wpdb->query("update ".$wpdb->prefix."walleto_orders set shipped='1', partially_shipped='1', shipped_on='$datemade' where id='$oid'");
					}
					
					//******************************
					
					echo '<div class="deleted_item_ok">';
					printf(__('Your item has been marked as shipped. <a href="%s">Return to your shipped orders</a>.','Walleto'), $acc);
					echo '</div>';
					//wp_delete_post($pid);
					
					//wp_redirect($acc);	
				}
				else
				{
		
		?>
                
                
                <form method="post">
                <div class="are_you_sure_delete">
        		<?php
				
				_e('Are you sure you want to mark this order as shipped?','Walleto');
				
				
				?>
                
                </div>
                
                <input type="submit" value="<?php _e('Yes','Walleto'); ?>" name="yes_confirm" />
                 <input type="submit" value="<?php _e('No','Walleto'); ?>" name="no_confirm" />
                
                
                </form>
                
                <?php } ?>

                </div>
                </div>
                </div>
                
	<?php Walleto_get_users_links(); ?>

<?php get_footer(); ?>