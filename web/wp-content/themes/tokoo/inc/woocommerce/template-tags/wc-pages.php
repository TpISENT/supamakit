<?php
/**
 * Template functions used in WooCommerce pages
 */

if ( ! function_exists( 'tokoo_display_cart_total' ) ) {
    function tokoo_display_cart_total() {
        ?><div class="cart-total-proceed-to-checkout">
            <div class="label"><?php esc_html_e( 'Total', 'tokoo' ); ?></div>
            <div class="value"><?php wc_cart_totals_order_total_html(); ?></div>
        </div><?php
    }
}

if ( ! function_exists( 'tokoo_wrap_shipping_method_label' ) ) {
    function tokoo_wrap_shipping_method_label( $label, $method ) {
        return '<div class="shipping-method-label">' . $label . '</div>';
    }
}

if ( ! function_exists( 'tokoo_disable_coupon' ) ) {
    function tokoo_disable_coupon() {
        add_filter( 'woocommerce_coupons_enabled', '__return_false', 10 );
    }
}

if ( ! function_exists( 'tokoo_cart_coupon' ) ) {
    function tokoo_cart_coupon() {
        if ( apply_filters( 'tokoo_wc_coupons_enabled', 'yes' === get_option( 'woocommerce_enable_coupons' ) ) ) {
            ?><div class="cart-coupon coupon">
                <div class="coupon-form-intro">
                    <span class="flaticon-shopping"></span>
                    <div class="coupon-form-details">
                        <div class="coupon-form-title"><?php echo apply_filters( 'tokoo_coupon_form_title', esc_html__( 'Discount/Promo Code', 'tokoo' ) ); ?></div>
                        <?php 
                            $coupon_form_subtitle = apply_filters( 'tokoo_coupon_form_subtitle', sprintf( esc_html__( 'Don\'t have any yet ? %sCheckout our discount programs%s', 'tokoo' ), '<a href="#">', '</a>') );
                            if ( ! empty( $coupon_form_subtitle ) ) : ?>
                        <div class="coupon-form-subtitle"><?php echo wp_kses_post( $coupon_form_subtitle ); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="coupon-form">
                    <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon Code', 'tokoo' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter your coupon code here', 'tokoo' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'tokoo' ); ?>" />
                </div>
                <?php 
                    remove_filter( 'woocommerce_coupons_enabled', '__return_false', 10 );
                    do_action( 'woocommerce_cart_coupon' ); ?>
            </div><?php
        }
    }
}

if ( ! function_exists( 'tokoo_cart_header_contents' ) ) {
    function tokoo_cart_header_contents() {
        $cart_items = wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'tokoo' ), WC()->cart->get_cart_contents_count() ) );
        ob_start();
        wc_cart_totals_order_total_html();
        $cart_total = ob_get_clean();

        $cart_header_subtitle = sprintf( wp_kses_post( __( 'Review your cart with <strong>%s</strong> and total %s', 'tokoo' ) ), $cart_items, $cart_total );
          ?><h1 class="cart-header-title"><?php echo esc_html__( 'Your Shopping Cart Summary', 'tokoo' ); ?></h1>
            <div class="cart-header-subtitle"><?php echo wp_kses_post( $cart_header_subtitle ); ?></div>
        <?php
    }
}

if ( ! function_exists( 'tokoo_cart_header' ) ) {
    function tokoo_cart_header() {
        ?><div class="cart-page-header"><?php
            tokoo_cart_header_contents();
        ?></div><?php
    }
}

if ( ! function_exists( 'tokoo_cart_empty_icon' ) ) {
    function tokoo_cart_empty_icon() {
        $cart_empty_icon = apply_filters( 'tokoo_cart_empty_icon', 'flaticon-shopping-cart'); 
        ?><div class="cart-empty-icon"><i class="<?php echo esc_attr( $cart_empty_icon ); ?>"></i></div><?php
    }
}

if ( ! function_exists( 'tokoo_form_shipping_title' ) ) {
    function tokoo_form_shipping_title() {
        ?><h3 class="form-title"><?php echo esc_html__( 'Shipping Details', 'tokoo' ); ?></h3><?php
    }
}

if ( ! function_exists( 'tokoo_wc_checkout_login_form' ) ) {
    function tokoo_wc_checkout_login_form() {
        $checkout = WC()->checkout();
        
        if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
            return;
        }

        $info_message_html = '<div class="info-message-title">' . esc_html__( 'Already have an account ?', 'tokoo' ) . '</div>';
        $info_message_html .= '<div class="info-message-subtitle">' . sprintf( esc_html__( '%sLogin%s to autocomplete required information and speed up checkout process.', 'tokoo' ), '<a href="#" class="showlogin">', '</a>' ) . '</div>';

        $info_message  = apply_filters( 'woocommerce_checkout_login_message', $info_message_html );
        wc_print_notice( $info_message, 'notice' );

        ?><div class="checkout-login-form"><?php

        woocommerce_login_form(
            array(
                'message'  => esc_html__( 'Account Details', 'tokoo' ),
                'redirect' => wc_get_page_permalink( 'checkout' ),
                'hidden'   => true,
            )
        ); ?></div><?php
    }
}

if ( ! function_exists( 'tokoo_login_form_footer_open' ) ) {
    function tokoo_login_form_footer_open() {
        ?><div class="login-form-footer"><?php
    }
}

if ( ! function_exists( 'tokoo_login_form_footer_close' ) ) {
    function tokoo_login_form_footer_close() {
        ?></div><!-- /.login-form-footer --><?php
    }
}

if ( ! function_exists( 'tokoo_checkout_header' ) ) {
    function tokoo_checkout_header() {
        if ( ! ( tokoo_is_woocommerce_activated() && is_checkout() ) ) {
            return;
        }

        if ( is_wc_endpoint_url( 'order-received' ) ) {
            $checkout_page_title = esc_html__( 'Thank you! Your Order has successfully placed.', 'tokoo' );
        } else {
            $checkout_page_title = esc_html__( 'Complete Steps to Place Your Order', 'tokoo' );
        }

        ?><div class="checkout-page-header">
            <h1 class="checkout-page-title"><?php echo esc_html( $checkout_page_title ); ?></h1>
            <?php tokoo_checkout_steps(); ?>
        </div><?php
    }
}

if ( ! function_exists( 'tokoo_checkout_steps' ) ) {
    function tokoo_checkout_steps() {
        $is_step_confirmation = false;
        if ( apply_filters( 'tokoo_enable_checkout_steps', true ) ) :
            if ( is_wc_endpoint_url( 'order-received' ) ) {
                $is_step_confirmation = true;
            }
        ?>
        <ul class="nav checkout-steps" role="tablist">
            <li><a href="#customer-details" class="checkout-step always-active active"><?php echo esc_html__( 'Customer Details', 'tokoo' ); ?></a></li>
            <li><a href="#order-review" class="checkout-step review-step<?php if ( $is_step_confirmation ) : ?> always-active<?php endif;?>" ><?php echo esc_html__( 'Review & Pay', 'tokoo' ); ?></a></li>
            <li><a href="#" class="checkout-step<?php if ( $is_step_confirmation ) : ?> always-active<?php endif;?>"><?php echo esc_html__( 'Confirmation', 'tokoo' ); ?></a></li>
        </ul>
        <?php endif;
    }
}

if ( ! function_exists( 'tokoo_customer_details_open' ) ) {
    function tokoo_customer_details_open() {
        ?><div class="tab-content">
            <div class="customer-details-tab-pane" id="customer-details"><?php
    }
}

if ( ! function_exists( 'tokoo_customer_details_close' ) ) {
    function tokoo_customer_details_close() {
        ?></div><!-- /.tab-pane --><?php
    }
}

if ( ! function_exists( 'tokoo_order_review_open' ) ) {
    function tokoo_order_review_open() {
        ?><div class="order-review-tab-pane" id="order-review">
            <h3 class="section-title"><?php echo esc_html__( 'Order Review', 'tokoo' ); ?></h3><?php
    }
}

if ( ! function_exists( 'tokoo_order_review_close' ) ) {
    function tokoo_order_review_close() {
        ?></div><!-- /.tab-pane -->
        </div><!-- /.tab-content --><?php
    }
}

if ( ! function_exists( 'tokoo_add_order_item_totals_title' ) ) {
    function tokoo_add_order_item_totals_title( $total_rows, $order, $tax_display ) {
        $title_row = array(
            'section_title' => array(
                'label' => esc_html__( 'Order Totals', 'tokoo' ),
                'value' => ''
            )
        );
        
        $new_total_rows = array_merge( $title_row, $total_rows );
        foreach( $new_total_rows as $key => $total_row ) {
            $new_total_rows[ $key ]['label'] = rtrim( $total_row['label'], ':' );
        }

        return $new_total_rows;
    }
}

if ( ! function_exists( 'tokoo_payment_method_title' ) ) {
    function tokoo_payment_method_title() {
        ?><h3 class="woocommerce-order-payment-methods__title"><?php echo esc_html__( 'Payment Method', 'tokoo' ); ?></h3><?php
    }
}

if ( ! function_exists( 'tokoo_place_order_button_wrapper_open' ) ) {
    function tokoo_place_order_button_wrapper_open() {
        ?><div class="place-order-button-wrapper">
            <div class="place-order-left">
                <?php tokoo_review_order_totals(); ?>
            </div>
            <div class="place-order-right"><?php 
                tokoo_display_cart_total(); 
                ?><div class="button-terms"><?php
                add_filter( 'woocommerce_checkout_show_terms', '__return_true', 20 );
                wc_get_template( 'checkout/terms.php' );
                add_filter( 'woocommerce_checkout_show_terms', '__return_false', 20 );
    }
}

if ( ! function_exists( 'tokoo_place_order_button_wrapper_close' ) ) {
    function tokoo_place_order_button_wrapper_close() {
                ?></div><!-- /.button-terms -->
            </div><!-- /.place-order-right -->
        </div><!-- /.place-order-button-wrapper --><?php
    }
}

if ( ! function_exists( 'tokoo_review_order_totals' ) ) {
    function tokoo_review_order_totals() {
        ?><div class="review-order-totals">
            <h3><?php echo esc_html__( 'Cart Totals', 'tokoo' ); ?></h3>
            <table class="shop_table">
                <tbody>

                <tr class="cart-subtotal">
                    <th><?php esc_html_e( 'Subtotal', 'tokoo' ); ?></th>
                    <td><?php wc_cart_totals_subtotal_html(); ?></td>
                </tr>

                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                    <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                        <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                    <?php wc_cart_totals_shipping_html(); ?>

                    <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

                <?php endif; ?>

                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                    <tr class="fee">
                        <th><?php echo esc_html( $fee->name ); ?></th>
                        <td><?php wc_cart_totals_fee_html( $fee ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                    <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                            <tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                                <th><?php echo esc_html( $tax->label ); ?></th>
                                <td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="tax-total">
                            <th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                            <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

                <tr class="order-total">
                    <th><?php esc_html_e( 'Total', 'tokoo' ); ?></th>
                    <td><?php wc_cart_totals_order_total_html(); ?></td>
                </tr>

                <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
            </tbody>
        </table>
    </div><?php
    }
}