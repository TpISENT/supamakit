<?php
/**
 * Options available for Shop sub menu of Theme Options
 * 
 */

$shop_options 	= apply_filters( 'tokoo_shop_options_args', array(
	'title'		=> esc_html__( 'Shop', 'tokoo' ),
	'icon'      => 'fas fa-shopping-cart',
	'fields'	=> array(
		array(
			'title'		=> esc_html__( 'General', 'tokoo' ),
			'id'		=> 'shop_general_info_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'title'		=> esc_html__( 'Catalog Mode', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Enable / Disable the Catalog Mode.', 'tokoo' ),
			'id'		=> 'catalog_mode',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'tokoo'),
			'off'		=> esc_html__('Disabled', 'tokoo'),
			'default'	=> 0,
		),

		array(
			'id'		=> 'shop_general_info_end',
			'type'		=> 'section',
			'indent'	=> false
		),
		
		array(
			'title'		=> esc_html__( 'Shop/Catalog Pages', 'tokoo' ),
			'id'		=> 'product_archive_page_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'		=> 'shop_jumbotron_id',
			'title'		=> esc_html__( 'Shop Page Jumbotron', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Choose a static block that will be the jumbotron element for shop page', 'tokoo' ),
			'type'		=> 'select',
			'data'		=> 'posts',
			'args'		=> array(
				'post_type'			=> 'static_block',
				'posts_per_page'	=> -1,
			)
		),

		array(
			'id'		=> 'compare_page_id',
			'title'		=> esc_html__( 'Shop Comparison Page', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Choose a page that will be the product compare page for shop.', 'tokoo' ),
			'type'		=> 'select',
			'data'		=> 'pages',
		),

		array(
			'id'        => 'product_archive_enabled_views',
			'type'      => 'sorter',
			'title'     => esc_html__( 'Product archive views', 'tokoo' ),
			'subtitle'  => esc_html__( 'Please drag and arrange the views. Top most view will be the default view', 'tokoo' ),
			'options'   => array(
				'enabled' => array(
					'grid'		=> esc_html__( 'Grid', 'tokoo' ),
					'list'		=> esc_html__( 'List', 'tokoo' )
				),
				'disabled' => array()
			)
		),

		array(
			'title'     => esc_html__('Shop Page Layout', 'tokoo'),
			'subtitle'  => esc_html__('Select the layout for the Shop Listing.', 'tokoo'),
			'id'        => 'shop_layout',
			'type'      => 'select',
			'options'   => array(
				'full-width'  	      => esc_html__( 'Full Width', 'tokoo' ),
				'left-sidebar'        => esc_html__( 'Left Sidebar', 'tokoo' ),
				'right-sidebar'       => esc_html__( 'Right Sidebar', 'tokoo' ),
			),
			'default'   => 'left-sidebar',
		),

		array(
			'id'		=> 'shop_bottom_jumbotron_id',
			'title'		=> esc_html__( 'Shop Page Bottom Jumbotron', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Choose a static block that will be the jumbotron element for shop page bottom', 'tokoo' ),
			'type'		=> 'select',
			'data'		=> 'posts',
			'args'		=> array(
				'post_type'			=> 'static_block',
				'posts_per_page'	=> -1,
			)
		),

		array(
			'title'		=> esc_html__('Number of Product Sub-categories Columns', 'tokoo'),
			'subtitle'	=> esc_html__('Drag the slider to set the number of columns for displaying product sub-categories in shop and catalog pages.', 'tokoo' ),
			'id'		=> 'subcategory_columns',
			'min'		=> '2',
			'step'		=> '1',
			'max'		=> '8',
			'type'		=> 'slider',
			'default'	=> '5',
		),

		array(
			'id'		=> 'product_archive_page_end',
			'type'		=> 'section',
			'indent'	=> false
		),
		
		array(
			'title'		=> esc_html__( 'Single Product Page', 'tokoo' ),
			'id'		=> 'product_single_page_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'        => 'single_product_features_show',
			'title'     => esc_html__( 'Show Single Product Features List', 'tokoo' ),
			'type'      => 'switch',
			'default'   => 1,
		),

		array(
			'id'		=> 'single_product_feature_list_icon',
			'type'		=> 'multi_text',
			'title'		=> esc_html__('Feature List Icon', 'tokoo'),
			'subtitle'	=> esc_html__('Add Icon', 'tokoo'),
			'default'   => array(
				esc_html__( 'fas fa-truck', 'tokoo' ),
				esc_html__( 'fas fa-undo', 'tokoo' ),
				esc_html__( 'fas fa-shield-alt', 'tokoo' ),
				esc_html__( 'fas fa-lock', 'tokoo' )
			),
			'required'	=> array( 'single_product_features_show', 'equals', true )
		),

		array(
			'id'		=> 'single_product_feature_list_title',
			'type'		=> 'multi_text',
			'title'		=> esc_html__('Feature List Title', 'tokoo'),
			'subtitle'	=> esc_html__('Add Title', 'tokoo'),
			'default'   => array(
				esc_html__( 'Fast Shipping', 'tokoo' ),
				esc_html__( 'Easy Returns', 'tokoo' ),
				esc_html__( 'Always Authentic', 'tokoo' ),
				esc_html__( 'Secure Shopping', 'tokoo' )
			),
			'required'	=> array( 'single_product_features_show', 'equals', true )
		),

		array(
			'id'		=> 'single_product_feature_list_text',
			'type'		=> 'multi_text',
			'title'		=> esc_html__('Feature List Text', 'tokoo'),
			'subtitle'	=> esc_html__('Add Description', 'tokoo'),
			'default'   => array(
				esc_html__( 'Receive products in amazing time', 'tokoo' ),
				esc_html__( 'Return policy that lets you shop at ease', 'tokoo' ),
				esc_html__( 'We only sell 100% authentic products', 'tokoo' ),
				esc_html__( 'Your data is always protected', 'tokoo' )
			),
			'required'	=> array( 'single_product_features_show', 'equals', true )
		),
	
		array(
			'id'        => 'enable_related_products',
			'title'     => esc_html__( 'Enable Related Products', 'tokoo' ),
			'type'      => 'switch',
			'default'   => 1,
		),

		array(
            'title'     => esc_html__( 'Enable Horizontal Thumbnails', 'tokoo' ),
            'id'        => 'horizontal_product_thumbnails',
            'type'      => 'switch',
            'default'   => 0,
        ),

        array(
            'title'     => esc_html__( 'Horizontal Dots only ?', 'tokoo' ),
            'id'        => 'horizontal_thumbnails_hide',
            'type'      => 'switch',
            'default'   => 0,
            'required'	=> array( 'horizontal_product_thumbnails', 'equals', true )
        ),

		array(
			'id'		=> 'product_single_page_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'title'		=> esc_html__( 'Cart & Checkout Page', 'tokoo' ),
			'id'		=> 'cart_checkout_page_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'        => 'coupon_form_title',
			'title'     => esc_html__( 'Coupon Form Title', 'tokoo' ),
			'type'      => 'text',
			'default'   => esc_html__( 'Discount/Promo Code', 'tokoo' )
		),

		array(
			'id'        => 'coupon_form_subtitle',
			'title'     => esc_html__( 'Coupon Form Subtitle', 'tokoo' ),
			'type'      => 'textarea',
			'default'   => sprintf( esc_html__( 'Don\'t have any yet ? %sCheckout our discount programs%s', 'tokoo' ), '<a href="#">', '</a>')
		),

		array(
			'id'        => 'cart_checkout_page_end',
			'type'      => 'section',
			'indent'    => false
		),

		array(
			'title'		=> esc_html__( 'My Account Page', 'tokoo' ),
			'id'		=> 'myaccount_page_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'        => 'myaccount_register_benefits_title',
			'title'     => esc_html__( 'Register Benefits Title', 'tokoo' ),
			'type'      => 'text',
			'default'   => esc_html__( 'Sign up today and you will be able to :', 'tokoo' )
		),

		array(
			'id'        => 'myaccount_register_benefits_text',
			'title'     => esc_html__( 'Register Benefits Text', 'tokoo' ),
			'type'      => 'textarea',
			'default'   => esc_html__( 'Tokoo Buyer Protection has you covered from click to delivery. Sign up or sign in and you will be able to:', 'tokoo' )
		),

		array(
			'id'        => 'myaccount_register_benefits',
			'title'     => esc_html__( 'Register Benefits', 'tokoo' ),
			'type'      => 'multi_text',
			'default'   => array(
				esc_html__( 'Speed your way through checkout', 'tokoo' ),
				esc_html__( 'Track your orders easily', 'tokoo' ),
				esc_html__( 'Keep a record of all your purchases', 'tokoo' ),
			),
		),

		array(
			'id'        => 'myaccount_register_banner_icon',
			'title'     => esc_html__( 'Register Banner Icon', 'tokoo' ),
			'type'      => 'text',
			'default'   => esc_html__( 'fa flaticon-megaphone', 'tokoo' )
		),

		array(
			'id'        => 'myaccount_register_banner_title',
			'title'     => esc_html__( 'Register Banner Title', 'tokoo' ),
			'type'      => 'text',
			'default'   => esc_html__( 'Get your free $50.00!', 'tokoo' )
		),

		array(
			'id'        => 'myaccount_register_banner_text',
			'title'     => esc_html__( 'Register Banner Text', 'tokoo' ),
			'type'      => 'textarea',
			'default'   =>  esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard', 'tokoo' )
		),

		array(
			'id'        => 'myaccount_page_end',
			'type'      => 'section',
			'indent'    => false
		)
		
	)
) );