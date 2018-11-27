<?php

require_once("modele/AuteurDal.class.php");
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
        $lesAuteurs = AuteurDal::loadAuteurs(1);
        // afficher le nombre d'auteurs
        $nbAuteurs = count($lesAuteurs);
        include("vues/v_listeAuteurs.php");
    }
    break;
  case 'consulterAuteur': {
            // récupération du code passé dans l'URL
            if (isset($_GET["id"])) {
                $strCode = strtoupper(htmlentities($_GET["id"]));
                // appel de la méthode du modèle
                $lAuteur = AuteurDal::loadAuteursByID($strCode);
                if ($lAuteur == NULL) {
                    $tabErreurs[] = 'Cet auteur n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                // pas d'id dans l'url ni de clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun auteur n'a été transmis pour consultation !";
                $hasErrors = true;
            }
            if ($hasErrors) {
                include 'vues/_v_afficherErreurs.php';
            } else {
                include 'vues/v_consulterAuteur.php';
            }
        }
        break;
}

?>