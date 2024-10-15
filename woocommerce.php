<?php
/**
 * Plugin Name: CC Compatibility for Woo Addons
 * Description: A compatibility plugin for some WooCommerce addons to work with Classic Commerce.
 * Author: Classic Commerce Research Team
 * Version: 9999.2
 * Requires CP: 1.0
 * Requires PHP: 7.0
 * Author URI: https://www.classiccommerce.cc/
 *
 * Contributors: SAThemba, ZigPress
 */

defined( 'ABSPATH' ) || exit;

define( 'CCWOOADDONSCOMPAT_VERSION', '9999.2' );  // Make sure the version number (and in the headers) is higher then current Woo version

define( 'CCWOOADDONSCOMPAT__FILE__', __FILE__ );
define( 'CCWOOADDONSCOMPAT_PATH', plugin_dir_path( CCWOOADDONSCOMPAT__FILE__ ) );

if( !defined( 'CCWOOADDONSCOMPAT_PLUGIN_BASE' ) ) {
	define( 'CCWOOADDONSCOMPAT_PLUGIN_BASE', plugin_basename( CCWOOADDONSCOMPAT__FILE__ ) );
}

function ccwooaddonscompat_hide_view_details( $plugin_meta, $plugin_file, $plugin_data, $status ) {
	if( CCWOOADDONSCOMPAT_PLUGIN_BASE == $plugin_file ) {
		unset( $plugin_meta[2] );
	}
	return $plugin_meta;
}
add_filter( 'plugin_row_meta', 'ccwooaddonscompat_hide_view_details', 10, 4 );
