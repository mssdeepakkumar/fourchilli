<?php

	global $wpdb,	$wp_rewrite,	$wp_query;
	$pid = $_GET['contact_owner_thing'];
	$post = get_post($pid);

?>

<script type="text/javascript">

function check_submits()
{
	if($('#your_name').val().length == 0)
	{
		alert("<?php _e('You have to type in your name.','Buzzler'); ?>");
		return false;
	}
	else if($('#your_email').val().length == 0)
	{
		alert("<?php _e('You have to type in your email.','Buzzler'); ?>");
		return false;
	}
	else if($('#your_message').val().length == 0)
	{
		alert("<?php _e('You have to type in your message.','Buzzler'); ?>");
		return false;
	}
	
	else return true;
}


</script>


	<style> * { text-align:left } </style>
	<div class="box_title"><?php echo sprintf(__("Contact owner on listing: %s",'Buzzler'), $post->post_title ); ?></div>
  	<div class="bid_panel" style="width:550px;height:300px">
    <div class="padd10">
    
    <form onsubmit="return check_submits();" method="post" action="<?php echo get_permalink($pid); ?>"> 
                <input type="hidden" name="control_id" value="<?php echo base64_encode($pid); ?>" /> 
    
    	<table width="100%">
        	<tr>
            <td valign="top"><?php echo __('Your Name:','Buzzler') ?></td>
            <td valign="top"><input type="text" size="30" value="" class="do_input" name="your_name" id="your_name" /></td>
        	</tr>
            
            <tr>
            <td valign="top"><?php echo __('Your Email:','Buzzler') ?></td>
            <td valign="top"><input type="text" size="30" value="" class="do_input" name="your_email" id="your_email" /></td>
        	</tr>
            
            
            <tr>
            <td valign="top"><?php echo __('Your Message:','Buzzler') ?></td>
            <td valign="top"><textarea class="do_input" rows="5" cols="30" name="your_message" id="your_message"></textarea></td>
        	</tr>
            
            <tr>
            <td>&nbsp;</td>
            <td> </td>
        	</tr>
            
            
            <tr>
            <td></td>
            <td><input type="submit" value="<?php echo __('Send Now','Buzzler') ?>" class="do_input" name="submit_me" /></td>
        	</tr>
            
        
        </table>
    </form>
    
    </div>
    </div>