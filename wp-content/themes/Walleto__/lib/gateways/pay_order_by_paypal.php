<?php

	$opt = get_option('Walleto_enable_paypal_ad');

	if($opt == "yes") 
		include 'adaptive_paypal_product.php';
	else 
		include 'normal_paypal_product.php';
	
	
?>