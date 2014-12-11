<?php

	$pid = $_GET['listing_id'];
	global $error;
	
	if(isset($_POST['buzzler_submit_1']))
	{
		$listingOK 				= 1;
		$listing_title 			= trim(strip_tags($_POST['listing_title']));
		$listing_description 	= nl2br(strip_tags($_POST['listing_description']));
		$listing_tags 			= trim(strip_tags($_POST['listing_tags']));
		
		$listing_category 			= $_POST['listing_cat_cat'];
		$listing_location			= $_POST['listing_location_cat'];
		$website_url 				= trim($_POST['website_url']);
		$street_address 			= trim($_POST['street_address']);
		
		//-----------------------------------------------------------------------------
		
			do_action('Buzzler_step_1_submit');
		
		//-----------------------------------------------------------------------------
		
		
		
		$y_link = htmlspecialchars($_POST['youtube_link']);
		
		if(!empty($y_link))
		{
			update_post_meta($pid, "youtube_link", trim($y_link));
			update_post_meta($pid, "has_video", "1");
		}
		
		//-----------------------------------------------------------------------------
		
		$listing_title 			= apply_filters('Buzzler_filter_listing_title', 					$listing_title, $pid); 
		$listing_description 	= apply_filters('Buzzler_filter_listing_description', 				$listing_description, $pid); 
		$listing_tags 			= apply_filters('Buzzler_filter_listing_tags', 						$listing_tags, $pid); 
		$website_url 			= apply_filters('Buzzler_filter_website_url', 						$website_url, $pid); 
		$street_address 			= apply_filters('Buzzler_filter_street_address', 				$street_address, $pid); 
		
		//-----------------------------------------------------------------------------
		
		$term 			= get_term( $listing_category, 'listing_cat' );	
		$listing_cat 	= $term->slug;
		wp_set_object_terms($pid, 	array($listing_cat),	'listing_cat');
		
		
		$term 			= get_term( $listing_location, 'listing_location' );	
		$listing_location 	= $term->slug;
		wp_set_object_terms($pid, 	array($listing_location),	'listing_location');
		
		//-----------------
		
		if(empty($listing_title)) 			{ $listingOK = 0; $error['title'] 			= __('You cannot leave the listing title blank!','Buzzler'); }
		if(empty($listing_description)) 	{ $listingOK = 0; $error['description'] 	= __('You cannot leave the listing description blank!','Buzzler'); }		
		if(empty($listing_category)) 		{ $listingOK = 0; $error['category'] 		= __('You cannot leave the listing category blank!','Buzzler'); }
		if(empty($listing_location)) 		{ $listingOK = 0; $error['location'] 		= __('You cannot leave the listing location blank!','Buzzler'); }
		if(empty($street_address)) 			{ $listingOK = 0; $error['address'] 		= __('You cannot leave the listing address/zip blank!','Buzzler'); }
		
		//-----------------
		
		$Buzzler_listing_normal_time_listing = get_option('Buzzler_listing_normal_time_listing');
		if(empty($Buzzler_listing_normal_time_listing)) $Buzzler_listing_normal_time_listing = 30;
		
		$Buzzler_listing_featured_time_listing = get_option('Buzzler_listing_featured_time_listing');
		if(empty($Buzzler_listing_featured_time_listing)) $Buzzler_listing_featured_time_listing = 30;
		
		
		
		if(isset($_POST['featured']))
		{ 
			update_post_meta($pid, "featured", "1");
			$end = $Buzzler_listing_featured_time_listing;
		}
		else 
		{	
			update_post_meta($pid, "featured", "0");
			$end = $Buzzler_listing_normal_time_listing;
		
		}
		
		$tm = current_time('timestamp',0);
		
		update_post_meta($pid, "ending", ($tm + 3600*24*$end));
		update_post_meta($pid, "closed", "0");
		update_post_meta($pid, "closed_date", "0");
		
		//-----------------
		
		$my_post = array();
		$my_post['post_title'] 		= substr($listing_title,0,170);
		$my_post['ID'] 				= $pid;
		$my_post['post_content'] 	= $listing_description;	
		$my_post['post_status'] 	= 'draft';	
		wp_update_post( $my_post );
		
		//----------------
		
		update_post_meta($pid, "street_address", $street_address);
		update_post_meta($pid, "website_url", $website_url);
		
		wp_set_post_tags($pid, $listing_tags);	
		
		//----------------
			  
			$loc 		= wp_get_post_terms( $pid, 'listing_location');
			$loc_a 	= '';
			 
			foreach($loc as $l)
			$loc_a .= $l->name.',' ;
				
			$loc_a .= $street_address;
			  
			$data = Buzzler_get_geo_coordinates($loc_a);
			$long = $data[3];
			$lat 	= $data[2];			  
			  
		 
			  
			update_post_meta($pid, 'list_lat', 	$lat);
			update_post_meta($pid, 'list_long', 	$long);
		
		//----------------
		
		if($listingOK == 1) //if everything ok, go to next step
		{		
			wp_redirect(Buzzler_post_new_with_pid_stuff_thg($pid, 2));
			exit;	
		}
		
	}
	
	
	
	/********************************************/
	
	
	if(isset($_POST['buzzler_submit_2']))
	{
		
		for($i=0;$i<count($_POST['custom_field_id']);$i++)
		{
			$id = $_POST['custom_field_id'][$i];
			$valval = $_POST['custom_field_value_'.$id];		
			
			if(is_array($valval))
					update_post_meta($pid, 'custom_field_ID_'.$id, $valval);
			else
				update_post_meta($pid, 'custom_field_ID_'.$id, strip_tags($valval));
		}
		
		
		//---------------------------------------
		// pictures
		
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		
		$default_nr = get_option('PricerrTheme_default_nr_of_pics');
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
	
									'post_author' => $cid,
								);
							 
					$attach_id = wp_insert_attachment( $attachment, $file_name_and_location, $pid );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
					wp_update_attachment_metadata($attach_id,  $attach_data);
				
				}
				
			endif;
		}
		
		//---------------------------------------
		
		if(!empty($_FILES['file_instant']['name'])):
	  
	  			$upload_overrides 	= array( 'test_form' => false );
                $uploaded_file 		= wp_handle_upload($_FILES['file_instant'], $upload_overrides);
				
				$file_name_and_location = $uploaded_file['file'];
                $file_title_for_media_library = $_FILES['file_instant']['name'];
						
				$arr_file_type 		= wp_check_filetype(basename($_FILES['file_instant']['name']));
                $uploaded_file_type = $arr_file_type['type'];
				
				if($uploaded_file_type == "application/pdf" or $uploaded_file_type == "application/zip" )
				{
				
					$attachment = array(
									'post_mime_type' => $uploaded_file_type,
									'post_title' => 'Uploaded file ' . addslashes($file_title_for_media_library),
									'post_content' => '',
									'post_status' => 'inherit',
									'post_parent' =>  $pid,
	
									'post_author' => $cid,
								);
							 
					$attach_id 		= wp_insert_attachment( $attachment, $file_name_and_location, $pid );
					$attach_data 	= wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
					wp_update_attachment_metadata($attach_id,  $attach_data);
					
			
					
				}

		endif;
		
		wp_redirect(Buzzler_post_new_with_pid_stuff_thg($pid, 3));
		
		//---------------------------------------	
		
	}
	
?>