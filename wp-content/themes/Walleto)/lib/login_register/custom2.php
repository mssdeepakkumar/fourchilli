<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - Walleto
*	More Info: http://sitemile.com/p/walleto
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/

	include 'sett.php';
	include 'login.php';
	include 'register.php';
	

	add_action('init', 'Walleto_do_login_register_init', 99);
	
	//=======================================================
	
		function Walleto_do_login_register_init()
		{
		  global $pagenow;
		
			if(isset($_GET['action']) && $_GET['action'] == "register")
			{
				Walleto_do_register_scr();	
			}
		
		  switch ($pagenow)
		  {
			case "wp-login.php":
			
				
			  Walleto_do_login_scr();
			break;
			case "wp-register.php":
				
	
				
			  Walleto_do_register_scr();
			break;
		  }
		}
		
	//=========================================================	



?>