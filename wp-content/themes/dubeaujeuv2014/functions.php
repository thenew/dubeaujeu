<?php
require_once(get_template_directory().'/fon/core/bootstrap.php');

add_action('init', 'wip_redirect');
function wip_redirect() {
    if( ! is_admin() && strstr($_SERVER['REQUEST_URI'] , 'illustrations') === FALSE) {
        wp_redirect( '/illustrations/' );
        die;
    }
}