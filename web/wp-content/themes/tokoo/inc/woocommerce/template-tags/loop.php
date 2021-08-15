<?php
/**
 * Template Tags used in product loop
 */


if ( ! function_exists( 'tokoo_wrap_flex_div_open' ) ) {
    function tokoo_wrap_flex_div_open() {
        ?><div class="flex-div"><?php
    }
}

if ( ! function_exists( 'tokoo_wrap_flex_div_close' ) ) {
    function tokoo_wrap_flex_div_close() {
        ?></div><!-- /.flex-div --><?php
    }
}

if ( ! function_exists( 'tokoo_price_rating_wrap_open' ) ) {
    function tokoo_price_rating_wrap_open() {
        ?><div class="price-rating"><?php
    }
}

if ( ! function_exists( 'tokoo_price_rating_wrap_close' ) ) {
    function tokoo_price_rating_wrap_close() {
        ?></div><!-- /.price-rating --><?php
    }
}

if ( ! function_exists( 'tokoo_price_wrapper_open' ) ) {
    function tokoo_price_wrapper_open() {
        ?><span class="price-range"><?php echo esc_html__( 'Start From', 'tokoo' ); ?><?php
            
    }
}

if ( ! function_exists( 'tokoo_price_wrapper_close' ) ) {
    function tokoo_price_wrapper_close() {
        ?></span><?php 
            
    }
}



