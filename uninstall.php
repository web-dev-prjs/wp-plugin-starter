<?php

/**
 * Uses for when uninstalling this plugin.
 * Such as removing related tables from a database, or any other required actions.
 *
 * @package wp-plugin-starter
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || die;

/**
 * Uninstall class.
 *
 * @since 1.0.0
 */
final class uninstall {

	/**
	 * Runs in the uninstallation time.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function run(): void {

		/*
		 |-----------------------------------------------------------
		 | Removes rewrite rules and then recreate rewrite rules.
		 |-----------------------------------------------------------
		 */
		flush_rewrite_rules();

		/*
		 |-----------------------------------------------------------
		 | Is deleted the "PLUGIN_ALL_OPTIONS" option-group
		 | at the deleting time the plugin.
		 |-----------------------------------------------------------
		 */
		delete_option( PLUGIN_ALL_OPTIONS );;

		/*
		 |-----------------------------------------------------------
		 | Clear any cached data that has been removed.
		 |-----------------------------------------------------------
		 */
		wp_cache_flush();
	}
}

// Is triggered at the deleting time the plugin.
uninstall::run();
