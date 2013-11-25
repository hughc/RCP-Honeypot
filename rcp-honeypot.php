<?php
/*
 * Plugin Name: Restrict Content Pro - Honeypot
 * Description: Simple anti-spam honeypot field to the Restrict Content Pro registration form
 * Author: Pippin Williamson
 * Version: 1.0
 */

class RCP_Honeypot {
	
	public function __construct() {

		add_action( 'rcp_form_errors',                 array( $this, 'error_checks'   ) );
		add_action( 'rcp_before_register_form_fields', array( $this, 'honeypot_field' ) );

	}

	public function error_checks() {
		if( ! empty( $_POST['rcp_sugar_pot'] ) ) {
			rcp_errors()->add( 'spammer', __( 'Nice try spammer, feel free to try again', 'rcp' ), 'register' );
		}
	}

	public function honeypot_field() {
		echo '<input type="hidden" name="rcp_sugar_pot" value=""/>';
	}

}
if( ! is_admin() ) {
	$rcp_honeypot = new RCP_Honeypot;
}