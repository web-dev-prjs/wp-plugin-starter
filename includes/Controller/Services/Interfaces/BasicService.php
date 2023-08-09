<?php

/**
 * Interface of service.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Controller\Services\Interfaces;

/**
 * BasicService interface.
 *
 * @since 1.0.0
 */
interface BasicService {

	/**
	 * Invokes all the service actions.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function handle_service_actions(): void;
}
