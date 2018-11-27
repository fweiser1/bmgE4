<div id="content">
    <h2>Gestion des genres</h2>
    <div id="object-list">                  
        <div class="corps-form">
            <fieldset>
                <legend>Consulter un auteur</legend>                        
                <div id="breadcrumb">
                    <a href="index.php?uc=gererAuteurs&action=ajouterAuteur">Ajouter</a>&nbsp;
                    <a href="index.php?uc=gererAuteurs&action=modifierAuteur&id=<?php echo $leAuteur->getId() ?>">Modifier</a>&nbsp;
                    <a href="index.php?uc=gererAuteurs&action=supprimerAuteur&id=<?php echo $leAuteur->getId() ?>">Supprimer</a>
                </div>
                <table>
                    <tr>
                        <td class="h-entete">
                            Id :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leAuteur->getId() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Nom :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leAuteur->getNom() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Prénom :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leAuteur->getPrenom() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Alias :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leAuteur->getAlias() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Notes :
                        </td>
                        <td class="h-valeur">
                            <?php echo $leAuteur->getNotes() ?>
                        </td>
                    </tr>
                </table>
            </fieldset>                    
        </div>
    </div>
</div>    