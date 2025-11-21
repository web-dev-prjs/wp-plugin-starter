<?php

/**
 * Defines the setting links of the plugin in the plugin page.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

/**
 * ActionLink class.
 *
 * @since 1.0.0
 */
final class ActionLink {

	/**
	 * Builds the settings links plugin.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function Build(): void {

		add_filter( "plugin_action_links_" . PLUGIN_BASENAME, [ $this, 'action_links' ] );
	}

	/**
	 * Add custom links to a plugin links array.
	 *
	 * @param array $links The list of plugin links array.
	 *
	 * @return array List of a link array.
	 * @since 1.0.0
	 */
	public function action_links( array $links ): array {

		$action_links = '<a href="plugin-editor.php?plugin=';
		$action_links .= PLUGIN_BASENAME . '&Submit=Select';
		$action_links .= '" style="color: chocolate;">';
		$action_links .= esc_html__( 'Edit', PLUGIN_DOMAIN ) . '</a> | ';
		$action_links .= '<a href="admin.php?page=';
		$action_links .= PLUGIN_PREFIX . '_dashboard" style="color: forestgreen;">';
		$action_links .= esc_html__( 'Settings', PLUGIN_DOMAIN ) . '</a>';

		array_unshift( $links, $action_links );

		return $links;
	}
}
