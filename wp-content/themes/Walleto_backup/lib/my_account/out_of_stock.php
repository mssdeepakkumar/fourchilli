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


if(!function_exists('Walleto_my_account_display_out_of_stock_page'))
{
function Walleto_my_account_display_out_of_stock_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
<div id="content">
			<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Out Of Stock Products",'Walleto'); ?></div>
                <div class="box_content">   
              <?php

					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$post_per_page = 8;				
				
					query_posts( "meta_key=quant&meta_value=0&post_type=product&order=DESC&orderby=id&author=".$uid."&posts_per_page=" . $post_per_page . "&paged=" . $query_vars['paged'] );
	
					if(have_posts()) :
					while ( have_posts() ) : the_post();
						walleto_active_products_get_product();
					endwhile; 
					
					if(function_exists('wp_pagenavi')):
					wp_pagenavi(); endif;
					
					else:
					
					_e("There are no out of stock products yet.",'Walleto');
					
					endif;
					
					wp_reset_query();
					
					?>

			</div>
			</div>
			
			<div class="clear10"></div>
			
			
		 
			
			
			
		</div> <!-- end div content -->


<?php

	echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>