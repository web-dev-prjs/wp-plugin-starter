<?php

/**
 * Defines the custom notices of the plugin.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

/**
 * Notices class.
 *
 * @since 1.0.0
 */
final class Notice {

	/**
	 * Trigger a notification when an action is done.
	 *
	 * @param string $class   The CSS class name of the notice.
	 * @param int    $code    The code to be noticed.
	 * @param string $message The message to be noticed.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function custom_admin_notice( string $class, int $code, string $message ): void {

		add_action(
			'admin_notices',
			function () use ( $class, $code, $message ) {
				self::custom_admin_notice_template( $class, "$message , ( Code: $code )" );
			},
			100,
			0
		);
	}

	/**
	 * Represent a notice in the html format.
	 *
	 * @param string $class  The CSS class name of the notice.
	 * @param string $phrase The message to be noticed.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private static function custom_admin_notice_template( string $class, string $phrase ): void {

		$html = '<div class="%1$s"><p><strong>%2$s</strong></p></div>';

		printf(
			$html,
			esc_attr( "notice notice-$class settings-error is-dismissible" ),
			esc_html( $phrase ),
		);
	}

	/**
	 * Trigger when the "autoload.php" file does not exist.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function autoload_error(): void {

		$class = 'notice notice-error is-dismissible';

		$message = esc_html__( 'The', PLUGIN_DOMAIN );
		$message .= ' <b>' . __( '"WP Plugin Starter (WPS)"', PLUGIN_DOMAIN ) . '</b> ';
		$message .= __( 'plugin requires to autoload file.', PLUGIN_DOMAIN );
		$message .= '&nbsp';
		$message .= __( 'Please run the following commands in the plugin directory:', PLUGIN_DOMAIN );

		$manual = '<li>';
		$manual .= __( 'Run this command in terminal:', PLUGIN_DOMAIN );
		$manual .= ' <b>"composer init"</b></li>';
		$manual .= '<li>';
		$manual .= __( 'Add the', PLUGIN_DOMAIN );
		$manual .= ' <b>"psr-4"</b>';
		$manual .= __( 'to the', PLUGIN_DOMAIN );
		$manual .= ' <b>composer.json</b> ';
		$manual .= __( 'file in the plugin directory (as follow):', PLUGIN_DOMAIN );
		$manual .= '</li>';
		$manual .= '<b>"autoload": {<br />';
		$manual .= '&nbsp;&nbsp;"psr-4": {<br />';
		$manual .= '&nbsp;&nbsp;&nbsp;&nbsp;"' . strtoupper( PLUGIN_PREFIX ) . '\\": "./includes"<br />';
		$manual .= '&nbsp;&nbsp;}<br />';
		$manual .= '}</b>';
		$manual .= '<li>';
		$manual .= __( 'Then run this command in terminal:', PLUGIN_DOMAIN );
		$manual .= ' <b>"composer install"</b></li>';

		printf(
			'<div class="%1$s"><p>%2$s</p><ol>%3$s</ol></div>',
			$class,
			$message,
			$manual,
		);
	}

	/**
	 * Trigger when the "includes" folder or the "Init.php" file does not exist.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function initializer_error(): void {

		$class = 'notice notice-error is-dismissible';

		$message = __( 'Something is wrong on the', PLUGIN_DOMAIN );
		$message .= ' <b>' . __( '"WP Plugin Starter (WPS)"', PLUGIN_DOMAIN ) . '</b> ';
		$message .= __( 'activation. Please sure the', PLUGIN_DOMAIN );
		$message .= ' <b>"includes"</b> ';
		$message .= __( 'folder and', PLUGIN_DOMAIN );
		$message .= ' <b>"App.php"</b> ';
		$message .= __( 'file exist in the plugin directory.', PLUGIN_DOMAIN );

		printf(
			'<div class="%1$s"><p>%2$s</p></div>',
			$class,
			$message,
		);
	}
}
