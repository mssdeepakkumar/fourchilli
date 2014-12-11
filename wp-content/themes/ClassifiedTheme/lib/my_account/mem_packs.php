<?php
/********************************************************************************
*
*	ClassifiedTheme - copyright (c) - sitemile.com - Details
*	if you want to remove actions from the sitemile framework use the hook
*	sitemile_pre_load to add your functions which contains the remove_filters
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v6.2.1
*
*********************************************************************************/


function ClassifiedTheme_my_account_mem_packs_area_function()
{
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	global $wpdb,$wp_rewrite,$wp_query;
	
	?>
    
    
    <div id="content">
    <!-- ############################################# -->
    
    
            <div class="my_box3">

            
            	<div class="box_title"><?php _e("Current Membership","ClassifiedTheme"); ?></div>
            	<div class="box_content">
    			


				
                <?php
				
				$total_nr 			= get_user_meta($uid, 'normal_ads_pack',true); 		if(empty($total_nr)) 			$total_nr = 0;
				$total_featured_nr 	= get_user_meta($uid, 'featured_ads_pack',true); 	if(empty($total_featured_nr)) 	$total_featured_nr = 0;
				
				?>
                
            	<table id="mem_packs" style="width:100%">
                <tr>
                <th><?php _e('Remaining Normal Ads','ClassifiedTheme'); ?>: </th>
                <th><?php echo $total_nr; ?></th>
                </tr>
                
                <tr>
                <th><?php _e('Remaining Featured Ads','ClassifiedTheme'); ?>: </th>
                <th><?php echo $total_featured_nr; ?></th>
                </tr>
                
                
                </table>

                </div>
           </div>
    
    
    
     <div class="clear10"></div>
            
            
            <div class="my_box3">
 
            
            	<div class="box_title"><?php _e("Get Membership Packs", "ClassifiedTheme"); ?></div>
                <div class="box_content">    
			
            
            	<?php
	
	$ss2 = "select * from ".$wpdb->prefix."ad_packs order by pack_cost+0 desc";
	///mysql_query($ss2) or die(mysql_error());
	$rf = $wpdb->get_results($ss2);
	
	if(count($rf) == 0)
		echo __('No packs yet added.','ClassifiedTheme');
	else
	{
		echo '<table id="mem_packs" style="width:100%">';
		
		
		echo '<thead><tr>';
		echo '<th><strong>'.__('Pack Name','ClassifiedTheme').'</strong></th>';
		echo '<th><strong>'.__('Ads Number','ClassifiedTheme').'</strong></th>';
		
		echo '<th><strong>'.__('Featured Included?','ClassifiedTheme').'</strong></th>';
		echo '<th><strong>'.__('Cost','ClassifiedTheme').'</strong></th>';
		echo '<th><strong></strong></th>';
		echo '</tr></thead>';
		
		foreach($rf as $row)
		{		
				$bgs = "efefef";
				if(isset($_GET['edit_field']))				
					if($_GET['edit_field'] == $row->id)
						$bgs = "B5CA73";
				
				
				
				echo '<tr>';
				echo '<th>'.$row->pack_name.'</th>';
				echo '<th>'.$row->ads_number.'</th>';			
				echo '<th>'.($row->featured_free == '1' ? __("Yes",'ClassifiedTheme') : __("No",'ClassifiedTheme')).'</th>';
				echo '<th class="cost">'.ClassifiedTheme_get_show_price($row->pack_cost,2).'</th>';
				echo '<th>
				<a class="buy_now_link" href="'.classifiedtheme_get_purchase_mem_lnk($row->id).'"
				>'.__('Purchase This','ClassifiedTheme').'</a>				
				</th>';
				echo '</tr>';
			
		}
		echo '</table>';
	}
	?>
            		
             
           </div>
           </div>     
            
    
    <!-- ############################################# -->
    </div>
    
    <?php
	
	classifiedTheme_get_users_links();
	
}

?>