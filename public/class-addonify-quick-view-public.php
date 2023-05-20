<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://addonify.com
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/public
 * @author     Addonify <info@addonify.com>
 */
class Addonify_Quick_View_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	/**
	 * Constructor for this class.
	 *
	 * @param string $plugin_name Name of plugin.
	 * @param string $version Version of plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;

		$this->version = $version;
	}

	/**
	 * Fires necessary actions when the plugin is loaded.
	 */
	public function actions_init() {

		if (
			! class_exists( 'WooCommerce' ) ||
			(int) addonify_quick_view_get_settings_fields_values( 'enable_quick_view' ) !== 1
		) {
			return;
		}

		add_filter( 'body_class', array( $this, 'body_classes_callback' ) );

		// Skips loading quick view related hooks when mobile device is detected.
		if (
			addonify_quick_view_is_mobile() &&
			(int) addonify_quick_view_get_settings_fields_values( 'disable_quick_view_on_mobile_device' ) === 1
		) {
			/**
			 * Handles AJAX request for coming from browser's responsive toggle toolbar.
			 * Solved the GitHub issue: https://github.com/addonify/addonify-quick-view/issues/150
			 *
			 * @since 1.2.4
			 */
			if ( ! wp_doing_ajax() ) {
				return;
			}
		}

		/**
		 * Loads front-end templates functions.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/template-functions.php';

		// Enqueue styles and scripts used in front-end.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add "Quick View" button after add to cart button.
		$quick_view_btn_position = addonify_quick_view_get_settings_fields_values( 'quick_view_btn_position' );
		if ( 'before_add_to_cart_button' === $quick_view_btn_position ) {
			add_action( 'woocommerce_after_shop_loop_item', 'addonify_quick_view_quick_view_button_template', 5 );
		}

		if ( 'after_add_to_cart_button' === $quick_view_btn_position ) {
			add_action( 'woocommerce_after_shop_loop_item', 'addonify_quick_view_quick_view_button_template', 15 );
		}

		// Add custom markup into footer.
		add_action( 'wp_footer', 'addonify_quick_view_content_wrapper_template' );

		// AJAX callback.
		add_action( 'wp_ajax_get_quick_view_contents', array( $this, 'quick_view_contents_callback' ) );
		add_action( 'wp_ajax_nopriv_get_quick_view_contents', array( $this, 'quick_view_contents_callback' ) );
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style(
			'perfect-scrollbar',
			plugin_dir_url( __FILE__ ) . 'assets/build/css/conditional/perfect-scrollbar.css',
			array(),
			$this->version,
			'all'
		);

		$style_dependency = array();

		if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {

			// These features are supported from woocommerce 3.0.0.
			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {

				if ( (int) addonify_quick_view_get_settings_fields_values( 'enable_lightbox' ) === 1 ) {
					$style_dependency[] = 'photoswipe-default-skin';
				}
			}
		}

		if ( is_rtl() ) {
			wp_enqueue_style(
				$this->plugin_name,
				plugin_dir_url( __FILE__ ) . 'assets/build/css/addonify-quick-view-rtl.css',
				$style_dependency,
				$this->version,
				'all'
			);
		} else {

			wp_enqueue_style(
				$this->plugin_name,
				plugin_dir_url( __FILE__ ) . 'assets/build/css/addonify-quick-view.css',
				$style_dependency,
				$this->version,
				'all'
			);
		}

		if ( (int) addonify_quick_view_get_settings_fields_values( 'enable_plugin_styles' ) === 1 ) {

			$inline_css = $this->dynamic_css();

			$custom_css = addonify_quick_view_get_settings_fields_values( 'custom_css' );

			if ( $custom_css ) {
				$inline_css .= $custom_css;
			}

			$inline_css = $this->minify_css( $inline_css );

			wp_add_inline_style( $this->plugin_name, $inline_css );
		}
	}

	/**
	 * Enqueue front end javascript scripts.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script(
			'perfect-scrollbar',
			plugin_dir_url( __FILE__ ) . 'assets/build/js/conditional/perfect-scrollbar.min.js',
			null,
			$this->version,
			true
		);

		$script_dependency = array( 'jquery', 'wc-add-to-cart-variation', 'flexslider' );

		if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {

			// these features are supported from woocommerce 3.0.0.

			if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {

				$script_dependency[] = 'zoom';
			}

			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {

				if ( (int) addonify_quick_view_get_settings_fields_values( 'enable_lightbox' ) === 1 ) {

					$script_dependency[] = 'photoswipe-ui-default';

					// This action is required for photoswipe to work.
					add_action( 'wp_footer', 'woocommerce_photoswipe', 15 );
				}
			}

			$script_dependency[] = 'wc-single-product';
		}

		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );

		wp_enqueue_script(
			'addonify-quick-view-public',
			plugin_dir_url( __FILE__ ) . 'assets/build/js/addonify-quick-view.min.js',
			$script_dependency,
			$this->version,
			true
		);

		// Localize AJAX script.
		wp_localize_script(
			'addonify-quick-view-public',
			'addonifyQuickViewPublicScriptObject',
			array(
				'ajaxURL'         => esc_url( admin_url( 'admin-ajax.php' ) ),
				'quickViewAction' => 'get_quick_view_contents',
				'nonce'           => wp_create_nonce( 'addonify_quick_view_nonce' ),
			)
		);
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @since 1.1.1
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes_callback( $classes ) {

		if ( (int) addonify_quick_view_get_settings_fields_values( 'disable_quick_view_on_mobile_device' ) === 1 ) {
			$classes[] = 'addonify-quick-view-disabled-on-mobile';
		}

		return $classes;
	}

	/**
	 * Ajax callback function for displaying content in modal when quick view button is clicked.
	 */
	public function quick_view_contents_callback() {

		$nonce = isset( $_GET['nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : ''; // phpcs:ignore

		if (
			empty( $nonce ) ||
			! wp_verify_nonce( $nonce, 'addonify_quick_view_nonce' )
		) {
			wp_send_json(
				array(
					'success' => false,
					'message' => esc_html__( 'Invalid security token.', 'addonify-quick-view' ),
				)
			);
		}

		$product_id = isset( $_GET['product_id'] ) ? (int) wp_unslash( $_GET['product_id'] ) : ''; // phpcs:ignore

		if ( ! $product_id ) {
			wp_send_json(
				array(
					'success' => false,
					'message' => esc_html__( 'Missing product id.', 'addonify-quick-view' ),
				)
			);
		}

		// generate contents dynamically.
		$this->generate_contents();

		$query_product = new WP_Query(
			array(
				'p'         => $product_id,
				'post_type' => 'product',
			)
		);

		if ( $query_product->have_posts() ) {

			$call_response = array(
				'success' => true,
			);

			ob_start();

			while ( $query_product->have_posts() ) {

				$query_product->the_post();

				do_action( 'addonify_quick_view_content', $product_id );
			}

			$call_response['data'] = ob_get_clean(); //phpcs:ignore

			wp_send_json( $call_response );
		} else {

			wp_send_json(
				array(
					'success' => false,
					'message' => esc_html__( 'There is no product with the id.', 'addonify-quick-view' ),
				)
			);
		}

		wp_die();

	}


	/**
	 * Generate and render contents for quick view modal.
	 */
	public function generate_contents() {

		$modal_box_content = unserialize( addonify_quick_view_get_settings_fields_values( 'modal_box_content' ) ); // phpcs:ignore

		if (
			! is_array( $modal_box_content ) ||
			empty( $modal_box_content )
		) {
			return;
		}

		// Show Hide Image according to user choices.
		if ( in_array( 'image', $modal_box_content, true ) ) {

			// show or hide gallery thumbnails according to user choice.
			if ( addonify_quick_view_get_settings_fields_values( 'product_thumbnail' ) === 'product_image_only' ) {

				remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
			}

			// show images.
			add_action( 'addonify_quick_view_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'addonify_quick_view_product_image', 'woocommerce_show_product_images', 20 );
		}

		// show or hide title.
		if ( in_array( 'title', $modal_box_content, true ) ) {

			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_title', 5 );
		}

		// show or hide product ratings.
		if ( in_array( 'rating', $modal_box_content, true ) ) {

			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_rating', 10 );
		}

		// show or hide price.
		if ( in_array( 'price', $modal_box_content, true ) ) {

			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_price', 15 );
		}

		// show or hide excerpt.
		if ( in_array( 'excerpt', $modal_box_content, true ) ) {

			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_excerpt', 20 );
		}

		// show or hide add to cart button.
		if ( in_array( 'add_to_cart', $modal_box_content, true ) ) {

			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
		}

		// show or hide product meta.
		if ( in_array( 'meta', $modal_box_content, true ) ) {

			add_action( 'addonify_quick_view_product_summary', 'woocommerce_template_single_meta', 30 );
		}
	}

	/**
	 * Print dynamic CSS generated from settings page.
	 */
	public function dynamic_css() {

		$css_values = array(
			'--addonify_qv_modal_overlay_background'      => addonify_quick_view_get_settings_fields_values( 'modal_box_overlay_background_color' ),
			'--addonify_qv_modal_background'              => addonify_quick_view_get_settings_fields_values( 'modal_box_background_color' ),
			'--addonify_qv_modal_general_text_color'      => addonify_quick_view_get_settings_fields_values( 'modal_box_general_text_color' ),
			'--addonify_qv_modal_inputs_background_color' => addonify_quick_view_get_settings_fields_values( 'modal_box_inputs_background_color' ),
			'--addonify_qv_modal_inputs_text_color'       => addonify_quick_view_get_settings_fields_values( 'modal_box_inputs_text_color' ),
			'--addonify_qv_modal_spinner_icon_color'      => addonify_quick_view_get_settings_fields_values( 'modal_box_spinner_icon_color' ),
			'--addonify_qv_product_title'                 => addonify_quick_view_get_settings_fields_values( 'product_title_color' ),
			'--addonify_qv_product_excerpt'               => addonify_quick_view_get_settings_fields_values( 'product_excerpt_text_color' ),
			'--addonify_qv_product_rating_filled'         => addonify_quick_view_get_settings_fields_values( 'product_rating_star_filled_color' ),
			'--addonify_qv_product_rating_empty'          => addonify_quick_view_get_settings_fields_values( 'product_rating_star_empty_color' ),
			'--addonify_qv_product_price'                 => addonify_quick_view_get_settings_fields_values( 'product_price_color' ),
			'--addonify_qv_product_price_sale'            => addonify_quick_view_get_settings_fields_values( 'product_on_sale_price_color' ),
			'--addonify_qv_product_meta'                  => addonify_quick_view_get_settings_fields_values( 'product_meta_text_color' ),
			'--addonify_qv_product_meta_hover'            => addonify_quick_view_get_settings_fields_values( 'product_meta_text_hover_color' ),
			'--addonify_qv_close_button_text'             => addonify_quick_view_get_settings_fields_values( 'modal_close_button_text_color' ),
			'--addonify_qv_close_button_text_hover'       => addonify_quick_view_get_settings_fields_values( 'modal_close_button_text_hover_color' ),
			'--addonify_qv_close_button_background'       => addonify_quick_view_get_settings_fields_values( 'modal_close_button_background_color' ),
			'--addonify_qv_close_button_background_hover' => addonify_quick_view_get_settings_fields_values( 'modal_close_button_background_hover_color' ),
			'--addonify_qv_misc_button_text'              => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_text_color' ),
			'--addonify_qv_misc_button_text_hover'        => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_text_hover_color' ),
			'--addonify_qv_misc_button_background'        => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_background_color' ),
			'--addonify_qv_misc_button_background_hover'  => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_background_hover_color' ),
		);

		$css = ':root {';

		foreach ( $css_values as $key => $value ) {
			if ( $value ) {
				$css .= $key . ': ' . $value . ';';
			}
		}

		$css .= '}';

		return $css;
	}


	/**
	 * Minify the dynamic css.
	 *
	 * @param string $css css to minify.
	 * @return string minified css.
	 */
	public function minify_css( $css ) {

		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		return trim( $css );
	}
}
