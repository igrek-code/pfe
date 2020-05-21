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
            $productions = array();
            while($row = mysqli_fetch_array($result)){
                $production = new production();
                $production->codeproj = $row['codeproj'];
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
            public $projet;
            public $dateDeb;
            public $dateFin;
            public $publication;
            public $communication;
            public $chapitreOuvrage;
            public $ouvrage;
            public $doctorat;
            public $master;
            public $pour;
            public $nom;
        }

        class projet{
            public $intitule;
            public $date;
            public $description;
            public $duree;
            public $etat;
            public $domaine;
            public $motscles;
            public $chef;
            public $membres;
        }

        class publication{
            public $titre;
            public $date;
            public $doi;
            public $volume;
            public $issue;
            public $domaine;
            public $specialite;
            public $auteurP;
            public $auteurs;
            public $motscles;
            public $revue;
            public $eissn;
            public $issn;
            public $editeur;
            public $classe;
            public $type;
            public $pays;
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
            public $pages;
            public $volume;
            public $editeur;
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
            public $nbrePages;
            public $editeur;
            public $domaine;
            public $specialite;
            public $auteurP;
            public $auteurs;
            public $motscles;
            public $codeproj;
        }

        class doctorat{
            public $titre;
            public $date;
            public $nordre;
            public $lieu;
            public $domaine;
            public $specialite;
            public $encadreur;
            public $motscles;
            public $codeproj;
        }

        class master{
            public $titre;
            public $date;
            public $lieu;
            public $domaine;
            public $specialite;
            public $encadreur;
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
        $productions = new production();
        $productions->dateDeb = $deb;
        $productions->dateFin = $fin;
        if(isset($_GET['codeproj'])){
            $sql = "SELECT * FROM projrecher WHERE codeproj='".$codeproj."'";
            $result2 = mysqli_query($db,$sql);
            if(mysqli_num_rows($result2) > 0){
                $projet = new projet();
                $row2 = mysqli_fetch_array($result2);
                $projet->intitule = $row2['intitule'];
                $projet->date = $row2['date'];
                $projet->duree = $row2['duree'];
                $projet->etat = $row2['etat'];
                $projet->description = $row2['description'];
                $codeDomaine = $row2['codeDomaine'];
                $sql = "SELECT nom FROM domaine WHERE codeDomaine='".$codeDomaine."'";
                $result3 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result3) > 0){
                    $projet->domaine = mysqli_fetch_array($result3)['nom'];
                }
                $sql = "SELECT * FROM motscler WHERE codeproj='".$codeproj."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $motscles = '';
                    while($row3 = mysqli_fetch_array($result2)){
                        $motscles = $motscles.$row3["mot"].', ';
                    }
                    $projet->motscles = $motscles;
                }
                $sql = "SELECT nom FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM chefproj WHERE codeproj='".$codeproj."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $projet->chef = mysqli_fetch_array($result2)["nom"];
                }
                $sql = "SELECT nom FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM membreproj WHERE codeproj = '".$codeproj."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $coauteurs = '';
                    while($row3 = mysqli_fetch_array($result2)){
                        $coauteurs = $coauteurs.$row3["nom"].', ';
                    }
                    $projet->membres = $coauteurs;
                }
                $productions->projet = $projet;
            }
        }else if(isset($_GET['bilancher'])){
            $productions->pour = 'chercheur';
            $sql = "SELECT nom FROM chercheur WHERE idcher='".$idcher."'";
            $result2 = mysqli_query($db,$sql);
            $productions->nom = mysqli_fetch_array($result2)['nom'];
        }else if(isset($_GET['bilanequipe'])){
            $productions->pour = 'équipe';
            $sql = "SELECT nomequip FROM equipe WHERE idequipe='".$idequipe."'";
            $result2 = mysqli_query($db,$sql);
            $productions->nom = mysqli_fetch_array($result2)['nomequip'];
        }else if(isset($_GET['bilanlabo'])){
            $productions->pour = 'laboratoire';
            $sql = "SELECT nom FROM laboratoire WHERE idlabo='".$idlabo."'";
            $result2 = mysqli_query($db,$sql);
            $productions->nom = mysqli_fetch_array($result2)['nom'];
        }
        if(mysqli_num_rows($result) > 0){
            $publications = array();
            $communications = array();
            $chapitreOuvrages = array();
            $ouvrages = array();
            $masters = array();
            $doctorats = array();

            while($row = mysqli_fetch_array($result)){
                $codepro = $row['codepro'];
                switch ($row['type']) {
                    case 'publication':
                        $sql = "SELECT * FROM publication WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $publication = new publication();
                            $publication->codeproj = $row['codeproj'];
                            $publication->titre = $row2['titre'];
                            $publication->date = $row['date'];
                            $idspe = $row2['idspe'];
                            $coderevue = $row2['coderevue'];
                            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $publication->domaine = mysqli_fetch_array($result2)["nom"];
                            }
                            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $publication->specialite = mysqli_fetch_array($result2)["nomspe"];
                            }
                            $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $motscles = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    $motscles = $motscles.$row3["mot"].', ';
                                }
                                $publication->motscles = $motscles;
                            }
                            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $publication->auteurP = mysqli_fetch_array($result2)["nom"];
                            }
                            else{
                                $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                                $result2 = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result2) > 0){
                                    $publication->auteurP = mysqli_fetch_array($result2)["nom"];
                                }
                            }
                            $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $coauteurs = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    if($row3["idcher"] == 0){
                                        $coauteurs = $coauteurs.$row3["nom"].', ';
                                    }
                                    else{
                                        $idcherco = $row3["idcher"];
                                        $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                        $result3 = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result3) > 0){
                                            $coauteurs = $coauteurs.mysqli_fetch_array($result3)["nom"].', ';
                                        }
                                    }
                                }
                                $publication->auteurs = $coauteurs;
                            }
                            $sql = "SELECT * FROM revue WHERE coderevue='".$coderevue."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $row3 = mysqli_fetch_array($result2);
                                $publication->revue = $row3["nom"];
                                $publication->eissn = $row3["issnonline"];
                                $publication->issn = $row3["issnprint"];
                                $publication->editeur = $row3["editeur"];
                                $publication->classe = $row3["classe"];
                                $publication->type = $row3["type"];
                                $publication->pays = $row3["pays"];
                            }
                        }
                        $publications[] = $publication; 
                    break;

                    case 'communication':
                        $sql = "SELECT * FROM communication WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $communication = new communication();
                            $communication->codeproj = $row['codeproj'];
                            $communication->titre = $row2['titre'];
                            $communication->date = $row['date'];
                            $idspe = $row2['idspe'];
                            $codeconf = $row2['codeconf'];
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
                                $motscles = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    $motscles = $motscles.$row3["mot"].', ';
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
                                $coauteurs = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    if($row3["idcher"] == 0){
                                        $coauteurs = $coauteurs.$row3["nom"].', ';
                                    }
                                    else{
                                        $idcherco = $row3["idcher"];
                                        $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                        $result3 = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result3) > 0){
                                            $coauteurs = $coauteurs.mysqli_fetch_array($result3)["nom"].', ';
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
                        $communications[] = $communication; 
                    break;
                    
                    case 'ouvrage':
                        $sql = "SELECT * FROM ouvrage WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $ouvrage = new ouvrage();
                            $ouvrage->codeproj = $row['codeproj'];
                            $ouvrage->titre = $row2['titre'];
                            $ouvrage->date = $row['date'];
                            $ouvrage->nbrePages = $row2['nbpages'];
                            $ouvrage->editeur = $row2['editeur'];
                            $idspe = $row2['idspe'];
                            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $ouvrage->domaine = mysqli_fetch_array($result2)["nom"];
                            }
                            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $ouvrage->specialite = mysqli_fetch_array($result2)["nomspe"];
                            }
                            $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $motscles = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    $motscles = $motscles.$row3["mot"].', ';
                                }
                                $ouvrage->motscles = $motscles;
                            }
                            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $ouvrage->auteurP = mysqli_fetch_array($result2)["nom"];
                            }
                            else{
                                $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                                $result2 = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result2) > 0){
                                    $ouvrage->auteurP = mysqli_fetch_array($result2)["nom"];
                                }
                            }
                            $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $coauteurs = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    if($row3["idcher"] == 0){
                                        $coauteurs = $coauteurs.$row3["nom"].', ';
                                    }
                                    else{
                                        $idcherco = $row3["idcher"];
                                        $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                        $result3 = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result3) > 0){
                                            $coauteurs = $coauteurs.mysqli_fetch_array($result3)["nom"].', ';
                                        }
                                    }
                                }
                                $ouvrage->auteurs = $coauteurs;
                            }
                        }
                        $ouvrages[] = $ouvrage; 
                    break;

                    case 'chapitreOuvrage':
                        $sql = "SELECT * FROM chapitredouvrage WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $chapitreOuvrage = new chapitreOuvrage();
                            $chapitreOuvrage->codeproj = $row['codeproj'];
                            $chapitreOuvrage->titre = $row2['titre'];
                            $chapitreOuvrage->date = $row['date'];
                            $chapitreOuvrage->pages = $row2['pages'];
                            $chapitreOuvrage->volume = $row2['volume'];
                            $chapitreOuvrage->editeur = $row2['editeur'];
                            $idspe = $row2['idspe'];
                            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $chapitreOuvrage->domaine = mysqli_fetch_array($result2)["nom"];
                            }
                            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $chapitreOuvrage->specialite = mysqli_fetch_array($result2)["nomspe"];
                            }
                            $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $motscles = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    $motscles = $motscles.$row3["mot"].', ';
                                }
                                $chapitreOuvrage->motscles = $motscles;
                            }
                            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $chapitreOuvrage->auteurP = mysqli_fetch_array($result2)["nom"];
                            }
                            else{
                                $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                                $result2 = mysqli_query($db,$sql);
                                if(mysqli_num_rows($result2) > 0){
                                    $chapitreOuvrage->auteurP = mysqli_fetch_array($result2)["nom"];
                                }
                            }
                            $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $coauteurs = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    if($row3["idcher"] == 0){
                                        $coauteurs = $coauteurs.$row3["nom"].', ';
                                    }
                                    else{
                                        $idcherco = $row3["idcher"];
                                        $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                        $result3 = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result3) > 0){
                                            $coauteurs = $coauteurs.mysqli_fetch_array($result3)["nom"].', ';
                                        }
                                    }
                                }
                                $chapitreOuvrage->auteurs = $coauteurs;
                            }
                        }
                        $chapitreOuvrages[] = $chapitreOuvrage; 
                    break;

                    case 'doctorat':
                        $sql = "SELECT * FROM these WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $doctorat = new doctorat();
                            $doctorat->codeproj = $row['codeproj'];
                            $doctorat->titre = $row2['titre'];
                            $doctorat->date = $row['date'];
                            $doctorat->nordre = $row2['nordre'];
                            $doctorat->lieu = $row2['lieusout'];
                            $encadreur = $row2['encadreur'];
                            $idspe = $row2['idspe'];
                            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $doctorat->domaine = mysqli_fetch_array($result2)["nom"];
                            }
                            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $doctorat->specialite = mysqli_fetch_array($result2)["nomspe"];
                            }
                            $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $motscles = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    $motscles = $motscles.$row3["mot"].', ';
                                }
                                $doctorat->motscles = $motscles;
                            }
                            $sql = "SELECT nom FROM chercheur WHERE idcher='".$encadreur."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $doctorat->encadreur = mysqli_fetch_array($result2)["nom"];
                            }
                        }
                        $doctorats[] = $doctorat; 
                    break;

                    case 'master':
                        $sql = "SELECT * FROM pfemaster WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $row2 = mysqli_fetch_array($result2);
                            $master = new master();
                            $master->codeproj = $row['codeproj'];
                            $master->titre = $row2['titre'];
                            $master->date = $row['date'];
                            $master->lieu = $row2['lieusout'];
                            $encadreur = $row2['encadreur'];
                            $idspe = $row2['idspe'];
                            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                            )";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $master->domaine = mysqli_fetch_array($result2)["nom"];
                            }
                            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $master->specialite = mysqli_fetch_array($result2)["nomspe"];
                            }
                            $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $motscles = '';
                                while($row3 = mysqli_fetch_array($result2)){
                                    $motscles = $motscles.$row3["mot"].', ';
                                }
                                $master->motscles = $motscles;
                            }
                            $sql = "SELECT nom FROM chercheur WHERE idcher='".$encadreur."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $master->encadreur = mysqli_fetch_array($result2)["nom"];
                            }
                        }
                        $masters[] = $master; 
                    break;
                }
            }
            if(!empty($publications))
            $productions->publication = $publications;
            if(!empty($communications))
            $productions->communication = $communications;
            if(!empty($ouvrages))
            $productions->ouvrage = $ouvrages;
            if(!empty($chapitreOuvrages))
            $productions->chapitreOuvrage = $chapitreOuvrages;
            if(!empty($masters))
            $productions->master = $masters;
            if(!empty($doctorats))
            $productions->doctorat = $doctorats;
        }
        $myfile = fopen("tempo/productions.json", "w");
        fwrite($myfile,json_encode($productions));
        fclose($myfile);
        exec('python tempo/excel.py',$returnedArray,$returnedInt);
        $generatedFile = 'tempo/productions.xlsx';
        while(!file_exists($generatedFile));
    }

?>