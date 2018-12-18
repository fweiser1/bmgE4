<?php

require_once("modele/ouvrageDal.class.php");
require_once("include/_reference.lib.php");

if (!isset($_REQUEST['action'])) {
    $action = 'listerOuvrages';
} else {
    $action = $_REQUEST['action'];
}

// variables pour la gestion des messages
$msg = '';  // message passé à la vue v_afficherMessage
$lien = ''; // message passé à la vue v_afficherErreurs
// variables pour la gestion des messages
$titrePage = 'Gestion des ouvrages';
// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;

switch ($action) {
    case 'listerOuvrages': {
            // récupérer les genres
            $lesOuvrages = OuvrageDal::loadOuvrages(1);
            // afficher le nombre de genres
            $nbOuvrages = count($lesOuvrages);
            include("vues/v_listerOuvrages.php");
        }
        break;
        case 'consulterOuvrage': {
            // récupération du code passé dans l'URL
            if (isset($_GET["id"])) {
                $strId = strtoupper(htmlentities($_GET["id"]));
                // appel de la méthode du modèle
                $leAuteur = OuvrageDal::loadOuvrageByID($strId);
                if ($leOuvrage == NULL) {
                    $tabErreurs[] = 'Cet Ouvrage n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                // pas d'id dans l'url ni de clic sur Valider : c'est anormal
                $tabErreurs[] = "Aucun Ouvrage n'a été transmis pour consultation !";
                $hasErrors = true;
            }
            if ($hasErrors) {
                include 'vues/_v_afficherErreurs.php';
            } else {
                include 'vues/v_consulterOuvrage.php';
            }
        }
        break;
    case 'ajouterOuvrage': {
            // traitement de l'option : saisie ou validation ?
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirOuvrage';
            }
            switch ($option) {
                case 'saisirOuvrage' : {
                        include 'vues/v_ajouterOuvrage.php';
                    } break;
                case 'validerOuvrage' : {
                        if (isset($_POST["cmdValider"])) {
                            
                            if (!empty($_POST["txtTitre"])) {
                                $strTitre = ucfirst(htmlentities($_POST["txtTitre"]));
                            }
                            
                            if (!empty($_POST["txtSalle"])) {
                                $strSalle = htmlentities($_POST["txtSalle"]);
                            }
                            else
                            {
                                $strSalle = NULL;
                            }
                            
                            if (!empty($_POST["txtRayon"])) {
                                $strRayon = ucfirst(htmlentities($_POST["txtRayon"]));
                            }
                            else
                            {
                                $strRayon = NULL;
                            }
                            
                            if (!empty($_POST["txtCodeGenre"])) {
                                $strCodeGenre = ucfirst(htmlentities($_POST["txtCodegenre"]));
                            }
                            
                            if (!empty($_POST["txtDateAcquisition"])) {
                                $strDateAcquisition = htmlentities($_POST["txtDateAcquisition"]);
                            }
                            else
                            {
                                $strDateAcquisition = NULL;
                            }

                            
                            // test zones obligatoires
                            if (!empty($strTitre)) {
                                // les zones obligatoires sont présentes
                                // tests de cohérence 
                                // contrôle d'existence d'un genre avec le même code
                                $doublon = OuvrageDal::loadOuvrageByID($strTitre);
                                if ($doublon != NULL) {
                                    // signaler l'erreur
                                    $tabErreurs[] = 'Il existe déjà un ouvrage avec ce numero !';
                                    $hasErrors = true;
                                }
                            } else {
                                // une ou plusieurs valeurs n'ont pas été saisies
                                if (empty($strTitre)) {
                                    $tabErreurs[] = "Le titre doit être renseigné !";
                                }                       
                                $hasErrors = true;
                            }
                            if (!$hasErrors) {
                                $res = OuvrageDal::addOuvrage($strTitre, $strSalle, $strRayon, $strCodeGenre, $strDateAcquisition);
                                if ($res > 0) {
                                    $msg = 'L\'ouvrage ' . $strTitre . ' a été ajouté';
//                                  $leOuvrage = new Ouvrage($strTitre, $strSalle, $strRayon, $strCodeGenre, $strDateAcquisition);
                                    include 'vues/_v_afficherMessage.php';
//                                    include 'vues/v_consulterOuvrage.php';
                                } else {
                                    $tabErreurs["Erreur"] = 'Une erreur s\'est produite dans l\'opération d\'ajout !';
                                    $hasErrors = true;
                                }
                            }
                            if ($hasErrors) {
                                $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                $lien = '<a href="index.php?uc=gererOuvrages&action=ajouterOuvrage">Retour à la saisie</a>';
                                include 'vues/_v_afficherErreurs.php';
                            }
                        }
                    } break;
            }
        }
        break;
        ///////////////////////////////////////////////////////////////
        case 'modifierOuvrage': {
            // initialisation des variables 
            $tabErreurs = array();
            $hasErrors = false;
            $strTitre = "";
            if (isset($_REQUEST['id'])) {
                $strId = htmlentities($_REQUEST['id']);
                $leOuvrage = OuvrageDal::loadOuvrageByID($strId);
                if ($leOuvrage == NULL) {
                    $tabErreurs[] = 'Cet ouvrage n\'existe pas !';
                    $hasErrors = true;
                }
            } else {
                $tabErreurs[] = 'Aucun ouvrage n\'a été transmis pour validation !';
                $hasErrors = true;
            }
            if (isset($_GET['option'])) {
                $option = htmlentities($_GET['option']);
            } else {
                $option = 'saisirOuvrage';
            }
            switch ($option) {
                case 'saisirOuvrage' : {
                        if (!$hasErrors) {
                            include 'vues/v_modifierOuvrage.php';
                        } else {
                            $msg = "L'opération de modification n'a pu être menée à terme en raison des erreurs suivantes :";
                            include 'vues/_v_afficherErreurs.php';
                        }
                    }
                    break;
                case 'validerOuvrage' : {
                        if (!$hasErrors) {
                            if (isset($_POST['cmdValider'])) {
                                if (!empty($_POST['txtTitre'])) {
                                    $strTitre = ucfirst(htmlentities($_POST['txtTitre']));
                                } 
                                else 
                                {
                                    $tabErreurs[] = "Le Titre doit être renseigné !";
                                    $hasErrors = true;
                                }
                                if (!empty($_POST["txtSalle"])) {
                                    $strSalle = htmlentities($_POST["txtSalle"]);
                                }
                                else
                                {
                                    $strSalle = NULL;
                                }
                                if (!empty($_POST["txtRayon"])) {
                                    $strRayon = ucfirst(htmlentities($_POST["txtRayon"]));
                                }
                                else
                                {
                                    $strAlias = NULL;
                                }
                                    if (!empty($_POST["txtCodeGenre"])) {
                                    $strCodeGenre = htmlentities($_POST["txtCodeGenre"]);
                                }
                                if (!empty($_POST["txtDateAcquisition"])) {
                                    $strDateAcquisition = htmlentities($_POST["txtDateAcquisition"]);
                                }
                                else
                                {
                                    $strDateAcquisition = NULL;
                                }
                                if (!$hasErrors) {
                                    $leOuvrage->setTitre($strTitre);
                                    $leOuvrage->setSalle($strSalle);
                                    $leOuvrage->setRayon($strRayon);
                                    $leOuvrage->setCodeGenre($strCodeGenre);
                                    $leOuvrage->setDateAcquisition($strDateAcquisition);
                                    $res = OuvrageDal::setOuvrage($leOuvrage);
                                    if ($res > 0) {
                                        $msg = 'L\'ouvrage ' . $strTitre . ' a été modifié';
                                        include 'vues/_v_afficherMessage.php';
                                        include 'vues/v_consulterOuvrage.php';
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
        case 'supprimerOuvrage': {
            // récupération du code passé dans l'URL
            if (isset($_GET["id"])) {
                $strId = htmlentities($_GET["id"]);
                // appel de la méthode du modèle
                $leOuvrage = OuvrageDal::loadOuvrageByID($strId);
                if ($leOuvrage == NULL) {
                    $tabErreurs[] = 'Cet ouvrage n\'existe pas !';
                    $hasErrors = true;
                } else {
                    // rechercher des ouvrages de ce genre
                    if (OuvrageDal::countOuvrages($leOuvrage->GetNo()) > 0) {
                        // il y a des ouvrages référencés, suppression impossible
                        $tabErreurs[] = "suppression impossible !";
                        $hasErrors = true;
                    }
                }
            } else {
                // pas d'id dans l'url ni clic sur Valider : c'est anormal
                $tabErrors[] = "Aucun ouvrage n'a été transmis pour suppression !";
                $hasErrors = true;
            }
            if (!$hasErrors) {
                $res = OuvrageDal::delOuvrage($leOuvrage->getNo());
                if ($res > 0) {
                    $msg = 'L\'ouvrage ' . $leOuvrage->getTitre() .  ' a été supprimé';
                    include 'vues/_v_afficherMessage.php';
                    // affichage de la liste des genres
                    $lesOuvrages = OuvrageDal::loadOuvrages(1);
                    // afficher le nombre de genres
                    $nbOuvrages = count($lesOuvrages);
                    include 'vues/v_listerOuvrages.php';
                } else {
                    $tabErreurs[] = 'Une erreur s\'est produite dans l\'opération de suppression ! ';
                    $hasErrors = true;
                }
            }
            if ($hasErrors) {
                $msg = "L'opération de suppression n'a pas pu être menée à terme en raison des erreurs suivantes : ";
                $lien = '<a href="index.php?uc=gererOuvrages">Retour à la saisie</a>';
                include 'vues/_v_afficherErreurs.php';
            }
        }
        break;
}
?>