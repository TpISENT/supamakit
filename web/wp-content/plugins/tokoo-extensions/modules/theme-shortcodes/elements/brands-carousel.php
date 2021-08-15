<?php

if ( ! function_exists( 'tokoo_brands_carousel_element' ) ) {

    function tokoo_brands_carousel_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'limit'             => '',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'slugs'             => '',
            'hide_empty'        => false,
            'ca_infinite'       => false,
            'ca_slidestoshow'   => 4,
            'ca_slidestoscroll' => 2,
            'ca_dots'           => false,
            'ca_arrows'         => false,
            'ca_autoplay'       => false,
            'ca_responsive'     => array(),
        ), $atts));

        $section_args = array(
            'section_title'           => $section_title
        );

        $taxonomy_args = array(
            'orderby'           => $orderby,
            'order'             => $order,
            'number'            => $limit,
            'hide_empty'        => $hide_empty
        );

        $carousel_args     = array(
            'infinite'          => filter_var( $ca_infinite, FILTER_VALIDATE_BOOLEAN ),
            'slidesToShow'      => intval( $ca_slidestoshow ),
            'slidesToScroll'    => intval( $ca_slidestoscroll ),
            'dots'              => filter_var( $ca_dots, FILTER_VALIDATE_BOOLEAN ),
            'arrows'            => filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ),
            'autoplay'       => filter_var( $ca_autoplay, FILTER_VALIDATE_BOOLEAN )
        );

        if( is_object( $ca_responsive ) || is_array( $ca_responsive ) ) {
            $ca_responsive = json_decode( json_encode( $ca_responsive ), true );
        } else {
            $ca_responsive = json_decode( urldecode( $ca_responsive ), true );
        }

        if( ! empty( $ca_responsive ) ) {
            $responsive_args = array();
            
            foreach ( $ca_responsive as $key => $responsive ) {

                extract(shortcode_atts(array(
                    'ca_res_breakpoint'         => 767,
                    'ca_res_slidestoshow'       => 1,
                    'ca_res_slidestoscroll'     => 1,
                ), $responsive));

                $responsive_args[] = array(
                    'breakpoint'    => $ca_res_breakpoint,
                    'settings'      => array(
                        'slidesToShow'      => intval( $ca_res_slidestoshow ) > 0 ? intval( $ca_res_slidestoshow ) : 1,
                        'slidesToScroll'    => intval( $ca_res_slidestoscroll ) > 0 ? intval( $ca_res_slidestoscroll ) : 1,
                    ),
                );
            }

            $carousel_args['responsive'] = $responsive_args;
        }

        $html = '';
        if( function_exists( 'tokoo_brands_carousel' ) ) {
            ob_start();
            tokoo_brands_carousel( $section_args, $taxonomy_args, $carousel_args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_brands_carousel' , 'tokoo_brands_carousel_element' );