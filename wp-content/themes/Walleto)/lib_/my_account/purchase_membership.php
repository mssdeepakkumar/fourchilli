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


if(!function_exists('walleto_purchase_membership_area_function'))
{
function walleto_purchase_membership_area_function()
{
	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	$pers 	= walleto_get_period_from_code($_GET['mem']);
	
	?>
    
    <div id="content">

	<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Purchase Membership",'Walleto'); ?></div>
                <div class="box_content">  
    
    			<?php
				
				$tp = '<b>'.$pers.'</b>';
				$cost = '<b>'.walleto_get_show_price(get_option('Walleto_shop_'.$_GET['mem'].'_fee')). '</b>';
				
				echo '<div class="sk_blast1">'.sprintf(__('You are about to purchase new membership for your shop. Use the payment options below.<br/>
				Membership Type: %s. Membership Cost: %s.','Walleto') , $tp, $cost) . '</div>';	?>
    			
                
                <div class="clear20"></div>
                
                <a href="<?php echo walleto_get_purchase_mem_link_ewallet($_GET['mem']) ?>" class="btns_pay"><?php _e('Pay by e-Wallet','Walleto'); ?></a>
                
                <?php if(get_option('Walleto_paypal_enable') == "yes") : ?>
                <a href="<?php bloginfo('siteurl') ?>/?w_action=purchase_mem_paypal&mem=<?php echo $_GET['mem'] ?>" class="btns_pay"><?php _e('Pay by PayPal','Walleto'); ?></a>
                <?php endif; ?>
                
                <?php if(get_option('Walleto_moneybookers_enable') == "yes") : ?>
                <a href="<?php bloginfo('siteurl') ?>/?w_action=purchase_mem_skrill&mem=<?php echo $_GET['mem'] ?>" class="btns_pay"><?php _e('Pay by Skrill','Walleto'); ?></a>
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
