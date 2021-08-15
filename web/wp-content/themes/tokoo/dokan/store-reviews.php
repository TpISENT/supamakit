<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

$store_user = get_userdata( get_query_var( 'author' ) );
$store_info = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';

get_header( 'shop' );
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div id="dokan-primary" class="dokan-single-store">
    <div id="dokan-content" class="store-review-wrap woocommerce" role="main">

        <?php dokan_get_template_part( 'store-header' ); ?>


        <?php
        $dokan_template_reviews = version_compare( dokan_pro()->version, '3.0.0' , '<' ) ? Dokan_Pro_Reviews::init() : dokan_pro()->review;
        $id                     = $store_user->ID;
        $post_type              = 'product';
        $limit                  = 20;
        $status                 = '1';
        $comments               = $dokan_template_reviews->comment_query( $id, $post_type, $limit, $status );
        ?>

        <div id="reviews">
            <div id="comments">

                <?php do_action( 'dokan_review_tab_before_comments' ); ?>

                <h2 class="headline"><?php _e( 'Seller Review', 'tokoo' ); ?></h2>

                <ol class="commentlist">
                    <?php
                    if ( count( $comments ) == 0 ) {
                        echo '<span colspan="5">' . __( 'No Results Found', 'tokoo' ) . '</span>';
                    } else {
                        foreach ( $comments as $single_comment ) {
                            if ( $single_comment->comment_approved ) {
                                $GLOBALS['comment'] = $single_comment;
                                $comment_date       = get_comment_date( 'l, F jS, Y \a\t g:i a', $single_comment->comment_ID );
                                $comment_author_img = get_avatar( $single_comment->comment_author_email, 60 );
                                $permalink          = get_comment_link( $single_comment );
                                ?>

                                <li <?php comment_class(); ?>>
                                    <div class="review_comment_container">
                                        <div class="dokan-review-author-img"><?php echo $comment_author_img; ?></div>
                                        <div class="comment-text">
                                            <p class="author">
                                                <strong><?php echo $single_comment->comment_author; ?></strong>
                                            </p>
                                            <a href="<?php echo $permalink; ?>">
                                                <?php
                                                if ( get_option('woocommerce_enable_review_rating') == 'yes' ) :
                                                    $rating =  intval( get_comment_meta( $single_comment->comment_ID, 'rating', true ) ); ?>
                                                    <div class="dokan-rating">
                                                        <div class="star-rating" title="<?php echo sprintf(__( 'Rated %d out of 5', 'tokoo' ), $rating) ?>">
                                                            <span style="width:<?php echo ( intval( get_comment_meta( $single_comment->comment_ID, 'rating', true ) ) / 5 ) * 100; ?>%"><strong><?php echo $rating; ?></strong> <?php _e( 'out of 5', 'tokoo' ); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </a>
                                            <div class="description">
                                                <p><?php echo $single_comment->comment_content; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <?php
                            }
                        }
                    }
                    ?>
                </ol>
            </div>
        </div>

        <?php
        echo $dokan_template_reviews->review_pagination( $id, $post_type, $limit, $status );
        ?>

    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php tokoo_get_dokan_store_sidebar(); ?>

<?php get_footer(); ?>