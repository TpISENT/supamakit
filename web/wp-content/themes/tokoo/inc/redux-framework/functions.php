<?php
/**
 * Redux Framework functions
 *
 * @package Tokoo/ReduxFramework
 */

/**
 * Setup functions for theme options
 */

function tk_remove_demo_mode_link() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}

function tk_redux_disable_dev_mode_and_remove_admin_notices( $redux ) {
    remove_action( 'admin_notices', array( $redux, '_admin_notices' ), 99 );
    $redux->args['dev_mode'] = false;
    $redux->args['forced_dev_mode_off'] = false;
}

/**
 * Enqueues font awesome for Redux Theme Options
 * 
 * @return void
 */
function redux_queue_font_awesome() {
    wp_register_style( 'redux-fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), time(), 'all' );
    wp_enqueue_style( 'redux-fontawesome' );
}

/**
 * Gets product attribute taxonomies
 * 
 * @return array
 */
function redux_get_product_attr_taxonomies() {

    $product_attr_taxonomies = array();

    if( function_exists( 'tokoo_get_product_attr_taxonomies' ) ) {
        $product_attr_taxonomies = tokoo_get_product_attr_taxonomies();
    }

    return $product_attr_taxonomies;
}

require_once get_template_directory() . '/inc/redux-framework/functions/general-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/shop-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/blog-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/header-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/footer-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/style-functions.php';
require_once get_template_directory() . '/inc/redux-framework/functions/typography-functions.php';