<?php
/**
 * Filter functions for Shop Section of Theme Options
 */

if( ! function_exists( 'redux_toggle_shop_catalog_mode' ) ) {
	function redux_toggle_shop_catalog_mode() {
		global $tokoo_options;

		if( isset( $tokoo_options['catalog_mode'] ) && $tokoo_options['catalog_mode'] == '1' ) {
			$catalog_mode = true;
		} else {
			$catalog_mode = false;
		}

		return $catalog_mode;
	}
}

function redux_apply_catalog_mode_for_product_loop( $product_link, $product ) {
	global $tokoo_options;

	
	$product_id = $product->get_id();
	$product_type = $product->get_type();

	if( isset( $tokoo_options['catalog_mode'] ) && $tokoo_options['catalog_mode'] == '1' ) {
		$product_link = sprintf( '<a href="%s" class="button btn-action product_type_%s">%s</a>',
			get_permalink( $product_id ),
			esc_attr( $product_type ),
			apply_filters( 'tokoo_catalog_mode_button_text', esc_html__( 'View Product', 'tokoo' ) )
		);
	}

	return $product_link;
}

if( ! function_exists( 'redux_apply_catalog_mode_for_product_loop' ) ) {
	function redux_apply_catalog_mode_for_product_loop( $product_link, $product ) {
		global $tokoo_options;

		$product_id = $product->get_id();
		$product_type = $product->get_type();

		if ( apply_filters( 'tokoo_show_affiliate_link_in_loop', true ) && 'external' == $product_type ) {
			$product_link =
				sprintf( '<a rel="nofollow" target="_blank" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $quantity ) ? $quantity : 1 ),
					esc_attr( $product->get_id() ),
					esc_attr( $product->get_sku() ),
					esc_attr( isset( $class ) ? $class : 'button' ),
					esc_html( $product->add_to_cart_text() )
				);
			return $product_link;
		}

		if( isset( $tokoo_options['catalog_mode'] ) && $tokoo_options['catalog_mode'] == '1' ) {
			$product_link = sprintf( '<a href="%s" class="button product_type_%s">%s</a>',
				get_permalink( $product_id ),
				esc_attr( $product_type ),
				apply_filters( 'tokoo_catalog_mode_button_text', esc_html__( 'View Product', 'tokoo' ) )
			);
		}

		return $product_link;
	}
}

if ( ! function_exists( 'redux_apply_shop_loop_subcategories_columns' ) ) {
	function redux_apply_shop_loop_subcategories_columns( $columns ) {
		global $tokoo_options;

		if( isset( $tokoo_options['subcategory_columns'] ) ) {
			$columns = $tokoo_options['subcategory_columns'];
		}

		return $columns;
	}
}

if( ! function_exists( 'redux_apply_product_brand_taxonomy' ) ) {
	function redux_apply_product_brand_taxonomy( $brand_taxonomy ) {
		global $tokoo_options;

		if( isset( $tokoo_options['product_brand_taxonomy'] ) ) {
			$brand_taxonomy = $tokoo_options['product_brand_taxonomy'];
		}

		return $brand_taxonomy;
	}
}


if ( ! function_exists( 'redux_set_shop_view_args' ) ) {
	function redux_set_shop_view_args( $shop_view_args ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['product_archive_enabled_views'] ) ) {
			$shop_views = $tokoo_options['product_archive_enabled_views']['enabled'];

			if ( $shop_views ) {
				$new_shop_view_args = array();
				$count = 0;
				
				foreach( $shop_views as $key => $shop_view ) {
					
					if ( isset( $shop_view_args[ $key ] ) ) {
						$new_shop_view_args[ $key ] = $shop_view_args[ $key ];

						if ( 0 == $count ) {
							$new_shop_view_args[ $key ]['active'] = true;
						} else {
							$new_shop_view_args[ $key ]['active'] = false;
						}

						$count++;
					}
				}

				return $new_shop_view_args;
			}
		}

		return $shop_view_args;
	}
}

if ( ! function_exists( 'redux_apply_shop_layout' ) ) {
	function redux_apply_shop_layout( $shop_layout ) {
		global $tokoo_options;

		if( isset( $tokoo_options['shop_layout'] ) ) {
			$shop_layout = $tokoo_options['shop_layout'];
		}

		return $shop_layout;
	}
}


if( ! function_exists( 'redux_apply_shop_jumbotron_id' ) ) {
	function redux_apply_shop_jumbotron_id( $static_block_id ) {
		global $tokoo_options;

		if( isset( $tokoo_options['shop_jumbotron_id'] ) ) {
			$static_block_id = $tokoo_options['shop_jumbotron_id'];
		}

		return $static_block_id;
	}
}

if( ! function_exists( 'redux_apply_shop_bottom_jumbotron_id' ) ) {
	function redux_apply_shop_bottom_jumbotron_id( $static_block_id ) {
		global $tokoo_options;

		if( isset( $tokoo_options['shop_bottom_jumbotron_id'] ) ) {
			$static_block_id = $tokoo_options['shop_bottom_jumbotron_id'];
		}

		return $static_block_id;
	}
}

if ( ! function_exists( 'redux_toggle_single_product_features_output' ) ) {
	function redux_toggle_single_product_features_output( $enable ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['single_product_features_show'] ) && $tokoo_options['single_product_features_show'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}



if ( ! function_exists( 'redux_apply_single_product_feature' ) ) {
	function redux_apply_single_product_feature( $features ) {
		global $tokoo_options;

		if( ! empty( $tokoo_options['single_product_feature_list_title'] ) ) {

			$info = array();

			foreach( $tokoo_options['single_product_feature_list_title'] as $key => $title ) {
				if ( ! empty( $title ) ) {
					$feature_desc = '';
					$icon = '';

					if( ! empty( $tokoo_options['single_product_feature_list_icon'][$key] ) ) {
						$icon = $tokoo_options['single_product_feature_list_icon'][$key];
					}

					if ( ! empty( $tokoo_options['single_product_feature_list_text'][$key] ) ) {
						$feature_desc = $tokoo_options['single_product_feature_list_text'][$key];
					}

					$info[] = array(
						'feature_title' => $title,
						'feature_desc'  => $feature_desc,
						'icon' => $icon
					);
				}
			}

			if( ! empty( $info ) ) {
				$features = $info;
			}
		}


		return $features;
	}
}

if ( ! function_exists( 'redux_toggle_related_products_output' ) ) {
	function redux_toggle_related_products_output( $enable ) {
		global $tokoo_options;

		if ( ! isset( $tokoo_options['enable_related_products'] ) ) {
			$tokoo_options['enable_related_products'] = true;
		}

		if ( $tokoo_options['enable_related_products'] ) {
			$enable = true;
		} else {
			$enable = false;
		}

		return $enable;
	}
}

if ( ! function_exists( 'redux_apply_coupon_form_title' ) ) {
	function redux_apply_coupon_form_title( $coupon_form_title ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['coupon_form_title'] ) ) {
			$coupon_form_title = $tokoo_options['coupon_form_title'];
		}

		return $coupon_form_title;
	}
}

if ( ! function_exists( 'redux_apply_coupon_form_subtitle' ) ) {
	function redux_apply_coupon_form_subtitle( $coupon_form_subtitle ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['coupon_form_subtitle'] ) ) {
			$coupon_form_subtitle = $tokoo_options['coupon_form_subtitle'];
		}

		return $coupon_form_subtitle;
	}
}


if ( ! function_exists( 'redux_apply_myaccount_register_benefits_title' ) ) {
	function redux_apply_myaccount_register_benefits_title( $register_benefits_title ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['myaccount_register_benefits_title'] ) ) {
			$register_benefits_title = $tokoo_options['myaccount_register_benefits_title'];
		}

		return $register_benefits_title;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_register_benefits_text' ) ) {
	function redux_apply_myaccount_register_benefits_text( $register_benefits_text ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['myaccount_register_benefits_text'] ) ) {
			$register_benefits_text = $tokoo_options['myaccount_register_benefits_text'];
		}

		return $register_benefits_text;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_register_benefits' ) ) {
	function redux_apply_myaccount_register_benefits( $benefits ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['myaccount_register_benefits'] ) ) {
			if ( is_array( $tokoo_options['myaccount_register_benefits'] ) ) {
				$benefits = $tokoo_options['myaccount_register_benefits'];
			} else {
				$benefits = array();
			}
		}

		return $benefits;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_register_banner_icon' ) ) {
	function redux_apply_myaccount_register_banner_icon( $register_banner_icon ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['myaccount_register_banner_icon'] ) ) {
			$register_banner_icon = $tokoo_options['myaccount_register_banner_icon'];
		}

		return $register_banner_icon;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_register_banner_title' ) ) {
	function redux_apply_myaccount_register_banner_title( $register_banner_title ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['myaccount_register_banner_title'] ) ) {
			$register_banner_title = $tokoo_options['myaccount_register_banner_title'];
		}

		return $register_banner_title;
	}
}

if ( ! function_exists( 'redux_apply_myaccount_register_banner_text' ) ) {
	function redux_apply_myaccount_register_banner_text( $register_banner_text ) {
		global $tokoo_options;

		if ( isset( $tokoo_options['myaccount_register_banner_text'] ) ) {
			$register_banner_text = $tokoo_options['myaccount_register_banner_text'];
		}

		return $register_banner_text;
	}
}

if ( ! function_exists ( 'redux_toggle_horizontal_product_thumbnails' ) ) {
    function redux_toggle_horizontal_product_thumbnails( $enable ) {
        global $tokoo_options;

        if ( ! isset( $tokoo_options['horizontal_product_thumbnails'] ) ) {
            $tokoo_options['horizontal_product_thumbnails'] = false;
        }

        if ( $tokoo_options['horizontal_product_thumbnails'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if ( ! function_exists ( 'redux_toggle_horizontal_thumbnails_hide' ) ) {
    function redux_toggle_horizontal_thumbnails_hide( $enable ) {
        global $tokoo_options;

        if ( ! isset( $tokoo_options['horizontal_thumbnails_hide'] ) ) {
            $tokoo_options['horizontal_thumbnails_hide'] = false;
        }

        if ( $tokoo_options['horizontal_thumbnails_hide'] ) {
            $enable = true;
        } else {
            $enable = false;
        }

        return $enable;
    }
}

if( ! function_exists( 'redux_apply_product_comparison_page_id' ) ) {
	function redux_apply_product_comparison_page_id( $compare_page_id ) {
		global $tokoo_options;

		if( isset( $tokoo_options['compare_page_id'] ) ) {
			$compare_page_id = $tokoo_options['compare_page_id'];
		}

		return $compare_page_id;
	}
}