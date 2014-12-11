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


if(!function_exists('walleto_blog_posts_area_function'))
{
function walleto_blog_posts_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
<div id="content"> 
<div class="my_box3"> 
            
            	<div class="box_title"><?php echo sprintf(__("Blog Posts",'Walleto')); ?></div>
                <div class="box_content">   
               
                
                <?php
					
					$args = array('post_type' => 'post', 'paged' => $paged);
					$my_query = new WP_Query( $args );

					if($my_query->have_posts()):
					while ( $my_query->have_posts() ) : $my_query->the_post();
					
						walleto_get_post_blog();
					
					endwhile;
					
						if(function_exists('wp_pagenavi')):
							wp_pagenavi( array( 'query' => $my_query ) );
						endif;
					
					else:
					_e('There are no blog posts.','Walleto');
					
					endif;
					
					
					
					?>
                
           
                </div>
                </div></div>

<!-- ############## -->

   
    <div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
    </div>
    


<?php

 
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>