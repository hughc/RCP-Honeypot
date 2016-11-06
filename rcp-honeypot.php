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
		add_action( 'rcp_after_register_form_fields', array( $this, 'honeypot_field' ) );

	}

	public function error_checks() {
		if( ! empty( $_POST['rcp_phone_field_002'] ) ) {
			rcp_errors()->add( 'spammer', __( 'Nice try spammer, feel free to try again', 'rcp' ), 'register' );
		}
	}

	public function honeypot_field() {
		?>
		<p id="rcp_validation_wrap" style='display:none; position: absolute!important; left: -9000px;'>
			<label for="rcp_phone_field_002">Phone</label>
			<input name="rcp_phone_field_002" id="rcp_phone_field_002" type="text" placeholder="Phone">
		</p>
		<?
	}

}
if( ! is_admin() ) {
	$rcp_honeypot = new RCP_Honeypot;
}