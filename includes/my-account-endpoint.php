<?php

/* ---------------------------------------------------------
 * My Account menu item
 * --------------------------------------------------------- */
add_filter('woocommerce_account_menu_items', function ($items) {
    $items['referral-coupons'] = 'Referral Coupons';
    return $items;
});

/* ---------------------------------------------------------
 * Endpoint
 * --------------------------------------------------------- */
add_action('init', function () {
    add_rewrite_endpoint('referral-coupons', EP_ROOT | EP_PAGES);
});

/* ---------------------------------------------------------
 * Endpoint content
 * --------------------------------------------------------- */
add_action('woocommerce_account_referral-coupons_endpoint', function () {

    if (!is_user_logged_in()) return;

    $user_id = get_current_user_id();
    $ref_link = home_url('/?ref=' . $user_id);
    $coupons = get_user_meta($user_id, 'celestee_referral_coupon');

?>
    <h3>Your Referral Link</h3>
    <div>
        <p id="referralWrapper" style="display:flex; align-items:center; gap:8px; margin-bottom:10px;">
            <span id="referralLink"><?php echo esc_attr($ref_link); ?></span>
            <span id="copyReferralIcon"
                class="dashicons dashicons-admin-page"
                style="cursor:pointer; font-size:20px;"
                title="Copy referral link"></span>
        </p>
        <div id="socialShareWrapper" style="display:flex; gap:8px; margin-bottom:15px;">
            <a id="shareWhatsApp"
                href="#"
                target="_blank"
                rel="noopener noreferrer"
                style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; background-color:#25D366; color:white; border-radius:50%; text-decoration:none; font-size:20px;"
                title="Share on WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a id="shareFacebook"
                href="#"
                target="_blank"
                rel="noopener noreferrer"
                style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; background-color:#1877F2; color:white; border-radius:50%; text-decoration:none; font-size:20px;"
                title="Share on Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a id="shareX"
                href="#"
                target="_blank"
                rel="noopener noreferrer"
                style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; background-color:#000000; color:white; border-radius:50%; text-decoration:none; font-size:20px;"
                title="Share on X">
                <i class="fab fa-twitter"></i>
            </a>
            <a id="shareMessenger"
                href="#"
                target="_blank"
                rel="noopener noreferrer"
                style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; background-color:#0084FF; color:white; border-radius:50%; text-decoration:none; font-size:20px;"
                title="Share on Messenger">
                <i class="fab fa-facebook-messenger"></i>
            </a>
        </div>
    </div>

    <hr style="margin:50px 0px;background-color:#9c9c9c">

    <h3>Your Referral Coupon Codes</h3>

    <?php if ($coupons): ?>
        <?php
        // Check if coupon has been used
        $coupon_used = false;
        foreach ($coupons as $code) {
            $coupon = new WC_Coupon($code);
            if ($coupon->get_id() && $coupon->get_usage_count() > 0) {
                $coupon_used = true;
                break;
            }
        }
        ?>
        <?php if ($coupon_used): ?>
            <p style="font-size:17px;">You've used your earned coupon</p>
        <?php else: ?>
            <table class="shop_table shop_table_responsive">
                <thead>
                    <tr>
                        <th>Coupon Code</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($coupons as $code): ?>
                        <tr>
                            <td class="coupon-code-cell">
                                <span class="coupon-code"><?php echo esc_html($code); ?></span>
                                <span class="copy-coupon-icon dashicons dashicons-admin-page"
                                    style="cursor:pointer; font-size:20px; margin-left:10px;"
                                    title="Copy coupon code"></span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php else: ?>
        <p style="font-size:17px;">No referral coupons earned yet.</p>
    <?php endif; ?>
<?php
});
