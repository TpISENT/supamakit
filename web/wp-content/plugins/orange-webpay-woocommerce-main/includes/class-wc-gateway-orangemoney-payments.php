<?php
if (!defined('ABSPATH')) {
    exit;
}

function pay()
{
    $order = wc_get_order($_GET['order_id']);

    $json_post = json_decode(file_get_contents('php://input'), true);

    $order->update_meta_data('payment_status', $json_post['status']);
    if ($json_post['status'] === 'SUCCESS' && $order->get_meta('notif_token') === $json_post['notif_token']) {
        $order->update_meta_data('txnid', $json_post['txnid']);
        $order->payment_complete();
    } else {
        $order->set_status('failed');
    }
    $order->save();

    exit;
}

add_action('woocommerce_api_orange_money_webpay/confirm_payment', 'pay');

function return_from_payment()
{
    $order = wc_get_order($_GET['order_id']);
    if ($order->get_status() === 'pending') {
        wp_redirect($order->get_cancel_order_url_raw());
    } elseif ($order->get_status() === 'on-hold' || $order->get_status() === 'processing' || $order->get_status() === 'completed') {
        wp_redirect($order->get_checkout_order_received_url());
    } else {
        wp_redirect(get_home_url());
    }

    exit;
}

add_action('woocommerce_api_orange_money_webpay/return_from_payment', 'return_from_payment');

class WC_Gateway_OM extends WC_Payment_Gateway
{

    /** @var bool Whether or not logging is enabled */
    public static $log_enabled = false;

    /** @var WC_Logger Logger instance */
    public static $log = false;

    /**
     * Constructor for the gateway.
     */
    public function __construct()
    {
        $this->id = 'orangemoneywebpay';
        $this->has_fields = false;
        $this->order_button_text = __('Pay with Orange Money WebPay', 'woocommerce');
        $this->method_title = __('Orange Money WebPay', 'woocommerce');
        $this->method_description = sprintf(__('votre paiement en ligne en toute s&eacute;curit&eacute; avec Orange Money', 'woocommerce'), admin_url('admin.php?page=wc-status'));
        $this->supports = array(
            'products',
            'refunds',
        );
        $this->form_fields = include 'settings-orangemoney.php';
        $this->init_settings();
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');
        $this->merchant_name = $this->get_option('name');
        $this->merchant_key = $this->get_option('merchant_key');
        $this->merchant_auth_key = $this->get_option('merchant_auth_key');
        $this->payment_url = $this->get_option('payment_url');
        $this->currency = $this->get_option('test_mode') === 'no' ? get_woocommerce_currency() : 'OUV';
        $this->debug = 'yes' === $this->get_option('test_mode', 'no');

        self::$log_enabled = $this->debug;

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

    }

    /**
     * Logging method.
     *
     * @param string $message Log message.
     * @param string $level   Optional. Default 'info'.
     *     emergency|alert|critical|error|warning|notice|info|debug
     */
    public static function log($message, $level = 'info')
    {
        if (self::$log_enabled) {
            if (empty(self::$log)) {
                self::$log = wc_get_logger();
            }
            self::$log->log($level, $message, array('source' => 'orangemoney'));
        }
    }

    public function get_icon()
    {
        $icon_html = '';
        $icon = apply_filters('woocommerce_orangemoneywebpay_icon', plugin_dir_url(__FILE__) . '../assets/images/orange-money.png');

        $icon_html .= '<img src="' . esc_attr($icon) . '" alt="' . esc_attr__('Orange Money WebPay Logo', 'woocommerce') . '" />';

        return apply_filters('woocommerce_gateway_icon', $icon_html, $this->id);
    }

    public function process_payment($order_id)
    {
        $response = wp_remote_post('https://api.orange.com/oauth/v2/token', array(
            'body' => array(
                'grant_type' => 'client_credentials',
            ),
            'headers' => array(
                'Authorization' => 'Basic ' . $this->merchant_auth_key,
            ),
        ));

        $order = wc_get_order($order_id);

        $pay_response = wp_remote_post($this->payment_url, array(
            'body' => json_encode(array(
                "merchant_key" => $this->merchant_key,
                "currency" => $this->currency,
                "order_id" => strval($order_id),
                "amount" => $order->get_total(),
                "return_url" => WC()->api_request_url('orange_money_webpay/return_from_payment') . '?order_id=' . $order_id,
                "cancel_url" => $order->get_cancel_order_url(),
                "notif_url" => WC()->api_request_url('orange_money_webpay/confirm_payment') . '?order_id=' . $order_id,
                "lang" => "en",
                "reference" => $this->merchant_name,
            )),
            'headers' => array(
                'Authorization' => 'Bearer ' . json_decode($response['body'])->access_token,
                'Content-Type' => 'application/json',
            ),
        ));

        $order->update_meta_data('pay_token', json_decode($pay_response['body'])->pay_token);
        $order->update_meta_data('notif_token', json_decode($pay_response['body'])->notif_token);
        $order->save();

        return array(
            'result' => 'success',
            'redirect' => json_decode($pay_response['body'])->payment_url,
        );
    }

    public function can_refund_order($order)
    {
        return false;
    }
}
