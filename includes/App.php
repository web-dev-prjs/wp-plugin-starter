<?php

/**
 * Initializes the whole of the plugin.
 *
 * @package wp-plugin-starter
 */

namespace WPS;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use WPS\Core\Notice;
use function DI\create;

/**
 * App class.
 *
 * @since 1.0.0
 */
final class App {

	/**
	 * Builds the whole services of the plugin.
	 *
	 * @param array $services
	 *
	 * @since 1.0.0
	 */
	public function build( array $services ): void {

		App::register_services( $services );
	}

	/**
	 * Loop through the classes, initialize them, and call the register() method if it exists.
	 *
	 * @param array $services
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private static function register_services( array $services ): void {

		$container = new Container();

		foreach ( $services as $tag => $service ) {
			try {
				if ( ! class_exists( $service ) ) {
					throw new NotFoundException(
						"The \"$service\" does not exist, please check the \"Services\" folder!",
						404
					);
				} else {
					$container->set( $tag, create( $service ) );
					$container->get( $tag )->register();
				}
			} catch ( DependencyException|NotFoundException $e ) {
				Notice::custom_admin_notice( 'error', $e->getCode(), $e->getMessage() );
			}
		}
	}
}
