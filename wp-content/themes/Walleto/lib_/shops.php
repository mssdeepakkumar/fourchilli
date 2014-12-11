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


if(!function_exists('walleto_shops_show_area_function'))
{
function walleto_shops_show_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	
	global $query_string;

			$Walleto_shop_subscriptions = get_option('Walleto_shop_subscriptions');
			if($Walleto_shop_subscriptions != 'no'):
			
			$membership_available = array(
					'key' => 'membership_available',
					'value' => current_time('timestamp',0),
					'type' => 'numeric',
					'compare' => '>'
			);
			
			endif;
			//meta_key=keyname&orderby=meta_value&order=ASC
				
			$prs_string_qu 					= wp_parse_args($query_string);
			$prs_string_qu['meta_query'] 	= array($membership_available);
			//$prs_string_qu['meta_key'] 		= 'featured';
			//$prs_string_qu['orderby'] 		= 'meta_value';
			$prs_string_qu['order'] 		= 'DESC';
			$prs_string_qu['post_type'] 		= 'shop';
					
			query_posts($prs_string_qu);
	
	
?>	

		<br/>
            	<div class="box_title"><?php echo sprintf(__("Shops",'Walleto')); ?></div>
                
              
                <div class="box_content">   
               
                
                
                <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

		<?php walleto_get_post_shop(); ?>

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
           
                </div>
               

<!-- ############## -->

   
    
    

<?php

 
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>