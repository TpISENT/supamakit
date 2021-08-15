<?php
/**
 * Template name: About
 *
 * @package tokoo
 */
remove_action( 'tokoo_before_site_content', 'tokoo_breadcrumb', 10 );

get_header();

    do_action( 'tokoo_before_about' ); ?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             */
            do_action( 'tokoo_about' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php do_action( 'tokoo_after_about' );

get_footer();