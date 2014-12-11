<?php
		
			$Walleto_show_main_menu = get_option('Walleto_show_main_menu');
			if($Walleto_show_main_menu != 'no'):
			
		
							
			$menu_name = 'primary-walleto-main-header';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
			$menu_items = wp_get_nav_menu_items($menu->term_id);
					
			$m = 0;			
			foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								if(!empty($title))
								$m++;
			}}
							
							
						
			
		?>

      	<div class="main_menu_main_div">
        
        <?php
		
			if($m == 0):
		
		?>
        <ul>
            <li class="padded_menu"><a href="<?php bloginfo('siteurl'); ?>" class="hm_cls"><?php _e('Home','Walleto'); ?></a></li>
            <li><a href="<?php echo get_post_type_archive_link('product'); ?>"><?php _e('All Products','Walleto'); ?></a></li> 
            <li><a href="<?php echo get_post_type_archive_link('shop'); ?>"><?php _e('Shops','Walleto'); ?></a></li> 
            <li><a href="<?php echo get_permalink(get_option('Walleto_adv_search_id')); ?>"><?php _e('Advanced Search','Walleto'); ?></a></li> 
            <li><a href="<?php echo get_permalink(get_option('Walleto_all_cats_id')); ?>"><?php _e('Show All Categories','Walleto'); ?></a></li> 
    
                       
            </ul>
        	<?php else: 
			
			$event = 'hover';
			$effect = 'fade';
			$fullWidth = ',fullWidth: true';
			$speed = 0;
			$submenu_width = 200;
			$menuwidth = 100;
		
		?>
        
        <script type="text/javascript">
				
				var $ = jQuery;
				
				jQuery(document).ready(function($) {
					jQuery('#<?php echo 'item_main_menus'; ?> .menu').dcMegaMenu({
						rowItems: <?php echo $menuwidth; ?>,
						subMenuWidth: '<?php echo $submenu_width; ?>',
						speed: <?php echo $speed; ?>,
						effect: '<?php echo $effect; ?>',
						event: '<?php echo $event; ?>'
						<?php echo $fullWidth; ?>
					});
				});
		</script>
       
       
        <div class="dcjq-mega-menu" id="<?php echo 'item_main_menus'; ?>">		
		<?php
			
			$menu_name = 'primary-walleto-main-header';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) 
			$nav_menu = wp_get_nav_menu_object( $locations[ $menu_name ] );					
							 
			
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
		
		?>		
		 
        </div>
        
            <?php endif; ?>
        
        <div class="cart_link2">
        <?php
		
		$cart 		= $_SESSION['my_cart'];
		if(count($cart) > 0) echo "(".count($_SESSION['my_cart']).")";
		
		?>
        </div>
         <div class="cart_link"><a class="cart_href" href="<?php echo get_permalink(get_option('Walleto_shopping_cart_page_id')); ?>"><img src="<?php bloginfo('template_url') ?>/images/cart_icon.png" /></a></div>
         
        </div>  
        
        <?php	
		else:
		//--------
		
		
		
		endif;	?>
