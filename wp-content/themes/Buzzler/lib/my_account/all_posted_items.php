<?php
/***************************************************************************
*
*	Buzzler - copyright (c) - sitemile.com
*	WordPress Business Directory Theme
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/buzzler
*	since v1.0
*
***************************************************************************/


function buzzler_my_account_all_posted_listings_area_function()
{
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>

	<div id="content" class="content_my_account" >
    
    			<div class="my_box3">          
            	<div class="box_title menu-title-item"><h1><?php _e("All Live Listings",'Buzzler'); ?></h1></div>
                <div class="box_content"> 
    			
                    <?php
					
					$lst_per_page = 8;
					$lst_per_page = apply_filters('Buzzler_listings_per_page_my_account',$lst_per_page);

					query_posts( "meta_key=closed&meta_value=0&post_type=listing&order=DESC&orderby=id&author=".$uid."&posts_per_page=" . $lst_per_page );
	
					if(have_posts()) :
					while ( have_posts() ) : the_post();
						buzzler_get_post();
					endwhile; else:
					
					_e("There are no listings yet.",'Buzzler');
					
					endif;
					
					wp_reset_query();
					
					?>
              
                </div>
                </div>
                
    </div>


<?php	
		
	buzzler_get_users_links();		
		
}

?>