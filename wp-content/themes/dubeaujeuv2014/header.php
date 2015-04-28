<!doctype html>
<html <?php language_attributes(); ?> class="no-js" dir="ltr">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?php echo ASSETS_URL ?>/img/app-icons/favicon<?php if(WP_DEBUG) echo '-debug'; ?>.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo ASSETS_URL ?>/img/app-icons/icon-144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo ASSETS_URL ?>/img/app-icons/icon-144.png" />
    <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL ?>/img/app-icons/startup.png">
    <link rel="logo" type="image/png" href="<?php echo ASSETS_URL ?>/img/app-icons/logo.png"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content=" black-translucent" />

    <?php // include TEMPLATEPATH . '/tpl/metas/tpl_metas.php'; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
