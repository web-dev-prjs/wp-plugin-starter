<?php

/**
 * Defines all admin callback functions.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core\Setting\Traits\Callbacks;

/**
 * Setting callback trait.
 *
 * @since 1.0.0
 */
trait Setting {

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

		$markup = '<h6>The admin settings section for set any checkbox fields!</h6>';

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

		$class       = $args['class'];
		$label_for   = $args['label_for'];
		$option_name = $args['option_name'];
		$options     = get_option( $option_name );
		$checked     = $options && isset( $options[ $label_for ] );

		$markup = '<div class="">'; // form-check form-switch
		$markup .= '<input type="checkbox" id="' . $label_for . '" name="' . $option_name . '[' . $label_for . ']"';
		$markup .= ' class="form-check-input' . $class . '" role="switch" value="1" ';
		$markup .= checked( $checked, true, false );
		$markup .= ' /><label for="' . $label_for . '"></label>';
		$markup .= '</div>';

		echo $markup;
	}
}
