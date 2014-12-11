<?php

if($_POST['status'] > -1)
{
		
		$c  	= $_POST['field1'];
		$c 		= explode('|',$c);
		
		$pid				= $c[0];
		$uid				= $c[1];
		$datemade 			= $c[2];		
		
		//---------------------------------------------------

			global $wpdb;
				
				$opt = get_user_meta($uid, 'classifiedtheme_mem_'.$datemade , true);
				
				if(empty($opt)):
					
					update_user_meta($uid, 'classifiedtheme_mem_'.$datemade , "done");
					
					$ss2 		= "select * from ".$wpdb->prefix."ad_packs where id='$pid'";
					$rf 		= $wpdb->get_results($ss2);
					$row 		= $rf[0];
					$tot_ads 	= $row->ads_number;
					
					$total_nr 			= get_user_meta($uid, 'normal_ads_pack',true); 		if(empty($total_nr)) 			$total_nr = 0;
					$total_featured_nr 	= get_user_meta($uid, 'featured_ads_pack',true); 	if(empty($total_featured_nr)) 	$total_featured_nr = 0;
		
					//--------------------------------
					
					if($row->featured_free == 1)
					{
						$tot_ads += $total_featured_nr;
						update_user_meta($uid, 'featured_ads_pack', $tot_ads);		
					}
					else
					{
						$tot_ads += $total_nr;
						update_user_meta($uid, 'normal_ads_pack', $tot_ads);		
					}
				
				endif;
			
			//---------------------------
}
	
?>