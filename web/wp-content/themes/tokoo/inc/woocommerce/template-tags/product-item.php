<?php
/**
 * Template functions used in Product Item i.e. content-product.php
 */

if ( ! function_exists( 'tokoo_product_item_wrap_open' ) ) {
    function tokoo_product_item_wrap_open() {
        ?><div class="product-outer">
            <div class="product-inner"><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_wrap_close' ) ) {
    function tokoo_product_item_wrap_close() {
        ?></div><!-- /.product-inner -->
    </div><!-- /.product-outer --><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_header_open' ) ) {
    function tokoo_product_item_header_open() {
        ?><div class="product-header"><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_header_close' ) ) {
    function tokoo_product_item_header_close() {
        ?></div><!-- /.product-header --><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_footer_open' ) ) {
    function tokoo_product_item_body_open() {
        ?><div class="product-body"><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_body_close' ) ) {
    function tokoo_product_item_body_close() {
        ?></div><!-- /.product-body --><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_footer_open' ) ) {
    function tokoo_product_item_footer_open() {
        ?><div class="product-footer"><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_footer_close' ) ) {
    function tokoo_product_item_footer_close() {
        ?></div><!-- /.product-footer --><?php
    }
}

if ( ! function_exists( 'tokoo_product_item_rating' ) ) {
    function tokoo_product_item_rating() {
        global $product;

        if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
            return;
        }

        $rating_count = $product->get_rating_count();
        $review_count = $product->get_review_count();
        $average      = $product->get_average_rating();

        if ( $rating_count > 0 ) : ?>

            <div class="woocommerce-product-rating">
                <?php echo wc_get_rating_html( $average, $rating_count ); ?>
                <span class="woocommerce-review-count"><?php printf( _n( '%s review', '%s reviews', $review_count, 'tokoo' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></span>
            </div>

        <?php endif;
    }
}

if ( ! function_exists( 'tokoo_modify_add_to_cart_args' ) ) {
    function tokoo_modify_add_to_cart_args( $args, $product ) {
        $args['class'] .= ' btn-action';
        return $args;
    }
}

if ( ! function_exists( 'tokoo_subcategory_count_html' ) ) {
    function tokoo_subcategory_count_html( $count_html, $category ) {
        return '<mark class="count">' . sprintf( esc_html__( '%s products', 'tokoo' ), $category->count ) . '</mark>';
    }
}

if ( ! function_exists( 'tokoo_template_loop_categories' ) ) {
    /**
     * Output Product Categories
     *
     */
    function tokoo_template_loop_categories() {
        global $product;

        $product_id = tokoo_wc_get_product_id( $product );
        $categories = wc_get_product_category_list( $product_id );

        echo apply_filters( 'tokoo_template_loop_categories_html', wp_kses_post( sprintf( '<span class="loop-product-categories">%s</span>', $categories ) ) );
    }
}

if( ! function_exists( 'tokoo_wc_get_product_id' ) ) {
    function tokoo_wc_get_product_id( $product ) {
        return $product->get_id();
    }
}