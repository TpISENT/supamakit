<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Elementor Vertical Menu Section Widget.
*
* Elementor widget that inserts an embbedable content into the page, from any given URL.
*
* @since 1.0.0
*/
class Tokoo_Elementor_Vertical_Menu_Section extends Widget_Base {

    /**
    * Get widget name.
    *
    * Retrieve Vertical Menu Section widget name.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget name.
    */
    public function get_name() {
        return 'tokoo_vertical_menu';
    }

    /**
    * Get widget title.
    *
    * Retrieve Vertical Menu Section widget title.
    *
    * @since 1.0.0
    * @access public
    *
    * @return string Widget title.
    */
    public function get_title() {
        return esc_html__( 'Vertical Menu', 'tokoo-extensions' );
    }

    /**
    * Get widget icon.
    *
    * Retrieve Vertical Menu Section widget icon.
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
    * Retrieve the list of categories the Vertical Menu Section widget belongs to.
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
    * Register Vertical Menu Section widget controls.
    *
    * Adds different input fields to allow the user to change and customize the widget settings.
    *
    * @since 1.0.0
    * @access protected
    */
    protected function _register_controls() {

        $nav_menus = wp_get_nav_menus();

        $nav_menus_option = array(
            esc_html__( 'Select a menu', 'tokoo-extensions' )       => '',
        );

        foreach ( $nav_menus as $key => $nav_menu ) {
            $nav_menus_option[$nav_menu->name] = $nav_menu->name;
        }

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'tokoo-extensions' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu_title',
            [
                'label' => esc_html__( 'Vertical Menu Title', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your Vertical Menu Title here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'menu_action_text',
            [
                'label' => esc_html__( 'Vertical Menu Action Text', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your Vertical Menu Action Text here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'menu_action_link',
            [
                'label' => esc_html__( 'Vertical Menu Action link', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your Vertical Menu Action link here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'menu',
            [
                'label'     => esc_html__( 'Select Menu', 'tokoo-extensions' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'vertical-menu',
                'options'   => $nav_menus_option,
            ]
        );

        $this->end_controls_section();
    }

    /**
    * Render Vertical Menu Section widget output on the frontend.
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
            'menu_title'        => isset( $menu_title ) ? $menu_title : '',
            'menu_action_text'  => isset( $menu_action_text ) ? $menu_action_text : '',
            'menu_action_link'  => isset( $menu_action_link ) ? $menu_action_link : '',
            'menu'              => isset( $menu ) ? $menu : ''
        );

        if( function_exists( 'tokoo_vertical_nav' ) ) {
            tokoo_vertical_nav( $args );
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_Vertical_Menu_Section );