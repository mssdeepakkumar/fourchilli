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
	
	<link href="<?php bloginfo('template_directory'); ?>/css/default_value.css" rel="stylesheet" media="screen">
	<link href="<?php bloginfo('template_directory'); ?>/css/fonts.css" rel="stylesheet" media="screen">
	<link href="<?php bloginfo('template_directory'); ?>/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php bloginfo('template_directory'); ?>/css/responsive.css" rel="stylesheet" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
	<!--[if IE 7]>
	      <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/font-awesome-ie7.min.css">
	    <![endif]-->
	<!--[if lt IE 9]>
			<html class="ie8"> 
	    <![endif]-->
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

			var SITE_URL 		= '<?php echo get_bloginfo('siteurl'); ?>';
			var is_on_check_list 	= '<?php echo $on_check_list; ?>';
			var minus_watchlist 	= "<?php echo __('Remove from watchlist','Walleto'); ?>";
			var plus_watchlist 	= "<?php echo __('Add to watchlist','Walleto'); ?>";
			
			
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
	
		$('.child_products').hide();
		var flag=0;
		var prev_li_id="";
		//var prev_li_id1="";
		var prev_child="";
		//var prev_child1="";
		var child_id="";
		$("ul#location-stuff li").mouseover(function(event) {//alert('dev');
			
		  var current_class=this.className;
		  var res = current_class.split("_");
		  child_id='#taxe_project_cat_'+res[3];
		       $(child_id).show();
		
		});
		
		$("ul#location-stuff li").mouseout(function(event) {
		     //alert(child_id);
		       $(child_id).hide();
		});       
		
		$("#menu_drop_down_button").click(function(){
		   if(!$(this).hasClass("dropy"))
		   {
			$("#browse-by-category-3").slideUp('350');
			$("#menu_drop_down_button").addClass("dropy");
		   }
		   else
		   {
			$(this).removeClass("dropy");
			$("#browse-by-category-3").slideDown('350');
		   }
		});		
		
	});
	
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
		
		
		//----------------------
		
		$Walleto_color_for_main_links = get_option('Walleto_color_for_main_links');
		$Walleto_color_for_main_links2 = get_option('Walleto_color_for_main_links2');
		
		
		
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

	
	
    
    
    	</head>
	<body <?php body_class(); ?> >
     
	<!--wrapper start-->
	<section id="wrapper" class="outer_width">
	<?php include 'top-main-menu.php'; ?>
	<!--middle header start-->
	<section id="middle_header" class="outer_width">
	<section class="inner_width">
	<?php
	$logo = get_option('Walleto_logo_url');
	if(empty($logo)) $logo = get_bloginfo('template_url').'/images/logo.png';
	?>
	<a class="brand-logo" href="<?php echo Walleto_advanced_search_link(); ?>"><img id="logo" alt="<?php bloginfo('name'); ?><?php bloginfo('description'); ?>"
		src="<?php echo $logo; ?>" class="img-responsive" /></a>
        
        <article class="middle_right_header">
	
	<a class="cart_href" href="<?php echo get_permalink(get_option('Walleto_shopping_cart_page_id')); ?>">
	
          <div class="middle_right_left pull-left"><i class="icon-shopping-cart"></i></div>
          <div class="middle_right_right pull-left">
            <h4>Shopping Cart</h4>
	    <?php
	    $cart = $_SESSION['my_cart'];
	    if(count($cart) > 0) echo "(".count($_SESSION['my_cart']).")";
	    else{ ?>
            <span>Now in your cart: 0 item(s) - $0.00</span>
	    <?php } ?>
          </div>
	</a>
	
        </article>
	</section>
	</section>
	<!--middle header end-->
	<!--navigation start-->
	<section id="search_menu_wrapper" class="outer_width">
	<section class="inner_width">
     	
           
	    
	   <!-- <form action="<?php bloginfo('url'); ?>" id="searchform" method="get" role="search">
	      <div id="search_category_box">
		      <input type="text" id="s" name="s" value="" placeholder="Im Shopping for...">
		      <a id="cat_drop_down_button" href="javascript:void(0);" class="all_category_search_drop_button">All categories  <i class="icon-double-angle-down"></i></a>
		      
		      <div class="search_category_btn"><input type="submit" value="Search" id="searchsubmit" style="background:none;border:none;"><i class="icon-search"></i></div>
	      </div>
            </form>-->
	    
	<form method="get" action="<?php echo Walleto_advanced_search_link(); ?>/" id="searchform">
	<div id="search_category_box">
                            <?php
							
							if(Walleto_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('Walleto_adv_search_id').'" name="page_id" />';
							
							?>
                            <input type="text" onfocus="this.value=''" id="big-search" name="term" placeholder="Im Shopping for..." onkeyup="suggest(this.value);" 
                            onblur="fill();"  value="<?php if(isset($_GET['term'])) echo $_GET['term']; else echo $default_search; ?>" />
                         
                           <a id="cat_drop_down_button" href="<?php echo get_permalink(393); ?>" class="all_category_search_drop_button">All categories</a>
		      
		      <div class="search_category_btn"><input type="submit" value="Search" id="searchsubmit" style="background:none;border:none;"><i class="icon-search"></i></div>
        </div>
	</form>
	    
        
	</section>
	</section>
	<!--navigation start-->    

        
	<?php //include 'home-slider.php'; ?>
	<!--middel section start-->
	<section id="middle_section_wrapper" class="outer_width">
	<!--middle content top section start-->
	<section class="inner_width">
	<section id="left_side_bar_menu_wrapper_outer">
	<!--left side bar start-->
	<aside id="left_side_bar_menu">
	<a id="menu_drop_down_button" class="all_category_dropdown" href="javascript:void(0);"><i class="icon-sitemap pull-left"></i> All Categories <i class="icon-chevron-down pull-right"></i></a>
	<?php if ( is_active_sidebar( 'home-left-widget-area' ) ) : ?><?php dynamic_sidebar( 'Home Page Sidebar - Left' ); ?><?php endif; ?>
	</aside>
	<!--left side bare end-->
	
        
        
           
    
    
