<?php
/**
 * Form, option group, option name, option fields
 *
 * @package   PT_Content_Views_Admin
 * @author    PT Guy <palaceofthemes@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */

if ( ! class_exists( 'PT_CV_Plugin' ) ) {

	/**
	 * @name PT_CV_Plugin
	 */
	class PT_CV_Plugin {

		/**
		 * Holds the values to be used in the fields callbacks
		 */
		static $options;

		/**
		 * Add custom filters/actions
		 */
		static function init() {

			// Action
			add_action( 'admin_init', array( __CLASS__, 'register_settings' ) );
		}

		/**
		 * Content Views Settings page : section 1
		 */
		public static function settings_page_section_one() {

			$file_path = plugin_dir_path( PT_CV_FILE ) . 'admin/includes/templates/settings-section-one.php';

			$text = PT_CV_Functions::file_include_content( $file_path );

			$text = apply_filters( PT_CV_PREFIX_ . 'settings_page_section_one', $text );

			echo balanceTags( $text );
		}

		/**
		 * Content Views Settings page : section 2
		 */
		public static function settings_page_section_two() {

			$file_path = plugin_dir_path( PT_CV_FILE ) . 'admin/includes/templates/settings-section-two.php';

			$text = PT_CV_Functions::file_include_content( $file_path );

			$text = apply_filters( PT_CV_PREFIX_ . 'settings_page_section_two', $text );

			echo balanceTags( $text );
		}

		/**
		 * Form in Settings page
		 */
		public static function settings_page_form() {
			ob_start();

			self::$options = get_option( PT_CV_OPTION_NAME );
			?>
			<form method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields( PT_CV_OPTION_NAME . '_group' );
				do_settings_sections( PT_CV_DOMAIN );
				submit_button();
				?>
			</form>
			<?php
			$text = ob_get_clean();

			echo balanceTags( $text );
		}

		/**
		 * Register option group, option name, option fields
		 */
		public static function register_settings() {

			register_setting(
				PT_CV_OPTION_NAME . '_group', // Option group
				PT_CV_OPTION_NAME, // Option name
				array( __CLASS__, 'field_sanitize' ) // Sanitize
			);

			// Common setting Section
			$this_section = 'setting_frontend_assets';
			add_settings_section(
				$this_section, // ID
				'', // Title
				array( __CLASS__, 'section_callback_setting_frontend_assets' ), // Callback
				PT_CV_DOMAIN // Page
			);

			// Define Common setting fields
			$frontend_assets_fields = array(
				array(
					'id'    => 'unload_bootstrap',
					'title' => '<strong>' . __( 'Frontend assets', PT_CV_DOMAIN ) . '</strong>',
				),
			);

			// Filter Frontend assets option
			$frontend_assets_fields = apply_filters( PT_CV_PREFIX_ . 'frontend_assets_fields', $frontend_assets_fields );

			// Add classes to find callback function for extra options
			$defined_in_class = (array) apply_filters( PT_CV_PREFIX_ . 'defined_in_class', array() );

			// Register Common setting fields
			foreach ( $frontend_assets_fields as $field ) {
				$class = ( array_key_exists( $field['id'], $defined_in_class ) ) ? $defined_in_class[$field['id']] : __CLASS__;
				self::field_register( $field, $this_section, $class );
			}

			do_action( PT_CV_PREFIX_ . 'settings_page' );
		}

		/**
		 * Sanitize each setting field as needed
		 *
		 * @param array $input Contains all settings fields as array keys
		 */
		public static function field_sanitize( $input ) {
			$new_input = array();

			foreach ( $input as $key => $value ) {
				$new_input[$key] = sanitize_text_field( $value );
			}

			return $new_input;
		}

		/**
		 * Add settings field
		 *
		 * @param array  $field_info Field information
		 * @param string $section    Id of setting section
		 * @param string $class      Class name to find the callback function
		 */
		public static function field_register( $field_info, $section, $class = __CLASS__ ) {
			if ( ! $field_info ) {
				return false;
			}

			add_settings_field(
				$field_info['id'], // ID
				$field_info['title'], // Title
				array( $class, 'field_callback_' . $field_info['id'] ), // Callback
				PT_CV_DOMAIN, // Page
				$section // Section
			);
		}

		/**
		 * License key field
		 */
		public static function field_callback_unload_bootstrap() {
			$field_name = 'unload_bootstrap';

			self::_field_print(
				$field_name,
				'checkbox',
				__( "Don't load <b>Bootstrap</b> style & script (in frontend of website)", PT_CV_DOMAIN ),
				__( 'Only check this option if Bootstrap has been loaded by active theme or other plugin', PT_CV_DOMAIN )
			);
		}

		/**
		 * Print text/password field
		 *
		 * @param string $field_name The ID of field
		 * @param string $field_type The type of field
		 * @param string $text       The label of field
		 * @param string $desc       Description text
		 */
		static function _field_print( $field_name, $field_type = 'text', $text = '', $desc = '' ) {

			// Get Saved value
			$field_value = isset( self::$options[$field_name] ) ? esc_attr( self::$options[$field_name] ) : '';
			$checked     = '';

			if ( in_array( $field_type, array( 'checkbox', 'radio' ) ) ) {
				$checked = checked( 1, $field_value, false );
				// Reassign value for this option
				$field_value = 1;
			}

			$field_id = esc_attr( $field_name );

			printf(
				'<input type="%1$s" id="%2$s" name="%3$s[%2$s]" value="%4$s" %5$s /> ',
				esc_attr( $field_type ), $field_id, PT_CV_OPTION_NAME, $field_value, $checked
			);

			// For radio, checkbox field
			if ( ! empty( $text ) ) {
				printf( '<label for="%s" class="label-for-option">%s</label>', $field_id, $text );
			}

			// Show description
			if ( ! empty( $desc ) ) {
				printf( '<p class="description">%s</p>', $desc );
			}
		}

		/**
		 * Print the text for Common setting Section
		 */
		public static function section_callback_setting_frontend_assets() {

		}
	}

}