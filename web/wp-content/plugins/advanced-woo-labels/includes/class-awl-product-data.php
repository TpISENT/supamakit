<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'AWL_Product_Data' ) ) :

    /**
     * Class for plugin help methods
     */
    class AWL_Product_Data {
        
        /**
         * Get product sales based on date query
         * @since 1.0
         * @param  string $query Date query
         * @param  object $product Product
         * @return integer
         */
        static public function get_sales_count( $query, $product ) {
            global $woocommerce;

            $value = 0;

            if ( $query === 'all' ) {

                $value = method_exists( $product, 'get_total_sales' ) ? $product->get_total_sales() : get_post_meta( $product->get_id(), 'total_sales', true );

            } else {

                include_once( $woocommerce->plugin_path() . '/includes/admin/reports/class-wc-admin-report.php' );
                $wc_report = new WC_Admin_Report();

                $data = $wc_report->get_order_report_data(
                    array(
                        'data'         => array(
                            '_product_id' => array(
                                'type'            => 'order_item_meta',
                                'order_item_type' => 'line_item',
                                'function'        => '',
                                'name'            => 'product_id',
                            ),
                            '_qty'     => array(
                                'type'            => 'order_item_meta',
                                'order_item_type' => 'line_item',
                                'function'        => 'SUM',
                                'name'            => 'sales',
                            ),
                            'post_date'   => array(
                                'type'     => 'post_data',
                                'function' => '',
                                'name'     => 'post_date',
                            ),
                        ),
                        'where'        => array(
                            array(
                                'key'      => 'post_date',
                                'value'    => date_i18n( 'Y-m-d', strtotime( $query, current_time( 'timestamp' ) ) ),
                                'operator' => '>',
                            ),
                            array(
                                'key'      => 'order_item_meta__product_id.meta_value',
                                'value'    => $product->get_id(),
                                'operator' => '=',
                            ),
                        ),
                        'group_by'     => 'product_id',
                        'query_type'   => 'get_results',
                        'filter_range' => false,
                    )
                );

                if ( $data && is_array( $data ) ) {
                    $value = $data[0]->sales;
                }

            }

            return $value;

        }

        /**
         * Get product quantity
         * @since 1.0
         * @param  object $product Product
         * @return integer
         */
        static public function get_quantity( $product ) {

            $stock_levels = array();

            if ( $product->is_type( 'variable' ) ) {
                foreach ( $product->get_children() as $variation ) {
                    $var = wc_get_product( $variation );
                    if ( $var->is_in_stock() && ! $var->get_manage_stock() ) {
                        $stock_levels[] = 999999;
                    } else {
                        $stock_levels[] = $var->get_stock_quantity();
                    }
                }
            } else {
                if ( $product->is_in_stock() && ! $product->get_manage_stock() ) {
                    $stock_levels[] = 999999;
                } else {
                    $stock_levels[] = $product->get_stock_quantity();
                }
            }

            return intval( max( $stock_levels ) );

        }

        /**
         * Get product reviews count
         * @since 1.0
         * @param  string $query Date query
         * @param  object $product Product
         * @return integer
         */
        static public function get_reviews_count( $query, $product ) {

            if ( $query === 'all' ) {

                $value = $product->get_review_count();

            } else {

                $value = get_comments( array(
                    'post_id'    => $product->get_id(),
                    'count'      => true,
                    'date_query' => $query
                ));

            }

            return $value;

        }

        /**
         * Get product price
         * @since 1.23
         * @param  object $product Product
         * @return integer
         */
        static public function get_price( $product ) {

            /**
             * Filter product price
             * @since 1.23
             * @param integer $price Product price
             * @param object $product Product
             */
            $price = apply_filters( 'awl_product_price', $product->get_price(), $product );

            return $price;

        }

        /**
         * Get product price
         * @since 1.23
         * @param  object $product Product
         * @return integer
         */
        static public function get_sale_price( $product ) {

            /**
             * Filter product sale price
             * @since 1.23
             * @param integer $price Product price
             * @param object $product Product
             */
            $price = apply_filters( 'awl_product_sale_price', $product->get_sale_price(), $product );

            if ( ! $price ) {
                $price = AWL_Product_Data::get_price( $product );
            }

            return $price;

        }

        /**
         * Get product discount percentage
         * @since 1.06
         * @param  object $product Product
         * @return integer
         */
        static public function get_discount_percent( $product ) {

            $save_percents = 0;

           if ( $product->is_type( 'variable' ) ) {

                $save_percents_cache = get_post_meta( $product->get_id(), '_awl_save_percent_value', true );
                if ( $save_percents_cache ) {
                    return $save_percents_cache;
                }

                $available_variations = $product->get_available_variations();

                for ( $i = 0; $i < count( $available_variations ); ++ $i ) {
                    $variation_id     = $available_variations[ $i ]['variation_id'];
                    $variable_product = new WC_Product_Variation( $variation_id );
                    $variable_product_regular_price = $variable_product->get_regular_price();
                    $variable_product_sale_price = AWL_Product_Data::get_sale_price( $variable_product );
                    if ( $variable_product_regular_price == $variable_product_sale_price ) {
                        continue;
                    }
                    $percentage = ( ( $variable_product_regular_price - $variable_product_sale_price ) / $variable_product_regular_price ) * 100;
                    if ( $percentage > $save_percents ) {
                        $save_percents = $percentage;
                    }
                }

                update_post_meta( $product->get_id(), '_awl_save_percent_value', $save_percents );

           } else {
               $product_regular_price = $product->get_regular_price();
               $product_sale_price = AWL_Product_Data::get_sale_price( $product );
               if ( $product_sale_price && $product_regular_price && $product_regular_price !== $product_sale_price ) {
                   $save_percents = ( ( $product_regular_price - $product_sale_price ) / $product_regular_price ) * 100;
               }
           }

           return $save_percents;

        }

        /**
         * Get product discount amount
         * @since 1.06
         * @param  object $product Product
         * @return integer
         */
        static public function get_discount_amount( $product ) {

            $save_amount = 0;

            if ( $product->is_type( 'variable' ) ) {

                $save_amount_cache = get_post_meta( $product->get_id(), '_awl_save_amount_value', true );
                if ( $save_amount_cache ) {
                    return $save_amount_cache;
                }

                $available_variations = $product->get_available_variations();

                for ( $i = 0; $i < count( $available_variations ); ++ $i ) {
                    $variation_id     = $available_variations[ $i ]['variation_id'];
                    $variable_product = new WC_Product_Variation( $variation_id );
                    $variable_product_regular_price = $variable_product->get_regular_price();
                    $variable_product_sale_price = AWL_Product_Data::get_sale_price( $variable_product );
                    if ( $variable_product_regular_price == $variable_product_sale_price ) {
                        continue;
                    }
                    $amount = $variable_product_regular_price - $variable_product_sale_price;
                    if ( $amount > $save_amount ) {
                        $save_amount = $amount;
                    }
                }

                update_post_meta( $product->get_id(), '_awl_save_amount_value', $save_amount );

            } else {
                $product_regular_price = $product->get_regular_price();
                $product_sale_price = AWL_Product_Data::get_sale_price( $product );
                if ( $product_sale_price && $product_regular_price && $product_regular_price !== $product_sale_price ) {
                    $save_amount = $product_regular_price - $product_sale_price;
                }
            }

            return $save_amount;

        }

    }

endif;