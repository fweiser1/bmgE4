<?php // COUCOU c'est FLOOOOOOOOOWWW
/**
 * Page de gestion des genres

 * @author 
 * @package default
 */
session_start();
// inclure les bibliothèques de fonctions
require_once 'include/_config.inc.php';
require_once 'include/_data.lib.php';
?>

<div id="content">
    <h2>Gestion des Auteurs</h2>
    <a href="index.php?uc=gererAuteurs&action=ajouterAuteur" title="Ajouter">
        Ajouter un auteur
    </a>
    <div class="corps-form">
        <!--- afficher la liste des genres -->
        <fieldset>        
            <legend>Auteurs</legend>
            <div id="object-list">
                <?php
                echo '<span>' . $nbAuteurs . ' auteur(s) trouvé(s)'
                . '</span><br /><br />';
                // afficher un tableau des genres
                if ($nbAuteurs > 0) {
                    // création du tableau
                    echo '<table>';
                    // affichage de l'entete du tableau 
                    echo '<tr>';
                    // création entete tableau avec noms de colonnes  
                    echo '<th>Id</th>';
                    echo '<th>Nom</th>';
                    echo '</tr>';
                    // affichage des lignes du tableau
                    $n = 0;
                    foreach ($lesAuteurs as $unAuteur) {
                        if (($n % 2) == 1) {
                            echo '<tr class="impair">';
                        } else {
                            echo '<tr class="pair">';
                        }
                        // afficher la colonne 1 dans un hyperlien
                        echo '<td><a href="index.php?uc=gererAuteurs&action=consulterAuteur&id='
                        . $unAuteur->getId().'">' . $unAuteur->getId().'</a></td>';
                        // afficher les colonnes suivantes
                    echo '<td>' . $unAuteur->getNom()." ".$unAuteur->getPrenom();
                           // " (".$unAuteur->getAlias().")" . '</td>';
                           if($unAuteur->getAlias() != NULL)
                           {
                               echo " (".$unAuteur->getAlias().")";
                           }
                           echo '</td>';
                        echo '</tr>';
                        $n++;
                    }
                    echo '</table>';
                } else {
                    echo "Aucun auteur trouvé !";
                }
                ?>
            </div>
        </fieldset>
    </div>
</div> 
