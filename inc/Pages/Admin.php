<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase.
/**
 * Admin class
 *
 * @package    wpPluginStarter
 * @category   class
 * @author     webbmakerr
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, webbmakerr.
 */

namespace Inc\Pages;

/**
 * The Admin class
 */
class Admin extends \Inc\Base\BaseController {

	/**
	 * The register function
	 * Register all the options pages plugin.
	 *
	 * @return void
	 */
	public function register() {

		\add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
	}

	/**
	 * The add_admin_pages function
	 * Add the option page for plugin.
	 *
	 * @return void
	 */
	public function add_admin_pages() {

		add_menu_page(
			'WP Plugin Starter',
			'WPS',
			'manage_options',
			'wps-admin',
			array( $this, 'admin_options_callback' ),
			'dashicons-admin-generic',
			110
		);
	}

	/**
	 * The admin_options_callback function
	 *
	 * @return void
	 */
	public function admin_options_callback() {

		require_once $this->plugin_path . 'templates/admin-options-callback.php';
	}
}
