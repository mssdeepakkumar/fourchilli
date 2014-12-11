<?php

add_action('widgets_init', 'buzzler_register_most_view_listings_widget');
function buzzler_register_most_view_listings_widget() {
	register_widget('buzzlerTheme_most_view_listings');
}

class buzzlerTheme_most_view_listings extends WP_Widget {

	function buzzlerTheme_most_view_listings() {
		$widget_ops = array( 'classname' => 'most-view-listings', 'description' => __('Show most viewed listings','Buzzler') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'most-view-listings' );
		$this->WP_Widget( 'most-view-listings', __('Buzzler - Most viewed listings','Buzzler'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		$limit = $instance['show_listings_limit'];

		if(empty($limit) || !is_numeric($limit)) $limit = 5;

				 global $wpdb;	
				 $querystr = "
					SELECT distinct wposts.* 
					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2
					WHERE wposts.ID = wpostmeta.post_id
					AND wpostmeta.meta_key = 'closed' 
					AND wpostmeta.meta_value = '0' AND wposts.ID = wpostmeta2.post_id
					AND wpostmeta2.meta_key = 'views' 
					AND
					wposts.post_status = 'publish' 
					AND wposts.post_type = 'listing' 
					ORDER BY wpostmeta2.meta_value+0 DESC LIMIT ".$limit;
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php buzzler_small_post('view'); ?>
                     
                     
                     <?php endforeach; ?>
                     <?php else : ?> <?php $no_p = 1; ?>
                       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted listings yet.",'Buzzler'); ?></p></div>
                        
                     <?php endif; ?>
                     
                     <?php
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) { ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','Buzzler'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
			value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('show_listings_limit'); ?>"><?php _e('Show listings limit','Buzzler'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('show_listings_limit'); ?>" name="<?php echo $this->get_field_name('show_listings_limit'); ?>" 
			value="<?php echo esc_attr( $instance['show_listings_limit'] ); ?>" style="width:20%;" />
		</p>

			
	<?php 
	}
}



?>