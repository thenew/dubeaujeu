<?php
wp_redirect(site_url());
die;
// get_header();
/*$q_args = array(
    'post_type'      => 'attachment',
    'post_status'    => 'any',
    'orderby'        => 'rand',
    'posts_per_page' => 400
);
$q_query = new WP_Query($q_args);
if($q_query->have_posts()): ?>
    <div class="cf mosaic">
        <?php while($q_query->have_posts()):$q_query->the_post();
            $size = "thumbnail";
            $thumb = wp_get_attachment_image_src(get_the_ID(),$size);
            $thumb = $thumb[0];
            ?>
            <div class="photo"><img src="<?php echo $thumb ?>" alt="<?php the_title_attribute(); ?>" /></div>
        <?php endwhile; ?>
        <div class="overlay"></div>
    </div>
    <h1 class="title">
        <i class="a"></i>
        <i class="b"></i>
        <i class="c"></i>
        <i class="d"></i>
        <i class="e"></i>
        <i class="e2"></i>
        <i class="f"></i>
        <i class="g"></i>
        <i class="h"></i>
        <i class="i"></i>
        <i class="j"></i>
        <i class="k"></i>
        <i class="l"></i>
        <i class="m"></i>
        <i class="n"></i>
        <i class="o"></i>
        <i class="p"></i>
        <i class="q"></i>
        <i class="r"></i>
        <i class="r2"></i>
    </h1>
<?php endif; ?>
<?php wp_reset_postdata();*/
get_footer();
