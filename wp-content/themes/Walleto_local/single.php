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


?>
	

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<!--left side bare end-->
<?php include'left_sidebar.php'; ?>
<!--right side banner main wrapper start--> 
    <section id="right_side_banner_main_wrapper" >
		    
    <ul class="list-unstyled" id="breadcrumb">
    <?php 
    if(function_exists('bcn_display'))
    {
	echo bcn_display();
    }
    ?>
    </ul>

<!--products view start-->
<section id="products_view_wrapper" class="outer_width clearfix">
   
    <div class="box_title"><?php  the_title(); ?></div>
    <div class="box_content post-content"> 


    <?php the_content(); ?>			
    <?php comments_template( '', true ); ?>
    
	</div>

 </section>
</section>
<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>