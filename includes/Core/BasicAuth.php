<?php

/**
 * Checks the REST-API request authentication.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use WP_REST_Response;

/**
 * BasicAuth class.
 *
 * @since 1.0.0
 */
final class BasicAuth {

	/**
	 * Wraps a function to checking authentication.
	 *
	 * @param $callback
	 *
	 * @return array|WP_REST_Response
	 * @since 1.0.0
	 */
	public static function wrap_in_basic_auth( $callback ): array|WP_REST_Response {

		return BasicAuth::basic_authentication( $callback );
	}

	/**
	 * Makes basic authentication for use in APIs.
	 *
	 * @param null $_function
	 *
	 * @return array|WP_REST_Response Response of authenticating.
	 * @since 1.0.0
	 */
	private static function basic_authentication( $_function ): array|WP_REST_Response {

		if ( ! isset( $_SERVER['PHP_AUTH_USER'] ) ) {
			header( 'WWW-Authenticate: Basic realm=Private Area' );
			header( 'HTTP/1.0 401 Unauthorized' );

			$result = [
				"code"    => "rest_forbidden",
				"message" => "Sorry, you need proper authentication.",
				"data"    => [
					"status" => 401
				]
			];
		} else {
			if (
				getenv( strtoupper( PLUGIN_PREFIX ) . '_CONSUMER_KEY' ) === $_SERVER['PHP_AUTH_USER']
				&&
				getenv( strtoupper( PLUGIN_PREFIX ) . '_CONSUMER_SECRET' ) === $_SERVER['PHP_AUTH_PW']
			) {
				$result = $_function;
			} else {
				header( 'WWW-Authenticate: Basic realm=Private Area' );
				header( 'HTTP/1.0 401 Unauthorized' );

				$result = [
					"code"    => "rest_forbidden",
					"message" => "Sorry, you are not allowed to do that.",
					"data"    => [
						"status" => 403
					]
				];
			}
		}

		return $result;
	}
}
