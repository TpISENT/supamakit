<?php

if ( ! function_exists( 'tokoo_home_v2_slider_product_element' ) ) {

    function tokoo_home_v2_slider_product_element( $atts, $content = null ){

        extract(shortcode_atts(array(
        	'is_enabled'        => '',
            'shortcode_tag'     => 'recent_products',
            'orderby'           => 'date',
            'order'             => 'desc',
            'product_id'        => '',
            'category'          => '',
            'limit'             => 1,
            'columns'           => 1
        ), $atts));

        $shortcode_atts = function_exists( 'tokoo_get_atts_for_shortcode' ) ? tokoo_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        $pr_args = array(
            'is_enabled'        => $is_enabled,
            'shortcode_tag'     => $shortcode_tag,
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'limit' => $limit ) )
        );

        $html = '';
        if( function_exists( 'tokoo_slider_product' ) ) {
            ob_start();
            tokoo_slider_product( $pr_args  );
            $html = ob_get_clean();
        }

        return $html;
    }
}

add_shortcode( 'slider_product' , 'tokoo_home_v2_slider_product_element' );