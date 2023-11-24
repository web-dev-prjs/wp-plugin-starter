<?php

/**
 * Defines all settings of plugin, Such as admin pages, sub-pages, option-pages, settings, sections, and fields.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core\Settings;

/**
 * Setting class.
 *
 * @since 1.0.0
 */
class Setting {

	/**
	 * The admin-pages variable
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $admin_pages = array();

	/**
	 * The admin sub-pages variable
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $admin_sub_pages = array();

	/**
	 * The admin option-pages variable
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $admin_option_pages = array();

	/**
	 * The admin-settings variable
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $admin_settings = array();

	/**
	 * The admin-sections variable
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $admin_sections = array();

	/**
	 * The admin-field variable
	 *
	 * @var array
	 * @since 1.0.0
	 */
	protected array $admin_fields = array();

	/**
	 * Creates admin pages and sub-pages.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	protected function create_pages(): void {

		static::register_admin_pages();
	}

	/**
	 * Creates the plugin options includes settings, sections, and fields.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	protected function create_options(): void {

		static::register_plugin_settings();
	}

	/**
	 * Sets plugin pages.
	 *
	 * @param array $pages The array of pages for generate them.
	 *
	 * @return static
	 * @since 1.0.0
	 */
	protected function set_pages( array $pages ): Setting {

		foreach ( $pages as $page ) {
			$this->admin_pages[] = array(
				'page_title' => $page['page_title'],
				'menu_title' => $page['menu_title'],
				'capability' => $page['capability'],
				'menu_slug'  => PLUGIN_PREFIX . "_{$page['menu_slug']}",
				'callback'   => ( $page['callback'] ?? null ),
				'icon_url'   => $page['icon_url'],
				'position'   => $page['position'],
			);
		}

		return $this;
	}

	/**
	 * Sets plugin page with sub pages.
	 *
	 * @param string|null $title The title of parent-page.
	 *
	 * @return static
	 * @since 1.0.0
	 */
	protected function with_sub_page( string $title = null ): Setting {

		$admin_page = $this->admin_pages[0];

		$this->admin_sub_pages = array(
			array(
				'parent_slug'    => $admin_page['menu_slug'],
				'sub_page_title' => $admin_page['page_title'],
				'menu_title'     => $title ?? $admin_page['menu_title'],
				'capability'     => $admin_page['capability'],
				'menu_slug'      => $admin_page['menu_slug'],
				'callback'       => ( $admin_page['callback'] ?? null ),
				'position'       => $admin_page['position']
			)
		);

		return $this;
	}

	/**
	 * Sets plugin sub-pages.
	 *
	 * @param array $sub_pages The array of sub-pages to generate them.
	 *
	 * @return static
	 * @since 1.0.0
	 */
	protected function set_sub_pages( array $sub_pages ): Setting {

		foreach ( $sub_pages as $sub_page ) {
			$this->admin_sub_pages[] = array(
				'parent_slug'    => PLUGIN_PREFIX . "_{$sub_page['parent_slug']}",
				'sub_page_title' => $sub_page['sub_page_title'],
				'menu_title'     => $sub_page['menu_title'],
				'capability'     => $sub_page['capability'],
				'menu_slug'      => PLUGIN_PREFIX . "_{$sub_page['sub_page_slug']}",
				'callback'       => ( $sub_page['callback'] ?? null ),
				'position'       => $sub_page['position'],
			);
		}

		return $this;
	}

	/**
	 * Sets plugin option-pages.
	 *
	 * @param array $option_pages The array of option-pages to generate them.
	 *
	 * @return static
	 * @since 1.0.0
	 */
	protected function set_option_pages( array $option_pages ): Setting {

		foreach ( $option_pages as $option_page ) {
			$this->admin_option_pages[] = array(
				'page_title' => $option_page['page_title'],
				'menu_title' => $option_page['menu_title'],
				'capability' => $option_page['capability'],
				'menu_slug'  => PLUGIN_PREFIX . "_{$option_page['menu_slug']}",
				'callback'   => ( $option_page['callback'] ?? null ),
				'position'   => $option_page['position']
			);
		}

		return $this;
	}

	/**
	 * Sets admin settings.
	 *
	 * @param array $settings The array of settings for generate them.
	 *
	 * @return static
	 * @since 1.0.0
	 */
	protected function set_settings( array $settings ): Setting {

		foreach ( $settings as $setting ) {
			$this->admin_settings[] = array(
				'option_group' => PLUGIN_PREFIX . "_{$setting['option_group']}_" . OPTION_GROUP_SUFFIX,
				'option_name'  => PLUGIN_PREFIX . "_{$setting['option_name']}",
				'callback'     => ( $setting['callback'] ?? null )
			);
		}

		return $this;
	}

	/**
	 * Sets admin sections.
	 *
	 * @param array $sections The array of sections for generate them.
	 *
	 * @return static
	 * @since 1.0.0
	 */
	protected function set_sections( array $sections ): Setting {

		foreach ( $sections as $section ) {
			$this->admin_sections[] = array(
				'id'       => PLUGIN_PREFIX . "_{$section['id']}_" . OPTION_SECTION_SUFFIX,
				'title'    => "<h5 class='mb-4'>{$section['title']}</h5>",
				'page'     => PLUGIN_PREFIX . "_{$section['page']}",
				'callback' => ( $section['callback'] ?? null )
			);
		}

		return $this;
	}

	/**
	 * Sets admin fields.
	 *
	 * @param array $fields The array of fields for generate them.
	 *
	 * @return static
	 * @since 1.0.0
	 */
	protected function set_fields( array $fields ): Setting {

		foreach ( $fields as $field ) {
			$this->admin_fields[] = array(
				'id'       => $field['id'],
				'title'    => $field['title'],
				'page'     => PLUGIN_PREFIX . "_{$field['page']}",
				'section'  => PLUGIN_PREFIX . "_{$field['section']}_" . OPTION_SECTION_SUFFIX,
				'args'     => array(
					'label_for'   => $field['id'] ?? null,
					'title'       => $field['title'] ?? null,
					'class'       => $field['classes'] ?? null,
					'placeholder' => $field['placeholder'] ?? null,
					'option_name' => PLUGIN_PREFIX . "_{$field['option_name']}" ?? null,
				),
				'callback' => ( $field['callback'] ?? null )
			);
		}

		return $this;
	}

	/**
	 * Registers admin pages and sub-pages.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function register_admin_pages(): void {

		if (
			! empty( $this->admin_pages ) ||
			! empty( $this->admin_sub_pages ) ||
			! empty( $this->admin_option_pages )
		) {
			add_action( 'admin_menu', function () {
				// Add menu page.
				foreach ( $this->admin_pages as $page ) {
					add_menu_page(
						$page['page_title'],
						$page['menu_title'],
						$page['capability'],
						$page['menu_slug'],
						$page['callback'],
						$page['icon_url'],
						$page['position']
					);
				}

				// Add sub-menu page.
				foreach ( $this->admin_sub_pages as $sub_page ) {
					add_submenu_page(
						$sub_page['parent_slug'],
						$sub_page['sub_page_title'],
						$sub_page['menu_title'],
						$sub_page['capability'],
						$sub_page['menu_slug'],
						$sub_page['callback'],
						$sub_page['position']
					);
				}

				// Add option-menu page.
				foreach ( $this->admin_option_pages as $option_page ) {
					add_options_page(
						$option_page['page_title'],
						$option_page['menu_title'],
						$option_page['capability'],
						$option_page['menu_slug'],
						$option_page['callback'],
						$option_page['position']
					);
				}
			} );
		}
	}

	/**
	 * Registers plugin settings, sections, and fields.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	private function register_plugin_settings(): void {

		if ( ! empty( $this->admin_settings ) ) {
			add_action( 'admin_init', function () {

				// Register settings.
				foreach ( $this->admin_settings as $setting ) {
					register_setting(
						$setting['option_group'],
						$setting['option_name'],
						( $setting['callback'] ?? null )
					);
				}

				// Register settings section.
				foreach ( $this->admin_sections as $section ) {
					add_settings_section(
						$section['id'],
						$section['title'],
						( $section['callback'] ?? null ),
						$section['page']
					);
				}

				// Register settings field.
				foreach ( $this->admin_fields as $field ) {
					add_settings_field(
						$field['id'],
						$field['title'],
						( $field['callback'] ?? null ),
						$field['page'],
						$field['section'],
						( $field['args'] ?? null )
					);
				}
			} );
		}
	}
}
