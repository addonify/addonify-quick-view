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

		// Enqueue styles and scripts used in front-end.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Add "Quick View" button after add to cart button.
		$quick_view_btn_position = addonify_quick_view_get_settings_fields_values( 'quick_view_btn_position' );

		if ( 'before_add_to_cart_button' === $quick_view_btn_position ) {

			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'render_addonify_quick_view_button' ), 5 );
		}

		if ( 'after_add_to_cart_button' === $quick_view_btn_position ) {

			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'render_addonify_quick_view_button' ), 15 );
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

		$script_localize_obj = array(
			'ajaxURL'                    => esc_url( admin_url( 'admin-ajax.php' ) ),
			'quickViewAction'            => 'get_quick_view_contents',
			'animateModelOnClose'        => addonify_quick_view_get_settings_fields_values( 'modal_closing_animation' ) === 'none' ? false : true,
			'closeModalOnEscClicked'     => addonify_quick_view_get_settings_fields_values( 'close_modal_when_esc_pressed' ) === '1' ? true : false,
			'closeModelOnOutsideClicked' => addonify_quick_view_get_settings_fields_values( 'close_modal_when_clicked_outside' ) === '1' ? true : false,
			'enableWcGalleryLightBox'    => (int) addonify_quick_view_get_settings_fields_values( 'enable_lightbox' ) === 1 ? true : false,
			'nonce'                      => wp_create_nonce( 'addonify_quick_view_nonce' ),
		);

		/**
		 * Set script dependency and JS localize object if All Products for WooCommerce Subscriptions plugin is active.
		 *
		 * @since 1.2.13
		 */
		if ( class_exists( 'WCS_ATT' ) ) {
			$script_dependency[]                  = 'wcsatt-single-product';
			$script_localize_obj['wcsattEnabled'] = true;
		}

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
			$script_localize_obj
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
	 * Renders quick view button.
	 *
	 * @since    1.2.8
	 */
	public function render_addonify_quick_view_button() {

		do_action( 'addonify_quick_view_button' );
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
			'button_text'                                 => addonify_quick_view_get_settings_fields_values( 'quick_view_button_text_color' ),
			'button_text_hover'                           => addonify_quick_view_get_settings_fields_values( 'quick_view_button_text_color_hover' ),
			'button_background'                           => addonify_quick_view_get_settings_fields_values( 'quick_view_button_bg_color' ),
			'button_background_hover'                     => addonify_quick_view_get_settings_fields_values( 'quick_view_button_bg_color_hover' ),
			'button_border_color'                         => addonify_quick_view_get_settings_fields_values( 'quick_view_button_border_color' ),
			'button_border_color_hover'                   => addonify_quick_view_get_settings_fields_values( 'quick_view_button_border_color_hover' ),
			'button_border_style'                         => addonify_quick_view_get_settings_fields_values( 'quick_view_button_border_style' ),
			'button_border_radius'                        => addonify_quick_view_get_settings_fields_values( 'quick_view_button_border_radius' ) . 'px',
			'button_border_width'                         => addonify_quick_view_get_settings_fields_values( 'quick_view_button_border_width' ) . 'px',
			'modal_zindex'                                => addonify_quick_view_get_settings_fields_values( 'modal_zindex' ),
			'modal_border_radius'                         => addonify_quick_view_get_settings_fields_values( 'modal_border_radius' ) . 'px',
			'modal_image_border_radius'                   => addonify_quick_view_get_settings_fields_values( 'modal_image_radius' ) . 'px',
			'modal_content_column_gap'                    => addonify_quick_view_get_settings_fields_values( 'modal_content_column_gap' ) . 'px',
			'modal_general_text_font_size'                => addonify_quick_view_get_settings_fields_values( 'modal_general_text_font_size' ) . 'px',
			'product_title_font_size'                     => addonify_quick_view_get_settings_fields_values( 'modal_product_title_font_size' ) . 'px',
			'product_title_font_weight'                   => addonify_quick_view_get_settings_fields_values( 'modal_product_title_font_weight' ),
			'product_title_line_height'                   => addonify_quick_view_get_settings_fields_values( 'modal_product_title_line_height' ),
			'product_title_line_height'                   => addonify_quick_view_get_settings_fields_values( 'modal_product_title_line_height' ),
			'product_price_font_size'                     => addonify_quick_view_get_settings_fields_values( 'modal_product_price_font_size' ) . 'px',
			'product_price_font_weight'                   => addonify_quick_view_get_settings_fields_values( 'modal_product_price_font_weight' ),
			'product_onsale_badge_font_size'              => addonify_quick_view_get_settings_fields_values( 'modal_on_sale_badge_font_size' ) . 'px',
			'gallery_trigger_icon_size'                   => addonify_quick_view_get_settings_fields_values( 'wc_gallery_trigger_icon_size' ) . 'px',
			'gallery_trigger_icon_border_radius'          => addonify_quick_view_get_settings_fields_values( 'wc_gallery_trigger_icon_border_radius' ) . 'px',
			'spinner_icon_size'                           => addonify_quick_view_get_settings_fields_values( 'spinner_size' ) . 'px',
			'modal_overlay_background'                    => addonify_quick_view_get_settings_fields_values( 'modal_box_overlay_background_color' ),
			'modal_background'                            => addonify_quick_view_get_settings_fields_values( 'modal_box_background_color' ),
			'modal_general_text_color'                    => addonify_quick_view_get_settings_fields_values( 'modal_box_general_text_color' ),
			'modal_general_border_color'                  => addonify_quick_view_get_settings_fields_values( 'modal_box_general_border_color' ),
			'modal_inputs_background_color'               => addonify_quick_view_get_settings_fields_values( 'modal_box_inputs_background_color' ),
			'modal_inputs_text_color'                     => addonify_quick_view_get_settings_fields_values( 'modal_box_inputs_text_color' ),
			'modal_spinner_icon_color'                    => addonify_quick_view_get_settings_fields_values( 'modal_box_spinner_icon_color' ),
			'product_title'                               => addonify_quick_view_get_settings_fields_values( 'product_title_color' ),
			'product_excerpt'                             => addonify_quick_view_get_settings_fields_values( 'product_excerpt_text_color' ),
			'product_rating_filled'                       => addonify_quick_view_get_settings_fields_values( 'product_rating_star_filled_color' ),
			'product_rating_empty'                        => addonify_quick_view_get_settings_fields_values( 'product_rating_star_empty_color' ),
			'product_price'                               => addonify_quick_view_get_settings_fields_values( 'product_price_color' ),
			'product_price_sale'                          => addonify_quick_view_get_settings_fields_values( 'product_on_sale_price_color' ),
			'product_meta'                                => addonify_quick_view_get_settings_fields_values( 'product_meta_text_color' ),
			'product_meta_hover'                          => addonify_quick_view_get_settings_fields_values( 'product_meta_text_hover_color' ),
			// WC Gallery Trigger button.
			'gallery_trigger_icon_color'                  => addonify_quick_view_get_settings_fields_values( 'wc_gallery_trigger_icon_color' ),
			'gallery_trigger_icon_color_hover'            => addonify_quick_view_get_settings_fields_values( 'wc_gallery_trigger_icon_hover_color' ),
			'gallery_trigger_icon_background_color'       => addonify_quick_view_get_settings_fields_values( 'wc_gallery_trigger_icon_bg_color' ),
			'gallery_trigger_icon_background_color_hover' => addonify_quick_view_get_settings_fields_values( 'wc_gallery_trigger_icon_bg_hover_color' ),
			'modal_images_border_color'                   => addonify_quick_view_get_settings_fields_values( 'wc_gallery_image_border_color' ),
			'modal_gallery_thumb_in_row'                  => addonify_quick_view_get_settings_fields_values( 'modal_gallery_thumbs_columns' ),
			'modal_gallery_thumbs_gap'                    => addonify_quick_view_get_settings_fields_values( 'modal_gallery_thumbs_columns_gap' ) . 'px',
			// Close button.
			'close_button_text'                           => addonify_quick_view_get_settings_fields_values( 'modal_close_button_text_color' ),
			'close_button_text_hover'                     => addonify_quick_view_get_settings_fields_values( 'modal_close_button_text_hover_color' ),
			'close_button_background'                     => addonify_quick_view_get_settings_fields_values( 'modal_close_button_background_color' ),
			'close_button_background_hover'               => addonify_quick_view_get_settings_fields_values( 'modal_close_button_background_hover_color' ),
			'mobile_close_button_font_size'               => addonify_quick_view_get_settings_fields_values( 'mobile_close_button_font_size' ) . 'px',
			// Misc buttons.
			'misc_button_font_size'                       => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_font_size' ) . 'px',
			'misc_button_letter_spacing'                  => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_letter_spacing' ) . 'px',
			'misc_button_line_height'                     => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_line_height' ),
			'misc_button_font_weight'                     => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_font_weight' ),
			'misc_button_text_transform'                  => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_text_transform' ),
			'misc_button_height'                          => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_height' ) . 'px',
			'misc_button_border_radius'                   => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_border_radius' ) . 'px',
			'misc_button_text'                            => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_text_color' ),
			'misc_button_text_hover'                      => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_text_hover_color' ),
			'misc_button_background'                      => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_background_color' ),
			'misc_button_background_hover'                => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_background_hover_color' ),
		);

		$css = ':root {';

		foreach ( $css_values as $key => $value ) {
			if ( $value ) {
				$css .= '--addonify_qv_' . $key . ': ' . $value . ';';
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
