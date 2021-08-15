<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tokoo
 */

get_header();

    do_action( 'tokoo_before_main_content' ); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main"><?php

        if ( have_posts() ) :

            ?><header class="page-header">
                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </header><!-- .page-header --><?php
            get_template_part( 'loop' );

        else :

            get_template_part( 'templates/contents/content', 'none' );

        endif; ?>

        </main><!-- #main -->
    </div><!-- #primary --><?php

    do_action( 'tokoo_after_main_content' );

    $layout = tokoo_get_blog_layout();
    if ( $layout == 'left-sidebar' || $layout == 'right-sidebar' ) {
        do_action( 'tokoo_sidebar', 'blog' );
    }

get_footer();