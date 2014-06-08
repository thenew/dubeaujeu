<?php
$fon_metas = array();

if(is_singular()) {
    global $post;
    $meta_description = '';
    $meta_description = strip_tags(strip_shortcodes($post->post_content));
    $meta_description = substr(str_replace(array("\n", "\r", "\t"), ' ', $meta_description ), 0, 125);
    $fon_metas[] = array('name' => 'title', 'content' => strip_tags(get_the_title($post->ID)));
    $fon_metas[] = array('name' => 'description', 'content' => $meta_description);
    $fon_metas[] = array('property'=>'og:url','content'=> get_permalink());
    $fon_metas[] = array('property'=>'og:type','content'=> 'article');
    $fon_metas[] = array('property'=>'og:title','content'=> strip_tags(get_the_title()));
} else {
    $fon_metas[] = array('name'=>'title','content'=> get_bloginfo('name'));
    $fon_metas[] = array('name' => 'description', 'content' => get_bloginfo('name').' ✳ '.get_bloginfo('description'));
    $fon_metas[] = array('property'=>'og:url','content'=> site_url('/'));
    $fon_metas[] = array('property'=>'og:type','content'=> 'website');
    $fon_metas[] = array('property'=>'og:title','content'=> get_bloginfo('name'));
    $fon_metas[] = array('property'=>'og:description', 'content' => get_bloginfo('name').' ✳ '.get_bloginfo('description'));
}
$fon_metas[] = array('property'=>'og:image','content'=> TEMPLATE_URL.'/screenshot.png');
$fon_metas[] = array('property'=>'og:site_name','content'=> get_bloginfo('name'));


echo "\n";
foreach($fon_metas as $name => $attributs){
    $meta = "\t".'<meta';
    foreach($attributs as $id => $value)
        $meta .= ' '.$id.'="'.$value.'"';
    $meta .= ' />'."\n";
    echo $meta;
}