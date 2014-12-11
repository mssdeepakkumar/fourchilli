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
?>
			<div class="product_list_heading"><span class="heading_text">New Products</span>
			
			</div>
			
			<ul class="list-unstyled product_listing_ul">	
			<?php	
				$limit = 9;

				 global $wpdb;	
				 $querystr = "
					SELECT distinct wposts.* 
					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
					WHERE wposts.ID = wpostmeta.post_id
					AND wpostmeta.meta_key = 'closed' 
					AND wpostmeta.meta_value = '0' AND 
					wposts.post_status = 'publish' 
					AND wposts.post_type = 'product' 
					ORDER BY wposts.post_date DESC LIMIT ".$limit;
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 
				 ?>
					
			<?php $i = 0; if ($pageposts): ?>
			<?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
			
		     
                     <?php walleto_get_post_list_view(); ?>
		     
                     
		     <?php endforeach; ?>
		     </ul>
					
                     <?php else : ?> <?php $no_p = 1; ?>
                       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted products yet","Walleto"); ?>.</p></div>
                        
                     <?php endif; ?>