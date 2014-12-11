<?php

add_action('widgets_init', 'register_browse_by_category_widget_auction');
function register_browse_by_category_widget_auction() {
	register_widget('Walleto_browse_by_category');
}

class Walleto_browse_by_category extends WP_Widget {

	function Walleto_browse_by_category() {
		$widget_ops = array( 'classname' => 'browse-by-category', 'description' => 'Show all categories and browse by category' );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'browse-by-category' );
		$this->WP_Widget( 'browse-by-category', 'Walleto - Browse by Category', $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget;
		
		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
		
		
		//----------------------
	
		$opt = get_option('Walleto_show_tax_views');
		if($opt == "no") $show_me_count = false;
		else $show_me_count = true; 
		
		//----------------------

		
		$loc_per_row 	= $instance['loc_per_row'];
		$widget_id 		= $args['widget_id'];
		$nr_rows 		= $instance['nr_rows'];
		$only_these 	= $instance['only_these'];
		
		$nr = 4;
		if(is_numeric($loc_per_row)) $nr = $loc_per_row;
		
		//if(!empty($loc_per_row)) $nr = $loc_per_row;
		//echo '<style>#'.$widget_id.' #location-stuff li ul { width: '.round(100/$nr).'%}</style>';
		
		if($nr_rows > 0) $jk = "&number=".($nr_rows * $loc_per_row);
		
		$terms_k 	= get_terms("product_cat","parent=0&hide_empty=0");
		$terms 		= get_terms("product_cat","parent=0&hide_empty=0".$jk);
		 
		 
		//$term = get_term( $term_id, $taxonomy ); 
		global $wpdb;
		$arr = array();
		
		if($only_these == "1")
		{
			$terms = array();
			
			foreach($terms_k as $trm)
			{
				if($instance['term_' . $trm->term_id] == $trm->term_id)
					array_push($terms, $trm);
			}
			
		}
		
		 
		//-----------------------------
		 
		 if(count($terms) < count($terms_k)) $disp_btn = 1;
		else $disp_btn = 0;
		 
		 
		$count = count($terms); $i = 0;
		if ( $count > 0 ){
			
			
		$nrs = 5;
		
		if(!empty($loc_per_row)) $nrs = $loc_per_row;
		//echo '<style>#'.$widget_id.' .stuffa { width: '.round(100/$nr).'%}</style>';
		
		

		//=========================================================================
	
		$opt = get_option('Walleto_show_subcats_enbl');
		
		if($opt == 'no')
		$smk_closed = "smk_closed_disp_none";		 
		else $smk_closed = ''; 	 
		            
		//-----------------------
		
		$total_count = 0;
		$arr = array();        
        global $wpdb;
		$contor = 0;


		 
		 $count = count($terms); $i = 0;
		 if ( $count > 0 ){
		     
		 foreach ( $terms as $term ) 
		 {
		       

			
			$stuffy = '';
			$cnt	= 1;
			
		       	$stuffy .= "<ul id='location-stuff'>
				<li>";
			   	$terms2 = get_terms("product_cat","parent=".$term->term_id."&hide_empty=0");
				

				$mese = '';
				
					$mese .= ' ';
					$link = get_term_link($term->slug,"product_cat");
					$mese .= "<a href='#' class='parent_taxe active_plus' rel='taxe_project_cat_".$term->term_id."' ><img rel='img_taxe_project_cat_".$term->term_id."'
					 src=\"".get_bloginfo('template_url')."/images/posted.png\" border='0' width=\"20\" height=\"20\" /></a> 
		       		<h3><a href='".$link."'>" . $term->name;
				
			   
			   $total_ads = Walleto_get_custom_taxonomy_count('auction',$term->slug);
			   
			   if($terms2)
				{
					$mese2 = '<ul class="'.$smk_closed.'" id="taxe_project_cat_'.$term->term_id.'">
					';
					foreach ( $terms2 as $term2 ) 
					{
						++$cnt;
						$tt = Walleto_get_custom_taxonomy_count('auction',$term2->slug);
		       			///$total_ads += $tt;
						$link = get_term_link($term2->slug,"product_cat");
						$mese2 .= "<li><a href='".$link."'>" . $term2->name." ". ($show_me_count == true ? "(".$tt.")" : "")."</a></li>
						";
						
						
						$terms3 = get_terms("product_cat","parent=".$term2->term_id."&hide_empty=0");
						
						if($terms3)
						{
							$mese2 .= '<ul class="baca_loc">';
							foreach ( $terms3 as $term3 ) 
							{
								++$cnt;
								$tt = Walleto_get_custom_taxonomy_count('auction',$term3->slug);
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
										$tt = Walleto_get_custom_taxonomy_count('auction',$term4->slug);
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
					
					$stuffy .= ' 
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
		 echo "<div class='stuffa".$nrs."'>".$res.'</div>
		 
		 '; 
		 
		
		 
		}
	
		//=========================================================================
			
		if($disp_btn == 1)
		{
				echo '<div class="see-more-tax"><b><a href="'.get_permalink(get_option('Walleto_all_cats_id')) .'">'.__('See More Categories','Walleto').'</a></b></div>';		
		}		
			
			
				
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	
		return $new_instance;
	}

	function form($instance) { ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
			value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('loc_per_row'); ?>"><?php _e('Number of Columns'); ?>:</label>
	
            
            <select id="<?php echo $this->get_field_id('loc_per_row'); ?>" name="<?php echo $this->get_field_name('loc_per_row'); ?>"  >
            <option value="1" <?php if(esc_attr( $instance['loc_per_row']) == "1") echo 'selected="selected"'; ?> >1</option>
            <option value="2" <?php if(esc_attr( $instance['loc_per_row']) == "2") echo 'selected="selected"'; ?> >2</option>
            <option value="3" <?php if(esc_attr( $instance['loc_per_row']) == "3") echo 'selected="selected"'; ?> >3</option>
            <option value="4" <?php if(esc_attr( $instance['loc_per_row']) == "4") echo 'selected="selected"'; ?> >4</option>
            <option value="5" <?php if(esc_attr( $instance['loc_per_row']) == "5") echo 'selected="selected"'; ?> >5</option>
            
            </select>
            
		</p>
				
        <p>
			<label for="<?php echo $this->get_field_id('nr_rows'); ?>"><?php _e('Number of Rows'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('nr_rows'); ?>" name="<?php echo $this->get_field_name('nr_rows'); ?>" 
			value="<?php echo esc_attr( $instance['nr_rows'] ); ?>" style="width:20%;" />
		</p>
        
        
         <p>
			<label for="<?php echo $this->get_field_id('nr_rows'); ?>"><?php _e('Only show categories below'); ?>:</label>
			<?php echo '<input type="checkbox" name="'.$this->get_field_name('only_these').'"  value="1" '.(
	 $instance['only_these'] == "1" ? ' checked="checked" ' : "" ).' /> '; ?>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('nr_rows'); ?>"><?php _e('Categories to show'); ?>:</label>
			
                <div style=" width:220px;
    height:180px;
    background-color:#ffffff;
    overflow:auto;border:1px solid #ccc">
     <?php
	 
	 $terms = get_terms("product_cat","parent=0&hide_empty=0");
	 foreach ( $terms as $term ) {
	 
	 echo '<input type="checkbox" name="'.$this->get_field_name('term_'.$term->term_id).'"  value="'.$term->term_id.'" '.(
	 $instance['term_'.$term->term_id] == $term->term_id ? ' checked="checked" ' : "" ).' /> ';
	 echo $term->name.'<br/>';
	 
	 }
	 
	 ?>
     
    </div> 
            
            
            
		</p>
		         
                	
	<?php 
	}
}




?>