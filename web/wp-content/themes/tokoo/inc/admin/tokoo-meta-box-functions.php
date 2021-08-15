<?php
/**
 * Tokoo Meta Box Functions
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Output a text input box.
 *
 * @param array $field
 */
function tokoo_wp_text_input( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['type']          = isset( $field['type'] ) ? $field['type'] : 'text';
	$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];

	switch ( $data_type ) {
		case 'url' :
			$field['class'] .= ' tokoo_input_url';
			$field['value']  = esc_url( $field['value'] );
			break;

		default :
			break;
	}

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><input type="' . esc_attr( $field['type'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" ' . implode( ' ', $custom_attributes ) . ' /> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo tokoo_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a hidden input box.
 *
 * @param array $field
 */
function tokoo_wp_hidden_input( $field ) {
	global $thepostid, $post;

	$thepostid = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']  = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value'] = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['class'] = isset( $field['class'] ) ? $field['class'] : '';

	echo '<input type="hidden" class="' . esc_attr( $field['class'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) .  '" /> ';
}

/**
 * Output a textarea input box.
 *
 * @param array $field
 */
function tokoo_wp_textarea_input( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><textarea class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '"  name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="2" cols="20" ' . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $field['value'] ) . '</textarea> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo tokoo_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a checkbox input box.
 *
 * @param array $field
 */
function tokoo_wp_checkbox( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'checkbox';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['cbvalue']       = isset( $field['cbvalue'] ) ? $field['cbvalue'] : 'yes';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><input type="checkbox" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['cbvalue'] ) . '" ' . checked( $field['value'], $field['cbvalue'], false ) . '  ' . implode( ' ', $custom_attributes ) . '/> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo tokoo_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}

	echo '</p>';
}

/**
 * Output a select input box.
 *
 * @param array $field
 */
function tokoo_wp_select( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );

	if ( empty( $field['value'] ) && isset( $field['default'] ) ) {
		$field['value'] = $field['default'];
	}

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {

		foreach ( $field['custom_attributes'] as $attribute => $value ){
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" ' . implode( ' ', $custom_attributes ) . '>';

	foreach ( $field['options'] as $key => $value ) {
		echo '<option value="' . esc_attr( $key ) . '" ' . selected( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
	}

	echo '</select> ';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo tokoo_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}
	echo '</p>';
}

/**
 * Output a radio input box.
 *
 * @param array $field
 */
function tokoo_wp_radio( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];

	echo '<fieldset class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><legend>' . wp_kses_post( $field['label'] ) . '</legend><ul class="ec-radios">';

	foreach ( $field['options'] as $key => $value ) {

		echo '<li><label><input
				name="' . esc_attr( $field['name'] ) . '"
				value="' . esc_attr( $key ) . '"
				type="radio"
				class="' . esc_attr( $field['class'] ) . '"
				style="' . esc_attr( $field['style'] ) . '"
				' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '
				/> ' . esc_html( $value ) . '</label>
		</li>';
	}
	echo '</ul>';

	if ( ! empty( $field['description'] ) ) {

		if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
			echo tokoo_help_tip( $field['description'] );
		} else {
			echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}
	}

	echo '</fieldset>';
}

/**
 * Output input fields to choose a WooCommerce Shortcode
 */
function tokoo_wp_wc_shortcode( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'per_page', 'columns', 'orderby' , 'order' );

	echo '<div class="tokoo-wc-shortcode">';

	tokoo_wp_select( array(
		'id'		=> $field['name'],
		'label'		=> $field['label'],
		'default'	=> $field['default'],
		'options'	=> array(
			'recent_products'		=> esc_html__( 'Recent Products', 'tokoo' ),
			'featured_products'		=> esc_html__( 'Featured Products', 'tokoo' ),
			'sale_products'			=> esc_html__( 'Sale Products', 'tokoo' ),
			'best_selling_products'	=> esc_html__( 'Best Selling Products', 'tokoo' ),
			'top_rated_products'	=> esc_html__( 'Top Rated Products', 'tokoo' ),
			'product_category'		=> esc_html__( 'Product Category', 'tokoo' ),
			'products'				=> esc_html__( 'Products', 'tokoo' ),
			'product_attribute'		=> esc_html__( 'Product Attribute', 'tokoo' ),
		),
		'class'		=> 'wc_shortcode_select show_hide_select',
		'name'		=> $field['name'] . '[shortcode]',
		'value'		=> isset( $field['value']['shortcode'] ) ? $field['value']['shortcode'] : $field['default'],
	) );
	
	tokoo_wp_text_input( array(
		'id'			=> $field['name'] . '_product_category_slug',
		'label'			=> esc_html__( 'Product Category Slug', 'tokoo' ),
		'class'			=>'wc_shortcode_product_category_slug',
		'placeholder'	=> esc_html__( 'Enter slug spearate by comma(,).', 'tokoo' ),
		'wrapper_class'	=> 'show_if_product_category hide',
		'name'			=> $field['name'] . '[product_category_slug]',
		'value'			=> isset( $field['value']['product_category_slug'] ) ? $field['value']['product_category_slug'] : '',
	) );

	tokoo_wp_text_input( array(
		'id'			=> $field['name'] . '_cat_operator',
		'label'			=> esc_html__( 'Product Category Operator', 'tokoo' ),
		'class'			=>'wc_shortcode_cat_operator',
		'placeholder'	=> esc_html__( 'Operator to compare categories. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'tokoo' ),
		'wrapper_class'	=> 'show_if_product_category hide',
		'name'			=> $field['name'] . '[cat_operator]',
		'value'			=> isset( $field['value']['cat_operator'] ) ? $field['value']['cat_operator'] : 'IN',
	) );

	tokoo_wp_select( array(
		'id'	=> $field['name'] . '_products_choice',
		'label'	=> esc_html__( 'Show Products by:', 'tokoo' ),
		'options'	=> array(  
			'ids'	=> esc_html__( 'IDs', 'tokoo' ),
			'skus'	=> esc_html__( 'SKUs', 'tokoo' )
		),
		'wrapper_class'	=> 'show_if_products hide',
		'class'			=> 'skus_or_ids',
		'name'			=> $field['name'] . '[products_choice]',
		'value'			=> isset( $field['value']['products_choice'] ) ? $field['value']['products_choice'] : 'ids',
	) );

	tokoo_wp_text_input( array(
		'id'			=> $field['name'] . '_products_ids_skus',
		'label'			=> esc_html__( 'Product IDs or SKUs', 'tokoo' ),
		'placeholder'	=> esc_html__( 'Enter IDs or SKUs separated by comma', 'tokoo' ),
		'wrapper_class'	=> 'show_if_products hide',
		'name'			=> $field['name'] . '[products_ids_skus]',
		'value'			=> isset( $field['value']['products_ids_skus'] ) ? $field['value']['products_ids_skus'] : '',
	) );

	tokoo_wp_text_input( array(
		'id'			=> $field['name'] . '_attribute',
		'label'			=> esc_html__( 'Attribute', 'tokoo' ),
		'class'			=>'wc_shortcode_attribute',
		'placeholder'	=> esc_html__( 'Enter single attribute slug.', 'tokoo' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[attribute]',
		'value'			=> isset( $field['value']['attribute'] ) ? $field['value']['attribute'] : '',
	) );

	tokoo_wp_text_input( array(
		'id'			=> $field['name'] . '_terms',
		'label'			=> esc_html__( 'Terms', 'tokoo' ),
		'class'			=>'wc_shortcode_terms',
		'placeholder'	=> esc_html__( 'Enter term slug spearate by comma(,).', 'tokoo' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[terms]',
		'value'			=> isset( $field['value']['terms'] ) ? $field['value']['terms'] : '',
	) );

	tokoo_wp_text_input( array(
		'id'			=> $field['name'] . '_terms_operator',
		'label'			=> esc_html__( 'Terms Operator', 'tokoo' ),
		'class'			=>'wc_shortcode_terms_operator',
		'placeholder'	=> esc_html__( 'Operator to compare terms. Possible values are \'IN\', \'NOT IN\', \'AND\'.', 'tokoo' ),
		'wrapper_class'	=> 'show_if_product_attribute hide',
		'name'			=> $field['name'] . '[terms_operator]',
		'value'			=> isset( $field['value']['terms_operator'] ) ? $field['value']['terms_operator'] : 'IN',
	) );

	echo '</div>';

	tokoo_wp_wc_shortcode_atts( array( 
		'id'			=> $field['name'] . '_shortcode_atts',
		'label'			=> esc_html__( 'Shortcode Atts', 'tokoo' ),
		'name'			=> $field['name'] . '[shortcode_atts]',
		'value'			=> isset( $field['value']['shortcode_atts'] ) ? $field['value']['shortcode_atts'] : '',
		'fields'		=> $field['fields']
	) );
}

/**
 * Output input fields to choose a WooCommerce Shortcode Atts
 */
function tokoo_wp_wc_shortcode_atts( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'per_page', 'columns', 'orderby' , 'order' );

	echo '<div class="tokoo-wc-shortcode-atts">';

	if( isset( $field['fields'] ) && in_array( 'per_page', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_per_page',
			'label'			=> esc_html__( 'per_page', 'tokoo' ),
			'name'			=> $field['name'] . '[per_page]',
			'value'			=> isset( $field['value']['per_page'] ) ? $field['value']['per_page'] : 12,
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'columns', $field['fields'] )  ) {
		tokoo_wp_select( array(
			'id'			=> $field['id'] . '_columns',
			'label'			=> esc_html__( 'columns', 'tokoo' ),
			'name'			=> $field['name'] . '[columns]',
			'options'       => array(
                '1'          => esc_html__( '1', 'tokoo' ),
                '2'          => esc_html__( '2', 'tokoo' ),
                '3'          => esc_html__( '3', 'tokoo' ),
                '4'          => esc_html__( '4', 'tokoo' ),
                '5'          => esc_html__( '5', 'tokoo' ),
                '6'          => esc_html__( '6', 'tokoo' ),
                
            ),
			'value'			=> isset( $field['value']['columns'] ) ? $field['value']['columns'] : 4,
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'orderby', $field['fields'] )  ) {
		tokoo_wp_select( array(
			'id'			=> $field['id'] . '_orderby',
			'label'			=> esc_html__( 'orderby', 'tokoo' ),
			'name'			=> $field['name'] . '[orderby]',
			'options'   => array(
                'date'           => esc_html__( 'Date', 'tokoo' ),
                'id'           => esc_html__( 'Id', 'tokoo' ),
                'menu_order'     => esc_html__( 'Menu Order', 'tokoo' ),
                'popularity'		 => esc_html__( 'Popularity', 'tokoo' ),
                'rand'             => esc_html__( 'Rand', 'tokoo' ),
                'rating'    => esc_html__( 'Rating', 'tokoo' ),
                'title'         => esc_html__( 'Title', 'tokoo' ),
            ),
			'value'			=> isset( $field['value']['orderby'] ) ? $field['value']['orderby'] : 'name',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'order', $field['fields'] )  ) {
		tokoo_wp_select( array(
			'id'			=> $field['id'] . '_order',
			'label'			=> esc_html__( 'order', 'tokoo' ),
			'name'			=> $field['name'] . '[order]',
			'options'       => array(
                'ASC'           => esc_html__( 'ASC', 'tokoo' ),
                'DESC'          => esc_html__( 'DESC', 'tokoo' ),
                
            ),
			'value'			=> isset( $field['value']['order'] ) ? $field['value']['order'] : 'ASC',
		) );
	}

	echo '</div>';
}

/**
 * Output input fields to choose a WooCommerce Category Shortcode Atts
 */
function tokoo_wp_wc_cat_shortcode_atts( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'limit', 'number', 'orderby' , 'order' );

	if( isset( $field['fields'] ) && in_array( 'limit', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_limit',
			'label'			=> esc_html__( 'limit', 'tokoo' ),
			'name'			=> $field['name'] . '[limit]',
			'value'			=> isset( $field['value']['limit'] ) ? $field['value']['limit'] : 10,
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'number', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_number',
			'label'			=> esc_html__( 'number', 'tokoo' ),
			'name'			=> $field['name'] . '[number]',
			'value'			=> isset( $field['value']['number'] ) ? $field['value']['number'] : 12,
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'hide_empty', $field['fields'] )  ) {
		tokoo_wp_checkbox( array(
			'id'			=> $field['id'] . '_hide_empty',
			'label'			=> esc_html__( 'hide_empty', 'tokoo' ),
			'name'			=> $field['name'] . '[hide_empty]',
			'value'			=> isset( $field['value']['hide_empty'] ) ? $field['value']['hide_empty'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'orderby', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_orderby',
			'label'			=> esc_html__( 'orderby', 'tokoo' ),
			'name'			=> $field['name'] . '[orderby]',
			'value'			=> isset( $field['value']['orderby'] ) ? $field['value']['orderby'] : 'date',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'order', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_order',
			'label'			=> esc_html__( 'order', 'tokoo' ),
			'name'			=> $field['name'] . '[order]',
			'value'			=> isset( $field['value']['order'] ) ? $field['value']['order'] : 'desc',
		) );
	}
}

/**
 * Outputs Legend for Fieldsets
 */
function tokoo_wp_legend( $title ) {
	?>
	<h4 class="tk-legend"><?php echo wp_kses_post( $title ); ?></h4>
	<?php
}

/**
 * Outputs Legend for Fieldsets
 */
function tokoo_wp_legend_sub( $title ) {
	?>
	<h6 class="tk-legend-sub"><?php echo wp_kses_post( $title ); ?></h6>
	<?php
}

function tokoo_wp_upload_image( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      	= isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['value']         = isset( $field['value'] ) ? $field['value'] : get_post_meta( $thepostid, $field['id'], true );
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['placeholder']	= isset( $field['placeholder'] ) ? $field['placeholder'] : false;

	if ( absint( $field['value'] ) ) {
		$image = wp_get_attachment_thumb_url( $field['value'] );
	} elseif ( $field['placeholder'] ) {
		$image = wc_placeholder_img_src();
	} else {
		$image = '';
	}

	echo '<p id="' . esc_attr( $field['id'] ) . '_field" class="form-field media-option ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	?>
		<?php if ( isset ( $image ) ) : ?>
		<img src="<?php echo esc_attr( $image ); ?>" class="upload_image_preview" data-placeholder-src="<?php echo esc_attr( wc_placeholder_img_src() ); ?>" alt="<?php echo esc_attr__( 'Image', 'tokoo' ); ?>" />
		<?php endif; ?>
		<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>" class="upload_image_id" value="<?php echo esc_attr( $field['value'] ); ?>" />
		<a href="#" class="button tk_upload_image_button tips"><?php echo esc_html__( 'Upload/Add image', 'tokoo' ); ?></a>
		<a href="#" class="button tk_remove_image_button tips"><?php echo esc_html__( 'Remove this image', 'tokoo' ); ?></a>
	</p>
	<?php
}

function tokoo_wp_animation_dropdown( $field ) {
	
	tokoo_wp_select( array(
		'id'		=> $field['id'] . '_products_choice',
		'label'		=> '',
		'class'		=> 'animation_dropdown',
		'name'		=> isset( $field['name'] ) ? $field['name'] : $field['id'],
		'value'		=> isset( $field['value'] ) ? $field['value'] : '',
		'options'	=> array(
			'' => esc_html__( 'No Animation', 'tokoo' ),
			'bounce' => 'bounce',
			'flash' => 'flash',
			'pulse' => 'pulse',
			'rubberBand' => 'rubberBand',
			'shake' => 'shake',
			'swing' => 'swing',
			'tada' => 'tada',
			'wobble' => 'wobble',
			'jello' => 'jello',
			'bounceIn' => 'bounceIn',
			'bounceInDown' => 'bounceInDown',
			'bounceInLeft' => 'bounceInLeft',
			'bounceInRight' => 'bounceInRight',
			'bounceInUp' => 'bounceInUp',
			'bounceOut' => 'bounceOut',
			'bounceOutDown' => 'bounceOutDown',
			'bounceOutLeft' => 'bounceOutLeft',
			'bounceOutRight' => 'bounceOutRight',
			'bounceOutUp' => 'bounceOutUp',
			'fadeIn' => 'fadeIn',
			'fadeInDown' => 'fadeInDown',
			'fadeInDownBig' => 'fadeInDownBig',
			'fadeInLeft' => 'fadeInLeft',
			'fadeInLeftBig' => 'fadeInLeftBig',
			'fadeInRight' => 'fadeInRight',
			'fadeInRightBig' => 'fadeInRightBig',
			'fadeInUp' => 'fadeInUp',
			'fadeInUpBig' => 'fadeInUpBig',
			'fadeOut' => 'fadeOut',
			'fadeOutDown' => 'fadeOutDown',
			'fadeOutDownBig' => 'fadeOutDownBig',
			'fadeOutLeft' => 'fadeOutLeft',
			'fadeOutLeftBig' => 'fadeOutLeftBig',
			'fadeOutRight' => 'fadeOutRight',
			'fadeOutRightBig' => 'fadeOutRightBig',
			'fadeOutUp' => 'fadeOutUp',
			'fadeOutUpBig' => 'fadeOutUpBig',
			'flip' => 'flip',
			'flipInX' => 'flipInX',
			'flipInY' => 'flipInY',
			'flipOutX' => 'flipOutX',
			'flipOutY' => 'flipOutY',
			'lightSpeedIn' => 'lightSpeedIn',
			'lightSpeedOut' => 'lightSpeedOut',
			'rotateIn' => 'rotateIn',
			'rotateInDownLeft' => 'rotateInDownLeft',
			'rotateInDownRight' => 'rotateInDownRight',
			'rotateInUpLeft' => 'rotateInUpLeft',
			'rotateInUpRight' => 'rotateInUpRight',
			'rotateOut' => 'rotateOut',
			'rotateOutDownLeft' => 'rotateOutDownLeft',
			'rotateOutDownRight' => 'rotateOutDownRight',
			'rotateOutUpLeft' => 'rotateOutUpLeft',
			'rotateOutUpRight' => 'rotateOutUpRight',
			'slideInUp' => 'slideInUp',
			'slideInDown' => 'slideInDown',
			'slideInLeft' => 'slideInLeft',
			'slideInRight' => 'slideInRight',
			'slideOutUp' => 'slideOutUp',
			'slideOutDown' => 'slideOutDown',
			'slideOutLeft' => 'slideOutLeft',
			'slideOutRight' => 'slideOutRight',
			'zoomIn' => 'zoomIn',
			'zoomInDown' => 'zoomInDown',
			'zoomInLeft' => 'zoomInLeft',
			'zoomInRight' => 'zoomInRight',
			'zoomInUp' => 'zoomInUp',
			'zoomOut' => 'zoomOut',
			'zoomOutDown' => 'zoomOutDown',
			'zoomOutLeft' => 'zoomOutLeft',
			'zoomOutRight' => 'zoomOutRight',
			'zoomOutUp' => 'zoomOutUp',
			'hinge' => 'hinge',
			'rollIn' => 'rollIn',
			'rollOut' => 'rollOut',
		),
	) );
}

/**
 * Output input fields to choose a Slick Carousel Options
 */
function tokoo_wp_slick_carousel_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'slidesPerRow', 'slidesToShow', 'slidesToScroll', 'dots', 'arrows' );

	echo '<div class="tokoo-slick-carousel-options">';

	if( isset( $field['label'] ) ) {
		tokoo_wp_legend_sub( $field['label'] );
	}

	if( isset( $field['fields'] ) && in_array( 'slidesPerRow', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_slidesPerRow',
			'label'			=> esc_html__( 'slidesPerRow', 'tokoo' ),
			'name'			=> $field['name'] . '[slidesPerRow]',
			'value'			=> isset( $field['value']['slidesPerRow'] ) ? $field['value']['slidesPerRow'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'slidesToShow', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_slidesToShow',
			'label'			=> esc_html__( 'slidesToShow', 'tokoo' ),
			'name'			=> $field['name'] . '[slidesToShow]',
			'value'			=> isset( $field['value']['slidesToShow'] ) ? $field['value']['slidesToShow'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'slidesToScroll', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_slidesToScroll',
			'label'			=> esc_html__( 'slidesToScroll', 'tokoo' ),
			'name'			=> $field['name'] . '[slidesToScroll]',
			'value'			=> isset( $field['value']['slidesToScroll'] ) ? $field['value']['slidesToScroll'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'rows', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_rows',
			'label'			=> esc_html__( 'rows', 'tokoo' ),
			'name'			=> $field['name'] . '[rows]',
			'value'			=> isset( $field['value']['rows'] ) ? $field['value']['rows'] : '',
		) );
	}

	
	if( isset( $field['fields'] ) && in_array( 'dots', $field['fields'] )  ) {
		tokoo_wp_checkbox( array(
			'id'			=> $field['id'] . '_dots',
			'label'			=> esc_html__( 'dots', 'tokoo' ),
			'name'			=> $field['name'] . '[dots]',
			'value'			=> isset( $field['value']['dots'] ) ? $field['value']['dots'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'arrows', $field['fields'] )  ) {
		tokoo_wp_checkbox( array(
			'id'			=> $field['id'] . '_arrows',
			'label'			=> esc_html__( 'arrows', 'tokoo' ),
			'name'			=> $field['name'] . '[arrows]',
			'value'			=> isset( $field['value']['arrows'] ) ? $field['value']['arrows'] : '',
			
		) );
	}
	
	if( isset( $field['fields'] ) && in_array( 'prevArrow', $field['fields'] )  ) {
		tokoo_wp_textarea_input( array(
			'id'			=> $field['id'] . '_prevArrow',
			'label'			=> esc_html__( 'prevArrow', 'tokoo' ),
			'name'			=> $field['name'] . '[prevArrow]',
			'value'			=> isset( $field['value']['prevArrow'] ) ? $field['value']['prevArrow' ] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'nextArrow', $field['fields'] )  ) {
		tokoo_wp_textarea_input( array(
			'id'			=> $field['id'] . '_nextArrow',
			'label'			=> esc_html__( 'nextArrow', 'tokoo' ),
			'name'			=> $field['name'] . '[nextArrow]',
			'value'			=> isset( $field['value']['nextArrow'] ) ? $field['value']['nextArrow'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'autoplay', $field['fields'] )  ) {
		tokoo_wp_checkbox( array(
			'id'			=> $field['id'] . '_autoplay',
			'label'			=> esc_html__( 'autoplay', 'tokoo' ),
			'name'			=> $field['name'] . '[autoplay]',
			'value'			=> isset( $field['value']['autoplay'] ) ? $field['value']['autoplay'] : '',
			
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'infinite', $field['fields'] )  ) {
		tokoo_wp_checkbox( array(
			'id'			=> $field['id'] . '_infinite',
			'label'			=> esc_html__( 'infinite', 'tokoo' ),
			'name'			=> $field['name'] . '[infinite]',
			'value'			=> isset( $field['value']['infinite'] ) ? $field['value']['infinite'] : '',
			
		) );
	}


	echo '</div>';
}

/**
 * Output input fields to choose a Banner Options
 */
function tokoo_wp_banner_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array('title','action_text', 'action_link', 'image_choice', 'image', 'bg_color', 'bg_image' ,'is_fullwidth','button_type');

	echo '<div class="tokoo-banner-options">';

	if( isset( $field['fields'] ) && in_array( 'title', $field['fields'] )  ) {
		tokoo_wp_textarea_input( array(
			'id'			=> $field['id'] . '_title',
			'label'			=> esc_html__( 'Title', 'tokoo' ),
			'name'			=> $field['name'] . '[title]',
			'value'			=> isset( $field['value']['title'] ) ? $field['value']['title'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'action_text', $field['fields'] )  ) {
		tokoo_wp_textarea_input( array(
			'id'			=> $field['id'] . '_action_text',
			'label'			=> esc_html__( 'Action Text', 'tokoo' ),
			'name'			=> $field['name'] . '[action_text]',
			'value'			=> isset( $field['value']['action_text'] ) ? $field['value']['action_text'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'action_link', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_action_link',
			'label'			=> esc_html__( 'Action Link', 'tokoo' ),
			'name'			=> $field['name'] . '[action_link]',
			'value'			=> isset( $field['value']['action_link'] ) ? $field['value']['action_link'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'image_choice', $field['fields'] )  ) {
		tokoo_wp_select( array(
			'id'			=> $field['id'] . '_image_choice',
			'label'			=> esc_html__( 'Image Choice', 'tokoo' ),
			'name'			=> $field['name'] . '[image_choice]',
			'options'		=> array(
				'image'		=> esc_html__( 'Image', 'tokoo' ),
				'bg_image'	=> esc_html__( 'Background Image', 'tokoo' ),
			),
			'class'			=> 'show_hide_select',
			'value'			=> isset( $field['value']['image_choice'] ) ? $field['value']['image_choice'] : 'image',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'image', $field['fields'] )  ) {
		tokoo_wp_upload_image( array(
			'id'			=> $field['id'] . '_image',
			'label'			=> esc_html__( 'Image', 'tokoo' ),
			'name'			=> $field['name'] . '[image]',
			'value'			=> isset( $field['value']['image'] ) ? $field['value']['image'] : '',
			'wrapper_class'	=> 'show_if_image hide',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'bg_image', $field['fields'] )  ) {
		tokoo_wp_upload_image( array(
			'id'			=> $field['id'] . '_bg_image',
			'label'			=> esc_html__( 'Background Image', 'tokoo' ),
			'wrapper_class'	=> 'show_if_bg_image hide',
			'name'			=> $field['name'] . '[bg_image]',
			'value'			=> isset( $field['value']['bg_image'] ) ? $field['value']['bg_image'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'bg_color', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_bg_color',
			'label'			=> esc_html__( 'Background Color', 'tokoo' ),
			'name'			=> $field['name'] . '[bg_color]',
			'value'			=> isset( $field['value']['bg_color'] ) ? $field['value']['bg_color'] : '',
			'wrapper_class'	=> 'show_if_image hide',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'is_fullwidth', $field['fields'] )  ) {
		tokoo_wp_checkbox( array(
			'id'			=> $field['id'] . '_is_fullwidth',
			'label'			=> esc_html__( 'Full Width', 'tokoo' ),
			'name'			=> $field['name'] . '[is_fullwidth]',
			'value'			=> isset( $field['value']['is_fullwidth'] ) ? $field['value']['is_fullwidth'] : '',
		) );
	}

	if( isset( $field['fields'] ) && in_array( 'button_type', $field['fields'] )  ) {
		tokoo_wp_select( array(
			'id'			=> $field['id'] . '_button_type',
			'label'			=> esc_html__( 'Button Type', 'tokoo' ),
			'name'			=> $field['name'] . '[button_type]',
			'options'		=> array(
				'primary'	=> esc_html__( 'Primary', 'tokoo' ),
				'secondary'	=> esc_html__( 'Secondary', 'tokoo' ),
			),
			'value'			=> isset( $field['value']['button_type'] ) ? $field['value']['button_type'] : 'primary',
		) );
	}

	echo '</div>';
}

/**
 * Output input fields to choose a Woocommerce Action List Options
 */

function tokoo_wp_woocommerce_action_list_options( $field ) {
	global $thepostid, $post;

	$thepostid          = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['name']      = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['default']	= isset( $field['default'] ) ? $field['default'] : '';
	$field['value'] 	= isset( $field['value'] ) ? $field['value'] : '';
	$field['fields']	= isset( $field['fields'] ) ? $field['fields'] : array( 'step_value', 'pre_title', 'title', 'caption');

	echo '<div class="tokoo-slick-carousel-options">';

	if( isset( $field['label'] ) ) {
		tokoo_wp_legend_sub( $field['label'] );
	}

	if( isset( $field['fields'] ) && in_array( 'step_value', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_step_value',
			'label'			=> esc_html__( 'Step Value', 'tokoo' ),
			'name'			=> $field['name'] . '[step_value]',
			'value'			=> isset( $field['value']['step_value'] ) ? $field['value']['step_value'] : '',
		) );
	}
	if( isset( $field['fields'] ) && in_array( 'pre_title', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_pre_title',
			'label'			=> esc_html__( 'Pre Title', 'tokoo' ),
			'name'			=> $field['name'] . '[pre_title]',
			'value'			=> isset( $field['value']['pre_title'] ) ? $field['value']['pre_title'] : '',
		) );
	}
	if( isset( $field['fields'] ) && in_array( 'title', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_title',
			'label'			=> esc_html__( 'Title', 'tokoo' ),
			'name'			=> $field['name'] . '[title]',
			'value'			=> isset( $field['value']['title'] ) ? $field['value']['title'] : '',
		) );
	}
	if( isset( $field['fields'] ) && in_array( 'caption', $field['fields'] )  ) {
		tokoo_wp_text_input( array(
			'id'			=> $field['id'] . '_caption',
			'label'			=> esc_html__( 'Caption', 'tokoo' ),
			'name'			=> $field['name'] . '[caption]',
			'value'			=> isset( $field['value']['caption'] ) ? $field['value']['caption'] : '',
		) );
	}
	echo '</div>';
}

function tokoo_wp_nav_menus_dropdown( $field ) {

	$nav_menus = wp_get_nav_menus();

	$nav_menus_option = array(
		'' => esc_html__( 'Select a menu', 'tokoo' )
	);
	
	foreach ( $nav_menus as $key => $nav_menu ) {
		$nav_menus_option[$nav_menu->slug] = $nav_menu->name;
	}
	
	tokoo_wp_select( array(
		'id'		=> $field['name'] . '_products_choice',
		'label'		=> esc_html__( 'Menu', 'tokoo' ),
		'class'		=> 'animation_dropdown',
		'name'		=> isset( $field['name'] ) ? $field['name'] : $field['id'],
		'value'		=> isset( $field['value'] ) ? $field['value'] : '',
		'options'	=> $nav_menus_option
	) );
}