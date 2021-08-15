<?php

/**
 * Module Name          : Theme Shortcodes
 * Module Description   : Provides additional shortcodes for the Tokoo theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( ! class_exists( 'Tokoo_Shortcodes' ) ) {
    class Tokoo_Shortcodes {

        /**
         * Constructor function.
         * @access  public
         * @since   1.0.0
         * @return  void
         */
        public function __construct() {
            add_action( 'init', array( $this, 'setup_constants' ),  10 );
            add_action( 'init', array( $this, 'includes' ),         10 );
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
            if ( ! defined( 'TOKOO_EXTENSIONS_SHORTCODE_DIR' ) ) {
                define( 'TOKOO_EXTENSIONS_SHORTCODE_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'TOKOO_EXTENSIONS_SHORTCODE_URL' ) ) {
                define( 'TOKOO_EXTENSIONS_SHORTCODE_URL', plugin_dir_url( __FILE__ ) );
            }

            // Plugin Root File
            if ( ! defined( 'TOKOO_EXTENSIONS_SHORTCODE_FILE' ) ) {
                define( 'TOKOO_EXTENSIONS_SHORTCODE_FILE', __FILE__ );
            }
        }

        /**
         * Include required files
         *
         * @access public
         * @since  1.0.0
         * @return void
         */
        public function includes() {

            #-----------------------------------------------------------------
            # Shortcodes
            #-----------------------------------------------------------------

            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/products-carousel.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/product-categories.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/product-1-8-block.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/product-4-1-4-block.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/deals-carousel.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/about-content-section.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/about-header-section.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/banner.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/features-list.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/team-member.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/job-section.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/brands-carousel.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/jumbotron.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/slider-category-block.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/slider-product.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/vertical-menu.php';
            require_once TOKOO_EXTENSIONS_SHORTCODE_DIR . '/elements/compare-page.php';
        }
    }
}

// Finally initialize code
new Tokoo_Shortcodes();
