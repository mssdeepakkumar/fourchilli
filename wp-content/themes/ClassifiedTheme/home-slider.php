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

	global $wp_query, $wp_rewrite, $post;
	$paagee 	=  $wp_query->query_vars['my_custom_page_type'];
	$c_action 	=  $wp_query->query_vars['c_action'];

if(is_home() && empty($c_action)):
		
		$classifiedTheme_show_front_slider = get_option('classifiedTheme_show_front_slider');
		if($classifiedTheme_show_front_slider != "no"):
			
			echo '<div id="classified-home-page-main-inner_wrap">';
			
		?>

        		<div id="classified-home-page-main-inner">
				
                
                <div id="slider2">
         	
			
			<?php
					
				 global $wpdb;	
				 $querystr = "
					SELECT distinct wposts.* 
					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2
					WHERE wposts.ID = wpostmeta.post_id AND
					wpostmeta.meta_key='closed' AND wpostmeta.meta_value='0'
					AND 
					
					wposts.ID = wpostmeta2.post_id AND
					wpostmeta2.meta_key='featured' AND wpostmeta2.meta_value='1'
					AND 
					
					wposts.post_status = 'publish' 
					AND wposts.post_type = 'ad' 
					ORDER BY wposts.post_date DESC LIMIT 28 ";
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php 
                     
					 echo '<div class="nk_slider_child">';
                      			ClassifiedTheme_slider_post();
					 echo '</div>';
  
                     
                     ?>

                     <?php endforeach; ?>
                     <?php endif; ?>

		
             
      
       </div>
       		<div class="clear20"></div>

       
        </div> </div>
        
        
        <?php 
			else:
			
			//echo '<div class="clear10"></div>';
		
		
			endif;
			endif; ?>