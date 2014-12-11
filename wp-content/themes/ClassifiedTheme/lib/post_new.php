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

function ClassifiedTheme_post_new_area_main_function()
{
	$new_ad_step =  $_GET['step'];
	if(empty($new_ad_step)) $new_ad_step = 1;
	
	$pid = $_GET['ad_id'];
	global $error, $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
			
	//----------------------------------------------------
	
	?>
    
    	<div class="my_box3" style="margin-top:5px;">
    <div class="padd10">
            
    <div class="box_title"><?php echo __("Post new Listing", 'ClassifiedTheme'); ?></div>
    <div class="box_content">
    
  
            
           
            <?php
				
				echo '<div id="steps">';
		
					echo '<ul>';
					
						echo '<li '.($new_ad_step == '1' ? "class='active_step' " : "").'>'.__("Write Listing", 'ClassifiedTheme').'</li>';
						echo '<li '.($new_ad_step == '2' ? "class='active_step' " : "").'>'.__("Add Photos", 'ClassifiedTheme').'</li>';
						echo '<li '.($new_ad_step == '3' ? "class='active_step' " : "").'>'.__("Review & Publish", 'ClassifiedTheme').'</li>';
					echo '</ul>';
					
				echo '</div>';

				
				
			?>
    
<!-- ####################################### Step 1 ######################################### -->
<?php

if($new_ad_step == "1")
{
	
	//-----------------
	$post 		= get_post($pid);
	$location 	= wp_get_object_terms($pid, 'ad_location');
	$cat 		= wp_get_object_terms($pid, 'ad_cat');
	
	if(is_array($error))
	if($adOK == 0)
	{
		echo '<div class="errrs">';
		
			foreach($error as $e)		
			echo '<div class="newad_error">'.$e. '</div>';	
	
		echo '</div>';
		
	}
	
	do_action('ClassifiedTheme_step1_before');
	
	?>
    
    
    <form method="post" action="<?php echo ClassifiedTheme_post_new_with_pid_stuff_thg($pid, $new_ad_step);?>">  
    <ul class="post-new">
        <li>
        	<h2><?php echo __('Your ad title', 'ClassifiedTheme'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="ad_title" 
            value="<?php echo (empty($_POST['ad_title']) ? 
			($post->post_title == "Auto Draft" ? "" : $post->post_title) : $_POST['ad_title']); ?>" /> <?php do_action('ClassifiedTheme_step1_after_title_field');  ?></p>
        </li>
        
        <?php do_action('ClassifiedTheme_after_title_li'); ?>

		<?php
		
			$ClassifiedTheme_enable_locations = get_option('ClassifiedTheme_enable_locations');
			if($ClassifiedTheme_enable_locations != 'no'):
		
		?>
        <li>
        	<h2><?php echo __('Location', 'ClassifiedTheme'); ?>:</h2>
        <p><?php	echo ClassifiedTheme_get_categories("ad_location", 
		empty($_POST['ad_location_cat']) ? (is_array($location) ? $location[0]->term_id : "") : $_POST['ad_location_cat'], __("Select Location","ClassifiedTheme"), "do_input"); ?></p>
        </li>
        <?php endif; ?>
        <?php do_action('ClassifiedTheme_after_location_li'); ?>
        
        <li><h2><?php echo __('Category', 'ClassifiedTheme'); ?>:</h2>
        	<p><?php	echo ClassifiedTheme_get_categories("ad_cat",  
			!isset($_POST['ad_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : $_POST['ad_cat_cat']
			, __("Select Category","ClassifiedTheme"), "do_input"); ?></p>
        </li>
        
        
        <?php do_action('ClassifiedTheme_after_category_li'); ?>
        
        
        <li>
        	<h2><?php echo __('Item Price', 'ClassifiedTheme'); ?>:</h2>
        <p><input type="text" size="10" name="price" class="do_input" 
        	value="<?php echo empty($_POST['price']) ? get_post_meta($pid, 'price', true) : $_POST['price']; ?>" /> 
			<?php echo ClassifiedTheme_currency(); ?> <?php do_action('ClassifiedTheme_step1_after_start_rpice_field');  ?></p>
        </li>
        
        
        
         <li>
        	<h2><?php echo __('Address','ClassifiedTheme'); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="ad_location_addr" value="<?php echo !isset($_POST['ad_location_addr']) ? 
		get_post_meta($pid, 'Location', true) : $_POST['ad_location_addr']; ?>" /> 
        <?php do_action('ClassifiedTheme_step1_after_address_field');  ?>
        </p>
        </li>
        
        <?php do_action('ClassifiedTheme_after_address_li'); ?>
        
        <li>
        	<h2><?php echo __('Description', 'ClassifiedTheme'); ?>:</h2>
        <p><textarea rows="6" cols="60" class="do_input"  name="ad_description"><?php 
		echo empty($_POST['ad_description']) ? trim($post->post_content) : $_POST['ad_description']; ?></textarea>
        <?php do_action('ClassifiedTheme_step1_after_description_field');  ?>
        </p>
        </li>


		<?php do_action('ClassifiedTheme_after_description_li'); ?>

	 <li>
        <h2><?php _e("Feature ad?",'ClassifiedTheme');  ?>:</h2>
        <p><input type="checkbox" class="do_input" name="featured" <?php echo (get_post_meta($pid,'featured', true) == "1" ? 'checked="checked"' : ''); ?> value="1" /> 
        <?php do_action('ClassifiedTheme_step1_after_featured_field');  ?>
        
       </p>
        </li>
        
        <li>
        	<h2><?php echo __('Tags', 'ClassifiedTheme'); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="ad_tags" value="<?php echo $ad_tags; ?>" /> 
        <?php do_action('ClassifiedTheme_step1_after_tags_field');  ?> </p>
        </li>
        
        
     	<?php do_action('ClassifiedTheme_after_tags_li'); ?>
        
        <li>
        <h2>&nbsp;</h2>
        <p>
        <?php 
		
		//echo '<a class="goback-link" href="'.ClassifiedTheme_post_new_link().'/step/1/?substep='.(count($_SESSION['ClassifiedTheme_stored_categories'])).'&post_new_ad_id='.  $pid.'">
		//'.__('Go Back','ClassifiedTheme').'</a>';
		
		 ?>
        <input type="submit" name="ad_submit_1" value="<?php _e("Next Step", 'ClassifiedTheme'); ?> >>" /></p>
        </li>
    
    	<?php do_action('ClassifiedTheme_after_submit_li'); ?>
    
    </ul>
    </form>
        
        <?php	
	
	
	
	
	
}
    
    
           
 ?>
 
 
 <!-- ####################################### Step 2 ######################################### -->
<?php

if($new_ad_step == "2")
{
	
?>	

    <form method="post" enctype="multipart/form-data" action="<?php echo ClassifiedTheme_post_new_with_pid_stuff_thg($pid, $new_ad_step);?>">  
    <ul class="post-new">


		                            <li>
                            <h2><?php echo __('Images', 'ClassifiedTheme'); ?>:</h2>
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
				
				$default_nr = get_option('ClassifiedTheme_nr_max_of_images');
		  		if(empty($default_nr)) $default_nr = 5;
				
				
				
				$actual_nr = count($attachments);
				if($pid == 0) $actual_nr = 0; 
				
				$dis = $default_nr - $actual_nr;
		  		
		  		for($i=1;$i<=$dis;$i++):
				?>                   
        		
                	<input type="file" class="do_input file_inpt" name="file_<?php echo $i; ?>" />
				
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
			ClassifiedTheme_generate_thumb($url, 70, 70). '" />
			<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
			</div>';
	  
	}
	}


	?>
    
    </div>
                           
                           </li>



		<?php /*-------  custom fields  -------- */ ?>
        <?php
		
		$auction_cat = wp_get_object_terms($pid, 'ad_cat');
		$cate = array($auction_cat[0]->term_id);
		
		$arr 	= get_listing_category_fields($cate, $pid);
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<li>';
					echo '<h2>'.$arr[$i]['field_name'].$arr[$i]['id'].':</h2>';
					echo '<p>'.$arr[$i]['value'];
					do_action('ClassifiedTheme_step2_after_custom_field_'.$arr[$i]['id'].'_field');
					echo '</p>';
					echo '</li>';
					
					do_action('ClassifiedTheme_after_field_'.$arr[$i]['id'].'_li');
			
			
		}	
		
		
		do_action('ClassifiedTheme_step2_form_thing', $pid);
		
		
		?> 


	    <li>
        <h2>&nbsp;</h2>
        <p>
        <?php 
		
		echo '<a class="goback-link" href="'.ClassifiedTheme_post_new_with_pid_stuff_thg($pid, 1).'">
		'.__('Go Back','ClassifiedTheme').'</a>';
		
		 ?>
        <input type="submit" name="ad_submit_2" value="<?php _e("Next Step", 'ClassifiedTheme'); ?> >>" /></p>
        </li>
    
    	<?php do_action('ClassifiedTheme_after_submit_li'); ?>
    
    </ul>
    </form>

	
	<?php } ?>
 
 
 <!-- ####################################### Step 3 ######################################### -->
<?php

if($new_ad_step == "3")
{
	$my_post = get_post($pid);
	
	
	
if($_GET['finalise'] == "yes") $finalise = true;
	else $finalise = false;
	
	
	//-----------------------
	
	$ClassifiedTheme_new_listing_listing_fee = get_option('ClassifiedTheme_new_listing_listing_fee');
	if(empty($ClassifiedTheme_new_listing_listing_fee)) $ClassifiedTheme_new_listing_listing_fee = 0;
	
	$ClassifiedTheme_new_listing_feat_listing_fee = get_option('ClassifiedTheme_new_listing_feat_listing_fee');
	if(empty($ClassifiedTheme_new_listing_feat_listing_fee)) $ClassifiedTheme_new_listing_feat_listing_fee = 0;
	
	$ClassifiedTheme_new_listing_sealed_bidding_fee = get_option('ClassifiedTheme_new_listing_sealed_bidding_fee');
	if(empty($ClassifiedTheme_new_listing_sealed_bidding_fee)) $ClassifiedTheme_new_listing_sealed_bidding_fee = 0;
	
	$ClassifiedTheme_get_images_cost_extra = ClassifiedTheme_get_images_cost_extra($pid); 
	$catid 								= ClassifiedTheme_get_item_primary_cat($pid);
	
	//---------------------------------
	
	$custom_set = get_option('ClassifiedTheme_enable_custom_posting');
	if($custom_set == 'yes')
	{
		$posting_fee = get_option('ClassifiedTheme_theme_custom_cat_'.$catid);
		if(empty($posting_fee)) $posting_fee = 0;		
	}
	else
	{
		$posting_fee = $ClassifiedTheme_new_listing_listing_fee;
	}
	
	
	//---------------------------------
	
	$payment_arr = array();
	
	$my_small_arr = array();
	$my_small_arr['fee_code'] 		= 'base_fee';
	$my_small_arr['show_me'] 		= true;
	$my_small_arr['amount'] 		= $posting_fee;
	$my_small_arr['description'] 	= __('Base Listing Fee','ClassifiedTheme');
	array_push($payment_arr, $my_small_arr);
	
	//--------------------------------
	
	$featured = get_post_meta($pid, 'featured', true);
	
	if($featured == "1"):
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'feat_fee';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $ClassifiedTheme_new_listing_feat_listing_fee;
		$my_small_arr['description'] 	= __('Featured Listing Fee','ClassifiedTheme');
		array_push($payment_arr, $my_small_arr);
	endif;
	
	//--------------------------------
	
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'extra_img';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $ClassifiedTheme_get_images_cost_extra;
		$my_small_arr['description'] 	= __('Extra Images Fee','ClassifiedTheme');
		array_push($payment_arr, $my_small_arr);
	
	//--------------------------------
	
	$post 			= get_post($pid);
		
	//---------------------------------------------
	
	$new_total 		= 0;
		
	foreach($payment_arr as $payment_item):			
		if($payment_item['amount'] > 0):				
			$new_total += $payment_item['amount'];			
		endif;			
	endforeach;
	
	//----------------------------------------
	
	$total 			= $new_total;
	$total 			= apply_filters('ClassifiedTheme_total_price_to_pay' , 			$total, $pid);

	$opt = get_option('ClassifiedTheme_admin_approve_listing');
	if($opt == "yes") $admin_must_approve = true;
	else $admin_must_approve = false;
	
	//-----------------------------------------
	
	do_action('ClassifiedTheme_action_when_posting_listing', $pid);
	
	if($total == 0)
	{
			global $current_user;
			get_currentuserinfo();
			
			echo '<div >';
			echo __('Thank you for posting your item with us.','ClassifiedTheme');
			update_post_meta($pid, "paid", "1");
			

			if($finalise):
				if($admin_must_approve)
				{
					$my_post1 = array();
					$my_post1['ID'] = $pid;
					$my_post1['post_status'] = 'draft';
	
					wp_update_post( $my_post1 );
					
					ClassifiedTheme_send_email_posted_item_not_approved($pid);
					ClassifiedTheme_send_email_posted_item_approved_admin($pid);
					
					echo '<br/>'.__("Your listing isn't yet live, the admin needs to approve it.", "ClassifiedTheme");
					
	
				
				}
				else
				{
					$post_new_date = date('Y-m-d h:s',current_time('timestamp',0));  
					
					$my_post1 = array();
					$my_post1['ID'] = $pid;
					$my_post1['post_status'] = 'publish';
					$my_post1["post_date"] 				= $post_new_date;
				  	$my_post1["post_date_gmt"] 			= $post_new_date;
					
					wp_update_post( $my_post1 );
					
					ClassifiedTheme_send_email_posted_item_approved($pid);
					ClassifiedTheme_send_email_posted_item_not_approved_admin($pid);
					
				}
				
			endif;
			echo '</div>';
			
	
	}
	else
	{
			update_post_meta($pid, "paid", "0");
			$featured	 = get_post_meta($pid, 'featured', true);
			
			if(is_user_logged_in()):
			
				global $current_user;
				get_currentuserinfo();
				$uid = $current_user->ID;
				
				$total_nr 			= get_user_meta($uid, 'normal_ads_pack',	true); 		if(empty($total_nr)) 			$total_nr = 0;
				$total_featured_nr 	= get_user_meta($uid, 'featured_ads_pack',	true); 		if(empty($total_featured_nr)) 	$total_featured_nr = 0;
				$featured_ad 		= get_post_meta($pid, 'featured' ,			true);
			
				if($featured == "1"):
					
					if($total_featured_nr > 0):
					
						$paid = get_post_meta($pid, "paid", true);
						
						if($paid == "0"):
							update_user_meta($uid, 'featured_ads_pack', ($total_featured_nr - 1));
							update_post_meta($pid, "paid", "1");
						endif;
						
						$ok_suc = 1;
							
					endif;
					
				else:
				
					if($total_nr > 0):
					
						$paid = get_post_meta($pid, "paid", true);
						
						if($paid == "0"):
							update_user_meta($uid, 'normal_ads_pack', ($total_nr - 1));
							update_post_meta($pid, "paid", "1");
						endif;
						
						$ok_suc = 1;
							
					endif;
				
				endif;
				
			
				if($ok_suc == 1):
				
					echo __('It seems you had credits in your account for posting the ad. So now your ad has been paid.','ClassifiedTheme'); 
					echo '<br/>';
				
					if($admin_approve == "yes"):
					
						echo __('However your ad is not yet live. The admin of the site will review and publish it.','ClassifiedTheme');
						ClassifiedTheme_post_new_notice_not_approved($pid, $email);
						
					else:				
						
						$my_post = array();
						$my_post['ID'] = $pid;
						$my_post['post_status'] = 'publish';
				
						wp_update_post( $my_post );
						wp_publish_post( $pid );
						
						echo sprintf(__('You can view your ad live on the site <a href="%s">here</a>.','ClassifiedTheme'), get_permalink($pid));
						ClassifiedTheme_post_new_notice_approved($pid, $email);
						
						
					endif;
				endif;			
			endif;
			//-------------------------------------
			
			
			if($ok_suc != 1):
			
			echo '<div >';
			echo __('Thank you for posting your ad with us. Below is the total price that you need to pay in order to put your ad live.<br/>
			Click the pay button and you will be redirected...', "ClassifiedTheme");
			echo '</div>';
			
			endif;
			
			
			
	}
	
	//----------------------------------------
	
	
	
	echo '<table style="margin-top:25px">';
	
	if($total > 0) :
	foreach($payment_arr as $payment_item):
			
			if($payment_item['amount'] > 0):
			
				echo '<tr>';
				echo '<td>'.$payment_item['description'].'&nbsp; &nbsp;</td>';
				echo '<td>'.ClassifiedTheme_get_show_price($payment_item['amount'],2).'</td>';
				echo '</tr>';

			endif;
			
		endforeach;
	
	
				echo '<tr>';
	echo '<td>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	echo '<tr>';
	echo '<td><strong>'.__('Total to Pay','ClassifiedTheme').'</strong></td>';
	echo '<td><strong>'.ClassifiedTheme_get_show_price($total,2).'</strong></td>';
	echo '<tr>';
	
	
	echo '<tr>';
	echo '<td>&nbsp;<br/>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	endif;
	
	if($total == 0)
	{
		if(!$admin_must_approve && $finalise):
		
			echo '<tr>';
			echo '<td></td>';
			echo '<td><a href="'.get_permalink($pid).'" class="pay_now">'.__('See your listing','ClassifiedTheme') .'</a></td>';
			echo '<tr>';	
		
		endif;
		
	}
	else
	{
		update_post_meta($pid,'unpaid','1');
		
		 		
						echo '<tr>';
						echo '<td></td><td>';
		
						$ClassifiedTheme_paypal_enable 		= get_option('ClassifiedTheme_paypal_enable');
						$ClassifiedTheme_alertpay_enable 		= get_option('ClassifiedTheme_alertpay_enable');
						$ClassifiedTheme_moneybookers_enable 	= get_option('ClassifiedTheme_moneybookers_enable');
						
						
						if($ClassifiedTheme_paypal_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=paypal_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by PayPal','ClassifiedTheme').'</a>';
						
						if($ClassifiedTheme_moneybookers_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=mb_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by MoneyBookers/Skrill','ClassifiedTheme').'</a>';
						
						if($ClassifiedTheme_alertpay_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?a_action=payza_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by Payza','ClassifiedTheme').'</a>';
						
						$ClassifiedTheme_offline_payments = get_option('ClassifiedTheme_offline_payments');
						if($ClassifiedTheme_offline_payments == "yes")
						{
							echo '<br/><br/>';
							$opt = get_option('ClassifiedTheme_offline_payment_dets');
							echo sprintf(__('Bank Details: %s','ClassifiedTheme'), $opt);	
							
						}
						
						do_action('ClassifiedTheme_add_payment_options_to_post_new_project', $pid);
						
						echo '</td></tr>';
		
		

	}
	
	
	echo '<tr>';
	echo '<td>&nbsp;<br/>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	echo '</table>';
	
	
	
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
	
	if(!$finalise)
	echo '<a href="'. ClassifiedTheme_post_new_with_pid_stuff_thg($pid, '2') .'" class="go_back_btn" >'.__('Go Back','ClassifiedTheme').'</a>';
	
	if($total == 0 && !$finalise)
	echo '<a href="'. ClassifiedTheme_post_new_with_pid_stuff_thg($pid, '3', 'finalise').'" 
	class="go_back_btn" >'.__('Finalize and Publish Item','ClassifiedTheme').'</a>';

 


 ?>

	<div class="my-separator-post-new"></div>
    
			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php echo $my_post->post_title; ?></div>
            	<div class="box_content">	
				<?php
				
						$arr = ClassifiedTheme_get_post_images($pid, 125);
						
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
            </div>
            </div>    
                
                
                
                
            <div class="my_box3">
            <div class="padd10">
            
            	
            	<div class="box_content">	
				<?php
				echo $my_post->post_content;
						
				?>
                </div>
            </div>
            </div>    
                    


<?php } ?> 
 
 
 
 
    <!-- end --> 
        </div>
    </div>
    </div>
    

 
 <?php           
            
        
	
}

?>