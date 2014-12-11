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


				echo '<h3 class="widget-title">'.__('Latest Products','Walleto').'</h3>';
				echo '<div class="switchers">';
				
				$view = walleto_get_current_view_grid_list();
					
					if($view != "grid")
					{
						echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid"></a>';
						echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list-selected"></a>';
					}
					else
					{
						echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid-selected"></a>';
						echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list"></a>';
					}
					
				echo '</div>';
				
				$Walleto_home_page_layout = get_option('Walleto_home_page_layout');
				if($Walleto_home_page_layout == "2" or $Walleto_home_page_layout == "3"):
					global $image_thing_tags;
					$image_thing_tags = 'main-image-post2';
				endif;
				
				$limit = 40;

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
                     
                     
                     <?php //Walleto_get_post(); 
					 
					
					 
					 if($view != "grid")
						 walleto_get_post_list_view();
					 else
					 	Walleto_get_post();
					 
					 ?>
                     
                     
                     <?php endforeach; ?>
                     <?php else : ?> <?php $no_p = 1; ?>
                       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted products yet","Walleto"); ?>.</p></div>
                        
                     <?php endif; ?>