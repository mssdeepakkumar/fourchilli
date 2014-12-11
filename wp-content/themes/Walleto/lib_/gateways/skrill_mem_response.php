<?php

if($_POST['status'] > -1)
{
		
		$c  	= $_POST['field1'];
		$c 		= explode('|',$c);
		
		$mem				= $c[0];
		$uid				= $c[1];
		$datemade 			= $c[2];		
		
		//---------------------------------------------------

		 
	$months = walleto_get_period_from_code_numeric($mem);
	walleto_update_membership_for_shop($uid, $months);
	
}
	
?>