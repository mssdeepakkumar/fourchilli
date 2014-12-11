<?php
/*
Template Name: Right-sidbar Template
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

<section id="right_side_banner_main_wrapper">
      
        <!--left side bar-->
        <section id="left_section_right_side_banner">
        <section class="middle_text_section_wrapper">       
                <?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
		<?php the_content();
		
			?>						
		<?php endwhile; // end of the loop. ?>
        </section>
        </section>         
        <!--left side bar end-->
        
        <!--right side bar-->
        <section id="right_section_right_side_banner">       
           
	     <?php echo Walleto_get_users_links();?>
            	
                	
        </section>
        <!--right side bar end-->
        
</section>

<?php get_footer(); ?>