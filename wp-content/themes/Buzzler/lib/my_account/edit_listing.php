<?php
/********************************************************************************
*
*	Buzzler - copyright (c) - sitemile.com - Details
*	http://sitemile.com/p/buzzler
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v1.0
*
*********************************************************************************/

	global $current_user, $wp_query;
	$pid 	=  $wp_query->query_vars['pid'];
	if(empty($pid)) $pid = $_GET['pid'];
	
	global $post_au;
	$post_au = get_post($pid);
	
	
	function Buzzler_filter_ttl($title){ global $post_au; return __("Edit Listing",'Buzzler')." - ".$post_au->post_title;}
	add_filter( 'wp_title', 'Buzzler_filter_ttl', 10, 3 );	
	
	if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }   
	   
	
	get_currentuserinfo();   

	$Buzzler_admin_approves_each_listing = get_option('Buzzler_admin_approve_listing');

	$uid 	= $current_user->ID;
	$title 	= $post_au->post_title;
	$cid 	= $current_user->ID;
	
	if($uid != $post_au->post_author) { echo 'Not your post. Sorry!'; exit; }
	
	//=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	
		
		global $wpdb,$wp_rewrite,$wp_query;
		$post_au = get_post($pid);
	
		if(isset($_POST['save-listing']))
		{
			$listing_title = trim($_POST['listing_title']);
			$listing_description = trim(nl2br(strip_tags($_POST['listing_description'])));
				
			  $features_not_paid = array();
			  $Buzzler_get_images_cost_extra = Buzzler_get_images_cost_extra($pid);
			  
			  if(!empty($_POST['street_address'])) 
			  update_post_meta($pid, "street_address", $_POST['street_address']);
			 
			 
			   if(!empty($_POST['website_url'])) 
			  update_post_meta($pid, "website_url", $_POST['website_url']);
			 	
				
				
			
			  $my_post = array();
			  $my_post['ID'] = $pid;
			  $my_post['post_content'] = $listing_description;
			  $my_post['post_title']   = $listing_title;
	
			  wp_update_post( $my_post );
				
				$term = get_term( $_POST['listing_cat_cat'], 'listing_cat' );	
				$listing_cat = $term->slug;
				
				$term = get_term( $_POST['listing_location_cat'], 'listing_location' );	
				$listing_location = $term->slug;
				
			wp_set_object_terms($pid, array($listing_cat),'listing_cat');
			wp_set_object_terms($pid, array($listing_location),'listing_location');
			
			
			//---------------------------
			
				for($i=0;$i<count($_POST['custom_field_id']);$i++)
				{
					$id = $_POST['custom_field_id'][$i];
					$valval = $_POST['custom_field_value_'.$id];		
					
					if(is_array($valval))
							update_post_meta($pid, 'custom_field_ID_'.$id, $valval);
					else
						update_post_meta($pid, 'custom_field_ID_'.$id, strip_tags($valval));
				}
				
				
			//---------------------	
			 
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		
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
			
			
			//---------------------
			
			
			$not_OK_to_just_publish = 2;
			
			//-----------------------------------
			// see if the listing was featured
			
			if(isset($_POST['featured'])) update_post_meta($pid, "featured", "1");
			else update_post_meta($pid, "featured", "0");
			
			//-------------------------------------------------------------
			
			$base_fee_paid 	= get_post_meta($pid, 'base_fee_paid', true);
			$base_fee 		= get_option('Buzzler_new_listing_listing_fee');
			
			//--------------------------------------------
			
			$catid = Buzzler_get_listing_primary_cat($pid);
			
			$custom_set = get_option('Buzzler_enable_custom_posting');
			if($custom_set == 'yes')
			{
				$base_fee = get_option('Buzzler_theme_custom_cat_'.$catid);
				if(empty($base_fee)) $base_fee = 0;		
			}
			
			//--------------------------------------------
			$payment_arr = array();
			
			if($base_fee_paid != "1" && $base_fee > 0)
			{

				$my_small_arr = array();
				$my_small_arr['fee_code'] 		= 'base_fee';
				$my_small_arr['show_me'] 		= true;
				$my_small_arr['amount'] 		= $base_fee;
				$my_small_arr['description'] 	= __('Base Fee','Buzzler');
				array_push($payment_arr, $my_small_arr);
			}
			
			
			$my_small_arr = array();
			$my_small_arr['fee_code'] 		= 'extra_img';
			$my_small_arr['show_me'] 		= true;
			$my_small_arr['amount'] 		= $Buzzler_get_images_cost_extra;
			$my_small_arr['description'] 	= __('Extra Images Fee','Buzzler');
			array_push($payment_arr, $my_small_arr);
				
			
			//-------- Featured listing Check --------------------------
			
			$featured 		= get_post_meta($pid, 'featured', true);
			$featured_paid 	= get_post_meta($pid, 'featured_paid', true);
			$feat_charge 	= get_option('Buzzler_new_listing_feat_listing_fee');
			
			if($featured == "1" && $featured_paid != "1" && $feat_charge > 0)
			{
				$not_OK_to_just_publish = 1;
				
				$my_small_arr = array();
				$my_small_arr['fee_code'] 		= 'feat_fee';
				$my_small_arr['show_me'] 		= true;
				$my_small_arr['amount'] 		= $feat_charge;
				$my_small_arr['description'] 	= __('Featured Fee','Buzzler');
				array_push($payment_arr, $my_small_arr);
			}
			
		
		
			//---------------------------
			
			$payment_arr = apply_filters('Buzzler_filter_payment_array', $payment_arr, $pid);
			
			$my_total = 0;
			if(count($payment_arr) > 0)
			foreach($payment_arr as $payment_item):
				if($payment_item['amount'] > 0):
					$my_total += $payment_item['amount'];
				endif;
			endforeach;			
			
			$my_total = apply_filters('Buzzler_filter_payment_total', $my_total, $pid);
			
			//---------------------
			
			$price 	= trim($_POST['price']);
			update_post_meta($pid, "price", 		$price);

			//--------------------
			
			
			
			if($not_OK_to_just_publish == 1 or $Buzzler_admin_approves_each_listing == "yes")
			{
					
				$my_post = array();
				$my_post['ID'] = $pid;
				$my_post['post_status'] = 'draft';
			
				wp_update_post( $my_post );
				
			}
			else
			{
				
				$my_post = array();
				$my_post['ID'] = $pid;
				$my_post['post_status'] = 'publish';

				wp_update_post( $my_post );
				
			}
		}
		
		
		

		
		$cid = $uid;
	

	get_header();
	
	$post_au = get_post($pid);
	
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

	<div id="content" >
        	
            <div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php printf(__("Edit Listing - %s", "Buzzler"), $post_au->post_title); ?></div>
                <div class="box_content"> 
            	
                
                 <!-- ########################################### -->
                <?php
				
				if($not_OK_to_just_publish == 2) //ok published
				{
					if($Buzzler_admin_approves_each_listing == "yes"):
					
						echo '<div class="stuff-paid-ok"><div class="padd10">';
						echo sprintf(__('Your listing has been updated and but is not live. The admin must approve it before it goes live.','Buzzler'));
						echo '</div></div>';	

					
					else:
					
						echo '<div class="stuff-paid-ok"><div class="padd10">';
						echo sprintf(__('Your listing has been updated and is live now. <a href="%s"><strong>Click here</strong></a> to see your listing.','Buzzler'), get_permalink($pid));
						echo '</div></div>';	
					
					endif;
				
				}
				
				elseif($not_OK_to_just_publish == 2) //ok published
				{
					echo '<div class="stuff-paid-ok"><div class="padd10">';
					echo sprintf(__('Your listing has been updated and is live now. <a href="%s"><strong>Click here</strong></a> to see your listing.','Buzzler'), get_permalink($pid));
					echo '</div></div>';	
				}
				
				elseif($not_OK_to_just_publish == 1)
				{
						echo '<div class="stuff-not-paid"><div class="padd10">';
						echo __('You have added extra options to your listing. In order to publish your listing you need to pay for the options.','Buzzler');
						echo '<br/><br/><table width="100%">';
						
						$ttl = 0;
						
						foreach($payment_arr as $payment_item):
							
							$feature_cost 			= $payment_item['amount'];
							$feature_description 	= $payment_item['description'];
							
							
							echo '<tr>';
							echo '<td width="320">'.$feature_description.'</td>';
							echo '<td>'.Buzzler_get_show_price($feature_cost,2).'</td>';
							echo '</tr>';
							
						endforeach;
						
							echo '<tr>';
							echo '<td width="320"><b>'.__('Total','Buzzler').'</b></td>';
							echo '<td>'.Buzzler_get_show_price($my_total,2).'</td>';
							echo '</tr>';
						
					 
							
						echo '</table><br/><br/>';
						
			 
						
						global $listing_ID;
						$listing_ID = $pid;
						
						//-------------------
						
						$Buzzler_paypal_enable 		= get_option('Buzzler_paypal_enable');
						$Buzzler_alertpay_enable 		= get_option('Buzzler_alertpay_enable');
						$Buzzler_moneybookers_enable 	= get_option('Buzzler_moneybookers_enable');
						
						if($Buzzler_paypal_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=paypal_listing&pid='.$pid.'" class="edit_listing_pay_cls">'.__('Pay by PayPal','Buzzler').'</a>';
						
						if($Buzzler_moneybookers_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=mb_listing&pid='.$pid.'" class="edit_listing_pay_cls">'.__('Pay by MoneyBookers/Skrill','Buzzler').'</a>';
						
						if($Buzzler_alertpay_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=payza_listing&pid='.$pid.'" class="edit_listing_pay_cls">'.__('Pay by Payza','Buzzler').'</a>';
						
						$Buzzler_offline_payments = get_option('Buzzler_offline_payments');
						if($Buzzler_offline_payments == "yes")
						{
							$opt = get_option('Buzzler_offline_payment_dets');
							echo sprintf(__('Bank Details: %s','Buzzler'), $opt);	
							
						}
						
						do_action('Buzzler_add_payment_options_to_edit_listing', $pid);
						
						echo '</div></div>';
				}
					
				
				
				
				?>
                
                <!-- ########################################## -->
<!-- ##################################################################### -->

<script type="text/javascript">
	
		function check_quant()
		{
			$('#quantity_li').toggle('slow');
			$('#start_prc').toggle('slow');
			$('#res_prc').toggle('slow');			
		}
	
	</script>

<?php
	
	$Buzzler_enable_images_in_listings = get_option('Buzzler_enable_images_in_listings');
				if($Buzzler_enable_images_in_listings != "no"):
				
				?>
    <form id="fileupload" action="<?php bloginfo('siteurl'); ?>/?uploady_thing=1&pid=<?php echo $pid; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    <input type="hidden" name="cid" value="<?php echo $cid; ?>">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span><?php _e('Add Images','Buzzler'); ?></span>
                    <input type="file" name="files[]" multiple>
                </span>
             
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span><?php _e('Cancel upload','Buzzler'); ?></span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span><?php _e('Delete','Buzzler'); ?></span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>



<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>{%=locale.fileupload.start%}</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>{%=locale.fileupload.cancel%}</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">{%=locale.fileupload.error%}</span> {%=locale.fileupload.errors[file.error] || file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                <i class="icon-trash icon-white"></i>
                <span>{%=locale.fileupload.destroy%}</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>
<script> var $ = jQuery; </script>



<?php endif; ?>

<!-- ####################################################################### -->  

                
                <div class="clear10"></div>
                 	<form method="post" enctype="multipart/form-data"> 
                    <?php
					
	$post_au 		  = get_post($pid);
	$location 	  = wp_get_object_terms($pid, 'listing_location');
	$cat 		  = wp_get_object_terms($pid, 'listing_cat');
 
					?>
            
        <div class="clear10"></div>         
    <ul class="post-new3">
           <li>
        	<h2><?php echo __('Your listing title', 'Buzzler'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="listing_title" 
            value="<?php echo (empty($_POST['listing_title']) ? 
			($post_au->post_title == "Auto Draft" ? "" : $post_au->post_title) : $_POST['listing_title']); ?>" /> <?php do_action('Buzzler_step1_after_title_field');  ?></p>
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
										'post_mime_type' => array('application/zip','application/pdf'),
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
             
        
        
        <li>
        	<h2><?php echo __('Location', 'Buzzler'); ?>:</h2>
        <p><?php	echo Buzzler_get_categories("listing_location", 
		empty($_POST['listing_location_cat']) ? (is_array($location) ? $location[0]->term_id : "") : $_POST['listing_location_cat'], __("Select Location","Buzzler"), "do_input"); ?></p>
        </li>

        
        <li><h2><?php echo __('Category', 'Buzzler'); ?>:</h2>
        	<p><?php	echo Buzzler_get_categories("listing_cat",  
			!isset($_POST['listing_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : $_POST['_cat_cat']
			, __("Select Category","Buzzler"), "do_input"); ?></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Address', 'Buzzler'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="street_address" value="<?php echo get_post_meta($pid,'street_address',true); ?>" />  </p>
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
		echo empty($_POST['listing_description']) ? trim($post_au->post_content) : $_POST['listing_description']; ?></textarea>
        <?php do_action('Buzzler_step1_after_description_field');  ?>
        </p>
        </li>

   <?php    
       	
		$cat 		  	= wp_get_object_terms($pid, 'listing_cat');
		$catidarr 		= array();
		
		foreach($cat as $catids)
		{
			$catidarr[] = $catids->term_id;
		}
	
		$arr 	= get_listing_category_fields($catidarr, $pid);
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<li><h2>';
					echo $arr[$i]['field_name'].$arr[$i]['id'].':</h2>';
					echo '<p>'.$arr[$i]['value'];
					do_action('Buzzler_step3_after_custom_field_'.$arr[$i]['id'].'_field');
					echo '</p>';
					echo '</li>';
			
			
		}	
	
        ?>

	 <li>
        <h2><?php _e("Feature listing?",'Buzzler');  ?>:</h2>
        <p><input type="checkbox" class="do_input" name="featured" <?php echo (get_post_meta($pid,'featured', true) == "1" ? 'checked="checked"' : ''); ?> value="1" /> 
        <?php do_action('Buzzler_step1_after_featured_field');  ?>
        
       </p>
        </li>
        
	 
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="save-listing" value="<?php _e("Save Listing",'Buzzler'); ?>" /></p>
        </li>
    


		</ul>
          </form>     
                
                
                </div>
                </div>
                </div>
                </div>
                
	<?php Buzzler_get_users_links(); ?>

<?php get_footer(); ?>