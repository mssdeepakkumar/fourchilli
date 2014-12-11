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

function ClassifiedTheme_my_account_home_area_main_function()
{
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
		<div id="content">
       
        		<div class="my_box3">
            	<div class="padd10">            
            	<div class="box_title"><?php _e("My Latest Active Listings",'ClassifiedTheme'); ?></div>
                <div class="box_content"> 
        		
                	
                    <?php

					query_posts( "meta_key=closed&meta_value=0&post_type=ad&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );
	
					if(have_posts()) :
					while ( have_posts() ) : the_post();
						classifiedTheme_get_post();
					endwhile; else:
					
					_e("There are no listings yet.",'ClassifiedTheme');
					
					endif;
					
					wp_reset_query();
					
					?>
                    
                </div>
                </div>
                </div>
                
                <div class="clear10"></div>
			
			
			<div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php _e("My Unpaid/Pending Listings",'ClassifiedTheme'); ?></div>
                <div class="box_content">    
			
			
				<?php

				query_posts( "post_status=draft&post_type=ad&order=DESC&orderby=id&author=".$uid."&posts_per_page=3" );
				
				if(have_posts()) :
				while ( have_posts() ) : the_post();
					classifiedTheme_get_post();
				endwhile; else:
				
				_e("There are no listings yet.",'ClassifiedTheme');
				
				endif;
				
				wp_reset_query();
				
				?>
			
			</div>
			</div>
			</div>
                
           
        
                
             <!-- ##################### -->   
        
        </div>


<?php	classifiedTheme_get_users_links();		
	
	
}

?>