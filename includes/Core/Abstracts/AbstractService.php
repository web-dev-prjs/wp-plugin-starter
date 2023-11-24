<?php

/**
 * Abstract Service.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core\Abstracts;

use WPS\Core\TwigTemplate;
use WPS\Utilities\Helper;

/**
 * Abstract service.
 *
 * @since 1.0.0
 */
abstract class AbstractService {

	/**
	 * The service slug.
	 *
	 * @var string
	 * @since 1.0.0
	 */
	private string $service_slug;

	/**
	 * When is True the service will register and active.
	 *
	 * @var bool
	 * @since 1.0.0
	 */
	protected bool $service_boot = true;

	/**
	 * The dashboard control.
	 *
	 * @var bool
	 * @since 1.0.0
	 */
	protected bool $dashboard_control = true;

	/**
	 * The service main-pages.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $service_main_pages = array();

	/**
	 * The service sub-pages.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $service_sub_pages = array();

	/**
	 * The service option-pages.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $service_option_pages = array();

	/**
	 * The service sections.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $service_sections = array();

	/**
	 * The service fields.
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $service_fields = array();

	/**
	 * Builds the service functionality.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function build(): void {

		$this->handle_dashboard_control();

		if ( ! $this->service_boot || ! $this->service_slug() ) {
			return;
		}

		$this->make_main_pages()
		     ->make_sub_pages()
		     ->make_option_pages()
		     ->make_option_group()
		     ->make_sections()
		     ->make_fields()
		     ->register();
	}

	/**
	 * Invokes all the service actions.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	protected function register(): void {

		// The service actions go here...
	}

	/**
	 * Builds the service main-pages.
	 *
	 * @return AbstractService
	 * @since 1.0.0
	 */
	private function make_main_pages(): AbstractService {

		$service_main_pages = array();

		if ( sizeof( $this->service_main_pages ) ) {
			foreach ( $this->service_main_pages as $menu_slug => $service_main_page ) {
				$service_main_pages[] = array(
					'page_title' => $service_main_page['page_title'],
					'menu_title' => $service_main_page['menu_title'],
					'capability' => $service_main_page['capability'],
					'menu_slug'  => $menu_slug,
					'icon_url'   => $service_main_page['icon_url'],
					'position'   => $service_main_page['position'],
					'callback'   => function () use ( $menu_slug, $service_main_page ) {

						/**
						 * @var TwigTemplate $twig_template
						 */
						global $twig_template;

						print $twig_template
							->with_template( $service_main_page['template_name'] )
							->with_context( array_merge_recursive(
								$service_main_page['template_context'],
								array( 'data' => array( 'settings_form' => $menu_slug ) )
							) )->template_render();
					}
				);
			}
		}

		add_filter(
			PLUGIN_PREFIX . '_add_main_pages_endpoint',
			function ( array $main_pages ) use ( $service_main_pages ) {

				foreach ( $service_main_pages as $service_main_page ) {
					$main_pages[] = $service_main_page;
				}

				return $main_pages;
			}
		);

		return $this;
	}

	/**
	 * Builds the service sub-pages.
	 *
	 * @return AbstractService
	 * @since 1.0.0
	 */
	private function make_sub_pages(): AbstractService {

		$service_sub_pages = array();

		if ( sizeof( $this->service_sub_pages ) ) {
			foreach ( $this->service_sub_pages as $sub_page_slug => $service_sub_page ) {
				$service_sub_pages[] = array(
					'parent_slug'    => $service_sub_page['parent_slug'],
					'sub_page_title' => $service_sub_page['sub_page_title'],
					'menu_title'     => $service_sub_page['menu_title'],
					'sub_page_slug'  => $sub_page_slug,
					'capability'     => $service_sub_page['capability'],
					'position'       => $service_sub_page['position'],
					'callback'       => function () use ( $sub_page_slug, $service_sub_page ) {

						/**
						 * @var TwigTemplate $twig_template
						 */
						global $twig_template;

						print $twig_template
							->with_template( $service_sub_page['template_name'] )
							->with_context( array_merge_recursive(
								$service_sub_page['template_context'],
								array( 'data' => array( 'settings_form' => $sub_page_slug ) )
							) )->template_render();
					}
				);
			}
		}

		add_filter(
			PLUGIN_PREFIX . '_add_sub_pages_endpoint',
			function ( array $sub_pages ) use ( $service_sub_pages ) {

				foreach ( $service_sub_pages as $service_sub_page ) {
					$sub_pages[] = $service_sub_page;
				}

				return $sub_pages;
			}
		);

		return $this;
	}

	/**
	 * Builds the service option-pages.
	 *
	 * @return AbstractService
	 * @since 1.0.0
	 */
	private function make_option_pages(): AbstractService {

		$service_option_pages = array();

		if ( sizeof( $this->service_option_pages ) ) {
			foreach ( $this->service_option_pages as $option_page_slug => $service_option_page ) {
				$service_option_pages[] = array(
					'page_title' => $service_option_page['page_title'],
					'menu_title' => $service_option_page['menu_title'],
					'capability' => $service_option_page['capability'],
					'menu_slug'  => $option_page_slug,
					'position'   => $service_option_page['position'],
					'callback'   => function () use ( $option_page_slug, $service_option_page ) {

						/**
						 * @var TwigTemplate $twig_template
						 */
						global $twig_template;

						print $twig_template
							->with_template( $service_option_page['template_name'] )
							->with_context( array_merge_recursive(
								$service_option_page['template_context'],
								array( 'data' => array( 'settings_form' => $option_page_slug ) )
							) )->template_render();
					}
				);
			}
		}

		add_filter(
			PLUGIN_PREFIX . '_add_option_pages_endpoint',
			function ( array $option_pages ) use ( $service_option_pages ) {

				foreach ( $service_option_pages as $service_option_page ) {
					$option_pages[] = $service_option_page;
				}

				return $option_pages;
			}
		);

		return $this;
	}

	/**
	 * Builds the service options.
	 *
	 * @return AbstractService
	 * @since 1.0.0
	 */
	private function make_option_group(): AbstractService {

		add_filter(
			PLUGIN_PREFIX . '_add_settings_endpoint',
			function ( array $settings ) {

				$settings[] = array(
					'option_group' => $this->service_slug, // sample_service
					'option_name'  => $this->service_slug, // The name is an array.
					'callback'     => array( $this, 'option_group_sanitize__callback' )
				);

				return $settings;
			}
		);

		return $this;
	}

	/**
	 * Builds the service sections.
	 *
	 * @return AbstractService
	 * @since 1.0.0
	 */
	private function make_sections(): AbstractService {

		$service_sections = array();

		if ( sizeof( $this->service_sections ) ) {
			foreach ( $this->service_sections as $id => $section ) {
				$service_sections[] = array(
					'id'       => $id, // sample_section
					'title'    => '<span' . ( empty( $section['class'] ) ? null : " class={$section['class']}" ) . '>' .
					              ( empty( $section['title'] ) ? null : $section['title'] ) . '</span>', // Sample Section
					'page'     => $this->service_slug,
					'callback' => array( $this, "{$id}_section__callback" )
				);
			}
		}

		add_filter(
			PLUGIN_PREFIX . '_add_sections_endpoint',
			function ( array $sections ) use ( $service_sections ) {

				foreach ( $service_sections as $service_section ) {
					$sections[] = $service_section;
				}

				return $sections;
			}
		);

		return $this;
	}

	/**
	 * Builds the service fields.
	 *
	 * @return AbstractService
	 * @since 1.0.0
	 */
	private function make_fields(): AbstractService {

		$service_fields = array();

		if ( sizeof( $this->service_fields ) ) {
			foreach ( $this->service_fields as $id => $field ) {
				$service_fields[] = array(
					'id'          => $id, // sample_option
					'title'       => $field['title'], // Sample Option:
					'page'        => $this->service_slug, // sample_service
					'option_name' => $this->service_slug, // sample_service
					'section'     => $field['section_id'], // sample_section
					'classes'     => $field['class'],
					'placeholder' => $field['place_holder'], // Enter your option name!
					'callback'    => array( $this, "{$id}_field__callback" )
				);
			}
		}

		add_filter(
			PLUGIN_PREFIX . '_add_fields_endpoint',
			function ( array $fields ) use ( $service_fields ) {

				foreach ( $service_fields as $service_field ) {
					$fields[] = $service_field;
				}

				return $fields;
			}
		);

		return $this;
	}

	/**
	 * Builds the service slug from service name (same class name).
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	private function service_slug(): bool {

		$this->service_slug = Helper::make_lower_slug(
			str_replace(
				'WPS\\Services\\Controllers\\',
				'',
				get_class( $this )
			)
		);

		return isset( get_option( PLUGIN_PREFIX . '_services' )[ $this->service_slug ] );
	}

	/**
	 * Handles to showing the service control in the plugin dashboard-page.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function handle_dashboard_control(): void {

		if ( $this->dashboard_control ) {
			add_filter(
				PLUGIN_PREFIX . '_add_fields_endpoint',
				function ( array $fields ) {

					$fields[] = array(
						'id'          => $this->service_slug, // sample_service
						'title'       => ucwords( str_replace(
								'_',
								' ',
								$this->service_slug
							) ) . ':', // Sample Service:
						'page'        => 'dashboard',
						'option_name' => 'services',
						'section'     => 'services',
						'classes'     => '',
						'callback'    => array(
							PLUGIN_NAMESPACE . 'Core\Callbacks\OptionCallback',
							'service_field__callback'
						)
					);

					return $fields;
				}
			);
		}
	}
}
