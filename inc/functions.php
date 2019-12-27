<?php
/**
 * File contains functions required by the plugin.
 */

// Instantiates the WordPress filesystem
function get_filesystem() {
	global $wp_filesystem;
	if ( ! defined( 'FS_METHOD' ) ) {
		define( 'FS_METHOD', 'direct' );
	}
	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}
	return $wp_filesystem;
}

// Install plugin
function install_compat() {
	if ( current_user_can( 'install_plugins' ) ) {
		// Require because it is not always loaded.
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( is_woocommerce_installed() ) {
            return;
        }
		// activate it
		activate_plugins( 'woocommerce/woocommerce.php' );
	}
}

// Display admin notice
function display_wc_message() {
	add_action( 'admin_notices', 'cc_wc_already_installed_notice' );
	deactivate_plugins( array( 'cc-compat-woo/cc-compat-woo.php' ) );
}

function cc_wc_already_installed_notice() {
	$error = 'You must delete WooCommerce before installing the CC Compatibility for Woo Addons plugin.';
    echo '<div class="error notice is-dismissible"><p>';
    echo __( $error, 'cc-compat-woo' );
    echo '</p></div>';
}

/**
 * Check if Is WooCommerce Installed
 * 
 * @returns boolean
 */
function is_woocommerce_installed() {
	$wp_filesystem = get_filesystem();
	
	if ( ! function_exists( 'is_plugin_active' ) ) {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	// Check for conclusive proof that the real WC is installed and not the Classic Commerce compatibility plugin 
	if( $wp_filesystem->exists( WP_PLUGIN_DIR . "/woocommerce/woocommerce.php" ) && 
		$wp_filesystem->exists( WP_PLUGIN_DIR . "/woocommerce/includes/class-woocommerce.php" ) && 
		$wp_filesystem->exists( WP_PLUGIN_DIR . "/woocommerce/includes/admin/class-wc-admin.php" ) 
	) {
		return true;
	}
	return false;
}
