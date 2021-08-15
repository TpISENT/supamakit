<?php
/**
 * Template functions used in WooCommerce
 */



require_once get_template_directory() . '/inc/woocommerce/template-tags/header.php';
require_once get_template_directory() . '/inc/woocommerce/template-tags/product-item.php';
require_once get_template_directory() . '/inc/woocommerce/template-tags/product-archive.php';
require_once get_template_directory() . '/inc/woocommerce/template-tags/single-product.php';
require_once get_template_directory() . '/inc/woocommerce/template-tags/wc-pages.php';
require_once get_template_directory() . '/inc/woocommerce/template-tags/cart.php';
require_once get_template_directory() . '/inc/woocommerce/template-tags/loop.php';
require_once get_template_directory() . '/inc/woocommerce/integrations.php';

if ( ! function_exists( 'tokoo_promoted_products' ) ) {
    /**
     * Featured and On-Sale Products
     * Check for featured products then on-sale products and use the appropiate shortcode.
     * If neither exist, it can fallback to show recently added products.
     *
     * @since  1.5.1
     * @param integer $per_page total products to display.
     * @param integer $columns columns to arrange products in to.
     * @param boolean $recent_fallback Should the function display recent products as a fallback when there are no featured or on-sale products?.
     * @uses  tokoo_is_woocommerce_activated()
     * @uses  wc_get_featured_product_ids()
     * @uses  wc_get_product_ids_on_sale()
     * @uses  tokoo_do_shortcode()
     * @return void
     */
    function tokoo_promoted_products( $per_page = '2', $columns = '2', $recent_fallback = true ) {
        if ( tokoo_is_woocommerce_activated() ) {
            if ( wc_get_featured_product_ids() ) {
                echo '<h2>' . esc_html__( 'Featured Products', 'tokoo' ) . '</h2>';
                echo tokoo_do_shortcode(
                    'featured_products', array(
                        'per_page' => $per_page,
                        'columns'  => $columns,
                    )
                ); // WPCS: XSS ok.
            } elseif ( wc_get_product_ids_on_sale() ) {
                echo '<h2>' . esc_html__( 'On Sale Now', 'tokoo' ) . '</h2>';
                echo tokoo_do_shortcode(
                    'sale_products', array(
                        'per_page' => $per_page,
                        'columns'  => $columns,
                    )
                ); // WPCS: XSS ok.
            } elseif ( $recent_fallback ) {
                echo '<h2>' . esc_html__( 'New In Store', 'tokoo' ) . '</h2>';
                echo tokoo_do_shortcode(
                    'recent_products', array(
                        'per_page' => $per_page,
                        'columns'  => $columns,
                    )
                ); // WPCS: XSS ok.
            }
        }
    }
}