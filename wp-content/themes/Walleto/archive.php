<?php
/********************************************************************
*
*	Wallot for WordPress - sitemile.com
*	http://sitemile.com/p/walleto
*	Copyright (c) 2012 sitemile.com
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
*********************************************************************/



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
            	<div class="padd10">
            
            	<div class="box_title">
				
                <?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Blog Archives: %s', 'Walleto' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Blog Archives: %s', 'Walleto' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'Walleto' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Blog Archives: %s', 'Walleto' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'Walleto' ) ) . '</span>' ); ?>
						<?php else : ?>
							<?php _e( 'Blog Archives', 'Walleto' ); ?>
						<?php endif; ?>
                
                </div>
                <div class="box_content post-content"> 
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php Walleto_get_post_blog(); ?>	
		
<?php endwhile; // end of the loop. ?>

    </div>
			</div>
			</div>
            </div>
        



<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
</div>

<?php get_footer(); ?>