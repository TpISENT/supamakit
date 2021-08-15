<?php
/**
 * Options available for Blog sub menu of Theme Options
 * 
 */

$blog_options 	= apply_filters( 'tokoo_blog_options_args', array(
	'title'		=> esc_html__( 'Blog', 'tokoo' ),
	'icon'		=> 'far fa-list-alt',
	'fields'	=> array(
	
		array(
			'title'     => esc_html__('Blog Page View', 'tokoo'),
			'subtitle'  => esc_html__('Select the view for the Blog Listing.', 'tokoo'),
			'id'        => 'blog_view',
			'type'      => 'select',
			'options'   => array(
				'blog-grid'		=> esc_html__( 'Grid', 'tokoo' ),
				'blog-list'		=> esc_html__( 'List', 'tokoo' )
			),
			'default'   => 'blog-grid',
		),

		array(
			'title'     => esc_html__('Blog Page Layout', 'tokoo'),
			'subtitle'  => esc_html__('Select the layout for the Blog Listing.', 'tokoo'),
			'id'        => 'blog_layout',
			'type'      => 'select',
			'options'   => array(
				'full-width'  	      => esc_html__( 'Full Width', 'tokoo' ),
				'left-sidebar'        => esc_html__( 'Left Sidebar', 'tokoo' ),
				'right-sidebar'       => esc_html__( 'Right Sidebar', 'tokoo' ),
			),
			'default'   => 'full-width',
		),

		array(
			'title'     => esc_html__('Single Post Layout', 'tokoo'),
			'subtitle'  => esc_html__('Select the layout for the Single Post.', 'tokoo'),
			'id'        => 'single_post_layout',
			'type'      => 'select',
			'options'   => array(
				'full-width'  	      => esc_html__( 'Full Width', 'tokoo' ),
				'left-sidebar'        => esc_html__( 'Left Sidebar', 'tokoo' ),
				'right-sidebar'       => esc_html__( 'Right Sidebar', 'tokoo' ),
			),
			'default'   => 'full-width',
		),

		array(
			'title'     => esc_html__( 'Blog Post Placeholder Icon', 'tokoo' ),
			'id'        => 'enable_post_icon_placeholder',
			'on'        => esc_html__('Show', 'tokoo'),
			'off'       => esc_html__('Hide', 'tokoo'),
			'type'      => 'switch',
			'default'   => false,
		),

		array(
			'title'     => esc_html__( 'Blog Post Author Info', 'tokoo' ),
			'id'        => 'show_blog_post_author_info',
			'on'        => esc_html__('Show', 'tokoo'),
			'off'       => esc_html__('Hide', 'tokoo'),
			'type'      => 'switch',
			'default'   => false,
		),
	)
) );