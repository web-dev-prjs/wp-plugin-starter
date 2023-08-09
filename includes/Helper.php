<?php

/**
 * Defines helper functions of the plugin.
 *
 * @package wp-plugin-starter
 */

namespace WPS;

use DateTimeZone;
use Exception;
use WPS\Core\Notice;

/**
 * Helper class.
 *
 * @since 1.0.0
 */
class Helper {

	/**
	 * Returns a name of class in the form of lowercase.
	 *
	 * @param string $file The magic file constant (__FILE__).
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function lower_class_name( string $file ): string {

		return strtolower(
			preg_replace( '/.php/', '', basename( $file ) )
		);
	}

	/**
	 * Makes a settings form based on settings name.
	 *
	 * @param string      $settings_name A settings name.
	 * @param null|string $button_text   Name of button.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function make_settings_form( string $settings_name, string $button_text = null ): void {

		echo '<form method="post" action="/wp-admin/options.php">';

		settings_errors();
		settings_fields( PLUGIN_PREFIX . "_{$settings_name}_" . OPTION_GROUP_SUFFIX );
		do_settings_sections( PLUGIN_PREFIX . "_$settings_name" );
		submit_button( $button_text );

		echo '</form>';

		if ( self::is_path( PLUGIN_PREFIX . '_dashboard' ) ) {
			$output = '<pre>';
			$output .= print_r( get_option( PLUGIN_PREFIX . "_services" ), true );
			$output .= '</pre>';

			echo $output;
		}
	}

	/**
	 * Checks the path based on the name of the page.
	 *
	 * @param string $page_name The name of the page.
	 *
	 * @return null|bool TRUE if the page exists, FALSE otherwise.
	 * @since 1.0.0
	 */
	public static function is_path( string $page_name ): null|bool {

		preg_match(
			'/(((\/\w*|\w*)\/' . $page_name . '\/)|(\w*' . $page_name . '))/',
			$_SERVER['REQUEST_URI'],
			$matches
		);

		if ( empty( $matches ) ) {
			return null;
		}

		return match ( $matches[0] ) {
			"/$page_name/", $page_name => true,
			default                    => false
		};
	}

	/**
	 * Checks if the admin page is an admin page of the plugin.
	 *
	 * @return bool TRUE if the admin page is an admin page of the "brp-toolbox" plugin, FALSE otherwise.
	 * @since  1.0.0-beta
	 */
	public static function this_plugin(): bool {

		return preg_match( '/' . PLUGIN_PREFIX . '_/', get_current_screen()->base );
	}

	/**
	 * Define date and timezone.
	 *
	 * @param string $timezone A string of location, based on the country/province formatted.
	 *
	 * @return DateTimeZone
	 * @throws Exception
	 * @since  1.0.0
	 */
	public static function is_date_timezone( string $timezone ): DateTimeZone {

		return new DateTimeZone( $timezone );
	}

	/**
	 * Get the template content to form the template folder.
	 *
	 * @param string      $path The path of template at this plugin.
	 * @param string      $name The name of template at this plugin.
	 * @param null|string $type The type of template at this plugin. Includes "view" or "callback." Default is "null."
	 * @param bool        $show Demonstrates the template. Default is "true."
	 *
	 * @return mixed Represent a html formatted of content.
	 * @since 1.0.0
	 */
	public static function get_template( string $path, string $name, ?string $type = null, bool $show = true ): mixed {

		if ( $show ) {
			$directory = ! empty( $type ) ? "/{$type}s/" : '/';

			try {
				if ( ! file_exists( $file = PLUGIN_TEMPLATES . "$path$directory$name.php" ) ) {
					throw new Exception(
						"The \"$name\" does not exist, please check the \"Templates\" folder!",
						404
					);
				} else {
					return require_once $file;
				}
			} catch ( Exception $e ) {
				Notice::custom_admin_notice( 'error', $e->getCode(), $e->getMessage() );
			}
		}

		return null;
	}

	/**
	 * Retrieves a specific plugins if is active.
	 *
	 * @param string $name The name of plugin.
	 *
	 * @return bool TRUE if plugin is active, FALSE otherwise.
	 * @since 1.0.0
	 */
	public static function is_plugin_active( string $name ): bool {

		return in_array( "$name/$name.php",
			apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	}

	/**
	 * Redirects based on two-way:
	 * 1- With `header` function.
	 * 2- With `wp_safe_redirect` function.
	 *
	 * @see   header(), wp_safe_redirect()
	 *
	 * @param string $type      Type of redirect, includes: `header` or `wsr`
	 * @param string $URL       An URL of destination
	 * @param bool   $permanent Type of redirect, if is `TRUE` be 301, and otherwise 302.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function redirect( string $type, string $URL, bool $permanent = false ): void {

		/**
		 * Redirect by header php function.
		 */
		if ( 'header' === $type ) {
			header( "Location: $URL", true, $permanent ? 301 : 302 );
			exit;
		}

		/**
		 * Redirect by wp_safe_redirect WordPress function.
		 */
		if ( 'wsr' === $type ) {
			wp_safe_redirect( $URL, $permanent ? 301 : 302 );
			exit;
		}
	}


	/**
	 * A couple of key/value pairs print to debugging.
	 *
	 * @param array $data    An array of data as key/value pairs.
	 * @param bool  $display Display whole of markup HTML, It can include "true" or "false," Default is "false."
	 *
	 * @return string A string in markup HTML formatted.
	 * @since  1.0.0
	 */
	public static function check_print( array $data, bool $display = false ): string {

		$display = $display ? 'block' : 'none';

		$markup = '<style>
			.check-print-display {
				display: ' . $display . ';
				padding: 30px 0;
			}
	        .check-print-section {
	            display: inline-block;
	            padding: 15px;
	            margin: 5px;
	            border: 1px solid green;
	            font-size: 15px;
				font-weight: 500;
	        }
            .check-print-section span {
	        	color: firebrick;
				font-weight: 600;
	        }
        </style>';

		$markup .= '<pre class="check-print-display">';

		foreach ( $data as $key => $value ) {
			$markup .= "<p class=\"check-print-section\"><span>$key: </span>";
			$markup .= print_r( $value, true );
			$markup .= '</p><br />';
		}

		$markup .= '</pre>';

		return $markup;
	}
}
