<?php

/**
 * Module Name          : Elementor Addons
 * Module Description   : Provides additional Elementor Elements for the Tokoo theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Tokoo_Elementor_Extensions' ) ) {
    final class Tokoo_Elementor_Extensions {

        /**
         * Tokoo_Extensions The single instance of Tokoo_Extensions.
         * @var     object
         * @access  private
         * @since   1.0.0
         */
        private static $_instance = null;

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __construct() {
            add_action( 'init', array( $this, 'setup_constants' ),  10 );
            add_action( 'elementor/elements/categories_registered', array( $this, 'add_widget_categories' ) );
            add_action( 'init', array( $this, 'elementor_widgets' ),  20 );
        }

        /**
         * Tokoo_Elementor_Extensions Instance
         *
         * Ensures only one instance of Tokoo_Elementor_Extensions is loaded or can be loaded.
         *
         * @since 1.0.0
         * @static
         * @return Tokoo_Elementor_Extensions instance
         */
        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Setup plugin constants
         *
         * @access public
         * @since  1.0.0
         * @return void
         */
        public function setup_constants() {

            // Plugin Folder Path
            if ( ! defined( 'TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR' ) ) {
                define( 'TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_URL' ) ) {
                define( 'TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_FILE' ) ) {
                define( 'TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_FILE', __FILE__ );
            }
        }

        /**
         * Widget Category Register
         *
         * @since  1.0.0
         * @access public
         */
        public function add_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'tokoo-elements',
                [
                    'title' => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
                    'icon' => 'fa fa-shopping-bag',
                ]
            );
        }

        /**
         * Widgets
         *
         * @since  1.0.0
         * @access public
         */
        public function elementor_widgets() {
            
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/brands-carousel.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/banner.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/product-categories.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/jumbotron.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/product-1-8-block.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/product-4-1-4-block.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/deals-carousel.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/features-list.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/about-header-section.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/about-content-section.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/job-section.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/team-member.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/products-carousel.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/slider-category-block.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/slider-product.php';
            require_once TOKOO_ELEMENTOR_PLUGIN_EXTENSIONS_DIR.'/widgets/vertical-menu.php';
        }

    }
}

if ( did_action( 'elementor/loaded' ) ) {
    // Finally initialize code
    Tokoo_Elementor_Extensions::instance();
}