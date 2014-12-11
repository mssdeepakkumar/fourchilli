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

	$pid = $_GET['ad_id'];
	global $error, $current_user;
	get_currentuserinfo();
	
	
	if(isset($_POST['ad_submit_2']))
	{
		
		//---------------------------------------
		// pictures
		
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		
		$default_nr = get_option('ClassifiedTheme_nr_max_of_images');
		if(empty($default_nr)) $default_nr = 5;
			
		for($j=1;$j<=	$default_nr; $j++)
		{ 
			if(!empty($_FILES['file_' . $j]['name'])):
	  
	  			$upload_overrides 	= array( 'test_form' => false );
                $uploaded_file 		= wp_handle_upload($_FILES['file_' . $j], $upload_overrides);
				
				$file_name_and_location = $uploaded_file['file'];
                $file_title_for_media_library = $_FILES['file_' . $j]['name'];
						
				$arr_file_type 		= wp_check_filetype(basename($_FILES['file_' . $j]['name']));
                $uploaded_file_type = $arr_file_type['type'];

				if($uploaded_file_type == "image/png" or $uploaded_file_type == "image/jpg" or $uploaded_file_type == "image/jpeg" or $uploaded_file_type == "image/gif" )
				{
				
					$attachment = array(
									'post_mime_type' => $uploaded_file_type,
									'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),
									'post_content' => '',
									'post_status' => 'inherit',
									'post_parent' =>  $pid,
	
									'post_author' => $current_user->ID,
								);
							 
					$attach_id = wp_insert_attachment( $attachment, $file_name_and_location, $pid );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
					wp_update_attachment_metadata($attach_id,  $attach_data);
				
				}
				
			endif;
		}
		
		//------------	
		
		$arr = $_POST['custom_field_id'];
		for($i=0;$i<count($arr);$i++)
		{
			$ids 	= $arr[$i];
			$value 	= $_POST['custom_field_value_'.$ids];
			
			if(is_array($value))
			{
				delete_post_meta($pid, "custom_field_ID_".$ids);
				
				for($j=0;$j<count($value);$j++) {
					add_post_meta($pid, "custom_field_ID_".$ids, $value[$j]);
					
				}
			}
			else
			update_post_meta($pid, "custom_field_ID_".$ids, $value);
			
		}	
			
		//-------------	
			
		wp_redirect(ClassifiedTheme_post_new_with_pid_stuff_thg($pid, 3));
		exit;
	}
	
	if(isset($_POST['ad_submit_1']))
	{
		$adOK 				= 1;
		$ad_title 			= trim(strip_tags($_POST['ad_title']));
		$ad_description 	= nl2br(strip_tags($_POST['ad_description']));
		$ad_tags 			= trim(strip_tags($_POST['ad_tags']));

		$price 				= classifiedTheme_clear_sums_of_cash(trim($_POST['price']));
		$ad_location_addr 	= strip_tags(trim($_POST['ad_location_addr']));
		
		$ad_category 		= $_POST['ad_cat_cat'];
		$ad_location 		= $_POST['ad_location_cat'];
		
	
		//-----------------------------------------------------------------------------
		
			do_action('ClassifiedTheme_step_1_submit');
		
		//-----------------------------------------------------------------------------
		
		$ad_title 			= apply_filters('ClassifiedTheme_filter_ad_title', 			$ad_title, $pid); 
		$ad_description 	= apply_filters('ClassifiedTheme_filter_ad_description', 	$ad_description, $pid); 
		$ad_tags 			= apply_filters('ClassifiedTheme_filter_ad_tags', 			$ad_tags, $pid); 
		$price 				= apply_filters('ClassifiedTheme_filter_ad_price', 			$price, $pid); 
		$ad_location_addr	= apply_filters('ClassifiedTheme_filter_ad_address', 		$ad_location_addr, $pid); 
		
		
		//-----------------------------------------------------------------------------
		
		$term = get_term( $ad_category, 'ad_cat' );	
		$ad_category = $term->slug;
				
		$term = get_term( $ad_location, 'ad_location' );	
		$ad_location = $term->slug;
		
		
		wp_set_object_terms($pid, array($ad_category),'ad_cat');
		wp_set_object_terms($pid, array($ad_location),'ad_location');		
		

		if(empty($ad_title)) 		{ $adOK = 0; $error['title'] 			= __('You cannot leave the listing title blank!','ClassifiedTheme'); }
		if(empty($ad_description)) { $adOK = 0; $error['description'] 	= __('You cannot leave the listing description blank!','ClassifiedTheme'); }
		
		if(empty($ad_category)) 		{ $adOK = 0; $error['category'] 		= __('You cannot leave the listing category blank!','ClassifiedTheme'); }
		
		$ClassifiedTheme_enable_locations = get_option('ClassifiedTheme_enable_locations');
		if($ClassifiedTheme_enable_locations != 'no')	
		if(empty($ad_location)) 		{ $adOK = 0; $error['location'] 		= __('You cannot leave the listing location blank!','ClassifiedTheme'); }
		if(empty($price)) 		{ $adOK = 0; $error['price'] 		= __('You cannot leave the listing price blank!','ClassifiedTheme'); }
		
		


		
		//----------------------------
		
		if(isset($_POST['featured']))
		{ 
			update_post_meta($pid, "featured", "1");
			$end = get_option('adTheme_ad_period_featured');
		}
		else update_post_meta($pid, "featured", "0");
		
		update_post_meta($pid, "closed", "0");
		update_post_meta($pid, "closed_date", "0");

		$my_post = array();
		$my_post['post_title'] 		= substr($ad_title,0,150);
		$my_post['ID'] 				= $pid;
		$my_post['post_content'] 	= $ad_description;	
		$my_post['post_status'] 	= 'draft';	
		wp_update_post( $my_post );
		
		
			
		//----------------------------------------------------------------
			// set categories
		
		//----------------------------------------------------------------
			

			wp_set_post_tags($pid, $ad_tags);
			  
			update_post_meta($pid, "Location", $ad_location_addr);
			update_post_meta($pid, "price", $price);
			  
			update_post_meta($pid, "paid", "0");
		  	update_post_meta($pid, "views", 		'0');

			$end 	= $_POST['ending']; 
			$nowtm 	= current_time('timestamp',0);
			
			//----- setting ending period ------------
			
			$ending = strtotime($end, $nowtm);
			
			$ClassifiedTheme_listing_featured_time_listing = get_option('ClassifiedTheme_listing_featured_time_listing');
			if(empty($ClassifiedTheme_listing_featured_time_listing)) $ClassifiedTheme_listing_featured_time_listing = 30;
			
			$ClassifiedTheme_listing_time_listing = get_option('ClassifiedTheme_listing_time_listing');
			if(empty($ClassifiedTheme_listing_time_listing)) $ClassifiedTheme_listing_time_listing = 30;
			
			$is_ad_featured = get_post_meta($pid, 'featured', true);
			if($is_ad_featured == "1") $time_ending = $nowtm + $ClassifiedTheme_listing_featured_time_listing *3600*24;
			else $time_ending = $nowtm + $ClassifiedTheme_listing_time_listing *3600*24;
			
			if(!empty($end)) 
			{
				$ending = strtotime($end, $nowtm);
				if($ending > $time_ending) $ending = $time_ending;
				
			} else $ending = $time_ending;
			
			//----------------------------------------
			
			update_post_meta($pid, "closed", 		"0");
			update_post_meta($pid, "closed_date", 	"0");
			update_post_meta($pid, "ending", 		$ending);
			 

			  //------------------------------------------------------
			 /* $zip = get_post_meta($pid, "Location", true);
			  
			  $loc 		= wp_get_post_terms( $pid, 'ad_location');
			  $loc_a 	= '';
			 
			  foreach($loc as $l)
			 	$loc_a .= $l->name.',' ;
				
			  $loc_a .= $zip;
			  
			  $data = ClassifiedTheme_get_geo_coordinates($loc_a);
			  $long = $data[3];
			  $lat 	= $data[2];			  
			  
			  update_post_meta($pid, 'ad_lat', 	$lat);
			  update_post_meta($pid, 'ad_long', 	$long); */
			  
			 // print_r($data);
			  //exit;
			  //------------------------------------------------------
		
		if($adOK == 1) //if everything ok, go to next step
		{		
			wp_redirect(ClassifiedTheme_post_new_with_pid_stuff_thg($pid, 2));
			exit;	
		}
		
	}


?>