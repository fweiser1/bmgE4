<div id="content">
    <h2>Gestion des auteurs</h2>
    <div id="object-list">
        <form action="index.php?uc=gererOuvrages&action=ajouterAuteurOuvrage&option=validerAuteurOuvrage&id=<?php echo $_GET['id'] ?>" method="post">
            <div class="corps-form">
                <fieldset>
                    <legend>Ajouter un ou des auteurs à l'ouvrage n°<?php echo $_GET['id'] ?></legend>
                    <?php
                    if ($nbAuteurs > 0) {
                    ?>
                        <table>
                            <?php
                                echo '<br/>';
                                echo '<span>'.$nbAuteurs.' auteur(s) trouvé(s)'
                                . '</span><br /><br />';
                            ?>
                            <tr>
                                <th>ID</th>
                                <th>Auteur</th>
                                <th>Ajouter</th>
                            </tr>
                            <?php
                            $n = 0;
                            foreach($lesAuteurs as $unAuteur) {
                                if (($n % 2) == 1) {
                                    echo '<tr class="impair">';
                                }
                                else {
                                    echo '<tr class="pair">';
                                }
                                echo '<td>'.$unAuteur->getId().'</td>'
                                    .'<td>'.$unAuteur->getNom().'</td>'
                                    . '<td><input type="checkbox" id="ckbAjouterAuteur'.$unAuteur->getId().'" name="ckbAjouterAuteur'.$unAuteur->getId().'"</td>'
                                . '</tr>';
                                $n++;
                            }
                            ?>
                        </table>
                    <?php
                    }
                    ?>
                </fieldset>
            </div>
            <div class="pied-form">
                <p>
                    <input id="cmdValider" name="cmdValider" 
                           type="submit"
                           value="Ajouter"
                    />
                </p> 
            </div>
        </form>
    </div>
</div>          


