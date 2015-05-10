<?php /* Template Name: E3 2015 */

// CSS

function fon_styles_e32015() { wp_enqueue_style( 'e32015', ASSETS_URL.'/css/pages/e32015.css' ); }
add_action( 'wp_enqueue_scripts', 'fon_styles_e32015' );

function fon_scripts_e32015() { wp_enqueue_script( 'e32015', ASSETS_URL.'/js/pages/e32015.js', '', '1.0', true ); }
add_action( 'wp_enqueue_scripts', 'fon_scripts_e32015' );

// VIEW

get_header();
?>
<div class="e32015-page">
    <div class="logo-box">
        <?php require_once TEMPLATEPATH.'/assets/img/e32015/logo.svg'; ?>
    </div>

    <div class="e32015-planning">
        <div class="day">
            <div class="date">
                <div class="day">15</div>
                <div class="month">juin</div>
            </div>
            <div class="items">
                <div class="item">
                    <div class="title">Bethesda</div>
                    <div class="hours">4 h (France - UTC+1)</div>
                    <div class="hours">4 h (Los Angeles - UTC-8)</div>
                    <a class="link" href="http://www.twitch.tv/bethesda" target="_blank">twitch.tv/bethesda</a>
                </div>
                <div class="item">
                    <div class="title">Electronic Arts</div>
                    <div class="hours">de 22 h à 23 h (France - UTC+1)</div>
                </div>
            </div>
        </div>
        <div class="day">
            <div class="date">
                <div class="day">16</div>
                <div class="month">juin</div>
            </div>
            <div class="items">
                <div class="item">
                    <div class="title">Square Enix</div>
                    <div class="hours">de 18 h à 19 h (France - UTC+1)</div>
                </div>
            </div>
        </div>

        <div class="nc">
            <div class="items">
                <div class="item">Sony : inconnu</div>
                <div class="item">Nintendo : inconnu</div>
                <div class="item">Microsoft : inconnu</div>
                <div class="item">Ubisoft : inconnu</div>
            </div>
        </div>
    </div>
</div>

<?php
/*
Pour l’instant, les horaires (fr) des confs E3 confirmées :

Sony : inconnu
Nintendo : inconnu
Microsoft : inconnu
Ubisoft : inconnu

Bethesda : 15 juin à 4h
http://www.twitch.tv/bethesda

Electronic Arts : 15 juin de 22h à 23h
Square Enix : 16 Juin de 18h à 19h
AMD PC Gaming Show :  17 juin de 2h à 5h
http://www.pcgamingshow.com/

Konami ?

15 juin
Bethesda : à 4h
EA : de 22h à 23h

16 juin
Square Enix : de 18h à 19h

17 juin
AMD PC Gaming Show :  de 2h à 5h


Expo : 16 - 18 juin

*/
get_footer();