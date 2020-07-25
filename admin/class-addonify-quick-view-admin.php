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
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $settings_page_slug = 'addonify_quick_view';

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

			wp_enqueue_style( 'lc_switch', plugin_dir_url( __FILE__ ) . 'css/lc_switch.css', array(), '', 'all' );

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
	
			wp_enqueue_script( 'lc_switch', plugin_dir_url( __FILE__ ) . 'js/lc_switch.min.js', array( 'jquery' ), '', false );

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/addonify-quick-view-admin.js', array( 'jquery' ), $this->version, false );

		}

	}


	// admin menu
	public function add_menu(){
		add_menu_page( 'Addonify Quick View Settings', 'Addonify', 'manage_options', $this->settings_page_slug, array($this, 'quick_view_settings_page_ui'), 'dashicons-slides', 76 );
		
		add_submenu_page(  $this->settings_page_slug, 'Addonify Quick View Settings', 'Quick View', 'manage_options', $this->settings_page_slug, array($this, 'quick_view_settings_page_ui'), 76 );

	}

	
	public function quick_view_settings_page_ui(){
	
?>
		<div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1>Quick View Options</h1>
			<p style="margin: 10px 0 35px">This is a sample settings page for this plugin</p>
            <form method="POST" action="options.php">
                <?php
					settings_fields("quick_views");
                    do_settings_sections($this->settings_page_slug);
                    submit_button();
                ?>         
            </form>
        </div>

<?php
	}


	public function settings_page_ui() {

		// ---------------------------------------------
		// General Options
		// ---------------------------------------------

		$settings_args = array(
			'section_id' 		=> 'general_options',
			'section_label'		=> __('GENERAL OPTIONS'),
			'section_callback'	=> '',
			'screen'			=> $this->settings_page_slug,
			'option_group'		=> 'quick_views',
			'fields'			=> array(
				array(
					'field_id'				=> 'enable_quick_view',
					'field_label'			=> 'Enable Quick View',
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 'name' => 'enable_quick_view', 'checked' => 1) 
				),
				array(
					'field_id'				=> 'button_position',
					'field_label'			=> 'Button position',
					'field_callback'		=> array($this, "select"),
					'field_callback_args'	=> array( 
						'name' => 'button_position', 
						'options' => array(
							'before_add_to_cart' 	=> 'Before add to cart button',
							'after_add_to_cart'		=> 'After add to cart button',
							'overlay_on_image'		=> 'Overlay on the product image'
						) 
					) 
				),
				array(
					'field_id'				=> 'button_label',
					'field_label'			=> 'Button label',
					'field_callback'		=> array($this, "text_box"),
					'field_callback_args'	=> array( 'name' => 'button_label', 'placeholder' => 'Quick View' ) 
				),
				array(
					'field_id'				=> 'content_to_display',
					'field_label'			=> 'Content to display',
					'field_callback'		=> array($this, "text_box"),
					'field_callback_args'	=> array( 'name' => 'content_to_display', 'placeholder' => '' ) 
				),
				array(
					'field_id'				=> 'display_view_details_btn',
					'field_label'			=> 'Show View Details button',
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 'name' => 'display_view_details_btn', 'placeholder' => '' ) 
				),
				array(
					'field_id'				=> 'view_details_button_label',
					'field_label'			=> 'View Details button label',
					'field_callback'		=> array($this, "text_box"),
					'field_callback_args'	=> array( 
						'name' => 'view_details_button_label', 
						'placeholder' => 'View Details' 
					) 
				),
				array(
					'field_id'				=> 'display_product_image_type',
					'field_label'			=> 'Display',
					'field_callback'		=> array($this, "select"),
					'field_callback_args'	=> array( 
						'name' => 'display_product_image_type', 
						'options' => array(
							'image' 	=> 'Product Image',
							'gallery'	=> 'Product Gallery'
						) 
					) 
				),
				array(
					'field_id'				=> 'enable_lightbox_on_product_image',
					'field_label'			=> 'Enable lightbox on product image',
					'field_callback'		=> array($this, "toggle_switch"),
					'field_callback_args'	=> array( 'name' => 'enable_lightbox_on_product_image', ) 
				)
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
			
			add_settings_field( $field['field_id'], $field['field_label'], $field['field_callback'], $args['screen'], $args['section_id'], $field['field_callback_args'] );
			
			register_setting( $args['option_group'],  $field['field_id'] );
		}
		
	}
	

	// -------------------------------------------------
	// form element helpers 
	// -------------------------------------------------

	public function text_box($args){
		$placeholder = isset( $args['placeholder'] ) ? $args['placeholder'] : '';
		$db_value = get_option($args['name'], $placeholder);
		echo '<input type="text" class="regular-text" name="'. $args['name'] .'" id="'. $args['name'] .'" value="'.$db_value . '" />';
	}

	public function toggle_switch($args){
		$state = ( array_key_exists('checked', $args) ) ? $args['checked'] : 1;
		$db_value = get_option($args['name']);
		echo '<input type="checkbox" class="lc_switch" id="'. $args['name'] .'" name="'. $args['name'] .'"  data-checked="'. $state .'" />';
	}

	public function select($args){
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