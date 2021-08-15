<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package tokoo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    /**
     * Functions hooked in to tokoo_page add_action
     *
     * @hooked tokoo_page_header          - 10
     * @hooked tokoo_page_content         - 20
     */
    do_action( 'tokoo_page' );
    ?>
</article><!-- #post-## -->