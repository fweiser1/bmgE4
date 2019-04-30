<?php

require_once 'modele/ClientDal.class.php';
require_once 'include/_reference.lib.php';

// variables pour la gestion des messages
$titrePage = 'Gestion des ouvrages';

// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;

// récupération de l'action à effectuer
if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = 'listerClients';
}
// variables pour la gestion des messages
$msg = '';    // message passé à la vue v_afficherMessage
$lien = '';   // message passé à la vue v_afficherErreurs
// charger la vue en fonction du choix de l'utilisateur
switch ($action) {
    case 'listerClients' : {
            // récupérer les clients
            $lesClients = ClientDal::loadClients(1);
            // afficher le nombre de clients
            $nbClients = count($lesClients);
            include 'vues/v_listeClients.php';
        } break;
}

?>