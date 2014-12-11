<?php

add_action('widgets_init', 'register_most_view_products_widget');
function register_most_view_products_widget() {
	register_widget('Walleto_most_view_products');
}

class Walleto_most_view_products extends WP_Widget {

	function Walleto_most_view_products() {
		$widget_ops = array( 'classname' => 'most-view-products', 'description' => __('Show most viewed products','Walleto') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'most-view-products' );
		$this->WP_Widget( 'most-view-products', __('Walleto - Most viewed products','Walleto'), $widget_ops, $control_ops );
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
					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2
					WHERE wposts.ID = wpostmeta.post_id
					AND wpostmeta.meta_key = 'closed' 
					AND wpostmeta.meta_value = '0' AND wposts.ID = wpostmeta2.post_id
					AND wpostmeta2.meta_key = 'views' 
					AND
					wposts.post_status = 'publish' 
					AND wposts.post_type = 'product' 
					ORDER BY wpostmeta2.meta_value+0 DESC LIMIT ".$limit;
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     
                     
                     <?php Walleto_small_post('view'); ?>
                     
                     
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