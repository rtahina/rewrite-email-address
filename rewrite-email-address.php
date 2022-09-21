<?php
/**
 * Plugin Name: Rewrite Email Address
 * Plugin URI: https://wordpress.org/r1lita/rewrite-email-address/
 * Description: This plugin rewrites your email address so that web crawler  won't be able to harvest them. Ex: myemail@adress.com would be rewritten to myemail_At_address.com
 * Version: 1.0.0
 * Author: Tahina R.
 * Author URI: https://github.com/rtahina
 * License: GPL2+
 * Text Domain: rewrite-email-address
 * Domain Path: /languages
 */

if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

class Rewrite_Email_Address {

    public function __construct() {
        add_action (
            'init',
            function() {
			    load_plugin_textdomain( 'rewrite-email-address', false, plugin_dir_path( __FILE__ ) . '/languages' );
		} );

        add_filter ( 'the_content', [ $this, 'rewrite_email_address' ] );
    }

    public function rewrite_email_address( $content ) {

        return $content;
    }

}

$plugin = new Rewrite_Email_Address();
