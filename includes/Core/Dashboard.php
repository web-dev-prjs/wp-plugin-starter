<?php

/**
 * Defines admin page, settings, sections, and fields of the plugin.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use WPS\Core\Setting\Classes\Setting;
use WPS\Core\Setting\Traits\Option;
use WPS\Core\Setting\Traits\Page;

/**
 * Dashboard class.
 *
 * @since 1.0.0
 */
final class Dashboard extends Setting {

	use Page;
	use Option;

	private object $pages;

	private object $options;

	/**
	 * Register all the pages, sub-pages, settings, sections, and fields of the plugin.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void {

		add_action( 'init', array( $this, 'actions' ) );
	}

	/**
	 * Actions any functionality of the plugin dashboard.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function actions(): void {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Gets all the pages to make them in the plugin admin-side.
		$this->pages = $this->add_pages();

		$this->add_main_pages()
		     ->add_sub_pages()
		     ->create_pages();

		// Gets all the options to make them in the plugin admin-side.
		$this->options = $this->add_options();

		$this->add_settings()
		     ->add_sections()
		     ->add_fields()
		     ->create_options();
	}

	/**
	 * Returns an array includes the dashboard “page” along to other “pages.”
	 *
	 * @return Dashboard
	 */
	private function add_main_pages(): Dashboard {

		$main_pages = array_merge(
			$this->pages->main_pages,
			apply_filters( PLUGIN_PREFIX . '_add_main_pages_endpoint', array() )
		);

		$this->set_pages(
			apply_filters( PLUGIN_PREFIX . '_main_pages_endpoint', $main_pages )
		)->with_sub_page(
			apply_filters( PLUGIN_PREFIX . '_with_sub_page_endpoint', 'Dashboard' )
		);

		return $this;
	}

	/**
	 * Returns an array includes the dashboard “page” along to other “pages.”
	 *
	 * @return Dashboard
	 */
	private function add_sub_pages(): Dashboard {

		$sub_pages = array_merge(
			$this->pages->sub_pages,
			apply_filters( PLUGIN_PREFIX . '_add_sub_pages_endpoint', array() )
		);

		$this->set_sub_pages(
			apply_filters( PLUGIN_PREFIX . '_sub_pages_endpoint', $sub_pages )
		);

		return $this;
	}

	/**
	 * Returns an array includes the dashboard “option group” along to other “options group.”
	 *
	 * @return Dashboard
	 */
	private function add_settings(): Dashboard {

		$settings = array_merge(
			$this->options->settings,
			apply_filters( PLUGIN_PREFIX . '_add_settings_endpoint', array() )
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
	 */
	private function add_sections(): Dashboard {

		$sections = array_merge(
			$this->options->sections,
			apply_filters( PLUGIN_PREFIX . '_add_sections_endpoint', array() )
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
	 */
	private function add_fields(): Dashboard {

		$fields = array_merge(
			$this->options->fields,
			apply_filters( PLUGIN_PREFIX . '_add_fields_endpoint', array() )
		);

		$this->set_fields(
			apply_filters( PLUGIN_PREFIX . '_fields_endpoint', $fields )
		);

		return $this;
	}
}
