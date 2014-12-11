<?php
/*****************************************************************************
*
*	copyright(c) - sitemile.com - Buzzler
*	More Info: http://sitemile.com/p/buzzler
*	Coder: Saioc Dragos Andrei
*	Email: andreisaioc@gmail.com
*
******************************************************************************/

	include 'sett.php';
	include 'login.php';
	include 'register.php';
	

	add_action('init', 'Buzzler_do_login_register_init', 99);
	
	//=======================================================
	
		function Buzzler_do_login_register_init()
		{
		  global $pagenow;
		
			if(isset($_GET['action']) && $_GET['action'] == "register")
			{
				Buzzler_do_register_scr();	
			}
		
		  switch ($pagenow)
		  {
			case "wp-login.php":
			
				
			  Buzzler_do_login_scr();
			break;
			case "wp-register.php":
				
	
				
			  Buzzler_do_register_scr();
			break;
		  }
		}
		
	//=========================================================	



?>