<?php

function fon_scripts_mobs() { wp_enqueue_script( 'mobs', ASSETS_URL.'/js/mobs.js', '', '1.0', true ); }
add_action( 'wp_enqueue_scripts', 'fon_scripts_mobs' );

get_header();
?>
<div class="landing">
    <div class="mobs-box">
        <div class="bar"></div>
        <div class="counter"></div>
        <div class="chrono"><span class="chrono-nb"></span> <span class="currency">¤</span></div>
        <svg class="mob" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
        <path class="line" d="m 49.900002,30 0,-20" /><path class="line" d="M 63.900002,36.099998 78,21.9" /><path class="line" d="m 49.900002,70 0,20" /><path class="line" d="M 63.900002,64 78,78.099998" /><path class="line" d="M 36.099998,36.099998 21.9,21.9" /><path class="line" d="M 36.099998,64 21.9,78.099998" />
        <g class="hitbox"><circle class="circle" fill="transparent" stroke="#333333" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" cx="50" cy="50" r="10"/><circle class="disc" fill="#333333" cx="50" cy="50" r="5"/></g>
        </svg>
    </div>
    <div class="content">
        <div class="logo">Du Beau Jeu</div>
        <div class="intro">
            Merci d‘avoir joué ! <br><br>
            Avec <em>Du Beau Jeu</em>, j’ai envie de mettre en forme le jeu vidéo autrement,<br>
            de découvrir des artistes, de réfléchir sur le medium loin de la course médiatique.<br><br>
            En attendant que je finisse de développer le site, suivez le compte <a href="http://twitter.com/dubeaujeu">twitter</a> シ
        </div>
    </div>
</div>
<?php
get_footer();