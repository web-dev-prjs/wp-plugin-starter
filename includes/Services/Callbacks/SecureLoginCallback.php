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
trait SecureLoginCallback {

	/**
	 * Sanitizes secure-login option inputs.
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
	 * Invokes the keyword section.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function login_keyword_section__callback(): void {

		$markup = '<h6>';
		$markup .= __(
			'You can enter a different login keyword instead of
			the "wp-admin" or "wp-login.php" to increase security!',
			PLUGIN_DOMAIN
		);
		$markup .= '</h6>';

		echo $markup;
	}

	/**
	 * Invokes the keyword field.
	 *
	 * @param array $args An array includes field data.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function login_keyword_field__callback( array $args ): void {

		print Component::input_tag_template( $args );
	}
}
