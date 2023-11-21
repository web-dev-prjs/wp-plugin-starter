<?php

/**
 * Defines the plugin const variables.
 *
 * @package wp-plugin-starter
 */

if ( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$plugin_data = get_plugins()[ PLUGIN_BASENAME ]; // Get all data plugin.

define( "PLUGIN_NAME", $plugin_data['Name'] ); // Define plugin name.
define( "PLUGIN_VERSION", $plugin_data['Version'] ); // Define plugin version.
define( "PLUGIN_DOMAIN", $plugin_data['TextDomain'] ); // Define plugin domain.

const PLUGIN_ENV_FILE   = '.env-example'; // Define the plugin ENV-file name.
const PLUGIN_HIDE_LOGIN = 'adminGate'; // Define plugin feature for hide default login path.

const PLUGIN_PREFIX         = 'wps'; // Define plugin prefix.
const TWIG_TEMPLATE_SUFFIX  = 'html.twig'; // Define Twig-template suffix.
const OPTION_SECTION_SUFFIX = 'section'; // The option section suffix.
const OPTION_GROUP_SUFFIX   = 'option_group'; // The option group suffix.
const WITH_SUBPAGE          = 'General'; // Define the plugin dashboard sub-page title.
const PLUGIN_ALL_OPTIONS    = PLUGIN_PREFIX . '_plugin_all_options'; // Define plugin prefix.

define( "PLUGIN_NAMESPACE", strtoupper( PLUGIN_PREFIX ) . '\\' ); // Define plugin namespace.

const PLUGIN_ASSETS    = PLUGIN_URL . 'assets/'; // Define plugin assets url.
const PLUGIN_INCLUDES  = PLUGIN_PATH . 'includes/'; // Define a plugin includes-folder path.
const PLUGIN_TEMPLATES = PLUGIN_PATH . 'templates/'; // Define a plugin templates-folder path.
const PLUGIN_TEMPORARY = PLUGIN_PATH . 'temporary/'; // Define a plugin temporary-folder path.
