<?php

/**
 * Adds custom Twig-functions.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Utilities;

/**
 * TwigFunction class.
 *
 * @since 1.0.0
 */
final class TwigFunction {

	/**
	 * Makes a settings form based on settings name.
	 *
	 * @param array $data An array of parameters includes:
	 *                    * @type string $settings_form Settings-form name.
	 *                    * @type null|string $button_text Name of button.
	 *                    * @type bool $show_options Show a collect of options based on a settings name,
	 *                    *                          Default is TRUE.
	 *
	 * @return string|false
	 * @since 1.0.0
	 */
	public static function make_settings_form( array $data ): bool|string {

		global $wp_settings_sections;

		if ( ! isset( $wp_settings_sections[ PLUGIN_PREFIX . "_{$data['settings_form']}" ] ) ) {
			return false;
		}

		ob_start();

		echo '<form method="post" action="/wp-admin/options.php">';

		if ( 'options-general' !== get_current_screen()->parent_base ) {
			settings_errors();
		}
		settings_fields( PLUGIN_PREFIX . "_{$data['settings_form']}_" . OPTION_GROUP_SUFFIX );
		do_settings_sections( PLUGIN_PREFIX . "_{$data['settings_form']}" );
		submit_button( $data['text_button'] ?? null );

		echo '</form>';

		if ( Helper::is_path( PLUGIN_PREFIX . '_dashboard' ) ) {
			$options = get_option( PLUGIN_PREFIX . '_services' );
		} else {
			$options = get_option( PLUGIN_PREFIX . "_{$data['settings_form']}" );
		}

		$show_options = $data['show_options'] ?? true;

		if ( $show_options && $options ) {
			foreach ( $options as $key => $value ) {
				echo '|&nbsp;&nbsp;<code>' . $key . ': ',
				print_r( $value, true ),
				'</code>&nbsp;&nbsp;|<br />';
			}
		}

		return ob_get_clean();
	}
}
