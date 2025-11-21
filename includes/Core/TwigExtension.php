<?php

/**
 * Adds custom Twig global-variables and custom-functions.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * TwigExtension class.
 *
 * @since 1.0.0
 */
final class TwigExtension extends AbstractExtension {

	/**
	 * Twig environment.
	 *
	 * @var Environment
	 * @since 1.0.0
	 */
	private static Environment $env;

	/**
	 * Twig global variables.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	private static array $variables;

	/**
	 * Builds global-variables and custom-functions based-on an environment.
	 *
	 * @param Environment $environment Twig environment.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public static function build( Environment $environment ): void {

		TwigExtension::$env = $environment;

		TwigExtension::add_global_variables();

		TwigExtension::add_custom_functions();
	}

	/*
	 |-----------------------------------------------------
	 | Custom functions section.
	 |-----------------------------------------------------
	 */

	/**
	 * Adds custom functions to specific environment.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private static function add_custom_functions(): void {

		$custom_functions_list = TwigExtension::set_custom_functions();

		if ( is_null( $custom_functions_list ) ) {
			return;
		}

		foreach ( $custom_functions_list as $custom_function ) {
			TwigExtension::$env->addFunction( $custom_function );
		}
	}

	/**
	 * Sets custom-functions based-on custom-functions list.
	 *
	 * @return null|array Returns an array of custom-function methods,
	 *                    if custom-function-slugs be empty, returns null.
	 * @since 1.0.0
	 */
	private static function set_custom_functions(): null|array {

		$custom_function_slugs = TwigExtension::custom_function_slugs();

		if ( ! sizeof( $custom_function_slugs ) ) {
			return null;
		}

		$custom_functions = [];

		foreach ( $custom_function_slugs as $custom_function_slug ) {
			$custom_functions[] = TwigExtension::create_custom_function(
				$custom_function_slug
			);
		}

		return $custom_functions;
	}

	/**
	 * Creates custom-function based-on function name.
	 *
	 * @param string $function_name The function name (slug).
	 *
	 * @return TwigFunction Returns an object from methods list based on them name.
	 * @since 1.0.0
	 */
	private static function create_custom_function( string $function_name ): TwigFunction {

		return new TwigFunction(
			$function_name,
			function ( array $data ) use ( $function_name ) {

				return \WPS\Utilities\TwigFunction::$function_name( $data );
			}
		);
	}

	/**
	 * Returns an array of custom-functions,
	 * by default returns every method from \Utilities\TwigFunction class.
	 *
	 * @return array An array of custom-functions slugs.
	 * @since 1.0.0
	 */
	private static function custom_function_slugs(): array {

		return apply_filters(
			PLUGIN_PREFIX . '_twig_custom_functions_list_endpoint',
			get_class_methods( \WPS\Utilities\TwigFunction::class )
		);
	}

	/*
	 |-----------------------------------------------------
	 | Global variables section.
	 |-----------------------------------------------------
	 */

	/**
	 * Adds global-variables based-on specific environment.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private static function add_global_variables(): void {

		TwigExtension::set_global_variables();

		foreach ( TwigExtension::$variables as $key => $variable ) {
			TwigExtension::$env->addGlobal( $key, $variable );
		}
	}

	/**
	 * Sets global-variables.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private static function set_global_variables(): void {

		TwigExtension::$variables = apply_filters(
			PLUGIN_PREFIX . '_twig_global_variables_list_endpoint',
			[
				'client_page_title' => get_the_title(),
				'admin_page_title'  => get_admin_page_title(),
				'plugin_version'    => 'v' . PLUGIN_VERSION
			]
		);
	}
}
