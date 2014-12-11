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

	function Buzzler_colorbox_stuff()
	{	
	
		echo '<link media="screen" rel="stylesheet" href="'.get_bloginfo('template_url').'/css/colorbox.css" />';
		/*echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>'; */
		echo '<script src="'.get_bloginfo('template_url').'/js/jquery.colorbox.js"></script>';
		
		?>
		
		<script>

	var $ = jQuery;

			$(document).ready(function(){
				
				$("a[rel='image_gal1']").colorbox();
				$("a[rel='image_gal2']").colorbox();
							
		});
		</script>
		
		<?php
	}
	
	add_action('wp_head','Buzzler_colorbox_stuff');	

//--------------------------------------------------------------------------

	get_header();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	//----------------------------------
	
	if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap"><div class="padd10">';	
		    bcn_display();
			echo '</div></div> ';
		}
	
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php


	$views    	= get_post_meta(get_the_ID(), "views", true);
	if(empty($views)) $views = 0;
	
	$views 		= $views + 1;
	
	if(!buzzler_is_owner_of_post())
	update_post_meta(get_the_ID(), "views", $views);


?>

<?php

	$Buzzler_adv_code_listing_page_above_content = get_option('Buzzler_adv_code_listing_page_above_content');
	if(!empty($Buzzler_adv_code_listing_page_above_content)) echo '<div class="wrapper">'.stripslashes($Buzzler_adv_code_listing_page_above_content) . '</div>';
			

?>

	<?php
	
		if(isset($_POST['submit_me']))
		{
			
			
			echo '<div class="saved_thing">'.__('Your message has been sent','Buzzler').'</div>';
			echo '<div class="clear10"></div>';	
		}	
	
	?>
    

	<div id="content" class="single-listing-page-content">
 
    	<div class="my_box3">
            
            	<div class="box_title"><h1><?php  the_title(); ?></h1></div>
                <div class="box_content post-content"> 
                
                				
                                <div class="listing-page-details-holder">
                                
                                	<div class="listing-page-ratings">
										
                                        <ul class="listing-main_details">
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Listing Rating:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo buzzler_get_rating_for_post(get_the_ID(), '-main'); ?></div>
                                                <div class="floatleft"> <?php $rtg = buzzler_get_total_ratings_post(get_the_ID()); printf(__('%s reviews','Buzzler'), $rtg); ?></div>
                                            </li>
                                            
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Posted In:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo get_the_term_list( get_the_ID(), 'listing_cat', '', ', ', '' ); ?></div>
                                            </li>
                                            
                                            
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Located In:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo get_the_term_list( get_the_ID(), 'listing_location', '', ', ', '' ); ?></div>
                                            </li>
                                            
                                            
                                             <li>
                                                <div class="floatleft ttl_main"><?php _e('Street Address:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo get_post_meta(get_the_ID(), 'street_address', true); ?></div>
                                            </li>
                                            
                                            
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Website:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo buzzler_get_website_url(get_the_ID()); ?></div>
                                            </li>
                                           
                                           <?php
										   
										   $args = array(
											'order'          => 'ASC',
											'orderby'        => 'post_date',
											'post_type'      => 'attachment',
											'post_parent'    => get_the_ID(),
											'post_mime_type' => array('application/zip','application/pdf'),
											'numberposts'    => -1,
											); $i = 0;
											
											$attachments = get_posts($args);
										   	if(count($attachments) > 0):
											
										   ?> 
                                            
                                            
                                             <li>
                                                <div class="floatleft ttl_main"><?php _e('Files:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo '<a target="_blank" href="'.wp_get_attachment_url($attachments[0]->ID).'">'.$attachments[0]->post_title.'</a>' ?></div>
                                            </li>
                                            
                                            <?php endif; ?>
                                  
                                      	</ul>
                                        
                                        <ul class="listing-extra_details">
                                        	
																	<?php
                                        $arrms = get_listing_fields_values(get_the_ID());
                                        
                                        if(count($arrms) > 0) 
                                            for($i=0;$i<count($arrms);$i++)
                                            {
                                        
                                        ?>
                                            <li>
                                                 
                                                <div class="floatleft ttl_main"><?php echo $arrms[$i]['field_name'];?>:</div>
                                                <div class="floatleft main_det_res"><?php 
                            
                                    
                                                if(is_array($arrms[$i]['field_value'][0]))
                                                {
                                                
                                                    foreach($arrms[$i]['field_value'][0] as $vl)
                                                    {
                                                
                                                        echo $vl	.'<br/>';
                                                    }
                                                }
                                                else echo $arrms[$i]['field_value'][0];
                                                ?></div>
                                            </li>
                                            
                                            <?php } ?>
                                            
                                        </ul>
                                        
                                        
                                        <div class="listing-extra-options-div">
                                        <div  class="floatleft">
                <?php
					
					$claimed = get_post_meta(get_the_ID(), 'claimed', true);
					$Buzzler_claim_listing_enable = get_option('Buzzler_claim_listing_enable');
					
					if($claimed != "1" and $Buzzler_claim_listing_enable == "yes"):
					
					$idss = get_option('Buzzler_claim_listing_page_id');
					if(buzzler_using_permalinks() == true)
						$lnks = get_permalink($idss)."?pid=" . get_the_ID();	
					else
						$lnks = get_bloginfo('siteurl')."?pid=" . get_the_ID()."&page_id=".$idss;
					
				?>                        	
                <a class="small_links_listing" href="<?php echo $lnks; ?>" ><?php _e('Claim Listing','Buzzler'); ?></a>
                <?php endif; ?>
                
                
                <?php
				
					$Buzzler_contact_owner_enable = get_option('Buzzler_contact_owner_enable');
					if($Buzzler_contact_owner_enable == "yes"):
				
				?> 
                <script>
				var $ = jQuery;
		
			$(document).ready(function(){
				
				$('#contact_owner_thing').click( function () {
					
					var pid = $(this).attr('rel');
					$.colorbox({href: "<?php bloginfo('siteurl'); ?>/?contact_owner_thing=" + pid });
					return false;
				});
				
				
			});
				
				</script>
                
                <a class="small_links_listing" id="contact_owner_thing" rel="<?php the_ID() ?>" href="#" ><?php _e('Contact Owner','Buzzler'); ?></a>
                
                                             <?php
			   endif;
			   	
			   
			   	if(buzzler_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):				
				?>
                
                <a class="rem-to-watchlist small_links_listing" rel="<?php the_ID(); ?>"  href="#"><?php _e('Remove from watchlist','Buzzler'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist small_links_listing" rel="<?php the_ID(); ?>" href="#"><?php _e('Add to watchlist','Buzzler'); ?></a>
                <?php endif; ?> 
                
                
                <a href="#write-a-review-ids" class="small_links_listing"><?php _e('Write Review','Buzzler'); ?></a>
                                        
                                        </div>
                                        	<!-- AddThis Button BEGIN -->
                                            <div class="addthis_toolbox addthis_default_style addthis_16x16_style" style="float:left; width:100%; padding-top:10px;">
                                            <a class="addthis_button_preferred_1"></a>
                                            <a class="addthis_button_preferred_2"></a>
                                            <a class="addthis_button_preferred_3"></a>
                                            <a class="addthis_button_preferred_4"></a>
                                            <a class="addthis_button_compact"></a>
                                            <a class="addthis_counter addthis_bubble_style"></a>
                                            </div>
                                            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4df68b4a2795dcd9"></script>
                                            <!-- AddThis Button END -->
                                        
                                        </div>
                                        
                                        
                                    </div>
                                
                                </div>
                                
                                
                                
                                
                                <div class="listing-page-image-holder">
                                <img class="img_class" src="<?php echo buzzler_get_first_post_image(get_the_ID(), 250, 170); ?>" alt="<?php the_title(); ?>" />
                                
                                        <?php
                                
                                $arr = buzzler_get_post_images(get_the_ID(), 4);
                
                                if($arr)
                                {
                                    
                                
                                echo '<ul class="image-gallery" style="padding-top:10px">';
                                foreach($arr as $image)
                                {
                                    echo '<li><a href="'.buzzler_generate_thumb($image, -1,600).'" rel="image_gal1"><img 
                                    src="'.buzzler_generate_thumb($image, 53,50).'" class="img_class" /></a></li>';
                                }
                                echo '</ul>';
                                
                                
                                }
                                
                                
                            	?>
                                    
                                </div>
                
                
                
               
       			</div>
       </div>
    
    	<!-- ################### -->
        
        
        <div class="my_box3">
            
            	<div class="box_title"><?php _e('Listing Overview','Buzzler'); ?></div>
                <div class="box_content post-content"> 
                	<?php the_content(); ?>
                </div>
        </div>
        
        <div class="my_box3">
        <div class="box_title"><?php echo __("Job Videos",'Buzzler'); ?></div>
                <div class="box_content">
				<?php
				
				// stugg here
				$vid = 0;

					$video = get_post_meta(get_the_ID(),'youtube_link',true);
					if(strstr($video,"?v=") != false)
					{
						$exp = explode("?v=",$video);
						$code_here = $exp[1];
						$done = 1;
					
					}
					
					if(strstr($video,"youtu.be/") != false)
					{
						$exp = explode("youtu.be/",$video);
						$code_here = $exp[1];
						$done = 1;
					}
					
					if(!empty($video) && $done == 1)
					{
					
						echo '<iframe style="margin-right:10px;margin-bottom:10px" width="225" height="180" src="http://www.youtube.com/embed/'.$code_here.'"
						 frameborder="0" allowfullscreen></iframe> ';
						 $vid = 1;
					
					}
				
				
				if($vid == 0) _e('No videos attached with this job.','Buzzler');
				
				?>
				
				
			
			</div></div>
        
        
        <div class="my_box3" id="write-a-review-ids">
            
            	<div class="box_title"><?php _e('Write Review','Buzzler'); ?></div>
                <div class="box_content post-content"> 
                	<?php  include 'write-review.php'; ?> 
                </div>
        </div>
        
         
        <div class="my_box3">
            
            	<div class="box_title"><?php _e('Reviews','Buzzler'); ?></div>
                <div class="box_content post-content"> 
                	<?php comments_template('/listing-reviews.php'); ?> 
                </div>
        </div>
    
    
    </div><!-- end content -->
    
    
    <div id="right-sidebar" class="right-sidebar-listing-page">
    <ul class="xoxo">
    <li class="listing-page-map-holder">
    		<div class="show_big_map"><a href="<?php echo buzzler_show_big_map_lnk(get_the_ID()); ?>"><?php _e('Show Full Map','Buzzler'); ?></a></div>	
    		<div id="map1"></div>
				
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
    map = new google.maps.Map(document.getElementById("map1"), myOptions);
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

	global $post;
	$pid = $post->ID;

	$terms = wp_get_post_terms($pid,'listing_location');
	foreach($terms as $term)
	{
		echo $term->name.",";
	}

	$location = get_post_meta($pid, "street_address", true);
	$location = preg_replace('~[\r\n]+~', '', $location);		
	echo $location;
	
 ?>");

    </script> 
    
    </li>
    
    <li>
    	<h3 class="widget-title"><?php _e('Photo Gallery','Buzzler'); ?></h3>
        
        <?php
		
			$arr = buzzler_get_post_images(get_the_ID(), 999);
                
                                if($arr)
                                {
                                    
                                
                                echo '<ul class="image-gallery" style="padding-top:10px">';
                                foreach($arr as $image)
                                {
                                    echo '<li><a href="'.buzzler_generate_thumb($image, -1,600).'" rel="image_gal2"><img 
                                    src="'.buzzler_generate_thumb($image, 50,50).'" class="img_class" /></a></li>';
                                }
                                echo '</ul>';
                                
                                
                                }
		
		
		?>
    </li>
    
        <?php dynamic_sidebar( 'listing-widget-area' ); ?>
    </ul>
</div>



<?php endwhile; ?>

 

<?php get_footer(); ?>