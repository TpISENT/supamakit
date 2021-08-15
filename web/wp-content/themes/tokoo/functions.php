<?php
/**
 * Tokoo engine room
 *
 * @package tokoo
 */

/**
 * Assign the Tokoo version to a var
 */
$theme         = wp_get_theme( 'tokoo' );
$tokoo_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 780; /* pixels */
}

$tokoo = (object) array(
    'version'    => $tokoo_version,
    'main'       => require get_template_directory() . '/inc/class-tokoo.php'
);

require get_template_directory() . '/inc/tokoo-functions.php';
require get_template_directory() . '/inc/tokoo-template-hooks.php';
require get_template_directory() . '/inc/tokoo-template-functions.php';

if ( tokoo_is_redux_activated() ) {
    require get_template_directory() . '/inc/redux-framework/tokoo-options.php';
    require get_template_directory() . '/inc/redux-framework/hooks.php';
    require get_template_directory() . '/inc/redux-framework/functions.php';
}

if ( tokoo_is_woocommerce_activated() ) {
    $tokoo->woocommerce = require get_template_directory() . '/inc/woocommerce/class-tokoo-woocommerce.php';
    require get_template_directory() . '/inc/woocommerce/tokoo-woocommerce-template-hooks.php';
    require get_template_directory() . '/inc/woocommerce/tokoo-woocommerce-template-functions.php';
}

if ( tokoo_is_ocdi_activated() ) {
    require get_template_directory() . '/inc/ocdi/hooks.php';
    require get_template_directory() . '/inc/ocdi/functions.php';
}

if ( tokoo_is_jetpack_activated() ) {
    require_once get_template_directory() . '/inc/jetpack/tokoo-jetpack-functions.php';
}

if ( tokoo_is_woozone_activated() ) {
    require_once get_template_directory() . '/inc/woozone/tokoo-woozone.php';
}

if ( apply_filters( 'tokoo_load_wpml', true ) && tokoo_is_wpml_activated() ) {
    require get_template_directory() . '/inc/wpml/class-tokoo-wpml.php';
}

if ( is_admin() ) {
    require get_template_directory() . '/inc/admin/class-tokoo-admin.php';
}

/**
 * Load Dokan compatibility files.
 */
if ( tokoo_is_dokan_activated() ) {
    require get_template_directory() . '/inc/dokan/functions.php';
    require get_template_directory() . '/inc/dokan/hooks.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

function remove_version_info() {
    return '';
}
add_filter('the_generator', 'remove_version_info');
