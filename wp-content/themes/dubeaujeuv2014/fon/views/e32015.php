<?php

// CSS

function fon_styles_e32015() {
    wp_enqueue_style( 'e32015', ASSETS_URL.'/css/pages/e32015.css' );
}
add_action( 'wp_enqueue_scripts', 'fon_styles_e32015' );

// VIEW

get_header();
?>
<div class="e32015-page">
    <div class="logo-box">
        <?php require_once TEMPLATEPATH.'/assets/img/e32015/logo.svg'; ?>
    </div>
</div>

<script>

jQuery(window).load(function(e){

    var svg = jQuery('svg');

    svg.each(function(i, el) {

        var paths = jQuery(el).find('path:not(defs path)');

        // For each path, set the stroke-dasharray and stroke-dashoffset
        // equal to the path's total length, hence rendering it invisible
        paths.each(function(i, e) {
            e.style.strokeDasharray = e.style.strokeDashoffset = e.getTotalLength();
        });

        // Add each separate line animation to the timeline, animating the
        // stroke-dashoffset to 0. Use the duration, delay and easing to
        // achieve the perfect animation.
        setTimeout(function() {

              // .to(paths.eq(1), 0.15, {strokeDashoffset: 0}, "+=.15")
            tl = new TimelineMax(),
            tl.to(paths.eq(0), 0.1, {strokeDashoffset: 0})
              .to(paths.eq(1), 0.1, {strokeDashoffset: 0}, "+=.05")
              .to(paths.eq(2), 0.1, {strokeDashoffset: 0}, "+=.05")
              .to(paths.eq(3), 0.1, {strokeDashoffset: 0}, "+=.05")
              .to(paths.eq(4), 0.2, {strokeDashoffset: 0}, "+=.25")
              .to(paths.eq(5), 0.3, {strokeDashoffset: 0})
              .to(paths.eq(6), 0.2, {strokeDashoffset: 0}, "+=.25")
              .to(paths.eq(7), 0.15, {strokeDashoffset: 0})
              .to(paths.eq(8), 0.15, {strokeDashoffset: 0})
              .to(paths.eq(9), 0.15, {strokeDashoffset: 0})
              .to(paths.eq(10), 0.15, {strokeDashoffset: 0})
              ;

        }, 500);

    });

});
</script>
<?php

get_footer();