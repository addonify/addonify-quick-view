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
		protected $rest_namespace = 'addonify-quick-view/v2';


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
				'/options',
				array(
					array(
						'methods'             => \WP_REST_Server::READABLE,
						'callback'            => array( $this, 'rest_handler_get_setting_sections_fields' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);

			register_rest_route(
				$this->rest_namespace,
				'/options',
				array(
					array(
						'methods'             => \WP_REST_Server::EDITABLE,
						'callback'            => array( $this, 'rest_handler_update_options_v2' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);

			register_rest_route(
				$this->rest_namespace,
				'/options/reset',
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
				'/options/export',
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
				'/options/import',
				array(
					array(
						'methods'             => \WP_REST_Server::CREATABLE,
						'callback'            => array( $this, 'import_settings' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);
		}

		/**
		 * Callback function to get all settings options values.
		 *
		 * @since 1.2.17
		 *
		 * @param \WP_REST_Request $request    The request object.
		 * @return \WP_REST_Response $return_data   The response object.
		 */
		public function rest_handler_get_setting_sections_fields( $request ) {

			$return_data = array(
				'success' => false,
				'message' => esc_html__( 'Oops, error getting settings!!!', 'addonify-quick-view' ),
			);

			// Check nonce if the request is not a "GET" request.
			if ( $request->get_method() !== 'GET' ) {
				$nonce = $request->get_header( 'x_wp_admin_nonce' );

				if ( ! $nonce || ! wp_verify_nonce( $nonce, 'addonify-quick-view-admin-nonce' ) ) {
					$return_data['message'] = esc_html__( 'Invalid security token', 'addonify-quick-view' );
					return rest_ensure_response( $return_data );
				}
			}

			$return_data['success'] = true;
			$return_data['message'] = esc_html__( 'Successfully fetched data.', 'addonify-quick-view' );
			$return_data['data']    = addonify_quick_view_get_settings_sections_fields();

			return rest_ensure_response( $return_data );
		}

		/**
		 * Callback function to update all settings options values.
		 *
		 * @since 1.0.7
		 *
		 * @param \WP_REST_Request $request    The request object.
		 * @return \WP_REST_Response $return_data   The response object.
		 */
		public function rest_handler_update_options_v2( $request ) {

			$return_data = array(
				'success' => false,
				'message' => esc_html__( 'Failed! to update options.', 'addonify-quick-view' ),
			);

			$nonce = $request->get_header( 'x_wp_admin_nonce' );

			if ( ! $nonce || empty( $nonce ) ) {
				$return_data['message'] = esc_html__( 'Security token is missing!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			if ( ! wp_verify_nonce( $nonce, 'addonify-quick-view-admin-nonce' ) ) {
				$return_data['message'] = esc_html__( 'Invalid security token!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			$params = $request->get_params();

			if ( ! isset( $params['settings_values'] ) ) {
				$return_data['message'] = esc_html__( 'No settings values to update!!!', 'addonify-quick-view' );
				return $return_data;
			}

			if ( addonify_quick_view_update_fields_values( $params['settings_values'] ) === true ) {

				$return_data['success'] = true;
				$return_data['message'] = esc_html__( 'Settings saved successfully', 'addonify-quick-view' );
			}

			return rest_ensure_response( $return_data );
		}

		/**
		 * API callback handler for resetting plugin settings.
		 *
		 * @since 1.2.17
		 *
		 * @param \WP_REST_Request $request    The request object.
		 */
		public function reset_settings( $request ) {

			$return_data = array(
				'success' => false,
				'message' => esc_html__( 'Failed! to reset options.', 'addonify-quick-view' ),
			);

			$nonce = $request->get_header( 'x_wp_admin_nonce' );

			if ( ! $nonce || empty( $nonce ) ) {
				$return_data['message'] = esc_html__( 'Security token is missing!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			if ( ! wp_verify_nonce( $nonce, 'addonify-quick-view-admin-nonce' ) ) {
				$return_data['message'] = esc_html__( 'Invalid security token!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			$setting_defaults = addonify_quick_view_setting_defaults();

			foreach ( $setting_defaults as $key => $value ) {
				update_option( ADDONIFY_QUICK_VIEW_DB_INITIALS . $key, $value );
			}

			$return_data['success'] = true;
			$return_data['message'] = esc_html__( 'Settings reset successfully!', 'addonify-quick-view' );

			return rest_ensure_response( $return_data );
		}

		/**
		 * API callback handler for exporting saved plugin settings.
		 *
		 * @since 1.2.17
		 *
		 * @param \WP_REST_Request $request    The request object.
		 */
		public function export_settings( $request ) {
			$return_data = array(
				'success' => false,
				'message' => esc_html__( 'Unable to write on server.', 'addonify-quick-view' ),
			);

			$nonce = $request->get_header( 'x_wp_admin_nonce' );

			if ( ! $nonce || empty( $nonce ) ) {
				$return_data['message'] = esc_html__( 'Security token is missing!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			if ( ! wp_verify_nonce( $nonce, 'addonify-quick-view-admin-nonce' ) ) {
				$return_data['message'] = esc_html__( 'Invalid security token!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			global $wpdb;

			$query = 'SELECT option_name, option_value FROM ' . $wpdb->options . ' WHERE option_name LIKE %s';

			$query_results = $wpdb->get_results( $wpdb->prepare( $query, '%' . ADDONIFY_QUICK_VIEW_DB_INITIALS . '%' ) ); // phpcs:ignore

			$json_file = 'addonify-quick-view-settings-' . time() . '.json';

			if (
				file_put_contents( //phpcs:ignore.
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

			return rest_ensure_response( $return_data );
		}

		/**
		 * API callback handler for exporting saved plugin settings.
		 *
		 * @since 1.2.17
		 *
		 * @param \WP_REST_Request $request    The request object.
		 */
		public function import_settings( $request ) {
			$return_data = array(
				'success' => false,
				'message' => esc_html__( 'Unable to import settings.', 'addonify-quick-view' ),
			);

			$nonce = $request->get_header( 'x_wp_admin_nonce' );

			if ( ! $nonce || empty( $nonce ) ) {
				$return_data['message'] = esc_html__( 'Security token is missing!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			if ( ! wp_verify_nonce( $nonce, 'addonify-quick-view-admin-nonce' ) ) {
				$return_data['message'] = esc_html__( 'Invalid security token!', 'addonify-quick-view' );
				return rest_ensure_response( $return_data );
			}

			if ( empty( $_FILES ) ) {
				return new WP_REST_Response(
					array(
						'success' => false,
						'message' => esc_html__( 'Import file not found.', 'addonify-quick-view' ),
					)
				);
			}

			$file_contents = file_get_contents( $_FILES['addonify-quick-view-settings-backup']['tmp_name'] ); //phpcs:ignore

			if ( isset( $_FILES['addonify-quick-view-settings-backup']['type'] ) &&
					'application/json' !== $_FILES['addonify-quick-view-settings-backup']['type']
				) {
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
				$value = wp_unslash( $setting_value->option_value );
				if ( is_serialized( $setting_value->option_value ) ) {
					$value = unserialize( $setting_value->option_value ); // phpcs:ignore
				}
				update_option( $setting_value->option_name, $value );
			}

			return new WP_REST_Response(
				array(
					'success' => true,
					'message' => esc_html__( 'Settings imported successfully.', 'addonify-quick-view' ),
				)
			);
		}

		/**
		 * Converts json data to array.
		 *
		 * @param mixed $data JSON Data to convert to array format.
		 * @return array|false Array if correct json format, false otherwise
		 */
		private function json_to_array( $data ) {
			if ( ! is_string( $data ) ) {
				return false;
			}

			try {
				$return_data = json_decode( $data );
				if ( JSON_ERROR_NONE === json_last_error() ) {
					if ( gettype( $return_data ) === 'array' ) {
						return $return_data;
					} elseif ( gettype( $return_data ) === 'object' ) {
						return (array) $return_data;
					}
				} else {
					return false;
				}
			} catch ( Exception $e ) {
				error_log( $e->getMessage() ); //phpcs:ignore
			}
		}

		/**
		 * Permission callback function to check if current user can access the rest api route.
		 *
		 * @since 1.0.7
		 */
		public function permission_callback() {

			if ( ! current_user_can( 'manage_options' ) ) {

				return new WP_Error( 'rest_forbidden', esc_html__( 'Oops, you are not allowed to manage options.', 'addonify-quick-view' ), array( 'status' => 401 ) );
			}

			return true;
		}
	}
}
