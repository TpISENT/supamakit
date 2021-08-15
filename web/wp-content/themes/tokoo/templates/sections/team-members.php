<?php
/**
 * Team Members
 *
 * @package Tokoo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$query = array('size' => '');
$query = woothemes_get_our_team( $query );
?>

<div class="testimonial">
	<div class="container">

		<header class="section-header">

            <?php if ( ! empty( $section_args['section_title'] ) ) : ?>
         		<h2 class="title"><?php echo esc_html( $section_args['section_title'] ); ?></h2>
        	<?php endif; ?>
	        
	    </header>

		<ul class="team-member-list">
		<?php if( is_array( $query ) || is_object( $query ) ) : ?>
			<?php foreach ( $query as $post ) : ?>
				<li class="team-member">
					<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo get_the_post_thumbnail( $post->ID ); ?></a>
					<div class="profile">
						<h4><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo  esc_html( $post->post_title ); ?></a></h4>
						<div class="designation" ><?php echo esc_html( $post->byline ); ?></div>
						<?php our_team_member_archive_social_links( $post->ID ); ?>
					</div>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
		</ul>

	</div>
</div>