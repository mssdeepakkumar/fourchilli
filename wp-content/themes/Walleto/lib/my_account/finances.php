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


if(!function_exists('Walleto_my_account_display_finances_page'))
{
function Walleto_my_account_display_finances_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
<div id="content">

<?php
			
			$pg = $_GET['pg'];
			if(!isset($pg)) $pg = 'home';
			
			
			
			if($pg == 'home'):
			
			?>

			<div class="my_box3">            
            <div class="box_title my_account_title"><?php _e("My Finances",'Walleto'); ?></div>
            <div class="box_content">   
        
			 
			 <?php
				$bal = walleto_get_credits($uid);
				echo '<span class="balance">'.__("Your Current Balance is", "Walleto").": ".walleto_get_show_price($bal)."</span>"; 
				
				
				 
			
			?>

			</div>
			</div>
			
			<div class="clear10"></div>
            
            
            
            <div class="my_box3">            
            <div class="box_title my_account_title"><?php _e("What do you want to do",'Walleto'); ?></div>
            <div class="box_content">   
            
                <a href="<?php echo Walleto_get_payments_page_url('deposit'); ?>" 			class="green_btn"><?php _e('Deposit Money','Walleto'); ?></a>  
                <a href="<?php echo Walleto_get_payments_page_url('makepayment'); ?>" 		class="green_btn"><?php _e('Make Payment','Walleto'); ?></a> 
                <a href="<?php echo Walleto_get_payments_page_url('withdraw'); ?>" 		class="green_btn"><?php _e('Withdraw Money','Walleto'); ?></a>  
                <a href="<?php echo Walleto_get_payments_page_url('transactions'); ?>" 	class="green_btn"><?php _e('Transactions','Walleto'); ?></a>

			</div>
			</div>
			
			<div class="clear10"></div>
            
            
            
            <div class="my_box3">            
            <div class="box_title my_account_title"><?php _e("Pending Withdrawals",'Walleto'); ?></div>
            <div class="box_content">   
            
             
             <?php
				
					global $wpdb;
					
					//----------------
				
					$s = "select * from ".$wpdb->prefix."walleto_withdraw where done='0' AND uid='$uid' order by id desc";
					$r = $wpdb->get_results($s);
					
					if(count($r) == 0) echo __('No withdrawals pending yet.','Walleto');
					else
					{
						echo '<table width="100%">';
						foreach($r as $row) // = mysql_fetch_object($r))
						{

							
							echo '<tr>';
							echo '<td>'.date('d-M-Y H:i:s', $row->datemade).'</td>';
							echo '<td>'.walleto_get_show_price($row->amount).'</td>';
							echo '<td>'.$row->methods .'</td>';
							echo '<td>'.$row->payeremail .'</td>';
							echo '<td><a href="'.walleto_get_payments_page_url('closewithdrawal', $row->id) .'"
							class="green_btn">'.__('Close Request','Walleto'). '</a></td>';
							echo '</tr>';
							
							
						}
						echo '</table>';
						
					}
				
				?>
             
			</div>
			</div>
			
			<div class="clear10"></div>
            
            <?php /*
            <div class="my_box3">            
            <div class="box_title my_account_title"><?php _e("Pending Incoming Payments",'Walleto'); ?></div>
            <div class="box_content">   
            
             <?php
				
					$s = "select * from ".$wpdb->prefix."walleto_escrow where released='0' AND toid='$uid' order by id desc";
					$r = $wpdb->get_results($s);
					
					if(count($r) == 0) echo __('No incoming payments pending yet.','Walleto');
					else
					{
						echo '<table width="100%">';
						foreach($r as $row) // = mysql_fetch_object($r))
						{
							$post = get_post($row->pid);
							$from = get_userdata($row->fromid);
							
							echo '<tr>';
							echo '<td><a href="'.walleto_get_user_profile_link($from->ID).'">'.$from->user_login.'</a></td>';
							echo '<td><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></td>';
							echo '<td>'.date('d-M-Y H:i:s', $row->datemade).'</td>';
							echo '<td>'.walleto_get_show_price($row->amount).'</td>';
							
							echo '</tr>';
							
							
						}
						echo '</table>';
						
					}
				
				?>
                
			</div>
			</div>
			
			<div class="clear10"></div>
			
			
            <div class="my_box3">            
            <div class="box_title my_account_title"><?php _e("Pending Outgoing Payments",'Walleto'); ?></div>
            <div class="box_content">   
            
             <?php
				
					$s = "select * from ".$wpdb->prefix."walleto_escrow where released='0' AND fromid='$uid' order by id desc";
					$r = $wpdb->get_results($s);
					
					if(count($r) == 0) echo __('No outgoing payments pending yet.','Walleto');
					else
					{
						echo '<table width="100%">';
						
						echo '<tr>';
							echo '<td><b>'.__('User','Walleto').'</b></td>';
							echo '<td><b>'.__('Order','Walleto').'</b></td>';
							echo '<td><b>'.__('Date','Walleto').'</b></td>';
							echo '<td><b>'.__('Amount','Walleto').'</b></td>';
							echo '<td><b>'.__('Options','Walleto').'</b></td>';
							
							echo '</tr>';
							
						
						foreach($r as $row) // = mysql_fetch_object($r))
						{
							$post = get_post($row->pid);
							$from = get_userdata($row->toid);
							
							echo '<tr>';
							echo '<td><a href="'.walleto_get_user_profile_link($from->ID).'">'.$from->user_login.'</a></td>';
							echo '<td><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></td>';
							echo '<td>'.date_i18n('d-M-Y H:i:s', $row->datemade).'</td>';
							echo '<td>'.walleto_get_show_price($row->amount).'</td>';
							echo '<td><a href="'.walleto_get_payments_page_url('releasepayment', $row->id).'"
							class="green_btn">'.__('Release Payment','Walleto').'</a></td>';
							
							echo '</tr>';
							
							
						}
						echo '</table>';
						
					}
				
				?>
                
			</div>
			</div>
			
			<div class="clear10"></div> */ ?>
            
            
		 <?php    
            elseif($pg == 'withdraw'):	
			
		?>
			
			   <div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Request Withdrawal","Walleto"); ?></div>
            	<div class="box_content">

                
                
                <?php
						
				$bal = Walleto_get_credits($uid);
				echo '<span class="balance">';
				printf(__('Your Current Balance is: %s','Walleto'), Walleto_get_show_price($bal)); 
				echo "</span><br/><br/>"; 
				
				if(isset($_POST['withdraw']))
				{
					$amount 	= $_POST['amount'];
					$paypal 	= $_POST['paypal'];
					$methods 	= $_POST['methods'];
					
					if(!is_numeric($amount) || $amount < 0)
					{
						echo '<span class="newproduct_error">'.__('Provide a well formated amount.','Walleto').'</span>';
							
					}
					else if(walleto_isValidEmail($paypal) == false && $methods != "Bank")
					{
						echo '<span class="newproduct_error">'.__('Invalid email provided.','Walleto').'</span>';	
					}
					else
					{
						$min = get_option('product_theme_min_withdraw');
						if(empty($min)) $min = 50;
					
						if($bal < $amount) 
						{
							echo '<span class="newproduct_error">'.__('Your balance is smaller than the amount requested.','Walleto').'</span>';
						}
						else if($amount < $min)
						{
							echo '<span class="newproduct_error">'.sprintf(__('The amount should not be less than %s','Walleto'),
							Walleto_get_show_price($min,2)).'.</span>';
						}
						else
						{
							
							if($methods == "Bank") $paypal = get_user_meta($uid, 'bank_details', true);
							
							$tm = current_time('timestamp',0); global $wpdb;
							$s = "insert into ".$wpdb->prefix."walleto_withdraw (payeremail, methods, amount, datemade, uid) 
							values('$paypal', '$methods','$amount','$tm','$uid')";
							$wpdb->query($s);
							
							$cr = Walleto_get_credits($uid);
							Walleto_update_credits($uid, $cr - $amount);
							
							//-----------------------
							$email 		= get_bloginfo('admin_email');
							$site_name 	= get_bloginfo('name');
							
							$usr = get_userdata($uid);
							
							$subject = __("Money Withdraw Requested","Walleto");
							$message = sprintf(__("You have requested a new withdrawal of: %s","Walleto"), $amount." ".Walleto_currency());
	
							//sitemile_send_email($usr->user_email, $subject , $message);
							
							//-----------------------
							
							echo '<span class="balance">'.__('Your request has been queued. Redirecting...','Walleto').'</span>';
							$url_redir = Walleto_get_payments_link();
							echo '<meta http-equiv="refresh" content="2;url='.$url_redir.'" />';
						}
						
					}
					
				}
				
				global $current_user;
				get_currentuserinfo();
				$uid = $current_user->ID;
				
					
					$opt = get_option('Walleto_paypal_enable');					
					if($opt == "yes"):
					
				?>
    				<br /><br />
                    <table>
                    <form method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" value="PayPal" name="methods" />
                    <tr>
                    <td><?php echo __("Withdraw amount","Walleto"); ?>:</td>
                    <td> <input value="<?php echo $_POST['amount']; ?>" type="text" 
                    size="10" name="amount" /> <?php echo Walleto_currency(); ?></td>
                    </tr>
                    <tr>
                    <td><?php echo __("PayPal Email","Walleto"); ?>:</td>
                    <td><input value="<?php echo get_user_meta($uid, 'paypal_email',true); ?>" type="text" size="30" name="paypal" /></td>
                    </tr>
                    
                    <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="withdraw" value="<?php echo __("Withdraw","Walleto"); ?>" /></td></tr></form></table>
    			<?php endif; 
				
				
					$opt = get_option('Walleto_paypal_enable');					
					if($opt == "yes"):
					
				?>
    				<br /><br />
                    <table>
                    <form method="post" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" value="Bank" name="methods" />
                    <tr>
                    <td><?php echo __("Withdraw amount(bank)","Walleto"); ?>:</td>
                    <td> <input value="<?php echo $_POST['amount']; ?>" type="text" 
                    size="10" name="amount" /> <?php echo Walleto_currency(); ?></td>
                    </tr>
                   
                   
                    <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="withdraw" value="<?php echo __("Withdraw","Walleto"); ?>" /></td></tr></form></table>
    			<?php endif; ?>
                
                
     
            </div>

            </div>
            
        <?php    
            elseif($pg == 'deposit'):	
			
			
			global $am_err;
			
			if($am_err == 1)
			{
				echo '<div class="errrs3">'.__('Please input a proper amount.','Walleto').'</div>';	
				
			}
			
			
		?>
        
        
    
        <div class="my_box3">
 
            
            	<div class="box_title my_account_title"><?php _e('Deposit Money','Walleto'); ?></div>
            	<div class="box_content">
                <div class="padd10">
                <?php				
				$opt = get_option('Walleto_offline_payments');
				if($opt =="yes"):				
				?>
                
               <strong><?php _e('Deposit money by Bank','Walleto'); ?></strong><br/><br/>
                
               <?php echo sprintf(__('Bank Details: %s','Walleto'), get_option('Walleto_offline_payment_dets')); ?>
               
               <br/><br/>
                
                
                <?php endif; ?>
                
                  <?php				
				$opt = get_option('Walleto_paypal_enable');
				if($opt =="yes"):				
				?>
                
                <strong><?php _e('Deposit money by PayPal','Walleto'); ?></strong><br/><br/>
                
                <form method="post">
                <?php _e('Amount to deposit:','Walleto') ?> <input type="text" size="10" name="amount" /> <?php echo Walleto_currency(); ?>
                &nbsp; &nbsp; <input type="submit" name="deposit_pay_me" value="<?php _e('Deposit','Walleto'); ?>" /></form>
    
   				 <?php endif; ?>
                 
                 
                 
                 <?php				
				$opt = get_option('Walleto_moneybookers_enable');
				if($opt =="yes"):				
				?>
                <br/><br/>
                <strong><?php _e('Deposit money by Skrill','Walleto'); ?></strong><br/><br/>
                
                <form method="post">
                <?php _e('Amount to deposit:','Walleto') ?> <input type="text" size="10" name="amount" /> <?php echo Walleto_currency(); ?>
                &nbsp; &nbsp; <input type="submit" name="deposit_pay_moneybookers" value="<?php _e('Deposit','Walleto'); ?>" /></form>
    
   				 <?php endif; ?>
	
	
	<?php
	
	do_action('Walleto_dposit_fields_page')
	
	
	?>
                  
                </div> 
            </div>
            </div>
        
        <?php    
            elseif($pg == 'transactions'):	
			
		?>	
		
        		
            <div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e('Payment Transactions','Walleto'); ?> </div>
            	<div class="box_content">
              
                
                <?php
					global $wpdb;
					$s = "select * from ".$wpdb->prefix."walleto_payment_transactions where uid='$uid' order by id desc";
					$r = $wpdb->get_results($s);
					
					if(count($r) == 0) echo __('No activity yet.','Walleto');
					else
					{
						$i = 0;
						echo '<table width="100%" cellpadding="5">';
						foreach($r as $row) // = mysql_fetch_object($r))
						{
							if($row->tp == 0){ $class="redred"; $sign = "-"; }
							else { $class="greengreen"; $sign = "+"; }
							
							echo '<tr style="background:'.($i%2 ? "#f2f2f2" : "#f9f9f9").'" >';
							echo '<td>'.$row->reason.'</td>';
							echo '<td width="25%">'.date('d-M-Y H:i:s',$row->datemade).'</td>';
							echo '<td width="20%" class="'.$class.'"><b>'.$sign.Walleto_get_show_price($row->amount).'</b></td>';
							
							echo '</tr>';
							$i++;
						}
						
						echo '</table>';
						
						
					}
				
				?>
    
               
            </div>
            </div>
         <?php
			elseif($pg == 'makepayment'):
		?>
        
          <div class="my_box3">
            
            	<div class="box_title my_account_title"><?php echo __("Make Payment","Walleto"); ?></div>
            	<div class="box_content">
 
                
                
                <?php
						
				$bal = Walleto_get_credits($uid);
				
				
				if(isset($_POST['payme']))
				{
					$amount 	= $_POST['amount'];
					$username 	= $_POST['username'];
					
					if(!is_numeric($amount) || $amount < 0)
					{
						echo '<div class="newproduct_error">'.__('Provide a well formated amount.','Walleto').'</div><br/>';
							
					}
					else if(Walleto_username_is_valid($username) == false)
					{
						echo '<div class="newproduct_error">'.__('Invalid username provided.','Walleto').'</div><br/>'; 	
					}
					
					else if($username == $current_user->user_login)
					{
						echo '<div class="newproduct_error">'.__('You cannot transfer money to your own account.','Walleto').'</div><br/>';	
					}
					else
					{
						$min = get_option('auction_theme_transfer_limit');
						if(empty($min)) $min = 20;
					
						if($bal < $amount) 
						{
							echo '<div class="newproduct_error">'.__('Your balance is smaller than the amount requested.','Walleto').'</div><br/>';
						}
						else if($amount < 10)
						{
							echo '<div class="newproduct_error">'.__('The amount should not be less than','Walleto').' 10.00 '.Walleto_currency().'.</div>
							<br/><br/>';
						}
						else
						{
							$tm = current_time('timestamp',0);
							$uid2 = Walleto_get_userid_from_username($username);
							
							// for logged in user, the user who sends
							//======================================================
							$cr = Walleto_get_credits($uid);
							Walleto_update_credits($uid, $cr - $amount);
											
							//-----------------------
							$email 		= get_bloginfo('admin_email');
							$site_name 	= get_bloginfo('name');
							
							$usr = get_userdata($uid);
							
							$subject = __("Money Sent","Walleto");
							$message = sprintf(__("You have sent amount of: %s %s to user: <b>%s</b>","Walleto")
							,$amount,Walleto_currency(),$username);
	
							//sitemile_send_email($usr->user_email, $subject , $message);
							
							$reason = sprintf(__("Amount transfered to user %s","Walleto"),$username);
							Walleto_add_history_log('0', $reason, $amount, $uid, $uid2);
							
							//======================================================
							
							// for other user, the user who receives
							//======================================================
							
							$cr = Walleto_get_credits($uid2);
							Walleto_update_credits($uid2, $cr + $amount);
											
												
							$usr2 = get_userdata($uid2);
							
							$subject = __("Money Received","Walleto");
							$message = sprintf(__("You have received amount of: %s %s from user: <b>%s</b>","Walleto"),
							$amount,Walleto_currency(),$usr->user_login);
	
							//sitemile_send_email($usr2->user_email, $subject , $message);
							
							$reason = sprintf(__("Amount transfered from user %s","Walleto"), $usr->user_login);
							Walleto_add_history_log('1', $reason, $amount, $uid2, $uid);
							
							//======================================================
							
							echo '<span class="balance">'.__('Your payment has been sent. Redirecting...','Walleto').'</span>';
							$url_redir = Walleto_get_payments_link();
							echo '<meta http-equiv="refresh" content="2;url='.$url_redir.'" />';
						}
						
					}
					
				}
				
				
				$bal = Walleto_get_credits($uid);
				echo '<span class="balance">'. sprintf(__("Your Current Balance is %s","Walleto"), Walleto_get_show_price($bal)).":</span><br/><br/>"; 
				
				?>
    				<br /><br />
                    <table>
                    <form method="post" enctype="application/x-www-form-urlencoded">
                    <tr>
                    <td><?php echo __("Payment amount","Walleto"); ?>:</td>
                    <td> <input value="<?php echo $_POST['amount']; ?>" type="text" 
                    size="10" name="amount" /> <?php echo Walleto_currency(); ?></td>
                    </tr>
                    <tr>
                    <td><?php echo __("Pay to user","Walleto"); ?>:</td>
                    <td><input value="<?php echo $_POST['username']; ?>" type="text" size="30" name="username" /></td>
                    </tr>
                    
                    <tr>
                    <td></td>
                    <td>
                    <input type="submit" name="payme" value="<?php echo __("Make Payment","Walleto"); ?>" /></td></tr></form></table>
    
                  
               
            </div>
            </div> 
        
        
        	
		<?php endif; ?>  
			
		</div> <!-- end div content -->


<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>