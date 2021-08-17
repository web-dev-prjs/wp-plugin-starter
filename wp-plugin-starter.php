<?php
/**
 * WP Plugin Starter
 *
 * @package   wpPluginStarter
 * @category  plugin
 * @link      https://github.com/omidhoseini/wp-plugin-starter
 * @author    webbmakerr
 * @copyright Copyright (c) 2021, webbmakerr.
 * @license   GPL v2 or later
 *
 * @wordpress-plugin
 * Plugin Name:       WP Plugin Starter
 * Plugin URI:        https://github.com/omidhoseini/wp-plugin-starter
 * Description:       This is an educational plugin and an example to produce any other plugin.
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      5.6
 * Author:            webbmakerr
 * Author URI:        https://webbmakerr.info
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/omidhoseini/wp-plugin-starter
 * Text Domain:       wp-plugin-starter
 * Domain Path:       /lang
 */

// Security Note: Blocks direct access to the PHP files.
\defined( 'ABSPATH' ) || die;

// Define and insert all require files.
if ( file_exists( \dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once \dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

// Activate plugin.
register_activation_hook(
	__FILE__,
	function() {
		Inc\Base\Activate::activate();
	}
);

// Deactivate plugin.
register_deactivation_hook(
	__FILE__,
	function() {
		Inc\Base\Deactivate::deactivate();
	}
);

if ( class_exists( 'Inc\\Init' ) ) :
	Inc\Init::register_services();
endif;
