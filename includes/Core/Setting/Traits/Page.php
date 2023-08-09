<?php

/**
 * Defines options of the plugin to manage it.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core\Setting\Traits;

use stdClass;
use WPS\Helper;

/**
 * Page trait.
 *
 * @since 1.0.0
 */
trait Page {

	/**
	 * Makes a stdClass of the general plugin main-pages, and sub-pages.
	 *
	 * @return object
	 * @since 1.0.0
	 */
	protected function add_pages(): object {

		$pages = new stdClass();

		$default_pages = array(
			/*
			 |----------------------------------
			 | Default plugin main-pages.
			 |----------------------------------
			 */
			'main_pages' => array(// New main-pages go here...
				array(
					'page_title' => 'Dashboard',
					'menu_title' => PLUGIN_NAME,
					'capability' => 'manage_options',
					'menu_slug'  => 'dashboard',
					'callback'   => function () {
						Helper::get_template( 'admin', 'dashboard', 'view' );
					},
					'icon_url'   => 'dashicons-admin-generic',
					'position'   => 110,
				)
			),
			/*
			 |----------------------------------
			 | Default plugin sub-pages.
			 |----------------------------------
			 */
			'sub_pages'  => array(// New sub-pages go here...
			)
		);

		/*
		 |---------------------------------------------------------------------
		 | Merges additional main-pages or sub-pages with default type pages.
		 |---------------------------------------------------------------------
		 */
		foreach ( $default_pages as $key => $value ) {
			$pages->{$key} = array_merge( $value, PLUGIN_PAGES[ $key ] );
		}

		return $pages;
	}
}
