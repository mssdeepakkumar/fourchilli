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


global $query_string;
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);
		
//query_posts($prs_string_qu);

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
			
//======================================================

	get_header();
	
	$Buzzler_adv_code_cat_page_above_content = stripslashes(get_option('Buzzler_adv_code_cat_page_above_content'));
		if(!empty($Buzzler_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Buzzler_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

?>

<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3"><div class="padd10">';	
		    bcn_display();
			echo '</div></div>';
		}

?>	

<div id="content">

<div class="my_box3">           
            	<div class="box_title"><?php
						if(empty($term_title)) echo __("All Posted Listings",'Buzzler');
						else echo sprintf( __("Latest Posted Auctions in %s",'Buzzler'), $term_title);
					?>
            		
            		
            		
            	</div> 
				<div class="box_content">

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php Buzzler_get_post(); ?>

<?php  
 		endwhile; 
		
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No listings posted.',"Buzzler");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();
		 
		?>


</div></div></div> 


<div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
</div>


<?php

	get_footer();

?>