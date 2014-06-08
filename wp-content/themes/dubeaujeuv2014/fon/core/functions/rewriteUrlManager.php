<?php
// Dédicace https://github.com/lesintegristes/wp-github-sync/blob/master/github-sync.php

// $fon_routes = array(
//   'filename' => 'fileName'
// );

function fon_rewrite_url_manager() {
    global $fon_routes;
    foreach (glob(FON_PATH.'/views/*.php') as $file) {
        $filename = basename($file, '.php');
        $fonBase = new Fon_Base_Class();
        $fon_routes[$fonBase->uglify($filename)] = $filename;
    }
}
add_action( 'init', 'fon_rewrite_url_manager' );

/* Add a custom URL */

// Second step: now we add a new rewrite rule.
// This new rewrite rule should redirect to an existing file.
// We use index.php with a query var.
add_filter('rewrite_rules_array', function($rules) use($wp_rewrite) {
    global $fon_routes;
    $new_routes = array();
    foreach ($fon_routes as $route => $action) {
        $new_routes['^'.$route.'\/?$'] = 'index.php?fon_action='.$action;
    }
    // var_dump($new_routes);
    // var_dump($rules);
    // die;
    return $new_routes + $rules;
});

// But this query var is not valid, we need to add it manually.
add_filter('query_vars', function($qvars) {
    $qvars[] = 'fon_action';
    return $qvars;
});

// And we finally intercept the request, based on the query.
add_action('template_redirect', function(){
    global $fon_routes;
    $fon_query_action = get_query_var('fon_action');
    if(empty($fon_query_action)) return;
    global $template;
    $template = FON_PATH.'/views/'.$fon_query_action.'.php';
    require_once($template);
    die();
});