<?php
/*
Template Name: Advanced_Search_Page
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
  

    <?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
    <?php the_content();?>						
    <?php endwhile; // end of the loop. ?>
   
    </section>
    <!--right side banner main wrapper start-->   
   
    </section>
    <!--middel section end-->  
    


<?php get_footer(); ?>