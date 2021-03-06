<div id="content">
    <h2>Gestion des ouvrages</h2>
    <a href="index.php?uc=gererOuvrages&action=ajouterOuvrage" title="Ajouter">
        Ajouter un ouvrage
    </a>
    <div class="corps-form">
        <!--- afficher la liste des genres -->
        <fieldset>	
            <legend>Ouvrages</legend>
            <div id="object-list">
                <?php
                echo '<span>'.$nbOuvrages.' ouvrage(s) trouvé(s)'
                        . '</span><br /><br />';
                // afficher un tableau des genres
                if ($nbOuvrages > 0) {
                    // création du tableau
                    echo '<table>';
                    // affichage de l'entete du tableau 
                    echo '<tr>';
                    // création entete tableau avec noms de colonnes  
                    echo '<th>ID</th>';
                    echo '<th>Titre</th>';
                    echo '<th>Genre</th>';
                    echo '<th>Auteur</th>';
                    echo '<th>Salle</th>';
                    echo '<th>Rayon</th>';
                    echo '<th>Dernier prêt</th>';
                    echo '<th>Disponibilite</th>';
                    echo '</tr>';
                    // affichage des lignes du tableau
                    $n = 0;
                    foreach($lesOuvrages as $unOuvrage)  {                                                            
                        if (($n % 2) == 1) {
                            echo '<tr class="impair">';
                        }
                        else {
                            echo '<tr class="pair">';
                        }
                        // afficher la colonne 1 dans un hyperlien
                        echo '<td><a href="index.php?uc=gererOuvrages&action=consulterOuvrage&id='
                            .$unOuvrage->getNoOuvrage().'">'.$unOuvrage->getNoOuvrage().'</a></td>';
                        // afficher les colonnes suivantes
                        echo '<td>'.$unOuvrage->getTitre().'</td>';
                        echo '<td>'.$unOuvrage->getLeGenre()->getLibelle().'</td>';
                        if($unOuvrage->getListeNomsAuteurs() == 'Indéterminé'){
                            echo '<td class="erreur">'.$unOuvrage->getListeNomsAuteurs().'</td>';
                        }
                        else {
                            echo '<td>'.$unOuvrage->getListeNomsAuteurs().'</td>';
                        }
                        echo '<td>'.$unOuvrage->getSalle().'</td>';
                        echo '<td>'.$unOuvrage->getRayon().'</td>';
                        echo '<td>'.$unOuvrage->getDernierPret().'</td>';
                        if($unOuvrage->getDisponibilite() == 'D'){
                            echo '<td class="center"><img src ="img/dispo.png"/></td>';
                        }
                        else {
                            echo '<td class="center"><img src ="img/emprunte.png"/></td>';
                        }                       
                        echo '</tr>';
                        $n++;
                    }
                    echo '</table>';
                }
                else {			
                    echo "Aucun ouvrage trouvé !";
                }	
                ?>
            </div>
        </fieldset>
    </div>
</div>          
       