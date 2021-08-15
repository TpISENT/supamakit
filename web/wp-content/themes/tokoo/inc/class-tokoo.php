<?php
/**
 * Tokoo Class
 *
 * @author   MadrasThemes
 * @since    1.0.0
 * @package  tokoo
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Tokoo' ) ) :

    /**
     * The main Tokoo class
     */
    class Tokoo {

        /**
         * Setup class
         *
         * @since 1.0.0
         */

        public function __construct() {
            $this->includes();
            $this->init_hooks();
        }

        public function includes() {
            include_once get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';
        }

        public function init_hooks() {
            add_action( 'after_setup_theme',          array( $this, 'setup' ) );
            add_action( 'after_setup_theme',          array( $this, 'tokoo_template_debug_mode' ) );
            add_action( 'widgets_init',               array( $this, 'widgets_init' ) );
            add_action( 'widgets_init',               array( $this, 'widgets_register' ) );
            add_filter( 'body_class',                 array( $this, 'body_classes' ) );
            add_action( 'wp_enqueue_scripts',         array( $this, 'scripts' ),       10 );
            add_action( 'wp_enqueue_scripts',         array( $this, 'child_scripts' ), 30 ); // After WooCommerce.
            add_filter( 'get_terms_orderby',          array( $this, 'terms_orderby_slug_order' ), 10, 2 );
            add_action( 'admin_init',                 array( $this, 'add_theme_editor_style' ) );
            add_filter( 'wp_page_menu_args',          array( $this, 'page_menu_args' ) );
            add_action( 'tgmpa_register',             array( $this, 'required_plugins' ) );
        }

        /**
         * Sets up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support for post thumbnails.
         */
        public function setup() {
            /*
             * Load Localisation files.
             *
             * Note: the first-loaded translation file overrides any following ones if the same translation is present.
             */

            // Loads wp-content/languages/themes/tokoo-it_IT.mo.
            load_theme_textdomain( 'tokoo', trailingslashit( WP_LANG_DIR ) . 'themes/' );

            // Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
            load_theme_textdomain( 'tokoo', get_stylesheet_directory() . '/languages' );

            // Loads wp-content/themes/tokoo/languages/it_IT.mo.
            load_theme_textdomain( 'tokoo', get_template_directory() . '/languages' );

            /**
             * Add default posts and comments RSS feed links to head.
             */
            add_theme_support( 'automatic-feed-links' );

            /*
             * Enable support for Post Thumbnails on posts and pages.
             *
             * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
             */
            add_theme_support( 'post-thumbnails' );

            /**
             * Enable support for site logo
             */
            add_theme_support( 'custom-logo', apply_filters( 'tokoo_custom_logo_args', array(
                'height'      => 31,
                'width'       => 117,
                'flex-width'  => true,
                'flex-height' => true,
                'header-text' => array( 'site-title', 'site-description' ),
            ) ) );

            // This theme uses wp_nav_menu() in two locations.
            register_nav_menus( apply_filters( 'tokoo_register_nav_menus', array(
                'top-bar-left'      => esc_html__( 'Top Bar Left Menu', 'tokoo' ),
                'top-bar-right'     => esc_html__( 'Top Bar Right Menu', 'tokoo' ),
                'departments-menu'  => esc_html__( 'Departments Menu', 'tokoo' ),
                'primary-nav'       => esc_html__( 'Primary Nav Menu', 'tokoo' ),
                'secondary-nav'     => esc_html__( 'Secondary Nav Menu', 'tokoo' ),
                'hand-held-nav'     => esc_html__( 'Handheld Menu', 'tokoo' ),
            ) ) );

            /*
             * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
             * to output valid HTML5.
             */
            add_theme_support( 'html5', apply_filters( 'tokoo_html5_args', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'widgets',
            ) ) );

            /**
             *  Add support for the Site Logo plugin and the site logo functionality in JetPack
             *  https://github.com/automattic/site-logo
             *  http://jetpack.me/
             */
            add_theme_support( 'site-logo', apply_filters( 'tokoo_site_logo_args', array(
                'size' => 'full'
            ) ) );

            // Declare WooCommerce support.
            add_theme_support( 'woocommerce', apply_filters( 'tokoo_woocommerce_args', array(
                'product_grid'          => array(
                    'default_columns' => 4,
                    'default_rows'    => 5,
                    'min_columns'     => 1,
                    'max_columns'     => 8,
                    'min_rows'        => 1
                )
            ) ) );

            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-lightbox' );
            // add_theme_support( 'wc-product-gallery-slider' );

            // Declare support for title theme feature.
            add_theme_support( 'title-tag' );

            // Declare support for selective refreshing of widgets.
            add_theme_support( 'customize-selective-refresh-widgets' );
        }

        /**
         * Enables template debug mode
         */
        function tokoo_template_debug_mode() {
            if ( ! defined( 'TOKOO_TEMPLATE_DEBUG_MODE' ) ) {
                $status_options = get_option( 'woocommerce_status_options', array() );
                if ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) {
                    define( 'TOKOO_TEMPLATE_DEBUG_MODE', true );
                } else {
                    define( 'TOKOO_TEMPLATE_DEBUG_MODE', false );
                }
            }
        }

        /**
         * Register widget area.
         *
         * @link https://codex.wordpress.org/Function_Reference/register_sidebar
         */
        public function widgets_init() {
            $sidebar_args['sidebar_blog'] = array(
                'name'          => esc_html__( 'Blog Sidebar', 'tokoo' ),
                'id'            => 'sidebar-blog',
                'description'   => esc_html__( 'Widgets added to this region will appear in the blog and single post page.', 'tokoo' ),
                'widget_tags'   => array(
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<span class="gamma widget-title"><span>',
                    'after_title'   => '</span></span>',
                ),
            );

            $sidebar_args['sidebar_shop'] = array(
                'name'        => esc_html__( 'Shop Sidebar', 'tokoo' ),
                'id'          => 'sidebar-shop',
                'description' => ''
            );

            $rows    = intval( apply_filters( 'tokoo_footer_widget_rows', 1 ) );
            $regions = intval( apply_filters( 'tokoo_footer_widget_columns', 4 ) );
            for ( $row = 1; $row <= $rows; $row++ ) {
                for ( $region = 1; $region <= $regions; $region++ ) {
                    $footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
                    $footer   = sprintf( 'footer_%d', $footer_n );
                    if ( 1 == $rows ) {
                        $footer_region_name = sprintf( esc_html__( 'Footer Column %1$d', 'tokoo' ), $region );
                        $footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of the footer.', 'tokoo' ), $region );
                    } else {
                        $footer_region_name = sprintf( esc_html__( 'Footer Row %1$d - Column %2$d', 'tokoo' ), $row, $region );
                        $footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'tokoo' ), $region, $row );
                    }
                    $sidebar_args[ $footer ] = array(
                        'name'        => $footer_region_name,
                        'id'          => sprintf( 'footer-%d', $footer_n ),
                        'description' => $footer_region_description,
                    );
                }
            }

            $sidebar_args = apply_filters( 'tokoo_sidebar_args', $sidebar_args );

            foreach ( $sidebar_args as $sidebar => $args ) {
                $widget_tags = array(
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<span class="gamma widget-title">',
                    'after_title'   => '</span>',
                );

                /**
                 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
                 *
                 * 'tokoo_sidebar_shop_widget_tags'
                 *
                 */
                $filter_hook = sprintf( 'tokoo_%s_widget_tags', $sidebar );
                $widget_tags = apply_filters( $filter_hook, $widget_tags );

                if ( is_array( $widget_tags ) ) {
                    register_sidebar( $args + $widget_tags );
                }
            }
        }

        /**
         * Register widgets.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_sidebar
         */
        public function widgets_register() {

            include_once get_template_directory() . '/inc/widgets/class-tokoo-social-menu-widget.php';
            register_widget( 'Social_Menu_Widget' );
        }

        /**
         * Enqueue scripts and styles.
         *
         * @since  1.0.0
         */
        public function scripts() {
            global $tokoo_version;

            /**
             * Styles
             */
            wp_enqueue_style( 'tokoo-style', get_template_directory_uri() . '/style.css', '', $tokoo_version );
            wp_style_add_data( 'tokoo-style', 'rtl', 'replace' );

            if( apply_filters( 'tokoo_use_predefined_colors', true ) ) {
                $color_css_file = apply_filters( 'tokoo_primary_color', 'green' );
                wp_enqueue_style( 'tokoo-color', get_template_directory_uri() . '/assets/css/colors/' . $color_css_file . '.css', '', $tokoo_version );
            }



            /**
             * Fonts
             */
            $google_fonts = apply_filters( 'tokoo_google_font_families', array(
                'poppins'    => 'Poppins:300,400,500,600'
            ) );

            $query_args = array(
                'family' => implode( '%7c', $google_fonts ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

            if ( apply_filters( 'tokoo_load_default_fonts', true ) ) {
                wp_enqueue_style( 'tokoo-fonts', $fonts_url, array(), null );
            }



            wp_enqueue_style( 'tokoo-fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.css', '', $tokoo_version );
            wp_enqueue_style( 'tokoo-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', '', $tokoo_version );



            /**
             * Scripts
             */
            $suffix = '.min';
            wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper' . $suffix . '.js', array(), $tokoo_version, true );
            wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap' . $suffix . '.js', array( 'jquery', 'popper' ), $tokoo_version, true );

            if( apply_filters( 'tokoo_enable_scrollup', true ) ) {
                wp_enqueue_script( 'tokoo-easing-js', get_template_directory_uri() . '/assets/js/jquery.easing' . $suffix . '.js', array( 'jquery' ), $tokoo_version, true );
                wp_enqueue_script( 'tokoo-scrollup-js', get_template_directory_uri() . '/assets/js/scrollup' . $suffix . '.js', array( 'jquery' ), $tokoo_version, true );
            }

            wp_enqueue_script( 'waypoints-js',  get_template_directory_uri() . '/assets/js/jquery.waypoints'. $suffix . '.js', array( 'jquery' ), $tokoo_version, true );

            if( tokoo_has_sticky_header() ) {
                wp_enqueue_script( 'waypoints-sticky-js',   get_template_directory_uri() . '/assets/js/waypoints-sticky'. $suffix . '.js', array( 'jquery' ), $tokoo_version, true );
            }

            wp_enqueue_script( 'tokoo-navigation', get_template_directory_uri() . '/assets/js/navigation' . $suffix . '.js', array(), $tokoo_version, true );

            if( apply_filters( 'tokoo_enable_live_search', false ) ) {
                wp_enqueue_script( 'typeahead', get_template_directory_uri() . '/assets/js/typeahead.bundle'. $suffix . '.js', array( 'jquery' ), $tokoo_version, true );
                wp_enqueue_script( 'handlebars', get_template_directory_uri() . '/assets/js/handlebars'. $suffix . '.js', array( 'typeahead' ), $tokoo_version, true );
            }

            wp_enqueue_script( 'slick-carousel-js',   get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), $tokoo_version, true );

            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }

            $admin_ajax_url = admin_url( 'admin-ajax.php' );
            $current_lang   = apply_filters( 'wpml_current_language', NULL );

            if ( $current_lang ) {
                $admin_ajax_url = add_query_arg( 'lang', $current_lang, $admin_ajax_url );
            }

            wp_enqueue_script( 'masonry', get_template_directory_uri()  .'/assets/js/masonry.pkgd.min.js', array( 'jquery' ), $tokoo_version, true );

            wp_enqueue_script( 'tokoo-scripts', get_template_directory_uri() . '/assets/js/tokoo' . $suffix . '.js', array( 'jquery' ), $tokoo_version, true );

            if ( has_nav_menu( 'hand-held-nav' ) ) {
                $tokoo_l10n = array(
                    'expand'   => esc_html__( 'Expand child menu', 'tokoo' ),
                    'collapse' => esc_html__( 'Collapse child menu', 'tokoo' ),
                );

                wp_localize_script( 'tokoo-navigation', 'tokooScreenReaderText', $tokoo_l10n );
            }


            $tokoo_js_options = apply_filters( 'tokoo_localize_script_data', array(
                'ajax_url'              => admin_url( 'admin-ajax.php' ),
                'ajax_loader_url'       => get_template_directory_uri() . '/assets/images/ajax-loader.gif',
                'enable_live_search'    => apply_filters( 'tokoo_enable_live_search', false ),
                'live_search_limit'     => apply_filters( 'tokoo_live_search_limit', 10 ),
                'live_search_template'  => apply_filters( 'tokoo_live_search_template', '<a href="{{url}}" class="media live-search-media"><img src="{{image}}" class="media-left media-object flip pull-left" height="60" width="60"><div class="media-body"><p>{{{value}}}</p></div></a>' ),
                'live_search_empty_msg' => apply_filters( 'tokoo_live_search_empty_msg', esc_html__( 'Unable to find any products that match the current query', 'tokoo' ) ),
                'deal_countdown_text'   => apply_filters( 'tokoo_deal_countdown_timer_clock_text', array(
                    'days_text'     => esc_html__( 'Days', 'tokoo' ),
                    'hours_text'    => esc_html__( 'Hours', 'tokoo' ),
                    'mins_text'     => esc_html__( 'Mins', 'tokoo' ),
                    'secs_text'     => esc_html__( 'Secs', 'tokoo' ),
                ) ),
            ) );

            wp_localize_script( 'tokoo-scripts', 'tokoo_options', $tokoo_js_options );
        }

        public function add_theme_editor_style() {
            add_editor_style();
        }


        /**
         * Enqueue child theme stylesheet.
         * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
         * primary css and the separate WooCommerce css.
         *
         * @since  1.0.0
         */
        public function child_scripts() {
            if ( is_child_theme() ) {
                $child_theme = wp_get_theme( get_stylesheet() );
                wp_enqueue_style( 'tokoo-child-style', get_stylesheet_uri(), array(), $child_theme->get( 'Version' ) );
            }
        }

        /**
         * Terms orderby slug order.
         *
         * @since 1.0.0
         */
        public function terms_orderby_slug_order( $orderby, $args ) {
            if ( isset( $args['orderby'] ) && 'include' == $args['orderby'] ) {
                $args    = tokoo_get_atts_for_taxonomy_slugs( $args );
                $include = implode( ',', array_map( 'sanitize_text_field', $args['include'] ) );
                $orderby = "FIELD( t.slug, $include )";
            }

            return $orderby;
        }

        /**
         * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
         *
         * @param array $args Configuration arguments.
         * @return array
         */
        public function page_menu_args( $args ) {
            $args['show_home'] = true;
            return $args;
        }

        /**
         * Adds custom classes to the array of body classes.
         *
         * @param array $classes Classes for the body element.
         * @return array
         */
        public function body_classes( $classes ) {
            // Adds a class of group-blog to blogs with more than 1 published author.
            if ( is_multi_author() ) {
                $classes[] = 'group-blog';
            }

            if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
                $classes[]  = 'no-wc-breadcrumb';
            }

            if ( tokoo_is_redux_activated() ) {
                $classes[]  = 'redux-active';
            }

            if( ! apply_filters( 'tokoo_enable_single_product_feature_list', true ) ) {
                $classes[]  = 'single-product-without-feature';
            }

            if( get_post_type() == 'post' && apply_filters( 'tokoo_enable_post_icon_placeholder', false ) ) {
                $classes[]  = 'post-icon-active';
            }

            /**
             * What is this?!
             * Take the blue pill, close this file and forget you saw the following code.
             * Or take the red pill, filter tokoo_make_me_cute and see how deep the rabbit hole goes...
             */
            $cute = apply_filters( 'tokoo_make_me_cute', false );

            if ( true === $cute ) {
                $classes[] = 'tokoo-cute';
            }

            $classes[] = tokoo_get_layout_class();

            $classes[] = tokoo_get_page_extra_class();

            return $classes;
        }

        public function required_plugins() {
            global $tokoo_version;

            $plugins = apply_filters( 'tokoo_tgmpa_plugins', array(
                array(
                    'name'                  => esc_html__( 'Contact Form by WPForms', 'tokoo' ),
                    'slug'                  => 'wpforms-lite',
                    'required'              => false,
                    'version'               => '1.6.1',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'Envato Market', 'tokoo' ),
                    'slug'                  => 'envato-market',
                    'source'                => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
                    'required'              => false,
                    'version'               => '2.0.3',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'Tokoo Extensions', 'tokoo' ),
                    'slug'                  => 'tokoo-extensions',
                    'source'                => 'https://transvelo.github.io/tokoo/assets/plugins/tokoo-extensions.zip',
                    'required'              => false,
                    'version'               => $tokoo_version,
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'KingComposer', 'tokoo' ),
                    'slug'                  => 'kingcomposer',
                    'required'              => false,
                    'version'               => '2.9.5',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'Elementor', 'tokoo' ),
                    'slug'                  => 'elementor',
                    'required'              => false,
                    'version'               => '2.9.13',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'MAS WooCommerce Brands', 'tokoo' ),
                    'slug'                  => 'mas-woocommerce-brands',
                    'source'                => 'https://github.com/madrasthemes/mas-woocommerce-brands/archive/v1.0.1.zip',
                    'required'              => false,
                    'version'               => '1.0.3',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'One Click Demo Import', 'tokoo' ),
                    'slug'                  => 'one-click-demo-import',
                    'required'              => false,
                    'version'               => '2.5.2',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => 'Our Team by WooThemes',
                    'slug'                  => 'our-team-by-woothemes',
                    'source'                => 'https://transvelo.github.io/included-plugins/our-team-by-woothemes.zip',
                    'required'              => false,
                    'version'               => '1.4.1',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'Redux Framework', 'tokoo' ),
                    'slug'                  => 'redux-framework',
                    'required'              => true,
                    'version'               => '3.6.18',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'Regenerate Thumbnails', 'tokoo' ),
                    'slug'                  => 'regenerate-thumbnails',
                    'required'              => false,
                    'version'               => '3.1.3',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'Revolution Slider', 'tokoo' ),
                    'slug'                  => 'revslider',
                    'source'                => 'https://transvelo.github.io/included-plugins/revslider.zip',
                    'required'              => false,
                    'version'               => '6.2.15',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'WooCommerce', 'tokoo' ),
                    'slug'                  => 'woocommerce',
                    'required'              => true,
                    'version'               => '4.2.2',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'external_url'          => '',
                ),

                array(
                    'name'                  => esc_html__( 'YITH WooCommerce Wishlist', 'tokoo' ),
                    'slug'                  => 'yith-woocommerce-wishlist',
                    'required'              => false,
                    'version'               => '3.0.11',
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'is_callable'           => array( 'YITH_WCWL', 'get_instance' ),
                    'external_url'          => '',
                )

            ) );

            $config = apply_filters( 'tokoo_tgmpa_config', array(
                'domain'            => 'tokoo',
                'default_path'      => '',
                'parent_slug'       => 'themes.php',
                'menu'              => 'install-required-plugins',
                'has_notices'       => true,
                'is_automatic'      => false,
                'message'           => '',
                'strings'           => array(
                    'page_title'                      => esc_html__( 'Install Required Plugins', 'tokoo' ),
                    'menu_title'                      => esc_html__( 'Install Plugins', 'tokoo' ),
                    'installing'                      => esc_html__( 'Installing Plugin: %s', 'tokoo' ),
                    'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tokoo' ),
                    'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tokoo' ),
                    'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tokoo' ),
                    'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tokoo' ),
                    'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tokoo' ),
                    'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tokoo' ),
                    'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tokoo' ),
                    'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tokoo' ),
                    'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tokoo' ),
                    'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tokoo'  ),
                    'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'tokoo'  ),
                    'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tokoo' ),
                    'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tokoo' ),
                    'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'tokoo' ),
                    'nag_type'                        => 'updated'
                )
            ) );

            tgmpa( $plugins, $config );
        }
    }
endif;

return new Tokoo();
