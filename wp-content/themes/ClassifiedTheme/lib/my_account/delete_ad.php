<?php
/********************************************************************************
*
*	ClassifiedTheme - copyright (c) - sitemile.com - Details
*	http://sitemile.com/p/classifiedTheme
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v6.2.1
*
*********************************************************************************/
	 
	global $current_user, $wp_query;
	$pid 	=  $wp_query->query_vars['pid'];
	
	global $post_au;
	$post_au = get_post($pid);
	
	
	function ClassifiedTheme_filter_ttl($title){ global $post_au; return __("Delete Listing",'ClassifiedTheme')." - ".$post_au->post_title;}
	add_filter( 'wp_title', 'ClassifiedTheme_filter_ttl', 10, 3 );	
	
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
						$acc = ClassifiedTheme_my_account_link();
						wp_redirect($acc);
						exit;
				}

//-------------------------------------

	get_header();
	
	$post_au = get_post($pid);
	
?>


	<div id="content" >
        	
            <div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php printf(__("Delete Listing - %s", "ClassifiedTheme"), $post_au->post_title); ?></div>
                <div class="box_content"> 
            	
                <?php
				
				if(isset($_POST['yes_confirm']))
				{
					$acc = classifiedTheme_my_account_link();
					echo '<div class="deleted_item_ok">';
					printf(__('Your item has been deleted. <a href="%s">Return to your account</a>.','ClassifiedTheme'), $acc);
					echo '</div>';
					wp_delete_post($pid);
					
					//wp_redirect($acc);	
				}
				else
				{
		
		?>
                
                
                <form method="post">
                <div class="are_you_sure_delete">
        		<?php
				
				_e('Are you sure you want to delete this item?','ClassifiedTheme');
				
				
				?>
                
                </div>
                
                <input type="submit" value="<?php _e('Yes','ClassifiedTheme'); ?>" name="yes_confirm" />
                 <input type="submit" value="<?php _e('No','ClassifiedTheme'); ?>" name="no_confirm" />
                
                
                </form>
                
                <?php } ?>
                </div>
                </div>
                </div>
                </div>
                
	<?php ClassifiedTheme_get_users_links(); ?>

<?php get_footer(); ?>