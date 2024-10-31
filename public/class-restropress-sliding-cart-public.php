<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://restropress.com/
 * @since      1.1
 *
 * @package    RPSC_Main
 * @subpackage RPSC_Main/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    RPSC_Main
 * @subpackage RPSC_Main/public
 * @author     magnigenie
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RPSC_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/restropress-sliding-cart-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/restropress-sliding-cart-public.js', array( 'jquery' ), $this->version, false );
        wp_localize_script( $this->plugin_name, 'rpsc_object', 
			array( 'ajax_url' 	=> admin_url( 'admin-ajax.php' ),
					'nonce' 	=> wp_create_nonce( 'ajax-nonce' )
				) );
	}
	
	public function get_cart_details() {

		check_ajax_referer( 'ajax-nonce', 'security' );
		
		$subtotal = rpress_get_cart_subtotal();
		$cart_details = count( rpress_get_cart_content_details() );
		$enable = rpress_get_option( 'sliding_cart_enable' );
		 
		$response = array(
			'subtotal' => $subtotal,
			'cart_details' => $cart_details,
			'set_enablle' => $enable
		);
		wp_send_json($response);	
	}
	public function add_floating_cart() {
		$enable = rpress_get_option('sliding_cart_enable');
		$cart_items = rpress_get_cart_contents();
		$display_option = rpress_get_option('display_option');
		$sliding_cart_badge_color = rpress_get_option('sliding_cart_badge_color', '');
		$remove_cart_icon = rpress_get_option( 'remove_cart_mobile' );

		if (!$enable) return;
		// Display the cart icon based on the display option
		if ($display_option === 'icon_bar') {
			// Display the existing cart display
			echo '<div class="rp-cart-left-wrap">';
			echo '<span class="rp-cart-mb-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>';
			echo '<span id="icon-bar" class="rpress-badge" style="color: ' . esc_attr($sliding_cart_badge_color) . ';"><sup>' . esc_html( count( $cart_items ) ) . '</sup></span>';
			echo '</span>';
			echo '<span class="rp-separation">&nbsp;|&nbsp;</span>';
			echo '<span class="rp-mb-price">' . esc_html( rpress_currency_filter( rpress_format_amount( rpress_get_cart_total() ) ) ) . '</span>';
			echo '</div>';
		} elseif ($display_option === 'cart_icon') {
			echo '<div id="rpress-floating-cart-icon">';
			echo '<div class="rpress-floating-inner-wrap">';
			echo '<span id="cart-icon" class="rpress-badge" style="color: ' . esc_attr($sliding_cart_badge_color) . ';"><sup>' . esc_html( count( $cart_items ) ) . '</sup></span>';
			echo '<i class="rpress-icon-cart"></i>';
			echo '</div>';
			echo '</div>';
		} 

		if ($remove_cart_icon == '1') { ?>
			<style>
				@media (max-width: 720px) {
					#rpress-floating-cart-icon {
						display: none !important;
					}
				}
			</style>
		<?php } elseif ($remove_cart_icon == '0') { ?>
			<style>
				@media (max-width: 720px) {
					.rpress-mobile-cart-icons {
						display: none !important;
					}
				}
			</style>
		<?php } 
	}	
}
$RPSC_Public = new RPSC_Public( 'restropress-sliding-cart', '1.1' );
