<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package tokoo
 */

get_header();

    do_action( 'tokoo_before_main_content' ); ?>

    <div id="primary" class="content-area">

        <main id="main" class="site-main" role="main">

            <div class="error-404 not-found">

                <div class="page-content">

                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'tokoo' ); ?></h1>
                    </header><!-- .page-header -->

                    <p><?php esc_html_e( 'Nothing was found at this location. Try searching, or check out the links above.', 'tokoo' ); ?></p>

                    <?php
             
                    echo '</section>';

                    if ( tokoo_is_woocommerce_activated() ) {

                        echo '<div class="error-404-wc-blocks">';

                            echo '<section class="promoted-products" aria-label="' . esc_html__( 'Promoted Products', 'tokoo' ) . '">';

                                tokoo_promoted_products();

                            echo '</section>';
/**
                            echo '<nav class="product-categories" aria-label="' . esc_html__( 'Product Categories', 'tokoo' ) . '">';

                                echo '<h2>' . esc_html__( 'Product Categories', 'tokoo' ) . '</h2>';

                                the_widget(
                                    'WC_Widget_Product_Categories', array(
                                        'count' => 1,
                                    )
                                );

                            echo '</nav>';
*/
                        echo '</div>';

                        echo '<section aria-label="' . esc_html__( 'Popular Products', 'tokoo' ) . '">';

                            echo '<h2>' . esc_html__( 'Popular Products', 'tokoo' ) . '</h2>';

                            $shortcode_content = tokoo_do_shortcode(
                                'best_selling_products', array(
                                    'per_page' => 6,
                                    'columns'  => 6,
                                )
                            );

                            echo $shortcode_content; // WPCS: XSS ok.

                        echo '</section>';
                    }
                    ?>

                </div><!-- .page-content -->
            </div><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
    do_action( 'tokoo_after_main_content' );

get_footer();