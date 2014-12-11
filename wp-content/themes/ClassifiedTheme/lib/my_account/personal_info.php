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


function ClassifiedTheme_my_account_pers_inf_area_function()
{
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	global $wpdb,$wp_rewrite,$wp_query;
	
	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
    
            <div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php _e("Personal Information","ClassifiedTheme"); ?></div>
            	<div class="box_content">
    			


<?php
				
				if(isset($_POST['save-info']))
				{
					$personal_info = strip_tags(nl2br($_POST['personal_info']), '<br />');
					update_user_meta($uid, 'personal_info', $personal_info);
					
 
					
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
						echo __("Passwords do not match!","ClassifiedTheme");
					}
 
					if(!empty($_FILES['avatar']["tmp_name"]))
					{
						$avatar = $_FILES['avatar'];
						
						$tmp_name 	= $avatar["tmp_name"];
        				$name 		= $avatar["name"];
        				
						$upldir = wp_upload_dir();
						$path = $upldir['path'];
						$url  = $upldir['url'];
						
						$name = str_replace(" ","",$name);
						
						if(getimagesize($tmp_name) > 0)
						{
							move_uploaded_file($tmp_name, $path."/".$name);
							update_user_meta($uid, 'avatar', $url."/".$name);
						}
					}
					
					echo '<div class="saved_thing">'.__('Your profile information was updated.','ClassifiedTheme').'</div>';
					echo '<div class="clear10"></div>';
					
				}
				
				?>
                <form method="post"  enctype="multipart/form-data">
                  <ul class="post-new3">
 
        
        <li>
        	<h2><?php echo __('Profile Description','ClassifiedTheme'); ?>:</h2>
        	<p><textarea type="textarea" cols="40" class="do_input" rows="5" name="personal_info"><?php echo stripslashes(get_user_meta($uid, 'personal_info', true)); ?></textarea></p>
        </li>
        
        
         <li>
        	<h2><?php echo __('New Password', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="password" size="35" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Repeat Password', "ClassifiedTheme"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="reppassword" size="35"  /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Profile Avatar','ClassifiedTheme'); ?>:</h2>
        	<p> <input type="file" name="avatar" /> <br/>
           <?php _e('max file size: 1mb. Formats: jpeg, jpg, png, gif'); ?>
            <br/>
            <img width="50" height="50" border="0" src="<?php echo ClassifiedTheme_get_avatar($uid,50,50); ?>" /> 
            </p>
        </li>
        
        
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="save-info" value="<?php _e("Save" ,'ClassifiedTheme'); ?>" /></p>
        </li>
        
        </ul>
                </form>



                
                </div>
                </div>
           </div>
    
    
    <!-- ############################################# -->
    </div>
    
    <?php
	
	classifiedTheme_get_users_links();
	
}

?>