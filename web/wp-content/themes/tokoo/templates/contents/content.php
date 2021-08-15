<?php
/**
 * Template used to display post content.
 *
 * @package tokoo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>

    <?php
    /**
     * Functions hooked in to tokoo_loop_post action.
     *
     * @hooked tokoo_post_header          - 10
     * @hooked tokoo_post_meta            - 20
     * @hooked tokoo_post_content         - 30
     */
    do_action( 'tokoo_loop_post' );
    ?>

</article><!-- #post-## -->