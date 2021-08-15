<?php

if( ! defined('KC_FILE' ) ) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

$kc = KingComposer::globe();

$shortcode_params = array();

$nav_menus = wp_get_nav_menus();

$nav_menus_option = array(
	esc_html__( 'Select a menu', 'tokoo-extensions' )		=> '',
);

foreach ( $nav_menus as $key => $nav_menu ) {
	$nav_menus_option[$nav_menu->name] = $nav_menu->name;
}

$shortcode_params['tokoo_products_carousel'] = array(
	'name'         => esc_html__( 'Products Carousel', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Products Carousel', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Products Carousel Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'show_header',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Show Header', 'tokoo-extensions' ),
			'description'	=> esc_html__( 'Check to show Header', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Enter Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Enter title.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'header_aside_action_text',
			'label'			=> esc_html__('Header Aside Action Text', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Header Aside Action Text', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'header_aside_action_link',
			'label'			=> esc_html__('Header Aside Action Link', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Header Aside Action Link', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'shortcode_tag',
			'label'			=> esc_html__( 'Shortcode', 'tokoo-extensions' ),
			'type'			=> 'select',
			'options'		=> array(
				'featured_products'		=> esc_html__( 'Featured Products','tokoo-extensions'),
				'sale_products'			=> esc_html__( 'On Sale Products','tokoo-extensions'),
				'top_rated_products'	=> esc_html__( 'Top Rated Products','tokoo-extensions'),
				'recent_products'		=> esc_html__( 'Recent Products','tokoo-extensions'),
				'best_selling_products'	=> esc_html__( 'Best Selling Products','tokoo-extensions'),
				'product_category'		=> esc_html__( 'Product Category','tokoo-extensions'),
				'products'				=> esc_html__( 'Products','tokoo-extensions')
			),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'per_page',
			'label'			=> esc_html__('Limit', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of products to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'orderby',
			'label'			=> esc_html__('Orderby', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter orderby.', 'tokoo-extensions'),
			'value'			=> 'date',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'order',
			'label'			=> esc_html__('Order', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter order.', 'tokoo-extensions'),
			'value'			=> 'desc',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'product_id',
			'label'			=> esc_html__('Product IDs', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'category',
			'label'			=> esc_html__('Category', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Product Category Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'ca_slidestoshow',
			'label'			=> esc_html__('slidesToShow', 'tokoo-extensions'),
			'type'			=> 'text',
			'value'			=> 6,
			'description'	=> esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'ca_slidestoscroll',
			'label'			=> esc_html__('slidesToScroll', 'tokoo-extensions'),
			'type'			=> 'text',
			'value'			=> 6,
			'description'	=> esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Arrows?', 'tokoo-extensions' ),
			'name'			=> 'ca_arrows',
			'description'	=> esc_html__( 'Check to show Arrows.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Autoplay', 'tokoo-extensions' ),
			'name'			=> 'ca_autoplay',
			'description'	=> esc_html__( 'Check to Autoplay Product Carousel.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Infinite?', 'tokoo-extensions' ),
			'name'			=> 'ca_infinite',
			'description'	=> esc_html__( 'Check to show Infinite Carousel.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'type'			=> 'group',
			'label'			=> esc_html__( 'Responsive', 'tokoo-extensions' ),
			'name'			=> 'ca_responsive',
			'description'	=> '',
			'options'		=> array(
				'add_text'			=> esc_html__( 'Add new breakpoint', 'tokoo-extensions' )
			),
			'params' => array(
				array(
					'name'			=> 'ca_res_breakpoint',
					'label'			=> esc_html__('Breakpoint', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter breakpoint.', 'tokoo-extensions'),
					'admin_label'	=> true
				),
				array(
					'name'			=> 'ca_res_slidestoshow',
					'label'			=> esc_html__('slidesToShow', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
					'admin_label'	=> true
				),
				array(
					'name'			=> 'ca_res_slidestoscroll',
					'label'			=> esc_html__('slidesToScroll', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
					'admin_label'	=> true
				)
			)
		)
	),
);

$shortcode_params['tokoo_product_categories'] = array(
	'name'         => esc_html__( 'Product Categories', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Product Categories', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Product Categories Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Section Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Enter section title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'slugs',
			'label'			=> esc_html__('Category Slug', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter slug spearate by comma(,) Note: Only works with Product Category Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'limit',
			'label'			=> esc_html__('Limit', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of categories to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'columns',
			'label'			=> esc_html__('Columns', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of columns to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Hide Empty?', 'tokoo-extensions' ),
			'name'			=> 'hide_empty',
			'description'	=> esc_html__( 'Check to hide empty categories.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_1_8_block'] = array(
	'name'         => esc_html__( 'Product-1-8 Block', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Product-1-8 Block', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Product-1-8 Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Section Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Enter section title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'tab_title',
			'label'			=> esc_html__('Tab Title', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter tab title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'show_cat_title',
			'label'			=> esc_html__('Show Categories Tab', 'tokoo-extensions'),
			'type'			=> 'checkbox',
			'description'	=> esc_html__('Show categories tab', 'tokoo-extensions'),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'shortcode_tag',
			'label'			=> esc_html__( 'Shortcode', 'tokoo-extensions' ),
			'type'			=> 'select',
			'options'		=> array(
				'featured_products'		=> esc_html__( 'Featured Products','tokoo-extensions'),
				'sale_products'			=> esc_html__( 'On Sale Products','tokoo-extensions'),
				'top_rated_products'	=> esc_html__( 'Top Rated Products','tokoo-extensions'),
				'recent_products'		=> esc_html__( 'Recent Products','tokoo-extensions'),
				'best_selling_products'	=> esc_html__( 'Best Selling Products','tokoo-extensions'),
				'product_category'		=> esc_html__( 'Product Category','tokoo-extensions'),
				'products'				=> esc_html__( 'Products','tokoo-extensions')
			),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'orderby',
			'label'			=> esc_html__('Orderby', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter orderby.', 'tokoo-extensions'),
			'value'			=> 'date',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'order',
			'label'			=> esc_html__('Order', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter order.', 'tokoo-extensions'),
			'value'			=> 'desc',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'product_id',
			'label'			=> esc_html__('Product IDs', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'cat_limit',
			'label'			=> esc_html__('Category Limit', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter number of categories to displayed', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'cat_slugs',
			'label'			=> esc_html__('Category Slug', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Product Category Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Hide Empty?', 'tokoo-extensions' ),
			'name'			=> 'hide_empty',
			'description'	=> esc_html__( 'Check to hide empty categories.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_4_1_4_block'] = array(
	'name'         => esc_html__( 'Product-4-1-4 Block', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Product-4-1-4 Block', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Product-4-1-4  Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'show_header',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Show Header', 'tokoo-extensions' ),
			'description'	=> esc_html__( 'Check to show Header', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Enter Title', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter title.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'header_aside_action_text',
			'label'			=> esc_html__('Header Aside Action Text', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Header Aside Action Text', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'header_aside_action_link',
			'label'			=> esc_html__('Header Aside Action Link', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Header Aside Action Link', 'tokoo-extensions'),
			'admin_label'	=> true
		),

		array(
			'name'			=> 'shortcode_tag',
			'label'			=> esc_html__( 'Shortcode', 'tokoo-extensions' ),
			'type'			=> 'select',
			'options'		=> array(
				'featured_products'		=> esc_html__( 'Featured Products','tokoo-extensions'),
				'sale_products'			=> esc_html__( 'On Sale Products','tokoo-extensions'),
				'top_rated_products'	=> esc_html__( 'Top Rated Products','tokoo-extensions'),
				'recent_products'		=> esc_html__( 'Recent Products','tokoo-extensions'),
				'best_selling_products'	=> esc_html__( 'Best Selling Products','tokoo-extensions'),
				'product_category'		=> esc_html__( 'Product Category','tokoo-extensions'),
				'products'				=> esc_html__( 'Products','tokoo-extensions')
			),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'orderby',
			'label'			=> esc_html__('Orderby', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter orderby.', 'tokoo-extensions'),
			'value'			=> 'date',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'order',
			'label'			=> esc_html__('Order', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter order.', 'tokoo-extensions'),
			'value'			=> 'desc',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'product_id',
			'label'			=> esc_html__('Product IDs', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_flash_sale_block'] = array(
	'name'         => esc_html__( 'Deals Carousel', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Deals Carousel', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Deals Carousel Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'show_header',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Show Header', 'tokoo-extensions' ),
			'description'	=> esc_html__( 'Check to show Header', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Enter Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Enter title.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'header_timer',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Show Header Timer', 'tokoo-extensions' ),
			'description'	=> esc_html__( 'Check to show Header Timer', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'timer_title',
			'label'			=> esc_html__('Timer Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Timer Title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'timer_value',
			'label'			=> esc_html__('Timer Value', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Timer Value', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'bg_img',
			'type'			=> 'attach_image',
			'label'			=> esc_html__( 'Background Image', 'tokoo-extensions' ),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'shortcode_tag',
			'label'			=> esc_html__( 'Shortcode', 'tokoo-extensions' ),
			'type'			=> 'select',
			'options'		=> array(
				'featured_products'		=> esc_html__( 'Featured Products','tokoo-extensions'),
				'sale_products'			=> esc_html__( 'On Sale Products','tokoo-extensions'),
				'top_rated_products'	=> esc_html__( 'Top Rated Products','tokoo-extensions'),
				'recent_products'		=> esc_html__( 'Recent Products','tokoo-extensions'),
				'best_selling_products'	=> esc_html__( 'Best Selling Products','tokoo-extensions'),
				'product_category'		=> esc_html__( 'Product Category','tokoo-extensions'),
				'products'				=> esc_html__( 'Products','tokoo-extensions')
			),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'orderby',
			'label'			=> esc_html__('Orderby', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter orderby.', 'tokoo-extensions'),
			'value'			=> 'date',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'order',
			'label'			=> esc_html__('Order', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter order.', 'tokoo-extensions'),
			'value'			=> 'desc',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'per_page',
			'label'			=> esc_html__('Limit', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of products to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'product_id',
			'label'			=> esc_html__('Product IDs', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'category',
			'label'			=> esc_html__('Category', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Product Category Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'ca_rows',
			'label'			=> esc_html__('Number of row', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of rows to display.', 'tokoo-extensions'),
			'value'			=> 2,
			'admin_label'	=> true
		),
		array(
			'name'			=> 'ca_slidesperrow',
			'label'			=> esc_html__('slidesPerRow', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of items per row.', 'tokoo-extensions'),
			'value'			=> 4,
			'admin_label'	=> true
		),
		array(
			'name'			=> 'ca_slidestoshow',
			'label'			=> esc_html__('slidesToShow', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
			'value'			=> 1,
			'admin_label'	=> true
		),
		array(
			'name'			=> 'ca_slidestoscroll',
			'label'			=> esc_html__('slidesToScroll', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
			'value'			=> 1,
			'admin_label'	=> true
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Infinite?', 'tokoo-extensions' ),
			'name'			=> 'ca_infinite',
			'description'	=> esc_html__( 'Check to show Infinite Carousel.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'type'			=> 'group',
			'label'			=> esc_html__( 'Responsive', 'tokoo-extensions' ),
			'name'			=> 'ca_responsive',
			'description'	=> '',
			'options'		=> array(
				'add_text'			=> esc_html__( 'Add new breakpoint', 'tokoo-extensions' )
			),
			'params' => array(
				array(
					'name'			=> 'ca_res_breakpoint',
					'label'			=> esc_html__('Breakpoint', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter breakpoint.', 'tokoo-extensions'),
					'admin_label'	=> true
				),
				array(
					'name'			=> 'ca_res_slidesperrow',
					'label'			=> esc_html__('slidesPerRow', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter the number of items per row to display.', 'tokoo-extensions'),
					'admin_label'	=> true
				),
				array(
					'name'			=> 'ca_res_slidestoshow',
					'label'			=> esc_html__('slidesToShow', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
					'admin_label'	=> true
				),
				array(
					'name'			=> 'ca_res_slidestoscroll',
					'label'			=> esc_html__('slidesToScroll', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
					'admin_label'	=> true
				)
			)
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_about_content_section'] = array(
	'name'         => esc_html__( 'About Content Section', 'tokoo-extensions' ),
	'description'  => esc_html__( 'About Content Section', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'About Content Section Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'about_content',
			'label'			=> esc_html__('About Content', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Enter About Content.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_about_header_section'] = array(
	'name'         => esc_html__( 'About Header Section', 'tokoo-extensions' ),
	'description'  => esc_html__( 'About Header Section', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'About Header Section Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'pre_title',
			'label'			=> esc_html__('Pre Title', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter pre title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'title',
			'label'			=> esc_html__('Title', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter title.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_banner'] = array(
	'name' 		   => esc_html__( 'Banner', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Banner', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'title'        => esc_html__( 'Banner Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'img_src',
			'type'			=> 'attach_image',
			'label'			=> esc_html__( 'Upload Image', 'tokoo-extensions' ),
			'admin_label'	=> true
		),

		array(
			'name'			=> 'link',
			'label'			=> esc_html__('Banner Link', 'tokoo-extensions'),
			'type'			=> 'text',
			'value'			=> '#',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_features_list'] = array(
	'name'         => esc_html__( 'Features List', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Features List', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'title'        => esc_html__( 'Features List Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'type'			=> 'group',
			'label'			=> esc_html__( 'Features', 'tokoo-extensions' ),
			'name'			=> 'features',
			'description'	=> '',
			'options'		=> array(
				'add_text'			=> esc_html__( 'Add new feature', 'tokoo-extensions' )
			),
			'params' => array(
				array(
					'name'			=> 'icon',
					'label'			=> esc_html__('Icon', 'tokoo-extensions'),
					'type'			=> 'icon_picker',
					'admin_label'	=> true
				),
				array(
					'name'			=> 'label',
					'label'			=> esc_html__('Label', 'tokoo-extensions'),
					'type'			=> 'textarea',
					'admin_label'	=> true
				)
			)
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_testimonial'] = array(
	'name'         => esc_html__( 'Team Member', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Team Member', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Team Member Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Section Title', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter section title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'orderby',
			'label'			=> esc_html__('Orderby', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter orderby.', 'tokoo-extensions'),
			'value'			=> 'date',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'order',
			'label'			=> esc_html__('Order', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter order.', 'tokoo-extensions'),
			'value'			=> 'desc',
			'admin_label'	=> true
		)
	),
);

$shortcode_params['tokoo_job_section'] = array(
	'name'         => esc_html__( 'Job Section', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Job Section', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Job Section Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Section Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Enter section title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'type'			=> 'group',
			'label'			=> esc_html__( 'Jobs', 'tokoo-extensions' ),
			'name'			=> 'jobs',
			'description'	=> '',
			'options'		=> array(
				'add_text'			=> esc_html__( 'Add new jobs', 'tokoo-extensions' )
			),
			'params' => array(
				array(
					'name'			=> 'pre_title',
					'label'			=> esc_html__('Pre Title', 'tokoo-extensions'),
					'type'			=> 'text',
					'admin_label'	=> true
				),
				array(
					'name'			=> 'job_title',
					'label'			=> esc_html__('Job Title', 'tokoo-extensions'),
					'type'			=> 'text',
					'admin_label'	=> true
				),
				array(
					'name'			=> 'job_title_link',
					'label'			=> esc_html__('Job Title Link', 'tokoo-extensions'),
					'type'			=> 'text',
					'admin_label'	=> true
				),
				array(
					'name'			=> 'description',
					'label'			=> esc_html__('Job Description', 'tokoo-extensions'),
					'type'			=> 'textarea',
					'admin_label'	=> true
				),
				array(
					'name'			=> 'action_text',
					'label'			=> esc_html__('Action Text', 'tokoo-extensions'),
					'type'			=> 'text',
					'admin_label'	=> true
				),
				array(
					'name'			=> 'action_link',
					'label'			=> esc_html__('Action Link', 'tokoo-extensions'),
					'type'			=> 'text',
					'admin_label'	=> true
				)
			)
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['tokoo_brands_carousel'] = array(
	'name' => esc_html__( 'Brands Carousel', 'tokoo-extensions' ),
	'description' => esc_html__( 'Brands Carousel', 'tokoo-extensions' ),
	'category' => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon' => 'tokoo-element-icon',
	'title' => esc_html__( 'Brands Carousel Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params' => array(
		array(
			'name'			=> 'section_title',
			'label'			=> esc_html__('Section Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'description'	=> esc_html__('Enter section title', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'limit',
			'label'			=> esc_html__('Limit', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of Brands to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'orderby',
			'label'			=> esc_html__('Orderby', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter orderby.', 'tokoo-extensions'),
			'value'			=> 'date',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'order',
			'label'			=> esc_html__('Order', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter order.', 'tokoo-extensions'),
			'value'			=> 'desc',
			'admin_label'	=> true
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Hide Empty?', 'tokoo-extensions' ),
			'name'			=> 'hide_empty',
			'description'	=> esc_html__( 'Check to hide empty brands.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'ca_slidestoshow',
			'label'			=> esc_html__('slidesToShow', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
			'value'			=> 6,
			'admin_label'	=> true
		),
		array(
			'name'			=> 'ca_slidestoscroll',
			'label'			=> esc_html__('slidesToScroll', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
			'value'			=> 6,
			'admin_label'	=> true
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Infinite?', 'tokoo-extensions' ),
			'name'			=> 'ca_infinite',
			'description'	=> esc_html__( 'Check to show Infinite Carousel.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'type'			=> 'group',
			'label'			=> esc_html__( 'Responsive', 'tokoo-extensions' ),
			'name'			=> 'ca_responsive',
			'description'	=> '',
			'options'		=> array(
				'add_text'			=> esc_html__( 'Add new breakpoint', 'tokoo-extensions' )
			),
			'params' => array(
				array(
					'name'			=> 'ca_res_breakpoint',
					'label'			=> esc_html__('Breakpoint', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter breakpoint.', 'tokoo-extensions'),
					'admin_label'	=> true
				),
				array(
					'name'			=> 'ca_res_slidestoshow',
					'label'			=> esc_html__('slidesToShow', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
					'admin_label'	=> true
				),
				array(
					'name'			=> 'ca_res_slidestoscroll',
					'label'			=> esc_html__('slidesToScroll', 'tokoo-extensions'),
					'type'			=> 'text',
					'description'	=> esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
					'admin_label'	=> true
				)
			)
		),
	),
);

$shortcode_params['tokoo_jumbotron'] = array(
	'name' => esc_html__( 'Jumbotron', 'tokoo-extensions' ),
	'description' => esc_html__( 'Add Jumbotron to your page.', 'tokoo-extensions' ),
	'category' => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'title' => esc_html__( 'Jumbotron Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params' => array(
		array(
			'name'			=> 'title',
			'label'			=> esc_html__('Title', 'tokoo-extensions'),
			'type'			=> 'textarea',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'image',
			'type'			=> 'attach_image',
			'label'			=> esc_html__( 'Background Image', 'tokoo-extensions' ),
			'admin_label'	=> true
		)
	),
);

$shortcode_params['tokoo_category_block'] = array(
	'name'         => esc_html__( 'Slider With Category block', 'tokoo-extensions' ),
	'description'  => esc_html__( 'Slider With Category block', 'tokoo-extensions' ),
	'category'     => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'icon'         => 'tokoo-element-icon',
	'title'        => esc_html__( 'Slider With Category block Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params'       => array(
		array(
			'name'			=> 'slugs',
			'label'			=> esc_html__('Category Slug', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter slug spearate by comma(,) Note: Only works with Product Category Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'limit',
			'label'			=> esc_html__('Limit', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of categories to display.', 'tokoo-extensions'),
			'value'			=> '5',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'columns',
			'label'			=> esc_html__('Columns', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of columns to display.', 'tokoo-extensions'),
			'value'			=> '5',
			'admin_label'	=> true
		),
		array(
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Hide Empty?', 'tokoo-extensions' ),
			'name'			=> 'hide_empty',
			'description'	=> esc_html__( 'Check to hide empty categories.', 'tokoo-extensions' ),
			'options'		=> array( 'true' => esc_html__( 'Enable', 'tokoo-extensions' ) ),
		),
		array(
			'name'			=> 'el_class',
			'label'			=> esc_html__('Extra class name', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions')
		)
	),
);

$shortcode_params['slider_product'] = array(
	'name' => esc_html__( 'Slider Product', 'tokoo-extensions' ),
	'description' => esc_html__( 'Slider product', 'tokoo-extensions' ),
	'category' => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'title' => esc_html__( 'Slider Product Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params' => array(
		array(
			'name'			=> 'shortcode_tag',
			'label'			=> esc_html__( 'Shortcode', 'tokoo-extensions' ),
			'type'			=> 'select',
			'options'		=> array(
				'featured_products'		=> esc_html__( 'Featured Products','tokoo-extensions'),
				'sale_products'			=> esc_html__( 'On Sale Products','tokoo-extensions'),
				'top_rated_products'	=> esc_html__( 'Top Rated Products','tokoo-extensions'),
				'recent_products'		=> esc_html__( 'Recent Products','tokoo-extensions'),
				'best_selling_products'	=> esc_html__( 'Best Selling Products','tokoo-extensions'),
				'product_category'		=> esc_html__( 'Product Category','tokoo-extensions'),
				'products'				=> esc_html__( 'Products','tokoo-extensions')
			),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'per_page',
			'label'			=> esc_html__('Limit', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of products to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),

		array(
			'name'			=> 'columns',
			'label'			=> esc_html__('Columns', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter the number of columns to display.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'orderby',
			'label'			=> esc_html__('Orderby', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter orderby.', 'tokoo-extensions'),
			'value'			=> 'date',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'order',
			'label'			=> esc_html__('Order', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter order.', 'tokoo-extensions'),
			'value'			=> 'desc',
			'admin_label'	=> true
		),
		array(
			'name'			=> 'product_id',
			'label'			=> esc_html__('Product IDs', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
		array(
			'name'			=> 'category',
			'label'			=> esc_html__('Category', 'tokoo-extensions'),
			'type'			=> 'text',
			'description'	=> esc_html__('Enter id spearate by comma(,) Note: Only works with Product Category Shortcode.', 'tokoo-extensions'),
			'admin_label'	=> true
		),
	),
);

if ( class_exists( 'RevSlider' ) ) {
	$revsliders = array();
	
	$slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();

	if ( $arrSliders ) {
		foreach ( $arrSliders as $slider ) {
			$revsliders[ $slider->getAlias() ] = $slider->getTitle();
		}
	} else {
		$revsliders[0] = esc_html__( 'No sliders found', 'tokoo-extensions' );
	}

	$shortcode_params['rev_slider'] = array(
		'name' => esc_html__( 'Revolution Slider', 'tokoo-extensions' ),
		'description' => esc_html__( 'Select your Revolution Slider.', 'tokoo-extensions' ),
		'category' => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
		'title' => esc_html__( 'Revolution Slider Settings', 'tokoo-extensions' ),
		'is_container' => true,
		'params' => array(
			array(
				'name'			=> 'alias',
				'label'			=> esc_html__('Revolution Slider', 'tokoo-extensions' ),
				'type'			=> 'select',
				'options'		=> $revsliders,
				'admin_label'	=> true
			)
		),
	);
}

$shortcode_params['tokoo_vertical_menu'] = array(
	'name' => esc_html__( 'Tokoo Vertical Menu', 'tokoo-extensions' ),
	'description' => esc_html__( 'Tokoo Vertical Menu', 'tokoo-extensions' ),
	'category' => esc_html__( 'Tokoo Elements', 'tokoo-extensions' ),
	'title' => esc_html__( 'Tokoo Vertical Menu Settings', 'tokoo-extensions' ),
	'is_container' => true,
	'params' => array(
		array(
			'name'			=> 'menu_title',
			'label'			=> esc_html__('Vertical Menu Title', 'tokoo-extensions'),
			'type'			=> 'Text',
			'admin_label'	=> true
		),

		array(
			'name'			=> 'menu_action_text',
			'label'			=> esc_html__('Vertical Menu Action Text', 'tokoo-extensions'),
			'type'			=> 'Text',
			'admin_label'	=> true
		),

		array(
			'name'			=> 'menu_action_link',
			'label'			=> esc_html__('Vertical Menu Action Text Link', 'tokoo-extensions'),
			'type'			=> 'text',
			'value'         => '#',
			'admin_label'	=> true
		),

		array(
			'name'			=> 'menu',
			'label'			=> esc_html__( 'Choose Vertical Menu', 'tokoo-extensions' ),
			'type'			=> 'select',
			'options'		=> $nav_menus_option,
			'admin_label'	=> true
		),
	),
);

$shortcode_params = apply_filters( 'tokoo_kc_map_shortcode_params', $shortcode_params );

$kc->add_map( $shortcode_params );