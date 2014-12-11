<?php
/*
Theme Name: Kinetica Sandbox | Layout Five
Version: 0.9b
Author: Michael Louviere
The template for displaying Search Results pages.
*/

?>
<?php get_header(); ?>

<!--left side bare end-->
<?php include'left_sidebar.php'; ?>

   <section id="right_side_banner_main_wrapper">
          <section id="product_list_new" class="product_list_wrapper wedding_products_wrapper_class">
	     <div class="product_list_heading">
		 <span class="heading_text">Advanced Search</span>
		     <span class="view_all">
		     <a href="javasctipt:void(0);" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
		 </span>
	     </div>
	     <ul class="list-unstyled product_listing_ul all_posted_products_list">
	      <?php
	      $image_thing_tags = 'main-image-post2';
	      if ( have_posts() ) : while ( have_posts() ) : the_post();
	      ?>
		<li>
		 <div class="product_block_top product_block_light_strip"></div>              
		  <div class="product_block_middle">
		    <a href="<?php echo get_permalink()?>"><?php echo walleto_get_first_post_image(get_the_ID(),'','','',$image_thing_tags,1);?></a>
		    <div class="product-content">
					  <a href="<?php echo get_permalink()?>" class="product_name"><?php echo substr(the_title('', '', FALSE), 0, 20);?>....</a>
		      <p class="product_detail"><?php echo substr(get_the_excerpt(), 0,30);?></p>                                      
		    </div>
			<div class="product-price">
					  <span class="product_orignal_price">$190.00</span>
		      <span class="product_discount_price">$169.90 </span>                                      
		    </div>
		    <a href="javascript:void(0);" class="buy_now_btn"><i class="icon-shopping-cart"></i> Buy Now </a>
		  </div>
		  <div class="product_block_bottom product_block_light_strip"></div>
		</li>
	        <?php endwhile;
		else : ?>
                <h1><?php _e( 'Nothing Found', 'walleto' ); ?></h1>
                <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sandbox' ); ?></p>
                <div style="margin-top:10px;"><?php get_search_form(); ?></div>
                <?php endif; ?>

	     </ul>
	  </section>
</section>
<!--right side banner main wrapper start-->  

<?php get_footer(); ?>