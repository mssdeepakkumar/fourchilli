<?php

//--------------------------------------------------------------

		$cart = $_SESSION['my_cart'];
		if(is_array($cart))
		{
			$sk = 0;
			foreach($cart as $citem)
			{
				if(	 $citem['pid'] == $_GET['add_to_cart']) { $sk = 1; break; }
			}
			
			if($sk == 0)
			{
			
				$cnt = count($cart);
				$cart[$cnt]['pid'] 	= $_GET['add_to_cart'];
				$cart[$cnt]['quant'] 	= 1;
				
				$_SESSION['my_cart'] = $cart;
				
			}
			
		}
		else
		{
			$cart[0]['pid'] 	= $_GET['add_to_cart'];
			$cart[0]['quant'] 	= 1;
			
			$_SESSION['my_cart'] = $cart;	
		}
		
		wp_redirect(get_permalink(get_option('Walleto_shopping_cart_page_id')));

?>