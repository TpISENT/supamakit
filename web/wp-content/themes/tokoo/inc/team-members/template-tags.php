<?php
/**
 * Custom template tags used to integrate this theme with Our Team.
 *
 * @package Tokoo
 */

if( ! function_exists( 'tokoo_add_team_member_fields' ) ) {
    function tokoo_add_team_member_fields( $fields ) {
        
        $fields['twitter']['name'] = esc_html__( 'Twitter URL', 'tokoo' );
        $fields['twitter']['description'] = esc_html__( 'Enter this team member\'s Twitter url.', 'tokoo' );
        
        $fields['facebook'] = array(
            'name'            => esc_html__( 'Facebook URL', 'tokoo' ),
            'description'     => esc_html__( 'Enter this team member\'s Facebook url.', 'tokoo' ),
            'type'            => 'text',
            'default'         => '',
            'section'         => 'info'
        );
        
        $fields['linkedin'] = array(
            'name'            => esc_html__( 'Linkedin Username', 'tokoo' ),
            'description'     => esc_html__( 'Enter this team member\'s Linkedin url.', 'tokoo' ),
            'type'            => 'text',
            'default'         => '',
            'section'         => 'info'
        );

        return $fields;
    }
}

if ( !function_exists( 'our_team_member_archive_social_links' ) ) {
	function our_team_member_archive_social_links( $post_id = '' ) {

		if( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}
		
		if ( apply_filters( 'enable_archive_team_member_social', TRUE ) ) :
			$twitter 			= esc_attr( get_post_meta( $post_id, '_twitter', true ) );
			$facebook			= esc_attr( get_post_meta( $post_id, '_facebook', true ) );
			$linkedin			= esc_attr( get_post_meta( $post_id, '_linkedin', true ) );
			$mail 				= esc_attr( get_post_meta( $post_id, '_contact_email', true ) );
			$url 				= esc_attr( get_post_meta( $post_id, '_url', true ) );

			$social_icons = apply_filters( 'our_team_member_archive_social_links_icons_args', array(
					'facebook'	=> array( 
						'class' 		=> 'facebook', 
						'icon' 			=> 'fab fa-facebook-f', 
						'title' 		=> esc_html__( 'Add me on Facebook', 'tokoo' ),
						'social_link' 	=> $facebook 
					),
					'twitter'		=> array( 
						'class' 		=> 'twitter', 
						'icon' 			=> 'fab fa-twitter', 
						'title' 		=> esc_html__( 'Follow me on Twitter', 'tokoo' ),
						'social_link' 	=> $twitter 
					),
					'linkedin'			=> array( 
						'class' 		=> 'linkedin', 
						'icon' 			=> 'fab fa-linkedin-in', 
						'title' 		=> esc_html__( 'Add me on Linkedin', 'tokoo' ),
						'social_link' 	=> $linkedin 
					)
				)
			);
			?>
			<ul class="social-links">
				<?php foreach ($social_icons as $social_icon) : ?>
					<?php if( !empty( $social_icon['social_link'] ) ) :?>
					<?php $url = !empty( $social_icon['link_prefix'] ) ? $social_icon['link_prefix'] . ':' . $social_icon['social_link'] : esc_url( $social_icon['social_link'] ); ?>
					<li class="<?php echo esc_attr( $social_icon['class'] ); ?>">
						<a href="<?php echo esc_url( $url ); ?>"><i class="<?php echo esc_attr( $social_icon['icon'] ); ?>"></i></a>
					</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;
	}
}