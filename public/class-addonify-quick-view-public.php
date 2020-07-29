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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Addonify_Quick_View_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Addonify_Quick_View_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/build/css/addonify-quick-view-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
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
				'id' 		=> 18,
				'action' 	=> 'get_quick_view_contents'
			) 
		);

	}

	public function get_quick_view_contents(){
		if( !isset($_GET['id']) ) die( 'product id is missing' );
?>
		<?php 

			// echo do_shortcode('[product_page id="18"]');

			// $product_id = $_GET['id'];
			// $query = new WP_Query( array( 'p' => $product_id, 'post_type' => 'product' ) );

			// if( $query->have_posts() ) {
			// 	while( $query->have_posts() ){
			// 		$query->the_post();
			// 		require_once dirname( __FILE__ ) .'/partials/content-single-product.php';
			// 	}
			// 	wp_reset_postdata();
			// }

		?>

<?php
		die;
	}

	

	// add custom "Quick View" button in woocommerce loop
	function show_custom_button_in_wc_loop($button, $product, $args) {

		printf(
			'<a href="%s" data-quantity="%s" class="%s" %s >%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() ),
		);

		printf(
			'<a href="%s" class="%s" data-product_id="%s" rel="nofollow" >%s</a>',
			'#',
			'addonify-qvm-button button',
			esc_attr( $product->get_id() ),
			__('Quick View', 'addonify-quick-view')
		);

	}


	// add custom markup into footer
	function add_markup_into_footer(){

		echo do_shortcode('[product_page id="18"]');

		
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
	

}