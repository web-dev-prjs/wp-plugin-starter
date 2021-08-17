<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase.
/**
 * BaseController class
 *
 * @package    wpPluginStarter
 * @category   class
 * @author     webbmakerr
 * @since      1.0.0
 * @copyright  Copyright (c) 2021, webbmakerr.
 */

namespace Inc\Base;

/**
 * The BaseController class
 */
class BaseController {

	/**
	 * The plugin data variable
	 *
	 * @var array
	 */
	public $plugin_data;

	/**
	 * The plugin name variable
	 *
	 * @var string
	 */
	public $plugin_name;

	/**
	 * The plugin version variable
	 *
	 * @var string
	 */
	public $plugin_version;

	/**
	 * The plugin domain variable
	 *
	 * @var string
	 */
	public $plugin_domain;

	/**
	 * The plugin base variable
	 * Include folder and file name.
	 *
	 * @var string
	 */
	public $plugin_base;

	/**
	 * The plugin path variable
	 *
	 * @var string
	 */
	public $plugin_path;

	/**
	 * The plugin URL variable
	 *
	 * @var string
	 */
	public $plugin_url;

	/**
	 * The plugin assets variable
	 *
	 * @var string
	 */
	public $plugin_assets;

	/**
	 * The __construct function
	 *
	 * @return void
	 */
	public function __construct() {

		// Get all data plugin.
		$this->plugin_data = \get_plugins()['wp-plugin-starter/wp-plugin-starter.php'];
		// Define plugin name.
		$this->plugin_name = $this->plugin_data['Name'];
		// Define plugin version.
		$this->plugin_version = $this->plugin_data['Version'];
		// Define plugin domain.
		$this->plugin_domain = $this->plugin_data['TextDomain'];

		// Define plugin base, include folder name and file name.
		$this->plugin_base = \plugin_basename( \dirname( __FILE__, 3 ) ) . '/' . $this->plugin_domain . '.php';
		// Define plugin path.
		$this->plugin_path = \plugin_dir_path( \dirname( __FILE__, 2 ) );
		// Define plugin url.
		$this->plugin_url = \plugin_dir_url( \dirname( __FILE__, 2 ) );
		// Define plugin assets url.
		$this->plugin_assets = $this->plugin_url . 'assets/';
	}
}
