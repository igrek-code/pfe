<?php
    session_start();
    require_once("../config.php");
    $idlabo = $_SESSION["idlabo"];
    $idchef = $_SESSION["idcher"];

    if(isset($_GET["idcher"]) && $_GET["idcher"] != ""){
        $idcher = mysqli_real_escape_string($db,$_GET["idcher"]);
        if(isset($_GET["action"]) && $_GET["action"] == "accepter"){
            $sql = "UPDATE users SET actif=1 WHERE idcher='".$idcher."'";
            if(mysqli_query($db,$sql))
                echo 'true';
        }
        else{
            $sql = "DELETE FROM chercheur WHERE idcher='".$idcher."'";
            if(mysqli_query($db,$sql)) echo 'true';
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
                <th>Equipe</th>
                <th>Action</th>
            </thead>
            <tbody>';
        $sql = "SELECT * FROM chercheur WHERE idcher IN (
            SELECT idcher FROM users WHERE actif = 0
        ) AND idcher IN (
            SELECT idcher FROM chefequip WHERE idequipe IN (
                SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)) {
                $idcher = $row["idcher"];
                $sql = "SELECT * FROM equipe WHERE idequipe IN (
                    SELECT idequipe FROM chefequip WHERE idcher='".$idcher."'
                )";
                if($result3 = mysqli_query($db,$sql)){
                    $row3 = mysqli_fetch_array($result3);
                    $nomLabo = $row3["nomequip"];
                    $idequipe = $row3['idequipe'];
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

    if(isset($_GET["refresh1"]) && $_GET["refresh1"]){
        echo '<div class="content">
        <table class="table table-hover" id="myTable1" >
            <thead>
                <th>Nom</th>
                <th>Profil</th>
                <th>Grade</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody>';
        $sql = "SELECT * FROM chercheur WHERE idcher IN (
            SELECT idcher FROM users WHERE actif = 0
        ) AND idcher IN (
            SELECT idcher FROM menbrequip WHERE idequipe IN (
                SELECT idequipe FROM chefequip WHERE idcher='".$idchef."'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)) {
                $idcher = $row["idcher"];
                $nomcher = $row["nom"];
                $profilcher = $row["profil"];
                $gradecher = $row["grade"];
                $mailcher = $row["mail"];
                echo   '<tr>';
                echo   '<td>'.$nomcher.'</td>';
                echo   '<td>'.$profilcher.'</td>';
                echo   '<td>'.$gradecher.'</td>';
                echo   '<td>'.$mailcher.'</td>';
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
        echo '</tbody>
            </table>
        </div>';
    }
?>