<?php

add_filter( 'body_class', 'tokoo_woozone_body_class' );

if ( ! function_exists( 'tokoo_woozone_body_class' ) ) {
    function tokoo_woozone_body_class( $classes ) {
        $classes[] = 'woozone-active';
        return $classes;
    }
}