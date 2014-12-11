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

	 
	global $current_user, $wp_query;
	$pid 	=  $wp_query->query_vars['pid'];
	
	global $post_au;
	$post_au = get_post($pid);
	
	
	function Walleto_filter_ttl($title){ global $post_au; return __("Activate Selling Product",'Walleto')." - ".$post_au->post_title;}
	add_filter( 'wp_title', 'Walleto_filter_ttl', 10, 3 );	
	
	if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }   
	   
	
	get_currentuserinfo();   

	$uid 	= $current_user->ID;
	$title 	= $post_au->post_title;
	$cid 	= $current_user->ID;
	
	if($uid != $post_au->post_author) { echo 'Not your post. Sorry!'; exit; }
	
	//=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	
			global $wpdb,$wp_rewrite,$wp_query;
		
			if(isset($_POST['no_confirm']))
				{
						$acc = Walleto_my_account_link();
						wp_redirect($acc);
						exit;
				}

//-------------------------------------

	get_header();
	
	$post_au = get_post($pid);
	
?>


	<div id="content" >
        	
            <div class="my_box3">
            
            	<div class="box_title my_account_title"><?php printf(__("Activate Selling Product - %s", "Walleto"), $post_au->post_title); ?></div>
                <div class="box_content"> 
            	
                <?php
				
				if(isset($_POST['yes_confirm']))
				{
					$acc = Walleto_my_account_link();
					echo '<div class="deleted_item_ok">';
					printf(__('Your item has been activated for selling. <a href="%s">Return to your account</a>.','Walleto'), $acc);
					echo '</div>';
					update_post_meta($pid,'status','active');
					
					//wp_redirect($acc);	
				}
				else
				{
		
		?>
                
                
                <form method="post">
                <div class="are_you_sure_delete">
        		<?php
				
				_e('Are you sure you want to mark this product as active for selling?','Walleto');
				
				
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