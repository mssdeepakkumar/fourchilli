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


	function walleto_search_posts_where( $where ) {

			global $wpdb, $term;			
			$where .= " AND ({$wpdb->posts}.post_title LIKE '%$term%' OR {$wpdb->posts}.post_content LIKE '%$term%')";
	
		return $where;
	}

if(!function_exists('walleto_advanced_search_content_area_function'))
{
function walleto_advanced_search_content_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	//-------------------------------------------
	
	global $term;
	$term = trim(strip_tags($_GET['term']));
	
	if(!empty($_GET['term']))
	{
		add_filter( 'posts_where' , 'walleto_search_posts_where' );
		
	}
	
	//-------------------------------------------
	
	if(!empty($_GET['product_cat_cat'])) $category_product = array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => $_GET['product_cat_cat']
		
	);
	else $category_product = '';
	
	//------------------------------------------
	
	//array_push($meta_querya,	$category_product);
	
	//------------------------------------------
	
	if(isset($_GET['pj'])) $pj = $_GET['pj'];
	else $pj = 1;
	
	$my_page = $pj;
	
	$nrpostsPage = 16;
	$Walleto_listings_per_page_adv_search = get_option('Walleto_listings_per_page_adv_search');
	if(!empty($Walleto_listings_per_page_adv_search)) $nrpostsPage = $Walleto_listings_per_page_adv_search;

 

	$args = array('posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'product', 'order' => $order , 'meta_query' => $meta_querya ,
	'meta_key' => $meta_key, 'orderby'=>$orderby,'tax_query' => array($category_product));
	$the_query = new WP_Query( $args );


	$nrposts = $the_query->found_posts;
	$totalPages = ceil($nrposts / $nrpostsPage);
	$pagess = $totalPages;
	
	
	
?>	
<div id="content"> 
<div class="my_box3"> 
            
            	<div class="box_title"><?php echo sprintf(__("Advanced Search",'Walleto')); ?>
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
               
                 <?php
	
		
		// The Loop
		$my_arr = array(); $i = 0;
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
		
	
 					if($view != "grid")
						 walleto_get_post_list_view();
					 else
					 	Walleto_get_post();
						
			
		 
			$i++;
		endwhile;
		//********************** pagination ***********************************
		?>
		
		 <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;
		$pages_curent = $my_page;

		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		echo '<a href="'.Walleto_get_adv_search_pagination_link($previous_pg).'"><< '.__('Previous','Walleto').'</a>';
		echo '<a href="'.Walleto_get_adv_search_pagination_link($start_me).'"><<</a>';		
		
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.Walleto_get_adv_search_pagination_link($i).'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.Walleto_get_adv_search_pagination_link($end_me).'">>></a>';
		echo '<a href="'.Walleto_get_adv_search_pagination_link($next_pg).'">'.__('Next','Walleto').' >></a>';						
				
					 ?> 
                     </div> <?php
		
		
		
		//*********************************************************************
		
		else:
		
		_e('There are no products.','Walleto');
		
		endif;

?>
    
                
                
           
                </div>
                </div></div>

<!-- ############## -->

   
    <div id="right-sidebar">
    <ul class="xoxo">
    <li id="text-6" class="widget-container widget_text">
        <h3 class="widget-title"><?php _e('Search Options','Walleto'); ?></h3>	
        
        <div class="textwidget" style="overflow:hidden">
        
                <div style="float:left;width:100%">
                <table width="100%">
                
                
                <form method="get" action="<?php echo Walleto_advanced_search_link(); ?>">
                
                <?php
							
							if(Walleto_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('Walleto_adv_search_id').'" name="page_id" />';
							
							?>
        
                    
                   <tr><td><?php _e('Keyword',"Walleto"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['term']; ?>" name="term" />
                   </td></tr>
                   
                   <tr><td><?php _e('Min Price',"Walleto"); ?>:</td><td>
                    <input class="do_input_afs" size="10" value="<?php echo $_GET['price_min']; ?>" name="price_min" /></td></tr> 
                    
                   <tr><td><?php _e('Max Price',"Walleto"); ?>:</td><td> 
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['price_max']; ?>" name="price_max" /></td></tr>
          			 
                   
                   <tr><td><?php _e('Category',"Walleto"); ?>: </td><td> 
				   <?php	echo Walleto_get_categories_slug("product_cat", $_GET['product_cat_cat'], __("Select Category","Walleto"), "do_input_afs2"); ?></td></tr>

                        <?php
		
		$get_catID = Walleto_get_CATID($_GET['product_cat_cat']);
		
		if(empty($get_catID)) $get_catID = 0;
		
		$get_catID = array($get_catID);
		$arr = walleto_get_product_category_fields_without_vals($get_catID, 'no');
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<tr>';
					echo '<td>'.$arr[$i]['field_name'].$arr[$i]['id'].':</td>';
					echo '<td>'.$arr[$i]['value'].'</td>';
					echo '</tr>';
			
			
		}	
		
		
		?>  
                
               

                   <tr><td></td><td>
                   <input type="submit" value="<?php _e("Refine Search","Walleto"); ?>" name="ref-search" class="big-search-submit2" /></td></tr>
                   </form>
</table> </div></div>
        
        </li>
    
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
    </div>
    

<style>
.no { width:100px; }
</style>
<?php

 
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>