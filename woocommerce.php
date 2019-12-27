<?php
/**
 * Plugin Name: CC Compatibility
 * Description: A compatibility plugin for some WooCommerce addons to work with ClassicCommerce.
 * Author: Classic Commerce Research Team
 * Author URI: https://www.classiccommerce.cc/
 * Plugin URI: https://www.classiccommerce.cc/
 * Version: 9999.0
 * Requires at least: 1.0.0
 * Tested up to: 1.1.2
 * 
 * Contributors: SAThemba, ZigPress
 */

defined( 'ABSPATH' ) || exit;

// Load the Update Client to manage updates for the CC Compatibility for Woo Addons plugin
include_once dirname( __FILE__ ) . '/includes/UpdateClient.class.php';

define( 'CCWOOADDONSCOMPAT_VERSION', '9999.0' ); // DO NOT change the version in the plugin header or the Earth will fall on you :P 
define( 'CCWOOADDONSCOMPAT__FILE__', __FILE__ );
define( 'CCWOOADDONSCOMPAT_PATH', plugin_dir_path( CCWOOADDONSCOMPAT__FILE__ ) );

if( !defined( 'CCWOOADDONSCOMPAT_PLUGIN_BASE' ) ) {
    define( 'CCWOOADDONSCOMPAT_PLUGIN_BASE', plugin_basename( CCWOOADDONSCOMPAT__FILE__ ) );
}

if( ! function_exists( 'wp_get_current_user' ) ) {
    require( ABSPATH . 'wp-includes/pluggable.php' ) ; 
}

require_once( WP_PLUGIN_DIR . '/cc-compat-woo/includes/functions.php' ) ; 

if ( is_woocommerce_installed() ) {
	display_wc_message();
	return;
}

install_compat();

add_filter( 'plugin_row_meta', 'ccwooaddonscompat_hide_view_details', 10, 4 );
function ccwooaddonscompat_hide_view_details( $plugin_meta, $plugin_file, $plugin_data, $status ) {
	if( CCWOOADDONSCOMPAT_PLUGIN_BASE == $plugin_file ) {
		unset( $plugin_meta[2] );		
	}
	return $plugin_meta;
}
