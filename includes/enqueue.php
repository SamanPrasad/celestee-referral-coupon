<?php

if (!defined('ABSPATH')) {
    exit;
}

function referral_enqueue_assets()
{
    // Load Poppins from Google Fonts (all weights)
    wp_enqueue_style('referral-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null);

    // Load Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');

    wp_enqueue_style('referral-styles', REFERRAL_PLUGIN_URL . 'assets/css/referral.css');

    wp_enqueue_style('dashicons');

    wp_enqueue_script('referral-script', REFERRAL_PLUGIN_URL . 'assets/js/referral.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'referral_enqueue_assets');
