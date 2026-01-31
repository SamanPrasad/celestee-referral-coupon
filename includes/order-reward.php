<?php

/* ---------------------------------------------------------
 * Reward referrer on first completed order
 * --------------------------------------------------------- */
add_action('woocommerce_order_status_completed', function ($order_id) {

    $order = wc_get_order($order_id);
    if (!$order) return;

    $user_id = $order->get_user_id();
    if (!$user_id) return;

    // Only first order
    if (wc_get_customer_order_count($user_id) > 1) return;

    // Prevent duplicate processing
    if (get_post_meta($order_id, 'celestee_referral_processed', true)) return;

    $referrer_id = get_user_meta($user_id, 'celestee_referrer', true);
    if (!$referrer_id || $referrer_id == $user_id) return;

    // Prevent multiple rewards for same user
    if (get_user_meta($referrer_id, 'celestee_referral_coupon_received', true)) return;

    $coupon_code = 'REF-' . strtoupper(wp_generate_password(8, false));

    $coupon = new WC_Coupon();
    $coupon->set_code($coupon_code);
    $coupon->set_discount_type('percent');
    $coupon->set_amount(20);
    $coupon->set_usage_limit(1);
    $coupon->set_individual_use(true);
    $coupon->set_date_expires(strtotime('+30 days'));
    $coupon->set_email_restrictions(array(
        get_userdata($referrer_id)->user_email
    ));
    $coupon->set_description('Referral reward coupon');
    $coupon->save();

    // Store coupon under referrer
    update_user_meta($referrer_id, 'celestee_referral_coupon', $coupon_code);

    // Email coupon
    WC()->mailer()->emails['CRC_Referral_Email']
        ->trigger(
            get_userdata($referrer_id)->user_email,
            $coupon_code
        );


    update_post_meta($order_id, 'celestee_referral_processed', true);
    update_user_meta($referrer_id, 'celestee_referral_coupon_received', true);
});
