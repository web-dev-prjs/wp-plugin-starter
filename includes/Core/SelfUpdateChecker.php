<?php

/**
 * Gets and checks for new version of the plugin from specific server.
 *
 * @package wp-plugin-starter
 */

namespace WPS\Core;

use stdClass;
use WPS\Utilities\Helper;

/**
 * UpdateChecker class.
 *
 * @since 1.0.0
 */
class SelfUpdateChecker {
    
    /**
     * The cache key variable
     *
     * @var string
     * @since 1.0.0
     */
    public string|array $plugin_slug;
    
    /**
     * The cache key variable
     *
     * @var string
     * @since 1.0.0
     */
    public string $cache_key;
    
    /**
     * The cache allowed variable
     *
     * @var string
     * @since 1.0.0
     */
    public string $cache_allowed;
    
    /**
     * The register method.
     *
     * @return void
     * @since 1.0.0
     */
    public function build(): void {
        
        $this->cache_allowed = false;
        $this->cache_key     = 'wdp_update_checker';
        $this->plugin_slug   = Helper::make_plugin_slug( PLUGIN_NAME );
        
        $request = $this->request();
        
        add_filter( 'plugins_api', array( $this, 'info' ), 20, 3 );
        
        add_filter( 'site_transient_update_plugins', array( $this, 'update' ) );
        
        add_action( 'upgrader_process_complete', array( $this, 'purge' ), 10, 2 );
    }
    
    /**
     * The request method.
     *
     * @return object|bool
     * @since 1.0.0
     */
    public function request(): object|bool {
        
        $remote = get_transient( $this->cache_key );
        
        if ( false === $remote || ! $this->cache_allowed ) {
            $server_url  = getenv( 'UPDATE_SERVER' );
            $server_path = getenv( 'UPDATE_SERVER_PATH' ) . $this->plugin_slug;
            $server_file = getenv( 'UPDATE_SERVER_FILE' );
            
            $url = $server_url . DIRECTORY_SEPARATOR . $server_path . DIRECTORY_SEPARATOR . $server_file;
            
            $args = array(
                'timeout' => 10,
                'headers' => array(
                    'Accept' => 'application/json'
                ),
            );
            
            $remote = wp_remote_get( $url, $args );
            
            if (
                is_wp_error( $remote ) ||
                200 !== wp_remote_retrieve_response_code( $remote ) ||
                empty( wp_remote_retrieve_body( $remote ) )
            ) {
                return false;
            }
            
            set_transient( $this->cache_key, $remote, DAY_IN_SECONDS / 4 );
        }
        
        return json_decode( wp_remote_retrieve_body( $remote ) );
    }
    
    /**
     * The info method.
     *
     * @param mixed  $res
     * @param string $action
     * @param object $args
     *
     * @return false|stdClass
     */
    public function info( mixed $res, string $action, object $args ): bool|stdClass {
        
        echo '<pre>', "<br /><p>{{ Action }}</p>", print_r( $action, true ), '<br />', '</pre>';
        echo '<pre>', "<br /><p>{{ Arguments }}</p>", print_r( $args, true ), '<br />', '</pre>';
        
        // Do nothing if you're not getting plugin information right now
        if ( 'plugin_information' !== $action ) {
            return false;
        }
        
        // Do nothing if it is not our plugin
        if ( $this->plugin_slug !== $args->slug ) {
            return false;
        }
        
        // Get updates
        $remote = $this->request();
        
        if ( ! $remote ) {
            return false;
        }
        
        $res = new stdClass();
        
        $res->name           = $remote->name;
        $res->slug           = $remote->slug;
        $res->version        = $remote->version;
        $res->tested         = $remote->tested;
        $res->requires       = $remote->requires;
        $res->author         = $remote->author;
        $res->author_profile = $remote->author_profile;
        $res->download_link  = $remote->download_url;
        $res->trunk          = $remote->download_url;
        $res->requires_php   = $remote->requires_php;
        $res->last_updated   = $remote->last_updated;
        
        $res->sections = array(
            'description'  => $remote->sections->description,
            'installation' => $remote->sections->installation,
            'changelog'    => $remote->sections->changelog
        );
        
        if ( ! empty( $remote->banners ) ) {
            $res->banners = array(
                'low'  => $remote->banners->low,
                'high' => $remote->banners->high
            );
        }
        
        return $res;
    }
    
    /**
     * The update method.
     *
     * @param object $transient
     *
     * @return object
     */
    public function update( object $transient ): object {
        
        if ( empty( $transient->checked ) ) {
            return $transient;
        }
        
        $remote = $this->request();
        
        if (
            $remote
            && version_compare( PLUGIN_VERSION, $remote->version, '<' )
            && version_compare( $remote->requires, get_bloginfo( 'version' ), '<' )
            && version_compare( $remote->requires_php, PHP_VERSION, '<' )
        ) {
            $res              = new stdClass();
            $res->slug        = $this->plugin_slug;
            $res->plugin      = PLUGIN_BASENAME;  // plugin-name/plugin-name.php
            $res->new_version = $remote->version;
            $res->tested      = $remote->tested;
            $res->package     = $remote->download_url;
            
            $transient->response[ $res->plugin ] = $res;
        }
        
        return $transient;
    }
    
    /**
     * The purge method.
     *
     * @return void
     */
    public function purge(): void {
        
        if (
            $this->cache_allowed &&
            'update' === ( isset( $options ) ? $options[ 'action' ] : null ) &&
            'plugin' === ( isset( $options ) ? $options[ 'type' ] : null )
        ) {
            // Just clean the cache when new plugin version is installed
            delete_transient( $this->cache_key );
        }
    }
}
