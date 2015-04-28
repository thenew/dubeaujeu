<?php

function fon_register_connections() {
    if(!function_exists('p2p_register_connection_type')) return;

    $role_terms = get_terms( 'role', array('hide_empty'=> false) );
    $roles = array();
    foreach ($role_terms as $role) {
        $roles[] = $role->name;
    }

    // Connexions
    $fon_connections = array(
        // Post -> Users
        array(
            'name' => 'multiple_authors',
            'from' => 'post',
            'to' => 'user'
            // 'to_query_vars' => array( 'role' => 'editor' )
        ),

        // company -> Games
        array(
            'name' => 'company_games',
            'from' => 'company',
            'to' => 'game',
            'reciprocal' => true,
            'fields' => array(
                'role' => array(
                    'title' => 'Rôle',
                    'type' => 'select',
                    'values' => $roles
                )
            )
        ),
        // person -> Games
        array(
            'name' => 'people_games',
            'from' => 'person',
            'to' => 'game',
            'reciprocal' => true,
            'fields' => array(
                'role' => array(
                    'title' => 'Rôle',
                    'type' => 'select',
                    'values' => $roles
                )
            )
        ),
        array(
            'name' => 'series_game',
            'from' => 'game',
            'to' => 'series',
            'reciprocal' => true,
        ),
        array(
            'name' => 'attachment_people',
            'from' => 'attachment',
            'to' => 'person',
            'reciprocal' => true,
        )
    );

    foreach ($fon_connections as $args) {
        p2p_register_connection_type($args);
    }


}

add_action('p2p_init', 'fon_register_connections');

