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
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);

//meta_key=keyname&orderby=meta_value&order=ASC
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);
$prs_string_qu['meta_key'] = 'featured';
$prs_string_qu['orderby'] = 'meta_value';
$prs_string_qu['order'] = 'DESC';
		
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
		    //echo bcn_display();
		}
                ?>
   </ul>
   <!--bread crumb end-->
 
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
	        <?php if(empty($term_title)) echo __("All Posted Products",'Walleto');
                else { echo sprintf( __("Latest Posted Products in %s",'Walleto'), $term_title); } ?>
         </span>
	     <span class="view_all">
                    <a href="" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
        </div>                        
                    
                        
                                  		 
            		
		<ul class="list-unstyled product_listing_ul product_lising_four_products"> 
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
		<?php 
				
					// walleto_get_post_list_view();
				
					Walleto_get_post();
		 ?>
		<?php  
				endwhile; 
			?>
		</ul>
	<?php 
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No items posted.',"Walleto");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>
</section>
   <!--right side banner END-->   
  </section>
   <!--middle content top section end-->  

 
<?php

	get_footer();

?>