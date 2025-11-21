<?php

/**
 * Defines admin page, settings, sections, and fields of the plugin.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use WPS\Core\Settings\Option;
use WPS\Core\Settings\Page;
use WPS\Core\Settings\Setting;

/**
 * Dashboard class.
 *
 * @since 1.0.0
 */
final class Dashboard extends Setting {

	use Page;
	use Option;

	/**
	 * An array of whole of the plugin pages.
	 *
	 * @var object
	 * @since 1.0.0
	 */
	private object $pages;

	/**
	 * An array of whole of the plugin options.
	 *
	 * @var object
	 * @since 1.0.0
	 */
	private object $options;

	/**
	 * Builds all the pages, subpages, settings, sections, and fields of the plugin.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function build(): void {

		/**
		 * Actions any functionality of the plugin dashboard.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		add_action( 'init', function () {

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Gets all the pages to make them in the plugin admin-side.
			$this->pages = $this->add_pages();

			$this->add_main_pages()
			     ->add_sub_pages()
			     ->add_option_pages()
			     ->create_pages();

			// Gets all the options to make them in the plugin admin-side.
			$this->options = $this->add_options();

			$this->add_settings()
			     ->add_sections()
			     ->add_fields()
			     ->create_options();
		} );
	}

	/**
	 * Returns an array includes the dashboard “page” along to other “pages.”
	 *
	 * @return Dashboard
	 * @since 1.0.0
	 */
	private function add_main_pages(): Dashboard {

		$main_pages = array_merge(
			$this->pages->main_pages,
			apply_filters( PLUGIN_PREFIX . '_add_main_pages_endpoint', [] )
		);

		$this->set_pages(
			apply_filters( PLUGIN_PREFIX . '_main_pages_endpoint', $main_pages )
		)->with_sub_page(
			apply_filters( PLUGIN_PREFIX . '_with_sub_page_endpoint', WITH_SUBPAGE )
		);

		return $this;
	}

	/**
	 * Returns an array includes the “sub-page” along to plugin dashboard “pages.”
	 *
	 * @return Dashboard
	 * @since 1.0.0
	 */
	private function add_sub_pages(): Dashboard {

		$sub_pages = array_merge(
			$this->pages->sub_pages,
			apply_filters( PLUGIN_PREFIX . '_add_sub_pages_endpoint', [] )
		);

		$this->set_sub_pages(
			apply_filters( PLUGIN_PREFIX . '_sub_pages_endpoint', $sub_pages )
		);

		return $this;
	}

	/**
	 * Returns an array includes the “option-page” along to dashboard settings section.
	 *
	 * @return Dashboard
	 * @since 1.0.0
	 */
	private function add_option_pages(): Dashboard {

		$option_pages = array_merge(
			$this->pages->option_pages,
			apply_filters( PLUGIN_PREFIX . '_add_option_pages_endpoint', [] )
		);

		$this->set_option_pages(
			apply_filters( PLUGIN_PREFIX . '_option_pages_endpoint', $option_pages )
		);

		return $this;
	}

	/**
	 * Returns an array includes the dashboard “option group” along to other “options group.”
	 *
	 * @return Dashboard
	 * @since 1.0.0
	 */
	private function add_settings(): Dashboard {

		$settings = array_merge(
			$this->options->settings,
			apply_filters( PLUGIN_PREFIX . '_add_settings_endpoint', [] )
		);

		$this->set_settings(
			apply_filters( PLUGIN_PREFIX . '_settings_endpoint', $settings )
		);

		return $this;
	}

	/**
	 * Returns an array includes the dashboard “option group” along to other “options group.”
	 *
	 * @return Dashboard
	 * @since 1.0.0
	 */
	private function add_sections(): Dashboard {

		$sections = array_merge(
			$this->options->sections,
			apply_filters( PLUGIN_PREFIX . '_add_sections_endpoint', [] )
		);

		$this->set_sections(
			apply_filters( PLUGIN_PREFIX . '_sections_endpoint', $sections )
		);

		return $this;
	}


	/**
	 * Returns an array includes the dashboard “option group” along to other “options group.”
	 *
	 * @return Dashboard
	 * @since 1.0.0
	 */
	private function add_fields(): Dashboard {

		$fields = array_merge(
			$this->options->fields,
			apply_filters( PLUGIN_PREFIX . '_add_fields_endpoint', [] )
		);

		$this->set_fields(
			apply_filters( PLUGIN_PREFIX . '_fields_endpoint', $fields )
		);

		return $this;
	}
}
