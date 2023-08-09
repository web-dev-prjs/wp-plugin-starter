<?php

/**
 * Checks the plugin updates.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use Puc_v4_Factory;

/**
 * UpdateChecker class.
 *
 * @since 1.0.0
 */
final class UpdateChecker {

	/**
	 * Register the "update_checker" method.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void {

		$this->update_checker();
	}

	/**
	 * Handle checking the plugin updates.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function update_checker(): void {

		// Invoke update checker library.
		if ( ! class_exists( 'Puc_v4_Factory' ) ) {
			require_once PLUGIN_PATH . 'update-checker/update-checker.php';

			$base_URL     = 'https://web-dev-prjs.com';
			$details_path = 'wp-update-details/plugins/wp-plugin-starter';
			$data_file    = 'details.php';

			Puc_v4_Factory::buildUpdateChecker(
				$base_URL . DIRECTORY_SEPARATOR . $details_path . DIRECTORY_SEPARATOR . $data_file,
				PLUGIN_FILE,
				PLUGIN_DOMAIN
			);
		}
	}
}
