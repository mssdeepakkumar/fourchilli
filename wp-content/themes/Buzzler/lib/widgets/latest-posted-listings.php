<?php

add_action('widgets_init', 'register_latest_posted_listings_widget');
function register_latest_posted_listings_widget() {
	register_widget('buzzlerTheme_latest_posted_listings');
}

class buzzlerTheme_latest_posted_listings extends WP_Widget {

	function buzzlerTheme_latest_posted_listings() {
		$widget_ops = array( 'classname' => 'latest-posted-listings', 'description' => __('Show latest posted listings','Buzzler') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'latest-posted-listings' );
		$this->WP_Widget( 'latest-posted-listings', __('Buzzler - Latest listings','Buzzler'), $widget_ops, $control_ops );
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
					FROM $wpdb->posts wposts 
					WHERE wposts.post_status = 'publish' 
					AND wposts.post_type = 'listing' 
					ORDER BY wposts.post_date DESC LIMIT ".$limit;
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php buzzler_small_post(); ?>
                     
                     
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