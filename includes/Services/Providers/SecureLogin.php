<?php

/**
 * Provides functionality for secure-login system.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Services\Providers;

use WPS\Utilities\Helper;

/**
 * SecureLogin class.
 *
 * @since 1.0.0
 */
class SecureLogin {

	/**
	 * The hide login keyword.
	 *
	 * @var null|string
	 * @since 1.0.0
	 */
	private ?string $hide_login_key;

	/**
	 * @since 1.0.0
	 */
	public function __construct() {

		$secure_login_options_name = PLUGIN_PREFIX . '_' . Helper::make_lower_slug(
				str_replace( 'WPS\\Services\\Providers\\', '', __CLASS__ )
			);

		$secure_login_options = get_option( $secure_login_options_name );
		$secure_login_keyword = $secure_login_options ? $secure_login_options['login_keyword'] : null;

		// Define plugin feature for hide default login path.
		$this->hide_login_key = $secure_login_keyword ?? delete_option( $secure_login_options_name );
	}

	/**
	 * Redirects to the home page when the path does not include the `hideLogin` key.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function redirect_to_home_page(): void {

		if ( empty( $this->hide_login_key ) ) {
			return;
		}

		if ( ! str_contains(
			parse_url( $_SERVER['REQUEST_URI'], PHP_URL_QUERY ),
			$this->hide_login_key,
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
	public function admin_login_page(): void {

		$requestURI = preg_replace(
			'/(\/)/',
			'',
			parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ),
		);

		if ( $this->hide_login_key === $requestURI && ( false !== $_GET['redirect'] ) ) {
			Helper::redirect(
				'wsr',
				home_url( 'wp-login.php?' . $this->hide_login_key . '&redirect=false' ),
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
			$this->hide_login_key,
		) ) {
			Helper::redirect( 'wsr', home_url( '?page_id=2' ) );
		}
	}
}
