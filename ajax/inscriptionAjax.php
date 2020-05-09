<?php
    require_once("../config.php");

    if(isset($_GET["idetab"]) && $_GET["idetab"] != ""){
        $idetab = mysqli_real_escape_string($db,$_GET["idetab"]);
        if(isset($_GET["codeDomaine"])){
            if(isset($_GET["nomDomaine"])){
                $nomDomaine = mysqli_real_escape_string($db,$_GET["nomDomaine"]);
                if($_GET["cheflabo"] != "true")
                    $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idspe IN (
                        SELECT idspe FROM specialite WHERE codeDomaine IN (
                            SELECT codeDomaine FROM domaine WHERE nom = '".$nomDomaine."'
                        )
                    )"; 
                else  
                    $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idspe IN (
                        SELECT idspe FROM specialite WHERE codeDomaine IN (
                            SELECT codeDomaine FROM domaine WHERE nom = '".$nomDomaine."'
                        )
                    ) AND idlabo NOT IN (
                        SELECT idlabo FROM cheflabo
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
                        SELECT idspe FROM laboratoire WHERE idetab='".$idetab."'
                    )
                ) GROUP BY nom";
                if($result = mysqli_query($db,$sql)){
                    while($row = mysqli_fetch_array($result)){
                        $nomDomaine = $row["nom"];
                        if($_GET["cheflabo"] != "true"){
                            $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idspe IN (
                                SELECT idspe FROM specialite WHERE codeDomaine IN (
                                    SELECT codeDomaine FROM domaine WHERE nom = '".$nomDomaine."'
                                )
                            )"; 
                        }
                        else{  
                            $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idspe IN (
                                SELECT idspe FROM specialite WHERE codeDomaine IN (
                                    SELECT codeDomaine FROM domaine WHERE nom = '".$nomDomaine."'
                                )
                            ) AND idlabo NOT IN (
                                SELECT idlabo FROM cheflabo
                            )"; 
                        }
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
                    SELECT idspe FROM laboratoire WHERE idetab='".$idetab."'
                )
            )GROUP BY nom";
            if($result = mysqli_query($db,$sql)){
                while($row = mysqli_fetch_array($result)){
                    $nomDomaine = $row["nom"];
                    echo '<option value="'.$nomDomaine.'">'.$nomDomaine.'</option>';
                }
            }
        }
    }

    if(isset($_GET["idlabo"])){
        if($_GET["chefequipe"] == "true"){
            $idlabo = mysqli_real_escape_string($db,$_GET["idlabo"]);
            $sql = "SELECT * FROM equipe WHERE idlabo='".$idlabo."' AND idequipe NOT IN (
                SELECT idequipe FROM chefequip
            )";
            if($result = mysqli_query($db,$sql)){
                while($row = mysqli_fetch_array($result)){
                    $nomequip = $row["nomequip"]; 
                    $idequipe = $row["idequipe"];
                    echo '<option value="'.$idequipe.'">'.$nomequip.'</option>';
                }
            }
        }
        else{
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
    }
?>