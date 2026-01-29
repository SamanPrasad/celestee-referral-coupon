<?php

/* ---------------------------------------------------------
 * 2. Save referrer on user registration
 * --------------------------------------------------------- */
add_action('user_register', function ($user_id) {
    if (isset($_COOKIE['woo_referrer'])) {
        $referrer = intval($_COOKIE['woo_referrer']);

        if ($referrer !== $user_id) {
            update_user_meta($user_id, '_woo_referrer', $referrer);
        }
    }
});
