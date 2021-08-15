<?php

if ( ! function_exists( 'tokoo_product_categories_element' ) ) {

    function tokoo_product_categories_element( $atts, $content = null ){

        extract(shortcode_atts(array(
            'section_title'     => '',
            'limit'             => '',
            'columns'           => '',
            'slugs'             => '',
            'hide_empty'        => ''
        ), $atts));

        $args = array(
            'section_title'    => $section_title,
            'category_args'    => array(
                'number'       => $limit,
                'columns'      => $columns,
                'slug'        => $slugs,
                'hide_empty'   => $hide_empty,
            )
        );

        $html = '';
        if( function_exists( 'tokoo_product_categories' ) ) {
            ob_start();
            tokoo_product_categories( $args );
            $html = ob_get_clean();
        }

        return $html;
    }

}

add_shortcode( 'tokoo_product_categories' , 'tokoo_product_categories_element' );