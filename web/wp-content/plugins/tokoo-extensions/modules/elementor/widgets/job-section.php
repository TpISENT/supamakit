<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Job Section Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tokoo_Elementor_Job_Section extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Job Section widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tokoo_job_section';
    }

    /**
     * Get widget title.
     *
     * Retrieve Job Section widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Job Section', 'tokoo-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Job Section widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-shopping-bag';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Job Section widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'tokoo-elements' ];
    }

    /**
     * Register Job Section widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'tokoo-extensions' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your title here', 'tokoo-extensions' ),
            ]
        );

         $this->add_control(
            'jobs',
            [
                'label' => esc_html__( 'Jobs Section', 'tokoo-extensions' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'pre_title',
                        'label' => esc_html__( 'Pre Title', 'tokoo-extensions' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'rows' => 2,
                		'default' => '',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'job_title',
                        'label' => esc_html__( 'Job Title', 'tokoo-extensions' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'rows' => 2,
                		'default' => '',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'job_title_link',
                        'label' => esc_html__( 'Job Title Link', 'tokoo-extensions' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'description',
                        'label' => esc_html__( 'Job Description', 'tokoo-extensions' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'rows' => 2,
                		'default' => '',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'action_text',
                        'label' => esc_html__( 'Action Text', 'tokoo-extensions' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'rows' => 2,
                		'default' => '',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'action_link',
                        'label' => esc_html__( 'Action Link', 'tokoo-extensions' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                ],
                'default' => [],
                'title_field' => '{{{ job_title }}}',
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'tokoo-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'tokoo-extensions' ),
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Job Section widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $args = array(
            'section_title'     => isset( $section_title ) ? $section_title : '',
            'section_class'     => isset( $el_class ) ? $el_class : '',
            'jobs'              => isset( $jobs ) ? $jobs : '',
        );

        if( function_exists( 'tokoo_job_section' ) ) {
            tokoo_job_section( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_Job_Section );