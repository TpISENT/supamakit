<?php
/**
 * Functions used in Home Pages
 */

if ( ! function_exists( 'tokoo_template_loop_product_thumbnail') ) {
    /**
     * Get the product thumbnail for the loop.
     */
    function tokoo_template_loop_product_thumbnail() {
        $thumbnail = woocommerce_get_product_thumbnail();
        echo apply_filters( 'tokoo_template_loop_product_thumbnail', $thumbnail );
    }
}

if ( ! function_exists( 'tokoo_template_loop_product_single_image') ) {
    /**
     * Get the product thumbnail for the loop.
     */
    function tokoo_template_loop_product_single_image() {
        $thumbnail = woocommerce_get_product_thumbnail( 'woocommerce_single' );
        echo apply_filters( 'tokoo_template_loop_product_thumbnail', $thumbnail );
    }
}


if ( ! function_exists( 'tokoo_add_4_1_4_main_product_hooks' ) ) {
    function tokoo_add_4_1_4_main_product_hooks() {
        
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',   10 );
        remove_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_rating',                            9  );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',                10 );
        
        add_action( 'woocommerce_before_shop_loop_item', 'tokoo_wrap_flex_div_open',                               3  );
        add_action( 'woocommerce_after_shop_loop_item', 'tokoo_wrap_flex_div_close',                               7  );
        add_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_template_loop_product_single_image',        70  );
        add_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_rating_wrap_open',                      1  );
        add_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_product_item_rating',                          2 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_wrapper_open',                           3 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',                    4 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_wrapper_close',                          5 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_rating_wrap_close',                      6 );
        
    }
}


if ( ! function_exists( 'tokoo_remove_4_1_4_main_product_hooks' ) ) {
    function tokoo_remove_4_1_4_main_product_hooks() {

        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',          10 );
        add_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_rating',                                    9 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',                       10 );

        remove_action( 'woocommerce_before_shop_loop_item', 'tokoo_wrap_flex_div_open',                                 3 );
        remove_action( 'woocommerce_after_shop_loop_item', 'tokoo_wrap_flex_div_close',                                 7 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_template_loop_product_single_image',          70 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_rating_wrap_open',                        1 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_product_item_rating',                           2 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_wrapper_open',                            3 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',                     4 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_wrapper_close',                           5 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_price_rating_wrap_close',                       6 );
        

        
    }
}

if ( ! function_exists( 'tokoo_add_1_8_main_product_hooks' ) ) {
    function tokoo_add_1_8_main_product_hooks() {

        remove_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_rating',                               9 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',     10 );

        add_action( 'woocommerce_before_shop_loop_item', 'tokoo_wrap_flex_div_open',                                  3 );
        add_action( 'woocommerce_after_shop_loop_item', 'tokoo_wrap_flex_div_close',                                  7 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_template_loop_product_single_image',           70 );
        add_action( 'woocommerce_shop_loop_item_title', 'tokoo_price_rating_wrap_open',                              11 );
        add_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_product_item_rating',                            5 );
        add_action( 'woocommerce_after_shop_loop_item', 'tokoo_price_rating_wrap_close',                              4 );
    }
}

if ( ! function_exists( 'tokoo_remove_1_8_main_product_hooks' ) ) {
    function tokoo_remove_1_8_main_product_hooks() {

        add_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_rating',                                9  );
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail',       10 );

       
        remove_action( 'woocommerce_before_shop_loop_item', 'tokoo_wrap_flex_div_open',                              3 );
        remove_action( 'woocommerce_after_shop_loop_item', 'tokoo_wrap_flex_div_close',                              7 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_template_loop_product_single_image',       70 );
        remove_action( 'woocommerce_shop_loop_item_title', 'tokoo_price_rating_wrap_open',                          11 );
        remove_action( 'woocommerce_after_shop_loop_item_title', 'tokoo_product_item_rating',                        5 );
        remove_action( 'woocommerce_after_shop_loop_item', 'tokoo_price_rating_wrap_close',                          4 );
    }
}


if ( ! function_exists( 'tokoo_add_slider_product_hooks' ) ) {
    function tokoo_add_slider_product_hooks() {

        remove_action( 'woocommerce_before_shop_loop_item', 'tokoo_product_item_header_open',                       5 );
        remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open',          10 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',       10 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close',   80 );
        remove_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_product_item_header_close',                90 );
        remove_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_rating',                             9  );
        remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_single_excerpt',                   15 );

        add_action( 'woocommerce_shop_loop_item_title', 'tokoo_template_loop_categories',           6 );
    }
}

if ( ! function_exists( 'tokoo_remove_slider_product_hooks' ) ) {
    function tokoo_remove_slider_product_hooks() {

        remove_action( 'woocommerce_shop_loop_item_title', 'tokoo_template_loop_categories',    6 );

        add_action( 'woocommerce_before_shop_loop_item', 'tokoo_product_item_header_open',                       5 );
        add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open',          10 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash',       10 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close',   80 );
        add_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_product_item_header_close',                90 );
        add_action( 'woocommerce_shop_loop_item_title', 'tokoo_product_item_rating',                             9  );
        add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_single_excerpt',                   15 );
    }
}