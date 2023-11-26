<?php

/**
 * Sample Service.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Services\Controllers;

use WPS\Core\Abstracts\AbstractService;
use WPS\Services\Callbacks\SampleServiceCallback;

/**
 * SampleService class.
 *
 * @since 1.0.0
 */
final class SampleService extends AbstractService {

	use SampleServiceCallback;

	protected function register(): void {

		// Codes go here...
	}

	protected array $service_main_pages = array(
		'sample_page' => array(
			'position'         => 111,
			'page_title'       => 'Sample Page',
			'menu_title'       => 'Sample Page',
			'capability'       => 'manage_options',
			'icon_url'         => 'dashicons-book-alt',
			'template_name'    => 'admin.pages.sample-page',
			'template_context' => array(
				'fa_icon' => 'fa-book',
				'link'    => 'https://php.net',
				'caption' => 'PHP Docs.'
			)
		)
	);

	protected array $service_sub_pages = array(
		'sample_service' => array(
			'position'         => 1,
			'parent_slug'      => 'dashboard',
			'sub_page_title'   => 'Sample Service',
			'menu_title'       => 'Sample Service',
			'capability'       => 'manage_options',
			'template_name'    => 'admin.pages.sample-service',
			'template_context' => array(
				'fa_icon' => 'fa-toolbox'
			)
		)
	);

	protected array $service_sections = array(
		'section_one' => array(
			'title' => 'Section One',
			'class' => 'text-dark py-2',
		)
	);

	protected array $service_fields = array(
		'field_one' => array(
			'type'         => 'text',
			'section_id'   => 'section_one',
			'title'        => 'Field One:',
			'place_holder' => 'Enter your option name!',
			'class'        => 'p-2',
		)
	);
}
