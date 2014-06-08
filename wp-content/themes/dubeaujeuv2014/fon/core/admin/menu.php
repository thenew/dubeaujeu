<?php

add_action( 'admin_menu', 'fon_register_menu' );

function fon_register_menu() {
    add_menu_page( 'Les Fondations', 'Fondations', 'manage_options', 'fondations_menu', 'fon_menu_actions', 'dashicons-marker', 1 );
    // Profil
    add_submenu_page( 'fondations_menu', 'Profil', 'Profil', 'manage_options', 'fon_menu_profile', 'fon_menu_profile_actions' );
    // Filou
    add_submenu_page( 'fondations_menu', 'Filou', 'Filou', 'manage_options', 'fon_menu_filou', 'fon_menu_filou_actions' );
}

function fon_menu_actions() {
    ?>
    <div class="fon-body wrap" id="">
        <h2>Les Fondations</h2>
        <?php do_action( 'fon_menu_hook' ); ?>
        <?php if(isset($_GET['applytag'])) {
            $applytag_args = array(
                'post_type'      => 'attachment',
                'post_status' => 'any',
                'date_query' => array(
                    array(
                        'before'    => array(
                            'year'  => 2014,
                            'month' => 5,
                            'day'   => 28,
                        ),
                    ),
                ),
                'posts_per_page' => -1,
            );
            $applytag_query = new WP_Query($applytag_args);
            if($applytag_query->have_posts()):
                while($applytag_query->have_posts()):$applytag_query->the_post();
                    wp_set_object_terms( get_the_id(), 'art', 'attachment_tag', true );
                endwhile;
            endif;
            wp_reset_postdata();
        } ?>
    </div>
    <?php
}

function fon_menu_profile_actions() {
    ?>
    <div class="fon-body wrap the-profile-page" id="the-profile-page">
        <h2>Profil</h2>
        <?php do_action( 'fon_menu_profile_hook' ); ?>
    </div>
    <?php
}

function fon_menu_filou_actions() {
    ?>
    <div class="fon-body wrap the-filou-page" id="the-filou-page">
        <h2>Filou</h2>
        <?php do_action( 'fon_menu_filou_hook' ); ?>
    </div>
    <?php
}
