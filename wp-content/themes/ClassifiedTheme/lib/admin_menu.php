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

function ClassifiedTheme_disp_spcl_cst_pic($pic)
{
	return '<img src="'.get_bloginfo('template_url').'/images/'.$pic.'" /> ';	
}

function ClassifiedTheme_admin_main_menu_scr()
{
	 $icn = get_bloginfo('template_url').'/images/adicon.gif';
	 $capability = 10;
	 
add_menu_page(__('Classified Theme'), __('Classified Theme','ClassifiedTheme'), $capability,"CT_menu_", 'ClassifiedTheme_site_summary', $icn, 0);
add_submenu_page("CT_menu_", __('Site Summary','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('overview_icon.png').__('Site Summary','ClassifiedTheme'),$capability, "CT_menu_", 'ClassifiedTheme_site_summary');
add_submenu_page("CT_menu_", __('General Options','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('setup_icon.png').__('General Options','ClassifiedTheme'),$capability, "general-options", 'ClassifiedTheme_general_options');
add_submenu_page("CT_menu_", __('Email Settings','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('email_icon.png').__('Email Settings','ClassifiedTheme'),$capability, 'CT_email_set_', 'ClassifiedTheme_email_settings');
add_submenu_page("CT_menu_", __('Pricing Settings','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('dollar_icon.png').__('Pricing Settings','ClassifiedTheme'),$capability, 'CT_pr_set_', 'ClassifiedTheme_pricing_options');
add_submenu_page("CT_menu_", __('Custom Pricing','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('penny_icon.png').__('Custom Pricing','ClassifiedTheme'),$capability, 'CT_cust_pricing_', 'ClassifiedTheme_cust_pricing');
add_submenu_page("CT_menu_", __('Custom Fields','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('input_icon.png').__('Custom Fields','ClassifiedTheme'),$capability, 'custom-fields', 'ClassifiedTheme_custom_fields');
add_submenu_page("CT_menu_", __('Images Options','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('image_icon.png').__('Images Options','ClassifiedTheme'),$capability, 'CT_img_sett_', 'ClassifiedTheme_images_settings');
add_submenu_page("CT_menu_", __('Payment Gateways','ClassifiedTheme'),ClassifiedTheme_disp_spcl_cst_pic('gateway_icon.png'). __('Payment Gateways','ClassifiedTheme'),$capability, 'CT_pay_gate_', 'ClassifiedTheme_payment_gateways');//add_submenu_page("CT_menu_", __('Membership Packs','ClassifiedTheme'), __('Membership Packs','ClassifiedTheme'),$capability, 'mem-packs', 'classifiedTheme_membership_packs');
//add_submenu_page("CT_menu_", __('Discount Coupons','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('cup_icon.png').__('Discount Coupons','ClassifiedTheme'),$capability, 'CT_discount_', 'ClassifiedTheme_discount_copuons');
//add_submenu_page("CT_menu_", __('Transactions','ClassifiedTheme'), __('Transactions','ClassifiedTheme'),$capability, 'paypal-trans', 'classifiedTheme_transactions');


//add_submenu_page("CT_menu_", __('InSite Transactions','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('list_icon.png').__('InSite Transactions','ClassifiedTheme'),$capability, 'trans-sites', 'ClassifiedTheme_hist_transact');
 

add_submenu_page("CT_menu_", __('Membership Packs','ClassifiedTheme'),ClassifiedTheme_disp_spcl_cst_pic('wallet_icon.png'). __('Membership Packs','ClassifiedTheme'),$capability, 'CT_mem_packs_', 'ClassifiedTheme_membership_paks');
 
 
add_submenu_page("CT_menu_", __('Layout Settings','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('layout_icon.png').__('Layout Settings','ClassifiedTheme'),$capability, 'CT_layout_', 'ClassifiedTheme_layout_settings');
add_submenu_page("CT_menu_", __('Advertising','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('adv_icon.png').__('Advertising','ClassifiedTheme'),$capability, 'CT_adv_', 'ClassifiedTheme_advertising_scr');
//add_submenu_page("CT_menu_", __('Import Tools','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('sheet_icon.png').__('Import Tools','ClassifiedTheme'),$capability, 'CT_import_tls_', 'ClassifiedTheme_import_tools_panel');
add_submenu_page("CT_menu_", __('Tracking Tools','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('track_icon.png').__('Tracking Tools','ClassifiedTheme'),$capability, 'CT_trck_', 'ClassifiedTheme_tracking_tools_panel');
add_submenu_page("CT_menu_", __('Info Stuff','ClassifiedTheme'), ClassifiedTheme_disp_spcl_cst_pic('info_icon.png').__('Info Stuff','ClassifiedTheme'),$capability, 'CT_info_stuff', 'ClassifiedTheme_info');
  
}

function ClassifiedTheme_cust_pricing()
{
	global $menu_admin_listing_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-custpricing"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">ClassifiedTheme Custom Pricing</h2>';
	
	$arr = array("yes" => "Yes", "no" => "No");
	         
	if(isset($_POST['my_submit']))
	{
		$classifiedTheme_enable_custom_posting 		= trim($_POST['classifiedTheme_enable_custom_posting']);
		update_option('classifiedTheme_enable_custom_posting', $classifiedTheme_enable_custom_posting);
			
		//---------------
		
		$customs = $_POST['customs'];
		for($i=0;$i<count($customs);$i++)
		{
			$ids = $customs[$i];
			$val =trim( $_POST['classifiedTheme_theme_custom_cat_'.$ids]);
			update_option('classifiedTheme_theme_custom_cat_'.$ids,$val);			
			
		}
		
		//---------------
		
		echo '<div class="saved_thing">Settings saved!</div>';
		
	}
	
	   if(isset($_POST['my_submit2']))
	{
		$classifiedTheme_enable_custom_bidding 		= $_POST['classifiedTheme_enable_custom_bidding'];
		update_option('classifiedTheme_enable_custom_bidding',$classifiedTheme_enable_custom_bidding);
			
		//---------------
		
		$customs = $_POST['customs'];
		for($i=0;$i<count($customs);$i++)
		{
			$ids = $customs[$i];
			$val = trim($_POST['classifiedTheme_theme_bidding_cat_'.$ids]);
			update_option('classifiedTheme_theme_bidding_cat_'.$ids,$val);			
			
		}
		
		//---------------
		
		echo '<div class="saved_thing">Settings saved!</div>';
		
	}
	
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">Custom Posting Fees</a></li> 
     
  </ul> 
  <div id="tabs1" style="display: block; ">
    	 <form method="post">
    	<table width="100%" class="sitemile-table">
        
        
        <tr>
        <td width="220" >Enable Custom Posting fees:</td>
        <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'classifiedTheme_enable_custom_posting'); ?></td>
        </tr>
        
                

        
        <?php echo ClassifiedTheme_listing_clear_table(2); ?>
        
         <tr>
        <td width="220" ><strong>Set Fees for each Category:</strong></td>
        <td></td>
        </tr>
        <?php echo ClassifiedTheme_listing_clear_table(2); ?>
        
        <?php
		  
		  $categories =  get_categories('taxonomy=ad_cat&hide_empty=0&orderby=name');
		  //$blg = get_option('listing_theme_blog_category');
			
		  foreach ($categories as $category) 
		  {
			if(1) //$category->cat_name != "Uncategorized" && $category->cat_ID != $blg )
			{
				echo '<tr>';
				echo '<td>'.$category->cat_name.'</td>';
				echo '<td><input type="text" size="6" value="'.get_option('classifiedTheme_theme_custom_cat_'.$category->cat_ID).'" 
				name="classifiedTheme_theme_custom_cat_'.$category->cat_ID.'" /> '.classifiedTheme_currency().'
				<input type="hidden" name="customs[]" value="'.$category->cat_ID.'" />
				</td>';
	
				echo '</tr>';
			}
		  
		  }
		
		?>
          <?php echo ClassifiedTheme_listing_clear_table(2); ?>
        
                <tr>
        <td ></td>
        <td><input type="submit" name="my_submit" value="Save these Settings!" /></td>
        </tr>
        
        </table>
    </form>
            
        
          </div> 
         
        </div> 
    
    
    <?php	
	
	echo '</div>';
}



function ClassifiedTheme_site_summary()
{
	
	global $menu_admin_listing_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-summary"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">ClassifiedTheme Site Summary</h2>';
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">General Overview</a></li> 
   <!-- <li><a href="#tabs2">More Information</a></li> -->
  </ul> 
  <div id="tabs1" style="display: block; ">
    	<table width="100%" class="sitemile-table">
          <tr>
          <td width="200">Total number of items</td>
          <td><?php echo ClassifiedTheme_get_total_nr_of_listings(); ?></td>
          </tr>
          
          
          <tr>
          <td>Open Listings</td>
          <td><?php echo ClassifiedTheme_get_total_nr_of_open_listings(); ?></td>
          </tr>
          
          <tr>
          <td>Closed Listings</td>
          <td><?php echo ClassifiedTheme_get_total_nr_of_closed_listings(); ?></td>
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
          <div id="tabs2" style="display: none; ">More content in tab 2.</div> 
        </div> 
    
    
    <?php	
	
	echo '</div>';	
	
}


function ClassifiedTheme_layout_settings()
{

	$id_icon 		= 'icon-options-general-layout';
	$ttl_of_stuff 	= 'ClassifiedTheme - '.__('Layout Settings','ClassifiedTheme');
	global $menu_admin_ClassifiedTheme_theme_bull;
	
	//------------------------------------------------------
	
	$arr = array("yes" => __("Yes",'ClassifiedTheme'), "no" => __("No",'ClassifiedTheme'));
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

		if(isset($_POST['ClassifiedTheme_save4']))
		{
			update_option('ClassifiedTheme_color_for_top_links', 			trim($_POST['ClassifiedTheme_color_for_top_links']));
			update_option('ClassifiedTheme_color_for_bk', 					trim($_POST['ClassifiedTheme_color_for_bk']));
			update_option('ClassifiedTheme_color_for_footer', 				trim($_POST['ClassifiedTheme_color_for_footer']));
			update_option('ClassifiedTheme_color_for_top_links2', 				trim($_POST['ClassifiedTheme_color_for_top_links2']));
			
			update_option('ClassifiedTheme_color_for_main_links', 				trim($_POST['ClassifiedTheme_color_for_main_links']));
			update_option('ClassifiedTheme_color_for_main_links2', 			trim($_POST['ClassifiedTheme_color_for_main_links2']));
			update_option('ClassifiedTheme_color_for_text_footer', 			trim($_POST['ClassifiedTheme_color_for_text_footer']));
			
			
			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		
		if(isset($_POST['ClassifiedTheme_save1']))
		{
			update_option('ClassifiedTheme_home_page_layout', 				trim($_POST['ClassifiedTheme_home_page_layout']));	
			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		
		if(isset($_POST['ClassifiedTheme_save2']))
		{
			update_option('ClassifiedTheme_logo_URL', 				trim($_POST['ClassifiedTheme_logo_URL']));
			update_option('ClassifiedTheme_custom_css', 				trim($_POST['ClassifiedTheme_custom_css']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		
		if(isset($_POST['ClassifiedTheme_save3']))
		{
			update_option('ClassifiedTheme_left_side_footer', 				stripslashes(trim($_POST['ClassifiedTheme_left_side_footer'])));
			update_option('ClassifiedTheme_right_side_footer', 			stripslashes(trim($_POST['ClassifiedTheme_right_side_footer'])));
			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		
		
		//-----------------------------------------

	$ClassifiedTheme_home_page_layout = get_option('ClassifiedTheme_home_page_layout');
	if(empty($ClassifiedTheme_home_page_layout)) $ClassifiedTheme_home_page_layout = "1";
	
?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Header','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Footer','ClassifiedTheme'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Change Colors','ClassifiedTheme'); ?></a></li> 
          </ul>
           
          <div id="tabs4">
           <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_layout_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
            
                
        <tr>
        <td width="200"><?php _e('Color for background:','ClassifiedTheme'); ?></td>
        <td><input type="text" id="colorpickerField1" name="ClassifiedTheme_color_for_bk"  value="<?php echo get_option('ClassifiedTheme_color_for_bk'); ?>"/>
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
        <td width="200"><?php _e('Color for footer:','ClassifiedTheme'); ?></td>
        <td><input type="text" id="colorpickerField2" name="ClassifiedTheme_color_for_footer" value="<?php echo get_option('ClassifiedTheme_color_for_footer'); ?>" />
		</td>
        </tr>
        
        
         <tr>
        <td width="200"><?php _e('Color for text footer:','ClassifiedTheme'); ?></td>
        <td><input type="text" id="colorpickerField9" name="ClassifiedTheme_color_for_text_footer" value="<?php echo get_option('ClassifiedTheme_color_for_text_footer'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for top links:','ClassifiedTheme'); ?></td>
        <td><input type="text" id="colorpickerField3" name="ClassifiedTheme_color_for_top_links" value="<?php echo get_option('ClassifiedTheme_color_for_top_links'); ?>" />
		</td>
        </tr>
        
        <tr>
        <td width="200"><?php _e('Color for top links(hover):','ClassifiedTheme'); ?></td>
        <td><input type="text" id="colorpickerField5" name="ClassifiedTheme_color_for_top_links2" value="<?php echo get_option('ClassifiedTheme_color_for_top_links2'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for main menu:','ClassifiedTheme'); ?></td>
        <td><input type="text" id="colorpickerField6" name="ClassifiedTheme_color_for_main_links" value="<?php echo get_option('ClassifiedTheme_color_for_main_links'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for main menu(hover):','ClassifiedTheme'); ?></td>
        <td><input type="text" id="colorpickerField7" name="ClassifiedTheme_color_for_main_links2" value="<?php echo get_option('ClassifiedTheme_color_for_main_links2'); ?>" />
		</td>
        </tr>
            
            
             <tr>
                  
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save4" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>    
                
            
            </table>
            
            </form>
          
          
          </div>
           
          <div id="tabs1">
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_layout_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
				<tr><td valign=top width="22"><?php ClassifiedTheme_theme_bullet(__('The layout of the homepage.','ClassifiedTheme')); ?></td>
					<td class="ttl"><strong><?php _e("Choose from the home page layouts available:","ClassifiedTheme"); ?></strong> </td> <td></td></tr>
            
				<tr>
                <td valign=top width="22"></td>
					<td width="350"><?php _e("Content + Right Sidebar:","ClassifiedTheme"); ?> </td>
					<td><input type="radio" name="ClassifiedTheme_home_page_layout" value="1" <?php if($ClassifiedTheme_home_page_layout == "1") echo 'checked="checked"'; ?> /> 
					 <img src="<?php bloginfo('template_url'); ?>/images/layout1.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Content + Left Sidebar + Right Sidebar:","ClassifiedTheme"); ?> </td>
					<td><input type="radio" name="ClassifiedTheme_home_page_layout" value="2" <?php if($ClassifiedTheme_home_page_layout == "2") echo 'checked="checked"'; ?> /> 
					  <img src="<?php bloginfo('template_url'); ?>/images/layout2.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content + Right Sidebar:","ClassifiedTheme"); ?> </td>
					<td><input type="radio" name="ClassifiedTheme_home_page_layout" value="3" <?php if($ClassifiedTheme_home_page_layout == "3") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout3.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content:","ClassifiedTheme"); ?> </td>
					<td><input type="radio" name="ClassifiedTheme_home_page_layout" value="4" <?php if($ClassifiedTheme_home_page_layout == "4") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout4.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top></td>
					<td><?php _e("Content:","ClassifiedTheme"); ?> </td>
					 <td><input type="radio" name="ClassifiedTheme_home_page_layout" value="5" <?php if($ClassifiedTheme_home_page_layout == "5") echo 'checked="checked"'; ?>/>  
					 <img src="<?php bloginfo('template_url'); ?>/images/layout5.jpg" /></td>
                </tr>
                
                
            
                        
                    <tr>
                   <td valign=top width="22"></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save1" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          	
          </div>
          
          <div id="tabs2">	
          
           <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_layout_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                  
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(__('Eg: http://your-site-url.com/images/logo.jpg','ClassifiedTheme')); ?></td>
                    <td ><?php _e('Logo URL:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="45" name="ClassifiedTheme_logo_URL" value="<?php echo get_option('ClassifiedTheme_logo_URL'); ?>"/></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(__('Write custom css code here, to affect entire website.','ClassifiedTheme')); ?></td>
                    <td ><?php _e('Custom CSS:','ClassifiedTheme'); ?></td>
                    <td><textarea rows="5" cols="45" name="ClassifiedTheme_custom_css"><?php echo get_option('ClassifiedTheme_custom_css'); ?></textarea></td>
                    </tr>
           
           
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save2" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">	
             <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_layout_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                 
          <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(__('This will appear in the left side of the footer area.','ClassifiedTheme')); ?></td>
                    <td valign="top" ><?php _e('Left side footer area content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="65" rows="4" name="ClassifiedTheme_left_side_footer"><?php echo stripslashes(get_option('ClassifiedTheme_left_side_footer')); ?></textarea></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(__('This will appear in the right side of the footer area.','ClassifiedTheme')); ?></td>
                    <td valign="top" ><?php _e('Right side footer area content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="65" rows="4" name="ClassifiedTheme_right_side_footer"><?php echo stripslashes(get_option('ClassifiedTheme_right_side_footer')); ?></textarea></td>
                    </tr>
          
          
             <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save3" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
    

<?php
	echo '</div>';		
}


function ClassifiedTheme_hist_transact()
{
	global $menu_admin_listing_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-list"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">ClassifiedTheme Transaction History</h2>';
	
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
	$s = "select * from ".$wpdb->prefix."ad_transactions_new order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
	$r = $wpdb->get_results($s);
	
	$s1 = "select id from ".$wpdb->prefix."ad_transactions_new order by id desc";	 	
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
	<th >Listing</th>
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
		echo '<th class="'.$cl.'">'.$sign.ClassifiedTheme_get_show_price($row->amount,2).'</th>';
		echo '<th>#</th>';
	
		echo '</tr>';
	}
	
	?>



	</tbody>
    
    
    </table>
    
    <?php
			
			
			if($start > 1)
			echo '<a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$previous_pg.'"><< '.__('Previous','ClassifiedTheme').'</a> ';
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
			echo ' <a href="'.get_admin_url().'admin.php?page=trans-sites&pj='.$next_pg.'">'.__('Next','ClassifiedTheme').' >></a> ';	
			
			
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
	$s = "select * from ".$wpdb->prefix."ad_transactions_new where uid='".$usrdt->ID."' order by id desc limit ".($nrpostsPage * ($page - 1) )." ,$nrpostsPage";
	$r = $wpdb->get_results($s);
	
	$s1 = "select id from ".$wpdb->prefix."ad_transactions_new where uid='".$usrdt->ID."' order by id desc";	 	
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
	<th >Listing</th>
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
		echo '<th class="'.$cl.'">'.$sign.ClassifiedTheme_get_show_price($row->amount,2).'</th>';
		echo '<th>#</th>';
	
		echo '</tr>';
	}
	
	?>



	</tbody>
    
    
    </table>
    
    <?php
			
			
			if($start > 1)
			echo '<a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$previous_pg.'"><< '.__('Previous','ClassifiedTheme').'</a> ';
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
			echo ' <a href="'.get_admin_url().'admin.php?src_usr='.$_GET['src_usr'].'&page=trans-sites&pj='.$next_pg.'">'.__('Next','ClassifiedTheme').' >></a> ';	
			
			
			?>
    
    
    <?php else: ?> <?php _e('Sorry there are no transactions.','ClassifiedTheme'); ?>
    
    <?php endif; endif; ?>
          
          </div> 
        </div> 
    
    
    <?php	
	
	echo '</div>';
}


function ClassifiedTheme_general_options()
{
	$id_icon 		= 'icon-options-general2';
	$ttl_of_stuff 	= 'ClassifiedTheme - '.__('General Settings','ClassifiedTheme');
	global $menu_admin_ClassifiedTheme_theme_bull;
	$arr = array("yes" => __("Yes",'ClassifiedTheme'), "no" => __("No",'ClassifiedTheme'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
		if(isset($_POST['ClassifiedTheme_save1']))
		{
			update_option('ClassifiedTheme_show_views', 				trim($_POST['ClassifiedTheme_show_views']));
			update_option('ClassifiedTheme_admin_approve_listing', 		trim($_POST['ClassifiedTheme_admin_approve_listing']));

			update_option('ClassifiedTheme_enable_blog', 				trim($_POST['ClassifiedTheme_enable_blog']));
			update_option('ClassifiedTheme_max_time_to_wait', 			trim($_POST['ClassifiedTheme_max_time_to_wait']));			
			update_option('ClassifiedTheme_listing_time_listing',			 	trim($_POST['ClassifiedTheme_listing_time_listing']));
			update_option('ClassifiedTheme_listing_featured_time_listing', 		trim($_POST['ClassifiedTheme_listing_featured_time_listing']));
			update_option('ClassifiedTheme_show_limit_job_cnt', 				trim($_POST['ClassifiedTheme_show_limit_job_cnt']));
			update_option('ClassifiedTheme_listings_per_page_adv_search', 				trim($_POST['ClassifiedTheme_listings_per_page_adv_search']));
			
			update_option('ClassifiedTheme_location_permalink', 				trim($_POST['ClassifiedTheme_location_permalink']));
			update_option('ClassifiedTheme_category_permalink', 				trim($_POST['ClassifiedTheme_category_permalink']));
			update_option('ClassifiedTheme_listing_permalink', 				trim($_POST['ClassifiedTheme_listing_permalink']));
			update_option('ClassifiedTheme_enable_locations', 					trim($_POST['ClassifiedTheme_enable_locations']));
			update_option('classifiedTheme_show_front_slider', 				trim($_POST['classifiedTheme_show_front_slider']));
			update_option('ClassifiedTheme_show_main_menu', 					trim($_POST['ClassifiedTheme_show_main_menu']));
			update_option('ClassifiedTheme_show_stretch', 						trim($_POST['ClassifiedTheme_show_stretch']));
			update_option('ClassifiedTheme_only_admins_post_listings', 						trim($_POST['ClassifiedTheme_only_admins_post_listings']));
			update_option('ClassifiedTheme_show_subcats_enbl', 						trim($_POST['ClassifiedTheme_show_subcats_enbl']));
			

			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		


		
		if(isset($_POST['ClassifiedTheme_save3']))
		{
			update_option('ClassifiedTheme_enable_shipping', 						trim($_POST['ClassifiedTheme_enable_shipping']));
			update_option('ClassifiedTheme_enable_flat_shipping', 					trim($_POST['ClassifiedTheme_enable_flat_shipping']));
			update_option('ClassifiedTheme_enable_location_based_shipping', 		trim($_POST['ClassifiedTheme_enable_location_based_shipping']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		

		
		if(isset($_POST['ClassifiedTheme_save4']))
		{
			update_option('ClassifiedTheme_enable_facebook_login', 	trim($_POST['ClassifiedTheme_enable_facebook_login']));
			update_option('ClassifiedTheme_facebook_app_id', 			trim($_POST['ClassifiedTheme_facebook_app_id']));
			update_option('ClassifiedTheme_facebook_app_secret', 		trim($_POST['ClassifiedTheme_facebook_app_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		
		
		if(isset($_POST['ClassifiedTheme_save5']))
		{
			update_option('ClassifiedTheme_enable_twitter_login', 			trim($_POST['ClassifiedTheme_enable_twitter_login']));
			update_option('ClassifiedTheme_twitter_consumer_key', 			trim($_POST['ClassifiedTheme_twitter_consumer_key']));
			update_option('ClassifiedTheme_twitter_consumer_secret', 		trim($_POST['ClassifiedTheme_twitter_consumer_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		
		do_action('ClassifiedTheme_general_options_actions');
	
	?>
    
		  <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Settings','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Facebook Connect','ClassifiedTheme'); ?></a></li>
            <li><a href="#tabs5"><?php _e('Twitter Connect','ClassifiedTheme'); ?></a></li> 
          	<?php do_action('ClassifiedTheme_general_options_tabs'); ?>
          </ul> 
          <div id="tabs1" >	
          
          			
            <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Collapsible Categories and Locations:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_show_subcats_enbl'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Send Emails no personal headers:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_use_no_personal_headers'); ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Show views in each listing page:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_show_views'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Admin approves each listing:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_admin_approve_listing'); ?></td>
                    </tr>
                    
                    
					<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Frontpage Slider:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'classifiedTheme_show_front_slider'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Main Menu:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_show_main_menu'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Stretch Area:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_show_stretch'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Blog:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_enable_blog'); ?></td>
                    </tr>
                    
 			
         
                    
                     <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Only admin will post listings:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_only_admins_post_listings'); ?></td>
                    </tr>

				
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(__('After the time expires the job will be closed and your users can repost it. Leave 0 for never-expire listings.','ClassifiedTheme')); ?></td>
                    <td ><?php _e('Listing max listing period:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="6" name="ClassifiedTheme_listing_time_listing" value="<?php echo get_option('ClassifiedTheme_listing_time_listing'); ?>"/> days</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Featured listing max job listing period:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="6" name="ClassifiedTheme_listing_featured_time_listing" value="<?php echo get_option('ClassifiedTheme_listing_featured_time_listing'); ?>"/> days</td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Listings per page in Advanced Search:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="6" name="ClassifiedTheme_listings_per_page_adv_search" value="<?php echo get_option('ClassifiedTheme_listings_per_page_adv_search'); ?>"/></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Listing Permalink:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="30" name="ClassifiedTheme_listing_permalink" value="<?php echo get_option('ClassifiedTheme_listing_permalink'); ?>"/> *if left empty will show 'listings'</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Location Permalink:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="30" name="ClassifiedTheme_location_permalink" value="<?php echo get_option('ClassifiedTheme_location_permalink'); ?>"/> *if left empty will show 'location'</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Category Permalink:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="30" name="ClassifiedTheme_category_permalink" value="<?php echo get_option('ClassifiedTheme_category_permalink'); ?>"/> *if left empty will show 'section'</td>
                    </tr>
                    
        
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save1" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                    
          
          </div>
          
  
          
         
          
          <div id="tabs4">	
          
           For facebook connect, install this plugin: <a href="http://wordpress.org/extend/plugins/wordpress-social-login/">WordPress Social Login</a>
           <!--
          
          	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Facebook Login:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_enable_facebook_login'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook App ID:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="35" name="ClassifiedTheme_facebook_app_id" value="<?php echo get_option('ClassifiedTheme_facebook_app_id'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Facebook Secret Key:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="35" name="ClassifiedTheme_facebook_app_secret" value="<?php echo get_option('ClassifiedTheme_facebook_app_secret'); ?>"/></td>
                    </tr>
  
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save4" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          -->
          </div>
           
          <div id="tabs5">	
           For twitter connect, install this plugin: <a href="http://wordpress.org/extend/plugins/wordpress-social-login/">WordPress Social Login</a> <!--
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=general-options&active_tab=tabs5">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable Twitter Login:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_enable_twitter_login'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Key:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="35" name="ClassifiedTheme_twitter_consumer_key" value="<?php echo get_option('ClassifiedTheme_twitter_consumer_key'); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Twitter Consumer Secret:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="35" name="ClassifiedTheme_twitter_consumer_secret" value="<?php echo get_option('ClassifiedTheme_twitter_consumer_secret'); ?>"/></td>
                    </tr>
  					
                    
                    
  						<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Callback URL:','ClassifiedTheme'); ?></td>
                    <td><?php echo get_bloginfo('template_url'); ?>/lib/social/twitter/callback.php</td>
                    </tr>
  
  
  
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save5" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form> -->
          </div>
    		
          <?php do_action('ClassifiedTheme_general_options_div_content'); ?>  

<?php
	echo '</div>';	
	
}



function ClassifiedTheme_theme_bullet($rn = '')
{
	global $menu_admin_ClassifiedTheme_theme_bull;
	$menu_admin_ClassifiedTheme_theme_bull = '<a href="#" class="tltp_cls" title="'.$rn.'"><img src="'.get_bloginfo('template_url') . '/images/qu_icon.png" /></a>';	
	echo $menu_admin_ClassifiedTheme_theme_bull;
	
}


function ClassifiedTheme_pricing_options()
{
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'ClassifiedTheme - '.__('Pricing Settings','ClassifiedTheme');
	$arr = array("yes" => __("Yes",'ClassifiedTheme'), "no" => __("No",'ClassifiedTheme'));
	$sep = array( "," => __('Comma (,)','ClassifiedTheme'), "." => __("Point (.)",'ClassifiedTheme'));
	$frn = array( "front" => __('In front of sum (eg: $50)','ClassifiedTheme'), "back" => __("After the sum (eg: 50$)",'ClassifiedTheme'));
	global $menu_admin_ClassifiedTheme_theme_bull, $wpdb;
	
	$arr_currency = array("USD" => "US Dollars", "EUR" => "Euros", "CAD" => "Canadian Dollars", "CHF" => "Swiss Francs","GBP" => "British Pounds",
						  "AUD" => "Australian Dollars","NZD" => "New Zealand Dollars","BRL" => "Brazilian Real", 'PLN' => 'Polish zloty',
						  "SGD" => "Singapore Dollars","SEK" => "Swidish Kroner","NOK" => "Norwegian Kroner","DKK" => "Danish Kroner",
						  "MXN" => "Mexican Pesos","JPY" => "Japanese Yen","EUR" => "Euros", "ZAR" => "South Africa Rand", 'RUB' => 'Russian Ruble' , "TRY" => "Turkish Lyra",  "RON" => "Romanian Lei",
						  'COP' => 'Colombian Peso' ,  'INR' => 'Indian Rupee' , 'THB' => 'Thai Baht', 'LTL' => 'Lithuania Litas' , 'MYR' => 'Malaysian ringgit', 'HKD' => 'HongKong Dollars'
						  
						  );
	
	$arr_currency = apply_filters('ClassifiedTheme_arr_currency',$arr_currency);
		
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	//-------------------
	
	if(isset($_POST['ClassifiedTheme_save1']))
	{
		$ClassifiedTheme_currency 						= trim($_POST['ClassifiedTheme_currency']);
		$ClassifiedTheme_currency_symbol 				= trim($_POST['ClassifiedTheme_currency_symbol']);
		$ClassifiedTheme_currency_position 			= trim($_POST['ClassifiedTheme_currency_position']);
		$ClassifiedTheme_decimal_sum_separator 		= trim($_POST['ClassifiedTheme_decimal_sum_separator']);
		$ClassifiedTheme_thousands_sum_separator 		= trim($_POST['ClassifiedTheme_thousands_sum_separator']);

		update_option('ClassifiedTheme_currency', 					$ClassifiedTheme_currency);
		update_option('ClassifiedTheme_currency_symbol', 			$ClassifiedTheme_currency_symbol);
		update_option('ClassifiedTheme_currency_position', 		$ClassifiedTheme_currency_position);
		update_option('ClassifiedTheme_decimal_sum_separator', 	$ClassifiedTheme_decimal_sum_separator);
		update_option('ClassifiedTheme_thousands_sum_separator', 	$ClassifiedTheme_thousands_sum_separator);

	
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';	
	}
	
	if(isset($_POST['ClassifiedTheme_save2']))
	{

		$ClassifiedTheme_new_listing_listing_fee 			= trim($_POST['ClassifiedTheme_new_listing_listing_fee']);
		$ClassifiedTheme_new_listing_feat_listing_fee 		= trim($_POST['ClassifiedTheme_new_listing_feat_listing_fee']);
		$ClassifiedTheme_withdraw_limit					= trim($_POST['ClassifiedTheme_withdraw_limit']);
		$ClassifiedTheme_percent_fee_taken					= trim($_POST['ClassifiedTheme_percent_fee_taken']);
		$ClassifiedTheme_solid_fee_taken					= trim($_POST['ClassifiedTheme_solid_fee_taken']);
	 
		
		update_option('ClassifiedTheme_new_listing_listing_fee', 					$ClassifiedTheme_new_listing_listing_fee);
		update_option('ClassifiedTheme_solid_fee_taken', 							$ClassifiedTheme_solid_fee_taken);
		update_option('ClassifiedTheme_percent_fee_taken', 						$ClassifiedTheme_percent_fee_taken);
		update_option('ClassifiedTheme_withdraw_limit', 							$ClassifiedTheme_withdraw_limit);
		update_option('ClassifiedTheme_new_listing_feat_listing_fee', 				$ClassifiedTheme_new_listing_feat_listing_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';	
	}
	
	
	if(isset($_POST['ClassifiedTheme_save3']))
	{

		$ClassifiedTheme_take_percent_fee 				= trim($_POST['ClassifiedTheme_take_percent_fee']);
		$ClassifiedTheme_take_flat_fee 		= trim($_POST['ClassifiedTheme_take_flat_fee']);
		$listing_theme_min_withdraw			= trim($_POST['listing_theme_min_withdraw']);
	
		update_option('listing_theme_min_withdraw', 			$listing_theme_min_withdraw);
		update_option('ClassifiedTheme_take_percent_fee', 			$ClassifiedTheme_take_percent_fee);
		update_option('ClassifiedTheme_take_flat_fee', 	$ClassifiedTheme_take_flat_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';	
	}
	
	
	if(isset($_POST['ClassifiedTheme_addnewcost']))
	{
		$cost = trim($_POST['newcost']);
		$ss = "insert into ".$wpdb->prefix."job_var_costs (cost) values('$cost')";
		$wpdb->query($ss);
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';	
	}


?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Details','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Listing Fees','ClassifiedTheme'); ?></a></li> 
         
            
          </ul> 
          <div id="tabs1">	
          
          	 <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_pr_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                     <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Site currency:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr_currency, 'ClassifiedTheme_currency'); ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Currency symbol:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="6" name="ClassifiedTheme_currency_symbol" value="<?php echo get_option('ClassifiedTheme_currency_symbol'); ?>"/> </td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Currency symbol position:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($frn, 'ClassifiedTheme_currency_position'); ?></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Decimals sum separator:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($sep, 'ClassifiedTheme_decimal_sum_separator'); ?></td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Thousands sum separator:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($sep, 'ClassifiedTheme_thousands_sum_separator'); ?></td>
                    </tr>
      
                   
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save1" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          
          </div>
          
          <div id="tabs2" style="display: none; ">
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_pr_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				

                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Listing Fee (base fee):','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="15" name="ClassifiedTheme_new_listing_listing_fee" value="<?php echo get_option('ClassifiedTheme_new_listing_listing_fee'); ?>"/> <?php echo ClassifiedTheme_get_currency(); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Listing Fee (featured fee):','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="15" name="ClassifiedTheme_new_listing_feat_listing_fee" value="<?php echo get_option('ClassifiedTheme_new_listing_feat_listing_fee'); ?>"/> 
					<?php echo ClassifiedTheme_get_currency(); ?></td>
                    </tr>
                    
                    
              
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save2" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          </div>
          
        
    
       

<?php
	echo '</div>';		
	
	
}

function ClassifiedTheme_info()
{
	$id_icon 		= 'icon-options-general-info';
	$ttl_of_stuff 	= 'ClassifiedTheme - '.__('Information','ClassifiedTheme');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Main Information','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('From SiteMile Blog','ClassifiedTheme'); ?></a></li> 
  
          </ul> 
          <div id="tabs1" style="display: block; ">	
          
          <table width="100%" class="sitemile-table">
    				

                    <tr>                    
                    <td width="260"><?php _e('ClassifiedTheme Version:','ClassifiedTheme'); ?></td>
                    <td><?php echo CLASSIFIEDTHEME_VERSION; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('ClassifiedTheme Latest Release:','ClassifiedTheme'); ?></td>
                    <td><?php echo CLASSIFIEDTHEME_RELEASE; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('WordPress Version:','ClassifiedTheme'); ?></td>
                    <td><?php bloginfo('version'); ?></td>
                    </tr>
                    
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to SiteMile official page:','ClassifiedTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com">SiteMile - Premium WordPress Themes</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to ClassifiedTheme\'s official page:','ClassifiedTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/p/classifiedTheme">SiteMile Classified Theme</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to support forums:','ClassifiedTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/forums">SiteMile Support Forums</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Contact SiteMile Team:','ClassifiedTheme'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/contact-us">Contact Form</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Like us on Facebook:','ClassifiedTheme'); ?></td>
                    <td><a class="festin" href="http://facebook.com/sitemile">SiteMile Facebook Fan Page</a></td>
                    </tr>
                    
                    
                     <tr>                    
                    <td width="160"><?php _e('Follow us on Twitter:','ClassifiedTheme'); ?></td>
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


function ClassifiedTheme_tracking_tools_panel()
{
	$id_icon 		= 'icon-options-general-track';
	$ttl_of_stuff 	= 'ClassifiedTheme - '.__('Tracking Tools','ClassifiedTheme');
	$arr = array("yes" => __("Yes",'ClassifiedTheme'), "no" => __("No",'ClassifiedTheme'));
	global $menu_admin_ClassifiedTheme_theme_bull;
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['ClassifiedTheme_save1']))
		{
			update_option('ClassifiedTheme_enable_google_analytics', 				trim($_POST['ClassifiedTheme_enable_google_analytics']));
			update_option('ClassifiedTheme_analytics_code', 						trim($_POST['ClassifiedTheme_analytics_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
		
	if(isset($_POST['ClassifiedTheme_save2']))
		{
			update_option('ClassifiedTheme_enable_other_tracking', 				trim($_POST['ClassifiedTheme_enable_other_tracking']));
			update_option('ClassifiedTheme_other_tracking_code', 						trim($_POST['ClassifiedTheme_other_tracking_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
		}
			

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Google Analytics','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Other Tracking Tools','ClassifiedTheme'); ?></a></li> 
          </ul> 
          <div id="tabs1">
          
          		
                 <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Google Analytics:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_enable_google_analytics'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Analytics Code:','ClassifiedTheme'); ?></td>
                    <td><textarea rows="6" cols="80" name="ClassifiedTheme_analytics_code"><?php echo stripslashes(get_option('ClassifiedTheme_analytics_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save1" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          	
          </div>
          
          <div id="tabs2">	
          
             <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Other Tracking:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_enable_other_tracking'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Other Tracking Code:','ClassifiedTheme'); ?></td>
                    <td><textarea rows="6" cols="80" name="ClassifiedTheme_other_tracking_code"><?php echo stripslashes(get_option('ClassifiedTheme_other_tracking_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save2" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          
          </div>
    

<?php
	echo '</div>';		
	
}


function ClassifiedTheme_advertising_scr()
{
 
	$id_icon 		= 'icon-options-general-adve';
	$ttl_of_stuff 	= 'ClassifiedTheme - '.__('Advertising Spaces','ClassifiedTheme');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['ClassifiedTheme_save1']))
	{
		update_option('ClassifiedTheme_adv_code_home_above_content', 				trim($_POST['ClassifiedTheme_adv_code_home_above_content']));
		update_option('ClassifiedTheme_adv_code_home_below_content', 				trim($_POST['ClassifiedTheme_adv_code_home_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
	}
	
	if(isset($_POST['ClassifiedTheme_save2']))
	{
		update_option('ClassifiedTheme_adv_code_listing_page_above_content', 				trim($_POST['ClassifiedTheme_adv_code_listing_page_above_content']));
		update_option('ClassifiedTheme_adv_code_listing_page_below_content', 				trim($_POST['ClassifiedTheme_adv_code_listing_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
	}
	
	if(isset($_POST['ClassifiedTheme_save3']))
	{
		update_option('ClassifiedTheme_adv_code_cat_page_above_content', 				trim($_POST['ClassifiedTheme_adv_code_cat_page_above_content']));
		update_option('ClassifiedTheme_adv_code_cat_page_below_content', 				trim($_POST['ClassifiedTheme_adv_code_cat_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
	}
	
	if(isset($_POST['ClassifiedTheme_save4']))
	{
		update_option('ClassifiedTheme_adv_code_single_page_above_content', 				trim($_POST['ClassifiedTheme_adv_code_single_page_above_content']));
		update_option('ClassifiedTheme_adv_code_single_page_below_content', 				trim($_POST['ClassifiedTheme_adv_code_single_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';
	}

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Listing Page','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Category Page','ClassifiedTheme'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Single Blog/Normal Page','ClassifiedTheme'); ?></a></li> 
          </ul> 
          <div id="tabs1">	
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_adv_&active_tab=tabs1">
          	  <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_home_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_home_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_home_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_home_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save1" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>  
                    
              </table>      
          </form>
          
          </div>
          
          <div id="tabs2">	
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_adv_&active_tab=tabs2">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_listing_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_listing_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_listing_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_listing_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save2" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>  
                    
              </table>  
          </form>
          </div>
          
          <div id="tabs3">	
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_adv_&active_tab=tabs3">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_cat_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_cat_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_cat_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_cat_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save3" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div> 
          
          <div id="tabs4">	
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_adv_&active_tab=tabs4">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_single_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_single_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','ClassifiedTheme'); ?></td>
                <td><textarea name="ClassifiedTheme_adv_code_single_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('ClassifiedTheme_adv_code_single_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save4" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div>  

<?php 
	echo '</div>';		
	
}

function ClassifiedTheme_membership_paks()
{
$id_icon 		= 'icon-options-general-withdr';
	$ttl_of_stuff 	= 'ClassifiedTheme - Membership Packs';
	global $wpdb, $menu_admin_ClassifiedTheme_theme_bull;
	$arr = array("yes" => __("Yes",'ClassifiedTheme'), "no" => __("No",'ClassifiedTheme'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------
	
	do_action('ClassifiedTheme_payment_methods_action');
	if(isset($_POST['ClassifiedTheme_save1']))
	{
		update_option('ClassifiedTheme_paypal_enable', 		trim($_POST['ClassifiedTheme_paypal_enable']));
		update_option('ClassifiedTheme_paypal_email', 			trim($_POST['ClassifiedTheme_paypal_email']));
		update_option('ClassifiedTheme_paypal_enable_sdbx', 	trim($_POST['ClassifiedTheme_paypal_enable_sdbx']));
		
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save2']))
	{
		update_option('ClassifiedTheme_alertpay_enable', trim($_POST['ClassifiedTheme_alertpay_enable']));
		update_option('ClassifiedTheme_alertpay_email', trim($_POST['ClassifiedTheme_alertpay_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save3']))
	{
		update_option('ClassifiedTheme_moneybookers_enable', trim($_POST['ClassifiedTheme_moneybookers_enable']));
		update_option('ClassifiedTheme_moneybookers_email', trim($_POST['ClassifiedTheme_moneybookers_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save4']))
	{
		update_option('ClassifiedTheme_ideal_enable', trim($_POST['ClassifiedTheme_ideal_enable']));
		update_option('ClassifiedTheme_ideal_email', trim($_POST['ClassifiedTheme_ideal_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	
		if(isset($_POST['ClassifiedTheme_offline_payment_save']))
	{
		update_option('ClassifiedTheme_offline_payments', trim($_POST['ClassifiedTheme_offline_payments']));
		update_option('ClassifiedTheme_offline_payment_dets', trim($_POST['ClassifiedTheme_offline_payment_dets']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	
	?>


	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php if(isset($_GET['edit_field'])): ?>Edit Pack<?php else: ?>Add New<?php endif; ?></a></li> 
            <li><a href="#tabs-2">Current Packs</a></li>
             
             
          </ul> 
          
          
          <div id="tabs1" style="padding:0">
            <?php
			
			if(isset($_POST['add-pack']))
			{
				$pack_name = trim($_POST['pack_name']);
				$ads_number = trim($_POST['ads_number']);
				$pack_cost = trim($_POST['pack_cost']);
				$tm = time();
				$featured_free = isset($_POST['featured_free']) ? 1 : 0;
				
			
				$wpdb->query("insert into ".$wpdb->prefix."ad_packs (datemade, pack_name, ads_number, pack_cost, featured_free ) 
				values('$tm','$pack_name','$ads_number','$pack_cost','$featured_free')");
				
				echo '<div class="packpack">Pack added!</div>';
			}
			
			
			if(isset($_POST['save-pack']))
			{
				$pack_name = trim($_POST['pack_name']);
				$ads_number = trim($_POST['ads_number']);
				$pack_cost = trim($_POST['pack_cost']);
				$tm = time();
				$featured_free = isset($_POST['featured_free']) ? 1 : 0;
				$id = $_POST['pid'];
			
				$wpdb->query("update ".$wpdb->prefix."ad_packs set pack_name='$pack_name', ads_number='$ads_number', 
				pack_cost='$pack_cost', featured_free='$featured_free' where id='$id'");
				
				echo 'Pack updated!<br/>';
			}
			
			
			?>
            
            <?php
			
			if(isset($_GET['edit_field'])):
			$fid = $_GET['edit_field'];
			$ss2 = "select * from ".$wpdb->prefix."ad_packs where id='$fid'";
			$rf = $wpdb->get_results($ss2);
			$row = $rf[0];
			
			
			endif;
			?>
            
            
            
                     <?php
			
			if(isset($_GET['delete_field'])):
			$fid = $_GET['delete_field'];
			$ss2 = "delete from ".$wpdb->prefix."ad_packs where id='$fid'";
			$wpdb->query($ss2);
			
			echo 'Pack deleted!<br/>';
			
			endif;
			?>
            
            
            
            
            
                <form method="post">
                <?php
				if(isset($_GET['edit_field'])):
				echo '<input type="hidden" name="pid" value="'.$row->id.'" />';
				endif;
				?>
<table  class="sitemile-table" width="100%">
<tr>
<td width="180">Pack Name:</td>
<td><input type="text" size="20" name="pack_name" value="<?php echo $row->pack_name; ?>" /></td>
</tr>


<tr>
<td>Number of ads:</td>
<td><input type="text" size="10" name="ads_number" value="<?php echo $row->ads_number; ?>" /></td>
</tr>


<tr>
<td>Cost:</td>
<td><input type="text" size="10" name="pack_cost" value="<?php echo $row->pack_cost; ?>" /> <?php echo classifiedTheme_currency(); ?></td>
</tr>


<tr>
<td>Include featured ads:</td>
<td><input type="checkbox" name="featured_free" value="1" <?php if($row->featured_free == "1") echo 'checked="checked"'; ?> /></td>
</tr>


<tr>
<td>&nbsp;</td>
<?php

if(isset($_GET['edit_field'])):
?>
<td><input type="submit" value="Save Pack" name="save-pack" /></td>
<?php else: ?>

<td><input type="submit" value="Add New Pack" name="add-pack" /></td>
<?php
endif;
?>

</tr> 

</table>
</form>
            
			</div>
			
			
			<div id="tabs-2">
            
            <?php
	
	$ss2 = "select * from ".$wpdb->prefix."ad_packs order by pack_name asc";
	///mysql_query($ss2) or die(mysql_error());
	$rf = $wpdb->get_results($ss2);
	
	if(count($rf) == 0)
		echo 'No packs yet added.';
	else
	{
		echo '<table class="wp-list-table widefat fixed posts">';
		
		
		echo '<thead><tr>';
		echo '<th><strong>Pack Name</strong></th>';
		echo '<th><strong>Ads Number</strong></th>';
		echo '<th><strong>Cost</strong></th>';
		echo '<th><strong>Featured Included?</strong></th>';
		echo '<th><strong>Options</strong></th>';
		echo '</tr></thead><tbody>';
		
		foreach($rf as $row)
		{		
				$bgs = "efefef";
				if(isset($_GET['edit_field']))				
					if($_GET['edit_field'] == $row->id)
						$bgs = "B5CA73";
				
				
				
				echo '<tr>';
				echo '<th>'.$row->pack_name.'</th>';
				echo '<th>'.$row->ads_number.'</th>';
				
				echo '<th>'.$row->pack_cost.' '.classifiedTheme_currency().'</th>';
				echo '<th>'.($row->featured_free == '1' ? "Yes" : "No").'</th>';
				echo '<th>
				<a href="'.get_admin_url().'admin.php?page=CT_mem_packs_&edit_field='.$row->id.'"
				><img src="'.get_bloginfo('template_url').'/images/edit.gif" border="0" alt="Edit" /></a>
				
				<a href="'.get_admin_url().'admin.php?page=CT_mem_packs_&delete_field='.$row->id.'"
				><img src="'.get_bloginfo('template_url').'/images/delete.gif" border="0" alt="Delete" /></a>
				
				</th>';
				echo '</tr>';
			
		}
		echo '</tbody></table>';
	}
	?>
            
            
			</div>

          
          
<?php
	echo '</div>';	
  	
		
	
}

function ClassifiedTheme_payment_gateways()
{
	
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'ClassifiedTheme - Payment Methods';
	global $menu_admin_ClassifiedTheme_theme_bull;
	$arr = array("yes" => __("Yes",'ClassifiedTheme'), "no" => __("No",'ClassifiedTheme'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------
	
	do_action('ClassifiedTheme_payment_methods_action');
	if(isset($_POST['ClassifiedTheme_save1']))
	{
		update_option('ClassifiedTheme_paypal_enable', 		trim($_POST['ClassifiedTheme_paypal_enable']));
		update_option('ClassifiedTheme_paypal_email', 			trim($_POST['ClassifiedTheme_paypal_email']));
		update_option('ClassifiedTheme_paypal_enable_sdbx', 	trim($_POST['ClassifiedTheme_paypal_enable_sdbx']));
		
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save2']))
	{
		update_option('ClassifiedTheme_alertpay_enable', trim($_POST['ClassifiedTheme_alertpay_enable']));
		update_option('ClassifiedTheme_alertpay_email', trim($_POST['ClassifiedTheme_alertpay_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save3']))
	{
		update_option('ClassifiedTheme_moneybookers_enable', trim($_POST['ClassifiedTheme_moneybookers_enable']));
		update_option('ClassifiedTheme_moneybookers_email', trim($_POST['ClassifiedTheme_moneybookers_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save4']))
	{
		update_option('ClassifiedTheme_ideal_enable', trim($_POST['ClassifiedTheme_ideal_enable']));
		update_option('ClassifiedTheme_ideal_email', trim($_POST['ClassifiedTheme_ideal_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	
		if(isset($_POST['ClassifiedTheme_offline_payment_save']))
	{
		update_option('ClassifiedTheme_offline_payments', trim($_POST['ClassifiedTheme_offline_payments']));
		update_option('ClassifiedTheme_offline_payment_dets', trim($_POST['ClassifiedTheme_offline_payment_dets']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	
	?>


	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1">PayPal</a></li> 
            <li><a href="#tabs2">Payza/AlertPay</a></li> 
            <li><a href="#tabs3">Moneybookers/Skrill</a></li> 
            <li><a href="#tabs4">iDeal</a></li> 
            <li><a href="#tabs_offline"><?php _e('Bank Payment(offline)','ClassifiedTheme'); ?></a></li>
            <?php do_action('ClassifiedTheme_payment_methods_tabs'); ?>
             
          </ul> 
          <div id="tabs1"  >	
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_pay_gate_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_paypal_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('PayPal Enable Sandbox:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_paypal_enable_sdbx'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('PayPal Email Address:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="45" name="ClassifiedTheme_paypal_email" value="<?php echo get_option('ClassifiedTheme_paypal_email'); ?>"/></td>
                    </tr>
                    
                    
                   
                  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save1" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs2" >	
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_pay_gate_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_alertpay_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Payza/Alertpay Email:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="45" name="ClassifiedTheme_alertpay_email" value="<?php echo get_option('ClassifiedTheme_alertpay_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save2" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>

            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_pay_gate_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_moneybookers_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('MoneyBookers Email:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="45" name="ClassifiedTheme_moneybookers_email" value="<?php echo get_option('ClassifiedTheme_moneybookers_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save3" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          		
          </div> 
          
          <div id="tabs4" >	
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_pay_gate_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_ideal_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('iDeal Partner ID:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="45" name="ClassifiedTheme_ideal_email" value="<?php echo get_option('ClassifiedTheme_ideal_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save4" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          	
          </div>
          
        
          
           <div id="tabs_offline" >	
           
           <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_pay_gate_&active_tab=tabs_offline">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_offline_payments'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign="top" ><?php _e('Bank Details:','ClassifiedTheme'); ?></td>
                    <td><textarea name="ClassifiedTheme_offline_payment_dets" rows="5" cols="50" ><?php echo get_option('ClassifiedTheme_offline_payment_dets'); ?></textarea></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_offline_payment_save" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
           
          </div>  
          
          <?php do_action('ClassifiedTheme_payment_methods_content_divs'); ?>

<?php
	echo '</div>';	
  	
	
}

function ClassifiedTheme_custom_fields()
{
	
global $menu_admin_item_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-custfields"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">ClassifiedTheme Custom Fields</h2>';
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
			$ss = "insert into ".$wpdb->prefix."ad_custom_fields (name,tp,ordr,cate) 
														values('$field_name','$field_type','$field_order','$field_category')";
			$wpdb->query($ss);
			
			//----------------------------
			
			$ss = "select id from ".$wpdb->prefix."ad_custom_fields where name='$field_name' AND tp='$field_type'";
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
								$wpdb->query("insert into ".$wpdb->prefix."ad_custom_relations (custid,catid) values('$custid','$field_category')");
								
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
						$wpdb->query("delete from ".$wpdb->prefix."ad_custom_relations where custid='$custid'"); 
						
						if($field_category != 'all')
						{
							
							for($i=0;$i<count($_POST['field_cats']);$i++)
								if(isset($_POST['field_cats'][$i]))
									{
										$field_category = $_POST['field_cats'][$i];
										$wpdb->query("insert into ".$wpdb->prefix."ad_custom_relations (custid,catid) values('$custid','$field_category')");	
									}
							
							if(empty($field_category)) $field_category = 'all';
						}
						else
							$field_category = 'all';
							
						//-------------------------------
						
						$ss = "update ".$wpdb->prefix."ad_custom_fields set name='$field_name',ordr='$field_order',cate='$field_category' where id='$custid'";
						$wpdb->query($ss);
						
						echo '<div class="saved_thing">Custom field saved!</div>';
					}
				}
		
		
		
		
		$s = "select * from ".$wpdb->prefix."ad_custom_fields where id='$custid'";
		$row = $wpdb->get_results($s);
		
		$row = $row[0];
	}	
		


	if(isset($_GET['delete_field']))
	{
		$delid = $_GET['delete_field'];
		$s = "select name from ".$wpdb->prefix."ad_custom_fields where id='$delid'";
		$row = $wpdb->get_results($s);
		$row = $row[0];
		
		if(isset($_GET['coo']))
		{
			$s = "delete from ".$wpdb->prefix."ad_custom_fields where id='$delid'";
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
				<li><a href="#tabs-0">Edit custom field "<?php echo $row->name; ?>"</a></li>				
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
    <td><?php echo ClassifiedTheme_get_field_tp($row->tp); ?></td>
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
				
				
			 $categories =  get_categories('taxonomy=ad_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category) 
				{
					
					if(classifiedTheme_search_into($custid,$category->cat_ID) == 1) $chk = ' checked="checked" ';
						else $chk = "";
					echo '
					    <tr>
						<td><input '.$chk.' type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';
						
					$subcategories =  get_categories('taxonomy=ad_cat&hide_empty=0&orderby=name&parent='.$category->term_id);
						
					if($subcategories)	
					foreach ($subcategories as $subcategory) 
					{
						if(classifiedTheme_search_into($custid,$subcategory->cat_ID) == 1) $chk = ' checked="checked" ';
						else $chk = "";
						
						echo '
					    <tr>
						<td>&nbsp; &nbsp; &nbsp; <input type="checkbox" '.$chk.' name="field_cats[]" value="'.$subcategory->cat_ID.'" />
						'.$subcategory->cat_name.'</td>
						</tr>';
						
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
				$ss = "insert into ".$wpdb->prefix."ad_custom_options (valval, custid) values('$option_name','$custid')";
				$wpdb->query($ss);
				
				echo '<div class="saved_thing"  id="add_options"><div class="padd10">Success! Your option was added!</div></div>';
				
				
			}
		
		
		?>
        
        
        <table  class="sitemile-table" width="100%"><tr><td>
        <strong>Add options:</strong>
        </td></tr>
        </table>
        
       	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=custom-fields&edit_field=<?php echo $custid; ?>#add_options"> 
        <table>
        <tr>
        <td>Option Name: </td>
        <td><input type="text" name="option_name" size="20" /> <input type="submit" name="_add_option" value="Add Option" /> </td>
        </tr>
		
        <?php echo ClassifiedTheme_clear_table(2); ?>
        </table>
        </form>
        
        
        <table><tr><td>
        <strong>Current options:</strong>
        </td></tr>
        </table>
        <?php
		
		$ss = "select * from ".$wpdb->prefix."ad_custom_options where custid='$custid' order by id desc";
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
			
			   $categories =  get_categories('taxonomy=ad_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category) 
				{
						echo '
					    <tr>
						<td><input type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';
						
					$subcategories =  get_categories('taxonomy=ad_cat&hide_empty=0&orderby=name&parent='.$category->term_id);
						
					if($subcategories)	
					foreach ($subcategories as $subcategory) 
					{
						echo '
					    <tr>
						<td>&nbsp; &nbsp; &nbsp; <input type="checkbox" name="field_cats[]" value="'.$subcategory->cat_ID.'" />
						'.$subcategory->cat_name.'</td>
						</tr>';
						
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
	
	$ss2 = "select * from ".$wpdb->prefix."ad_custom_fields order by name asc";
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
				echo '<th>'.ClassifiedTheme_get_field_tp($row->tp).'</th>';
				echo '<th>'.($row->cate == 'all' ? "All Categories" : "Multiple Categories").'</th>';
				echo '<th>'.$row->ordr.'</th>';
				echo '<th>
				<a href="'.get_admin_url().'admin.php?page=custom-fields&edit_field='.$row->id.'"
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

function ClassifiedTheme_email_settings()
{
	$id_icon 		= 'icon-options-general-email';
	$ttl_of_stuff 	= 'ClassifiedTheme - '.__('Email Settings','ClassifiedTheme');
	global $menu_admin_ClassifiedTheme_theme_bull;
	$arr = array( "yes" => 'Yes', "no" => "No");
	
	
		
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------------------------------------------------------
	
	if(isset($_POST['ClassifiedTheme_save1']))
	{
		update_option('ClassifiedTheme_email_name_from', 	trim($_POST['ClassifiedTheme_email_name_from']));
		update_option('ClassifiedTheme_email_addr_from', 	trim($_POST['ClassifiedTheme_email_addr_from']));
		update_option('ClassifiedTheme_allow_html_emails', trim($_POST['ClassifiedTheme_allow_html_emails']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save2']))
	{
		update_option('ClassifiedTheme_new_user_email_subject', 	trim($_POST['ClassifiedTheme_new_user_email_subject']));
		update_option('ClassifiedTheme_new_user_email_message', 	trim($_POST['ClassifiedTheme_new_user_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_send_expire_notice_save']))
	{
		update_option('ClassifiedTheme_send_expire_notice_enable', 	trim($_POST['ClassifiedTheme_send_expire_notice_enable']));
		update_option('ClassifiedTheme_send_expire_notice_subject', 	trim($_POST['ClassifiedTheme_send_expire_notice_subject']));
		update_option('ClassifiedTheme_send_expire_notice_message', 	trim($_POST['ClassifiedTheme_send_expire_notice_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	
	if(isset($_POST['ClassifiedTheme_save31']))
	{
		update_option('ClassifiedTheme_new_item_email_approve_admin_enable', 	trim($_POST['ClassifiedTheme_new_item_email_approve_admin_enable']));
		update_option('ClassifiedTheme_new_item_email_approve_admin_subject', 	trim($_POST['ClassifiedTheme_new_item_email_approve_admin_subject']));
		update_option('ClassifiedTheme_new_item_email_approve_admin_message', 	trim($_POST['ClassifiedTheme_new_item_email_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save3']))
	{
		update_option('ClassifiedTheme_new_item_email_not_approve_admin_enable', 	trim($_POST['ClassifiedTheme_new_item_email_not_approve_admin_enable']));
		update_option('ClassifiedTheme_new_item_email_not_approve_admin_subject', 	trim($_POST['ClassifiedTheme_new_item_email_not_approve_admin_subject']));
		update_option('ClassifiedTheme_new_item_email_not_approve_admin_message', 	trim($_POST['ClassifiedTheme_new_item_email_not_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save32']))
	{
		update_option('ClassifiedTheme_new_item_email_not_approved_enable', 	trim($_POST['ClassifiedTheme_new_item_email_not_approved_enable']));
		update_option('ClassifiedTheme_new_item_email_not_approved_subject', 	trim($_POST['ClassifiedTheme_new_item_email_not_approved_subject']));
		update_option('ClassifiedTheme_new_item_email_not_approved_message', 	trim($_POST['ClassifiedTheme_new_item_email_not_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	if(isset($_POST['ClassifiedTheme_save33']))
	{
		update_option('ClassifiedTheme_new_item_email_approved_enable', 	trim($_POST['ClassifiedTheme_new_item_email_approved_enable']));
		update_option('ClassifiedTheme_new_item_email_approved_subject', 	trim($_POST['ClassifiedTheme_new_item_email_approved_subject']));
		update_option('ClassifiedTheme_new_item_email_approved_message', 	trim($_POST['ClassifiedTheme_new_item_email_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	
	
	if(isset($_POST['ClassifiedTheme_save_new_user_email_admin']))
	{
		update_option('ClassifiedTheme_new_user_email_admin_subject', 	trim($_POST['ClassifiedTheme_new_user_email_admin_subject']));
		update_option('ClassifiedTheme_new_user_email_admin_message', 	trim($_POST['ClassifiedTheme_new_user_email_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','ClassifiedTheme').'</div>';		
	}
	
	do_action('ClassifiedTheme_save_emails_post');
	
	
	?>
    
	<div id="usual2" class="usual"> 
        <ul> 
            <li><a href="#tabs1"><?php _e('Email Settings','ClassifiedTheme'); ?></a></li> 
            <li><a href="#new_user_email"><?php _e('New User Email','ClassifiedTheme'); ?></a></li>
            <li><a href="#admin_new_user_email"><?php _e('New User Email (admin)','ClassifiedTheme'); ?></a></li>
            
            <li><a href="#post_listing_approved_admin"><?php _e('Post Item (Not Approved) Email (admin)','ClassifiedTheme'); ?></a></li>
            <li><a href="#post_listing_not_approved_admin"><?php _e('Post Item (Auto Approved) Email (admin)','ClassifiedTheme'); ?></a></li>
            <li><a href="#post_listing_approved"><?php _e('Post Item (Not Approved) Email','ClassifiedTheme'); ?></a></li>
            <li><a href="#post_listing_not_approved"><?php _e('Post Item (Auto Approved) Email','ClassifiedTheme'); ?></a></li>
            <li><a href="#post_expire_notice"><?php _e('Item Expire Notice','ClassifiedTheme'); ?></a></li>
            

              
    		
            <?php do_action('ClassifiedTheme_save_emails_tabs'); ?>
            
        </ul> 
 
 		        
        <div id="post_listing_not_approved" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is automatically approved. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','ClassifiedTheme'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=post_listing_not_approved">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_new_item_email_approved_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="90" name="ClassifiedTheme_new_item_email_approved_subject" value="<?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_approved_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="ClassifiedTheme_new_item_email_approved_message"><?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_approved_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','ClassifiedTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('username','ClassifiedTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','ClassifiedTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","ClassifiedTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'ClassifiedTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'ClassifiedTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'ClassifiedTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','ClassifiedTheme'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save33" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ################################## -->
        
        <div id="post_listing_approved" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is not automatically approved. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','ClassifiedTheme'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=post_listing_approved">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_new_item_email_not_approved_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="90" name="ClassifiedTheme_new_item_email_not_approved_subject" value="<?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_not_approved_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="ClassifiedTheme_new_item_email_not_approved_message"><?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_not_approved_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','ClassifiedTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('item owner username','ClassifiedTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','ClassifiedTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","ClassifiedTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'ClassifiedTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'ClassifiedTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'ClassifiedTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','ClassifiedTheme'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save32" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ############################### -->
        
        
        
        <div id="post_expire_notice" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the user when his listing on the website expires.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','ClassifiedTheme'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=post_expire_notice">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_send_expire_notice_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="90" name="ClassifiedTheme_send_expire_notice_subject" value="<?php echo stripslashes(get_option('ClassifiedTheme_send_expire_notice_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="ClassifiedTheme_send_expire_notice_message"><?php echo stripslashes(get_option('ClassifiedTheme_send_expire_notice_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','ClassifiedTheme'); ?><br/><br/>
                    
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','ClassifiedTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","ClassifiedTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'ClassifiedTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'ClassifiedTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'ClassifiedTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','ClassifiedTheme'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_send_expire_notice_save" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        
        <div id="post_listing_not_approved_admin" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website to be approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','ClassifiedTheme'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=post_listing_not_approved_admin">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_new_item_email_approve_admin_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="90" name="ClassifiedTheme_new_item_email_approve_admin_subject" value="<?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_approve_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="ClassifiedTheme_new_item_email_approve_admin_message"><?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_approve_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','ClassifiedTheme'); ?><br/><br/>
                    
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','ClassifiedTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","ClassifiedTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'ClassifiedTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'ClassifiedTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'ClassifiedTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','ClassifiedTheme'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save31" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
 
 		 <div id="post_listing_approved_admin" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website. This email will be received if the the item is automatically approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','ClassifiedTheme'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=post_listing_approved_admin">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','ClassifiedTheme'); ?></td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_new_item_email_not_approve_admin_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="90" name="ClassifiedTheme_new_item_email_not_approve_admin_subject" value="<?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_not_approve_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="ClassifiedTheme_new_item_email_not_approve_admin_message"><?php echo stripslashes(get_option('ClassifiedTheme_new_item_email_not_approve_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','ClassifiedTheme'); ?><br/><br/>
                    
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','ClassifiedTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","ClassifiedTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'ClassifiedTheme'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'ClassifiedTheme'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'ClassifiedTheme'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new listing','ClassifiedTheme'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save3" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
 
        <div id="tabs1" style="display: none; ">
        	<form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160">Email From Name:</td>
                    <td><input type="text" size="45" name="ClassifiedTheme_email_name_from" value="<?php echo stripslashes(get_option('ClassifiedTheme_email_name_from')); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td >Email From Address:</td>
                    <td><input type="text" size="45" name="ClassifiedTheme_email_addr_from" value="<?php echo stripslashes(get_option('ClassifiedTheme_email_addr_from')); ?>"/></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td >Allow HTML in emails:</td>
                    <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_allow_html_emails'); ?></td>
                    </tr>
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save1" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
        </div> 
          
        <!-- ################################ -->  
                
        <div id="new_user_email" style="display: none; ">
        	<div class="spntxt_bo"><?php _e('This email will be received by all new users who register on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','ClassifiedTheme'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="90" name="ClassifiedTheme_new_user_email_subject" value="<?php echo stripslashes(get_option('ClassifiedTheme_new_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="ClassifiedTheme_new_user_email_message"><?php echo stripslashes(get_option('ClassifiedTheme_new_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','ClassifiedTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e("your new username",'ClassifiedTheme'); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email",'ClassifiedTheme'); ?><br/>
                    <strong>##user_password##</strong> - <?php _e("your new user's password",'ClassifiedTheme'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','ClassifiedTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","ClassifiedTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'ClassifiedTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save2" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          
        </div> 
        
        <!-- ################################ -->  
                
        <div id="admin_new_user_email" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when a new user registers on the website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','ClassifiedTheme'); ?> </div>
          
          
          <form method="post" action="<?php echo get_admin_url(); ?>admin.php?page=CT_email_set_&active_tab=tabs_new_user_email_admin">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','ClassifiedTheme'); ?></td>
                    <td><input type="text" size="90" name="ClassifiedTheme_new_user_email_admin_subject" value="<?php echo stripslashes(get_option('ClassifiedTheme_new_user_email_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php ClassifiedTheme_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','ClassifiedTheme'); ?></td>
                    <td><textarea cols="92" rows="10" name="ClassifiedTheme_new_user_email_admin_message"><?php echo stripslashes(get_option('ClassifiedTheme_new_user_email_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','ClassifiedTheme'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"ClassifiedTheme"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","ClassifiedTheme"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','ClassifiedTheme'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","ClassifiedTheme"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'ClassifiedTheme'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="ClassifiedTheme_save_new_user_email_admin" value="<?php _e('Save Options','ClassifiedTheme'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
    
    
    	<?php do_action('ClassifiedTheme_save_emails_contents'); ?>
    
    </div> 
    
    
    <?php	
	
	echo '</div>';
}


function ClassifiedTheme_images_settings()
{
	global $menu_admin_listing_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-img"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">ClassifiedTheme Image Settings</h2>';
	
	$arr = array("yes" => "Yes", "no" => "No");
	
		if(isset($_POST['save1']))
		{
			$ClassifiedTheme_enable_images_in_listings = $_POST['ClassifiedTheme_enable_images_in_listings'];
			update_option('ClassifiedTheme_enable_images_in_listings', $ClassifiedTheme_enable_images_in_listings);
			
			$ClassifiedTheme_charge_fees_for_images = $_POST['ClassifiedTheme_charge_fees_for_images'];
			update_option('ClassifiedTheme_charge_fees_for_images', $ClassifiedTheme_charge_fees_for_images);
			
			$ClassifiedTheme_enable_max_images_limit = $_POST['ClassifiedTheme_enable_max_images_limit'];
			update_option('ClassifiedTheme_enable_max_images_limit', $ClassifiedTheme_enable_max_images_limit);
			
			//--------------------------------------
			
			update_option('ClassifiedTheme_nr_of_free_images', trim($_POST['ClassifiedTheme_nr_of_free_images']));
			update_option('ClassifiedTheme_extra_image_charge', trim($_POST['ClassifiedTheme_extra_image_charge']));
			update_option('ClassifiedTheme_nr_max_of_images', trim($_POST['ClassifiedTheme_nr_max_of_images']));
			
			
			
			echo '<div class="saved_thing">Settings saved!</div>';	
		}
		
		if(isset($_POST['save2']))
		{
			update_option('ClassifiedTheme_width_of_listing_images', trim($_POST['ClassifiedTheme_width_of_listing_images']));	
			
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
        <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_enable_max_images_limit'); ?></td>
        </tr>
        
         <tr>
        <td>Max limit of images:</td>
        <td><input type="text" value="<?php echo get_option('ClassifiedTheme_nr_max_of_images'); ?>" size="4" name="ClassifiedTheme_nr_max_of_images" /></td>
        </tr>
        
        
        <tr>
        <td width="190">Enable Images:</td>
        <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_enable_images_in_listings'); ?></td>
        </tr>
        
        
        <tr>
        <td>Charge fees for images:</td>
        <td><?php echo ClassifiedTheme_get_option_drop_down($arr, 'ClassifiedTheme_charge_fees_for_images'); ?></td>
        </tr>
        
        
        <tr>
        <td>Number of free images:</td>
        <td><input type="text" value="<?php echo get_option('ClassifiedTheme_nr_of_free_images'); ?>" size="4" name="ClassifiedTheme_nr_of_free_images" /></td>
        </tr>
        
        
        <tr>
        <td>Extra charge(per image):</td>
        <td><input type="text" value="<?php echo get_option('ClassifiedTheme_extra_image_charge'); ?>" size="5" name="ClassifiedTheme_extra_image_charge" /> <?php echo ClassifiedTheme_get_currency(); ?></td>
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
        <td><input type="text" value="<?php echo get_option('ClassifiedTheme_width_of_listing_images'); ?>" size="4" name="ClassifiedTheme_width_of_listing_images" /> pixels</td>
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


?>