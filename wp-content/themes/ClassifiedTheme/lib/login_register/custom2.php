<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - ClassifiedTheme
*	More Info: http://sitemile.com/p/classifiedTheme
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/

	include 'sett.php';
	include 'login.php';
	include 'register.php';
	

	add_action('init', 'ClassifiedTheme_do_login_register_init', 99);
	
	//=======================================================
	
		function ClassifiedTheme_do_login_register_init()
		{
		  global $pagenow;
		
			if(isset($_GET['action']) && $_GET['action'] == "register")
			{
				ClassifiedTheme_do_register_scr();	
			}
		
		  switch ($pagenow)
		  {
			case "wp-login.php":
			
				
			  ClassifiedTheme_do_login_scr();
			break;
			case "wp-register.php":
				
	
				
			  ClassifiedTheme_do_register_scr();
			break;
		  }
		}
		
	//=========================================================	



?>