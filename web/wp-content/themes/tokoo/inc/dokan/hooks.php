<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts',					'tokoo_dokan_scripts', 				100 );

add_filter( 'body_class',							'tokoo_dokan_body_classes',			100 );

add_action( 'dokan_product_edit_after_inventory_variants', 'tokoo_dokan_product_edit_add_specifications', 10, 2 );