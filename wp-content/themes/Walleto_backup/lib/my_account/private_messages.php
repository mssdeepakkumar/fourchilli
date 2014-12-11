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


if(!function_exists('Walleto_my_account_display_priv_mess_page'))
{
function Walleto_my_account_display_priv_mess_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
		global $wpdb,$wp_rewrite,$wp_query;
		$third_page = $_GET['priv_act'];
		
		if(empty($third_page)) $third_page = 'home';

		
		$using_perm = Walleto_using_permalinks();
	
		if($using_perm)	$privurl_m = get_permalink(get_option('Walleto_my_account_priv_mess_page_id')). "?";
		else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('Walleto_my_account_priv_mess_page_id'). "&";	
	
?>	
  <div id="content">
    <div class="my_box3">
 
                <a href="<?php echo $privurl_m; ?>" class="green_btn"><?php _e("Messaging Home","Walleto"); ?></a>
                <a href="<?php echo $privurl_m; ?>priv_act=send" class="green_btn"><?php _e("Send New Message","Walleto"); ?></a>
                <a href="<?php echo $privurl_m; ?>priv_act=inbox" class="green_btn"><?php _e("Inbox","Walleto");
				
				global $current_user;
				get_currentuserinfo();
				$rd = Walleto_get_unread_number_messages($current_user->ID);
				if($rd > 0) echo ' ('.$rd.')';
				
				 ?></a>
                <a href="<?php echo $privurl_m; ?>priv_act=sent-items" class="green_btn"><?php _e("Sent Items","Walleto"); ?></a>
                
             
        </div>
        <div class="clear10"></div>
        <?php
		
			if($third_page == 'home') {
		
			global $current_user;
			get_currentuserinfo();
			$myuid = $current_user->ID;
		
		?>        
        
		<!-- page content here -->	
			
            
            	
            	<div class="my_box3">
 
            
            	<div class="box_title my_account_title"><?php _e("Latest Received Messages","Walleto"); ?></div>
                <div class="box_content">  
                <?php
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."walleto_pm where user='$myuid' AND show_to_destination='1' order by id desc limit 4";
				$r = $wpdb->get_results($s);
				
				if(count($r) > 0)
				{
					echo '<table width="100%">';
					
					echo '<tr>';
						echo '<td>'.__('From User','Walleto').'</td>';
						echo '<td>'.__('Subject','Walleto').'</td>';						
						echo '<td>'.__('Date','Walleto').'</td>';
						echo '<td>'.__('Options','Walleto').'</td>';
						echo '</tr>';
					
					
					
					foreach($r as $row)
					{
						if($row->rd == 0) $cls = 'bold_stuff';
						else $cls = '';
					
						$user = get_userdata($row->initiator);
					
						echo '<tr>';
						echo '<td class="'.$cls.'"><a href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';
						echo '<td class="'.$cls.'">'.$row->subject.'</td>';						
						echo '<td class="'.$cls.'">'.date('d-M-Y H:i:s',$row->datemade).'</td>';
						echo '<td><a href="'.$privurl_m.'priv_act=read-message&id='.$row->id.'">'.__('Read','Walleto').'</a> | 
						<a href="'.$privurl_m.'return=home&priv_act=delete-message&id='.$row->id.'">'.__('Delete','Walleto').'</a></td>';
						echo '</tr>';
					
					}
					
					
					echo '</table>';
				} else _e('No messages here.','Walleto');
				
				?>
      
                </div>
                </div>
     
            
            <!--#######-->
            
            <div class="clear10"></div>
            
            	<div class="my_box3">
             
            
            	<div class="box_title my_account_title"><?php _e("Latest Sent Items","Walleto"); ?></div>
                <div class="box_content">  
                <?php
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."walleto_pm where initiator='$myuid' AND show_to_source='1' order by id desc limit 4";
				$r = $wpdb->get_results($s);
				
				if(count($r) > 0)
				{
					echo '<table width="100%">';
					
					echo '<tr>';
						echo '<td>'.__('To User','Walleto').'</td>';
						echo '<td>'.__('Subject','Walleto').'</td>';						
						echo '<td>'.__('Date','Walleto').'</td>';
						echo '<td>'.__('Options','Walleto').'</td>';
						echo '</tr>';
					
					
					
					foreach($r as $row)
					{
						//if($row->rd == 0) $cls = 'bold_stuff';
						//else
						 $cls = '';
					
						$user = get_userdata($row->user);
					
						echo '<tr>';
						echo '<td class="'.$cls.'"><a href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';
						echo '<td class="'.$cls.'">'.$row->subject.'</td>';						
						echo '<td class="'.$cls.'">'.date('d-M-Y H:i:s',$row->datemade).'</td>';
						echo '<td><a href="'.$privurl_m.'priv_act=read-message&id='.$row->id.'">'.__('Read','Walleto').'</a> | 
						<a href="'.$privurl_m.'return=home&priv_act=delete-message&id='.$row->id.'">'.__('Delete','Walleto').'</a></td>';
						echo '</tr>';
					
					}
					
					
					echo '</table>';
				}
				else _e('No messages here.','Walleto');
				?>
      
                </div>
                </div>
  
            
            
		<!-- page content here -->	
			
        <?php }
		
		
			elseif($third_page == 'inbox') {
		
			global $current_user;
			get_currentuserinfo();
			$myuid = $current_user->ID;
			
		?>        
        
		<!-- page content here -->	
			
            
            	<div class="my_box3">
           
            
            	<div class="box_title my_account_title"><?php _e("Private Messages: Inbox","Walleto"); ?></div>
                <div class="box_content">  
                <?php
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."walleto_pm where user='$myuid' AND show_to_destination='1' order by id desc";
				$r = $wpdb->get_results($s);
				
				if(count($r) > 0)
				{
					echo '<table width="100%">';
					
					echo '<tr>';
						echo '<td>'.__('From User','Walleto').'</td>';
						echo '<td>'.__('Subject','Walleto').'</td>';						
						echo '<td>'.__('Date','Walleto').'</td>';
						echo '<td>'.__('Options','Walleto').'</td>';
						echo '</tr>';
					
					
					
					foreach($r as $row)
					{
						if($row->rd == 0) $cls = 'bold_stuff';
						else $cls = '';
					
						$user = get_userdata($row->initiator);
					
						echo '<tr>';
						echo '<td class="'.$cls.'"><a href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';
						echo '<td class="'.$cls.'">'.$row->subject.'</td>';						
						echo '<td class="'.$cls.'">'.date('d-M-Y H:i:s',$row->datemade).'</td>';
						echo '<td><a href="'.$privurl_m.'priv_act=read-message&id='.$row->id.'">'.__('Read','Walleto').'</a> | 
						<a href="'.$privurl_m.'return=inbox&priv_act=delete-message&id='.$row->id.'">'.__('Delete','Walleto').'</a>
						</td>';
						echo '</tr>';
					
					}
					
					
					echo '</table>';
				} else _e('No messages here.','Walleto');
				
				?>
      
                </div>
                </div>
              
            
            
		<!-- page content here -->	
			
        <?php }
		
		elseif($third_page == 'sent-items') {
		
			global $current_user;
			get_currentuserinfo();
			$myuid = $current_user->ID;
			
		?>        
        
		<!-- page content here -->	
			
            
            	<div class="my_box3">
             
            
            	<div class="box_title my_account_title"><?php _e("Private Messages: Sent Items","Walleto"); ?></div>
                <div class="box_content">  
                <?php
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."walleto_pm where initiator='$myuid' AND show_to_source='1' order by id desc";
				$r = $wpdb->get_results($s);
				
				if(count($r) > 0)
				{
					echo '<table width="100%">';
					
					echo '<tr>';
						echo '<td>'.__('To User','Walleto').'</td>';
						echo '<td>'.__('Subject','Walleto').'</td>';						
						echo '<td>'.__('Date','Walleto').'</td>';
						echo '<td>'.__('Options','Walleto').'</td>';
						echo '</tr>';
					
					
					
					foreach($r as $row)
					{
						//if($row->rd == 0) $cls = 'bold_stuff';
						//else 
						$cls = '';
					
						$user = get_userdata($row->user);
					
						echo '<tr>';
						echo '<td class="'.$cls.'"><a href="'.Walleto_get_user_profile_link($user->ID).'">'.$user->user_login.'</a></td>';
						echo '<td class="'.$cls.'">'.$row->subject.'</td>';						
						echo '<td class="'.$cls.'">'.date('d-M-Y H:i:s',$row->datemade).'</td>';
						echo '<td><a href="'.$privurl_m.'priv_act=read-message&id='.$row->id.'">'.__('Read','Walleto').'</a> |  
						<a href="'.$privurl_m.'return=outbox&priv_act=delete-message&id='.$row->id.'">'.__('Delete','Walleto').'</a></td>';
						echo '</tr>';
					
					}
					
					
					echo '</table>';
				}
				else _e('No messages here.','Walleto');
				?>
      
                </div>
                </div>
               
            
            
		<!-- page content here -->	
			
        <?php }
		
		elseif($third_page == 'read-message') {
		
			global $current_user, $wpdb;
			get_currentuserinfo();
			$myuid = $current_user->ID;
			
			$id = $_GET['id'];
			$s = "select * from ".$wpdb->prefix."walleto_pm where id='$id' AND (user='$myuid' OR initiator='$myuid')";
			$r = $wpdb->get_results($s);
			$row = $r[0];
			
			if($myuid == $row->initiator) $owner = true; else $owner = false;

			if($owner == false)
			{
				//echo "asd";
				$wpdb->query("update ".$wpdb->prefix."walleto_pm set rd='1' where id='".$row->id."'");
			}
	
		?>        
        
		<!-- page content here -->	
			
            
            	<div class="my_box3">
 
            
            	<div class="box_title my_account_title"><?php _e("Read Message: ","Walleto"); echo " ".$row->subject ?></div>
                <div class="box_content">  
                <?php echo $row->content; ?>
      <br/> <br/>
      
      <?php if($owner == false): ?>
       <a href="<?php echo $privurl_m; ?>priv_act=send&<?php
           
			echo 'pid='.$row->pid.'&uid='.$row->initiator;
			
			?>" class="nice_link"><?php _e("Reply",'Walleto'); ?></a> <?php endif; ?>
                </div>
                </div>
             
            
            
		<!-- page content here -->	
			
        <?php }
		
		elseif($third_page == 'delete-message') {
		
			global $current_user, $wpdb;
			get_currentuserinfo();
			$myuid = $current_user->ID;
			
			$id = $_GET['id'];
			$s = "select * from ".$wpdb->prefix."walleto_pm where id='$id' AND (user='$myuid' OR initiator='$myuid')";
			$r = $wpdb->get_results($s);
			$row = $r[0];
			
			if($myuid == $row->initiator) $owner = true; else $owner = false;
			
			
			$owner = false;
			//if(!$owner)
			//$wpdb->query("update ".$wpdb->prefix."walleto_pm set rd='1' where id='{$row->id}'");
			
	
		?>        
        
		<!-- page content here -->	
			
            
            	<div class="my_box3">
             
            
            	<div class="box_title my_account_title"><?php _e("Delete Message: ","Walleto"); echo " ".$row->subject ?></div>
                <div class="box_content">  
                <?php echo $row->content; ?>
      <br/> <br/>
      
      <?php if($owner == false): ?>
       <a href="<?php echo $privurl_m; ?>priv_act=delete-message&<?php
           
			echo 'id='.$row->id.'&return='.$_GET['return']."&confirm_message_deletion=yes";
			
			?>" class="nice_link"><?php _e("Confirm Deletion",'Walleto'); ?></a> <?php endif; ?>
                </div>
                </div>
            
            
            
		<!-- page content here -->	
			
        <?php }
		
		 elseif($third_page == 'send') { ?>
        <?php
		
			$pid = $_GET['pid'];
			$uid = $_GET['uid'];
		
			$user = get_userdata($uid);
		
			if(!empty($pid))
			{
				$post = get_post($pid);
				$subject = "RE: ".$post->post_title;
			}

		
		
			if(isset($_POST['send']))
			{
				$subject = strip_tags(trim($_POST['subject']));
				$message = strip_tags(trim($_POST['message']));
				$to = $_POST['to'];
				
				if(!empty($to))
				{
					$uid = Walleto_get_userid_from_username($to);	
				}
	
				if($uid != false && $current_user->ID != $uid):
				
				global $current_user;
				get_currentuserinfo();
				$myuid = $current_user->ID;
				
				global $wpdb; $tm = current_time('timestamp',0);		
				$s = "insert into ".$wpdb->prefix."walleto_pm (subject, content, datemade, pid, initiator, user) values('$subject','$message','$tm','$pid','$myuid','$uid')";
				//mysql_query($s) or die(mysql_error());		
				 // $wpdb->show_errors     = true;
				$wpdb->query($s);
				//echo $wpdb->last_error;
			//-----------------------
		 
				$user = get_userdata($uid);
				Walleto_send_email_on_priv_mess_received($myuid, $uid)
				
			//-----------------------		
				?>
                
                <div class="my_box3">
            	 
                 <?php _e('Your message has been sent.','Walleto'); ?>
                
                </div>
                
                <?php
				elseif($current_user->ID == $uid): 
				?>
                
                    <div class="error">            	
                 <?php _e('Cant send messsages to yourself','Walleto'); ?>               
                </div>
				
                
                <?php
				else:
				?>
                
                <div class="my_box3">
            	 
                 <?php _e('The message was not sent. The recipient does not exist.','Walleto'); ?>
                 
                </div>
				
				
				<?php
				endif;
			}
			else
			{
		
		
		?>   
             
        <div class="my_box3">
             
            
            	<div class="box_title my_account_title"><?php echo sprintf(__("Send Private Message to: %s","Walleto"), $user->user_login); ?></div>
                <div class="box_content">  
                <form method="post" enctype="application/x-www-form-urlencoded">
                <table>
                <?php if(empty($uid)): ?>
                <tr>
                <td width="140"><?php _e("Send To", "Walleto"); ?>:</td>
                <td><input size="20" name="to" type="text" value="" /></td>
                </tr>
                <?php endif; ?>
                
                <tr>
                <td width="140"><?php _e("Subject", "Walleto"); ?>:</td>
                <td><input size="50" name="subject" type="text" value="<?php echo $subject; ?>" /></td>
                </tr>
                
                <tr>
                <td valign="top"><?php _e("Message", "Walleto"); ?>:</td>
                <td><textarea name="message" rows="6" cols="50"></textarea></td>
                </tr>
                
                 <tr>
                <td width="140">&nbsp;</td>
                <td></td>
                </tr>
                
                 <tr>
                <td width="140">&nbsp;</td>
                <td><input name="send" type="submit" value="<?php _e("Send Message",'Walleto'); ?>" /></td>
                </tr>
                
                </table>
      			</form>
                
              
                </div>
                </div>
        
        
        <?php } } ?>
        
    </div>
    <?php
	
	
	echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>