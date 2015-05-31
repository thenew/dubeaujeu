<?php // Chargement des JS
add_action('wp_enqueue_scripts', 'fon_script_init');
function fon_script_init() {
    if (!is_admin()){
        // wp_enqueue_script('mootools',ASSETS_URL.'/js/lib/mootools-core-1.4.5-full-compat-yc.js','','1.4.5',false);
        // wp_enqueue_script('mootoolsmore',ASSETS_URL.'/js/lib/mootools-more-1.4.0.1.js','','1.4.0.1',false);
        // wp_enqueue_script('modernizr',ASSETS_URL.'/js/lib/modernizr-1.7.min.js','','1.7',false);
        // wp_enqueue_script('moomasonry',ASSETS_URL.'/js/mooMasonry.js','','1.0',false);
        // wp_enqueue_script('infinitescroll',ASSETS_URL.'/js/InfiniteScroll.js','','1.0',false);
        // wp_enqueue_script('fonpopin',ASSETS_URL.'/js/FonPopin.js','','1.0',false);
        // wp_enqueue_script('jquery');
        wp_deregister_script( 'jquery' );
        wp_enqueue_script('modernizr',ASSETS_URL.'/js/vendor/modernizr.js','','1.7',false);
        wp_enqueue_script('jquery',ASSETS_URL.'/js/vendor/jquery.js','','1.11.2',true);
        // wp_enqueue_script('TimelineMax',ASSETS_URL.'/js/greensock/TimelineMax.js','','1.16.1',true);
        wp_enqueue_script('TweenMax',ASSETS_URL.'/js/greensock/TweenMax.js','','1.16.1',true);
        wp_enqueue_script('DrawSVGPlugin',ASSETS_URL.'/js/greensock/plugins/DrawSVGPlugin.js','','0.0.4',true);
        // wp_enqueue_script('ColorPropsPlugin',ASSETS_URL.'/js/greensock/plugins/ColorPropsPlugin.js','','1.3.0',true);
        wp_enqueue_script('functions',ASSETS_URL.'/js/functions.js','','1.0',true);
        wp_enqueue_script('scripts',ASSETS_URL.'/js/scripts.js','','1.0',true);
    }
    // Admin
    else {
        // wp_deregister_script( 'jquery' ); // unregistered key jQuery
        // wp_enqueue_script('jquery',ASSETS_URL.'/js/lib/jquery-1.7.1.min.js','','1.7.1',false);
    }
}
