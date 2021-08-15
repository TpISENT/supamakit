<?php
/**
 * Template name: Home v1
 *
 * @package tokoo
 */

remove_action( 'tokoo_before_site_content', 'tokoo_breadcrumb', 10 );

get_header();

    do_action( 'tokoo_before_home_v1' ); ?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            /**
             */
            do_action( 'tokoo_home_v1' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php do_action( 'tokoo_after_home_v1' );

get_footer();