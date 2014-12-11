<?php
/********************************************************************************
*
*	ClassifiedTheme - copyright (c) - sitemile.com - Details
*	http://sitemile.com/p/classifiedTheme
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v6.2.1
*
*********************************************************************************/

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
            	<div class="padd10">
            
            	<div class="box_title"><?php  the_title(); ?></div>
                <div class="box_content post-content"> 


<?php the_content(); ?>			
<?php comments_template( '', true ); ?>

    </div>
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