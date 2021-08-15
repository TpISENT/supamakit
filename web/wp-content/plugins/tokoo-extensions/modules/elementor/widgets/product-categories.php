<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Product Categories Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tokoo_Elementor_Product_Categories extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Product Categories widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tokoo_product_categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve Product Categories widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Categories', 'tokoo-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Categories widget icon.
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
     * Retrieve the list of categories the Product Categories widget belongs to.
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
     * Register Product Categories widget controls.
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
            'slugs',
            [
                'label' => esc_html__( 'Category Slug', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,) Note: Only works with Products Shortcode', 'tokoo-extensions' ),
            ]
        );


        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter the number of products to display', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter the number of categories to display', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'hide_empty',
            [
                'label'         => esc_html__( 'Hide Emtpy', 'tokoo-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Hide', 'tokoo-extensions' ),
                'label_off'     => esc_html__( 'Show', 'tokoo-extensions' ),
                'return_value'  => true,
                'default'       => false,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Product Categories widget output on the frontend.
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
            'category_args'     => array(
	            'columns'       => isset( $columns ) ? $columns : '',
	            'number'        => isset( $limit ) ? $limit : '',
	            'slug'          => isset( $slugs ) ? $slugs : '',
	            'hide_empty'    => isset( $hide_empty ) ? filter_var( $hide_empty, FILTER_VALIDATE_BOOLEAN ) : '',
	        ),
        );

        
        if( function_exists( 'tokoo_product_categories' ) ) {
            tokoo_product_categories( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_Product_Categories );