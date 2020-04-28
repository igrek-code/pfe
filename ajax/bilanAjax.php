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

    /* -------------------------------------------------------------------------------------------------------- */

    /*if(isset($_GET["typeProduction"]) && $_GET["typeProduction"] == "all" && isset($_GET["bilancher"]) && $_GET["bilancher"] != "" && isset($_GET["deb"]) && $_GET["deb"] != "" && isset($_GET["fin"]) && $_GET["fin"] != ""){
        class production{
            public $type;
            public $date;
        }
        $idcher = mysqli_real_escape_string($db,$_GET["bilancher"]);
        $deb = mysqli_real_escape_string($db,$_GET["deb"]);
        $fin = mysqli_real_escape_string($db,$_GET["fin"]);

        $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' AND codepro IN (
            SELECT codepro FROM auteurprinc WHERE idcher='".$idcher."' AND idcher IN (
                SELECT idcher FROM users WHERE actif='1'
            )
        ) OR codepro IN (
            SELECT codepro FROM coauteurs WHERE idcher='".$idcher."' AND idcher IN (
                SELECT idcher FROM users WHERE actif='1'
            )
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
    }*/

    if(isset($_GET["typeProduction"]) && $_GET["typeProduction"] != "" && isset($_GET["bilancher"]) && $_GET["bilancher"] != "" && isset($_GET["deb"]) && $_GET["deb"] != "" && isset($_GET["fin"]) && $_GET["fin"] != ""){
        class production{
            public $type;
            public $classe;
            public $inter;
            public $date;
        }
        $idcher = mysqli_real_escape_string($db,$_GET["bilancher"]);
        $deb = mysqli_real_escape_string($db,$_GET["deb"]);
        $fin = mysqli_real_escape_string($db,$_GET["fin"]);
        $typeProduction = mysqli_real_escape_string($db,$_GET["typeProduction"]);
        if($typeProduction == "all"){
            $typeProduction= "";
        }
        else{
            $typeProduction = " AND type='".$typeProduction."' ";
        }

        $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' ".$typeProduction." AND codepro IN (
            SELECT codepro FROM auteurprinc WHERE idcher='".$idcher."' AND idcher IN (
                SELECT idcher FROM users WHERE actif='1'
            )
        ) OR codepro IN (
            SELECT codepro FROM coauteurs WHERE idcher='".$idcher."' AND idcher IN (
                SELECT idcher FROM users WHERE actif='1'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $productions = array();
            while($row = mysqli_fetch_array($result)){
                $production = new production();
                $production->type = $row['type'];
                $production->date = $row['date'];
                $codepro = $row['codepro'];
                switch ($production->type) {
                    case 'publication':
                        $sql = "SELECT * FROM revue WHERE coderevue IN (
                            SELECT coderevue FROM publication WHERE codepro='".$codepro."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->classe = $row2['classe'];
                            $production->inter = $row2['type'];
                        }
                    break;

                    case 'communication':
                        $sql = "SELECT * FROM conference WHERE codeconf IN (
                            SELECT codeconf FROM communication WHERE codepro='".$codepro."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->classe = $row2['classe'];
                            $production->inter = $row2['type'];
                        }
                    break;

                    default:
                        $production->classe = '';
                        $production->inter = '';
                    break;
                }
                $productions[] = $production;
            }
        }
        if(isset($productions))
            echo json_encode($productions);
        else echo "[]";
    }

    if(isset($_GET['sysNotes'])){
        class Notes{
            public $revueInterAA;
            public $revueInterA;
            public $revueInterB;
            public $revueInterC;
            public $revueNat;
            public $autre;
            public $comInterA;
            public $comInterB;
            public $comInterC;
            public $comNat;
            public $chapitreOuvrage;
            public $ouvrage;
        }
        $sql = "SELECT * FROM systemenotes WHERE id='1'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $notes = new Notes();
            $notes->revueInterAA = $row['revueInterAA'];
            $notes->revueInterA = $row['revueInterA'];
            $notes->revueInterB = $row['revueInterB'];
            $notes->revueInterC = $row['revueInterC'];
            $notes->revueNat = $row['revueNat'];
            $notes->autre = $row['autre'];
            $notes->comInterA = $row['comInterA'];
            $notes->comInterB = $row['comInterB'];
            $notes->comInterC = $row['comInterC'];
            $notes->comNat = $row['comNat'];
            $notes->chapitreOuvrage = $row['chapitreOuvrage'];
            $notes->ouvrage = $row['ouvrage'];
        }
        if(isset($notes))
            echo json_encode($notes);
        else echo "{}";
    }

?>