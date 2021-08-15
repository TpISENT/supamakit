<?php
/**
 * Template for displaying search forms in Tokoo
 *
 */
$navbar_search_text = apply_filters( 'tokoo_navbar_search_placeholder', esc_html__( 'What are you looking for ?', 'tokoo' ) );
?>
<div class="tokoo-search-form-wrapper">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'tokoo' ); ?></label>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr( $navbar_search_text ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
        <button class="search-submit" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'tokoo' ); ?>"><i class="flaticon-magnifying-glass"></i></button>
    </form>
</div>