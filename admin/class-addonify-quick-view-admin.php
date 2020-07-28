<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://addonify.com
 * @since      1.0.0
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/admin
 * @author     Addonify <info@addonify.com>
 */
class Addonify_Quick_View_Admin {

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
	 * Default settings_page_slug
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $settings_page_slug = 'addonify_quick_view';

	/**
	 * Default Initials for input fields to be inserted in database
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $db_field_initials = 'addonify_qv_';


	/**  
	 * Store name of all the db_fields used by this plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $all_db_fields;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// store empty variables
		$this->all_db_fields = array();
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if( isset($_GET['page']) && $_GET['page'] == 'addonify_quick_view' ){

			// toggle switch
			wp_enqueue_style( 'lc_switch', plugin_dir_url( __FILE__ ) . 'css/lc_switch.css' );

			// built in wp color picker
			wp_enqueue_style( 'wp-color-picker' );

			// admin css
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/addonify-quick-view-admin.css', array(), $this->version, 'all' );

		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if( isset($_GET['page']) && $_GET['page'] == 'addonify_quick_view' ){
			
			// toggle switch
			wp_enqueue_script( 'lc_switch', plugin_dir_url( __FILE__ ) . 'js/lc_switch.min.js', array( 'jquery' ), '', false );

			// use built in wp color picker as dependency
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/addonify-quick-view-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );

		}

	}

	
	// check if woocommerce is active
	function is_woocommerce_active() {

		if ( class_exists( 'woocommerce' ) )  return true; 
		return false;

	}



	// admin menu
	public function add_menu(){

		// do not show menu if woocommerce is not active
		if ( ! $this->is_woocommerce_active() )  return; 

		add_menu_page( 'Addonify Quick View Settings', 'Addonify', 'manage_options', $this->settings_page_slug, array($this, 'quick_view_settings_page_ui'), 'dashicons-slides', 76 );
		
		// sub menu
		// redirects to main plugin link
		add_submenu_page(  $this->settings_page_slug, 'Addonify Quick View Settings', 'Quick View', 'manage_options', $this->settings_page_slug, array($this, 'quick_view_settings_page_ui') );

	}


	// add custom "settings" link in the plugins.php page
	public function custom_plugin_link( $links, $file ){
		
		if ( $file == plugin_basename(dirname(__FILE__, 2) . '/addonify-quick-view.php') ) {
			
			// add "Settings" link
			$links[] = '<a href="admin.php?page='. $this->settings_page_slug .'">' . __('Settings','addonify-quick-view') . '</a>';
			
    	}
		return $links;
	}

	
	public function quick_view_settings_page_ui(){
?>
		<div class="wrap">
            <h1>Quick View Options</h1>
			<!-- <p style="margin: 10px 0 35px">This is a sample settings page for this plugin</p> -->

			<div id="addonify-settings-wrapper">

				<form method="POST" action="options.php">
					<!-- generate nonce -->
					<?php settings_fields("quick_views"); ?>
					
					<ul id="addonify-settings-tabs">
						<li><a href="#addonify-settings-container" class="active">Settings</a></li>
						<li><a href="#addonify-styles-container">Styles</a></li>
					</ul>

					<div id="addonify-settings-container" class="addonify-content active">
						<!-- display form fields -->
						<?php do_settings_sections($this->settings_page_slug.'-settings'); ?>         
					</div><!--addonify-settings-container-->

					<div id="addonify-styles-container" class="addonify-content">
						<?php do_settings_sections($this->settings_page_slug.'-styles'); ?>       
					</div><!--addonify-styles-container-->
			
					<?php submit_button(); ?>

				</form>

			</div><!--addonify-settings-wrapper-->
		</div> <!--wrap-->

<?php
	}


	// show notification after form submission
	public function form_submission_notification(){
		settings_errors();
	}


	// generate settings page form elements
	public function settings_page_ui() {

		// ---------------------------------------------
		// General Options
		// ---------------------------------------------

		$settings_args = array(
			'settings_group_name'	=> 'quick_views',
			'section_id' 			=> 'general_options',
			'section_label'			=> __('GENERAL OPTIONS', 'addonify-quick-view' ),
			'section_callback'		=> '',
			'screen'				=> $this->settings_page_slug.'-settings',
			'fields'				=> array(
				array(
					'field_id'				=> $this->db_field_initials . 'enable_quick_view',
					'field_label'			=> __('Enable Quick View', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 
						array(
							'name' 			=> $this->db_field_initials . 'enable_quick_view', 
							'checked' 		=> 1
						)
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'quick_view_btn_position',
					'field_label'			=> __('Quick View Button Position', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "select"),
					'field_callback_args'	=> array( 
						array(
							'name' 				=> $this->db_field_initials . 'quick_view_btn_position', 
							'options' 			=> array(
								'before_add_to_cart' 	=> __('Before Add To Cart Button', 'addonify-quick-view' ),
								'after_add_to_cart'		=> __('After Add To Cart Button', 'addonify-quick-view' ),
								'overlay_on_image'		=> __('Overlay On The Product Image', 'addonify-quick-view' )
							) ,
						),
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'quick_view_btn_label',
					'field_label'			=> __('Quick View Button Label', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "text_box"),
					'field_callback_args'	=> array( 
						array(
							'name'			 => $this->db_field_initials . 'quick_view_btn_label', 
							'placeholder'	 => __('Quick View', 'addonify-quick-view') 
						)
					), 
				),
				
			)
		);

		// create settings fields
		$this->create_settings( $settings_args );


		// ---------------------------------------------
		// Contents Options
		// ---------------------------------------------

		$settings_args = array(
			'settings_group_name'	=> 'quick_views',
			'section_id' 			=> 'contents_to_show',
			'section_label'			=> __('CONTENTS OPTIONS', 'addonify-quick-view' ),
			'section_callback'		=> '',
			'screen'				=> $this->settings_page_slug.'-settings',
			'fields'				=> array(
				array(
					'field_id'				=> $this->db_field_initials . 'show_product_image_field',
					'field_label'			=> __('Content To Display', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "checkbox_with_label"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> __('Product Image', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'show_product_image'
						),
						array(
							'label'			=> __('Product Title', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'show_product_title'
						),
						array(
							'label'			=> __('Product Rating', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'show_product_rating'
						),
						array(
							'label'			=> __('Product Price', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'show_product_price'
						),
						array(
							'label'			=> __('Product Excerpt', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'show_product_excerpt'
						),
						array(
							'label'			=> __('Add To Cart Button', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'show_add_to_cart_btn'
						),
						array(
							'label'			=> __('Product Meta', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'show_product_meta'
						),
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_image_display_type',
					'field_label'			=> __('Product Image', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "select"),
					'field_callback_args'	=> array( 
						array(
							'name' 				=> $this->db_field_initials . 'button_position', 
							'options' 			=> array(
								'image_only' 			=> __('Product Image Only', 'addonify-quick-view' ),
								'image_or_gallery'		=> __('Product Image or Product Gallery', 'addonify-quick-view' ),
							) ,
						),
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'enable_lightbox',
					'field_label'			=> __('Enable Lightbox', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 
						array(
							'name' 			=> $this->db_field_initials . 'enable_lightbox', 
							'checked' 		=> 1
						)
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'display_view_detail_btn',
					'field_label'			=> __('Display View Detail Button', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 
						array(
							'name' 			=> $this->db_field_initials . 'display_view_detail_btn', 
							'checked' 		=> 1
						)
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'view_detail_btn_label',
					'field_label'			=> __('View Detail Button Label', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "text_box"),
					'field_callback_args'	=> array( 
						array(
							'name'			 => $this->db_field_initials . 'view_detail_btn_label', 
							'placeholder'	 => __('View Detail', 'addonify-quick-view') 
						)
					), 
				),
				
			)
		);

		// create settings fields
		$this->create_settings( $settings_args );



		// ---------------------------------------------
		// Styles Options
		// ---------------------------------------------

		$settings_args = array(
			'settings_group_name'	=> 'quick_views',
			'section_id' 			=> 'style_options',
			'section_label'			=> __('STYLE OPTIONS', 'addonify-quick-view' ),
			'section_callback'		=> '',
			'screen'				=> $this->settings_page_slug.'-styles',
			'fields'				=> array(
				array(
					'field_id'				=> $this->db_field_initials . 'load_styles_from_plugin',
					'field_label'			=> __('Load Styles From Plugin', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 
						array(
							'name' 			=> $this->db_field_initials . 'load_styles_from_plugin', 
							'checked' 		=> 1
						)
					) 
				),
			)
		);

		// create settings fields
		$this->create_settings( $settings_args );



		// ---------------------------------------------
		// Content Colors
		// ---------------------------------------------

		$settings_args = array(
			'settings_group_name'	=> 'quick_views',
			'section_id' 			=> 'content_colors',
			'section_label'			=> __('CONTENT COLORS', 'addonify-quick-view' ),
			'section_callback'		=> '',
			'screen'				=> $this->settings_page_slug.'-styles',
			'fields'				=> array(
				array(
					'field_id'				=> $this->db_field_initials . 'modal_box_color',
					'field_label'			=> __('Modal Box', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> __('Overlay Background Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'modal_overlay_bck_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Background Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'modal_bck_color',
							'default'		=> '#ffffff',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_title_color',
					'field_label'			=> __('Product Title', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'name'			=> $this->db_field_initials . 'product_title_color',
							'default'		=> '#000000',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_rating_color',
					'field_label'			=> __('Product Rating', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> __('Empty Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'product_rating_empty_color',
							'default'		=> '#cccccc',
						),
						array(
							'label'			=> __('Full Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'product_rating_full_color',
							'default'		=> '#000000',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_price_color',
					'field_label'			=> __('Product Price', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> __('Regular Price Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'product_regular_price_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Sale Price Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'product_sale_price_color',
							'default'		=> '#000000',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_excerpt_color',
					'field_label'			=> __('Product Excerpt', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'name'			=> $this->db_field_initials . 'product_excerpt_color',
							'default'		=> '#000000',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_meta_color',
					'field_label'			=> __('Product Meta', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> __('Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'product_meta_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Color - On Hover', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'product_meta_hover_color',
							'default'		=> '#000000',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_close_btn_color',
					'field_label'			=> __('Close Button', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> __('Text Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'close_btn_text_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Background Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'close_btn_bck_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Text Color - On Hover', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'close_btn_text_hover_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Background Color - On Hover', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'close_btn_bck_hover_color',
							'default'		=> '#000000',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'product_other_btn_color',
					'field_label'			=> __('Other Buttons', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker_group"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> __('Text Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'other_btn_text_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Background Color', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'other_btn_bck_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Text Color - On Hover', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'other_btn_text_hover_color',
							'default'		=> '#000000',
						),
						array(
							'label'			=> __('Background Color - On Hover', 'addonify-quick-view'),
							'name'			=> $this->db_field_initials . 'other_btn_bck_hover_color',
							'default'		=> '#000000',
						),
						
					),
				),
				array(
					'field_id'				=> $this->db_field_initials . 'custom_css',
					'field_label'			=> __('Custom CSS', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "text_area"),
					'field_callback_args'	=> array( 
						array(
							'name'			=> $this->db_field_initials . 'custom_css',
							'attr'			=> 'rows="5" class="large-text code"'
						),
						
					),
				),
				
			)
		);

		// create settings fields
		$this->create_settings( $settings_args );
		
	}

	
	// this function will create settings section, fields and register that settings in a single callback
	public function create_settings($args){
		
		// define section ---------------------------
		add_settings_section($args['section_id'], $args['section_label'], $args['section_callback'], $args['screen'] );

		foreach($args['fields'] as $field){
			
			// create label
			add_settings_field( $field['field_id'], $field['field_label'], $field['field_callback'], $args['screen'], $args['section_id'], $field['field_callback_args'] );
			
			foreach( $field['field_callback_args'] as $sub_field){
				register_setting( $args['settings_group_name'],  $sub_field['name'] );

				// add this field in to $all_db_fields
				// will be useful during plugin uninstall
				$this->all_db_fields[] = $sub_field['name'];
			}

		}
		
	}


	// -------------------------------------------------
	// form element helpers 
	// -------------------------------------------------

	public function text_box($arguments){
		foreach($arguments as $args){
			$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$db_value = get_option($args['name'], $placeholder);
			echo '<input type="text" class="regular-text" name="'. $args['name'] .'" id="'. $args['name'] .'" value="'.$db_value . '" />';
		}
	}

	public function text_area($arguments){
		foreach($arguments as $args){
			$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
			$db_value = get_option($args['name'], $placeholder);
			$attr = isset( $args['attr'] ) ? $args['attr'] : '';
			echo '<textarea type="text" name="'. $args['name'] .'" id="'. $args['name'] .'" '. $attr .' >'. $db_value .'</textarea>';
		}
	}

	public function toggle_switch($arguments){
		foreach($arguments as $args){
			$args['attr'] = ' class="lc_switch"';
			$this->checkbox($args);
		}
	}

	public function color_picker_group($args){
			
		foreach($args as $arg){
			$default =  isset( $arg['default'] )  ? $arg['default'] : '#000000';
			$db_value = get_option($arg['name'], $default);

			echo '<div class="colorpicker-group">';
			if( isset($arg['label']) ) {
				echo '<p>'. $arg['label'].'</p>';
			}
			echo '<input type="text" value="'. $db_value .'" name="'. $arg['name'] .'" id="'. $arg['name'] .'" class="color-picker" />';
			echo '</div>';
		}
	}

	public function checkbox_with_label($args){
			
		foreach($args as $arg){
			echo '<div class="checkbox-group">';
			$this->checkbox($arg);
			echo '<label>'.  $arg['label'] .'</label>';
			echo '</div>';
		}
	}

	public function checkbox($args){
		$default_state = ( array_key_exists('checked', $args) ) ? $args['checked'] : 1;
		$db_value = get_option($args['name'], $default_state);
		$is_checked = ( $db_value ) ? 'checked' : '';
		$attr = ( array_key_exists('attr', $args) ) ? $args['attr'] : '';

		echo '<input type="checkbox" value="1" id="'. $args['name'] .'" name="'. $args['name'] .'" '. $is_checked . ' ' . $attr .' />';
	}

	public function select($arguments){
		foreach($arguments as $args){

			$db_value = get_option($args['name']);
			$options = ( array_key_exists('options', $args) ) ? $args['options'] : array();
			echo '<select  name="'. $args['name'] .'" id="'. $args['name'] .'" >';
			foreach($options as $value => $label){
				echo '<option value="'. $value .'" ';
				if( $db_value == $value ) {
					echo 'selected';
				} 
				echo ' >' . $label . '</option>';
			}
			echo '</select>';
		}
	}


	// return names of all the fields used by this plugin to store data in database
	// useful in plugin deletion
	public function get_all_db_field_names(){
		return $this->all_db_fields;
	}


	// show error message in dashboard if woocommerce is not active
	function show_woocommerce_not_active_notice(){

		if( ! $this->is_woocommerce_active() ){
			add_action('admin_notices', 'woocommerce_not_active_notice' );
		}


		function woocommerce_not_active_notice() {
			
			echo '<div class="notice notice-error is-dismissible"><p>';
			_e( 'Addonify Quick View is enabled but not active. It requires WooCommerce in order to work.', 'addonify-quick-view' );
			echo '</p></div>';

		}

	}

}