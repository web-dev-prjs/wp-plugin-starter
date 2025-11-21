<?php

/**
 * Defines all options of plugin, Such as settings, sections, and fields.
 *
 * @package wp-plugin-starter
 */

const PLUGIN_OPTIONS = [
	/*
	 |-------------------------------------------------------------------------
	 | Additional the plugin settings.
	 |
	 | [
	 |     'option_group' => '',
	 |     'option_name'  => '',
	 |     'callback'     => [ PLUGIN_NAMESPACE . 'Core\Callbacks\BaseOptionCallback', 'Callback Name' ]
	 | ]
	 |-------------------------------------------------------------------------
	 */
	'settings' => [// New settings and option-groups go here...
	],

	/*
	 |-------------------------------------------------------------------------
	 | Additional the plugin sections.
	 |
	 | [
	 |     'id'       => ,
	 |     'title'    => '',
	 |     'page'     => '',
	 |     'callback' => [ PLUGIN_NAMESPACE . 'Core\Callbacks\BaseOptionCallback', 'Callback Name' ]
	 | ]
	 |-------------------------------------------------------------------------
	 */
	'sections' => [// New sections go here...
	],

	/*
	 |-------------------------------------------------------------------------
	 | Additional the plugin fields.
	 |
	 | [
	 |     'id'          => ,
	 |     'title'       => '',
	 |     'page'        => '',
	 |     'option_name' => 'services',
	 |     'section'     => 'services',
	 |     'classes'     => '',
	 |     'callback'    => [ PLUGIN_NAMESPACE . 'Core\Callbacks\BaseOptionCallback', 'Callback Name' ]
	 | ]
	 |-------------------------------------------------------------------------
	 */
	'fields'   => [// New custom-fields go here...
	]
];
