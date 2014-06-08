<?php
$msg ="";
if(!empty($_POST["super_add"]["url"])) {

    // insert post
    $post_id = false;
    if($_POST["super_add"]["is_post"]) {
        $my_post = array(
          'post_title'    => $_POST["super_add"]["title"],
          'post_content'  => '',
          'post_status'   => 'publish',
          'post_author'   => 1
        );
        $post_id = wp_insert_post($my_post);
    }

    // Treat the file url
    $imgs = explode("\n", $_POST["super_add"]["url"]);
    foreach ($imgs as $img) {
        $img = trim($img);
        $img_content = file_get_contents($img);
        if ($_POST["super_add"]["title"])
            $img_name = sanitize_title($_POST["super_add"]["title"]).'_'.uniqid().'.'.pathinfo($img, PATHINFO_EXTENSION);
        else
            $img_name = basename($img);
        $img_title = (!empty($_POST["super_add"]["title"])) ? $_POST["super_add"]["title"] : str_replace(array("-","_")," ",$img_name);
        $upload_dir = wp_upload_dir();
        $upload_dir = $upload_dir["path"]."/a/";

        // uploads directory
        if(!is_dir($upload_dir))
            @mkdir($upload_dir);
        @chmod($upload_dir, 0777);
        $filename = $upload_dir.$img_name;
        if(!file_exists($filename)) {
            if(file_put_contents($filename, $img_content)) {


                // insert attachment
                $wp_filetype = wp_check_filetype(basename($filename), null );
                $wp_upload_dir = wp_upload_dir();
                $attachment = array(
                    'guid' => $wp_upload_dir['url'] . '/a/' . basename( $filename ),
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => $img_title,
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment($attachment, $filename, $post_id);
                // you must first include the image.php file
                // for the function wp_generate_attachment_metadata() to work
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                wp_update_attachment_metadata($attach_id, $attach_data);

                $msg .= "<p style='color: #BADA55'>Youpi ! ".$img_name." est en ligne.</p>";
            } else {
                $msg .= "<p style='color: #c30'>Echec dans l'upload de ".$img_name."</p>";
            }
        } else {
            $msg .= "<p style='color: #c30'>Le fichier ".$img_name." existe déjà.</p>";
        }
    }
}
?>
<form name="super_add" method="POST" action="" style="width: 600px; margin: 100px auto;">
    <a href="<?php echo site_url("/") ?>">↩ Home</a>
    <?php echo $msg; ?>
    <div><textarea type="text" name="super_add[url]" placeholder="http://pipou.jpg" cols="60" rows="8" autofocus required></textarea></div>
    <div><input type="text" name="super_add[title]" placeholder="Pipou" /></div>
    <div><input type="checkbox" name="super_add[is_post]" id="super_add[is_post]" /><label for="super_add[is_post]">Créer un post</label></div>
    <div><button type="submit">Add</button></div>
</form>





<?php

function rel2abs($rel, $base)
{
    /* return if already absolute URL */
    if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;

    /* queries and anchors */
    if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;

    /* parse base URL and convert to local variables:
       $scheme, $host, $path */
    extract(parse_url($base));

    /* remove non-directory element from path */
    $path = preg_replace('#/[^/]*$#', '', $path);

    /* destroy path if relative url points to root */
    if ($rel[0] == '/') $path = '';

    /* dirty absolute URL */
    $abs = "$host$path/$rel";

    /* replace '//' or '/./' or '/foo/../' with '/' */
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}

    /* absolute URL is ready! */
    return $scheme.'://'.$abs;
}