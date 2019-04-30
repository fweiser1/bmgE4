<?php

/**
 * Contrôleur secondaire chargé de la gestion des auteurs
 * @package default (mission 4)
 */
require_once 'modele/OuvrageDal.class.php';
require_once 'modele/GenreDal.class.php';
require_once 'modele/AuteurDal.class.php';
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
    $action = 'listerOuvrages';
}
// variables pour la gestion des messages
$msg = '';    // message passé à la vue v_afficherMessage
$lien = '';   // message passé à la vue v_afficherErreurs
// charger la vue en fonction du choix de l'utilisateur
switch ($action) {
    case 'consulterOuvrage' : {
            if (isset($_GET["id"])) {
                $intID = intval(htmlentities($_GET["id"]));
                // récupération des valeurs dans la base
                try {
                    $lOuvrage = OuvrageDal::loadOuvrageById($intID);
                    if ($lOuvrage == NULL) {
                        $tabErreurs[] = "Cet ouvrage n'existe pas !";
                        $hasErrors = true;
                    }
                } catch (Exception $ex) {
                    $tabErreurs[] = $e->getMessage();
                    $hasErrors = true;
                }
            } else {
                // pas d'id dans l'url ni clic sur Valider : c'est animal
                $tabErreurs[] = "Aucun ouvrage n'a été transmis pour consultation !";
                $hasErrors = true;
            }
            if ($hasErrors) {
                $msg = "Une erreur s'est produite : ";
                include 'vues/_v_afficherErreurs.php';
            } else {
                include 'vues/v_consulterOuvrage.php';
            }
        } break;
    case 'ajouterOuvrage' : {
            $strTitre = '';
            $intSalle = 1;
            $strRayon = '';
            $strGenre = '';
            $strDate = '';
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirOuvrage';
            }
            switch ($option) {
                case 'saisirOuvrage': {
                        $lesGenres = genreDal::loadGenres(0);
                        include 'vues/v_ajouterOuvrage.php';
                    } break;
                case 'validerOuvrage': {
                        if (isset($_POST["cmdValider"])) {
                            if (!empty($_POST["txtTitre"])) {
                                $strTitre = ucfirst($_POST["txtTitre"]);
                            }
                            $intSalle = $_POST["rbnSalle"];
                            if (!empty($_POST["txtRayon"])) {
                                $strRayon = ucfirst($_POST["txtRayon"]);
                            }
                            $strGenre = $_POST["cbxGenres"];
                            if (!empty($_POST["txtRayon"])) {
                                $strDate = ucfirst($_POST["txtDate"]);
                            }
                            if (!empty($strTitre) && !empty($strRayon) && !empty($strDate)) {
                                $dateAcquisition = new DateTime($strDate);
                                $curDate = new DateTime(date('Y-m-d'));
                                if ($dateAcquisition > $curDate) {
                                    $tabErreurs[] = "La date d'acquisition doit être antérieure ou égale à la date du jour";
                                    $hasErrors = true;
                                }
                                if (!rayonValide($strRayon)) {
                                    $tabErreurs[] = "Le rayon n'est pas valide, il doit comporter une lettre et un chiffre !";
                                    $hasErrors = true;
                                }
                            } else {
                                if (empty($strTitre)) {
                                    $tabErreurs[] = "Le titre doit être renseigné !";
                                }
                                if (empty($strRayon)) {
                                    $tabErreurs[] = "Le rayon doit être renseigné !";
                                }
                                if (empty($strDate)) {
                                    $tabErreurs[] = "La date d'acquisition doit être renseignée !";
                                }
                                $hasErrors = true;
                            }
                            if (!$hasErrors) {
                                try {
                                    $res = OuvrageDal::addOuvrage($strTitre, $intSalle, $strRayon, $strGenre, $strDate);

                                    if ($res > 0) {
                                        $msg = '<span class="info">L\'ouvrage '
                                                . $strTitre . ' a été ajouté</span>';
                                        $intID = OuvrageDal::getMaxId();
                                        $lOuvrage = OuvrageDal::loadOuvrageById($intID);
                                        if ($lOuvrage) {
                                            include 'vues/v_consulterOuvrage.php';
                                        } else {
                                            $tabErreurs[] = "Cet ouvrage n'existe pas !";
                                            $hasErrors = true;
                                        }
                                    } else {
                                        $tabErreurs[] = "Une erreur s'est produite dans l'opération de l'ajout !";
                                        $hasErrors = true;
                                    }
                                } catch (Exception $ex) {
                                    $tabErreurs[] = "Une exception PDO a été levée !";
                                    $hasErrors = true;
                                }
                            } else {
                                $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                $lien = "<a href='index.php?uc=gererOuvrages&action=ajouterOuvrage'>Retour à la saisie</a>";
                                include 'vues/_v_afficherErreurs.php';
                            }
                        }
                    } break;
            }
        } break;
    case 'modifierOuvrage' : {
        // initialisation des variables
        $strTitre = '';
        $intSalle = 1;
        $strRayon = '';
        $strGenre = '';
        $strDate = '';
        $imgCouv = '';
        //traitement de l'option : saisie ou validation ?
        if (isset($_GET["option"])) {
            $option = htmlentities($_GET["option"]);
        }
        else {
            $option = 'saisirOuvrage';
        }
        // récupération de l'identifiant / en POST ou en GET
        if (isset($_GET["id"])) {
            $intID = intval(htmlentities($_GET["id"]));
            // récupération des données dans la base
            $lOuvrage = OuvrageDal::loadOuvrageById($intID);
            if ($lOuvrage == NULL) {
                $tabErreurs[] = "Cet ouvrage n'existe pas !";
                $hasErrors = true;
            }
        } else {
            // pas d'id dans l'url : c'est anormal
            $tabErreurs[] = "Aucun identifiant d'ouvrage n'a été transmis pour modification !";
            $hasErrors = true;
        }
        // On ne rentre dans le switch que si :
        // l'id est transmis et
        // l'id de l'ouvrage existe
        if (!$hasErrors) {
            switch ($option) {
                case 'saisirOuvrage' : {
                    // la fonction "afficherListe()" manipule un tableau associatif classique et non objet : style = 0
                    $lesGenres = GenreDal::loadGenres(0);
                    include 'vues/v_modifierOuvrage.php';
                } break;
                case 'validerOuvrage' : {
                    if (!empty($_FILES['btnCouv']['name'])){
                        $imgCouv = $_FILES['btnCouv'];
                    }
                    // si on a cliqué sur Valider
                    if (isset($_POST["cmdValider"])) {
                        // mémoriser les données pour les réafficher dans le formulaire
                        $intID = intval($_POST["txtID"]);
                        // récupération des valeurs saisies
                        if (!empty($_POST["txtTitre"])) {
                            $strTitre = ucfirst($_POST["txtTitre"]);
                        }
                        $intSalle = $_POST["rbnSalle"];
                        if (!empty($_POST["txtRayon"])) {
                            $strRayon = ucfirst($_POST["txtRayon"]);
                        }
                        $strGenre = $_POST["cbxGenres"];
                        $leGenre = GenreDal::loadGenreById($strGenre);
                        if (!empty($_POST["txtRayon"])) {
                            $strDate = $_POST["txtDate"];
                        }
                        if (!empty($_FILES['btnCouv']['name']) 
                                && ($_FILES['btnCouv']['type'] == 'image/jpg'
                                || $_FILES['btnCouv']['type'] == 'image/jpeg'
                                || $_FILES['btnCouv']['type'] == 'image/png'
                                || $_FILES['btnCouv']['type'] == 'image/gif')){
                            rename($_FILES['btnCouv']['tmp_name'], PATH_TO_IMG.$intID.".jpg");
                        }
                        
                        
                        //test zones obligatoires
                        if (!empty($strTitre) &&
                                !empty($strRayon) &&
                                !empty($strDate)) {
                            // test de cohérence
                            // test de la date d'acquisition
                            $dateAcquisition = new DateTime($strDate);
                            $curDate = new DateTime (date('Y-m-d'));
                            if ($dateAcquisition > $curDate) {
                                // la date d'acquisition est postérieur à la date du jour
                                $tabErreurs[] = 'La date d\'acquisition doit être antérieur ou égale à la date du jour';
                                $hasErrors = true;
                            }
                            // controel du rayon
                            if(!rayonValide($strRayon)) {
                                $tabErreurs[] = 'Le rayon n\'est pas valide, il doit comporter une lettre et un chiffre !';
                                $hasErrors = true;
                            }
                        }
                        else {
                            if (empty($strTitre)) {
                                $tabErreurs[] = "Le titre doit être renseigné !";
                            }
                            if (empty($strRayon)) {
                                $tabErreurs[] = "Le rayon doit être renseigné !";
                            }
                            if (empty($strDate)) {
                                $tabErreurs[] = "Le titre date d'acquisition être renseigné !";
                            }
                            $hasErrors = true;
                        }
                        if (!$hasErrors) {
                            $lOuvrage = new Ouvrage($intID, $strTitre, $intSalle, $strRayon, $leGenre, $dateAcquisition);
                            try {
                                // mise à jour dans la base de données
                                $res = OuvrageDal::setOuvrage($lOuvrage);
                                if($res > 0 || !empty($_FILES['btnCouv']['name']) 
                                    && ($_FILES['btnCouv']['type'] == 'image/jpg'
                                    || $_FILES['btnCouv']['type'] == 'image/jpeg'
                                    || $_FILES['btnCouv']['type'] == 'image/png'
                                    || $_FILES['btnCouv']['type'] == 'image/gif')) {
                                    $msg = '<span class="info">L\'ouvrage '.$strTitre.' a été modifié</span>';
                                    // récupération des valeurs dans la base
                                    $lOuvrage = OuvrageDal::loadOuvrageById($intID);
                                    if ($lOuvrage) {
                                        include 'vues/v_consulterOuvrage.php';
                                    }
                                }
                                else {
                                    $tabErreurs[] = 'Une erreur s\'est produite lors de l\'opération de mise à jour !';
                                    $hasErrors = true;
                                }
                            } catch (PDOException $e) {
                                    $tabErreurs[] = 'Une exception a été levée !';
                                    $hasErrors = true;
                            }
                        }
                    }
                    else {
                        // pas d'id dans l'url ni clic sur Valider : c'est anormal
                        $tabErreurs[] = 'Accès interdit !';
                        $hasErrors = true;
                    }
                }
            }
        }
        // affichage des erreurs
        if ($hasErrors){
            $msg = "Une erreur s'est produite :";
            include 'vues/_v_afficherErreurs.php';
        }
    } break;
    case 'supprimerOuvrage' : {
        // récupération de l'identifiant du ouvrage passé dans l'Url
        if (isset($_GET["id"])) {
                $intID = intval(htmlentities($_GET["id"]));
                // récupération des valeurs dans la base
                    $lOuvrage = OuvrageDal::loadOuvrageById($intID);
                    if ($lOuvrage == NULL) {
                        $tabErreurs[] = "Cet ouvrage n'existe pas !";
                        $hasErrors = true;
                    }
            } else {
                // pas d'id dans l'url ni clic sur Valider : c'est animal
                $tabErreurs[] = "Aucun identifiant n'a été transmis pour suppression !";
                $hasErrors = true;
            }
            if(!$hasErrors)
            {
                try {
                   $nbAuteursOuvrage = OuvrageDal::countAuteursOuvrage($intID);
                   if ($nbAuteursOuvrage == 0) {
                       // c'est bon, on peut le supprimer
                       try {
                           $res = OuvrageDal::delOuvrage($intID);
                           if ($res > 0){
                               $msg = 'L\'ouvrage '.$lOuvrage->getTitre().' a été supprimé ';
                               include 'vues/_v_afficherMessage.php';
                               // Affichage de la liste des ouvrages
                              $lesOuvrages = OuvrageDal::loadOuvrages(1);
                              // afficher le nombre d'ouvrages
                              $nbOuvrages = count($lesOuvrages);
                              include 'vues/v_listeOuvrages.php';
                           }
                       } 
                       catch (PDOException $e) {
                            $tabErreurs[] = "Une exception PDO a été levée !";
                            $hasErrors = true;
                       }
                   }
                   else {
                       $tabErreurs[] = "Cet ouvrage est lié à des auteurs, suppression impossible !";
                       $hasErrors = true;
                   }
                } 
                catch (PDOException $e) {
                    $tabErreurs[] = $e->getMessage();
                    $hasErrors = true;
                }
            }
            if ($hasErrors){
                $msg = "Une erreur s'est produite :";
                include 'vues/_v_afficherErreurs.php';
            }
        } break;
    case 'listerOuvrages' : {
            $lesOuvrages = OuvrageDal::loadOuvrages(1);
            $nbOuvrages = count($lesOuvrages);
            include 'vues/v_listeOuvrages.php';
        } break;
    case 'ajouterAuteurOuvrage' : {
            $lesAuteurs = AuteurDal::loadAuteurs(1);
            $nbAuteurs = count($lesAuteurs);
            $nbAuteursAjout = 0;
            $intID = $_GET['id'];
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'listerAuteurs';
            }
            switch ($option) {
                case 'listerAuteurs': {
                    include 'vues/v_ajouterAuteurOuvrage.php';
                } break;
                case 'validerAuteurOuvrage': {
                    foreach ($lesAuteurs as $unAuteur) {
                        if (isset($_POST['ckbAjouterAuteur'.$unAuteur->getId()])) {
                            if (!$hasErrors) {
                                try {
                                    $res = OuvrageDal::addAuteurOuvrage($intID, $unAuteur);
                                    if ($res > 0) {
                                        $msg = '<span class="info">Le ou les auteurs ont été ajoutés</span>';
                                    } else {
                                        $tabErreurs[] = "Une erreur s'est produite dans l'opération de l'ajout !";
                                        $hasErrors = true;
                                    }
                                } catch (Exception $ex) {
                                    $tabErreurs[] = "Une exception PDO a été levée !";
                                    $hasErrors = true;
                                }
                            }
                            else {
                                $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                $lien = "<a href='index.php?uc=gererOuvrages&action=listerOuvrages'>Retour à la saisie</a>";
                                include 'vues/_v_afficherErreurs.php';
                            }
                        }
                    }
                    $lOuvrage = OuvrageDal::loadOuvrageById($intID);
                    if ($lOuvrage) {
                        include 'vues/v_consulterOuvrage.php';
                    } else {
                        $tabErreurs[] = "Cet ouvrage n'existe pas !";
                        $hasErrors = true;
                    }
                } break;
            }
            
        } break;
}

