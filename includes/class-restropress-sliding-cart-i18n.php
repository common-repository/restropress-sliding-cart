<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://restropress.com/
 * @since      1.1
 *
 * @package    RPSC_Main
 * @subpackage RPSC_Main/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.1
 * @package    RPSC_Main
 * @subpackage RPSC_Main/includes
 * @author     magnigenie
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RPSC_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'restropress-sliding-cart',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
