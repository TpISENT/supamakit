<?php

// Redux Framework
function tk_ext_remove_demo_mode_link() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
}

add_action( 'init', 'tk_ext_remove_demo_mode_link' );

// Jetpack
function tokoo_jetpack_remove_share() {

    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'tokoo_jetpack_remove_share' );

// WooCommerce
remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
require_once TOKOO_EXTENSIONS_DIR . '/includes/class-tokoo-shortcode-products.php';
require_once TOKOO_EXTENSIONS_DIR . '/includes/class-tokoo-products.php';

// Metabox
function tokoo_admin_meta_boxes_init() {
    include_once TOKOO_EXTENSIONS_DIR . '/includes/class-tokoo-admin-meta-boxes.php';
}

add_action( 'init', 'tokoo_admin_meta_boxes_init' );