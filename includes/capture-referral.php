<?php

/* ---------------------------------------------------------
 * 1. Capture referral in cookie
 * --------------------------------------------------------- */

add_action('init', function () {
    if (isset($_GET['ref']) && is_numeric($_GET['ref'])) {
        if (!isset($_COOKIE['woo_referrer'])) {
            setcookie(
                'woo_referrer',
                intval($_GET['ref']),
                time() + 30 * DAY_IN_SECONDS,
                COOKIEPATH,
                COOKIE_DOMAIN
            );
        }
    }
});
