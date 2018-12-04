
<div id="content">
    <h2>Gestion des genres</h2>
    <div id="object-list">   
        <form action="index.php?uc=gererAuteurs&action=modifierAuteur&option=validerAuteur&id=<?php echo $leAuteur->getId() ?>" method="post">
            <div class="corps-form">
                <fieldset>
                    <legend>Modifier un auteur</legend>
                    <table>
                        <tr>
                            <td valign="top">
                                <label for="txtLibelle">
                                    Nom :
                                </label>
                            </td>
                            <td>
                                <input 
                                    type="text" id="txtNom" 
                                    name="txtNom"
                                    size="50" maxlength="50"
                                    value="<?php echo $leAuteur->getNom() ?>"
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
                                    value="<?php echo $leAuteur->getPrenom() ?>"
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
                                    value="<?php echo $leAuteur->getAlias() ?>"
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
                                    size="50" maxlength="255"
                                    value="<?php echo $leAuteur->getNotes() ?>"
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
                           value="Modifier"
                           />
                </p> 
            </div>
        </form>
    </div>
</div>