<?php
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_header();

$paged = (isset($_GET['page'])) ? $_GET['page'] : $paged;

$artworks_args = array(
    'post_type'      => 'attachment',
    'post_status'    => 'any',
    // 'orderby'        => 'rand',
    'paged'          => $paged
);

$artworks_query = new WP_Query($artworks_args);
$wides = 0;

if(!isset($_GET['ajax']) || $_GET['ajax'] != "1"): ?>
    <div id="du-beau-jeu" class="cf" data-liffect="zoomIn" data-paged="<?php echo $paged; ?>">
        <div class="boxes">
<?php endif;
    while($artworks_query->have_posts()):$artworks_query->the_post(); global $post;
        // If attach to a game
        if(!$post->post_parent || 'game' != get_post_type( $post->post_parent ) ) continue;

        $img = wp_get_attachment_image_src(get_the_ID(), "full");
        $ratio = $img[1]/$img[2];
        // $is_wide = ($wides < 2 && $ratio > 1.9 && $img[1] > 660) ? true : false;
        $is_wide = false;
        if($is_wide) $wides++;
        $size = ($is_wide) ? "medium" : "thumbnail";
        $thumb = wp_get_attachment_image_src(get_the_ID(),$size);
        $thumb = $thumb[0];

        if($post->post_parent) {
            $title = get_the_title($post->post_parent);

            if($title != get_the_title())
                $title_alt = $title.' ✳ '.get_the_title();
            else
                $title_alt = $title;
        } else {
            $title = get_the_title();
            $title_alt = $title;
        }
        $title_alt = strip_tags($title_alt);
        $title_alt = esc_attr($title_alt);
        ?>
        <div class="box">
            <div class="caption">
                <a class="heart" href="<?php the_permalink(); ?>"><span class="love">Love</span></a>
                <span class="post-title"><?php echo $title; ?></span>
            </div>
            <a class="popin-trigger el-link" href="<?php the_permalink(); ?>" data-bg="<?php echo $thumb; ?>">
                <div class="el">
                    <img class="" src="<?php echo $thumb; ?>" alt="artwork <?php echo $title_alt; ?>" />
                </div>
            </a>
        </div>
    <?php endwhile;
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1"): ?>
    </div>
</div>
<div id="main-loader">Loading</div>
<?php
endif;
wp_reset_postdata();
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_footer();
