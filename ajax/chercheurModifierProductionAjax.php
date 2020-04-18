<?php
    require_once("../config.php");
    
    if(isset($_GET["typeProduction"]) && $_GET["typeProduction"] != ""){
        switch ($_GET["typeProduction"]) {
            case 'publication':
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input required class="form-control" name="titreProduction" type="text" placeholder="Titre de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>DOI</label>
                        <input required class="form-control" name="doiProduction" type="text" placeholder="DOI de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>URL</label>
                        <input required class="form-control" name="urlProduction" type="text" placeholder="URL de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>№ ISSUE</label>
                        <input min="0" max="99" required class="form-control" name="nissueProduction" type="number" placeholder="№ issue de la publication">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>№ volume</label>
                        <input min="0" max="99" required class="form-control" name="nvolProduction" type="number" placeholder="№ volume de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la publication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date publication</label>
                        <input required class="form-control" name="dateProduction" type="month" placeholder="Date de la publication">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>
                            <select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                <option value="autre">Autre</option>';
                                $sql = "SELECT * FROM chercheur";
                                $result = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $nomcher = $row["nom"];
                                        $idcher = $row["idcher"];
                                        echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                    }
                                }
                            echo '</select>
                        </div>
                    </div>
                </div>
                <button value="0" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
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
                                    $coderevue = $row["coderevue"];
                                    $nomrevue = $row["nom"];
                                    echo '<option value="'.$coderevue.'">'.$nomrevue.'</option>';
                                }
                            }
                            
                        echo '</select>
                    </div>
                </div>
            </div>
            
            <div id="infoRevue"></div> ';
            break;

            case 'communication':
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input required class="form-control" name="titreProduction" type="text" placeholder="Titre de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>URL</label>
                        <input required class="form-control" name="urlProduction" type="text" placeholder="URL de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la communication">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date communication</label>
                        <input required class="form-control" name="dateProduction" type="month" placeholder="Date de la communication">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>
                            <select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                <option value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                            echo'</select>
                        </div>
                    </div>
                </div>
                <button value="0" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
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
                                        $codeconf = $row["codeconf"];
                                        $nomconf = $row["nomconf"];
                                        echo '<option valUe="'.$codeconf.'">'.$nomconf.'</option>';
                                    }
                                }
                        echo '</select>
                    </div>
                </div>
            </div>
            <div id="infoConf"></div>';
            break;

            case 'ouvrage':
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input required class="form-control" name="titreProduction" type="text" placeholder="Titre de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>éditeur</label>
                        <input required class="form-control" name="editeurProduction" type="text" placeholder="Editeur de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>nombres de pages</label>
                        <input min="1" max="9999" required class="form-control" name="nbrePagesProduction" type="number" placeholder="Nombre de pages de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>url</label>
                        <input required class="form-control" name="urlProduction" type="text" placeholder="URL de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input required class="form-control" name="dateProduction" type="month" placeholder="Date de publication de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>
                            <select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                <option value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                            echo'</select>
                        </div>
                    </div>
                </div>
                <button value="0" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
            </div>';
            break;

            case 'chapitreOuvrage':
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input required class="form-control" name="titreProduction" type="text" placeholder="Titre de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>éditeur</label>
                        <input required class="form-control" name="editeurProduction" type="text" placeholder="Editeur de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>pages</label>
                        <input maxlength="40" required class="form-control" name="pagesProduction" type="text" placeholder="Pages écrite de l\'ouvrage">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>volume</label>
                        <input min="1" required class="form-control" name="volumeProduction" type="number" placeholder="Volume de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>url</label>
                        <input required class="form-control" name="urlProduction" type="text" placeholder="URL de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input required class="form-control" name="dateProduction" type="month" placeholder="Date de publication de l\'ouvrage">
                    </div>
                </div>
            </div>

            <div id="auteurs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Auteur Principal</label>
                            <select required data-live-search="true" title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
                                <option value="autre">Autre</option>';
                                    $sql = "SELECT * FROM chercheur";
                                    $result = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_array($result)){
                                            $nomcher = $row["nom"];
                                            $idcher = $row["idcher"];
                                            echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                        }
                                    }
                            echo'</select>
                        </div>
                    </div>
                </div>
                <button value="0" type="button" class="btn btn-info btn-fill">Ajouter auteur</button>
            </div>';
            break;

            case 'doctorat':
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input required class="form-control" name="titreProduction" type="text" placeholder="Titre de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>№ ORDRE</label>
                        <input required class="form-control" name="nordreProduction" type="number" placeholder="№ ordre">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>lieu</label>
                        <input required class="form-control" name="lieusoutProduction" type="text" placeholder="Lieu de la soutenance">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>url</label>
                        <input required class="form-control" name="urlProduction" type="text" placeholder="URL de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input required class="form-control" name="dateProduction" type="month" placeholder="Date de la thèse">
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Encadreur</label>
                        <select required data-live-search="true" title="Encadreur..." name="encadreurProduction" id="encadreurProduction" class="form-control selectpicker">';
                                $sql = "SELECT * FROM chercheur";
                                $result = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $nomcher = $row["nom"];
                                        $idcher = $row["idcher"];
                                        echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                    }
                                }
                        echo'</select>
                    </div>
                </div>
            </div>';
            break;

            default:
                echo '<div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>titre</label>
                        <input required class="form-control" name="titreProduction" type="text" placeholder="Titre de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>lieu</label>
                        <input required class="form-control" name="lieusoutProduction" type="text" placeholder="Lieu de la soutenance">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>domaine</label>
                        <input required maxlength="50" class="form-control" name="codeDomaineProduction" type="text" placeholder="Domaine de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>spécialités</label>
                        <input maxlength="255" required class="form-control" name="idspeProduction" type="text" placeholder="Spécialités de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>mots-clés (séparés par , )</label>
                        <input required class="form-control" name="motsclesProduction" type="text" placeholder="Mots-clès de la thèse">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input required class="form-control" name="dateProduction" type="month" placeholder="Date de la thèse">
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Encadreur</label>
                        <select required data-live-search="true" title="Encadreur..." name="encadreurProduction" id="encadreurProduction" class="form-control selectpicker">';
                                $sql = "SELECT * FROM chercheur";
                                $result = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $nomcher = $row["nom"];
                                        $idcher = $row["idcher"];
                                        echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                    }
                                }
                        echo'</select>
                    </div>
                </div>
            </div>';
            break;
        }
    }
?>