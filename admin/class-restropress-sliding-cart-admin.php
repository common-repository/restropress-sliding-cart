<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://restropress.com/
 * @since      1.1
 *
 * @package    RPSC_Main
 * @subpackage RPSC_Main/admin
 */
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    RPSC_Main
 * @subpackage RPSC_Main/admin
 * @author     magnigenie
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RPSC_Admin {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	/**
	 * The version of this plugin.
	 *
	 * @since    1.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;	
    }
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in RPSC_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The RPSC_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/restropress-sliding-cart-admin.css', array(), $this->version, 'all' );	
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in RPSC_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The RPSC_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/restropress-sliding-cart-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function add_sliding_cart_settings( $general_settings ) {
        // Add a new section for Sliding Cart settings
        $general_settings['sliding_cart_settings'] = array(
            'section_title' => __( 'Sliding Cart Settings', 'restropress-sliding-cart' ),
            'section_desc'  => '',
            'section_id'    => 'sliding_cart_settings',
            'section_order' => 100, // Adjust the order as needed
        );
        // Enable Sliding Cart Checkbox
        $general_settings['sliding_cart_settings']['sliding_cart_enable'] = array(
            'id'    => 'sliding_cart_enable',
            'name'  => __( 'Enable Sliding Cart', 'restropress-sliding-cart' ),
            'desc'  => __( 'Enable or disable the Sliding Cart feature.', 'restropress-sliding-cart' ),
            'type'  => 'checkbox',
        );

        // Enable Sliding Cart Checkbox
        $general_settings['sliding_cart_settings']['remove_cart_mobile'] = array(
            'id'    => 'remove_cart_mobile',
            'name'  => __( 'Remove Cart For Mobile view', 'restropress-sliding-cart' ),
            'desc'  => __( 'Enable this option if you want to disable cart icon for mobile view.', 'restropress-sliding-cart' ),
            'type'  => 'checkbox',
        );
        
        // Total Items Badge Color
        $general_settings['sliding_cart_settings']['sliding_cart_badge_color'] = array(
            'id'    => 'sliding_cart_badge_color',
            'name'  => __( 'Total Items Badge Color', 'restropress-sliding-cart' ),
            'desc'  => __( 'Choose the color of the total items badge.', 'restropress-sliding-cart' ),
            'type'  => 'color',
        );
        // Single field for selecting either icon bar or cart icon
       $general_settings['sliding_cart_settings']['display_option'] = array(
            'id'    => 'display_option',
            'name'  => __( 'Display Option', 'restropress-sliding-cart' ),
            'desc'  => __( 'Choose the display option.', 'restropress-sliding-cart' ),
            'type'  => 'radio',  // Use 'radio' type for a set of options
            'options' => array(
				'icon_bar' => __( 'Icon Bar', 'restropress-sliding-cart' ),
				'cart_icon' => __( 'Cart Icon', 'restropress-sliding-cart' ),
    		),
		);	
        // Add more Sliding Cart settings fields here following the same pattern
        return $general_settings;
    }
    public function add_sliding_cart_settings_section( $sections ) {
        $sections['sliding_cart_settings'] = __( 'Sliding Cart', 'restropress-sliding-cart' );
        return $sections;
    }   
}