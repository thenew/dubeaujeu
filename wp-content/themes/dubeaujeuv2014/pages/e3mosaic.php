<?php /* Template Name: E3 2015 mosaic */

// CSS

function fon_styles_e32015mosaic() {
    wp_enqueue_style( 'photoswipe', ASSETS_URL.'/css/vendor/photoswipe.css' );
    wp_enqueue_style( 'photoswipe-default-skin', ASSETS_URL.'/css/vendor/default-skin/default-skin.css' );
    wp_enqueue_style( 'e32015mosaic', ASSETS_URL.'/css/pages/e32015mosaic.css' );
}
add_action( 'wp_enqueue_scripts', 'fon_styles_e32015mosaic' );

function fon_scripts_e32015mosaic() {
    wp_enqueue_script( 'packery', ASSETS_URL.'/js/vendor/packery.pkgd.min.js', '', '1.4.1', true );
    wp_enqueue_script( 'photoswipe', ASSETS_URL.'/js/vendor/photoswipe.min.js', '', '1.0', true );
    wp_enqueue_script( 'photoswipe-ui', ASSETS_URL.'/js/vendor/photoswipe-ui-default.min.js', '', '1.0', true );
    wp_enqueue_script( 'e32015mosaic', ASSETS_URL.'/js/pages/e32015mosaic.js', '', '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'fon_scripts_e32015mosaic' );

// VIEW

get_header();
the_post();
?>
<div class="e3mosaic-page">
    <!-- <div class="bg anim-tilt-reverse"></div> -->

    <?php
    if( have_rows('items') ): ?>
        <div class="bricks js-hidden">
            <?php while ( have_rows('items') ) : the_row();
                $title = get_sub_field('title');
                $thumbnail = get_sub_field('thumbnail');
                $intro = get_sub_field('intro');
                $video = get_sub_field('video');
                $images = get_sub_field('images');
                $format = get_sub_field('format');
                ?>
                <div class="brick-item format-<?php echo $format ?> anim-item anim-tilt">
                    <div class="brick-outer">
                    <div class="brick-inner <?php if( ! empty($images) ) echo 'pswp-gallery'; ?>">
                        <div class="bg" style="background-image: url(<?php echo $thumbnail['sizes']['large']; ?>);"></div>
                        <div class="overlay"></div>
                        <div class="title"><?php echo $title; ?></div>
                        <div class="pswp-trigger">
                            <?php if( ! empty( $intro ) ): ?>
                                <div class="html">
                                    <?php echo $intro; ?>
                                </div>
                            <?php endif; ?>
                            <?php if( ! empty( $video ) ): ?>
                                <div class="html">
                                    <div class="video-outer">
                                    <div class="video-inner">
                                        <?php echo $video; ?>
                                    </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $images ): ?>
                                <?php foreach( $images as $image ): ?>
                                    <a href="<?php echo $image['url']; ?>" class="pswp-item" data-size="<?php echo $image['width']; ?>x<?php echo $image['height']; ?>">
                                        <?php /* ?><img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" hidden />
                                        <p hidden><?php echo $image['caption']; ?></p> --><?php */ ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <div class="brick-item format-43pct stamp brick-logo">
                <div class="brick-outer">
                <div class="brick-inner">
                    <div class="logo-box">
                        <?php require_once TEMPLATEPATH.'/assets/img/e32015/logo.svg'; ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe.
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>

<?php
get_footer();