<?php

/**
 * Plugin Name: Celestee Referral Coupons
 * Description: Referral system with first-purchase validation and personalized one-time coupons.
 * Version: 1.0.0
 * Author: Saman Prasad
 */

if (!defined('ABSPATH')) exit;

define('REFERRAL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('REFERRAL_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once REFERRAL_PLUGIN_PATH . 'includes/enqueue.php';
require_once REFERRAL_PLUGIN_PATH . 'includes/capture-referral.php';
require_once REFERRAL_PLUGIN_PATH . 'includes/user-registration.php';
require_once REFERRAL_PLUGIN_PATH . 'includes/order-reward.php';
require_once REFERRAL_PLUGIN_PATH . 'includes/my-account-endpoint.php';

add_filter('woocommerce_email_classes', function ($emails) {
    if (!class_exists('WC_Email')) {
        return $emails;
    }

    require_once REFERRAL_PLUGIN_PATH . 'includes/emails/class-crc-referral-email.php';
    $emails['CRC_Referral_Email'] = new CRC_Referral_Email();
    return $emails;
});

/* ---------------------------------------------------------
 * Expose plugin email templates to WooCommerce & YayMail
 * --------------------------------------------------------- */
// add_filter('woocommerce_locate_template', function ($template, $template_name, $template_path) {

//     // Only handle our referral email templates
//     if (strpos($template_name, 'crc-referral-email.php') === false) {
//         return $template;
//     }

//     $plugin_template = REFERRAL_PLUGIN_PATH . 'templates/' . $template_name;

//     if (file_exists($plugin_template)) {
//         return $plugin_template;
//     }

//     return $template;
// }, 10, 3);

/* ---------------------------------------------------------
 * Flush rewrite rules on activation
 * --------------------------------------------------------- */
register_activation_hook(__FILE__, function () {
    flush_rewrite_rules();
});

register_deactivation_hook(__FILE__, function () {
    flush_rewrite_rules();
});
