<?php
/**
 * Contact Metabox
 *
 * Displays the contact meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Tokoo_Meta_Box_Contact Class.
 */
class Tokoo_Meta_Box_Contact {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		global $post, $thepostid;

		wp_nonce_field( 'tokoo_save_data', 'tokoo_meta_nonce' );

		$thepostid 		= $post->ID;
		$template_file 	= get_post_meta( $thepostid, '_wp_page_template', true );

		if ( $template_file !== 'template-contactpage.php' ) {
			return;
		}

		self::output_contact( $post );
	}

	private static function output_contact( $post ) {

		$contact = tokoo_get_contact_meta();

		?>
		<div class="panel-wrap meta-box-home">
			<ul class="home_data_tabs tk-tabs">
			<?php
				$product_data_tabs = apply_filters( 'tokoo_contact_data_tabs', array(
					'general' => array(
						'label'  => esc_html__( 'General', 'tokoo' ),
						'target' => 'general_block',
						'class'  => array(),
					),
					'contact_map' => array(
						'label'  => esc_html__( 'Contact Map', 'tokoo' ),
						'target' => 'contact_map',
						'class'  => array(),
					),
					'contact_form' => array(
						'label'  => esc_html__( 'Contact Form', 'tokoo' ),
						'target' => 'contact_form',
						'class'  => array(),
					),
				) );
				foreach ( $product_data_tabs as $key => $tab ) {
					?><li class="<?php echo esc_attr( $key ); ?>_options <?php echo esc_attr( $key ); ?>_tab <?php echo implode( ' ' , $tab['class'] ); ?>">
						<a href="#<?php echo esc_attr( $tab['target'] ); ?>"><?php echo esc_html( $tab['label'] ); ?></a>
					</li><?php
				}
			?>
			</ul>

			<?php do_action( 'tokoo_home_write_panel_tabs_before' ); ?>

			<div id="general_block" class="panel tokoo_options_panel">
				
				<div class="options_group">
					<?php 
						$contact_blocks = array(
							'hpc'   => esc_html__( 'Page content', 'tokoo' ),
							'cma'   => esc_html__( 'Contact Map', 'tokoo' ),
							'cfm'   => esc_html__( 'Contact Details', 'tokoo' ),
						);
					?>
					<table class="general-blocks-table widefat striped">
						<thead>
							<tr>
								<th><?php echo esc_html__( 'Block', 'tokoo' ); ?></th>
								<th><?php echo esc_html__( 'Animation', 'tokoo' ); ?></th>
								<th><?php echo esc_html__( 'Priority', 'tokoo' ); ?></th>
								<th><?php echo esc_html__( 'Enabled ?', 'tokoo' ); ?></th>
							</tr>	
						</thead>
						<tbody>
							<?php foreach( $contact_blocks as $key => $contact_block ) : ?>
							<tr>
								<td><?php echo esc_html( $contact_block ); ?></td>
								<td><?php tokoo_wp_animation_dropdown( array(  'id' => '_contact_' . $key . '_animation', 'label'=> '', 'name' => '_contact[' . $key . '][animation]', 'value' => isset( $contact['' . $key . '']['animation'] ) ? $contact['' . $key . '']['animation'] : '', )); ?></td>
								<td><?php tokoo_wp_text_input( array(  'id' => '_contact_' . $key . '_priority', 'label'=> '', 'name' => '_contact[' . $key . '][priority]', 'value' => isset( $contact['' . $key . '']['priority'] ) ? $contact['' . $key . '']['priority'] : 10, ) ); ?></td>
								<td><?php tokoo_wp_checkbox( array( 'id' => '_contact_' . $key . '_is_enabled', 'label' => '', 'name' => '_contact[' . $key . '][is_enabled]', 'value'=> isset( $contact['' . $key . '']['is_enabled'] ) ? $contact['' . $key . '']['is_enabled'] : '', ) ); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?php do_action( 'tokoo_contact_after_general_block' ) ?>

			</div><!-- /#general_block -->

			<div id="contact_map" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'Contact Map', 'tokoo' ) ); ?>

				<div class="options_group">
				<?php 

					tokoo_wp_textarea_input( array( 
						'id'		=> '_contact_cma_map', 
						'label'		=> esc_html__( 'Google Map', 'tokoo' ),
						'name'		=> '_contact[cma][map]',
						'value'		=> isset( $contact['cma']['map'] ) ? $contact['cma']['map'] : '',
					) );
				?>
				</div>

				<?php do_action( 'tokoo_contact_after_contact_map' ) ?>

			</div> <!-- /#contact_map -->

			<div id="contact_form" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'Contact Form', 'tokoo' ) ); ?>

				<div class="options_group">
				<?php 

					tokoo_wp_text_input( array( 
						'id'		=> '_contact_cfm_pre_title', 
						'label'		=> esc_html__( 'Pre Title', 'tokoo' ),
						'name'		=> '_contact[cfm][pre_title]',
						'value'		=> isset( $contact['cfm']['pre_title'] ) ? $contact['cfm']['pre_title'] : '',
					) );
					tokoo_wp_text_input( array( 
						'id'		=> '_contact_cfm_title', 
						'label'		=> esc_html__( 'Title', 'tokoo' ),
						'name'		=> '_contact[cfm][title]',
						'value'		=> isset( $contact['cfm']['title'] ) ? $contact['cfm']['title'] : '',
					) );
					tokoo_wp_text_input( array( 
                        'id'            => '_contact_cfm_shortcode', 
                        'label'         => esc_html__( 'Form Shortcode', 'tokoo' ), 
                        'placeholder'   => esc_html__( 'Enter the shorcode for your form here', 'tokoo' ),
                        'name'          => '_contact[cfm][shortcode]',
                        'value'         => isset( $contact['cfm']['shortcode'] ) ? $contact['cfm']['shortcode'] : '',
                    ) );
				?>
				</div>

				<?php do_action( 'tokoo_contact_after_contact_form' ) ?>

			</div> <!-- /#contact_form -->

		</div>
		<?php
	}

	public static function save( $post_id, $post ) {
		if ( isset( $_POST['_contact'] ) ) {
			$clean_contact_options = tokoo_clean_kses_post_allow_iframe( $_POST['_contact'] );
			update_post_meta( $post_id, '_contact_options',  serialize( $clean_contact_options ) );
		}	
	}
}
