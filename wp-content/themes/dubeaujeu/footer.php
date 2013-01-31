    </div><!-- .main -->
    <footer>
    </footer>

    <!--[if lte IE 8]>
        <script type="text/javascript" src="<?php echo ASSETS_URL; ?>/js/selectivizr.js"></script>
    <![endif]-->
    <?php if(!WP_DEBUG && !is_preview()): ?>
        <script>
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-164644-13']);
            _gaq.push(['_trackPageview']);

            (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    <?php endif; ?>
    <?php wp_footer(); ?>
</body>
</html>