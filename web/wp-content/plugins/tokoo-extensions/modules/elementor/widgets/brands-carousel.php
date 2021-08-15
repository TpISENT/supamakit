<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Brands Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tokoo_Elementor_Brands_Carousel extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Brands Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tokoo_brands_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve Brands Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Brands Carousel', 'tokoo-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Brands Carousel widget icon.
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
     * Retrieve the list of categories the Brands Carousel widget belongs to.
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
     * Register Brands Carousel widget controls.
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
            'limit',
            [
                'label' => esc_html__( 'Limit', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter the number of brands to display', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order By', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter order by', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter order', 'tokoo-extensions' ),
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

        $this->add_control(
            'ca_slidestoshow',
            [
                'label'         => esc_html__('slidesToShow', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of brands to display.', 'tokoo-extensions'),
            ]
        );

        $this->add_control(
            'ca_slidestoscroll',
            [
                'label'         => esc_html__('slidesToScroll', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of brands to scroll.', 'tokoo-extensions'),
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'tokoo-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'tokoo-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'tokoo-extensions' ),
                'return_value'  => true,
                'default'       => false,
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Brands Carousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $section_args = array(
            'section_title'     => isset( $section_title ) ? $section_title : '',
        );

        $taxonomy_args = array(
            'orderby'       => isset( $orderby ) ? $orderby : '',
            'order'         => isset( $order ) ? $order : '',
            'number'        => isset( $limit ) ? $limit : '',
            'hide_empty'    => isset( $hide_empty ) ? filter_var( $hide_empty, FILTER_VALIDATE_BOOLEAN ) : '',
        );

        $carousel_args  = array(
            'slidesToShow'      => isset( $ca_slidestoshow ) ? filter_var($ca_slidestoshow, FILTER_VALIDATE_INT) : '4',
            'slidesToScroll'    => isset( $ca_slidestoscroll ) ? filter_var( $ca_slidestoscroll , FILTER_VALIDATE_INT) : '4',
            'arrows'            => isset( $ca_arrows ) ? filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ) : false,
            'autoplay'          => isset( $autoplay ) ? filter_var( $autoplay, FILTER_VALIDATE_BOOLEAN ) : false,
            'responsive'    => array(
                array(
                    'breakpoint'    => 767,
                    'settings'      => array(
                        'slidesToShow'      => 1,
                        'slidesToScroll'    => 1
                    )
                ),
                array(
                    'breakpoint'    => 992,
                    'settings'      => array(
                        'slidesToShow'      => 3,
                        'slidesToScroll'    => 3
                    )
                ),
                array(
                    'breakpoint'    => 1200,
                    'settings'      => array(
                        'slidesToShow'      => 4,
                        'slidesToScroll'    => 4
                    )
                )
            )

        );

        if( function_exists( 'tokoo_brands_carousel' ) ) {
            tokoo_brands_carousel( $section_args, $taxonomy_args, $carousel_args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_Brands_Carousel );