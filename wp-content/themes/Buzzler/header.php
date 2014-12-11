<?php
/***************************************************************************
*
*	Buzzler - copyright (c) - sitemile.com
*	WordPress Business Directory Theme
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/buzzler
*	since v1.0
*
***************************************************************************/

?>


	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?> >
	<head>
		 <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"> 
        
	<title>
	<?php
		global $page, $paged;
		wp_title( '|', true, 'right' );

		bloginfo( 'name' );	

		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";	

		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'Buzzler' ), max( $paged, $page ) );
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
				
				$watchlist_pid = get_option('Buzzler_my_account_watch_list_page_id');
				
				if($post->ID == $watchlist_pid)
			 	$on_check_list = 1; else $on_check_list = 0;
				
			 
			 ?>
			 
			var SITE_URL 			= '<?php echo get_bloginfo('siteurl'); ?>';
			var is_on_check_list 	= '<?php echo $on_check_list; ?>';
			var minus_watchlist 	= "<?php echo __('- watchlist','Buzzler'); ?>";
			var plus_watchlist 		= "<?php echo __('+ watchlist','Buzzler'); ?>";
			 
			 
			 
			 
			 var $ = jQuery;
			 
	function suggest2(inputString, fielda)
	{
		$("#" + fielda).css('color','#333');
	}
				 
	function suggest(inputString, fielda)
	{
		$("#" + fielda).css('color','#333');
		
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {  
		$('#' + fielda).addClass('load');
			$.post("<?php bloginfo('siteurl'); ?>/wp-admin/admin-ajax.php?action=autosuggest_it", {queryString: ""+inputString+""}, function(data){
				
				var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								else data = data.slice(0, -2);
				
				
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#' + fielda).removeClass('load');
				}
			});
		}
		
			
	}
	
	function fill(thisValue) {
		//$('#search_input_txt').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}
		
	$(function(){
	  $('#slider2').bxSlider({
		auto: true,
		adaptiveHeight:true,
		minSlides: 1,
  maxSlides: 3,
  slideWidth: 300,
  slideMargin: 10,
  pager:false
	  });
	});	
	
	


	</script>


     <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/my-script.js"></script>
    <?php do_action('Buzzler_before_head_tag_open'); ?>

    
     <!-- ########################################## -->
     
     
      <?php
	 	
		$Buzzler_color_for_footer = get_option('Buzzler_color_for_footer');
		if(!empty($Buzzler_color_for_footer))
		{
			echo '<style> #footer { background:#'.$Buzzler_color_for_footer.' }</style>';	
		}
		
		
		$Buzzler_color_for_bk = get_option('Buzzler_color_for_bk');
		if(!empty($Buzzler_color_for_bk))
		{
			echo '<style> body { background:#'.$Buzzler_color_for_bk.' }</style>';	
		}
		
		$Buzzler_color_for_top_links = get_option('Buzzler_color_for_top_links');
		$Buzzler_color_for_top_links2 = get_option('Buzzler_color_for_top_links2');
		
		if(!empty($Buzzler_color_for_top_links))
		{
			echo '<style> .top-links2 a:link, .top-links2 a:visited { color:#'.$Buzzler_color_for_top_links.' }
			.top-links2 a:hover { color:#'.$Buzzler_color_for_top_links2.' }
			
			</style>';	
		}
		
		//----------------------
		
		$Buzzler_color_for_search_bar = get_option('Buzzler_color_for_search_bar');
		$Buzzler_color_for_slider_main = get_option('Buzzler_color_for_slider_main');
		
		if(!empty($Buzzler_color_for_search_bar))
		{
			echo '<style> 
			
			.main-menu-wrap{ background:#'.$Buzzler_color_for_search_bar.'; border-color:#'.$Buzzler_color_for_search_bar.'; }
			
			</style>';	
		}
		
		if(!empty($Buzzler_color_for_slider_main))
		{
			echo '<style> 
			
			#buzzler-home-page-slider-inner{ background:#'.$Buzzler_color_for_slider_main.'; border-color:#'.$Buzzler_color_for_slider_main.'; }
			
			</style>';	
		}
		
		//----------------------
		
		$Buzzler_color_for_text_footer = get_option('Buzzler_color_for_text_footer');
		
		if(!empty($Buzzler_color_for_text_footer))
		{
			echo '<style> 
			
			#footer-widget-area,#site-info, #footer-widget-area div ul li .widget-title, #footer .textwidget{ color:#'.$Buzzler_color_for_text_footer.' }
			#footer a:link, #footer a:visited { color:#'.$Buzzler_color_for_text_footer.' }
			#footer a:hover { color:#'.$Buzzler_color_for_text_footer.' }
			#site-info { border-color: #'.$Buzzler_color_for_text_footer.'  }
			
			</style>';	
		}
		
		
		
		//----------------------
		
	 	$Buzzler_home_page_layout = get_option('Buzzler_home_page_layout');
		if(Buzzler_is_home()):
			if($Buzzler_home_page_layout == "4"):
				echo '<style>#content { float:right; width:695px } #left-sidebar { float:left; }</style>';
			endif;
			
			if($Buzzler_home_page_layout == "5"):
				echo '<style>#content { width:100%; }  </style>';
			endif;
			
			if($Buzzler_home_page_layout == "3"):
				echo '<style> .content_holder { width:75% } #content { width:410px } .title_holder { width:257px; margin-bottom:15px } #left-sidebar{	float:left;margin-right:15px;}
				 </style>';
			endif;
			
			
			if($Buzzler_home_page_layout == "2"):
				echo '<style>.content_holder { width:75% } #content { width:410px } #left-sidebar{ float:right } #left-sidebar{ margin-right:15px; } .title_holder { width:100%; margin-bottom:15px }
				 </style>';
			endif;
		
		endif;
	 
	 
	 ?>
     
     <!-- ########################################## -->
     
     
	</head>
	<body <?php body_class(); ?> >
    
    
     <div class="main-top-menu-wrap">
    	 <div class="main-top-menu-inner wrapper">
    		
            
            <div   class="top-links22">
						<div class="top-links2">
							<ul>
							<?php 
								
							
						if(current_user_can('level_10')) {?> <li><a href="<?php bloginfo('siteurl'); ?>/wp-admin"><?php echo __("Wp-Admin","Buzzler"); ?></a></li> <?php }
							
							?>
							
							<li><a href="<?php bloginfo('siteurl') ?>" class="<?php echo $class_home; ?>"><?php echo __("Home","Buzzler"); ?></a></li>
                            
                            
                            
                                     <?php
							
							$menu_name = 'primary_buzzler_menu_header';

							if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
							$menu_items = wp_get_nav_menu_items($menu->term_id);
					
						
							foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								echo '<li><a href="' . $url . '">' . $title . '</a></li>';
							}
								
							}
							
							
							?>
                            
                            
                             
							<li><a href="<?php echo Buzzler_post_new_link(); ?>" class="<?php echo $class_post; ?>"><?php echo __("Post New","Buzzler"); ?></a></li> 
							<?php
							
							$blog_clthm = get_option('Buzzler_enable_blog');
							if($blog_clthm != "no") :
							
							?>
                            <li><a href="<?php echo Buzzler_blog_link(); ?>" class="<?php echo $class_blg; ?>"><?php echo __('Blog',"Buzzler"); ?></a> </li>
							
							<?php
							endif;
						
							
								if(is_user_logged_in())
								{
										
										
									?>
									
						<li><a href="<?php echo Buzzler_my_account_link(); ?>" class="<?php echo $class_myac; ?>"><?php echo __("MyAccount","Buzzler"); ?></a></li>
							<li><a <?php echo $logout_thing; ?> href="<?php echo wp_logout_url(); ?>"><?php echo __("Log Out","Buzzler"); ?></a></li>
									
									<?php
								}
								else
									{
										
									
							?>
							
						<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register" class="<?php echo $class_register; ?>"> <?php echo __("Register","Buzzler"); ?></a></li>
							<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php" class="<?php echo $class_log; ?>"><?php echo __("Log In","Buzzler"); ?></a></li>
                            
                           
                            
							<?php } ?></ul>
						</div></div>
    
    
    </div>
     </div>
    
	<div id="header">
    	<div class="wrapper" id="header-inner" >
    					<?php
							$logo = get_option('Buzzler_logo_url');
							if(empty($logo)) $logo = get_bloginfo('template_url').'/images/logo.png';
						?>
						<div class="logo"><a href="<?php bloginfo('siteurl'); ?>"><img id="logo_pic" src="<?php echo $logo; ?>" /></a></div>
    					
                        
                        
                        
                        <div class="header_btns" >
                            
                            	<ul id="header_btns_list">
                                	<li><a href="<?php echo get_permalink(get_option('Buzzler_listing_map_id')); ?>"><?php _e('See Listings Map','Buzzler'); ?></a></li>
                                    <li><a href="<?php echo get_permalink(get_option('Buzzler_post_new_page_id')); ?>"><?php _e('Submit New Listing','Buzzler'); ?></a></li>
                                </ul>
                            
                            
                    	</div>
                      
                   
                
                        
    
    	</div>
    </div>	
	
    <div class="main-menu-wrap">
    	  <div class="main-menu-inner wrapper">
     			
                <?php
				
					global $search_for, $location_near;
					
					$colour_txt1 = "color:#bbb; font-style:italic";
					$colour_txt2 = "color:#bbb; font-style:italic";
					
					if(!empty($_GET['search_location']) and $location_near != trim($_GET['search_location'])) { $location_near = $_GET['search_location']; $colour_txt2 = ""; }
					if(!empty($_GET['search_for']) and $search_for != trim($_GET['search_for'])) { $search_for = $_GET['search_for'];  $colour_txt1 = ""; }
					
				?>
                
                <div id="suggest" >
                
                <form method="get" action="<?php echo buzzler_maps_listings_link(); ?>/">
                <div class="search_input_txt_div">
                	<input type="text" autocomplete="off" onfocus="this.value=''" onkeyup="suggest(this.value, 'search_input_txt');" 
                    onblur="fill();" id="search_input_txt" style="<?php echo $colour_txt1; ?>" value="<?php echo $search_for; ?>" name="search_for" />
                </div>
                
                <div class="location_input_txt_div">
                	<input type="text" autocomplete="off" onfocus="this.value=''" onkeyup="suggest2(this.value, 'location_input_txt');" 
                     id="location_input_txt" style="<?php echo $colour_txt2; ?>" value="<?php echo $location_near; ?>" name="search_location" />
                </div>
                
                
                <div class="location_btn_sub_div">
                	<input type="image" src="<?php bloginfo('template_url') ?>/images/search_icon.png"  name="" />
                </div>
                </form>
                
                <div class="suggestionsBox" id="suggestions" style="z-index:999;display: none;"> 
                            <img src="<?php echo get_bloginfo('template_url');?>/images/arrow.png" style="position: relative; top: -10px; left: 30px;" alt="upArrow" />
                            <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                            </div>
                
                </div>
                
    	</div>
    </div>
	
    <?php
	
	$opt = get_option('Buzzler_big_main_menu_enable');
	if($opt == "yes"):
	
	?>
    	<div class="main_menu">
        <?php
		
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
			
			$menu_name = 'primary-buzzler-main-header';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) 
			$nav_menu = wp_get_nav_menu_object( $locations[ $menu_name ] );					
							 
			
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
		
		?>		
		 
        </div>
        
        </div>
    
	<?php endif;
	
	
	 if(buzzler_is_home()): 
	
	$Buzzler_show_front_slider = get_option('Buzzler_show_front_slider');
	if($Buzzler_show_front_slider != "no")	
	Buzzler_home_slider(); 
	
	endif; ?>
    
    <div id="main" class="wrapper"><div id="inner_main">
    