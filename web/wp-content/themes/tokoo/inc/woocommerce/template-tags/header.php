<?php
/**
 * WooCommerce Template functions used in header
 */

if ( ! function_exists( 'tokoo_cart_link_fragment' ) ) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param  array $fragments Fragments to refresh via AJAX.
     * @return array            Fragments to refresh via AJAX
     */
    function tokoo_cart_link_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        tokoo_cart_link();
        $fragments['a.cart-contents.header-icon-link'] = ob_get_clean();
        ob_start();
        tokoo_cart_header();
        $fragments['.cart-page-header'] = ob_get_clean();
        return $fragments;
    }
}
if ( ! function_exists( 'tokoo_cart_link' ) ) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function tokoo_cart_link() {
        $header_cart_icon             = apply_filters( 'tokoo_header_cart_icon', ' flaticon-shopping-cart' );
        ?><a class="cart-contents header-icon-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'tokoo' ); ?>">
            <i class="<?php echo esc_attr( $header_cart_icon ); ?>"></i>
            <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'tokoo' ), WC()->cart->get_cart_contents_count() ) );?></span>
        </a><?php
    }
}

if( ! function_exists( 'tokoo_products_live_search' ) ) {
    function tokoo_products_live_search() {
        if ( isset( $_REQUEST['fn'] ) && 'get_ajax_search' == $_REQUEST['fn'] ) {

            if( isset( $_REQUEST['terms'] ) ) {
                $term = $_REQUEST['terms'];
            }

            if ( empty( $term ) ) {
                echo json_encode( array() );
                die();
            }

            $data_store = WC_Data_Store::load( 'product' );
            $ids        = $data_store->search_products( $term, '', false );

            $results = array();

            if( ! empty( $ids ) ) {
                $product_objects = wc_get_products( apply_filters( 'tokoo_live_search_query_args', array( 'status' => array( 'publish' ), 'orderby' => 'date', 'order' => 'DESC', 'limit' => 10, 'include' => $ids ) ) );

                foreach ( $product_objects as $product_object ) {
                    $id = $product_object->get_id();
                    $title = get_the_title( $id );
                    $title = html_entity_decode( $title , ENT_QUOTES, 'UTF-8' );
                    $price = $product_object->get_price_html();
                    $brand = '';

                    if ( has_post_thumbnail( $id ) ) {
                        $post_thumbnail_ID = get_post_thumbnail_id( $id );
                        $post_thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_ID, 'thumbnail' );
                    } else{
                        $dimensions = wc_get_image_size( 'thumbnail' );
                        $post_thumbnail_src = array(
                            wc_placeholder_img_src(),
                            esc_attr( $dimensions['width'] ),
                            esc_attr( $dimensions['height'] )
                        );
                    }

                    $brand_taxonomy = class_exists( 'Mas_WC_Brands' ) ? Mas_WC_Brands()->get_brand_taxonomy() : '';
                    if( ! empty( $brand_taxonomy ) ) {
                        $terms = wc_get_product_terms( $id, $brand_taxonomy, array( 'fields' => 'names' ) );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            $brand_links = array();
                            foreach ( $terms as $term ) {
                                if( isset($term->name) ) {
                                    $brand_links[] = $term->name;
                                }
                            }
                            $brand = join( ", ", $brand_links );
                        }
                    }

                    $results[] = apply_filters( 'tokoo_live_search_results_args', array(
                        'value'     => $title,
                        'url'       => get_permalink( $id ),
                        'tokens'    => explode( ' ', $title ),
                        'image'     => $post_thumbnail_src[0],
                        'price'     => $price,
                        'brand'     => $brand,
                        'id'        => $id
                    ), $product_object );
                }

                wp_reset_postdata();
            }
            echo json_encode( $results );
        }
        die();
    }
}