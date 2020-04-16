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
                    <th>Titre</th>
                    <th>Revue</th>
                    <th>DOI</th>
                    <th>N Vol.</th>
                    <th>N issue</th>
                    <th>url</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $titre = $row["titre"];
                $coderevue = $row["coderevue"];
                $doi = $row["doi"];
                $nvol = $row["nvol"];
                $nissue = $row["nissue"];
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
                $sql = "SELECT * FROM revue WHERE coderevue='".$coderevue."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomrevue = mysqli_fetch_array($result2)["nom"];
                }
            }
        }
    }

    if(isset($_GET["refresh"]) && $_GET["refresh"]){
        $idcher = $_SESSION["idcher"];
        echo '<div class="content">
        <table class="table table-hover">
            <thead>
                <th>Nom</th>
                <th>Spécialités</th>
                <th>Action</th>
            </thead>
        <tbody>';
        $sql = "SELECT * FROM equipe WHERE idlabo IN (
            SELECT idlabo FROM cheflabo WHERE idcher = '".$idcher."'
        )";
        if($result = mysqli_query($db,$sql)){
            while($row = mysqli_fetch_array($result)){
                $idequipe = $row["idequipe"];
                $nomequipe = $row["nomequip"];
                $sql = "SELECT * FROM specialite WHERE idspe IN (
                    SELECT idspe FROM specialiteequipe WHERE idequipe = '".$idequipe."'
                )";
                $specialites = array();
                if($result2 = mysqli_query($db,$sql)){
                    while($nomspe = mysqli_fetch_array($result2)){
                        $specialites[] = $nomspe["nomspe"];
                    }
                    echo    '<tr>';
                    echo    '<td>'.$nomequipe.'</td>';
                    echo    '<td>';
                    foreach ($specialites as $specialite) {
                        echo    $specialite.", ";
                    }
                    echo    '</td>';
                    echo    '<td>';
                    echo    '<div class="btn-toolbar">';
                    echo    '<div class="btn-group">';
                    echo    '<a href="laboModifierEquipe.php?modifier='.$idequipe.'" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
                    echo    '</div>';
                    echo    '<div class="btn-group">';
                    echo    '<button  value="'.$idequipe.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                    echo    '</div>';
                    echo    '</div>';
                    echo    '</td>';
                    echo    '</tr>';
                }
                
            }
        }
        echo '</tbody>
            </table>
        </div>';
    }

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $idequipe = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "DELETE FROM equipe WHERE idequipe='".$idequipe."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>