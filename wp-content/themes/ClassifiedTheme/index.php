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

	get_header();
	
	
	$ClassifiedTheme_adv_code_home_above_content = stripslashes(get_option('ClassifiedTheme_adv_code_home_above_content'));
		if(!empty($ClassifiedTheme_adv_code_home_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo stripslashes($ClassifiedTheme_adv_code_home_above_content);
			echo '</div>';
		
		endif;
		
//----------------------------------------------		
		
		if(ClassifiedTheme_is_home())
		{
			$opt = get_option('ClassifiedTheme_show_stretch');
			
			if(	$opt != "no"):
								
				echo '<div class="stretch-area"><div class="padd10"><ul class="xoxo">';
				dynamic_sidebar( 'main-stretch-area' );
				echo '</ul></div></div>';	
				
			endif;	
		}	
		
		
		
		
		
		$ClassifiedTheme_home_page_layout = get_option('ClassifiedTheme_home_page_layout');
		
		if($ClassifiedTheme_home_page_layout == "3" or $ClassifiedTheme_home_page_layout == "4" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
		
		

?>
	
    


	<div id="content">
    	<ul class="xoxo">
        	<li class="widget-container latest-posted-items-big">
        		<?php
				
					include 'latest-posted-items.php';
				
				?>
        	</li>
            
            <?php dynamic_sidebar( 'main-page-widget-area' ); ?>
            
        </ul>   
    </div>
    
    <!-- ############################ -->
    
   <?php if($ClassifiedTheme_home_page_layout != "5" && $ClassifiedTheme_home_page_layout != "4"): ?>
	
    <div id="right-sidebar">
		<ul class="xoxo">
	 <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
		</ul>
       </div>

	<?php endif; ?>
    
    
    <?php
	
		if($ClassifiedTheme_home_page_layout == "2" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
	
	?>
    
    

<?php get_footer(); ?>