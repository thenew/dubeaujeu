<?php
/* OK, let's add a custom URL to WordPress!
   How many lines do we need to do this? HOW MANY LINES?
   Disclaimer: I hate WordPress. I really hate this thing. But I keep working on it. */

// First step: flush rewrite rules on activation!
register_activation_hook(__FILE__, function(){
  flush_rewrite_rules(FALSE);
});

// Second step: now we add a new rewrite rule.
// This new rewrite rule should redirect to an existing file.
// We use index.php with a query var.
add_filter('rewrite_rules_array', function($rules) use($wp_rewrite) {
  $new_rules = array('^a\/?$' => 'index.php?fon_view=super_add');
  return $new_rules + $rules;
});

// But this query var is not valid, we need to add it manually.
add_filter('query_vars', function($qvars) {
  $qvars[] = 'fon_view';
  return $qvars;
});

// And we finally intercept the request, based on the query.
add_action('template_redirect', function(){
  if (get_query_var('fon_view') == 'super_add') {
    include TEMPLATE_PATH.'/page-superadd.php';
    die;
  }
});
