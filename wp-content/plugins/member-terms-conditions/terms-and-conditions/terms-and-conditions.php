<div class="wrap">

<?php

//Check if user has agreed to the terms and conditions, if not display the terms and conditions else save the settings and display the welcome message.
if(!$_POST['terms-and-conditions']){

  //get the site name form settings
  if(function_exists('get_current_site')){
    $site_name = get_site_option('terms_and_conditions_sitename');
  }else{
    $site_name = get_option('terms_and_conditions_sitename');
  }

  //read the terms and conditions and privacy policy from file then format them for desplay
  $terms_and_conditions = stripslashes(file_get_contents(_TACPATH . 'terms-and-conditions' . DIRECTORY_SEPARATOR . 'terms-and-conditions.txt'));
  $terms_and_conditions = nl2br($terms_and_conditions);
  $terms_and_conditions = str_replace("%%WEBSITENAME%%", $site_name, $terms_and_conditions);
  
  $privacy_policy       = stripslashes(file_get_contents(_TACPATH . 'terms-and-conditions' . DIRECTORY_SEPARATOR . 'privacy-policy.txt'));
  $privacy_policy       = nl2br($privacy_policy);
  $privacy_policy       = str_replace("%%WEBSITENAME%%", $site_name, $privacy_policy);
  
  //the url the page will post to - I.e this script
  $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	
	//the agreement page
?>
  <h2>Members Agreement </h2>
	<p>Welcome to <?php echo $site_name; ?>, before you can start using this service, you must read and agree to the Terms of Use and Privacy Policy, including any future amendments.</p>
  <br class="clear">
  
  <h2 style="border:0px;">Terms of Use</h2>
  <div style="width:100%; height:250px; border:1px solid #C6D9E9; border-right:0px; padding:5px; overflow: auto"><?php echo $terms_and_conditions; ?></div>
  <br class="clear">
  
  <h2 style="border:0px;">Privacy Policy </h2>
  <div style="width:100%; height:250px; border:1px solid #C6D9E9; border-right:0px; padding:5px; overflow: auto"><?php echo $privacy_policy; ?></div>
  <br class="clear">
  
  <h2 style="border:0px;">The Agreement</h2>

  <form id="post" method="post" action="" name="post">
	<input type="hidden" name="terms-and-conditions" value="Yes">
	<p>By clicking "I agree" you are indicating that you have read and agree to the above Terms of Use and Privacy Policy.</p>
	<br /><input id="i_agree" type="submit" value="I agree" name="i_agree"/> <input type="button" value="I disagree" onClick="window.location='<?php echo site_url('wp-login.php?action=logout', 'login') ?>'">
	</form>
<?php
}else{
  //update cuttent users terms_and_conditions
	global $current_user;
  update_usermeta($current_user->ID, "terms_and_conditions", date("d.m.Y"));
  
  //get the site name form settings
  if(function_exists('get_current_site')){
    $site_name = get_site_option('terms_and_conditions_sitename');
  }else{
    $site_name = get_option('terms_and_conditions_sitename');
  }

  //read the welcome text from file then format for desplay
  $welcome       = stripslashes(file_get_contents(_TACPATH . 'terms-and-conditions' . DIRECTORY_SEPARATOR . 'welcome.txt'));
  $welcome       = nl2br($welcome);
  $welcome       = str_replace("%%WEBSITENAME%%", $site_name, $welcome);

//desplay welcome message.
?>

<h2>Welcome</h2>

<?php echo $welcome; ?>

<?php
}
?>
</div>
