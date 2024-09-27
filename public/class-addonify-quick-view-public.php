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
	 * Quick view button label.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $quick_view_button_label Quick view button label.
	 */
	private $quick_view_button_label;

	/**
	 * Holds boolean value to display quick view button icon.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    boolean $display_quick_view_button_icon Holds boolean value to display quick view button icon.
	 */
	private $display_quick_view_button_icon;

	/**
	 * Quick view button icon position.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $quick_view_button_icon_position Quick view button icon position.
	 */
	private $quick_view_button_icon_position;

	/**
	 * Quick view button icon.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string $quick_view_button_icon Quick view button icon.
	 */
	private $quick_view_button_icon;

	/**
	 * Holds boolean value if quick view is enabled.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    boolean $enable_quick_view Holds boolean value if quick view is enabled.
	 */
	private $enable_quick_view;


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

		$this->enable_quick_view = addonify_quick_view_get_option( 'enable_quick_view' );

		if ( '1' !== $this->enable_quick_view ) {
			return;
		}

		$this->quick_view_button_label = addonify_quick_view_get_option( 'quick_view_btn_label' );

		$this->display_quick_view_button_icon  = addonify_quick_view_get_option( 'enable_quick_view_btn_icon' );
		$this->quick_view_button_icon_position = addonify_quick_view_get_option( 'quick_view_btn_icon_position' );
		$this->quick_view_button_icon          = addonify_quick_view_get_option( 'quick_view_btn_icon' );

		add_filter( 'body_class', array( $this, 'body_classes_callback' ) );

		// Skips loading quick view related hooks when mobile device is detected.
		if (
			addonify_quick_view_is_mobile() &&
			(int) addonify_quick_view_get_option( 'disable_quick_view_on_mobile_device' ) === 1
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

		// Add "Quick View" button after add to cart button.
		$quick_view_btn_position = addonify_quick_view_get_option( 'quick_view_btn_position' );

		if ( 'before_add_to_cart_button' === $quick_view_btn_position ) {

			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'render_addonify_quick_view_button' ), 5 );
		}

		if ( 'after_add_to_cart_button' === $quick_view_btn_position ) {

			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'render_addonify_quick_view_button' ), 15 );
		}

		if ( 'over_image' === $quick_view_btn_position ) {

			add_action(
				'body_class',
				function ( $classes ) {

					$classes[] = 'addonify-qv-btn-over-image';

					return $classes;
				}
			);

			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'render_addonify_quick_view_button' ), 15 );
		}

		// Add custom markup into footer.
		add_action( 'wp_footer', 'addonify_quick_view_content_wrapper_template' );

		add_shortcode( 'addonify_quick_view_button', array( $this, 'quick_view_button_shortcode_callback' ) );

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

		if ( '1' !== $this->enable_quick_view ) {
			return;
		}

		wp_enqueue_style(
			'perfect-scrollbar',
			plugin_dir_url( __FILE__ ) . 'assets/libs/scrollbar/perfect-scrollbar.min.css',
			array(),
			$this->version,
			'all'
		);

		$style_dependency = array();

		if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {

			// These features are supported from woocommerce 3.0.0.
			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {

				if ( (int) addonify_quick_view_get_option( 'enable_lightbox' ) === 1 ) {
					$style_dependency[] = 'photoswipe-default-skin';
				}
			}
		}

		wp_enqueue_style(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'assets/build/public.min.css',
			$style_dependency,
			$this->version,
			'all'
		);

		$inline_css = $this->dynamic_css();

		$custom_css = addonify_quick_view_get_option( 'custom_css' );

		if ( $custom_css ) {
			$inline_css .= $custom_css;
		}

		$inline_css = addonify_quick_view_minify_css( $inline_css );

		wp_add_inline_style( $this->plugin_name, $inline_css );
	}

	/**
	 * Enqueue front end javascript scripts.
	 */
	public function enqueue_scripts() {

		if ( '1' !== $this->enable_quick_view ) {
			return;
		}

		wp_enqueue_script(
			'perfect-scrollbar',
			plugin_dir_url( __FILE__ ) . 'assets/libs/scrollbar/perfect-scrollbar.min.js',
			array(),
			$this->version,
			true
		);

		$script_dependency = array( 'jquery', 'perfect-scrollbar', 'wc-add-to-cart-variation', 'flexslider' );

		$script_localize_obj = apply_filters(
			'addonify_quick_view_localize_script_data',
			array(
				'ajaxURL'                    => esc_url( admin_url( 'admin-ajax.php' ) ),
				'ajaxQuickViewAction'        => 'get_quick_view_contents',
				'animateModelOnClose'        => addonify_quick_view_get_option( 'modal_closing_animation' ) === 'none' ? false : true,
				'closeModalOnEscClicked'     => addonify_quick_view_get_option( 'close_modal_when_esc_pressed' ) === '1' ? true : false,
				'closeModelOnOutsideClicked' => addonify_quick_view_get_option( 'close_modal_when_clicked_outside' ) === '1' ? true : false,
				'enableWcGalleryLightBox'    => (int) addonify_quick_view_get_option( 'enable_lightbox' ) === 1 ? true : false,
				'nonce'                      => wp_create_nonce( 'addonify_quick_view_nonce' ),
			)
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

				if ( (int) addonify_quick_view_get_option( 'enable_lightbox' ) === 1 ) {

					$script_dependency[] = 'photoswipe-ui-default';

					// This action is required for photoswipe to work.
					add_action( 'wp_footer', 'woocommerce_photoswipe', 15 );
				}
			}

			$script_dependency[] = 'wc-single-product';
		}

		wp_enqueue_script(
			'addonify-quick-view-public',
			plugin_dir_url( __FILE__ ) . 'assets/build/public.min.js',
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

		if ( (int) addonify_quick_view_get_option( 'disable_quick_view_on_mobile_device' ) === 1 ) {
			$classes[] = 'addonify-quick-view-disabled-on-mobile';
		}

		return $classes;
	}

	/**
	 * Renders quick view button.
	 *
	 * @since 1.2.8
	 */
	public function render_addonify_quick_view_button() {

		global $product;

		if (
			$product instanceof WC_Product &&
			apply_filters( 'addonify_quick_view_render_button', true, $product ) &&
			(
				! empty( $this->quick_view_button_label ) ||
				'1' === $this->display_quick_view_button_icon
			)
		) {

			$button_icon        = '';
			$icon_position      = '';
			$button_css_classes = array( 'button', 'addonify-qvm-button' );

			if (
				'1' === $this->display_quick_view_button_icon &&
				$this->quick_view_button_icon_position
			) {

				$button_icon = addonify_quick_view_get_button_icons( $this->quick_view_button_icon );

				$icon_position = ( 'before_label' === $this->quick_view_button_icon_position ) ? 'left' : 'right';
			}

			$button_args = array(
				'product_id'    => $product->get_id(),
				'label'         => $this->quick_view_button_label,
				'classes'       => apply_filters( 'addonify_quick_view_button_css_classes', $button_css_classes ),
				'icon'          => $button_icon,
				'icon_position' => $icon_position,
			);

			do_action( 'addonify_quick_view_button', $button_args );
		}
	}

	/**
	 * Callback function for add_shortcode function to render quick view button via shortcode.
	 *
	 * @since 1.2.17
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public function quick_view_button_shortcode_callback( $atts ) {

		$shortcode_atts = shortcode_atts(
			array(
				'id'            => 0,
				'label'         => '',
				'classes'       => '',
				'icon'          => '',
				'icon_position' => 'right',
			),
			$atts,
			'addonify_quick_view_button'
		);

		$product_id = (int) $shortcode_atts['id'];

		if ( ! $product_id ) {

			global $product;

			if ( $product && $product instanceof WC_Product ) {
				$product_id = $product->get_id();
			}
		}

		if ( ! $product_id > 0 ) {
			return '';
		}

		$product = wc_get_product( $product_id );

		if (
			apply_filters( 'addonify_quick_view_render_button', true, $product ) &&
			(
				! empty( $shortcode_atts['label'] ) ||
				! empty( $shortcode_atts['icon'] )
			)
		) {

			$icon          = false;
			$icon_position = false;

			if ( isset( $atts['icon'] ) && addonify_quick_view_get_button_icons( $atts['icon'] ) ) {
				$icon = addonify_quick_view_get_button_icons( $atts['icon'] );
			}

			if ( $icon && isset( $atts['icon_position'] ) ) {
				$icon_position = in_array( $atts['icon_position'], array( 'left', 'right' ), true ) ? $atts['icon_position'] : 'right';
			}

			$classes = array(
				'button',
				'addonify-qvm-button',
				'addonify-qv-shortcode-button',
				$shortcode_atts['classes'],
			);

			return apply_filters(
				'addonify_quick_view_shortcode_button_html',
				sprintf(
					'<button type="button" class="%s" data-product_id="%s" %s><span class="label">%s</span>%s</button>',
					esc_attr( implode( ' ', $classes ) ),
					esc_attr( $product_id ),
					( $icon_position ) ? 'data-icon_position="' . esc_attr( $icon_position ) . '"' : '',
					esc_html( $shortcode_atts['label'] ),
					( $icon ) ? '<span class="icon">' . addonify_quick_view_escape_svg( $icon ) . '</span>' : ''
				)
			);
		}
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

		$product_id = isset( $_GET['productId'] ) ? (int) wp_unslash( $_GET['productId'] ) : ''; // phpcs:ignore

		if ( ! $product_id ) {
			wp_send_json(
				array(
					'success' => false,
					'message' => esc_html__( 'Missing product id.', 'addonify-quick-view' ),
				)
			);
		}

		// generate contents dynamically.
		addonify_quick_view_generate_quick_view_content();

		$query_product = new WP_Query(
			array(
				'p'         => $product_id,
				'post_type' => 'product',
			)
		);

		if ( $query_product->have_posts() ) {

			$call_response = array(
				'success' => true,
				'data'    => array(),
			);

			ob_start();

			while ( $query_product->have_posts() ) {

				$query_product->the_post();

				global $product;

				do_action( 'addonify_quick_view_content', array( 'product' => $product ) );
			}

			$call_response['data']['#adfy-quick-view-modal-content'] = ob_get_clean(); //phpcs:ignore

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
	 * Print dynamic CSS generated from settings page.
	 */
	public function dynamic_css() {

		$css_values = array(
			'button_text'                                 => addonify_quick_view_get_option( 'quick_view_button_text_color' ),
			'button_text_hover'                           => addonify_quick_view_get_option( 'quick_view_button_text_color_hover' ),
			'button_background'                           => addonify_quick_view_get_option( 'quick_view_button_bg_color' ),
			'button_background_hover'                     => addonify_quick_view_get_option( 'quick_view_button_bg_color_hover' ),
			'button_border_color'                         => addonify_quick_view_get_option( 'quick_view_button_border_color' ),
			'button_border_color_hover'                   => addonify_quick_view_get_option( 'quick_view_button_border_color_hover' ),
			'button_border_style'                         => addonify_quick_view_get_option( 'quick_view_button_border_style' ),
			'button_border_radius'                        => addonify_quick_view_get_option( 'quick_view_button_border_radius' ) . 'px',
			'button_border_width'                         => addonify_quick_view_get_option( 'quick_view_button_border_width' ) . 'px',
			'modal_zindex'                                => addonify_quick_view_get_option( 'modal_zindex' ),
			'modal_border_radius'                         => addonify_quick_view_get_option( 'modal_border_radius' ) . 'px',
			'modal_image_border_radius'                   => addonify_quick_view_get_option( 'modal_image_radius' ) . 'px',
			'modal_content_column_gap'                    => addonify_quick_view_get_option( 'modal_content_column_gap' ) . 'px',
			'modal_general_text_font_size'                => addonify_quick_view_get_option( 'modal_general_text_font_size' ) . 'px',
			'product_title_font_size'                     => addonify_quick_view_get_option( 'modal_product_title_font_size' ) . 'px',
			'product_title_font_weight'                   => addonify_quick_view_get_option( 'modal_product_title_font_weight' ),
			'product_title_line_height'                   => addonify_quick_view_get_option( 'modal_product_title_line_height' ),
			'product_price_font_size'                     => addonify_quick_view_get_option( 'modal_product_price_font_size' ) . 'px',
			'product_price_font_weight'                   => addonify_quick_view_get_option( 'modal_product_price_font_weight' ),
			'product_onsale_badge_font_size'              => addonify_quick_view_get_option( 'modal_on_sale_badge_font_size' ) . 'px',
			'gallery_trigger_icon_size'                   => addonify_quick_view_get_option( 'wc_gallery_trigger_icon_size' ) . 'px',
			'gallery_trigger_icon_border_radius'          => addonify_quick_view_get_option( 'wc_gallery_trigger_icon_border_radius' ) . 'px',
			'spinner_icon_size'                           => addonify_quick_view_get_option( 'spinner_size' ) . 'px',
			'modal_overlay_background'                    => addonify_quick_view_get_option( 'modal_box_overlay_background_color' ),
			'modal_background'                            => addonify_quick_view_get_option( 'modal_box_background_color' ),
			'modal_general_text_color'                    => addonify_quick_view_get_option( 'modal_box_general_text_color' ),
			'modal_general_border_color'                  => addonify_quick_view_get_option( 'modal_box_general_border_color' ),
			'modal_inputs_background_color'               => addonify_quick_view_get_option( 'modal_box_inputs_background_color' ),
			'modal_inputs_text_color'                     => addonify_quick_view_get_option( 'modal_box_inputs_text_color' ),
			'modal_spinner_icon_color'                    => addonify_quick_view_get_option( 'modal_box_spinner_icon_color' ),
			'product_title'                               => addonify_quick_view_get_option( 'product_title_color' ),
			'product_excerpt'                             => addonify_quick_view_get_option( 'product_excerpt_text_color' ),
			'product_rating_filled'                       => addonify_quick_view_get_option( 'product_rating_star_filled_color' ),
			'product_rating_empty'                        => addonify_quick_view_get_option( 'product_rating_star_empty_color' ),
			'product_price'                               => addonify_quick_view_get_option( 'product_price_color' ),
			'product_price_sale'                          => addonify_quick_view_get_option( 'product_on_sale_price_color' ),
			'product_meta'                                => addonify_quick_view_get_option( 'product_meta_text_color' ),
			'product_meta_hover'                          => addonify_quick_view_get_option( 'product_meta_text_hover_color' ),
			// WC Gallery Trigger button.
			'gallery_trigger_icon_color'                  => addonify_quick_view_get_option( 'wc_gallery_trigger_icon_color' ),
			'gallery_trigger_icon_color_hover'            => addonify_quick_view_get_option( 'wc_gallery_trigger_icon_hover_color' ),
			'gallery_trigger_icon_background_color'       => addonify_quick_view_get_option( 'wc_gallery_trigger_icon_bg_color' ),
			'gallery_trigger_icon_background_color_hover' => addonify_quick_view_get_option( 'wc_gallery_trigger_icon_bg_hover_color' ),
			'modal_images_border_color'                   => addonify_quick_view_get_option( 'wc_gallery_image_border_color' ),
			'modal_gallery_thumb_in_row'                  => addonify_quick_view_get_option( 'modal_gallery_thumbs_columns' ),
			'modal_gallery_thumbs_gap'                    => addonify_quick_view_get_option( 'modal_gallery_thumbs_columns_gap' ) . 'px',
			// Close button.
			'close_button_text'                           => addonify_quick_view_get_option( 'modal_close_button_text_color' ),
			'close_button_text_hover'                     => addonify_quick_view_get_option( 'modal_close_button_text_hover_color' ),
			'close_button_background'                     => addonify_quick_view_get_option( 'modal_close_button_background_color' ),
			'close_button_background_hover'               => addonify_quick_view_get_option( 'modal_close_button_background_hover_color' ),
			'mobile_close_button_font_size'               => addonify_quick_view_get_option( 'mobile_close_button_font_size' ) . 'px',
			// Misc buttons.
			'misc_button_font_size'                       => addonify_quick_view_get_option( 'modal_misc_buttons_font_size' ) . 'px',
			'misc_button_letter_spacing'                  => addonify_quick_view_get_option( 'modal_misc_buttons_letter_spacing' ) . 'px',
			'misc_button_line_height'                     => addonify_quick_view_get_option( 'modal_misc_buttons_line_height' ),
			'misc_button_font_weight'                     => addonify_quick_view_get_option( 'modal_misc_buttons_font_weight' ),
			'misc_button_text_transform'                  => addonify_quick_view_get_option( 'modal_misc_buttons_text_transform' ),
			'misc_button_height'                          => addonify_quick_view_get_option( 'modal_misc_buttons_height' ) . 'px',
			'misc_button_border_radius'                   => addonify_quick_view_get_option( 'modal_misc_buttons_border_radius' ) . 'px',
			'misc_button_text'                            => addonify_quick_view_get_option( 'modal_misc_buttons_text_color' ),
			'misc_button_text_hover'                      => addonify_quick_view_get_option( 'modal_misc_buttons_text_hover_color' ),
			'misc_button_background'                      => addonify_quick_view_get_option( 'modal_misc_buttons_background_color' ),
			'misc_button_background_hover'                => addonify_quick_view_get_option( 'modal_misc_buttons_background_hover_color' ),
		);

		$css_values = apply_filters( 'addonify_quick_view_dynamic_css_values', $css_values );

		$css = ':root {';

		foreach ( $css_values as $key => $value ) {
			if ( $value ) {
				$css .= '--addonify_qv_' . $key . ': ' . $value . ';';
			}
		}

		$css .= '}';

		return $css;
	}
}
