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

function classifiedTheme_posts_where( $where ) {

		global $wpdb, $term;			
		$where .= " AND ({$wpdb->posts}.post_title LIKE '%$term%' OR {$wpdb->posts}.post_content LIKE '%$term%')";
	
	return $where;
}

function ClassifiedTheme_show_me_page_adv_search()
{
	
	
		global $default_search;
	
	if(isset($_GET['pj'])) $pj = $_GET['pj'];
	else $pj = 1;

	if(isset($_GET['order'])) $order = $_GET['order'];
	else $order = "DESC";
	
	if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];
	else $orderby = "date";
	
	if(isset($_GET['meta_key'])) $meta_key = $_GET['meta_key'];
	else $meta_key = "";


	if(!empty($_GET['price_max']) || !empty($_GET['price_max'])) {
		
		if(!empty($_GET['price_max'])) $max =  $_GET['price_max']; else $max = 99999999;
		if(!empty($_GET['price_min'])) $min =  $_GET['price_min']; else $min = 0;
		
		$price_q = array(
			'key' => 'price',
			'value' => array($min, $max),
			'type' => 'numeric',
			'compare' => 'BETWEEN'
		);
	}
	
	$closed = array(
			'key' => 'closed',
			'value' => "0",
			//'type' => 'numeric',
			'compare' => '='
		);
	

	if(!empty($_GET['ad_location_cat'])) $loc = array(
			'taxonomy' => 'ad_location',
			'field' => 'slug',
			'terms' => $_GET['ad_location_cat']
		
	);
	else $loc = '';
	
	
	
	
	if(!empty($_GET['ad_cat_cat'])) $adsads = array(
			'taxonomy' => 'ad_cat',
			'field' => 'slug',
			'terms' => $_GET['ad_cat_cat']
		
	);
	else $adsads = '';

	//------------
	

	
	global $term;
	$term = trim($_GET['term']);
	
	if(!empty($_GET['term']))
	{
		if($_GET['term'] != $default_search)
		add_filter( 'posts_where' , 'classifiedTheme_posts_where' );			
		
	}
	
	if(!empty($_GET['tags']))
	{
		
			$myar = array();
		
		$trm = explode(' ',$_GET['tags']);
		foreach($trm as $t)
			$myar[] = $t;
		
			$tags = array(
			'taxonomy' => 'post_tag',
			'field' => 'slug',
			'terms' => $myar);
	}
	else $tags = '';
	
	
	//------------

	$meta_querya = array();

			$arr = $_GET['custom_field_id'];
			
			for($i=0;$i<count($arr);$i++)
			{
				$ids 	= $arr[$i];
				$value 	= $_GET['custom_field_value_'.$ids];
				
				if(!empty($value)) {
				
				
				if(is_array($value))
				{
					$val = array();
					
					for($j=0;$j<count($value);$j++)						
						$val[] = $value[$j];
					
				}
				elseif(!empty($value)) {
				
					$val = $value;
				
				}
				
				$stuff = array(
					'key' => "custom_field_ID_".$ids,
					'value' => $val,
					'compare' => 'LIKE'
				);
				
				$meta_querya[] = $stuff;
				
				}
			}

//-----------------------
//orderby price - meta_value_num
	
	$ClassifiedTheme_listings_per_page_adv_search = get_option('ClassifiedTheme_listings_per_page_adv_search');
	$nrpostsPage = $ClassifiedTheme_listings_per_page_adv_search;

	if(empty($nrpostsPage)) $nrpostsPage = 10;
	
	
	
	if(!empty($price_q))
	$meta_querya[] = $price_q;
	$meta_querya[] = $closed;

	//echo '<pre>';
	//print_r($meta_querya);
	//echo '</pre>';
	
	$args = array( 'posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'ad', 'order' => $order , 'meta_query' => $meta_querya ,'meta_key' => $meta_key, 'orderby'=>$orderby,'tax_query' => array($loc, $adsads, $tags));
 
	
 
	
	$the_query = new WP_Query( $args );
	
	//echo '<pre>';
	//print_r($the_query);
	//echo '</pre>';
	
	$nrposts = $the_query->found_posts;
	$totalPages = ceil($nrposts / $nrpostsPage);
	$pagess = $totalPages;
	
	
	
	?>
    
    
    <div id="content">
	
    		<div class="my_box3">
       
            
            	<div class="box_title"><?php _e("Advanced Search", "ClassifiedTheme"); ?></div>
            	<div class="box_content">	
   
   
                    
                     <div style="float:left;padding-top:10px">
                    <?php
					
						$ge = 'order='.($_GET['order'] == 'ASC' ? "DESC" : "ASC").'&meta_key=price&orderby=meta_value_num';
						foreach($_GET as $key => $value)
						{
							if($key != 'meta_key' && $key != 'orderby' && $key != 'order')
							{
								$ge .= '&'.$key."=".$value;	
							}
						}
					
					//------------------------
						
						$ge2 = 'order='.($_GET['order'] == 'ASC' ? "DESC" : "ASC").'&orderby=title';
						foreach($_GET as $key => $value)
						{
							if( $key != 'orderby' && $key != 'order')
							{
								$ge2 .= '&'.$key."=".$value;	
							}
						}
					//------------------------
						
						$ge3 = 'order='.($_GET['order'] == 'ASC' ? "DESC" : "ASC").'&meta_key=views&orderby=meta_value_num';
						foreach($_GET as $key => $value)
						{
							if($key != 'meta_key' && $key != 'orderby' && $key != 'order')
							{
								$ge3 .= '&'.$key."=".$value;	
							}
						}
					
					
					?>
                    
                    Order by: <a href="<?php bloginfo('siteurl'); ?>/advanced-search/?<?php echo $ge; ?>"><?php _e("Price", "ClassifiedTheme");?></a> | 
                    <a href="<?php bloginfo('siteurl'); ?>/advanced-search/?<?php echo $ge2; ?>"><?php _e("Name", "ClassifiedTheme");?></a> | 
                    <a href="<?php bloginfo('siteurl'); ?>/advanced-search/?<?php echo $ge2; ?>"><?php _e("Visits", "ClassifiedTheme");?></a>
                    </div>
                    
                    
                   </form> 
                    
                
                   
                </div>
                </div>
            
                
                
                <div class="clear10"></div>
    
    

			<div class="my_box3">            
            	<div class="box_title"><?php _e("Search Results", "ClassifiedTheme"); ?></div>
            	<div class="box_content">	
	
    
<?php
	
		
		// The Loop
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			classifiedTheme_get_post($post, $i);
	
			
		endwhile;
	

?>
    

                     
                    
                     <div class="nav">
                     <?php
					 	
		$batch = ceil($pj / $nrpostsPage );
		$end = $batch * $nrpostsPage;
		if ($end == $my_pages) {
			//$end = $end + $this->links_per_page - 1;
		//$end = $end + ceil($this->links_per_page/2);
		}
		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
		
		$dd = $pj - 1;
		$pjs = $pj - 15;
		if($pjs < 0) $pjs = 1;
		
		if($pj == 1) { $dd = 1; $pjs = 1; }
		
		
		echo '<a href="'.get_bloginfo('siteurl').'/advanced-search/?search_me=1&ad_cat='.$category22.'&title='.$title.'&minprice='.$minprice.'&maxprice='.$maxprice.'&pj='.($dd).'"><< Previous</a>';
		
		
		echo '<a href="'.get_bloginfo('siteurl').'/advanced-search/?search_me=1&ad_cat='.$category22.'&title='.$title.'&minprice='.$minprice.'&maxprice='.$maxprice.'&pj='.($pjs).'"><<</a>';
		
		
		
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pj) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
				
					
					$ge = 'pj='.$i;
						foreach($_GET as $key => $value)
						{
							if($key != 'pj')
							{
								$ge .= '&'.$key."=".$value;	
							}
						}
	
				
				echo '<a href="'.get_bloginfo('siteurl').'/advanced-search/?'.$ge.'">'.$i.'</a>';
			}
		}
		
		$pjs = $pj+15;
		if($pjs > $pagess) $pjs = $pagess;
		
		
					$ge = 'pj='.$pjs;
						foreach($_GET as $key => $value)
						{
							if($key != 'pj')
							{
								$ge .= '&'.$key."=".$value;	
							}
						}
		
		echo '<a href="'.get_bloginfo('siteurl').'/advanced-search/?'.$ge.'">>></a>';
						
				
				
				echo '<a href="'.get_bloginfo('siteurl').'/advanced-search/?search_me=1&ad_cat='.$category22.'&title='.$title.'&minprice='.$minprice.'&maxprice='.$maxprice.'&pj='.($pj+1).'">Next >></a>';
						
						
				
					 ?>
                     </div>
                  <?php  
                                          
     	else:
		
		echo __('No ads posted.', "ClassifiedTheme");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();

            
					 
		?>
	
	
</div>
</div>
</div>




    
    
    
    <div id="right-sidebar">
    <ul class="xoxo">
    	<li id="text-6" class="widget-container widget_text">
        <h3 class="widget-title"><?php _e('Search Options','ClassifiedTheme'); ?></h3>	
        <div class="textwidget" style="overflow:hidden">
        
                <div style="float:left;width:100%">
                <table width="100%">
                
                
                <form method="get" action="<?php echo ClassifiedTheme_advanced_search_link(); ?>">
                
                <?php
							
							if(ClassifiedTheme_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('ClassifiedTheme_adv_search_id').'" name="page_id" />';
							
							?>
                
                   <tr><td><?php _e('Keyword',"ClassifiedTheme"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['term']; ?>" name="term" />
                   </td></tr>
                   
                   <tr><td><?php _e('Min Price',"ClassifiedTheme"); ?>:</td><td>
                    <input class="do_input_afs" size="10" value="<?php echo $_GET['price_min']; ?>" name="price_min" /></td></tr> 
                    
                   <tr><td><?php _e('Max Price',"ClassifiedTheme"); ?>:</td><td> 
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['price_max']; ?>" name="price_max" /></td></tr>
          			
                    
                   <tr><td><?php _e('Filter by Location',"ClassifiedTheme"); ?>:</td><td> 
				   <?php	echo ClassifiedTheme_get_categories_slug("ad_location", $_GET['ad_location_cat'], __("Select Location","ClassifiedTheme"), "do_input_afs2"); ?></td></tr>
                   
              
                   
                   <tr><td><?php _e('Filter by Category',"ClassifiedTheme"); ?>: </td><td>
				   <?php	echo ClassifiedTheme_get_categories_slug("ad_cat", $_GET['ad_cat_cat'], __("Select Category","ClassifiedTheme"), "do_input_afs2"); ?></td></tr>

                      
                      
                      
                       <?php
		
		$get_catID = ClassifiedTheme_get_CATID($_GET['ad_cat_cat']);
		
		if(empty($get_catID)) $get_catID = 0;
		
		$get_catID = array($get_catID);
		$arr = classifiedTheme_get_auction_category_fields_without_vals($get_catID, 'no');
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<tr>';
					echo '<td>'.$arr[$i]['field_name'].$arr[$i]['id'].':</td>';
					echo '<td>'.$arr[$i]['value'].'</td>';
					echo '</tr>';
			
			
		}	
		
		
		?>  
                
                

                   <tr><td></td><td>
                   <input type="submit" value="<?php _e("Refine Search","ClassifiedTheme"); ?>" name="ref-search" class="big-search-submit2" /></td></tr>
                   </form>
</table> </div>
</div>
</li>

<?php dynamic_sidebar( 'other-page-area'); ?>

  	</ul>  
    </div>
    
    
    <?php
	
	
	
}

?>