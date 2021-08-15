<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Elementor Slider Product Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Tokoo_Elementor_Slider_With_Product extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Slider Product widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tokoo_slider_with_product';
    }

    /**
     * Get widget title.
     *
     * Retrieve Slider Product widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Slider Product', 'tokoo-extensions' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Slider Product widget icon.
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
     * Retrieve the list of categories the Slider Product widget belongs to.
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
     * Register Slider Product widget controls.
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
            'columns',
            [
                'label'         => esc_html__( 'Column', 'tokoo-extensions' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter the number of column to display', 'tokoo-extensions' ),
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render Slider Product widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $shortcode_atts = function_exists( 'tokoo_get_atts_for_shortcode' ) ? tokoo_get_atts_for_shortcode( array( 'shortcode' => $shortcode_tag, 'product_category_slug' => $category, 'products_choice' => 'ids', 'products_ids_skus' => $product_id ) ) : array();

        $args = array(
            'shortcode_tag'     => isset( $shortcode_tag ) ? $shortcode_tag : 'recent_products',
            'shortcode_atts'    => wp_parse_args( $shortcode_atts, array( 'order' => $order, 'orderby' => $orderby, 'columns' => $columns, 'limit' => $limit) ),
        );

        if( function_exists( 'tokoo_slider_product' ) ) {
            tokoo_slider_product( $args);
        }

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Tokoo_Elementor_Slider_With_Product );