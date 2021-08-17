<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase.
/**
 * Activate class
 *
 * @package    wpPluginStarter
 * @category   class
 * @author     webbmakerr
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, webbmakerr.
 */

namespace Inc\Base;

/**
 * The Activate class
 */
class Activate {

	/**
	 * The __construct function
	 *
	 * @return void
	 */
	public function __construct() {

		\add_action( 'wps_notices', array( $this, 'notice' ) );
	}

	/**
	 * The notice function
	 *
	 * @return void
	 */
	public function notice() {

		$screen = get_current_screen();
		$slug   = 'wp-plugin-starter';

		if ( 'toplevel_page_' . $slug !== $screen->id ) :
			return;
		endif;

		$class   = 'notice notice-success is-dismissible';
		$message = 'Hora! now, you see TP icon in left sidebar of dashboard.';
		\printf(
			'<div class="%s"><p>%s</p></div>',
			\esc_attr( $class ),
			\esc_attr( $message )
		);
	}

	/**
	 * The activate function
	 *
	 * @return void
	 */
	public static function activate() {

		\flush_rewrite_rules();
	}
}
