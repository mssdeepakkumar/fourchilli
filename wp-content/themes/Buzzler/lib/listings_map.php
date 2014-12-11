<?php


	function Buzzler_adv_search_where_thing($where)
	{
			global $local_long, $local_lat, $radius ; 
			global $wpdb;	
					
			$where .= " AND 
			
			((ACOS(SIN($local_lat * PI() / 180) * SIN(`list_lat` * PI() / 180) + COS($local_lat * PI() / 180) * COS(`list_lat` * PI() / 180) * 
			COS(($local_long - `list_long`) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)
			
			< '$radius'";
	
		
		return $where;
	}
	
	
	function Buzzler_get_lat_stuff_join($wp_join)
	{

			global $wpdb;
			$wp_join .= " LEFT JOIN (
					SELECT post_id, meta_value as list_lat
					FROM $wpdb->postmeta
					WHERE meta_key =  'list_lat' ) AS DD1
					ON $wpdb->posts.ID = DD1.post_id ";
	
		return ($wp_join);
	}
	
	
	function Buzzler_get_long_stuff_join($wp_join)
	{
			global $wpdb;
			$wp_join .= " LEFT JOIN (
					SELECT post_id, meta_value as list_long
					FROM $wpdb->postmeta
					WHERE meta_key =  'list_long' ) AS DD2
					ON $wpdb->posts.ID = DD2.post_id ";
	
		return ($wp_join);
	}
	
	//------------
	
	function buzzler_posts_where_search( $where ) {

			global $wpdb, $term;			
			$where .= " AND ({$wpdb->posts}.post_title LIKE '%$term%' OR {$wpdb->posts}.post_content LIKE '%$term%')";
	
		return $where;
	}
	
function atheme_actAct($s)
{
	if($_GET['meta_key'] == $s) echo 'class="active-search-link"';
	if($s == 'title' && $_GET['orderby'] == $s) echo 'class="active-search-link"';
}


function buzzler_listing_map_area_function()
{
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;

	
	
	if(isset($_GET['pj'])) $pj = $_GET['pj'];
	else $pj = 1;

	if(isset($_GET['order'])) $order = $_GET['order'];
	else $order = "DESC";
	
	if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];
	else $orderby = "meta_value_num";
	
	if(isset($_GET['meta_key'])) $meta_key = $_GET['meta_key'];
	else $meta_key = "featured";


	
	$closed = array(
			'key' => 'closed',
			'value' => "0",
			//'type' => 'numeric',
			'compare' => '='
		);
		
	
	if(isset($_GET['featured']))
	{
		if($_GET['featured'] == "1"):
			$featured = array(
				'key' => 'featured',
				'value' => "1",
				//'type' => 'numeric',
				'compare' => '='
			);				
		endif;
	}
		
	

	if(!empty($_GET['listing_location_cat'])) $loc = array(
			'taxonomy' => 'listing_location',
			'field' => 'slug',
			'terms' => $_GET['listing_location_cat']
		
	);
	else $loc = '';
	
	
	
	
	if(!empty($_GET['listing_cat_cat'])) $adsads = array(
			'taxonomy' => 'listing_cat',
			'field' => 'slug',
			'terms' => $_GET['listing_cat_cat']
		
	);
	else $adsads = '';

	//------------
	global $location_near1;
	
	if(!empty($_GET['search_location']) and $location_near1 != trim($_GET['search_location']))
	{
		global $local_long, $local_lat, $radius ; 
		
		$country = ''; //"UK";	
		$zip = trim($_GET['search_location']);
		$radius = trim($_GET['radius']); 
		
		if(empty($radius)) $radius = 40;
		
		global $mak_address;
		
		$mak_address = $country.",".$zip;

		
		$data 	= Buzzler_get_geo_coordinates($country.",".$zip);
		$local_long 	= $data[3];
		$local_lat 		= $data[2];	
		
		
		add_filter('posts_join', 	'Buzzler_get_lat_stuff_join' );
		add_filter('posts_join', 	'Buzzler_get_long_stuff_join' );
		add_filter('posts_where', 	'Buzzler_adv_search_where_thing');

		
	}
	
	global $term, $search_for, $search_for1;
 
	if(!empty($_GET['search_for']) and $search_for1 != trim($_GET['search_for']))
	{
		$term = trim($_GET['search_for']);
		add_filter( 'posts_where' , 'buzzler_posts_where_search' );

	}
 
	
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
				
				array_push($meta_querya,$stuff);
				
				}
			}
	

		array_push($meta_querya,$price_q);
		array_push($meta_querya,$buy_now_custom_meta);
		array_push($meta_querya,$closed);
		array_push($meta_querya,$featured);
		array_push($meta_querya,$start_price_custom_meta);


//orderby price - meta_value_num

	$nrpostsPage = 10;
	$Buzzler_advanced_search_posts_per_page = get_option('Buzzler_advanced_search_posts_per_page');
	if(!empty($Buzzler_advanced_search_posts_per_page)) $nrpostsPage = $Buzzler_advanced_search_posts_per_page;

	$args = array( 'posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'listing', 'order' => $order , 'meta_query' => $meta_querya ,'meta_key' => $meta_key, 'orderby'=>$orderby,'tax_query' => array($loc, $adsads));
	$args2 = array( 'posts_per_page' =>'-1', 'paged' => $pj, 'post_type' => 'listing', 'order' => $order , 'meta_query' => $meta_querya ,'meta_key' => $meta_key, 'orderby'=>$orderby,'tax_query' => array($loc, $adsads));
	

	
	
	$the_temp_query = new WP_Query( $args2 );
	
	$the_query = new WP_Query( $args );
 
	$nrposts = $the_temp_query->post_count;
	$totalPages = ceil($nrposts / $nrpostsPage);
	$pagess = $totalPages;
	
	

	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
      <div class="my_box3">
   
            
            	<div class="box_title"><?php _e("Advanced Search","Buzzler"); ?></div>
            	<div class="box_content">
                
             		
                    
            <?php
	
		
		// The Loop
		$my_arr = array(); $i = 0;
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			Buzzler_get_post($post, $i);
			
			$lat = get_post_meta(get_the_ID(), 'list_lat', true);
			if(empty($lat)) $lat = 0;
			
			$long = get_post_meta(get_the_ID(), 'list_long', true);
			if(empty($lat)) $long = 0;
			
			$my_arr[$i]['lat']	= $lat;
			$my_arr[$i]['long'] = $long;
			$my_arr[$i]['ttl'] 	= get_the_title();
			$my_arr[$i]['lnk'] 	= get_permalink(get_the_ID());
			$i++;
		endwhile;
		
		
		else:
		
		_e('There are no listings.','Buzzler');
		
		endif;

?>
    
                    
             
                
                 
                </div>
                </div>
    
    <?php
	
	$Buzzler_enable_locations = get_option('Buzzler_enable_locations');
	if($Buzzler_enable_locations != "no"):
	
	?>
    
                <div class="clear10"></div>
    
    
    
    	<div class="my_box3">
           
            
            	<div class="box_title"><?php _e("Map Results","Buzzler"); ?></div>
            	<div class="box_content">	
                
                <div id="map" style="width: 655px; height: 300px;border:2px solid #ccc;float:left"></div>
                
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
            
         
                
                
                </div>
                </div>
                
    <?php endif; ?>
    
    <script>
<?php global $local_long, $local_lat, $radius ;  ?>
 var myLatlng = new google.maps.LatLng(1,1);
  var myOptions = {
    zoom: 11,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map"), myOptions);
	var bounds = new google.maps.LatLngBounds();
	
		
		
		<?php
	
	foreach($my_arr as $item):
	
	?>

  var Marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?php echo $item['lat']; ?>,<?php echo $item['long']; ?>),
      map: map,
      title:"<?php echo $item['ttl']; ?>"
  });
  
  google.maps.event.addListener(Marker, 'click', function() {
    window.location = '<?php echo $item['lnk']; ?>';
  });
  
  var ll = new google.maps.LatLng(<?php echo $item['lat']; ?>, 
        <?php echo $item['long']; ?>);
    bounds.extend(ll);

  
<?php endforeach; ?>
		
		
map.fitBounds(bounds);
</script>
    
    <!-- ############################################# -->
    </div>
    
    
    
    <div id="right-sidebar">
    <ul class="xoxo">
    	<li id="text-6" class="widget-container widget_text">
        <h3 class="widget-title"><?php _e('Search Options','Buzzler'); ?></h3>	
        <div class="textwidget" style="overflow:hidden">
        
                <div style="float:left;width:100%">
                <table width="100%">
                
                
                <form method="get" action="<?php echo Buzzler_listing_map_link(); ?>">
                
                <?php
							
							if(Buzzler_using_permalinks() == false)
							echo '<input type="hidden" value="'.get_option('Buzzler_listing_map_id').'" name="page_id" />';
							
							?>
                
               
<tr><td><?php _e('Search For',"Buzzler"); ?>: </td><td>
                   <input class="do_input_afs" size="20" value="<?php echo $_GET['search_for']; ?>" name="search_for" />
                    </td></tr>
                   

          			<?php
					
					$Buzzler_enable_locations = get_option('Buzzler_enable_locations');
					if($Buzzler_enable_locations != "no"):
					
					?>
                  
                  <tr><td><?php _e('Address/Zip',"Buzzler"); ?>: </td><td>
                   <input class="do_input_afs" size="20" value="<?php echo $_GET['search_location']; ?>" name="search_location" />
                    </td></tr>
                  
                   
                   <tr><td><?php _e('Radius',"Buzzler"); ?>: </td><td>
                   <input class="do_input_afs" size="10" value="<?php echo $_GET['radius']; ?>" name="radius" />
                   <?php _e('miles','Buzzler'); ?></td></tr>
                    
                   <tr><td><?php _e('Filter by Location',"Buzzler"); ?>:</td><td> 
				   <?php	echo Buzzler_get_categories_slug("listing_location", $_GET['listing_location_cat'], __("Select Location","Buzzler"), "do_input_afs2"); ?></td></tr>
                   
                   <?php endif; ?>
                   
                   <tr><td><?php _e('Filter by Category',"Buzzler"); ?>: </td><td>
				   <?php	echo Buzzler_get_categories_slug("listing_cat", $_GET['listing_cat_cat'], __("Select Category","Buzzler"), "do_input_afs2"); ?></td></tr>

                        <?php
		
		$get_catID = Buzzler_get_CATID($_GET['listing_cat_cat']);
		
		if(empty($get_catID)) $get_catID = 0;
		
		$get_catID = array($get_catID);
		$arr = Buzzler_get_listing_category_fields_without_vals($get_catID, 'no');
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<tr>';
					echo '<td>'.$arr[$i]['field_name'].$arr[$i]['id'].':</td>';
					echo '<td>'.$arr[$i]['value'].'</td>';
					echo '</tr>';
			
			
		}	
		
		
		?>  
                
                </div>

                   <tr><td></td><td>
                   <input type="submit" value="<?php _e("Refine Search","Buzzler"); ?>" name="ref-search" class="big-search-submit2" /></td></tr>
                   </form>
</table>
</div>
</li>

<?php dynamic_sidebar( 'other-page-area'); ?>

  	</ul>  
    </div>
    
    
    <?php
	
	
	
}



?>