<?php
/**
 * Page de gestion des genres

 * @author 
 * @package default
 */
// inclure les bibliothèques de fonctions
require_once 'include/_config.inc.php';
?>

<div id="content">
    <h2>Gestion des auteurs</h2>
    <div id="object-list">             
        <form action="index.php?uc=gererAuteurs&action=ajouterAuteur&option=validerAuteur" method="post">
            <div class="corps-form">
                <fieldset>
                    <legend>Ajouter un auteur</legend>
                    <table>
                        <tr>
                            <td>
                                <label for="txtId">
                                    Id :
                                </label>
                            </td>
                            <td>
                                <input 
                                    type="text" id="txtId" 
                                    name="txtId"
                                    size="3" maxlength="3"
                                    <?php
                                    if (!empty($strId)) {
                                    echo ' value="' . $strId . '"';
                                    }
                                    ?>
                                    />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <label for="txtNom">
                                    Nom :
                                </label>
                            </td>
                            <td>
                                <input 
                                    type="text" id="txtNom" 
                                    name="txtNom"
                                    size="50" maxlength="50"
                                    <?php
                                    if (!empty($strNom)) {
                                    echo ' value="' . $strNom . '"';
                                    }
                                    ?>
                                    />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <label for="txtPrenom">
                                    Prénom :
                                </label>
                            </td>
                            <td>
                                <input 
                                    type="text" id="txtPrenom" 
                                    name="txtPrenom"
                                    size="50" maxlength="50"
                                    <?php
                                    if (!empty($strPrenom)) {
                                    echo ' value="' . $strPrenom . '"';
                                    }
                                    ?>
                                    />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <label for="txtAlias">
                                    Alias :
                                </label>
                            </td>
                            <td>
                                <input 
                                    type="text" id="txtAlias" 
                                    name="txtAlias"
                                    size="50" maxlength="50"
                                    <?php
                                    if (!empty($strAlias)) {
                                    echo ' value="' . $strAlias . '"';
                                    }
                                    ?>
                                    />
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <label for="txtNotes">
                                    Notes :
                                </label>
                            </td>
                            <td>
                                <input 
                                    type="text" id="txtNotes" 
                                    name="txtNotes"
                                    size="50" maxlength="50"
                                    <?php
                                    if (!empty($strNotes)) {
                                    echo ' value="' . $strNotes . '"';
                                    }
                                    ?>
                                    />
                            </td>
                        </tr>
                    </table>
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