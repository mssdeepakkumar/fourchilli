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


function buzzler_my_account_watchlist_area_function()
{
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>

	<div id="content" class="content_my_account" >
    
    			<div class="my_box3">          
            	<div class="box_title menu-title-item"><h1><?php _e("My Watchlist",'Buzzler'); ?></h1></div>
                <div class="box_content"> 
    			
				
				<?php
				
				
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."buzzler_watchlist where uid='$uid' order by id asc";	
				$r = $wpdb->get_results($s);

				$my_arr = array();
					
				if(count($r) > 0)
				foreach($r as $item)
				{
					$my_arr[] = $item->pid;	
				}					
				
				if(count($my_arr) == 0) $my_arr[0] = 0;		
				
				$args = array('post__in' => $my_arr,
				'post_type' 	=> 'listing', 
				'paged'			=> $wp_query->query_vars['paged']);
				
				$the_query = new WP_Query( $args );				
				
				if($the_query->have_posts()):
				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post();
				
					buzzler_get_post();
					
				endwhile;
				
				if(function_exists('wp_pagenavi')):
		
					echo '<div class="navi-wrap">';
					wp_pagenavi( array( 'query' => $the_query ) );
					echo '</div>';
				
				endif;
				
				else:
					_e('There are no listings in your watch list.','Buzzler');
				endif;
				
				// Reset Post Data
				wp_reset_postdata();
								
				?>
                
              
                </div>
                </div>
                
    </div>


<?php	
		
	buzzler_get_users_links();		
		
}

?>