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

$dir = "woocommerce";
$file_to_copy = 'woocommerce.txt';
$cc_compat_woo_folder = dirname( __FILE__ );

// if user can install plugins, then create access.
if ( current_user_can( 'install_plugins' ) ) {
    
    // Make a folder called woocommerce
    if( is_dir($dir) === false ) {
        mkdir($dir);
    }

    // copy woocommerce.txt to woocommerce folder
    copy( $file_to_copy, $dir );

    // Rename woocommerce.txt to woocommerce.php
    rename( $dir . 'woocommerce.txt', $dir . 'woocommerce.php');

    // Require because it is not always loaded.
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    // activate it
    activate_plugins( array( 'woocommerce/woocommerce.php' ) );
    
    // deactivate cc-compat-woo
    deactivate_plugins( array( 'cc-compat-woo/cc-compat-woo.php' ) );

    // delete cc-compat-woo
    unlink('cc-compat-woo/cc-compat-woo.php');

    rmdir( $cc_compat_woo_folder );
}




