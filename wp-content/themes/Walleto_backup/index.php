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



get_header();

//-----------------------------------------------

	$Walleto_adv_code_home_above_content = stripslashes(get_option('Walleto_adv_code_home_above_content'));
		if(!empty($Walleto_adv_code_home_above_content)):
		
			echo '<div class="full_width_a_div">';
			echo stripslashes($Walleto_adv_code_home_above_content);
			echo '</div>';
		
		endif;
		
//----------------------------------------------		
		
		if(Walleto_is_home())
		{
			$opt = get_option('Walleto_show_stretch');
			
			if(	$opt != "no"):
								
				echo '<div class="stretch-area"><div class="padd10"><ul class="xoxo">';
				dynamic_sidebar( 'main-stretch-area' );
				echo '</ul></div></div>';	
				
			endif;	
		}	
		
		
		
		
		
		$Walleto_home_page_layout = get_option('Walleto_home_page_layout');
		
		if($Walleto_home_page_layout == "3" or $Walleto_home_page_layout == "4" ):
			
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
				
					include 'latest-posted-products.php';
				
				?>
        	</li>
            
            <?php dynamic_sidebar( 'main-page-widget-area' ); ?>
            
        </ul>   
    </div>
    
    <!-- ############################ -->
    
   <?php if($Walleto_home_page_layout != "5" && $Walleto_home_page_layout != "4"): ?>
	
    <div id="right-sidebar">
		<ul class="xoxo">
	 <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
		</ul>
       </div>

	<?php endif; ?>
    
    
    <?php
	
		if($Walleto_home_page_layout == "2" ):
			
			    echo '<div id="left-sidebar">';
					echo '<ul class="xoxo">';
				 		dynamic_sidebar( 'home-left-widget-area' ); 
					echo '</ul>';
				   echo '</div>';
		
		endif;
		
	
	?>
    
    

<?php get_footer(); ?>