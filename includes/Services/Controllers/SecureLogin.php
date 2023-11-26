<?php

/**
 * Secures login and customizes redirects.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Services\Controllers;

use WPS\Core\Abstracts\AbstractService;
use WPS\Services\Callbacks\SecureLoginCallback;

/**
 * SecureLogin class.
 *
 * @since 1.0.0
 */
final class SecureLogin extends AbstractService {

	use SecureLoginCallback;

	protected function register(): void {

		$actions = array(
			'init'       => 'admin_login_page',
			'login_head' => 'redirect_to_home_page',
			'wp_logout'  => 'redirect_in_logout_time',
		);

		foreach ( $actions as $hook => $method ) {
			add_action( $hook, array( new ( '\WPS\Services\Providers\SecureLogin' ), $method ) );
		}
	}

	protected array $service_option_pages = array(
		'secure_login' => array(
			'position'         => 100,
			'page_title'       => 'Secure Login',
			'menu_title'       => 'Secure Login',
			'capability'       => 'manage_options',
			'template_name'    => 'admin.pages.secure-login',
			'template_context' => array(
				'fa_icon' => 'fa fa-arrow-right-to-bracket me-2',
				'data'    => array(
					'text_button' => 'Change Keyword'
				)
			)
		)
	);

	protected array $service_sections = array(
		'login_keyword' => array()
	);

	protected array $service_fields = array(
		'login_keyword' => array(
			'type'         => 'text',
			'section_id'   => 'login_keyword',
			'title'        => 'Login Keyword:',
			'place_holder' => 'Enter your login keyword!',
			'class'        => 'p-2',
		)
	);
}
