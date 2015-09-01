<?php

class WC_Colors_Stylesheet extends WC_Colors_Asset_Base
{
    const STYLESHEET_HANDLE = 'wc_color_classes';

    const STYLESHEET_FILENAME_FORMAT = 'wc-color-classes-%s.css';

    /**
     * @param $colors
     */
    public function init( $colors )
    {
        $this->colors = $colors;

        if ( ! file_exists( $this->get_path() ) ) {
            $this->generate( $colors );
        }

        wp_register_style(self::STYLESHEET_HANDLE, $this->get_url(), [], null);

        add_action('wp_enqueue_scripts', [$this, 'enqueue_stylesheet']);
    }

    public function enqueue_stylesheet()
    {
        wp_enqueue_style(self::STYLESHEET_HANDLE);
    }

    /**
     * Get the css for the stylesheet
     * @return string
     */
    public function get_contents()
    {
        $styles = [ ];
        $props = ['color','background-color'];

        foreach ( $props as $prop )
        {
            foreach ( $this->colors as $key => $hex )
            {
                $styles[ ".wc-$key-$prop" ]    = $this->generate_css($prop, $hex);
                $styles[ ".wc-$key-mu-$prop" ] = $this->generate_css($prop, $hex, true);
            }
        }

        $css = '';
        foreach ( $styles as $selectors => $style )
        {
            $css .= "$selectors { $style }\n";
        }

        return $css;
    }

    /**
     * @param            $rule
     * @param            $value
     * @param bool|false $important
     *
     * @return string
     */
    protected function generate_css($rule, $value, $important = false)
    {
        $css = "$rule:$value";

        if ( $important )
            $css .= '!important';

        $css .= ';';

        return $css;
    }

    /**
     * Get a unique filename based on the colors
     * @return string
     */
    public function get_filename()
    {
        return sprintf(self::STYLESHEET_FILENAME_FORMAT, md5(serialize($this->colors)));
    }
}