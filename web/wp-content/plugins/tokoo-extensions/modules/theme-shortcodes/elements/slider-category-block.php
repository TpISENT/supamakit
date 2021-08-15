<?php

if ( ! function_exists( 'tokoo_slider_with_categories_block_element' ) ) {

    function tokoo_slider_with_categories_block_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'limit'             => '',
            'columns'           => '',
            'slugs'             => '',
            'hide_empty'        => ''
        ), $atts));

        $args = array(
            'category_args'    => array(
                'number'       => $limit,
                'columns'      => $columns,
                'slug'        => $slugs,
                'hide_empty'   => $hide_empty,
            )
        );

        $html = '';
        if( function_exists( 'tokoo_category_block' ) ) {
            ob_start();
            tokoo_category_block( $args );
            $html = ob_get_clean();
        }

        return $html;
    }
}

add_shortcode( 'tokoo_category_block' , 'tokoo_slider_with_categories_block_element' );