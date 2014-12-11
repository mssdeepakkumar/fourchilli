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
<div id="content">
			  <!-- ############################################# -->
    
                
                <div class="my_box3">
            
            
            	<div class="my_account_title box_title"><?php _e("Reviews I need to award",'Walleto'); ?></div>
                <div class="box_content">    
				
              	<?php
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."walleto_ratings where fromuser='$uid' AND awarded='0' order by id desc";
					$r = $wpdb->get_results($query);
					
					if(count($r) > 0)
					{
						echo '<table width="100%">';
							echo '<tr>';
								 
								echo '<th><b>'.__('Order ID','Walleto').'</b></th>';
								echo '<th><b>'.__('To User','Walleto').'</b></th>';									
								echo '<th><b>'.__('Aquired on','Walleto').'</b></th>';								
								echo '<th><b>'.__('Price','Walleto').'</b></th>';
								echo '<th><b>'.__('Options','Walleto').'</b></th>';
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$order 	= walleto_get_order_obj($row->orderid);
							$user 	= get_userdata($row->touser);
							 
							
							echo '<tr>';
								
								echo '<th>#'.$row->orderid.'</th>';	
								echo '<th><a href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></th>';							
								echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';								
								echo '<th>'.Walleto_get_show_price($order->totalprice + $order->shipping).'</th>';
								echo '<th><a href="'.get_bloginfo('siteurl').'/?w_action=rate_user&rid='.$row->id.'">'.__('Rate User','Walleto').'</a></th>';
							
							echo '</tr>';
							
						}
						
						echo '</table>';
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
       
            
            	<div class="my_account_title box_title"><?php _e("Reviews I am waiting ",'Walleto'); ?></div>
                <div class="box_content">    
				
              	<?php
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."walleto_ratings where touser='$uid' AND awarded='0' order by id desc";
					$r = $wpdb->get_results($query);
					
					if(count($r) > 0)
					{
						echo '<table width="100%">';
							echo '<tr>';
								 
								echo '<th><b>'.__('Order ID','Walleto').'</b></th>';								
								echo '<th><b>'.__('From User','Walleto').'</b></th>';	
								echo '<th><b>'.__('Aquired on','Walleto').'</b></th>';								
								echo '<th><b>'.__('Price','Walleto').'</b></th>';
								//echo '<th><b>'.__('Options','Walleto').'</b></th>';
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$order 	= walleto_get_order_obj($row->orderid);
							$user = get_userdata($row->fromuser);
							
							echo '<tr>';
								
								echo '<th>#'.$row->orderid .'</th>';	
 
								echo '<th><a href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></th>';								
								echo '<th>'.date('d-M-Y H:i:s',$row->datemade).'</th>';								
								echo '<th>'.Walleto_get_show_price($order->totalprice + $order->shipping).'</th>';
								//echo '<th><a href="#">Rate User</a></th>';
							
							echo '</tr>';
							
						}
						
						echo '</table>';
					}
					else
					{
						_e("There are no reviews to be awarded.","Walleto");	
					}
				?>
                
              
           </div>
           </div>    
           
           <div class="clear10"></div>
           
           <div class="my_box3">
            
            
            	<div class="my_account_title box_title"><?php _e("Reviews I was awarded ",'Walleto'); ?></div>
                <div class="box_content">    
				
              	<?php
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."walleto_ratings where touser='$uid' AND awarded='1' order by id desc";
					$r = $wpdb->get_results($query);
					
					if(count($r) > 0)
					{
						echo '<table width="100%">';
							echo '<tr>';
								echo '<th>&nbsp;</th>';	
								echo '<th><b>'.__('Order ID','Walleto').'</b></th>';								
								echo '<th><b>'.__('From User','Walleto').'</b></th>';	
								echo '<th><b>'.__('Aquired on','Walleto').'</b></th>';								
								echo '<th><b>'.__('Price','Walleto').'</b></th>';
								echo '<th><b>'.__('Rating','Walleto').'</b></th>';
								
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							$post = $row->pid;
							$post = get_post($post);
							$order 	= walleto_get_order_obj($row->orderid);
							$user = get_userdata($row->fromuser);
							echo '<tr>';
								
								echo '<th>#'.$row->orderid .'</th>';	
								echo '<th><a href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></th>';							
								echo '<th>'.date('d-M-Y H:i:s',$order->date_choosen).'</th>';								
								echo '<th>'.Walleto_get_show_price($order->totalprice + $order->shipping).'</th>';
								echo '<th>'.$row->grade.'</th>';
								
							
							echo '</tr>';
							echo '<tr>';
							echo '<th></th>';
							echo '<th colspan="5"><b>'.__('Comment','Walleto').':</b> '.$row->comment.'</th>'	;						
							echo '</tr>';
							
							echo '<tr><th colspan="6"><hr color="#eee" /></th></tr>';
							
						}
						
						echo '</table>';
					}
					else
					{
						_e("There are no reviews to be awarded.","Walleto");	
					}
				?>
                
                
           </div>
           </div>    
                

    
    
    <!-- ############################################# -->
    </div>
    


<?php

	echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>