<?php
/**
 * Return modal box option fields.
 *
 * @since 1.0.0.
 * @package addonify_quick_view.
 */

if ( ! function_exists( 'addonify_quick_view_modal_section' ) ) {
	/**
	 * Function to return modal control fields.
	 *
	 * @param array $sections section fields.
	 */
	function addonify_quick_view_modal_section( $sections ) {

		$sections['modal_box_options'] = array(
			'title'        => esc_html__( 'Modal Box Options', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_modal_box_option_fields(),
		);

		$sections['modal_box_ui_options'] = array(
			'title'        => esc_html__( 'Modal Box UI Options', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_modal_box_ui_option_fields(),
		);

		$sections['modal_box_close_button_options'] = array(
			'title'        => esc_html__( 'Modal Box Close Button Options', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_modal_box_close_button_option_fields(),
		);

		$sections['misc_button_inside_modal_box'] = array(
			'title'        => esc_html__( 'Misc Button Inside Modal Box', 'addonify-quick-view' ),
			'type'         => 'sub_section',
			'sub_sections' => addonify_quick_view_misc_button_inside_modal_box_fields(),
		);

		return $sections;
	}

	add_filter( 'addonify_quick_view_modal_sections', 'addonify_quick_view_modal_section' );
}

if ( ! function_exists( 'addonify_quick_view_modal_box_option_fields' ) ) {
	/**
	 * Function to return modal box options fields.
	 */
	function addonify_quick_view_modal_box_option_fields() {
		return apply_filters(
			'addonify_quick_view_modal_box_option_fields',
			array(
				'modal_box_content'                => array(
					'label'       => esc_html__( 'Content to display', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose content that you want to display in quick view modal box.', 'addonify-quick-view' ),
					'type'        => 'checkbox',
					'design'      => 'buttons',
					'width'       => 'full',
					'choices'     => array(
						'image'       => esc_html__( 'Image', 'addonify-quick-view' ),
						'title'       => esc_html__( 'Title', 'addonify-quick-view' ),
						'price'       => esc_html__( 'Price', 'addonify-quick-view' ),
						'rating'      => esc_html__( 'Rating', 'addonify-quick-view' ),
						'excerpt'     => esc_html__( 'Excerpt', 'addonify-quick-view' ),
						'meta'        => esc_html__( 'Meta', 'addonify-quick-view' ),
						'add_to_cart' => esc_html__( 'Add to Cart', 'addonify-quick-view' ),
					),
				),
				'modal_content_column_layout'      => array(
					'label'       => esc_html__( 'Content column layout inside modal', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose how content column should appear inside the modal box.', 'addonify-quick-view' ),
					'type'        => 'radio',
					'design'      => 'images',
					'choices'     => array(
						'default'      => '<svg viewBox="0 0 160 110" width="150" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="160" height="110" rx="10" fill="#EAEAEA" /><rect x="13" y="15" width="55" height="45" rx="4" fill="#DBDBDB" /><rect x="13" y="68" width="15" height="15" rx="2" fill="#DBDBDB" /><rect x="33" y="68" width="15" height="15" rx="2" fill="#DBDBDB" /><rect x="53" y="68" width="15" height="15" rx="2" fill="#DBDBDB" /><rect x="83" y="19" width="40" height="5" rx="2" fill="#D9D9D9" /><rect x="129" y="19" width="20" height="5" rx="2" fill="#D9D9D9" /><pathd="M88.6601 41.2898L85.57 43.1772L86.4102 39.6551L83.6602 37.2994L87.2696 37.01L88.6601 33.6667L90.0507 37.01L93.6602 37.2994L90.9102 39.6551L91.7503 43.1772L88.6601 41.2898Z" fill="#C2C2C2"/><path d="M97.6601 41.2898L94.57 43.1772L95.4102 39.6551L92.6602 37.2994L96.2696 37.01L97.6601 33.6667L99.0507 37.01L102.66 37.2994L99.9102 39.6551L100.75 43.1772L97.6601 41.2898Z" fill="#C2C2C2" /><path d="M106.66 41.2898L103.57 43.1772L104.41 39.6551L101.66 37.2994L105.27 37.01L106.66 33.6667L108.051 37.01L111.66 37.2994L108.91 39.6551L109.75 43.1772L106.66 41.2898Z" fill="#C2C2C2" /><path d="M115.66 41.2898L112.57 43.1772L113.41 39.6551L110.66 37.2994L114.27 37.01L115.66 33.6667L117.051 37.01L120.66 37.2994L117.91 39.6551L118.75 43.1772L115.66 41.2898Z" fill="#C2C2C2" /><path d="M124.66 41.2898L121.57 43.1772L122.41 39.6551L119.66 37.2994L123.27 37.01L124.66 33.6667L126.051 37.01L129.66 37.2994L126.91 39.6551L127.75 43.1772L124.66 41.2898Z" fill="#C2C2C2" /><rect x="83" y="54" width="25" height="5" rx="2" fill="#D9D9D9" /> <rect x="113" y="54" width="26" height="5" rx="2" fill="#D9D9D9" /><rect x="83" y="66" width="10" height="5" rx="2" fill="#D9D9D9" /><rect x="99" y="66" width="24" height="5" rx="2" fill="#D9D9D9" /><rect x="83" y="84" width="40" height="10" rx="5" fill="#C8C8C8" /></svg>',
						'row-reversed' => '<svg viewBox="0 0 160 110" width="150" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="160" height="110" rx="10" fill="#EAEAEA"/><rect x="93" y="15" width="55" height="45" rx="4" fill="#DBDBDB"/><rect x="93" y="68" width="15" height="15" rx="2" fill="#DBDBDB"/><rect x="113" y="68" width="15" height="15" rx="2" fill="#DBDBDB"/><rect x="133" y="68" width="15" height="15" rx="2" fill="#DBDBDB"/><rect x="13" y="19" width="40" height="5" rx="2" fill="#D9D9D9"/><rect x="59" y="19" width="20" height="5" rx="2" fill="#D9D9D9"/><path d="M18.6601 41.2898L15.57 43.1772L16.4102 39.6551L13.6602 37.2994L17.2696 37.01L18.6601 33.6667L20.0507 37.01L23.6602 37.2994L20.9102 39.6551L21.7503 43.1772L18.6601 41.2898Z" fill="#C2C2C2"/><path d="M27.6601 41.2898L24.57 43.1772L25.4102 39.6551L22.6602 37.2994L26.2696 37.01L27.6601 33.6667L29.0507 37.01L32.6602 37.2994L29.9102 39.6551L30.7503 43.1772L27.6601 41.2898Z" fill="#C2C2C2"/><path d="M36.6601 41.2898L33.57 43.1772L34.4102 39.6551L31.6602 37.2994L35.2696 37.01L36.6601 33.6667L38.0507 37.01L41.6602 37.2994L38.9102 39.6551L39.7503 43.1772L36.6601 41.2898Z" fill="#C2C2C2"/><path d="M45.6601 41.2898L42.57 43.1772L43.4102 39.6551L40.6602 37.2994L44.2696 37.01L45.6601 33.6667L47.0507 37.01L50.6602 37.2994L47.9102 39.6551L48.7503 43.1772L45.6601 41.2898Z" fill="#C2C2C2"/><path d="M54.6601 41.2898L51.57 43.1772L52.4102 39.6551L49.6602 37.2994L53.2696 37.01L54.6601 33.6667L56.0507 37.01L59.6602 37.2994L56.9102 39.6551L57.7503 43.1772L54.6601 41.2898Z" fill="#C2C2C2"/><rect x="13" y="54" width="25" height="5" rx="2" fill="#D9D9D9"/><rect x="43" y="54" width="26" height="5" rx="2" fill="#D9D9D9"/><rect x="13" y="66" width="10" height="5" rx="2" fill="#D9D9D9"/><rect x="29" y="66" width="24" height="5" rx="2" fill="#D9D9D9"/><rect x="13" y="84" width="40" height="10" rx="5" fill="#C8C8C8"/></svg>',
					),
				),
				'modal_content_column_gap'         => array(
					'label'       => esc_html__( 'Modal content column gap', 'addonify-quick-view' ),
					'description' => esc_html__( 'Specify the gap for the modal content inner column in px.', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '40', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 0,
					'max'         => 150,
					'step'        => 5,
				),
				'hide_modal_close_button'          => array(
					'label'       => esc_html__( 'Hide modal close button', 'addonify-quick-view' ),
					'description' => esc_html__( 'If enabled, close button will be hidden for all media screen except mobile device.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'close_modal_when_esc_pressed'     => array(
					'label'       => esc_html__( 'Close modal if ESC key is pressed', 'addonify-quick-view' ),
					'description' => esc_html__( 'Enable to close modal if ESC key is pressed on keyboard.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'close_modal_when_clicked_outside' => array(
					'label'       => esc_html__( 'Close modal if clicked outside', 'addonify-quick-view' ),
					'description' => esc_html__( 'Enable to close modal if clicked outside of modal box.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'switch',
				),
				'mobile_close_button_label'        => array(
					'label'       => esc_html__( 'Close button label on mobile device', 'addonify-quick-view' ),
					'description' => esc_html__( 'Check docs to learn about mobile close button.', 'addonify-quick-view' ),
					'type'        => 'text',
					'placeholder' => esc_html__( 'Close', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
				),
				'modal_opening_animation'          => array(
					'label'       => esc_html__( 'Modal opening animation', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose animation effect when modal opens.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'select',
					'choices'     => array(
						'none'           => esc_html__( 'None', 'addonify-quick-view' ),
						'fade-in'        => esc_html__( 'Fade in', 'addonify-quick-view' ),
						'fade-in-up'     => esc_html__( 'Fade in from up', 'addonify-quick-view' ),
						'bounce-in'      => esc_html__( 'Bounce in', 'addonify-quick-view' ),
						'slide-in-left'  => esc_html__( 'Slide in from left', 'addonify-quick-view' ),
						'slide-in-right' => esc_html__( 'Slide in from right', 'addonify-quick-view' ),
						'zoom-in'        => esc_html__( 'Zoom in', 'addonify-quick-view' ),
						'swing'          => esc_html__( 'Swing effect', 'addonify-quick-view' ),
						'jello'          => esc_html__( 'Jello effect', 'addonify-quick-view' ),
						'rubber-band'    => esc_html__( 'Rubber band effect', 'addonify-quick-view' ),
					),
				),
				'modal_closing_animation'          => array(
					'label'       => esc_html__( 'Modal closing animation', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose animation effect when modal close.', 'addonify-quick-view' ),
					'dependent'   => array( 'enable_quick_view' ),
					'type'        => 'select',
					'choices'     => array(
						'none'            => esc_html__( 'None', 'addonify-quick-view' ),
						'fade-out'        => esc_html__( 'Fade out', 'addonify-quick-view' ),
						'fade-out-down'   => esc_html__( 'Fade out down', 'addonify-quick-view' ),
						'bounce-out'      => esc_html__( 'Bounce out', 'addonify-quick-view' ),
						'slide-out-left'  => esc_html__( 'Slide out to left', 'addonify-quick-view' ),
						'slide-out-right' => esc_html__( 'Slide out to right', 'addonify-quick-view' ),
						'zoom-out'        => esc_html__( 'Zoom out', 'addonify-quick-view' ),
					),
				),
				'spinner_icons'                    => array(
					'type'        => 'radio',
					'design'      => 'icons',
					'label'       => esc_html__( 'Spinner icon', 'addonify-quick-view' ),
					'description' => esc_html__( 'Choose modal box loading spinner icon', 'addonify-quick-view' ),
					'width'       => 'full',
					'dependent'   => array( 'enable_quick_view' ),
					'choices'     => addonify_quick_view_get_spinner_icon( 'all' ),
				),
			)
		);
	}
}

if ( ! function_exists( 'addonify_quick_view_modal_box_ui_option_fields' ) ) {
	/**
	 * Function to return modal box options fields.
	 */
	function addonify_quick_view_modal_box_ui_option_fields() {
		return apply_filters(
			'addonify_quick_view_modal_box_ui_option_fields',
			array(
				'modal_general_text_font_size'       => array(
					'label'       => esc_html__( 'General text font size inside modal box', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '28', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 13,
					'max'         => 32,
					'step'        => 1,
				),
				'modal_zindex'                       => array(
					'label'       => esc_html__( 'Modal CSS z-index', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10000000000000000', 'addonify-quick-view' ),
					'type'        => 'number',
					'min'         => 0,
					'max'         => 1000000000000000000,
					'step'        => 10,
				),
				'modal_border_radius'                => array(
					'label'       => esc_html__( 'Modal border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '10', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 0,
					'max'         => 100,
					'step'        => 1,
				),
				'modal_box_overlay_background_color' => array(
					'label' => esc_html__( 'Modal overlay background', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_box_background_color'         => array(
					'label' => esc_html__( 'Modal box inner background', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_box_general_text_color'       => array(
					'label' => esc_html__( 'Text color inside modal box', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_box_general_border_color'     => array(
					'label' => esc_html__( 'General border color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_box_inputs_background_color'  => array(
					'label' => esc_html__( 'Input fields background color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_box_inputs_text_color'        => array(
					'label' => esc_html__( 'Input fields text color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_box_spinner_icon_color'       => array(
					'label' => esc_html__( 'Modal box spinner icon color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'spinner_size'                       => array(
					'label'       => esc_html__( 'Spinner icon font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '28', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 14,
					'max'         => 100,
					'step'        => 2,
				),
			)
		);
	}
}

if ( ! function_exists( 'addonify_quick_view_modal_box_close_button_option_fields' ) ) {
	/**
	 * Function to return modal box options fields.
	 */
	function addonify_quick_view_modal_box_close_button_option_fields() {
		return apply_filters(
			'addonify_quick_view_modal_box_close_button_option_fields',
			array(
				'modal_close_button_text_color'       => array(
					'label' => esc_html__( 'Icon color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_close_button_text_hover_color' => array(
					'label' => esc_html__( 'Icon color on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_close_button_background_color' => array(
					'label' => esc_html__( 'Icon background color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_close_button_background_hover_color' => array(
					'label' => esc_html__( 'Icon background color hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'mobile_close_button_font_size'       => array(
					'label'  => esc_html__( 'Mobile close button font size (unit: px)', 'addonify-quick-view' ),
					'type'   => 'number',
					'design' => 'plus-minus',
					'min'    => 12,
					'max'    => 18,
					'step'   => 1,
				),
			),
		);
	}
}

if ( ! function_exists( 'addonify_quick_view_misc_button_inside_modal_box_fields' ) ) {
	/**
	 * Function to return modal box options fields.
	 */
	function addonify_quick_view_misc_button_inside_modal_box_fields() {
		return apply_filters(
			'addonify_quick_view_misc_button_inside_modal_box_fields',
			array(
				'modal_misc_buttons_text_color'       => array(
					'label' => esc_html__( 'Text color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_misc_buttons_text_hover_color' => array(
					'label' => esc_html__( 'Text color on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_misc_buttons_background_color' => array(
					'label' => esc_html__( 'Background color', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_misc_buttons_background_hover_color' => array(
					'label' => esc_html__( 'Background on hover', 'addonify-quick-view' ),
					'type'  => 'color',
				),
				'modal_misc_buttons_font_size'        => array(
					'label'       => esc_html__( 'Font size (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '15', 'addonify-quick-view' ),
					'type'        => 'number',
					'style'       => 'buttons-plus-minus',
					'min'         => 10,
					'max'         => 24,
					'step'        => 1,
				),
				'modal_misc_buttons_font_weight'      => array(
					'label'   => esc_html__( 'Font weight', 'addonify-quick-view' ),
					'type'    => 'select',
					'choices' => array(
						'400' => __( 'Normal', 'addonify-quick-view' ),
						'500' => __( 'Medium', 'addonify-quick-view' ),
						'600' => __( 'Semi bold', 'addonify-quick-view' ),
						'700' => __( 'Bold', 'addonify-quick-view' ),
					),
				),
				'modal_misc_buttons_text_transform'   => array(
					'label'   => esc_html__( 'Text transform', 'addonify-quick-view' ),
					'type'    => 'select',
					'choices' => array(
						'default'    => esc_html__( 'Default', 'addonify-quick-view' ),
						'capitalize' => esc_html__( 'Capitalize', 'addonify-quick-view' ),
						'lowercase'  => esc_html__( 'Lowercase', 'addonify-quick-view' ),
						'uppercase'  => esc_html__( 'Uppercase', 'addonify-quick-view' ),
					),
				),
				'modal_misc_buttons_letter_spacing'   => array(
					'label'       => esc_html__( 'Letter spacing (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '0', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 0,
					'max'         => 10,
					'step'        => 0.1,
					'precision'   => 2,
				),
				'modal_misc_buttons_line_height'      => array(
					'label'       => esc_html__( 'Line height (unit: em)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '1', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 1,
					'max'         => 3,
					'step'        => 0.1,
					'precision'   => 2,
				),
				'modal_misc_buttons_height'           => array(
					'label'       => esc_html__( 'Height (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '50', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 30,
					'max'         => 100,
					'step'        => 1,
				),
				'modal_misc_buttons_border_radius'    => array(
					'label'       => esc_html__( 'Border radius (unit: px)', 'addonify-quick-view' ),
					'placeholder' => esc_html__( '5', 'addonify-quick-view' ),
					'type'        => 'number',
					'design'      => 'plus-minus',
					'min'         => 0,
					'max'         => 100,
					'step'        => 2,
				),
			),
		);
	}
}
