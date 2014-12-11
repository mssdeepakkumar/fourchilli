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

function Walleto_theme_bullet($rn = '')
{
	global $menu_admin_Walleto_theme_bull;
	$menu_admin_Walleto_theme_bull = '<a href="#" class="tltp_cls" title="'.$rn.'"><img src="'.get_bloginfo('template_url') . '/images/qu_icon.png" /></a>';	
	echo $menu_admin_Walleto_theme_bull;
	
}


function Walleto_disp_spcl_cst_pic($pic)
{
	return '<img src="'.get_bloginfo('template_url').'/images/'.$pic.'" /> ';	
}

if(isset($_POST['crds']))
{
	if(!current_user_can('level_10')) { exit; }
	
	$uid = $_POST['uid'];
	if(!empty($_POST['increase_credits']))
	{
		if($_POST['increase_credits'] > 0)
		if(is_numeric($_POST['increase_credits']))
		{
			$cr = Walleto_get_credits($uid);
			Walleto_update_credits($uid, $cr + $_POST['increase_credits']);
			
			$reason = __('Payment received from site admin','Walleto');
			Walleto_add_history_log('1', $reason, trim($_POST['increase_credits']), $uid);
							
			
		}
	}
	elseif(!empty($_POST['decrease_credits']))
	{
		if($_POST['decrease_credits'] > 0)
		if(is_numeric($_POST['decrease_credits']))
		{
			$cr = Walleto_get_credits($uid);
			Walleto_update_credits($uid, $cr - $_POST['decrease_credits']);
			
			$reason = __('Payment subtracted by site admin','Walleto');
			Walleto_add_history_log('0', $reason, trim($_POST['decrease_credits']), $uid);
		}
	
	}	
	//echo Walleto_get_credits($uid);
	echo $sign.Walleto_get_show_price(Walleto_get_credits($uid)) ;
	exit;
}



function Walleto_admin_main_menu_scr()
{
	 $icn = get_bloginfo('template_url').'/images/walleto_icn.png';
	 $capability = 10;
	 
add_menu_page(__('Walleto'), __('Walleto','Walleto'), $capability,"WL_menu_", 'Walleto_site_summary', $icn, 0);
add_submenu_page("WL_menu_", __('Site Summary','Walleto'), Walleto_disp_spcl_cst_pic('overview_icon.png').__('Site Summary','Walleto'),$capability, "WL_menu_", 'Walleto_site_summary');
add_submenu_page("WL_menu_", __('General Options','Walleto'), Walleto_disp_spcl_cst_pic('setup_icon.png').__('General Options','Walleto'),$capability, "general-options", 'Walleto_general_options');
add_submenu_page("WL_menu_", __('Email Settings','Walleto'), Walleto_disp_spcl_cst_pic('email_icon.png').__('Email Settings','Walleto'),$capability, 'WL_email_set_', 'Walleto_email_settings');
add_submenu_page("WL_menu_", __('Pricing Settings','Walleto'), Walleto_disp_spcl_cst_pic('dollar_icon.png').__('Pricing Settings','Walleto'),$capability, 'WL_pr_set_', 'Walleto_pricing_options');
//add_submenu_page("WL_menu_", __('Custom Pricing','Walleto'), Walleto_disp_spcl_cst_pic('penny_icon.png').__('Custom Pricing','Walleto'),$capability, 'WL_cust_pricing_', 'Walleto_cust_pricing');
add_submenu_page("WL_menu_", __('Custom Fields','Walleto'), Walleto_disp_spcl_cst_pic('input_icon.png').__('Custom Fields','Walleto'),$capability, 'custom-fields', 'Walleto_custom_fields');
add_submenu_page("WL_menu_", __('Images Options','Walleto'), Walleto_disp_spcl_cst_pic('image_icon.png').__('Images Options','Walleto'),$capability, 'WL_img_sett_', 'Walleto_images_settings');
add_submenu_page("WL_menu_", __('Payment Gateways','Walleto'),Walleto_disp_spcl_cst_pic('gateway_icon.png'). __('Payment Gateways','Walleto'),$capability, 'WL_pay_gate_', 'Walleto_payment_gateways');//add_submenu_page("WL_menu_", __('Membership Packs','Walleto'), __('Membership Packs','Walleto'),$capability, 'mem-packs', 'productTheme_membership_packs');
//add_submenu_page("WL_menu_", __('Discount Coupons','Walleto'), Walleto_disp_spcl_cst_pic('cup_icon.png').__('Discount Coupons','Walleto'),$capability, 'WL_discount_', 'Walleto_discount_copuons');
//add_submenu_page("WL_menu_", __('Transactions','Walleto'), __('Transactions','Walleto'),$capability, 'paypal-trans', 'productTheme_transactions');
add_submenu_page('WL_menu_', __('Withdrawals','Walleto'), Walleto_disp_spcl_cst_pic('wallet_icon.png').__('Withdrawals','Walleto'),$capability, 'Withdrawals', 'Walleto_withdrawals');
//add_submenu_page('WL_menu_', __('Escrows','Walleto'), Walleto_disp_spcl_cst_pic('vault_icon.png').__('Escrows','Walleto'),$capability, 'Escrows', 'Walleto_escrows');
add_submenu_page('WL_menu_', __('User Balances','Walleto'), Walleto_disp_spcl_cst_pic('bal_icon.png').__('User Balances','Walleto'),'10', 'WL_user_bal_', 'Walleto_user_balances');
add_submenu_page('WL_menu_', __('User Reviews','Walleto'), Walleto_disp_spcl_cst_pic('review_icon.png').__('User Reviews','Walleto'),'10', 'WL_user_rev_', 'Walleto_user_reviews');
add_submenu_page('WL_menu_', __('Private Messages','Walleto'), Walleto_disp_spcl_cst_pic('mess_icon.png').__('Private Messages','Walleto'),'10', 'WL_user_mess_', 'Walleto_user_private_mess');
add_submenu_page("WL_menu_", __('InSite Transactions','Walleto'), Walleto_disp_spcl_cst_pic('list_icon.png').__('InSite Transactions','Walleto'),$capability, 'trans-sites', 'Walleto_hist_transact');
add_submenu_page("WL_menu_", __('Orders','Walleto'), Walleto_disp_spcl_cst_pic('orders_icon.png').__('Orders','Walleto'),$capability, 'WL_orders_', 'Walleto_orders_main_screen');
//add_submenu_page("WL_menu_", __('Disputes','Walleto'), Walleto_disp_spcl_cst_pic('arbiter_icon.png').__('Disputes','Walleto'),$capability, 'WL_disp_', 'Walleto_disputes_panel');
add_submenu_page("WL_menu_", __('Layout Settings','Walleto'), Walleto_disp_spcl_cst_pic('layout_icon.png').__('Layout Settings','Walleto'),$capability, 'WL_layout_', 'Walleto_layout_settings');
add_submenu_page("WL_menu_", __('Advertising','Walleto'), Walleto_disp_spcl_cst_pic('adv_icon.png').__('Advertising','Walleto'),$capability, 'WL_adv_', 'Walleto_advertising_scr');
//add_submenu_page("WL_menu_", __('Import Tools','Walleto'), Walleto_disp_spcl_cst_pic('sheet_icon.png').__('Import Tools','Walleto'),$capability, 'WL_import_tls_', 'Walleto_import_tools_panel');
add_submenu_page("WL_menu_", __('Tracking Tools','Walleto'), Walleto_disp_spcl_cst_pic('track_icon.png').__('Tracking Tools','Walleto'),$capability, 'WL_trck_', 'Walleto_tracking_tools_panel');
add_submenu_page("WL_menu_", __('Info Stuff','Walleto'), Walleto_disp_spcl_cst_pic('info_icon.png').__('Info Stuff','Walleto'),$capability, 'WL_info_stuff', 'Walleto_info');
 	
	do_action('Walleto_new_page_admin_menu');
	 
}


function Walleto_hist_transact()
{
	global $menu_admin_Walleto_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-list"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto Transaction History</h2>';
	
	$arr = array("yes" => "Yes", "no" => "No");
	
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">All Transactions</a></li> 
    <li><a href="#tabs2">Search User</a></li> 
  </ul> 
  <div id="tabs1" style="display: block; ">
    
	
	
	
	<?php
	

	
	$nrpostsPage = 10; 
	$page = $_GET['pj']; if(empty($page)) $page = 1;
	$my_page = $page;
	
	//-----------------------------------------------------------
	
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."walleto_payment_transactions order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
	$r = $wpdb->get_results($s);
	
	$s1 = "select id from ".$wpdb->prefix."walleto_payment_transactions order by id desc";	 	
	$r1 = $wpdb->get_results($s1);	
		
	
	if(count($r) > 0):
		
	$total_nr = count($r1);
				
				$nrposts = $total_nr;
				$totalPages = ceil($nrposts / $nrpostsPage);
				$pagess = $totalPages;
				$batch = 10; //ceil($page / $nrpostsPage );
				
				
				$start 		= floor($my_page/$batch) * $batch + 1; 
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;
				
				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;
				
				if($start_me <= 0) $start_me = 1;
				
				$previous_pg = $my_page - 1;
				if($previous_pg <= 0) $previous_pg = 1;
				
				$next_pg = $my_page + 1;
				if($next_pg >= $totalPages) $next_pg = 1;	
		
	?>	  
            <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="10%">Username</th>
    <th width="40%">Comment/Description</th>
    <th>Date Made</th>
    <th >Amount</th>
 
    </tr>
    </thead>
    
    
    
    <tbody>


	<?php

	
	foreach($r as $row)
	{
		$user = get_userdata($row->uid);
		
		if($row->tp == 0) { $sign = '-'; $cl = 'redred'; }
		else
		{ $sign = '+'; $cl = 'greengreen'; }
		
		echo '<tr>';	
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->reason .'</th>';
		echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
		echo '<th class="'.$cl.'">'.$sign.Walleto_get_show_price($row->amount,2).'</th>';
 
	
		echo '</tr>';
	}
	
	?>



	</tbody>
    
    
    </table>
    
    <?php
			
			
			if($start > 1)
			echo '<a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$previous_pg.'"><< '.__('Previous','Walleto').'</a> ';
			echo ' <a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$start_me.'"><<</a> ';
			
			
	
			
			for($i = $start; $i <= $end; $i ++) {
				if ($i == $my_page) {
					echo ''.$i.' | ';
				} else {
		
					echo '<a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$i.'">'.$i.'</a> | ';
					
				}
			}
	
	
			
			if($totalPages > $my_page)
			echo ' <a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$end_me.'">>></a> ';
			echo ' <a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$next_pg.'">'.__('Next','Walleto').' >></a> ';	
			
			
			?>
    
    
    <?php else: ?> Sorry there are no transactions.
    
    <?php endif; ?>
          
     	</div>   
          <div id="tabs2" style="display: none; ">
          
          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
          <input type="hidden" name="page" value="trans-sites" />
          <input type="hidden" name="active_tab" value="tabs2" />
          Search User: <input type="text" size="35" value="<?php echo $_GET['src_usr']; ?>" name="src_usr" />
           <input type="submit" value="Submit" name="" />
          </form> <br/>
          
              <?php
	
	if(isset($_GET['src_usr'])):
	
	$usrdt = get_userdatabylogin($_GET['src_usr']);
	
	$nrpostsPage = 10; 
	$page = $_GET['pj']; if(empty($page)) $page = 1;
	$my_page = $page;
	
	//-----------------------------------------------------------
	
	global $wpdb;
	$s = "select * from ".$wpdb->prefix."walleto_payment_transactions where uid='".$usrdt->ID."' order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
	$r = $wpdb->get_results($s);
	
	$s1 = "select id from ".$wpdb->prefix."walleto_payment_transactions where uid='".$usrdt->ID."' order by id desc";	 	
	$r1 = $wpdb->get_results($s1);	
		
	
	if(count($r) > 0):
		
	$total_nr = count($r1);
				
				$nrposts = $total_nr;
				$totalPages = ceil($nrposts / $nrpostsPage);
				$pagess = $totalPages;
				$batch = 10; //ceil($page / $nrpostsPage );
				
				
				$start 		= floor($my_page/$batch) * $batch + 1; 
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;
				
				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;
				
				if($start_me <= 0) $start_me = 1;
				
				$previous_pg = $my_page - 1;
				if($previous_pg <= 0) $previous_pg = 1;
				
				$next_pg = $my_page + 1;
				if($next_pg >= $totalPages) $next_pg = 1;	
		
	?>	  
            <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="10%">Username</th>
    <th width="40%">Comment/Description</th>
    <th>Date Made</th>
    <th >Amount</th>
 
    </tr>
    </thead>
    
    
    
    <tbody>


	<?php

	
	foreach($r as $row)
	{
		$user = get_userdata($row->uid);
		
		if($row->tp == 0) { $sign = '-'; $cl = 'redred'; }
		else
		{ $sign = '+'; $cl = 'greengreen'; }
		
		echo '<tr>';	
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->reason .'</th>';
		echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
		echo '<th class="'.$cl.'">'.$sign.Walleto_get_show_price($row->amount,2).'</th>';
 
	
		echo '</tr>';
	}
	
	?>



	</tbody>
    
    
    </table>
    
    <?php
			
			
			if($start > 1)
			echo '<a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$previous_pg.'"><< '.__('Previous','Walleto').'</a> ';
			echo ' <a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$start_me.'"><<</a> ';
			
			
	
			
			for($i = $start; $i <= $end; $i ++) {
				if ($i == $my_page) {
					echo ''.$i.' | ';
				} else {
		
					echo '<a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$i.'">'.$i.'</a> | ';
					
				}
			}
	
	
			
			if($totalPages > $my_page)
			echo ' <a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$end_me.'">>></a> ';
			echo ' <a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$next_pg.'">'.__('Next','Walleto').' >></a> ';	
			
			
			?>
    
    
    <?php else: ?> Sorry there are no transactions.
    
    <?php endif; endif; ?>
          
          </div> 
        </div> 
    
    
    <?php	
	
	echo '</div>';
}



function Walleto_email_settings()
{
$id_icon 		= 'icon-options-general-email';
	$ttl_of_stuff 	= 'Walleto - '.__('Email Settings','Walleto');
	global $menu_admin_Walleto_theme_bull;
	$arr = array( "yes" => 'Yes', "no" => "No");
	
	
		
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------------------------------------------------------
	
	if(isset($_POST['Walleto_save1']))
	{
		update_option('Walleto_email_name_from', 	trim($_POST['Walleto_email_name_from']));
		update_option('Walleto_email_addr_from', 	trim($_POST['Walleto_email_addr_from']));
		update_option('Walleto_allow_html_emails', trim($_POST['Walleto_allow_html_emails']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_save2']))
	{
		update_option('Walleto_new_user_email_subject', 	trim($_POST['Walleto_new_user_email_subject']));
		update_option('Walleto_new_user_email_message', 	trim($_POST['Walleto_new_user_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_save_new_user_email_admin']))
	{
		update_option('Walleto_new_user_email_admin_subject', 	trim($_POST['Walleto_new_user_email_admin_subject']));
		update_option('Walleto_new_user_email_admin_message', 	trim($_POST['Walleto_new_user_email_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
		if(isset($_POST['Walleto_save3']))
	{
		update_option('Walleto_new_item_email_not_approve_admin_enable', 	trim($_POST['Walleto_new_item_email_not_approve_admin_enable']));
		update_option('Walleto_new_item_email_not_approve_admin_subject', 	trim($_POST['Walleto_new_item_email_not_approve_admin_subject']));
		update_option('Walleto_new_item_email_not_approve_admin_message', 	trim($_POST['Walleto_new_item_email_not_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}

	if(isset($_POST['Walleto_save31']))
	{
		update_option('Walleto_new_item_email_approve_admin_enable', 	trim($_POST['Walleto_new_item_email_approve_admin_enable']));
		update_option('Walleto_new_item_email_approve_admin_subject', 	trim($_POST['Walleto_new_item_email_approve_admin_subject']));
		update_option('Walleto_new_item_email_approve_admin_message', 	trim($_POST['Walleto_new_item_email_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_save32']))
	{
		update_option('Walleto_new_item_email_not_approved_enable', 	trim($_POST['Walleto_new_item_email_not_approved_enable']));
		update_option('Walleto_new_item_email_not_approved_subject', 	trim($_POST['Walleto_new_item_email_not_approved_subject']));
		update_option('Walleto_new_item_email_not_approved_message', 	trim($_POST['Walleto_new_item_email_not_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_save33']))
	{
		update_option('Walleto_new_item_email_approved_enable', 	trim($_POST['Walleto_new_item_email_approved_enable']));
		update_option('Walleto_new_item_email_approved_subject', 	trim($_POST['Walleto_new_item_email_approved_subject']));
		update_option('Walleto_new_item_email_approved_message', 	trim($_POST['Walleto_new_item_email_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	 
 
	if(isset($_POST['Walleto_priv_mess_received_email_save']))
	{
		update_option('Walleto_priv_mess_received_email_enable', 	trim($_POST['Walleto_priv_mess_received_email_enable']));
		update_option('Walleto_priv_mess_received_email_subject', 	trim($_POST['Walleto_priv_mess_received_email_subject']));
		update_option('Walleto_priv_mess_received_email_message', 	trim($_POST['Walleto_priv_mess_received_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_completed_auction_bidder_email_save']))
	{
		update_option('Walleto_completed_auction_bidder_email_enable', 	trim($_POST['Walleto_completed_auction_bidder_email_enable']));
		update_option('Walleto_completed_auction_bidder_email_subject', 	trim($_POST['Walleto_completed_auction_bidder_email_subject']));
		update_option('Walleto_completed_auction_bidder_email_message', 	trim($_POST['Walleto_completed_auction_bidder_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_rated_user_email_save']))
	{
		update_option('Walleto_rated_user_email_enable', 	trim($_POST['Walleto_rated_user_email_enable']));
		update_option('Walleto_rated_user_email_subject', 	trim($_POST['Walleto_rated_user_email_subject']));
		update_option('Walleto_rated_user_email_message', 	trim($_POST['Walleto_rated_user_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_completed_auction_owner_email_save']))
	{
		update_option('Walleto_completed_auction_owner_email_enable', 		trim($_POST['Walleto_completed_auction_owner_email_enable']));
		update_option('Walleto_completed_auction_owner_email_subject', 	trim($_POST['Walleto_completed_auction_owner_email_subject']));
		update_option('Walleto_completed_auction_owner_email_message', 	trim($_POST['Walleto_completed_auction_owner_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_delivered_auction_owner_email_save']))
	{
		update_option('Walleto_delivered_auction_owner_email_enable', 		trim($_POST['Walleto_delivered_auction_owner_email_enable']));
		update_option('Walleto_delivered_auction_owner_email_subject', 	trim($_POST['Walleto_delivered_auction_owner_email_subject']));
		update_option('Walleto_delivered_auction_owner_email_message', 	trim($_POST['Walleto_delivered_auction_owner_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	
	if(isset($_POST['Walleto_delivered_auction_bidder_email_save']))
	{
		update_option('Walleto_delivered_auction_bidder_email_enable', 	trim($_POST['Walleto_delivered_auction_bidder_email_enable']));
		update_option('Walleto_delivered_auction_bidder_email_subject', 	trim($_POST['Walleto_delivered_auction_bidder_email_subject']));
		update_option('Walleto_delivered_auction_bidder_email_message', 	trim($_POST['Walleto_delivered_auction_bidder_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	 
 
 
	//-------------------
	
	$arr_me_to = array('buy_now_auction_buyer','buy_now_auction_seller','paid_auction_buyer','paid_auction_seller', 'ship_auction_buyer','ship_auction_seller','review_to_award',
	'review_received','offer_received','offer_accepted','offer_rejected', 'counter_offer_received','counter_offer_rejected','counter_offer_accepted','membership_expired');
	
	foreach ($arr_me_to as $amaz)
	{
		if(isset($_POST['Walleto_'.$amaz.'_email_save']))
		{
			update_option('Walleto_'.$amaz.'_email_enable', 	trim($_POST['Walleto_'.$amaz.'_email_enable']));
			update_option('Walleto_'.$amaz.'_email_subject', 	trim($_POST['Walleto_'.$amaz.'_email_subject']));
			update_option('Walleto_'.$amaz.'_email_message', 	trim($_POST['Walleto_'.$amaz.'_email_message']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
			break;
		}
	}
	

	
	
	do_action('Walleto_save_emails_post');
	
	?>
    
	<div id="usual2" class="usual"> 
        <ul> 
            <li><a href="#tabs1"><?php _e('Email Settings','Walleto'); ?></a></li> 
            <li><a href="#new_user_email"><?php _e('New User Email','Walleto'); ?></a></li>
            <li><a href="#admin_new_user_email"><?php _e('New User Email (admin)','Walleto'); ?></a></li>
            
            <li><a href="#post_auction_approved_admin"><?php _e('Post Item (Not Approved) Email (admin)','Walleto'); ?></a></li>
            <li><a href="#post_auction_not_approved_admin"><?php _e('Post Item (Auto Approved) Email (admin)','Walleto'); ?></a></li>
            <li><a href="#post_auction_approved"><?php _e('Post Item (Not Approved) Email','Walleto'); ?></a></li>
            <li><a href="#post_auction_not_approved"><?php _e('Post Item (Auto Approved) Email','Walleto'); ?></a></li>
            
            <!-- #### -->
            
            
            <li><a href="#priv_mess_received"><?php _e('Private Message Received','Walleto'); ?></a></li>
            <li><a href="#rated_user"><?php _e('Rated User','Walleto'); ?></a></li>
    
    
    		 
    		<li><a href="#won_item_winner"><?php _e('Won Item(winner)','Walleto'); ?></a></li>          
    		<li><a href="#won_item_loser"><?php _e('Won Item(losers)','Walleto'); ?></a></li> 
            
                   
         
            
            <li><a href="#buy_now_auction_buyer"><?php _e('Buy Item(Buyer)','Walleto'); ?></a></li>   
            <li><a href="#buy_now_auction_seller"><?php _e('Buy Item(Seller)','Walleto'); ?></a></li> 
            
            <li><a href="#membership_expired"><?php _e('Shop Membership Expired','Walleto'); ?></a></li>  
            
            <li><a href="#paid_auction_buyer"><?php _e('Paid Item(Buyer)','Walleto'); ?></a></li>   
            <li><a href="#paid_auction_seller"><?php _e('Paid Item(Seller)','Walleto'); ?></a></li> 
            
            
            <li><a href="#ship_auction_buyer"><?php _e('Shipped Item(Buyer)','Walleto'); ?></a></li>   
            <li><a href="#ship_auction_seller"><?php _e('Shipped Item(Seller)','Walleto'); ?></a></li> 
            
            
            <li><a href="#review_to_award"><?php _e('Review To Award','Walleto'); ?></a></li> 
            <li><a href="#review_received"><?php _e('Review Received','Walleto'); ?></a></li> 
            
            
            <!-- <li><a href="#offer_received"><?php _e('Offer Received','Walleto'); ?></a></li> 
            <li><a href="#offer_accepted"><?php _e('Offer Accepted','Walleto'); ?></a></li> 
            <li><a href="#offer_rejected"><?php _e('Offer Rejected','Walleto'); ?></a></li>   
            
            <li><a href="#counter_offer_received"><?php _e('Counter Offer Received','Walleto'); ?></a></li> 
             <li><a href="#counter_offer_accepted"><?php _e('Counter Offer Accepted','Walleto'); ?></a></li>  
            <li><a href="#counter_offer_rejected"><?php _e('Counter Offer Rejected','Walleto'); ?></a></li>   -->
          
              
    		
            <?php do_action('Walleto_save_emails_tabs'); ?>
            
        </ul> 
        
        <div id="buy_now_auction_buyer" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the buyer, after he buys an item (buy now auction). 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=buy_now_auction_buyer">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_buy_now_auction_buyer_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_buy_now_auction_buyer_email_subject" value="<?php echo stripslashes(get_option('Walleto_buy_now_auction_buyer_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_buy_now_auction_buyer_email_message"><?php echo stripslashes(get_option('Walleto_buy_now_auction_buyer_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##seller_user##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_buy_now_auction_buyer_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
         <div id="buy_now_auction_seller" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the seller, after a buyer buys an item (buy now auction). 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=buy_now_auction_seller">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_buy_now_auction_seller_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_buy_now_auction_seller_email_subject" value="<?php echo stripslashes(get_option('Walleto_buy_now_auction_seller_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_buy_now_auction_seller_email_message"><?php echo stripslashes(get_option('Walleto_buy_now_auction_seller_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##seller_user##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_buy_now_auction_seller_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
         <div id="paid_auction_buyer" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the buyer, after he has paid for the item. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=paid_auction_buyer">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_paid_auction_buyer_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_paid_auction_buyer_email_subject" value="<?php echo stripslashes(get_option('Walleto_paid_auction_buyer_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_paid_auction_buyer_email_message"><?php echo stripslashes(get_option('Walleto_paid_auction_buyer_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##seller_user##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_paid_auction_buyer_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
         <div id="paid_auction_seller" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the seller, after the buyer has paid for the item. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=paid_auction_seller">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_paid_auction_seller_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_paid_auction_seller_email_subject" value="<?php echo stripslashes(get_option('Walleto_paid_auction_seller_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_paid_auction_seller_email_message"><?php echo stripslashes(get_option('Walleto_paid_auction_seller_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##seller_user##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_paid_auction_seller_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
        
         <div id="ship_auction_buyer" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the buyer, after the seller marks the item as shipped. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=ship_auction_buyer">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_ship_auction_buyer_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_ship_auction_buyer_email_subject" value="<?php echo stripslashes(get_option('Walleto_ship_auction_buyer_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_ship_auction_buyer_email_message"><?php echo stripslashes(get_option('Walleto_ship_auction_buyer_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##seller_user##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_ship_auction_buyer_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
         <div id="ship_auction_seller" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the seller, after he marks the item as shipped. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=ship_auction_seller">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_ship_auction_seller_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_ship_auction_seller_email_subject" value="<?php echo stripslashes(get_option('Walleto_ship_auction_seller_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_ship_auction_seller_email_message"><?php echo stripslashes(get_option('Walleto_ship_auction_seller_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##seller_user##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##buyer_user##</strong> - <?php _e('Buyer Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_ship_auction_seller_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
         <div id="review_to_award" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by any user, to get notified for a review he needs to award for an item he bought or sold. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=review_to_award">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_review_to_award_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_review_to_award_email_subject" value="<?php echo stripslashes(get_option('Walleto_review_to_award_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_review_to_award_email_message"><?php echo stripslashes(get_option('Walleto_review_to_award_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##rated_user##</strong> - <?php _e('To be rated user\'s Username','Walleto'); ?><br/>
                    <strong>##awarding_user##</strong> - <?php _e('The user\'s username who will award the rating','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_review_to_award_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
        
        <div id="counter_offer_received" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the potential buyer when the seller submits a counter offer to the buyer`s offer. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=counter_offer_received">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_counter_offer_received_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_counter_offer_received_email_subject" value="<?php echo stripslashes(get_option('Walleto_counter_offer_received_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_counter_offer_received_email_message"><?php echo stripslashes(get_option('Walleto_counter_offer_received_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##buyer_username##</strong> - <?php _e('Potential Buyer(offer) Username','Walleto'); ?><br/>
                    <strong>##seller_username##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_counter_offer_received_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
          
        
        <div id="offer_received" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the seller when a user submits an offer. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=offer_received">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_offer_received_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_offer_received_email_subject" value="<?php echo stripslashes(get_option('Walleto_offer_received_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_offer_received_email_message"><?php echo stripslashes(get_option('Walleto_offer_received_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##buyer_username##</strong> - <?php _e('Potential Buyer(offer) Username','Walleto'); ?><br/>
                    <strong>##seller_username##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_offer_received_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
          
          
          
           <div id="counter_offer_accepted" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the buyer when the seller has accepted thier counter offer. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=counter_offer_accepted">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_counter_offer_accepted_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_counter_offer_accepted_email_subject" value="<?php echo stripslashes(get_option('Walleto_counter_offer_accepted_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_counter_offer_accepted_email_message"><?php echo stripslashes(get_option('Walleto_counter_offer_accepted_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('Potential Buyer(offer) Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_counter_offer_accepted_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <div id="offer_accepted" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the user when the seller has accepted the offer. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=offer_accepted">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_offer_accepted_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_offer_accepted_email_subject" value="<?php echo stripslashes(get_option('Walleto_offer_accepted_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_offer_accepted_email_message"><?php echo stripslashes(get_option('Walleto_offer_accepted_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                     <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('Potential Buyer(offer) Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_offer_accepted_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        
        <div id="counter_offer_rejected" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the seller when the buyer has rejected the counter offer. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=counter_offer_rejected">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_counter_offer_rejected_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_counter_offer_rejected_email_subject" value="<?php echo stripslashes(get_option('Walleto_counter_offer_rejected_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_counter_offer_rejected_email_message"><?php echo stripslashes(get_option('Walleto_counter_offer_rejected_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('Seller Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_counter_offer_rejected_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <div id="offer_rejected" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the user when the seller has rejected the offer. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=offer_rejected">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_offer_rejected_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_offer_rejected_email_subject" value="<?php echo stripslashes(get_option('Walleto_offer_rejected_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_offer_rejected_email_message"><?php echo stripslashes(get_option('Walleto_offer_rejected_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('Potential Buyer(offer) Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##offer_price##</strong> - <?php _e("the offered price",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_offer_rejected_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <div id="review_received" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by any users who is rated for an item that he bought or sold. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=review_received">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_review_received_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_review_received_email_subject" value="<?php echo stripslashes(get_option('Walleto_review_received_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_review_received_email_message"><?php echo stripslashes(get_option('Walleto_review_received_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##rated_user##</strong> - <?php _e('Just rated user\'s Username','Walleto'); ?><br/>
                    <strong>##awarding_user##</strong> - <?php _e('The user\'s username who awarded the rating','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_review_received_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ###################### -->
        
        <div id="delivered_auction_owner" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the owner of the item after he accepts the item as delivered. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=delivered_auction_owner">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_delivered_auction_owner_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_delivered_auction_owner_email_subject" value="<?php echo stripslashes(get_option('Walleto_delivered_auction_owner_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_delivered_auction_owner_email_message"><?php echo stripslashes(get_option('Walleto_delivered_auction_owner_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('auction Owner\'s Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_delivered_auction_owner_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!--################### -->
        
         <div id="delivered_auction_bidder" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the bidder/provider after the owner of the items accepts the item as delivered. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=delivered_auction_bidder">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_delivered_auction_bidder_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_delivered_auction_bidder_email_subject" value="<?php echo stripslashes(get_option('Walleto_delivered_auction_bidder_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_delivered_auction_bidder_email_message"><?php echo stripslashes(get_option('Walleto_delivered_auction_bidder_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('Bidder\'s Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_delivered_auction_bidder_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!-- ################################ -->
        <div id="completed_auction_owner" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the owner of the item when the provider marks the item as completed. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=completed_auction_owner">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_completed_auction_owner_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_completed_auction_owner_email_subject" value="<?php echo stripslashes(get_option('Walleto_completed_auction_owner_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_completed_auction_owner_email_message"><?php echo stripslashes(get_option('Walleto_completed_auction_owner_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('auction Owner\'s Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_completed_auction_owner_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ################################ -->
        <div id="completed_auction_bidder" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the provider/bidder when he marks the item as completed. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=completed_auction_bidder">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_completed_auction_bidder_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_completed_auction_bidder_email_subject" value="<?php echo stripslashes(get_option('Walleto_completed_auction_bidder_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_completed_auction_bidder_email_message"><?php echo stripslashes(get_option('Walleto_completed_auction_bidder_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   					<strong>##username##</strong> - <?php _e('Bidder\'s Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_completed_auction_bidder_email_save" 
                    value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ################################ -->
         <div id="priv_mess_received" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by any user when another user sends a private message. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=priv_mess_received">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_priv_mess_received_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_priv_mess_received_email_subject" value="<?php echo stripslashes(get_option('Walleto_priv_mess_received_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_priv_mess_received_email_message"><?php echo stripslashes(get_option('Walleto_priv_mess_received_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
   
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                    <strong>##sender_username##</strong> - <?php _e('sender username','Walleto'); ?><br/>
                    <strong>##receiver_username##</strong> - <?php _e('receiver username','Walleto'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_priv_mess_received_email_save" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ################################ -->
        <div id="rated_user" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the freshly rated user. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=rated_user">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_rated_user_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_rated_user_email_subject" value="<?php echo stripslashes(get_option('Walleto_rated_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_rated_user_email_message"><?php echo stripslashes(get_option('Walleto_rated_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('Winner Bidder\'s Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                    <strong>##rating##</strong> - <?php _e('rating value','Walleto'); ?><br/>
                    <strong>##comment##</strong> - <?php _e('rating comment','Walleto'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_rated_user_email_save" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
       
        
     
        
        
        <!-- ########## -->
        
          <div id="membership_expired" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the the shop owner when his membership is expired. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=membership_expired">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_membership_expired_email_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_membership_expired_email_subject" value="<?php echo stripslashes(get_option('Walleto_membership_expired_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_membership_expired_email_message"><?php echo stripslashes(get_option('Walleto_membership_expired_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('auction Owner\'s Username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                    <strong>##bidder_username##</strong> - <?php _e('the bidder username','Walleto'); ?><br/>
                    <strong>##bid_value##</strong> - <?php _e('the bid value','Walleto'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_membership_expired_email_save" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
       
        <!-- ################################ -->
        
        
        
        <div id="post_auction_not_approved" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is automatically approved. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=post_auction_not_approved">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_new_item_email_approved_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_new_item_email_approved_subject" value="<?php echo stripslashes(get_option('Walleto_new_item_email_approved_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_new_item_email_approved_message"><?php echo stripslashes(get_option('Walleto_new_item_email_approved_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save33" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ################################## -->
        
        <div id="post_auction_approved" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is not automatically approved. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=post_auction_approved">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_new_item_email_not_approved_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_new_item_email_not_approved_subject" value="<?php echo stripslashes(get_option('Walleto_new_item_email_not_approved_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_new_item_email_not_approved_message"><?php echo stripslashes(get_option('Walleto_new_item_email_not_approved_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('item owner username','Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save32" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ############################### -->
        
        
        <div id="post_auction_not_approved_admin" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website to be approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=post_auction_not_approved_admin">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_new_item_email_approve_admin_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_new_item_email_approve_admin_subject" value="<?php echo stripslashes(get_option('Walleto_new_item_email_approve_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_new_item_email_approve_admin_message"><?php echo stripslashes(get_option('Walleto_new_item_email_approve_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Walleto'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save31" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
    <!-- ######################### -->    
        
        
         <div id="post_auction_approved_admin" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website. This email will be received if the item is automatically approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=post_auction_approved_admin">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_new_item_email_not_approve_admin_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_new_item_email_not_approve_admin_subject" value="<?php echo stripslashes(get_option('Walleto_new_item_email_not_approve_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_new_item_email_not_approve_admin_message"><?php echo stripslashes(get_option('Walleto_new_item_email_not_approve_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Walleto'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Walleto'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new auction','Walleto'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save3" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <!--################################ -->
        
        <div id="tabs1" style="display: none; ">
        	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160">Email From Name:</td>
                    <td><input type="text" size="45" name="Walleto_email_name_from" value="<?php echo stripslashes(get_option('Walleto_email_name_from')); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td >Email From Address:</td>
                    <td><input type="text" size="45" name="Walleto_email_addr_from" value="<?php echo stripslashes(get_option('Walleto_email_addr_from')); ?>"/></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td >Allow HTML in emails:</td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_allow_html_emails'); ?></td>
                    </tr>
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save1" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
        </div> 
          
        <!-- ################################ -->  
                
        <div id="new_user_email" style="display: none; ">
        	<div class="spntxt_bo"><?php _e('This email will be received by all new users who register on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_new_user_email_subject" value="<?php echo stripslashes(get_option('Walleto_new_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_new_user_email_message"><?php echo stripslashes(get_option('Walleto_new_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e("your new username",'Walleto'); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email",'Walleto'); ?><br/>
                    <strong>##user_password##</strong> - <?php _e("your new user's password",'Walleto'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save2" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          
        </div> 
        
        <!-- ################################ -->  
                
        <div id="admin_new_user_email" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when a new user registers on the website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Walleto'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_email_set_&active_tab=tabs_new_user_email_admin">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Walleto'); ?></td>
                    <td><input type="text" size="90" name="Walleto_new_user_email_admin_subject" value="<?php echo stripslashes(get_option('Walleto_new_user_email_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Walleto_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Walleto'); ?></td>
                    <td><textarea cols="92" rows="10" name="Walleto_new_user_email_admin_message"><?php echo stripslashes(get_option('Walleto_new_user_email_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Walleto'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"Walleto"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","Walleto"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Walleto'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Walleto"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Walleto'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save_new_user_email_admin" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
    
    
    	<?php do_action('Walleto_save_emails_contents'); ?>
    
    </div> 
    
    
    <?php	
	
	echo '</div>';	
	
}

function Walleto_site_summary()
{
	
	global $menu_admin_product_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-summary"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto Site Summary</h2>';
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1">General Overview</a></li> 
   <!-- <li><a href="#tabs2">More Information</a></li> -->
   <?php do_action('Walleto_general_overview_tabs') ?>
  </ul> 
  <div id="tabs1" style="display: block; ">
    	<table width="100%" class="sitemile-table">
          <tr>
          <td width="200">Total number of products</td>
          <td><?php echo Walleto_get_total_nr_of_product(); ?></td>
          </tr>
          
          
          <tr>
          <td>Active Products</td>
          <td><?php echo Walleto_get_total_nr_of_open_product(); ?></td>
          </tr>
          
          <tr>
          <td>Inactive Products</td>
          <td><?php echo Walleto_get_total_nr_of_closed_product(); ?></td>
          </tr>
          
<!--          
          <tr>
          <td>Disputed & Not Finished</td>
          <td>12</td>
          </tr>
  -->        
          
          <tr>
          <td>Total Users</td>
          <td><?php
			$result = count_users();
			echo 'There are ', $result['total_users'], ' total users';
			foreach($result['avail_roles'] as $role => $count)
				echo ', ', $count, ' are ', $role, 's';
			echo '.';
			?></td>
          </tr>
          
          </table>
        
          </div> 
          
          <?php do_action('Walleto_general_overview_content') ?>
          
          
        </div> 
    
    
    <?php	
	
	echo '</div>';	
	
}


function Walleto_general_options()
{
	$id_icon 		= 'icon-options-general2';
	$ttl_of_stuff 	= 'Walleto - '.__('General Settings','Walleto');
	global $menu_admin_Walleto_theme_bull;
	$arr = array("yes" => __("Yes",'Walleto'), "no" => __("No",'Walleto'));
	$arr2 = array("html" => __("Plain HTML Uploaders",'Walleto'), "jquery" => __("Fancy jQuery Uploaders",'Walleto'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
		if(isset($_POST['Walleto_save1']))
		{
			update_option('Walleto_show_views', 				trim($_POST['Walleto_show_views']));
			update_option('Walleto_admin_approve_product', 		trim($_POST['Walleto_admin_approve_product']));

			update_option('Walleto_enable_blog', 				trim($_POST['Walleto_enable_blog']));
			
			update_option('Walleto_enable_pay_credits', 				trim($_POST['Walleto_enable_pay_credits']));
			update_option('Walleto_max_time_to_wait', 			trim($_POST['Walleto_max_time_to_wait']));			
			update_option('Walleto_product_time_listing',			 	trim($_POST['Walleto_product_time_listing']));
			update_option('Walleto_product_featured_time_listing', 		trim($_POST['Walleto_product_featured_time_listing']));
			update_option('Walleto_show_limit_job_cnt', 				trim($_POST['Walleto_show_limit_job_cnt']));
			update_option('Walleto_listings_per_page_adv_search', 				trim($_POST['Walleto_listings_per_page_adv_search']));
			
			update_option('Walleto_location_permalink', 				trim($_POST['Walleto_location_permalink']));
			update_option('Walleto_category_permalink', 				trim($_POST['Walleto_category_permalink']));
			update_option('Walleto_product_permalink', 				trim($_POST['Walleto_product_permalink']));
			update_option('Walleto_enable_locations', 					trim($_POST['Walleto_enable_locations']));
			update_option('Walleto_show_front_slider', 				trim($_POST['Walleto_show_front_slider']));
			update_option('Walleto_show_main_menu', 					trim($_POST['Walleto_show_main_menu']));
			update_option('Walleto_show_stretch', 						trim($_POST['Walleto_show_stretch']));
			update_option('Walleto_only_admins_post_products', 						trim($_POST['Walleto_only_admins_post_products']));
			
			update_option('Walleto_ext_time_last', 						trim($_POST['Walleto_ext_time_last']));
			update_option('Walleto_ext_time_by', 							trim($_POST['Walleto_ext_time_by']));
			update_option('Walleto_last_min_bid_ext', 						trim($_POST['Walleto_last_min_bid_ext']));
			
			update_option('Walleto_enable_reverse', 						trim($_POST['Walleto_enable_reverse']));
			update_option('Walleto_show_subcats_enbl', 						trim($_POST['Walleto_show_subcats_enbl']));
			update_option('Walleto_increase_bid_limit', 						trim($_POST['Walleto_increase_bid_limit']));
			update_option('Walleto_enable_increase_bid_limit', 						trim($_POST['Walleto_enable_increase_bid_limit']));
			update_option('Walleto_automatic_bid_enable', 						trim($_POST['Walleto_automatic_bid_enable']));
			update_option('Walleto_uploader_type', 						trim($_POST['Walleto_uploader_type']));
			update_option('Walleto_randomize_slider_front', 						trim($_POST['Walleto_randomize_slider_front']));
			update_option('Walleto_shop_subscriptions', 						trim($_POST['Walleto_shop_subscriptions']));
			
			
			do_action('Walleto_general_settings_save_post');
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		if(isset($_POST['Walleto_save2']))
		{
			update_option('Walleto_filter_emails_private_messages', 				trim($_POST['Walleto_filter_emails_private_messages']));
			update_option('Walleto_filter_urls_private_messages', 					trim($_POST['Walleto_filter_urls_private_messages']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		if(isset($_POST['Walleto_save3']))
		{
			update_option('Walleto_enable_shipping', 						trim($_POST['Walleto_enable_shipping']));
			update_option('Walleto_enable_flat_shipping', 					trim($_POST['Walleto_enable_flat_shipping']));
			update_option('Walleto_enable_location_based_shipping', 		trim($_POST['Walleto_enable_location_based_shipping']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		

		
		if(isset($_POST['Walleto_save4']))
		{
			update_option('Walleto_enable_facebook_login', 	trim($_POST['Walleto_enable_facebook_login']));
			update_option('Walleto_facebook_app_id', 			trim($_POST['Walleto_facebook_app_id']));
			update_option('Walleto_facebook_app_secret', 		trim($_POST['Walleto_facebook_app_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		
		if(isset($_POST['Walleto_save5']))
		{
			update_option('Walleto_enable_twitter_login', 			trim($_POST['Walleto_enable_twitter_login']));
			update_option('Walleto_twitter_consumer_key', 			trim($_POST['Walleto_twitter_consumer_key']));
			update_option('Walleto_twitter_consumer_secret', 		trim($_POST['Walleto_twitter_consumer_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		do_action('Walleto_general_options_actions');
	
	?>
    
		  <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Settings','Walleto'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Filters','Walleto'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Facebook Connect','Walleto'); ?></a></li>
            <li><a href="#tabs5"><?php _e('Twitter Connect','Walleto'); ?></a></li> 
          	<?php do_action('Walleto_general_options_tabs'); ?>
          </ul> 
          <div id="tabs1" >	
          
          			
            <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    	  <?php do_action('Walleto_general_settings'); ?> 
                          
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Image Uploaders:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr2, 'Walleto_uploader_type'); ?></td>
                    </tr>     
 
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Randomise frontpage slider:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_randomize_slider_front'); ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet('With this option you can enable or disable the subscriptions for shops.'); ?></td>
                    <td width="240"><?php _e('Enable shop subscriptions:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_shop_subscriptions'); ?></td>
                    </tr>
                    
 
                     <tr>
                    <td valign=top width="22">&nbsp;</td>
                    <td width="240">&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    
             
             
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Show Subcategories & Sublocations:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_show_subcats_enbl'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Show views in each product page:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_show_views'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Admin approves each product:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_admin_approve_product'); ?></td>
                    </tr>
                    
                    
					<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Frontpage Slider:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_show_front_slider'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Main Menu:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_show_main_menu'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Stretch Area:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_show_stretch'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Blog:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_blog'); ?></td>
                    </tr>
                    
 					
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Virtual Currency (credits):','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_pay_credits'); ?></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Locations:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_locations'); ?></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Only admin will post products:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_only_admins_post_products'); ?></td>
                    </tr>

 
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Featured product max job listing period:','Walleto'); ?></td>
                    <td><input type="text" size="6" name="Walleto_product_featured_time_listing" value="<?php echo get_option('Walleto_product_featured_time_listing'); ?>"/> days</td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Products per page in Advanced Search:','Walleto'); ?></td>
                    <td><input type="text" size="6" name="Walleto_listings_per_page_adv_search" value="<?php echo get_option('Walleto_listings_per_page_adv_search'); ?>"/></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for product Permalink:','Walleto'); ?></td>
                    <td><input type="text" size="30" name="Walleto_product_permalink" value="<?php echo get_option('Walleto_product_permalink'); ?>"/> *if left empty will show 'products'</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Location Permalink:','Walleto'); ?></td>
                    <td><input type="text" size="30" name="Walleto_location_permalink" value="<?php echo get_option('Walleto_location_permalink'); ?>"/> *if left empty will show 'location'</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Category Permalink:','Walleto'); ?></td>
                    <td><input type="text" size="30" name="Walleto_category_permalink" value="<?php echo get_option('Walleto_category_permalink'); ?>"/> *if left empty will show 'section'</td>
                    </tr>
                    
        
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save1" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                    
          
          </div>
          
          <div id="tabs2">	
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Filter Email Addresses (private messages):','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_filter_emails_private_messages'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Filter URLs (private messages):','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_filter_urls_private_messages'); ?></td>
                    </tr>
                   
  
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save2" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
         
          
          <div id="tabs4">	
          
          For facebook connect, install this plugin: <a href="http://wordpress.org/extend/plugins/wordpress-social-login/">WordPress Social Login</a>
          
          <!--	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Facebook Login:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_facebook_login'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook App ID:','Walleto'); ?></td>
                    <td><input type="text" size="35" name="Walleto_facebook_app_id" value="<?php echo get_option('Walleto_facebook_app_id'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook Secret Key:','Walleto'); ?></td>
                    <td><input type="text" size="35" name="Walleto_facebook_app_secret" value="<?php echo get_option('Walleto_facebook_app_secret'); ?>"/></td>
                    </tr>
  
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save4" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form> -->
          
          </div>
           
          <div id="tabs5">	
         <!-- 
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs5">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Twitter Login:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_twitter_login'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Key:','Walleto'); ?></td>
                    <td><input type="text" size="35" name="Walleto_twitter_consumer_key" value="<?php echo get_option('Walleto_twitter_consumer_key'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Secret:','Walleto'); ?></td>
                    <td><input type="text" size="35" name="Walleto_twitter_consumer_secret" value="<?php echo get_option('Walleto_twitter_consumer_secret'); ?>"/></td>
                    </tr>
  					
                    
                    
  						<tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Callback URL:','Walleto'); ?></td>
                    <td><?php echo get_bloginfo('template_url'); ?>/lib/social/twitter/callback.php</td>
                    </tr>
  
  
  
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save5" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form> -->
            
            For twitter connect, install this plugin: <a href="http://wordpress.org/extend/plugins/wordpress-social-login/">WordPress Social Login</a>
            
          </div>
    		
          <?php do_action('Walleto_general_options_div_content'); ?>  

<?php
	echo '</div>';	
	
}

function Walleto_orders_main_screen()
{
	
	global $menu_admin_product_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-orders"><br/></div>';	
	
	
	if(isset($_GET['orders']))
	{
		
			echo '<h2 class="my_title_class_sitemile">Walleto Orders - Content for Order #'.$_GET['orders'].'</h2>';
	?>
  	
    <div id="usual2" class="usual"> 
  	<ul> 
    <li><a href="#tabs1" class="selected">Orders #<?php echo $_GET['orders']; ?></a></li> 	
    </ul>
    <div id="tabs1" style="display: block; ">
    
    	 <table class="widefat post fixed">
				<thead> <tr>
					<th>Product Name</th>					
                    <th>Seller</th>
					<th>Item Cost</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    
				</tr>
				</thead> <tbody>
                <?php
				
				global $wpdb;
				$s = "select * from ".$wpdb->prefix."walleto_order_contents where orderid='".$_GET['orders']."'";
				$r = $wpdb->get_results($s, OBJECT);
				$total = 0;			
				
				foreach($r as $row):
				
					$post 	= get_post($row->pid);	
					$seller = get_userdata($row->uid);	
					$datemade 		= !empty($row->datemade) ? date_i18n('d-M-Y H:i:s', $row->datemade) : "";
					
					$total += $row->price *$row->quant;
					
				?>
                
                <tr>
					<th><a target="_blank" href="<?php echo get_permalink($row->pid) ?>"><?php echo $post->post_title ?></a></th>					
                    <th><?php echo $seller->user_login ?></th>
					<th><?php echo walleto_get_show_price($row->price) ?></th>
                    <th><?php echo $row->quant ?></th>
                    <th><?php echo walleto_get_show_price($row->price *$row->quant) ?></th>
					<th><?php echo $datemade ?></th>
                    
				</tr>
                
                
                <?php endforeach; ?>
                
                
                <tr>
					<th style="text-align:right; font-size:16px" colspan=4 align="right"><strong>Total:</strong></th>					
                    <th colspan=2 style="text-align:left; font-size:16px"><strong><?php echo walleto_get_show_price($total) ?></strong></th>
                    
				</tr>
                
                </tbody>
                </table>
	
    
    </div>
    </div>
        
    <?php		
	}
	else
	{	
	
		echo '<h2 class="my_title_class_sitemile">Walleto Orders</h2>';
		
		if(isset($_GET['purge_order']))
		{
			global $wpdb;
			$oid = $_GET['mark_paid'];
			
			$s1 = "delete from ".$wpdb->prefix."walleto_order_contents where orderid='$oid'";
			$s2 = "delete from ".$wpdb->prefix."walleto_orders where id='$oid'";	
			
			$wpdb->query($s1);	
			$wpdb->query($s2);	
			
			echo '<div class="saved_thing">Order was purged.</div>';	
		}
		
		if(isset($_GET['mark_paid']))
		{
			global $wpdb;
			$oid = $_GET['mark_paid'];
			$datemade = current_time('timestamp',0);
		
			$s = "select * from ".$wpdb->prefix."walleto_order_contents cnt where cnt.orderid='$oid' AND cnt.paid='0' ";
			$r = $wpdb->get_results($s);	
			
			foreach($r as $row)
			{
				$idso = $row->orderid;
				$wpdb->query("update ".$wpdb->prefix."walleto_order_contents  set paid='1', paid_on='$datemade' where id='$idso'");
			}
			
			$wpdb->query("update ".$wpdb->prefix."walleto_orders set paid='1', partially_paid='1', paid_on='$datemade'  where id='$oid'");
			 
			echo '<div class="saved_thing">Order marked paid.</div>';	
		}
		
		
		if(isset($_GET['mark_shipped']))
		{
			global $wpdb;
			$oid = $_GET['mark_shipped'];
			$datemade = current_time('timestamp',0);
		
			$s = "select * from ".$wpdb->prefix."walleto_order_contents cnt where cnt.orderid='$oid' ";
			$r = $wpdb->get_results($s);	
			
			foreach($r as $row)
			{
				$idso = $row->orderid;
				$wpdb->query("update ".$wpdb->prefix."walleto_order_contents  set shipped='1', shipped_on='$datemade' where id='$idso'");
			}
			
			$wpdb->query("update ".$wpdb->prefix."walleto_orders set shipped='1', partially_shipped='1', shipped_on='$datemade' where id='$oid'");
			 
			echo '<div class="saved_thing">Order marked shipped.</div>';	
		}
		
		
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">Not Paid Orders</a></li> 
    <li><a href="#tabs2">Paid & Not Shipped Orders</a></li>
    <li><a href="#tabs3">Paid & Shipped Orders</a></li>
    <!-- <li><a href="#tabs4">Failed &amp; Disputed Orders</a></li> -->
    <?php do_action('Walleto_main_menu_orders_tabs'); ?>
  </ul> 
  <div id="tabs1" style="display: block; ">
    	
		
        
          <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;				
				
					$page = $_GET['pj'];
					if(empty($page)) $page = 1;
					
					//---------------------------------
					
					
					
				 global $wpdb;	
				 $querystr2 = "SELECT count(orders.id) cnt FROM ".$wpdb->prefix."walleto_orders orders 
								WHERE orders.shipped='0' AND orders.paid='0' ";
				
				
				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);	
				$total_count = count($pageposts2);
				$my_page = $page;	
				$pages_curent = $page;
			//-----------------------------------------------------------------------		
				
				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;
			
					
				$querystr = 	"SELECT *, orders.id oids FROM ".$wpdb->prefix."walleto_orders orders 
								WHERE orders.shipped='0' AND orders.paid='0'					
								ORDER BY orders.id DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;	
					
			 
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
                     
                    <table class="widefat post fixed">
				<thead> <tr>
					<th>Order Title</th>
					
                    <th>Buyer</th>
					<th>Order Amount</th>
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Options</th>
				</tr>
				</thead> <tbody>
                     
                     
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php
					 	
				 
						 
					 	$buyer 			= get_userdata($post->uid);
					 	$totalprice 	= Walleto_get_show_price($post->totalprice);
						$datemade 		= !empty($post->datemade) ? date_i18n('d-M-Y H:i:s', $post->datemade) : "";
						$shp 			= Walleto_get_show_price($post->shipping);						
						$ttl 			= Walleto_get_show_price( $post->shipping + $post->totalprice);
						
					 ?>
                     
                    <tr>
					<th><a href="<?php echo get_admin_url() ?>admin.php?page=WL_orders_&orders=<?php echo $post->id; ?>" target="_blank">Order #<?php echo $post->id; ?></a></th>
					
                    <th><?php echo $buyer->user_login; ?></th>
					<th><?php echo $totalprice; ?></th>
                     
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $datemade; ?></th>
                    <th><a href="<?php echo get_admin_url() ?>admin.php?page=WL_orders_&mark_paid=<?php echo $post->id; ?>"><?php _e('Mark as Paid','Walleto'); ?></a> | 
                    <a href="<?php echo get_admin_url() ?>admin.php?page=WL_orders_&purge_order=<?php echo $post->id; ?>"><?php _e('Purge Order','Walleto'); ?></a></th>
				</tr>
				
				<?php endforeach; ?>
                    </tbody> 
                    </table> 
                    
                     
                     <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		{	
			echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj='.$previous_pg.'"><< '.__('Previous','Walleto').'</a>';
			echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' .$start_me.'"><<</a>';		
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $i.'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $end_me.'">>></a>';
		
		if($page < $totalPages)
		echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $next_pg.'">'.__('Next','Walleto').' >></a>';						
				
					 ?>
                     </div>
                     
                     
                     
                     
                     <?php else: ?>
                     
                     <?php _e('There are no items yet','Walleto'); ?>
                     
                     <?php endif; ?>

					
					
					<?php
					
					wp_reset_query();
					
					?>
                
        
        
	
	
	
	
        
          </div> 
        
        
        <div id="tabs2" style="display: none; ">
        
     
          <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;				
				
					$page = $_GET['pj'];
					if(empty($page)) $page = 1;
					
					//---------------------------------
					
					
					
				 global $wpdb;	
				 $querystr2 = "SELECT count(orders.id) cnt FROM ".$wpdb->prefix."walleto_orders orders 
								WHERE orders.shipped='0' AND orders.paid='1' ";
				
				
				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);	
				$total_count = count($pageposts2);
				$my_page = $page;	
				$pages_curent = $page;
			//-----------------------------------------------------------------------		
				
				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;
			
					
				$querystr = 	"SELECT * FROM ".$wpdb->prefix."walleto_orders orders 
								WHERE orders.shipped='0' AND orders.paid='1'					
								ORDER BY orders.id DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;	
					
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
                     
                   
                   <table class="widefat post fixed">
				<thead> <tr>
					<th>Order Title</th>
					
                    <th>Buyer</th>
					<th>Order Amount</th>
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Paid On</th>
                    <th>Options</th>
				</tr>
				</thead> <tbody>
                     
                     
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php
					 	
				 
						 
					 	$buyer 			= get_userdata($post->uid);
					 	$totalprice 	= Walleto_get_show_price($post->totalprice);
						$datemade 		= !empty($post->datemade) ? date_i18n('d-M-Y H:i:s', $post->datemade) : "";
						$datemade2 		= !empty($post->paid_on) ? date_i18n('d-M-Y H:i:s', $post->paid_on) : "";
						$shp 			= Walleto_get_show_price($post->shipping);						
						$ttl 			= Walleto_get_show_price( $post->shipping + $post->totalprice);
						
					 ?>
                     
                    <tr>
					<th><a href="<?php echo get_admin_url() ?>admin.php?page=WL_orders_&orders=<?php echo $post->id; ?>" target="_blank">Order #<?php echo $post->id; ?></a></th>
					
                    <th><?php echo $buyer->user_login; ?></th>
					<th><?php echo $totalprice; ?></th>
                     
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $datemade; ?></th>
                    <th><?php echo $datemade2; ?></th>
                    <th><a href="<?php echo get_admin_url() ?>admin.php?page=WL_orders_&mark_shipped=<?php echo $post->id; ?>"><?php _e('Mark as Shipped','Walleto'); ?></a></th>
				</tr>
				   
				   
				   <?php endforeach; ?>
                    </tbody> 
                    </table> 
                     
                     
                     <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		{	
			echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj='.$previous_pg.'"><< '.__('Previous','Walleto').'</a>';
			echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' .$start_me.'"><<</a>';		
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $i.'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $end_me.'">>></a>';
		
		if($page < $totalPages)
		echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $next_pg.'">'.__('Next','Walleto').' >></a>';						
				
					 ?>
                     </div>
                     
                     
                     
                     
                     <?php else: ?>
                     
                     <?php _e('There are no items yet','Walleto'); ?>
                     
                     <?php endif; ?>

					
					
					<?php
					
					wp_reset_query();
					
					?>
                
        
        
	
	
	
        
        </div> 
       
       
        
        
         <div id="tabs3" style="display: none; ">
         
       
          <?php

		
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					global $wp_query;
					$query_vars = $wp_query->query_vars;
					$nrpostsPage = 8;				
				
					$page = $_GET['pj'];
					if(empty($page)) $page = 1;
					
					//---------------------------------
					
					
					
				 global $wpdb;	
				 $querystr2 = "SELECT count(orders.id) cnt FROM ".$wpdb->prefix."walleto_orders orders 
								WHERE orders.shipped='1' AND orders.paid='1' ";
				
				
				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);	
				$total_count = count($pageposts2);
				$my_page = $page;	
				$pages_curent = $page;
			//-----------------------------------------------------------------------		
				
				$totalPages = ($total_count > 0 ? ceil($total_count / $nrpostsPage) : 0);
				$pagess = $totalPages;
			
					
				$querystr = 	"SELECT * FROM ".$wpdb->prefix."walleto_orders orders 
								WHERE orders.shipped='1' AND orders.paid='1'					
								ORDER BY orders.id DESC LIMIT ".($nrpostsPage * ($page - 1) ).",". $nrpostsPage ;	
					
				
				 $pageposts = $wpdb->get_results($querystr, OBJECT);
				 $posts_per = 7;
				 ?>
					
					 <?php $i = 0; if ($pageposts): ?>
                     
                   <table class="widefat post fixed">
				<thead> <tr>
					<th>Order Title</th>
					
                    <th>Buyer</th>
					<th>Order Amount</th>
                    <th>Shipping Cost</th>
                    <th>Total Cost</th>
					<th>Purchased On</th>
                    <th>Paid On</th>
                    <th>Shipped On</th>
                    <th>Options</th>
				</tr>
				</thead> <tbody>
                     
                     
					 <?php global $post; ?>
                     <?php foreach ($pageposts as $post): ?>
                     <?php setup_postdata($post); ?>
                     <?php
					 	
				 
						 
					 	$buyer 			= get_userdata($post->uid);
					 	$totalprice 	= Walleto_get_show_price($post->totalprice);
						$datemade 		= !empty($post->datemade) ? date_i18n('d-M-Y H:i:s', $post->datemade) : "";
						$datemade2 		= !empty($post->paid_on) ? date_i18n('d-M-Y H:i:s', $post->paid_on) : "";
						$datemade3 		= !empty($post->shipped_on) ? date_i18n('d-M-Y H:i:s', $post->shipped_on) : "";
						$shp 			= Walleto_get_show_price($post->shipping);						
						$ttl 			= Walleto_get_show_price( $post->shipping + $post->totalprice);
						
					 ?>
                     
                    <tr>
					<th><a href="<?php echo get_admin_url() ?>admin.php?page=WL_orders_&orders=<?php echo $post->id; ?>" target="_blank">Order #<?php echo $post->id; ?></a></th>
					
                    <th><?php echo $buyer->user_login; ?></th>
					<th><?php echo $totalprice; ?></th>
                     
                    <th><?php echo $shp; ?></th>
                    <th><?php echo $ttl; ?></th>
					<th><?php echo $datemade; ?></th>
                    <th><?php echo $datemade2; ?></th>
                    <th><?php echo $datemade3; ?></th>
                    <th>#</th>
				</tr>
				   
                   
				   
				   <?php endforeach; ?>
                    </tbody> 
                    </table> 
                     
                     
                     <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $nrpostsPage );
		$end = $batch * $nrpostsPage;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $nrpostsPage + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($my_page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $pages_curent + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($my_page > 1)
		{	
			echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj='.$previous_pg.'"><< '.__('Previous','Walleto').'</a>';
			echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' .$start_me.'"><<</a>';		
		}
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $pages_curent) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $i.'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $my_page)
		echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $end_me.'">>></a>';
		
		if($page < $totalPages)
		echo '<a href="'.get_admin_url().'admin.php?page=WL_orders_&pj=' . $next_pg.'">'.__('Next','Walleto').' >></a>';						
				
					 ?>
                     </div>
                     
                     
                     
                     
                     <?php else: ?>
                     
                     <?php _e('There are no items yet','Walleto'); ?>
                     
                     <?php endif; ?>

					
					
					<?php
					
					wp_reset_query();
					
					?>
                
        
        
         
         </div> </div> 
         

    	
        <?php } do_action('Walleto_main_menu_orders_content'); ?>
    
    <?php	
	
	echo '</div>';	
	
}


function Walleto_custom_fields()
{
	
global $menu_admin_item_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-custfields"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto Custom Fields</h2>';
	?>
    
    <script src="<?php echo get_bloginfo('template_url'); ?>/js/jquery.form.js"></script>

	<?php
	
	if(isset($_POST['add_new_field']))
	{
		$field_name = trim($_POST['field_name']);
		$field_type = $_POST['field_type'];
		$field_order = trim($_POST['field_order']);
		$field_category = $_POST['field_category'];
		
		if(empty($field_name)) echo '<div class="delete_thing">Field name cannot be empty!</div>';
		else
		{
			$ss = "insert into ".$wpdb->prefix."walleto_custom_fields (name,tp,ordr,cate) 
														values('$field_name','$field_type','$field_order','$field_category')";
			$wpdb->query($ss);
			
			//----------------------------
			
			$ss = "select id from ".$wpdb->prefix."walleto_custom_fields where name='$field_name' AND tp='$field_type'";
			$rows = $wpdb->get_results($ss);
			
			foreach($rows as $row)
			{
			
				$custid = $row->id;
				
				if($field_category != 'all')
				{
					
					for($i=0;$i<count($_POST['field_cats']);$i++)
						if(isset($_POST['field_cats'][$i]))
							{
								$field_category = $_POST['field_cats'][$i];
								$wpdb->query("insert into ".$wpdb->prefix."walleto_custom_relations (custid,catid) values('$custid','$field_category')");
								
							}
					if(empty($field_category)) $field_category = 'all';
				}
				else
					$field_category = 'all';
			}	
			//-------------------------------
			

			
			echo '<div class="saved_thing">Custom field added!</div>';
		}
	}
	
	
	$arr = array("yes" => "Yes", "no" => "No");
	
	if(isset($_GET['edit_field']))
	{
		$custid = $_GET['edit_field'];
		
			if(isset($_POST['save_new_field']))
				{
					$field_name 	= trim($_POST['field_name']);
					//$field_type 	= $_POST['field_type'];
					$field_order 	= trim($_POST['field_order']);
					$field_category = $_POST['field_category'];
					
					if(empty($field_name)) echo '<div class="delete_thing">Field name cannot be empty!</div>';
					else
					{
						$wpdb->query("delete from ".$wpdb->prefix."walleto_custom_relations where custid='$custid'"); 
						
						if($field_category != 'all')
						{
							
							for($i=0;$i<count($_POST['field_cats']);$i++)
								if(isset($_POST['field_cats'][$i]))
									{
										$field_category = $_POST['field_cats'][$i];
										$wpdb->query("insert into ".$wpdb->prefix."walleto_custom_relations (custid,catid) values('$custid','$field_category')");	
									}
							
							if(empty($field_category)) $field_category = 'all';
						}
						else
							$field_category = 'all';
							
						//-------------------------------
						
						$ss = "update ".$wpdb->prefix."walleto_custom_fields set name='$field_name',ordr='$field_order',cate='$field_category' where id='$custid'";
						$wpdb->query($ss);
						
						echo '<div class="saved_thing">Custom field saved!</div>';
					}
				}
		
		
		
		
		$s = "select * from ".$wpdb->prefix."walleto_custom_fields where id='$custid'";
		$row = $wpdb->get_results($s);
		
		$row = $row[0];
	}	
		


	if(isset($_GET['delete_field']))
	{
		$delid = $_GET['delete_field'];
		$s = "select name from ".$wpdb->prefix."walleto_custom_fields where id='$delid'";
		$row = $wpdb->get_results($s);
		$row = $row[0];
		
		if(isset($_GET['coo']))
		{
			$s = "delete from ".$wpdb->prefix."walleto_custom_fields where id='$delid'";
			$r = $wpdb->query($s);
			
			echo '<div class="delete_thing">Field "'.$row->name.'" has been deleted! </div>';
			
		}
		else
		{
			
			echo '<div class="delete_thing"><div class="padd10">Are you sure you want to delete "'.$row->name.'" ? &nbsp; 
			<a href="'.get_admin_url().'admin.php?page=custom-fields&delete_field='.$delid.'&coo=y">Yes</a> | 
			<a href="'.get_admin_url().'admin.php?page=custom-fields">No</a> </div></div>';
		}
		
	} ?>
    
        <div id="usual2" class="usual"> 
  <ul> 
				<?php if(isset($_GET['edit_field'])): ?>
				<li><a href="#tabs-0" class="selected">Edit custom field "<?php echo $row->name; ?>"</a></li>				
				<?php endif; ?>
				<li><a href="#tabs1">Add New Custom Field</a></li>
				<li><a href="#tabs-2">Current Custom Fields</a></li>
    
    
  </ul> 


<?php if(isset($_GET['edit_field'])): ?>
			<div id="tabs-0" style="display:block;padding:0">	
				
				
	<form method="post">
	<table class="sitemile-table" width="100%">
    
    <tr>
    <td width="170"> Field Name: </td>
    <td><input type="text" size="30" name="field_name" value="<?php echo $row->name; ?>" /></td>
    </td>
    
    <tr>
    <td> Field Type: </td>
    <td><?php echo Walleto_get_field_tp($row->tp); ?></td>
    </td>
    
    
    <tr>
    <td width="170"> Field Order: </td>
    <td><input type="text" size="5" name="field_order" value="<?php echo $row->ordr; ?>" /></td>
    </td>
    
    
    <tr>
    <td width="170"> Apply to category: </td>
    <td><input type="radio" name="field_category" value="all" <?php if($row->cate == 'all') echo 'checked="checked"'; ?>  /> Apply to all categories </td>
    </td>
    
    
        <tr>
    <td width="170"> </td>
    <td><input type="radio" name="field_category" value="sel" <?php if($row->cate != 'all') echo 'checked="checked"'; ?>  /> Apply to selected categories <br/>
            <div class="cat-class">
            <table width="100%">
            <?php
				
				
			 $categories =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category) 
				{
					
					if(Walleto_search_into($custid,$category->cat_ID) == 1) $chk = ' checked="checked" ';
						else $chk = "";
					echo '
					    <tr>
						<td><input '.$chk.' type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';
						
					$subcategories =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent='.$category->term_id);
						
					if($subcategories)	
					foreach ($subcategories as $subcategory) 
					{
						if(Walleto_search_into($custid,$subcategory->cat_ID) == 1) $chk = ' checked="checked" ';
						else $chk = "";
						
						echo '
					    <tr>
						<td>&nbsp; &nbsp; &nbsp; <input type="checkbox" '.$chk.' name="field_cats[]" value="'.$subcategory->cat_ID.'" />
						'.$subcategory->cat_name.'</td>
						</tr>';
						
									
									$subcategories2 =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent='.$subcategory->term_id);
						
									if($subcategories2)	
									foreach ($subcategories2 as $subcategory2) 
									{
										if(Walleto_search_into($custid,$subcategory2->cat_ID) == 1) $chk = ' checked="checked" ';
										else $chk = "";
										
										echo '
										<tr>
										<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" '.$chk.' name="field_cats[]" value="'.$subcategory2->cat_ID.'" />
										'.$subcategory2->cat_name.'</td>
										</tr>';
										
												$subcategories3 =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent='.$subcategory2->term_id);
						
												if($subcategories3)	
												foreach ($subcategories3 as $subcategory3) 
												{
													if(Walleto_search_into($custid,$subcategory3->cat_ID) == 1) $chk = ' checked="checked" ';
													else $chk = "";
													
													echo '
													<tr>
													<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" '.$chk.' name="field_cats[]" value="'.$subcategory3->cat_ID.'" />
													'.$subcategory3->cat_name.'</td>
													</tr>';
													
												}
										
										
									}
						
						
						
					}
				}	
				
				
			

						
			
			?>
            
            
        
            
            </table>
            </div>
    </td>
    </td>
    
     
    <tr>
    <td width="170">  </td>
    <td><input type="submit" name="save_new_field" value="Save this!" /> </td>
    </td>
    
    </table>
	</form>

	
		
        <?php
		
		if($row->tp != 1 && $row->tp != 5)
		{
			
			?>	
		<hr color="#CCCCCC" />
        <?php
			
			if(isset($_POST['_add_option']) && !empty($_POST['option_name']))
			{
				$option_name = $_POST['option_name'];
				$ss = "insert into ".$wpdb->prefix."walleto_custom_options (valval, custid) values('$option_name','$custid')";
				$wpdb->query($ss);
				
				echo '<div class="saved_thing"  id="add_options"><div class="padd10">Success! Your option was added!</div></div>';
				
				
			}
		
		
		?>
        
        
        <table  class="sitemile-table" width="100%"><tr><td>
        <strong>Add options:</strong>
        </td></tr>
        </table>
        
       	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=custom-fields&edit_field=<?php echo $custid; ?>#tabs-0"> 
        <table>
        <tr>
        <td>Option Name: </td>
        <td><input type="text" name="option_name" size="20" /> <input type="submit" name="_add_option" value="Add Option" /> </td>
        </tr>
		
        <?php echo Walleto_clear_table(2); ?>
        </table>
        </form>
        
        
        <table><tr><td>
        <strong>Current options:</strong>
        </td></tr>
        </table>
        <?php
		
		$ss = "select * from ".$wpdb->prefix."walleto_custom_options where custid='$custid' order by id desc";
		$rows2 = $wpdb->get_results($ss);
		
		if(count($rows2) == 0)
		echo "No options defined.";
		else
		{
			?>			
				<script>
					function delete_this(id)
							{
								 $.ajax({
												method: 'get',
												url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_delete_custom_id='+id,
												dataType : 'text',
												success: function (text) {  
												 $('#option_' + id).animate({'backgroundColor' : '#ff9900'},1000);
												 $('#option_'+id).remove();  }
											 });
								  
							
							}
				</script>
					
			<?php
			echo '<table  class="wp-list-table widefat fixed posts">';
			
				echo '<thead><tr>';
				echo '<th>Option Value</th>';
				echo '<th>Option Order</th>';
				echo '<th></th>';
				echo '</tr></thead>';
			
			
			
			
			foreach($rows2 as $row2)
			{
				echo '<script type="text/javascript"> 
						$(document).ready(function() { 
						   $(\'#myForm_'.$row2->id.'\').ajaxForm(function() { 
								 

								
								$(\'#option_'.$row2->id.'\').animate({\'backgroundColor\' : \'#ff9900\'});
								$(\'#option_'.$row2->id.'\').animate({\'backgroundColor\' : \'#cccccc\'});


							}); 
						}); 
					</script> ';
					
				
				echo '<form method="post" id="myForm_'.$row2->id.'" action="admin.php?ajax_ready=1" />';
				echo '<tr id="option_'.$row2->id.'" >';
				echo '<th><input type="hidden" size="20" name="option_id"  value="'.$row2->id.'" />
				<input type="text" size="20" name="option_name" id="custom_option_value_'.$row2->id.'" value="'.$row2->valval.'" />
				</th>';
				echo '<th><input type="text" size="4" name="option_order" id="custom_option_order_'.$row2->id.'" value="'.$row2->ordr.'" /></th>';
				echo '<th><input type="submit" name="submit" id="submit" value="Update" />
							<input onclick="delete_this('.$row2->id.')" type="button" name="DEL" value="Delete"  />
				</th>';
				echo '</tr></form>';
			}		
			
			echo '</table>';
		}
		
		}
		?>
				</table>
			</div>
			<?php endif; ?>	
			
			
			<div id="tabs1" style="display:block;padding:0">
	
	
    <form method="post">
	<table  class="sitemile-table" width="100%">

    <tr>
    <td width="170"> Field Name: </td>
    <td><input type="text" size="30" name="field_name" /></td>
    </td>
    
    <tr>
    <td> Field Type: </td>
    <td><select name="field_type">
    <option value="1">Text field</option>
    <option value="2">Select box</option>
    <option value="3">Radio Buttons</option>
    <option value="4">Check-box</option>
    <option value="5">Large text-area</option>
    </select></td>
    </td>
    
    
    <tr>
    <td width="170"> Field Order: </td>
    <td><input type="text" size="5" name="field_order" /></td>
    </td>
    
    
    <tr>
    <td width="170"> Apply to category: </td>
    <td><input type="radio" name="field_category" value="all" checked="checked" /> Apply to all categories </td>
    </td>
    
    
        <tr>
    <td width="170"> </td>
    <td><input type="radio" name="field_category" value="sel" /> Apply to selected categories <br/>
            <div class="cat-class">
            <table width="100%">
            <?php
			
			  $categories =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category) 
				{
				
					echo '
					    <tr>
						<td><input type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';
						
					$subcategories =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent='.$category->term_id);
						
					if($subcategories)	
					foreach ($subcategories as $subcategory) 
					{
						
						
						echo '
					    <tr>
						<td>&nbsp; &nbsp; &nbsp; <input type="checkbox" name="field_cats[]" value="'.$subcategory->cat_ID.'" />
						'.$subcategory->cat_name.'</td>
						</tr>';
						
									
									$subcategories2 =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent='.$subcategory->term_id);
						
									if($subcategories2)	
									foreach ($subcategories2 as $subcategory2) 
									{
									
										
										echo '
										<tr>
										<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox"  name="field_cats[]" value="'.$subcategory2->cat_ID.'" />
										'.$subcategory2->cat_name.'</td>
										</tr>';
										
												$subcategories3 =  get_categories('taxonomy=product_cat&hide_empty=0&orderby=name&parent='.$subcategory2->term_id);
						
												if($subcategories3)	
												foreach ($subcategories3 as $subcategory3) 
												{
													
													
													echo '
													<tr>
													<td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" name="field_cats[]" value="'.$subcategory3->cat_ID.'" />
													'.$subcategory3->cat_name.'</td>
													</tr>';
													
												}
										
										
									}
						
						
						
					}
				}	
				
						
			
			?>
            
            
        
            
            </table>
            </div>
    </td>
    </td>
    

     
        <tr>
    <td width="170">  </td>
    <td><input type="submit" name="add_new_field" value="Add this!" /> </td>
    </td>
    
    </table>
	</form>
		
		
		</div>
		
			<div id="tabs-2" style="display:block;">
				
				
				 <table width="100%">
      
    </table>
    <?php
	
	$ss2 = "select * from ".$wpdb->prefix."walleto_custom_fields order by name asc";
	$rf = $wpdb->get_results($ss2);
	
	if(count($rf) == 0)
		echo 'No fields yet added.';
	else
	{
		echo '<table class="wp-list-table widefat fixed posts">';
		
		
		echo '<thead><tr>';
		echo '<th><strong>Field Name</strong></th>';
		echo '<th><strong>Field Type</strong></th>';
		echo '<th><strong>Field Category</strong></th>';
		echo '<th><strong>Field Order</strong></th>';
		echo '<th><strong>Options</strong></th>';
		echo '</tr></thead><tbody>';
		
		foreach($rf as $row)
		{		
				$bgs = "efefef";
				if(isset($_GET['edit_field']))				
					if($_GET['edit_field'] == $row->id)
						$bgs = "B5CA73";
				
				
				
				echo '<tr>';
				echo '<th>'.$row->name.'</th>';
				echo '<th>'.Walleto_get_field_tp($row->tp).'</th>';
				echo '<th>'.($row->cate == 'all' ? "All Categories" : "Multiple Categories").'</th>';
				echo '<th>'.$row->ordr.'</th>';
				echo '<th>
				<a href="'.get_admin_url().'admin.php?page=custom-fields&edit_field='.$row->id.'#tabs-0" 
				><img src="'.get_bloginfo('template_url').'/images/edit.gif" border="0" alt="Edit" /></a>
				
				<a href="'.get_admin_url().'admin.php?page=custom-fields&delete_field='.$row->id.'"
				><img src="'.get_bloginfo('template_url').'/images/delete.gif" border="0" alt="Delete" /></a>
				
				</th>';
				echo '</tr>';
			
		}
		echo '</tbody></table>';
	}   
	?>
				
				
			</div>
			</div>
	<?php
    
   	
	echo '</div>';	
	
}


function Walleto_withdrawals()
{
	global $menu_admin_Walleto_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-withdr"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto Withdrawals</h2>';
	
	
	if(isset($_GET['tid']))
	{
		$tm = current_time('timestamp',0);
		$ids = $_GET['tid'];
		
		$s = "select * from ".$wpdb->prefix."walleto_withdraw where id='$ids'";
		$row = $wpdb->get_results($r);
		$row = $row[0];
		
		if($row->done == 0)
		{
			echo '<div class="saved_thing">Payment completed!</div>';
			$ss = "update ".$wpdb->prefix."walleto_withdraw set done='1', datedone='$tm' where id='$ids'";
			$wpdb->query($ss);// or die(mysql_error());
			
			
			$usr = get_userdata($row->uid);
			
			$site_name 		= get_bloginfo('name');
			$email		 	= get_bloginfo('admin_email');
			
			$subject = sprintf(__("Your withdrawal has been completed: %s",'Walleto'), Walleto_get_show_price($amount));
			$message = sprintf(__("Your withdrawal has been completed: %s",'Walleto'), Walleto_get_show_price($amount));
			
			//sitemile_send_email($usr->user_email, $subject , $message);
	
			
			$reason = sprintf(__('Withdraw to PayPal to email: %s','Walleto') ,$row->payeremail);
			Walleto_add_history_log('0', $reason, $row->amount, $row->uid);
		}
	}
	
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <ul> 
            <li><a href="#tabs1"><?php _e('Unresolved Requests','Walleto'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Resolved Requests','Walleto'); ?></a></li> 
            <li><a href="#tabs_rejected"><?php _e('Rejected Requests','Walleto'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Search Unresolved','Walleto'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Search Solved','Walleto'); ?></a></li> 
            <li><a href="#tabs_search_rejected"><?php _e('Search Rejected','Walleto'); ?></a></li> 
          </ul> 
  </ul> 
  <div id="tabs1">
          <?php
		  
		   $s = "select * from ".$wpdb->prefix."walleto_withdraw where done='0' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','Walleto'); ?></th>
            <th><?php _e('Method','Walleto'); ?></th>
            <th width="20%"><?php _e('Details','Walleto'); ?></th>
            <th><?php _e('Date Requested','Walleto'); ?></th>
            <th ><?php _e('Amount','Walleto'); ?></th>
            <th width="25%"><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.Walleto_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','Walleto').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','Walleto').'</a>' :( $row->done == 1 ? __("Completed",'Walleto') : __("Rejected",'Walleto') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no unresolved withdrawal requests.','Walleto'); ?>
            </div>
            
            <?php endif; ?>
          
          	
          </div>
          
          <div id="tabs2">	
          
          
          <?php
		  
		   $s = "select * from ".$wpdb->prefix."walleto_withdraw where done='1' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th ><?php 	_e('Username','Walleto'); ?></th>
            <th><?php 	_e('Method','Walleto'); ?></th>
            <th><?php 	_e('Details','Walleto'); ?></th>
            <th><?php 	_e('Date Requested','Walleto'); ?></th>
            <th ><?php 	_e('Amount','Walleto'); ?></th>
            <th><?php 	_e('Date Released','Walleto'); ?></th>
            <th><?php 	_e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
				echo '<th>'.$user->methods.'</th>';
                echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.Walleto_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->datedone == 0 ? "Not yet" : date('d-M-Y H:i:s',$row->datedone)) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','Walleto').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','Walleto').'</a>' :( $row->done == 1 ? __("Completed",'Walleto') : __("Rejected",'Walleto') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no resolved withdrawal requests.','Walleto'); ?>
            </div>
            
            <?php endif; ?>
          
          
          </div>
          
          <div id="tabs_rejected">	
          
          
          <?php
		  
		   $s = "select * from ".$wpdb->prefix."walleto_withdraw where rejected='1' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th ><?php _e('Username','Walleto'); ?></th>
            <th><?php _e('Method','Walleto'); ?></th>
            <th><?php _e('Details','Walleto'); ?></th>
            <th><?php _e('Date Requested','Walleto'); ?></th>
            <th ><?php _e('Amount','Walleto'); ?></th>
            <th><?php _e('Date Released','Walleto'); ?></th>
            <th><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.Walleto_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->datedone == 0 ? "Not yet" : date('d-M-Y H:i:s',$row->datedone)) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','Walleto').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','Walleto').'</a>' :( $row->done == 1 ? __("Completed",'Walleto') : __("Rejected",'Walleto') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no rejected withdrawal requests.','Walleto'); ?>
            </div>
            
            <?php endif; ?>
          
          
          </div>
          
          
          <div id="tabs3">
          
          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="Withdrawals" name="page" />
            <input type="hidden" value="tabs3" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','Walleto'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user']; ?>" name="search_user" size="20" /> <input type="submit" name="Walleto_save3" value="<?php _e('Search','Walleto'); ?>"/></td>
                </tr>
     
            
            </table>
            </form> 
            
            <?php
			
			if(isset($_GET['Walleto_save3'])):
				
				$search_user = trim($_GET['search_user']);
				
				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;
				
				$s = "select * from ".$wpdb->prefix."walleto_withdraw where done='0' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','Walleto'); ?></th>
            <th><?php _e('Method','Walleto'); ?></th>
            <th width="20%"><?php _e('Details','Walleto'); ?></th>
            <th><?php _e('Date Requested','Walleto'); ?></th>
            <th ><?php _e('Amount','Walleto'); ?></th>
            <th width="25%"><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.Walleto_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','Walleto').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','Walleto').'</a>' :( $row->done == 1 ? __("Completed",'Walleto') : __("Rejected",'Walleto') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no results for your search.','Walleto'); ?>
            </div>
            
            <?php endif; 
				
			
			endif;
			
			?>
            
          		
          </div> 
          
          <div id="tabs4">	
          
          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="Withdrawals" name="page" />
            <input type="hidden" value="tabs4" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','Walleto'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user4']; ?>" name="search_user4" size="20" /> <input type="submit" name="Walleto_save4" value="<?php _e('Search','Walleto'); ?>"/></td>
                </tr>
     
            
            </table>
            </form> 
          	
             
            <?php
			
			if(isset($_GET['Walleto_save4'])):
				
				$search_user = trim($_GET['search_user4']);
				
				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;
				
				$s = "select * from ".$wpdb->prefix."walleto_withdraw where done='1' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','Walleto'); ?></th>
            <th><?php _e('Method','Walleto'); ?></th>
            <th width="20%"><?php _e('Details','Walleto'); ?></th>
            <th><?php _e('Date Requested','Walleto'); ?></th>
            <th ><?php _e('Amount','Walleto'); ?></th>
            <th width="25%"><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.Walleto_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','Walleto').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','Walleto').'</a>' :( $row->done == 1 ? __("Completed",'Walleto') : __("Rejected",'Walleto') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no results for your search.','Walleto'); ?>
            </div>
            
            <?php endif; 
				
			
			endif;
			
			?>
            
            </div>
          
          
          <div id="tabs_search_rejected">	
          
          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="Withdrawals" name="page" />
            <input type="hidden" value="tabs_search_rejected" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','Walleto'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user5']; ?>" name="search_user5" size="20" /> <input type="submit" name="Walleto_save5" value="<?php _e('Search','Walleto'); ?>"/></td>
                </tr>
     
            

            </table>
            </form> 
          	
            
             <?php
			
			if(isset($_GET['Walleto_save5'])):
				
				$search_user = trim($_GET['search_user5']);
				
				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;
				
				$s = "select * from ".$wpdb->prefix."walleto_withdraw where rejected='1' AND uid='$uid' order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th width="12%" ><?php _e('Username','Walleto'); ?></th>
            <th><?php _e('Method','Walleto'); ?></th>
            <th width="20%"><?php _e('Details','Walleto'); ?></th>
            <th><?php _e('Date Requested','Walleto'); ?></th>
            <th ><?php _e('Amount','Walleto'); ?></th>
            <th width="25%"><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $user = get_userdata($row->uid);
                
                echo '<tr>';	
                echo '<th>'.$user->user_login.'</th>';
                echo '<th>'.$row->methods .'</th>';
				 echo '<th>'.$row->payeremail .'</th>';
                echo '<th>'.date('d-M-Y H:i:s',$row->datemade) .'</th>';
                echo '<th>'.Walleto_get_show_price($row->amount) .'</th>';
                echo '<th>'.($row->done == 0 ? '<a href="'.get_admin_url().'admin.php?page=Withdrawals&active_tab=tabs1&tid='.$row->id.'" class="awesome">'.
                __('Make Complete','Walleto').'</a>' . ' | ' . '<a href="'.get_admin_url().'admin.php?page=Withdrawals&den_id='.$row->id.'" class="awesome">'.
                __('Deny Request','Walleto').'</a>' :( $row->done == 1 ? __("Completed",'Walleto') : __("Rejected",'Walleto') ) ).'</th>';
                echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no results for your search.','Walleto'); ?>
            </div>
            
            <?php endif; 
				
			
			endif;
			
			?>
            
          </div> 
          
          
          

<?php
	echo '</div>';		
}


function Walleto_user_reviews()
{
	global $menu_admin_Walleto_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-rev"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto Reviews/Feedback</h2>';
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1"><?php _e('All User Reviews','Walleto'); ?></a></li> 
    <li><a href="#tabs2"><?php _e('Search User','Walleto'); ?></a></li> 
  </ul> 
 
 
  <div id="tabs1">	
          
          <?php
		  
		   $s = "select * from ".$wpdb->prefix."walleto_ratings where awarded>0 order by id desc";
           $r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Rated User','Walleto'); ?></th>
            <th><?php _e('product','Walleto'); ?></th>
            <th><?php _e('Rating','Walleto'); ?></th>
            <th><?php _e('Description','Walleto'); ?></th>
            <th><?php _e('Awarded On','Walleto'); ?></th>
            <th><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
   
            foreach($r as $row)
            {
	
				$post = get_post($row->pid);
				$userdata = get_userdata($row->touser);
				$pid = $row->pid;
				
				echo '<tr>';
				echo '<th>'.$userdata->user_login.'</th>';
				echo '<th><a href="'.get_permalink($pid).'">'.$post->post_title.'</a></th>';
				echo '<th>'.($row->grade/2).'</th>';
				echo '<th>'.$row->comment.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th>#</th>';
				echo '</tr>';
				
				
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no user feedback.','Walleto'); ?>
            </div>
            
            <?php endif; ?>
          
          </div>
          
          <div id="tabs2">
           
          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
            <input type="hidden" value="AT_user_rev_" name="page" />
            <input type="hidden" value="tabs2" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','Walleto'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user']; ?>" name="search_user" size="20" /> <input type="submit" name="Walleto_save2" value="<?php _e('Search','Walleto'); ?>"/></td>
                </tr>
     
            
            </table>
            </form> 
          	
            <?php
		  
		  	$user = trim($_GET['search_user']);
			$user = get_userdatabylogin($user);
		  	$uid = $user->ID;
		  
		   	$s = "select * from ".$wpdb->prefix."walleto_ratings where touser='$uid' and awarded>0 order by id desc";
			$r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Rated User','Walleto'); ?></th>
            <th><?php _e('product','Walleto'); ?></th>
            <th><?php _e('Rating','Walleto'); ?></th>
            <th><?php _e('Description','Walleto'); ?></th>
            <th><?php _e('Awarded On','Walleto'); ?></th>
            <th><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
           
            foreach($r as $row)
            {
                $post = get_post($row->pid);
				$userdata = get_userdata($row->touser);
				$pid = $row->pid;
				
				echo '<tr>';
				echo '<th>'.$userdata->user_login.'</th>';
				echo '<th><a href="'.get_permalink($pid).'">'.$post->post_title.'</a></th>';
				echo '<th>'.($row->grade / 2).'</th>';
				echo '<th>'.$row->comment.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th>#</th>';
				echo '</tr>';
				
				
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no user feedback.','Walleto'); ?>
            </div>
            
            <?php endif; ?>
            
            
          </div>
          
          <div id="tabs3">		
          </div>   
    
    
    <?php	
	
	echo '</div>';
}


function Walleto_user_balances()
{
	global $menu_admin_Walleto_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-bal"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto User Balances</h2>';
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">All Users</a></li> 
    <li><a href="#tabs2">Search User</a></li> 
  </ul> 
  <div id="tabs1" style="display: none; ">
    	
        
	<?php
	
	$rows_per_page = 10;
	
	if(isset($_GET['pj'])) $pageno = $_GET['pj'];
	else $pageno = 1;
	
	global $wpdb;

	$s1 = "select ID from ".$wpdb->users." order by user_login asc ";
	$s = "select * from ".$wpdb->users." order by user_login asc ";
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
	
	
	$r = $wpdb->get_results($s1); $nr = count($r);
	$lastpage      = ceil($nr/$rows_per_page);
	
	$r = $wpdb->get_results($s.$limit);

	if($nr > 0)	
	{
		
		?>
		
		
		        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="15%">Username</th>
    <th width="20%">Email</th>
    <th width="20%">Date Registered</th>
    <th width="13%" >Cash Balance</th>
	<th >Options</th>
    </tr>
    </thead>
    
    <script>
	
	 $(document).ready(function() {
  
  	$('.update_btn*').click(function() {
	
	var id = $(this).attr('alt');
	var increase_credits = $('#increase_credits' + id).val();
	var decrease_credits = $('#decrease_credits' + id).val();
	
	$.ajax({
   type: "POST",
   url: "<?php echo get_bloginfo('siteurl'); ?>/",
   data: "crds=1&uid="+id+"&increase_credits="+increase_credits+"&decrease_credits="+decrease_credits,
   success: function(msg){
     
	 
	$("#money" + id).html(msg);
	$('#increase_credits' + id).val("");
	$('#decrease_credits' + id).val(""); 
	 
   }
 });
	
	});
  
  
 });
	
	
	</script>
    
    <tbody>
		
		
		<?php 
		
		
	foreach($r as $row)
	{
		$user = get_userdata($row->ID);
		

		echo '<tr style="">';	
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->user_email .'</th>';
		echo '<th>'.$row->user_registered .'</th>';
		echo '<th class="'.$cl.'"><span id="money'.$row->ID.'">'.$sign. Walleto_get_show_price(Walleto_get_credits($row->ID)) .'</span></th>';
		echo '<th>'; 
		?>
		
        Increase Credits: <input type="text" size="4" id="increase_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo Walleto_currency(); ?><br/>
        Decrease Credits: <input type="text" size="4" id="decrease_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo Walleto_currency(); ?><br/>
        
        <input type="button" value="Update" class="update_btn" alt="<?php echo $row->ID; ?>" />
        
        
        <?php
		echo '</th>';
	
		echo '</tr>';
	}
	
	
	?>



	</tbody>
    
    </table>
    
    <?php 
    
	for($i=1;$i<=$lastpage;$i++)
		{
			if($pageno == $i) echo $i." | ";
			else			
			echo '<a href="'.get_admin_url().'admin.php?page=WL_user_bal_&pj='.$i.'"
			>'.$i.'</a> | ';	
			
		}
		
	}
    
    ?>
          </div> 
          <div id="tabs2" >
          <form method="get" action="<?php echo get_admin_url(); ?>admin.php">
          <input type="hidden" name="page" value="WL_user_bal_" />
          <input type="hidden" name="active_tab" value="tabs2" />
          Search User: <input type="text" size="35" value="<?php echo $_GET['src_usr']; ?>" name="src_usr" />
           <input type="submit" value="Submit" name="" />
          </form>
          
          <?php
		  if(!empty($_GET['src_usr'])):
		  
		  ?>
          
          <?php
	
	$rows_per_page = 10;
	
	if(isset($_GET['pj'])) $pageno = $_GET['pj'];
	else $pageno = 1;
	
	global $wpdb;
	$src_usr = $_GET['src_usr'];
	
	$s1 = "select ID from ".$wpdb->users." where user_login like '%$src_usr%' order by user_login asc ";
	$s = "select * from ".$wpdb->users." where user_login like '%$src_usr%' order by user_login asc ";
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;
	
	
	$r = $wpdb->get_results($s1); $nr = count($r);
	$lastpage      = ceil($nr/$rows_per_page);
	
	$r = $wpdb->get_results($s.$limit);

	if($nr > 0)	
	{
		
		?>
		
		
		        <table class="widefat post fixed" cellspacing="0">
    <thead>
    <tr>
    <th width="15%">Username</th>
    <th width="20%">Email</th>
    <th width="20%">Date Registered</th>
    <th width="13%" >Cash Balance</th>
	<th >Options</th>
    </tr>
    </thead>
    
    <script>
	
	 $(document).ready(function() {
 
  	$('.update_btn1*').click(function() {
	
	var id = $(this).attr('alt');
	var increase_credits = $('#increase_credits' + id).val();
	var decrease_credits = $('#decrease_credits' + id).val();
	
	$.ajax({
   type: "POST",
   url: "<?php echo get_bloginfo('siteurl'); ?>/",
   data: "crds=1&uid="+id+"&increase_credits="+increase_credits+"&decrease_credits="+decrease_credits,
   success: function(msg){
     
	  
	$("#money" + id).html(msg);
	$('#increase_credits' + id).val("");
	$('#decrease_credits' + id).val(""); 
	 
   }
 });
	
	});
  
  
 });
	
	
	</script>
    
    <tbody>
		
		
		<?php 
		
		
	foreach($r as $row)
	{
		$user = get_userdata($row->ID);
		

		echo '<tr style="">';	
		echo '<th>'.$user->user_login.'</th>';
		echo '<th>'.$row->user_email .'</th>';
		echo '<th>'.$row->user_registered .'</th>';
		echo '<th class="'.$cl.'"><span id="money'.$row->ID.'">'.$sign. Walleto_get_show_price(Walleto_get_credits($row->ID)) .'</span></th>';
		echo '<th>'; 
		?>
		
        Increase Credits: <input type="text" size="4" id="increase_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo Walleto_currency(); ?><br/>
        Decrease Credits: <input type="text" size="4" id="decrease_credits<?php echo $row->ID; ?>" rel="<?php echo $row->ID; ?>" /> <?php echo Walleto_currency(); ?><br/>
        
        <input type="button" value="Update" class="update_btn1" alt="<?php echo $row->ID; ?>" />
        
        
        <?php
		echo '</th>';
	
		echo '</tr>';
	}
	
	
	?>



	</tbody>
    
    </table>
    
    <?php 
    
	for($i=1;$i<=$lastpage;$i++)
		{
			if($pageno == $i) echo $i." | ";
			else			
			echo '<a href="'.get_admin_url().'admin.php?active_tab=tabs2&src_usr='.$_GET['src_usr'].'&page=WL_user_bal_&pj='.$i.'"
			>'.$i.'</a> | ';	
			
		}
		
	}
    
    ?>
          
          
          <?php endif; ?>
          
          </div> 
        </div> 
    
    
    <?php	
	
	echo '</div>';
}

function Walleto_payment_gateways()
{
	
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'Walleto - Payment Methods';
	global $menu_admin_Walleto_theme_bull;
	$arr = array("yes" => __("Yes",'Walleto'), "no" => __("No",'Walleto'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------
	
	do_action('Walleto_payment_methods_action');
	if(isset($_POST['Walleto_save1']))
	{
		update_option('Walleto_paypal_enable', 		trim($_POST['Walleto_paypal_enable']));
		update_option('Walleto_paypal_email', 			trim($_POST['Walleto_paypal_email']));
		update_option('Walleto_paypal_enable_sdbx', 	trim($_POST['Walleto_paypal_enable_sdbx']));
		
		update_option('Walleto_enable_paypal_ad', 		trim($_POST['Walleto_enable_paypal_ad']));
		update_option('product_theme_signature', 			trim($_POST['product_theme_signature']));
		update_option('product_theme_apipass', 				trim($_POST['product_theme_apipass']));
		update_option('product_theme_apiuser', 				trim($_POST['product_theme_apiuser']));
		update_option('product_theme_appid', 				trim($_POST['product_theme_appid']));
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_save2']))
	{
		update_option('Walleto_alertpay_enable', trim($_POST['Walleto_alertpay_enable']));
		update_option('Walleto_alertpay_email', trim($_POST['Walleto_alertpay_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_offline_payment_save']))
	{
		update_option('Walleto_offline_payments', trim($_POST['Walleto_offline_payments']));
		update_option('Walleto_offline_payment_dets', nl2br($_POST['Walleto_offline_payment_dets']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	
	
	if(isset($_POST['Walleto_save3']))
	{
		update_option('Walleto_moneybookers_enable', trim($_POST['Walleto_moneybookers_enable']));
		update_option('Walleto_moneybookers_email', trim($_POST['Walleto_moneybookers_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	if(isset($_POST['Walleto_save4']))
	{
		update_option('Walleto_ideal_enable', trim($_POST['Walleto_ideal_enable']));
		update_option('Walleto_ideal_email', trim($_POST['Walleto_ideal_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';		
	}
	
	?>


	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1">PayPal</a></li> 
            <li><a href="#tabs2" <?php if($_GET['active_tab'] == "tabs2") echo 'class="selected"'; ?>>Payza/AlertPay</a></li> 
            <li><a href="#tabs3" <?php if($_GET['active_tab'] == "tabs3") echo 'class="selected"'; ?>>Moneybookers/Skrill</a></li> 
            <li><a href="#tabs4" <?php if($_GET['active_tab'] == "tabs4") echo 'class="selected"'; ?>>iDeal</a></li> 
 
            
            
            
           
            <li><a href="#tabs_amazon">Amazon</a></li>
            <li><a href="#tabs_chronopay">Chronopay</a></li>
            <li><a href="#tabs_offline" <?php if($_GET['active_tab'] == "tabs_offline") echo 'class="selected"'; ?>><?php _e('Bank Payment(offline)','Walleto'); ?></a></li>
            <?php do_action('Walleto_payment_methods_tabs'); ?>
             
          </ul> 
          <div id="tabs1"  >	
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_pay_gate_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_paypal_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('PayPal Enable Sandbox:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_paypal_enable_sdbx'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('PayPal Email Address:','Walleto'); ?></td>
                    <td><input type="text" size="45" name="Walleto_paypal_email" value="<?php echo get_option('Walleto_paypal_email'); ?>"/></td>
                    </tr>
                    
                    
                     <tr><td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td><?php _e('Enable PayPal Adaptive:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_paypal_ad'); ?></td>
                    </tr>
            
            
                     <tr><td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Signature:','Walleto'); ?></td>
                    <td><input type="text" name="product_theme_signature" value="<?php echo get_option('product_theme_signature'); ?>" size="85" /> </td>
                    </tr>
                    
                           <tr><td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('API Password:','Walleto'); ?></td>
                    <td><input type="text" name="product_theme_apipass" value="<?php echo get_option('product_theme_apipass'); ?>" size="55" /> </td>
                    </tr>
                    
                           <tr><td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('API User:','Walleto'); ?></td>
                    <td><input type="text" name="product_theme_apiuser" value="<?php echo get_option('product_theme_apiuser'); ?>" size="55" /> </td>
                    </tr>
                    
                           <tr><td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Application ID:','Walleto'); ?></td>
                    <td><input type="text" name="product_theme_appid" value="<?php echo get_option('product_theme_appid'); ?>" size="55" /> </td>
                    </tr>
                  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save1" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs2" >	
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_pay_gate_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_alertpay_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Payza/Alertpay Email:','Walleto'); ?></td>
                    <td><input type="text" size="45" name="Walleto_alertpay_email" value="<?php echo get_option('Walleto_alertpay_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save2" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>

            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_pay_gate_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_moneybookers_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('MoneyBookers Email:','Walleto'); ?></td>
                    <td><input type="text" size="45" name="Walleto_moneybookers_email" value="<?php echo get_option('Walleto_moneybookers_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save3" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          		
          </div> 
          
          <div id="tabs4" >	
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_pay_gate_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_ideal_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('iDeal Partner ID:','Walleto'); ?></td>
                    <td><input type="text" size="45" name="Walleto_ideal_email" value="<?php echo get_option('Walleto_ideal_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save4" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          	
          </div>
          
			<?php do_action('Walleto_payment_methods_content_divs_m'); ?>
          
          <div id="tabs_amazon">	 Coming Soon	
          </div>
          
          <div id="tabs_chronopay">	 Coming Soon	
          </div>  
          
           <div id="tabs_offline" >	
           
             <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=WL_pay_gate_&active_tab=tabs_offline">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_offline_payments'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td valign="top" ><?php _e('Bank Details:','Walleto'); ?></td>
                    <td><textarea name="Walleto_offline_payment_dets" rows="5" cols="50" ><?php echo str_replace('<br />','',get_option('Walleto_offline_payment_dets')); ?></textarea></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_offline_payment_save" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
           	
          </div>  
          
          <?php do_action('Walleto_payment_methods_content_divs'); ?>

<?php
	echo '</div>';	
  	
	
}


function Walleto_images_settings()
{
	global $menu_admin_Walleto_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-img"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto Image Settings</h2>';
	
	$arr = array("yes" => "Yes", "no" => "No");
	
		if(isset($_POST['save1']))
		{
			$Walleto_enable_images_in_products = $_POST['Walleto_enable_images_in_products'];
			update_option('Walleto_enable_images_in_products', $Walleto_enable_images_in_products);
			
			$Walleto_charge_fees_for_images = $_POST['Walleto_charge_fees_for_images'];
			update_option('Walleto_charge_fees_for_images', $Walleto_charge_fees_for_images);
			
			$Walleto_enable_max_images_limit = $_POST['Walleto_enable_max_images_limit'];
			update_option('Walleto_enable_max_images_limit', $Walleto_enable_max_images_limit);
			
			//--------------------------------------
			
			update_option('Walleto_nr_of_free_images', trim($_POST['Walleto_nr_of_free_images']));
			update_option('Walleto_extra_image_charge', trim($_POST['Walleto_extra_image_charge']));
			update_option('Walleto_nr_max_of_images', trim($_POST['Walleto_nr_max_of_images']));
			
			
			
			echo '<div class="saved_thing">Settings saved!</div>';	
		}
		
		if(isset($_POST['save2']))
		{
			update_option('Walleto_width_of_product_images', trim($_POST['Walleto_width_of_product_images']));	
			
			echo '<div class="saved_thing">Settings saved!</div>';	
		}
	
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">General Settings</a></li> 
    <li><a href="#tabs2">Resize Settings</a></li> 
  </ul> 
  <div id="tabs1" style="display: block; ">
    	
        <form method="post">
        <table width="100%" class="sitemile-table">
        
        <tr>
        <td width="190">Enable Limit on max images:</td>
        <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_max_images_limit'); ?></td>
        </tr>
        
         <tr>
        <td>Max limit of images:</td>
        <td><input type="text" value="<?php echo get_option('Walleto_nr_max_of_images'); ?>" size="4" name="Walleto_nr_max_of_images" /></td>
        </tr>
        

        
        <tr>
        <td></td>
        <td><input type="submit" name="save1" value="Save Settings" /></td>
        </tr>
        
        </table>
        </form>
          </div> 
          <div id="tabs2" style="display: none; ">
           <form method="post">
                  <table width="100%" class="sitemile-table">
        
   
        
        <tr>
        <td>Default width of picture resize:</td>
        <td><input type="text" value="<?php echo get_option('Walleto_width_of_product_images'); ?>" size="4" name="Walleto_width_of_product_images" /> pixels</td>
        </tr>
        

        
        <tr>
        <td></td>
        <td><input type="submit" name="save2" value="Save Settings" /></td>
        </tr>
        
        </table>
        </form>  
          </div> 
        </div> 
    
    
    <?php	
	
	echo '</div>';
}

function Walleto_pricing_options()
{
	
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'Walleto - '.__('Pricing Settings','Walleto');
	$arr = array("yes" => __("Yes",'Walleto'), "no" => __("No",'Walleto'));
	$sep = array( "," => __('Comma (,)','Walleto'), "." => __("Point (.)",'Walleto'));
	$frn = array( "front" => __('In front of sum (eg: $50)','Walleto'), "back" => __("After the sum (eg: 50$)",'Walleto'));
	global $menu_admin_Walleto_theme_bull, $wpdb;
	
	$arr_currency = array("USD" => "US Dollars", "EUR" => "Euros", "CAD" => "Canadian Dollars", "CHF" => "Swiss Francs","GBP" => "British Pounds",
						  "AUD" => "Australian Dollars","NZD" => "New Zealand Dollars","BRL" => "Brazilian Real", 'PLN' => 'Polish zloty',
						  "SGD" => "Singapore Dollars","SEK" => "Swidish Kroner","NOK" => "Norwegian Kroner","DKK" => "Danish Kroner",
						  "MXN" => "Mexican Pesos","JPY" => "Japanese Yen","EUR" => "Euros", "ZAR" => "South Africa Rand", 'RUB' => 'Russian Ruble' , "TRY" => "Turkish Lyra",  "RON" => "Romanian Lei",
						  "HUF" => "Hungarian Forint", 'PHP' => 'Philippine peso' ,  'INR' => 'Indian Rupee' , 'LTL' => 'Lithuania Litas' , 'MYR' => 'Malaysian ringgit', 'HKD' => 'HongKong Dollars'
						  );
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	//-------------------
	
	if(isset($_POST['Walleto_save1']))
	{
		$Walleto_currency 						= trim($_POST['Walleto_currency']);
		$Walleto_currency_symbol 				= trim($_POST['Walleto_currency_symbol']);
		$Walleto_currency_position 			= trim($_POST['Walleto_currency_position']);
		$Walleto_decimal_sum_separator 		= trim($_POST['Walleto_decimal_sum_separator']);
		$Walleto_thousands_sum_separator 		= trim($_POST['Walleto_thousands_sum_separator']);

		update_option('Walleto_currency', 					$Walleto_currency);
		update_option('Walleto_currency_symbol', 			$Walleto_currency_symbol);
		update_option('Walleto_currency_position', 		$Walleto_currency_position);
		update_option('Walleto_decimal_sum_separator', 	$Walleto_decimal_sum_separator);
		update_option('Walleto_thousands_sum_separator', 	$Walleto_thousands_sum_separator);

	
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';	
	}
	
	if(isset($_POST['Walleto_save2']))
	{

		$Walleto_shop_monthly_fee 			= trim($_POST['Walleto_shop_monthly_fee']);
		$Walleto_shop_yearly_fee 		= trim($_POST['Walleto_shop_yearly_fee']);
		$Walleto_withdraw_limit					= trim($_POST['Walleto_withdraw_limit']);
		$Walleto_percent_fee_taken					= trim($_POST['Walleto_percent_fee_taken']);
		$Walleto_solid_fee_taken					= trim($_POST['Walleto_solid_fee_taken']);
		 
		$Walleto_enable_shop_trial = trim($_POST['Walleto_enable_shop_trial']);
		$Walleto_shop_trial_days	= trim($_POST['Walleto_shop_trial_days']);
		
		
		update_option('Walleto_shop_trial_days', 					$Walleto_shop_trial_days);
		update_option('Walleto_enable_shop_trial', 					$Walleto_enable_shop_trial);
		update_option('Walleto_shop_monthly_fee', 					$Walleto_shop_monthly_fee);
		 
		update_option('Walleto_solid_fee_taken', 							$Walleto_solid_fee_taken);
		update_option('Walleto_percent_fee_taken', 						$Walleto_percent_fee_taken);
		update_option('Walleto_withdraw_limit', 							$Walleto_withdraw_limit);
		update_option('Walleto_shop_yearly_fee', 				$Walleto_shop_yearly_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';	
	}
	
	
	if(isset($_POST['Walleto_save3']))
	{

		$Walleto_take_percent_fee 				= trim($_POST['Walleto_take_percent_fee']);
		$Walleto_take_flat_fee 		= trim($_POST['Walleto_take_flat_fee']);
		$product_theme_min_withdraw			= trim($_POST['product_theme_min_withdraw']);
	
		update_option('product_theme_min_withdraw', 			$product_theme_min_withdraw);
		update_option('Walleto_take_percent_fee', 			$Walleto_take_percent_fee);
		update_option('Walleto_take_flat_fee', 	$Walleto_take_flat_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';	
	}
	
	
	if(isset($_POST['Walleto_addnewcost']))
	{
		$cost = trim($_POST['newcost']);
		$ss = "insert into ".$wpdb->prefix."job_var_costs (cost) values('$cost')";
		$wpdb->query($ss);
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';	
	}


?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Details','Walleto'); ?></a></li> 
            <li><a href="#tabs2" <?php if($_GET['active_tab'] == "tabs2") echo 'class="selected"'; ?>><?php _e('Store Fees','Walleto'); ?></a></li> 
            <li><a href="#tabs3" <?php if($_GET['active_tab'] == "tabs3") echo 'class="selected"'; ?>><?php _e('Other Fees','Walleto'); ?></a></li> 

            
          </ul> 
          <div id="tabs1">	
          
          	 <form method="post" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_pr_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Site currency:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr_currency, 'Walleto_currency'); ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Currency symbol:','Walleto'); ?></td>
                    <td><input type="text" size="6" name="Walleto_currency_symbol" value="<?php echo get_option('Walleto_currency_symbol'); ?>"/> </td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Currency symbol position:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($frn, 'Walleto_currency_position'); ?></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Decimals sum separator:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($sep, 'Walleto_decimal_sum_separator'); ?></td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Thousands sum separator:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($sep, 'Walleto_thousands_sum_separator'); ?></td>
                    </tr>
      
                   
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save1" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          
          </div>
          
          <div id="tabs2" style="display: none; ">
          
          <form method="post" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_pr_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
					
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Enable Trial:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_shop_trial'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Trial Period:','Walleto'); ?></td>
                    <td><input type="text" size="5" name="Walleto_shop_trial_days" value="<?php echo get_option('Walleto_shop_trial_days'); ?>"/> 
					<?php echo _e('days','Walleto'); ?></td>
                    </tr>
                     
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Shop Monthly Fee:','Walleto'); ?></td>
                    <td><input type="text" size="15" name="Walleto_shop_monthly_fee" value="<?php echo get_option('Walleto_shop_monthly_fee'); ?>"/> <?php echo Walleto_get_currency(); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td ><?php _e('Shop Yearly Fee:','Walleto'); ?></td>
                    <td><input type="text" size="15" name="Walleto_shop_yearly_fee" value="<?php echo get_option('Walleto_shop_yearly_fee'); ?>"/> 
					<?php echo Walleto_get_currency(); ?></td>
                    </tr>
                    
          
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save2" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          </div>
          
          
          
           <div id="tabs3">
          
          <form method="post" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_pr_set_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				

                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Fee taken for each product when paid:','Walleto'); ?></td>
                    <td><input type="text" size="5" name="Walleto_take_percent_fee" value="<?php echo get_option('Walleto_take_percent_fee'); ?>"/>% or flat fee 
                    <input type="text" size="5" name="Walleto_take_flat_fee" value="<?php echo get_option('Walleto_take_flat_fee'); ?>"/> <?php echo Walleto_get_currency(); ?> 
					 </td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Withdraw Min Limit:','Walleto'); ?></td>
                    <td><input type="text" size="5" name="product_theme_min_withdraw" value="<?php echo get_option('product_theme_min_withdraw'); ?>"/> <?php echo Walleto_get_currency(); ?> 
					 </td>
                    </tr>
                    
                
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save3" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          </div>
          
    
       

<?php
	echo '</div>';		
		
}


function Walleto_tracking_tools_panel()
{
	$id_icon 		= 'icon-options-general-track';
	$ttl_of_stuff 	= 'Walleto - '.__('Tracking Tools','Walleto');
	$arr = array("yes" => __("Yes",'Walleto'), "no" => __("No",'Walleto'));
	global $menu_admin_Walleto_theme_bull;
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['Walleto_save1']))
		{
			update_option('Walleto_enable_google_analytics', 				trim($_POST['Walleto_enable_google_analytics']));
			update_option('Walleto_analytics_code', 						trim($_POST['Walleto_analytics_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
	if(isset($_POST['Walleto_save2']))
		{
			update_option('Walleto_enable_other_tracking', 				trim($_POST['Walleto_enable_other_tracking']));
			update_option('Walleto_other_tracking_code', 						trim($_POST['Walleto_other_tracking_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
			

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Google Analytics','Walleto'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Other Tracking Tools','Walleto'); ?></a></li> 
          </ul> 
          <div id="tabs1">
          
          		
                 <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Google Analytics:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_google_analytics'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Analytics Code:','Walleto'); ?></td>
                    <td><textarea rows="6" cols="80" name="Walleto_analytics_code"><?php echo stripslashes(get_option('Walleto_analytics_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save1" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          	
          </div>
          
          <div id="tabs2">	
          
             <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Other Tracking:','Walleto'); ?></td>
                    <td><?php echo Walleto_get_option_drop_down($arr, 'Walleto_enable_other_tracking'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Other Tracking Code:','Walleto'); ?></td>
                    <td><textarea rows="6" cols="80" name="Walleto_other_tracking_code"><?php echo stripslashes(get_option('Walleto_other_tracking_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save2" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          
          </div>
    

<?php
	echo '</div>';		
	
}


function Walleto_info()
{
	$id_icon 		= 'icon-options-general-info';
	$ttl_of_stuff 	= 'Walleto - '.__('Information','Walleto');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Main Information','Walleto'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('From SiteMile Blog','Walleto'); ?></a></li> 
  
          </ul> 
          <div id="tabs1" style="display: block; ">	
          
          <table width="100%" class="sitemile-table">
    				

                    <tr>                    
                    <td width="260"><?php _e('Walleto Version:','Walleto'); ?></td>
                    <td><?php echo WALLETOTHEME_VERSION; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Walleto Latest Release:','Walleto'); ?></td>
                    <td><?php echo WALLETOTHEME_RELEASE; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('WordPress Version:','Walleto'); ?></td>
                    <td><?php bloginfo('version'); ?></td>
                    </tr>
                    
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to SiteMile official page:','Walleto'); ?></td>
                    <td><a class="festin" href="http://sitemile.com">SiteMile - Premium WordPress Themes</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to Walleto\'s official page:','Walleto'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/products/walleto-wordpress-marketplace-theme/">SiteMile Walleto Theme</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to support forums:','Walleto'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/forums">SiteMile Support Forums</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Contact SiteMile Team:','Walleto'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/contact-us">Contact Form</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Like us on Facebook:','Walleto'); ?></td>
                    <td><a class="festin" href="http://facebook.com/sitemile">SiteMile Facebook Fan Page</a></td>
                    </tr>
                    
                    
                     <tr>                    
                    <td width="160"><?php _e('Follow us on Twitter:','Walleto'); ?></td>
                    <td><a class="festin" href="http://twitter.com/sitemile">SiteMile Twitter Page</a></td>
                    </tr>
                    
                    
                    
           </table>         
          
          </div>
          
          <div id="tabs2" style="display: none; overflow:hidden ">	
          
          <?php
		   echo '<div style="float:left;">';
 wp_widget_rss_output(array(
 'url' => 'http://sitemile.com/feed/',
 'title' => 'Latest news from SiteMile.com Blog',
 'items' => 10,
 'show_summary' => 1,
 'show_author' => 0,
 'show_date' => 1
 ));
 echo "</div>";
 
 ?>
          
          </div>
          
     

<?php
	echo '</div>';		
	
}


function Walleto_advertising_scr()
{
 
	$id_icon 		= 'icon-options-general-adve';
	$ttl_of_stuff 	= 'Walleto - '.__('Advertising Spaces','Walleto');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['Walleto_save1']))
	{
		update_option('Walleto_adv_code_home_above_content', 				trim($_POST['Walleto_adv_code_home_above_content']));
		update_option('Walleto_adv_code_home_below_content', 				trim($_POST['Walleto_adv_code_home_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
	}
	
	if(isset($_POST['Walleto_save2']))
	{
		update_option('Walleto_adv_code_product_page_above_content', 				trim($_POST['Walleto_adv_code_product_page_above_content']));
		update_option('Walleto_adv_code_product_page_below_content', 				trim($_POST['Walleto_adv_code_product_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
	}
	
	if(isset($_POST['Walleto_save3']))
	{
		update_option('Walleto_adv_code_cat_page_above_content', 				trim($_POST['Walleto_adv_code_cat_page_above_content']));
		update_option('Walleto_adv_code_cat_page_below_content', 				trim($_POST['Walleto_adv_code_cat_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
	}
	
	if(isset($_POST['Walleto_save4']))
	{
		update_option('Walleto_adv_code_single_page_above_content', 				trim($_POST['Walleto_adv_code_single_page_above_content']));
		update_option('Walleto_adv_code_single_page_below_content', 				trim($_POST['Walleto_adv_code_single_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
	}

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','Walleto'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Product Page','Walleto'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Category Page','Walleto'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Single Blog/Normal Page','Walleto'); ?></a></li> 
          </ul> 
          <div id="tabs1">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_adv_&active_tab=tabs1">
          	  <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_home_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_home_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_home_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_home_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save1" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>  
                    
              </table>      
          </form>
          
          </div>
          
          <div id="tabs2">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_adv_&active_tab=tabs2">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_product_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_product_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_product_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_product_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save2" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>  
                    
              </table>  
          </form>
          </div>
          
          <div id="tabs3">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_adv_&active_tab=tabs3">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_cat_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_cat_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_cat_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_cat_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save3" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div> 
          
          <div id="tabs4">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_adv_&active_tab=tabs4">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_single_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_single_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Walleto'); ?></td>
                <td><textarea name="Walleto_adv_code_single_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Walleto_adv_code_single_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save4" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div>  

<?php 
	echo '</div>';		
	
}



function Walleto_layout_settings()
{

	$id_icon 		= 'icon-options-general-layout';
	$ttl_of_stuff 	= 'Walleto - '.__('Layout Settings','Walleto');
	global $menu_admin_Walleto_theme_bull;
	
	//------------------------------------------------------
	
	$arr = array("yes" => __("Yes",'Walleto'), "no" => __("No",'Walleto'));
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

		if(isset($_POST['Walleto_save4']))
		{
			update_option('Walleto_color_for_top_links', 			trim($_POST['Walleto_color_for_top_links']));
			update_option('Walleto_color_for_bk', 					trim($_POST['Walleto_color_for_bk']));
			update_option('Walleto_color_for_footer', 				trim($_POST['Walleto_color_for_footer']));
			update_option('Walleto_color_for_top_links2', 				trim($_POST['Walleto_color_for_top_links2']));
			
			update_option('Walleto_color_for_main_links', 				trim($_POST['Walleto_color_for_main_links']));
			update_option('Walleto_color_for_main_links2', 			trim($_POST['Walleto_color_for_main_links2']));
			update_option('Walleto_color_for_text_footer', 			trim($_POST['Walleto_color_for_text_footer']));
			
			
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		if(isset($_POST['Walleto_save1']))
		{
			update_option('Walleto_home_page_layout', 				trim($_POST['Walleto_home_page_layout']));	
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		if(isset($_POST['Walleto_save2']))
		{
			update_option('Walleto_logo_URL', 				trim($_POST['Walleto_logo_URL']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		if(isset($_POST['Walleto_save3']))
		{
			update_option('Walleto_left_side_footer', 				stripslashes(trim($_POST['Walleto_left_side_footer'])));
			update_option('Walleto_right_side_footer', 			stripslashes(trim($_POST['Walleto_right_side_footer'])));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Walleto').'</div>';
		}
		
		
		//-----------------------------------------

	$Walleto_home_page_layout = get_option('Walleto_home_page_layout');
	if(empty($Walleto_home_page_layout)) $Walleto_home_page_layout = "1";
	
?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','Walleto'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Header','Walleto'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Footer','Walleto'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Change Colors','Walleto'); ?></a></li> 
          </ul>
           
          <div id="tabs4">
           <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_layout_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
            
                
        <tr>
        <td width="200"><?php _e('Color for background:','Walleto'); ?></td>
        <td><input type="text" id="colorpickerField1" name="Walleto_color_for_bk"  value="<?php echo get_option('Walleto_color_for_bk'); ?>"/>
				<script>
					$(document).ready(function() {
						
					$('#colorpickerField1, #colorpickerField2, #colorpickerField3, #colorpickerField5, #colorpickerField6, #colorpickerField7, #colorpickerField9').ColorPicker({
							onSubmit: function(hsb, hex, rgb, el) {
								$(el).val(hex);
								$(el).ColorPickerHide();
							},
							onBeforeShow: function () {
								$(this).ColorPickerSetColor(this.value);
							}
						})
						.bind('keyup', function(){
							$(this).ColorPickerSetColor(this.value);
						});
						
						});
					
				</script>

		</td>
        </tr>
        
        
        
        <tr>
        <td width="200"><?php _e('Color for footer:','Walleto'); ?></td>
        <td><input type="text" id="colorpickerField2" name="Walleto_color_for_footer" value="<?php echo get_option('Walleto_color_for_footer'); ?>" />
		</td>
        </tr>
        
        
         <tr>
        <td width="200"><?php _e('Color for text footer:','Walleto'); ?></td>
        <td><input type="text" id="colorpickerField9" name="Walleto_color_for_text_footer" value="<?php echo get_option('Walleto_color_for_text_footer'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for top links:','Walleto'); ?></td>
        <td><input type="text" id="colorpickerField3" name="Walleto_color_for_top_links" value="<?php echo get_option('Walleto_color_for_top_links'); ?>" />
		</td>
        </tr>
        
        <tr>
        <td width="200"><?php _e('Color for top links(hover):','Walleto'); ?></td>
        <td><input type="text" id="colorpickerField5" name="Walleto_color_for_top_links2" value="<?php echo get_option('Walleto_color_for_top_links2'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for main menu:','Walleto'); ?></td>
        <td><input type="text" id="colorpickerField6" name="Walleto_color_for_main_links" value="<?php echo get_option('Walleto_color_for_main_links'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for main menu(hover):','Walleto'); ?></td>
        <td><input type="text" id="colorpickerField7" name="Walleto_color_for_main_links2" value="<?php echo get_option('Walleto_color_for_main_links2'); ?>" />
		</td>
        </tr>
            
            
             <tr>
                  
                    <td ></td>
                    <td><input type="submit" name="Walleto_save4" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>    
                
            
            </table>
            
            </form>
          
          
          </div>
           
          <div id="tabs1">
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_layout_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
				<tr><td valign=top width="22"><?php Walleto_theme_bullet(__('The layout of the homepage.','Walleto')); ?></td>
					<td class="ttl"><strong><?php _e("Choose from the home page layouts available:","Walleto"); ?></strong> </td> <td></td></tr>
            
				<tr>
                <td valign=top width="22"></td>
					<td width="350"><?php _e("Content + Right Sidebar:","Walleto"); ?> </td>
					<td><input type="radio" name="Walleto_home_page_layout" value="1" <?php if($Walleto_home_page_layout == "1") echo 'checked="checked"'; ?> /> 
					 <img src="<?php bloginfo('template_url'); ?>/images/layout1.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Content + Left Sidebar + Right Sidebar:","Walleto"); ?> </td>
					<td><input type="radio" name="Walleto_home_page_layout" value="2" <?php if($Walleto_home_page_layout == "2") echo 'checked="checked"'; ?> /> 
					  <img src="<?php bloginfo('template_url'); ?>/images/layout2.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content + Right Sidebar:","Walleto"); ?> </td>
					<td><input type="radio" name="Walleto_home_page_layout" value="3" <?php if($Walleto_home_page_layout == "3") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout3.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content:","Walleto"); ?> </td>
					<td><input type="radio" name="Walleto_home_page_layout" value="4" <?php if($Walleto_home_page_layout == "4") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout4.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top></td>
					<td><?php _e("Content:","Walleto"); ?> </td>
					 <td><input type="radio" name="Walleto_home_page_layout" value="5" <?php if($Walleto_home_page_layout == "5") echo 'checked="checked"'; ?>/>  
					 <img src="<?php bloginfo('template_url'); ?>/images/layout5.jpg" /></td>
                </tr>
                
                
            
                        
                    <tr>
                   <td valign=top width="22"></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save1" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          	
          </div>
          
          <div id="tabs2">	
          
           <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_layout_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                  
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(__('Eg: http://your-site-url.com/images/logo.jpg','Walleto')); ?></td>
                    <td ><?php _e('Logo URL:','Walleto'); ?></td>
                    <td><input type="text" size="45" name="Walleto_logo_URL" value="<?php echo get_option('Walleto_logo_URL'); ?>"/></td>
                    </tr>
           
           
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save2" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">	
             <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=WL_layout_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                 
          <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(__('This will appear in the left side of the footer area.','Walleto')); ?></td>
                    <td valign="top" ><?php _e('Left side footer area content:','Walleto'); ?></td>
                    <td><textarea cols="65" rows="4" name="Walleto_left_side_footer"><?php echo stripslashes(get_option('Walleto_left_side_footer')); ?></textarea></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Walleto_theme_bullet(__('This will appear in the right side of the footer area.','Walleto')); ?></td>
                    <td valign="top" ><?php _e('Right side footer area content:','Walleto'); ?></td>
                    <td><textarea cols="65" rows="4" name="Walleto_right_side_footer"><?php echo stripslashes(get_option('Walleto_right_side_footer')); ?></textarea></td>
                    </tr>
          
          
             <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Walleto_save3" value="<?php _e('Save Options','Walleto'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
    

<?php
	echo '</div>';		
}


function Walleto_user_private_mess()
{
	global $menu_admin_product_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-mess"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Walleto Private Messages</h2>';
	?>
    
       <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('All Private Messages','Walleto'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Search User','Walleto'); ?></a></li> 

          </ul> 
          <div id="tabs1">	
          
          <?php
		  
		  	$nrpostsPage = 10; 
		  	$page = $_GET['pj']; if(empty($page)) $page = 1;
			$my_page = $page;
			
		   $s = "select * from ".$wpdb->prefix."walleto_pm order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
           $r = $wpdb->get_results($s);
		 	
		
		$s1 = "select id from ".$wpdb->prefix."walleto_pm order by id desc";	 	
		$r1 = $wpdb->get_results($s1);	
		
		
		if(count($r) > 0):
		
				$total_nr = count($r1);
				
				$nrposts = $total_nr;
				$totalPages = ceil($nrposts / $nrpostsPage);
				$pagess = $totalPages;
				$batch = 10; //ceil($page / $nrpostsPage );
				
				
				$start 		= floor($my_page/$batch) * $batch + 1; 
				$end		= $start + $batch - 1;
				$end_me 	= $end + 1;
				$start_me 	= $start - 1;
				
				if($end > $totalPages) $end = $totalPages;
				if($end_me > $totalPages) $end_me = $totalPages;
				
				if($start_me <= 0) $start_me = 1;
				
				$previous_pg = $my_page - 1;
				if($previous_pg <= 0) $previous_pg = 1;
				
				$next_pg = $my_page + 1;
				if($next_pg >= $totalPages) $next_pg = 1;
				
			
			
		  
		  ?>
          <script>
		  
		  $(document).ready(function() {
  
  		
		$(".show_mess_priv").click(function () {
			
			var rel = $(this).attr("rel");
			$("#priv_id_" + rel).toggle("slow");
			
		});
		
		
		
		$(".delete_mess_priv").click(function () {
			
			var rel = $(this).attr("rel");
			
			
				$.ajax({
				   type: "POST",
				   url: "<?php echo get_bloginfo('siteurl'); ?>/",
				   data: "remove_message=1&id="+rel ,
				   success: function(msg){
					 
					 $("#priv_id_" + rel).hide("slow");
					alert("Message Deleted");
					 
				   }
				 });
	
			
			
		});
  
  
});
		  
		  </script>
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Sender','Walleto'); ?></th>
            <th><?php _e('Receiver','Walleto'); ?></th>
            <th width="20%"><?php _e('Subject','Walleto'); ?></th>
            <th><?php _e('Sent On','Walleto'); ?></th>
            <th width="25%"><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            $ij = 0;
			
            foreach($r as $row)
            {
                $sender 	= get_userdata($row->initiator);
				$receiver 	= get_userdata($row->user);
                
				if($ij%2 == 0) $cls = "background_reed_me"; else $cls = '';
				
                echo '<tr class="'.$cls.'">';
				echo '<th>'.$sender->user_login.'</th>';
				echo '<th>'.$receiver->user_login.'</th>';
				echo '<th>'.$row->subject.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th><a href="#" class="show_mess_priv" rel="'.$row->id.'">Show Message</a> | <a href="#" class="delete_mess_priv" rel="'.$row->id.'">Delete Message</a></th>';
				echo '</tr>';
				
				
				echo '<tr id="priv_id_'.$row->id.'" class="'.$cls.' priv_mess_content_admin">';
				echo '<th colspan="5">Message Content: '.$row->content.'</th>';
				echo '</tr>';
				
				$ij++;
				
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php
			
			
			if($start > 1)
			echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=WL_user_mess_&pj='.$previous_pg.'"><< '.__('Previous','Walleto').'</a> ';
			echo ' <a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=WL_user_mess_&pj='.$start_me.'"><<</a> ';
			
			
	
			
			for($i = $start; $i <= $end; $i ++) {
				if ($i == $my_page) {
					echo ''.$i.' | ';
				} else {
		
					echo '<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=WL_user_mess_&pj='.$i.'">'.$i.'</a> | ';
					
				}
			}
	
	
			
			if($totalPages > $my_page)
			echo ' <a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=WL_user_mess_&pj='.$end_me.'">>></a> ';
			echo ' <a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=WL_user_mess_&pj='.$next_pg.'">'.__('Next','Walleto').' >></a> ';	
			
			
			?>
            
            
            
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no private messages.','Walleto'); ?>
            </div>
            
            <?php endif; ?>
          
          
          </div>
          
          <div id="tabs2">	
          
          
          
          <form method="get" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php">
            <input type="hidden" value="WL_user_mess_" name="page" />
            <input type="hidden" value="tabs2" name="active_tab" />
            <table width="100%" class="sitemile-table">
            	<tr>
                <td><?php _e('Search User','Walleto'); ?></td>
                <td><input type="text" value="<?php echo $_GET['search_user']; ?>" name="search_user" size="20" /> <input type="submit" name="Walleto_save2" value="<?php _e('Search','Walleto'); ?>"/></td>
                </tr>
     
            
            </table>
            </form> 
            
            <?php
			
			if(isset($_GET['Walleto_save2'])):
				
				$search_user = trim($_GET['search_user']);
				
				$user 	= get_userdatabylogin($search_user);
				$uid 	= $user->ID;  
				
				$s = "select * from ".$wpdb->prefix."walleto_pm where initiator='$uid' OR user='$uid' order by id desc";
          		$r = $wpdb->get_results($s);
		  	
			if(count($r) > 0):
		  
		  ?>
          
           <table class="widefat post fixed" cellspacing="0">
            <thead>
            <tr>
            <th><?php _e('Sender','Walleto'); ?></th>
            <th><?php _e('Receiver','Walleto'); ?></th>
            <th width="20%"><?php _e('Subject','Walleto'); ?></th>
            <th><?php _e('Sent On','Walleto'); ?></th>
            <th width="25%"><?php _e('Options','Walleto'); ?></th>
            </tr>
            </thead>
            
            
            
            <tbody>
            <?php
            
           
            
            foreach($r as $row)
            {
                $sender 	= get_userdata($row->initiator);
				$receiver 	= get_userdata($row->user);
                
                echo '<tr>';
				echo '<th>'.$sender->user_login.'</th>';
				echo '<th>'.$receiver->user_login.'</th>';
				echo '<th>'.$row->subject.'</th>';
				echo '<th>'.date('d-M-Y H:i:s', $row->datemade).'</th>';
				echo '<th>#</th>';
				echo '</tr>';
            }
            
            ?>
            </tbody>
            
            
            </table>
            <?php else: ?>
            
            <div class="padd101">
            <?php _e('There are no results for your search.','Walleto'); ?>
            </div>
            
            <?php endif; 
				
			
			endif;
			
			?>
          
          </div>
          
 
<?php
	echo '</div>';		
	
}


?>