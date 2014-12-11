<?php
/********************************************************************************
*
*	ClassifiedTheme - copyright (c) - sitemile.com - Details
*	http://sitemile.com/p/classifiedTheme
*	Code written by_________Saioc Dragos Andrei
*	email___________________andreisaioc@gmail.com
*	since v6.2.1
*
*********************************************************************************/



function ClassifiedTheme_show_me_page_all_locations()
{
	
		?>
    
    	
         <div id="content">
    
    		<div class="my_box3">
      
                        
                <div class="box_title"><?php echo __("All Locations", 'ClassifiedTheme'); ?></div>
                <div class="box_content">
    				
                    
                    
                    <?php            
                    

		$terms 		= get_terms("ad_location","parent=0&hide_empty=0");

		global $wpdb;
		$arr = array();
		
		$count = count($terms); $i = 0;
		if ( $count > 0 ){
			
			
		$nr = 4;
		
		
		//=========================================================================

		
		$total_count = 0;
		$arr = array();        
        global $wpdb;
		$contor = 0;


		 
		 $count = count($terms); $i = 0;
		 if ( $count > 0 ){
		     
		     foreach ( $terms as $term ) {
		       

			
			$stuffy = '';
			$cnt	= 1;
			
		       	$stuffy .= "<ul id='location-stuff'><li>";
			   	$terms2 = get_terms("ad_location","parent=".$term->term_id."&hide_empty=0");
				

				$mese = '';
				
					$mese .= '<ul>';
					$link = get_term_link($term->slug,"ad_location");
					$mese .= "<li class='top-mark'> <a href='#' class='parent_taxe active_plus' rel='taxe_project_cat_".$term->term_id."' ><img rel='img_taxe_project_cat_".$term->term_id."'
					 src=\"".get_bloginfo('template_url')."/images/bullet-cat.png\" border='0' width=\"9\" height=\"12\" /></a>
		       		<h3><a href='".$link."'>" . $term->name;
					
				
			   
			   $total_ads = ClassifiedTheme_get_custom_taxonomy_count('ad',$term->slug);
			   
			   if($terms2)
				{
					$mese2 = '';
					foreach ( $terms2 as $term2 ) 
					{
						++$cnt;
						$tt = ClassifiedTheme_get_custom_taxonomy_count('ad',$term2->slug);
		       			///$total_ads += $tt;
						$link = get_term_link($term2->slug,"ad_location");
						$mese2 .= "<li><a href='".$link."'>" . $term2->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
						";
						
						
						$terms3 = get_terms("ad_location","parent=".$term2->term_id."&hide_empty=0");
						
						if($terms3)
						{
							$mese2 .= '<ul class="baca_loc">';
							foreach ( $terms3 as $term3 ) 
							{
								++$cnt;
								$tt = ClassifiedTheme_get_custom_taxonomy_count('ad',$term3->slug);
								///$total_ads += $tt;
								$link = get_term_link($term3->slug,"ad_location");
								$mese2 .= "<li><a href='".$link."'>" . $term3->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
								";
							
							}
							$mese2 .= '</ul>';
						}
						
					}
				}
					
					$stuffy .= $mese.($show_me_count == true ? "(".$total_ads.")" : "") ."</a></h3></li>
					";
					$stuffy .= $mese2;
					
					$mese2 = '';
					
					$stuffy .= '</ul></li>
					';
				$stuffy .= '</ul>
				';
				
			   
			   	$i++;
		        $arr[$contor]['content'] 	= $stuffy;
				$arr[$contor]['size'] 		= $cnt;
				$total_count 		= $total_count + $cnt;
				$contor++;
		     }

		 }   
         
        //=======================================

		 $i = 0; $k = 0;
		 $result = array();
		 
		 foreach($arr as $category)
		 {			

			$result[$k] .= $category['content'];
			//echo $k." ";
			$k++;
				
			if($k == $nr) $k=0;
	
		 }
		
		 foreach($result as $res)
		 echo "<div class='stuffa4'>".$res.'</div>
		 
		 '; 
		 
		
		 
		} ?>
                            
                    
                    
                    
                    
                </div>
                </div>
                </div>
                            
    
    
        <!-- ################ -->
    
    <div id="right-sidebar">
    <ul class="xoxo">
        <?php dynamic_sidebar( 'other-page-area' ); ?>
    </ul>
    </div>
    
    
    <?php	
	
	
}


?>