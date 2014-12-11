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
?>


	</div>
    </div>
    
    
    <?php
	global $wp;
	
	if(is_home()):
		$Buzzler_adv_code_home_below_content = stripslashes(get_option('Buzzler_adv_code_home_below_content'));
		if(!empty($Buzzler_adv_code_home_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Buzzler_adv_code_home_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	if ($wp->query_vars["post_type"] == "listing"):
		$Buzzler_adv_code_listing_page_below_content = stripslashes(get_option('Buzzler_adv_code_listing_page_below_content'));
		if(!empty($Buzzler_adv_code_listing_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Buzzler_adv_code_listing_page_below_content;
			echo '</div>';
		
		endif;	
	endif;
	
	//-------------------------------------
	
	if(is_single() or is_page()):
		$Buzzler_adv_code_single_page_below_content = stripslashes(get_option('Buzzler_adv_code_single_page_below_content'));
		if(!empty($Buzzler_adv_code_single_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Buzzler_adv_code_single_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-------------------------------------
	
	if(is_tax()):
		$Buzzler_adv_code_cat_page_below_content = stripslashes(get_option('Buzzler_adv_code_cat_page_below_content'));
		if(!empty($Buzzler_adv_code_cat_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $Buzzler_adv_code_cat_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	?>
    

<div id="footer">
	<div id="colophon">	
	
	<?php
			get_sidebar( 'footer' );
	?>
	
	
		<div id="site-info">
				<div id="site-info-left">
					
					<h3><?php echo stripslashes(get_option('Buzzler_left_side_footer')); ?></h3>
					
				</div>
				<div id="site-info-right">
					<?php echo stripslashes(get_option('Buzzler_right_side_footer')); ?>
				</div>
			</div>
		</div>

</div>


</div>
<?php

	$Buzzler_enable_google_analytics = get_option('Buzzler_enable_google_analytics');
	if($Buzzler_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('Buzzler_analytics_code'));	
	endif;
	
	//----------------
	
	$Buzzler_enable_other_tracking = get_option('Buzzler_enable_other_tracking');
	if($Buzzler_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('Buzzler_other_tracking_code'));	
	endif;


?>
<?php wp_footer(); ?>
</body>
</html>