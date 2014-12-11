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




?>
	
    
    <?php
	global $wp;
	
	if(is_home()):
		$ClassifiedTheme_adv_code_home_below_content = stripslashes(get_option('ClassifiedTheme_adv_code_home_below_content'));
		if(!empty($ClassifiedTheme_adv_code_home_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $ClassifiedTheme_adv_code_home_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	if ($wp->query_vars["post_type"] == "ad"):
		$ClassifiedTheme_adv_code_job_page_below_content = stripslashes(get_option('ClassifiedTheme_adv_code_job_page_below_content'));
		if(!empty($ClassifiedTheme_adv_code_job_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $ClassifiedTheme_adv_code_job_page_below_content;
			echo '</div>';
		
		endif;	
	endif;
	
	//-------------------------------------
	
	if(is_single() or is_page()):
		$ClassifiedTheme_adv_code_single_page_below_content = stripslashes(get_option('ClassifiedTheme_adv_code_single_page_below_content'));
		if(!empty($ClassifiedTheme_adv_code_single_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $ClassifiedTheme_adv_code_single_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-------------------------------------
	
	if(is_tax()):
		$ClassifiedTheme_adv_code_cat_page_below_content = stripslashes(get_option('ClassifiedTheme_adv_code_cat_page_below_content'));
		if(!empty($ClassifiedTheme_adv_code_cat_page_below_content)):
		
			echo '<div class="full_width_a_div">';
			echo $ClassifiedTheme_adv_code_cat_page_below_content;
			echo '</div>';
		
		endif;
	endif;
	
	//-----------------------------------
	
	?>
    
	</div> <!-- close main div -->
    
    
	<div id="footer">
	<div id="colophon">	
	
		<?php
                get_sidebar( 'footer' );
        ?>
        
        
            <div id="site-info">
                <div class="padd10">
                

                        <div id="site-info-left">					
                            <h3><?php echo stripslashes(get_option('ClassifiedTheme_left_side_footer')); ?></h3>					
                        </div>
                        
                        <div id="site-info-right">
                            <?php echo stripslashes(get_option('ClassifiedTheme_right_side_footer')); ?>
                        </div>

                
                </div>
            </div>
        
        
        </div>
    </div>

</div>


<?php

	$ClassifiedTheme_enable_google_analytics = get_option('ClassifiedTheme_enable_google_analytics');
	if($ClassifiedTheme_enable_google_analytics == "yes"):		
		echo stripslashes(get_option('ClassifiedTheme_analytics_code'));	
	endif;
	
	//----------------
	
	$ClassifiedTheme_enable_other_tracking = get_option('ClassifiedTheme_enable_other_tracking');
	if($ClassifiedTheme_enable_other_tracking == "yes"):		
		echo stripslashes(get_option('ClassifiedTheme_other_tracking_code'));	
	endif;


?>


	<?php 	
            wp_footer();
    ?>
</body>
</html>