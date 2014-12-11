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

ini_set('session.save_path', 'tmp');

	session_start();

	load_theme_textdomain( 'Walleto', TEMPLATEPATH . '/languages' );

	

	DEFINE("WALLETOTHEME_VERSION", "1.1.0");

	DEFINE("WALLETOTHEME_RELEASE", "13 September 2013");



	global $default_search;

	$default_search = __("Begin to search by typing here...",'Walleto');

	 

	//--------------------------------------

	

	add_theme_support( 'post-thumbnails' );

	

	global $current_theme_locale_name, $category_url_link, $products_url_thing, $shop_url_thing;	

	$current_theme_locale_name = 'Walleto';

	

	$category_url_link 	= "product-category";

	$products_url_thing = "products";

	$shop_url_thing 	= "shops";

	

	/************************************

	*

	*	INCLUDES HERE - ;)

	*

	*************************************/

	
        //include 'categories.php';
	include 'lib/admin_menu.php';

	include 'lib/first_run.php';

	include 'lib/first_run_emails.php';

	include 'lib/post_new.php';

	include 'lib/advanced_search.php';

	

	include 'lib/widgets/browse-by-category.php';

	include 'lib/widgets/latest-posted-products.php';

	include 'lib/widgets/most-visited-products.php';

	include 'lib/widgets/featured-products.php';

	include 'lib/widgets/search-widget.php';

	include 'lib/widgets/browse_shops.php';

	

	//----- my account includes ---------

	

	include 'lib/my_account/my_account.php';

	include 'lib/my_account/private_messages.php';

	include 'lib/my_account/reviews.php';

	include 'lib/my_account/personal_info.php';

	include 'lib/my_account/finances.php';

	

	include 'lib/my_account/outstanding_payments.php';

	include 'lib/my_account/all_orders.php';

	include 'lib/my_account/not_shipped.php';

	include 'lib/my_account/shipped_items.php';

	

	include 'lib/my_account/shipped_orders.php';

	include 'lib/my_account/awaiting_shipping.php';

	include 'lib/my_account/awaiting_payments.php';

	include 'lib/my_account/active_products.php';

	include 'lib/my_account/out_of_stock.php';

	include 'lib/my_account/order_content.php';

	include 'lib/my_account/order_content2.php';

	include 'lib/my_account/pay_4_item.php';

	include 'lib/my_account/pay_4_item_virtual.php';

	include 'lib/my_account/my_shop_setup.php';

	include 'lib/my_account/purchase_membership.php';

	include 'lib/my_account/purchase_membership_credits.php';

	

	include 'lib/login_register/custom2.php';

	

	include 'lib/my_cart.php';

	include 'lib/checkout.php';

	include 'lib/shops.php';

	include 'lib/watchlist.php';

	include 'lib/all_categories.php';

	include 'lib/blog.php';

	

	/************************************/

	

	

	add_shortcode('walleto_my_account_home', 							'Walleto_my_account_display_home_page');

	add_action('widgets_init',	 										'Walleto_framework_init_widgets' );

	add_action('init', 													'walleto_create_post_type' );

	add_action('admin_menu', 											'Walleto_admin_main_menu_scr');

	add_action('admin_head', 											'walleto_admin_main_head_scr');

	add_action("template_redirect", 									'walleto_template_redirect');

	add_action('query_vars', 											'walleto_add_query_vars'); 

	add_action('wp_enqueue_scripts', 									'walleto_add_theme_styles');

	add_filter('wp_head',												'walleto_add_max_nr_of_images');

	

	add_image_size( 'main-image-post', 184, 161, true );
	
	//add_image_size( 'main-image-product', 244, 214, true );

	add_image_size( 'main-image-post2', 244, 214, true );  

	add_image_size( 'small-image-post', 65, 65, true );

	add_image_size( 'image-single-product-page', 358, 329, true );

	add_image_size( 'thumbnail-image-post', 150, 150, true );

	

	

	

	

	add_action("manage_posts_custom_column", 					"walleto_my_custom_columns");

	add_filter("manage_edit-product_columns",					"walleto_my_products_columns");

	add_filter("manage_edit-shop_columns",						"walleto_my_shops_columns");

	add_action('save_post',										'walleto_save_custom_fields');

	add_action( 'init', 										'walleto_register_my_menus' );

	add_action('generate_rewrite_rules', 						'walleto_rewrite_rules' );

	

	add_shortcode( 'walleto_my_account' , 									'Walleto_my_account_display_home_page' );

	add_shortcode( 'walleto_my_account_priv_mess' , 						'Walleto_my_account_display_priv_mess_page' );

	add_shortcode( 'walleto_my_account_reviews' , 							'Walleto_my_account_display_reviews_page' );

	add_shortcode( 'walleto_my_account_pers_info' , 						'Walleto_my_account_display_persinfo_page' );

	add_shortcode( 'walleto_my_account_finances' , 							'Walleto_my_account_display_finances_page' );	

	

	add_shortcode( 'walleto_my_account_all_orders' , 						'Walleto_my_account_display_all_orders_page' );

	add_shortcode( 'walleto_my_account_outstand_pay' , 						'Walleto_my_account_display_outstanding_pay_page' );

	add_shortcode( 'walleto_my_account_not_shipped' , 						'Walleto_my_account_display_not_shipped_page' );

	add_shortcode( 'walleto_my_account_shipped_cust' , 						'Walleto_my_account_display_shipped_cust_page' );

	

	add_shortcode( 'walleto_my_account_active_items' , 						'Walleto_my_account_display_active_items_page' );

	add_shortcode( 'walleto_my_account_out_of_stock' , 						'Walleto_my_account_display_out_of_stock_page' );	

	add_shortcode( 'walleto_my_account_aw_pay' , 							'Walleto_my_account_display_awa_pay_page' );

	add_shortcode( 'walleto_my_account_aw_shp' , 							'Walleto_my_account_display_awa_shp_page' );	

	add_shortcode( 'walleto_my_account_shipped_orders' ,					'Walleto_my_account_display_shipped_orders_page' );

	add_shortcode( 'walleto_theme_shopping_cart' ,							'walleto_cart_area_function' );

	add_shortcode( 'walleto_theme_checkout_page' ,							'walleto_checkout_area_function' );

	add_shortcode( 'walleto_my_account_order_cnt_pg' ,						'walleto_get_my_order_content_area_function' );

	add_shortcode( 'walleto_theme_post_new' ,								'walleto_post_new_product_content_area_function' );

	add_shortcode( 'walleto_theme_adv_search' ,								'walleto_advanced_search_content_area_function' );

	add_shortcode( 'walleto_my_account_pay_4_item' ,						'walleto_pay_4_item_content_area_function' );

	add_shortcode( 'walleto_my_account_pay_4_item_virt' ,					'walleto_pay_4_item_virt_content_area_function' );

	add_shortcode( 'walleto_theme_shops_page' ,								'walleto_shops_show_area_function' );

	add_shortcode( 'walleto_watch_list' ,									'walleto_watchlist_area_function' );

	add_shortcode( 'walleto_show_all_categories' ,							'walleto_all_cats_area_function' );

	add_shortcode( 'walleto_blog_posts' ,									'walleto_blog_posts_area_function' );

	add_shortcode( 'walleto_my_account_purchase_mem' ,						'walleto_purchase_membership_area_function' );

	add_shortcode( 'walleto_my_account_my_shop_setup' ,						'walleto_my_shop_setup_area_function' );

	add_shortcode( 'walleto_my_account_purchase_mem_crds' ,					'walleto_purchase_membership_area_function_crds' );

	add_shortcode( 'walleto_my_account_order_cnt_pg2' ,						'walleto_get_my_order_content_area_function2' );





/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function Walleto_myplugin_update_slug( $data, $postarr ) {

    if ( !in_array( $data['post_status'], array( 'draft', 'pending', 'auto-draft' ) ) ) {

		if($data['post_type'] == "shop")

        $data['post_name'] = sanitize_title( $data['post_title'] );

    }

    return $data;

}

add_filter( 'wp_insert_post_data', 'Walleto_myplugin_update_slug', 99, 2 );



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_order_content_link2($id, $uid)

{

	if(walleto_using_permalinks())

	{

		return get_permalink(get_option('Walleto_my_account_show_order_cnt_page_id2')). "?oid=". $id;	

	}

	else

	{

		return get_permalink(get_option('Walleto_my_account_show_order_cnt_page_id2'))."&oid=" . $id;

	}	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function Walleto_auction_clear_table($spm = '')

{

	return '<tr><td colspan="'.$spm.'"></td></tr>';	

}



function walleto_get_product_category_fields_without_vals($catid, $clas_op = '')

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."walleto_custom_fields order by ordr asc";	

	$r = $wpdb->get_results($s);

	

	$arr1 = array(); $i = 0;

	

	if($clas_op != "no") $clas_op = 'do_input';

	

	foreach($r as $row)

	{

		$ims 	= $row->id;

		$name 	= $row->name;

		$tp 	= $row->tp;

		

		if($row->cate == 'all')

		{ 

			$arr1[$i]['id'] 	= $ims; 

			$arr1[$i]['name'] 	= $name; 

			$arr1[$i]['tp'] 	= $tp; 

			$i++; 

		

		}

		else

		{

			$se = "select * from ".$wpdb->prefix."walleto_custom_relations where custid='$ims'";

			$re = $wpdb->get_results($se);

			

			if(count($re) > 0)

			foreach($re as $rowe) // = mysql_fetch_object($re))

			{

				if(count($catid) > 0)

				foreach($catid as $id_of_cat)

				{

				

					if($rowe->catid == $id_of_cat)

					{

						$flag_me = 1;

						for($k=0;$k<count($arr1);$k++)

						{

							if(	$arr1[$k]['id'] 	== $ims	) {  $flag_me = 0; break; }						

						}

						

						if($flag_me == 1)

						{

							$arr1[$i]['id'] 	= $ims; 

							$arr1[$i]['name'] 	= $name; 

							$arr1[$i]['tp'] 	= $tp;

							$i++;

						}

					}

				}

			}

		}

	}



	$arr = array();

	$i = 0;

	

	for($j=0;$j<count($arr1);$j++)

	{

		$ids 	= $arr1[$j]['id'];

		$tp 	= $arr1[$j]['tp'];

		

		$arr[$i]['field_name']  = $arr1[$j]['name'];

		$arr[$i]['id']  = '<input type="hidden" value="'.$ids.'" name="custom_field_id[]" />';

		

		if($tp == 1) 

		{

		

		$teka = ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;

	

		$arr[$i]['value']  = '<input class="'.$clas_op.'" type="text" size="30" name="custom_field_value_'.$ids.'" 

		value="'.(isset($_GET['custom_field_value_'.$ids]) ? $_GET['custom_field_value_'.$ids] : $teka ).'" />';

		

		}

		

		if($tp == 5)

		{

		

			$teka 	= ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;

			$value 	= isset($_GET['custom_field_value_'.$ids]) ? $_GET['custom_field_value_'.$ids] : $teka;

			

			$arr[$i]['value']  = '<textarea rows="5" cols="40" class="'.$clas_op.'" name="custom_field_value_'.$ids.'">'.$value.'</textarea>';

		

		}

		

		if($tp == 3) //radio

		{

			$arr[$i]['value']  = '';

			

				$s2 = "select * from ".$wpdb->prefix."walleto_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 	= ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;

					if(isset($_GET['custom_field_value_'.$ids]))

					{

						if($_GET['custom_field_value_'.$ids] == $row2->valval) $value = 'checked="checked"';

						else $value = '';

					}

					elseif(!empty($pid))

					{

						$v = ''; //get_post_meta($pid, 'custom_field_ID_'.$ids, true);

						if($v == $row2->valval) $value = 'checked="checked"';

						else $value = ''; 

					

					}				

					else $value = '';

					

					$arr[$i]['value']  .= '<input type="radio" '.$value.' value="'.$row2->valval.'" name="custom_field_value_'.$ids.'"> '.$row2->valval.'<br/>';

				}

		}

		

		

		if($tp == 4) //checkbox

		{

			$arr[$i]['value']  = '';

			

				$s2 = "select * from ".$wpdb->prefix."walleto_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 	= $_GET['custom_field_value_'.$ids]; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;



				

					if(is_array($teka))

					{	

						$tekam = '';

						

						foreach($teka as $te)

						{

							

							if($te == $row2->valval) { $tekam = "checked='checked'"; break; }

						}	

						

									

					}

					else $tekam = '';

					

			

					

					$arr[$i]['value']  .= '<input '.$tekam.' type="checkbox" value="'.$row2->valval.'" name="custom_field_value_'.$ids.'[]"> '.$row2->valval.'<br/>';

				}



		}

		

		if($tp == 2) //select

		{

			$arr[$i]['value']  = '<select class="'.$clas_op.'" name="custom_field_value_'.$ids.'" /><option value="">'.__('Select','Walleto').'</option>';

			

				$s2 = "select * from ".$wpdb->prefix."walleto_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 	= ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;

					

					if(!empty($teka))

					{	

						foreach($teka as $te)

						{

							if($te == $row2->valval) { $teka = "selected='selected'"; break; }

						}	

						

						$teka = '';			

					}

					else $teka = '';

					

					if(isset($_GET['custom_field_value_'.$ids]) && $_GET['custom_field_value_'.$ids] == $row2->valval)

					$value = "selected='selected'" ;

					else $value = $teka;

					

					

					$arr[$i]['value']  .= '<option '.$value.' value="'.$row2->valval.'">'.$row2->valval.'</option>';

				

				}

			$arr[$i]['value']  .= '</select>';

		}

		

		$i++;

	}

	

	return $arr;

}





/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_CATID($slug)

{

	$c = get_term_by('slug', $slug, 'product_cat');	

	return $c->term_id;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_trial_link()

{

	$perm = walleto_using_permalinks();

	

	if($perm) return get_permalink(get_option('Walleto_my_account_shop_setup_page_id')) . "?activate_trial=1";

	return get_permalink(get_option('Walleto_my_account_shop_setup_page_id')) . "&activate_trial=1";	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_categories_slug($taxo, $selected = "", $include_empty_option = "", $ccc = "")

{

	$args = "orderby=name&order=ASC&hide_empty=0&parent=0";

	$terms = get_terms( $taxo, $args );

	

	$ret = '<select name="'.$taxo.'_cat" class="'.$ccc.'" id="'.$ccc.'">';

	if(!empty($include_empty_option)){

		

		if($include_empty_option == "1") $include_empty_option = "Select";

	 	$ret .= "<option value=''>".$include_empty_option."</option>";

	 }

	

	if(empty($selected)) $selected = -1;

	

	foreach ( $terms as $term )

	{

		$id = $term->slug;

		$ide = $term->term_id;

		

		$ret .= '<option '.($selected == $id ? "selected='selected'" : " " ).' value="'.$id.'">'.$term->name.'</option>';

		

		$args = "orderby=name&order=ASC&hide_empty=0&parent=".$ide;

		$sub_terms = get_terms( $taxo, $args );	

		

		if($sub_terms)

		foreach ( $sub_terms as $sub_term )

		{

			$sub_id = $sub_term->slug; 

			$ret .= '<option '.($selected == $sub_id ? "selected='selected'" : " " ).' value="'.$sub_id.'">&nbsp; &nbsp;|&nbsp;  '.$sub_term->name.'</option>';

			

			$args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_term->term_id;

			$sub_terms2 = get_terms( $taxo, $args2 );	

			

			if($sub_terms2)

			foreach ( $sub_terms2 as $sub_term2 )

			{

				$sub_id2 = $sub_term2->slug; 

				$ret .= '<option '.($selected == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp;  

				'.$sub_term2->name.'</option>';

				

				$args3 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_term2->term_id;

				$sub_terms3 = get_terms( $taxo, $args3 );

				

				if($sub_terms3)

				foreach ( $sub_terms3 as $sub_term3 )

				{

					$sub_id3 = $sub_term3->slug; 

					$ret .= '<option '.($selected == $sub_id3 ? "selected='selected'" : " " ).' value="'.$sub_id3.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp;  

					'.$sub_term3->name.'</option>';

					

				}

			

			}

			

		}

		

	}

	

	$ret .= '</select>';

	

	return $ret;

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function Walleto_send_email_when_item_is_paid_seller($oid, $the_seller_id,  $the_buyer_id) //received by seller

{

	$enable 	= get_option('Walleto_paid_auction_seller_email_enable');

	$subject 	= get_option('Walleto_paid_auction_seller_email_subject');

	$message 	= get_option('Walleto_paid_auction_seller_email_message');	

	

	

	

	if($enable != "no"):

		

 

		$seller 		= get_userdata($the_seller_id);

		$buyer 		    = get_userdata($the_buyer_id);

		

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));

		

		

		$find 		= array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Walleto_send_email_when_item_is_paid_seller';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------



		Walleto_send_email($seller->user_email, $subject, $message);

	

	endif;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function Walleto_send_email_when_item_is_paid_buyer($oid, $the_buyer_id, $the_seller_id) //received by buyer

{

	$enable 	= get_option('Walleto_paid_auction_buyer_email_enable');

	$subject 	= get_option('Walleto_paid_auction_buyer_email_subject');

	$message 	= get_option('Walleto_paid_auction_buyer_email_message');	

	

	

	

	if($enable != "no"):

		

 

		$seller 		= get_userdata($the_seller_id);

		$buyer 		    = get_userdata($the_buyer_id);

		

		$user 			= get_userdata($post->post_author);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));



		

		

		$find 		= array('##seller_user##', '##buyer_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($seller->user_login, $buyer->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Walleto_send_email_when_item_is_paid_buyer';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------



		Walleto_send_email($buyer->user_email, $subject, $message);

	

	endif;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_prepare_rating($fromuser, $touser, $order_id)

{



		global $wpdb;

		

		$s = "select * from ".$wpdb->prefix."walleto_ratings where touser='$touser' AND fromuser='$fromuser' AND $order_id='$order_id'";

		$r = $wpdb->get_results($s);

		

		if(count($r) == 0)

		{

			

			$tm = current_time('timestamp',0);			

			$s = "insert into ".$wpdb->prefix."walleto_ratings (fromuser, touser, orderid, datemade) values('$fromuser',	'$touser', '$order_id', '$tm')";				

			$wpdb->query($s);

			

			$ratings_for_bid_id = get_option($pid,'ratings_for_ord_id_' . $order_id. $fromuser . $touser);

			

			if(empty($ratings_for_bid_id))

			{

				update_option('ratings_for_ord_id_' . $order_id. $fromuser . $touser, "donE");

				Walleto_send_email_when_review_needs_to_be_awarded($order_id, $fromuser, 	$touser);

				Walleto_send_email_when_review_needs_to_be_awarded($order_id, $touser, 		$fromuser);

			

			}

		

		}

 

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_send_email_when_review_needs_to_be_awarded($oid, $rated_user_uid, $awarding_user_uid) //received by buyer

{

	$enable 	= get_option('Walleto_review_to_award_email_enable');

	$subject 	= get_option('Walleto_review_to_award_email_subject');

	$message 	= get_option('Walleto_review_to_award_email_message');	

	

	

	

	if($enable != "no"):

		

 

		$rated_user		= get_userdata($rated_user_uid);

		$awarding_user  = get_userdata($awarding_user_uid);

		

		$user 			= get_userdata($post->post_author);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));



		

		$find 		= array('##rated_user##', '##awarding_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($rated_user->user_login, $awarding_user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Walleto_send_email_when_review_needs_to_be_awarded';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------



		Walleto_send_email($awarding_user->user_email, $subject, $message);

	

	endif;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/	

function walleto_check_if_order_is_paid_fully($oid)

{

	global $wpdb;

	$s = "select id from ".$wpdb->prefix."walleto_order_contents where orderid='$oid' AND paid='0'";

	$r = $wpdb->get_results($s);

	

	if(count($r) == 0) return true;

	return false;	

}





/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_check_if_order_is_shipped_fully($oid)

{

	global $wpdb;

	$s = "select id from ".$wpdb->prefix."walleto_order_contents where orderid='$oid' AND shipped='0'";

	$r = $wpdb->get_results($s);

	

	if(count($r) == 0) return true;

	return false;	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_send_email_posted_item_approved_admin($pid)

{

	$enable 	= get_option('Walleto_new_item_email_approve_admin_enable');

	$subject 	= get_option('Walleto_new_item_email_approve_admin_subject');

	$message 	= get_option('Walleto_new_item_email_approve_admin_message');	

	

	if($enable != "no"):

	

		$post 			= get_post($pid);

		$user 			= get_userdata($post->post_author);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));

		



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Walleto_send_email_posted_item_approved_admin';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------

		

		$email = get_bloginfo('admin_email');

		Walleto_send_email($email, $subject, $message);

	

	endif;

}	



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_search_into($custid, $val)

	{

		global $wpdb;

		$s = "select * from ".$wpdb->prefix."walleto_custom_relations where custid='$custid'";

		$r = $wpdb->get_results($s);

		

		if(count($r) == 0) return 0;

		else

		foreach($r as $row) // = mysql_fetch_object($r))

		{

			if($row->catid == $val) return 1;

		}

	

		return 0;

	}

	

function Walleto_send_email_posted_item_not_approved($pid)

{

	$enable 	= get_option('Walleto_new_item_email_not_approved_enable');

	$subject 	= get_option('Walleto_new_item_email_not_approved_subject');

	$message 	= get_option('Walleto_new_item_email_not_approved_message');	

	

	if($enable != "no"):

	

		$post 			= get_post($pid);

		$user 			= get_userdata($post->post_author);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));

		



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Walleto_send_email_posted_item_not_approved';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------



		Walleto_send_email($user->user_email, $subject, $message);

	

	endif;	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_send_email_posted_item_not_approved_admin($pid)

{

	$enable 	= get_option('Walleto_new_item_email_not_approve_admin_enable');

	$subject 	= get_option('Walleto_new_item_email_not_approve_admin_subject');

	$message 	= get_option('Walleto_new_item_email_not_approve_admin_message');	

	

	if($enable != "no"):

	

		$post 			= get_post($pid);

		$user 			= get_userdata($post->post_author);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));

		



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Walleto_send_email_posted_item_not_approved_admin';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------

		

		$email = get_bloginfo('admin_email');

		Walleto_send_email($email, $subject, $message);

	

	endif;	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

add_action('admin_notices', 						'walleto_admin_notices');

function walleto_admin_notices(){

    

		if(!function_exists('wp_pagenavi')) {

		echo '<div class="updated">

		   <p>For the <strong>Walleto Theme</strong> you need to install the wp pagenavi plugin. 

		   Install it from <a href="http://wordpress.org/extend/plugins/wp-pagenavi"><strong>here</strong></a>.</p>

		</div>';

								}

								

	if(!function_exists('bcn_display')) {

		echo '<div class="updated">

		   <p>For the <strong>Walleto Theme</strong> you need to install the Breadcrumb NavXT plugin. 

		   Install it from <a href="http://wordpress.org/extend/plugins/breadcrumb-navxt/"><strong>here</strong></a>.</p>

		</div>';

								}	

	}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_small_shop_display()

{

	global $post;

	

	?>

    

    

    

    <div class="post_sml small-padd-top" >

                <div class="image_holder2">

                <a href="<?php the_permalink(); ?>"><?php echo Walleto_get_first_post_image(get_the_ID(),50,50, 'attachment-50x50'); ?></a>

                </div>

                <div  class="title_holder2_shop" > 

                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">

                        <?php   the_title();  ?></a></h2>

                        

                        <p class="mypostedon2">

                        <?php _e("Shop Category",'Walleto');?> <?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '' ); ?><br/>

                       

					    

                        

                                <span class="product_price_m"><?php echo substr($post->post_content,0,110); ?></span>

                      

                       

                        </p>

                       

                     

                

                      

                     </div></div> <?php	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_small_post($param = '')

{

			$ending 	= get_post_meta(get_the_ID(), 'ending', true);

			$sec 		= $ending - current_time('timestamp',0);

			$location 	= get_post_meta(get_the_ID(), 'Location', true);

			



			$price 		= get_post_meta(get_the_ID(), 'price', true);			

			$closed 	= get_post_meta(get_the_ID(), 'closed', true);

			$views 		= get_post_meta(get_the_ID(), 'views', true);

			$rnd = rand(1,999);

			

?>

		<li>

                <div class="featured_product_img">

                <a href="<?php the_permalink(); ?>"><?php echo Walleto_get_first_post_image(get_the_ID(),150,110,'slider-image'); ?></a>

                </div>

                <div  class="featured-content" > 

                    <p class="product_detail">
                        <?php   $ttl = get_the_title();
                        $xx  = 15;
                       if (strlen($ttl) > $xx)
                       echo substr($ttl, 0, $xx);
                       else
                       echo $ttl;?> 
		    </p>
                        

                        <p class="mypostedon2">

                        <?php _e("Posted in",'Walleto');?> <?php echo get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '' ); ?><br/>

                       

					    

                       <?php					   

					   		if($param == 'view'):							

							?>

                    		

							<?php _e("Views",'Walleto');?>: <?php echo $views; ?>

                    		

							<?php else: ?>

                       

                      		<span style="float:left"><?php _e("Price:",'Walleto');?>&nbsp; </span>

                                <span class="featured_price"><?php echo walleto_get_show_price(Walleto_get_item_price(get_the_ID())); ?></span>

                      

                      <?php endif; ?> 

                        </p>

                       

                     

                

                     

                     </div></li>
<?php	
}	

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/	

function walleto_is_owner_of_post()

{

	

	if(!is_user_logged_in())

		return false;

	

	global $current_user;

	get_currentuserinfo();

	

	$post = get_post(get_the_ID());

	if($post->post_author == $current_user->ID) return true;

	return false;	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_current_view_grid_list()

{

	

		if(	$_SESSION['view_tp'] == "list") return "list"; else return "grid";

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_switch_link_from_home_page($tp)

{



	return get_bloginfo('siteurl')."?switch_grd=".$tp."&get_urls=" . urlencode(Walleto_curPageURL());

		

}

 

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

 

function Walleto_get_post_blog()

{

			

						 $arrImages =& get_children('post_type=attachment&post_mime_type=image&post_parent=' . get_the_ID());

						 

						 if($arrImages) 

						 {

							$arrKeys 	= array_keys($arrImages);

							$iNum 		= $arrKeys[0];

					        $sThumbUrl 	= wp_get_attachment_thumb_url($iNum);

					        $sImgString = '<a href="' . get_permalink() . '">' .

	                          '<img class="image_class" src="' . $sThumbUrl . '" width="100" height="100" />' .

                      		'</a>';

							 							 

						 }

						 else

						 {

								$sImgString = '<a href="' . get_permalink() . '">' .

	                          '<img class="image_class" src="' . get_bloginfo('template_url') . '/images/nopic.png" width="100" height="100" />' .

                      			'</a>'; 

							 

						 }

					

			

?>

		<div class="post vc_POST" id="post-<?php the_ID(); ?>">

                <div class="padd10">

                <div class="image_holder" style="width:120px">

                <?php echo $sImgString; ?>

                </div>

                <div  class="title_holder" style="width:510px" > 

                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">

                        <?php the_title(); ?></a></h2>

                        <p class="mypostedon"><?php _e('Posted on','Walleto'); ?> <?php the_time('F jS, Y') ?>  <?php _e('by','Walleto'); ?> 

                       <?php the_author() ?>

                  </p>

                       <p class="blog_post_preview"> <?php the_excerpt(); ?></p>

                       

                      

                        <a href="<?php the_permalink() ?>" class="post_bid_btn"><?php _e('Read More','Walleto'); ?></a>

                         

                     </div></div>

                     

                   

                     

                     </div>

<?php

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_purchase_mem_link($mem)

{

	$id = get_option('Walleto_my_account_pur_mem_page_id');

	if(walleto_using_permalinks()) return get_permalink($id). "?mem=" . $mem;

	return get_permalink($id). "&mem=" . $mem;	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_purchase_mem_link_ewallet($mem, $agree = '')

{

	$id = get_option('Walleto_my_account_pur_mem_crds_page_id');

	if(walleto_using_permalinks()) return get_permalink($id). "?mem=" . $mem. $agree;

	return get_permalink($id). "&mem=" . $mem. $agree;	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_send_email_posted_item_approved($pid)

{

	$enable 	= get_option('Walleto_new_item_email_approved_enable');

	$subject 	= get_option('Walleto_new_item_email_approved_subject');

	$message 	= get_option('Walleto_new_item_email_approved_message');	

	

	if($enable != "no"):

	

		$post_au 			= get_post($pid);

		$user 			= get_userdata($post_au->post_author);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));

		

		$post 		= get_post($pid);

		$item_name 	= $post_au->post_title;

		$item_link 	= get_permalink($pid);



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $item_name, $item_link);

		

		$tag		= 'Walleto_send_email_posted_item_approved';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------

		

		$email = $user->user_email;

		Walleto_send_email($user->user_email, $subject, $message);

		

	endif;		

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_field_tp($nr)

{

		if($nr == "1") return "Text field";

		if($nr == "2") return "Select box";

		if($nr == "3") return "Radio Buttons";

		if($nr == "4") return "Check-box";

		if($nr == "5") return "Large text-area";	

		

		

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_check_if_shop_membership_is_valid($uid)

{

	$shop_id = walleto_get_auto_draft_shop($uid);	

	$dt = current_time('timestamp',0);

	

	$membership_available = get_post_meta($shop_id, 'membership_available', true);

	if( empty($membership_available) or $dt > $membership_available ) 

	{

		 

		return false;

		

	}

	else

	{

		return true;

	}

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_update_membership_for_shop($uid, $months)

{

	$shop_id = walleto_get_auto_draft_shop($uid);	

	$dt = current_time('timestamp',0);

	update_post_meta($shop_id, 'membership_available', $dt + ($months*30.5*24*3600));

	update_post_meta($uid, 'membership_available', $dt + ($months*30.5*24*3600));

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_shop_id($uid)

{

	return walleto_get_auto_draft_shop($uid);	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_send_email($recipients, $subject = '', $message = '') {

		

	$Walleto_email_addr_from 	= get_option('Walleto_email_addr_from');	

	$Walleto_email_name_from  	= get_option('Walleto_email_name_from');

	

	$message = stripslashes($message);

	$subject = stripslashes($subject); 

	

	if(empty($Walleto_email_name_from)) $Walleto_email_name_from  = "Walleto Theme";

	if(empty($Walleto_email_addr_from)) $Walleto_email_addr_from  = "Walleto@wordpress.org";

		

	$headers = 'From: '. $Walleto_email_name_from .' <'. $Walleto_email_addr_from .'>' . PHP_EOL;

	$Walleto_allow_html_emails = get_option('Walleto_allow_html_emails');

	if($Walleto_allow_html_emails != "yes") $html = false;

	else $html = true;



	$ok_send_email = true;

	$ok_send_email = apply_filters('Walleto_ok_to_send_emails', $ok_send_email);



	if($ok_send_email == true)

	{

		if ($html) {

			$headers .= "MIME-Version: 1.0\n";

			$headers .= "Content-Type: " . get_bloginfo('html_type') . "; charset=\"". get_bloginfo('charset') . "\"\n";

			$mailtext = "<html><head><title>" . $subject . "</title></head><body>" . nl2br($message) . "</body></html>";

			return wp_mail($recipients, $subject, $mailtext, $headers);

			

		} else {

			$headers .= "MIME-Version: 1.0\n";

			$headers .= "Content-Type: text/plain; charset=\"". get_bloginfo('charset') . "\"\n";

			$message = preg_replace('|&[^a][^m][^p].{0,3};|', '', $message);

			$message = preg_replace('|&amp;|', '&', $message);

			$mailtext = wordwrap(strip_tags($message), 80, "\n");

			return wp_mail($recipients, stripslashes($subject), stripslashes($mailtext), $headers);

		}



	}



}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_replace_stuff_for_me($find, $replace, $subject)

{

	$i = 0;

	foreach($find as $item)

	{

		$replace_with = $replace[$i];

		$subject = str_replace($item, $replace_with, $subject);	

		$i++;

	}

	

	return $subject;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_register_my_menus() {

		register_nav_menu( 'primary-walleto-header', 'Walleto Top-Header Menu' );

		register_nav_menu( 'primary-walleto-main-header', 'Walleto Big Main Menu' );		

		

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/	

		

function Walleto_add_max_nr_of_images()

{

	?>

    

    <script type="text/javascript">

		<?php

		$Walleto_enable_max_images_limit = get_option('Walleto_enable_max_images_limit');

		if($Walleto_enable_max_images_limit == "yes")

		{

			$Walleto_nr_max_of_images = get_option('Walleto_nr_max_of_images');

			if(empty($Walleto_nr_max_of_images))	 $Walleto_nr_max_of_images = 10;

		}

		else $Walleto_enable_max_images_limit = 1000;

		

		if(empty($Walleto_nr_max_of_images)) $Walleto_nr_max_of_images = 100;

		

		?>

		

		

		

		var maxNrImages_PT = <?php echo $Walleto_nr_max_of_images; ?>;

	

	</script>

    

    <?php	

	

}	 



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_login_url()

{

	return get_bloginfo('siteurl') . "/wp-login.php";	

}



	

/*************************************************************

*

*	Walleto (c) sitemile.com - function

*

**************************************************************/

function walleto_get_order_content_link($id)

{

	if(walleto_using_permalinks())

	{

		return get_permalink(get_option('Walleto_my_account_show_order_cnt_page_id')). "?oid=". $id;	

	}

	else

	{

		return get_permalink(get_option('Walleto_my_account_show_order_cnt_page_id'))."&oid=" . $id;

	}	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function Walleto_get_item_price($pid)

{

	return get_post_meta($pid,'price',true);	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/ 

function walleto_get_remove_from_cart_link($pid)

{

	if(walleto_using_permalinks())

	{

		return get_permalink(get_option('Walleto_shopping_cart_page_id')). "?remove_from_cart=". $pid;	

	}

	else

	{

		return get_permalink(get_option('Walleto_shopping_cart_page_id'))."&remove_from_cart=" . $pid;

	}

}



/*************************************************************

*

*	Walleto (c) sitemile.com - function

*

**************************************************************/

function walleto_get_post_images($pid, $limit = -1)

{

	

		//---------------------

		// build the exclude list

		$exclude = array();

		

		$args = array(

		'order'          => 'ASC',

		'post_type'      => 'attachment',

		'post_parent'    => get_the_ID(),

		'meta_key'		 => 'another_reserved1',

		'meta_value'	 => '1',

		'numberposts'    => -1,

		'post_status'    => null,

		);

		$attachments = get_posts($args);

		if ($attachments) {

			foreach ($attachments as $attachment) {

			$url = $attachment->ID;

			array_push($exclude, $url);

		}

		}

		

		//-----------------

	

	

		$arr = array();

		

		$args = array(

		'order'          => 'ASC',

		'orderby'        => 'post_date',

		'post_type'      => 'attachment',

		'post_parent'    => $pid,

		'exclude'    		=> $exclude,

		'post_mime_type' => 'image',

		'numberposts'    => $limit,

		); $i = 0;

		

		$attachments = get_posts($args); 

		if ($attachments) {

		

			foreach ($attachments as $attachment) {

						

				$url = $attachment->ID;

				array_push($arr, $url);

			  

		}

			return $arr;

		}

		return false;

}

/*****************************************************************************

*

*	Function - walleto -

*

*****************************************************************************/

function walleto_get_auto_draft($uid)

{

	global $wpdb;	

	$querystr = "

		SELECT distinct wposts.* 

		FROM $wpdb->posts wposts where 

		wposts.post_author = '$uid' AND wposts.post_status = 'auto-draft' 

		AND wposts.post_type = 'product' 

		ORDER BY wposts.ID DESC LIMIT 1 ";

				

	$row = $wpdb->get_results($querystr, OBJECT);

	if(count($row) > 0)

	{

		$row = $row[0];

		return $row->ID;

	}

	

	return walleto_create_auto_draft($uid);	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_auto_draft_shop($uid)

{

	global $wpdb;	

	$querystr = "

		SELECT distinct wposts.* 

		FROM $wpdb->posts wposts where 

		wposts.post_author = '$uid' AND (wposts.post_status = 'auto-draft' or wposts.post_status = 'draft' or wposts.post_status = 'publish')

		AND wposts.post_type = 'shop' 

		ORDER BY wposts.ID DESC LIMIT 1 ";

				

	$row = $wpdb->get_results($querystr, OBJECT);

	if(count($row) > 0)

	{

		$row = $row[0];

		return $row->ID;

	}

	

	return walleto_create_auto_draft_shop($uid);	

}



/*****************************************************************************

*

*	Function - walleto -

*

*****************************************************************************/

function walleto_create_auto_draft($uid)

{

		$my_post = array();

		$my_post['post_title'] 		= 'Auto Draft';

		$my_post['post_type'] 		= 'product';

		$my_post['post_status'] 	= 'auto-draft';

		$my_post['post_author'] 	= $uid;

		$pid =  wp_insert_post( $my_post, true );

		



		update_post_meta($pid,'featured_paid', 	"0");

		update_post_meta($pid,'featured', 		"0");

		update_post_meta($pid,'closed', 		"0");

		update_post_meta($pid,'quant', 			"1");

		update_post_meta($pid, "views", 		'0');

		

		return $pid;

		

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_create_auto_draft_shop($uid)

{

		$my_post = array();

		$my_post['post_title'] 		= 'Auto Draft';

		$my_post['post_type'] 		= 'shop';

		$my_post['post_status'] 	= 'auto-draft';

		$my_post['post_author'] 	= $uid;

		$pid =  wp_insert_post( $my_post, true );

		



		update_post_meta($pid,'featured_paid', 	"0");

		update_post_meta($pid,'featured', 		"0");

		update_post_meta($pid,'closed', 		"0");

		update_post_meta($pid,'quant', 			"1");

		update_post_meta($pid, "views", 		'0');

		update_post_meta($pid,'status',			'active');

		

		return $pid;

		

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_clear_sums_of_cash($cash)

{

	$cash = str_replace(" ","",$cash);

	$cash = str_replace(",","",$cash);

	//$cash = str_replace(".","",$cash);

	

	return strip_tags($cash);

}

/*****************************************************************************

*

*	Function - walleto -

*

*****************************************************************************/

function walleto_generate_thumb_upload_cls($img_ID )

{



	return walleto_wp_get_attachment_image($img_ID, array(80,80));

}

/*****************************************************************************

*

*	Function - walleto -

*

*****************************************************************************/

function walleto_formats_special($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always

  

	$dec_sep = '.';

	$tho_sep = ',';

  

  //dec,thou

  

  if (is_numeric($number)) { // a number

    if (!$number) { // zero

      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero

    } else { // value

      if (floor($number) == $number) { // whole number

        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, '' ); // format

      } else { // cents

        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, '' ); // format

      } // integer or decimal

    } // value

    return $money;

  } // numeric

} // formatMoney

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



add_action('init', 		'walleto_myStartSession', 1);

add_action('wp_logout', 'walleto_myEndSession');

add_action('wp_login', 	'walleto_myEndSession');



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_myStartSession() {

    if(!session_id()) {

        session_start();

    }

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_myEndSession() {

    session_destroy ();

}

 



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_total_of_order_for_user($oid, $uid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."walleto_order_contents cnt, $wpdb->posts posts where cnt.orderid='$oid' AND posts.post_author='$uid' AND cnt.paid='0' AND posts.ID=cnt.pid";

	$r = $wpdb->get_results($s);	

	

	$shp = 0;

	$sum = 0;

	foreach($r as $row)

	{

		$sum += $row->price;

		$shp		+= get_post_meta($row->pid, 'shipping', true);

	}

	

	return $sum + $shp;



}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_order_obj($oid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."walleto_orders where id='$oid'";

	$r = $wpdb->get_results($s);

	

	return $r[0];	

}



function Walleto_send_email_when_review_has_been_awarded($oid, $rated_user_uid, $awarding_user_uid) //received by buyer

{

	$enable 	= get_option('Walleto_review_received_email_enable');

	$subject 	= get_option('Walleto_review_received_email_subject');

	$message 	= get_option('Walleto_review_received_email_message');	

	

	

	

	if($enable != "no"):

		

		global $wpdb;

 

		$post 			= get_post($pid);

		$rated_user		= get_userdata($rated_user_uid);

		$awarding_user  = get_userdata($awarding_user_uid);

		

		$user 			= get_userdata($post->post_author);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));



		

		$find 		= array('##rated_user##', '##awarding_user##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($rated_user->user_login, $awarding_user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, "#".$oid, get_permalink($pid));

		

		$tag		= 'Walleto_send_email_when_review_has_been_awarded';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------



		Walleto_send_email($rated_user->user_email, $subject, $message);

	

	endif;

}



function walleto_get_prod_stars($rating)

	{

		$full 	= get_bloginfo('template_url')."/images/full_star.gif";

		$empty 	= get_bloginfo('template_url')."/images/empty_star.gif";	

		

		$r = '';

		

		for($j=1;$j<=$rating;$j++)

		$r .= '<img src="'.$full.'" alt="star" />';

		

		

		for($j=5;$j>$rating;$j--)

		$r .= '<img src="'.$empty.'" alt="star" />';

		

		return $r;

		

	}



function walleto_template_redirect()

{

	global $wp;

	global $wp_query, $wp_rewrite, $post;

	$paagee 	=  $wp_query->query_vars['my_custom_page_type'];

	$w_action 	=  $wp_query->query_vars['w_action'];

	

	$my_pid = $post->ID;

	$Walleto_post_new_page_id 					= get_option('Walleto_post_new_page_id');

	$Walleto_my_account_page_id					= get_option('Walleto_my_account_page_id');

	$Walleto_checkout_page_id					= get_option('Walleto_checkout_page_id');

	$Walleto_my_account_pur_mem_page_id 		= get_option('Walleto_my_account_pur_mem_page_id');

	$Walleto_my_account_pur_mem_crds_page_id	= get_option('Walleto_my_account_pur_mem_crds_page_id');

	

	if(isset($_GET['switch_grd']))

	{

		 

		$_SESSION['view_tp'] = $_GET['switch_grd'];

		wp_redirect($_GET['get_urls']);

		die();

		

	}

				

	if($post->post_parent == $Walleto_my_account_page_id or $my_pid == $Walleto_my_account_page_id or $Walleto_checkout_page_id == $my_pid or $my_pid == $Walleto_my_account_pur_mem_page_id or

	 $my_pid == $Walleto_my_account_pur_mem_crds_page_id)

	{

		if(!is_user_logged_in())

		{

			wp_redirect(get_bloginfo('siteurl') . "/wp-login.php?redirect_to=" . walleto_sm_replace_me(walleto_curPageURL_me()));

			exit;	

		}

			

	}

	

	if($my_pid == $Walleto_my_account_pur_mem_crds_page_id)

	{

		if($_GET['confirm'] == "nok") 

		{

			wp_redirect(get_permalink(get_option('Walleto_my_account_pur_mem_page_id')));

			die();	

		}

	}

	

	if($my_pid == $Walleto_post_new_page_id)

	{

		

		

		if(!isset($_GET['product_id'])) $set_ad = 1; else $set_ad = 0;

		global $current_user;

		get_currentuserinfo();

		

		if(walleto_check_if_shop_membership_is_valid($current_user->ID) == false)

		{

			$Walleto_shop_subscriptions = get_option('Walleto_shop_subscriptions');

			if($Walleto_shop_subscriptions != 'no'):

				wp_redirect(get_permalink(get_option('Walleto_my_account_shop_setup_page_id'))); die();	

			endif;

		}

		

		if($set_ad == 1)

		{

			$pid 		= walleto_get_auto_draft($current_user->ID);

			wp_redirect(walleto_post_new_with_pid_stuff_thg($pid));

		}

		

		if(!empty($_GET['product_id']))

		{

			$my_main_post = get_post($_GET['product_id']);

			if($my_main_post->post_author != $current_user->ID)

			{

				wp_redirect(get_bloginfo('siteurl')); exit;	

			}

			

		}

		

		do_action('Walleto_product_post_post_new_redirect');

		

		include 'lib/post_new_post.php';		

	}

	

	if(isset($_GET['_ad_delete_pid']))

	{

		if(is_user_logged_in())

		{

			$pid	= $_GET['_ad_delete_pid'];

			$pstpst = get_post($pid);

			global $current_user;

			get_currentuserinfo();

			

			//if($pstpst->post_author == $current_user->ID)

			//{

				wp_delete_post($_GET['_ad_delete_pid']);	

				echo "done";

			//}

		}

		exit;	

	}

	

	if($w_action == 'deposit_pay')

	{

		include 'lib/gateways/deposit_pay.php';

		die();

	}

	

	if($w_action == 'deposit_pay_moneybookers')

	{

		include 'lib/gateways/deposit_pay_moneybookers.php';

		die();

	}

	

	if($w_action == 'mb_deposit_response')

	{

		include 'lib/gateways/mb_deposit_response.php';

		die();

	}

	

	

	

	

	if(isset($_POST['deposit_pay_me']))

	{

		global $am_err;

		$amount = trim($_POST['amount']);

		if(empty($amount)) $am_err = 1;	

		elseif(!is_numeric($amount)) $am_err = 1;

		else

		{

			wp_redirect(get_bloginfo('siteurl') . "/?w_action=deposit_pay&am=" . $amount);	 exit;		

		}

	}

	

	

	if(isset($_POST['deposit_pay_moneybookers']))

	{

		global $am_err;

		$amount = trim($_POST['amount']);

		if(empty($amount)) $am_err = 1;	

		elseif(!is_numeric($amount)) $am_err = 1;

		else

		{

			wp_redirect(get_bloginfo('siteurl') . "/?w_action=deposit_pay_moneybookers&am=" . $amount);	 exit;		

		}

	}

	

	//-------------------------------------------------------------------

	

	if(isset($_GET['pay_order_by_paypal']))

	{

		include 'lib/gateways/pay_order_by_paypal.php';

		die();	

	}

	

	if(isset($_GET['uploady_thing']))

	{

 

		include 'my-upload.php';

		die();	

	}

	

	if($w_action == 'rate_user')

	{

		include 'lib/my_account/rate_user.php';

		die();

	}

	

	

	if(isset($_POST['agree_and_pay']))

	{

		include 'lib/agree_and_pay.php';

		die();	

	}

	

	if(isset($_POST['continue_shopping_me']))

	{

		wp_redirect(get_bloginfo('siteurl'));

		die();	

	}

	

	if(isset($_POST['go_back_to_my_shopping_cart_me']))

	{

		wp_redirect(get_permalink(get_option('Walleto_shopping_cart_page_id')));

		die();	

	}

	

	

	

	if(isset($_POST['send_me_to_checkout']))

	{

		wp_redirect(get_permalink(get_option('Walleto_checkout_page_id')));

		die();	

	}

	

	if($w_action == 'user_profile')

	{

		include 'lib/user_profile.php';

		die();

	}

	

	if($w_action == 'edit_product')

	{

		include 'lib/my_account/edit_product.php';

		die();

	}

	

	if($w_action == 'mark_shipped')

	{

		include 'lib/my_account/mark_shipped.php';

		die();

	}

	

	if($w_action == 'delete_product')

	{

		include 'lib/my_account/delete_product.php';

		die();

	}

	

	if($w_action == 'purchase_mem_paypal')

	{

		include 'lib/gateways/purchase_mem_paypal.php';

		die();

	}

	

	if($w_action == 'purchase_mem_skrill')

	{

		include 'lib/gateways/purchase_mem_skrill.php';

		die();

	}

	

	if($w_action == 'skrill_mem_response')

	{

		include 'lib/gateways/skrill_mem_response.php';

		die();

	}

	

	

	

	if($w_action == 'pause_selling')

	{

		include 'lib/my_account/pause_selling.php';

		die();

	}

	

	if($w_action == 'activate_selling')

	{

		include 'lib/my_account/activate_selling.php';

		die();

	}

	

	if($w_action == 'add_to_cart')

	{

		include 'lib/add_to_cart.php';

		die();

	}

	

	if($w_action == 'my_cart')

	{

		include 'lib/my_cart.php';

		die();

	}

	

	

}

/*****************************************************************************

*

*	Function - walleto -

*

*****************************************************************************/

function Walleto_get_browse__special_pg_link($page_id, $page)

{

	$using_perm = Walleto_using_permalinks();

	if($using_perm)	return get_permalink(get_option($page_id)). "?pj=" . $page ;

			else return get_bloginfo('siteurl'). "/?page_id=". get_option($page_id). "&pj=" . $page ;		

	

}



function walleto_sm_replace_me($s)

{

	return urlencode($s);

}

/*****************************************************************************

*

*	Function - walleto -

*

*****************************************************************************/

function walleto_curPageURL_me() {

	 $pageURL = 'http';

	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

	 $pageURL .= "://";

	 if ($_SERVER["SERVER_PORT"] != "80") {

	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

	 } else {

	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

	 }

	 return $pageURL;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_curPageURL() {

 $pageURL = 'http';

 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

 $pageURL .= "://";

 if ($_SERVER["SERVER_PORT"] != "80") {

  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

 } else {

  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

 }

 return $pageURL;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_add_query_vars($public_query_vars) 

{  

    	$public_query_vars[] = 'jb_action';

		$public_query_vars[] = 'w_action'; 

		$public_query_vars[] = 'orderid';

		$public_query_vars[] = 'bid_id';

		 

		$public_query_vars[] = 'step'; 

		$public_query_vars[] = 'my_second_page';

		$public_query_vars[] = 'third_page';

		$public_query_vars[] = 'username';

		$public_query_vars[] = 'pid';

		$public_query_vars[] = 'term_search';		//job_sort, job_category, page

		$public_query_vars[] = 'method';

		$public_query_vars[] = 'post_author';

		$public_query_vars[] = 'page';

		$public_query_vars[] = 'rid';

		$public_query_vars[] = 'ids';

		

    	return $public_query_vars;  

}



function Walleto_get_adv_search_pagination_link($pg)

{

	$page_id = get_option('Walleto_adv_search_id');

	

	$using_perm = Walleto_using_permalinks();

	if($using_perm)	$ssk = get_permalink(($page_id)). "?pj=" . $pg ;

	else $ssk = get_bloginfo('siteurl'). "/?page_id=". ($page_id). "&pj=" . $pg ;		

	

	$trif = '';

	foreach($_GET as $key=>$value)

	{

		if($key != "pj" and $key != 'page_id' and $key != "custom_field_id")

		$trif .= '&'.$key."=".$value;

	}

	

	if(is_array($_GET['custom_field_id']))

	foreach($_GET['custom_field_id'] as $values)

	$trif .= "&custom_field_id[]=".$values;

	

	return $ssk.$trif;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_times_bough_product($pid)

{

	global $wpdb;

	$s = "select count(id) cnts from ".$wpdb->prefix."walleto_order_contents where pid='$pid'";

	$r = $wpdb->get_results($s);

	$row = $r[0];

	

	return $row->cnts;

		

}



function walleto_active_products_get_product()

{

	$pid = get_the_ID();

	$status = get_post_meta($pid,'status',true);

	global $post;

	$st = $post->post_status;

	

	

	?>

	<tbody>
        <tr>
    	<td class="post" id="post-ID-<?php the_ID(); ?>">

    		
    
        <a href="<?php the_permalink(); ?>" class="">
        <?php echo walleto_get_first_post_image(get_the_ID(), 150, 150,'thumbnail-image-post',1); ?></a>

	</td>

            
	

            	<td class="title_holder">

            	<a class="red-txt f-w-b" href="<?php the_permalink(); ?>"><?php $ttl = get_the_title();
                $xx  = 24;
                if (strlen($ttl) > $xx)
                echo substr($ttl, 0, $xx);
                else
                echo $ttl;?>
                </a>

            		

                    <p class="mypostedon"><?php echo sprintf(__("Posted on %s by <a href='%s'>%s</a>",'Walleto'), get_the_time('F jS, Y'), $lnk, get_the_author()) ;?> <br/>

                        <?php echo sprintf(__("Posted in %s","Walleto"), get_the_term_list( get_the_ID(), 'product_cat', '', ', ', '' )); ?> </p>

                        

                        

                       

            	

                </td>

                

                <td class="details_holder_inner1">

                        <span class="display-block clearfix clear"><strong class="index_heading"><?php _e('Quantity','Walleto'); ?></strong>

                         <span class="index_value"><?php echo get_post_meta($pid,'quant',true); ?></span></span>

                      

                        


                        <span class="display-block clearfix clear"><strong class="index_heading"><?php _e('Was bought','Walleto'); ?></strong>

                         <span class="index_value"><?php

                        

						$times_bought = walleto_get_times_bough_product($pid);

						echo sprintf(__("%s times","Walleto"), $times_bought);

						

						?></span></span>


                     

                        

                        

                        <span class="display-block clearfix clear"><strong class="index_heading"><?php _e('Status','Walleto'); ?>

                        </strong><span class="index_value"><?php echo ($status != "paused" ? __('Active','Walleto') : __('Paused','Walleto')); ?></span></span>
			
			<span class="display-block clearfix clear"><strong class="index_heading"><?php _e('Price','Walleto'); ?></strong><span class="index_value">            
			</strong><span class="index_value">
                    	<?php

						$prc = walleto_get_show_price(walleto_get_product_price(get_the_ID()));

						echo sprintf(__($prc,'price',true), $prc);

					

			?></span></span>

                 


                </td>

                

                
                
		</tr>
		<tr>
                <td colspan="3" align="right"><div class="tags link_button_out_of_stock">	

                <?php

				

					if($st == "draft"):

					

						echo '<span>';

						_e('Your product is awaiting admin moderation.','Walleto');

						echo '</span>';

						

						?>

                         <a href="<?php bloginfo('siteurl') ?>/?w_action=delete_product&pid=<?php the_ID(); ?>" class="post_bid_btn_err"><?php echo __("Delete Product", "Walleto");?></a>

                        <?php

						

					else:

				?>

                

                

                

                 <!-- ######## -->

                        <a href="<?php the_permalink() ?>" class="post_bid_btn"><?php echo __("Read More", "Walleto");?></a> 

                        <a href="<?php bloginfo('siteurl') ?>/?w_action=edit_product&pid=<?php the_ID(); ?>" class="post_bid_btn"><?php echo __("Edit Product", "Walleto");?></a> 

                        <?php

                        

							if($status != "paused"):

						

						?>

                        <a href="<?php bloginfo('siteurl') ?>/?w_action=pause_selling&pid=<?php the_ID(); ?>" class="post_bid_btn"><?php echo __("Pause Selling", "Walleto");?></a>

                        

                        <?php

							else:

						?>                         

                         

                        <a href="<?php bloginfo('siteurl') ?>/?w_action=activate_selling&pid=<?php the_ID(); ?>" class="post_bid_btn"><?php echo __("Activate Selling", "Walleto");?></a>

                        

                        <?php endif; ?>

                         

                        <a href="<?php bloginfo('siteurl') ?>/?w_action=delete_product&pid=<?php the_ID(); ?>" class="post_bid_btn_err"><?php echo __("Delete Product", "Walleto");?></a>

                        

                        <?php endif; ?>

                        <!-- ########### -->

                   </td>     

                 </tr>

    	

        

        </tbody>

        

    <?php	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_avatar($uid, $w = 25, $h = 25)

{

	$av = get_user_meta($uid, 'avatar_new', true);

	if(empty($av)) return get_bloginfo('template_url')."/images/noav.jpg";

	else return walleto_wp_get_attachment_image($av, array($w, $h));  

}

 /*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_unread_number_messages($uid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."walleto_pm where user='$uid' and show_to_destination='1' and rd='0'";

				$r = $wpdb->get_results($s);	

				return count($r);

}

	 

 /*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_payments_page_url($subpage = '', $id = '')

{

	$opt = get_option('Walleto_my_account_my_finances_page_id');

	if(empty($subpage)) $subpage = "home";

	

	$perm = Walleto_using_permalinks();

	

	if($perm) return get_permalink($opt). "?pg=".$subpage.(!empty($id) ? "&id=".$id : '');

	

	return get_permalink($opt). "&pg=".$subpage.(!empty($id) ? "&id=".$id : '');

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_my_shops_columns($columns) //this function display the columns headings

{



	$columns["ending" ] 	= __("Membership Expires","Walleto");

	$columns["feat" ] 		= __("Featured","Walleto");

	$columns["thumbnail"] 	= __("Thumbnail","Walleto");

 

	return $columns;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_my_products_columns($columns) //this function display the columns headings

{



 

		$columns["price" ] 		= __("Price","Walleto");

		$columns["feat" ] 		= __("Featured","Walleto");

		$columns["thumbnail"] 	= __("Thumbnail","Walleto");

 

	return $columns;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_my_custom_columns($column)

{

	global $post;



	if ("thumbnail" == $column) 

	{

		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/post.php?post='.$post->ID.'&action=edit">'.walleto_get_first_post_image($post->ID,75,65).'</a>'; //shows up our post thumbnail that we previously created.

	}

	

	elseif ("feat" == $column)

	{

		$f = get_post_meta($post->ID,'featured', true);	

		if($f == "1") echo __("Yes","Walleto");

		else  echo __("No","Walleto");

	}

	

	elseif ("price" == $column)

	{	

		echo walleto_get_show_price(walleto_get_product_price($post->ID));

	}

	

	elseif ("ending" == $column)

	{	

		$dt = current_time('timestamp',0);

		$membership_available = get_post_meta($post->ID,'membership_available', true);

		

		if($dt > $membership_available) echo __('Expired','Walleto'); else 

		echo date_i18n('d-M-Y H:i:s', $membership_available);	

	}

	

 

}	

 /*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_product_price($pid)

{

	return get_post_meta($pid,'price',true);		

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_total_nr_of_product()

{

	$query = new WP_Query( "post_type=product&posts_per_page=1" );	

	return $query->found_posts;

}

/*************************************************************

*

*	Walleto (c) sitemile.com - function

*

**************************************************************/

function Walleto_get_total_nr_of_open_product()

{

	$query = new WP_Query( "meta_key=closed&meta_value=0&post_type=product&order=DESC&orderby=id&posts_per_page=1&paged=1" );	

	return $query->found_posts;

}

/*************************************************************

*

*	Walleto (c) sitemile.com - function

*

**************************************************************/

function Walleto_get_total_nr_of_closed_product()

{

	$query = new WP_Query( "meta_key=closed&meta_value=1&post_type=product&order=DESC&orderby=id&posts_per_page=1&paged=1" );	

	return $query->found_posts;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function Walleto_get_option_drop_down($arr, $name)

{

	$opts = get_option($name);

	$r = '<select name="'.$name.'">';

	foreach ($arr as $key => $value)

	{

		$r .= '<option value="'.$key.'" '.($opts == $key ? ' selected="selected" ' : "" ).'>'.$value.'</option>';		

		

	}

    return $r.'</select>'; 

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_add_theme_styles()  

{ 

	global $wp_query;

  	$new_auction_step = $wp_query->query_vars['step'];

        $w_action	  = $wp_query->query_vars['w_action'];

	

	

	

  	wp_register_style( 'bx_styles', get_bloginfo('template_url').'/css/bx_styles.css', array(), '20120822', 'all' );

	wp_register_script( 'social_pr', get_bloginfo('template_url').'/js/connect.js');

	

	

	wp_register_script( 'easing', get_bloginfo('template_url').'/js/jquery.easing.1.3.js');

	wp_register_script( 'bx_slider', get_bloginfo('template_url').'/js/jquery.bxslider.min.js');

	wp_register_script( 'jquery_cowntdown', get_bloginfo('template_url').'/js/jquery.countdown.js');

	wp_register_script( 'bootstrap_min', get_bloginfo('template_url').'/js/bootstrap.min.js');
	
	wp_register_script( 'html5', get_bloginfo('template_url').'/js/html5shiv.js');
	wp_register_script( 'respond', get_bloginfo('template_url').'/js/respond.min.js');
	
	wp_register_script( 'jquery', get_bloginfo('template_url').'/js/jquery.js');
	

	

	wp_register_style( 'bootstrap_style1', get_bloginfo('template_url').'/css/bootstrap_min.css', array(), '20120822', 'all' );

  	wp_register_style( 'bootstrap_style2', get_bloginfo('template_url').'/css/css.css', array(), '20120822', 'all' );

	wp_register_style( 'bootstrap_style3', get_bloginfo('template_url').'/css/bootstrap_responsive.css', array(), '20120822', 'all' );

	wp_register_style( 'bootstrap_ie6', 	get_bloginfo('template_url').'/css/bootstrap_ie6.css', array(), '20120822', 'all' );

	wp_register_style( 'bootstrap_gal', 	get_bloginfo('template_url').'/css/bootstrap_gal.css', array(), '20120822', 'all' );

	wp_register_style( 'fileupload_ui', 	get_bloginfo('template_url').'/css/jquery.fileupload-ui.css', array(), '20120822', 'all' );

	wp_register_style( 'uploadify_css', 	get_bloginfo('template_url').'/lib/uploadify/uploadify.css', array(), '20120822', 'all' );

	

	

	//wp_register_script( 'html5_js', get_bloginfo('template_url').'/js/html5.js');

	wp_register_script( 'jquery_ui', get_bloginfo('template_url').'/js/vendor/jquery.ui.widget.js');

	wp_register_script( 'templ_min', get_bloginfo('template_url').'/js/templ.min.js');

	wp_register_script( 'load_image', get_bloginfo('template_url').'/js/load_image.min.js');

	wp_register_script( 'canvas_to_blob', get_bloginfo('template_url').'/js/canvas_to_blob.js');

	wp_register_script( 'iframe_transport', get_bloginfo('template_url').'/js/jquery.iframe-transport.js');

	wp_register_script( 'load_image', get_bloginfo('template_url').'/js/load_image.js');

	

	

	wp_register_style( 'fileupload_ui', 	get_bloginfo('template_url').'/css/fileupload_ui.css', array(), '20120822', 'all' );

	wp_register_script( 'fileupload_main', get_bloginfo('template_url').'/js/jquery.fileupload.js');

	wp_register_script( 'fileupload_fp', get_bloginfo('template_url').'/js/jquery.fileupload-fp.js');

	wp_register_script( 'fileupload_ui', get_bloginfo('template_url').'/js/jquery.fileupload-ui.js');

	

	wp_register_script( 'locale_thing', get_bloginfo('template_url').'/js/locale.js');

	

	wp_register_script( 'main_thing', get_bloginfo('template_url').'/js/main.js');

	wp_register_script( 'js_cors_ie8', get_bloginfo('template_url').'/js/cors/jquery.xdr-transport.js');

	wp_register_script( 'jquery16', get_bloginfo('template_url').'/js/jquery16.js');

	

	//wp_deregister_script('jquery');

	//wp_register_script( 'jquery', get_bloginfo('template_url').'/js/jquery19.js');

	wp_register_script( 'my_scripts', get_bloginfo('template_url').'/js/my-script.js');

	wp_register_script( 'jquery_ui_min', get_bloginfo('template_url').'/js/jquery.ui.min.js');

 	wp_enqueue_script( 'dcjqmegamenu', get_bloginfo('template_url') . '/js/jquery.dcmegamenu.1.3.4.min.js', array('jquery') );

	wp_register_style( 'mega_menu_thing', 	get_bloginfo('template_url').'/css/menu.css', array(), '20120822', 'all' );

 	

	wp_enqueue_script( 'jqueryhoverintent', get_bloginfo('template_url') . '/js/jquery.hoverIntent.minified.js', array('jquery') );

	

	global $wp_styles, $wp_scripts;

	// enqueing:

  	 	 wp_enqueue_script( 'jqueryhoverintent' );

		 wp_enqueue_style( 'bx_styles' );

		 wp_enqueue_script( 'social_pr' );

		 wp_enqueue_script( 'easing' );

		 wp_enqueue_script( 'bx_slider' );

		 wp_enqueue_script( 'jquery_cowntdown' );

		 wp_enqueue_script( 'dcjqmegamenu' );

		wp_enqueue_style( 'mega_menu_thing' );

		

		

		if($new_auction_step == "2" or $new_auction_step == "1" or $w_action == "edit_product"  ):

		 

		 //wp_enqueue_script( 'jquery16' );

		 wp_enqueue_script( 'jquery_ui_min');

 

		

		 	  	// enqueing:

	  	if($new_auction_step == "2" or $w_action == "edit_product" )

		wp_enqueue_style( 'bootstrap_style1' );

	 	//wp_enqueue_style( 'bootstrap_style2' );

		//wp_enqueue_style( 'bootstrap_style3' );

		//wp_enqueue_style( 'bootstrap_ie6' );

		//wp_enqueue_style( 'bootstrap_gal' );

		wp_enqueue_style( 'fileupload_ui' );

		wp_enqueue_style( 'uploadify_css' );

		

		wp_enqueue_script( 'html5_js' );





		 

		 

		$uploaders = walleto_get_uploaders_tp();

		

		if($uploaders == "jquery")

		{

			wp_enqueue_script( 'jquery_ui' );

			wp_enqueue_script( 'templ_min' );

			wp_enqueue_script( 'load_image' );

			wp_enqueue_script( 'bootstrap_min' );

			wp_enqueue_script( 'canvas_to_blob' );

			wp_enqueue_script( 'iframe_transport' );

			wp_enqueue_script( 'fileupload_main' );

			wp_enqueue_script( 'fileupload_fp' );

			wp_enqueue_script( 'fileupload_ui' );

			wp_enqueue_script( 'main_thing' );

			wp_enqueue_script( 'js_cors_ie8' );

			

		}

		

		 wp_enqueue_script( 'locale_thing' );

		 wp_enqueue_script( 'uploadify_js' );

	 

	//$wp_styles->add_data('bootstrap_ie6', 'conditional', 'lte IE 7');

		else:

		

			//wp_enqueue_script('jquery');

			wp_enqueue_script('my_scripts');

		

		endif;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function get_product_category_fields($catid, $pid = '')

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."walleto_custom_fields order by ordr asc";	

	$r = $wpdb->get_results($s);

	

	$arr1 = array(); $i = 0;

	

	foreach($r as $row)

	{

		$ims 	= $row->id;

		$name 	= $row->name;

		$tp 	= $row->tp;

		

		if($row->cate == 'all')

		{ 

			$arr1[$i]['id'] 	= $ims; 

			$arr1[$i]['name'] 	= $name; 

			$arr1[$i]['tp'] 	= $tp; 

			$i++; 

		

		}

		else

		{

			$se = "select * from ".$wpdb->prefix."walleto_custom_relations where custid='$ims'";

			$re = $wpdb->get_results($se);

			

			if(count($re) > 0)

			foreach($re as $rowe) // = mysql_fetch_object($re))

			{

				if(count($catid) > 0)

				foreach($catid as $id_of_cat)

				{

				

					if($rowe->catid == $id_of_cat)

					{

						$flag_me = 1;

						for($k=0;$k<count($arr1);$k++)

						{

							if(	$arr1[$k]['id'] 	== $ims	) {  $flag_me = 0; break; }						

						}

						

						if($flag_me == 1)

						{

							$arr1[$i]['id'] 	= $ims; 

							$arr1[$i]['name'] 	= $name; 

							$arr1[$i]['tp'] 	= $tp;

							$i++;

						}

					}

				}

			}

		}

	}



	$arr = array();

	$i = 0;

	

	for($j=0;$j<count($arr1);$j++)

	{

		$ids 	= $arr1[$j]['id'];

		$tp 	= $arr1[$j]['tp'];

		

		$arr[$i]['field_name']  = $arr1[$j]['name'];

		$arr[$i]['id']  = '<input type="hidden" value="'.$ids.'" name="custom_field_id[]" />';

		

		if($tp == 1) 

		{

		

		$teka 	= !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;

		

		$arr[$i]['value']  = '<input class="do_input p_text_box" type="text" name="custom_field_value_'.$ids.'" 

		value="'.(isset($_POST['custom_field_value_'.$ids]) ? $_POST['custom_field_value_'.$ids] : $teka ).'" />';

		

		}

		

		if($tp == 5)

		{

		

			$teka 	= !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;

			$teka 	= $teka[0];

			$value 	= isset($_POST['custom_field_value_'.$ids]) ? $_POST['custom_field_value_'.$ids] : $teka;

			

			$arr[$i]['value']  = '<textarea rows="5" cols="40" name="custom_field_value_'.$ids.'">'.$value.'</textarea>';

		

		}

		

		if($tp == 3) //radio

		{

			$arr[$i]['value']  = '';

			

				$s2 = "select * from ".$wpdb->prefix."walleto_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 	= !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids, true) : "" ;

					$teka 	= $teka[0];

					

					if(isset($_POST['custom_field_value_'.$ids]))

					{

						if($_POST['custom_field_value_'.$ids] == $row2->valval) $value = 'checked="checked"';

						else $value = '';

					}

					elseif(!empty($pid))

					{

						$v = get_post_meta($pid, 'custom_field_ID_'.$ids, true);

						if($v == $row2->valval) $value = 'checked="checked"';

						else $value = ''; 

					

					}				

					else $value = '';

					

					$arr[$i]['value']  .= '<input type="radio" '.$value.' value="'.$row2->valval.'" name="custom_field_value_'.$ids.'"> '.$row2->valval.'<br/>';

				}

		}

		

		

		if($tp == 4) //checkbox

		{

			$arr[$i]['value']  = '';

			

				$s2 = "select * from ".$wpdb->prefix."walleto_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 		= !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;

					//$teka 		= $teka[0];

					$teka_ch 	= '';

					

					if(is_array($teka))

					{	

						foreach($teka as $te)

						{

							

							if(trim($te) == trim($row2->valval)) { $teka_ch = "checked='checked'";  break; }

						}	

								

					}

					elseif($row2->valval == $teka) $teka_ch = "checked='checked'";

					else $teka_ch = '';

					

					$teka_ch 	= isset($_POST['custom_field_value_'.$ids]) ? "checked='checked'" : $teka_ch;

					

					$arr[$i]['value']  .= '<input type="checkbox" '.$teka_ch.' value="'.$row2->valval.'" name="custom_field_value_'.$ids.'[]"> '.$row2->valval.'<br/>';

				}

		}

		

		if($tp == 2) //select

		{

			$arr[$i]['value']  = '<select class="do_input" name="custom_field_value_'.$ids.'" /><option value="">'.__('Select','Walleto').'</option>';

			

				$s2 = "select * from ".$wpdb->prefix."walleto_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 	= !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;



					if(!empty($teka))

					{	

						foreach($teka as $te)

						{

							if(trim($te) == trim($row2->valval)) { $teka = "selected='selected'"; break; }

						}	

						

								

					}

					else $teka = '';

					

					if(isset($_POST['custom_field_value_'.$ids]) && $_POST['custom_field_value_'.$ids] == $row2->valval)

					$value = "selected='selected'" ;

					else $value = $teka;

					

					

					$arr[$i]['value']  .= '<option '.$value.' value="'.$row2->valval.'">'.$row2->valval.'</option>';

				

				}

			$arr[$i]['value']  .= '</select>';

		}

		

		$i++;

	}

	

	return $arr;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_custom_taxonomy_count($ptype,$pterm) {

	global $wpdb;

	

	$s = "select * from ".$wpdb->prefix."terms where slug='$pterm'";

	$r = $wpdb->get_results($s);

	$r = $r[0];

	

	$term_id = $r->term_id;

	



	

	//--------

	

	$s = "select * from ".$wpdb->prefix."term_taxonomy where term_id='$term_id'";

	$r = $wpdb->get_results($s);

	$r = $r[0];

	

	$term_taxonomy_id = $r->term_taxonomy_id;



	

	//--------

	

	$s = "select distinct posts.ID from ".$wpdb->prefix."term_relationships rel, $wpdb->postmeta wpostmeta, $wpdb->posts posts 

	 where rel.term_taxonomy_id='$term_taxonomy_id' AND rel.object_id = wpostmeta.post_id AND posts.ID = wpostmeta.post_id AND posts.post_status = 'publish' AND posts.post_type = 'product' AND wpostmeta.meta_key = 'closed' AND wpostmeta.meta_value = '0'";

	$r = $wpdb->get_results($s);

	



	

	return count($r);

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_admin_main_head_scr()

{

	

 

	wp_enqueue_script("jquery-ui-widget");

	wp_enqueue_script("jquery-ui-mouse");

	wp_enqueue_script("jquery-ui-tabs");

	wp_enqueue_script("jquery-ui-datepicker");

	

?>	

	

    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    

    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/admin.css" type="text/css" />    

    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/colorpicker.css" type="text/css" />

    <link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_url'); ?>/css/layout.css" />

	<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

	

    <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/ui-thing.css" />

	<script type="text/javascript" language="javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-ui-timepicker-addon.js"></script>

    

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/idtabs.js"></script>	

 

		

		<script type="text/javascript">

			

			var $ = jQuery;

		jQuery(document).ready(function() {		

  jQuery("#usual2 ul").idTabs("tabs1"); 

		});

		</script>

	



	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/colorpicker.js"></script>

    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/eye.js"></script>

    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/utils.js"></script>

    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/layout.js?ver=1.0.2"></script>		



<?php	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/ 

function walleto_get_view_grd()

{

	if(isset($_SESSION['view_tp']))	

	{

		if(	$_SESSION['view_tp'] == "grid") return "grid"; else return "normal";

	}

	return "normal";

	

} 

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_uploaders_tp()

{

	$Walleto_uploader_type = get_option('Walleto_uploader_type');

	if(empty($Walleto_uploader_type)) return "html";

	

	return $Walleto_uploader_type;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_images_cost_extra($pid)

{

	$Walleto_charge_fees_for_images 	= get_option('Walleto_charge_fees_for_images');

	$Walleto_extra_image_charge			= get_option('Walleto_extra_image_charge');



		

	if($Walleto_charge_fees_for_images == "yes")

	{

		$Walleto_nr_of_free_images = get_option('Walleto_nr_of_free_images');

		if(empty($Walleto_nr_of_free_images)) $Walleto_nr_of_free_images = 1;	

		

		$Walleto_get_post_nr_of_images = Walleto_get_post_nr_of_images($pid);

		

		$nr_imgs = $Walleto_get_post_nr_of_images - $Walleto_nr_of_free_images;

		if($nr_imgs > 0)

		{

			return $nr_imgs*	$Walleto_extra_image_charge;

		}

		

	}

	

	return 0;

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_item_primary_cat($pid)

{

	$product_cat = wp_get_object_terms($pid, 'product_cat');	

	if(is_array($product_cat))

	{

		return 	$product_cat[0]->term_id;

	}

	

	return 0;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_post_nr_of_images($pid)

{

	

		//---------------------

		// build the exclude list

		$exclude = array();

		

		$args = array(

		'order'          => 'ASC',

		'post_type'      => 'attachment',

		'post_parent'    => $pid,

		'meta_key'		 => 'another_reserved1',

		'meta_value'	 => '1',

		'numberposts'    => -1,

		'post_status'    => null,

		);

		$attachments = get_posts($args);

		if ($attachments) {

			foreach ($attachments as $attachment) {

			$url = $attachment->ID;

			array_push($exclude, $url);

		}

		}

		

		//-----------------

	

	

		$arr = array();

		

		$args = array(

		'order'          => 'ASC',

		'orderby'        => 'post_date',

		'post_type'      => 'attachment',

		'post_parent'    => $pid,

		'exclude'    		=> $exclude,

		'post_mime_type' => 'image',

		'numberposts'    => -1,

		); $i = 0;

		

		$attachments = get_posts($args); 

		if ($attachments) {

		

			foreach ($attachments as $attachment) {

						

				$url = wp_get_attachment_url($attachment->ID);

				array_push($arr, $url);

			  

		}

			return count($arr);

		}

		return 0;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_wp_get_attachment_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {



	$html = '';

	$image = wp_get_attachment_image_src($attachment_id, $size, $icon);

	if ( $image ) {

		list($src, $width, $height) = $image;

		$hwstring = image_hwstring($width, $height);

		if ( is_array($size) )

			$size = join('x', $size);

		$attachment =& get_post($attachment_id);

		$default_attr = array(

			'src'	=> $src,

			'class'	=> "attachment-$size",

			'alt'	=> trim(strip_tags( get_post_meta($attachment_id, '_wp_attachment_image_alt', true) )), // Use Alt field first

			'title'	=> trim(strip_tags( $attachment->post_title )),

		);

		if ( empty($default_attr['alt']) )

			$default_attr['alt'] = trim(strip_tags( $attachment->post_excerpt )); // If not, Use the Caption

		if ( empty($default_attr['alt']) )

			$default_attr['alt'] = trim(strip_tags( $attachment->post_title )); // Finally, use the title



		$attr = wp_parse_args($attr, $default_attr);

		$attr = apply_filters( 'wp_get_attachment_image_attributes', $attr, $attachment );

		$attr = array_map( 'esc_attr', $attr );

		$html = rtrim("<img $hwstring");

		 

		$html = $attr['src'];

	}



	return $html;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_create_post_type() {

  

	global $products_url_thing, $product_thing_list, $shop_url_thing;

	

  $icn = get_bloginfo('template_url')."/images/prodicon.png";

  register_post_type( 'product',

    array(

      'labels' => array(

        'name' 			=> __( 'Products','Walleto' ),

        'singular_name' => __( 'Product','Walleto' ),

		'add_new' 		=> __('Add New Product','Walleto'),

		'new_item' 		=> __('New Product','Walleto'),

		'edit_item'		=> __('Edit Product','Walleto'),

		'add_new_item' 	=> __('Add New Product','Walleto'),

		'search_items' 	=> __('Search Products','Walleto'),),

		

      'public' => true,

	  'menu_position' => 5,

	  'register_meta_box_cb' => 'walleto_products_set_metaboxes',

	  'has_archive' => "product-list",

    	'rewrite' => array('slug'=> $products_url_thing."/%product_cat%",'with_front'=>false), 

		'supports' => array('title','editor','author','thumbnail','excerpt','comments'),

	  '_builtin' => false,

	  'menu_icon' => $icn,

	  'publicly_queryable' => true,

	  'hierarchical' => false 



    ));

	

	



	$icn = get_bloginfo('template_url')."/images/shopsicon.png";

  register_post_type( 'shop',

    array(

      'labels' => array(

        'name' 			=> __( 'Shops','Walleto' ),

        'singular_name' => __( 'Shop','Walleto' ),

		'add_new' 		=> __('Add New Shop','Walleto'),

		'new_item' 		=> __('New Shop','Walleto'),

		'edit_item'		=> __('Edit Shop','Walleto'),

		'add_new_item' 	=> __('Add New Shop','Walleto'),

		'search_items' 	=> __('Search Shops','Walleto'),),

		

      'public' => true,

	  'menu_position' => 5,

	  'register_meta_box_cb' => 'walleto_shops_set_metaboxes',

	  'has_archive' => "shop-list",

    	'rewrite' => true, 

		'supports' => array('title','editor','author','thumbnail','excerpt','comments'),

	  '_builtin' => false,

	  'menu_icon' => $icn,

	  'publicly_queryable' => true,

	  'hierarchical' => false 



    ));

	

  

  global $category_url_link, $location_url_link;



	register_taxonomy( 'product_cat', array('shop','product'), array( 'hierarchical' => true, 'label' => __('Product Categories','Walleto'),

	'rewrite'                  =>    true ) );

	

	register_taxonomy( 'shop_location', array('shop'), array( 'hierarchical' => true, 'label' => __('Shop Locations','Walleto'),

	'rewrite'                  =>    true ) );

 

 

 

	add_post_type_support( 'product', 'author' );

	//add_post_type_support( 'product', 'custom-fields' );

	register_taxonomy_for_object_type('post_tag', 'product');

	

	flush_rewrite_rules();



}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_categories($taxo, $selected = "", $include_empty_option = "", $ccc = "")

{

	$args = "orderby=name&order=ASC&hide_empty=0&parent=0";

	$terms = get_terms( $taxo, $args );

	

	$ret = '<select name="'.$taxo.'_cat" class="'.$ccc.'" id="'.$ccc.'">';

	if(!empty($include_empty_option)) $ret .= "<option value=''>".$include_empty_option."</option>";

	

	if(empty($selected)) $selected = -1;

	

	foreach ( $terms as $term )

	{

		$id = $term->term_id;

		

		$ret .= '<option '.($selected == $id ? "selected='selected'" : " " ).' value="'.$id.'">'.$term->name.'</option>';

		

		$args = "orderby=name&order=ASC&hide_empty=0&parent=".$id;

		$sub_terms = get_terms( $taxo, $args );	

		

		if($sub_terms)

		foreach ( $sub_terms as $sub_term )

		{

			$sub_id = $sub_term->term_id; 

			$ret .= '<option '.($selected == $sub_id ? "selected='selected'" : " " ).' value="'.$sub_id.'">&nbsp; &nbsp;|&nbsp;  '.$sub_term->name.'</option>';

			

			$args2 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id;

			$sub_terms2 = get_terms( $taxo, $args2 );	

			

			if($sub_terms2)

			foreach ( $sub_terms2 as $sub_term2 )

			{

				$sub_id2 = $sub_term2->term_id; 

				$ret .= '<option '.($selected == $sub_id2 ? "selected='selected'" : " " ).' value="'.$sub_id2.'">&nbsp; &nbsp; &nbsp; &nbsp;|&nbsp; 

				 '.$sub_term2->name.'</option>';

				 

				 $args3 = "orderby=name&order=ASC&hide_empty=0&parent=".$sub_id2;

				 $sub_terms3 = get_terms( $taxo, $args3 );	

				 

				 if($sub_terms3)

				 foreach ( $sub_terms3 as $sub_term3 )

				{

					$sub_id3 = $sub_term3->term_id; 

					$ret .= '<option '.($selected == $sub_id3 ? "selected='selected'" : " " ).' value="'.$sub_id3.'">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;|&nbsp; 

					 '.$sub_term3->name.'</option>';

				}

			}

		}

		

	}

	

	$ret .= '</select>';

	

	return $ret;

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_post_new_with_pid_stuff_thg($pid, $step = 1, $fin = '')

{

	$using_perm = walleto_using_permalinks();

	if($using_perm)	return get_permalink(get_option('Walleto_post_new_page_id')). "?product_id=" . $pid."&step=".$step.(!empty($fin) ? "&finalise=yes" : '');

			else return get_bloginfo('siteurl'). "/?page_id=". get_option('Walleto_post_new_page_id'). "&product_id=" . $pid."&step=".$step.(!empty($fin) ? "&finalise=yes" : '');	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_rewrite_rules( $wp_rewrite )

{



		global $category_url_link, $location_url_link;

		$new_rules = array( 

		



		$category_url_link.'/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?product_cat='.$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),

        $category_url_link.'/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?product_cat='.$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),

        $category_url_link.'/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?product_cat='.$wp_rewrite->preg_index(1)."&paged=".$wp_rewrite->preg_index(2),

        $category_url_link.'/([^/]+)/?$' => 'index.php?product_cat='.$wp_rewrite->preg_index(1)

			





		);



		$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;



}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



 function walleto_post_type_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {

	 

	global $category_url_link;

	 

    if ( strpos('%product_cat%', $post_link) === 'FALSE' ) {

      return $post_link;

    }

    $post = get_post($id);

    if ( !is_object($post) || $post->post_type != 'product' ) {

	

		if(walleto_using_permalinks())		

      return str_replace("product_cat", $category_url_link ,$post_link);

	  else return $post_link; 

    }

    $terms = wp_get_object_terms($post->ID, 'product_cat');

    if ( !$terms ) {

      return str_replace('%product_cat%', 'uncategorized', $post_link);

    }

    return str_replace('%product_cat%', $terms[0]->slug, $post_link);

  }

  

  /*****************************************************************************/

  

   function walleto_post_type_link_filter_function2( $post_link, $id = 0, $leavename = FALSE ) {

	 

	global $category_url_link;

	 

    if ( strpos('%shop_cat%', $post_link) === 'FALSE' ) {

      return $post_link;

    }

    $post = get_post($id);

    if ( !is_object($post) || $post->post_type != 'shop' ) {

	

		if(walleto_using_permalinks())		

      return str_replace("product_cat", $category_url_link ,$post_link);

	  else return $post_link; 

    }

    $terms = wp_get_object_terms($post->ID, 'product_cat');

    if ( !$terms ) {

      return str_replace('%shop_cat%', 'uncategorized', $post_link);

    }

    return str_replace('%shop_cat%', $terms[0]->slug, $post_link);

  }

	

	

add_filter('post_type_link', 'Walleto_post_type_link_filter_function', 1, 3);

add_filter('post_type_link', 'Walleto_post_type_link_filter_function2', 1, 3);



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

 function walleto_post_tax_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {

	global $category_url_link;

    

	if(!walleto_using_permalinks())	 return $post_link;

	return str_replace("product_cat",	$category_url_link ,$post_link);

  }



add_filter('term_link', 'walleto_post_tax_link_filter_function', 1, 3);

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_slider_post()

{

	do_action('walleto_slider_post');	

}



add_filter('walleto_slider_post', 'walleto_slider_post_function');

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_slider_post_function()

{

	?>

	

	 <li>
	        <div class="product_block_top product_block_light_strip"></div>              
                <div class="product_block_middle">
                   <a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php
                    echo walleto_get_first_post_image(get_the_ID(), '', '', '', $image_thing_tags, 1);?>
                  </a>
                  <div class="product-content">
		   <a class="product_name" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php $ttl = get_the_title();
                        $xx  = 24;
                       if (strlen($ttl) > $xx)
                       echo substr($ttl, 0, $xx);
                       else
                       echo $ttl;?>
                   </a>
		   <?php //if($post->post_content!="") {?>
                    <p class="product_detail">
		     <?php  echo substr(strip_tags($post->post_content), 0, 30);?>
		    </p>
		    <?php //} else{?>
		     <!-- <p class="product_detail"> </p>-->
		    <?php //}?>
		    
                  </div>
	              <div class="product-price">
                        <span class="product_orignal_price">$190.00</span>
			<span class="product_discount_price"><?php echo walleto_get_show_price(walleto_get_product_price($pid), 0);?>
                    
                      </div>
               <a href="<?php the_permalink();?>" class="buy_now_btn"><i class="icon-shopping-cart"></i> Buy Now </a>
                </div>
              	<div class="product_block_bottom product_block_light_strip"></div>
		</li>
           
	

	<?php

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/ 

function walleto_get_post($arr = '')

{

	do_action('walleto_get_post', $arr);	

}



function walleto_get_post_shop($arr = '')

{

	do_action('walleto_get_post_shop', $arr);	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_post_normal_view($arr = '')

{

	do_action('walleto_get_post_normal_view', $arr);	

}



function walleto_get_post_list_view($arr = '')

{

	do_action('walleto_get_post_list_view', $arr);	

}





function walleto_get_shop_list_view($arr = '')

{

	do_action('walleto_get_shop_list_view', $arr);	

}





add_filter('walleto_get_post',						'walleto_get_post_function',0,1);

add_filter('walleto_get_post_shop',					'walleto_get_post_shop_function',0,1);

add_filter('walleto_get_post_normal_view',			'walleto_get_post_normal_view_function',0,1);



add_filter('walleto_get_post_list_view',			'walleto_get_post_list_view_function',0,1);

add_filter('walleto_get_shop_list_view',			'walleto_get_shop_list_view_function',0,1);



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_shop_list_view_function()

{

	global $post;

	

	?>

    			<div class="post_list_view" id="post-ID-<?php the_ID(); ?>">

                

                

                <?php if($featured == "1"): ?>

                <div class="featured-two"></div>

                <?php endif; ?>

                

                

    

                <div class="image_holder_list"><a href="<?php the_permalink(); ?>"><?php echo walleto_get_first_post_image(get_the_ID(),'','','','small-image-post',1); ?></a></div>

                <div class="details_holder_list"><?php 

				 

				$ttl = get_the_title();

				echo '<a href="'.get_permalink(get_the_ID()).'">'.$ttl."</a>";

				

				

				

				 ?></div>

                 

                 <div class="thing_shop_content"><?php echo substr($post->post_content,0,180); ?><br/><br/>

                 

                 <a href="<?php echo get_permalink(get_the_ID()); ?>" class="explore_shop"><?php _e('Expore this Shop','Walleto'); ?></a>

                 </div>

                 

                 

              

                </div>

    

    <?php	

}





/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_post_list_view_function( $arr = '')

{



			if($arr[0] == "winner") $pay_this_me = 1;

			if($arr[0] == "unpaid") $unpaid = 1;

			

			$paid = get_post_meta(get_the_ID(),'paid',true);

 

			$closed 		= get_post_meta(get_the_ID(), 'closed', true);

			$post 			= get_post(get_the_ID());

 

			$buy_now 		= get_post_meta(get_the_ID(), 'buy_now', true);

			$featured 		= get_post_meta(get_the_ID(), 'featured', true);

			//$current_bid 		= get_post_meta(get_the_ID(), 'current_bid', true);

			

			$post = get_post(get_the_ID());

			$shop_name = get_userdata($post->post_author);

			$shop_name = $shop_name->user_login;

			

			

			global $current_user;

			get_currentuserinfo();

			$uid = $current_user->ID;

			

			$pid = get_the_ID();
                        $image_thing_tags = 'main-image-post2';
			

?>

	    <li>
	        <div class="product_block_top product_block_light_strip"></div>              
                <div class="product_block_middle">
                <a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php
                    echo walleto_get_first_post_image(get_the_ID(),244,214,$image_thing_tags, 1);?>
                </a>
                <div class="product-content">
		<a class="product_name" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php $ttl = get_the_title();
                        $xx  = 24;
                       if (strlen($ttl) > $xx)
                       echo substr($ttl, 0, $xx);
                       else
                       echo $ttl;?>
                </a>
                <?php //if($post->post_content!="") {?>
                <p class="product_detail">
                <?php  echo substr(strip_tags($post->post_content), 0, 30);?>
                </p>
                
		    
                </div>
                <div class="product-price">
                 <!-- <span class="product_orignal_price">$190.00</span>-->
                  <span class="product_discount_price"><?php echo walleto_get_show_price(walleto_get_product_price($pid), 0);?>
              
                </div>
                <a href="<?php the_permalink();?>" class="buy_now_btn"><i class="icon-shopping-cart"></i> Buy Now </a>
                </div>
              	<div class="product_block_bottom product_block_light_strip"></div>
	    </li>

<?php

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_post_normal_view_function( $arr = '')

{



			if($arr[0] == "winner") $pay_this_me = 1;

			if($arr[0] == "unpaid") $unpaid = 1;

			

			$paid = get_post_meta(get_the_ID(),'paid',true);

			

			$ending 		= get_post_meta(get_the_ID(), 'ending', true);

			$sec 			= $ending - current_time('timestamp',0);

			$location 		= get_post_meta(get_the_ID(), 'Location', true);		

			$closed 		= get_post_meta(get_the_ID(), 'closed', true);

			$post 			= get_post(get_the_ID());

			$only_buy_now 	= get_post_meta(get_the_ID(), 'only_buy_now', true);

			$buy_now 		= get_post_meta(get_the_ID(), 'buy_now', true);

			$featured 		= get_post_meta(get_the_ID(), 'featured', true);

			//$current_bid 		= get_post_meta(get_the_ID(), 'current_bid', true);

			

			$post = get_post(get_the_ID());

			

			global $current_user;

			get_currentuserinfo();

			$uid = $current_user->ID;

			

			$pid = get_the_ID();

			

?>

				<div class="post_normal_view" id="post-ID-<?php the_ID(); ?>">

                

                

                <?php if($featured == "1"): ?>

                <div class="featured-two"></div>

                <?php endif; ?>

                

                

    

               <div class="image_holder_grid"><a href="<?php the_permalink(); ?>"><?php echo walleto_get_first_post_image(get_the_ID(),'','','','small-image-post',1); ?></a></div>

                <div class="details_holder_grid"><?php 

				 

				$ttl = get_the_title();

				$xx = 16;

				

				if(strlen($ttl) > $xx)

				echo substr(0,$xx, $ttl)."..";

				else

				echo $ttl

				

				 ?></div>

              

                </div>

<?php

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/
/* comment by cis team 25feb start for shops product
function walleto_get_post_shop_function()
{
			$post = get_post(get_the_ID());
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			$pid = get_the_ID();
			//global $image_thing_tags;			
			//if(empty($image_thing_tags)) 
			$image_thing_tags = 'main-image-post';
                     ?>
          <div class="post_grid" id="post-ID-<?php the_ID(); ?>
                <?php if($featured == "1"): ?>
                <div class="featured-two"></div>
                <?php endif; ?>
                 <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo walleto_get_first_post_image(get_the_ID(),'','','',$image_thing_tags,1); ?></a></div>
                <div class="details_holder_grids">
			<div class="details_holder_grids_ttl">
			    <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php $ttl = get_the_title();
					$xx = 26;
					if(strlen($ttl) > $xx)
					echo substr($ttl, 0,$xx);
					else
					echo $ttl
					 ?>
			    </a>
			</div>
                 </div>
                </div>
<?php	
}
comment end 25feb for shops products

*/


function walleto_get_post_shop_function()
{
			$post = get_post(get_the_ID());
			global $current_user;
			get_currentuserinfo();
			$uid = $current_user->ID;
			$pid = get_the_ID();
			//global $image_thing_tags;			
			//if(empty($image_thing_tags)) 
			$image_thing_tags = 'main-image-post';
                     ?>
           <li>
	         <div class="product_block_top product_block_light_strip"></div>              
                <div class="product_block_middle">
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo walleto_get_first_post_image(get_the_ID(),184,161,$image_thing_tags,1); ?>
		   </a>
		
                <div class="product-content">
			<div class="details_holder_grids_ttl">
			    <a class="red-txt" title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php $ttl = get_the_title();
					$xx = 26;
					if(strlen($ttl) > $xx)
					echo substr($ttl, 0,$xx);
					else
					echo $ttl
					 ?>
			    </a>
			</div>
                 </div>
		</div>
            </li>
<?php	
}
/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

/* by cis group 24feb start */

function walleto_get_post_function($arr = '')
   {
     ?>
	<?php
    if ($arr[0] == "winner")
        $pay_this_me = 1;
    
    if ($arr[0] == "unpaid")
    $unpaid = 1;
    $paid = get_post_meta(get_the_ID(), 'paid', true);
    $ending = get_post_meta(get_the_ID(), 'ending', true);
    $sec = $ending - current_time('timestamp', 0);
    $location = get_post_meta(get_the_ID(), 'Location', true);
    $closed = get_post_meta(get_the_ID(), 'closed', true);
    $post = get_post(get_the_ID());
    $only_buy_now = get_post_meta(get_the_ID(), 'only_buy_now', true);
    $buy_now = get_post_meta(get_the_ID(), 'buy_now', true);
    $featured = get_post_meta(get_the_ID(), 'featured', true);
    //$current_bid 		= get_post_meta(get_the_ID(), 'current_bid', true);
    $post = get_post(get_the_ID());
   // echo"<pre>"; print_r($post);
    global $current_user;
    get_currentuserinfo();
    $uid = $current_user->ID;
    $pid = get_the_ID();
    global $image_thing_tags;
    if (empty($image_thing_tags))
        $image_thing_tags = 'main-image-post';
?>

            <li>
	        <div class="product_block_top product_block_light_strip"></div>              
                <div class="product_block_middle allproduct">
                <a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php
                    echo walleto_get_first_post_image(get_the_ID(),184,161,$image_thing_tags, 1);?>
                </a>
                <div class="product-content">
		<a class="product_name" title="<?php the_title();?>" href="<?php the_permalink();?>"><?php $ttl = get_the_title();
                        $xx  = 24;
                       if (strlen($ttl) > $xx)
                       echo substr($ttl, 0, $xx);
                       else
                       echo $ttl;?>
                </a>
                <?php //if($post->post_content!="") {?>
                <p class="product_detail">
                <?php  echo substr(strip_tags($post->post_content), 0, 30);?>
                </p>
                
		    
                </div>
                <div class="product-price">
                 <!-- <span class="product_orignal_price">$190.00</span>-->
                  <span class="product_discount_price"><?php echo walleto_get_show_price(walleto_get_product_price($pid), 0);?>
              
                </div>
                <a href="<?php the_permalink();?>" class="buy_now_btn"><i class="icon-shopping-cart"></i> Buy Now </a>
                </div>
              	<div class="product_block_bottom product_block_light_strip"></div>
	    </li>
           
<?php
   }
/* by cis group 24feb end */
/*




   
/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_first_post_image($pid, $w = 100, $h = 100, $clss = '', $string_image_size = '', $m = 0)

{

	

	//---------------------

	// build the exclude list

	$exclude = array();

	

	$args = array(

	'order'          => 'ASC',

	'post_type'      => 'attachment',

	'post_parent'    => get_the_ID(),

	'meta_key'		 => 'another_reserved1',

	'meta_value'	 => '1',

	'numberposts'    => -1,

	'post_status'    => null,

	);

	$attachments = get_posts($args);

	if ($attachments) {

	    foreach ($attachments as $attachment) {

		$url = $attachment->ID;

		array_push($exclude, $url);

	}

	}

	

	//-----------------



	$args = array(

	'order'          => 'ASC',

	'orderby'        => 'post_date',

	'post_type'      => 'attachment',

	'post_parent'    => $pid,

	'exclude'    		=> $exclude,

	'post_mime_type' => 'image',

	'post_status'    => null,

	'numberposts'    => 1,

	);

	$attachments = get_posts($args);

	if ($attachments) {

	    foreach ($attachments as $attachment) 

	    {

			if($m == 1)

			$url = wp_get_attachment_image( $attachment->ID, $string_image_size );

			else

			$url = wp_get_attachment_image( $attachment->ID, array($w, $h) ); //wp_get_attachment_link($attachment->ID,  array($w, $h));

			

			return $url;	  

		}

	}

	else{

			global $_wp_additional_image_sizes;

			if(!is_int($w))

			{

				$an = $_wp_additional_image_sizes[$string_image_size];			

				$w = $an['width'];

				$h = $an['height'];

				//$clss = 'image_class';

			}

			

		 

			

			return '<img src="' . get_bloginfo('template_url') .'/images/nopic.png' . '" alt="no image" width="'.$w.'" height="'.$h.'" class="'.$clss.'" />';

			

	}

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_products_set_metaboxes()

{

		add_meta_box( 'shop_mem', 			'Product Options',				'walleto_product_options_metabox', 	'product', 'side','high' );

		add_meta_box( 'product_images', 		'Product Images / Portfolio',			'walleto_product_images_metabox', 	'product', 'advanced','high' );

		add_meta_box( 'product_info', 			'Product Information Details',			'walleto_product_info_metabox', 	'product', 'advanced','high' );

		add_meta_box( 'custom_fields', 			'Product Custom Fields',			'walleto_product_custom_fields_metabox','product', 'advanced','high' );

 

		do_action('walleto_meta_boxes_menu_products');	

		

}



function walleto_product_custom_fields_metabox()

{      

	global $post, $wpdb;

	$pid = $post->ID;

	?>

    <table width="100%">

    <input type="hidden" value="1" name="fromadmin" />

	<?php

		$cat 		  	= wp_get_object_terms($pid, 'product_cat');

		$catidarr 		= array();

		

		foreach($cat as $catids)

		{

			$catidarr[] = $catids->term_id;

		}

	

		$arr 	= get_product_category_fields($catidarr, $pid);

		

		for($i=0;$i<count($arr);$i++)

		{

			

			        echo '<tr>';

					echo '<td>'.$arr[$i]['field_name'].$arr[$i]['id'].':</td>';

					echo '<td>'.$arr[$i]['value'];

					do_action('Walleto_step3_after_custom_field_'.$arr[$i]['id'].'_field');

					echo '</td>';

					echo '</tr>';

		}	

	

	?> 

    

    

    </table>

    <?php	

	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_userid_from_username($user)

{			

	$user = get_user_by('login', $user);

	if($user == false) return false;

	

	return $user->ID;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_username_is_valid($u)

{

	global $wpdb;

	$s = "select ID from ".$wpdb->users." where user_login='$u'";

	$r = $wpdb->get_results($s);

	

	$nr = count($r);

	

	if($nr == 0) return false; 

	return true;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function Walleto_insert_pages($page_ids, $page_title, $page_tag, $parent_pg = 0 )

{

	

		$opt = get_option($page_ids);			

		if(!Walleto_check_if_page_existed($opt))

		{

			

			$post = array(

			'post_title' 	=> $page_title, 

			'post_content' 	=> $page_tag, 

			'post_status' 	=> 'publish', 

			'post_type' 	=> 'page',

			'post_author' 	=> 1,

			'ping_status' 	=> 'closed', 

			'post_parent' 	=> $parent_pg);

			

			$post_id = wp_insert_post($post);

				

			update_post_meta($post_id, '_wp_page_template', 'walleto-special-page-template.php');

			update_option($page_ids, $post_id);

		

		}

				

	

}





/*************************************************************

*

*	Walleto (c) sitemile.com - function

*

**************************************************************/

function Walleto_check_if_page_existed($pid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."posts where post_type='page' AND post_status='publish' AND ID='$pid'";

	$r = $wpdb->get_results($s);

	

	if(count($r) > 0) return true;

	return false;	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_product_options_metabox()

{

	global $current_user;

	get_currentuserinfo();

	$cid = $current_user->ID;

	

	global $post;

	$pid = $post->ID;

	

	$f = get_post_meta($pid, "featured", true);

	$c = get_post_meta($pid, "status", true);

	

	?>

    

    <input type="hidden" value="1" name="fromadmin" />

    <table width="100%">

    	<tr>

        <td height="30"><?php _e('Price:','Walleto'); ?></td>

        <td><input type="text" size="10" name="price" value="<?php echo get_post_meta($pid,'price',true); ?>" /> <?php echo walleto_get_currency(); ?></td>

        </tr>

        

        <tr>

        <td height="30"><?php _e('Quantity:','Walleto'); ?></td>

        <td><input type="text" size="8" name="quant" value="<?php echo get_post_meta($pid,'quant',true); ?>" /></td>

        </tr>

        

        <tr>

        <td height="30"><?php _e('Shipping:','Walleto'); ?></td>

        <td><input type="text" size="10" name="shipping" value="<?php echo get_post_meta($pid,'shipping',true); ?>" /> <?php echo walleto_get_currency(); ?></td>

        </tr>

 

        

        <tr>

        <td height="30"><?php _e('Featured:','Walleto'); ?></td>

        <td><input type="checkbox" value="1" name="featured" <?php if($f == '1') echo ' checked="checked" '; ?> /></td>

        </tr>

    

    

     <tr>

        <td height="30"><?php _e('Paused/Hidden:','Walleto'); ?></td>

        <td><input type="checkbox" value="active" name="status" <?php if($c != 'active') echo ' checked="checked" '; ?> /></td>

        </tr>

    

    </table>

    

    

    <?php	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_shop_images_metabox()

{

global $current_user;

	get_currentuserinfo();

	$cid = $current_user->ID;

	

	global $post;

	$pid = $post->ID;





?>

	

    

    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/jquery.uploadify-3.1.js"></script>     

	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.css" type="text/css" />

	

    <script type="text/javascript">

	

	function delete_this2(id)

	{

		 jQuery.ajax({

						method: 'get',

						url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_ad_delete_pid='+id,

						dataType : 'text',

						success: function (text) {   jQuery('#image_ss'+id).remove();  }

					 });

		  //alert("a");

	

	}



	

	

	jQuery(function() {

		

		jQuery("#fileUpload3").uploadify({

			height        : 30,

			auto:			true,

			swf           : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.swf',

			uploader      : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploady.php',

			width         : 120,

			fileTypeExts  : '*.jpg;*.jpeg;*.gif;*.png',

			formData    : {'ID':<?php echo $pid; ?>,'author':<?php echo $cid; ?>},

			onUploadSuccess : function(file, data, response) {

			

			//alert(data);

			var bar = data.split("|");

			

jQuery('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" /><a href="javascript: void(0)" onclick="delete_this2('+ bar[1] +')"><img border="0" src="<?php echo get_bloginfo('template_url'); ?>/images/delete_icon.png" border="0" /></a></div>');

}

	

			

			

    	});

		

		

	});

	

	

	</script>

	

    <style type="text/css">

	.div_div

	{

		margin-left:5px; float:left; 

		width:110px;margin-top:10px;

	}

	

	</style>

    

    <div id="fileUpload3">You have a problem with your javascript</div>

    <div id="thumbnails" style="overflow:hidden;margin-top:20px">

    

    <?php



		$args = array(

		'order'          => 'ASC',

		'orderby'        => 'post_date',

		'post_type'      => 'attachment',

		'post_parent'    => $post->ID,

		'post_mime_type' => 'image',

		'numberposts'    => -1,

		); $i = 0;

		

		$attachments = get_posts($args);







	if ($attachments) {

	    foreach ($attachments as $attachment) {

		$url = wp_get_attachment_url($attachment->ID);

		

			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .

			walleto_generate_thumb($attachment->ID, 70, 70). '" />

			<a href="javascript: void(0)" onclick="delete_this2(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>

			</div>';

	  

	}

	}





	?>

    

    </div>

    

<?php 	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_product_info_metabox()

{

	global $current_user;

	get_currentuserinfo();

	$cid = $current_user->ID;

	

	global $post;

	$pid = $post->ID;

	

	?>

    

    <textarea rows="10" cols="80" class="do_input" id="other_details"  name="other_details"><?php echo get_post_meta($pid, 'other_details', true); ?></textarea>

    

    <?php	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_product_images_metabox()

{



	global $current_user;

	get_currentuserinfo();

	$cid = $current_user->ID;

	

	global $post;

	$pid = $post->ID;





?>

	

    

    <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/jquery.uploadify-3.1.js"></script>     

	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.css" type="text/css" />

	

    <script type="text/javascript">

	

	function delete_this2(id)

	{

		 jQuery.ajax({

						method: 'get',

						url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_ad_delete_pid='+id,

						dataType : 'text',

						success: function (text) {   jQuery('#image_ss'+id).remove();  }

					 });

		  //alert("a");

	

	}



	

	

	jQuery(function() {

		

		jQuery("#fileUpload3").uploadify({

			height        : 30,

			auto:			true,

			swf           : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.swf',

			uploader      : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploady.php',

			width         : 120,

			fileTypeExts  : '*.jpg;*.jpeg;*.gif;*.png',

			formData    : {'ID':<?php echo $pid; ?>,'author':<?php echo $cid; ?>},

			onUploadSuccess : function(file, data, response) {

			

			//alert(data);

			var bar = data.split("|");

			

jQuery('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" /><a href="javascript: void(0)" onclick="delete_this2('+ bar[1] +')"><img border="0" src="<?php echo get_bloginfo('template_url'); ?>/images/delete_icon.png" border="0" /></a></div>');

}

	

			

			

    	});

		

		

	});

	

	

	</script>

	

    <style type="text/css">

	.div_div

	{

		margin-left:5px; float:left; 

		width:110px;margin-top:10px;

	}

	

	</style>

    

    <div id="fileUpload3">You have a problem with your javascript</div>

    <div id="thumbnails" style="overflow:hidden;margin-top:20px">

    

    <?php



		$args = array(

		'order'          => 'ASC',

		'orderby'        => 'post_date',

		'post_type'      => 'attachment',

		'post_parent'    => $post->ID,

		'post_mime_type' => 'image',

		'numberposts'    => -1,

		); $i = 0;

		

		$attachments = get_posts($args);







	if ($attachments) {

	    foreach ($attachments as $attachment) {

		$url = wp_get_attachment_url($attachment->ID);

		

			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .

			walleto_generate_thumb($attachment->ID, 70, 70). '" />

			<a href="javascript: void(0)" onclick="delete_this2(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>

			</div>';

	  

	}

	}





	?>

    

    </div>

    

<?php 



}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_shops_set_metaboxes()

{

	    add_meta_box( 'shop_mem', 			'Shop Membership',						'walleto_shop_membership_metabox', 	'shop', 'side',		'high' );

		add_meta_box( 'shop_images', 		'Shop Images / Portfolio',				'walleto_shop_images_metabox', 		'shop', 'advanced',	'high' );

		add_meta_box( 'shop_info', 			'Shop Information Details',				'walleto_shop_info_metabox', 		'shop', 'advanced',	'high' );

 

		do_action('walleto_meta_boxes_menu_shops');	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_shop_membership_metabox()

{

	global $current_user;

	get_currentuserinfo();

	$uid = $current_user->ID;

	

	global $post;

	$pid = $post->ID;

	

	?>

    <ul id="post-new4"> 

    <input name="fromadmin" type="hidden" value="1" />

    

    

           <li>

        <h2>          

          

       <?php _e("Shop Membership",'Walleto'); ?>:</h2>

        <p><input type="text" name="membership_available" id="membership_available" value="<?php

		

		$d = get_post_meta($pid,'membership_available',true);

		

		if(!empty($d)) {

		$r = date_i18n('m/d/Y H:i:s', $d);

		echo $r;

		}

		 ?>" class="do_input"  /></p>

        </li>

        

 <script>



jQuery(document).ready(function() {

	 jQuery('#membership_available').datetimepicker({

	showSecond: true,

	timeFormat: 'hh:mm:ss'

});});

 

 </script>

        

        <li>

        <h2>Featured:</h2>

        <p> <?php $featured = get_post_meta($pid,'featured',true)  ?>

        <select name="featured_shop">

        <option value="0" <?php echo $featured == "0" ? "selected='selected'" : ''; ?>>No</option>

        <option value="1" <?php echo $featured == "1" ? "selected='selected'" : ''; ?>>Yes</option>

        

        </select>

        </p>

        </li>

	</ul>    

    

    <?php

		

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_save_custom_fields($pid)

{

	

	$sbr_post = get_post($pid);

	

	if(isset($_POST['fromadmin']) and $sbr_post->post_type == "product")

	{

		$price 					= trim($_POST['price']);

		$shipping 				= trim($_POST['shipping']);

		$quant 					= trim($_POST['quant']);

		

		update_post_meta($pid,'quant', $quant);

		update_post_meta($pid,'shipping', $shipping);

		update_post_meta($pid,'price', $price);

		

		update_post_meta($pid,'status', $_POST['status']);

		

		$featured = 0;

		if(isset($_POST['featured'])) $featured = 1;		

		update_post_meta($pid,'featured',  $featured );

		

		update_post_meta($pid,'other_details',  trim($_POST['other_details']) );

		

		//----------------

		

		$closed = 0;

		if(isset($_POST['closed'])) $closed = 1;		

		update_post_meta($pid,'closed',  $closed );

		

		//------------------

		

		for($i=0;$i<count($_POST['custom_field_id']);$i++)

		{

			$id = $_POST['custom_field_id'][$i];

			$valval = $_POST['custom_field_value_'.$id];		

			

			if(is_array($valval))

					update_post_meta($pid, 'custom_field_ID_'.$id, $valval);

			else

				update_post_meta($pid, 'custom_field_ID_'.$id, strip_tags($valval));

		}

	

		

	}

	

	if(isset($_POST['fromadmin']) and $sbr_post->post_type == "shop")

	{	

		$shop_facebook 			= trim($_POST['shop_facebook']);

		$shop_twitter 			= trim($_POST['shop_facebook']);

		$shop_policies 			= trim($_POST['shop_policies']);

		$contact_information 	= trim($_POST['contact_information']);

		$featured				= $_POST['featured'];

		

		update_post_meta($pid,'featured', $featured);

		update_post_meta($pid,'shop_facebook', $shop_facebook);

		update_post_meta($pid,'shop_twitter', $shop_twitter);

		update_post_meta($pid,'contact_information', nl2br($contact_information));

		update_post_meta($pid,'shop_policies', nl2br($shop_policies));



 		$membership_available = $_POST['membership_available'];

		update_post_meta($pid,'membership_available', strtotime($membership_available));

		update_post_meta($pid,'featured', nl2br($_POST['featured_shop']));

		

	}	  

	

}



function get_product_fields_values($pid)

	{

		$cat = wp_get_object_terms($pid, 'product_cat');

	

		$catid = $cat[0]->term_id ;

	

		global $wpdb;

		$s = "select * from ".$wpdb->prefix."walleto_custom_fields order by ordr asc "; //where cate='all' OR cate like '%|$catid|%' order by ordr asc";	

		$r = $wpdb->get_results($s);

		

	

		

		$arr = array();

		$i = 0;

		

		foreach($r as $row) // = mysql_fetch_object($r))

		{

			

			$pmeta = get_post_meta($pid, "custom_field_ID_".$row->id);

		

			if(!empty($pmeta) && count($pmeta) > 0)

			{

			 	$arr[$i]['field_name']  = $row->name;

		

				if(!empty($pmeta))

				{

					$arr[$i]['field_name']  = $row->name;

					$arr[$i]['field_value'] = $pmeta;

					$i++;

				}

			

			

			}

		}

		

		return $arr;

	}



function walleto_get_payments_link()

{

	return get_permalink(get_option('Walleto_my_account_my_finances_page_id'));	

}



function walleto_isValidEmail($email){

	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_shop_info_metabox()

{

	global $current_user;

	get_currentuserinfo();

	$cid = $current_user->ID;

	

	global $post;

	$pid = $post->ID;

	

	?>

    

    <input type="hidden" value="1" name="fromadmin" />

    <table>

    <tr>

    <td width="130"><?php _e('Shop Facebook:','Walleto'); ?></td>

    <td><input type="text" size="45" value="<?php echo get_post_meta($pid, 'shop_facebook', true); ?>" name="shop_facebook" /></td>

    </tr>

    

        <tr>

    <td><?php _e('Shop Twitter:','Walleto'); ?></td>

    <td><input type="text" size="45" value="<?php echo get_post_meta($pid, 'shop_twitter', true); ?>" name="shop_twitter" /></td>

    </tr>

    

    

    

          <tr>

    <td valign="top"><?php _e('Contact Info:','Walleto'); ?></td>

    <td><textarea name="contact_information" rows="4" cols="70" ><?php echo str_replace("<br />", " ", get_post_meta($pid, 'contact_information', true)); ?></textarea></td>

    </tr>

    

    

          <tr>

    <td valign="top"><?php _e('Shop Policies:','Walleto'); ?></td>

    <td><textarea name="shop_policies" rows="6" cols="70" ><?php echo str_replace("<br />", " ", get_post_meta($pid, 'shop_policies', true)); ?></textarea></td>

    </tr>

    

    </table>

    

    

    <?php	

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_framework_init_widgets()

{





	register_sidebar( array(

		'name' => __( 'Single Page Sidebar', 'Walleto' ),

		'id' => 'single-widget-area',

		'description' => __( 'The sidebar area of the single blog post', 'Walleto' ),

		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<div class="featured_product_heading">',

		'after_title' => '</div>',

	) );

	

	

	

		

		register_sidebar( array(

		'name' => __( 'Walleto - Stretch Wide MainPage Sidebar', 'Walleto' ),

		'id' => 'main-stretch-area',

		'description' => __( 'This sidebar is site wide stretched in home page, just under the slider/menu.', 'Walleto' ),

		'before_widget' => '',

		'after_widget' => '',

		'before_title' => '',

		'after_title' => '',

	) );

	
                
		register_sidebar( array(

		'name' => __( 'Inner Page Sidebar Left', 'Walleto' ),

		'id' => 'inner-page-area-left',

		'description' => __( 'The sidebar area of any inner page left area add', 'Walleto' ),

		'before_widget' => '',

		'after_widget' => '',

		

	) );

	

	

		register_sidebar( array(

		'name' => __( 'Other Page Sidebar', 'Walleto' ),

		'id' => 'other-page-area',

		'description' => __( 'The sidebar area of any other page than the defined ones', 'Walleto' ),

		'before_widget' => '',

		'after_widget' => '',

		

	) );

	

	

	

	

	register_sidebar( array(

		'name' => __( 'Home Page Sidebar - Right', 'Walleto' ),

		'id' => 'home-right-widget-area',

		'description' => __( 'The right sidebar area of the homepage', 'Walleto' ),

		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	
        register_sidebar( array(

		'name' => __( 'Home Page Sidebar - Right 2', 'Walleto' ),

		'id' => 'home-right-2-widget-area',

		'description' => __( 'The right sidebar area of the homepage', 'Walleto' ),

		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</div>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );
	

	

	

	register_sidebar( array(

		'name' => __( 'Home Page Sidebar - Left', 'Walleto' ),

		'id' => 'home-left-widget-area',

		'description' => __( 'The left sidebar area of the homepage', 'Walleto' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );
        
        register_sidebar( array(

		'name' => __( 'Home Page Search Sidebar', 'Walleto' ),

		'id' => 'home-search-widget-area',

		'description' => __( 'The left sidebar area of the homepage', 'Walleto' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	
        register_sidebar( array(

			'name' => __( 'HomePage Bottom Adds Area','Walleto' ),

			'id' => 'home-page-bootom-area',

			'description' => __( 'The sidebar for the main page, just under the slider.', 'Walleto' ),

			'before_widget' => '',

			'after_widget' => '',

			

	) );

	

	

	register_sidebar( array(

		'name' => __( 'First Footer Widget Area', 'Walleto' ),

		'id' => 'first-footer-widget-area',

		'description' => __( 'The first footer widget area', 'Walleto' ),

		'before_widget' => '<li id="%1$s" class="foot_list fl_1">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	// Area 4, located in the footer. Empty by default.

	register_sidebar( array(

		'name' => __( 'Second Footer Widget Area', 'Walleto' ),

		'id' => 'second-footer-widget-area',

		'description' => __( 'The second footer widget area', 'Walleto' ),

		'before_widget' => '<li id="%1$s" class="foot_list fl_2">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	// Area 5, located in the footer. Empty by default.

	register_sidebar( array(

		'name' => __( 'Third Footer Widget Area', 'Walleto' ),

		'id' => 'third-footer-widget-area',

		'description' => __( 'The third footer widget area', 'Walleto' ),

		'before_widget' => '<li id="%1$s" class="foot_list fl_3">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	// Area 6, located in the footer. Empty by default.

	register_sidebar( array(

		'name' => __( 'Fourth Footer Widget Area', 'Walleto' ),

		'id' => 'fourth-footer-widget-area',

		'description' => __( 'The fourth footer widget area', 'Walleto' ),

		'before_widget' => '<li id="%1$s" class="foot_list fl_4">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	
	register_sidebar( array(

		'name' => __( 'Fifth Footer Widget Area', 'Walleto' ),

		'id' => 'fifth-footer-widget-area',

		'description' => __( 'The Fifth footer widget area', 'Walleto' ),

		'before_widget' => '<li id="%1$s" class="foot_list fl_5">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );


		

			register_sidebar( array(

			'name' => __( 'Walleto - Product Single Sidebar', 'Walleto' ),

			'id' => 'product-widget-area',

			'description' => __( 'The sidebar of the single product page', 'Walleto' ),

			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

			'after_widget' => '</li>',

			'before_title' => '<h3 class="widget-title">',

			'after_title' => '</h3>',

		) );

		

		register_sidebar( array(

			'name' => __( 'Walleto - Shop Single Sidebar', 'Walleto' ),

			'id' => 'shop-widget-area',

			'description' => __( 'The sidebar of the single shop page', 'Walleto' ),

			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

			'after_widget' => '</li>',

			'before_title' => '<h3 class="widget-title">',

			'after_title' => '</h3>',

		) );

		

		

			
            register_sidebar( array(

		'name' => __( 'Breadcrumb Widget Area', 'Walleto' ),

		'id' => 'breadcrumb-widget-area',

		'description' => __( 'The Breadcrumb widget area', 'Walleto' ),

		'before_widget' => '<li id="%1$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );


	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_using_permalinks()

{

	global $wp_rewrite;

	if($wp_rewrite->using_permalinks()) return true; 

	else return false; 	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_credits($uid)

{

	$c = get_user_meta($uid,'credits',true);

	if(empty($c))

	{

		update_user_meta($uid,'credits',"0");	

		return 0;

	}

	

	return $c;

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_update_credits($uid, $ttl)

{

	update_user_meta($uid,'credits', $ttl);	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_get_total_for_order($oid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."walleto_orders where id='$oid'";

	$r = $wpdb->get_results($s);

	

	return $r[0]->totalprice + $r[0]->shipping;

		

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_show_payment_link_for_order($oid)

{

	if(Walleto_using_permalinks())

	{

		return get_permalink(get_option('Walleto_my_account_pay_4_item_page_id')) . "?oid=" . $oid;	

	}

	else

	{

		return get_permalink(get_option('Walleto_my_account_pay_4_item_page_id')) . "&oid=" . $oid;	

	}

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_show_payment_link_for_order_virtual_currency($oid, $c = 0)

{

	if(Walleto_using_permalinks())

	{

		return get_permalink(get_option('Walleto_my_account_pay_4_item_virt_page_id')) . "?".($c == 1 ? 'confirm=yes&' : '')."oid=" . $oid;	

	}

	else

	{

		return get_permalink(get_option('Walleto_my_account_pay_4_item_virt_page_id')) . ($c == 1 ? '&confirm=yes' : '')."&oid=" . $oid;	

	}

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_left_to_pay_for_order($oid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."walleto_order_contents where orderid='$oid' and paid='0'";

	$r = $wpdb->get_results($s);

	$total = 0;

	if(count($r) > 0)

	{

		foreach ($r as $row)

		{

			$total += $row->price;	

			$shp = get_post_meta($row->pid, 'shipping', true);

			$total += $shp;

		}

	

	}

	

	return $total;

}



function walleto_display_unpaid_order_for_buyer($row)

{
        $oid = $row->id;
        global $wpdb;
        $sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$oid'";
	$pid = $wpdb->get_results($sql); 
	$post = $pid[0]; 

	?>

	<tr><div class="my_order">

	    <td><a href="<?php echo get_permalink($post->pid); ?>"><?php echo walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post'); ?></a></td>

            <td><div class="my_order_datemade"><?php echo date_i18n('d-M-Y H:i:s', $row->datemade) ?></div></td>

            <td><div class="my_order_price"><?php echo walleto_get_show_price($row->totalprice + $row->shipping) ?></div></td>

            <td><div class="my_order_left_to_pay"><?php echo walleto_get_show_price(walleto_left_to_pay_for_order($row->id)) ?></div></td>

            <td class="my_order_buttons">

            

            

                <a class="btns_action" href="<?php echo walleto_get_order_content_link($row->id) ?>"><?php _e('See Items','Walleto'); ?></a> 

                <a class="btns_action" href="<?php echo walleto_show_payment_link_for_order($row->id) ?>"><?php _e('Pay This','Walleto'); ?></a>

                

            </td>
	</tr>
        

   

    

    <?php	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_display_unshipped_order_for_buyer($row)

{
        $oid = $row->id;
	
        global $wpdb;
        $sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$oid'";
	$pid = $wpdb->get_results($sql); 
	$post = $pid[0];
    
	?>

    	<tr class="my_order">

            <td class="my_order_id"><a href="<?php echo get_permalink($post->pid); ?>"><?php echo walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post'); ?></a></td>

            <td class="my_order_datemade"><?php echo date_i18n('d-M-Y H:i:s', $row->datemade) ?></td>

            <td class="my_order_price"><?php echo walleto_get_show_price($row->totalprice) ?></td>

            <td class="my_order_left_to_pay"><?php echo walleto_get_show_price(walleto_left_to_pay_for_order($row->id)) ?></td>
       
            <td class="red-txt">
             
            

                <?php _e('Waiting for seller to ship.','Walleto'); ?>


            </td>

        

       

    

    <?php	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_display_awaiting_shipping_for_seller($row)

{

	global $current_user;
        get_currentuserinfo();

	$uid = $current_user->ID;
        $buyer = $row->uid;
        
        $oid = $row->id;
	global $wpdb;
        $sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$oid'";
	$pid = $wpdb->get_results($sql); 
	$post = $pid[0]; 
	?>

    	
	<tr>
        
	<td><a href="<?php echo get_permalink($post->pid); ?>"><?php echo walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post'); ?></a>
        </td>
       

        <td><div class="my_order_datemade"><?php echo date_i18n('d-M-Y H:i:s', $row->datemade) ?></div></td>

        <td><div class="my_order_price"><?php echo walleto_get_show_price($row->totalprice) ?></div></td>

	

        <td>
                <?php 

				

					$dt = !empty($row->paid_on) ? date_i18n('d-M-Y H:i:s', $row->paid_on) : "";

					echo empty($dt) ? '&nbsp;' : $dt; ?>

        </td>    
        <td width="125">

            
		<a class="btns_payment" href="<?php echo walleto_get_order_content_link2($row->id, $uid) ?>"><?php _e('Details','Walleto'); ?></a> 
		
                <a class="btns_payment" href="<?php bloginfo('siteurl') ?>/?w_action=mark_shipped&oid=<?php echo $row->id ?>"><?php _e('Mark Shipped','Walleto'); ?></a> 

        </td>
        </tr>
        <tr>
        <td align="left" colspan="6">   
        <div class="tags link_button_out_of_stock">    
      
                <?php

                                $dets = get_user_meta($buyer,'shipping_info',true);

				echo '<span style="float:left;margin-bottom:10px">'. sprintf(__('Buyer Shipping Address: %s','Walleto'), $dets).'</span>';
                ?>

                <?php

			

			$using_perm = Walleto_using_permalinks();

	

			if($using_perm)	$privurl_m = get_permalink(get_option('Walleto_my_account_priv_mess_page_id')). "?";

			else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('Walleto_my_account_priv_mess_page_id'). "&";	

			

			$prvs = $privurl_m."priv_act=send&";

			$prvs .= 'uid='.$buyer;

			

			$buyer1 = get_userdata($buyer);

			

			?>

            

            

             <a class="btns_payment" href="<?php echo $prvs ?>"> <?php echo sprintf(__('Contact Buyer: %s','Walleto'), $buyer1->user_login); ?></a>

            

        </div>    
	</td>
	</tr>

<?php	

}


/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_display_done_payments_for_seller($row)

{

	

	$oid = $row->id; 

	if(empty($oid)) $oid = $row->orderid;

	global $current_user;

	get_currentuserinfo();

	$uid = $current_user->ID;
        
        $buyer = get_userdata($row->uid);
	
	global $wpdb;
        $sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$oid'";
	$pid = $wpdb->get_results($sql); 
	$post = $pid[0];

	?>

    	<tr class="my_order">

            <td class="my_order_id"><a href="<?php echo get_permalink($post->pid); ?>"><?php echo walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post'); ?></a></td>
            <td class="my_order_id"><?php echo $buyer->user_login; ?></td>
            
            <td class="my_order_datemade"><?php echo date_i18n('d-M-Y H:i:s', $row->datemade) ?></td>

            <td class="my_order_price"><?php echo walleto_get_show_price($row->totalprice) ?></td>

            <td class="my_order_buttons">

            

                <?php 

				

					$dt = !empty($row->paid_on) ? date_i18n('d-M-Y H:i:s', $row->paid_on) : "";

					echo sprintf(__('Paid on <br/> %s','Walleto'), $dt); ?>

            

            </td>

        	
            </tr>
            <tr>
            <td align="left" colspan="4">
            <div class="tags link_button_out_of_stock">

            <?php 

			

			global $wpdb;

			$s = "select cnt.shipped_on from ".$wpdb->prefix."walleto_order_contents cnt, $wpdb->posts posts where 

			 posts.ID=cnt.pid AND posts.post_author='$uid' AND cnt.orderid='$oid' limit 1";

			$r = $wpdb->get_results($s);  

			

			$r = $r[0];

			$shp = date_i18n('d-M-Y H:i:s', $r->shipped_on);

			

			echo sprintf(__('You shipped this order on: %s','Walleto'), $shp); ?> 

            <a class="btns_pay" href="<?php echo walleto_get_order_content_link2($oid, $uid) ?>"><?php _e('Order Details','Walleto'); ?></a>

            

            </div>
            </td></tr>

            

       

    

    <?php	

	

}







/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



function walleto_display_awaiting_payments_for_seller($row)

{

	?>

    	<tr class="my_order">

            <td class="my_order_id">#<?php echo $row->id ?></td>

            <td class="my_order_datemade"><?php echo date_i18n('d-M-Y H:i:s', $row->datemade) ?></td>

            <td class="my_order_price"><?php echo walleto_get_show_price($row->totalprice) ?></td>

            <td class="my_order_buttons">

            

                <?php 

				

					$dt = !empty($row->datemade) ? date_i18n('d-M-Y H:i:s', $row->datemade) : "";

					echo sprintf(__('Purchased on <br/> %s','Walleto'), $dt); ?>

            

            </td>

            </tr>
            <tr>
            <td align="left" colspan="4">
            <div class="tags link_button_out_of_stock">		

			<?php

			

			$using_perm = Walleto_using_permalinks();

	

			if($using_perm)	$privurl_m = get_permalink(get_option('Walleto_my_account_priv_mess_page_id')). "?";

			else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('Walleto_my_account_priv_mess_page_id'). "&";	

			

			$prvs = $privurl_m."priv_act=send&";

			$prvs .= 'pid='.$post->ID.'&uid='.$row->uid;

			

			$slr = get_userdata($row->uid);

			

			?>

            <a class="btns_pay" href="<?php echo walleto_get_order_content_link2($row->id, $uid) ?>"><?php _e('View Order Details','Walleto'); ?></a>

            <a class="btns_pay" href="<?php echo $prvs ?>"><?php echo sprintf(__('Contact Buyer: %s','Walleto'), $slr->user_login); ?></a>

            

            </div></td>
            </tr>

            

            

     

    

    <?php	

	

}





/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_display_shipped_order_for_buyer($row)

{
    $oid = $row->id;
	
    global $wpdb;
    $sql = "select pid from ".$wpdb->prefix."walleto_order_contents where orderid='$oid'";
    $pid = $wpdb->get_results($sql); 
    $post = $pid[0];

	?>

    	<tr class="my_order">

            <td class="my_order_id"><a href="<?php echo get_permalink($post->pid); ?>"><?php echo walleto_get_first_post_image($post->pid,150,150,'thumbnail-image-post'); ?></a></td>

            <td class="my_order_datemade"><?php echo date_i18n('d-M-Y H:i:s', $row->datemade) ?></td>

            <td class="my_order_price"><?php echo walleto_get_show_price($row->totalprice) ?></td>
            
           
            <td class="red-txt">

            

                <?php 

				

					$dt = !empty($row->shipped_on) ? date_i18n('d-M-Y H:i:s', $row->shipped_on) : "";

					echo sprintf(__('Order shipped on: %s.','Walleto'), $dt); ?>

            

            </td>
            </tr>
            

            <tr>
            <td align="left" colspan="4">
            <div class="tags link_button_out_of_stock">			

			 

            <a class="btns_pay" href="<?php echo walleto_get_order_content_link($row->id) ?>"><?php _e('View Order Details','Walleto'); ?></a>

            

            

            </div>
            </td></tr>

 
    <?php	

	}


/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_users_links()

{

	global $post;

	$pid = $post->ID;

	

	global $current_user;

	get_currentuserinfo();

	$uid = $current_user->ID;

	

	$feedback_page 		= get_option('Walleto_my_account_reviews_page_id');

	$messages_page 		= get_option('Walleto_my_account_priv_mess_page_id');

	$parent_acc 		= get_option('Walleto_my_account_page_id');

	$pers_info 			= get_option('Walleto_my_account_pers_info_page_id');

	$finances 			= get_option('Walleto_my_account_my_finances_page_id');

	

	$all_orders 		= get_option('Walleto_my_account_all_orders_page_id');

	$out_pay 			= get_option('Walleto_my_account_outstanding_pay_page_id');

	$not_shipped 		= get_option('Walleto_my_account_not_shipped_page_id');

	$shipped 			= get_option('Walleto_my_account_shipped_cust_page_id');

	

	$active_items 			= get_option('Walleto_my_account_act_items_page_id');

	$out_of_stock 			= get_option('Walleto_my_account_out_of_stock_page_id');

	$aw_pay 				= get_option('Walleto_my_account_aw_pay_page_id');

	$aw_shp 				= get_option('Walleto_my_account_aw_shp_page_id');

	$shp_orders 			= get_option('Walleto_my_account_shp_ord_page_id');

	$shp_stp_id				= get_option('Walleto_my_account_shop_setup_page_id');

	

	if($pid == $active_items)		$active_active_items = "class='active'";

	elseif($pid == $out_of_stock)		$active_out_of_stock = "class='active'";

	elseif($pid == $aw_pay)			$active_aw_pay = "class='active'";

	elseif($pid == $aw_shp)			$active_aw_shp = "class='active'";

	elseif($pid == $shp_orders)		$active_shp_orders = "class='active'";

	

	elseif($pid == $parent_acc)		$active_home = "class='active'";

	elseif($pid == $messages_page)	$active_messages = "class='active'";

	elseif($pid == $feedback_page)	$active_feedback = "class='active'";

	elseif($pid == $pers_info)		$active_pers_info = "class='active'";

	elseif($pid == $finances)		$active_finances = "class='active'";

	

	elseif($pid == $shipped)		$active_shp = "class='active'";

	elseif($pid == $not_shipped)		$active_not_shp = "class='active'";

	elseif($pid == $out_pay)		$active_out_py = "class='active'";

	elseif($pid == $all_orders)		$active_all_orders = "class='active'";

	elseif($pid == $shp_stp_id)		$shop_stp = "class='active'";

	

	?>

    	

        <ul id="side_menu_dashboard_wrapper">

            

            	<li class="active account_widget_thing"><a href="javascript:void(0);"><span class="category_icon_a"><i class="icon-lock"></i></span> 
                    <span class="category_text_a"><?php _e("My Account Menu",'Walleto'); ?></span>
		    </a>

                

                <ul id="my-account-admin-menu">

                    <li><a <?php echo $active_home; ?> href="<?php echo walleto_my_account_link(); ?>"><i class="icon-double-angle-right"></i><?php _e("My Account Home",'Walleto');?></a></li>

                    <li><a <?php echo $shop_stp; ?> href="<?php echo get_permalink($shp_stp_id); ?>"><i class="icon-double-angle-right"></i><?php _e("My Shop Setup",'Walleto');?></a></li>

                    <li><a <?php echo $active_finances; ?> href="<?php echo get_permalink($finances); ?>"><i class="icon-double-angle-right"></i><?php _e("Finances",'Walleto');?></a></li>

                    <li><a <?php echo $active_messages; ?> href="<?php echo get_permalink($messages_page); ?>"><i class="icon-double-angle-right"></i><?php _e("Private Messages",'Walleto');?></a></li>

                    <li><a <?php echo $active_pers_info; ?> href="<?php echo get_permalink($pers_info); ?>"><i class="icon-double-angle-right"></i><?php _e("Personal Info",'Walleto');?></a></li>

                    <li><a <?php echo $active_feedback; ?> href="<?php echo get_permalink($feedback_page); ?>"><i class="icon-double-angle-right"></i><?php _e("Reviews/Feedback",'Walleto');?></a></li>

                    

                    

                </ul>              

                </li>
	
                

                <li class="account_widget_thing"><a href="javascript:void(0);"><span class="category_icon_a"><i class="icon-shopping-cart "></i></span> <span class="category_text_a"><?php _e("My Shop",'Walleto'); ?></span></a>

                <?php

				

				global $wpdb;

				$s = "select distinct cnt.orderid from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 

				ord.paid='0' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND posts.post_author='$uid' order by ord.id desc";

				

				$row = $wpdb->get_results($s);

				$cnt = count($row);

				

				if($cnt > 0) $outs_pmnts2 = ' <span class="nots_nots">'.$cnt.'</span>';

				

				//-------------------------------

				

				global $wpdb;

				$s = "select distinct cnt.orderid from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 

				ord.paid='1' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND cnt.shipped='0' AND posts.post_author='$uid' order by ord.id desc";

				

				$r = $wpdb->get_results($s);						

				if(count($r) > 0) $outs_pmnts2a = ' <span class="nots_nots">'.count($r).'</span>';		

						

				?>

                <ul id="my-account-admin-menu">

                    <li><a href="<?php echo get_permalink(get_option('Walleto_post_new_page_id')); ?>"><i class="icon-double-angle-right"></i><?php _e("Sell New Product",'Walleto');?></a></li>

                    <li><a <?php echo $active_active_items; ?> href="<?php echo get_permalink($active_items); ?>"><i class="icon-double-angle-right"></i><?php _e("Active Items",'Walleto');?></a></li>

                    <li><a <?php echo $active_out_of_stock; ?> href="<?php echo get_permalink($out_of_stock); ?>"><i class="icon-double-angle-right"></i><?php _e("Out of Stock Items",'Walleto');?></a></li>

                    <li><a <?php echo $active_aw_pay; ?> href="<?php echo get_permalink($aw_pay); ?>"><i class="icon-double-angle-right"></i><?php echo sprintf(__("Awaiting Payments %s",'Walleto'), $outs_pmnts2);?></a></li>

                    <li><a <?php echo $active_aw_shp; ?> href="<?php echo get_permalink($aw_shp); ?>"><i class="icon-double-angle-right"></i><?php _e("Awaiting Shipping",'Walleto');?><?php echo $outs_pmnts2a; ?></a></li>

                    <li><a <?php echo $active_shp_orders; ?> href="<?php echo get_permalink($shp_orders); ?>"><i class="icon-double-angle-right"></i><?php _e("Paid and Shipped",'Walleto');?></a></li>

                </ul>  

                                

                </li>

                

                <?php

				

				global $wpdb;

				$s = "select count(id) as mycnt from ".$wpdb->prefix."walleto_orders where uid='$uid' AND paid='0' order by id desc";

				$r = $wpdb->get_results($s);

				$row = $r[0];

				

				if($row->mycnt > 0) $outs_pmnts = '<span class="nots_nots">'.$row->mycnt.'</span>';

					

					

				//---------------------

				

				$s = "select distinct orderid from ".$wpdb->prefix."walleto_order_contents where uid='$uid' AND paid='1' and shipped='0' order by id desc";

				$r = $wpdb->get_results($s);	

				

				if(count($r) > 0) $smopp = '<span class="nots_nots">'.count($r).'</span>';	

					

				?>

                <li class="account_widget_thing"><a href="javascript:void(0);"><span class="category_icon_a"><i class="icon-money"></i></span> <span class="category_text_a"><?php _e("My Purchases",'Walleto'); ?></span></a>

                

                <ul id="my-account-admin-menu">

                    <li><a <?php echo $active_all_orders; ?> href="<?php echo get_permalink($all_orders); ?>"><i class="icon-double-angle-right"></i><?php _e("All Orders",'Walleto');?></a></li>

                    <li><a <?php echo $active_out_py; ?> href="<?php echo get_permalink($out_pay); ?>"><i class="icon-double-angle-right"></i><?php echo sprintf(__("Outstanding Payments %s",'Walleto'), $outs_pmnts);?></a></li>

                    <li><a <?php echo $active_not_shp; ?> href="<?php echo get_permalink($not_shipped); ?>"><i class="icon-double-angle-right"></i><?php echo sprintf(__("Not Shipped Orders %s",'Walleto'), $smopp);?></a></li>

                    <li><a <?php echo $active_shp; ?> href="<?php echo get_permalink($shipped); ?>"><i class="icon-double-angle-right"></i><?php _e("Shipped Orders",'Walleto');?></a></li>

                </ul>  

                                

                </li>

                

            

            </ul>

      

    

    

    <?php	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_post_new_link()

{

	return get_permalink(get_option('Walleto_post_new_page_id'));		

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_watch_list()

{

	return get_permalink(get_option('Walleto_watch_list_id'));

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_blog_link()

{

	return get_permalink(get_option('Walleto_blog_home_id'));	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_advanced_search_link()

{

	return get_permalink(get_option('Walleto_adv_search_id'));		

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_period_from_code($s)

{

	if($s == "yearly") return __('12 Months','Walleto');

	return __('1 Month','Walleto');	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_get_period_from_code_numeric($s)

{

	if($s == "yearly") return 12;

	return 1;	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_how_much_to_get_as_custom_percent($amount)

{

	$Walleto_fee_after_paid = get_option('Walleto_take_percent_fee');

	$deducted = 0;	

								

	if(!empty($Walleto_fee_after_paid)):		

		$deducted = $amount*($Walleto_fee_after_paid * 0.01);

	else: 		

		$deducted = 0;		

	endif;

												

	//------------------------------------

								

	$Walleto_fee_after_paid_flat_fee  = get_option('Walleto_take_flat_fee');

	if(!empty($Walleto_fee_after_paid_flat_fee)):

		if(is_numeric($Walleto_fee_after_paid_flat_fee)):		

			$deducted = $Walleto_fee_after_paid_flat_fee;	

		endif;

	endif;		

	

	return $deducted;

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function walleto_add_history_log($tp, $reason, $amount, $uid, $uid2 = '')

{

	global $wpdb;

	

	$tm = current_time('timestamp',0); global $wpdb;

	$s = "insert into ".$wpdb->prefix."walleto_payment_transactions (tp,reason,amount,uid,datemade,uid2)

	values('$tp','$reason','$amount','$uid','$tm','$uid2')";	

	$wpdb->query($s);

}





/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_is_able_to_post_products()

{

	$opt = get_option('Walleto_only_admins_post_products');

	if($opt == "yes")

	{

		if(current_user_can( 'manage_options' )) return true;

		else return false;

	}

	

	return true;

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_my_account_link()

{

	return get_permalink(get_option('Walleto_my_account_page_id'));	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_is_home()

{

	global $current_user, $wp_query;

	$a_action 	=  $wp_query->query_vars['w_action'];	

	

	if(!empty($a_action)) return false;

	if(is_home()) return true;

	return false;

	

}



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/





	

	add_action('wp_ajax_remove_from_watchlist', 		'Walleto_remove_from_watchlist');
	
	add_action('wp_ajax_nopriv_remove_from_watchlist', 	'Walleto_remove_from_watchlist');
	
	
	
	add_action('wp_ajax_add_to_watchlist', 			'Walleto_add_to_watchlist');
	
	add_action('wp_ajax_nopriv_add_to_watchlist', 		'Walleto_add_to_watchlist');

	

	function Walleto_remove_from_watchlist()

	{

		 $pid = $_POST['pid']; 

		

		if(is_user_logged_in()):

		

			global $current_user;

			get_currentuserinfo();

			$uid = $current_user->ID;

			

			Walleto_delete_pid_in_watchlist($pid, $uid);

			

			echo "removed-".$uid."-".$pid."-";  

		

		else:

		

			echo "NO_LOGGED";	

		

		endif;	

		

	}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/	

	function Walleto_check_if_pid_is_in_watchlist($pid, $uid)

	{

		global $wpdb;

		$s = "select * from ".$wpdb->prefix."walleto_watchlist where pid='$pid' AND uid='$uid'";	

		$r = $wpdb->get_results($s);

		

		if(count($r) == 0) return false;		

		return true;

	}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

	

 

	 

	function Walleto_add_pid_in_watchlist($pid, $uid)

	{

		global $wpdb;

		$s = "insert into ".$wpdb->prefix."walleto_watchlist (pid,uid) values('$pid','$uid')";	

		$wpdb->query($s);

		

	}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/	

	function Walleto_delete_pid_in_watchlist($pid, $uid)

	{

		global $wpdb;

		$s = "delete from ".$wpdb->prefix."walleto_watchlist where pid='$pid' AND uid='$uid'";	

		$wpdb->query($s);

		

	}

	

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/



	function Walleto_add_to_watchlist()

	{

		$pid = $_POST['pid'];

		

		if(is_user_logged_in()):

		

			global $current_user;

			get_currentuserinfo();

			$uid = $current_user->ID;

			

			if(Walleto_check_if_pid_is_in_watchlist($pid, $uid) == false)

				Walleto_add_pid_in_watchlist($pid, $uid);

			

			echo "added-".$uid."-".$pid."-";  

			

		else:

		

			echo "NO_LOGGED";	

		

		endif;

	}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_currency()

{

	$c = trim(get_option('Walleto_currency_symbol'));

	if(empty($c)) return get_option('Walleto_currency');

	return $c;	

	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_currency()

{

	return Walleto_get_currency();	

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_get_show_price($price, $cents = 2)

{	

	$Walleto_currency_position = get_option('Walleto_currency_position');	

	if($Walleto_currency_position == "front") return Walleto_get_currency()."".Walleto_formats($price, $cents);	

	return Walleto_formats($price,$cents)."".Walleto_get_currency();	

		

}

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_formats($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always

  

  if($cents == 0) return $number;

  

  $dec_sep = get_option('Walleto_decimal_sum_separator');

  if(empty($dec_sep)) $dec_sep = '.';

  

  $tho_sep = get_option('Walleto_thousands_sum_separator');

  if(empty($tho_sep)) $tho_sep = ',';

  

  //dec,thou

  

  if (is_numeric($number)) { // a number

    if (!$number) { // zero

      $money = ($cents == 2 ? '0'.$dec_sep.'00' : '0'); // output zero

    } else { // value

      if (floor($number) == $number) { // whole number

        $money = number_format($number, ($cents == 2 ? 2 : 0), $dec_sep, $tho_sep ); // format

      } else { // cents

        $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2), $dec_sep, $tho_sep ); // format

      } // integer or decimal

    } // value

    return $money;

  } // numeric

} // formatMoney



/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

function Walleto_generate_thumb($img_url, $width, $height, $cut = true)

{



	return walleto_wp_get_attachment_image($img_url, array($width, $height ));

}



function walleto_get_user_profile_link($uid)

{

	return get_bloginfo('siteurl'). '/?w_action=user_profile&post_author='. $uid;	

}



function Walleto_send_email_on_priv_mess_received($sender_uid, $receiver_uid)

{

	$enable 	= get_option('Walleto_priv_mess_received_email_enable');

	$subject 	= get_option('Walleto_priv_mess_received_email_subject');

	$message 	= get_option('Walleto_priv_mess_received_email_message');	

	

	if($enable != "no"):

	

		$user 			= get_userdata($receiver_uid);

		$site_login_url = Walleto_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Walleto_my_account_page_id'));

		$sndr			= get_userdata($sender_uid);



		$find 		= array('##sender_username##', '##receiver_username##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##');

   		$replace 	= array($sndr->user_login, $user->user_login, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url);

		

		$tag		= 'Walleto_send_email_on_priv_mess_received';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Walleto_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Walleto_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------

 

		Walleto_send_email($user->user_email, $subject, $message);

	

	endif;

} 

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<a class="red-txt full-desc" href="javascript:void(0)"> Read More...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*****************************************************************************

*

*	Function - Walleto -

*

*****************************************************************************/

	

?>
