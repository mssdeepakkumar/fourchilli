<?php

if($_POST['status'] > -1)
{
		
		$c  	= $_POST['field1'];
		$c 		= explode('|',$c);
		
		$uid				= $c[0];
		$datemade 			= $c[1];		
		
		//---------------------------------------------------

		$amount = $_POST['amount'];
		
		$op = get_option('Walleto_deposit_'.$uid.$datemade);
	
	
		if($op != "1")
		{
			$mc_gross = $amount;
			
			$cr = Walleto_get_credits($uid);
			Walleto_update_credits($uid,$mc_gross + $cr);
			
			update_option('Walleto_deposit_'.$uid.$datemade, "1");
			$reason = __("Deposit through Moneybookers.","Walleto"); 
			Walleto_add_history_log('1', $reason, $mc_gross, $uid);
		
			$user = get_userdata($uid);
		
			//--------------------------------
			// send emails to admin and user
			
			$message = "The user ".$user->user_login." has just deposited ".$mc_gross." ".Walleto_currency()." into his account.";
		//	sitemile_send_email(get_bloginfo('admin_email'), __('Money received on your site: Deposit','Walleto') , $message);
			
			//-------
			
			$message = "You have just deposited ".$mc_gross." ".Walleto_currency()." into your account.";
		//	sitemile_send_email($user->user_email, __('Money deposit completed.','Walleto') , $message);
			
			//-------------------------------
		
		}
		
 
}
	
?>