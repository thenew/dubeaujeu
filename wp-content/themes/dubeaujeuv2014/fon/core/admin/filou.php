<?php
/*
 * Fondations Filou
 *
 * import and handle medias from URL
 *
 * Module de pillage des images : depuis une URL lister toutes les <img>
 * (chercher si un lien les entourent pour chercher l'image en grande résolution),
 * cocher les images à importer, les renommer (pour SEO et un pillage discret) + associer à un post
 *
 */

add_action( 'fon_menu_filou_hook', 'fon_filou_page' );
add_action( 'fon_menu_filou_hook', 'fon_filou_page_notice', 9 );

function fon_filou_page_notice(  ) {
    do_action( 'fon_filou_set_notice' );
}

function fon_filou_page() {

    fon_filou_save();

    $url = ( isset($_POST['filou']) && isset($_POST['filou']['url']) ) ? $_POST['filou']['url'] : '';
    $size_min = ( isset($_POST['filou']) && isset($_POST['filou']['size_min']) ) ? $_POST['filou']['size_min'] : 0;
    ?>

    <form id="filou_form" name="filou" class="" action="" method="POST">
        <table class="form-table"><tbody>
            <tr valign="top">
                <th scope="row"><label for="'.$field_id.'">URL</label></th>
                <td>
                    <input type="url" name="filou[url]" value="<?php echo $url; ?>" autofocus />
                    <p class="description">http://www.kickstarter.com/projects/rain-world/project-rain-world</p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="filou_size_min">Dimensions min.</label></th>
                <td><input type="range" name="filou[size_min]" min="0" max="1400" step="100" value="<?php echo $size_min; ?>" id="filou_size_min" class="input-range"/><span class="input-range-value"><span class="value"><?php echo $size_min; ?></span>px</span></td>
            </tr>
        </tbody></table>
        <p class="submit">
            <button name="fon-form-submit" id="fon-form-submit" class="button-primary"><?php echo __('Importe p’tit filou', 'fon'); ?></button>
        </p>
    </form>
    <?php

    fon_filou_parsing( $url, array( 'size_min' => (int) $size_min ) );

}

function fon_filou_parsing( $url = '', $args = array() ) {
    if( empty( $url ) ) return;

    if( strpos( $url, '.png' ) || strpos( $url, '.jpg' )  || strpos( $url, '.jpeg' )  || strpos( $url, '.gif' ) ) {
        $imgs = array(
            array(
                'url' => $url,
                'width' => '',
                'height' => ''
            )
        );
    } else {
        // args
        if( ! isset( $args['size_min'] ) || ! is_int( $args['size_min'] ) ) {
            $args['size_min'] = 300;
        }
        $size_min = $args['size_min'];

        $imgs_url = array();
        $imgs = array();

        // curl
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $html = curl_exec($curl);
        curl_close($curl);

        // parsing
        $dom = new DOMDocument();
        libxml_use_internal_errors( true );
        $dom->loadHTML( $html );
        $xpath = new DOMXPath( $dom );
        $nodes = $xpath->query( "//img[contains(@src, '.jpg') or contains(@src, '.jpeg') or contains(@src, '.png') or contains(@src, '.gif')]" );
        $nodes = $xpath->query( "//img" );

        $node_count = 0;
        foreach ($nodes as $node) {

            // get link wrapping img and check if its an img
            $href = $node->parentNode->getAttribute( 'href' );
            $href = rel2abs( $href, $url );
            if( ! empty( $href ) && ( strpos( $href, '.png' ) || strpos( $href, '.jpg' )  || strpos( $href, '.jpeg' )  || strpos( $href, '.gif' ) ) && ! in_array( $href, $imgs_url ) ) {
                $imgs_url[] = $href;

            // get img
            } else {

                $src = $node->getAttribute( 'src' );
                if(!$src) {
                    $src = $node->getAttribute( 'data-src' );
                }
                $src = rel2abs( $src, $url );
                if( ! in_array( $src, $imgs_url ) ) {
                    $imgs_url[] = $src;
                }

            }
            if($node_count % 40 == 0) {
                set_time_limit(30);
            }
            $node_count++;
        }

        // check size
        foreach ($imgs_url as $url) {

            $imgs[] = array(
                'url' => $url,
                'width' => '',
                'height' => ''
            );

            // check size (very buggy and slow)
            /*if( $size_min ) {

                // Get dimensions

                list( $width, $height, $type, $attr ) = getimagesize( $url );

                if( $width && $height && $width > $size_min && $height > $size_min ) {
                    $img_array = array(
                        'url' => $url,
                        'width' => $width,
                        'height' => $height
                    );
                    $imgs[] = $img_array;
                }
                set_time_limit(30);
            } else {
                $img_array = array(
                    'url' => $url,
                    'width' => '',
                    'height' => ''
                );
                $imgs[] = $img_array;
            }*/
        }

        asort($imgs);
    }

    // FORM SAVE
    ?>
    <form class="" name="" action="" method="POST">
        <div id="js-packery" class="images-wall cf">
            <?php
            $imgs_count = 0;
            foreach ( $imgs as $img ) { ?>
                <div class="item" data-width="<?php echo $img['width']; ?>" data-height="<?php echo $img['height']; ?>">
                    <?php
                    echo '<img src="'.$img['url'].'" alt="" />';
                    ?>
                    <div class="tag-inputs">
                        <div class="box">
                            <input type="checkbox" name="filou_imgs_tag[]" value="art" id="tag-art-<?php echo $imgs_count; ?>" class="tag-checkbox" />
                            <label class="label" for="tag-art-<?php echo $imgs_count; ?>">Art</label>
                        </div>
                        <div class="box">
                            <input type="checkbox" name="filou_imgs_tag[]" value="logo" id="tag-logo-<?php echo $imgs_count; ?>" class="tag-checkbox" />
                            <label class="label" for="tag-logo-<?php echo $imgs_count; ?>">Logo</label>
                        </div>
                        <div class="box">
                            <input type="checkbox" name="filou_imgs_tag[]" value="bg" id="tag-bg-<?php echo $imgs_count; ?>" class="tag-checkbox" />
                            <label class="label" for="tag-bg-<?php echo $imgs_count; ?>">Bg</label>
                        </div>
                        <div class="box">
                            <input type="checkbox" name="filou_imgs_tag[]" value="cover" id="tag-bg-<?php echo $imgs_count; ?>" class="tag-checkbox" />
                            <label class="label" for="tag-bg-<?php echo $imgs_count; ?>">Cover</label>
                        </div>
                        <div class="box">
                            <input type="checkbox" name="filou_imgs_tag[]" value="hors-jeu" id="tag-hors-jeu-<?php echo $imgs_count; ?>" class="tag-checkbox" />
                            <label class="label" for="tag-hors-jeu-<?php echo $imgs_count; ?>">H-jeu</label>
                        </div>
                    </div>
                    <input type="checkbox" name="filou_imgs[]" value="<?php echo $img['url']; ?>" class="checkbox" <?php if(count($imgs) < 2) echo 'checked' ?> />
                    <div class="overlay"></div>
                    <div class="infos">
                        <?php if ( $img['width'] ): ?>
                            <?php echo $img['width'].'x'.$img['height']; ?>
                        <?php else: ?>
                            /
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                $imgs_count++;
            } ?>
        </div>

        <table class="form-table"><tbody>
            <tr valign="top">
                <th scope="row"><label for="filou_post_id">Jeu existant</label></th>
                <td>
                    <select name="filou_post_id" id="filou_post_id">
                        <option value="0">Aucun</option>
                        <?php
                        $game_args = array(
                            'post_type' => 'game',
                            'posts_per_page' => -1,
                            'orderby' => 'title'
                        );
                        $games = get_posts( $game_args );
                        foreach ($games as $game) {
                            echo '<option value="'.$game->ID.'">'.$game->post_title.'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="filou_post_title">Nouveau jeu : titre</label></th>
                <td><input type="text" name="filou_post_title" id="filou_post_title" value="" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="filou_media_author_name">Crédit label</label></th>
                <td><input type="text" name="filou_media_author_name" id="filou_media_author_name" value="" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="filou_media_author_url">Crédit URL</label></th>
                <td><input type="text" name="filou_media_author_url" id="filou_media_author_url" value="" /></td>
            </tr>
        </tbody></table>
        <p class="submit">
            <button name="fon-form-submit" id="filou[submit]" class="button-primary"><?php echo __('Enregistrer', 'fon'); ?></button>
        </p>
    </form>
    <?php
}


function fon_filou_save() {

    if( ! isset( $_POST['filou_imgs'] ) || empty( $_POST['filou_imgs'] ) ) return;

    $imgs = $_POST['filou_imgs'];
    $post_id = $_POST['filou_post_id'];

    if ( isset( $_POST['filou_post_title'] ) && ! empty( $_POST['filou_post_title'] ) ) {

        $my_post = array(
          'post_title'    => $_POST['filou_post_title'],
          'post_content'  => '',
          'post_status'   => 'publish',
          'post_type'     => 'game',
          'post_author'   => 1
        );
        $post_id = wp_insert_post($my_post);
    }

    set_time_limit(30);

    $attachments_id = array();
    foreach ( $imgs as $key => $img_url ) {
        $title = ( $post_id ) ? get_the_title( $post_id ) : basename( $img_url );
        $attachment_id = fon_upload_form_url( $img_url, $title, $post_id );
        $attachments_id[] = $attachment_id;

        // metas
        if ( isset( $_POST['filou_media_author_name'] ) && ! empty( $_POST['filou_media_author_name'] ) && isset( $_POST['filou_media_author_url'] ) && ! empty( $_POST['filou_media_author_url'] ) ) {
            $acf_field_key = "field_53a2a6ec4778f";
            $acf_meta_value = get_field( $acf_field_key, $attachment_id );
            $acf_meta_value[] = array(
                "field_53a2a772b5c5f" => $_POST['filou_media_author_name'],
                "field_53a2a88e3b98a" => $_POST['filou_media_author_url']
            );
            update_field( $acf_field_key, $acf_meta_value, $attachment_id );
        }

        // tags
        if( isset( $_POST['filou_imgs_tag'][$key] ) && ! empty( $_POST['filou_imgs_tag'][$key] ) ) {
            wp_set_object_terms( $attachment_id, $_POST['filou_imgs_tag'][$key], 'attachment_tag', true );
        }
    }

    if ( ! empty( $attachments_id ) ) { ?>
        <div class="updated"><ul>
            <?php if($post_id) { ?>
                <li>Jeu <a href="<?php echo get_admin_url() . 'post.php?post=' . $post_id . '&action=edit'; ?>"><?php echo get_the_title( $post_id ); ?></a></li>
            <?php } ?>
            <?php foreach ($attachments_id as $id) { ?>
                <li><a href="<?php echo get_admin_url() . 'post.php?post=' . $id . '&action=edit'; ?>"><?php echo get_the_title( $id ); ?></a></li>
            <?php } ?>
        </ul></div>
    <?php }

}

function fon_upload_form_url( $url, $title = '', $post_id = 0, $metas = array() ) {
    if ( ! $url ) return;

    $img = $url;
    $img = trim($img);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $img);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $img_content = curl_exec($curl);

    if ( ! empty( $title ) ) {
        $img_name = sanitize_title( $title ).'_'.uniqid().'.'.pathinfo( $img, PATHINFO_EXTENSION );
    } else {
        $img_name = basename( $img );
    }
    $img_title = ( ! empty( $title ) ) ? $title : str_replace( array( "-", "_" ), " ", $img_name );
    $wp_upload_dir = wp_upload_dir();
    $upload_dir = $wp_upload_dir['path'] . '/fon/';
    $upload_dir_url = $wp_upload_dir['url'] . '/fon/';

    // uploads directory
    if( ! is_dir( $upload_dir ) ) {
        @mkdir( $upload_dir );
    }
    @chmod( $upload_dir, 0777 );
    $filename = $upload_dir.$img_name;
    if( ! file_exists( $filename ) ) {
        if( file_put_contents( $filename, $img_content ) ) {

            // insert attachment
            $wp_filetype = wp_check_filetype( basename( $filename ), null );
            $attachment = array(
                'guid' => $upload_dir_url . basename( $filename ),
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => $img_title,
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $filename, $post_id );

            // you must first include the image.php file
            // for the function wp_generate_attachment_metadata() to work
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
            wp_update_attachment_metadata( $attach_id, $attach_data );

            foreach ($metas as $meta_key => $meta_value) {
                update_post_meta( $attach_id, $meta_key, $meta_value );
            }

            return $attach_id;
        }
    }
}






function rel2abs($rel, $base) {
    /* return if already absolute URL */
    if (parse_url($rel, PHP_URL_SCHEME) != '' || substr($rel, 0, 2) == '//') return $rel;

    /* queries and anchors */
    if (isset($rel[0]) && ($rel[0]=='#' || $rel[0]=='?')) return $base.$rel;

    /* parse base URL and convert to local variables:
       $scheme, $host, $path */
    extract(parse_url($base));

    /* remove non-directory element from path */
    $path = preg_replace('#/[^/]*$#', '', $path);

    /* destroy path if relative url points to root */
    if (isset($rel[0]) && $rel[0] == '/') $path = '';

    /* dirty absolute URL */
    $abs = "$host$path/$rel";

    /* replace '//' or '/./' or '/foo/../' with '/' */
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}

    /* absolute URL is ready! */
    return $scheme.'://'.$abs;
}
