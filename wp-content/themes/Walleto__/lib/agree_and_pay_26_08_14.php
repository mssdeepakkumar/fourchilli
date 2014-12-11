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


	$cart 		= $_SESSION['my_cart']; 
	$prc_t 		= 0; 	
	$tm 		= current_time('timestamp',0);
	
	if(is_array($cart) and count($cart) > 0)
	{
		
		global $wpdb, $current_user;
		get_currentuserinfo();
		$uid = $current_user->ID;
		
		$s = "insert into ".$wpdb->prefix."walleto_orders (uid,datemade) values('$uid','$tm')";
		$wpdb->query($s);
		
		$s = "select * from ".$wpdb->prefix."walleto_orders where uid='$uid' AND datemade='$tm'";
		$r = $wpdb->get_results($s);
		
		$row 		= $r[0];
		$order_id = $row->id;
		$shp = 0;
		
		
		foreach($cart as $item)
		{
			
			$pid	 	= $item['pid'];
			$digital_good = get_post_meta($pid,'digital_good',true);
			$pp 		= Walleto_get_item_price($item['pid']);
			$prc 		= $pp;	
			$quant 		= $item['quant'];
			$shp		+= get_post_meta($item['pid'], 'shipping', true);
			
			if($digital_good != "1")
			{
			
				$qq = get_post_meta($pid,'quant',true);
				update_post_meta($pid,'quant', ($qq - $quant));
			
			}
			
			$wpdb->query("insert into ".$wpdb->prefix."walleto_order_contents (pid, quant, price, uid, orderid, datemade) values('$pid','$quant','$prc','$uid','$order_id', '$tm')");
			
			$prc_t += $prc*$quant;
		}
		
		$wpdb->query("update ".$wpdb->prefix."walleto_orders set totalprice='$prc_t', shipping='$shp' where id='$order_id'");
		
		unset($_SESSION['my_cart']);
		wp_redirect(get_permalink(get_option('Walleto_my_account_outstanding_pay_page_id')));		
	}

?>