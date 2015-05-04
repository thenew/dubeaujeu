<?php
global $fon_routes;

foreach (glob(FON_PATH.'/views/*.php') as $file) {
    // $fonBase = new Fon_Base_Class();
    // $fon_views_routes[$filename] = $fonBase->beautify($filename);
    // $filename = basename($file, '.php');
    // $fon_views_routes[$filename] = $filename;
}

$fon_custom_routes = array(
    // URL => views
    // 'art/illustrations' => 'art/illustrations',
    // 'art/videos' => 'art/videos',
    // 'art/hors-jeu' => 'art/hors-jeu'
    'e32015' => 'views/e32015'
);

// $fon_routes = $fon_views_routes + $fon_custom_routes;
$fon_routes = $fon_custom_routes;