<?php
/********************************************************************************
*
*	ClassifiedTheme - copyright (c) - sitemile.com - Details
*	if you want to remove actions from the sitemile framework use the hook
*	sitemile_pre_load to add your functions which contains the remove_filters
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v6.2.1
*
*********************************************************************************/


function ClassifiedTheme_my_account_active_listings_area_function()
{
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	global $wpdb,$wp_rewrite,$wp_query;
	
	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
    
            <div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php _e("Active Listings","ClassifiedTheme"); ?></div>
            	<div class="box_content">
    			


					<?php

					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$post_per_page = 8;				
				
					query_posts( "meta_key=closed&meta_value=0&post_status=publish&post_type=ad&order=DESC&orderby=id&author=".$uid."&posts_per_page=" . $post_per_page . "&paged=" . $query_vars['paged'] );
	
					if(have_posts()) :
					while ( have_posts() ) : the_post();
						classifiedTheme_get_post();
					endwhile; 
					
					if(function_exists('wp_pagenavi')):
					wp_pagenavi(); endif;
					
					else:
					
					_e("There are no active listings yet.",'ClassifiedTheme');
					
					endif;
					
					wp_reset_query();
					
					?>



                
                </div>
                </div>
           </div>
    
    
    <!-- ############################################# -->
    </div>
    
    <?php
	
	classifiedTheme_get_users_links();
	
}

?>