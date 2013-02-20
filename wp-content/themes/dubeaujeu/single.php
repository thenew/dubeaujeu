<?php if(isset($_GET['ajax']) && $_GET['ajax'] == "1" && isset($_GET['mode']) && $_GET['mode'] == "heart" ) {
    if(get_post_meta( get_the_ID(), '_heart_like', true )) {
        $old_value = (int) get_post_meta( get_the_ID(), '_heart_like', true );
        $new_value = $old_value + 1;
    } else {
        $new_value = 1;
    }
    update_post_meta( get_the_ID(), '_heart_like', $new_value );
} ?>
<div id="content">
    <div class="single">
        <img src="<?php echo $post->guid ?>" alt="" />
    </div>
</div>