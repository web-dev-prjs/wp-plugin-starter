<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase.
/**
 * Enqueue class
 *
 * @package    wpPluginStarter
 * @category   class
 * @author     webbmakerr
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, webbmakerr.
 */

namespace Inc\Base;

/**
 * The Enqueue class
 */
class Enqueue extends \Inc\Base\BaseController {

	/**
	 * The register function
	 *
	 * @return void
	 */
	public function register() {

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * The enqueue function
	 * Enqueue all our scripts.
	 *
	 * @return void
	 */
	public function enqueue() {

		// styles.
		\wp_register_style( 'wps_styles', $this->plugin_assets . 'css/styles.css', array(), $this->plugin_version, 'all' );
		\wp_enqueue_style( 'wps-styles' );

		// scripts.
		\wp_register_script( 'wps_scripts', $this->plugin_assets . 'js/scripts.js', array(), $this->plugin_version, true );
		\wp_enqueue_script( 'wps-scripts' );
	}
}
