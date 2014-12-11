<?php

	global $wpdb,$wp_rewrite,$wp_query;
	$username = $wp_query->query_vars['post_author'];
	$uid = $username;
	$paged = $wp_query->query_vars['paged'];
	
	global $username;
	
	$user = get_userdata($uid);
	$username = $user->user_login;
	
	
	
	function sitemile_filter_ttl($title){ global $username; return __("User Profile",'Walleto')." - " . $username;}
	add_filter( 'wp_title', 'sitemile_filter_ttl', 10, 3 );	
	
	get_header();
?>

<div id="content">
	
    		<div class="my_box3">
            
            	<div class="box_title"><?php _e("User Profile",'Walleto'); ?> - <?php echo html_entity_decode($username); ?> </div>
            	<div class="box_content">	
                    	
                      
                    
                        <div class="user-profile-description">
                        <?php
                        
                        $info = get_user_meta($uid, 'personal_info', true);
                        if(empty($info)) _e("No personal info defined.",'Walleto');
                        else echo $info;
                        
                        
                        ?>                        
                        </div>
                        
                          <div class="user-profile-avatar"><img class="imgImg" width="100" height="100" src="<?php echo Walleto_get_avatar($uid,100,100); ?>" /><br/><br/>
                          
                          <a class="nice_link" href="<?php
                
				
				$using_perm = Walleto_using_permalinks();
	
			if($using_perm)	$privurl_m = get_permalink(get_option('Walleto_my_account_priv_mess_page_id')). "?";
			else $privurl_m = get_bloginfo('siteurl'). "/?page_id=". get_option('Walleto_my_account_priv_mess_page_id'). "&";	
			
			echo $privurl_m."priv_act=send&";
			echo 'uid='.$user->ID;
				
				?>"><?php _e('Contact User','Walleto'); ?></a>
                          
                          
                   	 	</div>

                
            </div>
            </div>
                
                
                <div class="clear10"></div>
    
    

			<div class="my_box3">

            
            	<div class="box_title"><?php _e("User Latest Posted Products",'Walleto'); ?>
                
                <?php
							
							echo '<div class="switchers">';
							$view = walleto_get_current_view_grid_list();
					
							if($view != "grid")
							{
								echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid"></a>';
								echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list-selected"></a>';
							}
							else
							{
								echo '<a href="'.walleto_switch_link_from_home_page('grid').'" class="grid-selected"></a>';
								echo '<a href="'.walleto_switch_link_from_home_page('list').'" class="list"></a>';
							}
							echo '</div>';
					
					?>
                
                </div>
            	<div class="box_content">	

        
<?php

	
	$closed = array(
							'key' => 'closed',
							'value' => '0',
							'compare' => '='
						);	
	
	$nrpostsPage = 8;
	$args = array( 'author' => $uid , 'meta_query' => array($closed) ,'posts_per_page' => $nrpostsPage, 'paged' => $paged, 'post_type' => 'product', 'order' => "DESC" , 'orderby'=>"date");
	$the_query = new WP_Query( $args );
		
		// The Loop
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
					if($view != "grid")
						 walleto_get_post_list_view();
					 else
					 	Walleto_get_post();
						
	
			
		endwhile;
	
	if(function_exists('wp_pagenavi'))
	wp_pagenavi( array( 'query' => $the_query ) );
	
          ?>
          
          <?php                                
     	else:
		
		echo __('No products posted.','Walleto');
		
		endif;
		// Reset Post Data
		wp_reset_postdata();

            
					 
		?>
	

</div>
</div>


 

<div class="clear10"></div>

<div class="my_box3">
           
            
            	<div class="box_title"><?php _e("User Latest Feedback",'Walleto'); ?> 
               <span class="sml_ltrs"> [<a href="<?php bloginfo('siteurl'); ?>?w_action=user_feedback&post_author=<?php echo $uid; ?>"><?php _e('See All Feedback','Walleto'); ?></a>]</span>
               </div>
            	<div class="box_content">	
               <!-- ####### -->
                
                
                <?php
					
					global $wpdb;
					$query = "select * from ".$wpdb->prefix."walleto_ratings where touser='$uid' AND awarded='1' order by id desc limit 5";
					$r = $wpdb->get_results($query);
					
					if(count($r) > 0)
					{
						echo '<table width="100%">';
							echo '<tr>';
								 
								echo '<th><b>'.__('Order ID','Walleto').'</b></th>';								
								echo '<th><b>'.__('From User','Walleto').'</b></th>';	
								echo '<th><b>'.__('Aquired on','Walleto').'</b></th>';								
								echo '<th><b>'.__('Price','Walleto').'</b></th>';
								echo '<th><b>'.__('Rating','Walleto').'</b></th>';
								
							
							echo '</tr>';	
						
						
						foreach($r as $row)
						{
							 
							$order 	= walleto_get_order_obj($row->orderid);
							$user 	= get_userdata($row->fromuser);
							
							echo '<tr>';
								
								echo '<th>#'.$row->orderid.'</th>';	
								echo '<th><a href="'.Walleto_get_user_profile_link($user->user_login).'">'.$user->user_login.'</a></th>';								
								echo '<th>'.date('d-M-Y H:i:s',$row->datemade).'</th>';								
								echo '<th>'.Walleto_get_show_price($order->price).'</th>';
								echo '<th>'.walleto_get_prod_stars(floor($row->grade/2)).' ('.floor($row->grade/2).'/5)</th>';
								
							
							echo '</tr>';
							echo '<tr>';
							echo '<th></th>';
							echo '<th colspan="5"><b>'.__('Comment','Walleto').':</b> '.$row->comment.'</th>'	;						
							echo '</tr>';
							
							echo '<tr><th colspan="6"><hr color="#eee" /></th></tr>';
							
						}
						
						echo '</table>';
					}
					else
					{
						_e("There are no reviews to be awareded.","Walleto");	
					}
				?>
                
                
				<!-- ####### -->
                </div>
                
  
            </div>


</div>


<div id="right-sidebar">
	<ul class="xoxo">
	<?php dynamic_sidebar( 'other-page-area' ); ?>
	</ul>
</div>


<?php

	get_footer();
	
?>
