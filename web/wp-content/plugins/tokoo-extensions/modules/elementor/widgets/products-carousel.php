<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Products Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tokoo_Elementor_Products_Carousel extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Products Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tokoo_products_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve Products Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Carousel', 'tokoo-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Products Carousel widget icon.
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
     * Retrieve the list of categories the Products Carousel widget belongs to.
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
     * Register Products Carousel widget controls.
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
            'show_header',
            [
                'label'         => esc_html__( 'Show Header', 'tokoo-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'tokoo-extensions' ),
                'label_off'     => esc_html__( 'Hide', 'tokoo-extensions' ),
                'return_value'  => true,
                'default'       => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__( 'Title', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your title here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'header_aside_action_text',
            [
                'label' => esc_html__( 'Header Aside Action Text', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your header aside action text here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'header_aside_action_link',
            [
                'label' => esc_html__( 'Header Aside Action Link', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXT,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your header aside action link here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'shortcode_tag',
            [
                'label' => esc_html__( 'Shortcode Tags', 'tokoo-extensions' ),
                'type'  => Controls_Manager::SELECT,
                'default' => 'recent_products',
                'options' => [
                    'featured_products'     => esc_html__( 'Featured Products','tokoo-extensions'),
                    'sale_products'         => esc_html__( 'On Sale Products','tokoo-extensions'),
                    'top_rated_products'    => esc_html__( 'Top Rated Products','tokoo-extensions'),
                    'recent_products'       => esc_html__( 'Recent Products','tokoo-extensions'),
                    'best_selling_products' => esc_html__( 'Best Selling Products','tokoo-extensions'),
                    'product_category'      => esc_html__( 'Product Category','tokoo-extensions'),
                    'products'              => esc_html__( 'Products','tokoo-extensions')
                ],
            ]
        );

        $this->add_control(
            'product_id',
            [
                'label'         => esc_html__('Product IDs', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter id spearate by comma(,) Note: Only works with Products Shortcode.', 'tokoo-extensions'),
                'condition' => [
                    'shortcode_tag' => 'products',
                ],
            ]
        );

        $this->add_control(
            'category',
            [
                'label'         => esc_html__('Category', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter id spearate by comma(,) Note: Only works with Category Shortcode.', 'tokoo-extensions'),
                'condition' => [
                    'shortcode_tag' => 'product_category',
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'         => esc_html__( 'Orderby', 'tokoo-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter Orderby', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'         => esc_html__( 'Order', 'tokoo-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter Order', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'         => esc_html__( 'Limit', 'tokoo-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter the number of products to display', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'ca_slidestoshow',
            [
                'label'         => esc_html__('SlidesToShow', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
            ]
        );

        $this->add_control(
            'ca_slidestoscroll',
            [
                'label'         => esc_html__('SlidesToScroll', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
            ]
        );

        $this->add_control(
            'ca_arrows',
            [
                'label'         => esc_html__( 'Arrows', 'tokoo-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'tokoo-extensions' ),
                'label_off'     => esc_html__( 'Hide', 'tokoo-extensions' ),
                'return_value'  => true,
                'default'       => true,
            ]
        );

        $this->add_control(
            'ca_infinite',
            [
                'label'         => esc_html__( 'Infinite', 'tokoo-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Enable', 'tokoo-extensions' ),
                'label_off'     => esc_html__( 'Disable', 'tokoo-extensions' ),
                'return_value'  => true,
                'default'       => false,
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
     * Render Products Carousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();
        // echo print_r ( $settings );

        extract( $settings );

        $shortcode_atts = function_exists( 'tokoo_get_atts_for_shortcode' ) ? tokoo_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        

        $args = array(
            'header_args' => array(
                'show_header'       => isset( $show_header ) ? $show_header : '',
                'section_title'     => isset( $section_title ) ? $section_title : '',
                'header_aside_action_text'      => isset( $header_aside_action_text ) ? $header_aside_action_text : '',
                'header_aside_action_link'      => isset( $header_aside_action_link ) ? $header_aside_action_link : '',
            ),
            
            'shortcode_tag'     => isset( $shortcode_tag ) ? $shortcode_tag : 'recent_products',
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby'     => $orderby, 'columns' => $ca_slidestoshow, 'limit' => $limit ) ),
            
            'carousel_args' => array(
                'slidesToShow'      => isset( $ca_slidestoshow ) ? filter_var($ca_slidestoshow, FILTER_VALIDATE_INT) : '4',
                'slidesToScroll'    => isset( $ca_slidestoscroll ) ? filter_var( $ca_slidestoscroll , FILTER_VALIDATE_INT) : '4',
                'dots'              => isset( $ca_dots ) ? filter_var( $ca_dots, FILTER_VALIDATE_BOOLEAN ) : false,
                'arrows'            => isset( $ca_arrows ) ? filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ) : true,
                'autoplay'          => isset( $autoplay ) ? filter_var( $autoplay, FILTER_VALIDATE_BOOLEAN ) : false,
                'responsive'        => array(
                    array(
                        'breakpoint'    => 0,
                        'settings'      => array(
                            'slidesToShow'      => 2,
                            'slidesToScroll'    => 2
                        )
                    ),
                    array(
                        'breakpoint'    => 576,
                        'settings'      => array(
                            'slidesToShow'      => 2,
                            'slidesToScroll'    => 2
                        )
                    ),
                    array(
                        'breakpoint'    => 768,
                        'settings'      => array(
                            'slidesToShow'      => 2,
                            'slidesToScroll'    => 2
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
                ),
            )
            
        );

        if( function_exists( 'tokoo_products_carousel' ) ) {
            tokoo_products_carousel( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_Products_Carousel );