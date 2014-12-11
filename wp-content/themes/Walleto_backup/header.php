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

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?> >
	<head>
	<!--<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">-->
	<title>
	<?php
		wp_title();
	?>
    </title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>

	<?php

		wp_head();

	?>	

<script type="text/javascript">
<?php
			 	
				global $wp_query, $wp_rewrite, $post;
				
				$watchlist_pid = get_option('Walleto_watch_list_id');
				
				if($post->ID == $watchlist_pid)
			 	$on_check_list = 1; else $on_check_list = 0;
				
			 
			 ?>

			var SITE_URL 			= '<?php echo get_bloginfo('siteurl'); ?>';
			var is_on_check_list 	= '<?php echo $on_check_list; ?>';
			var minus_watchlist 	= "<?php echo __('Remove from watchlist','Walleto'); ?>";
			var plus_watchlist 		= "<?php echo __('Add to watchlist','Walleto'); ?>";
			
			
			
			<?php
		
		if(walleto_is_home()):
	
	?>	
	jQuery(function(){
			
	  jQuery('#slider2').bxSlider({
		auto: true,
		speed: 1000,
		pause: 5000,
		autoControls: false,
		 displaySlideQty: 5,
    	moveSlideQty: 1
	  });
	  
	  
	  
	  jQuery("#product-home-page-main-inner").show();	
	  
	  
	  });
	  
	  <?php endif; ?>
	  
	
			
			
</script>

    <?php do_action('Walleto_before_head_tag_open');  
		
		$Walleto_color_for_footer = get_option('Walleto_color_for_footer');
		if(!empty($Walleto_color_for_footer))
		{
			echo '<style> #footer { background:#'.$Walleto_color_for_footer.' }</style>';	
		}
		
		
		$Walleto_color_for_bk = get_option('Walleto_color_for_bk');
		if(!empty($Walleto_color_for_bk))
		{
			echo '<style> body { background:#'.$Walleto_color_for_bk.' }</style>';	
		}
		
		$Walleto_color_for_top_links = get_option('Walleto_color_for_top_links');
		$Walleto_color_for_top_links2 = get_option('Walleto_color_for_top_links2');
		
		if(!empty($Walleto_color_for_top_links))
		{
			echo '<style> .top-links ul li a:link, .top-links ul li a:visited { background:#'.$Walleto_color_for_top_links.' }
			.top-links ul li a:hover { background:#'.$Walleto_color_for_top_links2.' }
			
			</style>';	
		}
		
		//----------------------
		
		$Walleto_color_for_main_links = get_option('Walleto_color_for_main_links');
		$Walleto_color_for_main_links2 = get_option('Walleto_color_for_main_links2');
		
		if(!empty($Walleto_color_for_top_links))
		{
			echo '<style> 
			
			.main_menu_main_div{ background:#'.$Walleto_color_for_main_links.' }
			.main_menu_main_div ul li a:link, .main_menu_main_div ul li a:visited { background:#'.$Walleto_color_for_main_links.' }
			.main_menu_main_div ul li a:hover { background:#'.$Walleto_color_for_main_links2.' }
			
			</style>';	
		}
		
		//----------------------
		
		$Walleto_color_for_text_footer = get_option('Walleto_color_for_text_footer');
		
		if(!empty($Walleto_color_for_text_footer))
		{
			echo '<style> 
			
			#footer-widget-area,#site-info, #footer-widget-area div ul li .widget-title, #footer .textwidget{ color:#'.$Walleto_color_for_text_footer.' }
			#footer a:link, #footer a:visited { color:#'.$Walleto_color_for_text_footer.' }
			#footer a:hover { color:#'.$Walleto_color_for_text_footer.' }
			#site-info { border-color: #'.$Walleto_color_for_text_footer.'  }
			
			</style>';	
		}
		
    //----------------------
		
	 	$Walleto_home_page_layout = get_option('Walleto_home_page_layout');
		if(Walleto_is_home()):
			if($Walleto_home_page_layout == "4"):
				echo '<style>#content { float:right; width:695px } #left-sidebar { float:left; }</style>';
			endif;
			
			if($Walleto_home_page_layout == "5"):
				echo '<style>#content { width:100%; }  </style>';
			endif;
			
			if($Walleto_home_page_layout == "3"):
				echo '<style>#content { width:450px } .title_holder { width:257px; margin-bottom:15px } #left-sidebar{	float:left;margin-right:15px;}
				.post_grid { width:208px; height:182px } 
				 </style>';
			endif;
			
			
			if($Walleto_home_page_layout == "2"):
				echo '<style>#content { width:450px } #left-sidebar{ float:right } #left-sidebar{ margin-right:15px; } .title_holder { width:257px; margin-bottom:15px }
				.post_grid { width:208px; height:182px } 
				 </style>';
			endif;
		
		endif;
	 
	 
	 ?>
     
     <!-- ########################################## -->
     
    
    
    
    	</head>
	<body <?php body_class(); ?> >
    
    
    <div id="header">
			<div class="top-bar-bg">
			
					
			
			
            <div class="main_wrapper">            
            <div class="rss_icon_div"><a href="<?php bloginfo('siteurl') ?>/?feed=rss2&post_type=product"><img src="<?php bloginfo('template_url') ?>/images/rss_icon.png" width="20" height="20" /></a></div>            
            <div class="top-links">
							
                            <ul>
							<?php 
								
								if(current_user_can('level_10')) {?> <li><a href="<?php bloginfo('siteurl'); ?>/wp-admin"><?php 
								echo __("Wp-Admin","Walleto"); ?></a></li> <?php }
							
								if(is_home())
								$home_class_active = 'active';	
								
								global $wp_query, $pagenow;
								$vars = $wp_query->query_vars;
								$special_page = $vars['special_page'];
								
								if($special_page == "post-new") 	$post_new_class 	= 'active';	
								if($special_page == "adv-sea") 		$adv_sea_new_class 	= 'active';
								if($special_page == "account") 		$account_new_class 	= 'active';
								if($special_page == "blog") 		$blog_new_class 	= 'active';	
								if($special_page == "watch") 		$watch_class 		= 'active';									
								if($pagenow == "wp-login.php") 		$class_log 			= "active";	
								if($pagenow == "wp-register.php") 	$class_register 	= "active";	
								
								
									$Walleto_show_blue_menu = get_option('Walleto_show_main_menu');
									
									if($Walleto_show_blue_menu != "yes"):
							?>
							
							<li><a href="<?php bloginfo('siteurl') ?>" class="<?php echo $home_class_active; ?>"><?php echo __("Home","Walleto"); ?></a> </li>
                            
                            
                            <?php
							
							endif;
							
							$menu_name = 'primary-walleto-header';

							if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
							$menu_items = wp_get_nav_menu_items($menu->term_id);
					
						
							foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								if(!empty($title))
								echo '<li><a href="' . $url . '">' . $title . '</a></li>';
							}
								
							}
							
							
							?>
                            <li><a class="<?php echo $watch_class; ?>" href="<?php echo Walleto_watch_list(); ?>"><?php echo __("Watch List","Walleto"); ?></a> </li>
                            <?php
							
								if(Walleto_is_able_to_post_products()):
							
							?>
							<li><a href="<?php echo Walleto_post_new_link(); ?>" class="<?php echo $post_new_class; ?>"><?php 
							echo __("Sell Product","Walleto"); ?></a> </li>
                            
                            <?php endif; ?>
                            
							<?php if(get_option('Walleto_enable_blog') == "yes") { ?>
                            <li><a class="<?php echo $blog_new_class; ?>" href="<?php echo Walleto_blog_link(); ?>"><?php echo __("Blog","Walleto"); ?></a> </li>
							<?php } ?>
                            
                            <?php
							
							if($Walleto_show_blue_menu != "yes"):
							
							?>
                            
                            <li><a href="<?php echo Walleto_advanced_search_link(); ?>" 
                            class="<?php echo $adv_sea_new_class; ?>"><?php _e("Advanced Search","Walleto");?></a></li> 
							<?php
							
								endif;
							
								if(is_user_logged_in())
								{
								
									global $current_user;
									get_currentuserinfo();
									$user = $current_user->user_login;
									?>
									
							<li><a href="<?php echo Walleto_my_account_link(); ?>" 
                            class="<?php echo $account_new_class; ?>"><?php echo __("MyAccount","Walleto"); ?> - <?php echo $user; ?></a></li>
							<li><a href="<?php echo wp_logout_url(); ?>"><?php echo __("Log Out","Walleto"); ?></a></li>
									
									<?php
								}
								else
									{
										
							
							?>
							
							<li><a class="<?php echo $class_register; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register"><?php echo __("Register","Walleto"); ?></a></li>
							<li><a class="<?php echo $class_log; ?>" href="<?php bloginfo('siteurl') ?>/wp-login.php"><?php echo __("Log In","Walleto"); ?></a></li>
							<?php } ?>
                            
                            </ul>
						</div>
            
            
            </div>
			</div> <!-- end top-bar-bg -->
    
    
    			<div class="middle-header-bg">
				<div class="middle-header main_wrapper">
						<div class="logo-holder">
						<?php
							$logo = get_option('Walleto_logo_url');
							if(empty($logo)) $logo = get_bloginfo('template_url').'/images/logo.png';
						?>
						<a href="<?php bloginfo('siteurl'); ?>"><img id="logo" alt="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?>" src="<?php echo $logo; ?>" /></a>
						</div>
                        
                        <div class="search_bar_bgs">
                        <div id="suggest" >
                            <form method="get" action="<?php echo Walleto_advanced_search_link(); ?>/">
                            <?php
							
							if(Walleto_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('Walleto_adv_search_id').'" name="page_id" />';
							
							?>
                            <input type="text" onfocus="this.value=''" id="big-search" name="term" autocomplete="off" onkeyup="suggest(this.value);" 
                            onblur="fill();"  value="<?php if(isset($_GET['term'])) echo $_GET['term']; else echo $default_search; ?>" />
                         
                            <input type="submit"  name="search_me" id="search_btn" value="<?php _e('Search','Walleto'); ?>" />
                            </form>
                            
                            <div class="suggestionsBox" id="suggestions" style="z-index:999;display: none;"> 
                            <img src="<?php echo get_bloginfo('template_url');?>/images/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                            <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                            </div>
                    	</div>
                        </div>
                      

                        
				</div>
				
			</div> <!-- middle-header-bg -->
			
			
		</div>	
        
          <?php include 'top-main-menu.php'; ?>
        <?php include 'home-slider.php'; ?>
      
        
        
        <div id="main">
    
    
    