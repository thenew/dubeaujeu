<?php /* Template Name: E3 2015 */

// CSS

function fon_styles_e32015() { wp_enqueue_style( 'e32015', ASSETS_URL.'/css/pages/e32015.css' ); }
add_action( 'wp_enqueue_scripts', 'fon_styles_e32015' );

function fon_scripts_e32015() { wp_enqueue_script( 'e32015', ASSETS_URL.'/js/pages/e32015.js', '', '1.0', true ); }
add_action( 'wp_enqueue_scripts', 'fon_scripts_e32015' );

// VIEW

get_header();
?>
<div class="e32015-page">
    <div class="logo-box">
        <?php require_once TEMPLATEPATH.'/assets/img/e32015/logo.svg'; ?>
    </div>
</div>

<?php

get_footer();