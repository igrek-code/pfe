<?php
    require_once("../config.php");
    if(isset($_GET["idetab"])){
        $idetab = mysqli_real_escape_string($db,$_GET['idetab']);
        $sql = "DELETE FROM etablissement WHERE idetab='".$idetab."'";
        if(mysqli_query($db,$sql)) echo 'true';
        else echo 'false';
    }

    if(isset($_GET["loadTable"])){
        $sql = "SELECT * FROM etablissement";
        $result = mysqli_query($db,$sql);
        while ($row = mysqli_fetch_array($result)) {
            $nom = $row["nom"];
            $abrv = $row["abrv"];
            $type = $row["type"];
            $addresse = $row["addresse"];
            $tel = $row["tel"];
            $fax = $row["fax"];
            $siteweb = $row["siteweb"];
            $id = $row["idetab"];
        echo    '<tr>';
        echo    '<td>'.$nom.'</td>';
        echo    '<td>'.$abrv.'</td>';
        echo    '<td>'.$type.'</td>';
        //echo    '<td><a rel="external" target="_blank" href="http://www.'.$siteweb.'">'.$siteweb.'</a></td>';
        echo    '<td>';
        echo    '<div class="btn-toolbar">';
        echo    '<div class="btn-group">';
        echo    '<a href="adminModifierEtab.php?modifier='.$id.'" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
        echo    '</div>';
        echo    '<div class="btn-group">';
        echo    '<button  value="'.$id.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
        echo    '</div>';
        echo    '</div>';
        echo    '</td>';
        echo    '</tr>';
        }
    }

    /*if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = "SELECT nom from etablissement";
        if($result = mysqli_query($db,$sql)){
            $rows = array();
            while($row = mysqli_fetch_array($result)){
                $rows[] = $row;
            }
            echo json_encode($rows);
        }
    }        
   */
?>