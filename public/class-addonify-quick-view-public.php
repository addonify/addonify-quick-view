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
	 * Contains all the db fields used by this plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $all_db_fields;


	// constructor function	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// modify woocommerce shop loop
		// if quick view btn is selected to display in overlay of image
		$this->modify_woocommerce_shop_loop();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		$style_dependency = array();

		if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {
			
			// these features are supported from woocommerce 3.0.0

			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {

				if( (int) $this->get_db_values( 'enable_lightbox', 1 ) ) {
					$style_dependency[] = 'photoswipe-default-skin';
				}
			}

		}

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/css/addonify-quick-view-public.css', $style_dependency, $this->version, 'all' );

	}

	
	// enqueue scripts
	public function enqueue_scripts() {

		$script_dependency = array('jquery', 'wc-add-to-cart-variation', 'flexslider');
		
		if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {
			
			// these features are supported from woocommerce 3.0.0

			if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
				$script_dependency[] = 'zoom';
			}

			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {

				if( (int) $this->get_db_values( 'enable_lightbox', 1 ) ) {
					$script_dependency[] = 'photoswipe-ui-default';
					
					// this action is required for photoswipe to work
					add_action( 'wp_footer', 'woocommerce_photoswipe', 15 );
				}
			}

			$script_dependency[] = 'wc-single-product';
		}

		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );


		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/js/addonify-quick-view-public.min.js', array( 'jquery' ), $this->version, false );

		// for ajax
		wp_enqueue_script( 'addonify_qv_ajax_scripts', plugin_dir_url( __FILE__ ) . 'ajax-scripts.js', $script_dependency, '', true );

		// localize ajax script
		wp_localize_script( 
			'addonify_qv_ajax_scripts', 
			'ajax_object', 
			array( 
				'ajax_url' 	=> admin_url( 'admin-ajax.php' ), 
				'action' 	=> 'get_quick_view_contents'
			) 
		);

	}

	// callback function
	// get contents for quick view
	public function quick_view_contents_callback(){

		// product id is required
		if( ! isset( $_GET['id'] ) || ! is_numeric( $_GET['id'] ) ) wp_die( 'product id is missing' );

		$product_id = intval( $_GET['id'] );
		
		// generate contents dynamically
		$this->generate_contents();


		// Set the main wp query for the product.
		wp( 'p=' . $product_id . '&post_type=product' );

		ob_start();
		while ( have_posts() ) {
			the_post();
			$this->get_templates( 'addonify-quick-view-content' );
		}

		echo ob_get_clean();

		wp_die();

	}

	

	// callback function
	// add custom "Quick View" button in woocommerce loop
	function show_quick_view_btn_aside_add_to_cart_btn_callback($button, $product, $args) {

		$show_quick_btn = (int) $this->get_db_values('enable_quick_view', 1);
		$quick_view_btn_position = $this->get_db_values('quick_view_btn_position', 'after_add_to_cart' );
		$quick_view_btn_label = $this->get_db_values( 'quick_view_btn_label' );
		$product_id = $product->get_id();

		// show quick view btn before add to cart button
		if( $quick_view_btn_position == 'before_add_to_cart' ) {
			if( $show_quick_btn && $quick_view_btn_label ) {
				
				ob_start();
				$this->get_templates( 'addonify-quick-view-button', false, array( 'product_id' => $product_id, 'label' => $quick_view_btn_label) );
				echo ob_get_clean();
			}

		}

		// print default add to cart button by woocommerce
		echo $button;

		// show quick view btn after add to cart button
		if( $quick_view_btn_position == 'after_add_to_cart' ) {
			if( $show_quick_btn && $quick_view_btn_label ) {
				
				ob_start();
				$this->get_templates( 'addonify-quick-view-button', false, array( 'product_id' => $product_id, 'label' => $quick_view_btn_label ) );
				echo ob_get_clean();
			}
		}

	}

	
	// callback function
	// show quick view button aside image
	public function show_quick_view_btn_aside_image_callback(){

		global $product;
		$product_id = $product->get_id();

		$show_quick_btn = (int) $this->get_db_values( 'enable_quick_view', 1 );
		$quick_view_btn_position = $this->get_db_values( 'quick_view_btn_position', 'after_add_to_cart' );
		$quick_view_btn_label = $this->get_db_values( 'quick_view_btn_label' );

		if( $show_quick_btn && $quick_view_btn_position == 'overlay_on_image' ) {
			ob_start();
			$this->get_templates( 'addonify-quick-view-button', false, array( 'product_id' => $product_id, 'label' => $quick_view_btn_label) );
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
	
	
	// callback function
	// generate style tag according to options selected by user
	public function generate_custom_styles_callback(){

		$load_styles_from_plugin = $this->get_db_values( 'load_styles_from_plugin', 1 );

		// do not continue if plugin styles are disabled by user
		if( ! $load_styles_from_plugin ) return;

		$custom_css = $this->get_db_values('custom_css');
		$custom_styles_output = '';

		$style_args = array(
			'.adfy-quick-view-overlay' => array(
				'background' 	=> 'modal_overlay_bck_color'
			),
			'.adfy-quick-view-modal-content' => array(
				'background' 	=> 'modal_bck_color',
			),
			'.adfy-quick-view-modal-content .entry-title' => array(
				'color'		 	=> 'title_color',
			),
			'.star-rating::before' => array(
				'color'		 	=> 'rating_color_empty',
			),
			'.star-rating span::before' => array(
				'color'		 	=> 'rating_color_full',
			),
			'.adfy-quick-view-modal-content .price' => array(
				'color' 		=> 'price_color_regular',
			),
			'.adfy-quick-view-modal-content .price.del' => array(
				'background' 	=> 'price_color_sale',
			),
			'.adfy-quick-view-modal-content .woocommerce-product-details__short-description' => array(
				'color' 		=> 'excerpt_color',
			),
			'.adfy-quick-view-modal-content .product_meta' => array(
				'color' 		=> 'meta_color',
			),
			'.adfy-quick-view-modal-content .product_meta a:hover' => array(
				'color' 		=> 'meta_color_hover',
			),
			'#addonify-qvm-close-button svg' => array(
				'color' 		=> 'close_btn_text_color',
			),
			'#addonify-qvm-close-button' => array(
				'background'	=> 'close_btn_bck_color',
			),
			'#addonify-qvm-close-button:hover svg' => array(
				'color'		 	=> 'close_btn_text_color_hover',
			),
			'#addonify-qvm-close-button:hover' => array(
				'background' 	=> 'close_btn_bck_color_hover',
			),
			'.adfy-quick-view-modal-content button, .adfy-quick-view-modal-content .button' => array(
				'background' 	=> 'other_btn_bck_color',
				'color' 		=> 'other_btn_text_color',
			),
			'.adfy-quick-view-modal-content button:hover, .adfy-quick-view-modal-content .button:hover' => array(
				'background' 	=> 'other_btn_bck_color_hover',
				'color'		 	=> 'other_btn_text_color_hover',
			),
		);

		foreach($style_args as $css_sel => $property_value){

			$properties = '';

			foreach( $property_value as $property => $db_field){
				$db_value = $this->get_db_values( $db_field );

				if( $db_value ){
					$properties .=  $property . ': ' . $db_value .'; ';
				}
			}
			
			if( $properties ){
				$custom_styles_output .= $css_sel . '{' . $properties .'}';
			}

		}

		// avoid empty style tags
		if( $custom_styles_output || $custom_css ){
			echo "<style id=\"addonify-quick-view-styles\"  media=\"screen\"> \n" . $custom_styles_output .  $custom_css . "\n </style>\n";
		}

	}


	// helper function
	// get db values for selected fields
	private function get_db_values($field_name, $default = NULL ){
		return get_option( ADDONIFY_DB_INITIALS . $field_name, $default );
	}


	// generate contents dynamically to modal templates with hooks
	// called by get_quick_view_contents()
	private function generate_contents() {
		
		// Show Hide Image according to user choices 
		if( (int) $this->get_db_values( 'show_product_image' ) ) {

			// show or hide gallery thumbnails according to user choice
			if( $this->get_db_values( 'product_image_display_type' ) == 'image_only' ) {
				$this->disable_gallery_thumbnails();
			}
			
			// show images
			add_action( 'addonify_qv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'addonify_qv_product_image', 'woocommerce_show_product_images', 20 );
			
		}

		// show or hide title
		if( (int) $this->get_db_values( 'show_product_title' ) ) {
			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_title', 5 );
		}

		// show or hide product ratings
		if( (int) $this->get_db_values( 'show_product_rating' ) ) {
			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_rating', 10 );
		}

		// show or hide price
		if( (int) $this->get_db_values( 'show_product_price' ) ) {
			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_price', 15 );
		}

		// show or hide excerpt
		if( (int) $this->get_db_values( 'show_product_excerpt' ) ) {
			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_excerpt', 20 );
		}

		// show or hide add to cart button
		if( (int) $this->get_db_values( 'show_add_to_cart_btn' ) ) {
			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
		}

		// show or hide product meta
		if( (int) $this->get_db_values( 'show_product_meta' ) ) {
			add_action( 'addonify_qv_product_summary', 'woocommerce_template_single_meta', 30 );
		}

		// show  or hide view details button
		if( (int) $this->get_db_values( 'show_view_detail_btn' ) && $this->get_db_values( 'view_detail_btn_label' ) ) {
			add_action( 'addonify_qv_after_product_summary_content', array($this, 'view_details_btn_callback') );
		}

	}

	// callback function
	// view details button markups
	public function view_details_btn_callback( $post_id ){

		$btn_label = $this->get_db_values( 'view_detail_btn_label', __( 'View Detail', 'addonify-quick-views' ));

		if( ! $btn_label ) return;
		
		ob_start();
		$this->get_templates( 'addonify-view-details-button', true, array( 'post_id' => $post_id, 'btn_label' => $btn_label ) );
		echo ob_get_clean();
	}


	// this will hide thumbnails in woocommerce gallery
	private function disable_gallery_thumbnails(){
		// hide thumbnails from gallery in modal
		add_action( 'woocommerce_product_thumbnails', 'remove_hooks' );
		function remove_hooks(){
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
		}

	}

	// modify woocommerce_before_shop_loop_item
	// wrap loop in custom container
	// works only if quick_view_btn_position == overlay_on_image
	private function modify_woocommerce_shop_loop(){

		if( $this->get_db_values( 'quick_view_btn_position' ) == 'overlay_on_image' ){

			add_action ( 'woocommerce_before_shop_loop_item' ,  function (){
				echo '<div class="addonify-qvm-overlay-button">';
			});
			
			add_action ( 'woocommerce_after_shop_loop_item' ,  function (){
				echo '</div>';
			});

		}
	}


	private function get_templates( $template_name, $require_once = true, $args=array() ){

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