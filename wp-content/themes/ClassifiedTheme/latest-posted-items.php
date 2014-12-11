<?php

			echo '<h3 class="widget-title">'.__('Latest Listings','ClassifiedTheme').'</h3>';

				$limit = 12;

				 global $wpdb;	
				 $querystr = "
					SELECT distinct wposts.* 
					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
					WHERE wposts.ID = wpostmeta.post_id
					AND wpostmeta.meta_key = 'closed' 
					AND wpostmeta.meta_value = '0' AND 
					wposts.post_status = 'publish' 
					AND wposts.post_type = 'ad' 
					ORDER BY wposts.post_date DESC LIMIT ".$limit;
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php ClassifiedTheme_get_post(); ?>
                     
                     
                     <?php endforeach; ?>
                     
                     <?php 
					 
					 	echo '<a class="see_more_ads" href="'.get_post_type_archive_link('ad').'">'.__('See more ads','ClassifiedTheme').'</a>';
					 
					 ?>
                     <?php else : ?> <?php $no_p = 1; ?>
                       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted listings yet","ClassifiedTheme"); ?>.</p></div>
                        
                     <?php endif; ?>