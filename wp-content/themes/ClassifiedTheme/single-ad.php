<?php
/********************************************************************************
*
*	ClassifiedTheme - copyright (c) - sitemile.com - Details
*	if you want to remove actions from the sitemile framework use the hook
*	sitemile_pre_load to add your functions which contains the remove_filters
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v6.2.1
*
*********************************************************************************/
	
	function classifiedTheme_colorbox_stuff()
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
				
				$("#report-this-link").click( function() {
					
					if($("#report-this").css('display') == 'none')					
					$("#report-this").show('slow');
					else
					$("#report-this").hide('slow');
					
					return false;
				});
				
				
				$("#contact_seller-link").click( function() {
					
					if($("#contact-seller").css('display') == 'none')					
					$("#contact-seller").show('slow');
					else
					$("#contact-seller").hide('slow');
					
					return false;
				});
				
		});
		</script>
		
		<?php
	}
	
	add_action('wp_head','classifiedTheme_colorbox_stuff');	
	
	add_filter('body_class','ClassifiedTheme_my_class_names');
	function ClassifiedTheme_my_class_names($classes) {

		$classes2 = array();
		foreach($classes as $cname)
		{
			if($cname != 'single-ad')
			$classes2[] = $cname;	
		}

		return $classes2;
	}
	
	
	get_header();
?>

<?php 

			if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3"><div class="padd10">';	
		    bcn_display();
			echo '</div></div><div class="clear10"></div>';
		}

?>


<div id="content">

	
	
	
	
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php

	$location = get_post_meta(get_the_ID(), "Location", true);
	$ending   = get_post_meta(get_the_ID(), "ending", true);
	
	$views   = get_post_meta(get_the_ID(), "views", true);
	$views = $views + 1;
	
	update_post_meta(get_the_ID(), "views", $views);

?>	


<?php

	if(isset($_POST['report_this']))
	{
		
		if(isset($_SESSION['reported-soon']))
		{
			$rp = $_SESSION['reported-soon'];
			if($rp < time()) { $_SESSION['reported-soon'] = time() + 60; $rep_ok = 1; }
			else { $rep_ok = 0; }
		}
		else
		{
			$_SESSION['reported-soon'] = time() + 60; $rep_ok = 1;	
		}
		
		if($rep_ok == 1)
		{
		
		$pid_rep = $_POST['pid_rep'];
		$reason_report = nl2br($_POST['reason_report']);
		
		//---- send email to admin
		$subject = __("Report offensive ad", "ClassifiedTheme")." : ".get_the_title();
		
		$message = __("This ad has been reported as offensive", "ClassifiedTheme");
		$message .= " : <a href='".get_permalink(get_the_ID())."'>".get_the_title()."</a>"; 
		$message .= " <br/>Message: ".strip_tags($_POST['reason_report']); 
		
		global $post;
		$usr = get_userdata($post->post_author);
		$recipients = $usr->user_email; //get_bloginfo('admin_email');
		
		ClassifiedTheme_send_email($recipients, $subject, $message);
		
		//------------------------
		?>
        <div class="my_box3">
            <div class="padd10">
        		<div class="box_content">
                
                	<?php _e('Thank you! Your report has been submitted.', "ClassifiedTheme"); ?>
                
       			</div>
        	</div>
        </div>
        
        <div class="clear10"></div>
		
		<?php
		}
		else
		{
		?>	
		
        
        <div class="my_box3">
            <div class="padd10">
        		<div class="box_content" style="color:red;"><b>
                
                	<?php _e('Slow down buddy! You reported this before.', "ClassifiedTheme"); ?>
                </b>
       			</div>
        	</div>
        </div>
        
        <div class="clear10"></div>	
			
		<?php	
		}
	}

?>

<div id="report-this" style="display:none">
<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo __("Report this ad", "ClassifiedTheme"); ?></div>
                <div class="box_content">
					<form method="post"><input type="hidden" value="<?php the_ID(); ?>" name="pid_rep" />
                    <ul class="post-new3">

        
        <li>
        	<h2><?php echo __('Reason for reporting', "ClassifiedTheme"); ?>:</h2>
        <p><textarea rows="4" cols="40" class="do_input"  name="reason_report"></textarea></p>
        </li>
        
        
     
        
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="report_this" value="<?php _e('Submit Report', "ClassifiedTheme"); ?>" /></p>
        </li>
    
    
    </ul>
    </form>
                    
                    
				</div>
			</div>
			</div>
            
            <div class="clear10"></div>

</div>


<!-- ######### -->

<?php

	if(isset($_POST['contact_seller']))
	{
		
		if(isset($_SESSION['contact_soon']))
		{
			$rp = $_SESSION['contact_soon'];
			if($rp < time()) { $_SESSION['contact_soon'] = time() + 60; $rep_ok = 1; }
			else { $rep_ok = 0; }
		}
		else
		{
			$_SESSION['contact_soon'] = time() + 60; $rep_ok = 1;	
		}
		
		if($rep_ok == 1)
		{
		
		$subject = $_POST['subject'];
		$email = $_POST['email'];
		$message = nl2br($_POST['message']);
		
		//---- send email to admin

		
		$p = get_post(get_the_ID());
		$a = $p->post_author;
		$a = get_userdata($a);
		
		ClassifiedTheme_send_email($a->user_email, $subject, $message."<br/>".__("From Email:" ,'ClassifiedTheme')." ".$email);
		
		//------------------------
		?>
        <div class="my_box3">
            <div class="padd10">
        		<div class="box_content">
                
                	<?php _e('Thank you! Your message has been sent.', "ClassifiedTheme"); ?>
                
       			</div>
        	</div>
        </div>
        
        <div class="clear10"></div>
		
		<?php
		}
		else
		{
		?>	
			
            <div class="my_box3">
            <div class="padd10">
        		<div class="box_content">
                
                	<?php _e('Slow down buddy!.', "ClassifiedTheme"); ?>
                
       			</div>
        	</div>
        </div>
        
        <div class="clear10"></div>
			
            
           <?php
		}
	}

?>

<div id="contact-seller" style="display:none">
<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo __("Contact", "ClassifiedTheme"); ?></div>
                <div class="box_content">
					<form method="post"><input type="hidden" value="<?php the_ID(); ?>" name="pid_rep" />
                    <ul class="post-new3">

         <li>
        	<h2><?php echo __('Subject', "ClassifiedTheme"); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="subject" /></p>
        </li>
        
         <li>
        	<h2><?php echo __('Your Email', "ClassifiedTheme"); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="email" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Message', "ClassifiedTheme"); ?>:</h2>
        <p><textarea rows="4" cols="40" class="do_input"  name="message"></textarea></p>
        </li>
        
        
     
        
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="contact_seller" value="<?php _e('Send Message', "ClassifiedTheme"); ?>" /></p>
        </li>
    
    
    </ul>
    </form>
                    
                    
				</div>
			</div>
			</div>
            
            <div class="clear10"></div>

</div>





 			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title ad_page_title"><?php the_title() ?></div>
                <div class="box_content">
				
					<div class="ad-page-image-holder">
						<img class="img_class" id="main_ad_images" src="<?php echo ClassifiedTheme_get_first_post_image(get_the_ID(), 308, 210); ?>" alt="<?php the_title(); ?>" />
						
						<?php
				
				$arr = ClassifiedTheme_get_post_images(get_the_ID(), 5);
				
				if($arr)
				{
					
				
				echo '<ul class="image-gallery" style="padding-top:10px">';
				foreach($arr as $image)
				{
					echo '<li><a href="'.ClassifiedTheme_generate_thumb($image, -1,600).'" rel="image_gal1"><img 
					src="'.ClassifiedTheme_generate_thumb($image, 50,50).'" class="img_class" /></a></li>';
				}
				echo '</ul>';
				
				
				}
				//else { echo __('No images.', "ClassifiedTheme") ;}
				
				?>
						
					</div>
				
				<div class="ad-page-details-holder">
						<ul class="ad_details">
                        
                        	<?php do_action('ClassifiedTheme_ad_single_page_before_unique_id'); ?>
                        
                        	<li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" width="20" height="20" /> 
								<h3><?php echo __("Unique ID", "ClassifiedTheme"); ?>:</h3>
								<p>#<?php echo (get_the_ID()); ?></p>
							</li>
                        
                        <?php
						
						$price = get_post_meta(get_the_ID(), 'price',true);
						if(!empty($price)):
						
						?>
                        	<?php do_action('ClassifiedTheme_ad_single_page_before_price'); ?>
							<li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/price.png" width="20" height="20" /> 
								<h3><?php echo __("Price", "ClassifiedTheme"); ?>:</h3>
								<p><?php echo classifiedTheme_get_price(get_the_ID()); ?></p>
							</li>
						
						<?php endif; ?>
                        	
                            <?php do_action('ClassifiedTheme_ad_single_page_before_location'); ?>
							<li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/location.png" width="20" height="20" /> 
								<h3><?php echo __("Location", "ClassifiedTheme"); ?>:</h3>
								<p><?php echo get_the_term_list( get_the_ID(), 'ad_location', '', ', ', '' ); ?></p>
							</li>
							<?php do_action('ClassifiedTheme_ad_single_page_before_posted_on'); ?>
							<li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/posted.png" width="20" height="20" /> 
								<h3><?php echo __("Posted on", "ClassifiedTheme"); ?>:</h3>
								<p><?php the_time("jS \o\\f F Y \a\\t g:i A"); ?></p>
							</li>
							
							<?php do_action('ClassifiedTheme_ad_single_page_before_expires'); ?>
							<li>
								<img src="<?php echo get_bloginfo('template_url'); ?>/images/clock.png" width="20" height="20" /> 
								<h3><?php echo __("Expires in", "ClassifiedTheme"); ?>:</h3>
								<p><?php echo ClassifiedTheme_prepare_seconds_to_words($ending - current_time('timestamp',0)); ?></p>
							</li>
							<?php do_action('ClassifiedTheme_ad_single_page_after_expires'); ?>
						</ul>
						
						
						<div class="add-this">
						<!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
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
			</div>
			</div>	
			
			<div class="clear10"></div>
			
			<!-- ####################### -->
			<?php do_action('ClassifiedTheme_ad_single_page_before_description'); ?>
			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo __("Description", "ClassifiedTheme"); ?></div>
                <div class="box_content item_content">
					 <?php the_content(); ?> 
				</div>
			</div>
			</div>
			
			<div class="clear10"></div>
			
			<!-- ####################### -->
			<?php do_action('ClassifiedTheme_ad_single_page_before_image_gallery'); ?>
			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo __("Image Gallery", "ClassifiedTheme"); ?></div>
                <div class="box_content">
				<?php
				
				$arr = ClassifiedTheme_get_post_images(get_the_ID());
				
				if($arr)
				{
					
				
				echo '<ul class="image-gallery">';
				foreach($arr as $image)
				{
					echo '<li><a href="'.ClassifiedTheme_generate_thumb($image, -1,600).'" rel="image_gal2"><img src="'.ClassifiedTheme_generate_thumb($image, 100,80).'" 
					class="img_class" /></a></li>';
				}
				echo '</ul>';
				
				}
				else { echo __('No images.', "ClassifiedTheme") ;}
				
				?>
				
				
				</div>
			</div>
			</div>
			
			<div class="clear10"></div>
			
			<!-- ####################### -->
			<?php do_action('ClassifiedTheme_ad_single_page_before_map'); ?>
			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo __("Map Location", "ClassifiedTheme"); ?></div>
                <div class="box_content">
	
				<div id="map" style="width: 655px; height: 300px;border:2px solid #ccc;float:left"></div>
				
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
    map = new google.maps.Map(document.getElementById("map"), myOptions);
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

	$terms = wp_get_post_terms($pid,'ad_location');
	foreach($terms as $term)
	{
		echo $term->name." ";
	}

	$location = get_post_meta($pid, "Location", true);	
	echo $location;
	
 ?>");

    </script> 
				
				</div>
			</div>
			</div>
			
			<!-- ####################### -->
	
         
       <?php  
	   
	   $opt_comm = get_option('classifiedTheme_enable_comments');
	   
	   if($opt_comm != 'no'):	   
	   		comments_template();
	   endif;
	   
	    ?>
            
<?php endwhile; // end of the loop. ?>



</div>

<?php

	echo '<div id="right-sidebar" class="page-sidebar">';
	echo '<ul class="xoxo">';
	
	?>
	
	<li class="widget-container widget_text" id="ad-other-details">
		<h3 class="widget-title"><?php _e("Other Details", "ClassifiedTheme"); ?></h3>
		<p>
			<ul class="other-dets">
				<li>
				<img src="<?php echo get_bloginfo('template_url'); ?>/images/posted.png" width="15" height="15" /> 	
					
					<h3><?php _e("Posted by", "ClassifiedTheme");?>:</h3>
					<p><a href="<?php echo get_bloginfo('siteurl');?>/?a_action=user_profile&uid=<?php echo $post->post_author; ?>"><?php the_author() ?></a></p> 
				</li> 
				
				<li>
					<img src="<?php echo get_bloginfo('template_url'); ?>/images/category.png" width="15" height="15" /> 
					<h3><?php _e("Category", "ClassifiedTheme");?>:</h3>
					<p><?php echo get_the_term_list( get_the_ID(), 'ad_cat', '', ', ', '' ); ?></p> 
				</li>
				
				<li>
					<img src="<?php echo get_bloginfo('template_url'); ?>/images/location.png" width="15" height="15" /> 
					<h3><?php _e("Address", "ClassifiedTheme");?>:</h3>
					<p><?php echo $location; ?></p> 
				</li>
				
				
                <?php
				
				$ClassifiedTheme_show_views = get_option('ClassifiedTheme_show_views');
				if($ClassifiedTheme_show_views != "no"):
				
				?>
                
				<li>
					<img src="<?php echo get_bloginfo('template_url'); ?>/images/viewed.png" width="15" height="15" /> 
					<h3><?php _e("Viewed", "ClassifiedTheme");?>:</h3>
					<p><?php echo $views; ?> <?php _e("times", "ClassifiedTheme");?></p> 
				</li>
				
                <?php endif; ?>
                
				<?php
				/*$arrms = get_ad_fields_values(get_the_ID());
				
				if(count($arrms) > 0) 
					for($i=0;$i<count($arrms);$i++)
					{
				
				?>
                <li>
					<h3><?php echo $arrms[$i]['field_name'];?>:</h3>
               	 	<p><?php echo $arrms[$i]['field_value'];?></p>
                </li>
				<?php } ?>
				
			
                
                */ ?>
				
                
                  <?php
				$arrms = get_listing_fields_values(get_the_ID());
				
				if(count($arrms) > 0) 
					for($i=0;$i<count($arrms);$i++)
					{
				
				?>
                <li>
                	<img src="<?php echo get_bloginfo('template_url'); ?>/images/arr1.png" width="15" height="15" />
					<h3><?php echo $arrms[$i]['field_name'];?>:</h3>
               	 	<p><?php 

		
					if(is_array($arrms[$i]['field_value'][0]))
					{
					
						foreach($arrms[$i]['field_value'][0] as $vl)
						{
					
							echo $vl	.'<br/>';
						}
					}
					else echo $arrms[$i]['field_value'][0];
					?></p>
                </li>
				<?php } ?>
                
                
			</ul>
			<?php
				
				if(ClassifiedTheme_is_owner_of_post())
				{
					
				?>
				
			<a href="<?php echo classifiedTheme_my_account_link(); ?>/?a_action=edit_ad&pid=<?php the_ID(); ?>" class="nice_link"><?php _e("Edit", "ClassifiedTheme"); ?></a> 
			<a href="<?php echo ClassifiedTheme_post_new_with_pid_stuff_thg(get_the_ID(), 3); ?>" class="nice_link"><?php _e("Publish", "ClassifiedTheme"); ?></a> 
			<a href="<?php echo classifiedTheme_my_account_link(); ?>/?a_action=delete_ad&pid=<?php the_ID(); ?>" class="nice_link"><?php _e("Delete", "ClassifiedTheme"); ?></a>
			
			<?php } else {?>
			
			<a href="#" id="report-this-link" class="nice_link"><?php _e("Report", "ClassifiedTheme"); ?></a>
            <a href="#" id="contact_seller-link" class="nice_link"><?php _e("Contact", "ClassifiedTheme"); ?></a>
				
                <?php } ?>
		</p>
	</li>
	
	
	<?php
	
						dynamic_sidebar( 'listing-widget-area' );
	echo '</ul>';
	echo '</div>';


	//classified theme v 6
	get_footer();
?>