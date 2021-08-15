<?php
/**
 * Jumbotron
 *
 * @author  Transvelo
 * @package Tokoo/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! empty( $image ) ) {
	$image_attributes = wp_get_attachment_image_src( $image, 'full' );
}

?>
<div class="jumbotron">
	<?php if( isset( $image_attributes ) ) : ?>
	<div class="jumbotron-img">
		<img class="jumbo-image" src="<?php echo esc_url( $image_attributes[0] ); ?>" alt="<?php echo esc_attr( $title ); ?>" width="416" height="283" />
	</div>
	<?php endif; ?>
	<div class="jumbotron-caption">
		<h3 class="jumbo-title"><?php echo wp_kses_post( $title ); ?></h3>
	</div>
</div>