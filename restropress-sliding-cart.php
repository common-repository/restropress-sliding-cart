<?php

/**
 * Plugin Name:       Restropress - Sliding Cart
 * Plugin URI:        https://restropress.com/
 * Description:       Through this plugin you can able to add a Sliding Cart For RestroPress.
 * Version:           1.2.3
 * Author:            magnigenie
 * Author URI:        https://magnigenie.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       restropress-sliding-cart
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !defined( 'RPSC_FILE' ) ) {
    define( 'RPSC_FILE', __FILE__ );
}

define( 'RPSC_VERSION', '1.2.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-restropress-sliding-cart-activator.php
 */
function rpsc_register_activation_hook_callback() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-restropress-sliding-cart-activator.php';
	RPSC_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-restropress-sliding-cart-deactivator.php
 */
function rpsc_register_deactivation_hook_callback() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-restropress-sliding-cart-deactivator.php';
	RPSC_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'rpsc_register_activation_hook_callback' );
register_deactivation_hook( __FILE__, 'rpsc_register_deactivation_hook_callback' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-restropress-sliding-cart.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1
 */
function rpsc_execute() {

	$plugin = new RPSC_Main();
	$plugin->run();

}
rpsc_execute();