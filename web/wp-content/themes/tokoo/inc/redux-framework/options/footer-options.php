<?php
/**
 * Options available for Footer sub menu in Theme Options
 */

$footer_options = apply_filters( 'tokoo_footer_options_args', array(
	'title' 	=> esc_html__( 'Footer', 'tokoo' ),
	'desc'		=> esc_html__( 'Options related to the footer section. The Footer has : Brands Slider, Footer Widgets, Footer Newsletter Section, Footer Contact Block, Footer Bottom Wigets', 'tokoo' ),
	'icon' 		=> 'far fa-arrow-alt-circle-down',
	'fields' 	=> array(
		array(
			'id'        => 'footer_feature_list_show',
			'title'     => esc_html__( 'Show Footer Feature Lists', 'tokoo' ),
			'type'      => 'switch',
			'default'   => 0,
		),

		array(
			'id'		=> 'footer_feature_list_icon',
			'type'		=> 'multi_text',
			'title'		=> esc_html__('Icon', 'tokoo'),
			'subtitle'	=> esc_html__('Add Icon', 'tokoo'),
			'required'	=> array( 'footer_feature_list_show', 'equals', true )
		),

		array(
			'id'		=> 'footer_feature_list_text',
			'type'		=> 'multi_text',
			'title'		=> esc_html__('Text', 'tokoo'),
			'subtitle'	=> esc_html__('Add Text', 'tokoo'),
			'required'	=> array( 'footer_feature_list_show', 'equals', true )
		),

		array(
			'id'		=> 'footer_style_start',
			'type'		=> 'section',
			'indent'	=> true,
			'title'		=> esc_html__( 'Footer Style Block', 'tokoo' ),
		),

		array(
			'title'		=> esc_html__('Footer Style', 'tokoo'),
			'subtitle'	=> esc_html__('Select the footer style.', 'tokoo'),
			'id'		=> 'footer_style',
			'type'		=> 'select',
			'options'	=> array(
				'v1'		=> esc_html__( 'Footer v1', 'tokoo' ),
				'v2'		=> esc_html__( 'Footer v2', 'tokoo' ),

			),
			'default'   => 'v1',
		),

		array(
			'id'		=> 'footer_style_end',
			'type'		=> 'section',
			'indent'	=> false,
			
		),

		array(
			'id'		=> 'footer_logo_block_start',
			'type'		=> 'section',
			'indent'	=> true,
			'title'		=> esc_html__( 'Footer Logo Block', 'tokoo' ),
			'subtitle'	=> esc_html__( 'The Footer Logo Block is part of Footer. However it is not available as a separate widget but are fully customizable with the options given below.','tokoo' ),
		),

		array(
			'id'		=> 'show_footer_logo',
			'type'		=> 'switch',
			'title'		=> esc_html__( 'Show Footer logo', 'tokoo' ),
			'default'	=> 1,
			
		),

		array(
			'title'		=> esc_html__( 'Your Logo', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Upload your footer logo image.', 'tokoo' ),
			'id'		=> 'site_footer_logo',
			'type'		=> 'media',
			'required'	=> array( 'show_footer_logo', 'equals', true ),
		),

		array(
			'id'		=> 'footer_text',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Footer Logo Text', 'tokoo' ),
			'default'	=> '',
			'required'	=> array( 'show_footer_logo', 'equals', true ),
		),

		array(
			'id'		=> 'footer_logo_block_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'id'		=> 'footer_social_icons_block_start',
			'type'		=> 'section',
			'indent'	=> true,
			'title'		=> esc_html__( 'Footer Social Icons Block', 'tokoo' ),
			'subtitle'	=> esc_html__( 'The Footer Social Icons Block is part of Footer widgets.However it is not available as a separate widget but are fully customizable with the options given below.', 'tokoo' ),
		),

		array(
			'id'		=> 'show_footer_social_icons',
			'type'		=> 'switch',
			'title'		=> esc_html__( 'Show Footer Social Icons', 'tokoo' ),
			'default'	=> 0,
		),

		array(
			'id'		=> 'footer_social_icons_text',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Footer Social Icons Text', 'tokoo' ),
			'default'	=> esc_html__( 'Follow us on :', 'tokoo' ),
			'required'	=> array( 'show_footer_social_icons', 'equals', true ),
		),


		array(
			'id'		=> 'footer_social_icons_block_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'id'		=> 'footer_widgets_start',
			'type'		=> 'section',
			'title'		=> esc_html__( 'Footer Widgets', 'tokoo' ),
			'subtitle'	=> esc_html__( 'Options related to Footer Widgets. Please add widgets in Appearance > Widgets > Footer Column widget area. If the widget area is empty without any widgets, the theme loads default widgets.', 'tokoo' ),
			'indent'	=> true,
		),

		array(
			'title'		=> esc_html__( 'Show Footer Widgets ?', 'tokoo' ),
			'id'		=> 'show_footer_widgets',
			'type'		=> 'switch',
			'default'	=> 1,
		),

		array(
			'id'		=> 'footer_widgets_end',
			'type'		=> 'section',
			'indent'	=> false
		),

		array(
			'id'		=> 'footer_bottom_bar_start',
			'type'		=> 'section',
			'indent'	=> true,
			'title'		=> esc_html__( 'Footer Bottom Bar', 'tokoo' ),
			'subtitle'	=> esc_html__( 'The Footer Bottom Bar is available bottom of Footer.', 'tokoo' ),
		),

		array(
			'id'        => 'footer_bottom_bar_enable',
			'type'      => 'switch',
			'title'     => esc_html__( 'Enable Footer Bottom Bar', 'tokoo' ),
			'default'   => 1,
		),

		array(
			'id'        => 'footer_payment_icons_enable',
			'type'      => 'switch',
			'title'     => esc_html__( 'Enable Footer Payment Icons', 'tokoo' ),
			'default'   => 0,
			'required'	=> array( 'footer_bottom_bar_enable', 'equals', true ),
		),

		array(
			'id'		=> 'footer_payment_text',
			'type'		=> 'text',
			'title'		=> esc_html__( 'Footer Payment Icons Text', 'tokoo' ),
			'default'	=> esc_html__( 'We accept', 'tokoo' ),
			'required'	=> array( 'footer_payment_icons_enable', 'equals', true ),
		),

		array(
			'id'		=> 'footer_payment_icons',
			'type'		=> 'media',
			'title'		=> esc_html__( 'Footer Payment Icons Image', 'tokoo' ),
			'required'  => array( 'footer_payment_icons_enable', 'equals', 1 ),
		),

		array(
			'id'		=> 'footer_copyright',
			'type'		=> 'textarea',
			'title'		=> esc_html__( 'Footer Copyright Text', 'tokoo' ),
			'default'	=> '&copy; Copyright 2018 <a href="' . esc_url( home_url( '/' ) ) . '">' .  get_bloginfo( 'name' ) . '</a> - All Rights Reserved',
			'required'  => array( 'footer_bottom_bar_enable', 'equals', 1 ),
		),

		array(
			'id'		=> 'footer_bottom_bar_end',
			'type'		=> 'section',
			'indent'	=> false
		),

	)
) );
