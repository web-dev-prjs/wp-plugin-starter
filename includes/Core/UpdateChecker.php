<?php

/**
 * Checks the plugin updates.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

/**
 * UpdateChecker class.
 *
 * @since 1.0.0
 */
final class UpdateChecker {
    
    /**
     * Register the "update_checker" method.
     *
     * @return void
     * @since 1.0.0
     */
    public function build(): void {
        
        $this->update_checker();
    }
    
    /**
     * Handle checking the plugin updates.
     *
     * @return void
     * @since 1.0.0
     */
    private function update_checker(): void {
        
        // Invoke update checker library.
        if ( ! class_exists( 'PucFactory' ) ) {
            require_once PLUGIN_PATH . 'update-checker/update-checker.php';
            
            $base_URL     = getenv( 'UPDATE_HOST_SERVER' );
            $details_path = getenv( 'UPDATE_HOST_SERVER_PATH' ) . PLUGIN_DOMAIN;
            $data_file    = getenv( 'UPDATE_HOST_SERVER_FILE' );
            
            PucFactory::buildUpdateChecker(
                $base_URL . DIRECTORY_SEPARATOR . $details_path . DIRECTORY_SEPARATOR . $data_file,
                PLUGIN_FILE,
                PLUGIN_DOMAIN
            );
        }
    }
}
