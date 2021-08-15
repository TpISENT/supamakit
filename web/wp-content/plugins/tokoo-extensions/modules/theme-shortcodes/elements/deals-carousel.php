<?php

if ( ! function_exists( 'tokoo_deals_carousel_element' ) ) {

    function tokoo_deals_carousel_element( $atts, $content = null ){

        extract(shortcode_atts(array(
        	'show_header'       => '',
            'section_title'     => '',
            'header_timer'      => true,
            'timer_title'       => '',
            'timer_value'       => '',
            'bg_img'            => '',
            'shortcode_tag'     => 'recent_products',
            'per_page'          => 8,
            'orderby'           => 'date',
            'order'             => 'desc',
            'product_id'        => '',
            'category'          => '',
            'ca_infinite'       => false,
            'ca_rows'           => 2,
            'ca_slidesperrow'   => 4,
            'ca_slidestoshow'   => 1,
            'ca_slidestoscroll' => 1,
            'ca_dots'           => true,
            'ca_arrows'         => false,
            'ca_autoplay'       => false,
            'ca_responsive'     => array()
        ), $atts));

        $shortcode_atts = function_exists( 'tokoo_get_atts_for_shortcode' ) ? tokoo_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        $args = array(
        	'show_header'     	=> $show_header,
            'section_title'     => $section_title,
            'header_timer'      => $header_timer,
            'timer_title'       => $timer_title,
            'timer_value'       => $timer_value,
            'bg_img'            => isset( $bg_img ) && intval( $bg_img ) ? wp_get_attachment_url( $bg_img, 'full' ) : '',
            'shortcode_tag'     => $shortcode_tag,
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $ca_slidestoshow, 'per_page' => $per_page ) ),
            'carousel_args'     => array(
                'infinite'          => filter_var( $ca_infinite, FILTER_VALIDATE_BOOLEAN ),
                'rows'              => intval( $ca_rows ),
                'slidesPerRow'      => intval( $ca_slidesperrow ),
                'slidesToShow'      => intval( $ca_slidestoshow ),
                'slidesToScroll'    => intval( $ca_slidestoscroll ),
                'dots'              => filter_var( $ca_dots, FILTER_VALIDATE_BOOLEAN ),
                'arrows'            => filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ),
                'autoplay'          => filter_var( $ca_autoplay, FILTER_VALIDATE_BOOLEAN )
            ),
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
                    'ca_res_slidesperrow'       => 1,
                    'ca_res_slidestoshow'       => 1,
                    'ca_res_slidestoscroll'     => 1,
                ), $responsive));

                $responsive_args[] = array(
                    'breakpoint'    => $ca_res_breakpoint,
                    'settings'      => array(
                        'slidesPerRow'      => intval( $ca_res_slidesperrow ) > 0 ? intval( $ca_res_slidesperrow ) : 1,
                        'slidesToShow'      => intval( $ca_res_slidestoshow ) > 0 ? intval( $ca_res_slidestoshow ) : 1,
                        'slidesToScroll'    => intval( $ca_res_slidestoscroll ) > 0 ? intval( $ca_res_slidestoscroll ) : 1,
                    ),
                );
            }

            $args['carousel_args']['responsive'] = $responsive_args;

        }

        $html = '';
        if( function_exists( 'tokoo_flash_sale_block' ) ) {
            ob_start();
            tokoo_flash_sale_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_flash_sale_block' , 'tokoo_deals_carousel_element' );