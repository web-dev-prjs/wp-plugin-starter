<?php

/**
 * Invokes an HTML template as Twig-template file.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TemplateWrapper;

/**
 * TwigTemplate class.
 *
 * @since 1.0.0
 */
final class TwigTemplate {

	/**
	 * An array of parameters to pass to the template
	 *
	 * @var array
	 * @since 1.0.0
	 */
	private array $context = array();

	/**
	 * A flag that indicates which optimizations to apply
	 * (default to -1 which means that all optimizations are enabled; set it to 0 to disable).
	 *
	 * @var int
	 * @since 1.0.0
	 */
	private int $optimizations = - 1;

	/**
	 * When set to true, it automatically set "auto_reload" to true as well (default to false).
	 *
	 * @var false|string
	 * @since 1.0.0
	 */
	private false|string $cache = 'compilation-cache';

	/**
	 * * template:   The filename of template to render by Twig-engine.
	 * * charset:    The charset used by the templates (default to UTF-8).
	 * * autoescape: Whether to enable auto-escaping (default to html):
	 *               * false: disable auto-escaping.
	 *               * html, js: set the auto-escaping to one of the supported strategies.
	 *               * name: set the auto-escaping strategy based on the template name extension.
	 *               * PHP callback: a PHP callback that returns an escaping strategy based on the template "name".
	 *
	 * @var string
	 * @since 1.0.0
	 */
	private string $template = '', $charset = 'UTF-8', $autoescape = 'html';

	/**
	 * * debug:            When set to true, it automatically set "auto_reload" to true as well (default to false).
	 * * auto_reload:      Whether to reload the template if the original source changed.
	 *                     If you don't provide the auto_reload option, it will be
	 *                     determined automatically based on the debug value.
	 * * strict_variables: Whether to ignore invalid variables in templates (default to false).
	 *
	 * @var bool
	 * @since 1.0.0
	 */
	private bool $debug = true, $auto_reload = true, $strict_variables = false;

	/**
	 * Builds the global Twig-template variable.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function build(): void {

		global $twig_template;

		$twig_template = $this;
	}

	/**
	 * Sets a template name into template variable.
	 *
	 * @param string $template The template name.
	 *
	 * @return $this Returns the TwigTemplate instance.
	 * @since 1.0.0
	 */
	public function with_template( string $template ): TwigTemplate {

		$this->template = str_replace( '.', '/', $template );

		return $this;
	}

	/**
	 *  Sets context for Twig-template.
	 *
	 * @param array $context The context of template.
	 *
	 * @return $this Returns the TwigTemplate instance.
	 * @since 1.0.0
	 */
	public function with_context( array $context ): TwigTemplate {

		$this->context = $context;

		return $this;
	}

	/**
	 * Renders the passed template along with context.
	 *
	 * @return null|string Returns the rendered template.
	 * @since 1.0.0
	 */
	public function template_render(): null|string {

		if ( is_null( $template_load = $this->template_load() ) ) {
			return null;
		}

		return $template_load->render( $this->context );
	}

	/**
	 * Loads the passed template.
	 *
	 * @return null|TemplateWrapper Returns the passed template loader as template-wrapper.
	 * @since 1.0.0
	 */
	private function template_load(): null|TemplateWrapper {

		$basename  = $this->template . '.' . TWIG_TEMPLATE_SUFFIX;
		$file_path = PLUGIN_TEMPLATES . $basename;

		try {
			if ( ! file_exists( $file_path ) ) {
				throw new Exception(
					"The \"compilation-cache\" directory doesn't exist, please check the \"temporary\" folder!",
					404
				);
			} else {
				return $this->build_environment()->load( $basename );
			}
		} catch ( Exception $e ) {
			Notice::custom_admin_notice( 'error', $e->getCode(), $e->getMessage() );

			return null;
		}
	}

	/**
	 * Builds a Twig environment.
	 *
	 * @return null|Environment Returns the built Twig-environment.
	 * @since 1.0.0
	 */
	private function build_environment(): null|Environment {

		if ( is_null( $folder_loader = $this->folder_loader() ) ) {
			return null;
		}

		try {
			if ( ! file_exists( $cache = PLUGIN_TEMPORARY . $this->cache ) ) {
				throw new Exception(
					"The \"$cache\" directory does not exist, please check the \"temporary\" folder!",
					404
				);
			} else {
				$env = new Environment(
					$folder_loader,
					array(
						'debug'            => $this->debug, // bool-type.
						'charset'          => $this->charset, // string-type.
						'cache'            => $cache, // string-type (default folder: compilation-cache).
						'autoescape'       => $this->autoescape, // string-type.
						'auto_reload'      => $this->auto_reload, // bool-type.
						'optimizations'    => $this->optimizations, // integer-type.
						'strict_variables' => $this->strict_variables, // bool-type.
					)
				);

				TwigExtension::build( $env );

				return $env;
			}
		} catch ( Exception $e ) {
			Notice::custom_admin_notice( 'error', $e->getCode(), $e->getMessage() );

			return null;
		}
	}

	/**
	 * Loads the templates folder as a templates path.
	 *
	 * @return null|FilesystemLoader Returns the templates folder as filesystem-loader.
	 * @since 1.0.0
	 */
	private function folder_loader(): null|FilesystemLoader {

		try {
			if ( ! file_exists( PLUGIN_TEMPLATES ) ) {
				throw new Exception(
					"The \"templates\" directory does not exist, please check the \"plugin\" folder!",
					404
				);
			} else {
				return new FilesystemLoader( PLUGIN_TEMPLATES );
			}
		} catch ( Exception $e ) {
			Notice::custom_admin_notice( 'error', $e->getCode(), $e->getMessage() );

			return null;
		}
	}
}
