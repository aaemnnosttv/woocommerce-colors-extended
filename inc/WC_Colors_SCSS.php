<?php

class WC_Colors_SCSS extends WC_Colors_Asset_Base
{
    const FILENAME = '_wc-colors.scss';

    /**
     * @param $colors
     */
    public function init( $colors )
    {
        $this->colors = $colors;

        if ( ! file_exists( $this->get_path() ) ) {
            $this->generate( $colors );
        }
    }

    /**
     * Generate the asset
     *
     * @param $colors
     *
     * @return mixed
     */
    public function generate( $colors )
    {
        $this->colors = $colors;

        wp_mkdir_p( dirname($this->get_path()) );

        file_put_contents($this->get_path(), $this->get_contents());
    }

    /**
     * @return string
     */
    public function get_contents()
    {
        $scss = [];

        foreach ( $this->colors as $key => $hex )
        {
            $scss[ ] = "\$wc-color-$key: $hex !default;";
        }

        return join("\n", $scss);
    }

    /**
     * @return string
     */
    public function get_path()
    {
        $uploads = wp_upload_dir();

        return $uploads['basedir'] . '/wc-colors/' . $this->get_filename();
    }

    /**
     * @return string
     */
    public function get_filename()
    {
        return self::FILENAME;
    }
}