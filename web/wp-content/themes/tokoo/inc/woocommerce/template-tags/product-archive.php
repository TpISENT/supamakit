<?php
/**
 * Template tags used in product archive page
 */

if ( ! function_exists( 'tokoo_shop_control_bar' ) ) {
    function tokoo_shop_control_bar() {
        ?><div class="shop-control-bar">
            <?php do_action( 'tokoo_before_shop_control_bar' ); ?>
            <div class="shop-control-bar-left"><?php do_action( 'tokoo_shop_control_bar_left' ); ?></div>
            <div class="shop-control-bar-right"><?php do_action( 'tokoo_shop_control_bar_right' ); ?></div>
            
        </div><?php
    }
}

if ( ! function_exists( 'tokoo_wc_result_count' ) ) {
    function tokoo_wc_result_count() {
        if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
            return;
        }
        
        $total    = wc_get_loop_prop( 'total' );
        $per_page = wc_get_loop_prop( 'per_page' );
        $current  = wc_get_loop_prop( 'current_page' );

        ?><p class="woocommerce-result-count">
            <?php
            if ( $total <= $per_page || -1 === $per_page ) {
                /* translators: %d: total results */
                printf( _n( 'Showing the <strong>single</strong> product', 'Showing all <strong>%d</strong> products', $total, 'tokoo' ), $total );
            } else {
                $first = ( $per_page * $current ) - $per_page + 1;
                $last  = min( $total, $per_page * $current );
                /* translators: 1: first result 2: last result 3: total results */
                printf( _nx( 'Showing the <strong>single</strong> product', 'Showing <strong>%1$d&ndash;%2$d</strong> products from <strong>%3$d</strong> products', $total, 'with <strong>first</strong> and <strong>last</strong> product', 'tokoo' ), $first, $last, $total );
            }
            ?>
        </p><?php
    }
}

if ( ! function_exists( 'tokoo_wc_catalog_orderby' ) ) {
    function tokoo_wc_catalog_orderby( $options ) {
        $options = array(
            'menu_order' => esc_html__( 'Default', 'tokoo' ),
            'popularity' => esc_html__( 'Popularity', 'tokoo' ),
            'rating'     => esc_html__( 'Average rating', 'tokoo' ),
            'date'       => esc_html__( 'Newness', 'tokoo' ),
            'price'      => esc_html__( 'Price: low to high', 'tokoo' ),
            'price-desc' => esc_html__( 'Price: high to low', 'tokoo' ),
        );
        return $options;
    }
}

if ( ! function_exists( 'tokoo_wc_catalog_ordering' ) ) {
    function tokoo_wc_catalog_ordering() {
        ob_start();
        woocommerce_catalog_ordering();
        $wc_catalog_ordering = ob_get_clean();
        if ( ! empty( $wc_catalog_ordering ) ) : ?>
        <div class="tokoo-wc-catalog-ordering">
            <?php echo sprintf( wp_kses_post( __( 'Sort by %s', 'tokoo' ) ), $wc_catalog_ordering ); ?>
        </div><?php
        endif;
    }    
}

if ( ! function_exists( 'tokoo_wc_maybe_show_product_subcategories' ) ) {
    function tokoo_wc_maybe_show_product_subcategories() {
        wc_set_loop_prop( 'loop', 0 );
        $product_cat_columns = apply_filters( 'tokoo_product_cat_columns', 3 );
        $product_columns     = absint( max( 1, wc_get_loop_prop( 'columns', wc_get_default_products_per_row() ) ) );
        wc_set_loop_prop( 'columns', $product_cat_columns );
        $wc_sub_categories = woocommerce_maybe_show_product_subcategories( '' );
        wc_set_loop_prop( 'columns', $product_columns );
        if ( ! empty( $wc_sub_categories ) ) {
            ?><section class="section-product-categories"><h2 class="section-title"><?php echo sprintf( esc_html__( '%s Categories', 'tokoo' ), woocommerce_page_title( false ) ); ?></h2>
                <ul class="loop-product-categories columns-<?php echo esc_attr( $product_cat_columns ); ?>"><?php echo wp_kses_post(  $wc_sub_categories ); ?></ul></section><?php
        }
    }
}

if ( ! function_exists( 'tokoo_modify_wc_breadcrumb_args' ) ) {
    function tokoo_modify_wc_breadcrumb_args( $args ) {
        $args['delimiter'] = '<span class="delimiter"><i class="flaticon-arrows-1"></i></span>';
        return $args;
    }
}

if ( ! function_exists( 'tokoo_wc_products_header_title' ) ) {
    function tokoo_wc_products_header_title() {
        if( wc_get_loop_prop( 'total' ) ) : 
            ?><h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2><?php
        endif;
    }
}

if ( ! function_exists( 'tokoo_check_for_loop_total' ) ) {
    function tokoo_check_for_loop_total( $loop_wrap_html ) {
        if( tokoo_is_product_archive() && ! wc_get_loop_prop( 'total' ) ) {
            $loop_wrap_html = '';
        }
        return $loop_wrap_html;
    }
}

if ( ! function_exists( 'tokoo_get_shop_views' ) ) {
    /**
     * Get shop views available by tokoo
     */
    function tokoo_get_shop_views() {

        $shop_views = apply_filters( 'tokoo_get_shop_views_args', array(
            'list'          => array(
                'label'         => esc_html__( 'List View', 'tokoo' ),
                'icon'          => 'flaticon-list',
                'enabled'       => true,
                'active'        => false,
                
            ),
            'grid'              => array(
                'label'         => esc_html__( 'Grid View', 'tokoo' ),
                'icon'          => 'flaticon-squares',
                'enabled'       => true,
                'active'        => true,
            )
        ) );

        return $shop_views;
    }
}


if ( ! function_exists( 'tokoo_shop_view_switcher' ) ) {
    /**
     * Outputs view switcher
     */
    function tokoo_shop_view_switcher() {

        global $wp_query;

        if ( 1 === $wp_query->found_posts || ! woocommerce_products_will_display() ) {
            return;
        }

        $shop_views = tokoo_get_shop_views();
        ?>
        <ul class="shop-view-switcher">
        <?php foreach( $shop_views as $view_id => $shop_view ) : ?>
            <li><a id="tokoo-shop-view-switcher-<?php echo esc_attr( $view_id );?>" class="<?php $active_class = $shop_view[ 'active' ] ? 'active': ''; echo esc_attr( $active_class ); ?>" data-toggle="tab" title="<?php echo esc_attr( $shop_view[ 'label' ] ); ?>" href="#tokoo-shop-view-content"><i class="<?php echo esc_attr( $shop_view[ 'icon' ] ); ?>"></i></a></li>
        <?php endforeach; ?>
        </ul>
        <?php
    }
}

if ( ! function_exists( 'tokoo_shop_view_content_wrapper_open' ) ) {
    /**
     * Product show view content wrapper
     *
     * @since   1.0.0
     * @return  void
     */
    function tokoo_shop_view_content_wrapper_open() {
        $class = 'grid-view';
        $shop_views = tokoo_get_shop_views();
        foreach( $shop_views as $shop_view => $shop_view_args) {
            if ( $shop_view_args['active'] ) {
                $class = $shop_view . '-view';
                break;
            }
        }
        ?><div id="tokoo-shop-view-content" class="<?php echo esc_attr( $class ); ?>"><?php
    }
}

if ( ! function_exists( 'tokoo_shop_view_content_wrapper_close' ) ) {
    /**
     * Product show view content wrapper close
     *
     * @since   1.0.0
     * @return  void
     */
    function tokoo_shop_view_content_wrapper_close() {
        ?></div><!-- /#tokoo-shop-view-content --><?php
    }
}


if ( ! function_exists( 'tokoo_modify_wc_product_cat_widget_args' ) ) {
    function tokoo_modify_wc_product_cat_widget_args( $args ) {
        require_once get_template_directory() . '/inc/woocommerce/classes/class-tokoo-product-cat-list-walker.php';
        $args['walker'] = new Tokoo_WC_Product_Cat_List_Walker;
        return $args;
    }
}

if ( ! function_exists( 'tokooo_wc_layered_nav_term_html' ) ) {
    function tokooo_wc_layered_nav_term_html( $term_html, $term, $link, $count ) {
        $count_html = '';
        if ( $count > 0 ) {
            $count_html = '<span class="count">' . absint( $count ) . '</span>';    
        }
        
        if ( $link ) {
            $term_html = '<a class="woocommerce-widget-layered-nav-list__item__link" rel="nofollow" href="' . $link . '"><span class="checkbox-indicator"></span>' . esc_html( $term->name ) . '</a>' . $count_html;
        } else {
            $term_html = '<span>' . esc_html( $term->name ) . '</span>';
        }
        return '<div class="woocommerce-widget-layered-nav-list__item__inner">' . $term_html . '</div>';
    }
}

if ( ! function_exists( 'tokoo_wc_get_sidebar' ) ) {
    function tokoo_wc_get_sidebar() {
        if ( tokoo_is_product_archive() ) {
            woocommerce_get_sidebar();
        }
    }
}


if ( ! function_exists( 'tokoo_get_brands_taxonomy' ) ) {
    /**
     * Products Brand Taxonomy
     * 
     * @return string
     */
    function tokoo_get_brands_taxonomy() {
        return apply_filters( 'tokoo_product_brand_taxonomy', '' );
    }
}

if ( ! function_exists( 'tokoo_jumbotron' ) ) {
    function tokoo_jumbotron( $args = array() ) {
        tokoo_get_template( 'sections/jumbotron.php', $args );
    }
}

if( ! function_exists( 'tokoo_shop_archive_jumbotron' ) ) {
    function tokoo_shop_archive_jumbotron() {
        $static_block_id = '';
        $brands_taxonomy = tokoo_get_brands_taxonomy();

        if( is_shop() ) {
            $static_block_id = apply_filters( 'tokoo_shop_jumbotron_id', '' );
        } else if ( is_product_category() || is_tax( $brands_taxonomy ) ) {
            $term               = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
            $term_id            = $term->term_id;
            $static_block_id    = get_term_meta( $term_id, 'static_block_id', true );
        }

        if( ! empty( $static_block_id ) ) {
            if ( tokoo_is_elementor_activated() ) {
                $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $static_block_id );
            }

            if ( empty( $content ) && function_exists( 'kc_do_shortcode' ) ) {
                $raw_content = kc_raw_content( $static_block_id );
                $content = kc_do_shortcode( $raw_content );
            }

            if( empty( $content ) ) {
                $static_block = get_post( $static_block_id );
                $content = do_shortcode( $static_block->post_content );
            }
            echo '<div class="shop-archive-header">' . $content . '</div>';
        }
    }
}

if( ! function_exists( 'tokoo_shop_archive_bottom_jumbotron' ) ) {
    function tokoo_shop_archive_bottom_jumbotron() {
        $static_block_id = '';
        $brands_taxonomy = tokoo_get_brands_taxonomy();

        if( is_shop() ) {
            $static_block_id = apply_filters( 'tokoo_shop_bottom_jumbotron_id', '' );
        } else if ( is_product_category() || is_tax( $brands_taxonomy ) ) {
            $term               = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
            $term_id            = $term->term_id;
            $static_block_id    = get_term_meta( $term_id, 'static_block_bottom_id', true );
        }

        if( ! empty( $static_block_id ) ) {
            
            if ( tokoo_is_elementor_activated() ) {
                $content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $static_block_id );
            }

            if ( empty( $content ) && function_exists( 'kc_do_shortcode' ) ) {
                $raw_content = kc_raw_content( $static_block_id );
                $content = kc_do_shortcode( $raw_content );
            }

            if( empty( $content ) ) {
                $static_block = get_post( $static_block_id );
                $content = do_shortcode( $static_block->post_content );
            }
            echo '<div class="shop-archive-bottom">' . $content . '</div>';
        }
    }
}

if ( ! function_exists( 'tokoo_get_shop_catalog_mode' ) ) {
    /**
     * Shop Catelog Mode
     * 
     * @return bool
     */
    function tokoo_get_shop_catalog_mode() {
        return apply_filters( 'tokoo_shop_catalog_mode', false );
    }
}

if ( ! function_exists( 'tokoo_get_shop_layout' ) ) {
    function tokoo_get_shop_layout() {
        
        if ( is_product() ) {
            $layout = tokoo_get_single_product_layout();
        } else {
            $layout = apply_filters( 'tokoo_shop_layout', 'left-sidebar' );
        }

        return $layout;
    }
}

if ( ! function_exists( 'tokoo_wc_handheld_sidebar' ) ) {
    /**
     * Outputs WooCommerce Handheld Sidebar Toggle
     */
    function tokoo_wc_handheld_sidebar() {
        $layout = tokoo_get_shop_layout();
        if( apply_filters( 'tokoo_has_handheld_sidebar', true ) && in_array( $layout, array( 'left-sidebar', 'right-sidebar' ) ) ) {
            $handheld_sidebar_title = apply_filters( 'tokoo_handheld_sidebar_title', esc_html__( 'Filters', 'tokoo' ) );
            $handheld_sidebar_icon  = apply_filters( 'tokoo_handheld_sidebar_icon', 'fas fa-sliders-h' );
            ?><div class="handheld-sidebar-toggle"><button class="btn sidebar-toggler" type="button"><i class="<?php echo esc_attr( $handheld_sidebar_icon ); ?>"></i><span><?php echo esc_html( $handheld_sidebar_title ); ?></span></button></div><?php
        }
    }
}
