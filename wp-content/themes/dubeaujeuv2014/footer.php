    </div><!-- .main -->
    <footer class="footer">
        <a href="<?php echo get_page_link( fon_get_post_by_postname('a-propos') ); ?>">?</a>
    </footer>

    <?php if(!WP_DEBUG && !is_preview()): ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-164644-13', 'dubeauj.eu');
            ga('require', 'displayfeatures');
            ga('send', 'pageview');
        </script>
    <?php endif; ?>
    <?php wp_footer(); ?>
</body>
</html>
