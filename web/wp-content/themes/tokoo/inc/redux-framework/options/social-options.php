<?php
/**
 * Options available for Social Media sub menu of Theme Options
 *
 */

$social_options 	= apply_filters( 'tokoo_social_media_options_args', array(
	'title'     => esc_html__('Social Media', 'tokoo'),
	'icon'      => 'fas fa-share-square',
	'desc'      => esc_html__('Please type in your complete social network URL', 'tokoo' ),
	'fields'    => array(
		array(
			'title'     => esc_html__('Facebook', 'tokoo'),
			'id'        => 'facebook',
			'type'      => 'text',
			'icon'      => 'fa fa-facebook',
		),

		array(
			'title'     => esc_html__('Twitter', 'tokoo'),
			'id'        => 'twitter',
			'type'      => 'text',
			'icon'      => 'fa fa-twitter',
		),

		array(
			'title'     => esc_html__('Whatsapp Mobile', 'tokoo'),
			'id'        => 'whatsapp-mobile',
			'type'      => 'text',
			'icon'      => 'fa fa-whatsapp',
		),

		array(
			'title'     => esc_html__('Whatsapp Desktop', 'tokoo'),
			'id'        => 'whatsapp-desktop',
			'type'      => 'text',
			'icon'      => 'fa fa-whatsapp',
		),

		array(
			'title'     => esc_html__('Google+', 'tokoo'),
			'id'        => 'googleplus',
			'type'      => 'text',
			'icon'      => 'fa fa-google-plus',
		),

		array(
			'title'     => esc_html__('Pinterest', 'tokoo'),
			'id'        => 'pinterest',
			'type'      => 'text',
			'icon'      => 'fa fa-pinterest',
		),

		array(
			'title'     => esc_html__('LinkedIn', 'tokoo'),
			'id'        => 'linkedin',
			'type'      => 'text',
			'icon'      => 'fa fa-linkedin',
		),

		array(
			'title'     => esc_html__('Tumblr', 'tokoo'),
			'id'        => 'tumblr',
			'type'      => 'text',
			'icon'      => 'fa fa-tumblr',
		),

		array(
			'title'     => esc_html__('Instagram', 'tokoo'),
			'id'        => 'instagram',
			'type'      => 'text',
			'icon'      => 'fa fa-instagram',
		),

		array(
			'title'     => esc_html__('Youtube', 'tokoo'),
			'id'        => 'youtube',
			'type'      => 'text',
			'icon'      => 'fa fa-youtube',
		),

		array(
			'title'     => esc_html__('Vimeo', 'tokoo'),
			'id'        => 'vimeo',
			'type'      => 'text',
			'icon'      => 'fa fa-vimeo-square',
		),

		array(
			'title'     => esc_html__('Dribbble', 'tokoo'),
			'id'        => 'dribbble',
			'type'      => 'text',
			'icon'      => 'fa fa-dribbble',
		),

		array(
			'title'     => esc_html__('Stumble Upon', 'tokoo'),
			'id'        => 'stumbleupon',
			'type'      => 'text',
			'icon'      => 'fa fa-stumpleupon',
		),

		array(
			'title'     => esc_html__('Sound Cloud', 'tokoo'),
			'id'        => 'soundcloud',
			'type'      => 'text',
			'icon'      => 'fa fa-soundcloud',
		),

		array(
			'title'     => esc_html__('Vine', 'tokoo'),
			'id'        => 'vine',
			'type'      => 'text',
			'icon'      => 'fa fa-vine',
		),

		array(
			'title'     => esc_html__('VKontakte', 'tokoo'),
			'id'        => 'vk',
			'type'      => 'text',
			'icon'      => 'fa fa-vk',
		),

		array(
			'title'     => esc_html__('Telegram', 'tokoo'),
			'id'        => 'telegram',
			'type'      => 'text',
			'icon'      => 'fa fa-telegram',
		),

		array(
			'id'		=> 'show_footer_rss_icon',
			'type'		=> 'switch',
			'title'		=> esc_html__( 'RSS', 'tokoo' ),
			'desc'		=> esc_html__( 'On enabling footer rss icon.', 'tokoo' ),
			'default'	=> 1,
		),
	),
) );
