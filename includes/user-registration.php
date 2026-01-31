<?php

/* ---------------------------------------------------------
 * Save referrer on user registration
 * --------------------------------------------------------- */
add_action('user_register', function ($user_id) {
    if (isset($_COOKIE['celestee_referrer'])) {
        $referrer = intval($_COOKIE['celestee_referrer']);

        if ($referrer !== $user_id) {
            update_user_meta($user_id, 'celestee_referrer', $referrer);
        }
    }
});
