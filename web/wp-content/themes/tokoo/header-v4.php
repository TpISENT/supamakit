<?php
/**
 * The header v4 for Tokoo.
 *
 * @package tokoo
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="off-canvas-wrapper">
<div id="page" class="hfeed site">
    <?php
    /**
     * 
     */
    do_action( 'tokoo_before_header_v4' ); ?>

    <header class="site-header header-v4">
        <div class="<?php echo tokoo_has_handheld_header() ? 'desktop-only' : ''; ?>">
            <?php
            /**
             * 
             */
            do_action( 'tokoo_header_v4' ); ?>
        </div>

        <?php
        /**
         * @hooked tokoo_off_canvas_nav - 10
         * @hooked tokoo_header_logo - 20
         * @hooked tokoo_handheld_header_links - 30
         */
        do_action( 'tokoo_after_header' ); ?>
    
    </header><!-- #masthead -->

    <div id="content" class="site-content" tabindex="-1">
        <div class="container">
            <?php 
            /**
             * 
             */
            do_action( 'tokoo_before_site_content' ); ?>
            <div class="site-content-inner">