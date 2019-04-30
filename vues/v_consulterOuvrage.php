<div id="content">
    <h2>Gestion des ouvrages</h2>
    <?php
    if (strlen($msg) > 0) {
        echo '<span class="info">' . $msg . '</span>';
    }
    ?>
    <div id="object-list">    
        <div class="corps-form">
            <fieldset>
                <legend>Consulter un ouvrage</legend>                        
                <div id="breadcrumb">
                    <a href="index.php?uc=gererOuvrages&action=ajouterOuvrage">Ajouter</a>&nbsp;
                    <a href="index.php?uc=gererOuvrages&action=modifierOuvrage&option=saisirOuvrage&id=<?php echo $lOuvrage->getNoOuvrage() ?>">Modifier</a>&nbsp;
                    <a href="index.php?uc=gererOuvrages&action=supprimerOuvrage&id=<?php echo $lOuvrage->getNoOuvrage() ?>">Supprimer</a>&nbsp;
                    <a href="index.php?uc=gererOuvrages&action=ajouterAuteurOuvrage&option=listerAuteurs&id=<?php echo $lOuvrage->getNoOuvrage() ?>">Ajouter un Auteur</a>
                </div>
                <table>
                    <tr>
                        <td class="h-entete">
                            ID :
                        </td>
                        <td class="h-valeur">
                            <?php echo $intID ?>
                        </td>
                        <td class="right h-valeur" rowspan="8">
                            <?php echo couvertureOuvrage($lOuvrage->getNoOuvrage(), $lOuvrage->getTitre()) ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Titre :
                        </td>
                        <td class="h-valeur">
                            <?php echo $lOuvrage->getTitre() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Auteurs(s) :
                        </td>
                        <td class="h-valeur">
                            <?php echo $lOuvrage->getListeNomsAuteurs() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Date d'acquisition :
                        </td>
                        <td class="h-valeur">
                            <?php echo $lOuvrage->getDateAcquisition() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Genre :
                        </td>
                        <td class="h-valeur">
                            <?php echo $lOuvrage->getLeGenre()->getLibelle() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Salle et rayon :
                        </td>
                        <td class="h-valeur">
                            <?php echo $lOuvrage->getSalle() . ', ' . $lOuvrage->getRayon() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Dernier prêt :
                        </td>
                        <td class="h-valeur">
                            <?php echo $lOuvrage->getDernierPret() ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="h-entete">
                            Disponibilité :
                        </td>
                        <td class="h-valeur">
                            <?php
                            if ($lOuvrage->getDisponibilite() == "D") {
                                echo '<img src="img/dispo.png" alt="" />';
                            } else {
                                echo '<img src="img/emprunte.png" alt="" />';
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </fieldset>                    
        </div>
    </div>
</div>

