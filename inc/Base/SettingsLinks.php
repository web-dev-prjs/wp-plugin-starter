<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase.
/**
 * SettingsLinks class
 *
 * @package    wpPluginStarter
 * @category   class
 * @author     webbmakerr
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, webbmakerr.
 */

namespace Inc\Base;

/**
 * The SettingsLinks class
 */
class SettingsLinks extends \Inc\Base\BaseController {

	/**
	 * The register function
	 * Register the settings links plugin.
	 *
	 * @return void
	 */
	public function register() {

		\add_filter( 'plugin_action_links_' . $this->plugin_base, array( $this, 'settings_links' ) );
	}

	/**
	 * The settings_links function
	 * Add custom links to plugin links array.
	 *
	 * @param array $links The list of plugin links array.
	 * @return array       List of links array.
	 */
	public static function settings_links( $links ) {
		$settings_link = '<a href="admin.php?page=wps-admin">Settings</a>';
		\array_push( $links, $settings_link );
		return $links;
	}
}
