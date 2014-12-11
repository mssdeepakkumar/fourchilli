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


?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?> >
	<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>
	<?php 	wp_title(  ); ?>
    </title>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_enqueue_script("jquery"); ?>

	<?php

		wp_head();

	?>	


	 <?php
	 	
		$ClassifiedTheme_color_for_footer = get_option('ClassifiedTheme_color_for_footer');
		if(!empty($ClassifiedTheme_color_for_footer))
		{
			echo '<style> #footer { background:#'.$ClassifiedTheme_color_for_footer.' }</style>';	
		}
		
		
		$ClassifiedTheme_color_for_bk = get_option('ClassifiedTheme_color_for_bk');
		if(!empty($ClassifiedTheme_color_for_bk))
		{
			echo '<style> body { background:#'.$ClassifiedTheme_color_for_bk.' }</style>';	
		}
		
		$ClassifiedTheme_color_for_top_links = get_option('ClassifiedTheme_color_for_top_links');
		if(!empty($ClassifiedTheme_color_for_top_links))
		{
			echo '<style> .top_menu_wrapper { background:#'.$ClassifiedTheme_color_for_top_links.' }</style>';	
		}
		
		$ClassifiedTheme_color_for_main_links = get_option('ClassifiedTheme_color_for_main_links');
		if(!empty($ClassifiedTheme_color_for_main_links))
		{
			echo '<style> .main-thing-menu { background:#'.$ClassifiedTheme_color_for_main_links.' }</style>';	
		}
		
		
		$ClassifiedTheme_color_for_main_links2 = get_option('ClassifiedTheme_color_for_main_links2');
		if(!empty($ClassifiedTheme_color_for_main_links2))
		{
			echo '<style> .main-thing-menu ul li a:hover  { background:#'.$ClassifiedTheme_color_for_main_links2.' }</style>';	
		}
		
		$ClassifiedTheme_custom_css = get_option('ClassifiedTheme_custom_css');
		if(!empty($ClassifiedTheme_custom_css))
		{
			echo '<style>  '.$ClassifiedTheme_custom_css.'</style>';		
		}
		
		
		$ClassifiedTheme_color_for_top_links2 = get_option('ClassifiedTheme_color_for_top_links2');
		if(!empty($ClassifiedTheme_color_for_top_links2))
		echo '<style> .top-links a:hover { color:#'.$ClassifiedTheme_color_for_top_links2.' } </style>';
		
		//----------------------
		
	 	$ClassifiedTheme_home_page_layout = get_option('ClassifiedTheme_home_page_layout');
		if(ClassifiedTheme_is_home()):
			if($ClassifiedTheme_home_page_layout == "4"):
				echo '<style>#content { float:right } #left-sidebar { float:left; }</style>';
			endif;
			
			if($ClassifiedTheme_home_page_layout == "5"):
				echo '<style>#content { width:100%; }  </style>';
			endif;
			
			if($ClassifiedTheme_home_page_layout == "3"):
				echo '<style>#content { width:395px } .title_holder { width:280px; }  .ad_details1 { margin-left:60px} #left-sidebar{	float:left;margin-right:15px;}
				 </style>';
			endif;
			
			
			if($ClassifiedTheme_home_page_layout == "2"):
				echo '<style>#content { width:395px } #left-sidebar{ float:right } #left-sidebar{ margin-right:15px; } .title_holder { width:280px; } .ad_details1 { margin-left:60px}
				 </style>';
			endif;
		
		endif;
	 
	 
	 ?>
	
     <script type="text/javascript">
		
		 
		
	function suggest(inputString){
	
		if(inputString.length == 0) {
			jQuery('#suggestions').fadeOut();
		} else {  
		jQuery('#big-search').addClass('load');
			jQuery.post("<?php bloginfo('siteurl'); ?>/wp-admin/admin-ajax.php?action=autosuggest_it", {queryString: ""+inputString+""}, function(data){
				
				var stringa = data.charAt(data.length-1);
								if(stringa == '0') data = data.slice(0, -1);
								else data = data.slice(0, -2);
				
				
				if(data.length >0) {
					jQuery('#suggestions').fadeIn();
					jQuery('#suggestionsList').html(data);
					jQuery('#big-search').removeClass('load');
				}
			});
		}
	}


	function fill(thisValue) {
		jQuery('#big-search').val(thisValue);
		setTimeout("jQuery('#suggestions').fadeOut();", 600);
	}

	
	
	jQuery(function(){
	  jQuery('#slider2').bxSlider({
		auto: true,
		speed: 1000,
		pause: 6000,
		autoControls: false,
		 displaySlideQty: 5,
    	moveSlideQty: 1
	  });
	  
	  
	  jQuery("#classified-home-page-main-inner").show();	
	  
	});	

	
	
 
	</script>
    

    <?php do_action('ClassifiedTheme_before_head_tag_closes'); ?>
	</head>
	<body <?php body_class(); ?> >
    
    
 
	
    
			<div class="top_menu_wrapper">
            	<div class="top_menu_content">
            		
                    	
                    <div class="top_left_lnks">
						<a href="<?php echo classifiedTheme_advanced_search_link(); ?>" class="top_link"><?php _e("Advanced Search","ClassifiedTheme");?></a> 
						<a href="<?php bloginfo('siteurl') ?>/?feed=rss2&post_type=ad" class="top_link"><?php _e("RSS Feed","ClassifiedTheme"); ?></a>
						</div>    
                    
                    
            		
                      <?php
						
									if(classifiedTheme_is_home())
									$class_home = 'active_at';	
									
									global $wp_query, $pagenow;
									$paagee =  $wp_query->query_vars['my_custom_page_type'];
									
									if ($paagee == "post-new") $class_post = "active_at";	
									if ($paagee == "my_account") $class_myac = "active_at";	
									if ($paagee == "all-blog-posts") $class_blg = "active_at";	
									
									if ($pagenow == "wp-login.php") 		$class_log 			= "active_at";	
									if ($pagenow == "wp-register.php") 	$class_register 	= "active_at";	
						
						?>
                        
						
						
						<div class="top-links-wrapper">
						<div class="top-links">
							<ul>
							<?php 
								
							
						if(current_user_can('level_10')) {?> <li><a href="<?php bloginfo('siteurl'); ?>/wp-admin"><?php echo __("Wp-Admin","ClassifiedTheme"); ?></a></li> <?php }
							
							?>
							
							<li><a href="<?php bloginfo('siteurl') ?>" class="<?php echo $class_home; ?>"><?php echo __("Home"); ?></a></li>
                            
                            
                            
                                     <?php
							
							$menu_name = 'primary-classifiedtheme-header';

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
                            
                            
                             
							<li><a href="<?php echo classifiedTheme_post_new_link(); ?>" class="<?php echo $class_post; ?>"><?php echo __("Post New","ClassifiedTheme"); ?></a> </li>
							<?php
							
							$blog_clthm = get_option('classifiedTheme_enable_blog');
							if($blog_clthm != "no") :
							
							?>
                           <li> <a href="<?php echo classifiedTheme_blog_link(); ?>" class="<?php echo $class_blg; ?>"><?php echo __('Blog',"ClassifiedTheme"); ?></a> </li>
							
							<?php
							endif;
						
							
								if(is_user_logged_in())
								{
										if(function_exists(fbc_facebook_client)):
										$uid = fbc_facebook_client()->get_loggedin_user();
										
										if(is_numeric($uid)) $logout_thing = 'onclick="FBConnect.logout(); return false;"';
										endif;
										
										global $current_user;
										get_currentuserinfo();
										
									?>
									
						<li><a href="<?php echo classifiedTheme_my_account_link(); ?>" class="<?php echo $class_myac; ?>"><?php echo sprintf( __("MyAccount - %s","ClassifiedTheme"), $current_user->user_login); ?></a></li>
						<li><a <?php echo $logout_thing; ?> href="<?php echo wp_logout_url(); ?>"><?php echo __("Log Out","ClassifiedTheme"); ?></a></li>
									
									<?php
								}
								else
									{
										
									
							?>
							
						<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php?action=register" class="<?php echo $class_register; ?>"> <?php echo __("Register","ClassifiedTheme"); ?></a></li>
						<li><a href="<?php bloginfo('siteurl') ?>/wp-login.php" class="<?php echo $class_log; ?>"><?php echo __("Log In","ClassifiedTheme"); ?></a></li>
                            
                           
                            
							<?php } ?>
                            
                            </ul>
						</div>
					
                    
                        
				</div></div>
            
            	</div>
            </div>
            
               <div id="header">
            
			<div class="middle-header-bg">
				<div class="middle-header">
					
                    
                    <?php
							$logo = get_option('classifiedTheme_logo_url');
							if(empty($logo)) $logo = get_bloginfo('template_url').'/images/logo.png';
						?>
						<div class="my_logo"><a href="<?php bloginfo('siteurl'); ?>"><img id="logo" src="<?php echo $logo; ?>" /></a></div>
                    
                    
                    	
                        
                        <div id="suggest" >
                   <?php
				   
				   	global $default_search;
				   
				   ?>
                   
                    <form method="get" id="srcs_form" action="<?php echo classifiedTheme_advanced_search_link(); ?>/">
						
                        <div class="search_left_thing">
                        <input type="text" onfocus="this.value=''" id="big-search" name="term" autocomplete="off" onkeyup="suggest(this.value);" onblur="fill();"  value="<?php if(isset($_GET['term'])) echo $_GET['term']; 
						else echo $default_search; ?>" />
						</div>
			
            
		
					<div class="search_left_thing">
					<input type="image" id="big-search-submit" name="search_me" src="<?php bloginfo('template_url') ?>/images/search.png" />
                    </div>
                    
					</form>
                    
                    <div class="suggestionsBox" id="suggestions" style="z-index:999;display: none;"> <img src="<?php echo get_bloginfo('template_url');?>/images/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div></div>
                    
					
						
						
                        
                        
                      
				
			</div></div> <!-- middle-header-bg -->
			
		
        
        
        <?php
		
			$ClassifiedTheme_show_main_menu = get_option('ClassifiedTheme_show_main_menu');
			if($ClassifiedTheme_show_main_menu != 'no'):
		?>
        
      	<?php include 'top-main-menu.php' ?>
        
        <?php endif; ?>
        
        
        <?php 
		
		if(classifiedTheme_is_home())
		{
			
			include 'home-slider.php';
		 
		}
		
		 ?>
        
        
        <div id="main">