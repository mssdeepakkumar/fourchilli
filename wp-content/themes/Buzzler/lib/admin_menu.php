<?php
/****************************************************************************************
*
*	DirectoryMarket - WP Business Directory Theme - v1.0
*	SiteMile.com - author: andreisaioc
*	Author email: andreisaioc[at]gmail.com
*	Link: http://sitemile.com/products/directorymarket-wordpress-business-directory-theme/
*
*****************************************************************************************/


function Buzzler_theme_bullet($rn = '')
{
	global $menu_admin_Buzzler_theme_bull;
	$menu_admin_Buzzler_theme_bull = '<a href="#" class="tltp_cls" title="'.$rn.'"><img src="'.get_bloginfo('template_url') . '/images/qu_icon.png" /></a>';	
	echo $menu_admin_Buzzler_theme_bull;
	
}

function Buzzler_disp_spcl_cst_pic($pic)
{
	return '<img src="'.get_bloginfo('template_url').'/images/'.$pic.'" /> ';	
}

function buzzler_admin_main_menu_scr()
{
	 $icn = get_bloginfo('template_url').'/images/listing_icon.gif';
	 $capability = 10;
	 
add_menu_page(__('Buzzler'), __('Buzzler','Buzzler'), $capability,"bz_menu_", 'Buzzler_site_summary', $icn, 0);
add_submenu_page("bz_menu_", __('Site Summary','Buzzler'), Buzzler_disp_spcl_cst_pic('overview_icon.png').__('Site Summary','Buzzler'),$capability, "bz_menu_", 'Buzzler_site_summary');
add_submenu_page("bz_menu_", __('General Options','Buzzler'), Buzzler_disp_spcl_cst_pic('setup_icon.png').__('General Options','Buzzler'),$capability, "general-options", 'Buzzler_general_options');
add_submenu_page("bz_menu_", __('Email Settings','Buzzler'), Buzzler_disp_spcl_cst_pic('email_icon.png').__('Email Settings','Buzzler'),$capability, 'BZ_email_set_', 'Buzzler_email_settings');
add_submenu_page("bz_menu_", __('Pricing Settings','Buzzler'), Buzzler_disp_spcl_cst_pic('dollar_icon.png').__('Pricing Settings','Buzzler'),$capability, 'BZ_pr_set_', 'Buzzler_pricing_options');
add_submenu_page("bz_menu_", __('Custom Pricing','Buzzler'), Buzzler_disp_spcl_cst_pic('penny_icon.png').__('Custom Pricing','Buzzler'),$capability, 'BZ_cust_pricing_', 'Buzzler_cust_pricing');
add_submenu_page("bz_menu_", __('Custom Fields','Buzzler'), Buzzler_disp_spcl_cst_pic('input_icon.png').__('Custom Fields','Buzzler'),$capability, 'custom-fields', 'Buzzler_custom_fields');
add_submenu_page("bz_menu_", __('Images Options','Buzzler'), Buzzler_disp_spcl_cst_pic('image_icon.png').__('Images Options','Buzzler'),$capability, 'BZ_img_sett_', 'Buzzler_images_settings');
add_submenu_page("bz_menu_", __('Payment Gateways','Buzzler'),Buzzler_disp_spcl_cst_pic('gateway_icon.png'). __('Payment Gateways','Buzzler'),$capability, 'BZ_pay_gate_', 'Buzzler_payment_gateways');

add_submenu_page("bz_menu_", __('Layout Settings','Buzzler'), Buzzler_disp_spcl_cst_pic('layout_icon.png').__('Layout Settings','Buzzler'),$capability, 'BZ_layout_', 'Buzzler_layout_settings');
add_submenu_page("bz_menu_", __('Advertising','Buzzler'), Buzzler_disp_spcl_cst_pic('adv_icon.png').__('Advertising','Buzzler'),$capability, 'BZ_adv_', 'Buzzler_advertising_scr');
add_submenu_page("bz_menu_", __('Claims','Buzzler'), Buzzler_disp_spcl_cst_pic('email_icon.png').__('Claims','Buzzler'),$capability, 'BZ_claims_set_', 'Buzzler_claims_settings');
//add_submenu_page("bz_menu_", __('Import Tools','Buzzler'), Buzzler_disp_spcl_cst_pic('sheet_icon.png').__('Import Tools','Buzzler'),$capability, 'BZ_import_tls_', 'Buzzler_import_tools_panel');
add_submenu_page("bz_menu_", __('Tracking Tools','Buzzler'), Buzzler_disp_spcl_cst_pic('track_icon.png').__('Tracking Tools','Buzzler'),$capability, 'BZ_trck_', 'Buzzler_tracking_tools_panel');
add_submenu_page("bz_menu_", __('Info Stuff','Buzzler'), Buzzler_disp_spcl_cst_pic('info_icon.png').__('Info Stuff','Buzzler'),$capability, 'BZ_info_stuff', 'Buzzler_info');
  
  do_action('Buzzler_add_new_menu_item_admin');
  
}


function Buzzler_cust_pricing()
{
	global $menu_admin_listing_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-custpricing"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Buzzler Custom Pricing</h2>';
	
	$arr = array("yes" => "Yes", "no" => "No");
	         
	if(isset($_POST['my_submit']))
	{
		$Buzzler_enable_custom_posting 		= trim($_POST['Buzzler_enable_custom_posting']);
		update_option('Buzzler_enable_custom_posting', $Buzzler_enable_custom_posting);
			
		//---------------
		
		$customs = $_POST['customs'];
		for($i=0;$i<count($customs);$i++)
		{
			$ids = $customs[$i];
			$val =trim( $_POST['Buzzler_theme_custom_cat_'.$ids]);
			update_option('Buzzler_theme_custom_cat_'.$ids,$val);			
			
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
        <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_enable_custom_posting'); ?></td>
        </tr>
        
                

        
        <?php echo Buzzler_clear_table(2); ?>
        
         <tr>
        <td width="220" ><strong>Set Fees for each Category:</strong></td>
        <td></td>
        </tr>
        <?php echo Buzzler_clear_table(2); ?>
        
        <?php
		  
		  $categories =  get_categories('taxonomy=listing_cat&hide_empty=0&orderby=name');
		  //$blg = get_option('listing_theme_blog_category');
		
		if(count($categories) == 0)
		{
			?>
            
              <tr>
        
        <td colspan="2"> You need to add some listing categories first.</td>
        </tr>
            
            <?php
		}
		else
		{
			
		  foreach ($categories as $category) 
		  {
			if(1) //$category->cat_name != "Uncategorized" && $category->cat_ID != $blg )
			{
				echo '<tr>';
				echo '<td>'.$category->cat_name.'</td>';
				echo '<td><input type="text" size="6" value="'.get_option('Buzzler_theme_custom_cat_'.$category->cat_ID).'" 
				name="Buzzler_theme_custom_cat_'.$category->cat_ID.'" /> '.Buzzler_currency().'
				<input type="hidden" name="customs[]" value="'.$category->cat_ID.'" />
				</td>';
	
				echo '</tr>';
			}
		  
		  }
		
		}
		?>
          <?php echo Buzzler_clear_table(2); ?>
        
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


function Buzzler_email_settings()
{
	$id_icon 		= 'icon-options-general-email';
	$ttl_of_stuff 	= 'Buzzler - '.__('Email Settings','Buzzler');
	global $menu_admin_Buzzler_theme_bull;
	$arr = array( "yes" => 'Yes', "no" => "No");
	
	
		
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------------------------------------------------------
	
	if(isset($_POST['Buzzler_save1']))
	{
		update_option('Buzzler_email_name_from', 	trim($_POST['Buzzler_email_name_from']));
		update_option('Buzzler_email_addr_from', 	trim($_POST['Buzzler_email_addr_from']));
		update_option('Buzzler_allow_html_emails', trim($_POST['Buzzler_allow_html_emails']));

		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save2']))
	{
		update_option('Buzzler_new_user_email_subject', 	trim($_POST['Buzzler_new_user_email_subject']));
		update_option('Buzzler_new_user_email_message', 	trim($_POST['Buzzler_new_user_email_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save_new_user_email_admin']))
	{
		update_option('Buzzler_new_user_email_admin_subject', 	trim($_POST['Buzzler_new_user_email_admin_subject']));
		update_option('Buzzler_new_user_email_admin_message', 	trim($_POST['Buzzler_new_user_email_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_email_claim_listing_save']))
	{
		update_option('Buzzler_email_claim_listing_save', 	trim($_POST['Buzzler_email_claim_listing_save']));
		update_option('Buzzler_email_claim_listing_message', 	trim($_POST['Buzzler_email_claim_listing_message']));
		update_option('Buzzler_email_claim_listing_subject', 	trim($_POST['Buzzler_email_claim_listing_subject']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save3']))
	{
		update_option('Buzzler_new_item_email_not_approve_admin_enable', 	trim($_POST['Buzzler_new_item_email_not_approve_admin_enable']));
		update_option('Buzzler_new_item_email_not_approve_admin_subject', 	trim($_POST['Buzzler_new_item_email_not_approve_admin_subject']));
		update_option('Buzzler_new_item_email_not_approve_admin_message', 	trim($_POST['Buzzler_new_item_email_not_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save31']))
	{
		update_option('Buzzler_new_item_email_approve_admin_enable', 	trim($_POST['Buzzler_new_item_email_approve_admin_enable']));
		update_option('Buzzler_new_item_email_approve_admin_subject', 	trim($_POST['Buzzler_new_item_email_approve_admin_subject']));
		update_option('Buzzler_new_item_email_approve_admin_message', 	trim($_POST['Buzzler_new_item_email_approve_admin_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save32']))
	{
		update_option('Buzzler_new_item_email_not_approved_enable', 	trim($_POST['Buzzler_new_item_email_not_approved_enable']));
		update_option('Buzzler_new_item_email_not_approved_subject', 	trim($_POST['Buzzler_new_item_email_not_approved_subject']));
		update_option('Buzzler_new_item_email_not_approved_message', 	trim($_POST['Buzzler_new_item_email_not_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save33']))
	{
		update_option('Buzzler_new_item_email_approved_enable', 	trim($_POST['Buzzler_new_item_email_approved_enable']));
		update_option('Buzzler_new_item_email_approved_subject', 	trim($_POST['Buzzler_new_item_email_approved_subject']));
		update_option('Buzzler_new_item_email_approved_message', 	trim($_POST['Buzzler_new_item_email_approved_message']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	do_action('Buzzler_save_emails_post');
	
	
	?>
    
	<div id="usual2" class="usual"> 
        <ul> 
            <li><a href="#tabs1"><?php _e('Email Settings','Buzzler'); ?></a></li> 
            <li><a href="#new_user_email"><?php _e('New User Email','Buzzler'); ?></a></li>
            <li><a href="#admin_new_user_email"><?php _e('New User Email (admin)','Buzzler'); ?></a></li>
            
            <li><a href="#post_listing_approved_admin"><?php _e('Post Item (Not Approved) Email (admin)','Buzzler'); ?></a></li>
            <li><a href="#post_listing_not_approved_admin"><?php _e('Post Item (Auto Approved) Email (admin)','Buzzler'); ?></a></li>
            <li><a href="#post_listing_approved"><?php _e('Post Item (Not Approved) Email','Buzzler'); ?></a></li>
            <li><a href="#post_listing_not_approved"><?php _e('Post Item (Auto Approved) Email','Buzzler'); ?></a></li>
            
            <li><a href="#claim_listing_request"><?php _e('Claim Listing Request','Buzzler'); ?></a></li>
            

              
    		
            <?php do_action('Buzzler_save_emails_tabs'); ?>
            
        </ul> 
 
 		        
        <div id="claim_listing_request" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone requests a listing claim. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Buzzler'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=claim_listing_request">
            <table width="100%" class="sitemile-table">
    				
                     
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_email_claim_listing_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Buzzler'); ?></td>
                    <td><input type="text" size="90" name="Buzzler_email_claim_listing_subject" value="<?php echo stripslashes(get_option('Buzzler_email_claim_listing_enable')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Buzzler_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Buzzler'); ?></td>
                    <td><textarea cols="92" rows="10" name="Buzzler_email_claim_listing_message"><?php echo stripslashes(get_option('Buzzler_email_claim_listing_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Buzzler'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('username','Buzzler'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Buzzler'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Buzzler"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Buzzler'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Buzzler'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Buzzler'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Buzzler'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_email_claim_listing_save" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
          
          
            <div id="post_listing_not_approved" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is automatically approved. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Buzzler'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=post_listing_not_approved">
            <table width="100%" class="sitemile-table">
    				
                     
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_new_item_email_approved_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Buzzler'); ?></td>
                    <td><input type="text" size="90" name="Buzzler_new_item_email_approved_subject" value="<?php echo stripslashes(get_option('Buzzler_new_item_email_approved_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Buzzler_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Buzzler'); ?></td>
                    <td><textarea cols="92" rows="10" name="Buzzler_new_item_email_approved_message"><?php echo stripslashes(get_option('Buzzler_new_item_email_approved_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Buzzler'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('username','Buzzler'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Buzzler'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Buzzler"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Buzzler'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Buzzler'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Buzzler'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Buzzler'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save33" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
          
          
        
        <!-- ################################## -->
        
        <div id="post_listing_approved" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by your users after posting a new item on your website if the item is not automatically approved. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Buzzler'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=post_listing_approved">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_new_item_email_not_approved_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Buzzler'); ?></td>
                    <td><input type="text" size="90" name="Buzzler_new_item_email_not_approved_subject" value="<?php echo stripslashes(get_option('Buzzler_new_item_email_not_approved_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Buzzler_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Buzzler'); ?></td>
                    <td><textarea cols="92" rows="10" name="Buzzler_new_item_email_not_approved_message"><?php echo stripslashes(get_option('Buzzler_new_item_email_not_approved_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Buzzler'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('item owner username','Buzzler'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Buzzler'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Buzzler"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Buzzler'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Buzzler'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Buzzler'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Buzzler'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save32" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
        <!-- ############################### -->
        
        
        <div id="post_listing_not_approved_admin" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website to be approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Buzzler'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=post_listing_not_approved_admin">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_new_item_email_approve_admin_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Buzzler'); ?></td>
                    <td><input type="text" size="90" name="Buzzler_new_item_email_approve_admin_subject" value="<?php echo stripslashes(get_option('Buzzler_new_item_email_approve_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Buzzler_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Buzzler'); ?></td>
                    <td><textarea cols="92" rows="10" name="Buzzler_new_item_email_approve_admin_message"><?php echo stripslashes(get_option('Buzzler_new_item_email_approve_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Buzzler'); ?><br/><br/>
                    
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Buzzler'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Buzzler"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Buzzler'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Buzzler'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Buzzler'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new item','Buzzler'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save31" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
 
 		 <div id="post_listing_approved_admin" style="display: none; ">	
          
           <div class="spntxt_bo"><?php _e('This email will be received by the admin when someone posts an item on the website. This email will be received if the the item is automatically approved.
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Buzzler'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=post_listing_approved_admin">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable this email:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_new_item_email_not_approve_admin_enable'); ?></td>
                    </tr>
                    
            	  	<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Buzzler'); ?></td>
                    <td><input type="text" size="90" name="Buzzler_new_item_email_not_approve_admin_subject" value="<?php echo stripslashes(get_option('Buzzler_new_item_email_not_approve_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Buzzler_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Buzzler'); ?></td>
                    <td><textarea cols="92" rows="10" name="Buzzler_new_item_email_not_approve_admin_message"><?php echo stripslashes(get_option('Buzzler_new_item_email_not_approve_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>

                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Buzzler'); ?><br/><br/>
                    
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Buzzler'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Buzzler"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Buzzler'); ?><br/>
                    <strong>##my_account_url##</strong> - <?php _e("your website's my account link",'Buzzler'); ?><br/>
                    <strong>##item_name##</strong> - <?php _e("item's title",'Buzzler'); ?><br/>
                    <strong>##item_link##</strong> - <?php _e('link for the new listing','Buzzler'); ?><br/>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save3" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          	
          </div>
        
 
        <div id="tabs1" style="display: none; ">
        	<form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160">Email From Name:</td>
                    <td><input type="text" size="45" name="Buzzler_email_name_from" value="<?php echo stripslashes(get_option('Buzzler_email_name_from')); ?>"/></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td >Email From Address:</td>
                    <td><input type="text" size="45" name="Buzzler_email_addr_from" value="<?php echo stripslashes(get_option('Buzzler_email_addr_from')); ?>"/></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td >Allow HTML in emails:</td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_allow_html_emails'); ?></td>
                    </tr>
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save1" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
        </div> 
          
        <!-- ################################ -->  
                
        <div id="new_user_email" style="display: none; ">
        	<div class="spntxt_bo"><?php _e('This email will be received by all new users who register on your website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Buzzler'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Buzzler'); ?></td>
                    <td><input type="text" size="90" name="Buzzler_new_user_email_subject" value="<?php echo stripslashes(get_option('Buzzler_new_user_email_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Buzzler_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Buzzler'); ?></td>
                    <td><textarea cols="92" rows="10" name="Buzzler_new_user_email_message"><?php echo stripslashes(get_option('Buzzler_new_user_email_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Buzzler'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e("your new username",'Buzzler'); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email",'Buzzler'); ?><br/>
                    <strong>##user_password##</strong> - <?php _e("your new user's password",'Buzzler'); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Buzzler'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Buzzler"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Buzzler'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save2" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
          
        </div> 
        
        <!-- ################################ -->  
                
        <div id="admin_new_user_email" style="display: none; "> 
        	 <div class="spntxt_bo"><?php _e('This email will be received by the admin when a new user registers on the website. 
          Be aware, if you add html tags to this email you must have the allow HTML tags option set to yes.
          Also at the bottom you can see a list of tags you can use in the email body.','Buzzler'); ?> </div>
          
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_email_set_&active_tab=tabs_new_user_email_admin">
            <table width="100%" class="sitemile-table">
    		
            	  	<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Email Subject:','Buzzler'); ?></td>
                    <td><input type="text" size="90" name="Buzzler_new_user_email_admin_subject" value="<?php echo stripslashes(get_option('Buzzler_new_user_email_admin_subject')); ?>"/></td>
                    </tr>
                    

                    
                    <tr>
                    <td valign=top><?php Buzzler_theme_bullet(); ?></td>
                    <td valign=top ><?php _e('Email Content:','Buzzler'); ?></td>
                    <td><textarea cols="92" rows="10" name="Buzzler_new_user_email_admin_message"><?php echo stripslashes(get_option('Buzzler_new_user_email_admin_message')); ?></textarea></td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td valign=top></td>
                    <td valign=top ></td>
                    <td><div class="spntxt_bo2">
                    <?php _e('Here is a list of tags you can use in this email:','Buzzler'); ?><br/><br/>
                    
                    <strong>##username##</strong> - <?php _e('your new username',"Buzzler"); ?><br/>
                    <strong>##username_email##</strong> - <?php _e("your new user's email","Buzzler"); ?><br/>
                    <strong>##site_login_url##</strong> - <?php _e('the link to your user login page','Buzzler'); ?><br/>
                    <strong>##your_site_name##</strong> - <?php _e("your website's name","Buzzler"); ?><br/>
                    <strong>##your_site_url##</strong> - <?php _e("your website's main address",'Buzzler'); ?>
                    
                    </div></td>
                    </tr>
            		
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save_new_user_email_admin" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>
            </form>
        </div> 
    
    
    	<?php do_action('Buzzler_save_emails_contents'); ?>
    
    </div> 
    
    
    <?php	
	
	echo '</div>';
}


function Buzzler_general_options()
{
	$id_icon 		= 'icon-options-general2';
	$ttl_of_stuff 	= 'Buzzler - '.__('General Settings','Buzzler');
	global $menu_admin_Buzzler_theme_bull;
	$arr = array("yes" => __("Yes",'Buzzler'), "no" => __("No",'Buzzler'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
		if(isset($_POST['Buzzler_save1']))
		{
			update_option('Buzzler_show_views', 				trim($_POST['Buzzler_show_views']));
			update_option('Buzzler_admin_approve_listing', 		trim($_POST['Buzzler_admin_approve_listing']));

			update_option('Buzzler_enable_blog', 				trim($_POST['Buzzler_enable_blog']));
			
			update_option('Buzzler_enable_pay_credits', 				trim($_POST['Buzzler_enable_pay_credits']));
			update_option('Buzzler_max_time_to_wait', 			trim($_POST['Buzzler_max_time_to_wait']));			
			update_option('Buzzler_listing_time_listing',			 	trim($_POST['Buzzler_listing_time_listing']));
			update_option('Buzzler_listing_featured_time_listing', 		trim($_POST['Buzzler_listing_featured_time_listing']));
			update_option('Buzzler_show_limit_job_cnt', 				trim($_POST['Buzzler_show_limit_job_cnt']));
			update_option('Buzzler_listings_per_page_adv_search', 				trim($_POST['Buzzler_listings_per_page_adv_search']));
			
			update_option('Buzzler_location_permalink', 				trim($_POST['Buzzler_location_permalink']));
			update_option('Buzzler_category_permalink', 				trim($_POST['Buzzler_category_permalink']));
			update_option('Buzzler_listing_permalink', 				trim($_POST['Buzzler_listing_permalink']));
			update_option('Buzzler_enable_locations', 					trim($_POST['Buzzler_enable_locations']));
			update_option('Buzzler_show_front_slider', 				trim($_POST['Buzzler_show_front_slider']));
			update_option('Buzzler_show_main_menu', 					trim($_POST['Buzzler_show_main_menu']));
			update_option('Buzzler_show_stretch', 						trim($_POST['Buzzler_show_stretch']));
			update_option('Buzzler_only_admins_post_listings', 						trim($_POST['Buzzler_only_admins_post_listings']));
			
			update_option('Buzzler_ext_time_last', 						trim($_POST['Buzzler_ext_time_last']));
			update_option('Buzzler_ext_time_by', 							trim($_POST['Buzzler_ext_time_by']));
			update_option('Buzzler_last_min_bid_ext', 						trim($_POST['Buzzler_last_min_bid_ext']));
			
			update_option('Buzzler_enable_reverse', 						trim($_POST['Buzzler_enable_reverse']));
			update_option('Buzzler_listing_normal_time_listing', 						trim($_POST['Buzzler_listing_normal_time_listing']));
			update_option('Buzzler_claim_listing_enable', 						trim($_POST['Buzzler_claim_listing_enable']));
			
			
			update_option('Buzzler_limit_for_listings_enable', 						trim($_POST['Buzzler_limit_for_listings_enable']));
			update_option('Buzzler_max_nr_of_listings', 						trim($_POST['Buzzler_max_nr_of_listings']));
			update_option('Buzzler_big_main_menu_enable', 						trim($_POST['Buzzler_big_main_menu_enable']));
			update_option('Buzzler_contact_owner_enable', 						trim($_POST['Buzzler_contact_owner_enable']));
			
			
			
			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		if(isset($_POST['Buzzler_save2']))
		{
			update_option('Buzzler_filter_emails_private_messages', 				trim($_POST['Buzzler_filter_emails_private_messages']));
			update_option('Buzzler_filter_urls_private_messages', 					trim($_POST['Buzzler_filter_urls_private_messages']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		if(isset($_POST['Buzzler_save3']))
		{
			update_option('Buzzler_enable_shipping', 						trim($_POST['Buzzler_enable_shipping']));
			update_option('Buzzler_enable_flat_shipping', 					trim($_POST['Buzzler_enable_flat_shipping']));
			update_option('Buzzler_enable_location_based_shipping', 		trim($_POST['Buzzler_enable_location_based_shipping']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		

		
		if(isset($_POST['Buzzler_save4']))
		{
			update_option('Buzzler_enable_facebook_login', 	trim($_POST['Buzzler_enable_facebook_login']));
			update_option('Buzzler_facebook_app_id', 			trim($_POST['Buzzler_facebook_app_id']));
			update_option('Buzzler_facebook_app_secret', 		trim($_POST['Buzzler_facebook_app_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		
		if(isset($_POST['Buzzler_save5']))
		{
			update_option('Buzzler_enable_twitter_login', 			trim($_POST['Buzzler_enable_twitter_login']));
			update_option('Buzzler_twitter_consumer_key', 			trim($_POST['Buzzler_twitter_consumer_key']));
			update_option('Buzzler_twitter_consumer_secret', 		trim($_POST['Buzzler_twitter_consumer_secret']));

			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		do_action('Buzzler_general_options_actions');
	
	?>
    
		  <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Settings','Buzzler'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Facebook Connect','Buzzler'); ?></a></li>
            <li><a href="#tabs5"><?php _e('Twitter Connect','Buzzler'); ?></a></li> 
          	<?php do_action('Buzzler_general_options_tabs'); ?>
          </ul> 
          <div id="tabs1" >	
          
          			
            <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet('Enable the contact form in single listing page.'); ?></td>
                    <td ><?php _e('Enable contact owner button:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_contact_owner_enable'); ?></td>
                    </tr>
                    
                    
  					 <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable limit for listings:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_limit_for_listings_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Limit Listings To:','Buzzler'); ?></td>
                    <td><input type="text" size="4" name="Buzzler_max_nr_of_listings" value="<?php echo get_option('Buzzler_max_nr_of_listings'); ?>"/> maximum listings</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22">&nbsp;</td>
                    <td >&nbsp;</td>
                    <td>&nbsp;</td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable big main menu:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_big_main_menu_enable'); ?></td>
                    </tr>
                    
                    
  					 <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Enable claim listing:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_claim_listing_enable'); ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Show views in each listing page:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_show_views'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Admin approves each listing:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_admin_approve_listing'); ?></td>
                    </tr>
                    
                    
					<tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Frontpage Slider:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_show_front_slider'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Main Menu:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_show_main_menu'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Stretch Area:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_show_stretch'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Blog:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_enable_blog'); ?></td>
                    </tr>
                    
 
                    
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Enable Locations:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_enable_locations'); ?></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="240"><?php _e('Only admin will post listings:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_only_admins_post_listings'); ?></td>
                    </tr>

				
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Normal listing max period:','Buzzler'); ?></td>
                    <td><input type="text" size="6" name="Buzzler_listing_normal_time_listing" value="<?php echo get_option('Buzzler_listing_normal_time_listing'); ?>"/> days</td>
                    </tr>
        
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Featured listing max period:','Buzzler'); ?></td>
                    <td><input type="text" size="6" name="Buzzler_listing_featured_time_listing" value="<?php echo get_option('Buzzler_listing_featured_time_listing'); ?>"/> days</td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('listings per page in Advanced Search:','Buzzler'); ?></td>
                    <td><input type="text" size="6" name="Buzzler_listings_per_page_adv_search" value="<?php echo get_option('Buzzler_listings_per_page_adv_search'); ?>"/></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for listing Permalink:','Buzzler'); ?></td>
                    <td><input type="text" size="30" name="Buzzler_listing_permalink" value="<?php echo get_option('Buzzler_listing_permalink'); ?>"/> *if left empty will show 'listings'</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Location Permalink:','Buzzler'); ?></td>
                    <td><input type="text" size="30" name="Buzzler_location_permalink" value="<?php echo get_option('Buzzler_location_permalink'); ?>"/> *if left empty will show 'location'</td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Slug for Category Permalink:','Buzzler'); ?></td>
                    <td><input type="text" size="30" name="Buzzler_category_permalink" value="<?php echo get_option('Buzzler_category_permalink'); ?>"/> *if left empty will show 'section'</td>
                    </tr>
                    
        
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save1" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                    
          
          </div>
          
          

          <div id="tabs4">	
          For this install the plugin called: <a target="_blank" href="http://wordpress.org/plugins/wordpress-social-login/">WordPress Social Login</a>
          
          </div>
           
          <div id="tabs5">	
        	For this install the plugin called: <a target="_blank" href="http://wordpress.org/plugins/wordpress-social-login/">WordPress Social Login</a>
          </div>
    		
          <?php do_action('Buzzler_general_options_div_content'); ?>  

<?php
	echo '</div>';	
	
}

function Buzzler_tracking_tools_panel()
{
	$id_icon 		= 'icon-options-general-track';
	$ttl_of_stuff 	= 'Buzzler - '.__('Tracking Tools','Buzzler');
	$arr = array("yes" => __("Yes",'Buzzler'), "no" => __("No",'Buzzler'));
	global $menu_admin_Buzzler_theme_bull;
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['Buzzler_save1']))
		{
			update_option('Buzzler_enable_google_analytics', 				trim($_POST['Buzzler_enable_google_analytics']));
			update_option('Buzzler_analytics_code', 						trim($_POST['Buzzler_analytics_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
	if(isset($_POST['Buzzler_save2']))
		{
			update_option('Buzzler_enable_other_tracking', 				trim($_POST['Buzzler_enable_other_tracking']));
			update_option('Buzzler_other_tracking_code', 						trim($_POST['Buzzler_other_tracking_code']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
			

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Google Analytics','Buzzler'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Other Tracking Tools','Buzzler'); ?></a></li> 
          </ul> 
          <div id="tabs1">
          
          		
                 <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Google Analytics:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_enable_google_analytics'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Analytics Code:','Buzzler'); ?></td>
                    <td><textarea rows="6" cols="80" name="Buzzler_analytics_code"><?php echo stripslashes(get_option('Buzzler_analytics_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save1" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          	
          </div>
          
          <div id="tabs2">	
          
             <form method="post" action="">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="250"><?php _e('Enable Other Tracking:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_enable_other_tracking'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td valign="top"><?php _e('Other Tracking Code:','Buzzler'); ?></td>
                    <td><textarea rows="6" cols="80" name="Buzzler_other_tracking_code"><?php echo stripslashes(get_option('Buzzler_other_tracking_code')); ?></textarea></td>
                    </tr>
                    
             
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save2" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
                
          
          </div>
    

<?php
	echo '</div>';		
	
}

function Buzzler_claims_settings()
{
		$id_icon 		= 'icon-options-general-email';
	$ttl_of_stuff 	= 'Buzzler - '.__('Claims on Listings','Buzzler');
	global $menu_admin_Buzzler_theme_bull;
	global $wpdb;
		
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	
	if(isset($_GET['appr']))
	{
		$ids = $_GET['appr'];
		$s = "select * from ".$wpdb->prefix."buzzler_claims where id='$ids'";
		$r = $wpdb->get_results($s);
		$row = $r[0];
		
		$wpdb->query("update ".$wpdb->prefix."buzzler_claims set my_status='1' where id='$ids'");	
		
		 $my_post = array();
		 $my_post['ID'] = $row->pid;
		 $my_post['post_author'] = $row->uid;
		 wp_update_post( $my_post );
		
		update_post_meta($row->pid,'claimed','1');
		
		echo '<div class="saved_thing">'.__('Claim Approved!','Buzzler').'</div>';	
		
	}
	
	if(isset($_GET['rej']))
	{
		$ids = $_GET['appr'];
		$s = "select * from ".$wpdb->prefix."buzzler_claims where id='$ids'";
		$r = $wpdb->get_results($s);
		$row = $r[0];
		
		$wpdb->query("update ".$wpdb->prefix."buzzler_claims set my_status='2' where id='$ids'");			
		echo '<div class="saved_thing">'.__('Claim Rejected!','Buzzler').'</div>';	
		
	}
	
	?>
	
    		<div id="usual2" class="usual"> 
        <ul> 
            <li><a href="#tabs1"><?php _e('Unsolved Claims','Buzzler'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Solved Claims','Buzzler'); ?></a></li>
		</ul>
        
        
        <div id="tabs1">
        <?php
		
		
		
		$s = "select * from ".$wpdb->prefix."buzzler_claims where my_status='0'";
		$r = $wpdb->get_results($s);
		
		if(count($r) == 0)
		echo 'There are no unsolved claims.';
		else
		{
			
		?>
        
        
        	<table class="widefat post fixed">
				<thead> <tr>
					<th>Listing Title</th>
					<th>User Claimed</th>
                    <th>Name</th>
					<th>Phone</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Date</th>
					<th>Options</th>
				</tr>
				</thead> <tbody>
                
                <?php
				
				foreach($r as $row)
				{
					$pst 	= get_post($row->pid);
					$user 	= get_userdata($row->uid);
					
					echo '<tr>';
						echo '<td><a href="'.get_permalink($row->pid).'">'.$pst->post_title.'</a></td>';
						echo '<td>'.$user->user_login.'</td>';
						echo '<td>'.$row->your_name.'</td>';
						echo '<td>'.$row->your_phone.'</td>';
						echo '<td>'.$user->user_email.'</td>';
						echo '<td>'.$row->description.'</td>';
						echo '<td>'.date_i18n('d-m-Y H:i:s', $row->datemade).'</td>';
						echo '<td><a href="'.get_admin_url().'admin.php?page=BZ_claims_set_&appr='.$row->id.'">Approve Claim</a> | 
						<a href="'.get_admin_url().'admin.php?page=BZ_claims_set_&rej='.$row->id.'">Reject Claim</a></td>';
						
					echo '</tr>';
				
				}
				
				?>
                
                </tbody>
                </table>
        
        
        <?php } ?>
        </div>
        
        
        
         <div id="tabs2" style="display:none">
        
         <?php
		
		
		
		$s = "select * from ".$wpdb->prefix."buzzler_claims where my_status!='0'";
		$r = $wpdb->get_results($s);
		
		if(count($r) == 0)
		echo 'There are no solved claims.';
		else
		{
			
		?>
        
        
        	<table class="widefat post fixed">
				<thead> <tr>
					<th>Listing Title</th>
					<th>User Claimed</th>
                    <th>Name</th>
					<th>Phone</th>
                    <th>Email</th>
                    <th>Description</th>
                    <th>Date</th>
					<th>Status</th>
				</tr>
				</thead> <tbody>
                
                <?php
				
				foreach($r as $row)
				{
					$pst 	= get_post($row->pid);
					$user 	= get_userdata($row->uid);
					
					echo '<tr>';
						echo '<td><a href="'.get_permalink($row->pid).'">'.$pst->post_title.'</a></td>';
						echo '<td>'.$user->user_login.'</td>';
						echo '<td>'.$row->your_name.'</td>';
						echo '<td>'.$row->your_phone.'</td>';
						echo '<td>'.$user->user_email.'</td>';
						echo '<td>'.$row->description.'</td>';
						echo '<td>'.date_i18n('d-m-Y H:i:s', $row->datemade).'</td>';
						echo '<td>'.($row->my_status == 1 ? 'Approved' : 'Rejected').'</td>';
						
					echo '</tr>';
				
				}
				
				?>
                
                </tbody>
                </table>
        
        
        <?php } ?> 
        </div>
    
	
	<?php
	echo '</div>';	
	
}

function Buzzler_advertising_scr()
{
 
	$id_icon 		= 'icon-options-general-adve';
	$ttl_of_stuff 	= 'Buzzler - '.__('Advertising Spaces','Buzzler');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	if(isset($_POST['Buzzler_save1']))
	{
		update_option('Buzzler_adv_code_home_above_content', 				trim($_POST['Buzzler_adv_code_home_above_content']));
		update_option('Buzzler_adv_code_home_below_content', 				trim($_POST['Buzzler_adv_code_home_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
	}
	
	if(isset($_POST['Buzzler_save2']))
	{
		update_option('Buzzler_adv_code_listing_page_above_content', 				trim($_POST['Buzzler_adv_code_listing_page_above_content']));
		update_option('Buzzler_adv_code_listing_page_below_content', 				trim($_POST['Buzzler_adv_code_listing_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
	}
	
	if(isset($_POST['Buzzler_save3']))
	{
		update_option('Buzzler_adv_code_cat_page_above_content', 				trim($_POST['Buzzler_adv_code_cat_page_above_content']));
		update_option('Buzzler_adv_code_cat_page_below_content', 				trim($_POST['Buzzler_adv_code_cat_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
	}
	
	if(isset($_POST['Buzzler_save4']))
	{
		update_option('Buzzler_adv_code_single_page_above_content', 				trim($_POST['Buzzler_adv_code_single_page_above_content']));
		update_option('Buzzler_adv_code_single_page_below_content', 				trim($_POST['Buzzler_adv_code_single_page_below_content']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
	}

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','Buzzler'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Listing Page','Buzzler'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Category Page','Buzzler'); ?></a></li> 
            <li><a href="#tabs4"><?php _e('Single Blog/Normal Page','Buzzler'); ?></a></li> 
          </ul> 
          <div id="tabs1">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_adv_&active_tab=tabs1">
          	  <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_home_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_home_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_home_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_home_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save1" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>  
                    
              </table>      
          </form>
          
          </div>
          
          <div id="tabs2">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_adv_&active_tab=tabs2">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_listing_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_listing_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_listing_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_listing_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save2" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>  
                    
              </table>  
          </form>
          </div>
          
          <div id="tabs3">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_adv_&active_tab=tabs3">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_cat_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_cat_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_cat_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_cat_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save3" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div> 
          
          <div id="tabs4">	
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_adv_&active_tab=tabs4">
          <table width="100%" class="sitemile-table">
    			<tr>
                <td valign="top"><?php _e('Above the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_single_page_above_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_single_page_above_content')); ?></textarea></td>
                </tr>
                
                
                <tr>
                <td valign="top"><?php _e('Below the content area:','Buzzler'); ?></td>
                <td><textarea name="Buzzler_adv_code_single_page_below_content" rows="6" cols="60"><?php echo stripslashes(get_option('Buzzler_adv_code_single_page_below_content')); ?></textarea></td>
                </tr>	
                    
                  
                <tr>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save4" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>  
                    
              </table>  
          	</form>
          </div>  

<?php 
	echo '</div>';		
	
}

function Buzzler_layout_settings()
{

	$id_icon 		= 'icon-options-general-layout';
	$ttl_of_stuff 	= 'Buzzler - '.__('Layout Settings','Buzzler');
	global $menu_admin_Buzzler_theme_bull;
	
	//------------------------------------------------------
	
	$arr = array("yes" => __("Yes",'Buzzler'), "no" => __("No",'Buzzler'));
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

		if(isset($_POST['Buzzler_save4']))
		{
			update_option('Buzzler_color_for_top_links', 			trim($_POST['Buzzler_color_for_top_links']));
			update_option('Buzzler_color_for_bk', 					trim($_POST['Buzzler_color_for_bk']));
			update_option('Buzzler_color_for_footer', 				trim($_POST['Buzzler_color_for_footer']));
			update_option('Buzzler_color_for_top_links2', 				trim($_POST['Buzzler_color_for_top_links2']));
			
			update_option('Buzzler_color_for_search_bar', 				trim($_POST['Buzzler_color_for_search_bar']));
			update_option('Buzzler_color_for_slider_main', 			trim($_POST['Buzzler_color_for_slider_main']));
			update_option('Buzzler_color_for_text_footer', 			trim($_POST['Buzzler_color_for_text_footer']));
			
			
			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		if(isset($_POST['Buzzler_save1']))
		{
			update_option('Buzzler_home_page_layout', 				trim($_POST['Buzzler_home_page_layout']));	
			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		if(isset($_POST['Buzzler_save2']))
		{
			update_option('Buzzler_logo_URL', 				trim($_POST['Buzzler_logo_URL']));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		if(isset($_POST['Buzzler_save3']))
		{
			update_option('Buzzler_left_side_footer', 				stripslashes(trim($_POST['Buzzler_left_side_footer'])));
			update_option('Buzzler_right_side_footer', 			stripslashes(trim($_POST['Buzzler_right_side_footer'])));
			
			echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';
		}
		
		
		//-----------------------------------------

	$Buzzler_home_page_layout = get_option('Buzzler_home_page_layout');
	if(empty($Buzzler_home_page_layout)) $Buzzler_home_page_layout = "1";
	
?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('HomePage','Buzzler'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('Header','Buzzler'); ?></a></li> 
            <li><a href="#tabs3"><?php _e('Footer','Buzzler'); ?></a></li>
            <li><a href="#tabs4"><?php _e('Change Colors','Buzzler'); ?></a></li> 
          </ul>
           
          <div id="tabs4">
           <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_layout_&active_tab=tabs4">
            <table width="100%" class="sitemile-table">
            
                
        <tr>
        <td width="200"><?php _e('Color for background:','Buzzler'); ?></td>
        <td><input type="text" id="colorpickerField1" name="Buzzler_color_for_bk"  value="<?php echo get_option('Buzzler_color_for_bk'); ?>"/>
				<script>
					jQuery(document).ready(function() {
						
					jQuery('#colorpickerField1, #colorpickerField2, #colorpickerField3, #colorpickerField5, #colorpickerField6, #colorpickerField7, #colorpickerField9').ColorPicker({
							onSubmit: function(hsb, hex, rgb, el) {
								jQuery(el).val(hex);
								jQuery(el).ColorPickerHide();
							},
							onBeforeShow: function () {
								jQuery(this).ColorPickerSetColor(this.value);
							}
						})
						.bind('keyup', function(){
							jQuery(this).ColorPickerSetColor(this.value);
						});
						
						});
					
				</script>

		</td>
        </tr>
        
        
        
        <tr>
        <td width="200"><?php _e('Color for footer:','Buzzler'); ?></td>
        <td><input type="text" id="colorpickerField2" name="Buzzler_color_for_footer" value="<?php echo get_option('Buzzler_color_for_footer'); ?>" />
		</td>
        </tr>
        
        
         <tr>
        <td width="200"><?php _e('Color for text footer:','Buzzler'); ?></td>
        <td><input type="text" id="colorpickerField9" name="Buzzler_color_for_text_footer" value="<?php echo get_option('Buzzler_color_for_text_footer'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for top links:','Buzzler'); ?></td>
        <td><input type="text" id="colorpickerField3" name="Buzzler_color_for_top_links" value="<?php echo get_option('Buzzler_color_for_top_links'); ?>" />
		</td>
        </tr>
        
        <tr>
        <td width="200"><?php _e('Color for top links(hover):','Buzzler'); ?></td>
        <td><input type="text" id="colorpickerField5" name="Buzzler_color_for_top_links2" value="<?php echo get_option('Buzzler_color_for_top_links2'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for search bar:','Buzzler'); ?></td>
        <td><input type="text" id="colorpickerField6" name="Buzzler_color_for_search_bar" value="<?php echo get_option('Buzzler_color_for_search_bar'); ?>" />
		</td>
        </tr>
        
        
        <tr>
        <td width="200"><?php _e('Color for main slider:','Buzzler'); ?></td>
        <td><input type="text" id="colorpickerField7" name="Buzzler_color_for_slider_main" value="<?php echo get_option('Buzzler_color_for_slider_main'); ?>" />
		</td>
        </tr>
            
            
             <tr>
                  
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save4" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>    
                
            
            </table>
            
            </form>
          
          
          </div>
           
          <div id="tabs1">
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_layout_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
				<tr><td valign=top width="22"><?php Buzzler_theme_bullet(__('The layout of the homepage.','Buzzler')); ?></td>
					<td class="ttl"><strong><?php _e("Choose from the home page layouts available:","Buzzler"); ?></strong> </td> <td></td></tr>
            
				<tr>
                <td valign=top width="22"></td>
					<td width="350"><?php _e("Content + Right Sidebar:","Buzzler"); ?> </td>
					<td><input type="radio" name="Buzzler_home_page_layout" value="1" <?php if($Buzzler_home_page_layout == "1") echo 'checked="checked"'; ?> /> 
					 <img src="<?php bloginfo('template_url'); ?>/images/layout1.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Content + Left Sidebar + Right Sidebar:","Buzzler"); ?> </td>
					<td><input type="radio" name="Buzzler_home_page_layout" value="2" <?php if($Buzzler_home_page_layout == "2") echo 'checked="checked"'; ?> /> 
					  <img src="<?php bloginfo('template_url'); ?>/images/layout2.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content + Right Sidebar:","Buzzler"); ?> </td>
					<td><input type="radio" name="Buzzler_home_page_layout" value="3" <?php if($Buzzler_home_page_layout == "3") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout3.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top width="22"></td>
					<td><?php _e("Left Sidebar + Content:","Buzzler"); ?> </td>
					<td><input type="radio" name="Buzzler_home_page_layout" value="4" <?php if($Buzzler_home_page_layout == "4") echo 'checked="checked"'; ?>/>  
					  <img src="<?php bloginfo('template_url'); ?>/images/layout4.jpg" /></td>
                </tr>
                
                
                <tr>
                <td valign=top></td>
					<td><?php _e("Content:","Buzzler"); ?> </td>
					 <td><input type="radio" name="Buzzler_home_page_layout" value="5" <?php if($Buzzler_home_page_layout == "5") echo 'checked="checked"'; ?>/>  
					 <img src="<?php bloginfo('template_url'); ?>/images/layout5.jpg" /></td>
                </tr>
                
                
            
                        
                    <tr>
                   <td valign=top width="22"></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save1" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          	
          </div>
          
          <div id="tabs2">	
          
           <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_layout_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                  
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(__('Eg: http://your-site-url.com/images/logo.jpg','Buzzler')); ?></td>
                    <td ><?php _e('Logo URL:','Buzzler'); ?></td>
                    <td><input type="text" size="45" name="Buzzler_logo_URL" value="<?php echo get_option('Buzzler_logo_URL'); ?>"/></td>
                    </tr>
           
           
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save2" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">	
             <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_layout_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                 
          <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(__('This will appear in the left side of the footer area.','Buzzler')); ?></td>
                    <td valign="top" ><?php _e('Left side footer area content:','Buzzler'); ?></td>
                    <td><textarea cols="65" rows="4" name="Buzzler_left_side_footer"><?php echo stripslashes(get_option('Buzzler_left_side_footer')); ?></textarea></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(__('This will appear in the right side of the footer area.','Buzzler')); ?></td>
                    <td valign="top" ><?php _e('Right side footer area content:','Buzzler'); ?></td>
                    <td><textarea cols="65" rows="4" name="Buzzler_right_side_footer"><?php echo stripslashes(get_option('Buzzler_right_side_footer')); ?></textarea></td>
                    </tr>
          
          
             <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save3" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
    

<?php
	echo '</div>';		
}

function Buzzler_images_settings()
{
	global $menu_admin_listing_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-img"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Buzzler Image Settings</h2>';
	
	$arr = array("yes" => "Yes", "no" => "No");
	
		if(isset($_POST['save1']))
		{
			$Buzzler_enable_images_in_listings = $_POST['Buzzler_enable_images_in_listings'];
			update_option('Buzzler_enable_images_in_listings', $Buzzler_enable_images_in_listings);
			
			$Buzzler_charge_fees_for_images = $_POST['Buzzler_charge_fees_for_images'];
			update_option('Buzzler_charge_fees_for_images', $Buzzler_charge_fees_for_images);
			
			$Buzzler_enable_max_images_limit = $_POST['Buzzler_enable_max_images_limit'];
			update_option('Buzzler_enable_max_images_limit', $Buzzler_enable_max_images_limit);
			
			//--------------------------------------
			
			update_option('Buzzler_nr_of_free_images', trim($_POST['Buzzler_nr_of_free_images']));
			update_option('Buzzler_extra_image_charge', trim($_POST['Buzzler_extra_image_charge']));
			update_option('Buzzler_nr_max_of_images', trim($_POST['Buzzler_nr_max_of_images']));
			
			
			
			echo '<div class="saved_thing">Settings saved!</div>';	
		}
		
		if(isset($_POST['save2']))
		{
			update_option('Buzzler_width_of_listing_images', trim($_POST['Buzzler_width_of_listing_images']));	
			
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
        <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_enable_max_images_limit'); ?></td>
        </tr>
        
         <tr>
        <td>Max limit of images:</td>
        <td><input type="text" value="<?php echo get_option('Buzzler_nr_max_of_images'); ?>" size="4" name="Buzzler_nr_max_of_images" /></td>
        </tr>
        
        
        <tr>
        <td width="190">Enable Images:</td>
        <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_enable_images_in_listings'); ?></td>
        </tr>
        
        
        <tr>
        <td>Charge fees for images:</td>
        <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_charge_fees_for_images'); ?></td>
        </tr>
        
        
        <tr>
        <td>Number of free images:</td>
        <td><input type="text" value="<?php echo get_option('Buzzler_nr_of_free_images'); ?>" size="4" name="Buzzler_nr_of_free_images" /></td>
        </tr>
        
        
        <tr>
        <td>Extra charge(per image):</td>
        <td><input type="text" value="<?php echo get_option('Buzzler_extra_image_charge'); ?>" size="5" name="Buzzler_extra_image_charge" /> <?php echo buzzler_get_currency(); ?></td>
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
        <td><input type="text" value="<?php echo get_option('Buzzler_width_of_listing_images'); ?>" size="4" name="Buzzler_width_of_listing_images" /> pixels</td>
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


function Buzzler_payment_gateways()
{
	
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'Buzzler - Payment Methods';
	global $menu_admin_Buzzler_theme_bull;
	$arr = array("yes" => __("Yes",'Buzzler'), "no" => __("No",'Buzzler'));
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	
	
	//--------------------------
	
	do_action('Buzzler_payment_methods_action');
	if(isset($_POST['Buzzler_save1']))
	{
		update_option('Buzzler_paypal_enable', 		trim($_POST['Buzzler_paypal_enable']));
		update_option('Buzzler_paypal_email', 			trim($_POST['Buzzler_paypal_email']));
		update_option('Buzzler_paypal_enable_sdbx', 	trim($_POST['Buzzler_paypal_enable_sdbx']));
		

		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save2']))
	{
		update_option('Buzzler_alertpay_enable', trim($_POST['Buzzler_alertpay_enable']));
		update_option('Buzzler_alertpay_email', trim($_POST['Buzzler_alertpay_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save3']))
	{
		update_option('Buzzler_moneybookers_enable', trim($_POST['Buzzler_moneybookers_enable']));
		update_option('Buzzler_moneybookers_email', trim($_POST['Buzzler_moneybookers_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	if(isset($_POST['Buzzler_save4']))
	{
		update_option('Buzzler_ideal_enable', trim($_POST['Buzzler_ideal_enable']));
		update_option('Buzzler_ideal_email', trim($_POST['Buzzler_ideal_email']));
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';		
	}
	
	?>


	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" <?php if($_GET['active_tab'] == "tabs1") echo 'class="selected"'; ?>>PayPal</a></li> 
            <li><a href="#tabs2" <?php if($_GET['active_tab'] == "tabs2") echo 'class="selected"'; ?>>Payza/AlertPay</a></li> 
            <li><a href="#tabs3" <?php if($_GET['active_tab'] == "tabs3") echo 'class="selected"'; ?>>Moneybookers/Skrill</a></li> 
            
    
            <?php do_action('Buzzler_payment_methods_tabs'); ?>
             
          </ul> 
          <div id="tabs1"  >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_pay_gate_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_paypal_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="200"><?php _e('PayPal Enable Sandbox:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_paypal_enable_sdbx'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('PayPal Email Address:','Buzzler'); ?></td>
                    <td><input type="text" size="45" name="Buzzler_paypal_email" value="<?php echo get_option('Buzzler_paypal_email'); ?>"/></td>
                    </tr>
                    
                    
              
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save1" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs2" >	
          
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_pay_gate_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_alertpay_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Payza/Alertpay Email:','Buzzler'); ?></td>
                    <td><input type="text" size="45" name="Buzzler_alertpay_email" value="<?php echo get_option('Buzzler_alertpay_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save2" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>

            
            </table>      
          	</form>
          
          </div>
          
          <div id="tabs3">
          <form method="post" action="<?php bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_pay_gate_&active_tab=tabs3">
            <table width="100%" class="sitemile-table">
    				
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="200"><?php _e('Enable:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr, 'Buzzler_moneybookers_enable'); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('MoneyBookers Email:','Buzzler'); ?></td>
                    <td><input type="text" size="45" name="Buzzler_moneybookers_email" value="<?php echo get_option('Buzzler_moneybookers_email'); ?>"/></td>
                    </tr>
                    
  
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save3" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          		
          </div> 
        
          <?php do_action('Buzzler_payment_methods_content_divs'); ?>

<?php
	echo '</div>';	
  	
	
}

function Buzzler_custom_fields()
{
	
global $menu_admin_item_theme_bull, $wpdb;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-custfields"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Buzzler Custom Fields</h2>';
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
			$ss = "insert into ".$wpdb->prefix."buzzler_custom_fields (name,tp,ordr,cate) 
														values('$field_name','$field_type','$field_order','$field_category')";
			$wpdb->query($ss);
			
			//----------------------------
			
			$ss = "select id from ".$wpdb->prefix."buzzler_custom_fields where name='$field_name' AND tp='$field_type'";
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
								$wpdb->query("insert into ".$wpdb->prefix."buzzler_custom_relations (custid,catid) values('$custid','$field_category')");
								
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
						$wpdb->query("delete from ".$wpdb->prefix."buzzler_custom_relations where custid='$custid'"); 
						
						if($field_category != 'all')
						{
							
							for($i=0;$i<count($_POST['field_cats']);$i++)
								if(isset($_POST['field_cats'][$i]))
									{
										$field_category = $_POST['field_cats'][$i];
										$wpdb->query("insert into ".$wpdb->prefix."buzzler_custom_relations (custid,catid) values('$custid','$field_category')");	
									}
							
							if(empty($field_category)) $field_category = 'all';
						}
						else
							$field_category = 'all';
							
						//-------------------------------
						
						$ss = "update ".$wpdb->prefix."buzzler_custom_fields set name='$field_name',ordr='$field_order',cate='$field_category' where id='$custid'";
						$wpdb->query($ss);
						
						echo '<div class="saved_thing">Custom field saved!</div>';
					}
				}
		
		
		
		
		$s = "select * from ".$wpdb->prefix."buzzler_custom_fields where id='$custid'";
		$row = $wpdb->get_results($s);
		
		$row = $row[0];
	}	
		


	if(isset($_GET['delete_field']))
	{
		$delid = $_GET['delete_field'];
		$s = "select name from ".$wpdb->prefix."buzzler_custom_fields where id='$delid'";
		$row = $wpdb->get_results($s);
		$row = $row[0];
		
		if(isset($_GET['coo']))
		{
			$s = "delete from ".$wpdb->prefix."buzzler_custom_fields where id='$delid'";
			$r = $wpdb->query($s);
			
			echo '<div class="delete_thing">Field "'.$row->name.'" has been deleted! </div>';
			
		}
		else
		{
			
			echo '<div class="delete_thing"><div class="padd10">Are you sure you want to delete "'.$row->name.'" ? &nbsp; 
			<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=custom-fields&delete_field='.$delid.'&coo=y">Yes</a> | 
			<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=custom-fields">No</a> </div></div>';
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
    <td><?php echo Buzzler_get_field_tp($row->tp); ?></td>
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
				
				
			 $categories =  get_categories('taxonomy=listing_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category) 
				{
					
					if(buzzler_search_into($custid,$category->cat_ID) == 1) $chk = ' checked="checked" ';
						else $chk = "";
					echo '
					    <tr>
						<td><input '.$chk.' type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';
						
					$subcategories =  get_categories('taxonomy=listing_cat&hide_empty=0&orderby=name&parent='.$category->term_id);
						
					if($subcategories)	
					foreach ($subcategories as $subcategory) 
					{
						if(buzzler_search_into($custid,$subcategory->cat_ID) == 1) $chk = ' checked="checked" ';
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
				$ss = "insert into ".$wpdb->prefix."buzzler_custom_options (valval, custid) values('$option_name','$custid')";
				$wpdb->query($ss);
				
				echo '<div class="saved_thing"  id="add_options"><div class="padd10">Success! Your option was added!</div></div>';
				
				
			}
		
		
		?>
        
        
        <table  class="sitemile-table" width="100%"><tr><td>
        <strong>Add options:</strong>
        </td></tr>
        </table>
        
       	<form method="post" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php?page=custom-fields&edit_field=<?php echo $custid; ?>#add_options"> 
        <table>
        <tr>
        <td>Option Name: </td>
        <td><input type="text" name="option_name" size="20" /> <input type="submit" name="_add_option" value="Add Option" /> </td>
        </tr>
		
        <?php echo Buzzler_clear_table(2); ?>
        </table>
        </form>
        
        
        <table><tr><td>
        <strong>Current options:</strong>
        </td></tr>
        </table>
        <?php
		
		$ss = "select * from ".$wpdb->prefix."buzzler_custom_options where custid='$custid' order by id desc";
		$rows2 = $wpdb->get_results($ss);
		
		if(count($rows2) == 0)
		echo "No options defined.";
		else
		{
			?>			
				<script>
					function delete_this(id)
							{
								 jQuery.ajax({
												method: 'get',
												url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_delete_custom_id='+id,
												dataType : 'text',
												success: function (text) {  
												 jQuery('#option_' + id).animate({'backgroundColor' : '#ff9900'},1000);
												 jQuery('#option_'+id).remove();  }
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
						jQuery(document).ready(function() { 
						   jQuery(\'#myForm_'.$row2->id.'\').ajaxForm(function() { 
								 

								
								jQuery(\'#option_'.$row2->id.'\').animate({\'backgroundColor\' : \'#ff9900\'});
								jQuery(\'#option_'.$row2->id.'\').animate({\'backgroundColor\' : \'#cccccc\'});


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
			
			   $categories =  get_categories('taxonomy=listing_cat&hide_empty=0&orderby=name&parent=0');

			  foreach ($categories as $category) 
				{
						echo '
					    <tr>
						<td><input type="checkbox" name="field_cats[]" value="'.$category->cat_ID.'" />
						<b>'.$category->cat_name.'</b></td>
						</tr>';
						
					$subcategories =  get_categories('taxonomy=listing_cat&hide_empty=0&orderby=name&parent='.$category->term_id);
						
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
	
	$ss2 = "select * from ".$wpdb->prefix."buzzler_custom_fields order by name asc";
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
				echo '<th>'.Buzzler_get_field_tp($row->tp).'</th>';
				echo '<th>'.($row->cate == 'all' ? "All Categories" : "Multiple Categories").'</th>';
				echo '<th>'.$row->ordr.'</th>';
				echo '<th>
				<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=custom-fields&edit_field='.$row->id.'"
				><img src="'.get_bloginfo('template_url').'/images/edit.gif" border="0" alt="Edit" /></a>
				
				<a href="'.get_bloginfo('siteurl').'/wp-admin/admin.php?page=custom-fields&delete_field='.$row->id.'"
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

function Buzzler_pricing_options()
{
	$id_icon 		= 'icon-options-general4';
	$ttl_of_stuff 	= 'Buzzler - '.__('Pricing Settings','Buzzler');
	$arr = array("yes" => __("Yes",'Buzzler'), "no" => __("No",'Buzzler'));
	$sep = array( "," => __('Comma (,)','Buzzler'), "." => __("Point (.)",'Buzzler'));
	$frn = array( "front" => __('In front of sum (eg: $50)','Buzzler'), "back" => __("After the sum (eg: 50$)",'Buzzler'));
	global $menu_admin_Buzzler_theme_bull, $wpdb;
	
	$arr_currency = array("USD" => "US Dollars", "EUR" => "Euros", "CAD" => "Canadian Dollars", "CHF" => "Swiss Francs","GBP" => "British Pounds",
						  "AUD" => "Australian Dollars","NZD" => "New Zealand Dollars","BRL" => "Brazilian Real", 'PLN' => 'Polish zloty',
						  "SGD" => "Singapore Dollars","SEK" => "Swidish Kroner","NOK" => "Norwegian Kroner","DKK" => "Danish Kroner",
						  "MXN" => "Mexican Pesos","JPY" => "Japanese Yen","EUR" => "Euros", "ZAR" => "South Africa Rand", 'RUB' => 'Russian Ruble' , "TRY" => "Turkish Lyra",  "RON" => "Romanian Lei",
						  "HUF" => "Hungarian Forint", 'PHP' => 'Philippine peso' ,  'INR' => 'Indian Rupee'
						  );
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

	//-------------------
	
	if(isset($_POST['Buzzler_save1']))
	{
		$Buzzler_currency 						= trim($_POST['Buzzler_currency']);
		$Buzzler_currency_symbol 				= trim($_POST['Buzzler_currency_symbol']);
		$Buzzler_currency_position 			= trim($_POST['Buzzler_currency_position']);
		$Buzzler_decimal_sum_separator 		= trim($_POST['Buzzler_decimal_sum_separator']);
		$Buzzler_thousands_sum_separator 		= trim($_POST['Buzzler_thousands_sum_separator']);

		update_option('Buzzler_currency', 					$Buzzler_currency);
		update_option('Buzzler_currency_symbol', 			$Buzzler_currency_symbol);
		update_option('Buzzler_currency_position', 		$Buzzler_currency_position);
		update_option('Buzzler_decimal_sum_separator', 	$Buzzler_decimal_sum_separator);
		update_option('Buzzler_thousands_sum_separator', 	$Buzzler_thousands_sum_separator);

	
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';	
	}
	
	if(isset($_POST['Buzzler_save2']))
	{

		$Buzzler_new_listing_listing_fee 			= trim($_POST['Buzzler_new_listing_listing_fee']);
		$Buzzler_new_listing_feat_listing_fee 		= trim($_POST['Buzzler_new_listing_feat_listing_fee']);
		$Buzzler_withdraw_limit					= trim($_POST['Buzzler_withdraw_limit']);
		$Buzzler_percent_fee_taken					= trim($_POST['Buzzler_percent_fee_taken']);
		$Buzzler_solid_fee_taken					= trim($_POST['Buzzler_solid_fee_taken']);
		$Buzzler_new_listing_sealed_bidding_fee	= trim($_POST['Buzzler_new_listing_sealed_bidding_fee']);
		
		update_option('Buzzler_new_listing_listing_fee', 					$Buzzler_new_listing_listing_fee);
		update_option('Buzzler_new_listing_sealed_bidding_fee', 			$Buzzler_new_listing_sealed_bidding_fee);
		update_option('Buzzler_solid_fee_taken', 							$Buzzler_solid_fee_taken);
		update_option('Buzzler_percent_fee_taken', 						$Buzzler_percent_fee_taken);
		update_option('Buzzler_withdraw_limit', 							$Buzzler_withdraw_limit);
		update_option('Buzzler_new_listing_feat_listing_fee', 				$Buzzler_new_listing_feat_listing_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';	
	}
	
	
	if(isset($_POST['Buzzler_save3']))
	{

		$Buzzler_take_percent_fee 				= trim($_POST['Buzzler_take_percent_fee']);
		$Buzzler_take_flat_fee 		= trim($_POST['Buzzler_take_flat_fee']);
		$listing_theme_min_withdraw			= trim($_POST['listing_theme_min_withdraw']);
	
		update_option('listing_theme_min_withdraw', 			$listing_theme_min_withdraw);
		update_option('Buzzler_take_percent_fee', 			$Buzzler_take_percent_fee);
		update_option('Buzzler_take_flat_fee', 	$Buzzler_take_flat_fee);
	
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';	
	}
	
	
	if(isset($_POST['Buzzler_addnewcost']))
	{
		$cost = trim($_POST['newcost']);
		$ss = "insert into ".$wpdb->prefix."job_var_costs (cost) values('$cost')";
		$wpdb->query($ss);
		
		echo '<div class="saved_thing">'.__('Settings saved!','Buzzler').'</div>';	
	}


?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1"><?php _e('Main Details','Buzzler'); ?></a></li> 
           <!-- <li><a href="#tabs2"><?php _e('Listing Fees','Buzzler'); ?></a></li> -->

            
          </ul> 
          <div id="tabs1">	
          
          	 <form method="post" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_pr_set_&active_tab=tabs1">
            <table width="100%" class="sitemile-table">
    				
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Site currency:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($arr_currency, 'Buzzler_currency'); ?></td>
                    </tr>
                    
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Currency symbol:','Buzzler'); ?></td>
                    <td><input type="text" size="6" name="Buzzler_currency_symbol" value="<?php echo get_option('Buzzler_currency_symbol'); ?>"/> </td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Currency symbol position:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($frn, 'Buzzler_currency_position'); ?></td>
                    </tr>
                    
                    
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Decimals sum separator:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($sep, 'Buzzler_decimal_sum_separator'); ?></td>
                    </tr>
                    
                     <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Thousands sum separator:','Buzzler'); ?></td>
                    <td><?php echo Buzzler_get_option_drop_down($sep, 'Buzzler_thousands_sum_separator'); ?></td>
                    </tr>
      
                   
                    
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save1" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>
          
          
          </div>
          
          <div id="tabs2" style="display: none; ">
          
          <form method="post" action="<?php echo get_bloginfo('siteurl'); ?>/wp-admin/admin.php?page=BZ_pr_set_&active_tab=tabs2">
            <table width="100%" class="sitemile-table">
    				

                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td width="160"><?php _e('Listing Fee (base fee):','Buzzler'); ?></td>
                    <td><input type="text" size="15" name="Buzzler_new_listing_listing_fee" value="<?php echo get_option('Buzzler_new_listing_listing_fee'); ?>"/> <?php echo Buzzler_get_currency(); ?></td>
                    </tr>
                    
                    <tr>
                    <td valign=top width="22"><?php Buzzler_theme_bullet(); ?></td>
                    <td ><?php _e('Listing Fee (featured fee):','Buzzler'); ?></td>
                    <td><input type="text" size="15" name="Buzzler_new_listing_feat_listing_fee" value="<?php echo get_option('Buzzler_new_listing_feat_listing_fee'); ?>"/> 
					<?php echo Buzzler_get_currency(); ?></td>
                    </tr>
                    
                    
      
        
                    <tr>
                    <td ></td>
                    <td ></td>
                    <td><input type="submit" name="Buzzler_save2" value="<?php _e('Save Options','Buzzler'); ?>"/></td>
                    </tr>
            
            </table>      
          	</form>	
          </div>
          


<?php
	echo '</div>';		
	
	
}

function Buzzler_info()
{
	$id_icon 		= 'icon-options-general-info';
	$ttl_of_stuff 	= 'Buzzler - '.__('Information','Buzzler');
	
	//------------------------------------------------------
	
	echo '<div class="wrap">';
	echo '<div class="icon32" id="'.$id_icon.'"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">'.$ttl_of_stuff.'</h2>';	

?>

	    <div id="usual2" class="usual"> 
          <ul> 
            <li><a href="#tabs1" class="selected"><?php _e('Main Information','Buzzler'); ?></a></li> 
            <li><a href="#tabs2"><?php _e('From SiteMile Blog','Buzzler'); ?></a></li> 
  
          </ul> 
          <div id="tabs1" style="display: block; ">	
          
          <table width="100%" class="sitemile-table">
    				

                    <tr>                    
                    <td width="260"><?php _e('Buzzler Version:','Buzzler'); ?></td>
                    <td><?php echo BUZZLER_VERSION; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Buzzler Latest Release:','Buzzler'); ?></td>
                    <td><?php echo BUZZLER_RELEASE; ?></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('WordPress Version:','Buzzler'); ?></td>
                    <td><?php bloginfo('version'); ?></td>
                    </tr>
                    
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to SiteMile official page:','Buzzler'); ?></td>
                    <td><a class="festin" href="http://sitemile.com">SiteMile - Premium WordPress Themes</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to Buzzler\'s official page:','Buzzler'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/p/buzzler">SiteMile Buzzler Theme</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Go to support forums:','Buzzler'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/forums">SiteMile Support Forums</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Contact SiteMile Team:','Buzzler'); ?></td>
                    <td><a class="festin" href="http://sitemile.com/contact-us">Contact Form</a></td>
                    </tr>
                    
                    <tr>                    
                    <td width="160"><?php _e('Like us on Facebook:','Buzzler'); ?></td>
                    <td><a class="festin" href="http://facebook.com/sitemile">SiteMile Facebook Fan Page</a></td>
                    </tr>
                    
                    
                     <tr>                    
                    <td width="160"><?php _e('Follow us on Twitter:','Buzzler'); ?></td>
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

function Buzzler_site_summary()
{
	global $menu_admin_listing_theme_bull;
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general-summary"><br/></div>';	
	echo '<h2 class="my_title_class_sitemile">Buzzler Site Summary</h2>';
	?>
    
        <div id="usual2" class="usual"> 
  <ul> 
    <li><a href="#tabs1" class="selected">General Overview</a></li> 
   <!-- <li><a href="#tabs2">More Information</a></li> -->
  </ul> 
  <div id="tabs1" style="display: block; ">
    	<table width="100%" class="sitemile-table">
          <tr>
          <td width="200"><?php _e('Total number of listings','Buzzler') ?></td>
          <td><?php echo Buzzler_get_total_nr_of_listing(); ?></td>
          </tr>
          
          
          <tr>
          <td><?php _e('Open Listings','Buzzler') ?></td>
          <td><?php echo Buzzler_get_total_nr_of_open_listings(); ?></td>
          </tr>
          
          <tr>
          <td><?php _e('Closed & Finished','Buzzler') ?></td>
          <td><?php echo Buzzler_get_total_nr_of_closed_listings(); ?></td>
          </tr>
          
<!--          
          <tr>
          <td>Disputed & Not Finished</td>
          <td>12</td>
          </tr>
  -->        
          
          <tr>
          <td><?php _e('Total Users','Buzzler') ?></td>
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

?>