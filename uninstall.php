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
final class Uninstall {

	/**
	 * Runs in the uninstallation time.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function uninstall(): void {

		// Deletes all the plugin options, when uninstall the plugin.
		delete_option( PLUGIN_ALL_OPTIONS );
	}
}
