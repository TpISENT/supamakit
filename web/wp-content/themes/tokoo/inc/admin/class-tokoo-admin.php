<?php
/**
 * Tokoo Admin Class
 *
 * @author   WooThemes
 * @package  Tokoo
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tokoo_Admin' ) ) :
	/**
	 * The Tokoo admin class
	 */
	class Tokoo_Admin {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'includes' ) );
			add_action( 'admin_menu', array( $this, 'add_custom_css_page' ) );
		}

		/**
		 * Include any classes we need within admin
		 */
		public function includes() {
			include_once get_template_directory() . '/inc/admin/tokoo-admin-functions.php';
			include_once get_template_directory() . '/inc/admin/tokoo-meta-box-functions.php';
			include_once get_template_directory() . '/inc/admin/class-tokoo-admin-assets.php';

			$this->load_meta_boxes();
		}

		public function load_meta_boxes() {
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-home-v1.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-home-v2.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-home-v3.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-home-v4.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-home-v5.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-contact.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-about.php';
			include_once get_template_directory() . '/inc/admin/meta-boxes/class-tokoo-meta-box-page.php';
		}

		public function add_custom_css_page() {
			if ( apply_filters( 'tokoo_should_add_custom_css_page', false ) ) {
				add_theme_page( 'Custom Color CSS', 'Custom Color CSS', 'manage_options', 'custom-primary-color-css-page', 'tokoo_custom_primary_color_page' );
			}
		}

		/**
		 * Get product data from json
		 *
		 * @param  string $url       URL to the json file.
		 * @param  string $transient Name the transient.
		 * @return [type]            [description]
		 */
		public function get_tokoo_product_data( $url, $transient ) {
			$raw_products = wp_safe_remote_get( $url );
			$products     = json_decode( wp_remote_retrieve_body( $raw_products ) );

			if ( ! empty( $products ) ) {
				set_transient( $transient, $products, DAY_IN_SECONDS );
			}

			return $products;
		}
	}

endif;

return new Tokoo_Admin();
