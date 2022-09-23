<?php
/**
 * Plugin Name: Rewrite Email Address
 * Plugin URI: https://wordpress.org/rtahina/rewrite-email-address/
 * Description: This plugin rewrites your email address so that web crawler  won't be able to harvest them. Ex: myemail@adress.com would be rewritten to myemail_At_address.com
 * Version: 1.0.2
 * Author: Tahina Rakotomanarivo.
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

    /**
     * the_content hook callback
     */
    public function rewrite_email_address( $content ) {

        $pattern = '/([a-z0-9_\.\-])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,4})+/i';
        preg_match_all( $pattern, $content, $match );

        if ( isset( $match[0] ) ) {
            $email_addresses = $match[0];
            $rewritten_email_addresses = [];

            foreach( $email_addresses as $email ) {
                $rewritten_email = str_replace( '@', '_At_', $email );
                $rewritten_email = '' . $rewritten_email . ' <sup><i style="font-size: 0.8em; opacity:0.8;" class="fa fa-envelope" aria-hidden="true"></i></sup>';
                $rewritten_email_addresses[] = $rewritten_email;
            }

            $content = str_replace( $email_addresses, $rewritten_email_addresses, $content );
        }

        return $content;
    }

}

$plugin = new Rewrite_Email_Address();
