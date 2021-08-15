<?php
/**
 * Tokoo Admin Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


function tokoo_custom_primary_color_page() {
	?><h1><?php echo esc_html__( 'Tokoo Custom Primary Color CSS', 'tokoo' ); ?></h1>
	<p><?php echo esc_html__( 'The generated custom primary color CSS is given below', 'tokoo' ); ?></p>
	<textarea class="tokoo-custom-primary-color-textarea"><?php echo wp_kses_post( redux_get_custom_color_css() ); ?></textarea>
	<h2><?php echo esc_html__( 'Instructions', 'tokoo' );?></h2>
	<ol>
		<li><?php echo esc_html__( 'Create a file named custom-color.css in your child theme like wp-content/themes/tokoo-child/custom-color.css. Latest versions of tokoo-child comes with an empty custom-color.css so you don\'t have to create one', 'tokoo' ); ?></li>
		<li><?php echo esc_html__( 'If you do not use a child theme, please use one otherwise all your custom changes will be lost during update', 'tokoo' ); ?></li>
		<li><?php echo esc_html__( 'Copy the CSS above and paste in the custom-color.css file created in step 1', 'tokoo' ); ?></li>
		<li><?php echo esc_html__( 'Thats it. Your custom-color.css will be loaded automatically.', 'tokoo' ); ?></li>
	</ol><?php
}