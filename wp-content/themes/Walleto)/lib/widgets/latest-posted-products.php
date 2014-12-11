<?php

add_action('widgets_init', 'register_latest_posted_products_widget');
function register_latest_posted_products_widget() {
	register_widget('Walleto_latest_posted_products');
}

class Walleto_latest_posted_products extends WP_Widget {

	function Walleto_latest_posted_products() {
		$widget_ops = array( 'classname' => 'latest-posted-products', 'description' => __('Show latest posted products','Walleto') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'latest-posted-products' );
		$this->WP_Widget( 'latest-posted-products', __('Walleto - Latest Products','Walleto'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		$limit = $instance['show_products_limit'];

		if(empty($limit) || !is_numeric($limit)) $limit = 5;

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
                     
                     
                     <?php Walleto_small_post(); ?>
                     
                     
                     <?php endforeach; ?>
                     <?php else : ?> <?php $no_p = 1; ?>
                       <div class="padd100"><p class="center"><?php _e("Sorry, there are no posted products yet.",'Walleto'); ?></p></div>
                        
                     <?php endif; ?>
                     
                     <?php
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) { ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','Walleto'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
			value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('show_products_limit'); ?>"><?php _e('Show products limit','Walleto'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('show_products_limit'); ?>" name="<?php echo $this->get_field_name('show_products_limit'); ?>" 
			value="<?php echo esc_attr( $instance['show_products_limit'] ); ?>" style="width:20%;" />
		</p>

			
	<?php 
	}
}



?>