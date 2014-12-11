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

	global $pagenow;
	if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) 
	{
		global $wpdb;
		
		//-------------------------------------------------------

		update_option('ClassifiedTheme_right_side_footer', '<a title="WordPress Classified Theme" href="http://sitemile.com/products/wordpress-classified-ads-theme">WordPress Classified Theme</a>');
		update_option('ClassifiedTheme_left_side_footer', 'Copyright (c) '.get_bloginfo('name'));
			
		//------------------------------
		
		update_option('ClassifiedTheme_email_name_from', 'ClassifiedTheme');
		update_option('ClassifiedTheme_email_addr_from', 'ClassifiedTheme@wordpress.org');
		
		
		ClassifiedTheme_insert_pages('ClassifiedTheme_all_locations_page_id', 			'All Locations', 			'[classified_theme_all_locations]' );
		ClassifiedTheme_insert_pages('ClassifiedTheme_all_categories_page_id', 			'All Categories', 			'[classified_theme_all_categories]' );
		ClassifiedTheme_insert_pages('ClassifiedTheme_adv_search_page_id', 				'Advanced Search', 			'[classified_theme_adv_search]' );
		
		ClassifiedTheme_insert_pages('ClassifiedTheme_post_new_page_id', 				'Post New Advert', 				'[classified_theme_post_new]' );
		ClassifiedTheme_insert_pages('ClassifiedTheme_all_blog_posts_page_id', 			'Blog Posts', 					'[classified_theme_all_blog_posts]' );
		ClassifiedTheme_insert_pages('ClassifiedTheme_my_account_page_id', 				'My Account', 					'[classified_theme_my_account_home]' );
		ClassifiedTheme_insert_pages('ClassifiedTheme_my_account_personal_info_id', 	'Personal Information', 		'[classified_theme_my_account_personal_info]', 	get_option('ClassifiedTheme_my_account_page_id') );
		ClassifiedTheme_insert_pages('ClassifiedTheme_my_account_active_ads_id', 	'Active Listings', 		'[classified_theme_my_account_act_listings]', 	get_option('ClassifiedTheme_my_account_page_id') );
		ClassifiedTheme_insert_pages('ClassifiedTheme_my_account_expired_ads_id', 	'Expired Listings', 		'[classified_theme_my_account_expired_listings]', 	get_option('ClassifiedTheme_my_account_page_id') );
		ClassifiedTheme_insert_pages('ClassifiedTheme_my_account_unpub_ads_id', 	'Unpublished Listings', 		'[classified_theme_my_account_unpub_listings]', 	get_option('ClassifiedTheme_my_account_page_id') );
		ClassifiedTheme_insert_pages('ClassifiedTheme_my_account_mem_pks_id', 	'Membership Packs', 		'[classified_theme_my_account_mem_pks]', 	get_option('ClassifiedTheme_my_account_page_id') );
		
		//------------------------------
		
		$ss = " CREATE TABLE `".$wpdb->prefix."ad_packs` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`pack_name` VARCHAR( 255 ) NOT NULL ,
					`ads_number` INT NOT NULL ,
					`pack_cost` VARCHAR( 255 ) NOT NULL ,
					`datemade` VARCHAR( 255 ) NOT NULL ,
					`featured_free` INT NOT NULL DEFAULT '0',
					`pause` INT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 
			 
			 $ss = " CREATE TABLE `".$wpdb->prefix."ad_coupons` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`coupon_name` VARCHAR( 255 ) NOT NULL ,
					`coupon_solid_reduction` VARCHAR( 255 ) NOT NULL,
					`coupon_percent_reduction` VARCHAR( 255 ) NOT NULL,
					
					`ending` VARCHAR( 255 ) NOT NULL,
					`coupon_code` VARCHAR( 255 ) NOT NULL ,
					`datemade` VARCHAR( 255 ) NOT NULL ,
					`featured_free` INT NOT NULL DEFAULT '0',
					`pause` INT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 
			//----------------------- 
			 
			 		$ss = " CREATE TABLE `".$wpdb->prefix."ad_custom_fields` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`name` VARCHAR( 255 ) NOT NULL ,
					`tp` VARCHAR( 48 ) NOT NULL ,
					`ordr` INT NOT NULL ,
					`cate` VARCHAR( 255 ) NOT NULL ,
					`pause` INT NOT NULL DEFAULT '1'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 
		//-------------------	 
			 $ss = " CREATE TABLE `".$wpdb->prefix."ad_custom_options` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`valval` VARCHAR( 255 ) NOT NULL ,
					`ordr` INT( 11 ) NOT NULL ,
					`custid` INT NOT NULL
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 

			
		//----------------------------
		
			$ss = " CREATE TABLE `".$wpdb->prefix."ad_custom_relations` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`custid` BIGINT NOT NULL ,
					`catid` BIGINT NOT NULL
					) ENGINE = MYISAM ";
			$wpdb->query($ss);
		
		//-----------------------------
		
			$ss = " CREATE TABLE `".$wpdb->prefix."ad_transactions_new` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`pid` BIGINT NOT NULL ,
					`datemade` INT NOT NULL ,
					`uid` INT NOT NULL ,
					`payment_date` VARCHAR( 255 ) NOT NULL ,
					`transaction_text` TEXT NOT NULL ,
					`paid_amount` VARCHAR( 255 ) NOT NULL ,
					`amount_means` VARCHAR( 255 ) NOT NULL,
					`payment_method` VARCHAR( 255 ) NOT NULL
					) ENGINE = MYISAM ";
			
			$wpdb->query($ss);
		//-------$wpdb->query---------------------
		
	}
	
	$opt = get_option('ClassifiedTheme_upd63331h');
	 
	if(empty($opt))
	{
		
		update_option('ClassifiedTheme_upd63331h','DoneE');		
		ClassifiedTheme_insert_pages('ClassifiedTheme_my_account_purchase_mem_id', 	'Purchase Membership', 		'[classified_theme_my_account_purchase_mem]', 	get_option('ClassifiedTheme_my_account_page_id') );	
				
	}
	
?>