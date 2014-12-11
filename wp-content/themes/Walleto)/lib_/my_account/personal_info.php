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


if(!function_exists('Walleto_my_account_display_persinfo_page'))
{
function Walleto_my_account_display_persinfo_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	
?>	
<div id="content">
		     <?php do_action('Walleto_before_pers_info_i_page'); ?>
        
        
        <div class="my_box3">
 
            
            	<div class="box_title my_account_title"><?php _e("Personal Information",'Walleto'); ?></div>
                <div class="box_content">    
				<?php
				
				if(isset($_POST['save-info']))
				{
					$personal_info = strip_tags(nl2br($_POST['personal_info']), '<br />');
					update_user_meta($uid, 'personal_info', $personal_info);
					
					$shipping_info = trim($_POST['shipping_info']);
					update_user_meta($uid, 'shipping_info', $shipping_info);
					
					
					
					if(isset($_POST['password']) && !empty($_POST['password']))
					{
						$p1 = trim($_POST['password']);
						$p2 = trim($_POST['reppassword']);
						
						if($p1 == $p2)
						{
							global $wpdb;
							$newp = md5($p1);
							$sq = "update $wpdb->users set user_pass='$newp' where ID='$uid'" ;
							$wpdb->query($sq);
						}
						else
						echo __("Passwords do not match!","Walleto");
					}
					
					
					$paypal_email = trim($_POST['paypal_email']);
					update_user_meta($uid, 'paypal_email', $paypal_email);
				 
					
					if(!empty($_FILES['avatar']['name'])):
	  
						$upload_overrides 	= array( 'test_form' => false );
						$uploaded_file 		= wp_handle_upload($_FILES['avatar'], $upload_overrides);
						
						$file_name_and_location = $uploaded_file['file'];
						$file_title_for_media_library = $_FILES['avatar']['name'];
								
						$arr_file_type 		= wp_check_filetype(basename($_FILES['avatar']['name']));
						$uploaded_file_type = $arr_file_type['type'];
		
						if($uploaded_file_type == "image/png" or $uploaded_file_type == "image/jpg" or $uploaded_file_type == "image/jpeg" or $uploaded_file_type == "image/gif" )
						{
						
							$attachment = array(
											'post_mime_type' => $uploaded_file_type,
											'post_title' => 'Uploaded avatar ' . addslashes($file_title_for_media_library),
											'post_content' => '',
											'post_status' => 'inherit',
											'post_parent' =>  0,			
											'post_author' => $current_user->ID,
										);
									 
							$attach_id = wp_insert_attachment( $attachment, $file_name_and_location, 0 );
							$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
							wp_update_attachment_metadata($attach_id,  $attach_data);
							
							update_user_meta($uid, 'avatar_new', $attach_id);
						
						}
						
					endif;
					
					
					echo '<div class="saved_thing">'.__('Your profile information was updated.','Walleto').'</div>';
					echo '<div class="clear10"></div>';
					
				}
				
				?>
                <form method="post"  enctype="multipart/form-data">
                  <ul class="post-new3">
        <li>
        	<span class="p_form_name"><?php echo __('PayPal Email','Walleto'); ?>:</span>
        	<p><input type="text" name="paypal_email" class="do_input p_text_box" value="<?php echo get_user_meta($uid, 'paypal_email', true); ?>" size="40" /></p>
        </li>
        
        
        <li>
        	<span class="p_form_name"><?php echo __('Shipping Info','Walleto'); ?>:</span>
        	<p><textarea type="shipping_info"  class="do_input p_textarea"  name="shipping_info"><?php echo stripslashes(get_user_meta($uid, 'shipping_info', true)); ?></textarea></p>
        </li>
        
        <li>
        	<span class="p_form_name"><?php echo __('Profile Description','Walleto'); ?>:</span>
        	<p><textarea type="textarea"  class="do_input p_textarea"  name="personal_info"><?php echo stripslashes(get_user_meta($uid, 'personal_info', true)); ?></textarea></p>
        </li>
        
        
         <li>
        	<span class="p_form_name"><?php echo __('New Password', "Walleto"); ?>:</span>
        	<p><input type="password" value="" class="do_input p_text_box" name="password" size="35" /></p>
        </li>
        
        
        <li>
        	<span class="p_form_name"><?php echo __('Repeat Password', "Walleto"); ?>:</span>
        	<p><input type="password" value="" class="do_input p_text_box" name="reppassword" size="35"  /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Profile Avatar','Walleto'); ?>:</h2>
        	<p> <input type="file" name="avatar" /> <br/>
           <?php _e('max file size: 1mb. Formats: jpeg, jpg, png, gif'); ?>
            <br/>
            <img width="150" height="150" border="0" src="<?php echo Walleto_get_avatar($uid,150,150); ?>" /> 
            </p>
        </li>
        
        
        <li>
        <h2>&nbsp;</h2>
        <p><input class="pink-btn" type="submit" name="save-info" value="<?php _e("Save" ,'Walleto'); ?>" /></p>
        </li>
        
        </ul>
                </form>
                </div>
           </div>
           
        
        </div>

<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
