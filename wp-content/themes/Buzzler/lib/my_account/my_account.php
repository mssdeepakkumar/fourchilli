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


function buzzler_my_account_home_area_function()
{
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
 
?>

	<div id="content" class="content_my_account" >
    
    			<div class="my_box3">          
            	<div class="box_title menu-title-item"><h1><?php _e("My Latest Posted Listings",'Buzzler'); ?></h1></div>
                <div class="box_content"> 
    			
                <?php

					$the_query = new WP_Query( "post_status=published,draft&meta_key=closed&meta_value=0&post_type=listing&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );
					
			 
					if($the_query->have_posts() ) :
					while ( $the_query->have_posts()  ) : $the_query->the_post();
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