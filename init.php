<?php

/**
 * Initializes the whole of the plugin.
 *
 * @package wp-plugin-starter
 */

// Security Note: Blocks direct access to the PHP files.
defined( 'ABSPATH' ) || exit;

require_once PLUGIN_PATH . 'configs/constants.php'; // Load the plugin data configuration.
require_once PLUGIN_PATH . 'configs/pages.php'; // Includes all the plugin pages and sub-pages.
require_once PLUGIN_PATH . 'configs/options.php'; // Includes all the plugin settings, sections, and fields.

// Check if it does not exist the autoload file.
if ( ! file_exists( PLUGIN_PATH . 'vendor/autoload.php' ) ) {
	require_once PLUGIN_PATH . 'includes/Core/Notice.php';

	add_action(
		'admin_notices',
		PLUGIN_NAMESPACE . 'Core\Notice::autoload_error',
		100,
		0
	);
} else {
	require_once PLUGIN_PATH . 'vendor/autoload.php'; // Insert all require files.

	// Activate the plugin.
	register_activation_hook(
		PLUGIN_FILE,
		[ PLUGIN_NAMESPACE . 'Core\Activate', 'activate' ]
	);

	// Deactivate the plugin.
	register_deactivation_hook(
		PLUGIN_FILE,
		[ PLUGIN_NAMESPACE . 'Core\Deactivate', 'deactivate' ]
	);

	// Load the plugin text-domain
	load_plugin_textdomain(
		PLUGIN_NAME,
		false,
		dirname( PLUGIN_BASENAME ) . '/language'
	);

	if ( ! class_exists( PLUGIN_NAMESPACE . 'App' ) ) {
		add_action(
			'admin_notices',
			PLUGIN_NAMESPACE . 'Core\Notice::initializer_error',
			100,
			0
		);
	} else {
		// Builds the plugin modules.
		(new ( PLUGIN_NAMESPACE . 'App' ))->run();
	}
}
