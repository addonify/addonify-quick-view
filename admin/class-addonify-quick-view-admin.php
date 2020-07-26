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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if( isset($_GET['page']) && $_GET['page'] == 'addonify_quick_view' ){

			// toggle switch
			wp_enqueue_style( 'lc_switch', plugin_dir_url( __FILE__ ) . 'css/lc_switch.css' );

			// color picker
			wp_enqueue_style( 'spectrum', '//cdn.jsdelivr.net/npm/spectrum-colorpicker2@2.0.0/dist/spectrum.min.css' );

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

			// color picker
			wp_enqueue_script( 'spectrum', '//cdn.jsdelivr.net/npm/spectrum-colorpicker2@2.0.0/dist/spectrum.min.js', array( 'jquery' ), '', false );

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/addonify-quick-view-admin.js', array( 'jquery' ), $this->version, false );

		}

	}


	// admin menu
	public function add_menu(){
		add_menu_page( 'Addonify Quick View Settings', 'Addonify', 'manage_options', $this->settings_page_slug, array($this, 'quick_view_settings_page_ui'), 'dashicons-slides', 76 );
		
		add_submenu_page(  $this->settings_page_slug, 'Addonify Quick View Settings', 'Quick View', 'manage_options', $this->settings_page_slug, array($this, 'quick_view_settings_page_ui') );

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
					
				</div><!--addonify-settings-wrapper-->
				
				<?php submit_button(); ?>
            </form>
        </div>

<?php
	}



	public function form_submission_notification(){
		settings_errors();
	}


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
					'field_id'				=> $this->db_field_initials . 'button_position',
					'field_label'			=> __('Button position', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "select"),
					'field_callback_args'	=> array( 
						array(
							'name' 				=> $this->db_field_initials . 'button_position', 
							'options' 			=> array(
								'before_add_to_cart' 	=> __('Before add to cart button', 'addonify-quick-view' ),
								'after_add_to_cart'		=> __('After add to cart button', 'addonify-quick-view' ),
								'overlay_on_image'		=> __('Overlay on the product image', 'addonify-quick-view' )
							) ,
						),
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'button_label',
					'field_label'			=> __('Button label', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "text_box"),
					'field_callback_args'	=> array( 
						array(
							'name'			 => $this->db_field_initials . 'button_label', 
							'placeholder'	 => __('Quick View') 
						)
					), 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'display_view_details_btn',
					'field_label'			=> __('Show View Details button', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 
						array(
							'name' => $this->db_field_initials . 'display_view_details_btn'
						)
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'view_details_button_label',
					'field_label'			=> __('View Details button label', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "text_box"),
					'field_callback_args'	=> array( 
						array(
							'name' 				=> $this->db_field_initials . 'view_details_button_label', 
							'placeholder' 		=> __('View Details', 'addonify-quick-view' ) 
						)
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'display_product_image_type',
					'field_label'			=> __('Display', 'addonify-quick-view' ),
					'field_callback'		=> array( $this, "select" ),
					'field_callback_args'	=> array( 
						array(
							'name' 				=> $this->db_field_initials . 'display_product_image_type', 
							'options' 			=> array(
								'image' 		=> __('Product Image', 'addonify-quick-view' ),
								'gallery'		=> __('Product Gallery', 'addonify-quick-view' )
							) 
						)
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'enable_lightbox_on_product_image',
					'field_label'			=> __('Enable lightbox on product image', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 
						array(
							'name' => $this->db_field_initials . 'enable_lightbox_on_product_image' 
						)
					) 
				)
			)
		);

		// create settings fields
		$this->create_settings( $settings_args );


		// ---------------------------------------------
		// Contents to Show
		// ---------------------------------------------

		$settings_args = array(
			'settings_group_name'	=> 'quick_views',
			'section_id' 			=> 'contents_to_show',
			'section_label'			=> __('CONTENTS TO SHOW', 'addonify-quick-view' ),
			'section_callback'		=> '',
			'screen'				=> $this->settings_page_slug.'-settings',
			'fields'				=> array(
				array(
					'field_id'				=> $this->db_field_initials . 'show_product_image_field',
					'field_label'			=> __('Product Image', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "checkbox_with_label"),
					'field_callback_args'	=> array( 
						array(
							'label'			=> 'Product Image',
							'name'	=> $this->db_field_initials . 'show_product_image'
						),
						array(
							'label'			=> 'Product Image 2 ',
							'name'	=> $this->db_field_initials . 'show_product_image_2'
						),
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
			'section_label'			=> __('STYLES OPTIONS', 'addonify-quick-view' ),
			'section_callback'		=> '',
			'screen'				=> $this->settings_page_slug.'-styles',
			'fields'				=> array(
				array(
					'field_id'				=> $this->db_field_initials . 'load_plugin_css',
					'field_label'			=> __('Load plugin CSS', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'load_plugin_css', 
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_overlay_bck_color',
					'field_label'			=> __('Modal overlay background color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_overlay_bck_color', 
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_content_bck_color',
					'field_label'			=> __('Content background color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_content_bck_color', 
						'default'			=> 'white',
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_product_title_text_color',
					'field_label'			=> __('Product title text color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_product_title_text_color', 
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_product_ratings_color',
					'field_label'			=> __('Product ratings color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_product_ratings_color', 
						'default'			=> 'red'
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_product_price_color',
					'field_label'			=> __('Product price color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_product_price_color', 
						'default'			=> '#cccccc'
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_product_excerpt_color',
					'field_label'			=> __('Product excerpt color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_product_excerpt_color', 
						'default'			=> '#000'
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_product_meta_color',
					'field_label'			=> __('Product meta color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_product_meta_color', 
						'default'			=> '#000'
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_btn_bck_color',
					'field_label'			=> __('Button background color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_btn_bck_color', 
						'default'			=> 'black'
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'modal_btn_text_color',
					'field_label'			=> __('Button text color', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "color_picker"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'modal_btn_text_color', 
						'default'			=> '#ffffff'
					) 
				),
				array(
					'field_id'				=> $this->db_field_initials . 'custom_css',
					'field_label'			=> __('Custom CSS', 'addonify-quick-view' ),
					'field_callback'		=> array($this, "text_area"),
					'field_callback_args'	=> array( 
						'name' 				=> $this->db_field_initials . 'custom_css', 
						'attr'				=> 'class="large-text code" rows="5"'
					) 
				),
				
				
			)
		);

		// create settings fields
		// $this->create_settings( $settings_args );
		
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
			}

			// }
			// else{
			// 	// generate field in database
			// 	register_setting( $args['settings_group_name'],  $field['field_id'] );
			// }


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

	public function text_area($args){
		$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$db_value = get_option($args['name'], $placeholder);
		$attr = isset( $args['attr'] ) ? $args['attr'] : '';
		echo '<textarea type="text" name="'. $args['name'] .'" id="'. $args['name'] .'" '. $attr .' >'. $db_value .'</textarea>';
	}


	public function toggle_switch($arguments){
		foreach($arguments as $args){
			$args['css_class'] = 'lc_switch';
			$this->checkbox($args);
		}
	}


	public function color_picker($args){
		$default = ( array_key_exists('default', $args) ) ? $args['default'] : '#000000';
		$db_value = get_option($args['name'], $default);
		$attr = ( array_key_exists('attr', $args) ) ? $args['attr'] : '';

		echo '<input value="'. $db_value .'" class="color-picker" id="'. $args['name'] .'" name="'. $args['name'] .'" '. $attr . ' />';
	}


	public function checkbox_with_label($args){

		// if( !array($args) ){
		// 	echo '<label>'.  $args['label'] .'</label>';
		// 	$this->checkbox($args);
		// }
		// else{
			
			foreach($args as $arg){
				echo '<div class="checkbox-group">';
				$this->checkbox($arg);
				echo '<label>'.  $arg['label'] .'</label>';
				echo '</div>';
			}
		// }
	}


	public function checkbox($args){
		$css_class = ( array_key_exists('css_class', $args) ) ? $args['css_class'] : '';
		$state = ( array_key_exists('checked', $args) ) ? $args['checked'] : 1;
		$db_value = get_option($args['name'], $state);
		$is_checked = ( $db_value ) ? 'checked' : '';
		$attr = ( array_key_exists('attr', $args) ) ? $args['attr'] : '';

		echo '<input type="checkbox" value="1" class="'. $css_class .'" id="'. $args['name'] .'" name="'. $args['name'] .'" '. $is_checked . ' ' . $attr .' />';
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


}