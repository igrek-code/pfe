<?php
    require_once("../config.php");
    
    if(isset($_GET["typeProduction"]) && $_GET["typeProduction"] != "" && isset($_GET["codepro"]) && $_GET["codepro"] != ""){
        $codepro = mysqli_real_escape_string($db,$_GET["codepro"]);
        switch ($_GET["typeProduction"]) {
            case 'publication':
                $sql = "SELECT * FROM publication WHERE codepro='".$codepro."'";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $titre = $row["titre"];
                    $doi = $row["doi"];
                    $nvol = $row["nvol"];
                    $nissue = $row["nissue"];
                    $coderevue = $row["coderevue"];
                    $url = $row["url"];
                    $idspe = $row["idspe"];
                    $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $nomspe = mysqli_fetch_array($result)["nomspe"];
                    }
                    $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                        SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                    )";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $nomDomaine = mysqli_fetch_array($result)["nom"];
                    }
                    $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $date = mysqli_fetch_array($result2)["date"]; 
                    }
                    $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $motscles = array();
                        while($row = mysqli_fetch_array($result2)){
                            $motscles[] = $row["mot"];
                        }
                    }
                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                        SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $row2 = mysqli_fetch_array($result2);
                        $auteurprinc = $row2["nom"];
                        $idcherauteurprinc = $row2["idcher"];
                    }
                    else{
                        $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            $idcherauteurprinc = 0;
                        }
                    }
                    $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $coauteurs = array();
                        while($row2 = mysqli_fetch_array($result2)){
                            $coauteurs[] = $row2;
                        }
                    }
                    /* ---------- PARTIE REVUE ------------ */
                    /*$sql = "SELECT * FROM revue WHERE coderevue='".$coderevue."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $row2 = mysqli_fetch_array($result2);
                        $nomrevue = $row2["nom"];
                        $periodicite = $row2["periodicite"];
                        $issnonline = $row2["issnonline"];
                        $issnprint = $row2["issnprint"];
                        $editeur = $row2["editeur"];
                        $annee = $row2["annee"];
                        $theme = $row2["theme"];
                        $classe = $row2["classe"];
                        $type = $row2["type"];
                        $pays = $row2["pays"];
                        $idspe = $row2["idspe"];
                        $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                            SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomDomaine = mysqli_fetch_array($result2)["nom"];
                        }
                        $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomspe = mysqli_fetch_array($result2)["nomspe"];
                        }
                    }*/
                }
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input value="'.$titre.'" required class="form-control" name="titreProduction" type="text" placeholder="Titre de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>DOI</label>
                        <input value="'.$doi.'" required class="form-control" name="doiProduction" type="text" placeholder="DOI de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>URL</label>
                        <input value="'.$url.'" required class="form-control" name="urlProduction" type="text" placeholder="URL de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>№ ISSUE</label>
                        <input value="'.$nissue.'" min="0" max="99" required class="form-control" name="nissueProduction" type="number" placeholder="№ issue de la publication">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>№ volume</label>
                        <input value="'.$nvol.'" min="0" max="99" required class="form-control" name="nvolProduction" type="number" placeholder="№ volume de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input value="'.$nomDomaine.'" required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input value="'.$nomspe.'" maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input value="';
                        $length = count($motscles);
                        for($i=0; $i<$length-1; $i++) {
                            echo $motscles[$i].',';
                        }
                        echo $motscles[$length-1];
                        echo'" required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input value="'.$date.'" required class="form-control" name="dateProduction" type="month" placeholder="Date de la publication">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>';
                            if($idcherauteurprinc != 0){
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            if($idcherauteurprinc == $idcher) echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            else echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>
                                        </div>
                                    </div>
                                </div>';
                            }
                            else{
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>';
                                echo '<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input value="'.$auteurprinc.'" required class="form-control" name="auteurprincInput" type="text" placeholder="Nom de l\'auteur principale">
                                    </div>
                                </div>
                            </div>
                            </div>
                                    </div>
                                </div>';
                            }
                            $position = 0;
                foreach ($coauteurs as $auteur) {
                    $position++;
                    if($auteur["idcher"] == 0){
                        $nomauteur = $auteur["nom"];
                        echo '<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                <label>auteur '.$position.'</label>
                                <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo'</select>';
                            
                    echo '<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <input required value="'.$nomauteur.'" auteur="'.$position.'" class="form-control" name="auteurInput[]" type="text" placeholder="Nom de l\'auteur '.$position.'">
                            </div>
                        </div>
                    </div>
                    </div>
                        </div>
                    </div>';
                    }
                    else{
                        $idcoauteur = $auteur["idcher"];
                        echo '<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                <label>auteur '.$position.'</label>
                                <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            if($idcher == $idcoauteur)
                                            echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            else
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo'</select>
                            </div>
                        </div>
                    </div>';
                    }
                }            
                echo '<button value="'.$position.'" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Revue</label>
                        <select required data-live-search="true" name="coderevue" id="coderevue" class="form-control selectpicker" title="Revue...">
                            <option value="autre">Autre</option>';
                            
                            $sql = "SELECT * FROM revue";
                            $result = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $coderevue2 = $row["coderevue"];
                                    $nomrevue2 = $row["nom"];
                                    if($coderevue == $coderevue2)
                                    echo '<option selected value="'.$coderevue2.'">'.$nomrevue2.'</option>';
                                    else
                                    echo '<option value="'.$coderevue2.'">'.$nomrevue2.'</option>';
                                }
                            }
                            
                        echo '</select>
                    </div>
                </div>
            </div>
            
            <div id="infoRevue"></div> ';
            break;

            case 'communication':
                $sql = "SELECT * FROM communication WHERE codepro='".$codepro."'";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $codeconf = $row["codeconf"];
                    $titre = $row["titre"];
                    $url = $row["url"];
                    $idspe = $row["idspe"];
                    $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                        SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomDomaine = mysqli_fetch_array($result2)["nom"];
                    }
                    $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomspe = mysqli_fetch_array($result2)["nomspe"];
                    }
                    $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $motscles = array();
                        while($row = mysqli_fetch_array($result2)){
                            $motscles[] = $row["mot"];
                        }
                    }
                    $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $date = mysqli_fetch_array($result2)["date"]; 
                    }
                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                        SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $row2 = mysqli_fetch_array($result2);
                        $auteurprinc = $row2["nom"];
                        $idcherauteurprinc = $row2["idcher"];
                    }
                    else{
                        $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            $idcherauteurprinc = 0;
                        }
                    }
                    $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $coauteurs = array();
                        while($row2 = mysqli_fetch_array($result2)){
                            $coauteurs[] = $row2;
                        }
                    }
                }
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input value="'.$titre.'" required class="form-control" name="titreProduction" type="text" placeholder="Titre de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>URL</label>
                        <input value="'.$url.'" required class="form-control" name="urlProduction" type="text" placeholder="URL de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input value="'.$nomDomaine.'" required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input value="'.$nomspe.'" maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input value="';
                        $length = count($motscles);
                        for($i=0; $i<$length-1; $i++) {
                            echo $motscles[$i].',';
                        }
                        echo $motscles[$length-1];
                        echo'" required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input value="'.$date.'" required class="form-control" name="dateProduction" type="month" placeholder="Date de la communication">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>';
                            if($idcherauteurprinc != 0){
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            if($idcherauteurprinc == $idcher) echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            else echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>
                                        </div>
                                    </div>
                                </div>';
                            }
                            else{
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>';
                                echo '<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input value="'.$auteurprinc.'" required class="form-control" name="auteurprincInput" type="text" placeholder="Nom de l\'auteur principale">
                                    </div>
                                </div>
                            </div>
                            </div>
                                    </div>
                                </div>';
                            }
                            $position = 0;
                foreach ($coauteurs as $auteur) {
                    $position++;
                    if($auteur["idcher"] == 0){
                        $nomauteur = $auteur["nom"];
                        echo '<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                <label>auteur '.$position.'</label>
                                <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo'</select>';
                            
                    echo '<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <input required value="'.$nomauteur.'" auteur="'.$position.'" class="form-control" name="auteurInput[]" type="text" placeholder="Nom de l\'auteur '.$position.'">
                            </div>
                        </div>
                    </div>
                    </div>
                        </div>
                    </div>';
                    }
                    else{
                        $idcoauteur = $auteur["idcher"];
                        echo '<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                <label>auteur '.$position.'</label>
                                <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            if($idcher == $idcoauteur)
                                            echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            else
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo'</select>
                            </div>
                        </div>
                    </div>';
                    }
                }
                echo'<button value="'.$position.'" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>conférence</label>
                        <select required data-live-search="true" name="codeconf" id="codeconf" class="form-control selectpicker" title="Conférence...">
                            <option value="autre">Autre</option>';  
                                $sql = "SELECT * FROM conference";
                                $result = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $codeconf2 = $row["codeconf"];
                                        $nomconf2 = $row["nomconf"];
                                        if($codeconf == $codeconf2)
                                        echo '<option selected value="'.$codeconf2.'">'.$nomconf2.'</option>';
                                        else
                                        echo '<option value="'.$codeconf2.'">'.$nomconf2.'</option>';
                                    }
                                }
                        echo '</select>
                    </div>
                </div>
            </div>
            <div id="infoConf"></div>';
            break;

            case 'ouvrage':
                $sql = "SELECT * FROM ouvrage WHERE codepro='".$codepro."'";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $idspe = $row["idspe"];
                    $titre = $row["titre"];
                    $nbpages = $row["nbpages"];
                    $editeur = $row["editeur"];
                    $url = $row["url"];
                    $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                        SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomDomaine = mysqli_fetch_array($result2)["nom"];
                    }
                    $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomspe = mysqli_fetch_array($result2)["nomspe"];
                    }
                    $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $motscles = array();
                        while($row = mysqli_fetch_array($result2)){
                            $motscles[] = $row["mot"];
                        }
                    }
                    $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $date = mysqli_fetch_array($result2)["date"]; 
                    }
                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                        SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $row2 = mysqli_fetch_array($result2);
                        $auteurprinc = $row2["nom"];
                        $idcherauteurprinc = $row2["idcher"];
                    }
                    else{
                        $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            $idcherauteurprinc = 0;
                        }
                    }
                    $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $coauteurs = array();
                        while($row2 = mysqli_fetch_array($result2)){
                            $coauteurs[] = $row2;
                        }
                    }
                }
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input value="'.$titre.'" required class="form-control" name="titreProduction" type="text" placeholder="Titre de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>éditeur</label>
                        <input value="'.$editeur.'" required class="form-control" name="editeurProduction" type="text" placeholder="Editeur de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>nombres de pages</label>
                        <input value="'.$nbpages.'" min="1" max="9999" required class="form-control" name="nbrePagesProduction" type="number" placeholder="Nombre de pages de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>url</label>
                        <input value="'.$url.'" required class="form-control" name="urlProduction" type="text" placeholder="URL de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input value="'.$nomDomaine.'" required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input value="'.$nomspe.'" maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input value="';
                        $length = count($motscles);
                        for($i=0; $i<$length-1; $i++) {
                            echo $motscles[$i].',';
                        }
                        echo $motscles[$length-1];
                        echo'" required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input value="'.$date.'" required class="form-control" name="dateProduction" type="month" placeholder="Date de publication de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>';
                            if($idcherauteurprinc != 0){
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            if($idcherauteurprinc == $idcher) echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            else echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>
                                        </div>
                                    </div>
                                </div>';
                            }
                            else{
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>';
                                echo '<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input value="'.$auteurprinc.'" required class="form-control" name="auteurprincInput" type="text" placeholder="Nom de l\'auteur principale">
                                    </div>
                                </div>
                            </div>
                            </div>
                                    </div>
                                </div>';
                            }
                            $position = 0;
                            foreach ($coauteurs as $auteur) {
                                $position++;
                                if($auteur["idcher"] == 0){
                                    $nomauteur = $auteur["nom"];
                                    echo '<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                            <label>auteur '.$position.'</label>
                                            <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                            <option selected value="autre">Autre</option>';
                                                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                                    SELECT idcher FROM users WHERE actif=1
                                                )";
                                                $result = mysqli_query($db,$sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $nomcher = $row["nom"];
                                                        $idcher = $row["idcher"];
                                                        echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                                    }
                                                }
                                            echo'</select>';
                                        
                                echo '<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input required value="'.$nomauteur.'" auteur="'.$position.'" class="form-control" name="auteurInput[]" type="text" placeholder="Nom de l\'auteur '.$position.'">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                    </div>
                                </div>';
                                }
                                else{
                                    $idcoauteur = $auteur["idcher"];
                                    echo '<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                            <label>auteur '.$position.'</label>
                                            <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                            <option selected value="autre">Autre</option>';
                                                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                                    SELECT idcher FROM users WHERE actif=1
                                                )";
                                                $result = mysqli_query($db,$sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $nomcher = $row["nom"];
                                                        $idcher = $row["idcher"];
                                                        if($idcher == $idcoauteur)
                                                        echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                                        else
                                                        echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                                    }
                                                }
                                            echo'</select>
                                        </div>
                                    </div>
                                </div>';
                                }
                            }
                echo'<button value="'.$position.'" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
            </div>';
            break;

            case 'chapitreOuvrage':
                $sql = "SELECT * FROM chapitredouvrage WHERE codepro='".$codepro."'";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result)){
                    $row = mysqli_fetch_array($result);
                    $idspe = $row["idspe"];
                    $titre = $row["titre"];
                    $pages = $row["pages"];
                    $editeur = $row["editeur"];
                    $volume = $row["volume"];
                    $url = $row["url"];
                    $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                        SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomDomaine = mysqli_fetch_array($result2)["nom"];
                    }
                    $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomspe = mysqli_fetch_array($result2)["nomspe"];
                    }
                    $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $motscles = array();
                        while($row = mysqli_fetch_array($result2)){
                            $motscles[] = $row["mot"];
                        }
                    }
                    $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $date = mysqli_fetch_array($result2)["date"]; 
                    }
                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                        SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $row2 = mysqli_fetch_array($result2);
                        $auteurprinc = $row2["nom"];
                        $idcherauteurprinc = $row2["idcher"];
                    }
                    else{
                        $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            $idcherauteurprinc = 0;
                        }
                    }
                    $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $coauteurs = array();
                        while($row2 = mysqli_fetch_array($result2)){
                            $coauteurs[] = $row2;
                        }
                    }
                }
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input value="'.$titre.'" required class="form-control" name="titreProduction" type="text" placeholder="Titre de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>éditeur</label>
                        <input value="'.$editeur.'" required class="form-control" name="editeurProduction" type="text" placeholder="Editeur de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>n° de pages</label>
                        <input value="'.$pages.'" maxlength="40" required class="form-control" name="pagesProduction" type="text" placeholder="Pages écrite de l\'ouvrage">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>volume</label>
                        <input value="'.$volume.'" min="1" required class="form-control" name="volumeProduction" type="number" placeholder="Volume de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>url</label>
                        <input value="'.$url.'" required class="form-control" name="urlProduction" type="text" placeholder="URL de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input value="'.$nomDomaine.'" required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input value="'.$nomspe.'" maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input value="';
                        $length = count($motscles);
                        for($i=0; $i<$length-1; $i++) {
                            echo $motscles[$i].',';
                        }
                        echo $motscles[$length-1];
                        echo'" required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input value="'.$date.'" required class="form-control" name="dateProduction" type="month" placeholder="Date de publication de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>';
                            if($idcherauteurprinc != 0){
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            if($idcherauteurprinc == $idcher) echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            else echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>
                                        </div>
                                    </div>
                                </div>';
                            }
                            else{
                                echo '<select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                    <option selected value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                        SELECT idcher FROM users WHERE actif=1
                                    )";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                                echo '</select>';
                                echo '<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input value="'.$auteurprinc.'" required class="form-control" name="auteurprincInput" type="text" placeholder="Nom de l\'auteur principale">
                                    </div>
                                </div>
                            </div>
                            </div>
                                    </div>
                                </div>';
                            }
                            $position = 0;
                            foreach ($coauteurs as $auteur) {
                                $position++;
                                if($auteur["idcher"] == 0){
                                    $nomauteur = $auteur["nom"];
                                    echo '<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                            <label>auteur '.$position.'</label>
                                            <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                            <option selected value="autre">Autre</option>';
                                                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                                    SELECT idcher FROM users WHERE actif=1
                                                )";
                                                $result = mysqli_query($db,$sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $nomcher = $row["nom"];
                                                        $idcher = $row["idcher"];
                                                        echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                                    }
                                                }
                                            echo'</select>';
                                        
                                echo '<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input required value="'.$nomauteur.'" auteur="'.$position.'" class="form-control" name="auteurInput[]" type="text" placeholder="Nom de l\'auteur '.$position.'">
                                        </div>
                                    </div>
                                </div>
                                </div>
                                    </div>
                                </div>';
                                }
                                else{
                                    $idcoauteur = $auteur["idcher"];
                                    echo '<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                            <label>auteur '.$position.'</label>
                                            <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur'.$position.'" auteur="'.$position.'">
                                            <option selected value="autre">Autre</option>';
                                                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                                    SELECT idcher FROM users WHERE actif=1
                                                )";
                                                $result = mysqli_query($db,$sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $nomcher = $row["nom"];
                                                        $idcher = $row["idcher"];
                                                        if($idcher == $idcoauteur)
                                                        echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                                        else
                                                        echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                                    }
                                                }
                                            echo'</select>
                                        </div>
                                    </div>
                                </div>';
                                }
                            }
                echo'<button value="'.$position.'" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
            </div>';
            break;

            case 'doctorat':
                $sql = "SELECT * FROM these WHERE codepro='".$codepro."'";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $titre = $row["titre"];
                    $lieusout = $row["lieusout"];
                    $nordre = $row["nordre"];
                    $encadreur = $row["encadreur"];
                    $idspe = $row["idspe"];
                    $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                        SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomDomaine = mysqli_fetch_array($result2)["nom"];
                    }
                    $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomspe = mysqli_fetch_array($result2)["nomspe"];
                    }
                    $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $motscles = array();
                        while($row = mysqli_fetch_array($result2)){
                            $motscles[] = $row["mot"];
                        }
                    }
                    $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $date = mysqli_fetch_array($result2)["date"]; 
                    }
                }
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input value="'.$titre.'" required class="form-control" name="titreProduction" type="text" placeholder="Titre de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>№ ORDRE</label>
                        <input value="'.$nordre.'" required class="form-control" name="nordreProduction" type="number" placeholder="№ ordre">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>lieu</label>
                        <input value="'.$lieusout.'" required class="form-control" name="lieusoutProduction" type="text" placeholder="Lieu de la soutenance">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>url</label>
                        <input value="'.$lieusout.'" required class="form-control" name="urlProduction" type="text" placeholder="URL de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input value="'.$nomDomaine.'" required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input value="'.$nomspe.'" maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input value="';
                        $length = count($motscles);
                        for($i=0; $i<$length-1; $i++) {
                            echo $motscles[$i].',';
                        }
                        echo $motscles[$length-1];
                        echo'" required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input value="'.$date.'" required class="form-control" name="dateProduction" type="month" placeholder="Date de la thèse">
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Encadreur</label>
                        <select disabled required data-live-search="true" title="Encadreur..." name="encadreurProduction" id="encadreurProduction" class="form-control selectpicker">';
                                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                    SELECT idcher FROM users WHERE actif=1
                                )";
                                $result = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $nomcher = $row["nom"];
                                        $idcher = $row["idcher"];
                                        if($encadreur == $idcher){
                                            echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            break;
                                        }
                                    }
                                }
                        echo'</select>
                        <input hidden value="'.$encadreur.'" type="text" name="encadreurProduction" required>
                    </div>
                </div>
            </div>';
            break;

            default:
                $sql = "SELECT * FROM pfemaster WHERE codepro='".$codepro."'";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $titre = $row["titre"];
                    $lieusout = $row["lieusout"];
                    $encadreur = $row["encadreur"];
                    $idspe = $row["idspe"];
                    $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                        SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                    )";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomDomaine = mysqli_fetch_array($result2)["nom"];
                    }
                    $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $nomspe = mysqli_fetch_array($result2)["nomspe"];
                    }
                    $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $motscles = array();
                        while($row = mysqli_fetch_array($result2)){
                            $motscles[] = $row["mot"];
                        }
                    }
                    $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $date = mysqli_fetch_array($result2)["date"]; 
                    }
                }
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input value="'.$titre.'" required class="form-control" name="titreProduction" type="text" placeholder="Titre de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>lieu</label>
                        <input value="'.$lieusout.'" required class="form-control" name="lieusoutProduction" type="text" placeholder="Lieu de la soutenance">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input value="'.$nomDomaine.'" required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input value="'.$nomspe.'" maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input value="';
                        $length = count($motscles);
                        for($i=0; $i<$length-1; $i++) {
                            echo $motscles[$i].',';
                        }
                        echo $motscles[$length-1];
                        echo'" required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input value="'.$date.'" required class="form-control" name="dateProduction" type="month" placeholder="Date de la thèse">
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Encadreur</label>
                        <select disabled required data-live-search="true" title="Encadreur..." name="encadreurProduction" id="encadreurProduction" class="form-control selectpicker">';
                                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                    SELECT idcher FROM users WHERE actif=1
                                )";
                                $result = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $nomcher = $row["nom"];
                                        $idcher = $row["idcher"];
                                        if($idcher == $encadreur){
                                            echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                            break;
                                        }
                                    }
                                }
                        echo'</select>
                        <input hidden value="'.$encadreur.'" type="text" name="encadreurProduction" required>
                    </div>
                </div>
            </div>';
            break;
        }
    }
?>