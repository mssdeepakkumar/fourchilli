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

if(!function_exists('walleto_post_new_product_content_area_function'))
{
function walleto_post_new_product_content_area_function()
{
	ob_start();
	
		
	$new_product_step =  $_GET['step'];
	if(empty($new_product_step)) $new_product_step = 1;
	
	$pid = $_GET['product_id'];
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	$uploaders = walleto_get_uploaders_tp();
	
	?>
    
    			<div class="my_box3"> 
            
            	<div class="box_title"><?php echo sprintf(__("Post New Product",'Walleto')); ?></div>
                <div class="box_content">   
                
                <div class="special_breadcrumb"><div class="padd10">
    		
            <?php
			
				if($new_product_step >= 1):			
				echo '<span class="cate_tax-bold">'.__('About Your Product','Walleto').'</span> > ';					
				endif;// endif step 3
				
				if($new_product_step >= 2):			
					echo '<span class="cate_tax-bold">'.__('Add Photos','Walleto').'</span> > ';					
				endif;// endif step 4
				
				if($new_product_step >= 3):			
					echo '<span class="cate_tax-bold">'.__('Review & Publish','Walleto').'</span> ';					
				endif;// endif step 4
			?>
            
            </div></div>
                
               <?php
				
				echo '<div id="steps">';
		
					echo '<ul>';

						echo '<li '.($new_product_step == '1' ? "class='active_step' " : "").'>'.__("About Your Product", 'Walleto').'</li>';
						echo '<li '.($new_product_step == '2' ? "class='active_step' " : "").'>'.__("Add Photos", 'Walleto').'</li>';
						echo '<li '.($new_product_step == '3' ? "class='active_step' " : "").'>'.__("Review & Publish", 'Walleto').'</li>';
					echo '</ul>';
					
				echo '</div>';

				
				
			?>
    
<!-- ####################################### Step 1 ######################################### -->             
<?php

if($new_product_step == "1")
{
	//-----------------
	global $error, $myPID;
	$myPID = $Pid;
	$post 		= get_post($pid);
	$cat 		= wp_get_object_terms($pid, 'product_cat');
	$Walleto_currency_position = get_option('Walleto_currency_position');
	
	if(is_array($error))
	if($productOK == 0)
	{
		echo '<div class="errrs">';
		
			foreach($error as $e)		
			echo '<div class="newad_error">'.$e. '</div>';	
	
		echo '</div>';
		
	}
	
	do_action('Walleto_step1_before');
	
	?>
    <script type="text/javascript">
	
		function check_quant()
		{
			$('#quantity_li').toggle('slow');
			$('#start_prc').toggle('slow');
			$('#res_prc').toggle('slow');			
		}
	
	</script>
    
    <form method="post" action="<?php echo Walleto_post_new_with_pid_stuff_thg($pid, $new_product_step);?>">  
    <ul class="post-new">
        <li>
        	<h2><?php echo __('Your product title', 'Walleto'); ?>:</h2>
        	<p><input type="text" size="50" class="do_input" name="product_title" 
            value="<?php echo (empty($_POST['product_title']) ? 
			($post->post_title == "Auto Draft" ? "" : $post->post_title) : $_POST['product_title']); ?>" /> <?php do_action('Walleto_step1_after_title_field');  ?></p>
        </li>
        
        <?php do_action('Walleto_after_title_li'); ?>

	 
        
        <li><h2><?php echo __('Category', 'Walleto'); ?>:</h2>
        	<p><?php	echo Walleto_get_categories("product_cat",  
			!isset($_POST['product_cat_cat']) ? (is_array($cat) ? $cat[0]->term_id : "") : $_POST['product_cat_cat']
			, __("Select Category","Walleto"), "do_input"); ?></p>
        </li>
        
        
        <?php do_action('Walleto_after_category_li'); ?>
 
 
         <li>
        	<h2><?php echo __('Product Price', 'Walleto'); ?>:</h2>
        <p><?php if($Walleto_currency_position == "front") echo walleto_get_currency(); ?>
        <input type="text" size="10" name="price" class="do_input" 
        	value="<?php echo (empty($_POST['price']) ? get_post_meta($pid, 'price', true) : $_POST['price']); ?>" /> <?php if($Walleto_currency_position != "front") echo walleto_get_currency(); ?>
             
             <?php do_action('Walleto_step1_after_price_field');  ?>
             </p>
        </li>
        
        <?php do_action('Walleto_after_price_li'); ?>
        
        

        
        <li id="quantity_liasd " >
        	<h2><?php echo __('Quantity', 'Walleto'); ?>:</h2>
        <p><input type="text" size="10" name="quant" class="do_input" 
        	value="<?php echo (empty($_POST['quant']) ? get_post_meta($pid, 'quant', true) : $_POST['quant']); ?>" /> 
            <?php do_action('Walleto_step1_after_quantity_field');  ?></p>
        </li>
        
        
        <?php do_action('Walleto_after_quantity_li'); ?>
        
	
        <li>
        	<h2><?php echo __('Shipping Cost', 'Walleto'); ?>:</h2>
        <p><?php if($Walleto_currency_position == "front") echo walleto_get_currency(); ?>
        <input type="text" size="10" name="shipping" class="do_input" 
        	value="<?php echo get_post_meta($pid, 'shipping', true); ?>" /> <?php if($Walleto_currency_position != "front") echo walleto_get_currency(); ?>
            
            <input type="checkbox" value="1" name="do_not_require_shipping" /> <?php _e('This item does not require shipping.','Walleto'); ?>
			
			<?php do_action('Walleto_step1_after_shipping_field');  ?>
            
            
            </p>
        </li>
        
        
        <?php do_action('Walleto_after_shipping_li'); ?>
        
 
 
        
        <?php do_action('Walleto_after_address_li'); ?>
        
        <li>
        	<h2><?php echo __('Description', 'Walleto'); ?>:</h2>
        <p><textarea rows="6" cols="60" class="do_input" id="product_description"  name="product_description"><?php 
		echo empty($_POST['product_description']) ? trim($post->post_content) : $_POST['product_description']; ?></textarea>
        <?php do_action('Walleto_step1_after_description_field');  ?>
        </p>
        </li>
        
        
        <li>
        	<h2><?php echo __('Other Details', 'Walleto'); ?>:</h2>
        <p><textarea rows="3" cols="60" class="do_input" id="other_details"  name="other_details"><?php echo get_post_meta($pid, 'other_details', true); ?></textarea>
        <?php do_action('Walleto_step1_after_other_details_field');  ?>
        </p>
        </li>


		<?php do_action('Walleto_after_description_li'); ?>

	 <li>
        <h2><?php _e("Feature product?",'Walleto');  ?>:</h2>
        <p><input type="checkbox" class="do_input" name="featured" <?php echo (get_post_meta($pid,'featured', true) == "1" ? 'checked="checked"' : ''); ?> value="1" /> 
        <?php do_action('Walleto_step1_after_featured_field');  ?>
        
       </p>
        </li>
        
        <?php do_action('Walleto_after_feature_li'); ?>
        
 
        
       
       <?php
	    
		$product_tags = '';
	   
	   	$t = wp_get_post_tags($pid);
		foreach($t as $tg)
		{
			$product_tags .= $tg->name . ', ';	
		}
	   
	   ?>

		<li>
        	<h2><?php echo __('Tags', 'Walleto'); ?>:</h2>
        <p><input type="text" size="50" class="do_input"  name="product_tags" value="<?php echo $product_tags; ?>" /> 
        <?php do_action('Walleto_step1_after_tags_field');  ?> </p>
        </li>
        
        
     	<?php do_action('Walleto_after_tags_li'); ?>
        
        <li>
        <h2>&nbsp;</h2>
        <p>
        <?php 
		
		//echo '<a class="goback-link" href="'.Walleto_post_new_link().'/step/1/?substep='.(count($_SESSION['Walleto_stored_categories'])).'&post_new_product_id='.  $pid.'">
		//'.__('Go Back','Walleto').'</a>';
		
		 ?>
        <input type="submit" name="product_submit_1" value="<?php _e("Next Step", 'Walleto'); ?> >>" /></p>
        </li>
    
    	<?php do_action('Walleto_after_submit_li'); ?>
    
    </ul>
    </form>
    
<?php } ?>                  
 
 <!-- ####################################### Step 2 ######################################### -->   
    
    
    
    
    
    
<?php
    
if($new_product_step == 2)
{

	$img_nr = get_option("ad_theme_pic_nr");
	$catid 	= $_SESSION['posted_thing_cat'];
	$wii = get_option('ad_uploaded_image_width');
	
	if(empty($img_nr)) $img_nr = 5;
	
	global $current_user;
	get_currentuserinfo();
	$cid = $current_user->ID;

	
	if($uploaders == "html") $enc = 'enctype="multipart/form-data"';
	
	?>
    <!-- ###########################  -->
    <?php
		
		if($uploaders == "jquery"):
	
	?>
    
    <ul class="post-new">
    <li>
                            <h2><?php echo __('Images', 'Walleto'); ?>:</h2>
                            <p>
    					
	<div id="mcont">
    <form id="fileupload" action="<?php bloginfo('siteurl'); ?>/?uploady_thing=1&pid=<?php echo $pid; ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    <input type="hidden" name="cid" value="<?php echo $cid; ?>">
    
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                 
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
    
 
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
 

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                <i class="icon-trash icon-white"></i>
                <span>Delete</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>

</div>

    
    						</p>
    						</li>
    
    </ul>    
    
    
    <?php endif; //endif jquery uploads ?>
    
    <!-- ########################## -->
    
    <form method="post" <?php echo $enc; ?>  action="<?php echo Walleto_post_new_with_pid_stuff_thg($pid, $new_product_step);?>" > 
      <ul class="post-new">
      
      <?php
	  	if($uploaders == "html"):
	  ?>
      
 <li>
                            <h2><?php echo __('Images', 'Walleto'); ?>:</h2>
                            <p>
          <?php
		  
		  		$args = array(
				'order'          => 'ASC',
				'orderby'        => 'post_date',
				'post_type'      => 'attachment',
				'post_parent'    => $pid,
				'post_mime_type' => 'image',
				'numberposts'    => -1,
				); $i = 0;
				
				$attachments = get_posts($args);
				
				$default_nr = get_option('Walleto_nr_max_of_images');
		  		if(empty($default_nr)) $default_nr = 5;
				
				$actual_nr = count($attachments);
				$dis = $default_nr - $actual_nr;
		  
		  		for($i=1;$i<=$dis;$i++):
				?>                   
        		
                	<input type="file" class="do_input file_inpt" name="file_<?php echo $i; ?>" />
				
				<?php	endfor; ?>
       
                          </p>
                            </li>
                           
                           <li>
                           
                            <div id="thumbnails" style="overflow:hidden;">
                            
                                          <script type="text/javascript"> var $ = jQuery;
	
	function delete_this3(id)
	{
		 jQuery.ajax({
						method: 'get',
						url : '<?php echo get_bloginfo('siteurl');?>/?_ad_delete_pid='+id,
						dataType : 'text',
						success: function (text) {   $('#image_ss'+id).remove(); window.location.reload();  }
					 });
		  //alert("a");
	
	}
	
</script>
                            
    
    <?php

	

	if($pid > 0)
	if ($attachments) {
	    foreach ($attachments as $attachment) {
		$url = wp_get_attachment_url($attachment->ID);
		
			echo '<div class="div_div2"  id="image_ss'.$attachment->ID.'"><img width="70" class="image_class" height="70" src="' .
			Walleto_wp_get_attachment_image($attachment->ID, array(70, 70)). '" />
			<a href="javascript: void(0)" onclick="delete_this3(\''.$attachment->ID.'\')"><img border="0" src="'.get_bloginfo('template_url').'/images/delete_icon.png" /></a>
			</div>';
	  
	}
	}


	?>
    
    </div>
                           
                           </li>

 	<?php endif; //image uploaders html ?>
 
 
 		<?php /*-------  custom fields  -------- */ ?>
        <?php
		
		$product_cat = wp_get_object_terms($pid, 'product_cat');
		$cate = array($product_cat[0]->term_id);
		
		$arr 	= get_product_category_fields($cate, $pid);
		
		for($i=0;$i<count($arr);$i++)
		{
			
			        echo '<li>';
					echo '<h2>'.$arr[$i]['field_name'].$arr[$i]['id'].':</h2>';
					echo '<p>'.$arr[$i]['value'];
					do_action('Walleto_step2_after_custom_field_'.$arr[$i]['id'].'_field');
					echo '</p>';
					echo '</li>';
					
					do_action('Walleto_after_field_'.$arr[$i]['id'].'_li');
			
			
		}	
		
		
		do_action('Walleto_step2_form_thing', $pid);
		
		
		?>        
 
 
        <li>
        <h2>&nbsp;</h2>
        <p>
        <?php
        
		echo '<a class="goback-link" href="'.Walleto_post_new_with_pid_stuff_thg($pid, ($new_product_step-1)).'">'.__('Go Back','Walleto').'</a>';
		
		?>
        <input type="submit" name="product_submit_photos" value="<?php _e("Next Step", 'Walleto'); ?> >>" /></p>
        </li>
    
    
    </ul>
    </form>
    
  <?php } //end step2 ?>  
     
 <?php


if($new_product_step == "3")
{
	if($_GET['finalise'] == "yes") $finalise = true;
	else $finalise = false;
	
	
	//-----------------------
	
	$Walleto_new_product_listing_fee = get_option('Walleto_new_product_listing_fee');
	if(empty($Walleto_new_product_listing_fee)) $Walleto_new_product_listing_fee = 0;
	
	$Walleto_new_product_feat_listing_fee = get_option('Walleto_new_product_feat_listing_fee');
	if(empty($Walleto_new_product_feat_listing_fee)) $Walleto_new_product_feat_listing_fee = 0;
	
	$Walleto_new_product_sealed_bidding_fee = get_option('Walleto_new_product_sealed_bidding_fee');
	if(empty($Walleto_new_product_sealed_bidding_fee)) $Walleto_new_product_sealed_bidding_fee = 0;
	
	$Walleto_get_images_cost_extra 	= Walleto_get_images_cost_extra($pid); 
	$catid 							= Walleto_get_item_primary_cat($pid);
	
	//---------------------------------
	
	$custom_set = get_option('Walleto_enable_custom_posting');
	if($custom_set == 'yes')
	{
		$posting_fee = get_option('Walleto_theme_custom_cat_'.$catid);
		if(empty($posting_fee)) $posting_fee = 0;		
	}
	else
	{
		$posting_fee = $Walleto_new_product_listing_fee;
	}
	
	
	//---------------------------------
	
	$payment_arr = array();
	
 
	//--------------------------------
	
	$featured = get_post_meta($pid, 'featured', true);
	
	if($featured == "1"):
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'feat_fee';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $Walleto_new_product_feat_listing_fee;
		$my_small_arr['description'] 	= __('Featured Listing Fee','Walleto');
		array_push($payment_arr, $my_small_arr);
	endif;
	
	 
	
	
		$my_small_arr = array();
		$my_small_arr['fee_code'] 		= 'extra_img';
		$my_small_arr['show_me'] 		= true;
		$my_small_arr['amount'] 		= $Walleto_get_images_cost_extra;
		$my_small_arr['description'] 	= __('Extra Images Fee','Walleto');
		array_push($payment_arr, $my_small_arr);
	
	//--------------------------------
	
	$post 			= get_post($pid);
		
	//---------------------------------------------
	
	$new_total 		= 0;
		
	foreach($payment_arr as $payment_item):			
		if($payment_item['amount'] > 0):				
			$new_total += $payment_item['amount'];			
		endif;			
	endforeach;
	
	//----------------------------------------
	
	$total 			= $new_total;
	$total 			= apply_filters('Walleto_total_price_to_pay' , 			$total, $pid);

	$opt = get_option('Walleto_admin_approve_product');
	if($opt == "yes") $admin_must_approve = true;
	else $admin_must_approve = false;
	
	//-----------------------------------------
	
	do_action('Walleto_action_when_posting_product', $pid);
	do_action('Walleto_action_when_posting_product_payment_arr', $payment_arr, $new_total);
	
	if($total == 0)
	{
			global $current_user;
			get_currentuserinfo();
			
			echo '<div >';
			echo __('Thank you for posting your item with us.','Walleto');
			update_post_meta($pid, "paid", "1");
			
			
			
			if($finalise):
				if($admin_must_approve)
				{
					
					
					$my_post = array();
					$my_post['ID'] = $pid;
					$my_post['post_status'] = 'draft';
	
					wp_update_post( $my_post );
					
					
					
					Walleto_send_email_posted_item_not_approved($pid);
					Walleto_send_email_posted_item_approved_admin($pid);
					
					echo '<br/>'.__("Your product isn't yet live, the admin needs to approve it.", "Walleto");
					
	
				
				}
				else
				{
					$my_post = array();
					$my_post['ID'] = $pid;
					$my_post['post_status'] = 'publish';
	
					wp_update_post( $my_post );
					
					Walleto_send_email_posted_item_approved($pid);
					Walleto_send_email_posted_item_not_approved_admin($pid);
					
				}
				
			
				
			endif;
			echo '</div>';
			
	
	}
	else
	{
			update_post_meta($pid, "paid", "0");
			
			echo '<div >';
			echo __('Thank you for posting your product with us. Below is the total price that you need to pay in order to put your product live.<br/>
			Click the pay button and you will be redirected...', 'Walleto');
			echo '</div>';
			
			
			
	}
	
	//----------------------------------------
	
	
	
	echo '<table style="margin-top:25px">';
	
	if($total > 0) :
	foreach($payment_arr as $payment_item):
			
			if($payment_item['amount'] > 0):
			
				echo '<tr>';
				echo '<td>'.$payment_item['description'].'&nbsp; &nbsp;</td>';
				echo '<td>'.Walleto_get_show_price($payment_item['amount'],2).'</td>';
				echo '</tr>';

			endif;
			
		endforeach;
	
	
				echo '<tr>';
	echo '<td>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	echo '<tr>';
	echo '<td><strong>'.__('Total to Pay','Walleto').'</strong></td>';
	echo '<td><strong>'.Walleto_get_show_price($total,2).'</strong></td>';
	echo '<tr>';
	
	
	echo '<tr>';
	echo '<td>&nbsp;<br/>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	endif;
	
	if($total == 0)
	{
		if(!$admin_must_approve && $finalise):
		
			echo '<tr>';
			echo '<td></td>';
			echo '<td><a href="'.get_permalink($pid).'" class="pay_now">'.__('See your product','Walleto') .'</a></td>';
			echo '<tr>';	
		
		endif;
		
	}
	else
	{
		update_post_meta($pid,'unpaid','1');
		
		$Walleto_enable_pay_credits = get_option('Walleto_enable_pay_credits');		
		if($Walleto_enable_pay_credits != 'no'):
			
			
			echo '<tr>';
			echo '<td><strong>'.__('Your Total Credits','Walleto').'</strong></td>';
			echo '<td><strong>'.Walleto_get_show_price(Walleto_get_credits($uid),2).'</strong></td>';
			echo '</tr>';
			
			echo '<tr>';
			echo '<td>'.__('Pay by Credits','Walleto').'</td>';
			echo '<td><a href="'.get_bloginfo('siteurl').'/?w_action=credits_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay Now','Walleto').'</a></td>';
			echo '<tr>';
		
		endif;
						
						echo '<tr>';
						echo '<td></td><td>';
		
						$Walleto_paypal_enable 		= get_option('Walleto_paypal_enable');
						$Walleto_alertpay_enable 		= get_option('Walleto_alertpay_enable');
						$Walleto_moneybookers_enable 	= get_option('Walleto_moneybookers_enable');
						
						
						if($Walleto_paypal_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?w_action=paypal_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by PayPal','Walleto').'</a>';
						
						if($Walleto_moneybookers_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?w_action=mb_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by MoneyBookers/Skrill','Walleto').'</a>';
						
						if($Walleto_alertpay_enable == "yes")
							echo '<a href="'.get_bloginfo('siteurl').'/?w_action=payza_listing&pid='.$pid.'" class="post_bid_btn">'.__('Pay by Payza','Walleto').'</a>';
						
						do_action('Walleto_add_payment_options_to_post_new_project', $pid);
						
						echo '</td></tr>';
		
		

	}
	
	
	echo '<tr>';
	echo '<td>&nbsp;<br/>&nbsp;</td>';
	echo '<td></td>';
	echo '<tr>';
	
	echo '</table>';
	
	
	
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
	echo '<div class="clear10"></div>';
	
	if(!$finalise)
	echo '<a href="'. Walleto_post_new_with_pid_stuff_thg($pid, '2') .'" class="go_back_btn" >'.__('Go Back','Walleto').'</a>';
	
	if($total == 0 && !$finalise)
	echo '<a href="'. Walleto_post_new_with_pid_stuff_thg($pid, '3', 'finalise').'" 
	class="go_back_btn" >'.__('Finalize and Publish Item','Walleto').'</a>';

}


 ?>

    
    
    
    
   <!-- end --> 
                
                
                </div>
                </div>
    
    
    
    <?php
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;	
	
}
}


?>