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
                            <select required title="Auteur principale" name="auteurprincSelect" id="auteurprinc" class="form-control selectpicker">
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
                            <input required class="form-control" name="auteurprinc" type="text" placeholder="Nom de l\'auteur principal">
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
                                    echo '<option vale="'.$coderevue.'">'.$nomrevue.'</option>';
                                }
                            }
                            
                        echo '</select>
                    </div>
                </div>
            </div>
            
            <div id="infoRevue"></div> ';
            break;
            
            default:
                # code...
            break;
        }
    }

    if(isset($_GET["coderevue"]) && $_GET["coderevue"] == "autre"){
        echo '<div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>nom</label>
                <input maxlength="20" required class="form-control" name="nomrevue" type="text" placeholder="Nom de la revue">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>e-issn</label>
                <input maxlength="40" required class="form-control" name="issnonline" type="text" placeholder="e-issn de la revue">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>issn-print</label>
                <input maxlength="40" required class="form-control" name="issnprint" type="text" placeholder="issn-print de la revue">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>éditeur</label>
                <input maxlength="40" required class="form-control" name="editeur" type="text" placeholder="éditeur de la revue">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>thémes</label>
                <input maxlength="255" required class="form-control" name="theme" type="text" placeholder="thèmes de la revue">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>domaine</label>
                <input maxlength="50" class="form-control" name="codeDomaineRevue" type="text" placeholder="Domaine de la revue">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>spécialités</label>
                <input maxlength="255" class="form-control" name="idspeRevue" type="text" placeholder="Spécialités de la production">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>année REVUE</label>
                <input maxlength="4" required class="form-control" name="anneeRevue" type="text" placeholder="Année de la revue">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>périodicité</label>
                <select required title="Périodicite..." name="periodiciteRevue" id="periodiciteRevue" class="form-control selectpicker">
                    <option value="annuel">Annuel</option>
                    <option value="semestriel">Semestriel</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-check form-check-inline">
                <input required class="form-check-input" type="radio" name="typeRevue" value="nationale">
                <label class="form-check-label">nationale</label>
                <input checked required style="margin-left:10px;" class="form-check-input" type="radio" name="typeRevue" value="internationale">
                <label class="form-check-label">internationale</label>
            </div>
        </div>
    </div>

    <div id="infoType"></div>';
    }

    if(isset($_GET["typeRevue"]) && $_GET["typeRevue"] != ""){
        if($_GET["typeRevue"] == "nationale"){
            echo '<div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>pays</label>
                        <input required class="form-control" name="paysRevue" type="text" placeholder="Pays de la revue">
                    </div>
                </div>
            </div>';
        }
        else{
            echo '<div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label>classe</label>
                    <select required class="form-control selectpicker" name="classeRevue" id="classeRevue" title="Classe de la revue...">
                        <option value="AA">A*</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
            </div>
        </div>';
        }
    }
?>