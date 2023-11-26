<?php

/**
 * Defines all admin callback methods.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Services\Callbacks;

use WPS\Utilities\Component;

/**
 * SampleCallback class.
 *
 * @since 1.0.0
 */
trait SampleServiceCallback {

	/**
	 * Sanitizes sample-service option inputs.
	 *
	 * @param array $input
	 *
	 * @return array An array of custom fields.
	 * @since 1.0.0
	 */
	public function option_group_sanitize__callback( array $input ): array {

		return $input;
	}

	/**
	 * Invokes the sample-service dashboard section.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function section_one_section__callback(): void {

		$markup = '<h6>';
		$markup .= __(
			'Configure the Section-One functionality!',
			PLUGIN_DOMAIN
		);
		$markup .= '</h6>';

		echo $markup;
	}

	/**
	 * Invokes the sample-service option fields.
	 *
	 * @param array $args An array includes field data.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function field_one_field__callback( array $args ): void {

		print Component::input_tag_template( $args );
	}
}
