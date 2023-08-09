<?php

/**
 * Sample Service.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Controller\Services;

use WPS\Controller\Services\Abstracts\Service;
use WPS\Helper;

/**
 * ServiceOne class.
 *
 * @since 1.0.0
 */
class SampleService extends Service {

	protected string $service_slug = 'sample_service';

	protected function handle_service_pages(): void {

		$this->with_main_pages(
			array(
				'page_title' => 'Books',
				'menu_title' => 'Books',
				'capability' => 'manage_options',
				'menu_slug'  => 'books',
				'callback'   => function () {
					// Helper::get_template( 'admin', 'dashboard', 'view' );
					echo '<h3 class="mt-5">The books main-page</h3>';
				},
				'icon_url'   => 'dashicons-book-alt',
				'position'   => 111,
			)
		)->with_sub_pages(
			array(
				'position'       => 1,
				'parent_slug'    => 'dashboard',
				'sub_page_slug'  => 'sample_service',
				'sub_page_title' => 'Sample Service',
				'menu_title'     => 'Sample Service',
				'callback'       => function () {
					Helper::get_template( 'admin', 'sample-service', 'view' );
				}
			)
		);
	}

	protected function handle_service_settings(): void {

		$this->with_settings(
			array(
				'option_group' => 'sample_service',
				'option_name'  => 'sample_options', // The name is an array.
				'callback'     => array( $this, 'input_sample_option_sanitize__callback' )
			)
		)->with_sections(
			array(
				'id'       => 'sample_service',
				'title'    => 'Sample Service Section',
				'page'     => 'sample_service',
				'callback' => array( $this, 'sample_service_section__callback' )
			)
		)->with_fields(
			array(
				'id'          => 'sample_option',
				'title'       => 'Sample Option',
				'page'        => 'sample_service',
				'option_name' => 'sample_options',
				'section'     => 'sample_service',
				'classes'     => '',
				'placeholder' => 'Enter your option name!',
				'callback'    => array( $this, 'sample_option_field__callback' )
			)
		);
	}
}
