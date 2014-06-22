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
            'terms' => 'hors-jeu'
        )
    ),
    'paged' => $paged
);
$artworks_query = new WP_Query($artworks_args);
$wides = 0;

require_once TEMPLATE_PATH . '/tpl/page/gallery.php';

wp_reset_postdata();
if(!isset($_GET['ajax']) || $_GET['ajax'] != "1")
    get_footer();