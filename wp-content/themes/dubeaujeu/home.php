<?php
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_header();

$paged = (isset($_GET['page'])) ? $_GET['page'] : $paged;

$args = array(
    'post_type'      => 'attachment',
    'post_status'    => 'any',
    // 'orderby'        => 'rand',
    'paged'          => $paged
);
query_posts($args);
$wides = 0;

if(!isset($_GET['ajax']) || $_GET['ajax'] != "1"): ?>
    <div id="du-beau-jeu" class="cf" data-liffect="zoomIn" data-paged="<?php echo $paged; ?>">
        <div class="boxes">
<?php endif;
    while (have_posts()) : the_post();
        $img = wp_get_attachment_image_src(get_the_ID(), "full");
        $ratio = $img[1]/$img[2];
        $is_wide = ($wides < 2 && $ratio > 1.9 && $img[1] > 660) ? true : false;
        if($is_wide) $wides++;
        $size = ($is_wide) ? "medium" : "thumbnail";
        $thumb = wp_get_attachment_image_src(get_the_ID(),$size);
        $thumb = $thumb[0];

        if($post->post_parent)
            $title = get_the_title($post->post_parent);
        else
            $title = get_the_title();
        ?>
        <div class="box">
            <div class="caption"><a class="heart" href="<?php the_permalink(); ?>"></a><span class="post-title"><?php echo $title; ?></span></div>
            <a class="popin-trigger el-link" href="<?php the_permalink(); ?>">
                <img class="el" src="<?php echo $thumb; ?>" alt="" />
            </a>
        </div>
    <?php endwhile;
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1"): ?>
    </div>
</div>
<div id="main-loader">Loading</div>
<?php
endif;
wp_reset_query();
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_footer();
