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


global $pagenow;
if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) 
{

	global $wpdb;
	
	update_option('Walleto_right_side_footer', '<a title="WordPress Marketplace Theme" href="http://sitemile.com/products/walleto-wordpress-marketplace-theme/">Wordpress Marketplace Theme</a>');
	update_option('Walleto_left_side_footer', 'Copyright (c) '.get_bloginfo('name'));		
	
	update_option('Walleto_email_name_from', 				get_bloginfo('name'));
	update_option('Walleto_email_addr_from', 				get_bloginfo('admin_email'));
	update_option('Walleto_nr_max_of_images', 				'8');
	update_option('Walleto_width_of_product_images', 				'850');
	update_option('Walleto_shop_trial_days', 				'30');
	update_option('Walleto_enable_shop_trial', 				'yes');
	
	update_option('Walleto_shop_monthly_fee', 				'1.99');
	update_option('Walleto_shop_yearly_fee', 				'12.99');
	
	
	
	//-----------------------------------
	Walleto_insert_pages('Walleto_all_cats_id', 						'Show All Categories', 			'[walleto_show_all_categories]' );
	
	Walleto_insert_pages('Walleto_blog_home_id', 					'Blog Posts', 				'[walleto_blog_posts]' );
	Walleto_insert_pages('Walleto_watch_list_id', 					'Watch List', 				'[walleto_watch_list]' );
	Walleto_insert_pages('Walleto_adv_search_id', 					'Advanced Search', 			'[walleto_theme_adv_search]' );	
	Walleto_insert_pages('Walleto_post_new_page_id', 				'Sell My Product', 			'[walleto_theme_post_new]' );
	Walleto_insert_pages('Walleto_shops_page_id', 						'Shops', 			'[walleto_theme_shops_page]' );
	
	Walleto_insert_pages('Walleto_shopping_cart_page_id', 				'Shopping Cart', 			'[walleto_theme_shopping_cart]' );
	Walleto_insert_pages('Walleto_checkout_page_id', 				'Checkout', 			'[walleto_theme_checkout_page]' );
	
	walleto_insert_pages('Walleto_my_account_page_id', 				'My Account', 				'[walleto_my_account]' );
	walleto_insert_pages('Walleto_my_account_shop_setup_page_id', 		'My Shop Setup', 		'[walleto_my_account_my_shop_setup]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_pur_mem_page_id', 		'Purchase Membership', 		'[walleto_my_account_purchase_mem]',		get_option('Walleto_my_account_shop_setup_page_id') );
	walleto_insert_pages('Walleto_my_account_pur_mem_crds_page_id', 		'Purchase Membership - Pay by eWallet', 		'[walleto_my_account_purchase_mem_crds]',		get_option('Walleto_my_account_pur_mem_page_id') );
	
	walleto_insert_pages('Walleto_my_account_pay_4_item_page_id', 		'Pay for Item', 		'[walleto_my_account_pay_4_item]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_pay_4_item_virt_page_id', 		'Pay for Item by Virtual Currency', 		'[walleto_my_account_pay_4_item_virt]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_reviews_page_id', 		'Reviews/Feedback', 		'[walleto_my_account_reviews]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_priv_mess_page_id', 	'Private Messages', 		'[walleto_my_account_priv_mess]',	get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_my_finances_page_id', 	'My Finances', 				'[walleto_my_account_finances]',	get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_pers_info_page_id', 	'Personal Info', 			'[walleto_my_account_pers_info]',	get_option('Walleto_my_account_page_id') );
	
	//-----------------------------
	
	walleto_insert_pages('Walleto_my_account_all_orders_page_id', 		'All Orders', 				'[walleto_my_account_all_orders]',			get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_outstanding_pay_page_id', 	'Outstanding Payments', 	'[walleto_my_account_outstand_pay]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_not_shipped_page_id', 		'Not Shipped Orders', 		'[walleto_my_account_not_shipped]',			get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_shipped_cust_page_id', 	'Shipped Orders', 			'[walleto_my_account_shipped_cust]',		get_option('Walleto_my_account_page_id') ); // for buyer
	
	walleto_insert_pages('Walleto_my_account_show_order_cnt_page_id', 	'Order Content', 			'[walleto_my_account_order_cnt_pg]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_show_order_cnt_page_id2', 	'Order Content', 			'[walleto_my_account_order_cnt_pg2]',		get_option('Walleto_my_account_page_id') );
	
	//-----------------------------
	
	walleto_insert_pages('Walleto_my_account_act_items_page_id', 		'Active Items', 			'[walleto_my_account_active_items]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_out_of_stock_page_id', 	'Out of Stock', 			'[walleto_my_account_out_of_stock]',		get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_aw_pay_page_id', 			'Awaiting Payments', 		'[walleto_my_account_aw_pay]',				get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_aw_shp_page_id', 			'Awaiting Shipping', 		'[walleto_my_account_aw_shp]',				get_option('Walleto_my_account_page_id') );
	walleto_insert_pages('Walleto_my_account_shp_ord_page_id', 			'Shipped Orders', 			'[walleto_my_account_shipped_orders]',		get_option('Walleto_my_account_page_id') ); // for seller
	
	
	//-----------------------------
	
	global $wpdb;
	
	$ss = " CREATE TABLE `".$wpdb->prefix."walleto_watchlist` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` BIGINT NOT NULL DEFAULT '0',
					`pid` BIGINT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
	
	$ss = " CREATE TABLE `".$wpdb->prefix."walleto_orders` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` BIGINT NOT NULL DEFAULT '0',
					`datemade` BIGINT NOT NULL DEFAULT '0',
					`totalprice` VARCHAR( 255 ) NOT NULL DEFAULT '0',
					`shipping` VARCHAR( 255 ) NOT NULL DEFAULT '0',
					`paid` INT NOT NULL DEFAULT '0',
					`shipped` INT NOT NULL DEFAULT '0',
					`paid_on` BIGINT NOT NULL DEFAULT '0',
					`shipped_on` BIGINT NOT NULL DEFAULT '0'
						
					) ENGINE = MYISAM ";
	$wpdb->query($ss);
	
	//------------------------------
	
	$ss = " CREATE TABLE `".$wpdb->prefix."walleto_order_contents` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` BIGINT NOT NULL DEFAULT '0',
					`orderid` BIGINT NOT NULL DEFAULT '0',
					`pid` BIGINT NOT NULL DEFAULT '0',
					`datemade` BIGINT NOT NULL DEFAULT '0',
					`price` VARCHAR( 255 ) NOT NULL DEFAULT '0',
					`quant` INT NOT NULL DEFAULT '0'					
					) ENGINE = MYISAM ";
	$wpdb->query($ss);
	
	//------------------------------
	
	$ss = " CREATE TABLE `".$wpdb->prefix."walleto_payment_transactions` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`uid` INT NOT NULL ,
					`reason` TEXT NOT NULL ,
					`datemade` INT NOT NULL ,
					`amount` DOUBLE NOT NULL ,
					`tp` TINYINT NOT NULL DEFAULT '1',
					`uid2` INT NOT NULL
					) ENGINE = MYISAM ";
		$wpdb->query($ss); 
	
	
	$ss = "CREATE TABLE `".$wpdb->prefix."walleto_pm` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`owner` INT NOT NULL DEFAULT '0',
					`user` INT NOT NULL DEFAULT '0',
					`content` TEXT NOT NULL ,
					`subject` TEXT NOT NULL ,
					`rd` TINYINT NOT NULL DEFAULT '0',
					`parent` BIGINT NOT NULL DEFAULT '0',
					`pid` INT NOT NULL DEFAULT '0',
					`datemade` INT NOT NULL DEFAULT '0',
					`readdate` INT NOT NULL DEFAULT '0',
					`initiator` INT NOT NULL DEFAULT '0',
					`attached` INT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ;
					";
	$wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_pm` ADD  `show_to_source` TINYINT NOT NULL DEFAULT '1';";
	$wpdb->query($ss);
		
	//---------------------------	
			
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_pm` ADD  `show_to_destination` TINYINT NOT NULL DEFAULT '1';";
	$wpdb->query($ss);	
			
	
	//-------------------------------------
			
	$ss = " CREATE TABLE `".$wpdb->prefix."walleto_custom_fields` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`name` VARCHAR( 255 ) NOT NULL ,
					`tp` VARCHAR( 48 ) NOT NULL ,
					`ordr` INT NOT NULL ,
					`cate` VARCHAR( 255 ) NOT NULL ,
					`pause` INT NOT NULL DEFAULT '1'
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 
		//-------------------	 
			 $ss = " CREATE TABLE `".$wpdb->prefix."walleto_custom_options` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`valval` VARCHAR( 255 ) NOT NULL ,
					`ordr` INT( 11 ) NOT NULL ,
					`custid` INT NOT NULL
					) ENGINE = MYISAM ";
			 $wpdb->query($ss);
			 

			
		//----------------------------
		
			$ss = " CREATE TABLE `".$wpdb->prefix."walleto_custom_relations` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`custid` BIGINT NOT NULL ,
					`catid` BIGINT NOT NULL
					) ENGINE = MYISAM ";
			$wpdb->query($ss);
	
	//----------------------------
				
	$ss = " CREATE TABLE `".$wpdb->prefix."walleto_withdraw` (
					`id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`datemade` INT NOT NULL ,
					`done` INT NOT NULL ,
					`datedone` INT NOT NULL ,
					`payeremail` VARCHAR( 255 ) NOT NULL ,
					`uid` INT NOT NULL ,
					`amount` DOUBLE NOT NULL
					) ENGINE = MYISAM ";
	$wpdb->query($ss);
	$wpdb->query("ALTER TABLE `".$wpdb->prefix."walleto_withdraw` ADD `methods` VARCHAR( 255 ) NOT NULL ;");	
	
	//-----------------------------
	
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_orders` ADD  `partially_shipped` TINYINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_orders` ADD  `partially_paid` TINYINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	//------------------------------
	
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_order_contents` ADD  `paid` TINYINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_order_contents` ADD  `paid_on` BIGINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_order_contents` ADD  `shipped_on` BIGINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_order_contents` ADD  `shipped` TINYINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);
	
	//----------------------------------
	
	$ss = " CREATE TABLE `".$wpdb->prefix."walleto_ratings` (
					`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`fromuser` BIGINT NOT NULL ,
					`touser` BIGINT NOT NULL ,
					`comment` TEXT ,
					`grade` TINYINT NOT NULL ,
					`datemade` BIGINT NOT NULL DEFAULT '0' ,
					`awarded` TINYINT NOT NULL DEFAULT '0'
					) ENGINE = MYISAM ";			
			
	$wpdb->query($ss);
			
	$ss = "ALTER TABLE `".$wpdb->prefix."walleto_ratings` ADD `orderid` BIGINT NOT NULL DEFAULT '0';";
	$wpdb->query($ss);	
			
		
}

	$opt = get_option('walleto_upd138saa_bass');
	if(empty($opt))
	{
		global $wpdb;
		update_option('walleto_upd138saa_bass','y');
		
		$sql_option_my = "ALTER TABLE  `".$wpdb->prefix."walleto_withdraw` ADD  `rejected` VARCHAR(255) NOT NULL DEFAULT '0';";
		$wpdb->query($sql_option_my);	
		
	}



?>