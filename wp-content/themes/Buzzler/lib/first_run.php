<?php
/****************************************************************************************
*
*	Buzzler - WP Business Directory Theme - v1.0
*	SiteMile.com - author: andreisaioc
*	Author email: andreisaioc[at]gmail.com
*	Link: http://sitemile.com/p/buzzler/
*
*****************************************************************************************/

global $pagenow;
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) 
{

	global $wpdb;
	
	update_option('Buzzler_right_side_footer', '<a title="WordPress Business Directory Theme" href="http://sitemile.com/products/buzzler-business-directory-theme/">Business Directory Software</a>');
	update_option('Buzzler_left_side_footer', 	'Copyright (c) '.get_bloginfo('name'));	
	update_option('Buzzler_currency', 			'USD');	
	update_option('Buzzler_currency_symbol', 	'$');	

	//------------------------------
	
	Buzzler_insert_pages('Buzzler_all_locs_id', 					'Show All Locations', 			'[buzzler_theme_show_all_locations]' );
	Buzzler_insert_pages('Buzzler_all_cats_id', 					'Show All Categories', 			'[buzzler_theme_show_all_categories]' );
	
	Buzzler_insert_pages('Buzzler_listing_map_id', 					'Listings Map', 				'[buzzler_theme_listings_map]' );
	
	
	Buzzler_insert_pages('Buzzler_blog_page_id', 					'Blog Posts', 					'[buzzler_theme_blog_posts]' );
	//Buzzler_insert_pages('Buzzler_adv_search_id', 					'Advanced Search', 				'[buzzler_theme_adv_search]' );
	Buzzler_insert_pages('Buzzler_post_new_page_id', 				'Post New Listing', 			'[buzzler_theme_post_new]' );
	Buzzler_insert_pages('Buzzler_my_account_page_id', 				'My Account', 					'[buzzler_theme_my_account]' );
	Buzzler_insert_pages('Buzzler_claim_listing_page_id', 			'Claim Listing', 					'[buzzler_claim_listing]' );
	Buzzler_insert_pages('Buzzler_my_account_personal_info_page_id','Personal Information', 		'[buzzler_theme_my_account_personal_info]', get_option('Buzzler_my_account_page_id') );
	Buzzler_insert_pages('Buzzler_my_account_watch_list_page_id',	'Watch List', 					'[buzzler_theme_my_account_watch_list]', get_option('Buzzler_my_account_page_id') );
	Buzzler_insert_pages('Buzzler_my_account_reviews_page_id',		'My Reviews', 					'[buzzler_theme_my_account_reviews]', get_option('Buzzler_my_account_page_id') );
	Buzzler_insert_pages('Buzzler_my_account_all_listings_page_id',	'Live Listings', 				'[buzzler_theme_my_account_listings]', get_option('Buzzler_my_account_page_id') );
	Buzzler_insert_pages('Buzzler_my_account_all_pending_page_id',	'Pending Listings', 				'[buzzler_theme_my_account_pending_listings]', get_option('Buzzler_my_account_page_id') );
	Buzzler_insert_pages('Buzzler_my_account_exp_listings_page_id',	'Expired Listings', 			'[buzzler_theme_my_account_exp_listings]', get_option('Buzzler_my_account_page_id') );
	
	//-------------------------------
	
	 $ss = " CREATE TABLE `".$wpdb->prefix."buzzler_watchlist` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` BIGINT NOT NULL DEFAULT '0',
					`pid` BIGINT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
	
	
	$ss = " CREATE TABLE `".$wpdb->prefix."buzzler_claims` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` BIGINT NOT NULL DEFAULT '0',
					`pid` BIGINT NOT NULL DEFAULT '0',
					`your_name` VARCHAR( 255 ) NOT NULL ,
					`your_phone` VARCHAR( 255 ) NOT NULL 
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."buzzler_claims` ADD  `description` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ;";
	$wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."buzzler_claims` ADD  `my_status` INT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."buzzler_claims` ADD  `datemade` BIGINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	//----------------------------------
	
	 		$ss = " CREATE TABLE `".$wpdb->prefix."buzzler_custom_fields` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`name` VARCHAR( 255 ) NOT NULL ,
					`tp` VARCHAR( 48 ) NOT NULL ,
					`ordr` INT NOT NULL ,
					`cate` VARCHAR( 255 ) NOT NULL ,
					`pause` INT NOT NULL DEFAULT '1'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 
		//-------------------	 
			 $ss = " CREATE TABLE `".$wpdb->prefix."buzzler_custom_options` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`valval` VARCHAR( 255 ) NOT NULL ,
					`ordr` INT( 11 ) NOT NULL ,
					`custid` INT NOT NULL
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 

			
		//----------------------------
		
			$ss = " CREATE TABLE `".$wpdb->prefix."buzzler_custom_relations` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`custid` BIGINT NOT NULL ,
					`catid` BIGINT NOT NULL
					) ENGINE = MYISAM ";
			$wpdb->query($ss);
		
		//-----------------------------
		
		$ss = "ALTER TABLE `".$wpdb->prefix."buzzler_custom_fields` ADD  `description` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ;";
		$wpdb->query($ss);
		
}


?>