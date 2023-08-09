<?php

/**
 * Defines the pages and sub-pages of the plugin.
 *
 * @package wp-plugin-starter
 */

const PLUGIN_PAGES = array(
	/*
	 |-----------------------------------------------------------
	 | Additional main-pages based on the below structure:
	 |
	 | array(
	 |     'position'   => ,
	 |     'page_slug'  => '',
	 |     'page_title' => '',
	 |     'menu_title' => '',
	 |     'icon_url'   => '',
	 |     'callback'   => function () {
	 |         Helper::get_template( 'admin', '', 'view' );
	 |     }
	 | )
	 |-----------------------------------------------------------
	 */
	'main_pages' => array(// The new main-pages go here...
	),
	/*
	 |-----------------------------------------------------------
	 | Additional sub-pages based on the below structure:
	 |
	 | array(
	 |     'position'       => ,
	 |     'parent_slug'    => '',
	 |     'sub_page_slug'  => '',
	 |     'sub_page_title' => '',
	 |     'menu_title'     => '',
	 |     'callback'       => function () {
	 |         Helper::get_template( 'admin', '', 'view' );
	 |     }
	 | )
	 |-----------------------------------------------------------
	 */
	'sub_pages'  => array(// The new sub-pages go here...
	)
);
