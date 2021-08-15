<?php
/**
 * Template tags for About
 */
function tokoo_get_default_about_options() {
	$about = array(
		'ah'  => array(
			'is_enabled' => 'yes',
			'priority'   => 10,
			'animation'  => '',
			'pre_title'  => esc_html__( 'know us better', 'tokoo' ),
			'title'      => esc_html__( 'About Us', 'tokoo' ),
		),
		'ac1' => array(
			'is_enabled'    => 'yes',
			'priority'      => 20,
			'animation'     => '',
			'about_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum Nam liber tempor cum soluta nobis eleifend. <br><br>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 'tokoo' ),
		),
		'fl'  => array(
			'is_enabled' => 'yes',
			'priority'   => 30,
			'animation'  => '',
			'features'   => array(
				array(
					'icon'  => 'flaticon-security',
					'label' => esc_html__( '100% Payment <br>Secured', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-wallet',
					'label' => esc_html__( 'Support lots <br>of Payments', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-support',
					'label' => esc_html__( 'Friendly Customer <br>Support', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-shipped',
					'label' => esc_html__( 'Free Delivery <br>to All Destinations', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-price-tag',
					'label' => esc_html__( 'Best Price <br>Guaranteed', 'tokoo' ),
				),
				array(
					'icon'  => 'flaticon-system',
					'label' => esc_html__( 'Mobile Apps <br>Ready', 'tokoo' ),
				),
			),
		),
		'ac2' => array(
			'is_enabled'    => 'yes',
			'priority'      => 40,
			'animation'     => '',
			'about_content' => esc_html__( 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum Nam liber tempor cum soluta nobis eleifend.', 'tokoo' ),
		),
		'ts'  => array(
			'is_enabled'    => 'yes',
			'priority'      => 50,
			'animation'     => '',
			'section_title' => esc_html__( 'Our Team', 'tokoo' ),
			'orderby'       => 'title',
			'order'         => 'ASC',
			'limit'         => 3,
			'category'      => '',
		),
		'aj'  => array(
			'is_enabled'    => 'yes',
			'priority'      => 60,
			'animation'     => '',
			'section_title' => esc_html__( 'Join Us on Tokoo', 'tokoo' ),
			'jobs'          => array(
				array(
					'pre_title'      => 'backend',
					'job_title_link' => '#',
					'job_title'      => 'Ruby on Rails Dev',
					'description'    => 'Duis autem vel eum iriure dolor in hendrerit in vulput velit esse molestie conseqt, vel illum dolore eu feugiat. nulla facilisis at vero. Vel illum dolore eu feugiat.',
					'action_text'    => 'Apply Now',
					'action_link'    => '#',
				),
				array(
					'pre_title'      => 'backend',
					'job_title_link' => '#',
					'job_title'      => 'Wordpress Devs',
					'description'    => 'Duis autem vel eum iriure dolor in hendrerit in vulput velit esse molestie conseqt, vel illum dolore eu feugiat. nulla facilisis at vero. Vel illum dolore eu feugiat.',
					'action_text'    => 'Apply Now',
					'action_link'    => '#',
				),
				array(
					'pre_title'      => 'frontend',
					'job_title_link' => '#',
					'job_title'      => 'Front-end Devs',
					'description'    => 'Duis autem vel eum iriure dolor in hendrerit in vulput velit esse molestie conseqt, vel illum dolore eu feugiat. nulla facilisis at vero. Vel illum dolore eu feugiat.',
					'action_text'    => 'Apply Now',
					'action_link'    => '#',
				),
				array(
					'pre_title'      => 'design',
					'job_title_link' => '#',
					'job_title'      => 'UI/UX Designer',
					'description'    => 'Duis autem vel eum iriure dolor in hendrerit in vulput velit esse molestie conseqt, vel illum dolore eu feugiat. nulla facilisis at vero. Vel illum dolore eu feugiat.',
					'action_text'    => 'Apply Now',
					'action_link'    => '#',
				),
			),
		),
	);

	return apply_filters( 'tokoo_get_default_about_options', $about );
}

function tokoo_get_about_meta( $merge_default = true ) {
	global $post;

	if ( isset( $post->ID ) ) {

		$clean_about_options = get_post_meta( $post->ID, '_about_options', true );
		$about_options       = maybe_unserialize( $clean_about_options );

		if ( ! is_array( $about_options ) ) {
			$about_options = json_decode( $clean_about_options, true );
		}

		if ( $merge_default ) {
			$default_options = tokoo_get_default_about_options();
			$about           = wp_parse_args( $about_options, $default_options );
		} else {
			$about = $about_options;
		}

		return apply_filters( 'tokoo_about_meta', $about, $post );
	}
}

if ( ! function_exists( 'tokoo_about_header' ) ) {
	/**
	 * Display About Header
	 */
	function tokoo_about_header() {
		$about      = tokoo_get_about_meta();
		$ah_options = $about['ah'];

		$is_enabled = isset( $ah_options['is_enabled'] ) ? filter_var( $ah_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $ah_options['animation'] ) ? $ah_options['animation'] : '';

		$args = array(
			'section_class' => '',
			'animation'     => $animation,
			'pre_title'     => isset( $ah_options['pre_title'] ) ? $ah_options['pre_title'] : esc_html__( 'know us better', 'tokoo' ),
			'title'         => isset( $ah_options['title'] ) ? $ah_options['title'] : esc_html__( 'About Us', 'tokoo' ),
		);

		$args = apply_filters( 'tokoo_about_header_args', $args );

		tokoo_about_header_section( $args );
	}
}

if ( ! function_exists( 'tokoo_about_content_1' ) ) {
	/**
	 * Display About Content_1
	 */
	function tokoo_about_content_1() {
		$about       = tokoo_get_about_meta();
		$ac1_options = $about['ac1'];

		$is_enabled = isset( $ac1_options['is_enabled'] ) ? filter_var( $ac1_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $ac1_options['animation'] ) ? $ac1_options['animation'] : '';

		$args = array(
			'section_class' => '',
			'animation'     => $animation,
			'about_content' => isset( $ac1_options['about_content'] ) ? $ac1_options['about_content'] : esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum Nam liber tempor cum soluta nobis eleifend. <br><br>Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 'tokoo' ),
		);

		$args = apply_filters( 'tokoo_about_content_1_args', $args );

		tokoo_about_content_section( $args );
	}
}

if ( ! function_exists( 'tokoo_about_features_list' ) ) {
	/**
	 * Display About Feature List
	 */
	function tokoo_about_features_list() {
		$about      = tokoo_get_about_meta();
		$fl_options = $about['fl'];

		$is_enabled = isset( $fl_options['is_enabled'] ) ? filter_var( $fl_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $fl_options['animation'] ) ? $fl_options['animation'] : '';

		$args = array(
			'section_class' => 'about-features',
			'animation'     => $animation,
			'features'      => array(),
		);

		foreach ( $fl_options['features'] as $key => $feature ) {
			if ( isset( $feature['icon'] ) && isset( $feature['label'] ) ) {
				$args['features'][] = array(
					'icon'  => $feature['icon'],
					'label' => $feature['label'],
				);
			}
		}

		$args = apply_filters( 'tokoo_about_features_list_args', $args );

		tokoo_features_list( $args );
	}
}

if ( ! function_exists( 'tokoo_about_content_2' ) ) {
	/**
	 * Display About Content_2
	 */
	function tokoo_about_content_2() {
		$about       = tokoo_get_about_meta();
		$ac2_options = $about['ac2'];

		$is_enabled = isset( $ac2_options['is_enabled'] ) ? filter_var( $ac2_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $ac2_options['animation'] ) ? $ac2_options['animation'] : '';

		$args = array(
			'section_class' => '',
			'animation'     => $animation,
			'about_content' => isset( $ac2_options['about_content'] ) ? $ac2_options['about_content'] : esc_html__( 'Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum Nam liber tempor cum soluta nobis eleifend.', 'tokoo' ),
		);

		$args = apply_filters( 'tokoo_about_content_2_args', $args );

		$section_class = empty( $section_class ) ? 'about-content' : 'about-content' . $section_class;

		if ( ! empty( $animation ) ) {
			$section_class .= ' animate-in-view';
		}

		?>
		<div class="<?php echo esc_attr( $section_class ); ?>" <?php if ( ! empty( $animation ) ) : ?>
			data-animation="<?php echo esc_attr( $animation ); ?>"<?php endif; ?>>
			<?php
			if ( ! empty( $args['about_content'] ) ) {
				echo '<p>' . wp_kses_post( $args['about_content'] ) . '</p>';
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tokoo_about_testimonial' ) ) {
	/**
	 * Displays Testimonial
	 */
	function tokoo_about_testimonial() {
		$about      = tokoo_get_about_meta();
		$ts_options = $about['ts'];

		$is_enabled = isset( $ts_options['is_enabled'] ) ? filter_var( $ts_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $ts_options['animation'] ) ? $ts_options['animation'] : '';

		$section_args = apply_filters(
			'tokoo_testimonial_section_args',
			array(
				'animation'     => $animation,
				'section_title' => isset( $ts_options['section_title'] ) ? $ts_options['section_title'] : 'Our Team',
			)
		);

		$taxonomy_args = array(
			'limit'    => isset( $ts_options['limit'] ) ? $ts_options['limit'] : 3,
			'orderby'  => isset( $ts_options['orderby'] ) ? $ts_options['orderby'] : 'title',
			'order'    => isset( $ts_options['order'] ) ? $ts_options['order'] : 'ASC',
			'category' => isset( $ts_options['category'] ) ? $ts_options['category'] : '',
		);

		tokoo_testimonial( $section_args, $taxonomy_args );
	}
}

if ( ! function_exists( 'tokoo_about_job_section' ) ) {
	/**
	 * Display About Job Section
	 */
	function tokoo_about_job_section() {
		$about      = tokoo_get_about_meta();
		$aj_options = $about['aj'];

		$is_enabled = isset( $aj_options['is_enabled'] ) ? filter_var( $aj_options['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

		if ( ! $is_enabled ) {
			return;
		}

		$animation = isset( $aj_options['animation'] ) ? $aj_options['animation'] : '';

		$args = array(
			'section_class' => '',
			'animation'     => $animation,
			'section_title' => isset( $aj_options['section_title'] ) ? $aj_options['section_title'] : esc_html__( 'Join Us on Tokoo', 'tokoo' ),
			'jobs'          => array(),
		);

		foreach ( $aj_options['jobs'] as $key => $job ) {
			if ( isset( $job['pre_title'] ) && isset( $job['job_title_link'] ) && isset( $job['job_title'] ) && isset( $job['description'] ) && isset( $job['action_text'] ) && isset( $job['action_link'] ) ) {
				$args['jobs'][] = array(
					'pre_title'      => $job['pre_title'],
					'job_title_link' => $job['job_title_link'],
					'job_title'      => $job['job_title'],
					'description'    => $job['description'],
					'action_text'    => $job['action_text'],
					'action_link'    => $job['action_link'],
				);
			}
		}

		$args = apply_filters( 'tokoo_about_job_section_args', $args );

		tokoo_job_section( $args );
	}
}

if ( ! function_exists( 'tokoo_configure_about_hooks' ) ) {
	function tokoo_configure_about_hooks() {
		if ( is_page_template( array( 'template-aboutpage.php' ) ) ) {
			remove_all_actions( 'tokoo_about' );

			$about = tokoo_get_about_meta();

			$is_enabled = isset( $about['hpc']['is_enabled'] ) ? filter_var( $about['hpc']['is_enabled'], FILTER_VALIDATE_BOOLEAN ) : false;

			if ( $is_enabled ) {
				add_action( 'tokoo_about', 'tokoo_homepage_content', isset( $about['hpc']['priority'] ) ? intval( $about['hpc']['priority'] ) : 5 );
			}

			add_action( 'tokoo_about', 'tokoo_about_header', isset( $about['ah']['priority'] ) ? intval( $about['ah']['priority'] ) : 10 );
			add_action( 'tokoo_about', 'tokoo_about_content_1', isset( $about['ac1']['priority'] ) ? intval( $about['ac1']['priority'] ) : 20 );
			add_action( 'tokoo_about', 'tokoo_about_features_list', isset( $about['fl']['priority'] ) ? intval( $about['fl']['priority'] ) : 30 );
			add_action( 'tokoo_about', 'tokoo_about_content_2', isset( $about['ac2']['priority'] ) ? intval( $about['ac2']['priority'] ) : 40 );
			add_action( 'tokoo_about', 'tokoo_about_testimonial', isset( $about['ts']['priority'] ) ? intval( $about['ts']['priority'] ) : 50 );
			add_action( 'tokoo_about', 'tokoo_about_job_section', isset( $about['aj']['priority'] ) ? intval( $about['aj']['priority'] ) : 60 );
		}
	}
}
