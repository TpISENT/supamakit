<?php

if ( ! function_exists( 'tokoo_about_content_section_element' ) ) {

    function tokoo_about_content_section_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'about_content'     => '',
            'el_class'          => ''
        ), $atts));

        $args = array(
            'section_class'     => $el_class,
            'about_content'     => $about_content,
        );

        $html = '';
        if( function_exists( 'tokoo_about_content_section' ) ) {
            ob_start();
            tokoo_about_content_section( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_about_content_section' , 'tokoo_about_content_section_element' );