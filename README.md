# CC Compat with WooCommerce
Plugin to facilitate Classic Commerce compatibility with WooCommerce extension plugins.

Some WooCommerce extensions check for an active plugin file named `woocommerce/woocommerce.php`, which doesn't work with Classic Commerce because the folder and the file have been renamed.

This compatibility plugin may perform other duties in the future, but for now it just provides a file named `woocommerce/woocommerce.php` so that these extensions can work as expected.
