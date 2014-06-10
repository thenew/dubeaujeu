<?php
global $paged;
$paged = (isset($_GET['page'])) ? $_GET['page'] : $paged;

if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_header();

$artworks_args = array(
    'post_type' => 'attachment',
    'post_status' => 'any',
    'tax_query' => array(
        array(
            'taxonomy' => 'attachment_tag',
            'field' => 'slug',
            'terms' => 'art'
        )
    ),
    'paged' => $paged
);
$artworks_query = new WP_Query($artworks_args);
$wides = 0;

if(!isset($_GET['ajax']) || $_GET['ajax'] != "1"): ?>
    <div id="js-illustrations-page" class="cf" data-liffect="zoomIn" data-paged="<?php echo $paged; ?>">
        <div class="boxes">
<?php endif;

    while($artworks_query->have_posts()): $artworks_query->the_post(); global $post;

        $img = wp_get_attachment_image_src( get_the_ID(), 'full' );
        $ratio = $img[1] / $img[2];
        // $is_wide = ($wides < 2 && $ratio > 1.9 && $img[1] > 660) ? true : false;
        $is_wide = false;
        if($is_wide) $wides++;
        $size = ($is_wide) ? 'medium' : 'thumbnail';
        $thumb = wp_get_attachment_image_src(get_the_ID(),$size);
        $thumb = $thumb[0];

        if($post->post_parent) {
            $game_title = get_the_title($post->post_parent);
            $game_link = get_permalink( $post->post_parent );

            if($game_title != get_the_title())
                $title_alt = $game_title.' ✳ '.get_the_title();
            else
                $title_alt = $game_title;
        } else {
            $game_title = '';
            $title_alt = $game_title;
        }
        $title_alt = strip_tags($title_alt);
        $title_alt = esc_attr($title_alt);

        ?>
        <div class="box">
            <div class="el">
                <a href="<?php the_permalink(); ?>" target="_blank">
                    <img src="<?php echo $thumb; ?>" alt="artwork <?php echo $title_alt; ?>" />
                </a>
            </div>
            <?php if(!empty($game_title)): ?>
                <div class="caption">
                    <span class="post-title"><a href="<?php echo $game_link; ?>"><?php echo $game_title; ?></a></span>
                </div>
            <?php endif; ?>
        </div>
        <?php

    endwhile;

if(!isset($_GET['ajax']) || $_GET['ajax'] != "1"): ?>
    </div>
</div>
<div id="main-loader">Loading</div>
<?php
endif;
wp_reset_postdata();
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_footer();