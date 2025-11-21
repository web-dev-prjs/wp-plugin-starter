<?php

/**
 * Creates an array of the service-slugs from /Services/Controllers folder.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use WPS\Utilities\Helper;

/**
 * ServiceSlug class.
 *
 * @since 1.0.0
 */
final class ServiceKey {

	/**
	 * A list of service keys based-on /Services/Controllers folder.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	public array $keys;

	/**
	 * Returns a service-slugs list on call this class.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->get_service_keys();
	}

	/**
	 * Gets service-slugs based-on /Services/Controllers folder,
	 * and save into slugs variable after create every key from filename
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function get_service_keys(): void {

		if ( is_null( $filenames = $this->fetch_service_filenames() ) ) {
			return;
		}

		foreach ( $filenames as $filename ) {
			$key     = Helper::make_service_key( $filename );
			$service = new ( "\WPS\Services\Controllers\\$filename" );

			$this->keys[ $key ] = $service::class;
		}
	}

	/**
	 * Fetches the filename of services from /Services/Controllers, and returns an array of filenames.
	 *
	 * @return null|array An array of filenames based-on /Services/Controllers folder.
	 * @since 1.0.0
	 */
	private function fetch_service_filenames(): null|array {

		$controllers_path = PLUGIN_INCLUDES . 'Services/Controllers/';

		if ( ! sizeof( $files = glob( $controllers_path . '*' ) ) ) {
			return null;
		}

		$controllers = [];

		foreach ( $files as $file ) {
			if (
				! is_dir( $controllers_path . $file )
				&&
				preg_match( '/[.]php/', $file )
			) {
				$controllers[] = preg_replace(
					'/[.]\w*/',
					'',
					basename( $file )
				);
			}
		}

		return $controllers;
	}
}
