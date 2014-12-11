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


add_action('init', 'classifiedTheme_expire_ads_now'); //wp_init - here

function classifiedTheme_expire_ads_now()
{

		$ending = array(
			'key' => 'ending',
			'value' => current_time('timestamp',0),
			'type' => 'numeric',
			'compare' => '<'
		);
		
			$closed = array(
			'key' => 'closed',
			'value' => "0",
			//'type' => 'numeric',
			'compare' => 'LIKE'
		);
		
	$args2 = array( 'posts_per_page' =>'-1', 'post_type' => 'ad', 'meta_query' => array($ending, $closed));
	$the_query = new WP_Query( $args2 );
	
			if($the_query->have_posts()):
			while ( $the_query->have_posts() ) : $the_query->the_post();
			
			update_post_meta(get_the_ID(), 'closed', "1");
			update_post_meta(get_the_ID(), 'paid', "0");
			update_post_meta(get_the_ID(), 'base_fee_paid', '0');
			update_post_meta(get_the_ID(), 'featured_paid', '1');
			
			$post = get_post(get_the_ID());
			$author = get_userdata($post->post_author);
			

			ClassifiedTheme_send_email_expiry_advert_notice(get_the_ID());
 
			
		endwhile;
		endif;
	
}


?>