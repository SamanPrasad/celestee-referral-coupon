<?php
if (!defined('ABSPATH')) exit;

class CRC_Referral_Email extends WC_Email
{
    protected string $coupon_code = '';

    public function __construct()
    {

        $this->id             = 'crc_referral_email';
        $this->title          = 'CELESTEE Referral Reward Email';
        $this->description    = 'Email sent when a referral coupon is earned';

        $this->heading        = 'You earned a referral reward!';
        $this->subject        = 'CELESTEE Referral Coupon';

        $this->template_html  = 'emails/crc-referral-email.php';
        $this->template_plain = 'emails/plain/crc-referral-email.php';

        $this->template_base  = REFERRAL_PLUGIN_PATH . 'templates/';

        parent::__construct();

        $this->recipient = '';
    }

    /**
     * Trigger email
     */
    public function trigger($email, $coupon_code)
    {

        $this->recipient = $email;

        $this->coupon_code = $coupon_code;

        if (!$this->is_enabled() || !$this->get_recipient()) {
            return;
        }

        $this->send(
            $this->get_recipient(),
            $this->get_subject(),
            $this->get_content(),
            $this->get_headers(),
            $this->get_attachments()
        );
    }

    public function get_content_html()
    {
        return wc_get_template_html(
            $this->template_html,
            [
                'email_heading' => $this->get_heading(),
                'coupon_code'   => $this->coupon_code,
                'email'         => $this,
            ],
            '',
            $this->template_base
        );
    }

    public function get_content_plain()
    {
        return wc_get_template_html(
            $this->template_plain,
            [
                'coupon_code' => $this->coupon_code,
            ],
            '',
            $this->template_base
        );
    }
}
