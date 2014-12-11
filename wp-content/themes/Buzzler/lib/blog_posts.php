<?php

function buzzler_blog_pgs_area_function()
{
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	?>
    
        
   <div id="content">
		
<div class="my_box3">
             
            
            		<div class="box_title"><?php echo __("All Blog Posts", 'Buzzler'); ?></div>
            		<div class="box_content">
                    
                    <?php
					
					$args = array('post_type' => 'post');
					$my_query = new WP_Query( $args );

					if($my_query->have_posts()):
					while ( $my_query->have_posts() ) : $my_query->the_post();
					
						buzzler_get_post_blog();
					
					endwhile;
					
						if(function_exists('wp_pagenavi')):
							wp_pagenavi( array( 'query' => $my_query ) );
						endif;
					
					else:
					_e('There are no posts.','Buzzler');
					
					endif;
					
					
					
					?>
                    
               
  </div></div></div>
    
    
      <!-- ################### -->
    
    <div id="right-sidebar">    
    	<ul class="xoxo">
        	 <?php dynamic_sidebar( 'other-page-area' ); ?>
        </ul>    
    </div>
    
    <?php	
	
}

?>