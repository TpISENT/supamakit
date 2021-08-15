<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

$vendor = dokan()->vendor->get( get_query_var( 'author' ) );
$vendor_info = $vendor->get_shop_info();

get_header( 'shop' );
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div id="primary" class="content-area dokan-single-store dokan-w8">
    <div id="dokan-content" class="site-content store-review-wrap woocommerce" role="main">

        <?php dokan_get_template_part( 'store-header' ); ?>

        <div id="store-toc-wrapper">
            <div id="store-toc">
                <?php
                if( ! empty( $vendor->get_store_tnc() ) ):
                ?>
                    <h2 class="headline"><?php _e( 'Terms And Conditions', 'tokoo' ); ?></h2>
                    <div>
                        <?php
                        echo nl2br( $vendor->get_store_tnc() );
                        ?>
                    </div>
                <?php
                endif;
                ?>
            </div><!-- #store-toc -->
        </div><!-- #store-toc-wrap -->

    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<div class="dokan-clearfix"></div>

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>