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

global $query_string, $wp_query;
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);

function CT_custom_orderby($orderby) {
	global $wpdb;
    return $orderby . ", $wpdb->posts.post_date DESC";
}
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);

$prs_string_qu['meta_key'] = 'featured';
$prs_string_qu['orderby'] = 'meta_value';
$prs_string_qu['order'] = 'DESC';
		
add_filter('posts_orderby', 'CT_custom_orderby');		
query_posts($prs_string_qu);
remove_filter('posts_orderby', 'CT_custom_orderby');



$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
			
//======================================================

	get_header();
	
	$ClassifiedTheme_adv_code_cat_page_above_content = stripslashes(get_option('ClassifiedTheme_adv_code_cat_page_above_content'));
		if(!empty($ClassifiedTheme_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $ClassifiedTheme_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

?>

<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap"><div class="padd10">';	
		    bcn_display();
			echo '</div></div>';
		}

?>	

<div id="content">

<div class="my_box3">
            	            
            	<div class="box_title"><?php
						if(empty($term_title)) echo __("All Posted Items",'ClassifiedTheme');
						else { echo sprintf( __("Latest Posted Items in %s",'ClassifiedTheme'), $term_title);
						
						?>
                        
                        <a href="<?php bloginfo('siteurl'); ?>/?feed=rss2&<?php echo get_query_var( 'taxonomy' ); ?>=<?php echo get_query_var( 'term' ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss_icon.png" 
                    border="0" width="19" height="19" alt="rss icon" /></a>
                        
                        <?php
						
						}
					?>
            		
            		
            		
            	</div> 
				<div class="box_content"> 

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php ClassifiedTheme_get_post(); ?>

<?php  
 		endwhile; 
		
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No listings posted.',"ClassifiedTheme");
		
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