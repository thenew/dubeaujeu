<?php
if(!isset($_GET['ajax']) && $_GET['ajax'] != "1")
    get_header();

$paged = (isset($_GET['page'])) ? $_GET['page'] : $paged;

$args = array(
    'post_type'      => 'attachment',
    'post_status'    => 'any',
    'orderby'        => 'rand'
    'paged'          => $paged
);
query_posts($args);
$wides = 0;
if(!isset($_GET['ajax']) && $_GET['ajax'] != "1"): ?>
    <div id="du-beau-jeu" class="cf" data-liffect="slideTop" data-paged="<?php echo $paged; ?>">
<?php
endif;
    while (have_posts()) : the_post();
        $img = wp_get_attachment_image_src(get_the_ID(), "full");
        $ratio = $img[1]/$img[2];
        $is_wide = (($wides/$query_posts->found_posts < 0.8) && $ratio > 1.9 && $img[1] > 660) ? true : false;
        if($is_wide) $wides++;
        $size = ($is_wide) ? "medium" : "thumbnail";
        $thumb = wp_get_attachment_image_src(get_the_ID(),$size);
        $thumb = $thumb[0];
        ?>
        <div class="box">
            <img class="li" src="<?php echo $thumb; ?>" alt="" />
        </div>
    <?php endwhile;
if(!isset($_GET['ajax']) && $_GET['ajax'] != "1"): ?>
</div>
<?php
endif;
wp_reset_query();
if(!isset($_GET['ajax']) && $_GET['ajax'] != "1")
    get_footer();
