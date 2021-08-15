<?php
/**
 * Options available for Header sub menu of Theme Options
 * 
 */
$nav_menus    = get_terms( 'nav_menu' );
$menu_options = array(
	'0' => esc_html__( 'Default WooCommerce account menu', 'tokoo' )
);

foreach( $nav_menus as $nav_menu ) {
	$menu_options[ $nav_menu->term_id ] = $nav_menu->name;
}

$header_options 	= apply_filters( 'tokoo_header_options_args', array(
	'title'		=> esc_html__( 'Header', 'tokoo' ),
	'icon'		=> 'far fa-arrow-alt-circle-up',
	'desc'		=> esc_html__( 'Options related to the header section. The header has 5 different styles including top bar, masthead, etc.', 'tokoo' ),
	'fields'	=> array(
		array(
			'title'		=> esc_html__( 'Top Bar', 'tokoo' ),
			'id'		=> 'top_bar_start',
			'type'		=> 'section',
			'indent'	=> true,
		),

		array(
			'id'        => 'header_top_bar_show',
			'title'     => esc_html__( 'Show Top Bar', 'tokoo' ),
			'type'      => 'switch',
			'default'   => 1,
		),

		array(
			'id'		=> 'top_bar_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'title'     => esc_html__( 'Logo', 'tokoo' ),
			'id'        => 'logo_start',
			'type'      => 'section',
			'indent'    => true
		),

		array(
			'title'		=> esc_html__( 'Logo SVG', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Enable to display svg logo instead of site title.', 'tokoo' ),
			'desc'		=> esc_html__( 'This will not work when you use site logo in customizer.', 'tokoo' ),
			'id'		=> 'logo_svg',
			'type'		=> 'switch',
			'on'		=> esc_html__( 'Enabled', 'tokoo' ),
			'off'		=> esc_html__( 'Disabled', 'tokoo' ),
			'default'	=> 1,
		),

		array(
			'id'		=> 'show_handheld_logo',
			'type'		=> 'switch',
			'title'		=> esc_html__( 'Show Separate Logo For Handheld', 'tokoo' ),
			'on'		=> esc_html__( 'Enabled', 'tokoo' ),
			'off'		=> esc_html__( 'Disabled', 'tokoo' ),
			'default'	=> 0,
		),

		array(
			'title'		=> esc_html__( 'Your Handheld Logo', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Upload your Handheld logo image.', 'tokoo' ),
			'id'		=> 'site_handheld_logo',
			'type'		=> 'media',
			'required'	=> array( 'show_handheld_logo', 'equals', 1 ),
		),

		array(
			'id'        => 'logo_end',
			'type'      => 'section',
			'indent'    => false
		),

		array(
			'title'		=> esc_html__( 'Masthead', 'tokoo' ),
			'id'		=> 'masthead_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'title'		=> esc_html__('Header Style', 'tokoo'),
			'subtitle'	=> esc_html__('Select the header style.', 'tokoo'),
			'id'		=> 'header_style',
			'type'		=> 'select',
			'options'	=> array(
				'v1'		=> esc_html__( 'Header v1', 'tokoo' ),
				'v2'		=> esc_html__( 'Header v2', 'tokoo' ),
				'v3'		=> esc_html__( 'Header v3', 'tokoo' ),
				'v4'		=> esc_html__( 'Header v4', 'tokoo' ),

			),
			'default'   => 'v1',
		),

		array(
			'title'		=> esc_html__( 'Sticky Header', 'tokoo' ),
			'id'		=> 'sticky_header',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'tokoo'),
			'off'		=> esc_html__('Disabled', 'tokoo'),
			'default'	=> 0,
		),

		array(
			'id'		=> 'header_departments_menu_icon',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Department Menu Icon', 'tokoo' ),
			'default'	=> 'flaticon-list',
		),


		array(
			'id'		=> 'header_departments_menu_title',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Department Menu Title', 'tokoo' ),
			'default'	=> esc_html__( 'Categories', 'tokoo' ),
		),

		array(
			'id'		=> 'masthead_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'title'		=> esc_html__( 'Header Search', 'tokoo' ),
			'id'		=> 'header_search_start',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'		=> 'header_navbar_search_placeholder',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Navbar Search Placeholder', 'tokoo' ),
			'default'	=> esc_html__( 'What are you looking for ?', 'tokoo' ),
		),

		array(
			'id'        => 'header_live_search',
			'title'     => esc_html__( 'Enable Live search ?', 'tokoo' ),
			'type'      => 'switch',
			'default'   => 1,
		),

		array(
			'id'		=> 'header_search_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'title'		=> esc_html__( 'Header Cart', 'tokoo' ),
			'id'		=> 'header_cart_start',
			'subtitle'  => esc_html__(' The settings below are applicable only if WooCommerce plugin is activated', 'tokoo' ),
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'		=> 'header_cart_icon',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Cart Icon', 'tokoo' ),
			'default'	=> 'flaticon-shopping-cart',
		),

		array(
			'id'        => 'header_cart_dropdown_disable',
			'title'     => esc_html__( 'Disable dropdown menu in header cart ?', 'tokoo' ),
			'subtitle'  => esc_html__( 'If you are using a sticky header, you might want to disable dropdown menu', 'tokoo' ),
			'type'      => 'switch',
			'default'   => 0,
			'on'		=> esc_html__( 'Enabled', 'tokoo' ),
			'off'		=> esc_html__( 'Disabled', 'tokoo' ),
		),

		array(
			'id'		=> 'header_cart_end',
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'title'		=> esc_html__( 'Header User Account', 'tokoo' ),
			'id'		=> 'header_user_account_start',
			'subtitle'  => esc_html__(' The settings below are applicable only if WooCommerce plugin is activated', 'tokoo' ),
			'type'		=> 'section',
			'indent'	=> true
		),

		array(
			'id'        => 'header_user_account_enable',
			'title'     => esc_html__( 'Enable user account icon in header ?', 'tokoo' ),
			'type'      => 'switch',
			'default'   => 0,
			'on'		=> esc_html__('Enabled', 'tokoo'),
			'off'		=> esc_html__('Disabled', 'tokoo'),
		),

		array(
			'id'		=> 'header_user_account_icon',
			'type'		=> 'text',
			'title'		=> esc_html__( 'User Account Icon', 'tokoo' ),
			'default'	=> 'flaticon-social',
			'required'  => array( 'header_user_account_enable', 'equals', 1 )
		),

		array(
			'title'		=> esc_html__( 'Logged in dropdown menu', 'tokoo'),
			'subtitle'	=> esc_html__('Select the menu you want to show in dropdown when the user is logged in.', 'tokoo'),
			'id'		=> 'header_user_account_logged_in_menu',
			'type'		=> 'select',
			'options'   => $menu_options,
			'default'   => '0',
			'required'  => array( 'header_user_account_enable', 'equals', 1 )
		),

		array(
			'id'		=> 'header_user_account_end',
			'type'		=> 'section',
			'indent'	=> true
		),
	)
) );