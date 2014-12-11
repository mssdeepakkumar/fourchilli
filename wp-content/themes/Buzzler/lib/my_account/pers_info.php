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


function buzzler_my_account_pers_info_area_function()
{
	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	
	$uid = $current_user->ID;
	
?>

	<div id="content" class="content_my_account" >
    
    			<div class="my_box3">          
            	<div class="box_title menu-title-item"><h1><?php _e("Personal Information",'Buzzler'); ?></h1></div>
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
						echo __("Passwords do not match!","Buzzler");
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
					
					echo '<div class="saved_thing">'.__('Your profile information was updated.','Buzzler').'</div>';
					echo '<div class="clear10"></div>';
					
				}
				
				?>
                <form method="post"  enctype="multipart/form-data">
                  <ul class="post-new3">

        
        <li>
        	<h2><?php echo __('Profile Description','Buzzler'); ?>:</h2>
        	<p><textarea type="textarea" cols="40" class="do_input" rows="5" name="personal_info"><?php echo stripslashes(get_user_meta($uid, 'personal_info', true)); ?></textarea></p>
        </li>
        
        
         <li>
        	<h2><?php echo __('New Password', "Buzzler"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="password" size="35" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Repeat Password', "Buzzler"); ?>:</h2>
        	<p><input type="password" value="" class="do_input" name="reppassword" size="35"  /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Profile Avatar','Buzzler'); ?>:</h2>
        	<p> <input type="file" name="avatar" /> <br/>
           <?php _e('max file size: 1mb. Formats: jpeg, jpg, png, gif','Buzzler'); ?>
            <br/>
            <img width="50" height="50" border="0" src="<?php echo buzzler_get_avatar($uid,50,50); ?>" /> 
            </p>
        </li>
        
        
        <li>
        <h2>&nbsp;</h2>
        <p><input type="submit" name="save-info" value="<?php _e("Save" ,'Buzzler'); ?>" /></p>
        </li>
        
        </ul>
                </form>
              
                </div>
                </div>
                
    </div>


<?php	
		
	buzzler_get_users_links();		
		
}

?>