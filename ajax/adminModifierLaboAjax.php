<?php
    require_once("../config.php");

    if(isset($_GET["codeDomaine"]) && $_GET["codeDomaine"] != "" && isset($_GET["idlabo"]) && $_GET["idlabo"] != ""){
        $codeDomaine = mysqli_real_escape_string($db,$_GET["codeDomaine"]);
        $idlabo = mysqli_real_escape_string($db,$_GET["idlabo"]);
        $sql = "SELECT * FROM specialitelabo WHERE idspe IN (
            SELECT idspe FROM specialite WHERE codeDomaine ='".$codeDomaine."'
        ) AND idlabo='".$idlabo."'";
        if($result2 = mysqli_query($db,$sql)){
            $specialites = array();
            while($specialites[] = mysqli_fetch_array($result2)["idspe"]);
            if(isset($_GET["nomDomaine"])){
                $nomDomaine = $_GET["nomDomaine"];
                echo '<optgroup label="'.$nomDomaine.'">';
                $sql = "SELECT * FROM specialite WHERE codeDomaine='".$codeDomaine."'";
                if($result = mysqli_query($db,$sql)){
                    while ($row = mysqli_fetch_array($result)) {
                        $idspe = $row["idspe"];
                        $nomspe = $row["nomspe"];
                        $samespe = false;
                        foreach ($specialites as $specialite) {
                            if($specialite == $idspe){
                                $samespe = true;
                                break;
                            }
                        }
                        if($samespe)
                            echo '<option selected value="'.$idspe.'">'.$nomspe.'</option>';
                        else
                            echo '<option value="'.$idspe.'">'.$nomspe.'</option>';
                    }
                }
                echo '</optgroup>';
            }
        }
    }
    
    /*if(isset($_GET["all"]) && $_GET["all"] == "all"){
        echo '<select class="form-control selectpicker" data-live-search="true" name="idcher" id="idcher" title="Chercheur...">';
        $sql = "SELECT * FROM chercheur WHERE profil='permanent' AND actif=1";
        if($result = mysqli_query($db,$sql)){
            while($row = mysqli_fetch_array($result)){
                $nomcher = $row["nom"];
                $idcher = $row["idcher"];
                echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
            }
        }
        echo '</select>';
    }*/
?>
        