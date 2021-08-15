<?php
/**
 * Options available for Styling sub menu of Theme Options
 *
 */

$custom_css_page_link = '<a href="' . esc_url( add_query_arg( array( 'page' => 'custom-primary-color-css-page' ) ), admin_url( 'themes.php' ) ) . '">' . esc_html__( 'Custom Primary CSS', 'tokoo' ) . '</a>';

$style_options 	= apply_filters( 'tokoo_style_options_args', array(
	'title'		=> esc_html__( 'Styling', 'tokoo' ),
	'icon'		=> 'fas fa-edit',
	'fields'	=> array(
		array(
			'id'		=> 'styling_general_info_start',
			'type'		=> 'section',
			'title'		=> esc_html__( 'General', 'tokoo' ),
			'subtitle'	=> esc_html__( 'General Theme Style Settings', 'tokoo' ),
			'indent'	=> TRUE,
		),

		array(
			'title'		=> esc_html__( 'Use a predefined color scheme', 'tokoo' ),
			'on'		=> esc_html__('Yes', 'tokoo'),
			'off'		=> esc_html__('No', 'tokoo'),
			'type'		=> 'switch',
			'default'	=> 1,
			'id'		=> 'use_predefined_color'
		),

		array(
			'title'		=> esc_html__( 'Main Theme Color', 'tokoo' ),
			'subtitle'	=> esc_html__( 'The main color of the site.', 'tokoo' ),
			'id'		=> 'main_color',
			'type'		=> 'select',
			'options'	=> array(
				'green'			=> esc_html__( 'Green', 'tokoo' ),
				'red'			=> esc_html__( 'Red', 'tokoo' ),
				'blue'			=> esc_html__( 'Blue', 'tokoo' ),
				'purple'		=> esc_html__( 'Purple', 'tokoo' ),
				'midnightblue'	=> esc_html__( 'Midnightblue', 'tokoo' ),
				'orange'		=> esc_html__( 'Orange', 'tokoo' ),
			),
			'default'	=> 'green',
			'required'	=> array( 'use_predefined_color', 'equals', 1 ),
		),

		array(
			'id'		  => 'custom_primary_color',
			'title'		  => esc_html__( 'Custom Primary Color', 'tokoo' ),
			'type'		  => 'color',
			'transparent' => false,
			'default'	  => '#45b44d',
			'required'	  => array( 'use_predefined_color', 'equals', 0 ),
		),
		
		array(
			'id'		  => 'custom_primary_text_color',
			'title'		  => esc_html__( 'Custom Primary Text Color', 'tokoo' ),
			'type'		  => 'color',
			'transparent' => false,
			'default'     => '#fff',
			'required'	  => array( 'use_predefined_color', 'equals', 0 ),
		),

		array(
			'id'		  => 'include_custom_color',
			'title'		  => esc_html__( 'How to include custom color ?', 'tokoo' ),
			'type'		  => 'radio',
			'options'     => array(
				'1'  => esc_html__( 'Inline', 'tokoo' ),
				'2'  => esc_html__( 'External File', 'tokoo' )
			),
			'default'     => '1',
			'required'	  => array( 'use_predefined_color', 'equals', 0 ),
		),

		array(
			'id'		=> 'external_file_css',
			'type'      => 'raw',
			'title'		=> esc_html__( 'Custom Primary Color CSS', 'tokoo' ),
			'content'  	=> esc_html__( 'If you choose "External File", then please "Save Changes" and then click on ths link to get the custom color primary CSS: ', 'tokoo' ) . $custom_css_page_link,
			'required'	=> array( 'use_predefined_color', 'equals', 0 ),
		),

		array(
			'id'		=> 'styling_general_info_end',
			'type'		=> 'section',
			'indent'	=> FALSE,
		),
	)
) );
