<?php
    session_start();
    require_once("../config.php");
    if(isset($_GET["refresh"]) && $_GET["refresh"]){
        $idcher = $_SESSION["idcher"];
        echo '<div class="content">
        <table class="table table-hover">
            <thead>
                <th>Intitulé</th>
                <th>Date</th>
                <th>Durée (mois)</th>
                <th>Description</th>
                <th>Membres</th>
                <th>Action</th>
            </thead>
        <tbody>';
        $sql = "SELECT * FROM projrecher WHERE codeproj IN (
            SELECT codeproj FROM chefproj WHERE idcher='".$idcher."'
        )";
        if($result = mysqli_query($db,$sql)){
            while($row = mysqli_fetch_array($result)){
                $intitule = $row['intitule'];
                $date = $row['date'];
                $duree = $row['duree']; 
                $codeproj = $row['codeproj'];
                /*$idspe = $row["idspe"];
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){    
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];*/
                echo    '<tr>';
                echo    '<td>'.$intitule.'</td>';
                echo    '<td>'.$date.'</td>';
                echo    '<td>'.$duree.'</td>';
                echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">Description</button></td>';
                echo    '<td><button membre="membre" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">Membres</button></td>';
                echo    '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<a href="modifierProjet.php?modifier='.$codeproj.'" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codeproj.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                echo    '</div>';
                echo    '</div>';
                echo    '</td>';
                echo    '</tr>';
                //}
                
            }
        }
        echo '</tbody>
            </table>
        </div>';
    }

    if(isset($_GET["description"]) && $_GET["description"] != ""){
        $codeproj = mysqli_real_escape_string($db,$_GET["description"]);
        $sql = "SELECT description FROM projrecher WHERE codeproj='".$codeproj."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $description = mysqli_fetch_array($result)['description'];
            echo $description;
        }
        else{
            echo '<div class="text-danger">Desciption indisponibles !</div>';
        }
    }    

    if(isset($_GET["membre"]) && $_GET["membre"] != ""){
        $codeproj = mysqli_real_escape_string($db,$_GET["membre"]);
        $nom = $_SESSION["nom"];
        echo '<span class="text-info">Chef du projet: </span>'.$nom.'<br>';

        $sql = "SELECT nom FROM chercheur WHERE idcher IN (
            SELECT idcher FROM membreproj WHERE codeproj = '".$codeproj."'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<span class="text-info">Membres: </span>';
            while($row = mysqli_fetch_array($result)){
                $nom = $row['nom'];
                echo $nom.', ';
            }
            echo '<br>';
        }
        else{
            echo '<div class="text-danger">Membres indisponibles !</div>';
        }
    }  

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $codeproj = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "DELETE FROM projrecher WHERE codeproj='".$codeproj."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>