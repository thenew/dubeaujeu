<?php /* Template Name: E3 2015 mosaic */

// CSS

function fon_styles_e32015mosaic() { wp_enqueue_style( 'e32015mosaic', ASSETS_URL.'/css/pages/e32015mosaic.css' ); }
add_action( 'wp_enqueue_scripts', 'fon_styles_e32015mosaic' );

function fon_scripts_e32015mosaic() { wp_enqueue_script( 'e32015mosaic', ASSETS_URL.'/js/pages/e32015mosaic.js', '', '1.0', true ); }
add_action( 'wp_enqueue_scripts', 'fon_scripts_e32015mosaic' );

// VIEW

get_header();
?>
<div class="e3mosaic-page">
    <div class="bg"></div>
    <div class="logo-box">
        <?php require_once TEMPLATEPATH.'/assets/img/e32015/logo.svg'; ?>
    </div>

    <div class="e32015-planning">
        <div class="items">
            <div class="item">
                <div class="title">Bethesda</div>
                <div class="infos">
                    <div class="hours">15 juin 3:30 (France)</div>
                    <a class="link" href="http://www.twitch.tv/bethesda" target="_blank">twitch.tv/bethesda</a>
                </div>
            </div>
            <div class="item">
                <div class="title">Microsoft</div>
                <div class="infos">
                    <div class="hours">15 juin 18:30 (France)</div>
                    <a class="link" href="http://www.xbox.com/fr-FR/E3" target="_blank">xbox.com/e3</a>
                </div>
            </div>
            <div class="item">
                <div class="title">Electronic Arts</div>
                <div class="infos">
                    <div class="hours">15 juin 22:00 (France)</div>
                </div>
            </div>
            <div class="item">
                <div class="title">Ubisoft</div>
                <div class="infos">
                    <div class="hours">16 juin 00:00 (France)</div>
                </div>
            </div>
            <div class="item">
                <div class="title">Sony</div>
                <div class="infos">
                    <div class="hours">16 juin 03:00 (France)</div>
                </div>
            </div>
            <div class="item">
                <div class="title">Nintendo</div>
                <div class="infos">
                    <div class="hours">16 juin 18:00 (France)</div>
                    <a class="link" href="http://e3.nintendo.com/" target="_blank">e3.nintendo.com</a>
                </div>
            </div>
            <div class="item">
                <div class="title">Square Enix</div>
                <div class="infos">
                    <div class="hours">16 juin 19:00 (France)</div>
                </div>
            </div>
            <div class="item">
                <div class="title">AMD PC Gaming Show</div>
                <div class="infos">
                    <div class="hours">17 juin 19:00 (France)</div>
                    <div class="hours">02:00 (France)</div>
                    <a class="link" href="http://www.pcgamingshow.com/" target="_blank">pcgamingshow.com</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();