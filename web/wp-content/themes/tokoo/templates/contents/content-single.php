<?php
/**
 * Template used to display post content on single pages.
 *
 * @package tokoo
 */

$single_post_class = apply_filters( 'tokoo_single_post_class', array( 'article', 'single-article' ) );

?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $single_post_class ); ?>>

    <?php
    do_action( 'tokoo_single_post_top' );

    /**
     * Functions hooked into tokoo_single_post add_action
     *
     * @hooked tokoo_post_header          - 10
     * @hooked tokoo_post_meta            - 20
     * @hooked tokoo_post_content         - 30
     */
    do_action( 'tokoo_single_post' );

    /**
     * Functions hooked in to tokoo_single_post_bottom action
     *
     * @hooked tokoo_post_nav         - 10
     * @hooked tokoo_display_comments - 20
     */
    do_action( 'tokoo_single_post_bottom' );
    ?>

</div><!-- #post-## -->


