<?php
/**
 * Plugin Name:    	Tokoo Extensions
 * Plugin URI:     	https://madrasthemes.com/tokoo
 * Description:    	This selection of extensions compliment our lean and mean theme for WooCommerce, Tokoo. Please note: they don’t work with any WordPress theme, just tokoo.
 * Author:         	MadrasThemes
 * Author URI:     	https://madrasthemes.com/
 * Version:        	1.1.10
 * Text Domain: 	tokoo-extensions
 * Domain Path: 	/languages
 * WC tested up to: 4.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Tokoo_Extensions' ) ) {
	/**
	 * Main Tokoo_Extensions Class
	 *
	 * @class Tokoo_Extensions
	 * @version	1.0.0
	 * @since 1.0.0
	 * @package	Tokoo
	 * @author Ibrahim
	 */
	final class Tokoo_Extensions {
		/**
		 * Tokoo_Extensions The single instance of Tokoo_Extensions.
		 * @var 	object
		 * @access  private
		 * @since 	1.0.0
		 */
		private static $_instance = null;

		/**
		 * The token.
		 * @var     string
		 * @access  public
		 * @since   1.0.0
		 */
		public $token;

		/**
		 * The version number.
		 * @var     string
		 * @access  public
		 * @since   1.0.0
		 */
		public $version;

		/**
		 * Constructor function.
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function __construct () {

			$this->token 	= 'tokoo-extensions';
			$this->version 	= '1.0.0';

			add_action( 'plugins_loaded', array( $this, 'setup_constants' ),		10 );
			add_action( 'plugins_loaded', array( $this, 'includes' ),				20 );
			// add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ),	30 );
		}

		/**
		 * Main Tokoo_Extensions Instance
		 *
		 * Ensures only one instance of Tokoo_Extensions is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 * @static
		 * @see Tokoo_Extensions()
		 * @return Main Tokoo instance
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
			if ( ! defined( 'TOKOO_EXTENSIONS_DIR' ) ) {
				define( 'TOKOO_EXTENSIONS_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'TOKOO_EXTENSIONS_URL' ) ) {
				define( 'TOKOO_EXTENSIONS_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'TOKOO_EXTENSIONS_FILE' ) ) {
				define( 'TOKOO_EXTENSIONS_FILE', __FILE__ );
			}

			// Modules File
			if ( ! defined( 'TOKOO_MODULES_DIR' ) ) {
				define( 'TOKOO_MODULES_DIR', TOKOO_EXTENSIONS_DIR . '/modules' );
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
			require TOKOO_EXTENSIONS_DIR . '/includes/functions.php';

			#-----------------------------------------------------------------
			# Static Block Post Type
			#-----------------------------------------------------------------
			require_once TOKOO_MODULES_DIR . '/post-types/static-block/static-block.php';

			#-----------------------------------------------------------------
			# Theme Shortcodes
			#-----------------------------------------------------------------
			require_once TOKOO_MODULES_DIR . '/theme-shortcodes/theme-shortcodes.php';

			#-----------------------------------------------------------------
			# Elementor Extensions
			#-----------------------------------------------------------------
			require_once TOKOO_MODULES_DIR . '/elementor/elementor.php';

			#-----------------------------------------------------------------
			# King Composer Extensions
			#-----------------------------------------------------------------
			require_once TOKOO_MODULES_DIR . '/kingcomposer/kingcomposer.php';
		}

		/**
		 * Cloning is forbidden.
		 *
		 * @since 1.0.0
		 */
		public function __clone () {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'tokoo-extensions' ), '1.0.0' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 *
		 * @since 1.0.0
		 */
		public function __wakeup () {
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'tokoo-extensions' ), '1.0.0' );
		}
	}
}

/**
 * Returns the main instance of Tokoo_Extensions to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Tokoo_Extensions
 */
function Tokoo_Extensions() {
	return Tokoo_Extensions::instance();
}

/**
 * Initialise the plugin
 */
Tokoo_Extensions();
