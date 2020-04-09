<?php
    require_once("../config.php");

    if(isset($_GET["idetab"]) && $_GET["idetab"] != ""){
        $idetab = mysqli_real_escape_string($db,$_GET["idetab"]);
        if(isset($_GET["codeDomaine"])){
            if(isset($_GET["nomDomaine"])){
                $codeDomaine = mysqli_real_escape_string($db,$_GET["codeDomaine"]);
                $nomDomaine = mysqli_real_escape_string($db,$_GET["nomDomaine"]);
                $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idlabo IN (
                    SELECT idlabo from specialitelabo WHERE idspe IN (
                        SELECT idspe FROM specialite WHERE codeDomaine ='".$codeDomaine."'
                    )
                )"; 
                if($result = mysqli_query($db,$sql)){
                    while ($row = mysqli_fetch_array($result)) {
                        $idlabo = $row["idlabo"];
                        $nomlabo = $row["nom"];
                        echo '<option value="'.$idlabo.'">'.$nomlabo.'</option>';
                    }
                }
            }
            else{
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe IN (
                        SELECT idspe FROM specialitelabo WHERE idlabo IN (
                            SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                        ) 
                    )
                )";
                if($result = mysqli_query($db,$sql)){
                    while($row = mysqli_fetch_array($result)){
                        $codeDomaine = $row["codeDomaine"];
                        $nomDomaine = $row["nom"];
                        $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idlabo IN (
                            SELECT idlabo from specialitelabo WHERE idspe IN (
                                SELECT idspe FROM specialite WHERE codeDomaine ='".$codeDomaine."'
                            )
                        )"; 
                        if($result2 = mysqli_query($db,$sql)){
                            echo '<optgroup label="'.$nomDomaine.'">';
                            while ($row2 = mysqli_fetch_array($result2)) {
                                $idlabo = $row2["idlabo"];
                                $nomlabo = $row2["nom"];
                                echo '<option value="'.$idlabo.'">'.$nomlabo.'</option>';
                            }
                            echo '</optgroup>';
                        }
                    }
                }
            }
        }
        else{
            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                SELECT codeDomaine FROM specialite WHERE idspe IN (
                    SELECT idspe FROM specialitelabo WHERE idlabo IN (
                        SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                    ) 
                )
            )";
            if($result = mysqli_query($db,$sql)){
                while($row = mysqli_fetch_array($result)){
                    $codeDomaine = $row["codeDomaine"];
                    $nomDomaine = $row["nom"];
                    echo '<option value="'.$codeDomaine.'">'.$nomDomaine.'</option>';
                }
            }
        }
    }

    if(isset($_GET["idlabo"])){
        $idlabo = mysqli_real_escape_string($db,$_GET["idlabo"]);
        $sql = "SELECT * FROM equipe WHERE idlabo='".$idlabo."'";
        if($result = mysqli_query($db,$sql)){
            while($row = mysqli_fetch_array($result)){
                $nomequip = $row["nomequip"]; 
                $idequipe = $row["idequipe"];
                echo '<option value="'.$idequipe.'">'.$nomequip.'</option>';
            }
        }
    }
?>