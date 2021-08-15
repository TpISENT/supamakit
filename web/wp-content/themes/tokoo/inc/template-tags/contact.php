<?php
/**
 * Template tags for Contact
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function tokoo_get_default_contact_options() {
	$contact_us = array(
		'cma' => array(
			'is_enabled' => 'yes',
			'priority'   => 10,
			'map'        => '',
		),
		'cfm' => array(
			'is_enabled' => 'yes',
			'priority'   => 20,
			'animation'  => '',
			'pre_title'  => esc_html__( 'Leave Us a Message', 'tokoo' ),
			'title'      => esc_html__( 'Contact Us', 'tokoo' ),
			'shortcode'  => '[contact-form-7 title="Contact page form"]',
		),
	);

	return apply_filters( 'tokoo_get_default_contact_options', $contact_us );
}

function tokoo_get_contact_meta( $merge_default = true ) {
	global $post;

	if ( isset( $post->ID ) ) {

		$clean_contact_options = get_post_meta( $post->ID, '_contact_options', true );
		$contact_options       = maybe_unserialize( $clean_contact_options );

		if ( ! is_array( $contact_options ) ) {
			$contact_options = json_decode( $clean_contact_options, true );
		}

		if ( $merge_default ) {
			$default_options = tokoo_get_default_contact_options();
			$contact_us      = wp_parse_args( $contact_options, $default_options );
		} else {
			$contact_us = $contact_options;
		}

		return apply_filters( 'tokoo_contact_meta', $contact_us, $post );
	}
}

if ( ! function_exists( 'tokoo_contact_map' ) ) {
	/**
	 * Displays Contact Map
	 */
	function tokoo_contact_map() {
		$contact     = tokoo_get_contact_meta();
		$cma_options = $contact['cma'];

		$is_enabled = isset( $cma_options['is_enabled'] ) ? $cma_options['is_enabled'] : 'no';

		if ( 'yes' !== $is_enabled ) {
			return;
		}

		$animation     = isset( $cma_options['animation'] ) ? $cma_options['animation'] : '';
		$section_class = 'google-map';
		$args          = array(
			'map' => isset( $cma_options['map'] ) ? $cma_options['map'] : '',
		);

		if ( ! empty( $animation ) ) {
			$section_class .= ' animate-in-view';
		}

		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>
			data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<?php echo apply_filters( 'tokoo_contact_map_content', $args['map'] ); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_contact_form' ) ) {
	/**
	 * Displays Contact Form
	 */
	function tokoo_contact_form() {
		$contact     = tokoo_get_contact_meta();
		$cfm_options = $contact['cfm'];

		$is_enabled = isset( $cfm_options['is_enabled'] ) ? filter_var( $cfm_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $cfm_options['animation'] ) ? $cfm_options['animation'] : '';

		$args = array(
			'section_class' => '',
			'animation'     => $animation,
			'pre_title'     => isset( $cfm_options['pre_title'] ) ? $cfm_options['pre_title'] : esc_html__( 'Leave Us a Message', 'tokoo' ),
			'title'         => isset( $cfm_options['title'] ) ? $cfm_options['title'] : esc_html__( 'Contact Us', 'tokoo' ),
			'shortcode'     => isset( $cfm_options['shortcode'] ) ? $cfm_options['shortcode'] : '[contact-form-7 title="Contact page form"]',
		);

		$args = apply_filters( 'tokoo_contact_form_args', $args );

		$section_class = empty( $section_class ) ? 'contact-form' : 'contact-form' . $section_class;

		if ( ! empty( $animation ) ) {
			$section_class .= ' animate-in-view';
		}

		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>
			data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<div class="contact-form-inner">
				<?php
				if ( ! empty( $args['pre_title'] ) ) {
					echo '<h3 class="pretitle">' . wp_kses_post( $args['pre_title'] ) . '</h3>';
				}

				if ( ! empty( $args['title'] ) ) {
					echo '<h2 class="title">' . wp_kses_post( $args['title'] ) . '</h2>';
				}

					echo do_shortcode( $args['shortcode'] );
				?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_contactpage_hook_control' ) ) {
	function tokoo_contactpage_hook_control() {
		if ( is_page_template( array( 'template-contactpage.php' ) ) ) {
			remove_all_actions( 'tokoo_contact' );

			$contact = tokoo_get_contact_meta();

			$is_enabled = isset( $contact['hpc']['is_enabled'] ) ? filter_var( $contact['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

			if ( $is_enabled ) {
				add_action( 'tokoo_contact', 'tokoo_homepage_content', isset( $contact['hpc']['priority'] ) ? intval( $contact['hpc']['priority'] ) : 5 );
			}

			add_action( 'tokoo_contact', 'tokoo_contact_map', isset( $contact['cma']['priority'] ) ? intval( $contact['cma']['priority'] ) : 10 );
			add_action( 'tokoo_contact', 'tokoo_contact_form', isset( $contact['cfm']['priority'] ) ? intval( $contact['cfm']['priority'] ) : 20 );
		}
	}
}
