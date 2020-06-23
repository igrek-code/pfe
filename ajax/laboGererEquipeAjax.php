<?php
    session_start();
    require_once("../config.php");
    if(isset($_GET["refresh"]) && $_GET["refresh"]){
        $idcher = $_SESSION["idcher"];
        echo '<div class="content">
        <table class="table table-hover">
            <thead>
                <th>Nom</th>
                <th>Etat</th>
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
                $idspe = $row["idspe"];
                $etat = $row['etat'];
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){    
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];
                    echo    '<tr>';
                    echo    '<td><button membrequipe="membrequipe" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$idequipe.'">'.$nomequipe.'</button></td>';
                    if($etat == "actif")    
                            echo    '<td class="text-success">Actif</td>';
                        else
                            echo    '<td class="text-danger">Inactif</td>';
                    echo    '<td>'.$nomspe.'</td>';
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

    if(isset($_GET['membre']) && $_GET['membre'] != ''){
        $idequipe = mysqli_real_escape_string($db,$_GET['membre']);
        $sql = "SELECT nom FROM chercheur WHERE idcher IN (
            SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $nomChef = mysqli_fetch_array($result)['nom'];
            echo '<span class="text-info">Chef: </span>'.$nomChef.'<br>';
            $sql = "SELECT nom FROM chercheur WHERE idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                echo '<span class="text-info">Membres: </span><br>';
                while($row = mysqli_fetch_array($result)){
                    $nomMembre = $row['nom'];
                    echo '- '.$nomMembre.'<br>';
                }
                echo '<br>';
            }
        }
        else{
            echo '<div class="text-danger">Informations indisponibles !</div>';
        }
    }

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $idequipe = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "DELETE FROM equipe WHERE idequipe='".$idequipe."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>