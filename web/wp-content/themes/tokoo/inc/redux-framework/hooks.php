<?php
/**
 * Redux Framworks hooks
 *
 * @package Tokoo/ReduxFramework
 */
add_action( 'init',                                         'tk_remove_demo_mode_link' );
add_action( 'redux/loaded',                                 'tk_redux_disable_dev_mode_and_remove_admin_notices' );
add_action( 'redux/page/tokoo_options/enqueue',             'redux_queue_font_awesome' );

//General Filters
add_filter( 'tokoo_enable_scrollup',                        'redux_toggle_scrollup',                        10 );

// Shop Filters
add_filter( 'tokoo_shop_catalog_mode',                      'redux_toggle_shop_catalog_mode',				10 );
add_filter( 'woocommerce_loop_add_to_cart_link',            'redux_apply_catalog_mode_for_product_loop',    100, 2 );
add_filter( 'tokoo_shop_jumbotron_id',				        'redux_apply_shop_jumbotron_id',				10 );
add_filter( 'tokoo_shop_bottom_jumbotron_id',               'redux_apply_shop_bottom_jumbotron_id',         10 );
add_filter( 'tokoo_get_shop_views_args',                    'redux_set_shop_view_args',                     10 );
add_filter( 'tokoo_shop_layout',                            'redux_apply_shop_layout',                      10 );
add_filter( 'tokoo_product_cat_columns',                    'redux_apply_shop_loop_subcategories_columns',  10 );
add_filter( 'tokoo_enable_single_product_feature_list',		'redux_toggle_single_product_features_output',	10 );
add_filter( 'tokoo_features_section_args',             		'redux_apply_single_product_feature',           10 );
add_filter( 'tokoo_enable_related_products',                'redux_toggle_related_products_output',         10 );
add_filter( 'tokoo_horizontal_product_thumbnails',          'redux_toggle_horizontal_product_thumbnails',   10 );
add_filter( 'tokoo_horizontal_thumbnails_hide',             'redux_toggle_horizontal_thumbnails_hide',      10 );
add_filter( 'tokoo_product_comparison_page_id',             'redux_apply_product_comparison_page_id',       10 );

add_filter( 'tokoo_coupon_form_title',                      'redux_apply_coupon_form_title',                10 );
add_filter( 'tokoo_coupon_form_subtitle',                   'redux_apply_coupon_form_subtitle',             10 );

add_filter( 'tokoo_register_benefits_title',           		'redux_apply_myaccount_register_benefits_title',10 );
add_filter( 'tokoo_register_benefits_text',                 'redux_apply_myaccount_register_benefits_text', 20 );
add_filter( 'tokoo_register_benefits',                      'redux_apply_myaccount_register_benefits',      30 );

add_filter( 'tokoo_register_banner_icon',           		'redux_apply_myaccount_register_banner_icon',   40 );
add_filter( 'tokoo_register_banner_title',           		'redux_apply_myaccount_register_banner_title',  50 );
add_filter( 'tokoo_register_banner_text',           		'redux_apply_myaccount_register_banner_text',   60 );

// Header Filters
add_filter( 'tokoo_enable_top_bar',                         'redux_toggle_top_bar',                         10 );
add_filter( 'tokoo_site_logo_svg',                          'redux_toggle_logo_svg',                        10 );
add_filter( 'tokoo_header_version',							'redux_apply_header_style',						10 );
add_filter( 'tokoo_has_sticky_header',                      'redux_toggle_sticky_header',                   10 );
add_filter( 'tokoo_departments_menu_icon',               	'redux_apply_departments_menu_icon',        	10 );
add_filter( 'tokoo_departments_menu_title',                 'redux_apply_departments_menu_title',           10 );
add_filter( 'tokoo_navbar_search_placeholder',         		'redux_apply_header_search_placeholder_text',   10 );
add_filter( 'tokoo_enable_live_search',                     'redux_toggle_live_search',                     10 );

add_filter( 'tokoo_header_cart_icon',                       'redux_apply_header_cart_icon',                 10 );
add_filter( 'tokoo_header_cart_dropdown_disable',           'redux_toggle_header_cart_dropdown',            10 );

add_filter( 'tokoo_enable_header_user_account',       		'redux_toggle_header_user_account_enable',      10 );
add_filter( 'tokoo_header_user_account_icon',         		'redux_apply_header_user_account_icon',         10 );
add_filter( 'tokoo_user_account_nav_menu_ID',         		'redux_apply_header_user_account_menu',         10 );
add_filter( 'tokoo_handheld_header_logo_show',                   'redux_toggle_handheld_logo',                   10 );
add_filter( 'tokoo_header_logo_html',                       'redux_apply_handheld_logo',                    10 );

// Footer Filters
add_filter( 'tokoo_enable_footer_features_list',			 'redux_toggle_footer_features_output',			 10 );
add_filter( 'tokoo_footer_features',             			 'redux_apply_footer_features',                  10 );
add_filter( 'tokoo_footer_version',							 'redux_apply_footer_style',					 10 );
add_filter( 'tokoo_footer_logo',						     'redux_toggle_footer_logo',					 10 );
add_filter( 'tokoo_footer_logo_html',                        'redux_apply_footer_logo',                      10 );
add_filter( 'tokoo_footer_logo_text',						 'redux_toggle_footer_logo_text',				 10 );
add_filter( 'tokoo_footer_social_icons',				     'redux_toggle_footer_social_icons',			 10 );
add_filter( 'tokoo_footer_social_icons_text',				 'redux_apply_footer_social_icons_text',		 10 );
add_filter( 'tokoo_footer_widgets',					         'redux_toggle_footer_widgets',					 10 );
add_filter( 'tokoo_enable_footer_bottom_bar',                'redux_toggle_footer_bottom_bar',               10 );
add_filter( 'tokoo_enable_footer_payment_icons',             'redux_toggle_footer_payment_icons',            10 );
add_filter( 'tokoo_footer_payment_icons_text',               'redux_apply_footer_payment_icons_text',        10 );
add_filter( 'tokoo_footer_payment_icons_image_src',			 'redux_apply_footer_payment_icons',			 10 );
add_filter( 'tokoo_get_social_networks',					 'redux_apply_social_networks',					10 );
add_filter( 'copyright_info',			 					 'redux_apply_footer_copyright_text',				10 );


// Blog Filters
add_filter( 'tokoo_blog_style',                             'redux_apply_blog_page_view',                   10 );
add_filter( 'tokoo_blog_layout',                            'redux_apply_blog_page_layout',                 10 );
add_filter( 'tokoo_single_post_layout',                     'redux_apply_single_post_layout',               10 );
add_filter( 'tokoo_enable_post_icon_placeholder',           'redux_toggle_post_icon_placeholder',           10 );
add_filter( 'tokoo_show_author_info',                       'redux_toggle_author_info',                     10 );


// Style Filters
add_filter( 'tokoo_use_predefined_colors',                  'redux_toggle_use_predefined_colors',           10 );
add_action( 'tokoo_primary_color',                          'redux_apply_primary_color',                    10 );
add_action( 'wp_head',                                      'redux_apply_custom_color_css',                 100 );
add_action( 'wp_enqueue_scripts',                           'redux_load_external_custom_css',               20 );
add_filter( 'tokoo_should_add_custom_css_page',             'redux_toggle_custom_css_page',                 10 );

// Typography Filters
add_filter( 'tokoo_load_default_fonts',                     'redux_has_google_fonts',                       10 );
add_action( 'wp_head',                                      'redux_apply_custom_fonts',                     100 );
