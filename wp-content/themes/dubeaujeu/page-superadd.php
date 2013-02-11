<?php
$msg ="";
if(!empty($_POST["super_add"]["url"])) {
    // Treat the file url
    $img = $_POST["super_add"]["url"];
    $img_content = file_get_contents($img);
    $img_name = basename($img);
    $img_title = (!empty($_POST["super_add"]["title"])) ? $_POST["super_add"]["title"] : $img_name;
    $upload_dir = wp_upload_dir();
    $upload_dir = $upload_dir["path"]."/a/";

    // uploads directory
    if(!is_dir($upload_dir))
        @mkdir($upload_dir);
    @chmod($upload_dir, "0777");
    $filename = $upload_dir.$img_name;
    if(!file_exists($filename)) {
        if(file_put_contents($filename, $img_content)) {

            // insert post
            $post_id = false;
            if($_POST["super_add"]["is_post"]) {
                $my_post = array(
                  'post_title'    => $img_title,
                  'post_content'  => '',
                  'post_status'   => 'publish',
                  'post_author'   => 1
                );
                $post_id = wp_insert_post($my_post);
            }

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

            $msg = "<p style='color: #BADA55'>Youpi ! ".$img_name." est en ligne.</p>";
        } else {
            $msg = "<p style='color: #c30'>Echec dans l'upload</p>";
        }
    } else {
        $msg = "<p style='color: #c30'>Le fichier existe déjà.</p>";
    }
}
?>

<form name="super_add" method="POST" action="" style="width: 180px; margin: 100px auto;">
    <?php echo $msg; ?>
    <div><input type="text" name="super_add[url]" placeholder="http://pipou.jpg" autofocus required /></div>
    <div><input type="text" name="super_add[title]" placeholder="Pipou" /></div>
    <div><input type="checkbox" name="super_add[is_post]" /><labe for="super_add[is_post]">Créer un post</label></div>
    <div><button type="submit">Add</button></div>
</form>