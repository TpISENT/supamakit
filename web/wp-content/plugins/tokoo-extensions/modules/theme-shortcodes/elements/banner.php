<?php

if ( ! function_exists( 'tokoo_banner_element' ) ) {

    function tokoo_banner_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'img_src'       => '',
            'link'          => '',
            'el_class'      => ''
        ), $atts));

        $args = array(
            'img_src'         => isset( $img_src ) && intval( $img_src ) ? wp_get_attachment_url( $img_src, 'full' ) : '',
            'link'          => $link,
            'section_class' => $el_class,
        );

        $html = '';
        if( function_exists( 'tokoo_banner' ) ) {
            ob_start();
            tokoo_banner( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_banner' , 'tokoo_banner_element' );