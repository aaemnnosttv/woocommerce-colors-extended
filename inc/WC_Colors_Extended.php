<?php

class WC_Color_Classes
{
    const OPTION_NAME = 'woocommerce_colors';

    protected $assets = [ ];

    /**
     *
     */
    public function __construct()
    {
        add_action('wp', [$this, 'init_assets']);
        add_action('update_option_' . self::OPTION_NAME, [$this, 'generate_assets']);
    }

    /**
     * @param WC_Colors_Asset_Interface $asset
     */
    public function register_asset( WC_Colors_Asset_Interface $asset )
    {
        if ( ! in_array($asset, $this->assets) ) {
            $this->assets[ ] = $asset;
        }
    }

    /**
     *
     */
    public function init_assets()
    {
        $this->map_assets('init');
    }

    /**
     *
     */
    public function generate_assets()
    {
        $this->map_assets('generate');
    }

    /**
     * @param       $method
     */
    protected function map_assets( $method )
    {
        $args = [
            $this->get_colors()
        ];

        foreach ( $this->assets as $asset ) {
            call_user_func_array([$asset, $method], $args);
        }
    }

    /**
     * @return array
     */
    public function get_colors()
    {
        return WC_Colors::get_options( get_option(self::OPTION_NAME) );
    }
}