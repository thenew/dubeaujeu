<?php
get_header();
the_post();
$post_id = get_the_id();

$attachment_bg = fon_get_attachments($post_id, array('formats' => 'full', 'attachment_tag' => 'bg'));
if( ! empty($attachment_bg) ) {
    $attachment_bg = $attachment_bg[array_rand($attachment_bg)];
    $attachment_bg_src = $attachment_bg['full']['src'];
}

$attachment_logo = fon_get_attachments($post_id, array('formats' => 'large', 'attachment_tag' => 'logo'));
if( ! empty($attachment_logo) ) {
    $attachment_logo = current($attachment_logo);
    $attachment_logo_src = $attachment_logo['large']['src'];
}
?>
<div class="content-single-game">
    <?php if( isset($attachment_bg_src) ): ?>
        <div class="bg" style="background-image: url(<?php echo $attachment_bg_src; ?>);"></div>
    <?php endif; ?>
    <?php if( isset($attachment_logo_src) ): ?>
        <div class="logo"><img src="<?php echo $attachment_logo_src; ?>" alt="Logo <?php the_title(); ?>" /></div>
    <?php else: ?>
    <div class="game-title"><?php the_title(); ?></div>
    <?php endif; ?>
</div>
<?php
get_footer();