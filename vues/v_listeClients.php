<?php
/** 
 * Page de gestion des auteurs

 * @author 
 * @package default
*/
?>
<div id="content">
    <h2>Gestion des clients</h2>
    <a href="index.php?uc=gererClients&action=ajouterClient" title="Ajouter">
        Ajouter un client
    </a>
    <div class="corps-form">
        <!--- afficher la liste des auteurs -->
        <fieldset>	
            <legend>Clients</legend>
            <div id="object-list">
                <?php
                echo '<span>'.$nbClients.' client(s) trouvé(s)'
                        . '</span><br /><br />';
                // afficher un tableau des auteurs
                if ($nbClients > 0) {
                    // création du tableau
                    echo '<table>';
                    // affichage de l'entete du tableau 
                    echo '<tr>'
                            . '<th>ID</th>'
                            . '<th>Nom</th>'
                            . '<th>Prénom</th>'
                            . '<th>Rue</th>'
                            . '<th>Code Postal</th>'
                            . '<th>Ville</th>'
                            . '<th>Date d\'inscription</th>'
                            . '<th>Mel</th>'
                            . '<th>État</th>'
                        . '</tr>';
                    // affichage des lignes du tableau
                    $n = 0;
                    foreach($lesClients as $unClient) {
                        if (($n % 2) == 1) {
                            echo '<tr class="impair">';
                        }
                        else {
                            echo '<tr class="pair">';
                        }
                        // afficher la colonne 1 dans un hyperlien
                        echo '<td><a href="index.php?uc=gererClients&action=consulterClient&id='
                            .$unClient->getID().'">'.$unClient->getID().'</a></td>';
                        // afficher les colonnes suivantes
                        echo '<td>'.$unClient->getNom().'</td>';
                        echo '<td>'.$unClient->getPrenom().'</td>';
                        echo '<td>'.$unClient->getRue().'</td>';
                        echo '<td>'.$unClient->getCodePost().'</td>';
                        echo '<td>'.$unClient->getVille().'</td>';
                        echo '<td>'.$unClient->getDateInscr().'</td>';
                        echo '<td>'.$unClient->getMel().'</td>';
                        echo '<td>'.$unClient->getEtat().'</td>';
                        echo '</tr>';
                        $n++;
                    }
                    echo '</table>';
                }
                else {			
                    echo "Aucun client trouvé !";
                }		
                ?>
            </div>
        </fieldset>
    </div>
</div>          
