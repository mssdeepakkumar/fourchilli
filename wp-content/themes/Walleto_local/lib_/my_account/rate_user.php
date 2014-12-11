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


		global $wpdb;
		
 		$id = $_GET['rid'];
		$s = "select * from ".$wpdb->prefix."walleto_ratings where id='$id'";
		$result = $wpdb->get_results($s);
		
		$row = $result[0]; 
		$pid = $row->pid;
		$user = get_userdata($row->touser);
		$post_au = get_post($row->pid);
		
 		$my_uid = $row->touser;
		$my_uid2 = $row->fromuser;
 
 	get_header();
 ?> 
 
 
<!--left side bare end-->
<?php   $path = get_template_directory().'/left_sidebar.php';
include($path); ?>

<section id="right_side_banner_main_wrapper">
        	
            <div class="my_box3">
 
            
            	<div class="box_title"><?php printf(__("Review User %s for order #%s",'Walleto'), $user->user_login, $id ) ; ?></div>
                
            	
                <?php
			$nok = 1;
			
			if(isset($_POST['rateme']))
			{
			
				$rating = $_POST['rating'];
				$comment = nl2br(strip_tags($_POST['commenta']));
				
				if(empty($comment)):
					
					$nok = 1;
					
					echo '<div class="error">';
					echo __('Please leave a comment with your review.','Walleto');
					echo '</div>';
					
				else:
					
					$tm = current_time('timestamp',0);
						
					$s = "update ".$wpdb->prefix."walleto_ratings set grade='$rating', datemade='$tm', comment='$comment', awarded='1' where id='$id'";
					$wpdb->query($s);					
						
					$link = get_permalink(get_option('Walleto_my_account_page_id'));	
					printf(__("Your rating has been posted. <a class='red-txt' href='%s'>Return to your account area</a>","Walleto"),$link);
					
					$nok = 0;
					

					Walleto_send_email_when_review_has_been_awarded($id, $my_uid, $my_uid2);
					//---------------------------
					
					$cool_user_rating = get_user_meta($my_uid, 'cool_user_rating', true);
					if(empty($cool_user_rating)) update_user_meta($my_uid, 'cool_user_rating', 0);
					
					//---------------------------
					
					$cool_user_rating = get_user_meta($my_uid, 'cool_user_rating', true);
					
					global $wpdb;
					$s = "select grade from ".$wpdb->prefix."walleto_ratings where touser='$my_uid' AND awarded='1'";
					$r = $wpdb->get_results($s);
					$i = 0; $s = 0;
						
					if(count($r) > 0)
					{
						foreach($r as $row) // = mysql_fetch_object($r))
						{
							$i++;
							$s = $s + $row->grade;
								
						}
	
						$rating2 = round(($s/$i)/2, 2);
						update_user_meta($my_uid, 'cool_user_rating', $rating2);
					
					}
					
					
					//---------------------------
					
				endif;
			}
			
			if($nok == 1)
			{
		
		?>
        <form method="post">	
             	   <ul class="post-new3">
            <li>
        	<h2><?php echo __('Your Rating','Walleto'); ?>:</h2>
        	<p><select class="do_input" name="rating"><?php for($i=5;$i>0;$i--) echo '<option value="'.($i*2).'">'.$i.'</option>'; ?></select></p>
        </li>
        
        <li>
        	<h2><?php echo __('Your Comment','Walleto'); ?>:</h2>
        	<p><textarea name="commenta" class="do_input" rows="5" cols="40" ></textarea></p>
        </li>
        
        
        
           <li>
        	<h2>&nbsp;</h2>
        	<p><input type="submit" name="rateme" value="<?php _e("Submit Rating","Walleto"); ?>"  /></p>
        </li>
        
        
        
        </ul>
         </form> <?php } ?>      
                
                
                              
               
                </div>
           </section>    
           </section>        
	<?php //Walleto_get_users_links(); ?>

<?php get_footer(); ?>
