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
                $strId = strtoupper(htmlentities($_GET["id"]));
                // appel de la méthode du modèle
                $leAuteur = AuteurDal::loadAuteurByID($strId);
                if ($leAuteur == NULL) {
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
    case 'ajouterAuteur': {
            // traitement de l'option : saisie ou validation ?
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirAuteur';
            }
            switch ($option) {
                case 'saisirAuteur' : {
                        include 'vues/v_ajouterAuteur.php';
                    } break;
                case 'validerAuteur' : {
                        if (isset($_POST["cmdValider"])) {
                            // récupération du libellé
                            if (!empty($_POST["txtLibelle"])) {
                                $strLibelle = ucfirst(htmlentities($_POST["txtLibelle"]));
                            }
                            if (!empty($_POST["txtCode"])) {
                                $strCode = strtoupper(htmlentities($_POST["txtCode"]));
                            }
                            // test zones obligatoires
                            if (!empty($strCode) and ! empty($strLibelle)) {
                                // les zones obligatoires sont présentes
                                // tests de cohérence 
                                // contrôle d'existence d'un genre avec le même code
                                $doublon = AuteurDal::loadAuteursByID($strCode);
                                if ($doublon != NULL) {
                                    // signaler l'erreur
                                    $tabErreurs[] = 'Il existe déjà un genre avec ce code !';
                                    $hasErrors = true;
                                }
                            } else {
                                // une ou plusieurs valeurs n'ont pas été saisies
                                if (empty($strCode)) {
                                    $tabErreurs[] = "Le code doit être renseigné !";
                                }
                                if (empty($strLibelle)) {
                                    $tabErreurs[] = "Le libellé doit être renseigné !";
                                }
                                $hasErrors = true;
                            }
                            if (!$hasErrors) {
                                $res = AuteurDal::addAuteur($strCode, $strLibelle);
                                if ($res > 0) {
                                    $msg = 'Le genre '
                                            . $strCode . '-'
                                            . $strLibelle . ' a été ajouté';
                                    $lAuteur = new Auteur($strCode, $strLibelle);
                                    include 'vues/_v_afficherMessage.php';
                                    include 'vues/v_consulterAuteur.php';
                                } else {
                                    $tabErreurs["Erreur"] = 'Une erreur s\'est produite dans l\'opération d\'ajout !';
                                    $hasErrors = true;
                                }
                            }
                            if ($hasErrors) {
                                $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                $lien = '<a href="index.php?uc=gererAuteurs&action=ajouterAuteur">Retour à la saisie</a>';
                                include 'vues/_v_afficherErreurs.php';
                            }
                        }
                    } break;
            }
        }
        break;
}
?>