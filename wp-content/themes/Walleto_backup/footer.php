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

?>

<?php
	global $wp;
	
	if(is_home()):
		$Walleto_adv_code_home_below_content = stripslashes(get_option('Walleto_adv_code_home_below_content'));
		if(!empty($Walleto_adv_code_home_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Walleto_adv_code_home_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	if ($wp->query_vars["post_type"] == "auction"):
		$Walleto_adv_code_job_page_below_content = stripslashes(get_option('Walleto_adv_code_job_page_below_content'));
		if(!empty($Walleto_adv_code_job_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Walleto_adv_code_job_page_below_content;
			echo '</div>';
		
		endif;	
	endif;
	
	//-------------------------------------
	
	if(is_single() or is_page()):
		$Walleto_adv_code_single_page_below_content = stripslashes(get_option('Walleto_adv_code_single_page_below_content'));
		if(!empty($Walleto_adv_code_single_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Walleto_adv_code_single_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-------------------------------------
	
	if(is_tax()):
		$Walleto_adv_code_cat_page_below_content = stripslashes(get_option('Walleto_adv_code_cat_page_below_content'));
		if(!empty($Walleto_adv_code_cat_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Walleto_adv_code_cat_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	?>

</div> 
</div> <!-- end some_wide_header -->
</div>
</div>

<div id="footer">
	<div id="colophon">	
	
	<?php
			get_sidebar( 'footer' );
	?>
	
	
		<div id="site-info">
				<div id="site-info-left">
					
					<h3><?php echo stripslashes(get_option('Walleto_left_side_footer')); ?></h3>
					
				</div>
				<div id="site-info-right">
					<?php echo stripslashes(get_option('Walleto_right_side_footer')); ?>
				</div>
			</div>
		</div>

</div>


</div>
<?php

	$Walleto_enable_google_analytics = get_option('Walleto_enable_google_analytics');
	if($Walleto_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('Walleto_analytics_code'));	
	endif;
	
	//----------------
	
	$Walleto_enable_other_tracking = get_option('Walleto_enable_other_tracking');
	if($Walleto_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('Walleto_other_tracking_code'));	
	endif;


?>
<?php wp_footer(); ?>
</body>
</html>