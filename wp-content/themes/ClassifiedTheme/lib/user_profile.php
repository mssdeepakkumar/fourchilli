<?php

	global $wpdb,$wp_rewrite,$wp_query;
	//$username = $wp_query->query_vars['username'];
	//$uid = get_userdatabylogin($username);
	$uid = $_GET['uid']; if(empty($uid)) $uid = $_GET['post_author'];
	$paged = $wp_query->query_vars['paged'];

	$userdata = get_userdata($uid);
	$username = $userdata->user_login;
	
	function sitemile_filter_ttl($title){return __("User Profile", "ClassifiedTheme")." - ";}
	add_filter( 'wp_title', 'sitemile_filter_ttl', 10, 3 );	
	
get_header();
?>

<div id="content">
	
    		<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php _e("User Profile", "ClassifiedTheme"); ?> - <?php echo $username; ?></div>
            	<div class="box_content">	
         
            
                            <div class="profile-info">
                              
                            <?php
                             
                            $info = get_user_meta($uid, 'personal_info', true);
                            if(empty($info)) _e("No personal info defined.", "ClassifiedTheme");
                            else echo $info;
                        
                            ?>
                            
                            </div>
                            
                            <div class="profile-avatar">
                             <img width="150" height="150" border="0" src="<?php echo ClassifiedTheme_get_avatar($uid,150,150); ?>" /> 
                            </div>
                            
                </div>
                
            </div>
            </div>
                
                
                <div class="clear10"></div>
    
    

			<div class="my_box3">
            <div class="padd10">
            
            	<div class="box_title"><?php _e("User Latest Posted ads", "ClassifiedTheme"); ?></div>
            	<div class="box_content">	
	
    
        
<?php


	
	$nrpostsPage = 10;
	$args = array( 'author' => $uid ,'posts_per_page' => $nrpostsPage, 'paged' => $paged, 'post_type' => 'ad', 'order' => "DESC" , 'orderby'=>"date", 'meta_key'=>'closed', 'meta_value'=> '0', );
	$the_query = new WP_Query( $args );
		
		// The Loop
		
		if($the_query->have_posts()):
		while ( $the_query->have_posts() ) : $the_query->the_post();
			
			classifiedTheme_get_post();
	
			
		endwhile;
	
	if(function_exists('wp_pagenavi'))
	wp_pagenavi( array( 'query' => $the_query ) );

          ?>
          
          <?php                                
     	else:
		
		echo __('No ads posted.', "ClassifiedTheme");
		
		endif;
		// Reset Post Data
		wp_reset_postdata();

            
					 
		?>
	

	
</div>
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
