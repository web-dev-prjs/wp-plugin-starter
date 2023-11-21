<?php

/**
 * The plugin bootstrap file.
 *
 * @package    wp-plugin-starter
 * @copyright  Copyright (c) 2023, omidhosseini (as webbmakerr).
 * @wordpress-plugin
 * Plugin Name: WP Plugin Starter
 * Plugin URI: https://github.com/web-dev-prjs/wp-plugin-starter
 * Description: A boilerplate with the developmental purpose of any other WordPress plugin in less time.
 * Version: 1.0.0
 * Requires at least: 6.3
 * Requires PHP: 8.0.27
 * Author: Omid Hosseini
 * Author URI: https://omidhosseini.info
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://github.com/web-dev-prjs/wp-plugin-starter
 * Text Domain: wp-plugin-starter
 * Domain Path: /language
 */

// Security Note: Blocks direct access to the PHP files.
defined( 'ABSPATH' ) || exit;

const PLUGIN_FILE = __FILE__;

define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

require_once __DIR__ . '/init.php';
