<?php
/**
 * General Theme Options
 * 
 */

$general_options 	= apply_filters( 'tokoo_general_options_args', array(
	'title'		=> esc_html__( 'General', 'tokoo' ),
	'icon'		=> 'far fa-dot-circle',
	'fields'	=> array(
		array(
			'title'		=> esc_html__( 'Scroll To Top', 'tokoo' ),
			'id'		=> 'scrollup',
			'type'		=> 'switch',
			'on'		=> esc_html__('Enabled', 'tokoo'),
			'off'		=> esc_html__('Disabled', 'tokoo'),
			'default'	=> 1,
		)
	)
) );

if ( is_child_theme() ) {
	$general_options['fields'][] = array(
		'title'   => esc_html__( 'Load child theme style.css', 'tokoo' ),
		'id'      => 'load_child_theme',
		'type'    => 'switch',
		'default' => 0
	);
}