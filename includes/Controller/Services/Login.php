<?php

/**
 * Customizes redirects.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Controller\Services;

use WPS\Helper;

/**
 * Login class.
 *
 * @since 1.0.0
 */
class Login {

	/**
	 * Secures the admin login page by customizing it.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register(): void {

		add_action( 'init', array( $this, 'admin_login_page' ) );
		add_action( 'login_head', array( $this, 'redirect_to_home_page' ) );
		add_action( 'wp_logout', array( $this, 'redirect_in_logout_time' ) );
	}

	/**
	 * Redirects to the home page when the path does not include the `hideLogin` key.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function redirect_to_home_page(): void {

		if ( ! str_contains(
			parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY ),
			PLUGIN_HIDE_LOGIN,
		) ) {
			Helper::redirect( 'wsr', home_url() );
		}
	}

	/**
	 * Redirects to the actual login page if used from the `hide login` key.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function admin_login_page(): void {

		$requestURI = preg_replace(
			'/(\/)/',
			'',
			parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ),
		);

		if ( PLUGIN_HIDE_LOGIN === $requestURI && ( false !== $_GET['redirect'] ) ) {
			Helper::redirect(
				'wsr',
				home_url( 'wp-login.php?' . PLUGIN_HIDE_LOGIN . '&redirect=false' ),
			);
		}
	}

	/**
	 * Redirects to the home page after logout.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function redirect_in_logout_time(): void {

		wp_destroy_current_session();
		wp_clear_auth_cookie();
		wp_set_current_user( 0 );

		if ( ( 'logout' === $_GET['action'] ) && is_user_logged_in() ) {
			Helper::redirect( 'wsr', wp_logout_url( home_url( '?page_id=2' ) ) );
		} elseif ( ! str_contains(
			parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY ),
			PLUGIN_HIDE_LOGIN,
		) ) {
			Helper::redirect( 'wsr', home_url( '?page_id=2' ) );
		}
	}
}
