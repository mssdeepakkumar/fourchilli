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

	 
	global $current_user, $wp_query;
	$pid 	=  $wp_query->query_vars['pid'];
	
	global $post_au;
	$post_au = get_post($pid);
	
	
	function Walleto_filter_ttl($title){ global $post_au; return __("Edit Product Product",'Walleto')." - ".$post_au->post_title;}
	add_filter( 'wp_title', 'Walleto_filter_ttl', 10, 3 );	
	
	if(!is_user_logged_in()) { wp_redirect(get_bloginfo('siteurl')."/wp-login.php"); exit; }   
	   
	
	get_currentuserinfo();   

	$uid 	= $current_user->ID;
	$title 	= $post_au->post_title;
	$cid 	= $current_user->ID;
	
	if($uid != $post_au->post_author) { echo 'Not your post. Sorry!'; exit; }
	
	//=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	
			global $wpdb,$wp_rewrite,$wp_query;
		

	$show_ok = false;
	if(isset($_POST['product_submit_edit']))
	{
		$product_title 			= trim(strip_tags($_POST['product_title']));
		$product_description 	= nl2br(strip_tags($_POST['product_description']));
		$product_tags 			= trim(strip_tags($_POST['product_tags']));
		
		$my_post = array();
		$my_post['ID'] 			= $pid;
		$my_post['post_title'] 	= $product_title;
		$my_post['post_content'] 	= $product_description;
		
		// Update the post into the database
		wp_update_post( $my_post );
		
		//----------------------------------------------
		
		$other_details = $_POST['other_details'];
		$price 		= trim($_POST['price']);
		$shipping 	= trim($_POST['shipping']);
		$quant 		= trim($_POST['quant']);
		
		$do_not_require_shipping 	= isset($_POST['do_not_require_shipping']) ? "1" : "0";
		$featured 					= isset($_POST['featured']) ? "1" : "0";
		
		
		update_post_meta($pid,'do_not_require_shipping', 		$do_not_require_shipping);
		update_post_meta($pid,'price', 		$price);
		update_post_meta($pid,'shipping', 	$shipping);
		update_post_meta($pid,'quant', 		$quant);
		update_post_meta($pid,'featured', 		$featured);
		update_post_meta($pid,'other_details', 		$other_details);
		
		$show_ok = true;	
	}

//-------------------------------------

	get_header();
	
	$post_au = get_post($pid);
	$cat 		= wp_get_object_terms($pid, 'product_cat');
	$Walleto_currency_position = get_option('Walleto_currency_position');
	
?>

		<!--left side bare end-->
		<?php   $path = get_template_directory().'/left_sidebar.php';
		include($path); ?>
		<!--right side banner main wrapper start--> 
		<section id="right_side_banner_main_wrapper">
		 <!--left side bar-->
		<section id="left_section_right_side_banner">
		<section class="middle_text_section_wrapper">   
		<div class="product_list_heading"> <span class="heading_text"><?php printf(__("Edit Product - %s", "Walleto"), $post_au->post_title); ?></span></div>
               
            	
                <?php
                	
					if($show_ok == true)
					{
						echo '<div class="saved_thing">';
						echo __('Your product has been saved successfully.','Walleto');
						echo '</div>';	
						
						echo '<div class="clear10"></div>';
					}
                
                ?>
                
                
                    <ul class="post-new"> 
	<li>
                            <span class="p_form_name"><?php echo __('Images', 'Walleto'); ?>:</span>
                            <p>
    					

<div id="mcont">
    <form id="fileupload" action="<?php bloginfo('url'); ?>/?uploady_thing=1&pid=<?php echo $pid; ?>" method="POST" enctype="multipart/form-data">
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
                
                
        <div class="p_info_form">        
	<form method="post">
       
	<ul class="post-new_edit_proj post-new p_form_box">
	    <li>
		<span class="p_form_name"><?php echo __('Your product title', 'Walleto'); ?>:</span>
		<p><input type="text" class="do_input p_text_box" name="product_title" value="<?php echo  $post_au->post_title; ?>" /> </p>
	    </li>
       
       
        <li><span class="p_form_name"><?php echo __('Category', 'Walleto'); ?>:</span>
	    <p><?php	echo Walleto_get_categories("product_cat", (is_array($cat) ? $cat[0]->term_id : ""), __("Select Category","Walleto"), "do_input p_text_box"); ?></p>
	</li>
               
               
        <li>
        <span class="p_form_name"><?php echo __('Product Price', 'Walleto'); ?>:</span>
        <?php if($Walleto_currency_position == "front") echo walleto_get_currency(); ?>
        <input type="text"  name="price" class="do_input p_text_box_small" 
        	value="<?php echo  get_post_meta($pid, 'price', true) ; ?>" />
	<?php if($Walleto_currency_position != "front") echo walleto_get_currency(); ?>
       
           
        </li>
        
        <li id="quantity_li" >
        	<span class="p_form_name"><?php echo __('Quantity', 'Walleto'); ?>:</span>
        <p><input type="text"  name="quant" class="do_input p_text_box_small" value="<?php echo get_post_meta($pid, 'quant', true) ; ?>" /> 
            
        </li>
        
              
              
              
        <li>
        <span class="p_form_name"><?php echo __('Shipping Cost', 'Walleto'); ?>:</span>
        <?php if($Walleto_currency_position == "front") echo walleto_get_currency(); ?>
        <input type="text"  name="shipping" class="do_input p_text_box_small" 
        	value="<?php echo get_post_meta($pid, 'shipping', true); ?>" />
	<?php if($Walleto_currency_position != "front") echo walleto_get_currency(); ?>
        <input type="checkbox" value="1" name="do_not_require_shipping" /> <?php _e('This item does not require shipping.','Walleto'); ?>
            
          
        </li>
        
 
        <li>
        	<span class="p_form_name"><?php echo __('Description', 'Walleto'); ?>:</span>
        <p><textarea  class="do_input p_textarea" id="product_description"  name="product_description"><?php echo  trim($post_au->post_content); ?></textarea>
 
        </p>
        </li>
        
        <?php do_action('Walleto_step2_form_thing', $pid) ?>
        
        <li>
        	<span class="p_form_name"><?php echo __('Other Details', 'Walleto'); ?>:</span>
        <p><textarea  class="do_input p_textarea" id="other_details"  name="other_details"><?php echo get_post_meta($pid, 'other_details', true); ?></textarea>
 
        </p>
        </li>


		<?php do_action('Walleto_after_description_li'); ?>

	 	<li>
        <span class="p_form_name"><?php _e("Feature product?",'Walleto');  ?>:</span>
        <p><input type="checkbox" class="do_input" name="featured" <?php echo (get_post_meta($pid,'featured', true) == "1" ? 'checked="checked"' : ''); ?> value="1" /> 
       </p>
        </li>
 
       
       <?php
	    
		$product_tags = '';
	   
	   	$t = wp_get_post_tags($pid);
		foreach($t as $tg)
		{
			$product_tags .= $tg->name . ', ';	
		}
	   
	   ?>

	<li>
	<span class="p_form_name"><?php echo __('Tags', 'Walleto'); ?>:</span>
        <p><input type="text" class="do_input p_text_box"  name="product_tags" value="<?php echo $product_tags; ?>" /> 
        <?php do_action('Walleto_step1_after_tags_field');  ?> </p>
        </li>
        <?php do_action('Walleto_after_tags_li'); ?>
        
	
	<li>
        <input class="pink-btn" type="submit" name="product_submit_edit" value="<?php _e("Save Product", 'Walleto'); ?>" />
        </li>
              
        </ul> 
        </form>
        </div>        
               

	
	
	</section>
	</section>	
	<!--right side bar-->
        <section id="right_section_right_side_banner">       
           
	     <?php echo Walleto_get_users_links();?>
            	
                	
        </section>
        <!--right side bar end-->
	</section>
		
	<?php //Walleto_get_users_links(); ?>

<?php get_footer(); ?>
