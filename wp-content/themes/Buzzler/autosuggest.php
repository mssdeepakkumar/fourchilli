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


add_action('wp_ajax_autosuggest_it', 				'AuctionTheme_autosuggest_it');
add_action('wp_ajax_nopriv_autosuggest_it', 		'AuctionTheme_autosuggest_it');

function AuctionTheme_autosuggest_it()
{

	include('classes/stem.php');
	include('classes/cleaner.php');
	global $wpdb;
	
	$string			 	= $_POST['queryString']; 
	$stemmer 			= new Stemmer;
	$stemmed_string 	= $stemmer->stem ( $string );
	
		$clean_string = new jSearchString();
		$stemmed_string = $clean_string->parseString ( $stemmed_string );		
		
		$new_string = '';
		foreach ( array_unique ( split ( " ",$stemmed_string ) ) as $array => $value )
		{
			if(strlen($value) >= 1)
			{
				$new_string .= ''.$value.' ';
			}
		}
	
	
	$new_string = substr ( $new_string,0, ( strLen ( $new_string ) -1 ) );
		
		$new_string = htmlspecialchars($_POST['queryString']);
		
		if ( strlen ( $new_string ) > 0 ):
		
			$split_stemmed = split ( " ",$new_string );
		     
			 /*
			 
			  
			$sql = "SELECT DISTINCT COUNT(*) as occurences, ".$wpdb->prefix."posts.post_title, ".$wpdb->prefix."posts.ID FROM ".$wpdb->prefix."posts,
			".$wpdb->prefix."postmeta WHERE ".$wpdb->prefix."posts.post_status='publish' and 
			".$wpdb->prefix."posts.post_type='listing' 
			
					AND ".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id 
					AND ".$wpdb->prefix."postmeta.meta_key = 'closed' 
					AND ".$wpdb->prefix."postmeta.meta_value = '0' 
			
			AND (";
			
			*/
			    
		    
			$sql = "SELECT DISTINCT COUNT(*) as occurences, ".$wpdb->prefix."posts.post_title, ".$wpdb->prefix."posts.ID FROM ".$wpdb->prefix."posts,
			".$wpdb->prefix."postmeta WHERE ".$wpdb->prefix."posts.post_status='publish' and 
			".$wpdb->prefix."posts.post_type='listing' 
			
				
			
			AND (";
		             
			while ( list ( $key,$val ) = each ( $split_stemmed ) )
			{
		              if( $val!='' && strlen ( $val ) > 0 )
		              {
		              	$sql .= "(".$wpdb->prefix."posts.post_title LIKE '%".$val."%' OR ".$wpdb->prefix."posts.post_content LIKE '%".$val."%') OR";
		              }
			}
			
			$sql=substr ( $sql,0, ( strLen ( $sql )-3 ) );//this will eat the last OR
			$sql .= ") GROUP BY ".$wpdb->prefix."posts.post_title ORDER BY occurences DESC LIMIT 10";
		
		
			//echo $sql; 
		
			$query = mysql_query($sql) or die ( mysql_error () );
			//$row_sql = mysql_fetch_assoc ( $query );
			$total = mysql_num_rows ( $query );
			 
			if($total>0):
					
					while ( $row = mysql_fetch_assoc ( $query ) ): 
						echo '<ul id="small_search_res">';	
						$prm = get_permalink($row['ID']);			
								echo '<li onClick="window.location=\''.$prm.'\';"> <h2><img width="36" height="36" class="image_class" 
								src="'.Buzzler_get_first_post_image($row['ID'],36,36).'" /></h2> <p>'.$row['post_title'].'</p></li>';
						echo '</ul>';			
					endwhile;
			else:
			
			
			echo '<ul>';				
	         		echo '<li onClick="fill(\''.$new_string.'\');">'.__('No results found','Buzzler').'</li>';
	        echo '</ul>';
					
				
			endif;
		endif;

	
		
}

?>