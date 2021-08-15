<?php
/**
 * Tokoo WooCommerce Class
 *
 * @package  tokoo
 * @author   MadrasThemes
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Tokoo_WooCommerce' ) ) :

    /**
     * The Tokoo WooCommerce Integration class
     */
    class Tokoo_WooCommerce {

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {
            $this->includes();
            $this->init_hooks();
        }

        /**
         * Includes classes and other files required
         */
        public function includes() {
            require_once get_template_directory() . '/inc/woocommerce/classes/class-tokoo-wc-helper.php';
            require_once get_template_directory() . '/inc/woocommerce/classes/class-tokoo-categories.php';
            require_once get_template_directory() . '/inc/woocommerce/classes/class-tokoo-increment-decrement.php';
        }
        
        /**
        * Hooks into actionsand filters
        */
        private function init_hooks(){
            add_filter( 'body_class',                               array( $this, 'woocommerce_body_class' ) );
            add_action( 'wp_enqueue_scripts',                       array( $this, 'woocommerce_scripts' ),  20 );
            add_filter( 'woocommerce_enqueue_styles',               '__return_empty_array' );
            add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
            add_filter( 'woocommerce_cross_sells_columns',          array( $this, 'set_cross_sells_columns' ) );
            add_filter( 'post_class',                               array( $this, 'wc_product_class' ), 10, 3 );
        }

        /**
         * WooCommerce specific scripts & stylesheets
         *
         * @since 1.0.0
         */
        public function woocommerce_scripts() {
            global $tokoo_version;

            $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
            
            wp_enqueue_style( 'tokoo-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), $tokoo_version );
            wp_style_add_data( 'tokoo-woocommerce-style', 'rtl', 'replace' );
        }

        /**
         * Add 'woocommerce-active' class to the body tag
         *
         * @param  array $classes css classes applied to the body tag.
         * @return array $classes modified to include 'woocommerce-active' class
         */
        public function woocommerce_body_class( $classes ) {
            if ( tokoo_is_woocommerce_activated() ) {
                $classes[] = 'woocommerce-active';
            }

            if ( tokoo_is_product_archive() ) {
                $classes[] = 'woocommerce-shop';
            }

            if ( is_cart() && WC()->cart->is_empty() ) {
                $classes[] = 'woocommerce-cart-empty';
            }

            return $classes;
        }

        public function wc_product_class( $classes, $class, $product_id ) {
            if ( is_a( $product_id, 'WC_Product' ) ) {
                $product    = $product_id;
                $product_id = $product_id->get_id();
                $post       = get_post( $product_id );
            } else {
                $post    = get_post( $product_id );
                $product = wc_get_product( $post->ID );
            }

            if ( is_a( $product, 'WC_Product' ) && get_option( 'woocommerce_enable_review_rating' ) === 'yes' && $product->get_rating_count() > 0 ) {
                $classes[] = 'has-rating';
            }

            return $classes;
        }

        /**
         * Related Products Args
         *
         * @param  array $args related products args.
         * @since 1.0.0
         * @return  array $args related products args
         */
        public function related_products_args( $args ) {
            $args = apply_filters( 'tokoo_related_products_args', array(
                'posts_per_page' => 6,
                'columns'        => 6,
            ) );

            return $args;
        }

        public function set_cross_sells_columns( $columns ) {
            $columns = apply_filters( 'tokoo_cross_sells_columns', 6 );
            return $columns;
        } 
    }
endif;

return new Tokoo_WooCommerce();