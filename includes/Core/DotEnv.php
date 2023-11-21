<?php

/**
 * Retrieves the plugin ENV-file content.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

/**
 * DotEnv class.
 *
 * @since 1.0.0
 */
final class DotEnv {

	/**
	 * Defines the plugin directory.
	 *
	 * @var string
	 */
	private string $path;

	/**
	 * Defines the ".env" file.
	 *
	 * @var string
	 */
	private string $base = PLUGIN_ENV_FILE;

	/**
	 * Builds actions of this class in while the plugin will activate.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function build(): void {

		$this->path = $this->path_generator();
		$this->environment_load();
	}

	/**
	 * The directory where the .env file can be located and create the ".env" path in security way.
	 *
	 * @return string The ".env" file path
	 * @since 1.0.0
	 */
	private function path_generator(): string {

		$route = PLUGIN_PATH . $this->base;

		if ( ! file_exists( $route ) ) {
			die( sprintf( '"%s" does not exist', $route ) );
		}

		return $route;
	}

	/**
	 * Check if the path is readable and put information of ".env" file in environment-store.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function environment_load(): void {

		if ( ! is_readable( $this->path ) ) {
			die( sprintf( '"%s" file is not readable', $this->path ) );
		}

		$lines = file( $this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );

		foreach ( $lines as $line ) {
			preg_match( '/#/', trim( $line ), $matches );

			if ( $matches && $matches[0] ) {
				continue;
			}

			[ $name, $value ] = explode( '=', $line, 2 );
			$name  = trim( $name );
			$value = trim( $value );

			if (
				! array_key_exists( $name, $_SERVER )
				&&
				! array_key_exists( $name, $_ENV )
			) {
				putenv( sprintf( '%s=%s', $name, $value ) );
			}
		}
	}
}
