<?php
    require_once("../config.php");

    /*function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 20; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }*/

    if(isset($_GET["idcher"]) && $_GET["idcher"] != ""){
        $idcher = mysqli_real_escape_string($db,$_GET["idcher"]);
        if(isset($_GET["action"]) && $_GET["action"] == "accepter"){
            $sql = "UPDATE users SET actif=1 WHERE idcher='".$idcher."'";
            if(mysqli_query($db,$sql))
                echo 'true';
        }
        else{
            $sql = "DELETE FROM chercheur WHERE idcher='".$idcher."'";
            if(mysqli_query($db,$sql)){
                $sql = "DELETE FROM users WHERE idcher='".$idcher."'";
                if(mysqli_query($db,$sql))
                    echo 'true';
            }
        }
    }

    if(isset($_GET["refresh"]) && $_GET["refresh"]){
        echo '<div class="content">
        <table class="table table-hover" id="myTable" >
            <thead>
                <th>Nom</th>
                <th>Profil</th>
                <th>Grade</th>
                <th>Email</th>
                <th>Laboratoire</th>
                <th>Action</th>
            </thead>
            <tbody>';
        $sql = "SELECT * FROM chercheur WHERE idcher IN (
            SELECT idcher FROM users WHERE actif = 0
        ) AND idcher IN (
            SELECT idcher FROM cheflabo
        )";
        if($result = mysqli_query($db,$sql)){
            while ($row = mysqli_fetch_array($result)) {
                $idcher = $row["idcher"];
                $sql = "SELECT * FROM laboratoire WHERE idlabo IN (
                    SELECT idlabo FROM cheflabo WHERE idcher='".$idcher."'
                )";
                if($result3 = mysqli_query($db,$sql)){
                    $nomLabo =mysqli_fetch_array($result3)["nom"];
                    $nomcher = $row["nom"];
                    $profilcher = $row["profil"];
                    $gradecher = $row["grade"];
                    $mailcher = $row["mail"];
                    echo   '<tr>';
                    echo   '<td>'.$nomcher.'</td>';
                    echo   '<td>'.$profilcher.'</td>';
                    echo   '<td>'.$gradecher.'</td>';
                    echo   '<td>'.$mailcher.'</td>';
                    echo   '<td>'.$nomLabo.'</td>';
                    echo   '<td>';
                    echo    '<div class="btn-toolbar">';
                    echo    '<div class="btn-group">';
                    echo    '<button value="'.$idcher.'" title="accepter" class="btn btn-fill btn-success">Accepter</button>';
                    echo    '</div>';
                    echo    '<div class="btn-group">';
                    echo    '<button  value="'.$idcher.'" title="supprimer" class="btn-fill btn btn-danger">Décliner</button>';
                    echo    '</div>';
                    echo    '</div>';
                    echo   '</td>';
                    echo   '</tr>';
                }
                
            }
        }
        echo '</tbody>
            </table>
        </div>';
    }
?>