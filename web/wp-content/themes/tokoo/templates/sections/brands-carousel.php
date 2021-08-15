<?php
/**
 * Brands Carousel
 *
 * @author      Transvelo
 * @package     tokoo/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_class = empty( $section_args['section_class'] ) ? 'brands-carousel' : $section_args['section_class'] . ' brands-carousel';

if ( ! empty( $section_args['animation'] ) ) {
    $section_class .= ' animate-in-view';
}

$section_id = 'brands-carousel-' . uniqid();
$taxonomy_args = tokoo_get_atts_for_taxonomy_slugs( $taxonomy_args );

?>
<section id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( $section_class ); ?>" >
    <header>
        <?php if ( ! empty( $section_args['section_title'] ) ) : ?>
        <h2 class="section-title"><?php echo esc_html( $section_args['section_title'] ); ?></h2>
        <?php endif; ?>
    </header>

    <div class="brands" data-ride="tk-slick-carousel" data-wrap=".brand-thumbnails" data-slick="<?php echo htmlspecialchars( json_encode( $carousel_args ), ENT_QUOTES, 'UTF-8' ); ?>">
        <?php echo tokoo_do_shortcode( 'mas_product_brand_thumbnails', $taxonomy_args ); ?>
    </div>
</section>