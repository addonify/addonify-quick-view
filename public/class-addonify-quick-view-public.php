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

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/css/addonify-quick-view-public.css', array(), $this->version, 'all' );

	}

	// enqueue scripts
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/js/addonify-quick-view-public.min.js', array( 'jquery' ), $this->version, false );

		// for ajax
		wp_enqueue_script( 'custom-scripts', plugin_dir_url( __FILE__ ) . 'ajax-scripts.js', array( 'jquery', 'zoom', 'flexslider', 'photoswipe-ui-default', 'wc-single-product' ), '', true );

		// localize ajax script
		wp_localize_script( 
			'custom-scripts', 
			'ajax_object', 
			array( 
				'ajax_url' 	=> admin_url( 'admin-ajax.php' ), 
				'action' 	=> 'get_quick_view_contents'
			) 
		);

	}

	public function get_quick_view_contents(){
		// product id is reqiored
		if( !isset($_GET['id']) ) die( 'product id is missing' );

		$product_id = $_GET['id'];
		echo do_shortcode('[product_page id="'. $product_id .'"]');

		// require content templates
		// require_once dirname( __FILE__ ) .'/partials/content-single-product.php';
		
		// end with die()
		die;
	}

	

	// add custom "Quick View" button in woocommerce loop
	function show_quick_view_btn_aside_add_to_cart_btn($button, $product, $args) {

		$show_quick_btn = $this->get_db_values('quick_view_btn_label', 1);
		$quick_view_btn_position = $this->get_db_values('quick_view_btn_position', 'after_add_to_cart' );

		if( $quick_view_btn_position == 'before_add_to_cart' ) {
			$this->show_quick_view_btn($show_quick_btn, $product->get_id() );
		}

		printf(
			'<a href="%s" data-quantity="%s" class="%s" %s >%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() ),
		);

		if( $quick_view_btn_position == 'after_add_to_cart' ) {
			$this->show_quick_view_btn($show_quick_btn, $product->get_id() );
		}

	}


	public function show_quick_view_btn_in_image(){
		global $product;

		$show_quick_btn = $this->get_db_values('quick_view_btn_label', 1);
		$quick_view_btn_position = $this->get_db_values('quick_view_btn_position', 'after_add_to_cart' );

		if( $show_quick_btn && $quick_view_btn_position == 'overlay_on_image' ) {
			printf(
				'<div class="addonify-qv-label addonify-qvm-button" data-product_id="%s" ><span class="button ">%s</span></div>',
				$product->get_id(),
				$this->get_db_values('quick_view_btn_label', __( 'Quick View', 'addonify-quick-view' ) )
			);
		}

	}



	private function show_quick_view_btn( $show_quick_btn, $product_id ){
		if( $show_quick_btn  ) {
			printf(
				'<a href="%s" class="%s" data-product_id="%s" rel="nofollow" >%s</a>',
				'#',
				'addonify-qvm-button button',
				esc_attr( $product_id ),
				$this->get_db_values('quick_view_btn_label', __( 'Quick View', 'addonify-quick-view' )  )
			);
		}
	}


	// add custom markup into footer
	function add_markup_into_footer(){
?>
		<div id="addonify-quick-view-modal">
			<div class="adfy-quick-view-model-inner">
				<div class="adfy-qvm-head">
					<button id="addonify-qvm-close-button" class="adfy-qv-button">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<line x1="18" y1="6" x2="6" y2="18"></line>
							<line x1="6" y1="6" x2="18" y2="18"></line>
						</svg>
					</button>
				</div><!-- // adfy-qvm-head -->
				<div class="adfy-quick-view-modal-content">
				</div><!-- // adfy-quick-view-modal-content -->
			</div><!-- // adfy-quick-view-model-inner -->
		</div><!-- // addonify-quick-view-modal -->
		<div class="adfy-quick-view-overlay"></div>
<?php
	}
	

	// private function get_all_db_fields(){
		
	// 	$this->all_db_fields = array(
	// 		// general
	// 		'enable_quick_view' 		=> $this->get_db_values( 'enable_quick_view' ), 
	// 		'quick_view_btn_position'	=> $this->get_db_values( 'quick_view_btn_position' ),
	// 		'quick_view_btn_label'		=> $this->get_db_values( 'quick_view_btn_label' ),

	// 		// content options
	// 		'show_product_image'		=> $this->get_db_values( 'show_product_image' ),
	// 		'show_product_title'		=> $this->get_db_values( 'show_product_title' ),
	// 		'show_product_rating'		=> $this->get_db_values( 'show_product_rating' ),
	// 		'show_product_price'		=> $this->get_db_values( 'show_product_price' ),
	// 		'show_product_excerpt'		=> $this->get_db_values( 'show_product_excerpt' ),
	// 		'show_add_to_cart_btn'		=> $this->get_db_values( 'show_add_to_cart_btn' ),
	// 		'show_product_meta'			=> $this->get_db_values( 'show_product_meta' ),
	// 		'product_image_display_type'=> $this->get_db_values( 'product_image_display_type' ),
	// 		'enable_lightbox'			=> $this->get_db_values( 'enable_lightbox' ),
	// 		'show_view_details_btn'		=> $this->get_db_values( 'show_view_detail_btn' ),
	// 		'view_details_btn_label'	=> $this->get_db_values( 'view_detail_btn_label' ),

	// 		// style options
	// 		'load_styles_from_plugin'	=> $this->get_db_values( 'load_styles_from_plugin' ),

	// 		// content colors
	// 		'modal_overlay_bck_color'	=> $this->get_db_values( 'modal_overlay_bck_color', '#000000' ),
	// 		'modal_bck_color'			=> $this->get_db_values( 'modal_bck_color', '#ffffff' ),
	// 		'title_color'				=> $this->get_db_values( 'product_title_color', '#000000' ),
	// 		'rating_empty_color'		=> $this->get_db_values( 'product_rating_empty_color', '#cccccc' ),
	// 		'rating_full_color'			=> $this->get_db_values( 'product_rating_full_color', '#000000' ),
	// 		'price_color_regular'		=> $this->get_db_values( 'product_regular_price_color', '#000000' ),
	// 		'price_color_sale'			=> $this->get_db_values( 'product_sale_price_color', '#000000' ),
	// 		'excerpt_color'				=> $this->get_db_values( 'excerpt_color', '#000000' ),
	// 		'meta_color'				=> $this->get_db_values( 'meta_color', '#000000' ),
	// 		'meta_color_hover'			=> $this->get_db_values( 'meta_color_hover', '#000000' ),
	// 		'close_btn_text_color'		=> $this->get_db_values( 'close_btn_text_color', '#000000' ),
	// 		'close_btn_bck_color'		=> $this->get_db_values( 'close_btn_bck_color', '#000000' ),
	// 		'close_btn_text_color_hover'=> $this->get_db_values( 'close_btn_text_color_hover', '#000000' ),
	// 		'close_btn_bck_color_hover'	=> $this->get_db_values( 'close_btn_bck_color_hover', '#000000' ),
	// 		'other_btn_text_color'		=> $this->get_db_values( 'other_btn_text_color', '#000000' ),
	// 		'other_btn_bck_color'		=> $this->get_db_values( 'other_btn_bck_color', '#000000' ),
	// 		'other_btn_text_color_hover'=> $this->get_db_values( 'other_btn_text_color_hover', '#000000' ),
	// 		'other_btn_bck_color_hover'	=> $this->get_db_values( 'other_btn_bck_color_hover', '#000000' ),
	// 		'custom_css'				=> $this->get_db_values( 'custom_css', '#000000' ),

	// 	);

	// }


	public function generate_custom_styles(){

		$load_styles_from_plugin = $this->get_db_values( 'load_styles_from_plugin', 1 );

		// do not continue if plugin styles are disabled by user
		if( ! $load_styles_from_plugin ) return;

		$custom_styles_output = '';

		$style_fields = array(
			'.adfy-quick-view-overlay' => array(
				'background' 	=> 'modal_overlay_bck_color'
			),
			'.adfy-quick-view-modal-content' => array(
				'background' 	=> 'modal_bck_color',
			),
			'.adfy-quick-view-modal-content .entry-title' => array(
				'color'		 	=> 'title_color',
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
			'.adfy-quick-view-modal-content button' => array(
				'background' 	=> 'other_btn_bck_color',
				'color' 		=> 'other_btn_text_color',
			),
			'.adfy-quick-view-modal-content button:hover' => array(
				'background' 	=> 'other_btn_bck_color_hover',
				'color'		 	=> 'other_btn_text_color_hover',
			),
			
		);


		foreach($style_fields as $css_sel => $property_value){

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


		if( $custom_styles_output ){
			echo "<style> \n" . $custom_styles_output . "\n </style>";
		}

	}


	// get db values for selected fields
	private function get_db_values($field_name, $default = NULL ){
		return get_option( ADDONIFY_DB_INITIALS . $field_name, $default );
	}

}