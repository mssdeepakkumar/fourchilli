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
				
			$('#watchlist').click(function(){
			window.location.reload();
			});
			$(function() {
			$( "#tabs" ).tabs();
		      });
			
			
		});	
	</script>

        
        <?php
	}
	
	//----------------------------------------------------
	add_action('wp_head','walleto_colorbox_stuff');	
	get_header(); ?>




<!--left side bare end-->
<?php include'left_sidebar.php'; ?>
 
<?php
if ( have_posts() ){ while ( have_posts() ) : the_post(); 
global $post;
		
		
	$views    	= get_post_meta(get_the_ID(), "views", true);
	if(empty($views)) $views = 0;
	$views 		= $views + 1;
	
	if(!walleto_is_owner_of_post())
	update_post_meta(get_the_ID(), "views", $views);
		
?>   
   <!--right side banner main wrapper start--> 
	<section id="right_side_banner_main_wrapper" >


		<ul class="list-unstyled" id="breadcrumb">
		<?php 
		if(function_exists('bcn_display'))
		{
		    echo bcn_display();
		}
                ?>
		</ul>
	
	<!--products view start-->
	<section id="products_view_wrapper" class="outer_width clearfix">
		<h4 class="product_view_title"><?php echo substr(the_title('', '', FALSE), 0, 50); ?></h4>
            	
                <div class="product_view_inner">
		<!--product view inner Left wrapper -->
		<div class="product_view_inner_left">
    			
                <div class="main_product_img_show">
                <?php echo walleto_get_first_post_image(get_the_ID(), 358, 329); ?>
                </div>
                <div class="thumb_product_img_show">
            	
                <?php
				
				$arr = walleto_get_post_images(get_the_ID(), 4);

				if($arr)
				{
					
				foreach($arr as $image)
				{
					echo '<a class="img-responsive" href="'.walleto_wp_get_attachment_image($image, array(900, 700)).'" rel="image_gal1">'.wp_get_attachment_image( $image, array(80, 80) ).'</a>';
				}
				
				
				
				}
				//else { echo __('No images.') ;}
				
				?>
		</div>
                <!--<a href="javascript:void(0);" class="all-social-plugin"><img src="img/all_social_plugin.png" class="img-responsive"></a>-->
               
                </div>
		
		<div class="product_view_inner_right">
                <div class="title_product_view_right_side">
		<?php 
	$pr = get_post_meta(get_the_ID(),'price',true);
	$pr = walleto_get_show_price($pr);
	
	echo sprintf(__('Price: %s','Walleto'), $pr); ?>
	</div>
        <div class="description_product_view_right_side">
            <div class="title_description"><?php _e('Product Description','Walleto'); ?></div>
	    <div class="full-product-dics"><?php the_content(); ?><a class="hide-dics" href="javascript:void(0)">Hide Content</a></div>
            <div class="short-product-dics"><?php the_excerpt(); ?></div>
	    
	</div> 
                    
            <ul class="list-unstyled product_other_info">
            	<li>
                <div class="left">Shipping:</div>
                <div class="right">
		<?php $shps = trim(get_post_meta(get_the_ID(),	'shipping',true));
		if(!empty($shps))
		{
			 
			$shps = walleto_get_show_price($shps);
			echo $shps;
		}?>
		</div>
                </li>
                <li>
			<div class="left">Views:</div>
			<div class="right"><div class="color_coded"><?php echo sprintf(__('This product has been viewed %s times.','Walleto'), $views); ?></div></div>
                </li>
                <li>
                <div class="left">Social:</div>
                    <div class="right"><!-- AddThis Button BEGIN -->
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
		    </div>
                </li>
                <li>
                <div class="left">Quantity Available:</div>
                <div class="right"><p class="piece_text"><?php $quant = get_post_meta(get_the_ID(),'quant',true);echo  $quant; ?> <span>piece</span></p></div>
                </li>
                <li>
                	<div class="left">Total Price:</div>
                    <div class="right">Depends on the product properties you select</div>
                </li>
            </ul>
            <div class="payment_method_button">
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
                
                <a id="watchlist" class="rem-to-watchlist" rel="<?php the_ID(); ?>" 
                href="#"><?php _e('Remove from watchlist','Walleto'); ?></a>
                
                <?php else: ?>
                
                <a id="watchlist" class="add-to-watchlist" rel="<?php the_ID(); ?>" 
                href="#"><i class="icon-camera"></i>&nbsp;<?php _e('Add to watchlist','Walleto'); ?></a>
                <?php endif; ?> 
		<?php
			
				if($quant > 0):
			
		?>
		<a href="<?php bloginfo('siteurl') ?>/?w_action=add_to_cart&add_to_cart=<?php the_ID(); ?>" class="add_to_cart add_to_cart_orange">
		<i class="icon-shopping-cart"></i>&nbsp;<?php _e('Add To Cart','Walleto'); ?></a>
		<?php else: ?>
            
		<p class="error_quant red-txt"><?php _e('Unavailable product. Quantity is 0.','Walleto'); ?></p>
            
		<?php endif; ?>
           
           
            </div>
        </div>        
	<!--product view inner Right wrapper end-->        
	</div>
	<!--product view inner wrapper end-->    
	</section>
	<!--Products view end-->
	
	
	<section id="product_view_bottom_wrapper">
   
	<!--product description tabs start-->
	<section id="product_description_tabs">
	<!--For Top Tabs-->
	<div id="tabs"><div class="for_ul_li_tabs">
	   <ul class="list-unstyled">
	       <li><a  href="#tabs-1">Product Details</a></li>
	       <li><a href="#tabs-2">About Shop</a>
	       </li><li><a href="#tabs-3"> Shipping &amp; Payment</a>
	       </li><li><a href="#tabs-4">Seller Guarantee</a></li>
	   </ul>
	</div>
	<!--For Top Tabs end-->   
	<!--For bottom content Tabs-->
	<div class="bottom_content_tabs_wrapper" id="tabs-1">
	<div class="content_tabs active" >
        	
		<div class="bottom_tabs_heading">Item specifics</div>
		<ul class="tabs-listing-half tabs-listing">
		<?php
				$arrms = get_product_fields_values($post->ID);  
				
				if(count($arrms) > 0)
				{ 
					
					for($i=0;$i<2;$i++)
					{
				
		?>
                <li>
                	 
		<span class="left-tabs-listing"><?php echo $arrms[$i]['field_name'];?>:</span>
               	 	<?php 

		
					if(is_array($arrms[$i]['field_value'][0]))
					{
					
						foreach($arrms[$i]['field_value'][0] as $vl)
						{
					
							echo '<span class="right-tabs-listing">'.$v.'<span>';
						}
					}
					else echo $arrms[$i]['field_value'][0];
					?>
                </li>
				<?php } echo '</ul>'; } else { ?>
				
                
				<?php _e('There are no other details.','Walleto'); ?>
                
                <?php } ?>
	
            
            <div class="product_description">
            <span class="heading"><strong>Product Description</strong></span>
            <p><?php the_content();?></p>
	    </div>            
        </div>
	</div>
	<div class="bottom_content_tabs_wrapper" id="tabs-2">
		<div class="content_tabs active">
		<?php
				
				$uid = $post->post_author;
				$shop_id = walleto_get_shop_id($uid);
				$shop_post = get_post($shop_id);
				
				echo '<div class="bottom_tabs_heading">';
				echo '<a class="red-txt" href="'.get_permalink($shop_id).'">'.$shop_post->post_title.'</a>';
				echo '</div>';
				
				
				echo '<div class="shop_details_single shop_cnt_cnt">';
				echo  $shop_post->post_content;
				echo '</div>';
				
		?>
        
               
		<div class="product_description">
		<span class="heading"><strong>About Shop Owner</strong></span>
		<p><?php echo get_user_meta($post->post_author, 'personal_info',true);?></p>
		</div>            
	</div>
		
	</div>
	<div class="bottom_content_tabs_wrapper" id="tabs-3">
	<div class="content_tabs active">
		<div class="bottom_tabs_heading">Shipping & Payment</div>
		
		<?php
		$arrms = get_product_fields_values($post->ID);
		foreach($arrms as $arr){
			if($arr['field_name'] == 'Shipping & Payment'){
				echo $arr['field_value'][0];
			}
		}
		?>
		
		
	</div>
	</div>
	<div class="bottom_content_tabs_wrapper" id="tabs-4">
		<div class="content_tabs active">
		<div class="bottom_tabs_heading">Seller Guarantee</div>
		<?php
		$arrms = get_product_fields_values($post->ID);
		foreach($arrms as $arr){
			if($arr['field_name'] == 'Seller Guarantee'){
				echo $arr['field_value'][0];
			}
		}
		?>
		</div>
	</div>
	<!-- wrapper tab-->
	</div>
	</div>
	<!--For Top Tabs end-->   
	</section>
	<!--product description tabs end-->   
   
	<!--deler information start-->
	<section id="deler_information">
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
				
					echo '<div class="div_div1"  id="image_ss'.$attachment->ID.'"><img  class="img-responsive seller_img"  src="' .
					walleto_generate_thumb($attachment->ID, 244, 214). '" />					</div>';
			  
			}
			}
		
		
			?>	
    	
        
	<a href="<?php echo get_permalink($shop_id); ?>" class="visit_store"><?php _e('Visit Store','Walleto'); ?></a>       
		
	<div class="sold_description">
	<?php
			
			$using_perm = Walleto_using_permalinks();
			if($using_perm)	$privurl_m = get_permalink(get_option('Walleto_my_account_priv_mess_page_id')). "?";
			else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('Walleto_my_account_priv_mess_page_id'). "&";	
			
			$prvs = $privurl_m."priv_act=send&";
			$prvs .= 'pid='.$post->ID.'&uid='.$post->post_author;
			
	?>
      	<span><strong>Contact Seller</strong></span>
        <a href="<?php echo $prvs;?>" class="red-txt"><i class="icon-envelope"></i>&nbsp;Contact Now</a></span>
      </div>
     </section>
   <!--deler information end-->
   </section>
  </section>
   <!--right side banner main wrapper start-->   
  </section>
   <!--middle content top section end-->  	
<?php
endwhile; } ?>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
	$('.full-desc').click(function(){
	   $(".full-product-dics").css({ display: "block" });
	   $(".short-product-dics").css({ display: "none" });
	});
	$('.hide-dics').click(function(){
	   $(".full-product-dics").css({ display: "none" });
	   $(".short-product-dics").css({ display: "block" });
	});
</script>	
get_footer(); ?>