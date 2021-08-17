<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase.
/**
 * Initialize class
 *
 * @package    wpPluginStarter
 * @category   class
 * @author     webbmakerr
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, webbmakerr.
 */

namespace Inc;

/**
 * The Init class
 */
final class Init {

	/**
	 * The get_services function
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {

		return array(
			Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,
		);
	}

	/**
	 * The instantiate function
	 * Initialize the class
	 *
	 * @param class $class    The class name from the services array.
	 * @return class instance New instance of the class
	 */
	private static function instantiate( $class ) {

		return new $class();
	}

	/**
	 * The register_services function
	 * Loop through the classes, initialize them, and call the register() method if it exists.
	 *
	 * @return void
	 */
	public static function register_services() {

		foreach ( self::get_services() as $class ) :

			$service = self::instantiate( $class );
			if ( \method_exists( $service, 'register' ) ) :
				$service->register();
			endif;
		endforeach;
	}

}
