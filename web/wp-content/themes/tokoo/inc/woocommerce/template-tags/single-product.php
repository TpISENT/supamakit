<?php

if ( ! function_exists( 'tokoo_single_product_header' ) ) {
    function tokoo_single_product_header() {
        ?><div class="single-product-header"><?php 
            do_action( 'tokoo_single_product_header' ); 
        ?></div><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_header_meta' ) ) {
    function tokoo_single_product_header_meta() {
        ?><div class="single-product-header-meta"><?php 
            do_action( 'tokoo_single_product_header_meta' );
        ?></div><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_body_open' ) ) {
    function tokoo_single_product_body_open() {
        ?><div class="single-product-body"><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_body_close' ) ) {
    function tokoo_single_product_body_close() {
        ?></div><!-- /.single-product-body --><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_aside' ) ) {
    function tokoo_single_product_aside() {
        ?><div class="single-product-aside"><?php 
            do_action( 'tokoo_single_product_aside' );
        ?></div><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_summar_inner_open' ) ) {
    function tokoo_single_product_summar_inner_open() {
        ?><div class="single-product-summary-inner"><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_summar_inner_close' ) ) {
    function tokoo_single_product_summar_inner_close() {
        ?></div><!-- /.single-product-summary-inner --><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_info' ) ) {
    function tokoo_single_product_info() {
        ?><div class="single-product-info"><?php 
    }
}

if ( ! function_exists( 'tokoo_single_product_info_close' ) ) {
    function tokoo_single_product_info_close() {
        ?></div><?php 
    }
}

if ( ! function_exists( 'tokoo_single_product_detail_box_open' ) ) {
    function tokoo_single_product_detail_box_open() {
        ?><div class="single-product-detail-box"><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_detail_box_close' ) ) {
    function tokoo_single_product_detail_box_close() {
        ?></div><!-- /.single-product-detail-box --><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_additional_info' ) ) {
    function tokoo_single_product_additional_info() {
        ?><div class="additional-info"></div><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_wishlist_compare_open' ) ) {
    function tokoo_single_product_wishlist_compare_open() {
        ?><div class="single-product-whislist-compare"><?php
    }
}

if ( ! function_exists( 'tokoo_single_product_wishlist_compare_close' ) ) {
    function tokoo_single_product_wishlist_compare_close() {
        ?></div><!-- /.single-product-whislist-compare --><?php
    }
}

if ( ! function_exists( 'tokoo_format_single_product_price' ) ) {
    function tokoo_format_single_product_price( $price, $regular_price, $sale_price ) {
        if ( is_product() ) {
            $price = '<ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins> <del>' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del>';
        }
        return $price;
    }
}

if ( ! function_exists( 'tokoo_modify_show_option_none' ) ) {
    function tokoo_modify_show_option_none( $args ) {
        $args['show_option_none'] = esc_html__( 'Select', 'tokoo' );
        return $args;
    }
}

if ( ! function_exists( 'tokoo_wc_tabs_outer_open' ) ) {
    function tokoo_wc_tabs_outer_open() {
        ?><div class="wc-tabs-outer"><div class="container"><?php
    }
}

if ( ! function_exists( 'tokoo_wc_tabs_outer_close' ) ) {
    function tokoo_wc_tabs_outer_close() {
        ?></div></div><!-- /.wc-tabs-outer --><?php
    }
}


if ( ! function_exists ( 'tokoo_wrap_single_product' ) ) {
    /**
     * 
     */
    function tokoo_wrap_single_product() {
        ?>
        <div class="single-product-inner">
        <?php
    }
}

if ( ! function_exists( 'tokoo_wrap_single_product_close' ) ) {
    /**
     * 
     */
    function tokoo_wrap_single_product_close() {
        ?>
        </div><!-- /.single-product-inner -->
        <?php
    }
}

if ( ! function_exists ( 'tokoo_wrap_product_images' ) ) {
    /**
     * 
     */
    function tokoo_wrap_product_images() {
        ?>
        <div class="product-images-wrapper">
        <?php
    }
}

if ( ! function_exists( 'tokoo_wrap_product_images_close' ) ) {
    /**
     * 
     */
    function tokoo_wrap_product_images_close() {
        ?>
        </div><!-- /.product-images-wrapper -->
        <?php
    }
}


if ( ! function_exists( 'tokoo_wc_show_product_images' ) ) {
    function tokoo_wc_show_product_images() {
        global $product;

        $columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
        $post_thumbnail_id = $product->get_image_id();
        $attachment_ids    = $product->get_gallery_image_ids();
        $wrapper_id        = 'tokoo-single-product-gallery-' . uniqid();
        $wrapper_classes   = apply_filters( 'tokoo_single_product_image_gallery_classes', array(
            'tokoo-product-gallery',
            'tokoo-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
            'tokoo-product-gallery--columns-' . absint( $columns ),
            'tokoo-thumb-count-' . count( $attachment_ids ),
            'images',
        ) );
        $carousel_single_args     = apply_filters( 'tokoo_product_single_carousel_args', array(
            'infinite'          => false,
            'slidesToShow'      => 1,
            'slidesToScroll'    => 1,
            'arrows'            => false,
            'dots'              => false,
            'asNavFor'          => '#' . $wrapper_id . ' .tokoo-single-product-gallery-thumbnails__wrapper'
        ) );
        $carousel_gallery_args    = apply_filters( 'tokoo_wc_product_gallery_carousel_args', array(
            'infinite'          => false,
            'slidesToShow'      => 5,
            'slidesToScroll'    => 1,
            'arrows'            => true,
            'dots'              => false,
            'asNavFor'          => '#' . $wrapper_id . ' .woocommerce-product-gallery__wrapper',
            'vertical'          => true,
            'verticalSwiping'   => true,
            'focusOnSelect'     => true,
            'touchMove'         => true,
            'responsive'        => array(
                array(
                    'breakpoint'    => 767,
                    'settings'      => array(
                        'vertical'          => false,
                        'verticalSwiping'   => false,
                        'slidesToShow'      => 3
                    )
                )
            )
        ) );

        if( is_rtl() ) {
            $carousel_single_args['rtl'] = true;
        }

        $classes = '';
        if( apply_filters( 'tokoo_horizontal_product_thumbnails', false ) ) {
            $classes = ' horizontal-thumbnails';

            $carousel_gallery_args['dots'] = true;
            $carousel_gallery_args['arrows'] = false;
            $carousel_gallery_args['vertical'] = false;
            $carousel_gallery_args['verticalSwiping'] = false;
        }

        $thumbnail_hide = '';
        if( apply_filters( 'tokoo_horizontal_thumbnails_hide', false ) ) {
            $thumbnail_hide = 'thumbnails-hide';
        }

        ?>
        <div id="<?php echo esc_attr( $wrapper_id ); ?>" class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); echo esc_attr( $classes ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
            <div class="tokoo-single-product-gallery-images" data-ride="tk-slick-carousel" data-wrap=".woocommerce-product-gallery__wrapper" data-slick="<?php echo htmlspecialchars( json_encode( $carousel_single_args ), ENT_QUOTES, 'UTF-8' ); ?>">
                <?php
                    add_filter( 'woocommerce_single_product_flexslider_enabled', '__return_true' );
                    woocommerce_show_product_images();
                    add_filter( 'woocommerce_single_product_flexslider_enabled', '__return_false' );
                ?>
            </div>
            <div class="tokoo-single-product-gallery-thumbnails" data-ride="tk-slick-carousel" data-wrap=".tokoo-single-product-gallery-thumbnails__wrapper" data-slick="<?php echo htmlspecialchars( json_encode( $carousel_gallery_args ), ENT_QUOTES, 'UTF-8' ); ?>">
                <figure class="tokoo-single-product-gallery-thumbnails__wrapper <?php echo esc_attr( $thumbnail_hide ); ?>">
                    <?php
                    if ( has_post_thumbnail() ) {
                        $html  = tokoo_wc_get_gallery_image_html( $post_thumbnail_id );
                    } else {
                        $html  = '<div class="tokoo-wc-product-gallery__image--placeholder">';
                        $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'tokoo' ) );
                        $html .= '</div>';
                    }

                    echo apply_filters( 'tokoo_wc_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

                    if ( $attachment_ids && has_post_thumbnail() ) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            echo apply_filters( 'tokoo_wc_single_product_image_thumbnail_html', tokoo_wc_get_gallery_image_html( $attachment_id  ), $attachment_id );
                        }
                    }
                    ?>
                </figure>
            </div>
            <?php
                $custom_script = "
                    jQuery(document).ready( function($){
                        $( 'body' ).on( 'woocommerce_gallery_init_zoom', function( e ) {
                            $('.woocommerce-product-gallery__wrapper').slick( 'slickGoTo', 0 );
                        });
                    } );
                ";

                if( apply_filters( get_theme_support( 'wc-product-gallery-zoom' ), true ) ) {
                    $custom_script .= "
                        jQuery(document).ready( function($){
                            $( '.tokoo-single-product-gallery-images' ).each( function() {
                                var target = $( this ).find( '.woocommerce-product-gallery' );
                                    images = $( '.woocommerce-product-gallery__image', target );
                                var zoomTarget   = images,
                                    galleryWidth = target.width(),
                                    zoomEnabled  = false;

                                $( zoomTarget ).each( function( index, target ) {
                                    var image = $( target ).find( 'img' );

                                    if ( image.data( 'large_image_width' ) > galleryWidth ) {
                                        zoomEnabled = true;
                                        return false;
                                    }
                                } );

                                // But only zoom if the img is larger than its container.
                                if ( zoomEnabled ) {
                                    var zoom_options = {
                                        touch: false
                                    };

                                    if ( 'ontouchstart' in window ) {
                                        zoom_options.on = 'click';
                                    }

                                    zoomTarget.trigger( 'zoom.destroy' );
                                    zoomTarget.zoom( zoom_options );
                                }
                            } );
                        } );
                    ";
                }

                wp_add_inline_script( 'tokoo-scripts', $custom_script );
            ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'tokoo_wc_get_gallery_image_html' ) ) {
    function tokoo_wc_get_gallery_image_html( $attachment_id, $main_image = false ) {
        $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
        $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
        $image_size        = apply_filters( 'woocommerce_gallery_image_size', $main_image ? 'woocommerce_single': $thumbnail_size );
        $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
        $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
        $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
        $image             = wp_get_attachment_image( $attachment_id, $image_size, false, array(
            'title'                   => get_post_field( 'post_title', $attachment_id ),
            'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
            'data-src'                => $full_src[0],
            'data-large_image'        => $full_src[0],
            'data-large_image_width'  => $full_src[1],
            'data-large_image_height' => $full_src[2],
            'class'                   => $main_image ? 'wp-post-image' : '',
        ) );

        return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="tokoo-wc-product-gallery__image">' . $image . '</div>';
    }
}

if ( ! function_exists ( 'tokoo_single_product_meta_open' ) ) {
    /**
     * 
     */
    function tokoo_single_product_meta_open() {
        ?>
        <div class="tokoo_single_product_header_meta">
        <?php
    }
}

if ( ! function_exists( 'tokoo_single_product_meta_close' ) ) {
    /**
     * 
     */
    function tokoo_single_product_meta_close() {
        ?>
        </div><!-- /.tokoo_single_product_meta -->
        <?php
    }
}


if ( ! function_exists( 'tokoo_single_product_brand' ) ) {
    function tokoo_single_product_brand( $product_id = null ) {
        global $product;
        if( ! $product_id ) {
            $product_id = $product->get_id();
        }
        $brand_html = tokoo_do_shortcode( 'mas_product_brand', array( 'post_id'  => $product_id ) );
        if ( ! empty( $brand_html ) ) : ?>

        <div class="brand">
            <?php echo wp_kses_post( $brand_html ); ?>
        </div><?php
        endif;
    }
}

if ( ! function_exists( 'tokoo_features_section' ) ) {
    /**
     * Display Features list
     */
    function tokoo_features_section( $args = array() ) {

        $features =  apply_filters( 'tokoo_features_section_args', array(
            array(
                'icon'              => 'fas fa-truck',
                'feature_title'     => esc_html__( 'Fast Shipping', 'tokoo' ),
                'feature_desc'      => esc_html__( 'Receive products in amazing time', 'tokoo' ),
            ),
            array(
                'icon'              => 'fas fa-undo',
                'feature_title'     => esc_html__( 'Easy Returns', 'tokoo' ),
                'feature_desc'      => esc_html__( 'Return policy that lets you shop at ease', 'tokoo' ),
            ),
            array(
                'icon'              => 'fas fa-shield-alt',
                'feature_title'     => esc_html__( 'Always Authentic', 'tokoo' ),
                'feature_desc'      => esc_html__( 'We only sell 100% authentic products', 'tokoo' ),
            ),
            array(
                'icon'              => 'fas fa-lock',
                'feature_title'     => esc_html__( 'Secure Shopping', 'tokoo' ),
                'feature_desc'      => esc_html__( 'Your data is always protected', 'tokoo' ),
            )
            
        ));
        
        if ( ! empty( $features ) && apply_filters( 'tokoo_enable_single_product_feature_list', true ) ) {
        ?>
        
        <div class="single-product-feature-list">
            <ul class="features">
                <?php foreach( $features as $feature ) : ?>
                    <?php if ( ! empty( $feature['feature_title'] ) ) : ?>
                    <li class="feature">
                        <div class="feature-inner">
                            <?php if ( ! empty( $feature['icon'] ) ) : ?>
                                <div class="feature-thumbnail">
                                    <i class="<?php echo esc_attr( $feature['icon'] ); ?>"></i>
                                </div>
                            <?php endif; ?>
                            <div class="feature-info">
                                <?php
                                    if( ! empty( $feature['feature_title'] ) ) {
                                        echo '<h3 class="feature-title">' . wp_kses_post( $feature['feature_title'] ) . '</h3>' ;
                                    }
                                ?>
                                <?php
                                    if( ! empty( $feature['feature_desc'] ) ) {
                                        echo '<span class="feature-desc">' . wp_kses_post( $feature['feature_desc'] ) . '</span>' ;
                                    }
                                ?>
                            </div>
                        </div>
                    </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
        }

    }
}


if ( ! function_exists ( 'tokoo_product_price_wrapper_open' ) ) {
    /**
     * 
     */
    function tokoo_product_price_wrapper_open() {
        ?>
        <div class="price-details">
        <?php
    }
}

if ( ! function_exists( 'tokoo_product_price_wrapper_close' ) ) {
    /**
     * 
     */
    function tokoo_product_price_wrapper_close() {
        ?>
        </div><!-- /.price-details -->
        <?php
    }
}

if ( ! function_exists ( 'tokoo_product_summary_detail_wrapper_open' ) ) {
    /**
     * 
     */
    function tokoo_product_summary_detail_wrapper_open() {
        ?>
        <div class="summary-details">
        <?php
    }
}

if ( ! function_exists( 'tokoo_product_summary_detail_wrapper_close' ) ) {
    /**
     * 
     */
    function tokoo_product_summary_detail_wrapper_close() {
        ?>
        </div><!-- /.summary-details -->
        <?php
    }
}

if ( ! function_exists ( 'tokoo_product_summary_action_block_open' ) ) {
    /**
     * 
     */
    function tokoo_product_summary_action_block_open() {
        ?>
        <div class="product-action-block">
        <?php
    }
}

if ( ! function_exists( 'tokoo_product_summary_action_block_close' ) ) {
    /**
     * 
     */
    function tokoo_product_summary_action_block_close() {
        ?>
        </div><!-- /.product-action-block -->
        <?php
    }
}

if( ! function_exists( 'tokoo_template_single_add_to_cart' ) ) {
    function tokoo_template_single_add_to_cart() {
        global $product;
        
        if( tokoo_get_shop_catalog_mode() == false ) {
            do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart'  );
        } elseif( tokoo_get_shop_catalog_mode() == true && $product->is_type( 'external' ) ) {
            do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart'  );
        }
    }
}


if ( ! function_exists( 'tokoo_wc_template_single_excerpt' ) ) {
    function tokoo_wc_template_single_excerpt() {
        ob_start();
        wc_get_template( 'single-product/short-description.php' );
        $excerpt = ob_get_clean();
        if ( ! empty( $excerpt ) ) { ?>
            <div class="woocommerce-product-details__short-description-wrapper">
                <h3 class="summary-label"><?php echo esc_html__( 'Highlights', 'tokoo' ); ?></h3>
                <?php echo wp_kses_post( $excerpt ); ?>
            </div><?php
        }
    }
}

if ( ! function_exists( 'tokoo_single_product_summary_last_detail' ) ) {
    function tokoo_single_product_summary_last_detail() {
        ?><div class="summary-last-detail">
            <?php
            /**
             * 
             */
            do_action( 'tokoo_single_product_summar_last_detail' ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'tokoo_wc_review_meta' ) ) {
    /**
     * Reviwe Verified Buyer changes
     */
    function tokoo_wc_review_meta( $comment ) {
        
        global $comment;
        $verified = wc_review_is_from_verified_owner( $comment->comment_ID );

        if ( '0' === $comment->comment_approved ) { ?>

            <p class="meta">
                <em class="woocommerce-review__awaiting-approval">
                    <?php esc_html_e( 'Your review is awaiting approval', 'tokoo' ); ?>
                </em>
            </p>

        <?php } else { ?>

            <p class="meta">
                <strong class="woocommerce-review__author"><?php comment_author(); ?> </strong>
                <?php
                if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
                    echo '<span class="woocommerce-review__verified verified">' . esc_attr__( 'Verified Buyer', 'tokoo' ) . '</span> ';
                }
                ?>
            </p>

        <?php
        }               
    }
}

if ( ! function_exists( 'tokoo_output_related_products' ) ) {
    function tokoo_output_related_products() {
        if ( apply_filters( 'tokoo_enable_related_products', true ) ) {
            woocommerce_output_related_products();
        }
    }
}