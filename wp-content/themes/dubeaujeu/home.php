<?php get_header();
// $sizes = array("thumbnail", "medium");
$sizes = array("thumbnail");
$args = array(
    'post_type'      => 'attachment',
    'post_status'    => 'any',
    'posts_per_page' => -1
);
query_posts($args); ?>
<ul id="du-beau-jeu" class="cf" data-liffect="slideTop">
    <?php while (have_posts()) : the_post(); ?>
        <?php $img = wp_get_attachment_image_src(get_the_ID(),$sizes[rand(0,count($sizes)-1)]); ?>
        <li class="box">
            <img class="li" src="<?php echo $img[0]; ?>" alt="" />
        </li>
    <?php endwhile; ?>
</ul>
<?php
wp_reset_query();
get_footer();