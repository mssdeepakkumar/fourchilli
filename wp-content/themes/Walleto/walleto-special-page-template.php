<?php
/*
Template Name: Category Page
*/
?>

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
get_header();

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
?>

<!--left side bare end-->

<?php include'left_sidebar.php'; ?>
<!--right side banner main wrapper start--> 
<section id="right_side_banner_main_wrapper">
		<section class="cat_slider">
		<?php echo do_shortcode("[metaslider id=576]"); ?>
		</section>
		<!-- section first-->
		<section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
		<div class="product_list_heading">
		<span class="heading_text">
	        <?php echo __("Antiques, Art & Handicrafts",'Walleto');?>
		</span>
		<span class="view_all">
                    <a href="<?php echo get_term_link('antiques-art-handicrafts', 'product_cat');?>" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
		</div>                        
                    
                <ul class="list-unstyled product_listing_ul product_lising_four_products">
		<?php $loop = new WP_Query(array('post_type' => 'product','product_cat' => 'antiques-art-handicrafts','showposts' => 4));?>		
		<?php if ( $loop->have_posts() ): while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php 
				
					// walleto_get_post_list_view();
				
					Walleto_get_post();
		 ?>
		<?php  endwhile; ?>
		</ul>
		<?php 
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>
		</section>
		
		<!-- section seccond-->
		<section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
		<div class="product_list_heading">
		<span class="heading_text">
	        <?php echo __("Baby & Children",'Walleto'); ?>
		</span>
		<span class="view_all">
                    <a href="<?php echo get_term_link('baby-children', 'product_cat');?>" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
		</div>                        
                    
                <ul class="list-unstyled product_listing_ul product_lising_four_products">
		<?php $loop = new WP_Query(array('post_type' => 'product','product_cat' => 'baby-children','showposts' => 4));?>		
		<?php if ( $loop->have_posts() ): while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php Walleto_get_post();?>
		<?php  endwhile; ?>
		</ul>
		<?php 
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>
		</section>
		
		<!-- section third-->
		<section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
		<div class="product_list_heading">
		<span class="heading_text">
	        <?php echo __("Sports & Fitness",'Walleto');?>
		</span>
		<span class="view_all">
                    <a href="<?php echo get_term_link('sports-fitness', 'product_cat');?>" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
		</div>                        
                    
                <ul class="list-unstyled product_listing_ul product_lising_four_products">
		<?php $loop = new WP_Query(array('post_type' => 'product','product_cat' => 'sports-fitness','showposts' => 4));?>		
		<?php if ( $loop->have_posts() ): while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php Walleto_get_post();?>
		<?php  endwhile; ?>
		</ul>
		<?php 
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>
		</section>
		
		<!-- section fourth-->
		<section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
		<div class="product_list_heading">
		<span class="heading_text">
	        <?php  echo __("Electronics & Computers",'Walleto');?>
		</span>
		<span class="view_all">
                    <a href="<?php echo get_term_link('electronics-computers', 'product_cat');?>" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
		</div>                        
                    
                <ul class="list-unstyled product_listing_ul product_lising_four_products">
		<?php $loop = new WP_Query(array('post_type' => 'product','product_cat' => 'electronics-computers','showposts' => 4));?>		
		<?php if ( $loop->have_posts() ): while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php Walleto_get_post();?>
		<?php  endwhile; ?>
		</ul>
		<?php 
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>
		</section>
		
		<!-- section fifth-->
		<section id="wedding_products_wrapper" class="product_list_wrapper wedding_products_wrapper_class">
		<div class="product_list_heading">
		<span class="heading_text">
	        <?php echo __("Books, Music & Games",'Walleto'); ?>
		</span>
		<span class="view_all">
                    <a href="<?php echo get_term_link('books-music-games', 'product_cat');?>" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
		</div>                        
                <ul class="list-unstyled product_listing_ul product_lising_four_products">
		<?php $loop = new WP_Query(array('post_type' => 'product','product_cat' => 'books-music-games','showposts' => 4));?>		
		<?php if ( $loop->have_posts() ): while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<?php Walleto_get_post();?>
		<?php  endwhile; ?>
		</ul>
		<?php 
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>
		</section>
		<a class="view-more-category" href="<?php echo get_permalink(get_option('Walleto_all_cats_id')); ?>">View More Categories  <i class="icon-double-angle-down"></i></a>
		<!--right side banner END-->   
</section>
<!--middle content top section end-->  

 
<?php get_footer();?>