<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

Congratulations!

Your referral coupon code is:

<?php echo esc_html($coupon_code ?? ''); ?>

This coupon can be used once only.