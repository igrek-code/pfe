<?php
    session_start();
    require_once("../config.php");

    if(isset($_GET["typeProduction"]) && $_GET["typeProduction"] != ""){
        $idcher = $_SESSION["idcher"];
        switch ($_GET["typeProduction"]) {
            case 'publication':
                afficher_publication($db,$idcher);
                break;
            
            default:
                # code...
                break;
        }
    }

    function afficher_publication($db,$idcher){
        $sql = "SELECT * FROM publication WHERE codepro IN (
            SELECT codepro FROM auteurprinc WHERE idcher='".$idcher."'
        ) OR codepro IN (
            SELECT codepro FROM coauteurs WHERE idcher='".$idcher."'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="content">
            <table class="table table-hover">
                <thead>
                    <th>Doi</th>
                    <th>Volume</th>
                    <th>N ISSUE</th>
                    <th>Mots-clès</th>
                    <th>Auteur principal</th>
                    <th>Co-auteurs</th>
                    <th>Périodicité</th>
                    <th>E-ISSN</th>
                    <th>ISSN PRINT</th>
                    <th>Editeur</th>
                    <th>Année</th>
                    <th>Thème</th>
                    <th>Domaine</th>
                    <th>Spécialités</th>
                    <th>Type</th>
                    <th>Classe</th>
                    <th>Pays</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Revue</th>
                    <th>url</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $titre = $row["titre"];
                $doi = $row["doi"];
                $nvol = $row["nvol"];
                $nissue = $row["nissue"];
                $coderevue = $row["coderevue"];
                $url = $row["url"];
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
                    $auteurprinc = mysqli_fetch_array($result2)["nom"];
                }
                else{
                    $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $auteurprinc = mysqli_fetch_array($result2)["nom"];
                    }
                }
                $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $coauteurs = array();
                    while($row2 = mysqli_fetch_array($result2)){
                        if($row2["idcher"] == 0){
                            $coauteurs[] = $row2["nom"];
                        }
                        else{
                            $idcherco = $row2["idcher"];
                            $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                            $result3 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result3) > 0){
                                $coauteurs = mysqli_fetch_array($result3)["nom"];
                            }
                        }
                    }
                }
                /* ---------- PARTIE REVUE ------------ */
                $sql = "SELECT * FROM revue WHERE coderevue='".$coderevue."'";
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
                }
                echo    '<tr>';
                echo    '<td>'.$doi.'</td>';
                echo    '<td>'.$nvol.'</td>';
                echo    '<td>'.$nissue.'</td>';
                echo    '<td>';
                foreach ($motscles as $mot) {
                    echo $mot.', ';
                }   
                echo    '</td>';
                echo    '<td>'.$auteurprinc.'</td>';
                echo    '<td>';
                foreach ($coauteurs as $auteur) {
                    echo $auteur.', ';
                }
                echo    '</td>';
                echo    '<td>'.$periodicite.'</td>';
                echo    '<td>'.$issnonline.'</td>';
                echo    '<td>'.$issnprint.'</td>';
                echo    '<td>'.$editeur.'</td>';
                echo    '<td>'.$annee.'</td>';
                echo    '<td>'.$theme.'</td>';
                echo    '<td>'.$nomDomaine.'</td>';
                echo    '<td>'.$nomspe.'</td>';
                echo    '<td>'.$type.'</td>';
                echo    '<td>'.$classe.'</td>';
                echo    '<td>'.$pays.'</td>';
                echo    '<td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codepro.'">'.$titre.'</button></td>';
                echo    '<td>'.$date.'</td>';
                echo    '<td><button coderevue="coderevue" class="btn btn-primary" style="border:0px;font-size:16px;"  value="'.$coderevue.'">'.$nomrevue.'</button></td>';
                echo    '<td><a target="_blank" href="http://'.$url.'">lien</a></td>';
                echo    '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<a href="chercheurModifierPublication.php?modifier='.$codepro.'" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codepro.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                echo    '</div>';
                echo    '</div>';
                echo    '</td>';
                echo    '</tr>';
            }
            echo '</tbody>
            </table>
            </div>';
        }
    }

    if(isset($_GET["coderevue"]) && $_GET["coderevue"] != ""){
        $coderevue = mysqli_real_escape_string($db,$_GET["coderevue"]);
        $sql = "SELECT * FROM revue WHERE coderevue='".$coderevue."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $nomrevue = $row["nom"];
            $periodicite = $row["periodicite"];
            $issnonline = $row["issnonline"];
            $issnprint = $row["issnprint"];
            $editeur = $row["editeur"];
            $annee = $row["annee"];
            $theme = $row["theme"];
            $classe = $row["classe"];
            $type = $row["type"];
            $pays = $row["pays"];
            $idspe = $row["idspe"];
            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                $nomDomaine = mysqli_fetch_array($result)["nom"];
            }
            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                $nomspe = mysqli_fetch_array($result)["nomspe"];
            }
            echo '<span class="text-info">Nom: </span>'.$nomrevue.'<br>';
            echo '<span class="text-info">Périodicité: </span>'.$periodicite.'<br>';
            echo '<span class="text-info">E-ISSN: </span>'.$issnonline.'<br>';
            echo '<span class="text-info">ISSN PRINT: </span>'.$issnprint.'<br>';
            echo '<span class="text-info">editeur: </span>'.$editeur.'<br>';
            echo '<span class="text-info">Année: </span>'.$annee.'<br>';
            echo '<span class="text-info">Thème: </span>'.$theme.'<br>';
            echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
            echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
            echo '<span class="text-info">Type: </span>'.$type.'<br>';
            if($type == "nationale"){
                echo '<span class="text-info">Pays: </span>'.$pays.'<br>';
            }
            else{
                if($classe == "AA") echo '<span class="text-info">Classe: </span>A*<br>';
                else echo '<span class="text-info">Classe: </span>'.$classe.'<br>';
            }
        }
        else{
            echo '<div class="text-danger">information sur la revue non trouvée !</div>';
        }
    }

    if(isset($_GET["codepro"]) && $_GET["codepro"] != ""){
        $codepro = mysqli_real_escape_string($db,$_GET["codepro"]);
        $sql = "SELECT * FROM publication WHERE codepro='".$codepro."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $titre = $row["titre"];
            $doi = $row["doi"];
            $nvol = $row["nvol"];
            $nissue = $row["nissue"];
            echo '<span class="text-info">Titre: </span>'.$titre.'<br>';
            echo '<span class="text-info">DOI: </span>'.$doi.'<br>';
            echo '<span class="text-info">Volume: </span>'.$nvol.'<br>';
            echo '<span class="text-info">N ISSUE: </span>'.$nissue.'<br>';
            echo '<span class="text-info">Mots-clès: </span>';
            $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
            $result2 = mysqli_query($db,$sql);
            if(mysqli_num_rows($result2) > 0){
                while($row = mysqli_fetch_array($result2)){
                    $mot = $row["mot"];
                    echo $mot.', ';
                }
            }
            echo '<br>';
            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
            )";
            $result2 = mysqli_query($db,$sql);
            if(mysqli_num_rows($result2) > 0){
                $auteurprinc = mysqli_fetch_array($result2)["nom"];
            }
            else{
                $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $auteurprinc = mysqli_fetch_array($result2)["nom"];
                }
            }
            echo '<span class="text-info">Auteur principal: </span>'.$auteurprinc.'<br>';
            $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
            $result2 = mysqli_query($db,$sql);
            if(mysqli_num_rows($result2) > 0){
                $coauteurs = array();
                while($row2 = mysqli_fetch_array($result2)){
                    if($row2["idcher"] == 0){
                        $coauteurs[] = $row2["nom"];
                    }
                    else{
                        $idcherco = $row2["idcher"];
                        $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                        $result3 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result3) > 0){
                            $coauteurs = mysqli_fetch_array($result3)["nom"];
                        }
                    }
                }
            }
            echo '<span class="text-info">Co-auteurs: </span>';
            foreach ($coauteurs as $auteur) {
                echo $auteur.', ';
            }
            echo '<br>';
        }
        else{
            echo '<div class="text-danger">information sur la publication non trouvée !</div>';
        }
    }

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $codepro = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
        $result = mysqli_query($db,$sql);
        $typeProduction = "none";
        if(mysqli_num_rows($result) > 0) $typeProduction = mysqli_fetch_array($result)["type"];
        $ok = "true";
        switch ($typeProduction) {
            case 'publication':
                $sql = "DELETE FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe IN (
                        SELECT idspe FROM publication WHERE codepro='".$codepro."'
                    )
                )";
                if(!mysqli_query($db,$sql)) {$ok = "false";break;}
                $sql = "DELETE FROM production WHERE codepro='".$codepro."'";
                if(!mysqli_query($db,$sql)) $ok = "false";
                break;
            
            default:
                # code...
                break;
        }
        echo $ok;
    }
?>