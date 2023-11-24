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
use WPS\Core\ActionLink;
use WPS\Core\Dashboard;
use WPS\Core\DotEnv;
use WPS\Core\Enqueue;
use WPS\Core\Notice;
use WPS\Core\ServiceSlug;
use WPS\Core\TwigTemplate;
use WPS\Core\UpdateChecker;
use function DI\create;

/**
 * App class.
 *
 * @since 1.0.0
 */
final class App {

	/**
	 * Runs the whole modules of the plugin.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function run(): void {

		$base_modules = apply_filters( PLUGIN_PREFIX . '_base_modules_endpoint', array(
			/*
			 |-------------------------------------------------------------------------
			 | Base configs, For setting up this plugin.
			 |-------------------------------------------------------------------------
			 */
			'dot_env'         => DotEnv::class,
			'enqueue'         => Enqueue::class,
			'action_link'     => ActionLink::class,
			'twig_template'   => TwigTemplate::class,
			'update_checker'  => UpdateChecker::class,

			/*
			 |-------------------------------------------------------------------------
			 | Admin configs, For implement admin dashboard of plugin.
			 |-------------------------------------------------------------------------
			 */
			'admin_dashboard' => Dashboard::class,
		) );

		App::register_modules(
			array_merge( $base_modules, ( new ServiceSlug() )->slugs )
		);
	}

	/**
	 * Loop through the classes, initialize them, and call the build method if it exists.
	 *
	 * @param array $modules
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private static function register_modules( array $modules ): void {

		$container = new Container();

		foreach ( $modules as $tag => $module ) {
			try {
				if ( ! class_exists( $module ) ) {
					throw new NotFoundException(
						"Something went wrong, The \"$module\" does not exist.",
						404
					);
				} else {
					$container->set( $tag, create( $module ) );
					$container->get( $tag )->build();
				}
			} catch ( DependencyException|NotFoundException $e ) {
				Notice::custom_admin_notice( 'error', $e->getCode(), $e->getMessage() );
			}
		}
	}
}
