<?php
/***************************************************************************
*
*	Buzzler - copyright (c) - sitemile.com
*	WordPress Business Directory Theme
*
*	Coder: Andrei Dragos Saioc
*	Email: sitemile[at]sitemile.com | andreisaioc[at]gmail.com
*	More info about the theme here: http://sitemile.com/p/buzzler
*	since v1.0
*
***************************************************************************/

function buzzler_all_locations_area_function()
{
	
?>
    
    	
         <div id="content">
    
    		<div class="my_box3">
      
                        
                <div class="box_title"><?php echo __("All Locations", 'Buzzler'); ?></div>
                <div class="box_content">
    				
                    
                    
                    <?php            
                    

		$terms 		= get_terms("listing_location","parent=0&hide_empty=0");

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
			   	$terms2 = get_terms("listing_location","parent=".$term->term_id."&hide_empty=0");
				

				$mese = '';
				
					$mese .= '<ul>';
					$link = get_term_link($term->slug,"listing_location");
					$mese .= "<li class='top-mark'>
		       		<h3><a href='".$link."'>" . $term->name;
					
				
			   
			   $total_ads = Buzzler_get_custom_taxonomy_count('listing',$term->slug);
			   
			   if($terms2)
				{
					$mese2 = '';
					foreach ( $terms2 as $term2 ) 
					{
						++$cnt;
						$tt = Buzzler_get_custom_taxonomy_count('listing',$term2->slug);
		       			///$total_ads += $tt;
						$link = get_term_link($term2->slug,"listing_location");
						$mese2 .= "<li><a href='".$link."'>" . $term2->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
						";
						
						
						$terms3 = get_terms("listing_location","parent=".$term2->term_id."&hide_empty=0");
						
						if($terms3)
						{
							$mese2 .= '<ul class="baca_loc">';
							foreach ( $terms3 as $term3 ) 
							{
								++$cnt;
								$tt = Buzzler_get_custom_taxonomy_count('listing',$term3->slug);
								///$total_ads += $tt;
								$link = get_term_link($term3->slug,"listing_location");
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