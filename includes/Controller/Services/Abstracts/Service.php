<?php

/**
 * Abstract Service.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Controller\Services\Abstracts;

use WPS\Controller\Services\Callbacks\SampleService;
use WPS\Controller\Services\Interfaces\BasicService;
use WPS\Core\Setting\Traits\Option;

/**
 * Abstract service.
 *
 * @since 1.0.0
 */
abstract class Service implements BasicService {

	use Option;
	use SampleService;

	/**
	 * When is True the service will register and active.
	 *
	 * @var bool
	 * @since 1.0.0
	 */
	protected bool $boot = true;

	/**
	 * The service slug.
	 *
	 * @var string
	 * @since 1.0.0
	 */
	protected string $service_slug;

	/**
	 * Registers the service functionality.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void {

		if ( ! $this->boot or ! isset( get_option( PLUGIN_PREFIX . '_services' )[ $this->service_slug ] ) ) {
			return;
		}

		$this->handle_service_pages();
		$this->handle_service_settings();
		$this->handle_service_actions();
	}

	/**
	 * Handles to create the service pages.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	protected function handle_service_pages(): void {

		// The service pages go here...
	}

	/**
	 * Handles to create the service settings, sections, and fields.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	protected function handle_service_settings(): void {

		// The service pages go here...
	}

	/**
	 * Invokes all the service actions.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function handle_service_actions(): void {

		// The service actions go here...
	}

	/**
	 * @param array $with_main_pages An array of the service main-pages.
	 *
	 * @return Service
	 * @since 1.0.0
	 */
	protected function with_main_pages( array $with_main_pages ): Service {

		add_filter(
			PLUGIN_PREFIX . '_add_main_pages_endpoint',
			function ( array $main_pages ) use ( $with_main_pages ) {

				$main_pages[] = $with_main_pages;

				return $main_pages;
			}
		);

		return $this;
	}

	/**
	 * @param array $with_sub_pages An array of the service sub-pages.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	protected function with_sub_pages( array $with_sub_pages ): void {

		add_filter(
			PLUGIN_PREFIX . '_add_sub_pages_endpoint',
			function ( array $sub_pages ) use ( $with_sub_pages ) {

				$sub_pages[] = $with_sub_pages;

				return $sub_pages;
			}
		);
	}

	/**
	 * @param array $with_settings An array of the service settings.
	 *
	 * @return Service
	 * @since 1.0.0
	 */
	protected function with_settings( array $with_settings ): Service {

		add_filter(
			PLUGIN_PREFIX . '_add_settings_endpoint',
			function ( array $settings ) use ( $with_settings ) {

				$settings[] = $with_settings;

				return $settings;
			}
		);

		return $this;
	}

	/**
	 * @param array $with_sections An array of the service sections.
	 *
	 * @return Service
	 * @since 1.0.0
	 */
	protected function with_sections( array $with_sections ): Service {

		add_filter(
			PLUGIN_PREFIX . '_add_sections_endpoint',
			function ( array $sections ) use ( $with_sections ) {

				$sections[] = $with_sections;

				return $sections;
			}
		);

		return $this;
	}

	/**
	 * @param array $with_fields An array of the service custom-fields.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	protected function with_fields( array $with_fields ): void {

		add_filter(
			PLUGIN_PREFIX . '_add_fields_endpoint',
			function ( array $fields ) use ( $with_fields ) {

				$fields[] = $with_fields;

				return $fields;
			}
		);
	}
}
