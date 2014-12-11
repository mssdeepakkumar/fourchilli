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



global $query_string;
	
$closed = array(
		'key' => 'closed',
		'value' => "0",
		//'type' => 'numeric',
		'compare' => '='
);

//meta_key=keyname&orderby=meta_value&order=ASC
	
$prs_string_qu = wp_parse_args($query_string);
$prs_string_qu['meta_query'] = array($closed);
$prs_string_qu['meta_key'] = 'featured';
$prs_string_qu['orderby'] = 'meta_value';
$prs_string_qu['order'] = 'DESC';
		
query_posts($prs_string_qu);

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_title = $term->name;
			
//======================================================

	get_header();
	
	$Walleto_adv_code_cat_page_above_content = stripslashes(get_option('Walleto_adv_code_cat_page_above_content'));
		if(!empty($Walleto_adv_code_cat_page_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Walleto_adv_code_cat_page_above_content;
			echo '</div>';
		
		endif;
	

?>

<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap">';	
		    bcn_display();
			echo '</div>';
		}

?>	

<div id="content">

<div class="my_box3">
             
            	<div class="box_title"><?php
						if(empty($term_title)) echo __("All Posted Products",'Walleto');
						else { echo sprintf( __("Latest Posted Products in %s",'Walleto'), $term_title);
						
						?>
                        
                        <a href="<?php bloginfo('siteurl'); ?>/?feed=rss2&<?php echo get_query_var( 'taxonomy' ); ?>=<?php echo get_query_var( 'term' ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/rss_icon.png" 
                    border="0" width="19" height="19" alt="rss icon" /></a>
                        
                        <?php
						
						}
					?> 
            		<?php
							
							echo '<div class="switchers">';
							$view = walleto_get_current_view_grid_list();
					
							if($view != "grid")
							{
								echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid"></a>';
								echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list-selected"></a>';
							}
							else
							{
								echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid-selected"></a>';
								echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list"></a>';
							}
							echo '</div>';
					
					?>
            		 
            		
            	</div> 
				<div class="box_content"> 

<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

<?php 

	
 					if($view != "grid")
						 walleto_get_post_list_view();
					 else
					 	Walleto_get_post();
						
						 ?>

<?php  
 		endwhile; 
		
		if(function_exists('wp_pagenavi')):
		wp_pagenavi(); endif;
		                             
     	else:
		
		echo __('No items posted.',"Walleto");
		
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