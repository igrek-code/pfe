<?php
    session_start();
    require_once("../config.php");
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
?>