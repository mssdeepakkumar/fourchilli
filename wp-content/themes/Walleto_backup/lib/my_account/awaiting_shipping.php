<?php
/***************************************************************************
*
*	Walleto - copyright (c) - sitemile.com
*	The best wordpress premium theme for having a marketplace. Sell and buy all kind of products, including downloadable goods. 
*	Have a niche marketplace website in minutes. Turn-key solution.
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/products/walleto-wordpress-marketplace-theme/
*	since v1.0.1
*
*	Dedicated to my wife: Alexandra
*
***************************************************************************/


if(!function_exists('Walleto_my_account_display_awa_shp_page'))
{
function Walleto_my_account_display_awa_shp_page()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>	
<div id="content">
			<div class="my_box3">
            
            	<div class="box_title my_account_title"><?php _e("Awaiting Shipping",'Walleto'); ?></div>
                <div class="box_content">   
                <?php
                 
			global $wpdb;
			
			//------------------------
			
			$post_per_page = 8;				
			$page = $_GET['pj'];
			if(empty($page)) $page = 1;
			
			$s1 = "select count(distinct cnt.orderid) cnts from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 
			ord.paid='1' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND cnt.shipped='0' AND posts.post_author='$uid' order by ord.id desc";
			$r1 = $wpdb->get_results($s1);
			$rws = $r1[0];
			
			$total_count 	= $rws->cnts;
			$totalPages 	= ($total_count > 0 ? ceil($total_count / $post_per_page) : 0);
	 
			//-----------------------
			
			$s = "select distinct cnt.orderid from ".$wpdb->prefix."walleto_order_contents cnt, ".$wpdb->prefix."walleto_orders ord, $wpdb->posts posts where 
			ord.paid='1' and ord.shipped='0' AND ord.id=cnt.orderid AND posts.ID=cnt.pid AND cnt.shipped='0' AND posts.post_author='$uid' order by ord.id desc LIMIT ".($post_per_page * ($page - 1) ).",". $post_per_page;
			
			$r = $wpdb->get_results($s);
			
			if(count($r) > 0)
			{
			?>
            	
            <div class="my_shipp header_side">
                <div class="my_order_id"><?php echo __('Order ID','Walleto'); ?></div>
                <div class="my_order_datemade"><?php echo __('Date and Time','Walleto'); ?></div>
                <div class="my_order_price"><?php echo __('Order Total','Walleto'); ?></div>
                <div class="my_order_details"><?php echo __('Paid On','Walleto'); ?></div>
                <div class="my_order_buttons"><?php echo __('Options','Walleto'); ?></div>
            </div>
            
            <?php
				foreach($r as $row)
				{
					$s1 = "select * from ".$wpdb->prefix."walleto_orders where id='{$row->orderid}'";
					$r1 = $wpdb->get_results($s1);
					$row1 = $r1[0];
					
					walleto_display_awaiting_shipping_for_seller($row1);				
				}
			?>
            
             <div class="nav">
                     <?php
					 	
		$batch = 10; //ceil($page / $post_per_page );
		$end = $batch * $post_per_page;


		if ($end > $pagess) {
			$end = $pagess;
		}
		$start = $end - $post_per_page + 1;
		
		if($start < 1) $start = 1;
		
		$links = '';
	
		
		$raport = ceil($page/$batch) - 1; if ($raport < 0) $raport = 0;
		
		$start 		= $raport * $batch + 1; 
		$end		= $start + $batch - 1;
		$end_me 	= $end + 1;
		$start_me 	= $start - 1;
		
		if($end > $totalPages) $end = $totalPages;
		if($end_me > $totalPages) $end_me = $totalPages;
		
		if($start_me <= 0) $start_me = 1;
		
		$previous_pg = $page - 1;
		if($previous_pg <= 0) $previous_pg = 1;
		
		$next_pg = $page + 1;
		if($next_pg > $totalPages) $next_pg = 1;
		
		
		
		//PricerrTheme_get_browse_jobs_link($job_tax, $job_category, 'new', $page)
		
		if($page > 1)
		echo '<a href="'.Walleto_get_browse__special_pg_link('Walleto_my_account_aw_shp_page_id', $previous_pg).'"><< '.__('Previous','Walleto').'</a>';
		echo '<a href="'.Walleto_get_browse__special_pg_link('Walleto_my_account_aw_shp_page_id', $start_me).'"><<</a>';		
		
		//------------------------
		//echo $start." ".$end;
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $page) {
				echo '<a class="activee" href="#">'.$i.'</a>';
			} else {
	
				echo '<a href="'.Walleto_get_browse__special_pg_link('Walleto_my_account_aw_shp_page_id', $i).'">'.$i.'</a>';
				
			}
		}
		
		//----------------------
		
		if($totalPages > $page) {
		echo '<a href="'.Walleto_get_browse__special_pg_link('Walleto_my_account_aw_shp_page_id', $end_me).'">>></a>';
		echo '<a href="'.Walleto_get_browse__special_pg_link('Walleto_my_account_aw_shp_page_id', $next_pg).'">'.__('Next','Walleto').' >></a>'; }						
				
					 ?>
                     </div>
                     
            
            <?php 
			
			}
			else
			{
				_e('There are no orders yet.','Walleto');	
			}
			
			?>

			</div>
			</div>
			
			<div class="clear10"></div>
			
			
		 
			
			
			
		</div> <!-- end div content -->


<?php

	echo Walleto_get_users_links();
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>