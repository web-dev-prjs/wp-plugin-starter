<?php

/**
 * Defines the pages, sub-pages and option-pages of the plugin.
 *
 * @package wp-plugin-starter
 */

const PLUGIN_PAGES = [
	/*
	 |-----------------------------------------------------------
	 | Additional main-pages based on the below structure:
	 |
	 | [
	 |     'position'   => 100,
	 |     'page_slug'  => '',
	 |     'page_title' => '',
	 |     'capability' => '',
	 |     'menu_title' => '',
	 |     'icon_url'   => '',
	 |     'callback'   => function () {
	 |
	 |		    global $twig_template;
	 |
	 |		    print $twig_template
	 |			    ->with_template( 'template_name' )
	 |				->with_context( 'context' )
	 |				->template_render();
	 |	   }
	 | ]
	 |-----------------------------------------------------------
	 */
	'main_pages'   => [// The new main-pages go here...
	],
	/*
	 |-----------------------------------------------------------
	 | Additional sub-pages based on the below structure:
	 |
	 | [
	 |     'position'       => 100,
	 |     'parent_slug'    => '',
	 |     'sub_page_slug'  => '',
	 |     'sub_page_title' => '',
	 |     'menu_title'     => '',
	 |     'capability'     => '',
	 |     'callback'   => function () {
	 |
	 |		    global $twig_template;
	 |
	 |		    print $twig_template
	 |			    ->with_template( 'template_name' )
	 |				->with_context( 'context' )
	 |				->template_render();
	 |	   }
	 | ]
	 |-----------------------------------------------------------
	 */
	'sub_pages'    => [// The new sub-pages go here...
	],
	/*
	 |-----------------------------------------------------------
	 | Additional option-pages based on the below structure:
	 |
	 | [
	 |     'position'   => 100,
	 |     'page_title' => '',
	 |     'menu_title' => '',
	 |     'menu_slug'   => '',
	 |     'capability' => '',
	 |     'callback'   => function () {
	 |
	 |		    global $twig_template;
	 |
	 |		    print $twig_template
	 |			    ->with_template( 'template_name' )
	 |				->with_context( 'context' )
	 |				->template_render();
	 |	   }
	 | ]
	 |-----------------------------------------------------------
	 */
	'option_pages' => [// The new option-pages go here...
	]
];
