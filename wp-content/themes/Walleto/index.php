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
get_header();?>
	

   </section>
   <!--right side banner main wrapper start--> 
   <section id="right_side_banner_main_wrapper">
     <!--right side slider start-->
    <figure id="right-top-slider">
      <?php echo do_shortcode("[metaslider id=54]"); ?>
	</figure>
	<!--right side slider end-->
	<!--right side small banner start-->
	<figure id="right-small-banner">
	<?php dynamic_sidebar( 'main-stretch-area' ); ?>
	</figure>
	<!--right side small banner startend-->
	</section>
	<!--right side banner main wrapper start-->   
	</section>

	<section class="outer_width" id="testimonails_wrapper">
	  <section class="inner_width">
	      
	  
	
	<?php $query = new WP_Query( 'cat=149' );
	if ( $query->have_posts() ) while ( $query->have_posts() ) : $query->the_post(); ?>


            	
            	<div class="testimonials_heading"><?php  the_title(); ?></div>
                <article class="testimonials_content"> 
		<?php the_content(); ?>
		<a class="see-more-btn" href="<?php the_permalink();?>"><i class="icon-eye-open"></i> SEE MORE</a>
		</article>
		</div>

	   
	<?php endwhile; // end of the loop. ?>
	
	</section>
	</section>
	
	<section id="middle_bottom_section_wrapper" class="outer_width">
	<section class="inner_width">
	<!--middle bottom left section start-->
	<section id="middle_bottom_left_wrapper">
        <!--popular products start-->
        <section id="popular_products_wrapper" class="product_list_wrapper">
        	<?php include 'popular-products.php'; ?>
        </section>
        <!--popular products end-->
	<!--new  products start-->
        <section id="new_products_wrapper" class="product_list_wrapper">
        	
	<?php include 'latest-posted-products.php'; ?>
        	
	</section>
        <!--new products end-->
	<!--small banner in middle bottom left-->
        <div class="banner_small_middle_bottom">
        <?php dynamic_sidebar( 'home-page-bootom-area' ); ?>	
  
        </div>
        <!--small banner in middle bottom left-->           
        </section>      
	<!--middle bottom left section end-->    
   
	 
    <!--middle bottom right section start-->
	<section id="middle_bottom_right_wrapper">
        <!--featured products start-->
        <section id="featured_products">
        <div class="featured_product_heading">Featured Products</div>     
          <ul class="list-unstyled featured_product_listing">
             <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
          </ul>   
        </section>
        <!--featured products end-->
        <!--add banner-->
		<?php dynamic_sidebar( 'home-right-2-widget-area' ); ?>
        <!--add banner-->
        
        <!--small slider start-->
        <section id="small_slider">
        <?php echo do_shortcode("[metaslider id=325]");?>
        </section>
        <!--small slider end-->        
        
        </section>      
      <!--middle bottom right section end-->           
    </section>
    </section>
    <!--middle content bottom section start--> 
    
    <!--payment method and social icons wrapper-->
    
    
    

    
   
<?php get_footer(); ?>
