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

	function walleto_colorbox_stuff()
	{	
	
		echo '<link media="screen" type="text/css" rel="stylesheet" href="'.get_bloginfo('template_url').'/css/colorbox.css" />';
		/*echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>'; */
		echo '<script src="'.get_bloginfo('template_url').'/js/jquery.colorbox.js" type="text/javascript"></script>';
		
		?>
        
        <script>
		
			$(document).ready(function(){

				$("a[rel='image_gal1']").colorbox();

			});
			
		</script>

        
        <?php
	}
	
	//----------------------------------------------------
	add_action('wp_head','walleto_colorbox_stuff');	
	get_header();


	if ( have_posts() ){ while ( have_posts() ) : the_post(); 
	global $post;
	
	
		
	$views    	= get_post_meta(get_the_ID(), "views", true);
	if(empty($views)) $views = 0;
	$views 		= $views + 1;
	
	if(!walleto_is_owner_of_post())
	update_post_meta(get_the_ID(), "views", $views);
		

?>

	<div id="content" >
    <?php 

			if(function_exists('bcn_display'))
		{
		    echo '<div class="my_box3 breadcrumb-wrap">';	
		    bcn_display();
			echo '</div>';
		}
	
	?>	
	
    
    
    	<div class="my_box3">
         
            	<div class="box_title"><h1><?php the_title(); ?></h1></div>
                <div class="box_content">
    			
                 
                <?php
				
				$arr = walleto_get_post_images(get_the_ID(), 25);

				if($arr)
				{
					
				
				echo '<ul class="image-gallery" style="padding-top:10px">';
				foreach($arr as $image)
				{
					echo '<li><a href="'.walleto_wp_get_attachment_image($image, array(900, 700)).'" rel="image_gal1">'.wp_get_attachment_image( $image, array(80, 80) ).'</a></li>';
				}
				echo '</ul>';
				
				
				}
				//else { echo __('No images.') ;}
				
				?>
                
                    
                
                
        </div>
        </div>
        
        <div class="my_box3">
        	<div class="box_title"><?php _e('Shop Description','Walleto'); ?></div>
        	
            <div class="my_content_shop">
                <?php the_content(); ?>
                </div>
            
        </div>
        
        
        <?php
		
			$shop_policy = get_post_meta(get_the_ID(), 'shop_policy', true);
			if(strlen($shop_policy) > 5):
		?>
        <div class="clear20"></div>
        <div class="my_box3">
        	<div class="box_title"><?php _e('Shop Policy','Walleto'); ?></div>
        	
            <div class="my_content_shop">
                <?php echo $shop_policy; ?>
                </div>
            
        </div>
        <?php endif; ?>
        
        
        <?php
		
			$contact_information = get_post_meta(get_the_ID(), 'contact_information', true);
			if(strlen($contact_information) > 5):
		?>
        <div class="clear20"></div>
        <div class="my_box3">
        	<div class="box_title"><?php _e('Contact Information','Walleto'); ?></div>
        	
            <div class="my_content_shop">
                <?php echo $contact_information; ?>
                </div>
            
        </div>
        <?php endif; ?>
        
        
        <div class="clear20"></div>
        <div class="my_box3">
        	<div class="box_title"><?php _e('Shop Items','Walleto'); ?>
            
            <?php
							
							echo '<div class="switchers">';
							$view = walleto_get_current_view_grid_list();
					
							if($view != "grid")
							{
								echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid"></a>';
								echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list-selected"></a>';
							}
							else
							{
								echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid-selected"></a>';
								echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list"></a>';
							}
							echo '</div>';
					
					?>
            
            </div>
        	
            <div class="my_content">
            <?php
				$mypid = get_the_ID();
				
				$post1 = get_post(get_the_ID());
				$uid = $post->post_author;
				$nrpostsPage = 16;
				$pj = (get_query_var('pagem')) ? get_query_var('pagem') : 1;
				
				$args = array('posts_per_page' => $nrpostsPage, 'paged' => $pj, 'post_type' => 'product', 'order' => "desc" , 'author' => $uid);
				$the_query = new WP_Query( $args );
				
				if($the_query->have_posts()):
				echo '<div class="clear10"></div>';
				while ( $the_query->have_posts() ) : $the_query->the_post();
				
				if($view != "grid")
				walleto_get_post_list_view();
				else Walleto_get_post() ;
				
				endwhile;
				
					if(function_exists('wp_pagenavi')):
					wp_pagenavi( array( 'query' => $the_query )); endif;
					echo '<div class="clear10"></div>';
					
				else:
				
				_e('There are no products in this shop yet.','Walleto');
				
				endif;
				wp_reset_query();
			?>    
                
                
                
            </div>
            
        </div>
        
       
        
    </div>  <?php break;  endwhile; ?>
    
    <?php

	echo '<div id="right-sidebar" class="page-sidebar">';
	echo '<ul class="xoxo">';
	
	?>
 
    
    <!-- ################# -->
     <li class="widget-container widget_text" id="shop-product-details">
   	<h3 class="widget-title"><?php _e('Shop Social Details','Walleto'); ?></h3>
    <p>
    	<?php
			
			$mp = 0;
			$fb = get_post_meta($mypid,'facebook',true);
			if(!empty($fb))
			{
				echo '<a href="'.get_post_meta($mypid,'facebook',true).'">Facebook</a>'; echo '<br/>';
				$mp++;
			}
			
			$tw = get_post_meta($mypid,'twitter',true);
			if(!empty($tw))
			{
				echo '<a href="'.get_post_meta($mypid,'twitter',true).'">Twitter</a>'; echo '<br/>';
				$mp++;
			}
			
			if($mp == 0) _e('There are no social details.','Walleto');
			
		?>
    </p> 
    </li>
    
    
      <li class="widget-container widget_text" id="shop-product-details">  
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=andreisaioc"></script>
<!-- AddThis Button END -->
    </li>
    
     <li class="widget-container widget_text" id="shop-product-details">
   	<h3 class="widget-title"><?php _e('About Shop Owner','Walleto'); ?></h3>
    <p>
    	<?php $post1 = get_post($mypid);
		
			echo '<img src="'.walleto_get_avatar($post1->post_author, 65,65).'" class="av_photo_thing" width="65" height="65" />';
			echo get_user_meta($post1->post_author, 'personal_info',true);
		
		?>
    </p> 
    </li>
    
    <?php 
				dynamic_sidebar( 'shop-widget-area' );
				
		echo '</ul></div>';
	
	?>


<?php

  
} 

	get_footer();

?>