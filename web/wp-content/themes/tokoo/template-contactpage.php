<?php
/**
 * Template name: Contact
 *
 * @package tokoo
 */
remove_action( 'tokoo_before_site_content', 'tokoo_breadcrumb', 10 );

get_header();
    
    do_action( 'tokoo_before_contact' ); ?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
        	<div class="contact-page-wrapper">
	            <?php
	            /**
	             */
	            do_action( 'tokoo_contact' ); ?>
	        </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();