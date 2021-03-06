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

    <?php if(FONDATIONS_BOOTSTRAP): ?>
        <link rel="stylesheet" href="<?php echo BOOTSTRAP_URL; ?>/docs/assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo BOOTSTRAP_URL; ?>/docs/assets/css/bootstrap-responsive.css">
    <?php endif; ?>
    <?php if(FONDATIONS_CSSNORMALIZE): ?>
        <link rel="stylesheet" href="<?php echo TEMPLATE_URL ?>/lib/cssnormalize.php">
    <?php endif; ?>
    <?php // CSS
    if(WP_DEBUG) { ?>
        <link rel="stylesheet" href="<?php echo TEMPLATE_URL ?>/style.php" />
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo TEMPLATE_URL ?>/fon_min.css" />
    <?php } ?>
    <link rel="icon" href="<?php echo ASSETS_URL ?>/img/app-icons/favicon.png" />
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
    <header id="home" class="header">
        <h1 class="logo">Du Beau Jeu</h1><a class="popin-trigger about-btn" href="<?php echo site_url( '/about' ); ?>" >✳</a>
    </header>
    <div id="main" class="main">