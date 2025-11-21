<?php

/**
 * Enqueues styles and scripts.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use Exception;
use WP_Error;
use WPS\Utilities\Helper;

/**
 * Enqueue class.
 *
 * @since 1.0.0
 */
final class Enqueue {

	/**
	 * Builds actions of this class in while the plugin will activate.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function build(): void {

		// Hooks all backend (admin) styles and scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
	}

	/**
	 * Enqueue all our scripts inside admin dashboard.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function admin_enqueue(): void {

		$enqueues = [
			/*
			 |-----------------------------------
			 | All stylesheets of plugin.
			 |-----------------------------------
			 */
			'style'  => [
				// Bootstrap styles.
				'admin-npm-bootstrap'   => [
					'this_plugin' => false,
					'enqueue'     => false,
					'version'     => '5.3.0',
					'screen'      => [],
					'url'         => PLUGIN_URL . 'node_modules/bootstrap/dist/css/bootstrap.min.css'
				],
				// Fontawesome styles.
				'admin-npm-fontawesome' => [
					'this_plugin' => false,
					'enqueue'     => false,
					'version'     => '6.3.0',
					'screen'      => [],
					'url'         => PLUGIN_URL . 'node_modules/@fortawesome/fontawesome-free/css/all.min.css'
				],
				// Plugin styles.
				'admin'                 => [
					'this_plugin' => true,
					'enqueue'     => true,
					'screen'      => [],
					'filename'    => 'styles.admin.css',
					'dependency'  => [
						PLUGIN_PREFIX . '-admin-npm-bootstrap',
						PLUGIN_PREFIX . '-admin-npm-fontawesome',
					]
				],
				// Additional styles go here.
			],

			/*
			 |-----------------------------------
			 | All scripts of plugin.
			 |-----------------------------------
			 */
			'script' => [
				// Bootstrap scripts.
				'admin-npm-bootstrap'        => [
					'this_plugin' => false,
					'enqueue'     => false,
					'version'     => '5.3.0',
					'screen'      => [],
					'url'         => PLUGIN_URL . 'node_modules/bootstrap/dist/js/bootstrap.min.js'
				],
				// Bootstrap bundle scripts.
				'admin-npm-bootstrap-bundle' => [
					'this_plugin' => false,
					'enqueue'     => false,
					'version'     => '5.3.0',
					'screen'      => [],
					'url'         => PLUGIN_URL . 'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
				],
				// Plugin scripts.
				'admin'                      => [
					'this_plugin' => true,
					'enqueue'     => true,
					'screen'      => [],
					'filename'    => 'scripts.admin.js',
					'dependency'  => [
						'jquery',
						PLUGIN_PREFIX . '-admin-npm-bootstrap',
						PLUGIN_PREFIX . '-admin-npm-bootstrap-bundle',
					],
					'in_footer'   => true
				],
				// Additional scripts go here.
			]
		];

		self::enqueue_generator( $enqueues );
	}

	/**
	 * Generates stylesheet/script.
	 *
	 * @see   wp_register_style(), wp_enqueue_style(), wp_register_script(), wp_enqueue_script()
	 *
	 * @param array $enqueues An array of stylesheet and scripts. Includes =>
	 *                        Type: string $handle Name of the stylesheet/script, it Should be unique.
	 *                        Type: string $filename Path of the stylesheet relative to the plugin assets directory.
	 *                        Type: array $dependency An array of registered stylesheet/script handles this stylesheet/script depends on.
	 *                        Type: string $version String specifying script version number.
	 *                        Type: string $media The media for which this stylesheet has been defined.
	 *                        Type: string $in_footer Whether to enqueue the script before the body tag closes.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private static function enqueue_generator( array $enqueues ): void {

		try {
			foreach ( $enqueues as $type => $enqueue ) {
				foreach ( $enqueue as $handle => $param ) {
					$handle = PLUGIN_PREFIX . "-$handle";

					switch ( $type ) {
						case 'style':
							wp_register_style(
								$handle,
								$param['url'] ?? PLUGIN_ASSETS . "css/{$param['filename']}",
								$param['dependency'] ?? [],
								$param['version'] ?? PLUGIN_VERSION,
								$param['media'] ?? 'all',
							);

							if ( $param['enqueue'] &&
								( $param['this_plugin'] === Helper::this_plugin() ||
								in_array( get_current_screen()->id, $param['screen'] ) )
							) {
								wp_enqueue_style( $handle );
							}

							break;

						case
						'script':
							wp_register_script(
								$handle,
								$param['url'] ?? PLUGIN_ASSETS . "js/{$param['filename']}",
								$param['dependency'] ?? [],
								$param['version'] ?? PLUGIN_VERSION,
								$param['in_footer'] ?? false,
							);

							if ( $param['enqueue'] &&
								( $param['this_plugin'] === Helper::this_plugin() ||
								in_array( get_current_screen()->id, $param['screen'] ) )
							) {
								wp_enqueue_script( $handle );
							}

							break;
					}
				}
			}
		} catch ( Exception $e ) {
			new WP_Error( $e->getCode(), $e->getMessage() );
		}
	}
}
