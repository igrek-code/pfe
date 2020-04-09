<?php
    require_once("../config.php");

    if(isset($_GET["codeDomaine"]) && $_GET["codeDomaine"] != ""){
        $codeDomaine = mysqli_real_escape_string($db,$_GET["codeDomaine"]);
        if(isset($_GET["nomDomaine"])){
            $nomDomaine = $_GET["nomDomaine"];
            echo '<optgroup label="'.$nomDomaine.'">';
            $sql = "SELECT * FROM specialite WHERE codeDomaine='".$codeDomaine."'";
            if($result = mysqli_query($db,$sql)){
                while ($row = mysqli_fetch_array($result)) {
                    $idspe = $row["idspe"];
                    $nomspe = $row["nomspe"];
                    echo '<option value="'.$idspe.'">'.$nomspe.'</option>';
                }
            }
            echo '</optgroup>';
        }
    }
    
    if(isset($_GET["all"]) && $_GET["all"] == "all"){
        echo '<select class="form-control selectpicker" data-live-search="true" name="idcher" id="idcher" title="Chercheur...">';
        $sql = "SELECT * FROM chercheur WHERE profil='permanent'";
        if($result = mysqli_query($db,$sql)){
            while($row = mysqli_fetch_array($result)){
                $nomcher = $row["nom"];
                $idcher = $row["idcher"];
                echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
            }
        }
        echo '</select>';
    }
?>
        