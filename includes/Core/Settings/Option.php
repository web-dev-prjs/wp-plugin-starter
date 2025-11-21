<?php

/**
 * Defines all options of plugin, Such as settings, sections, and fields.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core\Settings;

use stdClass;
use WPS\Core\Callbacks\OptionCallback;

/**
 * Option trait.
 *
 * @since 1.0.0
 */
trait Option {

	use OptionCallback;

	/**
	 * Makes a stdClass of the general plugin settings, sections, and custom-fields.
	 *
	 * @return object
	 * @since 1.0.0
	 */
	protected function add_options(): object {

		$options = new stdClass();

		$default_options = [
			/*
			 |----------------------------------
			 | Default plugin settings.
			 |----------------------------------
			 */
			'settings' => [// New default settings go here...
				[
					'option_group' => 'dashboard',
					'option_name'  => 'services', // The name is an array.
					'callback'     =>  [ $this, 'service_option_group__callback' ]
				]
			],
			/*
			 |----------------------------------
			 | Default plugin sections.
			 |----------------------------------
			 */
			'sections' => [// New default sections go here...
				[
					'id'       => 'services',
					'title'    => '<span class="text-dark py-1">Services Section</span>',
					'page'     => 'dashboard',
					'callback' => [ $this, 'services_section__callback' ]
				]
			],
			/*
			 |----------------------------------
			 | Default plugin fields.
			 |----------------------------------
			 */
			'fields'   => [// New default fields go here...
			]
		];

		/*
		 |-------------------------------------------------------------------------------
		 | Merges additional settings, sections, and fields with default type options.
		 |-------------------------------------------------------------------------------
		 */
		foreach ( $default_options as $key => $value ) {
			$options->{$key} = array_merge( $value, PLUGIN_OPTIONS[ $key ] );
		}

		return $options;
	}
}
