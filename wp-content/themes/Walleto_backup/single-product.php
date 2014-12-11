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
    			
                <div class="walleto_main_image">
                <div class="walleto_main_image1">
                <?php echo walleto_get_first_post_image(get_the_ID(), 350, 200, 'img_class', 'image-single-product-page'); ?>
                </div>
                
                
                <div class="walleto_main_image2">	
                <?php
				
				$arr = walleto_get_post_images(get_the_ID(), 4);

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
                  
                    
                
                
        </div>
        </div>
        
        <div class="clear10"></div>
        
        <div class="my_box3">
        	<div class="box_title"><?php _e('Item Description','Walleto'); ?></div>
        	
            <div class="my_content">
                <?php the_content(); ?>
                </div>
            
        </div>
        
        
        <div class="clear10"></div>
        
        <div class="my_box3">
        	<div class="box_title"><?php _e('Item Other Details','Walleto'); ?></div>
        	
            <div class="my_content">
               <?php
			   
			   	$other_details = get_post_meta(get_the_ID(), 'other_details', true);
			   	if(empty($other_details))
				{
					_e('There are no other details defined for this item.','Walleto');
				}
				else echo $other_details;
			   
			   ?>
                </div>
            
        </div>
        
        
        
    </div>
    
    <?php

	echo '<div id="right-sidebar" class="page-sidebar">';
	echo '<ul class="xoxo">';
	
	?>
    <li class="widget-container widget_text" id="price-product-details">
    <p id="my_total_price_product">
    <div id="super_price"> 
   	<?php 
	
	$pr = get_post_meta(get_the_ID(),'price',true);
	$pr = walleto_get_show_price($pr);
	
	echo sprintf(__('Price: %s','Walleto'), $pr); ?></div> 
    
    <div class="shp_costs"><?php 
		
		$shps = trim(get_post_meta(get_the_ID(),	'shipping',true));
		
		if(!empty($shps))
		{
			 
			$shps = walleto_get_show_price($shps);
			echo sprintf(__('Shipping: %s','Walleto'), $shps);
		}
		
	?></div>
    <div id="quant_available"><?php 
	
	$quant = get_post_meta(get_the_ID(),'quant',true);
	echo sprintf(__('Available quantity: %s item(s)','Walleto'), $quant); ?></div>
    
    </p>
    </li>
    
    <!-- ################# -->
    
     <li class="widget-container widget_text" id="addcart-product-details">
     <p>
     		<div class="add_to_cart_div">
            <?php
			
				if($quant > 0):
			
			?>
            <a href="<?php bloginfo('siteurl') ?>/?w_action=add_to_cart&add_to_cart=<?php the_ID(); ?>" class="add_to_cart"><?php _e('Add To Cart','Walleto'); ?></a>
            <?php else: ?>
            
            <span class="error_quant"><?php _e('Unavailable product. Quantity is 0.','Walleto'); ?></span>
            
            <?php endif; ?>
            
            </div>
     </p>
     </li>
    
    <?php
	
	if(walleto_is_owner_of_post()):
	
	?>
    
    <li class="widget-container widget_text" id="owner-of-post-details">
    <h3 class="widget-title"><?php _e('Product Owner','Walleto'); ?></h3>
     <p>
     		<?php _e('You are the owner of this product. See your options below.','Walleto'); ?><br/><br/>
            
            <a href="<?php bloginfo('siteurl') ?>?w_action=edit_product&pid=<?php the_ID() ?>" class="edit_shop"><?php _e('Edit Product','Walleto'); ?></a>
     </p>
     </li>
    
    
    
    <?php endif; ?>
        
        
        <li class="widget-container widget_text" id="views-details">
    <h3 class="widget-title"><?php _e('Product Views','Walleto'); ?></h3>
     <p>
     		<?php echo sprintf(__('This product has been viewed %s times.','Walleto'), $views); ?> 
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
    
    <!-- ################# -->
    
    <li class="widget-container widget_text" id="shop-product-details">
   	<h3 class="widget-title"><?php _e('About Shop','Walleto'); ?></h3>
    <p>
    
    	<?php
				
				$uid = $post->post_author;
				$shop_id = walleto_get_shop_id($uid);
				$shop_post = get_post($shop_id);
				
				echo '<div class="shop_details_single">';
				echo '<a href="'.get_permalink($shop_id).'">'.$shop_post->post_title.'</a>';
				echo '</div>';
				
				
				echo '<div class="shop_details_single shop_cnt_cnt">';
				echo  $shop_post->post_content;
				echo '</div>';
				
		?>
        
        <div class="thumbs">
        
        	<?php

				$args = array(
				'order'          => 'ASC',
				'orderby'        => 'post_date',
				'post_type'      => 'attachment',
				'meta_key' 			=> 'is_portfolio',
				'meta_value' 		=> '1',
				'post_mime_type' 	=> 'image',
				'numberposts'    	=> 6,
				'post_parent'    	=> $shop_id,
				); $i = 0;
				
				$attachments = get_posts($args);
		
		
		
			if ($attachments) {
				foreach ($attachments as $attachment) {
				$url = wp_get_attachment_url($attachment->ID);
				
					echo '<div class="div_div1"  id="image_ss'.$attachment->ID.'"><img width="50" class="image_class" height="50" src="' .
					walleto_generate_thumb($attachment->ID, 50, 50). '" />					</div>';
			  
			}
			}
		
		
			?>
        
        </div>
        
        
        <div class="shop_link_me">
        	<a href="<?php echo get_permalink($shop_id); ?>" class="explore_shop"><?php _e('Explore this Shop','Walleto'); ?></a>       
        </div>
    
    </p> 
    </li>
    
    
    <!-- ################# -->
    
     <li class="widget-container widget_text" id="shop-product-details">
   	<h3 class="widget-title"><?php _e('About Shop Owner','Walleto'); ?></h3>
    <p>
    	<?php
		
			echo get_user_meta($post->post_author, 'personal_info',true);
		
		?>
    </p> 
    </li>
    
    
    
        <li class="widget-container widget_text" id="shop-product-details">
 
    <p>
    	<?php
			
			$using_perm = Walleto_using_permalinks();
	
			if($using_perm)	$privurl_m = get_permalink(get_option('Walleto_my_account_priv_mess_page_id')). "?";
			else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('Walleto_my_account_priv_mess_page_id'). "&";	
			
			$prvs = $privurl_m."priv_act=send&";
			$prvs .= 'pid='.$post->ID.'&uid='.$post->post_author;
			
			echo '<a href="'.$prvs.'" class="explore_shop">';
			echo __('Contact Seller','');
			echo '</a>';

			
		
		?>
        
        <br/> <br/>
        <?php 
								
				if(is_user_logged_in())
				{
					global $current_user;
					get_currentuserinfo();
					$uid = $current_user->ID;
					
					$walleto_check_if_pid_is_in_watchlist = walleto_check_if_pid_is_in_watchlist(get_the_ID(), $uid);
					
					if($walleto_check_if_pid_is_in_watchlist == true)  
					$isIn_watchlist = 1;
					else 	
					 $isIn_watchlist = 0;
					 
				}
				else
				{
					$isIn_watchlist = 0;

				}
				
				if($isIn_watchlist == 1):				
				?>
                
                <a class="rem-to-watchlist" rel="<?php the_ID(); ?>" 
                href="#"><?php _e('Remove from watchlist','AuctionTheme'); ?></a>
                
                <?php else: ?>
                
                <a class="add-to-watchlist" rel="<?php the_ID(); ?>" 
                href="#"><?php _e('Add to watchlist','AuctionTheme'); ?></a>
                <?php endif; ?>  
        
        
    </p> 
    </li>
    
    
    <!-- ################# -->
    
     <li class="widget-container widget_text" id="shop-product-details">
   	<h3 class="widget-title"><?php _e('Other Details','Walleto'); ?></h3>
    <p>
    	
        
        <?php
				$arrms = get_product_fields_values($post->ID);
				
				if(count($arrms) > 0)
				{ 
					echo '<ul class="other-dets5">';
					for($i=0;$i<count($arrms);$i++)
					{
				
				?>
                <li>
                	 
					<h3><?php echo $arrms[$i]['field_name'];?>:</h3>
               	 	<p><?php 

		
					if(is_array($arrms[$i]['field_value'][0]))
					{
					
						foreach($arrms[$i]['field_value'][0] as $vl)
						{
					
							echo $vl	.'<br/>';
						}
					}
					else echo $arrms[$i]['field_value'][0];
					?></p>
                </li>
				<?php } echo '</ul>'; } else { ?>
				
                
				<?php _e('There are no other details.','Walleto'); ?>
                
                <?php } ?>
			
        
        
    </p> 
    </li>
    

    
    
    
    <?php 
				dynamic_sidebar( 'product-widget-area' );
				
		echo '</ul></div>';
	
	?>


<?php

   endwhile;
}

	get_footer();

?>