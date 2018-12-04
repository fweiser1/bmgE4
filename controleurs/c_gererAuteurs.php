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
                            
                            if (!empty($_POST["txtNom"])) {
                                $strNom = ucfirst(htmlentities($_POST["txtNom"]));
                            }
                            
                            if (!empty($_POST["txtPrenom"])) {
                                $strPrenom = ucfirst(htmlentities($_POST["txtPrenom"]));
                            }
                            else
                            {
                                $strPrenom = NULL;
                            }
                            
                            if (!empty($_POST["txtAlias"])) {
                                $strAlias = ucfirst(htmlentities($_POST["txtAlias"]));
                            }
                            else
                            {
                                $strAlias = NULL;
                            }
                            
                            if (!empty($_POST["txtNotes"])) {
                                $strNotes = ucfirst(htmlentities($_POST["txtNotes"]));
                            }
                            else
                            {
                                $strNotes = NULL;
                            }
                            
                            // test zones obligatoires
                            if (!empty($strNom)) {
                                // les zones obligatoires sont présentes
                                // tests de cohérence 
                                // contrôle d'existence d'un genre avec le même code
                                $doublon = AuteurDal::loadAuteurByID($strNom);
                                if ($doublon != NULL) {
                                    // signaler l'erreur
                                    $tabErreurs[] = 'Il existe déjà un genre avec ce code !';
                                    $hasErrors = true;
                                }
                            } else {
                                // une ou plusieurs valeurs n'ont pas été saisies
                                if (empty($strNom)) {
                                    $tabErreurs[] = "Le nom doit être renseigné !";
                                }                       
                                $hasErrors = true;
                            }
                            if (!$hasErrors) {
                                $res = AuteurDal::addAuteur($strNom, $strPrenom, $strAlias, $strNotes);
                                if ($res > 0) {
                                    $msg = 'L\'auteur '
                                            . $strNom . ' a été ajouté';
//                                    $leAuteur = new Auteur($strNom, $strPrenom, $strAlias, $strNotes);
                                    include 'vues/_v_afficherMessage.php';
//                                    include 'vues/v_consulterAuteur.php';
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
        ///////////////////////////////////////////////////////////////
        case 'modifierAuteur': {
            // initialisation des variables 
            $tabErreurs = array();
            $hasErrors = false;
            $strNom = "";
            if (isset($_REQUEST['id'])) {
                $strId = htmlentities($_REQUEST['id']);
                $leAuteur = AuteurDal::loadAuteurByID($strId);
                if ($leAuteur == NULL) {
                    $tabErreurs[] = 'Cet auteur n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                $tabErreurs[] = 'Aucun auteur n\'a été transmis pour validation !';
                $hasErrors = true;
            }
            if (isset($_GET['option'])) {
                $option = htmlentities($_GET['option']);
            } else {
                $option = 'saisirAuteur';
            }
            switch ($option) {
                case 'saisirAuteur' : {
                        if (!$hasErrors) {
                            include 'vues/v_modifierAuteur.php';
                        } else {
                            $msg = "L'opération de modification n'a pu être menée à terme en raison des erreurs suivantes :";
                            include 'vues/_v_afficherErreurs.php';
                        }
                    }
                    break;
                case 'validerAuteur' : {
                        if (!$hasErrors) {
                            if (isset($_POST['cmdValider'])) {
                                if (!empty($_POST['txtNom'])) {
                                    $strNom = ucfirst(htmlentities($_POST['txtNom']));
                                } else {
                                    $tabErreurs[] = "Le Nom doit être renseigné !";
                                    $hasErrors = true;
                                }
                                if (!$hasErrors) {
                                    $leAuteur->setNom($strNom);
                                    $res = AuteurDal::setAuteur($leAuteur);
                                    if ($res > 0) {
                                        $msg = 'L\'Auteur '
                                                . $leAuteur->getId() . '-'
                                                . $leAuteur->getNom() . ' a été modifié';
                                        include 'vues/_v_afficherMessage.php';
                                        include 'vues/v_consulterAuteur.php';
                                    } else {
                                        $tabErreurs[] = "Une erreur s'est produite dans l'opération de mise à jour";
                                        $hasErrors = true;
                                    }
                                }
                            }
                        }
                        if ($hasErrors) {
                            $msg = "L'opération de modification n'a pu être menée à terme en raison des erreurs suivantes :";
                            include 'vues/_v_afficherErreurs.php';
                        }
                    }
                    break;
            }
        }
        break;
        ////////////////////////////////////////////
        case 'supprimerAuteur': {
            // récupération du code passé dans l'URL
            if (isset($_GET["id"])) {
                $strId = htmlentities($_GET["id"]);
                // appel de la méthode du modèle
                $leAuteur = AuteurDal::loadAuteurByID($strId);
                if ($leAuteur == NULL) {
                    $tabErreurs[] = 'Cet auteur n\'existe pas !';
                    $hasErrors = true;
                } else {
                    // rechercher des ouvrages de ce genre
                    if (AuteurDal::countOuvragesAuteur($leAuteur->GetId()) > 0) {
                        // il y a des ouvrages référencés, suppression impossible
                        $tabErreurs[] = "Il existe des ouvrages qui référencient cet auteur, suppression impossible !";
                        $hasErrors = true;
                    }
                }
            } else {
                // pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErrors[] = "Aucun genre n'a été transmis pour suppression !";
                $hasErrors = true;
            }
            if (!$hasErrors) {
                $res = AuteurDal::delAuteur($leAuteur->getId());
                if ($res > 0) {
                    $msg = 'L\'auteur '
                            . $leAuteur->getId() . ' - ' . $leAuteur->getNom() . ' ' . $leAuteur->getPrenom() . '(' . $leAuteur->getAlias() . ')' . ' a été supprimé';
                    include 'vues/_v_afficherMessage.php';
                    // affichage de la liste des genres
                    $lesAuteurs = AuteurDal::loadAuteurs(1);
                    // afficher le nombre de genres
                    $nbAuteurs = count($lesAuteurs);
                    include 'vues/v_listeAuteurs.php';
                } else {
                    $tabErreurs[] = 'Une erreur s\'est produite dans l\'opération de suppression ! ';
                    $hasErrors = true;
                }
            }
            if ($hasErrors) {
                $msg = "L'opération de suppression n'a pas pu être menée à terme en raison des erreurs suivantes : ";
                $lien = '<a href="index.php?uc=gererAuteurs">Retour à la saisie</a>';
                include 'vues/_v_afficherErreurs.php';
            }
        }
        break;
}
?>