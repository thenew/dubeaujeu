<?php
require_once(get_template_directory().'/fon/core/bootstrap.php');

add_action('template_redirect', 'wip_redirect');
function wip_redirect() {
    // && ! is_singular( 'game' )
    if( ! is_admin() && ! is_attachment() && strstr($_SERVER['REQUEST_URI'] , 'wp-admin') === FALSE && strstr($_SERVER['REQUEST_URI'] , 'wp-login') === FALSE && strstr($_SERVER['REQUEST_URI'] , 'art') === FALSE) {
        wp_redirect( '/art/illustrations/' );
        die;
    }
}
