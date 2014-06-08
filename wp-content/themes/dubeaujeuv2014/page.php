<?php
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_header();
the_post();
?>

<div id="content">
    <div class="page-wrap">
        <h1 class="page-title"><?php the_title(); ?></h1>
        <div class="post-content"><?php the_content(); ?></div>
    </div>
</div>

<?php if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_footer();
