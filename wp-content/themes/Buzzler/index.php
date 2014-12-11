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

	get_header();
	

    $opt = get_option('Buzzler_show_stretch');
	
	$Buzzler_adv_code_home_above_content = get_option('Buzzler_adv_code_home_above_content');
	if(!empty($Buzzler_adv_code_home_above_content)) echo '<div class="wrapper">'.stripslashes($Buzzler_adv_code_home_above_content) . '</div>';
			
	if(	$opt != "no"):
							
			echo '<div class="stretch-area"><ul class="xoxo">';
			dynamic_sidebar( 'main-stretch-area' );
			echo '</ul></div>';	
			
	endif;	
    
	?>

	<div id="content">
    	<ul class="theme_sidebar">
        	<li class="widget-container latest-posted-listings-big">
        		<?php
				
					include 'latest-posted-listings.php';
				
				?>
        	</li>
            
            <?php dynamic_sidebar( 'main-page-widget-area' ); ?>
            
        </ul>   
    </div>
    
    
     <div id="right-sidebar">
		<ul class="xoxo">
				 <?php dynamic_sidebar( 'home-right-widget-area' ); ?>
		</ul>
       </div>
    

<?php get_footer(); ?>