<?php
    session_start();
    require_once("../config.php");
    if(isset($_GET["refresh"]) && $_GET["refresh"] && isset($_SESSION["idequipe"])){
        $idequipe = $_SESSION["idequipe"];
        echo '<div class="content">
        <table class="table table-hover">
            <thead>
                <th>Nom</th>
                <th>Mail</th>
                <th>Grade</th>
                <th>Grade C</th>
                <th>Profil</th>
                <th>Action</th>
            </thead>
        <tbody>';
        $sql = "SELECT * FROM chercheur WHERE idcher IN (
            SELECT idcher FROM menbrequip WHERE idequipe = '".$idequipe."'
        ) AND idcher IN (
            SELECT idcher FROM users WHERE actif='1'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $idcher = $row["idcher"];
                $nomcher = $row["nom"];
                $mailcher = $row["mail"];
                $gradecher = $row["grade"];
                $gradecherC = $row["gradeC"];
                $profilcher = $row["profil"];
                echo    '<tr>';
                echo    '<td>'.$nomcher.'</td>';
                echo    '<td>'.$mailcher.'</td>';
                echo    '<td>'.$gradecher.'</td>';
                echo    '<td>'.$gradecherC.'</td>';
                echo    '<td>'.$profilcher.'</td>';
                echo    '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$idcher.'" title="supprimer" class="supprimer btn-fill btn btn-danger ">Supprimer</button>';
                echo    '</div>';
                echo    '</div>';
                echo    '</td>';
                echo    '</tr>';
            }
        }
        echo '</tbody>
            </table>
        </div>';
    }

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $idcher = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "DELETE FROM menbrequip WHERE idcher='".$idcher."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>