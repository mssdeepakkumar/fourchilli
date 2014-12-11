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


if(!function_exists('walleto_watchlist_area_function'))
{
function walleto_watchlist_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
<section id="product_list_new" class="product_list_wrapper wedding_products_wrapper_class">
        <div class="product_list_heading">
	   <span class="heading_text"><?php echo sprintf(__("Watch List",'Walleto')); ?></span>
        </div> 
            
            	
               <ul class="list-unstyled product_listing_ul product_lising_four_products">
               
                
                      <?php
				
				
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."walleto_watchlist where uid='$uid' order by id asc";	
				$r = $wpdb->get_results($s);

				$my_arr = array();
					
				if(count($r) > 0)
				foreach($r as $item)
				{
					$my_arr[] = $item->pid;	
				}					
				
				if(count($my_arr) == 0) $my_arr[0] = 0;		
				
				$args = array('post__in' => $my_arr,
				'post_type' 	=> 'product', 
				'paged'			=> $wp_query->query_vars['paged']);
				
				$the_query = new WP_Query( $args );				
				
				if($the_query->have_posts()):
				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
				
					walleto_get_post();
					
				endwhile;
				
				if(function_exists('wp_pagenavi')):
		
					echo '<div class="navi-wrap">';
					wp_pagenavi( array( 'query' => $the_query ) );
					echo '</div>';
				
				endif;
				
				else:
					_e('There are no items in your watch list.','Walleto');
				endif;
				
				// Reset Post Data
				wp_reset_postdata();
								
				?>
                
           
                </ul>
               
</section>
<?php

 
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>