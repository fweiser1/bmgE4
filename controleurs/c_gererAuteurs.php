<?php

require_once("modele/genreDal.class.php");
require_once("include/_reference.lib.php");

if (!isset($_REQUEST['action'])) {
    $action = 'listerAuteurs';
} else {
    $action = $_REQUEST['action'];
}

// variables pour la gestion des messages
$msg = '';  // message passé à la vue v_afficherMessage
$lien = ''; // message passé à la vue v_afficherErreurs
// variables pour la gestion des messages
$titrePage = 'Gestion des auteurs';
// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;

switch ($action) {
    case 'listerAuteurs' : {
        // récupérer les auteurs
        $lesAuteurs = AuteurDal::loadAuteur(1);
        // afficher le nombre d'auteurs
        $nbAuteurs = count($lesAuteurs);
        include("vues/v_listeAuteurs.php");
    }
    break;
}

?>