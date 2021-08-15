<?php
/**
 * Template Hooks used in single product
 */

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',          10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images',              20 );
remove_action( 'woocommerce_single_product_summary',		'woocommerce_template_single_add_to_cart',		30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 					5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 					10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 					10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 					40 );
remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_output_related_products',  20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing',                    50 );


add_action( 'woocommerce_before_single_product_summary', 	'tokoo_single_product_header', 					5 );

add_action( 'tokoo_single_product_header', 'woocommerce_template_single_title', 							10 );
add_action( 'tokoo_single_product_header', 'tokoo_single_product_header_meta', 								20 );

add_action( 'tokoo_single_product_header_meta', 'woocommerce_template_single_rating', 						40 );


add_action( 'woocommerce_before_single_product_summary',	'tokoo_wrap_single_product',					10  );
add_action( 'woocommerce_before_single_product_summary',	'tokoo_wrap_product_images',					20  );
add_action( 'woocommerce_before_single_product_summary',	'tokoo_wc_show_product_images',					30 );
add_action( 'woocommerce_before_single_product_summary',	'tokoo_wrap_product_images_close',				40 );

add_action( 'woocommerce_single_product_summary', 'tokoo_single_product_summar_inner_open', 				5 );
add_action( 'woocommerce_single_product_summary', 'tokoo_single_product_info', 								10 );

add_action( 'woocommerce_single_product_summary', 'tokoo_product_price_wrapper_open', 						12 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 						15 );
add_action( 'woocommerce_single_product_summary', 'tokoo_product_price_wrapper_close', 						20 );
add_action( 'woocommerce_single_product_summary', 'tokoo_template_single_add_to_cart',			            30 );

add_action( 'woocommerce_single_product_summary', 'tokoo_product_summary_detail_wrapper_open', 				22 );
add_action( 'woocommerce_single_product_summary', 'tokoo_wc_template_single_excerpt', 					    40 );
add_action( 'woocommerce_single_product_summary', 'tokoo_single_product_summary_last_detail',               50 );
add_action( 'tokoo_single_product_summar_last_detail', 'woocommerce_template_single_meta',                  10 );
add_action( 'tokoo_single_product_summar_last_detail', 'woocommerce_template_single_sharing',               30 );
add_action( 'woocommerce_single_product_summary', 'tokoo_product_summary_detail_wrapper_close', 			70 );

add_action( 'woocommerce_single_product_summary', 'tokoo_single_product_info_close', 						80 );

add_action( 'woocommerce_single_product_summary', 'tokoo_features_section', 								9 );

add_action( 'woocommerce_single_product_summary', 'tokoo_single_product_summar_inner_close', 				100 );

add_action( 'woocommerce_after_single_product_summary',     'tokoo_output_related_products',        		20 );

add_action( 'woocommerce_after_single_product_summary',		'tokoo_wrap_single_product_close',				1  );

add_filter( 'woocommerce_format_sale_price', 'tokoo_format_single_product_price', 10, 3 );

add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'tokoo_modify_show_option_none', 10 );

add_action( 'woocommerce_after_single_product_summary', 'tokoo_wc_tabs_outer_open', 9 );
add_action( 'woocommerce_after_single_product_summary', 'tokoo_wc_tabs_outer_close', 11 );

// Reviwe Verified Buyer changes
remove_action( 'woocommerce_review_meta',   'woocommerce_review_display_meta', 10 );
add_action( 'woocommerce_review_meta',  'tokoo_wc_review_meta', 10 );