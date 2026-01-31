<?php if (!defined('ABSPATH')) exit; ?>

<?php do_action('woocommerce_email_header', $email_heading, $email); ?>
<div>
    <p style="text-align: center;">Congratulations! 🎉</p>

    <p style="text-align: center;">You’ve earned a referral reward coupon.</p>

    <h2 style="text-align:center;color:red">
        <?php echo esc_html($coupon_code); ?>
    </h2>

    <p style="text-align: center; color:red">This coupon can be used <strong>once only</strong>.</p>

    <p style="text-align: center;">Thank you for referring customers!</p>
    <div style="color:#1d1d1d;font-family:Helvetica,Roboto,Arial,sans-serif">
        <p style="font-size:14px;margin:0px 0px 16px;text-align:center; text-align:center"><span style="font-size:30px">C E L E S T E E</span></p>
    </div>
</div>


<?php do_action('woocommerce_email_footer', $email); ?>