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


	// constructor function
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;

		$this->version = $version;
	}


	public function actions_init() {

		if ( 
			! class_exists( 'WooCommerce' ) ||
			(int) addonify_quick_view_get_settings_fields_values( 'enable_quick_view' ) !== 1
		) {
			return;
		}

		// Enqueue styles and scripts used in front-end.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// add "Quick View" button after add to cart button
		if ( addonify_quick_view_get_settings_fields_values( 'quick_view_btn_position' ) == 'before_add_to_cart_button' ) {
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'quick_view_button_render_callback' ), 5 );
		}
		
		if ( addonify_quick_view_get_settings_fields_values( 'quick_view_btn_position' ) == 'after_add_to_cart_button' ) {
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'quick_view_button_render_callback' ), 15 );
		}


		// add custom markup into footer
		add_action( 'wp_footer', array( $this, 'add_markup_into_footer_callback' ) );


		// ajax callback
		add_action( 'wp_ajax_get_quick_view_contents', array( $this, 'quick_view_contents_callback' ) );
		add_action( 'wp_ajax_nopriv_get_quick_view_contents', array( $this, 'quick_view_contents_callback' ) );



		// show  or hide view details button
		if ( (int) addonify_quick_view_get_settings_fields_values( 'display_read_more_button' ) === 1 ) {

			add_action( 'addonify_qv_after_product_summary_content', array( $this, 'render_read_more_button' ) );
		}
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'perfect-scrollbar', plugin_dir_url( __FILE__ ) . 'assets/build/css/conditional/perfect-scrollbar.css', array(), $this->version );

		$style_dependency = array();

		if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {

			// these features are supported from woocommerce 3.0.0

			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {

				if ( (int) addonify_quick_view_get_settings_fields_values( 'enable_lightbox' ) === 1 ) {
					$style_dependency[] = 'photoswipe-default-skin';
				}
			}

		}

		if ( is_rtl() ){
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/css/addonify-quick-view-rtl.css', $style_dependency, $this->version, 'all' );
		} 
		else{

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/css/addonify-quick-view.css', $style_dependency, $this->version, 'all' );
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


	// enqueue scripts
	public function enqueue_scripts() {

		wp_enqueue_script( 'perfect-scrollbar', plugin_dir_url( __FILE__ ) . 'assets/build/js/conditional/perfect-scrollbar.min.js', null, $this->version, true );

		$script_dependency = array('jquery', 'wc-add-to-cart-variation', 'flexslider');

		if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {

			// these features are supported from woocommerce 3.0.0

			if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {

				$script_dependency[] = 'zoom';
			}

			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {

				if ( (int) addonify_quick_view_get_settings_fields_values( 'enable_lightbox' ) === 1 ) {

					$script_dependency[] = 'photoswipe-ui-default';

					// this action is required for photoswipe to work
					add_action( 'wp_footer', 'woocommerce_photoswipe', 15 );
				}
			}

			$script_dependency[] = 'wc-single-product';
		}

		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );

		wp_enqueue_script( 'addonify-quick-view-public', plugin_dir_url( __FILE__ ) . 'assets/build/js/addonify-quick-view.min.js', $script_dependency, $this->version, true );

		// localize ajax script

		wp_localize_script(
			'addonify-quick-view-public',
			'ajax_object',
			array(
				'ajax_url' 	=> esc_url( admin_url( 'admin-ajax.php' ) ),
				'action' 	=> 'get_quick_view_contents',
				'nonce' 	=> wp_create_nonce( 'addonify_quick_view_nonce' )
			)
		);
	}

	// callback function
	// ajax request
	// get contents for quick view
	public function quick_view_contents_callback() {

		// deny any non ajax requests
		if( ! wp_doing_ajax() ) wp_die('Invalid Requests');

		// product id is required
		if( ! isset( $_GET['id'] ) || ! is_numeric( $_GET['id'] ) ) wp_die( 'product id is missing' );

		$product_id = intval( $_GET['id'] );

		// generate contents dynamically
		$this->generate_contents();

		$query_product = new WP_Query( array( 
			'p' => $product_id,
			'post_type' => 'product',
		 ) );

		ob_start();

		while ( $query_product->have_posts() ) {

			$query_product->the_post();
			$this->get_templates( 'addonify-quick-view-content' );
		}

		echo ob_get_clean();

		wp_die();

	}


	public function quick_view_button_render_callback() {

		global $product;

		// show compare btn after add to cart button
		if ( addonify_quick_view_get_settings_fields_values( 'quick_view_btn_label' ) ) {

			ob_start();

			$this->get_templates( 
				'addonify-quick-view-button', 
				false, 
				array( 
					'product_id' => $product->get_id(), 
					'label' => addonify_quick_view_get_settings_fields_values( 'quick_view_btn_label' ), 
					'css_class' => ''
				) 
			);

			echo ob_get_clean();
		}
	}


	// callback function
	// add custom markup into footer
	public function add_markup_into_footer_callback(){

		ob_start();
		$this->get_templates( 'addonify-quick-view-content-wrapper' );
		echo ob_get_clean();
	}


	// generate contents dynamically to modal templates with hooks
	// called by get_quick_view_contents()
	public function generate_contents() {

		$modal_box_content = unserialize( addonify_quick_view_get_settings_fields_values( 'modal_box_content' ) );

		if ( 
			! is_array( $modal_box_content ) || 
			empty( $modal_box_content ) 
		) {

			return;
		}

		// Show Hide Image according to user choices
		if ( in_array( 'image', $modal_box_content ) ) {

			// show or hide gallery thumbnails according to user choice
			if ( addonify_quick_view_get_settings_fields_values( 'product_thumbnail' ) == "product_image_only" ) {

				$this->disable_gallery_thumbnails();
			}

			// show images
			add_action( 'addonify_qv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'addonify_qv_product_image', 'woocommerce_show_product_images', 20 );

		}

		// show or hide title
		if ( in_array( 'title', $modal_box_content ) ) {
			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_title', 5 );
		}

		// show or hide product ratings
		if ( in_array( 'rating', $modal_box_content ) ) {

			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_rating', 10 );
		}

		// show or hide price
		if ( in_array( 'price', $modal_box_content ) ) {

			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_price', 15 );
		}

		// show or hide excerpt
		if ( in_array( 'excerpt', $modal_box_content ) ) {

			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_excerpt', 20 );
		}

		// show or hide add to cart button
		if ( in_array( 'add_to_cart', $modal_box_content ) ) {

			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
		}

		// show or hide product meta
		if ( in_array( 'meta', $modal_box_content ) ) {

			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_meta', 30 );
		}

		
	}

	// callback function
	// view details button markups
	public function render_read_more_button( $product_id ) {

		$btn_label = addonify_quick_view_get_settings_fields_values( 'read_more_button_label' );

		ob_start();

		$this->get_templates( 'addonify-view-detail-button', true, array( 'post_id' => $product_id, 'btn_label' => $btn_label ) );

		echo ob_get_clean();
	}


	// this will hide thumbnails in woocommerce gallery
	public function disable_gallery_thumbnails() {

		// hide thumbnails from gallery in modal		
		remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
	}

	public function dynamic_css() {

		$css_values = array(
			'--addonify_qv_modal_overlay_background' => addonify_quick_view_get_settings_fields_values( 'modal_box_overlay_background_color' ),
			'--addonify_qv_modal_background' => addonify_quick_view_get_settings_fields_values( 'modal_box_background_color' ),
			'--addonify_qv_product_title' => addonify_quick_view_get_settings_fields_values( 'product_title_color' ),
			'--addonify_qv_product_excerpt' => addonify_quick_view_get_settings_fields_values( 'product_excerpt_text_color' ),
			'--addonify_qv_product_rating_filled' => addonify_quick_view_get_settings_fields_values( 'product_rating_star_filled_color' ),
			'--addonify_qv_product_rating_empty' => addonify_quick_view_get_settings_fields_values( 'product_rating_star_empty_color' ),
			'--addonify_qv_product_price' => addonify_quick_view_get_settings_fields_values( 'product_price_color' ),
			'--addonify_qv_product_price_sale' => addonify_quick_view_get_settings_fields_values( 'product_on_sale_price_color' ),
			'--addonify_qv_product_meta' => addonify_quick_view_get_settings_fields_values( 'product_meta_text_color' ),
			'--addonify_qv_product_meta_hover' => addonify_quick_view_get_settings_fields_values( 'product_meta_text_hover_color' ),
			'--addonify_qv_close_button_text' => addonify_quick_view_get_settings_fields_values( 'modal_close_button_text_color' ),
			'--addonify_qv_close_button_text_hover' => addonify_quick_view_get_settings_fields_values( 'modal_close_button_text_hover_color' ),
			'--addonify_qv_close_button_background' => addonify_quick_view_get_settings_fields_values( 'modal_close_button_background_color' ),
			'--addonify_qv_close_button_background_hover' => addonify_quick_view_get_settings_fields_values( 'modal_close_button_background_hover_color' ),
			'--addonify_qv_misc_button_text' => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_text_color' ),
			'--addonify_qv_misc_button_text_hover' => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_text_hover_color' ),
			'--addonify_qv_misc_button_background' => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_background_color' ),
			'--addonify_qv_misc_button_background_hover' => addonify_quick_view_get_settings_fields_values( 'modal_misc_buttons_background_hover_color' )
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


	public function minify_css( $css ) {

		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		return trim( $css );
	}


	// require proper templates for use in front end
	public function get_templates( $template_name, $require_once = true, $args=array() ){

		// first look for template in themes/addonify/templates
		$theme_path = get_template_directory() . '/addonify/' . $template_name .'.php';
		$plugin_path = dirname( __FILE__ ) .'/templates/' . $template_name .'.php';

		if( file_exists( $theme_path ) ){
			$template_path = $theme_path;
		}
		else{
			$template_path = $plugin_path;
		}

		if( $require_once ){
			require_once $template_path;
		}
		else{
			require $template_path;
		}
	}

}
