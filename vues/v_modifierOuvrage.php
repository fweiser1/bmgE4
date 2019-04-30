        <div id="content">
            <h2>Gestion des ouvrages</h2>
            <div id="object-list">
                        <form action="index.php?uc=gererOuvrages&action=modifierOuvrage&option=validerOuvrage&id=<?php echo $lOuvrage->getNoOuvrage() ?>"  method="post" enctype="multipart/form-data">
                            <div class="corps-form">
                                <fieldset>
                                    <legend>Modifier un ouvrage</legend>
                                    <table>
                                        <tr>
                                            <td>
                                                <label for="txtID">
                                                    ID :
                                                </label>
                                            </td>
                                            <td>
                                                <input 
                                                    type="text" id="txtID" 
                                                    name="txtID"
                                                    size="5" 
                                                    readonly="readonly"
                                                    value="<?php echo $lOuvrage->getNoOuvrage() ?>"
                                                />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="txtTitre">
                                                    Titre :
                                                </label>
                                            </td>
                                            <td>
                                                <input 
                                                    type="text" id="txtTitre" 
                                                    name="txtTitre"
                                                    size="50" maxlength="128"
                                                    value="<?php echo $lOuvrage->getTitre()?>"
                                                />
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                <label for="rbnSalle1">
                                                    Salle :
                                                </label>
                                            </td>
                                            <td>
                                                <input 
                                                    type="radio" id="rbnSalle1" 
                                                    name="rbnSalle"
                                                    value="1"
                                                    <?php 
                                                        if($lOuvrage->getSalle() == 1) {
                                                            echo 'checked="checked"';
                                                        }
                                                    ?>
                                                />
                                                <label>1</label>
                                                <input 
                                                    type="radio" id="rbnSalle2" 
                                                    name="rbnSalle"
                                                    value="2"
                                                    <?php 
                                                        if($lOuvrage->getSalle() == 2) {
                                                            echo 'checked="checked"';
                                                        }
                                                    ?>
                                                />
                                                 <label>2</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="txtRayon">
                                                    Rayon :
                                                </label>
                                            </td>
                                            <td>
                                                <input 
                                                    type="text" id="txtRayon" 
                                                    name="txtRayon"
                                                    size="2" maxlength="2"
                                                    <?php 
                                                        if(!empty($lOuvrage->getrayon())) {
                                                            echo ' value="'.$lOuvrage->getRayon().'"';
                                                        }
                                                    ?>
                                                />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="cbxGenres">
                                                    Genre :
                                                </label>
                                            </td>
                                            <td>
                                               <?php 
                                                afficherListe($lesGenres, "cbxGenres", $lOuvrage->getleGenre()->getCode(), "");
                                               ?>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>
                                                <label for="txtDate">
                                                    Acquisition :
                                                </label>
                                            </td>
                                            <td>
                                                <input 
                                                    type="text" id="txtDate" 
                                                    name="txtDate"
                                                    <?php  
                                                        if(empty($lOuvrage->getDateAcquisition())) {
                                                            echo ' value="'.$lOuvrage->getDateAcquisition().'"';
                                                        }      
                                                        else
                                                        {
                                                             echo ' value="'.date('Y-m-d').'"';
                                                        }
                                                    ?>
                                                />
                                            </td>
                                        </tr>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                                        <?php
                                        if (!couvertureExiste($lOuvrage->getNoOuvrage())) {
                                            echo '<tr>
                                                <td>
                                                    <label for="btnCouv">
                                                        Couverture :
                                                    </label>
                                                </td>
                                                <td>
                                                    <input
                                                        type="file" id="btnCouv" 
                                                        name="btnCouv"
                                                    />
                                                </td>
                                            </tr>';
                                        }
                                        ?>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->                                        
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