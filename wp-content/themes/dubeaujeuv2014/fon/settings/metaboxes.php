<?php

// ACF

if( function_exists("register_field_group") )
{
    if(ENV_DEV) {
        return;
    }
    if(!ENV_DEV) {
        define( 'ACF_LITE', true );
    }

    register_field_group(array (
        'id' => 'acf_details',
        'title' => 'Détails',
        'fields' => array (
            array (
                'key' => 'field_539468f0f5e19',
                'label' => 'Durée de lecture',
                'name' => 'read_time',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5394692df5e1a',
                'label' => 'Source',
                'name' => 'source_name',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53946934f5e1b',
                'label' => 'Source URL',
                'name' => 'source_url',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53946940f5e1c',
                'label' => 'Via',
                'name' => 'via_name',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5394694af5e1d',
                'label' => 'Via URL',
                'name' => 'via_url',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'side',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_infos',
        'title' => 'Infos',
        'fields' => array (
            array (
                'key' => 'field_53945fa08beb3',
                'label' => 'Titre original',
                'name' => 'original_title',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_53945fd28beb4',
                'label' => 'Autre nom, on l’appelle aussi',
                'name' => 'variant_title',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5394600b8beb6',
                'label' => 'Date de sortie française',
                'name' => 'release_date_fr',
                'type' => 'date_picker',
                'date_format' => 'yyyy-mm-dd',
                'display_format' => 'dd/mm/yyyy',
                'first_day' => 1,
            ),
            array (
                'key' => 'field_53945fe48beb5',
                'label' => 'Site officiel',
                'name' => 'website',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_539468b08efa9',
                'label' => 'Résumé',
                'name' => 'summary',
                'type' => 'textarea',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'formatting' => 'br',
            ),
            array (
                'key' => 'field_539460958beb7',
                'label' => 'Pochette',
                'name' => 'cover',
                'type' => 'image',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'game',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_credits',
        'title' => 'Crédits',
        'fields' => array (
            array (
                'key' => 'field_53a2a6ec4778f',
                'label' => 'Crédit',
                'name' => 'credit',
                'type' => 'repeater',
                'sub_fields' => array (
                    array (
                        'key' => 'field_53a2a772b5c5f',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_53a2a88e3b98a',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Ajouter',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'ef_media',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_liens',
        'title' => 'Liens',
        'fields' => array (
            array (
                'key' => 'field_53a76b90c00f1',
                'label' => 'Liens',
                'name' => 'links',
                'type' => 'repeater',
                'sub_fields' => array (
                    array (
                        'key' => 'field_53a76de4c00f2',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                    array (
                        'key' => 'field_53a76df0c00f3',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'game',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'person',
                    'order_no' => 0,
                    'group_no' => 1,
                ),
            ),
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'company',
                    'order_no' => 0,
                    'group_no' => 2,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_videos',
        'title' => 'Vidéos',
        'fields' => array (
            array (
                'key' => 'field_53a76fd0b85bc',
                'label' => 'URL Vidéo',
                'name' => 'url_video',
                'type' => 'repeater',
                'sub_fields' => array (
                    array (
                        'key' => 'field_53a76fe8b85bd',
                        'label' => 'URL',
                        'name' => 'url',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                    ),
                ),
                'row_min' => '',
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'game',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

}
