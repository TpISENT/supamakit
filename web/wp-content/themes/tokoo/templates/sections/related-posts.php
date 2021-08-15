<?php
/**
 * Posts Block
 *
 * @author  MadrasThemes
 * @package Tokoo/Templates
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$section_class = empty( $section_class ) ? 'tokoo-related-articles' : 'tokoo-related-articles ' . $section_class;
if ( ! empty( $animation ) ) {
    $section_class .= ' animate-in-view';
}

$related_posts = new WP_Query( $query_args );
if ( $related_posts->have_posts() ) : ?>
<section class="<?php echo esc_attr( $section_class ); ?>" <?php if ( !empty( $animation ) ) : ?>data-animation="<?php echo esc_attr( $animation );?>"<?php endif; ?>>
    <?php if( ! empty( $section_title ) || ! empty( $subtitle ) ) : ?>
    <header class="section-header">
        <?php if( ! empty( $section_title ) ) : ?>
            <h2 class="section-title"><?php echo wp_kses_post ( $section_title ); ?></h2>
        <?php endif; ?>
    </header>
    <?php endif; ?>
    <div class="related-posts columns-<?php echo esc_attr( $columns ); ?>">
        <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
        <article class="post article">
            <?php
                tokoo_post_featured_image();
                tokoo_post_header();
            ?>
        </article>
        <?php endwhile; ?>
    </div>
</section>
<?php endif;
wp_reset_postdata();