<?php
get_header();
the_post();
$post_id = get_the_id();
$parent_id = $post->post_parent;
?>
<div class="content-single-attachment">
    <?php if ( wp_attachment_is_image( $post_id ) ) :
        $att_image = wp_get_attachment_image_src( $post_id, "full"); ?>
        <div class="attachment">
            <img class="js-toggle-zoom" src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php $post->post_excerpt; ?>" />
        </div>
        <?php
        $att_args = array(
            'formats' => 'thumbnail',
            'exclude_ids' => $post_id
        );
        $attachments = fon_get_attachments($parent_id, $att_args);
        if ( ! empty( $attachments ) ) : ?>
            <div class="attachments-list horizontal cf">
                <?php foreach ($attachments as $attachment) : ?>
                    <a href="<?php echo get_permalink( $attachment['id'] ); ?>" class="item"><img src="<?php echo $attachment['thumbnail']['src']; ?>" alt="<?php echo $attachment['alt']; ?>" /></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <a href="<?php echo wp_get_attachment_url($post_id) ?>" title="<?php echo wp_specialchars( get_the_title($post_id), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
    <?php endif; ?>
</div>
<?php
get_footer();