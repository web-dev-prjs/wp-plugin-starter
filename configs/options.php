<?php

/**
 * Defines all options of plugin, Such as settings, sections, and fields.
 *
 * @package wp-plugin-starter
 */

$plugin_prefix = strtoupper( PLUGIN_PREFIX );

const PLUGIN_OPTIONS = array(
	/*
	 |-------------------------------------------------------------------------
	 | Additional the plugin settings.
	 |
	 | array(
	 |     'option_group' => '',
	 |     'option_name'  => '',
	 |     'callback'    => array( PLUGIN_NAMESPACE . 'Core\Setting\Traits\Callbacks\Setting', '' )
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
	 |     'callback'    => array( PLUGIN_NAMESPACE . 'Core\Setting\Traits\Callbacks\Setting', '' )
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
	 |     'callback'    => array( PLUGIN_NAMESPACE . 'Core\Setting\Traits\Callbacks\Setting', '' )
	 | )
	 |-------------------------------------------------------------------------
	 */
	'fields'   => array(// New custom-fields go here...
		array(
			'id'          => 'sample_service',
			'title'       => 'Sample Service',
			'page'        => 'dashboard',
			'option_name' => 'services',
			'section'     => 'services',
			'classes'     => '',
			'callback'    => array(
				PLUGIN_NAMESPACE . 'Core\Setting\Traits\Callbacks\Setting',
				'service_field__callback'
			)
		)
	)
);
