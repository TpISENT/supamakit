<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'AWL_Label_Text' ) ) :

    /**
     * AWL Conditions check class
     */
    class AWL_Label_Text {

        protected $text = '';

        protected $matches = '';

        protected $replacement = '';

        protected $custom_var = false;

        protected $variables = array(
            '/{PRICE}/i' => 'price',
            '/{REGULAR_PRICE}/i' => 'regular_price',
            '/{SALE_PRICE}/i' => 'sale_price',
            '/{SAVE_PERCENT\s*\|*\s*([\d]*)\s*}/i' => 'save_percent',
            '/{SAVE_AMOUNT\s*\|*\s*([\d]*)\s*}/i' => 'save_amount',
            '/{SALE_ENDS}/i' => 'sale_ends',
            '/{SYMBOL}/i' => 'currency_symbol',
            '/{SKU}/i' => 'sku',
            '/{QTY}/i' => 'quantity',
            '/{BR}/i' => 'br',
        );

        /*
         * Constructor
         */
        public function __construct( $text ) {

            $this->text = $text;

            /**
             * Filter labels text vars
             * @since 1.00
             * @param array $this->variables Array of text variables
             */
            $this->variables = apply_filters( 'awl_labels_text_vars', $this->variables );

        }

        /*
         * Get label text
         */
        public function text() {

            if ( ! isset( $GLOBALS['product'] ) ) {
                return $this->text;
            }

            foreach ( $this->variables as $rule => $replacement_f ) {
                if ( preg_match( $rule, $this->text ) ) {
                    $this->replacement = is_array( $replacement_f ) ? $replacement_f['func'] : array( $this, $replacement_f );
                    $this->custom_var = is_array( $replacement_f );
                    $this->text = preg_replace_callback( $rule, array( $this, 'replace'), $this->text );
                }
            }

            return $this->text;

        }

        /*
         * Replace callback
         */
        private function replace( $matches ) {

            global $product;

            if ( isset( $matches[1] ) && trim( $matches[1] ) === '' ) {
                unset( $matches[1] );
            }
            $this->matches = $matches;
            $text = $this->custom_var ? call_user_func( $this->replacement, $matches ) : call_user_func( $this->replacement );

            /**
             * Filter text vaiables output
             * @since 1.23
             * @param string $text Text variables output
             * @param string $matches Text variable
             * @param array|string $this->replacement Callback function
             * @param object $product Current product
             */
            $text = apply_filters( 'awl_label_text_var_value', $text, $matches[0], $this->replacement, $product );

            return $text;
            
        }

        /*
         * Get price
         */
        private function price() {
            global $product;
            $price = AWL_Product_Data::get_price( $product ) ? get_woocommerce_currency_symbol() . AWL_Product_Data::get_price( $product ) : '';
            return $price;
        }

        /*
         * Get price
         */
        private function regular_price() {
            global $product;
            $regular_price_val = $product->get_type() === 'variable' ? $product->get_variation_regular_price() : $product->get_regular_price();
            $regular_price = $regular_price_val ? get_woocommerce_currency_symbol() . $regular_price_val : '';
            return $regular_price;
        }

        /*
         * Get sale price
         */
        private function sale_price() {
            global $product;
            $sale_price = ( $product->is_on_sale() && AWL_Product_Data::get_sale_price( $product ) ) ? get_woocommerce_currency_symbol() . AWL_Product_Data::get_sale_price( $product ) : ( AWL_Product_Data::get_price( $product ) ? get_woocommerce_currency_symbol() . AWL_Product_Data::get_price( $product ) : '' );
            return $sale_price;
        }

        /*
         * Get discount percentage
         */
        private function save_percent() {
            global $product;
            $round = isset( $this->matches[1] ) ? intval( $this->matches[1] ) : 0;
            $value = AWL_Product_Data::get_discount_percent( $product );
            $save_percents = $value ? round( $value, $round ) : '';
            return $save_percents;
        }

        /*
         * Get discount amount
         */
        private function save_amount() {
            global $product;
            $round = isset( $this->matches[1] ) ? intval( $this->matches[1] ) : 0;
            $value = AWL_Product_Data::get_discount_amount( $product );
            $save_amount = $value ? round( $value, $round ) : '';
            return $save_amount;
        }

        /*
         * Get sale end date in days
         */
        private function sale_ends() {
            global $product;
            $sale_ends = ( $product->is_on_sale() && AWL_Product_Data::get_sale_price( $product ) && method_exists( $product, 'get_date_on_sale_to' ) && $product->get_date_on_sale_to() ) ? round( ( strtotime( $product->get_date_on_sale_to() ) - time() ) / ( 60 * 60 * 24 ) ) : '';
            return $sale_ends;
        }

        /*
         * Get currency symbol
         */
        private function currency_symbol() {
            $symbol = get_woocommerce_currency_symbol();
            return $symbol;
        }

        /*
         * Get product SKU
         */
        private function sku() {
            global $product;
            $sku = $product->get_sku() ? $product->get_sku() : '';
            return $sku;
        }

        /*
         * Get product quantity
         */
        private function quantity() {
            global $product;
            $value = AWL_Product_Data::get_quantity( $product );
            $quantity = $value ? $value : '';
            return $quantity;
        }

        /*
        * Replace br
        */
        private function br() {
            return '<br>';
        }

    }

endif;