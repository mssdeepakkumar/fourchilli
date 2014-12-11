<?php
/***************************************************************************
*
*	Buzzler - copyright (c) - sitemile.com
*	WordPress Business Directory Theme
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/buzzler
*	since v1.0
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
            
            	<div class="box_title"><h1><?php  the_title(); ?></h1></div>
                <div class="box_content post-content"> 


<?php the_content(); ?>			


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