<?php

if ( ! function_exists( 'tokoo_about_header_section_element' ) ) {

    function tokoo_about_header_section_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'title'             => '',
            'pre_title'         => '',
            'el_class'          => ''
        ), $atts));

        $args = array(
            'section_class'     => $el_class,
            'title'             => $title,
            'pre_title'         => $pre_title,
        );

        $html = '';
        if( function_exists( 'tokoo_about_header_section' ) ) {
            ob_start();
            tokoo_about_header_section( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_about_header_section' , 'tokoo_about_header_section_element' );