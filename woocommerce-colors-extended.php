<?php
/**
 * Plugin Name: WooCommerce Colors Extended
 * Description: A plugin for making WooCommerce colors more accessible.
 * Author: Evan Mattson
 * Version: 0.1
 */

function WC_Colors_Extended()
{
    if ( ! class_exists('WC_Colors') ) return;

    static $plugin;
    if ( ! $plugin ) {
        require_once( __DIR__ . '/inc/WC_Colors_Extended.php' );
        require_once( __DIR__ . '/inc/WC_Colors_Asset_Interface.php' );
        require_once( __DIR__ . '/inc/WC_Colors_Asset_Base.php' );
        require_once( __DIR__ . '/inc/WC_Colors_Stylesheet.php' );
        require_once( __DIR__ . '/inc/WC_Colors_SCSS.php' );

        $plugin = new WC_Color_Classes();

        $plugin->register_asset( new WC_Colors_Stylesheet() );
        $plugin->register_asset( new WC_Colors_SCSS() );
    }

    return $plugin;
}
add_action('woocommerce_init', 'WC_Colors_Extended');
