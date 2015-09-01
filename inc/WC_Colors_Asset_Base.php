<?php

class WC_Colors_Asset_Base implements WC_Colors_Asset_Interface
{
    protected $colors;

    public function init( $colors ) {}

    public function get_contents() {}

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

        wp_mkdir_p( dirname( $this->get_path() ) );
        file_put_contents( $this->get_path(), $this->get_contents() );
    }

    /**
     * @return string
     */
    public function get_url()
    {
        $uploads = wp_upload_dir();

        return $uploads[ 'baseurl' ] . '/wc-colors/' . $this->get_filename();
    }

    /**
     * @return string
     */
    public function get_path()
    {
        $uploads = wp_upload_dir();

        return $uploads[ 'basedir' ] . '/wc-colors/' . $this->get_filename();
    }
}