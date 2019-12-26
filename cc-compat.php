<?php
/**
 * Plugin Name: CC Compatibility
 * Description: A compatibility plugin for some WooCommerce addons to work with ClassicCommerce.
 * Author: Classic Commerce Research Team
 * Version: 9999.0
 * Requires at least: 1.0.0
 * Tested up to: 1.1.2
 * Author URI: https://www.classiccommerce.cc/
 * 
 * Contributors: SAThemba, ZigPress
 */

if( ! function_exists( 'wp_get_current_user' ) ) {
    require( ABSPATH . "wp-includes/pluggable.php") ; 
}
    
// Require because it is not always loaded.
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

global $wp_filesystem;
  
$dir = "woocommerce";
$file_to_copy = 'woocommerce.txt';
$cc_compat_woo_folder = dirname( __FILE__ );

// if user can install plugins, then create access.
if ( current_user_can( 'install_plugins' ) ) {

    // Make a folder called woocommerce
    if( $wp_filesystem->is_dir($dir) === false ) {
        $wp_filesystem->mkdir($dir);
        // copy woocommerce.txt into .php in woocommerce folder
        $wp_filesystem->move( $dir . $file_to_copy, $dir . 'woocommerce.php');
        
        // activate it
        activate_plugins( 'woocommerce/woocommerce.php' );
        
        // deactivate cc-compat-woo
        deactivate_plugins( 'cc-compat-woo/cc-compat-woo.php' );

        // delete cc-compat-woo
        $wp_filesystem->delete('cc-compat-woo/cc-compat-woo.php');

        $wp_filesystem->rmdir( $cc_compat_woo_folder );
    }
}