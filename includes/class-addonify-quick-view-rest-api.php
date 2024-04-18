<?php
/**
 * The class to define REST API endpoints used in settings page.
 *
 * This is used to define REST API endpoints used in admin settings page to get and update settings values.
 *
 * @since      1.0.7
 * @package    Addonify_Quick_View
 * @subpackage Addonify_Quick_View/includes
 * @author     Addonify <info@addonify.com>
 */

if ( ! class_exists( 'Addonify_Quick_View_Rest_API' ) ) {
	/**
	 * Register rest api.
	 *
	 * @package    Addonify_Quick_View
	 * @subpackage Addonify_Quick_View/includes
	 * @author     Adodnify <contact@addonify.com>
	 */
	class Addonify_Quick_View_Rest_API {

		/**
		 * The namespace of the Rest API.
		 *
		 * @since 1.0.7
		 *
		 * @access   protected
		 * @var      string    $rest_namespace.
		 */
		protected $rest_namespace = 'addonify_quick_view_options_api';


		/**
		 * Register new REST API endpoints.
		 *
		 * @since 1.0.7
		 */
		public function __construct() {

			add_action( 'rest_api_init', array( $this, 'register_rest_endpoints' ) );
		}


		/**
		 * Define the REST API endpoints to get all setting options and update all setting options.
		 *
		 * @since 1.0.7
		 * @access   public
		 */
		public function register_rest_endpoints() {

			register_rest_route(
				$this->rest_namespace,
				'/get_options',
				array(
					array(
						'methods'             => 'GET',
						'callback'            => array( $this, 'rest_handler_get_settings_fields' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);

			register_rest_route(
				$this->rest_namespace,
				'/update_options',
				array(
					array(
						'methods'             => \WP_REST_Server::CREATABLE,
						'callback'            => array( $this, 'rest_handler_update_options' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);

			register_rest_route(
				$this->rest_namespace,
				'/reset_options',
				array(
					array(
						'methods'             => \WP_REST_Server::CREATABLE,
						'callback'            => array( $this, 'reset_settings' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);

			register_rest_route(
				$this->rest_namespace,
				'/export_options',
				array(
					array(
						'methods'             => \WP_REST_Server::READABLE,
						'callback'            => array( $this, 'export_settings' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);

			register_rest_route(
				$this->rest_namespace,
				'/import_options',
				array(
					array(
						'methods'             => \WP_REST_Server::READABLE,
						'callback'            => array( $this, 'import_settings' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);
		}


		/**
		 * Callback function to get all settings options values.
		 *
		 * @since 1.0.7
		 */
		public function rest_handler_get_settings_fields() {

			return addonify_quick_view_get_settings_fields();
		}


		/**
		 * Callback function to update all settings options values.
		 *
		 * @since 1.0.7
		 *
		 * @param \WP_REST_Request $request    The request object.
		 * @return \WP_REST_Response $return_data   The response object.
		 */
		public function rest_handler_update_options( $request ) {

			$return_data = array(
				'success' => false,
				'message' => __( 'Ooops, error saving settings!!!', 'addonify-quick-view' ),
			);

			$params = $request->get_params();

			if ( ! isset( $params['settings_values'] ) ) {

				$return_data['message'] = __( 'No settings values to update!!!', 'addonify-quick-view' );
				return $return_data;
			}

			if ( addonify_quick_view_update_settings_fields_values( $params['settings_values'] ) === true ) {

				$return_data['success'] = true;
				$return_data['message'] = __( 'Settings saved successfully', 'addonify-quick-view' );
			}

			return rest_ensure_response( $return_data );
		}

		/**
		 * API callback handler for resetting plugin settings.
		 *
		 * @since 1.2.17
		 */
		public function reset_settings() {

			$setting_defaults = addonify_quick_view_settings_fields_defaults();

			foreach ( $setting_defaults as $setting_key => $default_value ) {

				if ( ! update_option( ADDONIFY_DB_INITIALS . $setting_key, $default_value ) ) {
					return array(
						'success' => false,
						'message' => esc_html__( 'Error resetting options', 'addonify-quick-view' ),
					);
				}
			}

			return array(
				'success' => true,
				'message' => esc_html__( 'Options resetted sucessfully', 'addonify-quick-view' ),
			);
		}

		/**
		 * API callback handler for exporting saved plugin settings.
		 *
		 * @since 1.2.17
		 */
		public function export_settings() {

			global $wpdb;

			$query = 'SELECT option_name, option_value FROM ' . $wpdb->options . ' WHERE option_name LIKE %s';

			$query_results = $wpdb->get_results( $wpdb->prepare( $query, '%' . ADDONIFY_DB_INITIALS . '%' ), ARRAY_A ); //phpcs:ignore

			$json_file = 'adfy-qv-' . time() . '.json';

			if (
				file_put_contents( //phpcs:ignore
					trailingslashit( wp_upload_dir()['path'] ) . $json_file,
					wp_json_encode( $query_results )
				)
			) {
				return new WP_REST_Response(
					array(
						'success' => true,
						'url'     => trailingslashit( wp_upload_dir()['url'] ) . $json_file,
					)
				);
			}

			return new WP_REST_Response(
				array(
					'success' => false,
					'message' => esc_html__( 'Unable to write on server.', 'addonify-quick-view' ),
				)
			);
		}

		/**
		 * API callback handler for exporting saved plugin settings.
		 *
		 * @since 1.2.17
		 */
		public function import_settings() {

			if ( empty( $_FILES ) ) {
				return new WP_REST_Response(
					array(
						'success' => false,
						'message' => esc_html__( 'Import file not found.', 'addonify-quick-view' ),
					)
				);
			}
			$file_contents = file_get_contents( $_FILES['gocart_import_file']['tmp_name'] ); //phpcs:ignore

			if ( isset( $_FILES['gocart_import_file']['type'] ) && 'application/json' !== $_FILES['gocart_import_file']['type'] ) {
				return new WP_REST_Response(
					array(
						'success' => false,
						'message' => esc_html__( 'Unsupported file format of uploaded file.', 'addonify-quick-view' ),
					)
				);
			}

			$settings_values = $this->json_to_array( $file_contents );

			if ( ! is_array( $settings_values ) ) {
				return new WP_REST_Response(
					array(
						'success' => false,
						'message' => esc_html__( 'Invalid json content.', 'addonify-quick-view' ),
					)
				);
			}

			foreach ( $settings_values as $setting_value ) {
				update_option( $setting_value->option_name, $setting_value->option_value );
			}

			return new WP_REST_Response(
				array(
					'success' => true,
					'message' => esc_html__( 'Settings imported successfully.', 'addonify-quick-view' ),
				)
			);
		}

		/**
		 * Permission callback function to check if current user can access the rest api route.
		 *
		 * @since 1.0.7
		 */
		public function permission_callback() {

			if ( ! current_user_can( 'manage_options' ) ) {

				return new WP_Error( 'rest_forbidden', esc_html__( 'Ooops, you are not allowed to manage options.', 'addonify-quick-view' ), array( 'status' => 401 ) );
			}

			return true;
		}
	}
}
