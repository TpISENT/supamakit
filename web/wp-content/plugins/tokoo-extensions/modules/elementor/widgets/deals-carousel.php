<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Deals Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tokoo_Elementor_Deals_Carousel extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Deals Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tokoo_deals_carousel';
    }

    /**
     * Get widget title.
     *
     * Retrieve Deals Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Deals Carousel', 'tokoo-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Deals Carousel widget icon.
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
     * Retrieve the list of categories the Deals Carousel widget belongs to.
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
     * Register Deals Carousel widget controls.
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
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your title here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'header_timer',
            [
                'label'         => esc_html__( 'Show Header Timer', 'tokoo-extensions' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'tokoo-extensions' ),
                'label_off'     => esc_html__( 'Hide', 'tokoo-extensions' ),
                'return_value'  => true,
                'default'       => true,
            ]
        );

        $this->add_control(
            'timer_title',
            [
                'label' => esc_html__( 'Timer Title', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your timer title here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'timer_value',
            [
                'label' => esc_html__( 'Timer Value', 'tokoo-extensions' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '+8 hours',
                'placeholder' => esc_html__( 'Enter your timer value here', 'tokoo-extensions' ),
            ]
        );

        $this->add_control(
            'bg_img',
            [
                'name' => 'image',
                'label' => esc_html__( 'Upload Background Image', 'tokoo-extensions' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload background image', 'tokoo-extensions' ),
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
                'default'       => 20,
            ]
        );

        $this->add_control(
            'ca_rows',
            [
                'label'         => esc_html__('row', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of rows.', 'tokoo-extensions'),
                'default'       => 2,
            ]
        );

        $this->add_control(
            'ca_slidesperrow',
            [
                'label'         => esc_html__('slidesPerRow', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of rows to display.', 'tokoo-extensions'),
                'default'       => 4,
            ]
        );


        $this->add_control(
            'ca_slidestoshow',
            [
                'label'         => esc_html__('slidesToShow', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to display.', 'tokoo-extensions'),
                'default'       => 1,
            ]
        );

        $this->add_control(
            'ca_slidestoscroll',
            [
                'label'         => esc_html__('slidesToScroll', 'tokoo-extensions'),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__('Enter the number of items to scroll.', 'tokoo-extensions'),
                'default'       => 1,
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
     * Render Deals Carousel widget output on the frontend.
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

        $shortcode   = '[products limit="24"]';

        $args = array(
            
            'show_header'       => isset( $show_header ) ? $show_header : '',
            'section_title'     => isset( $section_title ) ? $section_title : '',
            'header_timer'      => isset( $header_timer ) ? $header_timer : '',
            'timer_title'       => isset( $timer_title ) ? $timer_title : '',
            'timer_value'       => isset( $timer_value ) ? $timer_value : '',
            'bg_img'            => ( isset( $bg_img['id'] ) && $bg_img['id'] != 0 ) ? wp_get_attachment_url( $bg_img['id'] ) : '',
            'shortcode_tag'     => isset( $shortcode_tag ) ? $shortcode_tag : 'products',
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby'     => $orderby, 'limit'     => $limit ) ),
            'carousel_args' => array(
                'rows'                  => isset( $ca_rows ) ? filter_var($ca_rows, FILTER_VALIDATE_INT) : '2',
                'slidesPerRow'      => isset( $ca_slidesperrow ) ? filter_var($ca_slidesperrow, FILTER_VALIDATE_INT) : 4,
                'slidesToShow'      => isset( $ca_slidestoshow ) ? filter_var($ca_slidestoshow, FILTER_VALIDATE_INT) : '4',
                'slidesToScroll'    => isset( $ca_slidestoscroll ) ? filter_var( $ca_slidestoscroll , FILTER_VALIDATE_INT) : '4',
                'dots'              => isset( $ca_dots ) ? filter_var( $ca_dots, FILTER_VALIDATE_BOOLEAN ) : true,
                'arrows'            => isset( $ca_arrows ) ? filter_var( $ca_arrows, FILTER_VALIDATE_BOOLEAN ) : false,
                'autoplay'          => isset( $autoplay ) ? filter_var( $autoplay, FILTER_VALIDATE_BOOLEAN ) : false,
                'responsive'        => array(
                    array(
                        'breakpoint'    => 0,
                        'settings'      => array(
                            'slidesPerRow'      => 2,
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 576,
                        'settings'      => array(
                            'slidesPerRow'      => 2,
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 2
                        )
                    ),
                    array(
                        'breakpoint'    => 768,
                        'settings'      => array(
                            'slidesPerRow'      => 2,
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 992,
                        'settings'      => array(
                            'slidesPerRow'      => 3,
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    ),
                    array(
                        'breakpoint'    => 1200,
                        'settings'      => array(
                            'slidesPerRow'      => 4,
                            'slidesToShow'      => 1,
                            'slidesToScroll'    => 1
                        )
                    )
                ),
            ),

        );

        
        if( function_exists( 'tokoo_flash_sale_block' ) ) {
            tokoo_flash_sale_block( $args );
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_Deals_Carousel );