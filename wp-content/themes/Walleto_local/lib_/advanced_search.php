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
	
	$nrpostsPage = 9;
	$Walleto_listings_per_page_adv_search = get_option('Walleto_listings_per_page_adv_search');
	if(!empty($Walleto_listings_per_page_adv_search)) $nrpostsPage = $Walleto_listings_per_page_adv_search;

 

	$args = array('posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'product', 'order' => $order , 'meta_query' => $meta_querya ,
	'meta_key' => $meta_key, 'orderby'=>$orderby,'tax_query' => array($category_product));
	$the_query = new WP_Query( $args );


	$nrposts = $the_query->found_posts;
	$totalPages = ceil($nrposts / $nrpostsPage);
	$pagess = $totalPages;
	
	
	
?>
  
       <section id="product_list_new" class="product_list_wrapper wedding_products_wrapper_class">
          <div class="product_list_heading">
            	<span class="heading_text"><?php echo sprintf(__("Advanced Search",'Walleto')); ?></span>
	            <span class="view_all">
                    <a href="" class="view_all_items">View all Items   <i class="icon-double-angle-right ml10"></i></a>
                </span>
		</div>   
                
		<ul class="list-unstyled product_listing_ul all_posted_products_list" id="adsearch_product">
                 <?php
	
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
		walleto_get_post_list_view();
						
			
		endwhile;
		?>
		</ul>
		<div class="wp-pagenavi">
		<?php
					 	
		$batch = 3; //ceil($page / $nrpostsPage );
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

<!-- ############## -->

   
   
    


<?php

}
}
?>