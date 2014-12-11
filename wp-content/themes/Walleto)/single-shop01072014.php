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
?>

<!--left side bare end-->
<?php include'left_sidebar.php'; ?>

   
	<!--right side banner main wrapper start--> 
	<section id="right_side_banner_main_wrapper">
	<ul class="list-unstyled" id="breadcrumb">
		<?php 
		if(function_exists('bcn_display'))
		{
		    echo bcn_display();
		}
                ?>
	</ul>
	<?php
	if ( have_posts() ){ while ( have_posts() ) : the_post(); 
	global $post;
	
			
		$views    	= get_post_meta(get_the_ID(), "views", true);
		if(empty($views)) $views = 0;
		$views 		= $views + 1;
		
		if(!walleto_is_owner_of_post())
		update_post_meta(get_the_ID(), "views", $views);
			
	
	?>

	                             	
    
	
    
    
		<section id="products_view_wrapper" class="outer_width clearfix">
         
            	<div class="product_list_heading"><span class="heading_text"><?php the_title(); ?></span></div>
                
    		<div class="product_view_inner">	
                 
                <?php
				
				$arr = walleto_get_post_images(get_the_ID(), 25);

				if($arr)
				{
					
				
				echo '<ul class="image-gallery" style="padding-top:10px">';
				foreach($arr as $image)
				{
					echo '<a href="'.walleto_wp_get_attachment_image($image, array(900, 700)).'" rel="image_gal1">'.wp_get_attachment_image( $image, array(80, 80) ).'</a>';
				}
				echo '</ul>';
				
				
				}
				//else { echo __('No images.') ;}
				
				?>
                
                    
                
                <div class="product_list_heading"><span class="heading_text"><?php _e('Shop Description','Walleto'); ?></span></div>
        	
		<div class="my_content_shop">
                <?php the_content(); ?>
                </div>
		
		
		<div class="product_list_heading"><span class="heading_text"><?php _e('Shop Social Details','Walleto'); ?></span></div>
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
		
	      
	        <br/>
		<div class="product_list_heading"><span class="heading_text"><?php _e('About Shop Owner','Walleto'); ?></span></div>
		<p>
		  <?php $post = get_post($mypid);
			  
				  echo '<img src="'.walleto_get_avatar($post->post_author, 15,15).'" class="av_photo_thing" width="65" height="65" />';
				  echo get_user_meta($post->post_author, 'personal_info',true);
			  
			  ?>
		</p> 
		
        
		</section>
       
        	
            
       
        
        
        
       
        	<section id="popular_products_wrapper" class="product_list_wrapper">
		<div class="product_list_heading"><span class="heading_text"><?php _e('Shop Items','Walleto'); ?></span></div>
        	
		<ul class="list-unstyled product_listing_ul">
		<?php
				$mypid = get_the_ID();
				
				$post = get_post(get_the_ID());
				$uid = $post->post_author;
				$nrpostsPage = 12;
				$pj = get_query_var('paged');
				
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
				
			?>    
                
               
       
        
        
        
		
		
    
   
 
    
	<!-- ################# -->
	
    </ul>
    
<?php

   endwhile;
} ?>
</section>
</section>
</section>
   <!--right side banner main wrapper start-->   
</section>
   <!--middle content top section end-->  
<?php get_footer(); ?>