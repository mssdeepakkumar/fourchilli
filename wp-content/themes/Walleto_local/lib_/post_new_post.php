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

	$pid = $_GET['product_id'];
	global $error;
	

	if(isset($_POST['product_submit_1']))
	{
		$productOK 				= 1;
		$product_title 			= trim(strip_tags($_POST['product_title']));
		$product_description 	= nl2br(strip_tags($_POST['product_description']));
		$product_tags 			= trim(strip_tags($_POST['product_tags']));
		
		$price 				= walleto_clear_sums_of_cash(trim($_POST['price']));
		$shipping 				= walleto_clear_sums_of_cash(trim($_POST['shipping']));
 
		$product_category 		= $_POST['product_cat_cat'];		
		$do_not_require_shipping = $_POST['do_not_require_shipping'];
		
		if(!empty($do_not_require_shipping)) update_post_meta($pid, 'do_not_require_shipping', "1");
		else update_post_meta($pid, 'do_not_require_shipping', "0");
	
		//-----------------------------------------------------------------------------
		
			do_action('Walleto_step_1_submit');
		
		//-----------------------------------------------------------------------------
		
		$product_title 			= apply_filters('Walleto_filter_product_title', 			$product_title, $pid); 
		$product_description 	= apply_filters('Walleto_filter_product_description', 		$product_description, $pid); 
		$product_tags 			= apply_filters('Walleto_filter_product_tags', 				$product_tags, $pid); 
		$price 				= apply_filters('Walleto_filter_product_price_price', 	$price, $pid); 
		$shipping 				= apply_filters('Walleto_filter_product_shipping', 			$shipping, $pid); 

	
		
		//-----------------------------------------------------------------------------
		
		$term = get_term( $product_category, 'product_cat' );	
		$product_category = $term->slug;
		wp_set_object_terms($pid, array($product_category),'product_cat');

		
		//-----------------------------------------------------------------------------
		
		$quant = trim($_POST['quant']);
		if(empty($quant) || !is_numeric($quant) || $quant < 0) $quant = 1;
 
		
		//-------------------------------
		
	
		if(empty($product_title)) 			{ $productOK = 0; $error['title'] 			= __('You cannot leave the product title blank!','Walleto'); }
		if(empty($product_description)) 	{ $productOK = 0; $error['description'] 	= __('You cannot leave the product description blank!','Walleto'); }
		if(empty($product_category)) 		{ $productOK = 0; $error['category'] 		= __('You cannot leave the product category blank!','Walleto'); }
		if(empty($price)) 		{ $productOK = 0; $error['price'] 		= __('You cannot leave the product price blank!','Walleto'); }
		
		$other_details = $_POST['other_details'];
		update_post_meta($pid, "other_details", nl2br(strip_tags($other_details)));
		
		//----------------------------
		
		if(isset($_POST['featured']))
		{ 
			update_post_meta($pid, "featured", "1");
			$end = get_option('productTheme_ad_period_featured');
		}
		else update_post_meta($pid, "featured", "0");
		
 
		update_post_meta($pid, "closed", "0");
		update_post_meta($pid, "closed_date", "0");

		$my_post = array();
		$my_post['post_title'] 		= substr($product_title,0,80);
		$my_post['ID'] 				= $pid;
		$my_post['post_content'] 	= $product_description;	
		$my_post['post_status'] 	= 'draft';	
		wp_update_post( $my_post );
		
		
			
		//----------------------------------------------------------------
			// set categories

			
		wp_set_post_tags($pid, $product_tags);
		update_post_meta($pid, "quant", $quant);			  
		update_post_meta($pid, "shipping", 		empty($shipping) ? 0 : $shipping);			
		update_post_meta($pid, "price", 		$price); 
		
		//----------------------------------------
			
		update_post_meta($pid, "closed", 		"0");
		update_post_meta($pid, "closed_date", 	"0");
 
		//------------------------------------------------------

		
		if($productOK == 1) //if everything ok, go to next step
		{		
			wp_redirect(Walleto_post_new_with_pid_stuff_thg($pid, 2));
			exit;	
		}
		
	}
	
	
	/*********************************************/
	
	if(isset($_POST['product_submit_photos']))
	{
		
		$uploaders = walleto_get_uploaders_tp();
		
		//---------------------------------------
		// pictures
		
		if($uploaders  == "html"):
		
				require_once(ABSPATH . "wp-admin" . '/includes/file.php');
				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				
				$default_nr = get_option('Walleto_nr_max_of_images');
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
		
		endif;
		
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
	
		do_action('Walleto_step2_form_thing_post', $pid);
		
		wp_redirect(Walleto_post_new_with_pid_stuff_thg($pid, 3));
		exit;	
	}

?>