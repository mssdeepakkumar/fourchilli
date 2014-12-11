<!----popup login form---->
    <section class="login-submit-form" id="pop_wrapper"> 
		<section class="login_wrapper">
		<section class="login_form_inner">
                  <div class="login_heading">Sign in <a href="javascript:void(0);" class="img-circle transition" id="remove_popup">
		  <i class="icon-remove "></i></a></div>        

		  <form name="loginform" id="loginform" action="wp-login.php" method="post" class="sign_in_wrapper">

			      <div class="form-group"><label><?php _e('Username:',$current_theme_locale_name) ?><label>

				<input class="do_input form-control" required type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1); ?>"/>

			      </div>

							

                            

				<div class="form-group"><label><?php _e('Password:',$current_theme_locale_name); ?></label>

				<input class="do_input form-control" type="password" required name="pwd" id="login_password" value=""/>
				
				<a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=lostpassword" title="<?php _e('Password Lost and Found',$current_theme_locale_name) ?>">
			        <small class="red-txt"><?php _e('Lost your password?',$current_theme_locale_name) ?></small></a>
			        <span style="float:right;margin-top:10px;"><input class="do_input" name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="3" /> 

				<span class="red-txt"><?php _e('Keep me logged in',$current_theme_locale_name); ?></span></span>
				</div>

							

				

				

						<?php do_action('login_form'); ?>

                       

							

						<?php //if (get_settings('users_can_register')) : ?>

						<a class="join_free_now f-w-b red-txt pull-left" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=register"><?php _e('Join for free now!',$current_theme_locale_name) ?></a>

						<?php //endif; ?>

							
			

                             

				

				<div class="update sign_in_button "><input type="submit" class="submit_bottom" name="submits" id="submits" value="<?php _e('Login',$current_theme_locale_name); ?>"  style="background:none;border:none;color:#FFFFFF" /><i class="icon-key"></i></div>

				<input type="hidden" name="redirect_to" value="<?php echo $_GET['redirect_to']; ?>" />

				

							

			</form>

				

                

	    </section>  
	    </section>
    </section>


<!----popup form---->


<style>
#select-regi {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);
    display: none;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 2147483647;
}
#select-regi_pop {
    background: none repeat scroll 0 0 #fff;
    display: block;
    height: 43px;
    line-height: 43px;
    padding: 10px 0 0 1px;
    position: absolute;
    right: -15px;
    text-align: center;
    top: -15px;
    width: 43px;
}
.sel-wapp{
	height:300px;

}
.updater
{
	
 background: linear-gradient(to bottom, #e33246 0%, #e02d42 24%, #d22135 65%, #cc192e 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #9a0414;
    color: #fff;
    float: right;
    font-family: 'OpenSansSemibold';
    padding: 8px 40;
}
.updater.top {
     float: none;
    margin: 0 auto;
    padding: 14px 36px;
    text-align: center;
    width: 230px;
}
.updater.bot {
float: none;
    margin: 0 auto;
    padding: 14px 46px;
    text-align: center;
    width: 244px;
}
.sel-wapp a:hover, .sel-wapp a:focus {
    color: #fff;
    text-decoration: none;
}
</style>
<section class="login-submit-form" id="select-regi" style="display:none;"> 
	<section class="login_wrapper">
	<section class="login_form_inner">
			  <div class="login_heading">Welcome to Four Chillies <a href="javascript:void(0);" class="img-circle transition" id="select-regi_pop">
	  <i class="icon-remove"></i></a></div>      
	  <div class="sel-wapp">
		  <div style="float: left;margin-top: 70px; text-align: center;width: 100%;">
		  
		 
		  <a href="http://fourchillies.com/register-user/" class="updater top">Register as a Shopper</a>
		   </div>
		   <div style="  float: left; margin-top: 40px;text-align: center;width: 100%;">
		  <a href="http://fourchillies.com/register-seller/" class="updater bot">Register as a Seller</a>
		  </div>
	  </div>
	</section>  
	</section>
</section>








<header id="header" class="outer_width">
	<!--top header start-->
	<section id="top_header" class="outer_width">
	<section class="inner_width">		
	    <!--<div class="rss_icon_div"><a href="<?php bloginfo('siteurl') ?>/?feed=rss2&post_type=product"><img src="<?php bloginfo('template_url') ?>/images/rss_icon.png" width="20" height="20" /></a></div>-->            
            <div class="top-links">
							
                        <ul class="list-unstyled m-b-none pull-left top_left_header">
						<?php 
								
								if(current_user_can('level_10')) {?> <li><a href="<?php bloginfo('siteurl'); ?>/wp-admin"><?php 
								echo __("Wp-Admin","Walleto"); ?></a></li> <?php }
							
								if(is_home())
								$home_class_active = 'active';	
								
								global $wp_query, $pagenow;
								$vars = $wp_query->query_vars;
								$special_page = $vars['special_page'];
								
								if($special_page == "post-new") 	$post_new_class 	= 'active';	
								if($special_page == "adv-sea") 		$adv_sea_new_class 	= 'active';
								if($special_page == "account") 		$account_new_class 	= 'active';
								if($special_page == "blog") 		$blog_new_class 	= 'active';	
								if($special_page == "watch") 		$watch_class 		= 'active';									
								if($pagenow == "wp-login.php") 		$class_log 		= "active";	
								if($pagenow == "wp-register.php") 	$class_register 	= "active";	
								
								
									$Walleto_show_blue_menu = get_option('Walleto_show_main_menu');
									
									if($Walleto_show_blue_menu != "yes"):
						?>
							
							<li><a href="<?php bloginfo('siteurl') ?>" class="<?php echo $home_class_active; ?>"><?php echo __("Home","Walleto"); ?></a> </li>
                            
                            
						<?php
							
							endif;
							
							$menu_name = 'primary-walleto-header';

							if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
							$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
							$menu_items = wp_get_nav_menu_items($menu->term_id);
					
						
							foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								if(!empty($title))
								echo '<li><a href="' . $url . '">' . $title . '</a></li>';
							}
								
							}
							
							
						?>
                        <li><a class="<?php echo $watch_class; ?>" href="<?php echo Walleto_watch_list(); ?>"><?php echo __("Watch List","Walleto"); ?></a> </li>
						<?php
							
								if(Walleto_is_able_to_post_products()):
							
						?>
							<li><a href="<?php echo Walleto_post_new_link(); ?>" class="<?php echo $post_new_class; ?>"><?php 
							echo __("Sell Product","Walleto"); ?></a> </li>
                            
						<?php endif; ?>
                            
						<?php if(get_option('Walleto_enable_blog') == "yes") { ?>
                        <li><a class="<?php echo $blog_new_class; ?>" href="<?php echo Walleto_blog_link(); ?>"><?php echo __("Blog","Walleto"); ?></a> </li>
							<?php } ?>
                            
						<?php
							
							if($Walleto_show_blue_menu != "yes"):
							
						?>
                            
                        <li><a href="<?php echo Walleto_advanced_search_link(); ?>" 
                            class="<?php echo $adv_sea_new_class; ?>"><?php _e("Advanced Search","Walleto");?></a></li> 
							<?php
							
								endif;
							
								if(is_user_logged_in())
								{
								
									global $current_user;
									get_currentuserinfo();
									$user = $current_user->user_login;
									?>
									
							<li><a href="<?php echo Walleto_my_account_link(); ?>" 
                            class="<?php echo $account_new_class; ?>"><?php echo __("MyAccount","Walleto"); ?> - <?php echo $user; ?></a></li>
							<li><a href="<?php echo wp_logout_url(); ?>"><?php echo __("Log Out","Walleto"); ?></a></li>
									
									<?php
								}
								else
									{
										
							
							?>
							
							<!--li><a class="<?php// echo $class_register; ?>" id="register_button" href="#"><?php //echo __("Register","Walleto"); ?></a></li-->
							<li><a class="test" id="register_button2" href="#"><?php echo __("Register","Walleto"); ?></a></li>
							<li><a class="<?php echo $class_log; ?>" id="login_button" href="#"><?php echo __("Log In","Walleto"); ?></a></li>
							<?php } ?>
                            
                        </ul>
			</div>
            
            
		
    			
        

			<?php
		
			$Walleto_show_main_menu = get_option('Walleto_show_main_menu');
			if($Walleto_show_main_menu != 'no'):
			
		
							
			$menu_name = 'primary-walleto-main-header';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
						
			$menu_items = wp_get_nav_menu_items($menu->term_id);
					
			$m = 0;			
			foreach ( (array) $menu_items as $key => $menu_item ) {
								$title = $menu_item->title;
								$url = $menu_item->url;
								if(!empty($title))
								$m++;
			}}
							
							
						
			
			?>

      
        
			<?php
		
			if($m == 0):
		
			?>
			<ul class="list-unstyled m-b-none top_right_header">
			<li class="padded_menu"><a href="<?php bloginfo('siteurl'); ?>" class="hm_cls"><?php _e('Home','Walleto'); ?></a></li>
			<li><a href="<?php echo get_post_type_archive_link('product'); ?>"><?php _e('All Products','Walleto'); ?></a></li> 
			<li><a href="<?php echo get_post_type_archive_link('shop'); ?>"><?php _e('All Shops','Walleto'); ?></a></li> 
			<li><a href="<?php echo get_permalink(get_option('Walleto_adv_search_id')); ?>"><?php _e('Advanced Search','Walleto'); ?></a></li> 
			<li><a href="<?php echo get_permalink(get_option('Walleto_all_cats_id')); ?>"><?php _e('Show All Categories','Walleto'); ?></a></li> 
    
                       
			</ul>
			<?php else: 
			
			$event = 'hover';
			$effect = 'fade';
			$fullWidth = ',fullWidth: true';
			$speed = 0;
			$submenu_width = 200;
			$menuwidth = 100;
		
			?>
        
			<script type="text/javascript">
				
				var $ = jQuery;
				
				jQuery(document).ready(function($) {
					jQuery('#<?php echo 'item_main_menus'; ?> .menu').dcMegaMenu({
						rowItems: <?php echo $menuwidth; ?>,
						subMenuWidth: '<?php echo $submenu_width; ?>',
						speed: <?php echo $speed; ?>,
						effect: '<?php echo $effect; ?>',
						event: '<?php echo $event; ?>'
						<?php echo $fullWidth; ?>
					});
				});
			</script>
       
       
			<div class="dcjq-mega-menu" id="<?php echo 'item_main_menus'; ?>">		
			<?php
			
			$menu_name = 'primary-walleto-main-header';

			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) 
			$nav_menu = wp_get_nav_menu_object( $locations[ $menu_name ] );					
							 
			
			wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'container' => false ) );
		
			?>		
		 
			<?php endif; ?>
			 <?php	
			else:
			//--------
		
		
			endif;	?>
        
			</section>
			</section>
<!--top header end-->


<!----popup Register form---->
<section class="register-submit-form" id="reg_pop_wrapper">
<section class="login_wrapper register_wrapper">
<section class="login_form_inner">
	<div class="login_heading">Register Now <a href="javascript:void(0);" class="img-circle transition" id="reg_remove_popup"><i class="icon-remove "></i></a></div>
	<?php if ( isset($errors) && isset($_POST['action']) ) : ?>
						  <div class="error">
							<ul>
							<?php
							foreach($errors as $error) {
							if(count($error) > 0) {
							
							foreach($error as $e) echo "<li>".$e[0]."</li>";
							
							
							}
							}
							?>
							</ul>
						  </div>
	<?php endif; ?>
	<form class="sign_in_wrapper" action="<?php echo site_url().'/wp-login.php?action=register';?>" method="post" id="loginform">
	<input type="hidden" name="action" value="register" />	
							<div class="form-group">							 
							<label for="register-firstname"><?php _e('First Name:',$current_theme_locale_name) ?></label>
							<input type="text" required class="do_input form-control" name="user_FIRSTNAME" id="user_firstname" size="30" maxlength="100" value="<?php echo wp_specialchars($user_firstname); ?>" />
							</div>

							<div class="form-group">							 
							<label for="register-lastname"><?php _e('Last Name:',$current_theme_locale_name) ?></label>
							<input type="text" required class="do_input form-control" name="user_LASTNAME" id="user_lastname" size="30" maxlength="100" value="<?php echo wp_specialchars($user_lastname); ?>" />
							</div>

							<div class="form-group">							 
							<label for="register-email"><?php _e('E-mail:',$current_theme_locale_name) ?></label>
							<input type="text" required class="do_input form-control" name="user_email" id="user_email" size="30" maxlength="100" value="<?php echo wp_specialchars($user_email); ?>" />
							</div>

							<div class="form-group">							 
							<label for="register-phone"><?php _e('Mobile Number:',$current_theme_locale_name) ?></label>
							<input type="text" required class="do_input form-control" name="user_phone" onkeypress="return numbersonly(event)" id="user_phone" size="30" maxlength="100" value="<?php echo wp_specialchars($user_phone); ?>" />
							</div>

							<div class="form-group">
							<label for="register-username"><?php _e('Username:',$current_theme_locale_name) ?></label>
							<input type="text" required class="do_input form-control" name="user_login" id="user_login" size="30" maxlength="20" value="<?php echo wp_specialchars($user_login); ?>" />
							</div>							
							
							
                        
							

							<span class="register_page_checkbox">&nbsp;&nbsp;
							<?php _e('Your password will be e-mailed or messaged to you within 24 hours.',$current_theme_locale_name) ?>
							</span>
							<!--<ul id="logins">
							<li><a href="<?php bloginfo('home'); ?>/" title="<?php _e('Are you lost?',$current_theme_locale_name) ?>"><?php _e('Home',$current_theme_locale_name) ?></a></li>
							<li><a href="<?php bloginfo('wpurl'); ?>/wp-login.php"><?php _e('Login',$current_theme_locale_name) ?></a></li>
							<li><a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=lostpassword" title="<?php _e('Password Lost?',$current_theme_locale_name) ?>"><?php _e('Lost your password?',$current_theme_locale_name) ?></a></li>
							</ul>-->
							<div class="update sign_in_button  pull-left">
						
							<i class="icon-user"></i><input type="submit" class="submit_bottom" value="<?php _e('Create your account',$current_theme_locale_name) ?>" id="submits" name="submits" style="background:none;border:none;color:#FFFFFF"/>
							</div>
						
    
</form>
</section>    
</section>    
</section>
<!----popup login form---->
</header>
<script type="text/javascript">
$(document).ready(function(){
	$('#login_button').click(function(e){
		$('#pop_wrapper').show(500);
		$('#remove_popup').click(function(){
		$('#pop_wrapper').hide(500);
			
		});
		
	});	
	$('#register_button2').click(function(e){	
		$('#select-regi').show(500);
		$('#select-regi_pop').click(function(){
		$('#select-regi').hide(500);
		});
	});	
});


function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
</script>
