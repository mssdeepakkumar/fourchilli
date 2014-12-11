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

	$opt = get_option('Walleto_new_emails_101_12');
	if(empty($opt)):
		
		update_option('Walleto_new_emails_101_12', 'DonE');
		
		update_option('Walleto_new_user_email_subject', 'Welcome to ##your_site_name##');
		update_option('Walleto_new_user_email_message', 'Hello ##username##,'.PHP_EOL.PHP_EOL.
																'Welcome to our website.'.PHP_EOL.
																'Your username: ##username##'.PHP_EOL.
																'Your password: ##user_password##'.PHP_EOL.PHP_EOL.
																'Login here: ##site_login_url##'.PHP_EOL.PHP_EOL.
																'Thank you,'.PHP_EOL.
																'##your_site_name## Team');
	
		//-----------------------------------------------------------------------------------------------------------
		
		update_option('Walleto_new_user_email_admin_subject', 'New user registration on your site');
		update_option('Walleto_new_user_email_admin_message', 'Hello admin,'.PHP_EOL.PHP_EOL.
																	'A new user has been registered on your website.'.PHP_EOL.
																	'See the details below:'.PHP_EOL.PHP_EOL.
																	'Username: ##username##'.PHP_EOL.
																	'Email: ##user_email##');
																	
		//------------------------------------------------------------------------------------------------------------
		
		update_option('Walleto_new_item_email_not_approve_admin_subject', 'New item posted: ##item_name##');
		update_option('Walleto_new_item_email_not_approve_admin_message', 'Hello admin,'.PHP_EOL.PHP_EOL.
																				'The user ##username## has posted a new item on your website.'.PHP_EOL.
																				'The item name: [##item_name##]'.PHP_EOL.
																				'The item was automatically approved on your website.'.PHP_EOL.PHP_EOL.																				
																				'View the item here: ##item_link##'.PHP_EOL.PHP_EOL.																				
																				'Thank you,'.PHP_EOL.
																				'##your_site_name## Team');
		
		//------------------------------------------------------------------------------------------------------------
		
		update_option('Walleto_new_item_email_approve_admin_subject', 'New item posted. Must approve ##item_name##');
		update_option('Walleto_new_item_email_approve_admin_message', 'Hello admin,'.PHP_EOL.PHP_EOL.
																			'The user ##username## has posted a new item on your website.'.PHP_EOL.
																			'The item name: <b>##item_name##</b> '.PHP_EOL.
																			'The item is not automatically approved so you have to manually approve the item before it appears on your website.'.PHP_EOL.PHP_EOL.																			
																			'You can approve the item by going to your admin dashboard in your website'.PHP_EOL.
																			'Go here: ##your_site_url##/wp-admin');
		
		//------------------------------------------------------------------------------------------------------------
		
		update_option('Walleto_new_item_email_not_approved_subject', 'Your new item posted, but not yet approved: ##item_name##');
		update_option('Walleto_new_item_email_not_approved_message', 'Hello ##username##,'.PHP_EOL.PHP_EOL.																			
																			'Your item <b>##item_name##</b> has been posted on the website. However it is not live yet.'.PHP_EOL.
																			'The item needs to be approved by the admin before it goes live. '.PHP_EOL.
																			'You will be notified by email when the item is active and published.'.PHP_EOL.PHP_EOL.																			
																			'After is approved the item will appear here: ##item_link##'.PHP_EOL.PHP_EOL.																			
																			'Thank you,'.PHP_EOL.
																			'##your_site_name## Team');
																			
		//--------------------------------------------------------------------------------------------------------------
		
		update_option('Walleto_new_item_email_approved_subject', 'Your new item posted, and approved: ##item_name##');
		update_option('Walleto_new_item_email_approved_message', 'Hello ##username##,'.PHP_EOL.PHP_EOL.
																				'Your item <b>##item_name##</b> has been posted on the website.'.PHP_EOL.
																				'The item is live and you can see it here: ##item_link##'.PHP_EOL.
																				'Also you can check your item offers here: ##my_account_url##'.PHP_EOL.PHP_EOL.																				
																				'Thank you,'.PHP_EOL.
																				'##your_site_name## Team');
																				
		//--------------------------------------------------------------------------------------------------------------
		
		update_option('Walleto_priv_mess_received_email_subject', 'Your have received a private message from user: ##sender_username##.');
		update_option('Walleto_priv_mess_received_email_message', 'Hello ##receiver_username##,'.PHP_EOL.PHP_EOL.
																				'You have received a private message from <b>##sender_username##</b>'.PHP_EOL.
																				'To read it, just login to your account: ##my_account_url##'.PHP_EOL.PHP_EOL.
																					
																				'Thank you,'.PHP_EOL.
																				'##your_site_name## Team');
		
		endif;

?>