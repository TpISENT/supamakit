<?php
/**
 * AWL plugin hooks
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class AWL_Hooks {

    /**
     * @var AWL_Hooks The single instance of the class
     */
    protected static $_instance = null;
    
    /**
     * Main AWL_Hooks Instance
     *
     * Ensures only one instance of AWL_Hooks is loaded or can be loaded.
     *
     * @static
     * @return AWL_Hooks - Main instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {

        if ( AWL()->get_settings( 'show_single' ) === 'false' ) {
            add_filter( 'awl_labels_hooks', array( $this, 'remove_single_hooks' ), 3 );
        }

        if ( AWL()->get_settings( 'show_default_sale' ) === 'false' ) {

            add_action( 'wp_head', array( $this, 'wp_head_sale_flash' ) );

            remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

            if ( AWL()->get_settings( 'show_single' ) === 'true' ) {
                add_filter( 'woocommerce_sale_flash', array( $this, 'remove_woocommerce_sale_flash' ) );
                remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
            }

            do_action( 'awl_hide_default_sale_flash' );

        }

        if ( AWL()->get_settings( 'show_default_stock' ) === 'false' ) {

            add_action( 'wp_head', array( $this, 'wp_head_stock_flash' ) );

            do_action( 'awl_hide_default_stock_flash' );

        }

        // Js seamless integration
        add_action( 'wp_footer', array( $this, 'js_integration' ) );

        // Hooks display option
        add_filter( 'awl_labels_hooks', array( $this, 'awl_labels_hooks' ), 2 );

        // On products save clear meta fields
        add_action( 'woocommerce_before_product_object_save', array( $this, 'clear_meta' ) );

    }

    /*
     * Remove label display hooks for single product page
     */
    public function remove_single_hooks( $hooks ) {

        if ( is_array( $hooks ) && ! empty( $hooks ) ) {
            foreach( $hooks as $position => $hooks_list_type ) {
                if ( isset( $hooks[$position]['single'] ) ) {
                    unset( $hooks[$position]['single'] );
                }
            }
        }

        return $hooks;

    }

    /*
     * Change custom display hooks with the hooks from the settings page
     */
    public function awl_labels_hooks( $hooks ) {

        $hooks_options = AWL()->get_settings( 'hooks' );
        $new_hooks = array();

        if ( $hooks_options && is_array( $hooks_options ) && ! empty( $hooks_options ) ) {
            foreach( $hooks_options as $hook ) {

                $position = $hook['position'];
                $priority = $hook['priority'] ? intval( $hook['priority'] ) : 10;
                $hook_name = in_array( $hook['hook'], array( 'custom action', 'custom filter' ) ) ? $hook['custom'] : $hook['hook'];
                $hook_type = $hook['hook'] === 'custom filter' ? 'filter' : 'action';

                if ( $hook_name ) {
                    $new_hooks[$position]['archive_custom'][$hook_name] = array( 'priority' => $priority, 'type' => $hook_type );
                }

            }

        }

        if ( ! empty( $new_hooks ) ) {
            foreach ( $new_hooks as $new_hooks_position => $new_hooks_args ) {
                foreach( $new_hooks_args as $new_hooks_arg_name => $new_hooks_arg_val ) {
                    $hooks[$new_hooks_position][$new_hooks_arg_name] = $new_hooks_arg_val;
                }
            }
        }

        return $hooks;

    }

    /*
     * Remove default sale flash
     */
    public function remove_woocommerce_sale_flash( $html ) {
        return '';
    }

    /*
     * Remove sale flash styles
     */
    public function wp_head_sale_flash() {

        $output = '';

        if ( defined( 'MFN_THEME_VERSION' ) ) {
            $output .= '<style>.product-loop-thumb .onsale { display: none; }</style>';
        }

        echo $output;

    }

    /*
     * Remove out of stock flash styles
     */
    public function wp_head_stock_flash() {

        $output = '';

        if ( class_exists( 'Avada' ) ) {
            $output .= '<style>.fusion-out-of-stock { display: none; }</style>';
        }

        if ( defined( 'MFN_THEME_VERSION' ) ) {
            $output .= '<style>.product-loop-thumb .soldout { display: none; }</style>';
        }

        echo $output;

    }

    /*
     * Js seamless integration method
     */
    public function js_integration() {

        $selectors = AWL_Helpers::get_js_selectors();

        if ( ! is_array( $selectors ) || empty( $selectors ) ) {
            return;
        }

        $json = json_encode( $selectors );

        $product_container = array( '.product' );

        /**
         * Filter js selectors for product container
         * @since 1.19
         * @param array $product_container Array of css selectors for product container
         */
        $product_container = apply_filters( 'awl_js_container_selectors', $product_container );

        $product_container_selector = implode( ',', $product_container );

        ?>

        <script>

            document.addEventListener('DOMContentLoaded', function() {

                if (!Element.prototype.matches) {
                    Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
                }
                if (!Element.prototype.closest) {
                    Element.prototype.closest = function(s) {
                        var el = this;

                        do {
                            if (el.matches(s)) return el;
                            el = el.parentElement || el.parentNode;
                        } while (el !== null && el.nodeType === 1);
                        return null;
                    };
                }

                setTimeout( function() {

                    var selectors = <?php echo $json; ?>;

                    for ( var property in selectors ) {

                        if ( selectors.hasOwnProperty( property ) ) {

                            var from = document.querySelectorAll(property);

                            if (from.length) {
                                for (var i = 0; i < from.length; i++) {

                                    var productContainer = from[i].closest("<?php echo $product_container_selector; ?>");

                                    if ( productContainer ) {

                                        var to = productContainer.querySelectorAll(selectors[property][0]);

                                        if (to.length && from[i] && to[0]) {

                                            var addTo = to[0];

                                            if (selectors[property][1] && selectors[property][1] === 'prepend') {
                                                addTo.prepend(from[i]);
                                            } else if (selectors[property][1] && selectors[property][1] === 'after') {
                                                addTo.after(from[i]);
                                            } else if (selectors[property][1] && selectors[property][1] === 'before') {
                                                addTo.before(from[i]);
                                            } else {
                                                addTo.append(from[i]);
                                            }

                                        }

                                        if ( from[i] ) {
                                            from[i].style.display = "flex";
                                        }

                                    }

                                }
                            }

                        }

                    }

                }, 200 );

            }, false);

        </script>

        <?php

    }

    /*
     * Clear percentage meta values
     */
    public function clear_meta( $object ) {
        $post_id = 'variation' === $object->get_type() ? $object->get_parent_id() : $object->get_id();
        delete_post_meta( $post_id, '_awl_save_percent_value' );
        delete_post_meta( $post_id, '_awl_save_amount_value' );
    }

}