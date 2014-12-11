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


if(!function_exists('walleto_my_shop_setup_area_function'))
{
function walleto_my_shop_setup_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	$shop_id = walleto_get_shop_id($uid);
	
	
	
?>	
<div id="content">

<?php

			if(isset($_GET['activate_trial']))
			{
					
				$trial_activated = get_post_meta($shop_id, 'trial_activated', true);
				
				if(empty($trial_activated))
				{	
					update_post_meta($shop_id, 'trial_activated', "1");
					update_post_meta($shop_id, 'membership_available', current_time('timestamp',0) + 3600*24*get_option('Walleto_shop_trial_days'));
					
				}
				
				?>

	<div class="saved_thing">
    <?php _e('Your trial has been activated.','Walleto'); ?>
    </div>
<div class="clear10"></div>


<?php } ?>
<?php

	$Walleto_shop_subscriptions = get_option('Walleto_shop_subscriptions');
	if($Walleto_shop_subscriptions != 'no'):

?>
<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Shop Subscription",'Walleto'); ?></div>
                <div class="box_content">  
                <?php
				
				$dt = current_time('timestamp',0);
				 
				if( walleto_check_if_shop_membership_is_valid($uid) == false ) 
				{
					echo '<div class="sk_blast">'.__('Your shop membership has expired and you need to renew it. Please chose from the options below to start selling your products.','Walleto') . '</div>';	
					?>
                    
                    	<div class="clear10"></div>
                        <table class="sitemile-table" width="100%">
                        <?php
						
							$opt = get_option('Walleto_enable_shop_trial');
							$opt2 = get_post_meta($shop_id, 'trial_activated', true);
							
							if($opt == "yes" and empty($opt2)):
							
						?>
                        
                        <tr>
                        	<td><?php _e('Trial Membership','Walleto') ?></td>
                            <td><?php echo sprintf(__('For %s days','Walleto'), get_option('Walleto_shop_trial_days')); ?></td>
                            <td><a class="purchase_mem" href="<?php echo walleto_get_trial_link() ?>"><?php _e('Activate Now','Walleto'); ?></a></td>
                        </tr>
                        
                        <?php endif; ?>
                        
                         <tr>
                        	<td><?php _e('Monthly Membership','Walleto') ?></td>
                            <td><?php echo walleto_get_show_price(get_option('Walleto_shop_monthly_fee')); ?></td>
                            <td><a class="purchase_mem" href="<?php echo walleto_get_purchase_mem_link('monthly') ?>"><?php _e('Purchase Now','Walleto'); ?></a></td>
                        </tr>
                        
                        
                         <tr>
                        	<td><?php _e('Yearly Membership','Walleto') ?></td>
                            <td><?php echo walleto_get_show_price(get_option('Walleto_shop_yearly_fee')); ?></td>
                            <td><a class="purchase_mem" href="<?php echo walleto_get_purchase_mem_link('yearly') ?>"><?php _e('Purchase Now','Walleto'); ?></a></td>
                        </tr>
                        
                        </table>
                    
                    <?php
				}
				else
				{
					$membership_available = get_post_meta($shop_id, 'membership_available', true);
					$dt = date_i18n('d-M-Y H:i:s',$membership_available); 
					echo '<div class="sk_blast1">'.sprintf(__('Your shop membership is valid and will expire on %s.','Walleto') , $dt) . '</div>';		
				}
				
				?>                
                </div>
                </div>

<div class="clear10"></div> <?php endif; ?>

			<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("My Shop Setup",'Walleto'); ?></div>
                <div class="box_content">   
               <?php
               
               	if(isset($_POST['product_submit_1']))
				{
					$shop_title = $_POST['shop_title'];
					$shop_description = $_POST['shop_description'];
					
					  $my_post = array();
					  $my_post['ID'] 			= $shop_id;
					  $my_post['post_title'] 	= $shop_title;
					  $my_post['post_content'] 	= $shop_description;
					  $my_post['post_status'] 	= 'publish';
					
					// Update the post into the database
					  wp_update_post( $my_post );
						
						update_post_meta($shop_id, 'facebook', trim($_POST['facebook']));
						update_post_meta($shop_id, 'twitter', trim($_POST['twitter']));
					
					//---------------------------------------------------------------
					
					$product_category 		= $_POST['product_cat_cat'];	
					$term = get_term( $product_category, 'product_cat' );	
					$product_category = $term->slug;
					wp_set_object_terms($shop_id, array($product_category),'product_cat');
					
					//---------------------------------------------------------------
					
					$shop_location 		= $_POST['shop_location_cat'];	
					$term = get_term( $shop_location, 'shop_location' );	
					$shop_location = $term->slug;
					wp_set_object_terms($shop_id, array($shop_location),'shop_location');
					
					//---------------------------------------------------------------
										
					echo '<div class="saved_thing">'.__('Info saved!','ProjectTheme').'</div> <div class="clear10"></div>';
				}			   
			   
			   
			   ?>
               
             <?php 
			 
			 $post_shop = get_post($shop_id); 
			 $cat 		= wp_get_object_terms($shop_id, 'product_cat');
			 $loc 		= wp_get_object_terms($shop_id, 'shop_location');
			 
			 ?>  
			<form method="post"  >  
    <ul class="post-new3">
        <li>
        	<h2><?php echo __('Your shop URL', 'Walleto'); ?>:</h2>
        	<p><a target="_blank" href="<?php echo get_permalink($post_shop->ID) ?>"><?php echo ($post_shop->post_title == "Auto Draft" ? __('Shop not setup yet.','Walleto') : $post_shop->post_title );  ?></a></p>
        </li>
        
        
        <li><h2><?php echo __('Shop Category', 'Walleto'); ?>:</h2>
        	<p><?php	echo Walleto_get_categories("product_cat",  
			!isset($_POST['product_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : $_POST['product_cat_cat']
			, __("Select Category","Walleto"), "do_input p_text_box"); ?></p>
        </li>
        
        
        <!--li><h2><?php // echo __('Shop Location', 'Walleto'); ?>:</h2>
        	<p><?php//echo Walleto_get_categories("shop_location",  
			//!isset($_POST['shop_location_cat']) ? (is_array($loc) ? $loc[0]->term_id : "") : $_POST['shop_location_cat']
			//, __("Select Location","Walleto"), "do_input p_text_box"); ?></p>
        </li-->
        
        <li>
        	<h2><?php echo __('Your shop title', 'Walleto'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input p_text_box" name="shop_title" value="<?php echo ($post_shop->post_title == "Auto Draft" ? __('Shop not setup yet.','Walleto') : $post_shop->post_title );  ?>" /></p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Facebook Link', 'Walleto'); ?>:</h2>
        	<p><input type="text" size="40" class="do_input p_text_box" name="facebook" value="<?php echo get_post_meta($post_shop->ID, 'facebook', true);  ?>" /></p>
        </li>
        
        <li>
        	<h2><?php echo __('Twitter Link', 'Walleto'); ?>:</h2>
        	<p><input type="text" size="40" class="do_input p_text_box" name="twitter" value="<?php echo get_post_meta($post_shop->ID, 'twitter', true);  ?>" /></p>
        </li>
        
        
         <li>
        	<h2><?php echo __('Portfolio Pictures','Walleto'); ?>:</h2>
        	<p>
			
       <script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/jquery.uploadify-3.1.js"></script>     
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.css" type="text/css" />
    
	<style>
			#fileUpload4 { float:left }
	</style>
           
    <script type="text/javascript">
	
	function delete_this(id)
	{
		 $.ajax({
						method: 'get',
						url : '<?php echo get_bloginfo('siteurl');?>/index.php/?_ad_delete_pid='+id,
						dataType : 'text',
						success: function (text) {   $('#image_ss'+id).remove();  }
					 });
		  //alert("a");
	
	}

	
	
	$(function() {
		
		$("#fileUpload4").uploadify({
			height        : 30,
			auto:			true,
			swf           : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploadify.swf',
			uploader      : '<?php echo get_bloginfo('template_url'); ?>/lib/uploadify/uploady8.php',
			width         : 180,
			buttonText	: 'Add Portfolio Images',
			fileTypeExts  : '*.jpg;*.jpeg;*.gif;*.png',
			formData    : {'ID':<?php echo $shop_id; ?>,'author':<?php echo $uid; ?>},
			onUploadSuccess : function(file, data, response) {
			
			//alert(data);
			var bar = data.split("|");
			
$('#thumbnails').append('<div class="div_div" id="image_ss'+bar[1]+'" ><img width="70" class="image_class" height="70" src="' + bar[0] + '" /><a href="javascript: void(0)" onclick="delete_this('+ bar[1] +')"><img border="0" src="<?php echo get_bloginfo('template_url'); ?>/images/delete_icon.png" border="0" /></a></div>');
}
	
			
			
    	});
		
		
	});
	
	
	</script>
	
    <style type="text/css">
	.div_div
	{
		margin-left:5px; float:left; 
		width:110px;margin-top:10px;
	}
	
	</style>
    
    <div id="fileUpload4" style="width:100%">You have a problem with your javascript</div>
    <div id="thumbnails" style="overflow:hidden;margin-top:20px;width:650px; float:left">
    
    <?php

		$args = array(
		'order'          => 'ASC',
		'orderby'        => 'post_date',
		'post_type'      => 'attachment',
		'author'    => $current_user->ID,
		'meta_key' 			=> 'is_portfolio',
		'meta_value' 		=> '1',
		'post_mime_type' 	=> 'image',
		'numberposts'    	=> -1,
		'post_parent'    	=> $shop_id,
		); $i = 0;
		
		$attachments = get_posts($args);



	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = wp_get_attachment_url($attachment->ID);
		
			echo '<div class="div_div"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
			walleto_generate_thumb($attachment->ID, 70, 70). '" />
			<a href="javascript: void(0)" onclick="delete_this(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
			</div>';
	  
	}
	}


	?>
    
    </div>
            
            
            </p>
        </li>
        
        <li>
        	<h2><?php echo __('Description', 'Walleto'); ?>:</h2>
        <p><textarea rows="6" cols="45" class="do_input p_textarea" id="shop_description"  name="shop_description"><?php echo $post_shop->post_content; ?></textarea></p>
        </li>
        
        
         <li>
        <h2>&nbsp;</h2>
        <p>      <input type="submit" name="product_submit_1" value="<?php _e("Save Information", 'Walleto'); ?>" /></p>
        </li>
        
        </ul>
        </form>
        
			</div>
			</div>
		 
 
		</div> <!-- end div content -->


<?php

	//echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>
