<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - Walleto
*	More Info: http://sitemile.com/p/walleto
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/	
		
		function Walleto_do_register_scr()
		{
		  global $wpdb, $wp_query, $current_theme_locale_name;
		
		  if (!is_array($wp_query->query_vars))
			$wp_query->query_vars = array();
		
		header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));
		
	
		  switch( $_REQUEST["action"] ) 
		  {
			
			case 'register':
			 // require_once( ABSPATH . WPINC . '/registration-functions.php');
			  
				$user_login = sanitize_user( str_replace(" ","",$_POST['user_login']) );
				$user_email = trim($_POST['user_email']);
				$name = $_POST['user_FIRSTNAME'];
				$lastname = $_POST['user_LASTNAME'];
				$phone = $_POST['user_phone'];
				$sanitized_user_login = $user_login;				
				$errors = Walleto_register_new_user_sitemile($user_login, $user_email, $user_firstname, $user_lastname, $user_phone);
				
					if (!is_wp_error($errors)) 
					{	
						$ok_reg = 1;						
					}	
					if ($errors) {
						update_user_meta( $errors, 'first_name' , $name );
				 		update_user_meta( $errors, 'last_name' , $lastname );
				 		update_user_meta( $errors, 'phone' , $phone );
					}
				
			  if ( 1 == $ok_reg ) 
			  {//continues after the break; 
				
				global $real_ttl;
				$real_ttl = __("Registration Complete", $current_theme_locale_name);			
				add_filter( 'wp_title', 'Walleto_sitemile_filter_ttl', 10, 3 );	
				
				get_header();
				global $current_theme_locale_name;	
				
		?>
				
	    </section>
	    <!--left side bare end-->
	    <section id="right_side_banner_main_wrapper">
            <div class="box_content"><br/>
            	<div class="box_title"><?php _e('Registered',$current_theme_locale_name) ?></div>
			    <p><?php printf(__('Username: %s',$current_theme_locale_name), "<strong>" . wp_specialchars($user_login) . "</strong>") ?><br />
			    <?php printf(__('Password: %s',$current_theme_locale_name), '<strong>' . __('Your password will be e-mailed or messaged to you within 24 hours.',$current_theme_locale_name) . '</strong>') ?> <br />
			    <?php printf(__('E-mail: %s',$current_theme_locale_name), "<strong>" . wp_specialchars($user_email) . "</strong>") ?><br /><br />
			    <?php _e("Please check your <strong>Junk Mail</strong> if your account information does not appear within 5 minutes.",$current_theme_locale_name); ?>
                            </p>

			    <p class="submit"><a class="red-txt" href="wp-login.php"><?php _e('Login', $current_theme_locale_name); ?> &raquo;</a></p>
		</div>
	     </section>
             </section> 
	   
		<?php
								
				
				get_footer();
		
				die();
			break;
			  }//continued from the error check above
		
			default:
			
			global $real_ttl;
			$real_ttl = __("Register", $current_theme_locale_name);			
			add_filter( 'wp_title', 'Walleto_sitemile_filter_ttl', 10, 3 );	
			
			get_header();
			
		
			?>
				
	   
	    </section>
	    <!--left side bare end-->
	    <section id="right_side_banner_main_wrapper">
            <div class="product_list_heading"><br/>
	    <span class="heading_text"><?php _e("Register",$current_theme_locale_name); ?> - <?php echo  get_bloginfo('name'); ?></span></div>
	  
                <div class="box_content">
		  <section class="loginpage_wrapper">                                         
						  
						  <?php if ( isset($errors) && isset($_POST['action']) ) : ?>
						  <div class="error">
							<ul>
							<?php
							foreach ($errors->errors as $key => $value) {							
									echo "<li>".$value[0]."</li>";
								}
						/*	foreach($errors as $error) {
							if(count($error) > 0) {
							
							foreach($error as $e) echo "<li>".$e[0]."</li>";
							
							
							}
							}*/
							?>
							</ul>
						  </div>
						  <?php endif; ?>
						  <div class="login-submit-form">
                          
                          
						  <form method="post" id="loginform">
						  <input type="hidden" name="action" value="register" />	
							<div class="form-group">							 
							<label for="register-firstname"><?php _e('First Name:',$current_theme_locale_name) ?></label>
							<input type="text" required class="login_input" name="user_FIRSTNAME" id="user_firstname" size="30" maxlength="100" value="<?php echo wp_specialchars($user_firstname); ?>" />
							</div>

							<div class="form-group">							 
							<label for="register-lastname"><?php _e('Last Name:',$current_theme_locale_name) ?></label>
							<input type="text" required class="login_input" name="user_LASTNAME" id="user_lastname" size="30" maxlength="100" value="<?php echo wp_specialchars($user_lastname); ?>" />
							</div>

							<div class="form-group">							 
							<label for="register-email"><?php _e('E-mail:',$current_theme_locale_name) ?></label>
							<input type="text" required class="login_input" name="user_email" id="user_email" size="30" maxlength="100" value="<?php echo wp_specialchars($user_email); ?>" />
							</div>


							<div class="form-group">							 
							<label for="register-phone"><?php _e('Mobile Number:',$current_theme_locale_name) ?></label>
							<input type="text" required class="login_input" name="user_phone" id="user_phone" size="30" maxlength="100" onkeypress="return numbersonly(event)" value="<?php echo wp_specialchars($user_phone); ?>" />
							</div>


							<div class="form-group">
							<label for="register-username"><?php _e('Username:',$current_theme_locale_name) ?></label>
							<input type="text" required class="login_input" name="user_login" id="user_login" size="30" maxlength="20" value="<?php echo wp_specialchars($user_login); ?>" />
							</div>							
							
							<div class="form-group">
                        
							<?php //do_action('register_form'); ?>

							<div><label for="submitbtn">&nbsp;</label>
							<?php _e('Your password will be e-mailed or messaged to you within 24 hours.',$current_theme_locale_name) ?></p>
							

                          
							
						<p class="submit">
                        <label for="submitbtn">&nbsp;</label>
							 <input type="submit" class="submit_bottom" value="<?php _e('Register',$current_theme_locale_name) ?>" id="submits" name="submits" />
						</p>
                          
						  <ul id="register">
							<li><a class="green_btn" href="<?php bloginfo('home'); ?>/" title="<?php _e('Are you lost?',$current_theme_locale_name) ?>"><?php _e('Home',$current_theme_locale_name) ?></a></li>
							<li><a class="green_btn" href="<?php bloginfo('wpurl'); ?>/wp-login.php"><?php _e('Login',$current_theme_locale_name) ?></a></li>
							<li><a class="green_btn" href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=lostpassword" title="<?php _e('Password Lost?',$current_theme_locale_name) ?>"><?php _e('Lost your password?',$current_theme_locale_name) ?></a></li>
						  </ul>
						</div>
                        
                        
                        </section>
                        </div>
                        </section> 
	    </section></section>
                        
                        
		<?php
				
				
	 			  get_footer();
		
			  die();
			break;
			case 'disabled':
     
	 				global $real_ttl;
			$real_ttl = __("Registration Disabled", $current_theme_locale_name);			
			add_filter( 'wp_title', 'Walleto_sitemile_filter_ttl', 10, 3 );	
			
	 
	 			  get_header();
				
			
		?>



        <div class="clear10"></div>	
				<div class="my_box3">
            	<div class="padd10">

        <div class="box_title"><?php _e('Registration Disabled',$current_theme_locale_name) ?></div>
                <div class="box_content">
                                                  
							
							<p><?php _e('User registration is currently not allowed.',$current_theme_locale_name) ?><br />
							<a href="<?php echo get_settings('home'); ?>/" title="<?php _e('Go back to the blog',$current_theme_locale_name) ?>"><?php _e('Home',$current_theme_locale_name) ?></a>
							</p>
						</div></div></div>
		<?php
				
				 get_footer();
		
			  die();
			break;
		  }
		}


//===================================================================

function Walleto_register_new_user_sitemile( $user_login, $user_email, $user_firstname, $user_lastname ) {
	$errors = new WP_Error();
	global $current_theme_locale_name;
	$sanitized_user_login = sanitize_user( $user_login );
	$user_email = apply_filters( 'user_registration_email', $user_email );

	// Check the username
	if ( $sanitized_user_login == '' ) {
		$errors->add( 'empty_username', __( '<strong>ERROR</strong>: Please enter a username.', $current_theme_locale_name ) );
	} elseif ( ! validate_username( $user_login ) ) {
		$errors->add( 'invalid_username', __( '<strong>ERROR</strong>: This username is invalid because it uses illegal characters. Please enter a valid username.', $current_theme_locale_name ) );
		$sanitized_user_login = '';
	} elseif ( username_exists( $sanitized_user_login ) ) {
		$errors->add( 'username_exists', __( '<strong>ERROR</strong>: This username is already registered, please choose another one.', $current_theme_locale_name ) );
	}

	// Check the e-mail address
	if ( $user_email == '' ) {
		$errors->add( 'empty_email', __( '<strong>ERROR</strong>: Please type your e-mail address.', $current_theme_locale_name ) );
	} elseif ( ! is_email( $user_email ) ) {
		$errors->add( 'invalid_email', __( '<strong>ERROR</strong>: The email address isn&#8217;t correct.', $current_theme_locale_name ) );
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$errors->add( 'email_exists', __( '<strong>ERROR</strong>: This email is already registered, please choose another one.', $current_theme_locale_name ) );
	}

	do_action( 'register_post', $sanitized_user_login, $user_email, $errors );

	$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );

	if ( $errors->get_error_code() )
		return $errors;

	$user_pass = wp_generate_password( 12, false);
	$user_id = wp_create_user( $sanitized_user_login, $user_pass, $user_email );
	if ( ! $user_id ) {
		$errors->add( 'registerfail', sprintf( __( '<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !', $current_theme_locale_name ), get_option( 'admin_email' ) ) );
		return $errors;
	}

	update_user_option( $user_id, 'default_password_nag', true, true ); //Set up the Password change nag.

	Walleto_new_user_notification($user_id, $user_pass );
	Walleto_new_user_notification_admin($user_id);
	
	return $user_id;
}
?>
