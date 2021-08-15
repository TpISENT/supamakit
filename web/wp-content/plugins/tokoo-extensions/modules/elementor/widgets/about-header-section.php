<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor About Header Section Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tokoo_Elementor_About_Header_Section extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve About Header Section widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tokoo_about_header_section';
    }

    /**
     * Get widget title.
     *
     * Retrieve About Header Section widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'About Header Section', 'tokoo-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve About Header Section widget icon.
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
     * Retrieve the list of categories the About Header Section widget belongs to.
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
     * Register About Header Section widget controls.
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
            'title',
            [
                'label' => esc_html__( 'Title', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your title here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'pre_title',
            [
                'label' => esc_html__( 'Pre Title', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your pre title here', 'tokoo-extensions' ),
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
     * Render About Header Section widget output on the frontend.
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
            'title'       		=> isset( $title ) ? $title : '',
            'pre_title'    		=> isset( $pre_title ) ? $pre_title : '',
            'section_class'     => isset( $el_class ) ? $el_class : ''
        );

        if( function_exists( 'tokoo_about_header_section' ) ) {
            tokoo_about_header_section( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_About_Header_Section );