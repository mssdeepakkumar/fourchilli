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


function buzzler_post_new_area_function()
{
	
	$new_listing_step =  $_GET['step'];
	if(empty($new_listing_step)) $new_listing_step = 1;
	
	$pid = $_GET['listing_id'];
	global $error, $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;	
	$is_limit_reached = false;
	
	$Buzzler_limit_for_listings_enable 	= get_option('Buzzler_limit_for_listings_enable');
	
	if($Buzzler_limit_for_listings_enable == "yes")
	{
		$max_posts = buzzler_count_user_posts_by_type($uid,'listing');
		
		$Buzzler_max_nr_of_listings 		= get_option('Buzzler_max_nr_of_listings');
		if($max_posts >= $Buzzler_max_nr_of_listings)
		{
			$is_limit_reached = true;	
		}
	}
	
	//--------------------------------------
	?>
    
    
    	<div id="content" class="full_width_dv" >
    
    			<div class="my_box3">          
            	<div class="box_title menu-title-item"><h1><?php _e("Post New Listing",'Buzzler'); ?></h1></div>
                <div class="box_content"> 
    <?php
	
		if($is_limit_reached == true):
		
			echo sprintf(__('Your maximum number of posts/listings has been reached. You cannot post anymore listings. <a href="%s">Return to your account</a>.','Buzzler') , 
			get_permalink(get_option('Buzzler_my_account_page_id')) );
		
		else:
	
	?>
            
            <?php
				
				echo '<div id="steps">';		
					echo '<ul>';
						echo '<li '.($new_listing_step == '1' ? "class='active_step' " : "").'>'.__("Write Listing", 'Buzzler').'</li>';
						echo '<li '.($new_listing_step == '2' ? "class='active_step' " : "").'>'.__("Add Photos", 'Buzzler').'</li>';
						echo '<li '.($new_listing_step == '3' ? "class='active_step' " : "").'>'.__("Review & Publish", 'Buzzler').'</li>';
					echo '</ul>';					
				echo '</div>';

				
				
			?>
    
        
        
<?php

if($new_listing_step == "1")
{      

	//-----------------
	$post 		= get_post($pid);
	$location 	= wp_get_object_terms($pid, 'listing_location');
	$cat 		= wp_get_object_terms($pid, 'listing_cat');
	
	if(is_array($error))
	if($listingOK == 0)
	{
		echo '<div class="errrs">';
		
			foreach($error as $e)		
			echo '<div class="newad_error">'.$e. '</div>';	
	
		echo '</div>';
		
	}
	
	do_action('Buzzler_step1_before');

?>

	<form method="post" action="<?php echo Buzzler_post_new_with_pid_stuff_thg($pid, $new_listing_step);?>">  
    <ul class="post-new">
        <li>
        	<h2><?php echo __('Your listing title', 'Buzzler'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="listing_title" 
            value="<?php echo (empty($_POST['listing_title']) ? 
			($post->post_title == "Auto Draft" ? "" : $post->post_title) : $_POST['listing_title']); ?>" /> <?php do_action('Buzzler_step1_after_title_field');  ?></p>
        </li>
		
        
        <li><h2><?php echo __('Category', 'Buzzler'); ?>:</h2>
        	<p><?php	echo Buzzler_get_categories("listing_cat",  
			!isset($_POST['listing_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : $_POST['listing_cat_cat']
			, __("Select Category","Buzzler"), "do_input"); ?></p>
        </li>
        
        
        <li><h2><?php echo __('Location', 'Buzzler'); ?>:</h2>
        	<p><?php	echo Buzzler_get_categories("listing_location",  
			!isset($_POST['listing_location_cat']) ? (is_array($location) ? $location[0]->term_id : "") : $_POST['listing_location_cat']
			, __("Select Location","Buzzler"), "do_input"); ?></p>
        </li>
		
        <li>
        	<h2><?php echo __('Address/Zip','Buzzler'); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="street_address" value="<?php echo !isset($_POST['street_address']) ? 
		get_post_meta($pid, 'street_address', true) : $_POST['street_address']; ?>" /> 
        <?php do_action('Buzzler_step1_after_address_field');  ?>
        </p>
        </li>
        
        
        <li>
                                <h2><?php echo __('Youtube Video Link','Buzzler'); ?>:</h2>
                            <p><input type="text" size="50" name="youtube_link" class="do_input" 
                                value="<?php echo get_post_meta($pid, 'youtube_link', true); ?>" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Website','Buzzler'); ?>:</h2>
        <p><input type="text" size="40" class="do_input"  name="website_url" value="<?php echo !isset($_POST['website_url']) ? 
		get_post_meta($pid, 'website_url', true) : $_POST['website_url']; ?>" /> 
        <?php do_action('Buzzler_step1_after_address_field');  ?>
        </p>
        </li>
        
        
         <li>
        	<h2><?php echo __('Description', 'Buzzler'); ?>:</h2>
        <p><textarea rows="6" cols="60" class="do_input"  name="listing_description"><?php 
		echo empty($_POST['listing_description']) ? trim($post->post_content) : $_POST['listing_description']; ?></textarea>
        <?php do_action('Buzzler_step1_after_description_field');  ?>
        </p>
        </li>
        
        
  
        <li>
        	<h2><?php echo __('Tags', 'Buzzler'); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="listing_tags" value="<?php echo $listing_tags; ?>" /> 
        <?php do_action('Buzzler_step1_after_tags_field');  ?> </p>
        </li>
        
        
        <li>
        <h2>&nbsp;</h2>
        <p> <input type="submit" name="buzzler_submit_1" value="<?php _e("Next Step", 'Buzzler'); ?> >>" /></p>
        </li>
        
	</ul>
    </form>


<?php        
        
        
}

if($new_listing_step == "2")
{

	

?>

<script>

function delete_this(id)
	{
		 $.ajax({
						method: 'get',
						url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_ad_delete_pid='+id,
						dataType : 'text',
						success: function (text) {   $('#image_ss'+id).remove();  window.location.reload();  }
					 });
		  //alert("a");
	
	}


</script>

	<form method="post" enctype="multipart/form-data" action="<?php echo Buzzler_post_new_with_pid_stuff_thg($pid, $new_listing_step);?>">  
    <ul class="post-new">


 <li>
                            <h2><?php echo __('Images', 'Buzzler'); ?>:</h2>
                            <p>
          <?php
		  
		  		$args = array(
				'order'          => 'ASC',
				'orderby'        => 'post_date',
				'post_type'      => 'attachment',
				'post_parent'    => $pid,
				'post_mime_type' => 'image',
				'numberposts'    => -1,
				); $i = 0;
				
				$attachments = get_posts($args);
				
				$default_nr = get_option('PricerrTheme_default_nr_of_pics');
		  		if(empty($default_nr)) $default_nr = 5;
				
				if($pid == 0) $actual_nr = 0;
				
				$actual_nr = count($attachments);
				$dis = $default_nr - $actual_nr;
		  
		  		for($i=1;$i<=$dis;$i++):
				?>                   
        		
                	<input type="file" class="do_input_a" name="file_<?php echo $i; ?>" />
				
				<?php	endfor; ?>
       
                          </p>
                            </li>
                           
                           <li>
                           
                            <div id="thumbnails" style="overflow:hidden;">
    
    <?php

	

	if($pid > 0)
	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = wp_get_attachment_url($attachment->ID);
		
			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
			Buzzler_generate_thumb($url, 70, 70). '" />
			<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
			</div>';
	  
	}
	}


	?>
    
    </div>
                           
                           </li>
                           
             
             <li>
                                <h2><?php echo __('Digital Files', 'Buzzler'); ?>:</h2>
                            <p>
                             <?php
		  
										$args = array(
										'order'          => 'ASC',
										'orderby'        => 'post_date',
										'post_type'      => 'attachment',
										'post_parent'    => $pid,
										'post_mime_type' => 'application/zip',
										'numberposts'    => -1,
										); $i = 0;
										
										$attachments = get_posts($args);
                            			
										if(count($attachments) == 0):
							
							?>
                            
                            <input type="file" class="do_input_a" name="file_instant" />
                            
                            <?php else: 
							
								
									if ($attachments) {
											foreach ($attachments as $attachment) {
											$url = wp_get_attachment_url($attachment->ID);
											
												echo '<p class="div_div2"  id="image_ss'.$attachment->ID.'">'.$attachment->post_title.'
												<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
												</p>';
										  
										}
										} 
								
							
							 endif; ?>
                            
                             </p>
                            </li>
             
                           
                           
                           <?php
		
		//============= custom fields =================================================
						   
		$cat 		  	= wp_get_object_terms($pid, 'listing_cat');
		$catidarr 		= array();
		
		foreach($cat as $catids)
		{
			$catidarr[] = $catids->term_id;
		}
	
		$arr 	= get_listing_category_fields($catidarr, $pid);
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<li>';
					echo '<h2>'.$arr[$i]['field_name'].$arr[$i]['id'].':</h2>';
					echo '<p>'.$arr[$i]['value'];
					do_action('Buzzler_step3_after_custom_field_'.$arr[$i]['id'].'_field');
					echo '</p>';
					echo '</li>';
			
			
		}	
						   
						   ?>
                           
                           
                                <li>
        <h2>&nbsp;</h2>
        <p> <?php
        
		echo '<a class="goback-link" href="'.Buzzler_post_new_with_pid_stuff_thg($pid, ($new_listing_step-1)).'">'.__('Go Back','Buzzler').'</a>';
		
		?> <input type="submit" name="buzzler_submit_2" value="<?php _e("Next Step", 'Buzzler'); ?> >>" /></p>
        </li>
        
	</ul>
    </form>


<?php } 

if($new_listing_step == "3")
{
	
	$post_e = get_post($pid);
	

	if(isset($_GET['plan']))
	{
		$planid 	= $_GET['plan'];
		$my_plan 	= get_post($_GET['plan']);	
		$prc 		= get_post_meta($planid,'price',true);
		$days 		= get_post_meta($planid,'days',true);
		
		$featured_homepage 	= get_post_meta($planid,'featured_homepage',true);
		$featured_search 	= get_post_meta($planid,'featured_search',true);
		
		if($featured_homepage == "yes" or $featured_search == "yes")
		{
			update_post_meta($pid,'featured',"1");	
		}
		
		if($_GET['ok'] == "ok"):
		
		
			global $current_user;
			get_currentuserinfo();
			
			echo '<div class="lid_end">';

			
			$admin_must_approve2 = trim(get_option('Buzzler_admin_approve_listing'));
 
			
			//--------------------------------------------
			 
				if($admin_must_approve2 == "yes")
				{
					$my_post1 = array();
					$my_post1['ID'] = $pid;
					$my_post1['post_status'] = 'draft';
					
					wp_update_post( $my_post1 );
					
					Buzzler_send_email_posted_item_not_approved($pid);
					Buzzler_send_email_posted_item_approved_admin($pid);
					
					$lnk_ = get_permalink(get_option('Buzzler_my_account_page_id'));
					
					echo '<br/>'.sprintf(__("Your listing isn't yet live, the admin needs to approve it. <a href='%s'>Go to your account</a>.", "Buzzler"), $lnk_);
					 
	
				
				}
				else
				{
					$my_post1 = array();
					$my_post1['ID'] = $pid;
					$my_post1['post_status'] = 'publish';
	
					wp_update_post( $my_post1 );
					
					Buzzler_send_email_posted_item_approved($pid);
					Buzzler_send_email_posted_item_not_approved_admin($pid);
 					
					echo __('Thank you for posting your item with us.','Buzzler');
					update_post_meta($pid, "paid", "1");
					
					echo ' <a href="'.get_permalink($pid).'" class="pay_now">'.__('See your listing','Buzzler') .'</a> ';
 
		 	
				}
				
			 
			echo '</div>';
		
		
		else:		
		?>
        
        <ul class="plan_ul">
        	<li>
            	<h2><?php _e('Plan Name:','Buzzler'); ?></h2>
                <p><?php echo $my_plan->post_title; ?></p>
            </li>
            
            <li>
            	<h2><?php _e('Plan Costs:','Buzzler'); ?></h2>
                <p><?php echo ($prc == 0 ? __('FREE','Buzzler') : buzzler_get_show_price(get_post_meta($planid,'price',true), 2)); ?></p>
            </li>
            
            <li>
            	<h2><?php _e('Valid For:','Buzzler'); ?></h2>
                <p><?php echo sprintf(__('%s days','Buzzler'), $days); ?></p>
            </li> 
        	
            <li><p class="pmnts_btns">
            <?php
			
				if($prc == 0)
				{
						
						echo '<a href="'.Buzzler_post_new_with_pid_stuff_thg2($pid, $new_listing_step, $planid,'ok').'" class="post_bid_btn">'.__('Get it now','Buzzler').'</a>';		
				}
				else
				{
			
						$Buzzler_paypal_enable 			= get_option('Buzzler_paypal_enable');
						$Buzzler_alertpay_enable 		= get_option('Buzzler_alertpay_enable');
						$Buzzler_moneybookers_enable 	= get_option('Buzzler_moneybookers_enable');
						
						
						if($Buzzler_paypal_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?b_action=paypal_listing&pid='.$pid.'&plan='.$planid.'" class="post_bid_btn">'.__('Pay by PayPal','Buzzler').'</a>';
						
						if($Buzzler_moneybookers_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?b_action=mb_listing&pid='.$pid.'&plan='.$planid.'" class="post_bid_btn">'.__('Pay by MoneyBookers/Skrill','Buzzler').'</a>';
						
						if($Buzzler_alertpay_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?b_action=payza_listing&pid='.$pid.'&plan='.$planid.'" class="post_bid_btn">'.__('Pay by Payza','Buzzler').'</a>';
						
						$Buzzler_offline_payments = get_option('Buzzler_offline_payments');
						if($Buzzler_offline_payments == "yes")
						{
							$opt = get_option('Buzzler_offline_payment_dets');
							echo sprintf(__('Bank Details: %s','Buzzler'), $opt);	
							
						}
						
						do_action('Buzzler_add_payment_options_to_post_new_project', $pid);
			
				}
			
			?></p>
            </li>
            
            
        </ul>
        <?php endif; ?>
        
        <?php
		
	}
	else
	{
	
		echo '<div class="lid_end">';
		echo __('Choose your payment plan from the ones available.','Buzzler');
		echo '</div>';
	
	
	//----------------------------------------------------

					$the_query = new WP_Query( "meta_key=order&post_type=payment-plan&order=asc&orderby=meta_value_num&posts_per_page=-1" );
					
			 
					if($the_query->have_posts() ) :
					while ( $the_query->have_posts()  ) : $the_query->the_post();
					
						$price_v 	= get_post_meta(get_the_ID(),'price',true);
						$price 		= $price_v;
						$price 		= buzzler_get_show_price($price, 2);
						$days 		= get_post_meta(get_the_ID(),'days',true);
					
					?>
					
                    <div class="the_plan_me">
                    	<div class="padd10">
                    		
                            <table>
                            <tr>
                            <td class="plan_tlls"><div class="plan_ttl"><?php the_title(); ?></div>
                            <div class="plan_cnt"><?php the_content(); ?></div>
                            </td>
                            
                            <td class="plan_prices_td"><div class="plan_ttl2"><?php 
							
							if($price_v == 0) $price = __('FREE','Buzzler');
							echo sprintf(__('%s for %s days','Buzzler'), $price, $days); ?></div></td>
                            
                            <td class="plan_button_td"><div class="plan_ttl2">
                            <?php
								
								if($price_v == 0)
								{
							?>
                            	
                                <a href="<?php echo Buzzler_post_new_with_pid_stuff_thg2($pid, $new_listing_step, get_the_ID()); ?>" class="button_pay"><?php _e('Get Now','Buzzler'); ?></a>
                            
                            <?php		
								}
								else
								{
							
							?>
                            <a href="<?php echo Buzzler_post_new_with_pid_stuff_thg2($pid, $new_listing_step, get_the_ID()); ?>" class="button_pay"><?php _e('Pay Now','Buzzler'); ?></a>
                            
                            <?php } ?>
                            </div></td>
                            
                            </tr>
                            </table>
                            
                    	</div>
                    </div>
					
                    
                    <?php
					endwhile; else:
					
					_e("There are no payment plans defined. Please ask admin to add payment plans.",'Buzzler');
					
					endif;
					
					wp_reset_query();
					
	//--------------------------------------------------
	
	}
	
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
 
	
	if(isset($_GET['plan']))
	{
		if(empty($_GET['ok']))
		echo '<a href="'. Buzzler_post_new_with_pid_stuff_thg($pid, '3') .'" class="go_back_btn" >'.__('Go Back','Buzzler').'</a>';
	
	}
	else
	echo '<a href="'. Buzzler_post_new_with_pid_stuff_thg($pid, '2') .'" class="go_back_btn" >'.__('Go Back','Buzzler').'</a>';
	

 
?>

	<div class="my-separator-post-new"></div>



<div class="review_left_big_div">
<div class="my_box3">
            
            	<div class="box_title"><h1><?php  echo $post_e->post_title; ?></h1></div>
                <div class="box_content post-content"> 
                
                				
                                <div class="listing-page-details-holder">
                                
                                	<div class="listing-page-ratings">
										
                                        <ul class="listing-main_details">
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Listing Rating:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo buzzler_get_rating_for_post($pid); ?></div>
                                                <div class="floatleft"> <?php $rtg = buzzler_get_total_ratings_post($pid); printf(__('%s reviews','Buzzler'), $rtg); ?></div>
                                            </li>
                                            
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Posted In:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo get_the_term_list( $pid, 'listing_cat', '', ', ', '' ); ?></div>
                                            </li>
                                            
                                            
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Located In:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo get_the_term_list( $pid, 'listing_location', '', ', ', '' ); ?></div>
                                            </li>
                                            
                                            
                                             <li>
                                                <div class="floatleft ttl_main"><?php _e('Street Address:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo get_post_meta($pid, 'street_address', true); ?></div>
                                            </li>
                                            
                                            
                                            <li>
                                                <div class="floatleft ttl_main"><?php _e('Website:','Buzzler'); ?></div>
                                                <div class="floatleft"> <?php echo buzzler_get_website_url($pid); ?></div>
                                            </li>
                                  
                                      	</ul>
                                        
                                        <ul class="listing-extra_details">
                                        	
																	<?php
                                        $arrms = get_listing_fields_values($pid);
                                        
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
                                        
                                        
                                </div>
                                
                                </div>
                                
                                
                                
                                
                                <div class="listing-page-image-holder">
                                <img class="img_class" src="<?php echo buzzler_get_first_post_image($pid, 250, 170); ?>" alt="<?php the_title(); ?>" />
                                
                                        <?php
                                
                                $arr = buzzler_get_post_images($pid, 4);
                
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
                	<?php echo $post_e->post_content; ?>
                </div>
        </div>
        
        
         </div>
         
         
           <div id="right-sidebar" class="right-sidebar-listing-page">
    <ul class="xoxo">
    <li class="listing-page-map-holder">
    		<div class="show_big_map"><a href="<?php echo buzzler_show_big_map_lnk($pid); ?>"><?php _e('Show Full Map','Buzzler'); ?></a></div>	
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
		
			$arr = buzzler_get_post_images($pid, 999);
                
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
    
       
    </ul>
</div>





<?php } endif; ?>
        </div>
        </div>
        </div>
    
    <?php
	
}

?>