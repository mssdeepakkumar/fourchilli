<?php

/***************************************************************************

*

*	Buzzler - copyright (c) - sitemile.com

*	WordPress Business Directory Theme

*

*	Coder: Andrei Dragos Saioc

*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com

*	More info about the theme here: http://sitemile.com/p/buzzler

*	since v1.0

*

***************************************************************************/





	load_theme_textdomain( 'Buzzler', TEMPLATEPATH.'/languages' );

	add_theme_support( 'post-thumbnails' );

	

	DEFINE("BUZZLER_VERSION", "1.1.0");

	DEFINE("BUZZLER_RELEASE", "9 September 2013");



	session_start();

	global $current_theme_locale_name;	

	$current_theme_locale_name = 'Buzzler';

	

	global $default_search, $search_for, $location_near, $search_for1, $location_near1;

	$default_search = __("Begin to search by typing here...", "Buzzler");

	

	$search_for = __('Search for...', "Buzzler");

	$location_near = __('Near location...', "Buzzler");

	

	$search_for1 = $search_for;

	$location_near1 = $location_near;

	

	global $listings_url_thing;

	$listings_url_thing = "listing";

	

	add_theme_support( 'post-thumbnails' );



	

	global $category_url_link, $location_url_link, $listings_url_thing, $listing_thing_list;

	$category_url_link 		= get_option("buzzler_category_permalink");

	$location_url_link 		= get_option("Buzzler_location_permalink");

	$listings_url_thing 	= get_option("Buzzler_listing_permalink");

	$listing_thing_list		= "listing-list";

	

	if(empty($category_url_link)) 	$category_url_link = 'section';

	if(empty($location_url_link)) 	$location_url_link = 'location';

	if(empty($listings_url_thing)) 	$listings_url_thing = 'listings';

	

	



//----------- Includes -----------------------

	

	include 'lib/social/social.php';

	include 'my-upload.php';

	include 'autosuggest.php';

	include 'lib/first_run.php';

	include 'lib/first_run_emails.php';

	include 'lib/admin_menu.php';

	include 'lib/post_new.php';

	include 'lib/listings_map.php';

	include 'lib/advanced_search.php';

	include 'lib/login_register/custom2.php';

	include 'lib/blog_posts.php';

	include 'lib/all_categories.php';

	include 'lib/all_locations.php';

	include 'lib/claim_listing.php';

	

	include 'lib/my_account/my_account.php';

	include 'lib/my_account/pers_info.php';

	include 'lib/my_account/all_posted_items.php';

	include 'lib/my_account/my_reviews.php';

	include 'lib/my_account/watchlist.php';

	include 'lib/my_account/expired_listings.php';

	

	include 'lib/widgets/browse-by-location.php';

	include 'lib/widgets/browse-by-category.php';

	include 'lib/widgets/latest-posted-listings.php';

	include 'lib/widgets/most-visited-listings.php';



//--------------------------------------------

	

	add_filter('wp_head',								'Buzzler_add_max_nr_of_images');

	add_action("template_redirect", 	'Buzzler_template_redirect');

	add_action("Buzzler_home_slider", 	'Buzzler_home_slider_fnc');

	add_action("Buzzler_slider_post", 	'Buzzler_slider_post_fnc');

	add_action("Buzzler_get_post", 		'Buzzler_get_post_fnc');

	add_action('init', 					'Buzzler_create_post_type' );	

	add_action('comment_text', 			'buzzler_filter_comment_text',10);
 
	add_action('admin_head', 			'buzzler_admin_main_head_scr');

	add_action('generate_rewrite_rules', 						'buzzler_rewrite_rules' );

	add_action('admin_menu', 						'buzzler_admin_main_menu_scr');

	add_action('save_post',							'buzzler_save_custom_fields');

	add_action('save_post',							'buzzler_save_custom_fields2');

	add_action('query_vars', 						'buzzler_add_query_vars');

	add_action('the_content', 			'buzzler_my_account_home_look_for_stuff');

	add_action('the_content', 			'buzzler_my_account_pers_info_look_for_stuff');

	add_action('the_content', 			'buzzler_my_account_all_posted_items_look_for_stuff');

	add_action('the_content', 			'buzzler_my_account_my_reviews_look_for_stuff');

	add_action('the_content', 			'buzzler_my_account_watchlist_look_for_stuff');

	add_action('the_content', 			'buzzler_post_new_look_for_stuff');

	add_action('the_content', 			'buzzler_adv_search_look_for_stuff');

	add_action('the_content', 			'buzzler_my_account_exp_posted_items_look_for_stuff');

	add_action('the_content', 			'buzzler_listing_maps_look_for_stuff');

	add_action('the_content', 			'buzzler_blog_pgs_look_for_stuff');

	add_action('the_content', 			'buzzler_all_cats_look_for_stuff');

	add_action('the_content', 			'buzzler_all_locations_look_for_stuff');

	add_action('the_content', 			'buzzler_claim_listing_look_for_stuff');

	add_action( 'init', 										'buzzler_register_my_menus' );

		

	add_action('comment_post', 'buzzler_run_after_comment_post');

	add_action('wp_enqueue_scripts', 							'buzzler_add_theme_styles');

	add_action("manage_posts_custom_column", 					"Buzzler_my_custom_columns");

	add_filter("manage_edit-listing_columns",					"Buzzler_my_listings_columns");

	add_filter("manage_edit-payment-plan_columns",					"Buzzler_my_listings_columns_payment_plans");





function buzzler_count_user_posts_by_type($userid, $post_type = 'post') {

  global $wpdb;

  $where = get_posts_by_author_sql($post_type, TRUE, $userid);

  $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts $where" );

  return apply_filters('get_usernumposts', $count, $userid);

}



function buzzler_register_my_menus() {



		register_nav_menu( 'primary-buzzler-main-header', 'Buzzler Big Main Menu' );		

		

}



function buzzler_run_after_comment_post($comment_ID) 

{

  	

	//buzzler_get_rating_for_post

	

	$pid = $_POST['comment_post_ID'];

	$sum_up_rating = get_post_meta($pid, 'sum_up_rating', true);

	$total_ratings = get_post_meta($pid, 'total_ratings', true);

	

	if(empty($sum_up_rating)) $sum_up_rating = 0;

	if(empty($total_ratings)) $total_ratings = 0;

	

 	$my_rating = $_POST['my_rating']; 

  	update_comment_meta( $comment_ID, 'grade', $my_rating);

  	

	//----------------------------

	

	$sum_up_rating += $my_rating;

	$total_ratings += 1;

	

	//----------------------------

 	

	update_post_meta($pid, 'sum_up_rating', $sum_up_rating);

	update_post_meta($pid, 'total_ratings', $total_ratings);

	

	update_post_meta($pid, 'general_rating', round(($sum_up_rating / $total_ratings) , 2));

	

}



	

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_my_custom_columns($column)

{

	global $post;

	

//----------------	

	

	if ("thumbnail" == $column) 

	{

		echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/post.php?post='.$post->ID.'&action=edit"><img class="image_class" 

	src="'.buzzler_get_first_post_image($post->ID,75,65).'" width="75" height="65" /></a>'; //shows up our post thumbnail that we previously created.

	}

	

	elseif ("days_list" == $column)

	{

		$f = get_post_meta($post->ID,'days', true);	

		echo $f. " days";

	}

	

	elseif ("price_list" == $column)

	{

		$f = get_post_meta($post->ID,'price', true);	

		echo buzzler_get_show_price($f);

	}

	

	elseif ("order_list" == $column)

	{

		$f = get_post_meta($post->ID,'order', true);	

		echo $f;

	}

	

	elseif ("feat" == $column)

	{

		$f = get_post_meta($post->ID,'featured', true);	

		if($f == "1") echo __("Yes","Buzzler");

		else  echo __("No","Buzzler");

	}

	

	elseif ("exp" == $column)

	{

		$ending = get_post_meta($post->ID, 'ending', true);		

		echo Buzzler_prepare_seconds_to_words($ending - current_time('timestamp',0));	

	}

	

	elseif ("options" == $column)

	{

		echo '<div style="padding-top:20px">';

		echo '<a class="awesome" href="'.get_bloginfo('siteurl').'/wp-admin/post.php?post='.$post->ID.'&action=edit">Edit</a> ';	

		echo '<a class="awesome" href="'.get_permalink($post->ID).'" target="_blank">View</a> ';

		echo '<a class="trash" href="'.get_delete_post_link($post->ID).'">Trash</a> ';

		echo '</div>';

	}

	

}	

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function Buzzler_my_listings_columns_payment_plans($columns)

{

	

		$columns["days_list"] = __("Valid For","Buzzler");

		$columns["price_list"] = __("Price","Buzzler");

		$columns["order_list"] = __("Order","Buzzler");

 

	return $columns;	

}



function Buzzler_my_listings_columns($columns) //this function display the columns headings

{

 

		$columns["exp"] = __("Expires in","Buzzler");

		$columns["feat"] = __("Featured","Buzzler");

		$columns["thumbnail"] = __("Thumbnail","Buzzler");

		$columns["options"] = __("Options","Buzzler");

 

	return $columns;

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/	

function Buzzler_seconds_to_words_new($seconds)

{

		if($seconds < 0 ) return 'Expired';

			

        /*** number of days ***/

        $days=(int)($seconds/86400); 

        /*** if more than one day ***/

        $plural = $days > 1 ? 'days' : 'day';

        /*** number of hours ***/

        $hours = (int)(($seconds-($days*86400))/3600);

        /*** number of mins ***/

        $mins = (int)(($seconds-$days*86400-$hours*3600)/60);

        /*** number of seconds ***/

        $secs = (int)($seconds - ($days*86400)-($hours*3600)-($mins*60));

        /*** return the string ***/

                if($days == 0 || $days < 0)

				{

					$arr[0] = 0;

					$arr[1] = $hours;

					$arr[2] = $mins;

					$arr[3] = $secs;

					return $arr;//sprintf("%d hours, %d min, %d sec", $hours, $mins, $secs);

				}

				else

				{

					$arr[0] = 1;

					$arr[1] = $days;

					$arr[2] = $hours;

					$arr[3] = $mins;

					

					return $arr; //sprintf("%d $plural, %d hours, %d min", $days, $hours, $mins);

        		}			

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_prepare_seconds_to_words($seconds)

	{

		$res = Buzzler_seconds_to_words_new($seconds); 

		if($res == "Expired") return __('Expired','Buzzler');	

		

		if($res[0] == 0) return sprintf(__("%s hours, %s min, %s sec",'Buzzler'), $res[1], $res[2], $res[3]);

		if($res[0] == 1){

			

			$plural = $res[1] > 1 ? __('days','Buzzler') : __('day','Buzzler');

			return sprintf(__("%s %s, %s hours, %s min",'Buzzler'), $res[1], $plural , $res[2], $res[3]);

		}

	}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_send_email($recipients, $subject = '', $message = '') {

		

	$Buzzler_email_addr_from 	= get_option('Buzzler_email_addr_from');	

	$Buzzler_email_name_from  	= get_option('Buzzler_email_name_from');

	

	$message = stripslashes($message);

	$subject = stripslashes($subject); 

	

	if(empty($Buzzler_email_name_from)) $Buzzler_email_name_from  = "Buzzler Theme";

	if(empty($Buzzler_email_addr_from)) $Buzzler_email_addr_from  = "Buzzler@wordpress.org";

		

	$headers = 'From: '. $Buzzler_email_name_from .' <'. $Buzzler_email_addr_from .'>' . PHP_EOL;

	$Buzzler_allow_html_emails = get_option('Buzzler_allow_html_emails');

	if($Buzzler_allow_html_emails != "yes") $html = false;

	else $html = true;



	$ok_send_email = true;

	$ok_send_email = apply_filters('Buzzler_ok_to_send_emails', $ok_send_email);



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



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_replace_stuff_for_me($find, $replace, $subject)

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

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_categories($taxo, $selected = "", $include_empty_option = "", $ccc = "")

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

 

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_listing_category_fields_without_vals($catid, $clas_op = '')

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."buzzler_custom_fields order by ordr asc";	

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

			$se = "select * from ".$wpdb->prefix."buzzler_custom_relations where custid='$ims'";

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

			

				$s2 = "select * from ".$wpdb->prefix."buzzler_custom_options where custid='$ids' order by ordr ASC ";

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

			

				$s2 = "select * from ".$wpdb->prefix."buzzler_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 	= ''; //!empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;

					

					if(!empty($teka))

					{	

						foreach($teka as $te)

						{

							if($te == $row2->valval) { $teka = "checked='checked'"; break; }

						}	

						

						$teka = '';			

					}

					else $teka = '';

					

					

					$value 	= isset($_GET['custom_field_value_'.$ids]) ? "checked='checked'" : $teka;

					

					$arr[$i]['value']  .= '<input '.$value.' type="checkbox" value="'.$row2->valval.'" name="custom_field_value_'.$ids.'[]"> '.$row2->valval.'<br/>';

				}



		}

		

		if($tp == 2) //select

		{

			$arr[$i]['value']  = '<select class="'.$clas_op.'" name="custom_field_value_'.$ids.'" /><option value="">'.__('Select','Buzzler').'</option>';

			

				$s2 = "select * from ".$wpdb->prefix."buzzler_custom_options where custid='$ids' order by ordr ASC ";

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



 

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/ 

function Buzzler_get_CATID($slug)

{

	$c = get_term_by('slug', $slug, 'listing_cat');	

	return $c->term_id;

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_get_post_blog()

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

                <div  class="title_holder"   > 

                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">

                        <?php the_title(); ?></a></h2>

                        <p class="mypostedon"><?php _e('Posted on','Buzzler'); ?> <?php the_time('F jS, Y') ?>  <?php _e('by','Buzzler'); ?> 

                       <?php the_author() ?>

                  </p>

                       <p class="blog_post_preview"> <?php the_excerpt(); ?></p>

                       

                      

                        <a href="<?php the_permalink() ?>" class="post_bid_btn"><?php _e('Read More','Buzzler'); ?></a>

                         

                     </div></div>

                     

                   

                     

                     </div>

<?php

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_post_new_with_pid_stuff_thg($pid, $step = 1, $fin = '')

{

	$using_perm = Buzzler_using_permalinks();

	if($using_perm)	return get_permalink(get_option('Buzzler_post_new_page_id')). "?listing_id=" . $pid."&step=".$step.(!empty($fin) ? "&finalise=yes" : '');

			else return get_bloginfo('siteurl'). "/?page_id=". get_option('Buzzler_post_new_page_id'). "&listing_id=" . $pid."&step=".$step.(!empty($fin) ? "&finalise=yes" : '');	

}



function Buzzler_post_new_with_pid_stuff_thg2($pid, $step = 1, $plan = '', $ok = '')

{

	$using_perm = Buzzler_using_permalinks();

	if($using_perm)	return get_permalink(get_option('Buzzler_post_new_page_id')). "?ok=".$ok."&listing_id=" . $pid."&step=".$step.(!empty($plan) ? "&plan=".$plan : '');

			else return get_bloginfo('siteurl'). "/?ok=".$ok."&page_id=". get_option('Buzzler_post_new_page_id'). "&listing_id=" . $pid."&step=".$step.(!empty($plan) ? "&plan=".$plan : '');	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_total_nr_of_listing()

{

	$query = new WP_Query( "post_type=listing&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	

	return $query->post_count;

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_total_nr_of_open_listings()

{

	$query = new WP_Query( "meta_key=closed&meta_value=0&post_type=listing&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	

	return $query->post_count;

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_total_nr_of_closed_listings()

{

	$query = new WP_Query( "meta_key=closed&meta_value=1&post_type=listing&order=DESC&orderby=id&posts_per_page=-1&paged=1" );	

	return $query->post_count;

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

add_action( 'admin_enqueue_scripts', 'buzzler_enqueue_scripts_admin' );



function buzzler_enqueue_scripts_admin()

{

		

	wp_register_script( 'jquery-form', get_bloginfo('template_url').'/js/jquery.form.js');

	wp_register_script( 'jquery_metadata', get_bloginfo('template_url').'/js/jquery.MetaData.js');

	wp_register_script( 'jquery_rating', get_bloginfo('template_url').'/js/jquery.rating.js');

	wp_register_script( 'jquery_rating_pack', get_bloginfo('template_url').'/js/jquery.rating.pack.js');

	 

	 wp_enqueue_script( 'jquery-form' );

	  wp_enqueue_script( 'jquery_metadata' );

	 wp_enqueue_script( 'jquery_rating' );

	 wp_enqueue_script( 'jquery_rating_pack' );	

	

	wp_register_style( 'jquery_rating_css', 	get_bloginfo('template_url').'/css/jquery.rating.css', array(), '20120822', 'all' );

	 wp_enqueue_style( 'jquery_rating_css' );

}



function buzzler_add_theme_styles()  

{ 

	global $wp_query;

  	$new_buzzler_step = $wp_query->query_vars['step'];

    $b_action			= $wp_query->query_vars['b_action'];

	

  	wp_register_style( 'bx_styles', get_bloginfo('template_url').'/css/bx_styles.css', array(), '20120822', 'all' );

	//wp_register_script( 'social_pr', get_bloginfo('template_url').'/js/connect.js');

	

	wp_register_script( 'easing', get_bloginfo('template_url').'/js/jquery.easing.1.3.js');

	wp_register_script( 'bx_slider', get_bloginfo('template_url').'/js/jquery.bxSlider.min.js');

	wp_register_script( 'jquery_cowntdown', get_bloginfo('template_url').'/js/jquery.countdown.js');

	

	

	wp_register_style( 'bootstrap_style1', get_bloginfo('template_url').'/css/bootstrap_min.css', array(), '20120822', 'all' );

  	wp_register_style( 'bootstrap_style2', get_bloginfo('template_url').'/css/css.css', array(), '20120822', 'all' );

	wp_register_style( 'bootstrap_style3', get_bloginfo('template_url').'/css/bootstrap_responsive.css', array(), '20120822', 'all' );

	wp_register_style( 'bootstrap_ie6', 	get_bloginfo('template_url').'/css/bootstrap_ie6.css', array(), '20120822', 'all' );

	wp_register_style( 'bootstrap_gal', 	get_bloginfo('template_url').'/css/bootstrap_gal.css', array(), '20120822', 'all' );

	wp_register_style( 'fileupload_ui', 	get_bloginfo('template_url').'/css/fileupload_ui.css', array(), '20120822', 'all' );

	wp_register_style( 'uploadify_css', 	get_bloginfo('template_url').'/lib/uploadify/uploadify.css', array(), '20120822', 'all' );

	

	wp_register_style( 'jquery_rating_css', 	get_bloginfo('template_url').'/css/jquery.rating.css', array(), '20120822', 'all' );

	

	

	wp_register_script( 'html5_js', get_bloginfo('template_url').'/js/html5.js');

	wp_register_script( 'jquery_ui', get_bloginfo('template_url').'/js/vendor/jquery.ui.widget.js');

	wp_register_script( 'templ_min', get_bloginfo('template_url').'/js/templ.min.js');

	wp_register_script( 'load_image', get_bloginfo('template_url').'/js/load_image.min.js');

	wp_register_script( 'canvas_to_blob', get_bloginfo('template_url').'/js/canvas_to_blob.js');

	wp_register_script( 'iframe_transport', get_bloginfo('template_url').'/js/jquery.iframe-transport.js');

	

	

	wp_register_style( 'fileupload_ui', 	get_bloginfo('template_url').'/css/fileupload_ui.css', array(), '20120822', 'all' );

	wp_register_script( 'fileupload_main', get_bloginfo('template_url').'/js/jquery.fileupload.js');

	wp_register_script( 'fileupload_fp', get_bloginfo('template_url').'/js/jquery.fileupload-fp.js');

	wp_register_script( 'fileupload_ui', get_bloginfo('template_url').'/js/jquery.fileupload-ui.js');

	

	wp_register_script( 'locale_thing', get_bloginfo('template_url').'/js/locale.js');

	

	wp_register_script( 'main_thing', get_bloginfo('template_url').'/js/main.js');

	

	wp_register_script( 'jquery-form', get_bloginfo('template_url').'/js/jquery.form.js');

	wp_register_script( 'jquery_metadata', get_bloginfo('template_url').'/js/jquery.MetaData.js');

	wp_register_script( 'jquery_rating', get_bloginfo('template_url').'/js/jquery.rating.js');

	wp_register_script( 'jquery_rating_pack', get_bloginfo('template_url').'/js/jquery.rating.pack.js');

	

	

	wp_enqueue_script( 'hoverIntent', get_bloginfo('template_url') . '/js/jquery.hoverIntent.minified.js', array('jquery') );

	wp_enqueue_script( 'dcjqmegamenu', get_bloginfo('template_url') . '/js/jquery.dcmegamenu.1.3.4.min.js', array('jquery') );

	wp_register_style( 'mega_menu_thing', 	get_bloginfo('template_url').'/css/menu.css', array(), '201208s2', 'all' );

	

	 wp_enqueue_script( 'jquery-form' );

	 wp_enqueue_script( 'jquery_metadata' );

	 wp_enqueue_script( 'jquery_rating' );

	 wp_enqueue_script( 'jquery_rating_pack' );

	   

	

	global $wp_styles, $wp_scripts;

	// enqueing:

  		 wp_enqueue_script( 'hoverIntent' );

		 wp_enqueue_style( 'bx_styles' );

		 wp_enqueue_script( 'social_pr' );

		 wp_enqueue_script( 'easing' );

		 wp_enqueue_script( 'bx_slider' );

		wp_enqueue_script( 'dcjqmegamenu' );

		 wp_enqueue_style( 'mega_menu_thing' );

		 wp_enqueue_style( 'jquery_rating_css' );

		 

		

		if($new_buzzler_step == "2" or $b_action == "edit_listing" or $b_action == "repost_listing"):

		 

		 	  	// enqueing:

	  	wp_enqueue_style( 'bootstrap_style1' );

	 //	wp_enqueue_style( 'bootstrap_style2' );

		//wp_enqueue_style( 'bootstrap_style3' );

		//wp_enqueue_style( 'bootstrap_ie6' );

		//wp_enqueue_style( 'bootstrap_gal' );

		wp_enqueue_style( 'fileupload_ui' );

		wp_enqueue_style( 'uploadify_css' );

		

		 wp_enqueue_script( 'html5_js' );

		 wp_enqueue_script( 'jquery_ui' );

		 wp_enqueue_script( 'templ_min' );

		 wp_enqueue_script( 'load_image' );

		 wp_enqueue_script( 'canvas_to_blob' );

		 wp_enqueue_script( 'iframe_transport' );

		 

		 wp_enqueue_script( 'fileupload_main' );

		 wp_enqueue_script( 'fileupload_fp' );

		 wp_enqueue_script( 'fileupload_ui' );

		 wp_enqueue_script( 'locale_thing' );

		 wp_enqueue_script( 'main_thing' );

		 wp_enqueue_script( 'uploadify_js' );

	 

	//$wp_styles->add_data('bootstrap_ie6', 'conditional', 'lte IE 7');

	

		endif;

}



add_filter('wp_head','buzzler_add_make_rating_jquery');

add_filter('admin_head','buzzler_add_make_rating_jquery');



function buzzler_add_make_rating_jquery()

{

	?>

    <script type="text/javascript" language="javascript">

	

	var $ = jQuery;

	

jQuery(function(){ 

 jQuery('#commentform :radio.star').rating();

 jQuery('radio.star').rating();

  

});

</script>





<?php

	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_clear_table($colspan = '')

{

	return '<tr><td colspan="'.$colspan.'">&nbsp;</td></tr>';	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_search_into($custid, $val)

{

		global $wpdb;

		$s = "select * from ".$wpdb->prefix."buzzler_custom_relations where custid='$custid'";

		$r = $wpdb->get_results($s);

		

		if(count($r) == 0) return 0;

		else

		foreach($r as $row) // = mysql_fetch_object($r))

		{

			if($row->catid == $val) return 1;

		}

	

		return 0;

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/	

function buzzler_get_field_tp($nr)

{

		if($nr == "1") return "Text field";

		if($nr == "2") return "Select box";

		if($nr == "3") return "Radio Buttons";

		if($nr == "4") return "Check-box";

		if($nr == "5") return "Large text-area";	

		

		

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_currency()

{

	$c = trim(get_option('Buzzler_currency_symbol'));

	if(empty($c)) return get_option('Buzzler_currency');

	return $c;	

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_currency()

{

	return Buzzler_get_currency();	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_option_drop_down($arr, $name)

{

	$opts = get_option($name);

	$r = '<select name="'.$name.'">';

	foreach ($arr as $key => $value)

	{

		$r .= '<option value="'.$key.'" '.($opts == $key ? ' selected="selected" ' : "" ).'>'.$value.'</option>';		

		

	}

    return $r.'</select>'; 

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_is_owner_of_post()

{

	

	if(!is_user_logged_in())

		return false;

	

	global $current_user;

	get_currentuserinfo();

	

	$post = get_post(get_the_ID());

	if($post->post_author == $current_user->ID) return true;

	return false;	

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_get_total_ratings_post($pid)

{

	return get_comments_number($pid);	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



add_filter('upload_mimes', 'buzzler_custom_upload_mimes');



function buzzler_custom_upload_mimes ( $existing_mimes=array() ) {

 



$existing_mimes['zip'] = 'application/zip'; 

$existing_mimes['pdf'] = 'application/pdf'; 



return $existing_mimes;



 

}



function buzzler_save_custom_fields($pid)

{

	$pst = get_post($pid);

	

	

	if(isset($_POST['fromadmin']))

	{	

		if($pst->post_type == "listing")

		{

			

		$website_url = trim($_POST['website_url']);

		update_post_meta($pid, 'website_url', $website_url);

		

		$street_address = trim($_POST['street_address']);

		update_post_meta($pid, 'street_address', $street_address);

		

		$youtube_link = trim($_POST['youtube_link']);

		update_post_meta($pid, 'youtube_link', $youtube_link);

		

		

		

		//-----------------------------------

			  

		$loc 		= wp_get_post_terms( $pid, 'listing_location');

		$loc_a 	= '';

			 

		foreach($loc as $l)

			$loc_a .= $l->name.',' ;

				

		$loc_a .= $street_address;

		 

		$data = buzzler_get_geo_coordinates($loc_a);

		$long = $data[3];

		$lat  = $data[2];			  

			  

		update_post_meta($pid, 'list_lat', 	$lat);

		update_post_meta($pid, 'list_long', 	$long);

		

	

	//-----------save custom fields ------------------

		

		for($i=0;$i<count($_POST['custom_field_id']);$i++)

		{

			$id = $_POST['custom_field_id'][$i];

			$valval = $_POST['custom_field_value_'.$id];		

			

			if(is_array($valval))

					update_post_meta($pid, 'custom_field_ID_'.$id, $valval);

			else

				update_post_meta($pid, 'custom_field_ID_'.$id, strip_tags($valval));

		}

	

	//---------------------------------------------------------------------------------------------	

		

		$now 			= current_time('timestamp',0);

		$ending 		= get_post_meta($pid,"ending",true);

		$views 			= get_post_meta($pid,"views",true);

		$closed 		= get_post_meta($pid,"closed",true);

	

	

		update_post_meta($pid,"ending",strtotime($_POST['ending'], $now));	

		if(empty($views)) update_post_meta($pid,"views",0);	

		

		

		if($_POST['featureds'] == '1') 

		update_post_meta($pid,"featured",'1');

		else

		update_post_meta($pid,"featured",'0');

		

		if($_POST['closed'] == '1') 

			{

				

				update_post_meta($pid,"closed",'1');

			}

		else

		{

			if($closed == "1") 	update_post_meta($pid,"ending",current_time('timestamp',0) + 30*24*3600);		

			update_post_meta($pid,"closed",'0');

			

		}

		}

	}

}





/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_adv_search_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_adv_search\]/", $content ) ) 

	{

		ob_start();

		buzzler_adv_search_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_adv_search\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_all_cats_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_show_all_categories\]/", $content ) ) 

	{

		ob_start();

		buzzler_all_cats_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_show_all_categories\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_all_locations_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_show_all_locations\]/", $content ) ) 

	{

		ob_start();

		buzzler_all_locations_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_show_all_locations\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_blog_pgs_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_blog_posts\]/", $content ) ) 

	{

		ob_start();

		buzzler_blog_pgs_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_blog_posts\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}





/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_listing_maps_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_listings_map\]/", $content ) ) 

	{

		ob_start();

		buzzler_listing_map_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_listings_map\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}

	

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_post_new_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_post_new\]/", $content ) ) 

	{

		ob_start();

		buzzler_post_new_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_post_new\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_my_account_watchlist_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_my_account_watch_list\]/", $content ) ) 

	{

		ob_start();

		buzzler_my_account_watchlist_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_my_account_watch_list\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_my_account_my_reviews_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_my_account_reviews\]/", $content ) ) 

	{

		ob_start();

		buzzler_my_account_my_reviews_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_my_account_reviews\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}



function buzzler_claim_listing_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_claim_listing\]/", $content ) ) 

	{

		ob_start();

		buzzler_claim_listing_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_claim_listing\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}







/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_my_account_all_posted_items_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_my_account_listings\]/", $content ) ) 

	{

		ob_start();

		buzzler_my_account_all_posted_listings_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_my_account_listings\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_my_account_exp_posted_items_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_my_account_exp_listings\]/", $content ) ) 

	{

		ob_start();

		buzzler_my_account_exp_posted_listings_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_my_account_exp_listings\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_my_account_pers_info_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_my_account_personal_info\]/", $content ) ) 

	{

		ob_start();

		buzzler_my_account_pers_info_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_my_account_personal_info\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_my_account_home_look_for_stuff( $content = '' ) 

{

	if ( preg_match( "/\[buzzler_theme_my_account\]/", $content ) ) 

	{

		ob_start();

		buzzler_my_account_home_area_function();

		$output = ob_get_contents();

		ob_end_clean();

		$output = str_replace( '$', '\$', $output );

		return preg_replace( "/(<p>)*\[buzzler_theme_my_account\](<\/p>)*/", $output, $content );

		

	} 

	else {

		return $content;

	}

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_small_post($param = '')

{



			$location 	= get_post_meta(get_the_ID(), 'Location', true);

			$views 	= get_post_meta(get_the_ID(), 'views', true);

			$rnd = rand(1,999);

			

?>

				<div class="post small-padd-top" >

                <div class="image_holder2">

                <a href="<?php the_permalink(); ?>"><img width="50" alt="<?php the_title(); ?>" height="50" class="image_class" 

                src="<?php echo Buzzler_get_first_post_image(get_the_ID(),75,65); ?>" /></a>

                </div>

                <div  class="title_holder2" > 

                     <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">

                        <?php   the_title();  ?></a></h2>

                        

                        <p class="mypostedon2">

                        <?php _e("Posted in",'Buzzler');?> <?php echo get_the_term_list( get_the_ID(), 'listing_cat', '', ', ', '' ); ?><br/>

                       <?php _e("Location",'Buzzler');?>: <?php 

					   

					   $lc = get_the_term_list( get_the_ID(), 'listing_location', '', ', ', '' );

					   echo (empty($lc) ? __("not defined",'Buzzler') : $lc ); ?><br/>

                     

                    		

							<?php _e("Views",'Buzzler');?>: <?php echo $views; ?>

                    		

							

                        </p>

                       

                     

                

                     

                     </div></div> <?php	

}	

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_rewrite_rules( $wp_rewrite )

{



		global $category_url_link, $location_url_link;

		$new_rules = array( 

		



		$category_url_link.'/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?listing_cat='.$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),

        $category_url_link.'/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?listing_cat='.$wp_rewrite->preg_index(1)."&feed=".$wp_rewrite->preg_index(2),

        $category_url_link.'/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?listing_cat='.$wp_rewrite->preg_index(1)."&paged=".$wp_rewrite->preg_index(2),

        $category_url_link.'/([^/]+)/?$' => 'index.php?listing_cat='.$wp_rewrite->preg_index(1)

			





		);



		$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;



}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_admin_main_head_scr()

{

	wp_enqueue_script("jquery-ui-widget");

	wp_enqueue_script("jquery-ui-mouse");

	wp_enqueue_script("jquery-ui-tabs");

	wp_enqueue_script("jquery-ui-datepicker");

	

?>	

	

    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>



    <link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/admin.css" type="text/css" />    

    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/colorpicker.css" type="text/css" />

    <link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_url'); ?>/css/layout.css" />

	<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

	

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



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_filter_comment_text($comment_text, $comm = '')

{

	if(is_admin())

	{

		$comment_ID = ($comm->comment_ID);

		$pid 		= $comm->comment_post_ID;

		$grade 		= get_comment_meta($comment_ID,'grade',true);

		$tp = get_post_type( $pid );

		if($tp != "listing") return $comment_text;

		

		if(empty($grade)) $grade = 4;

		

		$cmm = '<div class="rtg100">';

		$cmm .= '<div class="alignleft">'.__("User Rating:",'Buzzler')."</div>".buzzler_get_rating_for_post($pid)."</div>";

		return $cmm.$comment_text;	

	}

	

	

	return $comment_text;

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_get_website_url($pid)

{

	$wb = get_post_meta($pid, 'website_url', true);

	if(empty($wb)) return __('Not defined','Buzzler');

	else {

		

			if(strpos($wb, "http://") === false) $URL = "http://$wb";

			else $URL = $wb;



			return '<a href="'.$URL.'">'.$wb.'</a>';	



	}

}



function buzzler_get_item_primary_cat($pid)

{

	$ad_terms = wp_get_object_terms($pid, 'listing_cat');	

	if(is_array($ad_terms))

	{

		return 	$ad_terms[0]->term_id;

	}

	

	return 0;

}



function Buzzler_get_listing_primary_cat($pid)

{

	$ad_terms = wp_get_object_terms($pid, 'listing_cat');	

	if(is_array($ad_terms))

	{

		return 	$ad_terms[0]->term_id;

	}

	

	return 0;

}

 



function Buzzler_get_images_cost_extra($pid)

{

	$Buzzler_charge_fees_for_images 	= get_option('Buzzler_charge_fees_for_images');

	$Buzzler_extra_image_charge		= get_option('Buzzler_extra_image_charge');



		

	if($Buzzler_charge_fees_for_images == "yes")

	{

		$Buzzler_nr_of_free_images = get_option('Buzzler_nr_of_free_images');

		if(empty($Buzzler_nr_of_free_images)) $Buzzler_nr_of_free_images = 1;	

		

		$Buzzler_get_post_nr_of_images = Buzzler_get_post_nr_of_images($pid);

		

		$nr_imgs = $Buzzler_get_post_nr_of_images - $Buzzler_nr_of_free_images;

		if($nr_imgs > 0)

		{

			return $nr_imgs*	$Buzzler_extra_image_charge;

		}

		

	}

	

	return 0;

	

}



function Buzzler_send_email_posted_item_approved($pid)

{

	$enable 	= get_option('Buzzler_new_item_email_approved_enable');

	$subject 	= get_option('Buzzler_new_item_email_approved_subject');

	$message 	= get_option('Buzzler_new_item_email_approved_message');	

	

	if($enable != "no"):

	

		$post 			= get_post($pid);

		$user 			= get_userdata($post->post_author);

		$site_login_url = Buzzler_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Buzzler_my_account_page_id'));

		

		$post 		= get_post($pid);

		$item_name 	= $post->post_title;

		$item_link 	= get_permalink($pid);



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $item_name, $item_link);

		

		$tag		= 'Buzzler_send_email_posted_item_approved';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Buzzler_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Buzzler_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------

		

		$email = $user->user_email;

		Buzzler_send_email($email, $subject, $message);

		

	endif;		

	

}



function Buzzler_get_post_nr_of_images($pid)

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



function Buzzler_send_email_posted_item_not_approved_admin($pid)

{

	$enable 	= get_option('Buzzler_new_item_email_not_approve_admin_enable');

	$subject 	= get_option('Buzzler_new_item_email_not_approve_admin_subject');

	$message 	= get_option('Buzzler_new_item_email_not_approve_admin_message');	

	

	if($enable != "no"):

	

		$post 			= get_post($pid);

		$user 			= get_userdata($post->post_author);

		$site_login_url = Buzzler_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Buzzler_my_account_page_id'));

		



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Buzzler_send_email_posted_item_not_approved_admin';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Buzzler_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Buzzler_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------

		

		$email = get_bloginfo('admin_email');

		Buzzler_send_email($email, $subject, $message);

	

	endif;	

	

}



function Buzzler_send_email_posted_item_not_approved($pid)

{

	$enable 	= get_option('Buzzler_new_item_email_not_approved_enable');

	$subject 	= get_option('Buzzler_new_item_email_not_approved_subject');

	$message 	= get_option('Buzzler_new_item_email_not_approved_message');	

	

	if($enable != "no"):

	

		$post 			= get_post($pid);

		$user 			= get_userdata($post->post_author);

		$site_login_url = Buzzler_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Buzzler_my_account_page_id'));

		



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Buzzler_send_email_posted_item_not_approved_admin';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Buzzler_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Buzzler_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------



		Buzzler_send_email($email, $subject, $message);

	

	endif;	

	

}



function Buzzler_send_email_posted_item_approved_admin($pid)

{

	$enable 	= get_option('Buzzler_new_item_email_approve_admin_enable');

	$subject 	= get_option('Buzzler_new_item_email_approve_admin_subject');

	$message 	= get_option('Buzzler_new_item_email_approve_admin_message');	

	

	if($enable != "no"):

	

		$post 			= get_post($pid);

		$user 			= get_userdata($post->post_author);

		$site_login_url = Buzzler_login_url();

		$site_name 		= get_bloginfo('name');

		$account_url 	= get_permalink(get_option('Buzzler_my_account_page_id'));

		



		$find 		= array('##username##', '##username_email##', '##site_login_url##', '##your_site_name##', '##your_site_url##' , '##my_account_url##', '##item_name##', '##item_link##');

   		$replace 	= array($user->user_login, $user->user_email, $site_login_url, $site_name, get_bloginfo('siteurl'), $account_url, $post->post_title, get_permalink($pid));

		

		$tag		= 'Buzzler_send_email_posted_item_approved_admin';

		$find 		= apply_filters( $tag . '_find', 	$find );

		$replace 	= apply_filters( $tag . '_replace', $replace );

		

		$message 	= Buzzler_replace_stuff_for_me($find, $replace, $message);

		$subject 	= Buzzler_replace_stuff_for_me($find, $replace, $subject);

		

		//---------------------------------------------

		

		$email = get_bloginfo('admin_email');

		Buzzler_send_email($email, $subject, $message);

	

	endif;

}		





/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_geo_coordinates($addr)

{

	//http://maps.google.com/maps/geo?output=csv&q=Bucharest&key=	

	/*$key = get_option('Buzzler_maps_api_key');

	$url = "http://maps.google.com/maps/geo?output=csv&q=".urlencode($addr)."&key=".$key;

	

	$data = Buzzler_curl_get_data($url);

	$data = explode(",", $data);

	

	return $data;	

	*/

	

	$key = get_option('Buzzler_maps_api_key');



	//$url = "http://maps.google.com/maps/geo?output=csv&q=".urlencode($addr)."&key=".$key;

	$addr = str_replace(" ","+",$addr);

	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$addr."&sensor=false";



	$data = Buzzler_curl_get_data($url);

	$data =  json_decode($data);

	

	//echo '<pre>';

	//print_r($data->results[0]->geometry->location);

	//echo '<pre>';

	//exit;

	

	//$data = explode(",", $data);



	$data1 = array();

	$data1[3] = $data->results[0]->geometry->location->lng;

	$data1[2] = $data->results[0]->geometry->location->lat;







	return $data1;

	

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_curl_get_data($url)

{

	  $ch = curl_init();

	  $timeout = 5;

	  curl_setopt($ch,CURLOPT_URL,$url);

	  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

	  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);

	  $data = curl_exec($ch);

	  curl_close($ch);

	  return $data;

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_get_rating_for_post($pid, $kk = '')

{

	$general_rating = get_post_meta($pid, 'general_rating', true);

	if(empty($general_rating)) $general_rating = 0;

	

	return Buzzler_get_rating_stars($general_rating, $pid . $kk);	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_rating_stars($nr, $comid = '')

{

	return '<input class="star" type="radio" name="rating-'.$nr.'-rating-'.$comid.'" value="1" disabled="disabled" '.($nr == 1 ? 'checked="checked"' : '' ).'/>

<input class="star" type="radio" name="rating-'.$nr.'-rating-'.$comid.'" value="2" disabled="disabled" '.($nr == 2 ? 'checked="checked"' : '' ).'/>

<input class="star" type="radio" name="rating-'.$nr.'-rating-'.$comid.'" value="3" disabled="disabled" '.($nr == 3 ? 'checked="checked"' : '' ).'/>

<input class="star" type="radio" name="rating-'.$nr.'-rating-'.$comid.'" value="4" disabled="disabled" '.($nr == 4 ? 'checked="checked"' : '' ).'/>

<input class="star" type="radio" name="rating-'.$nr.'-rating-'.$comid.'" value="5" disabled="disabled" '.($nr == 5 ? 'checked="checked"' : '' ).'/>



';		

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_post()

{

	do_action('Buzzler_get_post');	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_post_fnc()

{

	global $wpdb, $post, $current_user;

	get_currentuserinfo();

	$uid = $current_user->ID;

	

	$featured = get_post_meta(get_the_ID(), 'featured', true);

	$author_user = $post->post_author;

	

	?>

    	

        <div class="post" id="post-ID-<?php the_ID(); ?>">

        

         		<?php

				

					if($featured == "1")

					echo '<div class="featured-one"></div>';

				?>

        

 

                

                <div class="image_holder">                

                <a href="<?php the_permalink(); ?>"><img width="75" height="65" class="image_class" 

                alt="<?php the_title(); ?>" src="<?php echo Buzzler_get_first_post_image(get_the_ID(),75,65); ?>" /></a>

                

                    <div class="watch-list">

                   <?php

                   

                    if(buzzler_check_if_pid_is_in_watchlist(get_the_ID(), $uid) == true):				

                    ?>

                    

                    <a class="rem-to-watchlist" rel="<?php the_ID(); ?>"  href="#"><?php _e('- watchlist','Buzzler'); ?></a>

                    

                    <?php else: ?>

                    

                    <a class="add-to-watchlist" rel="<?php the_ID(); ?>" href="#"><?php _e('+ watchlist','Buzzler'); ?></a>

                    <?php endif; ?>  

                   

                    </div>

                

                </div>

        		

                <div class="content_holder">

                

                    <div  class="title_holder" ><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">

                            <?php  the_title(); ?></a></h2>

                            

                            <div class="review_post">

                            <div class="post_review_link"><a href="<?php the_permalink() ?>"><?php _e('Post Review','Buzzler'); ?></a>

                            <?php

							

								if($author_user == $uid):	

									$edit_link = get_bloginfo('siteurl'). "/?b_action=edit_listing&pid=".get_the_ID();

							?> 

                            <a href="<?php echo $edit_link; ?>"><?php _e('Edit Listing','Buzzler'); ?></a>

                            <?php endif; ?>

                            </div>

                            <div class="post_review_rating"><?php 

							

							$general_rating = get_post_meta(get_the_ID(), 'general_rating', true);

							if(empty($general_rating)) $general_rating = 0;

							

							echo Buzzler_get_rating_stars($general_rating, get_the_ID() . "-post"); ?></div>

                            </div>

                            

                    </div>

                    

                    <div class="posted_in"><?php _e('Posted in:','Buzzler'); ?> <?php echo get_the_term_list( get_the_ID(), 'listing_cat', '', ', ', '' ); ?><br/>

                    <?php _e('Located in:','Buzzler'); ?> <?php echo get_the_term_list( get_the_ID(), 'listing_location', '', ', ', '' ); ?></div>

                    

                    <div class="description_holder post_excerpt">      

                         <?php the_excerpt(); ?> 

                    </div>       

                    

               </div> 

         

        </div>

    

    

    <?php	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_check_if_page_existed($pid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."posts where post_type='page' AND post_status='publish' AND ID='$pid'";

	$r = $wpdb->get_results($s);

	

	if(count($r) > 0) return true;

	return false;	

	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_insert_pages($page_ids, $page_title, $page_tag, $parent_pg = 0 )

{

	

		$opt = get_option($page_ids);			

		if(!buzzler_check_if_page_existed($opt))

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

				

			update_post_meta($post_id, '_wp_page_template', 'buzzler-special-page-template.php');

			update_option($page_ids, $post_id);

		

		}



}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_using_permalinks()

{

	global $wp_rewrite;

	if($wp_rewrite->using_permalinks()) return true; 

	else return false; 	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



 function buzzler_post_type_link_filter_function( $post_link, $id = 0, $leavename = FALSE ) {

	 

	global $category_url_link;

	 

    if ( strpos('%listing_cat%', $post_link) === 'FALSE' ) {

      return $post_link;

    }

    $post = get_post($id);

    if ( !is_object($post) || $post->post_type != 'listing' ) {

	

		if(buzzler_using_permalinks())		

      return str_replace("listing_cat", $category_url_link ,$post_link);

	  else return $post_link; 

    }

    $terms = wp_get_object_terms($post->ID, 'listing_cat');

    if ( !$terms ) {

      return str_replace('%listing_cat%', 'uncategorized', $post_link);

    }

    return str_replace('%listing_cat%', $terms[0]->slug, $post_link);

  }

	

	

add_filter('term_link', 'buzzler_post_type_link_filter_function', 1, 3);

add_filter('post_type_link', 'buzzler_post_type_link_filter_function', 1, 3);

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_slider_post()

{

	do_action('Buzzler_slider_post');	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_slider_post_fnc()

{

	?>

    

    	<div class="slider-post">

		<a href="<?php the_permalink(); ?>"><img width="245" height="161" class="image_class3" 

                src="<?php echo Buzzler_get_first_post_image(get_the_ID(),245,161); ?>" alt="<?php the_title(); ?>" /></a>

                

                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

                

               <!--<h2 class="slider_rating_arrange"> <?php echo buzzler_get_rating_for_post(get_the_ID() . "slider"); ?></h2> -->

        

        </div>        

    

    <?php	

	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function Buzzler_home_slider()

{

	do_action('Buzzler_home_slider');	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_home_slider_fnc()

{

	$opt = get_option('Buzzler_show_home_slider');

	

	if($opt != "no"):

	?>

	

	<div id="buzzler-home-page-slider-inner">

	 	<div id="slider2">

    	

        	<?php

					

				 global $wpdb;	

				 $querystr = "

					SELECT distinct wposts.* 

					FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta, $wpdb->postmeta wpostmeta2

					WHERE wposts.ID = wpostmeta.post_id AND

					wpostmeta.meta_key='closed' AND wpostmeta.meta_value='0'

					AND 

					

					wposts.ID = wpostmeta2.post_id AND

					wpostmeta2.meta_key='featured' AND wpostmeta2.meta_value='1'

					AND 

					

					wposts.post_status = 'publish' 

					AND wposts.post_type = 'listing' 

					ORDER BY wposts.post_date DESC LIMIT 28 ";

				

				 $pageposts = $wpdb->get_results($querystr, OBJECT);

				 $posts_per = 7;

				 ?>

					

					 <?php $i = 0; if ($pageposts): ?>

					 <?php global $post; ?>

                     <?php foreach ($pageposts as $post): ?>

                     <?php setup_postdata($post); ?>

                     

                     

                     <?php 

                     

					 echo '<li>';

                      			Buzzler_slider_post();

					 echo '</li>';

  

                     

                     ?>



                     <?php endforeach; ?>

                     <?php endif; ?>

        

    

    	</div>

    </div>

    

    <?php

	endif;	

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_comment_user_account_link()

{

	$opt = get_option('Buzzler_my_account_reviews_page_id');

	$perm = buzzler_using_permalinks();

	

	if($perm) return get_permalink($opt). "?";

	

	return get_permalink($opt). "&pg=".$subpage."&";

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_display_rating_comm($comment, $args, $depth)

{



		$GLOBALS['comment'] = $comment;

		extract($args, EXTR_SKIP);



		if ( 'div' == $args['style'] ) {

			$tag = 'div';

			$add_below = 'comment';

		} else {

			$tag = 'li';

			$add_below = 'div-comment';

		}

		

		$comm_id = get_comment_ID();

		

		$tag  = 'div';

?>

		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

		<?php if ( 1 ) : ?>

		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">

		<?php endif; ?>

		<div class="comment-author vcard">

		<div class="avatar_actual_pic"><?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?></div>

		<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>

		</div>

        

        <div class="comment-corp ">

        

        

<?php if ($comment->comment_approved == '0') : ?>

		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>

		<br />

<?php endif; ?>



		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">

			<?php

				/* translators: 1: date, 2: time */

				printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );

				

				$grade 		= get_comment_meta(get_comment_ID(),'grade',true);

				if(empty($grade)) $grade = 0;

				

				echo '<div class="rating_me_me">';

				echo Buzzler_get_rating_stars($grade, $comm_id);

				echo '</div>';

			?>

		</div>

		

        <p class="comm_text_front">

		<?php comment_text() ?>

		</p>

        

		<div class="reply">

		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

		</div>

		<?php if (1): // 'div' != $args['style'] ) : ?>

		</div>

		<?php endif; ?>

        

        </div></div>

<?php

        

		

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_create_post_type() 

{

  

	global $listings_url_thing;

  	$icn = get_bloginfo('template_url')."/images/listing_icon.gif";

	$icn2 =  get_bloginfo('template_url'). '/images/wallet_icon.png' ;	 

	

	register_post_type( 'listing',

	array(

	  	'labels' => array(

		'name' 			=> __( 'Listings' ,			'Buzzler'),

		'singular_name' => __( 'Listing'  ,			'Buzzler'),

		'add_new' 		=> __('Add New Listing' ,	'Buzzler'),

		'new_item' 		=> __('New Listing' ,		'Buzzler'),

		'edit_item'		=> __('Edit Listing' ,		'Buzzler'),

		'add_new_item' 	=> __('Add New Listing' ,	'Buzzler'),

		'search_items' 	=> __('Search Listing' ,	'Buzzler')		

	  ),

	  'public' => true,

	  'menu_position' => 5,

	  'register_meta_box_cb' => 'Buzzler_set_metaboxes',

	  'has_archive' => "all-listings",

		'rewrite' => array('slug'=> $listings_url_thing.'/%listing_cat%', 'pages' => false),

	  '_builtin' => false,

	  'menu_icon' => $icn,

	  'publicly_queryable' => true,

	  'hierarchical' => false 

		

	)

	  );

	  

	  

	  register_post_type( 'payment-plan',

	array(

	  	'labels' => array(

		'name' 			=> __( 'Payment Plans' ,			'Buzzler'),

		'singular_name' => __( 'Payment Plan'  ,			'Buzzler'),

		'add_new' 		=> __('Add New Plan' ,	'Buzzler'),

		'new_item' 		=> __('New Plan' ,		'Buzzler'),

		'edit_item'		=> __('Edit Plan' ,		'Buzzler'),

		'add_new_item' 	=> __('Add New Plan' ,	'Buzzler'),

		'search_items' 	=> __('Search Plans' ,	'Buzzler')		

	  ),

	  'public' => true,

	  'menu_position' => 6,

	  'register_meta_box_cb' => 'Buzzler_set_payment_plans_metaboxes',

	  'has_archive' => "all-plans",

		'rewrite' => false,

	  '_builtin' => false,

	  'menu_icon' => $icn2,

	  'publicly_queryable' => true,

	  'hierarchical' => false 

		

	)

	  );

	  

	

		register_taxonomy( 'listing_cat', 'listing', array( 'hierarchical' => true, 'label' => __('Listing Categories' ,'Buzzler'),

		'rewrite'                      => true

		 ) );

		register_taxonomy( 'listing_location', 'listing', array( 'hierarchical' => true, 'label' => __('Locations' ,'Buzzler'), 

		'labels' => array('add_new_item' => 'Add New Location' ,'Buzzler') ,

		'rewrite'                       => true

		

		 ) );

		add_post_type_support( 'listing', 'author' );

		add_post_type_support( 'listing', 'trackbacks' );

		add_post_type_support( 'listing', 'comments' );

		//add_post_type_support( 'listing', 'custom-fields' );

		register_taxonomy_for_object_type('post_tag', 'listing');

		

		flush_rewrite_rules();

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_add_query_vars($public_query_vars) 

{  

    	$public_query_vars[] = 'jb_action';

		$public_query_vars[] = 'b_action'; 

		$public_query_vars[] = 'b_action'; 

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

		

    	return $public_query_vars;  

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_show_big_map_lnk($pid)

{

	return get_bloginfo('siteurl') . "/?b_action=show_full_map&pid=" . $pid;	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function get_listing_category_fields($catid, $pid = '')

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."buzzler_custom_fields order by ordr asc";	

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

			$se = "select * from ".$wpdb->prefix."buzzler_custom_relations where custid='$ims'";

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

		

		$arr[$i]['value']  = '<input class="do_input" type="text" size="30" name="custom_field_value_'.$ids.'" 

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

			

				$s2 = "select * from ".$wpdb->prefix."buzzler_custom_options where custid='$ids' order by ordr ASC ";

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

			

				$s2 = "select * from ".$wpdb->prefix."buzzler_custom_options where custid='$ids' order by ordr ASC ";

				$r2 = $wpdb->get_results($s2);

				

				if(count($r2) > 0)

				foreach($r2 as $row2) // = mysql_fetch_object($r2))

				{

					$teka 		= !empty($pid) ? get_post_meta($pid, 'custom_field_ID_'.$ids) : "" ;

					$teka 		= $teka[0];

					$teka_ch 	= '';

					

					if(!empty($teka))

					{	

						foreach($teka as $te)

						{

							

							if(trim($te) == trim($row2->valval)) { $teka_ch = "checked='checked'";  break; }

						}	

								

					}

					else $teka_ch = '';

			

					

					$teka_ch 	= isset($_POST['custom_field_value_'.$ids]) ? "checked='checked'" : $teka_ch;

					

					$arr[$i]['value']  .= '<input type="checkbox" '.$teka_ch.' value="'.$row2->valval.'" name="custom_field_value_'.$ids.'[]"> '.$row2->valval.'<br/>';

				}

		}

		

		if($tp == 2) //select

		{

			$arr[$i]['value']  = '<select class="do_input" name="custom_field_value_'.$ids.'" />';

			

				$s2 = "select * from ".$wpdb->prefix."buzzler_custom_options where custid='$ids' order by ordr ASC ";

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

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_custom_fields_html()

{

	global $post, $wpdb;

	$pid = $post->ID;

	?>

    <table width="100%">

    <input type="hidden" value="1" name="fromadmin" />

	<?php

		$cat 		  	= wp_get_object_terms($pid, 'listing_cat');

		$catidarr 		= array();

		

		foreach($cat as $catids)

		{

			$catidarr[] = $catids->term_id;

		}

	

		$arr 	= get_listing_category_fields($catidarr, $pid);

		

		for($i=0;$i<count($arr);$i++)

		{

			

			        echo '<tr>';

					echo '<td>'.$arr[$i]['field_name'].$arr[$i]['id'].':</td>';

					echo '<td>'.$arr[$i]['value'];

					do_action('Buzzler_step3_after_custom_field_'.$arr[$i]['id'].'_field');

					echo '</td>';

					echo '</tr>';

			

			

		}	

	

	?> 

    

    

    </table>

    <?php	

	

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_set_payment_plans_metaboxes()

{

	add_meta_box( 'plant_dets', 			'Plan Details',		'Buzzler_theme_payment_plan_dts', 'payment-plan', 'side','high' );	

}



function Buzzler_set_metaboxes()

{

	add_meta_box( 'custom_listing_fields', 	'Listing Custom Fields','Buzzler_custom_fields_html', 'listing', 'advanced','high' );

	add_meta_box( 'listing_images', 		'Listing Images',		'Buzzler_theme_listing_images', 'listing', 'advanced','high' );

	add_meta_box( 'listing_dets', 			'Listing Details',		'Buzzler_theme_listing_dts', 'listing', 'side','high' );		

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_save_custom_fields2($pid)

{

	$pst = get_post($pid);

	

	if(isset($_POST['fromadmin']))

	{

		if($pst->post_type == "payment-plan")

		{

			update_post_meta($pid, 'featured_homepage', $_POST['featured_homepage']);

			update_post_meta($pid, 'featured', $_POST['featured']);

			update_post_meta($pid, 'recurring', $_POST['recurring']); 

			

			update_post_meta($pid, 'price', $_POST['price']); 

			update_post_meta($pid, 'days', $_POST['days']);

			update_post_meta($pid, 'order', $_POST['order']); 	

			

		}	

	}

}



function Buzzler_theme_payment_plan_dts()

{

	global $post;

	$pid = $post->ID;	

	

	$featured_homepage 	= get_post_meta($pid,'featured_homepage',true);

	$featured  			= get_post_meta($pid,'featured',true);

	$recurring 			= get_post_meta($pid,'recurring',true);

	

	

	?>

     <ul id="post-new4"> 

    <input name="fromadmin" type="hidden" value="1" />

   

   		<li>

        <h2><?php _e("Display Order",'Buzzler');?>:</h2>

        <p><input type="order" value="<?php echo get_post_meta($pid,'order',true); ?>" size="3" name="order" /></p>

        </li>

    

     	<li>

        <h2><?php _e("Price",'Buzzler');?>:</h2>

        <p><input type="text" value="<?php echo get_post_meta($pid,'price',true); ?>" size="4" name="price" /> <?php echo buzzler_get_currency(); ?></p>

        </li>

        

        

        <li>

        <h2><?php _e("Valid for",'Buzzler');?>:</h2>

        <p><input type="text" value="<?php echo get_post_meta($pid,'days',true); ?>" size="4" name="days" /> days</p>

        </li>

        

        

        <li>

        <h2><?php _e("HomePage Featured",'Buzzler');?>:</h2>

        <p class="sk_ml"><input type="checkbox" value="1" name="featured_homepage" <?php if($featured_homepage == '1') echo ' checked="checked" '; ?> /> <?php _e("Yes",'Buzzler');?></p>

        </li>

        

        <li>

        <h2><?php _e("Search Featured",'Buzzler');?>:</h2>

        <p class="sk_ml"><input type="checkbox" value="1" name="featured_search" <?php if($featured_search == '1') echo ' checked="checked" '; ?> /> <?php _e("Yes",'Buzzler');?></p>

        </li>

        

        

        <li>

        <h2><?php _e("Recurring?",'Buzzler');?>:</h2>

        <p class="sk_ml"><input type="checkbox" value="1" name="recurring" <?php if($recurring == '1') echo ' checked="checked" '; ?> /> <?php _e("Yes",'Buzzler');?></p>

        </li>

        

     </ul>   

    

    

    <?php

}



function Buzzler_theme_listing_dts()

{

	global $post;

	$pid = $post->ID;

	$price = get_post_meta($pid, "price", true);

	$location = get_post_meta($pid, "Location", true);

	$f = get_post_meta($pid, "featured", true);

	$t = get_post_meta($pid, "closed", true);

	

	$reverse = get_post_meta($pid, "reverse", true);

	

	?>

    

    <ul id="post-new4"> 

    <input name="fromadmin" type="hidden" value="1" />

   

   

    

     	<li>

        <h2><?php _e("Featured",'Buzzler');?>:</h2>

        <p><input type="checkbox" value="1" name="featureds" <?php if($f == '1') echo ' checked="checked" '; ?> /></p>

        </li>

        

        

        <li>

        <h2><?php _e("Expired",'Buzzler');?>:</h2>

        <p><input type="checkbox" value="1" name="closed" <?php if($t == '1') echo ' checked="checked" '; ?> /></p>

        </li>

        

        

          <li>

        <h2><?php _e("Website",'Buzzler');?>:</h2>

        <p><input type="text" value="<?php echo get_post_meta($pid,'website_url',true); ?>" name="website_url" size="16" /></p>

        </li>

        

         <li>

        <h2><?php _e("Address",'Buzzler');?>:</h2>

        <p><textarea rows="3" cols="18" name="street_address" ><?php echo get_post_meta($pid,'street_address',true); ?></textarea></p>

        </li>

        

        

        

        <li>

                                <h2><?php echo __('Youtube Link','Buzzler'); ?>:</h2>

                            <p><input type="text" size="50" name="youtube_link" class="do_input" 

                                value="<?php echo get_post_meta($pid, 'youtube_link', true); ?>" /></p>

        </li>

        

        

        

        <li>

        <h2>

        

         

        

        <link rel="stylesheet" media="all" type="text/css" href="<?php echo get_bloginfo('template_url'); ?>/css/ui-thing.css" />

		<script type="text/javascript" language="javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-ui-timepicker-addon.js"></script>

          

          

          

          

       <?php _e("Expires On",'Buzzler'); ?>:</h2>

        <p><input type="text" name="ending" id="ending" size="16" value="<?php

		

		$d = get_post_meta($pid,'ending',true);

		

		if(!empty($d)) {

		$r = date('m/d/Y H:i:s', $d);

		echo $r;

		}

		 ?>" class="do_input"  /></p>

        </li>

        

 <script>



jQuery(document).ready(function() {

	 jQuery('#ending').datetimepicker({

	showSecond: true,

	timeFormat: 'hh:mm:ss'

});});

 

 </script>

        

        

	</ul>    



	

	<?php

		

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function get_listing_fields_values($pid)

	{

		$cat = wp_get_object_terms($pid, 'listing_cat');

	

		$catid = $cat[0]->term_id ;

	

		global $wpdb;

		$s = "select * from ".$wpdb->prefix."buzzler_custom_fields order by ordr asc "; //where cate='all' OR cate like '%|$catid|%' order by ordr asc";	

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

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function Buzzler_theme_listing_images()

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

	

	

	

	var $ = jQuery;

	

	function delete_this(id)

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

			

jQuery('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" /><a href="javascript: void(0)" onclick="delete_this('+ bar[1] +')"><img border="0" src="<?php echo get_bloginfo('template_url'); ?>/images/delete_icon.png" border="0" /></a></div>');

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

			Buzzler_generate_thumb($url, 70, 70). '" />

			<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>

			</div>';

	  

	}

	}





	?>

    

    </div>

    

<?php 

	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_is_home()

{

	global $current_user, $wp_query;

	$b_action 	=  $wp_query->query_vars['b_action'];	

	

	if(!empty($b_action)) return false;

	if(is_home()) return true;

	return false;

	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function Buzzler_get_auto_draft($uid)

{

	global $wpdb;	

	$querystr = "

		SELECT distinct wposts.* 

		FROM $wpdb->posts wposts where 

		wposts.post_author = '$uid' AND wposts.post_status = 'auto-draft' 

		AND wposts.post_type = 'listing' 

		ORDER BY wposts.ID DESC LIMIT 1 ";

				

	$row = $wpdb->get_results($querystr, OBJECT);

	if(count($row) > 0)

	{

		$row = $row[0];

		return $row->ID;

	}

	

	return Buzzler_create_auto_draft($uid);	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_create_auto_draft($uid)

{

		$my_post = array();

		$my_post['post_title'] 		= 'Auto Draft';

		$my_post['post_type'] 		= 'listing';

		$my_post['post_status'] 	= 'auto-draft';

		$my_post['post_author'] 	= $uid;

		$pid =  wp_insert_post( $my_post, true );

		

		update_post_meta($pid,'base_fee_paid', 		"0");

		update_post_meta($pid,'featured_paid', 	"0");

		

		return $pid;

		

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function Buzzler_add_max_nr_of_images()

{

	?>

    

    <script type="text/javascript">

		<?php

		$Buzzler_enable_max_images_limit = get_option('Buzzler_enable_max_images_limit');

		if($Buzzler_enable_max_images_limit == "yes")

		{

			$Buzzler_nr_max_of_images = get_option('Buzzler_nr_max_of_images');

			if(empty($Buzzler_nr_max_of_images))	 $Buzzler_nr_max_of_images = 10;

		}

		else $Buzzler_enable_max_images_limit = 1000;

		

		if(empty($Buzzler_nr_max_of_images)) $Buzzler_nr_max_of_images = 100;

		

		?>

		

		

		

		var maxNrImages_BZ = <?php echo $Buzzler_nr_max_of_images; ?>;

	

	</script>

    

    <?php	

	

}



function Buzzler_template_redirect()

{

	global $wp;

	global $wp_query, $wp_rewrite, $post;

	$b_action 	=  $wp_query->query_vars['b_action'];

	$my_pid = $post->ID;

	$Buzzler_post_new_page_id 						= get_option('Buzzler_post_new_page_id');

	$parent 										= $post->post_parent;

	$Buzzler_my_account_page_id						= get_option('Buzzler_my_account_page_id');

	$Buzzler_claim_listing_page_id 					= get_option('Buzzler_claim_listing_page_id');

	

	//---------------------

	

	if(isset($_GET['contact_owner_thing']))

	{

		include 'lib/contact_owner_thing.php';

		die();	

	}

	

	if($Buzzler_claim_listing_page_id == $my_pid )

	{

		

		if(!is_user_logged_in())	{ wp_redirect(Buzzler_login_url()); exit; }	

	}

	

	if($parent == $Buzzler_my_account_page_id or $Buzzler_my_account_page_id == $my_pid )

	{

		

		if(!is_user_logged_in())	{ wp_redirect(Buzzler_login_url()); exit; }	

	}

	

	if($b_action == 'show_full_map')

	{

		include 'lib/show_full_map.php';

		die();

	}

	

	if($my_pid == $Buzzler_post_new_page_id)

	{

		if(!is_user_logged_in())	{ wp_redirect(Buzzler_login_url()); exit; }

		

		if(!isset($_GET['listing_id'])) $set_ad = 1; else $set_ad = 0;

		global $current_user;

		get_currentuserinfo();

		

		if($set_ad == 1)

		{

			$pid 		= Buzzler_get_auto_draft($current_user->ID);

			wp_redirect(Buzzler_post_new_with_pid_stuff_thg($pid));

		}

		

		include 'lib/post_new_post.php';		

	}

	

	if($b_action == 'paypal_listing')

	{

		include 'lib/gateways/paypal_listing.php';

		die();

	}

	

	if($b_action == 'mb_listing')

	{

		include 'lib/gateways/moneybookers_listing.php';

		die();

	}

	

	if($b_action == 'payza_listing')

	{

		include 'lib/gateways/payza_listing.php';

		die();

	}

	

	

	if($b_action == 'edit_listing')

	{

		include 'lib/my_account/edit_listing.php';

		die();

	}

	

	if($b_action == 'mb_mem_response')

	{

		include 'lib/gateways/mb_mem_response.php';

		die();

	}

	

	

	if($b_action == 'mb_listing_response')

	{

		include 'lib/gateways/moneybookers_listing_response.php';

		die();

	}

	

		

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_login_url()

{

	return get_bloginfo('siteurl'). '/wp-login.php' ;	

}



function buzzler_formats_special($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always

  

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





/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_post_new_link()

{

	return get_permalink(get_option('Buzzler_post_new_page_id'));	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_get_first_post_image($pid, $w = 100, $h = 100)

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

			$url = wp_get_attachment_url($attachment->ID);

			return Buzzler_generate_thumb($url, $w, $h);	  

		}

	}

	else{

			return get_bloginfo('template_url').'/images/nopic.png';

			

	}

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_generate_thumb($img_url, $width, $height, $cut = true)

{



	

	require_once(ABSPATH . '/wp-admin/includes/image.php');

	$uploads = wp_upload_dir();

	$basedir = $uploads['basedir'].'/';

	$exp = explode('/',$img_url);

	

	$nr = count($exp);

	$pic = $exp[$nr-1];

	$year = $exp[$nr-3];

	$month = $exp[$nr-2];



	if($uploads['basedir'] == $uploads['path'])

	{

		$img_url = $basedir.'/'.$pic;

		$ba = $basedir.'/';

		$iii = $uploads['url'];

	}

	else

	{

		$img_url = $basedir.$year.'/'.$month.'/'.$pic;

		$ba = $basedir.$year.'/'.$month.'/';

		$iii = $uploads['baseurl']."/".$year."/".$month;

	}

	list($width1, $height1, $type1, $attr1) = getimagesize($img_url);

	

	//return $height;

	$a = false;

	if($width == -1)

	{

		$a = true;

	

	}





	if($width > $width1) $width = $width1-1;

	if($height > $height1) $height = $height1-1;



	if($a == true)

	{

		$prop = $width1 / $height1;

		$width = round($prop * $height);

	}

	

		$width = $width-1;

	$height = $height-1;

	

	

	$xxo = "-".$width."x".$height;

	$exp = explode(".", $pic);

	$new_name = $exp[0].$xxo.".".$exp[1];

	

	$tgh = str_replace("//","/",$ba.$new_name);



	if(file_exists($tgh)) return $iii."/".$new_name;	







	$thumb = image_resize($img_url,$width,$height,$cut);

	

	if(is_wp_error($thumb)) {  return $thumb->get_error_message(); }

	

	$exp = explode($basedir, $thumb);	

    return $uploads['baseurl']."/".$exp[1]; 

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_advanced_search_link()

{

	$buzzler_using_permalinks = buzzler_using_permalinks();

	

	if($buzzler_using_permalinks)

	return get_permalink(get_option('Buzzler_adv_search_id')) . "?";	

	else

	return get_bloginfo('siteurl') . "?page_id=" .get_option('Buzzler_adv_search_id') . "&";

}



function buzzler_maps_listings_link()

{

	$buzzler_using_permalinks = buzzler_using_permalinks();

	

	if($buzzler_using_permalinks)

	return get_permalink(get_option('Buzzler_listing_map_id')) . "?";	

	else

	return get_bloginfo('siteurl') . "?page_id=" .get_option('Buzzler_listing_map_id') . "&";

}



function buzzler_get_show_price($price, $cents = 2)

{	

	$Buzzler_currency_position = get_option('Buzzler_currency_position');	

	if($Buzzler_currency_position == "front") return buzzler_get_currency()."".buzzler_formats($price, $cents);	

	return buzzler_formats($price,$cents)."".buzzler_get_currency();	

		

}



function buzzler_formats($number, $cents = 1) { // cents: 0=never, 1=if needed, 2=always

  

  $dec_sep = get_option('Buzzler_decimal_sum_separator');

  if(empty($dec_sep)) $dec_sep = '.';

  

  $tho_sep = get_option('Buzzler_thousands_sum_separator');

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







function Buzzler_advanced_search_link2()

{

	return get_permalink(get_option('Buzzler_adv_search_id'));

}



function Buzzler_listing_map_link()

{

	return get_permalink(get_option('Buzzler_listing_map_id'));	

	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_my_account_link()

{

	return get_permalink(get_option('Buzzler_my_account_page_id'));

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function Buzzler_blog_link()

{

	return get_permalink(get_option('Buzzler_blog_page_id'));	

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_get_categories_slug($taxo, $selected = "", $include_empty_option = "", $ccc = "")

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

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_active_listings_nr($uid)

{

	$the_query = new WP_Query( "meta_key=closed&meta_value=0&post_type=listing&order=DESC&orderby=id&author=".$uid."&posts_per_page=-1" );	

	return ($the_query->post_count);

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_expired_listings_nr($uid)

{

	$the_query = new WP_Query( "meta_key=closed&meta_value=1&post_type=listing&order=DESC&orderby=id&author=".$uid."&posts_per_page=-1" );	

	return ($the_query->post_count);

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_reviews_posted_nr($uid_em)

{

	$the_query = get_comments( 'author_email='.$uid_em );;	

	return count($the_query);

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_watch_list_items_nr($uid)

{

	global $wpdb;

	$s = "select * from ".$wpdb->prefix."buzzler_watchlist where uid='$uid' order by id asc";	

	$r = $wpdb->get_results($s);

	return count($r);

}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_get_users_links()

{

		global $current_user, $wpdb;

		get_currentuserinfo();	

		$uid = $current_user->ID;

		

		$usrnm = $current_user->user_login;



?>

	

    	<div id="right-sidebar">

			<ul class="xoxo">

			

            <li class="widget-container widget_text"><h3 class="widget-title"><?php printf(__("Welcome, %s",'Buzzler'), $usrnm); ?></h3>

			

            <ul class="stats-user">

            	<li>

                	<h3><?php _e('Active Listings:','Buzzler'); ?></h3>

                    <p><?php echo buzzler_active_listings_nr($uid); ?></p>

                </li>

                

                <li>

                	<h3><?php _e('Expired Listings:','Buzzler'); ?></h3>

                    <p><?php echo buzzler_expired_listings_nr($uid); ?></p>

                </li>

                

                <li>

                	<h3><?php _e('Reviews Posted:','Buzzler'); ?></h3>

                    <p><?php echo buzzler_reviews_posted_nr($current_user->user_email); ?></p>

                </li>

                

                <li>

                	<h3><?php _e('Watchlist Items:','Buzzler'); ?></h3>

                    <p><?php echo buzzler_watch_list_items_nr($uid); ?></p>

                </li>

               

               <?php do_action('Buzzler_get_user_links_info'); ?>

                

            </ul>



			</li>

            

            

            <!-- ########## -->

            

			<li class="widget-container widget_text"><h3 class="widget-title"><?php _e("My Account Menu",'Buzzler'); ?></h3>

			

            <ul id="my-account-admin-menu">

                    <li><a href="<?php echo buzzler_my_account_link(); ?>"><?php _e("My Account Home",'Buzzler');?></a></li>

                    <li><a href="<?php echo buzzler_post_new_link(); ?>"><?php _e("Post New Listing",'Buzzler');?></a></li>

                    <li><a href="<?php echo get_permalink(get_option('Buzzler_my_account_watch_list_page_id')); ?>"><?php _e("Watch List",'Buzzler');?></a></li>

                    <li><a href="<?php echo get_permalink(get_option('Buzzler_my_account_personal_info_page_id')); ?>"><?php _e("Personal Info",'Buzzler');?></a></li>

                    <li><a href="<?php echo get_permalink(get_option('Buzzler_my_account_all_listings_page_id')); ?>"><?php _e("All Live Listings",'Buzzler');?></a></li>

                    <li><a href="<?php echo get_permalink(get_option('Buzzler_my_account_all_pending_page_id')); ?>"><?php _e("Pending Listings",'Buzzler');?></a></li>

                    <li><a href="<?php echo get_permalink(get_option('Buzzler_my_account_exp_listings_page_id')); ?>"><?php _e("Expired Listings",'Buzzler');?></a></li>

                    <li><a href="<?php echo get_permalink(get_option('Buzzler_my_account_reviews_page_id')); ?>"><?php _e("My Reviews",'Buzzler');?></a></li>



            </ul>



			</li>

            

			</ul>

		</div>



<?php

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



function buzzler_get_avatar($uid, $w = 25, $h = 25)

	{

		$av = get_user_meta($uid, 'avatar', true);

		if(empty($av)) return get_bloginfo('template_url')."/images/noav.jpg";

		else return buzzler_generate_thumb($av, $w, $h);

	}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



	add_action('wp_ajax_remove_from_watchlist', 		'buzzler_remove_from_watchlist');

	add_action('wp_ajax_nopriv_remove_from_watchlist', 	'buzzler_remove_from_watchlist');

	

	add_action('wp_ajax_add_to_watchlist', 				'buzzler_add_to_watchlist');

	add_action('wp_ajax_nopriv_add_to_watchlist', 		'buzzler_add_to_watchlist');



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

	

	function buzzler_remove_from_watchlist()

	{

		$pid = $_POST['pid'];

		

		if(is_user_logged_in()):

		

			global $current_user;

			get_currentuserinfo();

			$uid = $current_user->ID;

			

			buzzler_delete_pid_in_watchlist($pid, $uid);

			

			echo "removed-".$uid."-".$pid."-";

		

		else:

		

			echo "NO_LOGGED";	

		

		endif;	

		

	}

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/	

	function buzzler_check_if_pid_is_in_watchlist($pid, $uid)

	{

		global $wpdb;

		$s = "select * from ".$wpdb->prefix."buzzler_watchlist where pid='$pid' AND uid='$uid'";	

		$r = $wpdb->get_results($s);

		

		if(count($r) == 0) return false;		

		return true;

	}

	

	function buzzler_add_pid_in_watchlist($pid, $uid)

	{

		global $wpdb;

		$s = "insert into ".$wpdb->prefix."buzzler_watchlist (pid,uid) values('$pid','$uid')";	

		$wpdb->query($s);

		

	}

/*****************************************************************************

*

*	Function - buzzler -

*

*****************************************************************************/	

	function buzzler_delete_pid_in_watchlist($pid, $uid)

	{

		global $wpdb;

		$s = "delete from ".$wpdb->prefix."buzzler_watchlist where pid='$pid' AND uid='$uid'";	

		$wpdb->query($s);

		

	}

	

/*****************************************************************************

*

*	Function - buzzler -

*

*****************************************************************************/



	function buzzler_add_to_watchlist()

	{

		$pid = $_POST['pid'];

		

		if(is_user_logged_in()):

		

			global $current_user;

			get_currentuserinfo();

			$uid = $current_user->ID;

			

			if(buzzler_check_if_pid_is_in_watchlist($pid, $uid) == false)

				buzzler_add_pid_in_watchlist($pid, $uid);

			

			echo "added-".$uid."-".$pid."-";

			

		else:

		

			echo "NO_LOGGED";	

		

		endif;

	}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/



add_action('widgets_init',	 					'Buzzler_framework_init_widgets' );



function Buzzler_framework_init_widgets()

{



	register_sidebar( array(

		'name' => __( 'Single Page Sidebar', 'Buzzler' ),

		'id' => 'single-widget-area',

		'description' => __( 'The sidebar area of the single blog post', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	

	

	

		

			register_sidebar( array(

		'name' => __( 'Buzzler - Stretch Wide MainPage Sidebar', 'Buzzler' ),

		'id' => 'main-stretch-area',

		'description' => __( 'This sidebar is site wide stretched in home page, just under the slider/menu.', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	

	

	

		register_sidebar( array(

		'name' => __( 'Other Page Sidebar', 'Buzzler' ),

		'id' => 'other-page-area',

		'description' => __( 'The sidebar area of any other page than the defined ones', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	

	

	

	

	register_sidebar( array(

		'name' => __( 'Home Page Sidebar - Right', 'Buzzler' ),

		'id' => 'home-right-widget-area',

		'description' => __( 'The right sidebar area of the homepage', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	

	

	

	

	register_sidebar( array(

		'name' => __( 'Home Page Sidebar - Left', 'Buzzler' ),

		'id' => 'home-left-widget-area',

		'description' => __( 'The left sidebar area of the homepage', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	

	

	

	register_sidebar( array(

		'name' => __( 'First Footer Widget Area', 'Buzzler' ),

		'id' => 'first-footer-widget-area',

		'description' => __( 'The first footer widget area', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	// Area 4, located in the footer. Empty by default.

	register_sidebar( array(

		'name' => __( 'Second Footer Widget Area', 'Buzzler' ),

		'id' => 'second-footer-widget-area',

		'description' => __( 'The second footer widget area', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	// Area 5, located in the footer. Empty by default.

	register_sidebar( array(

		'name' => __( 'Third Footer Widget Area', 'Buzzler' ),

		'id' => 'third-footer-widget-area',

		'description' => __( 'The third footer widget area', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );



	// Area 6, located in the footer. Empty by default.

	register_sidebar( array(

		'name' => __( 'Fourth Footer Widget Area', 'Buzzler' ),

		'id' => 'fourth-footer-widget-area',

		'description' => __( 'The fourth footer widget area', 'Buzzler' ),

		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

		'after_widget' => '</li>',

		'before_title' => '<h3 class="widget-title">',

		'after_title' => '</h3>',

	) );

	



		

			register_sidebar( array(

			'name' => __( 'Buzzler - Listing Single Sidebar', 'Buzzler' ),

			'id' => 'listing-widget-area',

			'description' => __( 'The sidebar of the single listing page', 'Buzzler' ),

			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

			'after_widget' => '</li>',

			'before_title' => '<h3 class="widget-title">',

			'after_title' => '</h3>',

		) );

		

		

			register_sidebar( array(

			'name' => __( 'Buzzler - HomePage Area','Buzzler' ),

			'id' => 'main-page-widget-area',

			'description' => __( 'The sidebar for the main page, just under the slider.', 'Buzzler' ),

			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

			'after_widget' => '</li>',

			'before_title' => '<h3 class="widget-title">',

			'after_title' => '</h3>',

		) );

		



	

}



/**************************************************************

*

*	Buzzler - Function

*

**************************************************************/

function buzzler_get_post_images($pid, $limit = -1)

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

						

				$url = wp_get_attachment_url($attachment->ID);

				array_push($arr, $url);

			  

		}

			return $arr;

		}

		return false;

}


?>