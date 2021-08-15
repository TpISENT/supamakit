<?php
/**
 * About Metabox
 *
 * Displays the about meta box, tabbed, with several panels covering price, stock etc.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Tokoo_Meta_Box_About Class.
 */
class Tokoo_Meta_Box_About {

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

		if ( $template_file !== 'template-aboutpage.php' ) {
			return;
		}

		self::output_about( $post );
	}

	private static function output_about( $post ) {

		$about = tokoo_get_about_meta();

		?>
		<div class="panel-wrap meta-box-home">
			<ul class="home_data_tabs tk-tabs">
			<?php
				$product_data_tabs = apply_filters( 'tokoo_about_data_tabs', array(
					'general' => array(
						'label'  => esc_html__( 'General', 'tokoo' ),
						'target' => 'general_block',
						'class'  => array(),
					),
					'about_header' => array(
                        'label'  => esc_html__( 'About Header', 'tokoo' ),
                        'target' => 'about_header',
                        'class'  => array(),
                    ),
                    'about_content_1' => array(
                        'label'  => esc_html__( 'About Content 1', 'tokoo' ),
                        'target' => 'about_content_1',
                        'class'  => array(),
                    ),
                    'features_list' => array(
                        'label'  => esc_html__( 'Features List', 'tokoo' ),
                        'target' => 'features_list',
                        'class'  => array(),
                    ),
                    'about_content_2' => array(
                        'label'  => esc_html__( 'About Content 2', 'tokoo' ),
                        'target' => 'about_content_2',
                        'class'  => array(),
                    ),
                    'testimonials' => array(
                        'label'  => esc_html__( 'Testimonials', 'tokoo' ),
                        'target' => 'testimonials',
                        'class'  => array(),
                    ),
                    'about_job' => array(
                        'label'  => esc_html__( 'About Job', 'tokoo' ),
                        'target' => 'about_job',
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
						$about_blocks = array(
							'hpc'	=> esc_html__( 'Page content', 'tokoo' ),
							'ah'	=> esc_html__( 'About Header', 'tokoo' ),
							'ac1'	=> esc_html__( 'About Content 1', 'tokoo' ),
							'fl'	=> esc_html__( 'Features List', 'tokoo' ),
							'ac2'	=> esc_html__( 'About Content 2', 'tokoo' ),
							'ts'	=> esc_html__( 'Testimonials', 'tokoo' ),
							'aj'	=> esc_html__( 'About Job', 'tokoo' ),
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
							<?php foreach( $about_blocks as $key => $about_block ) : ?>
							<tr>
								<td><?php echo esc_html( $about_block ); ?></td>
								<td><?php tokoo_wp_animation_dropdown( array(  'id' => '_about_' . $key . '_animation', 'label'=> '', 'name' => '_about[' . $key . '][animation]', 'value' => isset( $about['' . $key . '']['animation'] ) ? $about['' . $key . '']['animation'] : '', )); ?></td>
								<td><?php tokoo_wp_text_input( array(  'id' => '_about_' . $key . '_priority', 'label'=> '', 'name' => '_about[' . $key . '][priority]', 'value' => isset( $about['' . $key . '']['priority'] ) ? $about['' . $key . '']['priority'] : 10, ) ); ?></td>
								<td><?php tokoo_wp_checkbox( array( 'id' => '_about_' . $key . '_is_enabled', 'label' => '', 'name' => '_about[' . $key . '][is_enabled]', 'value'=> isset( $about['' . $key . '']['is_enabled'] ) ? $about['' . $key . '']['is_enabled'] : '', ) ); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<?php do_action( 'tokoo_about_after_general_block' ) ?>

			</div><!-- /#general_block -->

			<div id="about_header" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'About Header', 'tokoo' ) ); ?>

				<div class="options_group">
				<?php 

					tokoo_wp_text_input( array( 
						'id'		=> '_about_ah_pre_title',
						'label'		=> esc_html__( 'Pre Title', 'tokoo' ),
						'name'		=> '_about[ah][pre_title]',
						'value'		=> isset( $about['ah']['pre_title'] ) ? $about['ah']['pre_title'] : '',
					) );
					tokoo_wp_text_input( array( 
						'id'		=> '_about_ah_title', 
						'label'		=> esc_html__( 'Title', 'tokoo' ),
						'name'		=> '_about[ah][title]',
						'value'		=> isset( $about['ah']['title'] ) ? $about['ah']['title'] : '',
					) );
				?>
				</div>

				<?php do_action( 'tokoo_about_after_about_header' ) ?>

			</div> <!-- /#about_header -->

			<div id="about_content_1" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'About Content 1', 'tokoo' ) ); ?>

				<div class="options_group">
				<?php 

					tokoo_wp_textarea_input( array( 
						'id'		=> '_about_ac1_about_content',
						'label'		=> esc_html__( 'About Content', 'tokoo' ),
						'name'		=> '_about[ac1][about_content]',
						'value'		=> isset( $about['ac1']['about_content'] ) ? $about['ac1']['about_content'] : '',
					) );
				?>
				</div>

				<?php do_action( 'tokoo_about_after_about_content_1' ) ?>

			</div> <!-- /#about_content_1 -->

			<div id="features_list" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'Features List', 'tokoo' ) ); ?>

				<?php tokoo_wp_legend( esc_html__( 'Feature 1', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_1_icon',
							'label' 		=> esc_html__( 'Icon', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the icon for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][0][icon]',
							'value'			=> isset( $about['fl']['features'][0]['icon'] ) ? $about['fl']['features'][0]['icon'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_1_feature_title',
							'label' 		=> esc_html__( 'Feature Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][0][label]',
							'value'			=> isset( $about['fl']['features'][0]['label'] ) ? $about['fl']['features'][0]['label'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'Feature 2', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_2_icon',
							'label' 		=> esc_html__( 'Icon', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the icon for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][1][icon]',
							'value'			=> isset( $about['fl']['features'][1]['icon'] ) ? $about['fl']['features'][1]['icon'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_2_feature_title',
							'label' 		=> esc_html__( 'Feature Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][1][label]',
							'value'			=> isset( $about['fl']['features'][1]['label'] ) ? $about['fl']['features'][1]['label'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'Feature 3', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_3_icon',
							'label' 		=> esc_html__( 'Icon', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the icon for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][2][icon]',
							'value'			=> isset( $about['fl']['features'][2]['icon'] ) ? $about['fl']['features'][2]['icon'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_3_feature_title',
							'label' 		=> esc_html__( 'Feature Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][2][label]',
							'value'			=> isset( $about['fl']['features'][2]['label'] ) ? $about['fl']['features'][2]['label'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'Feature 4', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_4_icon',
							'label' 		=> esc_html__( 'Icon', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the icon for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][3][icon]',
							'value'			=> isset( $about['fl']['features'][3]['icon'] ) ? $about['fl']['features'][3]['icon'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_4_feature_title',
							'label' 		=> esc_html__( 'Feature Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][3][label]',
							'value'			=> isset( $about['fl']['features'][3]['label'] ) ? $about['fl']['features'][3]['label'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'Feature 5', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_5_icon',
							'label' 		=> esc_html__( 'Icon', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the icon for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][4][icon]',
							'value'			=> isset( $about['fl']['features'][4]['icon'] ) ? $about['fl']['features'][4]['icon'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_5_feature_title',
							'label' 		=> esc_html__( 'Feature Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][4][label]',
							'value'			=> isset( $about['fl']['features'][4]['label'] ) ? $about['fl']['features'][4]['label'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'Feature 6', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_6_icon',
							'label' 		=> esc_html__( 'Icon', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the icon for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][5][icon]',
							'value'			=> isset( $about['fl']['features'][5]['icon'] ) ? $about['fl']['features'][5]['icon'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_fl_6_feature_title',
							'label' 		=> esc_html__( 'Feature Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your features here', 'tokoo' ),
							'name'			=> '_about[fl][features][5][label]',
							'value'			=> isset( $about['fl']['features'][5]['label'] ) ? $about['fl']['features'][5]['label'] : '',
						) );
					?>
				</div>

				<?php do_action( 'tokoo_about_after_features_list' ) ?>

			</div> <!-- /#features_list -->

			<div id="about_content_2" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'About Content 2', 'tokoo' ) ); ?>

				<div class="options_group">
				<?php 

					tokoo_wp_textarea_input( array( 
						'id'		=> '_about_ac2_about_content',
						'label'		=> esc_html__( 'About Content', 'tokoo' ),
						'name'		=> '_about[ac2][about_content]',
						'value'		=> isset( $about['ac2']['about_content'] ) ? $about['ac2']['about_content'] : '',
					) );
				?>
				</div>

				<?php do_action( 'tokoo_about_after_about_content_2' ) ?>

			</div> <!-- /#about_content_2 -->

			<div id="testimonials" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'About Testimonials', 'tokoo' ) ); ?>

				<div class="options_group">
				<?php 
					tokoo_wp_text_input( array( 
						'id' 			=> '_about_ts_section_title', 
						'label' 		=> esc_html__( 'Section Title', 'tokoo' ), 
						'placeholder' 	=> esc_html__( 'Enter the Section title', 'tokoo' ),
						'name'			=> '_about[ts][section_title]',
						'value'			=> isset( $about['ts']['section_title'] ) ? $about['ts']['section_title'] : '',
					) );

					tokoo_wp_select( array( 
                        'id'            => '_about_ts_orderby', 
                        'label'         =>  esc_html__( 'Order By', 'tokoo' ),
                        'name'          => '_about[ts][orderby]',
                        'options'       => array(
                            'name'           => esc_html__( 'Name', 'tokoo' ),
                            'slug'           => esc_html__( 'Slug', 'tokoo' ),
                            'id'             => esc_html__( 'Id', 'tokoo' ),
                        ),
                        'value'              => isset( $about['ts']['orderby'] ) ? $about['ts']['orderby'] : 'name',
                    ) );
                    
                    tokoo_wp_select( array( 
                        'id'            => '_about_ts_order', 
                        'label'         =>  esc_html__( 'Order', 'tokoo' ),
                        'name'          => '_about[ts][order]',
                        'options'       => array(
                            'ASC'           => esc_html__( 'ASC', 'tokoo' ),
                            'DESC'          => esc_html__( 'DESC', 'tokoo' ),
                        ),
                        'value'         => isset( $about['ts']['order'] ) ? $about['ts']['order'] : 'ASC',
                    ) );
				?>
				</div>

				<?php do_action( 'tokoo_about_after_testimonials' ) ?>

			</div> <!-- /#testimonials -->

			<div id="about_job" class="panel tokoo_options_panel">

				<?php tokoo_wp_legend( esc_html__( 'About Job', 'tokoo' ) ); ?>

				<div class="options_group">
				<?php 
					tokoo_wp_text_input( array( 
						'id' 			=> '_about_aj_section_title', 
						'label' 		=> esc_html__( 'Section Title', 'tokoo' ), 
						'placeholder' 	=> esc_html__( 'Enter the Section title', 'tokoo' ),
						'name'			=> '_about[aj][section_title]',
						'value'			=> isset( $about['aj']['section_title'] ) ? $about['aj']['section_title'] : '',
					) );
				?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'About Job List 1', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_1_pre_title',
							'label' 		=> esc_html__( 'Job Pre Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the job pre title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][0][pre_title]',
							'value'			=> isset( $about['aj']['jobs'][0]['pre_title'] ) ? $about['aj']['jobs'][0]['pre_title'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_1_job_title_link',
							'label' 		=> esc_html__( 'Job Title Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][0][job_title_link]',
							'value'			=> isset( $about['aj']['jobs'][0]['job_title_link'] ) ? $about['aj']['jobs'][0]['job_title_link'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_1_title',
							'label' 		=> esc_html__( 'Job Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][0][job_title]',
							'value'			=> isset( $about['aj']['jobs'][0]['job_title'] ) ? $about['aj']['jobs'][0]['job_title'] : '',
						) );

						tokoo_wp_textarea_input( array( 
							'id' 			=> '_about_aj_1_description',
							'label' 		=> esc_html__( 'Job Description', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the description for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][0][description]',
							'value'			=> isset( $about['aj']['jobs'][0]['description'] ) ? $about['aj']['jobs'][0]['description'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_1_action_text',
							'label' 		=> esc_html__( 'Job Action Text', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action text for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][0][action_text]',
							'value'			=> isset( $about['aj']['jobs'][0]['action_text'] ) ? $about['aj']['jobs'][0]['action_text'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_1_action_link',
							'label' 		=> esc_html__( 'Job Action Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][0][action_link]',
							'value'			=> isset( $about['aj']['jobs'][0]['action_link'] ) ? $about['aj']['jobs'][0]['action_link'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'About Job List 2', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_2_pre_title',
							'label' 		=> esc_html__( 'Job Pre Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the job pre title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][1][pre_title]',
							'value'			=> isset( $about['aj']['jobs'][1]['pre_title'] ) ? $about['aj']['jobs'][1]['pre_title'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_2_job_title_link',
							'label' 		=> esc_html__( 'Job Title Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][1][job_title_link]',
							'value'			=> isset( $about['aj']['jobs'][1]['job_title_link'] ) ? $about['aj']['jobs'][1]['job_title_link'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_2_title',
							'label' 		=> esc_html__( 'Job Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][1][job_title]',
							'value'			=> isset( $about['aj']['jobs'][1]['job_title'] ) ? $about['aj']['jobs'][1]['job_title'] : '',
						) );

						tokoo_wp_textarea_input( array( 
							'id' 			=> '_about_aj_2_description',
							'label' 		=> esc_html__( 'Job Description', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the description for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][1][description]',
							'value'			=> isset( $about['aj']['jobs'][1]['description'] ) ? $about['aj']['jobs'][1]['description'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_2_action_text',
							'label' 		=> esc_html__( 'Job Action Text', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action text for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][1][action_text]',
							'value'			=> isset( $about['aj']['jobs'][1]['action_text'] ) ? $about['aj']['jobs'][1]['action_text'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_2_action_link',
							'label' 		=> esc_html__( 'Job Action Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][1][action_link]',
							'value'			=> isset( $about['aj']['jobs'][1]['action_link'] ) ? $about['aj']['jobs'][1]['action_link'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'About Job List 3', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_3_pre_title',
							'label' 		=> esc_html__( 'Job Pre Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the job pre title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][2][pre_title]',
							'value'			=> isset( $about['aj']['jobs'][2]['pre_title'] ) ? $about['aj']['jobs'][2]['pre_title'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_3_job_title_link',
							'label' 		=> esc_html__( 'Job Title Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][2][job_title_link]',
							'value'			=> isset( $about['aj']['jobs'][2]['job_title_link'] ) ? $about['aj']['jobs'][2]['job_title_link'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_3_title',
							'label' 		=> esc_html__( 'Job Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][2][job_title]',
							'value'			=> isset( $about['aj']['jobs'][2]['job_title'] ) ? $about['aj']['jobs'][2]['job_title'] : '',
						) );

						tokoo_wp_textarea_input( array( 
							'id' 			=> '_about_aj_3_description',
							'label' 		=> esc_html__( 'Job Description', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the description for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][2][description]',
							'value'			=> isset( $about['aj']['jobs'][2]['description'] ) ? $about['aj']['jobs'][2]['description'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_3_action_text',
							'label' 		=> esc_html__( 'Job Action Text', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action text for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][2][action_text]',
							'value'			=> isset( $about['aj']['jobs'][2]['action_text'] ) ? $about['aj']['jobs'][2]['action_text'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_3_action_link',
							'label' 		=> esc_html__( 'Job Action Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][2][action_link]',
							'value'			=> isset( $about['aj']['jobs'][2]['action_link'] ) ? $about['aj']['jobs'][2]['action_link'] : '',
						) );
					?>
				</div>

				<?php tokoo_wp_legend( esc_html__( 'About Job List 4', 'tokoo' ) ); ?>
				
				<div class="options_group">
					<?php
						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_4_pre_title',
							'label' 		=> esc_html__( 'Job Pre Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the job pre title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][3][pre_title]',
							'value'			=> isset( $about['aj']['jobs'][3]['pre_title'] ) ? $about['aj']['jobs'][3]['pre_title'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_4_job_title_link',
							'label' 		=> esc_html__( 'Job Title Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][3][job_title_link]',
							'value'			=> isset( $about['aj']['jobs'][3]['job_title_link'] ) ? $about['aj']['jobs'][3]['job_title_link'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_4_title',
							'label' 		=> esc_html__( 'Job Title', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the title for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][3][job_title]',
							'value'			=> isset( $about['aj']['jobs'][3]['job_title'] ) ? $about['aj']['jobs'][3]['job_title'] : '',
						) );

						tokoo_wp_textarea_input( array( 
							'id' 			=> '_about_aj_4_description',
							'label' 		=> esc_html__( 'Job Description', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the description for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][3][description]',
							'value'			=> isset( $about['aj']['jobs'][3]['description'] ) ? $about['aj']['jobs'][3]['description'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_4_action_text',
							'label' 		=> esc_html__( 'Job Action Text', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action text for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][3][action_text]',
							'value'			=> isset( $about['aj']['jobs'][3]['action_text'] ) ? $about['aj']['jobs'][3]['action_text'] : '',
						) );

						tokoo_wp_text_input( array( 
							'id' 			=> '_about_aj_4_action_link',
							'label' 		=> esc_html__( 'Job Action Link', 'tokoo' ), 
							'placeholder' 	=> esc_html__( 'Enter the action link for your job here', 'tokoo' ),
							'name'			=> '_about[aj][jobs][3][action_link]',
							'value'			=> isset( $about['aj']['jobs'][3]['action_link'] ) ? $about['aj']['jobs'][3]['action_link'] : '',
						) );
					?>
				</div>

				<?php do_action( 'tokoo_about_after_about_job' ) ?>

			</div> <!-- /#about_job -->

		</div>
		<?php
	}

	public static function save( $post_id, $post ) {
		if ( isset( $_POST['_about'] ) ) {
			$clean_about_options = tokoo_clean_kses_post( $_POST['_about'] );
			update_post_meta( $post_id, '_about_options',  serialize( $clean_about_options ) );
		}	
	}
}
