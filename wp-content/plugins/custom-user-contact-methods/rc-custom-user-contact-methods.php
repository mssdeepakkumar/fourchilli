<?php
/*
Plugin Name: Custom User Contact Methods
Plugin URL: http://remicorson.com/
Description: Add custom fields to users "contact" section
Version: 1.0
Author: Remi Corson
Author URI: http://remicorson.com
Contributors: corsonr
*/

$extra_fields =  array( 
					array( 'phone', __('Phone Number', 'rc_cucm'), true )
					);

// Use the user_contactmethods to add new fields
add_filter( 'user_contactmethods', 'rc_add_user_contactmethods' );

// Add our fields to the registration process
add_action( 'register_form', 'rc_register_form_display_extra_fields' );
add_action( 'user_register', 'rc_user_register_save_extra_fields', 100 );

/**
 * Add custom users custom contact methods
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function rc_add_user_contactmethods( $user_contactmethods ) {

	// Get fields
	global $extra_fields;
	
	// Display each fields
	foreach( $extra_fields as $field ) {
		if ( !isset( $contactmethods[ $field[0] ] ) )
    		$user_contactmethods[ $field[0] ] = $field[1];
	}

    // Returns the contact methods
    return $user_contactmethods;
}


/**
 * Show custom fields on registration page
 *
 * Show custom fields on registration if field third parameter is set to true
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function rc_register_form_display_extra_fields() {
    
    // Get fields
    global $extra_fields;

    // Display each field if 3th parameter set to "true"
    foreach( $extra_fields as $field ) {
    	if( $field[2] == true ) { 
    	if( isset( $_POST[ $field[0] ] ) ) { $field_value = $_POST[ $field[0] ]; } else { $field_value = ''; }
    	?>
	    <p>
            <label for="<?php echo $field[0]; ?>"><?php echo $field[1]; ?><br />
            <input type="text" name="<?php echo $field[0]; ?>" id="<?php echo $field[0]; ?>" class="input" value="<?php echo $field_value; ?>" size="20" /></label>
            </label>
	    </p>
	    <?php
    	} // endif
    } // end foreach
}

/**
 * Save field values
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
function rc_user_register_save_extra_fields( $user_id, $password = '', $meta = array() )  {

	// Get fields
    global $extra_fields;
    
    $userdata       = array();
    $userdata['ID'] = $user_id;
    
    // Save each field
    foreach( $extra_fields as $field ) {
    	if( $field[2] == true ) { 
	    	$userdata[ $field[0] ] = $_POST[ $field[0] ];
	    } // endif
	} // end foreach

    $new_user_id = wp_update_user( $userdata );
}

