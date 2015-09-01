<?php

interface WC_Colors_Asset_Interface
{
    public function init( $colors );

    public function generate( $colors );

    public function get_contents();
}