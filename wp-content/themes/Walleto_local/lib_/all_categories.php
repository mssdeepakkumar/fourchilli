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


if(!function_exists('walleto_all_cats_area_function'))
{
function walleto_all_cats_area_function()
{

	ob_start();
	
	global $current_user;
	get_currentuserinfo();
	$uid = $current_user->ID;
	
?>
 <section id="product_list_new" class="product_list_wrapper wedding_products_wrapper_class">
        <div class="product_list_heading">
	   <span class="heading_text"><?php echo sprintf(__("All Categories",'Walleto')); ?></span>
        </div>                                	
        <?php            
        
		$opt = get_option('Walleto_show_subcats_enbl');
		
		if($opt == 'no')
		$smk_closed = "smk_closed_disp_none";		 
		else $smk_closed = ''; 	 
		            
		//-----------------------

		$terms 		= get_terms("product_cat","parent=0&hide_empty=0");
		
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
			   	$terms2 = get_terms("product_cat","parent=".$term->term_id."&hide_empty=0");
				

				$mese = '';
				
					$mese .= '<ul>';
					$link = get_term_link($term->slug,"product_cat");
					$mese .= "<a href='#' class='parent_taxe active_plus' rel='taxe_project_cat_".$term->term_id."' > 
					</a> 
		       		       <h5><a href='".$link."'>" . $term->name;
				       
			   $total_ads = Walleto_get_custom_taxonomy_count('product',$term->slug);
			   
			   if($terms2)
				{
					$mese2 = '<ul class="'.$smk_closed.'" id="taxe_project_cat_'.$term->term_id.'">';
					foreach ( $terms2 as $term2 ) 
					{
						++$cnt;
						$tt = Walleto_get_custom_taxonomy_count('product',$term2->slug);
		       			///$total_ads += $tt;
						$link = get_term_link($term2->slug,"product_cat");
						$mese2 .= "<li><a href='".$link."'>" . $term2->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
						";
						
						
						$terms3 = get_terms("product_cat","parent=".$term2->term_id."&hide_empty=0");
						//echo"<pre>"; print_r($terms3);
						if($terms3)
						{
							$mese2 .= '<ul class="baca_loc">';
							foreach ( $terms3 as $term3 ) 
							{
								++$cnt;
								$tt = Walleto_get_custom_taxonomy_count('product',$term3->slug);
								///$total_ads += $tt;
								$link = get_term_link($term3->slug,	"product_cat");
								if(!is_wp_error($link))
								$mese2 .= "<li><a href='".$link."'>" . $term3->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
								";
								
								$terms4 = get_terms("product_cat","parent=".$term3->term_id."&hide_empty=0");
								
								if($terms4)
								{
									$mese2 .= '<ul class="baca_loc">';
									foreach ( $terms4 as $term4 ) 
									{
										++$cnt;
										$tt = Walleto_get_custom_taxonomy_count('product',$term4->slug);
										///$total_ads += $tt;
										$link = get_term_link($term4->slug,	"product_cat");
										if(!is_wp_error($link))
										$mese2 .= "<li><a href='".$link."'>" . $term4->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
										";	 
									}
									$mese2 .= '</ul>';
								}
							
							}
							$mese2 .= '</ul>';
						}
						
					}
					
					$mese2 .= '</ul>';
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
        <!-- ################ -->
<?php

 
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	
}
}
?>