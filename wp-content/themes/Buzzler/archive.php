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

 

<div id="content">	
			<div class="my_box3">            
            	<div class="box_title">
				
                <?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Blog Archives: %s', 'Buzzler' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Blog Archives: %s', 'Buzzler' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'Buzzler' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Blog Archives: %s', 'Buzzler' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'Buzzler' ) ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'Buzzler' ); ?>
						<?php endif; ?>
                
                </div>
                <div class="box_content post-content"> 
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php Buzzler_get_post_blog(); ?>	
		
<?php endwhile; // end of the loop. ?>

    </div>
			</div>
			</div>

        



<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
</div>

<?php get_footer(); ?>