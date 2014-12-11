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
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );   //print_r($term);
//======================================================
get_header();

$Walleto_adv_code_cat_page_above_content = stripslashes(get_option('Walleto_adv_code_cat_page_above_content'));
		if(!empty($Walleto_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Walleto_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;


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
			echo bcn_display();
		    }
		    ?>
	</ul>
       <!--bread crumb end-->
	<section class="cat_slider">
	<?php 
	if( $term->term_id == 52) echo do_shortcode("[metaslider id=448]");
	if( $term->term_id == 26) echo do_shortcode("[metaslider id=576]");
	if( $term->term_id == 56) echo do_shortcode("[metaslider id=587]");
	if( $term->term_id == 36) echo do_shortcode("[metaslider id=588]");
	if( $term->term_id == 8) echo do_shortcode("[metaslider id=589]");
	if( $term->term_id == 16) echo do_shortcode("[metaslider id=590]");
	if( $term->term_id == 22) echo do_shortcode("[metaslider id=591]");
	if( $term->term_id == 41) echo do_shortcode("[metaslider id=592]");
	?>
	</section>
	<?php
	
	$term_child = get_term_children($term->term_id, 'product_cat');  
	if($term_child):
	foreach ( $term_child as $child ) :
	$terms = get_term_by( $term->term_id, $child, 'product_cat' ); 
	$term_title = $terms->name;
	?>
	<section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
        	<div class="product_list_heading">
		<span class="heading_text"><?php echo $term_title;?></span>
	        <span class="view_all">
		<a href="<?php echo get_term_link($child, 'product_cat');?>" class="view_all_items">
		View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
                </div>     
		<?php if(empty($term_title)) echo __("All Posted Items",'Walleto');?>
           		
	<ul class="list-unstyled product_listing_ul product_lising_four_products">
	<?php $loop = new WP_Query(array('post_type' => 'product','product_cat' => $terms->slug,'showposts' => 4));?>		
	<?php if ( $loop->have_posts() ): while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<?php Walleto_get_post();?>
    
	<?php  endwhile; ?>
	</ul>
	<?php
		else:
		echo __('No items posted.',"Walleto");
		
		endif; 
		// Reset Post Data
		wp_reset_postdata();
		
		?>   
        </section>
	<?php endforeach;?>
	<?php else: 
	$term_title = $term->name;
	?>
	<section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
        	<div class="product_list_heading">
		<span class="heading_text"><?php echo $term_title;?></span>
	        </div>     
		<?php if(empty($term_title)) echo __("All Posted Items",'Walleto');?>

	<ul class="list-unstyled product_listing_ul product_lising_four_products">
	<?php $loop = new WP_Query(array('post_type' => 'product','posts_per_page'   => 300, 'product_cat' => $term->slug));?>		
	<?php if ( $loop->have_posts() ): while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<?php Walleto_get_post();?>
	<?php  endwhile; ?>
	</ul>
	<?php
		else:
		echo __('No items posted.',"Walleto");
		
		endif; 
		// Reset Post Data
		wp_reset_postdata();
		
		?>   
        </section>
	
	
	<?php endif;?>
	<!--<a href="#" class="view-more-category">View More Categories  <i class="icon-double-angle-down"></i></a>-->
</section>
<!--right side banner main wrapper start-->   
   

<?php get_footer();?>
