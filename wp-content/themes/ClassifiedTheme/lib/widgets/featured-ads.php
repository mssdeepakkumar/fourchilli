<?php
/********************************************************************************
*
*	ClassifiedTheme - copyright (c) - sitemile.com - Details
*	if you want to remove actions from the sitemile framework use the hook
*	sitemile_pre_load to add your functions which contains the remove_filters
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v6.2.1
*
*********************************************************************************/	

add_action('widgets_init', 'register_featured_ads_widget');
function register_featured_ads_widget() {
	register_widget('ClassifiedTheme_featured_ads');
}

class ClassifiedTheme_featured_ads extends WP_Widget {

	function ClassifiedTheme_featured_ads() {
		$widget_ops = array( 'classname' => 'featured-ads', 'description' => 'Show latest featured ads' );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'featured-ads' );
		$this->WP_Widget( 'featured-ads', 'ClassifiedTheme - Featured Ads', $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		$limit = $instance['show_ads_limit'];

		if(empty($limit) || !is_numeric($limit)) $limit = 5;

				 global $wpdb;	
				 $querystr = "
					SELECT distinct wposts.* 
					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2
					WHERE wposts.ID = wpostmeta.post_id AND wposts.ID = wpostmeta2.post_id
					AND wpostmeta.meta_key = 'closed' 
					AND wpostmeta.meta_value = '0' 
					
					AND wpostmeta2.meta_key = 'featured' 
					AND wpostmeta2.meta_value = '1' AND 
					
					wposts.post_status = 'publish' 
					AND wposts.post_type = 'ad' 
					ORDER BY wposts.post_date DESC LIMIT ".$limit;
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php classifiedTheme_small_post(); ?>
                     
                     
                     <?php endforeach; ?>
                     <?php else : ?> <?php $no_p = 1; ?>
                       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted ads yet."); ?></p></div>
                        
                     <?php endif; ?>
                     
                     <?php
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
	}

	function form($instance) { ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
			value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('show_ads_limit'); ?>"><?php _e('Show ads limit'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('show_ads_limit'); ?>" name="<?php echo $this->get_field_name('show_ads_limit'); ?>" 
			value="<?php echo esc_attr( $instance['show_ads_limit'] ); ?>" style="width:20%;" />
		</p>
		


			
	<?php 
	}
}



?>