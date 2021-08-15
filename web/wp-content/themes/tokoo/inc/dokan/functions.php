<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'tokoo_dokan_scripts' ) ) {
	function tokoo_dokan_scripts() {
		global $tokoo_version;

		if ( apply_filters( 'tokoo_use_predefined_colors', true ) ) {
			wp_dequeue_style( 'tokoo-color' );
		}

		wp_dequeue_style( 'fontawesome' );
        wp_enqueue_style( 'tokoo-flaticon', get_template_directory_uri() . '/assets/css/flaticon.css', '', $tokoo_version );
        wp_enqueue_style( 'tokoo-flaticon' );
		
		wp_enqueue_style( 'tokoo-dokan-style', get_template_directory_uri() . '/assets/css/dokan.min.css', '', $tokoo_version );
		wp_style_add_data( 'tokoo-dokan-style', 'rtl', 'replace' );

		if( apply_filters( 'tokoo_use_predefined_colors', true ) ) {
            $color_css_file = apply_filters( 'tokoo_primary_color', 'green' );
            wp_enqueue_style( 'tokoo-color', get_template_directory_uri() . '/assets/css/colors/' . $color_css_file . '.css', '', $tokoo_version );
        }

		// Dequeue Bootstrap Modaljs
		wp_dequeue_script( 'modaljs' );

		// Dequeue Bootstrap Tooltip
		wp_dequeue_script( 'dokan-tooltip' );
	}
}

if( ! function_exists( 'tokoo_get_dokan_store_sidebar' ) ) {
	function tokoo_get_dokan_store_sidebar() {
		$store_user   = get_userdata( get_query_var( 'author' ) );
		$store_info   = dokan_get_store_info( $store_user->ID );
		$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';

		if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>

			<div role="complementary" class="widget-area" id="sidebar">
				<div id="dokan-secondary" class="dokan-clearfix dokan-store-sidebar" role="complementary">
					<div class="dokan-widget-area widget-collapse">
						<?php do_action( 'dokan_sidebar_store_before', $store_user, $store_info ); ?>
						<?php
						if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

							$args = array(
								'before_widget' => '<aside class="widget">',
								'after_widget'  => '</aside>',
								'before_title'  => '<h3 class="widget-title">',
								'after_title'   => '</h3>',
							);

							if ( class_exists( 'Dokan_Store_Location' ) ) {
								the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'tokoo' ) ), $args );

								if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on' ) {
									the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'tokoo' ) ), $args );
								}

								if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
									the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Seller', 'tokoo' ) ), $args );
								}
							}

						}
						?>

						<?php do_action( 'dokan_sidebar_store_after', $store_user, $store_info ); ?>
					</div>
				</div>
			</div><!-- #secondary .widget-area -->
		<?php
		} else {
			get_sidebar( 'store' );
		}
	}
}

// if ( ! function_exists( 'tokoo_dokan_after_wc_content' ) ) {
// 	function tokoo_dokan_after_wc_content() {
//     if( dokan_is_store_page() ){
//         tokoo_get_dokan_store_sidebar();
//     	}
// 	}
// }


if ( ! function_exists( 'tokoo_dokan_toggle_shop_sidebar' ) ) {
	function tokoo_dokan_toggle_shop_sidebar( $has_sidebar ) {
		if( dokan_is_store_page() ){
			$has_sidebar = true;
		}

		return $has_sidebar;
	}
}

if ( ! function_exists( 'tokoo_setup_dokan_sidebars' ) ) {
	/**
	 * Setup Sidebars available in tokoo
	 */
	function tokoo_setup_dokan_sidebars() {
		// Store Sidebar
		register_sidebar( apply_filters( 'tokoo_register_store_sidebar_args', array(
			'name'          => esc_html__( 'Store Sidebar', 'tokoo' ),
			'id'            => 'store-sidebar-widgets',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) ) );
	}
}

if( ! function_exists( 'tokoo_dokan_body_classes' ) ) {
	function tokoo_dokan_body_classes( $classes ) {
		if( dokan_is_store_page() ) {
			$layout = tokoo_get_blog_layout();
			if( ( $key = array_search( $layout, $classes ) ) !== false ) {
				unset($classes[$key]);
			}

			$classes[] = apply_filters( 'tokoo_dokan_sidebar_layout_class', 'left-sidebar' );
		}

		return $classes;
	}
}

if ( ! function_exists( 'tokoo_dokan_product_edit_add_specifications' ) ) {
	function tokoo_dokan_product_edit_add_specifications( $post, $post_id ) {
		?>
		<div class="dokan-product-specifications dokan-edit-row">
			<div class="dokan-section-heading" data-togglehandler="dokan_product_specifications">
				<h2><i class="fa fa-cog" aria-hidden="true"></i> <?php _e( 'Specifications', 'tokoo' ); ?></h2>
				<p><?php _e( 'Manage specifications for this product.', 'tokoo' ); ?></p>
				<a href="#" class="dokan-section-toggle">
					<i class="fa fa-sort-desc fa-flip-vertical" aria-hidden="true"></i>
				</a>
				<div class="dokan-clearfix"></div>
			</div>

			<div class="dokan-section-content">

				<?php
					$display_attributes = get_post_meta( $post_id, '_specifications_display_attributes', true );
					$specifications = get_post_meta( $post_id, '_specifications', true );
				?>

				<div class="content-half-part dokan-form-group">
					<label class="" for="_specifications_display_attributes">
						<input name="_specifications_display_attributes" id="_specifications_display_attributes" value="yes" type="checkbox" <?php checked( $display_attributes, 'yes' ); ?>>
						<?php esc_html_e( 'Display Attributes', 'tokoo' ) ?>
					</label>
				</div>

				<div class="content-half-part dokan-form-group">
					<label for="_specifications_attributes_title" class="form-label"><?php esc_html_e( 'Attributes Title', 'tokoo' ); ?></label>
					<?php dokan_post_input_box( $post_id, '_specifications_attributes_title' ); ?>
				</div>

				<div class="dokan-clearfix"></div>

				<?php wp_editor( htmlspecialchars_decode( $specifications ) , '_specifications', array('editor_height' => 50, 'quicktags' => true, 'media_buttons' => false, 'teeny' => true, 'editor_class' => 'post_content') ); ?>

			</div><!-- .dokan-side-right -->
		</div><!-- .dokan-product-specifications -->
		<?php
	}
}