<?php

/**
 * Actives the plugin.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

/**
 * Activate class.
 *
 * @since 1.0.0
 */
final class Activate {

	/**
	 * Runs in the activation time.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function activate(): void {

		flush_rewrite_rules();

		get_option( PLUGIN_ALL_OPTIONS ) or add_option( PLUGIN_ALL_OPTIONS, array() );
	}
}
