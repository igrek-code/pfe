<?php
    require_once("../config.php");
    if(isset($_GET["idetab"]) && $_GET["idetab"] != ""){
        $idetab = mysqli_real_escape_string($db,$_GET["idetab"]);
        $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $idlabo = $row["idlabo"];
                $nom = $row["nom"];
                echo '<option value="'.$idlabo.'">'.$nom.'</option>';
            }
        }
    }

    if(isset($_GET["idlabo"]) && $_GET["idlabo"] != ""){
        $idlabo = mysqli_real_escape_string($db,$_GET["idlabo"]);
        $sql = "SELECT * FROM equipe WHERE idlabo='".$idlabo."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $idequipe = $row["idequipe"];
                $nomequip = $row["nomequip"];
                echo '<option value="'.$idequipe.'">'.$nomequip.'</option>';
            }
        }
    }

    if(isset($_GET["idequipe"]) && $_GET["idequipe"] != ""){
        $idequipe = mysqli_real_escape_string($db,$_GET["idequipe"]);
        $sql = "SELECT * FROM chercheur WHERE idcher IN (
            SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
        )OR idcher IN (
            SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $idcher = $row["idcher"];
                $nom = $row["nom"];
                echo '<option value="'.$idcher.'">'.$nom.'</option>';
            }
        }
    }

    if(isset($_GET["bilancher"]) && $_GET["bilancher"] != "" && isset($_GET["deb"]) && $_GET["deb"] != "" && isset($_GET["fin"]) && $_GET["fin"] != ""){
        class production{
            public $titre;
            public $type;
            public $date;
        }
        $idcher = mysqli_real_escape_string($db,$_GET["bilancher"]);
        $deb = mysqli_real_escape_string($db,$_GET["deb"]);
        if(strlen($deb) == 4)
            $deb = $deb."-01";
        $fin = mysqli_real_escape_string($db,$_GET["fin"]);
        if(strlen($fin) == 4)
            $fin = $fin."-12";
        $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' AND codepro IN (
            SELECT codepro FROM auteurprinc WHERE idcher='".$idcher."'
        ) OR codepro IN (
            SELECT codepro FROM coauteurs WHERE idcher='".$idcher."'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $productions = array();
            while($row = mysqli_fetch_array($result)){
                $production = new production();
                $production->type = $row["type"];
                $codepro = $row["codepro"];
                $production->date = $row["date"];
                switch ($production->type) {
                    case 'publication':
                        $sql = "SELECT * FROM publication WHERE codepro='".$codepro."'";
                    break;
                    
                    case 'communication':
                        $sql = "SELECT * FROM communication WHERE codepro='".$codepro."'";
                    break;

                    case 'ouvrage':
                        $sql = "SELECT * FROM ouvrage WHERE codepro='".$codepro."'";
                    break;

                    case 'chapitreOuvrage':
                        $sql = "SELECT * FROM chapitredouvrage WHERE codepro='".$codepro."'";
                    break;

                    case 'doctorat':
                        $sql = "SELECT * FROM these WHERE codepro='".$codepro."'";
                    break;

                    default:
                        $sql = "SELECT * FROM pfemaster WHERE codepro='".$codepro."'";
                    break;
                }
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $production->titre = mysqli_fetch_array($result2)["titre"];
                }
                $productions[] = $production;
            }
        }
        if(isset($productions))
            echo json_encode($productions);
        else echo "[]";
    }
?>