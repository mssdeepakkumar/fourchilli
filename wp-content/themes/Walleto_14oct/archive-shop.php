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



global $query_string;

			$Walleto_shop_subscriptions = get_option('Walleto_shop_subscriptions');
			if($Walleto_shop_subscriptions != 'no'):
			
			$membership_available = array(
					'key' => 'membership_available',
					'value' => current_time('timestamp',0),
					'type' => 'numeric',
					'compare' => '>'
			);
			
			endif;
//meta_key=keyname&orderby=meta_value&order=ASC
	
$prs_string_qu 					= wp_parse_args($query_string);
$prs_string_qu['meta_query'] 	= array($membership_available);
//$prs_string_qu['meta_key'] 		= 'featured';
//$prs_string_qu['orderby'] 		= 'meta_value';
$prs_string_qu['order'] 		= 'DESC';
		
query_posts($prs_string_qu);

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
			
//======================================================

	get_header();
	?>
	<!--left side bare end-->
<?php include'left_sidebar.php'; ?>
   
   <!--right side banner main wrapper start--> 
   <section id="right_side_banner_main_wrapper">
   <!--bread crumb start-->
    <ul class="list-unstyled" id="breadcrumb">
		<?php 
		if(function_exists('bcn_display'))
		{
		   // echo bcn_display();
		}
                ?>
   </ul>
 
	
	<?php
	
	$Walleto_adv_code_cat_page_above_content = stripslashes(get_option('Walleto_adv_code_cat_page_above_content'));
		if(!empty($Walleto_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Walleto_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

	?>
    <section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
        <div class="product_list_heading">
	   <span class="heading_text">
		<?php
			if(empty($term_title)) echo __("All Shops",'Walleto');
			else { echo sprintf( __("All Shops in %s",'Walleto'), $term_title); }
		?>       
            </span>
		<!--<span class="view_all">
		       <a href="" class="view_all_items">View all shops   <i class="icon-double-angle-right ml10"></i></a>
		 </span>-->
          </div>                  
                        <!--<a href="<?php //bloginfo('siteurl'); ?>/?feed=rss2&<?php ///echo get_query_var( 'taxonomy' ); ?>=<?php //echo get_query_var( 'term' ); ?>"><img src="<?php //bloginfo('template_url'); ?>/images/rss_icon.png" 
                    border="0" width="19" height="19" alt="rss icon" /></a>-->
                        
                      
            		
<ul class="list-unstyled product_listing_ul product_lising_four_products"> 

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php  walleto_get_post_shop(); ?>

<?php  endwhile; ?>
</ul>
	<?php
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No shops yet.',"Walleto");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>


</section>
  
</section>
<!--middle content top section end-->  

   
 



<?php

	get_footer();

?>