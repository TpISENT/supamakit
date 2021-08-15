<?php
/**
 * Tokoo functions.
 *
 * @package tokoo
 */

if ( ! function_exists( 'tokoo_is_woocommerce_activated' ) ) {
    /**
     * Query WooCommerce activation
     */
    function tokoo_is_woocommerce_activated() {
        return class_exists( 'WooCommerce' ) ? true : false;
    }
}

if( ! function_exists( 'tokoo_is_woocommerce_extension_activated' ) ) {
    /**
     * Query WooCommerce Extension Activation.
     * @var  $extension main extension class name
     * @return boolean
     */
    function tokoo_is_woocommerce_extension_activated( $extension ) {
        if( tokoo_is_woocommerce_activated() ) {
            $is_activated = class_exists( $extension ) ? true : false;
        } else {
            $is_activated = false;
        }

        return $is_activated;
    }
}

if( ! function_exists( 'tokoo_is_yith_wcwl_activated' ) ) {
    /**
     * Checks if YITH Wishlist is activated
     *
     * @return boolean
     */
    function tokoo_is_yith_wcwl_activated() {
        return tokoo_is_woocommerce_extension_activated( 'YITH_WCWL' );
    }
}

if ( ! function_exists( 'tokoo_is_yith_wcan_activated' ) ) {
    /**
     * Checks if YITH WCAN is activated
     *
     * @return  boolean
     */
    function tokoo_is_yith_wcan_activated() {
        return function_exists( 'YITH_WCAN' );
    }
}

if( ! function_exists( 'tokoo_is_yith_woocompare_activated' ) ) {
    /**
     * Checks if YITH Compare is activated
     *
     * @return boolean
     */
    function tokoo_is_yith_woocompare_activated() {
        return tokoo_is_woocommerce_extension_activated( 'YITH_Woocompare' );
    }
}

if ( ! function_exists( 'tokoo_is_jetpack_activated' ) ) {
    function tokoo_is_jetpack_activated() {
        return class_exists( 'Jetpack' ) ? true : false;
    }
}

if ( ! function_exists( 'tokoo_is_dokan_activated' ) ) {
    /**
     * Check if Dokan is activated
     */
    function tokoo_is_dokan_activated() {
        return class_exists( 'WeDevs_Dokan' ) ? true : false;
    }
}


if ( ! function_exists( 'is_mas_brands_woocommerce_activated' ) ) {
    function is_mas_brands_woocommerce_activated() {
        return class_exists( 'Mas_WC_Brands' ) ? true : false;
    }
}

if ( ! function_exists( 'is_our_team_activated' ) ) {
    function is_our_team_activated() {
        return class_exists( 'Woothemes_Our_Team' ) ? true : false;
    }
}

if ( ! function_exists( 'tokoo_is_woozone_activated' ) ) {
    function tokoo_is_woozone_activated() {
        return class_exists( 'WooZone' ) ? true : false;       
    }
}

if( ! function_exists( 'tokoo_is_ocdi_activated' ) ) {
    /**
     * Check if One Click Demo Import is activated
     */
    function tokoo_is_ocdi_activated() {
        return class_exists( 'OCDI_Plugin' ) ? true : false;
    }
}

/**
 * Check if Redux Framework is activated
 */
if( ! function_exists( 'tokoo_is_redux_activated' ) ) {
    function tokoo_is_redux_activated() {
        return class_exists( 'ReduxFrameworkPlugin' ) ? true : false;
    }
}

/**
 * Checks if WPML is activated
 */
if( ! function_exists( 'tokoo_is_wpml_activated' ) ) {
    function tokoo_is_wpml_activated() {
        return function_exists( 'icl_object_id' ) && class_exists('SitePress');
    }
}

/**
 * Check if Elementor is activated
 */
if( ! function_exists( 'tokoo_is_elementor_activated' ) ) {
    function tokoo_is_elementor_activated() {
        return did_action( 'elementor/loaded' ) ? true : false;
    }
}

/**
 * Checks if the current page is a product archive
 * @return boolean
 */
function tokoo_is_product_archive() {
    if ( tokoo_is_woocommerce_activated() ) {
        if ( is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag() ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */

function tokoo_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
    if ( $args && is_array( $args ) ) {
        extract( $args );
    }

    $located = tokoo_locate_template( $template_name, $template_path, $default_path );

    if ( ! file_exists( $located ) ) {
        _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
        return;
    }

    // Allow 3rd party plugin filter template file from their plugin
    $located = apply_filters( 'tokoo_get_template', $located, $template_name, $args, $template_path, $default_path );

    do_action( 'tokoo_before_template_part', $template_name, $template_path, $located, $args );

    include( $located );

    do_action( 'tokoo_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path  /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function tokoo_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    if ( ! $template_path ) {
        $template_path = 'templates/';
    }

    if ( ! $default_path ) {
        $default_path = 'templates/';
    }

    // Look within passed path within the theme - this is priority
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name
        )
    );

    // Get default template
    if ( ! $template || TOKOO_TEMPLATE_DEBUG_MODE ) {
        $template = $default_path . $template_name;
    }

    // Return what we found
    return apply_filters( 'tokoo_locate_template', $template, $template_name, $template_path );
}

if ( ! function_exists( 'tokoo_get_header_version' ) ) {
    /**
     * Gets the Header version set in theme options
     */
    function tokoo_get_header_version() {
        global $post;

        $template_file = '';

        if ( isset( $post ) ) {
            $template_file = get_post_meta( $post->ID, '_wp_page_template', true );
        }

        switch( $template_file ) {
            case 'template-homepage-v1.php':
                $home_v1        = tokoo_get_home_v1_meta();
                $header_style   = ! empty( $home_v1['header_style'] ) ? $home_v1['header_style'] : 'v1';
                $header_version = apply_filters( 'tokoo_home_v1_header_version', $header_style );
                break;
            case 'template-homepage-v2.php':
                $home_v2        = tokoo_get_home_v2_meta();
                $header_style   = ! empty( $home_v2['header_style'] ) ? $home_v2['header_style'] : 'v2';
                $header_version = apply_filters( 'tokoo_home_v2_header_version', $header_style );
                break;
            case 'template-homepage-v3.php':
                $home_v3        = tokoo_get_home_v3_meta();
                $header_style   = ! empty( $home_v3['header_style'] ) ? $home_v3['header_style'] : 'v3';
                $header_version = apply_filters( 'tokoo_home_v3_header_version', $header_style );
                break;
            case 'template-homepage-v4.php':
                $home_v4        = tokoo_get_home_v4_meta();
                $header_style   = ! empty( $home_v4['header_style'] ) ? $home_v4['header_style'] : 'v4';
                $header_version = apply_filters( 'tokoo_home_v4_header_version', $header_style );
                break;
            case 'template-homepage-v5.php':
                $home_v5        = tokoo_get_home_v5_meta();
                $header_style   = ! empty( $home_v5['header_style'] ) ? $home_v5['header_style'] : 'v2';
                $header_version = apply_filters( 'tokoo_home_v5_header_version', $header_style );
                break;
            default:
                $header_version = apply_filters( 'tokoo_header_version', 'v1' );
        }
        
        return $header_version;
    }
}

if ( ! function_exists( 'tokoo_get_footer_version' ) ) {
    /**
     * Gets the Header version set in theme options
     */
    function tokoo_get_footer_version() {
        global $post;

        $template_file = '';

        if ( isset( $post ) ) {
            $template_file = get_post_meta( $post->ID, '_wp_page_template', true );
        }

        switch( $template_file ) {
            case 'template-homepage-v1.php':
                $home_v1        = tokoo_get_home_v1_meta();
                $footer_style   = ! empty( $home_v1['footer_style'] ) ? $home_v1['footer_style'] : 'v1';
                $footer_version = apply_filters( 'tokoo_home_v1_footer_version', $footer_style );
                break;
            case 'template-homepage-v2.php':
                $home_v2        = tokoo_get_home_v2_meta();
                $footer_style   = ! empty( $home_v2['footer_style'] ) ? $home_v2['footer_style'] : 'v2';
                $footer_version = apply_filters( 'tokoo_home_v2_footer_version', $footer_style );
                break;
            case 'template-homepage-v3.php':
                $home_v3        = tokoo_get_home_v3_meta();
                $footer_style   = ! empty( $home_v3['footer_style'] ) ? $home_v3['footer_style'] : 'v1';
                $footer_version = apply_filters( 'tokoo_home_v3_footer_version', $footer_style );
                break;
            case 'template-homepage-v4.php':
                $home_v4        = tokoo_get_home_v4_meta();
                $footer_style   = ! empty( $home_v4['footer_style'] ) ? $home_v4['footer_style'] : 'v1';
                $footer_version = apply_filters( 'tokoo_home_v4_footer_version', $footer_style );
                break;
            case 'template-homepage-v5.php':
                $home_v5        = tokoo_get_home_v5_meta();
                $footer_style   = ! empty( $home_v5['footer_style'] ) ? $home_v5['footer_style'] : 'v1';
                $footer_version = apply_filters( 'tokoo_home_v5_footer_version', $footer_style );
                break;
            default:
                $footer_version = apply_filters( 'tokoo_footer_version', 'v1' );
        }
        
        return $footer_version;
    }
}

if ( ! function_exists( 'tokoo_get_layout_class' ) ) {
    function tokoo_get_layout_class() {
        $classes = '';

        if( tokoo_is_woocommerce_activated() && is_woocommerce() ) {
            if( is_product() ) {
               // $classes = tokoo_get_single_product_layout();
            } else if( is_shop() || is_product_category() || is_tax( 'product_label' ) || is_tax( get_object_taxonomies( 'product' ) ) ) {
                $classes    = tokoo_get_shop_layout();
            }
        } elseif ( is_front_page() && is_home()) {
            // Default homepage
            $classes .= tokoo_get_blog_layout() . ' ' . tokoo_get_blog_style();

        } elseif ( is_front_page() ) {
            // static homepage
        } elseif ( is_home() ) {
            // blog page
            $classes .= tokoo_get_blog_layout() . ' ' . tokoo_get_blog_style();
        } elseif( is_page() || is_404() ) {
            // all pages
            $classes = apply_filters( 'tokoo_page_layout', 'full-width' );
        } elseif ( is_search() ) {
            // search
        } elseif ( is_single() ) {
            $classes = tokoo_get_single_post_layout();
        } else {
            //everything else
            if ( 'post' == get_post_type() ) {
                $classes .= tokoo_get_blog_layout() . ' ' . tokoo_get_blog_style();
            } else {
                $classes = apply_filters( 'tokoo_default_layout', 'blog full-width' );
            }
        }

        if ( is_sticky()) {
           $classes .= ' is-sticky';
       }

        return $classes;
    }
}


if ( ! function_exists( 'tokoo_clean_kses_post' ) ) {
    /**
     * Clean variables using wp_kses_post.
     * @param string|array $var
     * @return string|array
     */
    function tokoo_clean_kses_post( $var ) {
        return is_array( $var ) ? array_map( 'tokoo_clean_kses_post', $var ) : wp_kses_post( stripslashes( $var ) );
    }
}

if ( ! function_exists( 'tokoo_clean_kses_post_allow_iframe' ) ) {
    /**
     * Clean variables using wp_kses_post.
     * @param string|array $var
     * @return string|array
     */
    function tokoo_clean_kses_post_allow_iframe( $var ) {
        $allowed_html = wp_kses_allowed_html( 'post' );
        $allowed_html['iframe'] = array(
            'align' => true,
            'width' => true,
            'height' => true,
            'frameborder' => true,
            'name' => true,
            'src' => true,
            'id' => true,
            'class' => true,
            'style' => true,
            'scrolling' => true,
            'marginwidth' => true,
            'marginheight' => true,

        );
        return is_array( $var ) ? array_map( 'tokoo_clean_kses_post_allow_iframe', $var ) : wp_kses( stripslashes( $var ), $allowed_html );
    }
}

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.0.0
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function tokoo_do_shortcode( $tag, array $atts = array(), $content = null ) {
    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
        return false;
    }

    return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

require_once get_template_directory() . '/inc/functions/home.php';
require_once get_template_directory() . '/inc/functions/menu.php';
require_once get_template_directory() . '/inc/functions/page.php';