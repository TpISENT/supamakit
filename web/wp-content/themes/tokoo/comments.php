<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package tokoo
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<section id="comments" class="comments-area" aria-label="<?php esc_html_e( 'Post Comments', 'tokoo' ); ?>">

    <?php if ( have_comments() ) : ?>
    <div class="comments-area-inner">
        <h2 class="comments-title">
            <?php
                printf( // WPCS: XSS OK.
                    esc_html( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'tokoo' ) ),
                    number_format_i18n( get_comments_number() ),
                    '<span>' . get_the_title() . '</span>'
                );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'      => 'ol',
                    'short_ping' => true,
                    'callback'   => 'tokoo_comment',
                ) );
            ?>
        </ol><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through. ?>
        <nav id="comment-nav-below" class="comment-navigation" role="navigation" aria-label="<?php esc_html_e( 'Comment Navigation Below', 'tokoo' ); ?>">
            <span class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tokoo' ); ?></span>
            <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'tokoo' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'tokoo' ) ); ?></div>
        </nav><!-- #comment-nav-below -->
        <?php endif; // Check for comment navigation. ?>
    </div><?php
    endif;

    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tokoo' ); ?></p>
    <?php endif; 

    $args = apply_filters( 'tokoo_comment_form_args', tokoo_get_comment_form_args() );
    comment_form( $args ); ?>

</section><!-- #comments -->