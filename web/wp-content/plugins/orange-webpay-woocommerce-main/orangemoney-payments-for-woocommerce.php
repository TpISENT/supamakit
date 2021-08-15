<?php
/*
 * Plugin Name: Orange Money Payments for WooCommerce
 * Description: Orange mobile money payment gateway for woocommerce.
 * Author: Hadi Chahine <hadi.n.chahine@gmail.com> | Saidu Ernest Kamara <ernest@kamara.io>
 * Version: 1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Required minimums and constants
 */
define('WC_OM_PAYMENTS_VERSION', '1.0');
define('WC_OM_PAYMENTS_MIN_PHP_VER', '5.4.0');
define('WC_OM_PAYMENTS_MIN_WC_VER', '3.0.0');
define('WC_OM_PAYMENTS_MAIN_FILE', __FILE__);
define('WC_OM_PAYMENTS_PLUGIN_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

function get_setting_link()
{
    $use_id_as_section = function_exists('WC') ? version_compare(WC()->version, '2.6', '>=') : false;

    $section_slug = $use_id_as_section ? 'orangemoney' : strtolower('WC_Gateway_OM');

    return admin_url('admin.php?page=wc-settings&tab=checkout&section=' . $section_slug);
}

function admin_notices()
{
    $notices = array();
    foreach ((array) $notices as $notice_key => $notice) {
        echo "<div class='" . esc_attr($notice['class']) . "'><p>";
        echo wp_kses($notice['message'], array('a' => array('href' => array())));
        echo '</p></div>';
    }
}

function add_gateways($methods)
{
    $methods[] = 'WC_Gateway_OM';

    return $methods;
}

function init_gateways()
{
    if (!class_exists('WC_Payment_Gateway')) {
        return;
    }

    include_once WC_OM_PAYMENTS_PLUGIN_PATH . '/includes/class-wc-gateway-orangemoney-payments.php';
    //include_once( WC_OM_PAYMENTS_PLUGIN_PATH . '/includes/class-wc-afrikpay-payments-order-lines.php' );

    load_plugin_textdomain('orangemoney-payments-for-woocommerce', false, plugin_basename(dirname(__FILE__)) . '/languages');
    add_filter('woocommerce_payment_gateways', 'add_gateways');
}

add_action('admin_notices', 'admin_notices', 15);
add_action('plugins_loaded', function () {
    init_gateways();
    add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
        $setting_link = get_setting_link();
        $plugin_links = array(
            '<a href="' . $setting_link . '">' . __('Settings', 'orangemoney-payments-for-woocommerce') . '</a>',
            '<a href="http://afrikpay.cederconsulting.com/">' . __('Support', 'orangemoney-payments-for-woocommerce') . '</a>',
        );
        return array_merge($plugin_links, $links);
    });
});
