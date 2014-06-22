<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6 lt_ie7 lt_ie8 lt_ie9 lt_ie10" <?php language_attributes(); ?> dir="ltr"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7 lt_ie8 lt_ie9 lt_ie10" <?php language_attributes(); ?> dir="ltr"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8 lt_ie9 lt_ie10" <?php language_attributes(); ?> dir="ltr"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9 lt_ie10" <?php language_attributes(); ?> dir="ltr"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js" dir="ltr"> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=690">

    <link rel="icon" href="<?php echo ASSETS_URL ?>/img/app-icons/favicon<?php if(WP_DEBUG) echo '-debug'; ?>.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo ASSETS_URL ?>/img/app-icons/icon-144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo ASSETS_URL ?>/img/app-icons/icon-144.png" />
    <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL ?>/img/app-icons/startup.png">
    <link rel="logo" type="image/png" href="<?php echo ASSETS_URL ?>/img/app-icons/logo.png"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content=" black-translucent" />

    <?php include TEMPLATEPATH . '/tpl/metas/tpl_metas.php'; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header">
        <div class="cf logo-box">
            <a href="<?php echo site_url(); ?>">
                <div class="logo"></div>
                <h1 class="site-title">Du Beau Jeu</h1>
            </a>
        </div>
        <div>
            <div class="menu"><ul class="cf">
                <li class="menu-item"><a href="" class="wip">Articles</a></li>
                <li class="menu-item"><a href="" class="wip">Jeux</a></li>
                <li class="menu-item"><a href="<?php echo site_url( '/art/illustrations/' ); ?>">Illustrations</a></li>
                <li class="menu-item"><a href="<?php echo site_url( '/art/videos/' ); ?>">Vidéos</a></li>
                <li class="menu-item"><a href="<?php echo site_url( '/art/hors-jeu/' ); ?>">Hors jeu</a></li>
            </ul></div>
        </div>
    </header>
    <div class="main">