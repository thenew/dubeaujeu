<?php
require_once(get_template_directory().'/fon/core/bootstrap.php');

// add_action('init', 'wip_redirect');
function wip_redirect() {
    if( ! is_admin() && strstr($_SERVER['REQUEST_URI'] , 'wp-admin') === FALSE && strstr($_SERVER['REQUEST_URI'] , 'wp-login') === FALSE && strstr($_SERVER['REQUEST_URI'] , 'art/illustrations') === FALSE) {
        wp_redirect( '/art/illustrations/' );
        die;
    }
}