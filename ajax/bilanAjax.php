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

    if(isset($_GET["export"]) && $_GET["export"] == "false" && isset($_GET["typeProduction"]) && $_GET["typeProduction"] != "" && isset($_GET["deb"]) && $_GET["deb"] != "" && isset($_GET["fin"]) && $_GET["fin"] != ""){
        class production{
            public $codepro;
            public $titre;
            public $type;
            public $classe;
            public $inter;
            public $date;
        }

        $deb = mysqli_real_escape_string($db,$_GET["deb"]);
        $fin = mysqli_real_escape_string($db,$_GET["fin"]);
        $typeProduction = mysqli_real_escape_string($db,$_GET["typeProduction"]);
        if($typeProduction == "all"){
            $typeProduction= "";
        }
        else{
            $typeProduction = " AND type='".$typeProduction."' ";
        }

        if(isset($_GET["codeproj"]) && $_GET["codeproj"] != ""){
            $codeproj = mysqli_real_escape_string($db,$_GET["codeproj"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' AND codeproj='".$codeproj."'";
        }

        if(isset($_GET["bilancher"]) && $_GET["bilancher"] != ""){
            $idcher = mysqli_real_escape_string($db,$_GET["bilancher"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' ".$typeProduction." AND (codepro IN (
                SELECT codepro FROM auteurprinc WHERE idcher='".$idcher."' AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM coauteurs WHERE idcher='".$idcher."' AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM pfemaster WHERE encadreur='".$idcher."'
            )OR codepro IN (
                SELECT codepro FROM these WHERE encadreur='".$idcher."'
            )) AND codepro NOT IN (
                SELECT codepro FROM validationproduction
            )";
        }

        if(isset($_GET["bilanequipe"]) && $_GET["bilanequipe"] != ""){
            $idequipe = mysqli_real_escape_string($db,$_GET["bilanequipe"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' ".$typeProduction." AND (codepro IN (
                SELECT codepro FROM auteurprinc WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM coauteurs WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM pfemaster WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )OR codepro IN (
                SELECT codepro FROM these WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )) AND codepro NOT IN (
                SELECT codepro FROM validationproduction
            )";
        }
        
        if(isset($_GET["bilanlabo"]) && $_GET["bilanlabo"] != ""){
            $idlabo = mysqli_real_escape_string($db,$_GET["bilanlabo"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' ".$typeProduction." AND (codepro IN (
                SELECT codepro FROM auteurprinc WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM coauteurs WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM pfemaster WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )OR codepro IN (
                SELECT codepro FROM these WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )) AND codepro NOT IN (
                SELECT codepro FROM validationproduction
            )";
        }

        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $productions = array();
            while($row = mysqli_fetch_array($result)){
                $production = new production();
                $production->type = $row['type'];
                $production->date = $row['date'];
                $codepro = $row['codepro'];
                $production->codepro = $codepro;
                switch ($production->type) {
                    case 'publication':
                        $sql = "SELECT * FROM publication WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;
                    
                    case 'communication':
                        $sql = "SELECT * FROM communication WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;   

                    case 'ouvrage':
                        $sql = "SELECT * FROM ouvrage WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    case 'chapitreOuvrage':
                        $sql = "SELECT * FROM chapitredouvrage WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    case 'doctorat':
                        $sql = "SELECT * FROM these WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    case 'master':
                        $sql = "SELECT * FROM pfemaster WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    default:
                        # code...
                    break;
                }
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
            public $revueInterAutre;
            public $revueNat;
            public $autre;
            public $comInterA;
            public $comInterB;
            public $comInterC;
            public $comInterAutre;
            public $comNat;
            public $chapitreOuvrage;
            public $ouvrage;
            public $master;
            public $doctorat;
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
            $notes->revueInterAutre = $row['revueInterAutre'];
            $notes->revueNat = $row['revueNat'];
            $notes->autre = $row['autre'];
            $notes->comInterA = $row['comInterA'];
            $notes->comInterB = $row['comInterB'];
            $notes->comInterC = $row['comInterC'];
            $notes->comInterAutre = $row['comInterAutre'];
            $notes->comNat = $row['comNat'];
            $notes->chapitreOuvrage = $row['chapitreOuvrage'];
            $notes->ouvrage = $row['ouvrage'];
            $notes->doctorat = $row['doctorat'];
            $notes->master = $row['master'];
        }
        if(isset($notes))
            echo json_encode($notes);
        else echo "{}";
    }

    if(isset($_GET["export"]) && $_GET["export"] == "true" && isset($_GET["typeProduction"]) && $_GET["typeProduction"] != "" && isset($_GET["deb"]) && $_GET["deb"] != "" && isset($_GET["fin"]) && $_GET["fin"] != ""){
        class production{
            public $publication;
            public $communication;
            public $chapitreOuvrage;
            public $ouvrage;
            public $doctorat;
            public $master;
        }

        class publication{
            public $titre;
            public $date;
            public $domaine;
            public $specialite;
            public $auteurP;
            public $auteurs;
            public $motscles;
            public $revue;
            public $codeproj;
        }

        class communication{
            public $titre;
            public $date;
            public $domaine;
            public $specialite;
            public $auteurP;
            public $auteurs;
            public $motscles;
            public $conference;
            public $codeproj;
        }

        class chapitreOuvrage{
            public $titre;
            public $date;
            public $domaine;
            public $specialite;
            public $auteurP;
            public $auteurs;
            public $motscles;
            public $codeproj;
        }

        class ouvrage{
            public $titre;
            public $date;
            public $domaine;
            public $specialite;
            public $auteurP;
            public $auteurs;
            public $motscles;
            public $codeproj;
        }

        $deb = mysqli_real_escape_string($db,$_GET["deb"]);
        $fin = mysqli_real_escape_string($db,$_GET["fin"]);
        $typeProduction = mysqli_real_escape_string($db,$_GET["typeProduction"]);
        if($typeProduction == "all"){
            $typeProduction= "";
        }
        else{
            $typeProduction = " AND type='".$typeProduction."' ";
        }

        if(isset($_GET["codeproj"]) && $_GET["codeproj"] != ""){
            $codeproj = mysqli_real_escape_string($db,$_GET["codeproj"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' AND codeproj='".$codeproj."'";
        }

        if(isset($_GET["bilancher"]) && $_GET["bilancher"] != ""){
            $idcher = mysqli_real_escape_string($db,$_GET["bilancher"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' ".$typeProduction." AND (codepro IN (
                SELECT codepro FROM auteurprinc WHERE idcher='".$idcher."' AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM coauteurs WHERE idcher='".$idcher."' AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM pfemaster WHERE encadreur='".$idcher."'
            )OR codepro IN (
                SELECT codepro FROM these WHERE encadreur='".$idcher."'
            )) AND codepro NOT IN (
                SELECT codepro FROM validationproduction
            )";
        }

        if(isset($_GET["bilanequipe"]) && $_GET["bilanequipe"] != ""){
            $idequipe = mysqli_real_escape_string($db,$_GET["bilanequipe"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' ".$typeProduction." AND (codepro IN (
                SELECT codepro FROM auteurprinc WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM coauteurs WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM pfemaster WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )OR codepro IN (
                SELECT codepro FROM these WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe='".$idequipe."'
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe='".$idequipe."'
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )) AND codepro NOT IN (
                SELECT codepro FROM validationproduction
            )";
        }
        
        if(isset($_GET["bilanlabo"]) && $_GET["bilanlabo"] != ""){
            $idlabo = mysqli_real_escape_string($db,$_GET["bilanlabo"]);
            $sql = "SELECT * FROM production WHERE date BETWEEN '".$deb."' AND '".$fin."' ".$typeProduction." AND (codepro IN (
                SELECT codepro FROM auteurprinc WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM coauteurs WHERE (idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            ) OR codepro IN (
                SELECT codepro FROM pfemaster WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )OR codepro IN (
                SELECT codepro FROM these WHERE (encadreur IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                ) OR encadreur IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo='".$idlabo."'
                    )
                )) AND encadreur IN (
                    SELECT idcher FROM users WHERE actif='1'
                )
            )) AND codepro NOT IN (
                SELECT codepro FROM validationproduction
            )";
        }

        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $productions = new production();
            $publications = array();
            $communications = array();
            $chapitreOuvrages = array();

            while($row = mysqli_fetch_array($result)){
                switch ($row['type']) {
                    case 'communication':
                        $sql = "SELECT * FROM communication WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $communication = new communication();
                            $communication->codeproj = $row['codeproj'];
                            $communication->titre = $row2['titre'];
                            $communication->date = $row['date'];
                            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $communication->domaine = mysqli_fetch_array($result2)["nom"];
                            }
                            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $communication->specialite = mysqli_fetch_array($result2)["nomspe"];
                            }
                            $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $motscles = array();
                                while($row3 = mysqli_fetch_array($result2)){
                                    $motscles[] = $row3["mot"];
                                }
                                $communication->motscles = $motscles;
                            }
                            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $communication->auteurP = mysqli_fetch_array($result2)["nom"];
                            }
                            else{
                                $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                                $result2 = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result2) > 0){
                                    $communication->auteurP = mysqli_fetch_array($result2)["nom"];
                                }
                            }
                            $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $coauteurs = array();
                                while($row3 = mysqli_fetch_array($result2)){
                                    if($row3["idcher"] == 0){
                                        $coauteurs[] = $row3["nom"];
                                    }
                                    else{
                                        $idcherco = $row3["idcher"];
                                        $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                        $result3 = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result3) > 0){
                                            $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                                        }
                                    }
                                }
                                $communication->auteurs = $coauteurs;
                            }
                            $sql = "SELECT * FROM conference WHERE codeconf='".$codeconf."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $communication->conference = mysqli_fetch_array($result2)['nomconf'];
                                /*$nomconf = $row2["nomconf"];
                                $abrvconf = $row2["abrv"];
                                $annee = $row2["annee"];
                                $theme = $row2["theme"];
                                $periodicite = $row2["periodicite"];
                                $type = $row2["type"];
                                $classe = $row2["classe"];
                                $pays = $row2["pays"];*/
                            }
                        }
                    break;
                    
                    /*case 'communication':
                        $sql = "SELECT * FROM communication WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;   

                    case 'ouvrage':
                        $sql = "SELECT * FROM ouvrage WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    case 'chapitreOuvrage':
                        $sql = "SELECT * FROM chapitredouvrage WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    case 'doctorat':
                        $sql = "SELECT * FROM these WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    case 'master':
                        $sql = "SELECT * FROM pfemaster WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $production->titre = $row2['titre'];
                        }
                    break;

                    default:
                        # code...
                    break;*/
                }
                $productions->publication = $publications;
            }
        }
        if(isset($productions))
            echo json_encode($productions);
        else echo "[]";
    }

?>