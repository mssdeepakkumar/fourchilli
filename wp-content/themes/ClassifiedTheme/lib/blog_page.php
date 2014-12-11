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

function ClassifiedTheme_display_blog_page_disp()
{
	
		global $current_user, $wp_query;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	$paged = $wp_query->query_vars['paged'];
	
	?>
    
        
   <div id="content">
		
<div class="my_box3">
            	<div class="padd10"> 	
            
            		<div class="box_title"><?php echo __("All Blog Posts", 'ClassifiedTheme'); ?></div>
            		<div class="box_content">
                    
                    <?php
					
					$args = array('post_type' => 'post', 'paged' => $paged);
					$my_query = new WP_Query( $args );

					if($my_query->have_posts()):
					while ( $my_query->have_posts() ) : $my_query->the_post();
					
						ClassifiedTheme_get_post_blog();
					
					endwhile;
					
						if(function_exists('wp_pagenavi')):
							wp_pagenavi( array( 'query' => $my_query ) );
						endif;
					
					else:
					_e('There are no blog posts.','ClassifiedTheme');
					
					endif;
					
					
					
					?>
                    
                    </div>
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