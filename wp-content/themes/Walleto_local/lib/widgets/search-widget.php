<?php

add_action('widgets_init', 'register_adv_search_WL_widget');
function register_adv_search_WL_widget() {
	register_widget('walleto_search_widget_products');
}

class walleto_search_widget_products extends WP_Widget {

	function walleto_search_widget_products() {
		$widget_ops = array( 'classname' => 'adv-search-widget', 'description' => __('Show advanced search widget.','Walleto') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'adv-search-widget' );
		$this->WP_Widget( 'adv-search-widget', __('Walleto - Search Widget','Walleto'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		?>
		
         <table width="100%">
                
                
                	<form method="get" action="<?php echo Walleto_advanced_search_link(); ?>">
                
                	<?php
							
							if(Walleto_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('Walleto_adv_search_id').'" name="page_id" />';
							
							?>
                
                 	<tr><td><?php _e('Product ID#',"Walleto"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['product_ID']; ?>" name="product_ID" />
                   </td></tr>	
                
                   <tr><td><?php _e('Keyword',"Walleto"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['term']; ?>" name="term" />
                   </td></tr>
                   
                   <tr><td><?php _e('Min Price',"Walleto"); ?>:</td><td>
                    <input class="do_input_afs" size="10" value="<?php echo $_GET['price_min']; ?>" name="price_min" /> <?php echo walleto_get_currency(); ?></td></tr> 
                    
                   <tr><td><?php _e('Max Price',"Walleto"); ?>:</td><td> 
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['price_max']; ?>" name="price_max" /> <?php echo walleto_get_currency(); ?></td></tr>
          			 
                   
                   <tr><td><?php _e('Filter by Category',"Walleto"); ?>: </td><td>
				   <?php	echo Walleto_get_categories_slug("product_cat", $_GET['product_cat_cat'], __("Select Category","Walleto"), "do_input_afs2"); ?></td></tr>

             

                   <tr><td></td><td>
                   <input type="submit" value="<?php _e("Refine Search","Walleto"); ?>" name="ref-search" class="big-search-submit2" /></td></tr>
                   </form>
</table>
        
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
		
 
			
	<?php 
	}
}



?>