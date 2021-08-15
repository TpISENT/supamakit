<?php

if (!defined('ABSPATH')) {
    exit;
}

return array(
    'enabled' => array(
        'title' => __('Enable/Disable', 'woocommerce'),
        'type' => 'checkbox',
        'label' => __('Enable Orange Money WebPay', 'woocommerce'),
        'default' => 'no',
    ),
    'test_mode' => array(
        'title' => __('Test Mode', 'woocommerce'),
        'type' => 'checkbox',
        'desc_tip' => true,
        'description' => __('Enables gateway in test mode.', 'woocommerce'),
        'default' => 'no',
    ),
    'title' => array(
        'title' => __('Title', 'woocommerce'),
        'type' => 'text',
        'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
        'default' => __('Orange Money WebPay', 'woocommerce'),
        'desc_tip' => true,
    ),
    'description' => array(
        'title' => __('Description', 'woocommerce'),
        'type' => 'text',
        'desc_tip' => true,
        'description' => __('This controls the description which the user sees during checkout.', 'woocommerce'),
        'default' => __('Pay with orange money webpay.', 'woocommerce'),
    ),
    'merchant_name' => array(
        'title' => __('Merchant Name', 'woocommerce'),
        'type' => 'text',
        'desc_tip' => true,
        'description' => __('This is what the client sees as the merchant name on orange\'s checkout site.', 'woocommerce'),
        'default' => __('Orange Money Merchant', 'woocommerce'),
    ),
    'payment_url' => array(
        'title' => __('Payment URL', 'woocommerce'),
        'type' => 'text',
        'desc_tip' => false,
    ),
    'merchant_key' => array(
        'title' => __('Merchant Key', 'woocommerce'),
        'type' => 'text',
        'desc_tip' => true,
        'description' => __('This is the merchant\'s key.', 'woocommerce'),
    ),
    'merchant_auth_key' => array(
        'title' => __('Merchant Auth Key', 'woocommerce'),
        'type' => 'text',
        'desc_tip' => true,
        'description' => __('This is the merchant\'s auth key.', 'woocommerce'),
    ),
);
