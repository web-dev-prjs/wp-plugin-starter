<?php

/**
 * Defines options of the plugin to manage it.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core\Settings;

use stdClass;
use WPS\Core\TwigTemplate;

/**
 * Page trait.
 *
 * @since 1.0.0
 */
trait Page {

	/**
	 * Makes a stdClass of the general plugin main-pages, and subpages.
	 *
	 * @return object
	 * @since 1.0.0
	 */
	protected function add_pages(): object {

		$pages = new stdClass();

		$default_pages = [
			/*
			 |----------------------------------
			 | Default plugin main-pages.
			 |----------------------------------
			 */
			'main_pages'   => [// New main-pages go here...
				[
					'page_title' => 'Dashboard',
					'menu_title' => PLUGIN_NAME,
					'capability' => 'manage_options',
					'menu_slug'  => 'dashboard',
					'callback'   => function () {

						/**
						 * @var TwigTemplate $twig_template
						 */
						global $twig_template;

						print $twig_template
							->with_template( 'admin.pages.dashboard' )
							->with_context( array(
								'fa_icon' => 'fa-tachometer-alt',
								'data'    => array(
									'text_button'   => 'Update',
									'settings_form' => 'dashboard'
								)
							) )->template_render();
					},
					'icon_url'   => 'dashicons-admin-generic',
					'position'   => 110
				]
			],
			/*
			 |----------------------------------
			 | Default plugin sub-pages.
			 |----------------------------------
			 */
			'sub_pages'    => [// New subpages go here...
			],
			/*
			 |----------------------------------
			 | Default plugin sub-pages.
			 |----------------------------------
			 */
			'option_pages' => [// New option-pages go here...
			]
		];

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
