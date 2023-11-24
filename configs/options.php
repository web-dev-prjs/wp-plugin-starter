<?php

/**
 * Defines all options of plugin, Such as settings, sections, and fields.
 *
 * @package wp-plugin-starter
 */

const PLUGIN_OPTIONS = array(
	/*
	 |-------------------------------------------------------------------------
	 | Additional the plugin settings.
	 |
	 | array(
	 |     'option_group' => '',
	 |     'option_name'  => '',
	 |     'callback'    => array( PLUGIN_NAMESPACE . 'Core\Callbacks\BaseOptionCallback', 'Callback Name' )
	 | )
	 |-------------------------------------------------------------------------
	 */
	'settings' => array(// New settings and option-groups go here...
	),

	/*
	 |-------------------------------------------------------------------------
	 | Additional the plugin sections.
	 |
	 | array(
	 |     'id'       => ,
	 |     'title'    => '',
	 |     'page'     => '',
	 |     'callback'    => array( PLUGIN_NAMESPACE . 'Core\Callbacks\BaseOptionCallback', 'Callback Name' )
	 | )
	 |-------------------------------------------------------------------------
	 */
	'sections' => array(// New sections go here...
	),

	/*
	 |-------------------------------------------------------------------------
	 | Additional the plugin fields.
	 |
	 | array(
	 |     'id'          => ,
	 |     'title'       => '',
	 |     'page'        => '',
	 |     'option_name' => 'services',
	 |     'section'     => 'services',
	 |     'classes'     => '',
	 |     'callback'    => array( PLUGIN_NAMESPACE . 'Core\Callbacks\BaseOptionCallback', 'Callback Name' )
	 | )
	 |-------------------------------------------------------------------------
	 */
	'fields'   => array(// New custom-fields go here...
	)
);
