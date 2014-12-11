<?php

function buzzler_claim_listing_area_function()
{
	$pid 		= $_GET['pid'];
	$post_au 	= get_post($pid);
	
	global $wpdb, $current_user;	
	get_currentuserinfo();
	$uid = $current_user->ID;
		
	?>
    
    	<div id="content" class="full_width_dv" >
    
    			<div class="my_box3">          
            	<div class="box_title menu-title-item"><h1><?php echo sprintf(__("Claim Listing - %s",'Buzzler'), $post_au->post_title); ?></h1></div>
                <div class="box_content"> 
    		<?php
			$ok = 1;
			
			if(isset($_POST['buzzler_claim_listing']))
			{
				$your_name = trim($_POST['your_name']);
				$your_phone = trim($_POST['your_phone']);
				$description = trim($_POST['description']);
				
				if(empty($your_name)) { $ok = 0; $err['name'] = __('Your name cannot be emtpy.','Buzzler'); }
				if(empty($your_phone)) { $ok = 0; $err['your_phone'] = __('Your phone number cannot be emtpy.','Buzzler'); }
				if(empty($description)) { $ok = 0; $err['description'] = __('Your description cannot be empty.','Buzzler'); }
				
				if($ok == 1)
				{
					$tm = current_time('timestamp',0);
			 		$ss = "insert into ".$wpdb->prefix."buzzler_claims (datemade, your_name, uid, pid, your_phone, description) values('$tm', '$your_name','$uid','$pid','$your_phone','$description')";
					$wpdb->query($ss);
					
					echo '<div class="claim_listing_response">'.__('Your request has been sent, and you will be contacted soon.','Buzzler') . "</div>";
				
				}
            	
			}
			 	if($ok == 0)
				{
						echo '<div class="errrs">';
						
							foreach($err as $e)		
							echo '<div class="newad_error">'.$e. '</div>';	
					
						echo '</div>';
				
				}
			
			
			
				$ss = "select * from ".$wpdb->prefix."buzzler_claims where uid='$uid' AND pid='$pid'";
				$r = $wpdb->get_results($ss);
				
				if(count($r) == 0)
				{
					
			?>
    				<form method="post">  
                        <ul class="post-new">
                            <li>
                                <h2><?php echo __('Your name:', 'Buzzler'); ?></h2>
                                <p><input type="text" size="50" class="do_input" name="your_name" value="<?php echo $_POST['your_name']; ?>" /></p>
                            </li>
                    
                    
                    		<li>
                                <h2><?php echo __('Your phone:', 'Buzzler'); ?></h2>
                                <p><input type="text" size="50" class="do_input" name="your_phone" value="<?php echo $_POST['your_phone']; ?>" /></p>
                            </li>
                    
                    		
                            <li>
        	<h2><?php echo __('Describe your role:', 'Buzzler'); ?></h2>
        <p><textarea rows="6" cols="60" class="do_input"  name="description"><?php echo   $_POST['description']; ?></textarea> 
        </p>
        </li>
        
        <li>
        <h2>&nbsp;</h2>
        <p> <input type="submit" name="buzzler_claim_listing" value="<?php _e("Submit Claim", 'Buzzler'); ?> >>" /></p>
        </li>
                    
                    
                    		</ul>
                    </form>    
                       
                       <?php } elseif(!isset($_POST['buzzler_claim_listing'])) {
						   			
						   
						  echo '<div class="claim_listing_response">'.__('Your request has been sent, and you will be contacted soon.','Buzzler') . "</div>"; 
						   
					   }
						   ?> 
           
                
                </div>
                </div>
        </div>
    
    <?php	
	
}

?>