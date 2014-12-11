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


if(!function_exists('walleto_purchase_membership_area_function_crds'))
{
function walleto_purchase_membership_area_function_crds()
{
	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	$cost = get_option('Walleto_shop_'.$_GET['mem'].'_fee');
	
	$pers 	= walleto_get_period_from_code($_GET['mem']);
	$months = walleto_get_period_from_code_numeric($_GET['mem']);
	
	?>
    
    <div id="content">

	<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Purchase Membership - Pay by eWallet",'Walleto'); ?></div>
                <div class="box_content">  
    			
                <?php
				$is_paid_and_ok = false;
				
				if($_GET['confirm'] == "ok")
				{
				
					$Walleto_get_credits = Walleto_get_credits($uid); 
					$walleto_check_if_shop_membership_is_valid = walleto_check_if_shop_membership_is_valid($uid);
					 
					if($Walleto_get_credits < $cost and $walleto_check_if_shop_membership_is_valid == false)
					{
						$lnk = '';
						echo '<div class="error">'.sprintf(__('You do not have enough credits in your account to pay for this membership. <a href="%s">Click here</a> to deposit more.','Walleto'), $lnk).'</div>';
						
						
					}
					else
					{
						
						if($walleto_check_if_shop_membership_is_valid == false)
						{
							$Walleto_get_credits -= $cost;
							Walleto_update_credits($uid, $Walleto_get_credits);
							 
							$reason = sprintf(__("Payment for shop membership. Period %s.","Walleto"), $pers); 
							walleto_add_history_log('0', $reason, $cost, $uid);	
							
							walleto_update_membership_for_shop($uid, $months);
							
						}
						
						$is_paid_and_ok = true;
						
					}				 		
					
				}
				
				?>
                
    			<?php
				
				if($is_paid_and_ok == true)
				{
					echo '<div class="saved-thing"><div class="padd10">';
					echo sprintf(__('Your membership was upgraded. <a href="%s"><b>Click here</b></a> to get back to your account.','Walleto'), get_permalink(get_option('Walleto_my_account_page_id')));
					echo '</div></div>';
					
					echo '<div class="clear10"></div>';
					
				}
				
				
				$tp = '<b>'.$pers.'</b>';
				$cost = '<b>'.walleto_get_show_price($cost). '</b>';
				
				if($is_paid_and_ok == false):
				
				echo '<div class="sk_blast1">'.sprintf(__('You are about to purchase new membership for your shop. You will pay by eWallet.<br/>
				Membership Type: %s. Membership Cost: %s.','Walleto') , $tp, $cost) . '</div>';	?>
    			
                
                <div class="clear20"></div>
                
                <a href="<?php echo walleto_get_purchase_mem_link_ewallet($_GET['mem'], '&confirm=ok') ?>" class="btns_pay"><?php _e('Agree and Purchase','Walleto'); ?></a>
                
                <a href="<?php echo walleto_get_purchase_mem_link_ewallet($_GET['mem'], '&confirm=nok') ?>" class="btns_pay"><?php _e('Cancel and Go Back','Walleto'); ?></a>
 				
                <?php endif; ?>
    
    </div>
    </div>
    </div>
    
    
    <?php	
	
		//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}

?>
