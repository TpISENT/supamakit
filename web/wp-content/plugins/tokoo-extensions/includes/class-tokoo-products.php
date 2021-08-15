<?php
/**
 * Tokoo Products Class
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tokoo_Products class
 */
if( class_exists( 'Tokoo_Shortcode_Products' ) ) {
	class Tokoo_Products {

		/**
		 * List products in a category shortcode.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function product_category( $atts ) {
			if ( empty( $atts['category'] ) ) {
				return '';
			}

			$atts = array_merge( array(
				'limit'        => '12',
				'columns'      => '4',
				'orderby'      => 'menu_order title',
				'order'        => 'ASC',
				'category'     => '',
				'cat_operator' => 'IN',
			), (array) $atts );

			$shortcode = new Tokoo_Shortcode_Products( $atts, 'product_category' );

			return $shortcode->get_products();
		}

		/**
		 * List all (or limited) product categories.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function product_categories( $atts ) {
			global $woocommerce_loop;
			
			$atts = shortcode_atts( array(
				'number'     => null,
				'orderby'    => 'name',
				'order'      => 'ASC',
				'columns'    => '4',
				'hide_empty' => 1,
				'parent'     => '',
				'ids'        => '',
				'slug'       => '',
			), $atts, 'product_categories' );
			
			$ids        = array_filter( array_map( 'trim', explode( ',', $atts['ids'] ) ) );
			$hide_empty = ( true === $atts['hide_empty'] || 'true' === $atts['hide_empty'] || 1 === $atts['hide_empty'] || '1' === $atts['hide_empty'] ) ? 1 : 0;
			
			// get terms and workaround WP bug with parents/pad counts
			$args = array(
				'orderby'    => $atts['orderby'],
				'order'      => $atts['order'],
				'hide_empty' => $hide_empty,
				'slug'       => $atts['slug'],
				'include'    => $ids,
				'pad_counts' => true,
				'child_of'   => $atts['parent'],
			);
			
			$product_categories = get_terms( 'product_cat', $args );
			
			if ( '' !== $atts['parent'] ) {
				$product_categories = wp_list_filter( $product_categories, array( 'parent' => $atts['parent'] ) );
			}
			
			if ( $hide_empty ) {
				foreach ( $product_categories as $key => $category ) {
					if ( 0 == $category->count ) {
						unset( $product_categories[ $key ] );
					}
				}
			}
			
			if ( $atts['number'] ) {
				$product_categories = array_slice( $product_categories, 0, $atts['number'] );
			}
			
			$columns = absint( $atts['columns'] );
			$woocommerce_loop['columns'] = $columns;
			
			ob_start();
			
			if ( $product_categories ) {
				
				woocommerce_product_loop_start();
				
				foreach ( $product_categories as $category ) {
					wc_get_template( 'content-product_cat.php', array(
						'category' => $category,
					) );
				}
				
				woocommerce_product_loop_end();
			
			}
			
			woocommerce_reset_loop();
			
			return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
		}

		/**
		 * Recent Products shortcode.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function recent_products( $atts ) {
			$atts = array_merge( array(
				'limit'        => '12',
				'columns'      => '4',
				'orderby'      => 'date',
				'order'        => 'DESC',
				'category'     => '',
				'cat_operator' => 'IN',
			), (array) $atts );

			$shortcode = new Tokoo_Shortcode_Products( $atts, 'recent_products' );

			return $shortcode->get_products();
		}

		/**
		 * List multiple products shortcode.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function products( $atts ) {
			$atts = (array) $atts;
			$type = 'products';

			// Allow list product based on specific cases.
			if ( isset( $atts['on_sale'] ) && wc_string_to_bool( $atts['on_sale'] ) ) {
				$type = 'sale_products';
			} elseif ( isset( $atts['best_selling'] ) && wc_string_to_bool( $atts['best_selling'] ) ) {
				$type = 'best_selling_products';
			} elseif ( isset( $atts['top_rated'] ) && wc_string_to_bool( $atts['top_rated'] ) ) {
				$type = 'top_rated_products';
			}

			$shortcode = new Tokoo_Shortcode_Products( $atts, $type );

			return $shortcode->get_products();
		}

		/**
		 * List all products on sale.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function sale_products( $atts ) {
			$atts = array_merge( array(
				'limit'        => '12',
				'columns'      => '4',
				'orderby'      => 'title',
				'order'        => 'ASC',
				'category'     => '',
				'cat_operator' => 'IN',
			), (array) $atts );

			$shortcode = new Tokoo_Shortcode_Products( $atts, 'sale_products' );

			return $shortcode->get_products();
		}

		/**
		 * List best selling products on sale.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function best_selling_products( $atts ) {
			$atts = array_merge( array(
				'limit'        => '12',
				'columns'      => '4',
				'category'     => '',
				'cat_operator' => 'IN',
			), (array) $atts );

			$shortcode = new Tokoo_Shortcode_Products( $atts, 'best_selling_products' );

			return $shortcode->get_products();
		}

		/**
		 * List top rated products on sale.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function top_rated_products( $atts ) {
			$atts = array_merge( array(
				'limit'        => '12',
				'columns'      => '4',
				'orderby'      => 'title',
				'order'        => 'ASC',
				'category'     => '',
				'cat_operator' => 'IN',
			), (array) $atts );

			$shortcode = new Tokoo_Shortcode_Products( $atts, 'top_rated_products' );

			return $shortcode->get_products();
		}
		
		/**
		 * Output featured products.
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function featured_products( $atts ) {
			$atts = array_merge( array(
				'limit'        => '12',
				'columns'      => '4',
				'orderby'      => 'date',
				'order'        => 'DESC',
				'category'     => '',
				'cat_operator' => 'IN',
			), (array) $atts );

			$atts['visibility'] = 'featured';

			$shortcode = new Tokoo_Shortcode_Products( $atts, 'featured_products' );

			return $shortcode->get_products();
		}

		/**
		 * List products with an attribute shortcode.
		 * Example [product_attribute attribute="color" filter="black"].
		 *
		 * @param array $atts Attributes.
		 * @return string
		 */
		public static function product_attribute( $atts ) {
			$atts = array_merge( array(
				'limit'     => '12',
				'columns'   => '4',
				'orderby'   => 'title',
				'order'     => 'ASC',
				'attribute' => '',
				'terms'     => '',
			), (array) $atts );
			
			if ( empty( $atts['attribute'] ) ) {
				return '';
			}
			
			$shortcode = new Tokoo_Shortcode_Products( $atts, 'product_attribute' );
			
			return $shortcode->get_products();
		}
	}
} 
