<?php

/**
 * Deactivates the plugin.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

/**
 * Deactivate class.
 *
 * @since 1.0.0
 */
final class Deactivate {

	/**
	 * Runs in the deactivation time.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function deactivate(): void {

		flush_rewrite_rules();
	}
}
