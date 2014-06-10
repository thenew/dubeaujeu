    </div><!-- .main -->
    <footer class="footer">
        <a href="<?php echo get_page_link( fon_get_post_by_postname('a-propos') ); ?>">?</a>
    </footer>

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