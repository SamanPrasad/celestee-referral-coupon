<?php if (!defined('ABSPATH')) exit; ?>

<?php do_action('woocommerce_email_header', $email_heading, $email); ?>

<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">

            <p>Congratulations! 🎉</p>

            <p>You’ve earned a referral reward coupon.</p>

            <h2 style="color:red; margin:16px 0; text-align:center;">
                <?php echo esc_html($coupon_code); ?>
            </h2>

            <p style="color:red;">
                This coupon can be used <strong>once only</strong>.
            </p>

            <p>Thank you for referring customers!</p>

            <p style="font-family:Helvetica,Roboto,Arial,sans-serif; font-size:14px; margin-top:24px;">
                <span style="font-size:30px;">C E L E S T E E</span>
            </p>

        </td>
    </tr>
</table>

<?php do_action('woocommerce_email_footer', $email); ?>