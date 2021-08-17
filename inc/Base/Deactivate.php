<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase.
/**
 * Deactivate class
 *
 * @package    wpPluginStarter
 * @category   class
 * @author     webbmakerr
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, webbmakerr.
 */

namespace Inc\Base;

/**
 * The Deactivate class
 */
class Deactivate {

	/**
	 * The deactivate function
	 *
	 * @return void
	 */
	public static function deactivate() {

		\flush_rewrite_rules();
	}
}
