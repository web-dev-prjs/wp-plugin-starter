<?php

/**
 * Defines all admin callback methods.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Controller\Services\Callbacks;

/**
 * Callbacks class.
 *
 * @since 1.0.0
 */
trait SampleService {

	/**
	 * Sanitizes sample-option inputs.
	 *
	 * @param array $input
	 *
	 * @return array An array of custom fields.
	 * @since 1.0.0
	 */
	public function sample_option_sanitize__callback( array $input ): array {

		return $input;
	}

	/**
	 * Retrieves the sample-service dashboard section.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function sample_service_section__callback(): void {

		$markup = '<h6>The sample-service section for manage the functionality!</h6>';

		echo $markup;
	}

	/**
	 * Retrieves the sample-option service fields.
	 *
	 * @param array $args An array includes field data.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function sample_option_field__callback( array $args ): void {

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

		echo $markup;
	}
}
