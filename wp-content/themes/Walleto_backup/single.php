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
<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap"><div class="padd10">';	
		    bcn_display();
			echo '</div></div> ';
		}


	

?>	

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



<div id="content">	
			<div class="my_box3">
 
            
            	<div class="box_title"><?php  the_title(); ?></div>
                <div class="box_content post-content"> 


<?php the_content(); ?>			
<?php comments_template( '', true ); ?>

    </div>
			</div>
			</div>
      
        

<?php endwhile; // end of the loop. ?>

<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'single-widget-area' ); ?>
    </ul>
</div>

<?php get_footer(); ?>