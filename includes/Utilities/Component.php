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
	 * Creates an input-tag html template.
	 *
	 * @param array $args An array includes field data.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function input_tag_template( array $args ): string {

		$input_type  = $args['type'];
		$class       = $args['class'] ?? null;
		$style       = $args['style'] ?? null;
		$field_name  = $args['field_name'];
		$attribute   = $args['attribute'] ?? null;
		$placeholder = $args['placeholder'] ?? null;

		$option_name = $args['option_name'];
		$options     = get_option( $option_name );

		$checked     = $options && isset( $options[ $field_name ] );
		$field_value = $options && isset( $options[ $field_name ] ) ? $options[ $field_name ] : null;

		$html = '<div class="">';
		$html .= '<input type="' . $input_type . '" name="' . $option_name . '[' . $field_name . ']"';
		$html .= ' id="' . PLUGIN_PREFIX . '_' . $field_name . '"';
		$html .= ' class="' . $class . '" style="' . $style . '"' . $attribute;

		if ( 'checkbox' !== $input_type ) {
			$html .= ' value="' . $field_value . '" placeholder="' . $placeholder . '" />';
		} else {
			$html .= ' role="switch" value="1" ' . checked( $checked, true, false ) . ' />';
		}

		$html .= '<label for="' . PLUGIN_PREFIX . '_' . $field_name . '"></label>';
		$html .= '</div>';

		return $html;
	}
}
