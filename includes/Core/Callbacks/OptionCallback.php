<?php

/**
 * Defines all admin-option callback functions.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core\Callbacks;

use WPS\Utilities\Component;

/**
 * Option callback trait.
 *
 * @since 1.0.0
 */
trait OptionCallback {

	/**
	 * Sanitizes input value.
	 *
	 * @param mixed $args An array of custom fields.
	 *
	 * @return null|array An array of custom fields.
	 * @since 1.0.0
	 */
	public static function service_option_group__callback( mixed $args ): null|array {

		return $args;
	}

	/**
	 * Retrieves the admin dashboard section.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function services_section__callback(): void {

		$markup = '<h6>';
		$markup .= __(
			'The admin settings section for set any checkbox fields!',
			PLUGIN_DOMAIN
		);
		$markup .= '</h6>';

		echo $markup;
	}

	/**
	 * Retrieves the option service field.
	 *
	 * @param array $args An array includes field data.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function service_field__callback( array $args ): void {

		print Component::input_tag_template( $args );
	}
}
