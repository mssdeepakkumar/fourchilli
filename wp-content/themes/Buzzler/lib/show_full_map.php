<?php

	global $wp;
	global $wp_query, $wp_rewrite, $post;
	$pid 	=  $wp_query->query_vars['pid'];
	
	//---------------------------------------
	
	$post = get_post($pid);
	$s = $post->post_title;
	
	get_header();	


?>

	<div id="content" class="full_width_div">
    
    	<div class="my_box3">
            
            	<div class="box_title"><h1><?php  echo sprintf(__('Show Full Map - %s','Buzzler') , $s); ?></h1></div>
                <div class="box_content post-content"> 
	
    			
                
                <div id="map2"></div>
				
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
            
            <script type="text/javascript"
            src="<?php echo get_bloginfo('template_url'); ?>/js/mk.js"></script> 
                                                <script type="text/javascript"> 
   
	  var geocoder;
  var map;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
      zoom: 13,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map2"), myOptions);
  }

  function codeAddress(address) {
    
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new MarkerWithLabel({
            
            position: results[0].geometry.location,
			map: map,
       labelContent: address,
       labelAnchor: new google.maps.Point(22, 0),
       labelClass: "labels", // the CSS class for the label
       labelStyle: {opacity: 1.0}

        });
      } else {
        //alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }

initialize();

codeAddress("<?php 


	$terms = wp_get_post_terms($pid,'listing_location');
	foreach($terms as $term)
	{
		echo $term->name.",";
	}

	$location = get_post_meta($pid, "street_address", true);	
	echo $location;
	
 ?>");

    </script> 
                
    
    </div>
    </div>
    </div>
    
<?php get_footer(); ?>