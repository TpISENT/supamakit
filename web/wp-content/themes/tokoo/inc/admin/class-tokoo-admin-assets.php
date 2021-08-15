<?php
/**
 * Load assets
 *
 * @author      CheThemes
 * @category    Admin
 * @package     Tokoo/Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tokoo_Admin_Assets' ) ) :

/**
 * Tokoo_Admin_Assets Class.
 */
class Tokoo_Admin_Assets {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_styles() {
		global $wp_scripts, $tokoo_version;

		$screen         = get_current_screen();
		$screen_id      = $screen ? $screen->id : '';
		$jquery_version = isset( $wp_scripts->registered['jquery-ui-core']->ver ) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';

		// Register admin styles
		wp_register_style( 'tokoo_admin_styles', get_template_directory_uri() . '/assets/css/admin/admin.css', array(), $tokoo_version );
		wp_register_style( 'font-awesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), $tokoo_version );
		
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'tokoo_admin_styles' );
	}

	/**
	 * Enqueue scripts.
	 */
	public function admin_scripts() {
		global $wp_query, $post, $tokoo_version;

		$screen       = get_current_screen();
		$screen_id    = $screen ? $screen->id : '';
		$ec_screen_id = sanitize_title( esc_html__( 'tokoo', 'tokoo' ) );
		$suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( 'tokoo-admin-meta-boxes', get_template_directory_uri() . '/assets/js/admin/meta-boxes' . $suffix . '.js', array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable'), $tokoo_version );

		wp_enqueue_script( 'tokoo-admin-meta-boxes' );
	}
}
endif;

return new Tokoo_Admin_Assets();