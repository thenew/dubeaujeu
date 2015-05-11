<!doctype html>
<html <?php language_attributes(); ?> class="no-js" dir="ltr">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo ASSETS_URL ?>/img/app-icons/favicon<?php if(WP_DEBUG) echo '-debug'; ?>.png" />
    <link rel="icon" sizes="114x114" href="<?php echo ASSETS_URL ?>/img/app-icons/icon-114.png" />
    <link rel="icon" sizes="512x512" href="<?php echo ASSETS_URL ?>/img/app-icons/icon-512.png" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS_URL ?>/img/app-icons/icon-512.png">
    <meta name="theme-color" content="#ffffff">
    <?php // include TEMPLATEPATH . '/tpl/metas/tpl_metas.php'; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
