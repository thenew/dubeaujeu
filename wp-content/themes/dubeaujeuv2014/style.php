<?php
include dirname(__FILE__).'/../../../wp-load.php';

$retour_css = '';
$fichiers = array( );

// Dossier contenant les fichiers css
$dossier_css = TEMPLATE_PATH.'/assets/css/';
// On parcourt le dossier des css
$dir = opendir($dossier_css);

// don't load reset.css if we use Twitter Bootstrap
if(FONDATIONS_BOOTSTRAP || FONDATIONS_CSSNORMALIZE) {
  // On ajoute chaque fichier à un tableau 'fichiers'
  // pour chaque fichier
  while ( $fichier = readdir($dir) ) {
    // sauf les valeurs . et .. et reset
    if($fichier != "." && $fichier != ".." && $fichier != "a-reset.css" && $fichier != "reset.css") {
        $fichiers[] = $dossier_css . $fichier;
    }
  }
} else {
  while ( $fichier = readdir($dir) ) {
    if($fichier != "." && $fichier != "..") {
        $fichiers[] = $dossier_css . $fichier;
    }
  }
}

closedir($dir);

// Tri par ordre alphabetique des fichiers
asort($fichiers);

// Inclusion des fichiers dans l'ordre
foreach ( $fichiers as $fichier )
  $retour_css .= file_get_contents($fichier);

// Définition de la fonction de compression
function compress_css($css) {
    // remove comments, tabs, spaces, newlines, etc.
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', ' ', $css);
    $css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $css);
    $css = str_replace(
         array(';}', ' {', '} ', ': ', ' !', ', ', ' >', '> '),
         array('}',  '{',  '}',  ':',  '!',  ',',  '>',  '>'), $css);
  return $css;
}

// Compression du CSS
$retour_css = compress_css($retour_css);

// Mis en cache fichier externe
file_put_contents(TEMPLATE_PATH.'/fon_min.css', $retour_css);
if(WP_DEBUG) {
    // Declaration du contenu CSS
    header("Content-type: text/css; charset=utf-8");
    // Envoi du retour CSS
    echo $retour_css;
}