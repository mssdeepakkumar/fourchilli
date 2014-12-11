<?php
/****************************************************************************************
*
*	DirectoryMarket - WP Business Directory Theme - v1.0
*	SiteMile.com - author: andreisaioc
*	Author email: andreisaioc[at]gmail.com
*	Link: http://sitemile.com/products/directorymarket-wordpress-business-directory-theme/
*
*****************************************************************************************/



	get_header();

?>

	<?php 

		if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3_breadcrumb"><div class="padd10_a">';	
		    bcn_display();
			echo '</div></div>';
		}
		
		
		
?>


<div id="content">
    <div class="box_title"><?php _e('Page Not Found','DirectoryMarket'); ?></div>
	<div class="padd10">
<?php _e('The requested page cannot be found. Maybe your project has not been approved yet.','DirectoryMarket'); ?>

    </div>
    </div>


  <!-- ################### -->
    
    <div id="right-sidebar">    
    	<ul class="xoxo">
        	 <?php dynamic_sidebar( 'single-widget-area' ); ?>
        </ul>    
    </div>


<?php

	get_footer();

?>