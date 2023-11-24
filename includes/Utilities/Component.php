<?php

/**
 * All plugin components.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Utilities;

/**
 * Component class.
 *
 * @since 1.0.0
 */
final class Component {

	/**
	 * Creates an input-text html template.
	 *
	 * @param array $args An array includes field data.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function input_text_template( array $args ): string {

		$field_name  = $args['label_for'];
		$option_name = $args['option_name'];
		$placeholder = $args['placeholder'];
		$options     = get_option( $option_name );
		$field_value = $options && isset( $options[ $field_name ] ) ? $options[ $field_name ] : null;

		$markup = '<div class="">'; // form-check form-switch
		$markup .= '<input type="input" id="' . $field_name . '" name="' . $option_name . '[' . $field_name . ']"';
		$markup .= ' class="' . $args['class'] . '" value="' . $field_value . '" placeholder="' . $placeholder . '"';
		$markup .= ' /><label for="' . $field_name . '"></label>';
		$markup .= '</div>';

		return $markup;
	}

	/**
	 * Creates an input-checkbox html template.
	 *
	 * @param array $args An array includes field data.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function input_checkbox_template( array $args ): string {

		$label_for   = $args['label_for'];
		$option_name = $args['option_name'];
		$options     = get_option( $option_name );
		$checked     = $options && isset( $options[ $label_for ] );

		$markup = '<div class="">'; // form-check form-switch
		$markup .= '<input type="checkbox" id="' . $label_for . '" name="' . $option_name . '[' . $label_for . ']"';
		$markup .= ' class="' . $args['class'] . '" role="switch" value="1" '; // form-check-input
		$markup .= checked( $checked, true, false );
		$markup .= ' /><label for="' . $label_for . '"></label>';
		$markup .= '</div>';

		return $markup;
	}
}
