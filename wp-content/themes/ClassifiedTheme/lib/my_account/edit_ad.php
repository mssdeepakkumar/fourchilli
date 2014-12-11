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

	global $current_user, $wp_query;
	$pid 	=  $wp_query->query_vars['pid'];
	if(empty($pid)) $pid = $_GET['pid'];
	
	global $post_au;
	$post_au = get_post($pid);
	
	
	function ClassifiedTheme_filter_ttl($title){ global $post_au; return __("Edit Listing",'ClassifiedTheme')." - ".$post_au->post_title;}
	add_filter( 'wp_title', 'ClassifiedTheme_filter_ttl', 10, 3 );	
	
	if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }   
	   
	
	get_currentuserinfo();   

	$ClassifiedTheme_admin_approves_each_listing = get_option('ClassifiedTheme_admin_approve_listing');

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
			  $ClassifiedTheme_get_images_cost_extra = ClassifiedTheme_get_images_cost_extra($pid);
			  
			  if(!empty($_POST['Location'])) 
			  update_post_meta($pid, "Location", $_POST['Location']);
			 
			
			  $my_post = array();
			  $my_post['ID'] = $pid;
			  $my_post['post_content'] = $listing_description;
			  $my_post['post_title']   = $listing_title;
	
			  wp_update_post( $my_post );
				
				$term = get_term( $_POST['ad_cat_cat'], 'ad_cat' );	
				$ad_cat = $term->slug;
				
				$term = get_term( $_POST['ad_location_cat'], 'ad_location' );	
				$ad_location = $term->slug;
				
			wp_set_object_terms($pid, array($ad_cat),'ad_cat');
			wp_set_object_terms($pid, array($ad_location),'ad_location');
			
			
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
			
			
			
			$not_OK_to_just_publish = 2;
			
			//-----------------------------------
			// see if the listing was featured
			
			if(isset($_POST['featured'])) update_post_meta($pid, "featured", "1");
			else update_post_meta($pid, "featured", "0");
			
			//--------------------------------------------------------------
			
			if(isset($_POST['featured']))
			{
				$nowtm = current_time('timestamp',0);
				
				$ClassifiedTheme_listing_featured_time_listing = get_option('ClassifiedTheme_listing_featured_time_listing');
				if(empty($ClassifiedTheme_listing_featured_time_listing)) $ClassifiedTheme_listing_featured_time_listing = 30;
				
				$ClassifiedTheme_listing_time_listing = get_option('ClassifiedTheme_listing_time_listing');
				if(empty($ClassifiedTheme_listing_time_listing)) $ClassifiedTheme_listing_time_listing = 30;
				
				$is_ad_featured = get_post_meta($pid, 'featured', true);
				if($is_ad_featured == "1") $time_ending = $nowtm + $ClassifiedTheme_listing_featured_time_listing *3600*24;
				else $time_ending = $nowtm + $ClassifiedTheme_listing_time_listing *3600*24;
				
				update_post_meta($pid, "ending", $time_ending);
				
			}
			
			//-------------------------------------------------------------
			
			$base_fee_paid 	= get_post_meta($pid, 'base_fee_paid', true);
			$base_fee 		= get_option('ClassifiedTheme_new_listing_listing_fee');
			
			//--------------------------------------------
			
			$catid = ClassifiedTheme_get_listing_primary_cat($pid);
			
			$custom_set = get_option('ClassifiedTheme_enable_custom_posting');
			if($custom_set == 'yes')
			{
				$base_fee = get_option('ClassifiedTheme_theme_custom_cat_'.$catid);
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
				$my_small_arr['description'] 	= __('Base Fee','ClassifiedTheme');
				array_push($payment_arr, $my_small_arr);
			}
			
			
			$my_small_arr = array();
			$my_small_arr['fee_code'] 		= 'extra_img';
			$my_small_arr['show_me'] 		= true;
			$my_small_arr['amount'] 		= $ClassifiedTheme_get_images_cost_extra;
			$my_small_arr['description'] 	= __('Extra Images Fee','ClassifiedTheme');
			array_push($payment_arr, $my_small_arr);
				
			
			//-------- Featured listing Check --------------------------
			
			$featured 		= get_post_meta($pid, 'featured', true);
			$featured_paid 	= get_post_meta($pid, 'featured_paid', true);
			$feat_charge 	= get_option('ClassifiedTheme_new_listing_feat_listing_fee');
			
			if($featured == "1" && $featured_paid != "1" && $feat_charge > 0)
			{
				$not_OK_to_just_publish = 1;
				
				$my_small_arr = array();
				$my_small_arr['fee_code'] 		= 'feat_fee';
				$my_small_arr['show_me'] 		= true;
				$my_small_arr['amount'] 		= $feat_charge;
				$my_small_arr['description'] 	= __('Featured Fee','ClassifiedTheme');
				array_push($payment_arr, $my_small_arr);
			}
			
		
		
			//---------------------------
			
			$payment_arr = apply_filters('ClassifiedTheme_filter_payment_array', $payment_arr, $pid);
			
			$my_total = 0;
			if(count($payment_arr) > 0)
			foreach($payment_arr as $payment_item):
				if($payment_item['amount'] > 0):
					$my_total += $payment_item['amount'];
				endif;
			endforeach;			
			
			$my_total = apply_filters('ClassifiedTheme_filter_payment_total', $my_total, $pid);
			
			//---------------------
			
			$price 	= trim($_POST['price']);
			update_post_meta($pid, "price", 		$price);

			//--------------------
			
			
			
			if($not_OK_to_just_publish == 1 or $ClassifiedTheme_admin_approves_each_listing == "yes")
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


	<div id="content" >
        	
            <div class="my_box3">
            	<div class="padd10">
            
            	<div class="box_title"><?php printf(__("Edit Listing - %s", "ClassifiedTheme"), $post_au->post_title); ?></div>
                <div class="box_content"> 
            	
                
                 <!-- ########################################### -->
                <?php
				
				if($not_OK_to_just_publish == 2) //ok published
				{
					if($ClassifiedTheme_admin_approves_each_listing == "yes"):
					
						echo '<div class="stuff-paid-ok"><div class="padd10">';
						echo sprintf(__('Your listing has been updated and but is not live. The admin must approve it before it goes live.','ClassifiedTheme'));
						echo '</div></div>';	

					
					else:
					
						echo '<div class="stuff-paid-ok"><div class="padd10">';
						echo sprintf(__('Your listing has been updated and is live now. <a href="%s"><strong>Click here</strong></a> to see your listing.','ClassifiedTheme'), get_permalink($pid));
						echo '</div></div>';	
					
					endif;
				
				}
				
				elseif($not_OK_to_just_publish == 2) //ok published
				{
					echo '<div class="stuff-paid-ok"><div class="padd10">';
					echo sprintf(__('Your listing has been updated and is live now. <a href="%s"><strong>Click here</strong></a> to see your listing.','ClassifiedTheme'), get_permalink($pid));
					echo '</div></div>';	
				}
				
				elseif($not_OK_to_just_publish == 1)
				{
						echo '<div class="stuff-not-paid"><div class="padd10">';
						echo __('You have added extra options to your listing. In order to publish your listing you need to pay for the options.','ClassifiedTheme');
						echo '<br/><br/><table width="100%">';
						
						$ttl = 0;
						
						foreach($payment_arr as $payment_item):
							
							$feature_cost 			= $payment_item['amount'];
							$feature_description 	= $payment_item['description'];
							
							
							echo '<tr>';
							echo '<td width="320">'.$feature_description.'</td>';
							echo '<td>'.ClassifiedTheme_get_show_price($feature_cost,2).'</td>';
							echo '</tr>';
							
						endforeach;
						
							echo '<tr>';
							echo '<td width="320"><b>'.__('Total','ClassifiedTheme').'</b></td>';
							echo '<td>'.ClassifiedTheme_get_show_price($my_total,2).'</td>';
							echo '</tr>';
						
					 
							
						echo '</table><br/><br/>';
						
			 
						
						global $listing_ID;
						$listing_ID = $pid;
						
						//-------------------
						
						$ClassifiedTheme_paypal_enable 		= get_option('ClassifiedTheme_paypal_enable');
						$ClassifiedTheme_alertpay_enable 		= get_option('ClassifiedTheme_alertpay_enable');
						$ClassifiedTheme_moneybookers_enable 	= get_option('ClassifiedTheme_moneybookers_enable');
						
						if($ClassifiedTheme_paypal_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=paypal_listing&pid='.$pid.'" class="edit_listing_pay_cls">'.__('Pay by PayPal','ClassifiedTheme').'</a>';
						
						if($ClassifiedTheme_moneybookers_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=mb_listing&pid='.$pid.'" class="edit_listing_pay_cls">'.__('Pay by MoneyBookers/Skrill','ClassifiedTheme').'</a>';
						
						if($ClassifiedTheme_alertpay_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=payza_listing&pid='.$pid.'" class="edit_listing_pay_cls">'.__('Pay by Payza','ClassifiedTheme').'</a>';
						
						$ClassifiedTheme_offline_payments = get_option('ClassifiedTheme_offline_payments');
						if($ClassifiedTheme_offline_payments == "yes")
						{
							$opt = get_option('ClassifiedTheme_offline_payment_dets');
							echo sprintf(__('Bank Details: %s','ClassifiedTheme'), $opt);	
							
						}
						
						do_action('ClassifiedTheme_add_payment_options_to_edit_listing', $pid);
						
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
	
	$ClassifiedTheme_enable_images_in_listings = get_option('ClassifiedTheme_enable_images_in_listings');
				if($ClassifiedTheme_enable_images_in_listings != "no"):
				
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
                    <span><?php _e('Add Images','ClassifiedTheme'); ?></span>
                    <input type="file" name="files[]" multiple>
                </span>
             
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span><?php _e('Cancel upload','ClassifiedTheme'); ?></span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span><?php _e('Delete','ClassifiedTheme'); ?></span>
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
                <span><?php _e('Delete','ClassifiedTheme'); ?></span>
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
                 	<form method="post"> 
                    <?php
					
	$post_au 		  = get_post($pid);
	$location 	  = wp_get_object_terms($pid, 'ad_location');
	$cat 		  = wp_get_object_terms($pid, 'ad_cat');
 
					?>
            
        <div class="clear10"></div>         
    <ul class="post-new3">
           <li>
        	<h2><?php echo __('Your listing title', 'ClassifiedTheme'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="listing_title" 
            value="<?php echo (empty($_POST['listing_title']) ? 
			($post_au->post_title == "Auto Draft" ? "" : $post_au->post_title) : $_POST['listing_title']); ?>" /> <?php do_action('ClassifiedTheme_step1_after_title_field');  ?></p>
        </li>
        
		
        <li>
        	<h2><?php echo __('Location', 'ClassifiedTheme'); ?>:</h2>
        <p><?php	echo ClassifiedTheme_get_categories("ad_location", 
		empty($_POST['ad_location_cat']) ? (is_array($location) ? $location[0]->term_id : "") : $_POST['ad_location_cat'], __("Select Location","ClassifiedTheme"), "do_input"); ?></p>
        </li>

        
        <li><h2><?php echo __('Category', 'ClassifiedTheme'); ?>:</h2>
        	<p><?php	echo ClassifiedTheme_get_categories("ad_cat",  
			!isset($_POST['ad_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : $_POST['ad_cat_cat']
			, __("Select Category","ClassifiedTheme"), "do_input"); ?></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Address', 'ClassifiedTheme'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="Location" value="<?php echo get_post_meta($pid,'Location',true); ?>" />  </p>
        </li>

        <li id='start_prc' style="<?php echo ($only_buy_now == "1" ? 'display:none' : '');  ?>">
        	<h2><?php echo __('Price', 'ClassifiedTheme'); ?>:</h2>
        <p><input type="text" size="10" name="price" class="do_input" value="<?php echo get_post_meta($pid, 'price', true); ?>" /> 
			<?php echo classifiedTheme_currency(); ?> <?php do_action('ClassifiedTheme_step1_after_start_rpice_field');  ?></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Description', 'ClassifiedTheme'); ?>:</h2>
        <p><textarea rows="6" cols="60" class="do_input"  name="listing_description"><?php 
		echo empty($_POST['listing_description']) ? trim($post_au->post_content) : $_POST['listing_description']; ?></textarea>
        <?php do_action('ClassifiedTheme_step1_after_description_field');  ?>
        </p>
        </li>

   <?php    
       	
		$cat 		  	= wp_get_object_terms($pid, 'ad_cat');
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
					do_action('ClassifiedTheme_step3_after_custom_field_'.$arr[$i]['id'].'_field');
					echo '</p>';
					echo '</li>';
			
			
		}	
	
        ?>

	 <li>
        <h2><?php _e("Feature listing?",'ClassifiedTheme');  ?>:</h2>
        <p><input type="checkbox" class="do_input" name="featured" <?php echo (get_post_meta($pid,'featured', true) == "1" ? 'checked="checked"' : ''); ?> value="1" /> 
        <?php do_action('ClassifiedTheme_step1_after_featured_field');  ?>
        
       </p>
        </li>
        
	 
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="save-listing" value="<?php _e("Save Listing",'ClassifiedTheme'); ?>" /></p>
        </li>
    


		</ul>
          </form>     
                
                
                </div>
                </div>
                </div>
                </div>
                
	<?php ClassifiedTheme_get_users_links(); ?>

<?php get_footer(); ?>