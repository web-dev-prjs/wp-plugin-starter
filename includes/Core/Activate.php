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

		/*
		 |-----------------------------------------------------------
		 | Removes rewrite rules and then recreate rewrite rules.
		 |-----------------------------------------------------------
		 */
		flush_rewrite_rules();

		/*
		 |-----------------------------------------------------------
		 | Checks the existing the "PLUGIN_ALL_OPTIONS" option-group,
		 | if it does not exist therefore adds it as an empty array.
		 |-----------------------------------------------------------
		 */
		get_option( PLUGIN_ALL_OPTIONS ) or add_option( PLUGIN_ALL_OPTIONS, array() );
	}
}
