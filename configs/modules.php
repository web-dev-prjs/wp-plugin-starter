<?php

/**
 * Defines all services of the plugin to register.
 *
 * @package wp-plugin-starter
 */

/*
 |-----------------------------------------------
 | Returns the all services with key and value.
 |-----------------------------------------------
 */
return $services = array(
	/*
	 |-------------------------------------------------------------------------
	 | Base config, For setting up this plugin.
	 |-------------------------------------------------------------------------
	 */
	'enqueue'         => \WPS\Core\Enqueue::class,
	'action_links'    => \WPS\Core\ActionLink::class,
	'update_checker'  => \WPS\Core\UpdateChecker::class,

	/*
	 |-------------------------------------------------------------------------
	 | Admin dashboard config, For implement admin dashboard of plugin.
	 |-------------------------------------------------------------------------
	 */
	'admin_dashboard' => \WPS\Core\Dashboard::class,

	/*
	 |-------------------------------------------------------------------------
	 | Additional services, For implement features.
	 |-------------------------------------------------------------------------
	 */
	'sample_service'  => \WPS\Controller\Services\SampleService::class,
);
