<?php
/*
Plugin Name: Chris2x TagAds Modified
Plugin URI: http://chris2x.com
Description: A tag ads widget
Author: Chris Christensen
Version: 10.0
Author URI: http://chris2x.com
add to taxonomy.php line 69 --- <div class="cat_ad"> <?php if(function_exists('chris2x_tagads_filter')){echo chris2x_tagads_filter($term_title);} ?></div>
*/

function strnpos($haystack, $needle, $nth=1, $offset=0) {
  if ($nth < 1) 
  	$nth = 1;
  $loop1 = TRUE;
  while ($nth > 0) {
    $offset = strpos($haystack, $needle, $loop1 ? $offset : $offset+1);
    if ($offset === FALSE) 
    	break;
    $nth--;
    $loop1 = FALSE;
  }
  return $offset;
}

function replace_nth($search, $replace, $data, $n) {
    $res = strnpos($data, $search, $n);
    if ($res === false) {
        return $data;
    } else {
        // There is data to be replaced
        $left_seg = substr($data, 0, $res);
        $right_seg = substr($data, ($res + strlen($search)));
        return $left_seg . $replace . $right_seg;
    }
}  

class chris2XTagAds {
	function get() {
		$saved_options = maybe_unserialize(get_option('chris2XTagAdsOptions'));
		
		if (!empty($saved_options) && is_object($saved_options)) {
			foreach ($saved_options as $option_name => $value)
				$this->$option_name = $value;
		}
		else {
			$this->version = 1;
			$this->ads['travel'][0] = '';
									
			update_option('chris2XTagAdsOptions', $this);
		}
	}
	
	function save() {
		update_option('chris2XTagAdsOptions', $this);
	}
}

function chris2x_tagads_filter($termtitle) {
	global $wpdb;
	$maxads = 1;
	$table_name = $wpdb->prefix . "chris2x_tagads";
	
	if (!is_tax()) {
		return "";
	}
	$results = (array) null;
	
	$posttags = $termtitle;
	if ($posttags) {
			$ads = $wpdb->get_results("SELECT ad FROM $table_name WHERE tag_name = '".$posttags."'", ARRAY_A);
			if (!empty($ads)) {
				$results = $results + $ads;
			}
	}
	
/*	if (count($results) < 10) {
		$postcats = get_the_category();
		if ($postcats) {
			foreach($postcats as $cat) {
				$ads = $wpdb->get_results("SELECT ad FROM $table_name WHERE tag_name = '".$cat->name."'", ARRAY_A);

				if (!empty($ads)) {
					$results = array_merge($results, $ads);
				}
			}
		}
	}
	*/
	if (empty($results)) {
		$ads = $wpdb->get_results("SELECT ad FROM $table_name WHERE tag_name = 'global'", ARRAY_A);
		
		if (!empty($ads)) {
			$results = array_merge($results, $ads);
		}
	}
	$text="";
	if (!empty($results)) {
		$ads = "";
		$n = 0;
		shuffle($results);
		//_log($results);
		
		foreach ($results as $ad) {
			$ads .= stripslashes($ad['ad']);
			$n++;
			if ($n >= $maxads)
				break;
		}
	
		/*$n = substr_count($text, ">");
		if ($n >= 1) {
			$j = rand(1, $n / 2);
			$text = replace_nth(">", "/>\n".$ads, $text, $j);
		}
		else {*/
			$text = $text.$ads;
		//}
	}
	return $text;
}

function chris2x_tagads_settings_page() {
	global $wpdb;
	$table_name = $wpdb->prefix . "chris2x_tagads";
	$id = "";

	if (array_key_exists('action', $_POST)) {
		$action = $_POST['action'];
	}
	if (array_key_exists('function', $_POST)) {
		$action = $_POST['function'];
	}
	if (array_key_exists('chris2x-tagads-command', $_POST)) {
		$action = $_POST['chris2x-tagads-command'];
	}
	$prompt = "";
	//_log($_POST);

	if ($action == 'Delete') {
		$id = $_POST['id'];
		$tag_name = $_POST['tag_name'];
		
		
		if ($id != "") {
			$result = $wpdb->delete( $table_name , array( "id" => $id ));
      	}
	}

	if ($action == 'create-ad') {
		$ad = $_POST['ad'];
		$tag_name = $_POST['tag_name'];
		$expires = $_POST['expires'];
		$advertiser = $_POST['advertiser'];
		
		if (($ad != "") && ($tag_name != "")) {		
			$wpdb->insert( $table_name, array( 'tag_name' => $tag_name, 'ad' => $ad, 'advertiser' => $advertiser, 'expires' => $expires));				
			$prompt = "One ad inserted";
      	}
	}
	
	if ($action == 'update-ad') {
		$id = $_POST['id'];
		$ad = $_POST['ad'];
		$tag_name = $_POST['tag_name'];
		$expires = $_POST['expires'];
		$advertiser = $_POST['advertiser'];
		if ($expires."x" == "x") {
			$expires = NULL;
		}
		
		if (($ad != "") && ($tag_name != "")) {		
			$wpdb->update( $table_name, array( 'tag_name' => $tag_name, 'ad' => $ad, 'advertiser' => $advertiser, 'expires' => $expires), array( 'ID' => $id ));
			$prompt = "One ad updated";
      	}
	}	

?>
<div class="wrap">
<h2>Category Ads</h2>

<p><?php echo $prompt ?></p>

<?php
	$tag_name = $_REQUEST['tag_name'];

	if ($tag_name != "") {
?>
	<h3>Ads for tag / category '<?php echo $tag_name ?>'</h3>
<?php	
	$results = $wpdb->get_results("SELECT * FROM $table_name WHERE tag_name = '".$tag_name."'", ARRAY_A);
		
?>	
    <table class="form-table">
<?php	
	foreach ($results as $ad) {
		$expires = $ad['expires'];
		if ($expires == "0000-00-00") {
			$expires = "";
		}
?>	
<form method="post" name="options" target="_self">
<?php settings_fields( 'chris2x-tagads-settings-group' ); ?>
        <tr valign="top">
        <td width=60 ><input type="submit" class="button-primary" name="function" value="<?php _e('Delete') ?>" /></td>
        <td width=60 ><input type="submit" class="button-primary" name="function" value="<?php _e('Edit') ?>" /></td>
		<td><?php echo $ad['advertiser'] ?></td>
		<td><?php echo $expires ?></td>
		<td align=left><?php echo stripslashes($ad['ad']) ?></td>
        </tr>
	<input type="hidden" name="tag_name" value="<?php echo $tag_name ?>" />    
	<input type="hidden" name="id" value="<?php echo $ad['id'] ?>" />    
</form>
<?php  
		}
?>
</table>
<?php  		
	}
	
	if ($action == 'Edit') {
		$id = $_POST['id'];
		
		$results = $wpdb->get_row("SELECT * from $table_name WHERE id = '".$id."'", ARRAY_A);		
		//_log($results);
		$tag_name = $results['tag_name'];
		$advertiser = $results['advertiser'];
		$expires = $results['expires'];
		$ad = $results['ad'];
	}	
	else {
		$id = "";
		$advertiser = "";
		$expires = "";
		$ad = "";
	}	
?>

<h3>Create an Ad</h3>

<form method="post" name="options" target="_self">
	<input type="hidden" name="id" value="<?php echo $id ?>" />    
    <?php settings_fields( 'chris2x-tagads-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Id</th>
        <td><?php echo $id ?></td>
        </tr>

        <tr valign="top">
        <th scope="row">Category Name</th>
        <td><input type="text" name="tag_name" value="<?php echo $tag_name ?>" /> [ Use word '<b>global</b>' if applicable to all Categories]</td>
        </tr>

        <tr valign="top">
        <th scope="row">Advertiser</th>
        <td><input type="text" name="advertiser" value="<?php echo $advertiser ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Ad</th>
        <td><textarea name="ad" rows=4 cols=60><?php echo stripslashes($ad) ?></textarea></td>
        </tr>        
    </table>
    
    <p class="submit">
    <?php if ($id == "") { ?>
	<input type="hidden" name="chris2x-tagads-command" value="create-ad" />
    <input type="submit" class="button-primary" value="<?php _e('Create Ad') ?>" />
	<?php } else { ?>
	<input type="hidden" name="chris2x-tagads-command" value="update-ad" />
    <input type="submit" class="button-primary" value="<?php _e('Update Ad') ?>" />
	<?php } ?>
    </p>
</form>

<h3>Show Ads</h3>

<form method="post" name="options" target="_self">
<?php settings_fields( 'chris2x-tagads-settings-group' ); ?>
    <table class="form-table">
		<tr valign="top">
		<th scope="row">Tag</th>
		<td><input type="text" name="tag_name" value="" /></td>
		</tr>
    </table>

	<input type="hidden" name="chris2x-tagads-command" value="show-ads" />
    <p class="submit">
    <input type="submit" class="button-primary" name="function" value="<?php _e('Show Ads') ?>" />
    </p>
</form>
</div>

<?php
	$results = $wpdb->get_results("SELECT tag_name,count(*) FROM $table_name group by tag_name order by count(*) desc", ARRAY_A);
	$bins = $results[0]['count(*)'] / 20;
	//_log("bins ".$bins);
	
	$results = $wpdb->get_results("SELECT tag_name,count(*) FROM $table_name group by tag_name order by tag_name", ARRAY_A);
	//_log($results);
	foreach ($results as $tag) {
		$size = ($tag['count(*)'] / $bins) + 1;
?>
<a href="?page=chris2x-tagads&tag_name=<?php echo $tag['tag_name'] ?>"><font size=<?php echo $size ?>><?php echo $tag['tag_name'] ?></a></font>&nbsp;
<?php
	}	
}

function register_chris2x_tagads_settings() {
	//register our settings
	register_setting( 'chris2x-tagads-settings-group', 'new_option_name' );
	register_setting( 'chris2x-tagads-settings-group', 'some_other_option' );
}

function chris2x_tagads_create_menu() {

	//create new top-level menu
	add_options_page('Category Ads Options', 'Category Ads', 'administrator', 'chris2x-tagads', 'chris2x_tagads_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_chris2x_tagads_settings' );
}


function chris2x_tagads_install () {
	global $wpdb;

	$table_name = $wpdb->prefix . "chris2x_tagads";
      
	$sql = "CREATE TABLE " . $table_name . " (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  tag_name varchar(64) NOT NULL,
	  ad text NOT NULL,
	  expires date,
	  advertiser varchar(64), 
	  UNIQUE KEY id (id), 
	  INDEX (tag_name)
	);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

/*
	$tagAds = new chris2XTagAds;
	$tagAds->get();
	foreach ($tagAds->ads as $k => $v) {
		foreach ($tagAds->ads[$k] as $ad) {
			$wpdb->insert( $table_name, array( 'tag_name' => $k, 'ad' => $ad));
		}
	}
*/	
	
	add_option("chris2x_tagads_db_version", "10.0");
}


//add_filter("the_content", "chris2x_tagads_filter");
add_action('admin_menu', 'chris2x_tagads_create_menu');
register_activation_hook(__FILE__,'chris2x_tagads_install');

?>
