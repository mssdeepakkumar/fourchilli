<?php
/*
Template Name: Ad_Special_Page
*/
?>

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
			echo '</div></div><div class="clear10"></div>';
		}

?>	



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>			
<?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>