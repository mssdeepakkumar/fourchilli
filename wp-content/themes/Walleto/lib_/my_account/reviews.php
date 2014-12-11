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


if(!function_exists('Walleto_my_account_display_reviews_page'))
{
function Walleto_my_account_display_reviews_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	global $wpdb,$wp_rewrite,$wp_query;
	
	
?>	

	<!-- ############################################# -->
    
                
                <div class="my_box3">
            
            
            	<div class="my_account_title box_title"><?php _e("Reviews to be Awarded",'Walleto'); ?></div>
                <div class="box_content">    
				
              	<?php
					
			global $wpdb;
			$query = "select * from ".$wpdb->prefix."walleto_ratings where fromuser='$uid' AND awarded='0' order by id desc";
			$r = $wpdb->get_results($query);
			
			if(count($r) > 0)
			{
			echo '<div class="responsive_table">
			<table class="shopping_cart" width="100%" border="0" cellspacing="0" cellpadding="0">';
							echo '<tbody><tr class="head">';
								 
								echo '<td>'.__('Product','Walleto').'</td>';
								echo '<td>'.__('To User','Walleto').'</td>';									
								echo '<td>'.__('Aquired on','Walleto').'</td>';								
								echo '<td>'.__('Price','Walleto').'</td>';
								echo '<td>'.__('Options','Walleto').'</td>';
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$order 	= walleto_get_order_obj($row->orderid);
							$user 	= get_userdata($row->touser);
							$sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$row->orderid'";
							$pid = $wpdb->get_results($sql); 
							$post = $pid[0]; 
							
							echo '<tr>';
								
								echo '<td>'.walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post').'</td>';	
								echo '<td><a class="red-txt" href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';							
								echo '<td>'.date('d-M-Y H:i:s', $row->datemade).'</td>';								
								echo '<td>'.Walleto_get_show_price($order->totalprice + $order->shipping).'</td>';
								echo '<td><a class="red-txt" href="'.get_bloginfo('siteurl').'/?w_action=rate_user&rid='.$row->id.'">'.__('Rate User','Walleto').'</a></td>';
							
							echo '</tr>';
							
						}
						
						echo '</tbody></table></div>';
					}
					else
					{
						_e("There are no reviews to be awarded.","Walleto");	
					}
				?>
                
                
           </div>
           </div>    
           
           <!-- ##### -->
           <div class="clear10"></div>
           
           <div class="my_box3">
       
            
            	<div class="my_account_title box_title"><?php _e("Reviews waiting to be Received",'Walleto'); ?></div>
                <div class="box_content">    
				
              	<?php
					
			global $wpdb;
			$query = "select * from ".$wpdb->prefix."walleto_ratings where touser='$uid' AND awarded='0' order by id desc";
			$r = $wpdb->get_results($query);
			
			if(count($r) > 0)
			{
			echo '<div class="responsive_table">
			<table class="shopping_cart" width="100%" border="0" cellspacing="0" cellpadding="0">';
							echo '<tbody><tr class="head">';
								 
								echo '<td>'.__('Product','Walleto').'</td>';
								echo '<td>'.__('To User','Walleto').'</td>';									
								echo '<td>'.__('Aquired on','Walleto').'</td>';								
								echo '<td>'.__('Price','Walleto').'</td>';
								//echo '<td>'.__('Options','Walleto').'</th>';
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$order 	= walleto_get_order_obj($row->orderid);
							$user = get_userdata($row->fromuser);
							$sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$row->orderid'";
							$pid = $wpdb->get_results($sql); 
							$post = $pid[0];
							
							echo '<tr>';
								
								echo '<td>'.walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post').'</td>';	
 
								echo '<td><a class="red-txt" href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';								
								echo '<td>'.date('d-M-Y H:i:s',$row->datemade).'</td>';								
								echo '<td>'.Walleto_get_show_price($order->totalprice + $order->shipping).'</td>';
								//echo '<td><a href="#">Rate User</a></td>';
							
							echo '</tr>';
							
						}
						
						echo '<tbody></table></div>';
					}
					else
					{
						_e("There are no reviews waiting to be Received.","Walleto");	
					}
				?>
                
              
           </div>
           </div>    
          
           <div class="clear10"></div>
           
           <div class="my_box3">
            
            
            	<div class="my_account_title box_title"><?php _e("Recently Awarded Reviews",'Walleto'); ?></div>
                <div class="box_content">    
				
              	<?php
					
			global $wpdb;
			$query = "select * from ".$wpdb->prefix."walleto_ratings where touser='$uid' AND awarded='1' order by id desc";
			$r = $wpdb->get_results($query);
			
			if(count($r) > 0)
			{
			echo '<div class="responsive_table">
			<table class="shopping_cart" width="100%" border="0" cellspacing="0" cellpadding="0">';
						echo '<tbody><tr class="head">';	
							
							echo '<td>'.__('Product','Walleto').'</td>';
							echo '<td>'.__('To User','Walleto').'</td>';									
							echo '<td>'.__('Aquired on','Walleto').'</td>';								
							echo '<td>'.__('Price','Walleto').'</td>';
							echo '<td>'.__('Grade','Walleto').'</td>';
							
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$post = $row->pid;
							$post = get_post($post);
							$order 	= walleto_get_order_obj($row->orderid);
							$user = get_userdata($row->fromuser);
							
							$sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$row->orderid'";
							$pid = $wpdb->get_results($sql); 
							$post = $pid[0];
							echo '<tr>';
								
								echo '<td>'.walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post').'</td>';	
								echo '<td><a class="red-txt" href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';							
								echo '<td>'.date('d-M-Y H:i:s',$order->date_choosen).'</td>';								
								echo '<td>'.Walleto_get_show_price($order->totalprice + $order->shipping).'</td>';
								echo '<td>'.$row->grade.'</td>';
								
							
							echo '</tr>';
							echo '<tr>';
							
							echo '<td colspan="5"><b>'.__('Comment','Walleto').':</b> '.$row->comment.'</td>'	;						
							echo '</tr>';
							
							
							
						}
						
						echo '</tbody></table></div>';
					}
					else
					{
						_e("There are no reviews to be awarded.","Walleto");	
					}
				?>
                
                
           </div>
           </div>    
                
	  <div class="clear10"></div>
    
    
	<!-- ############################################# -->

    


<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
