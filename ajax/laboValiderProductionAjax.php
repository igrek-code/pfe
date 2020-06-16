<?php
    session_start();
    require_once("../config.php");
    $idequipe = $_SESSION["idequipe"];

    if(isset($_GET["typeProduction"]) && $_GET["typeProduction"] != ""){
        switch ($_GET["typeProduction"]) {
            case 'publication':
                afficher_publication($db,$idequipe);
            break;
            
            case 'communication':
                afficher_communication($db,$idequipe);
            break;

            case 'ouvrage':
                afficher_ouvrage($db,$idequipe);
            break;

            case 'chapitreOuvrage':
                afficher_chapitreOuvrage($db,$idequipe);
            break;

            case 'doctorat':
                afficher_doctorat($db,$idequipe);
            break;

            case 'master':
                afficher_master($db,$idequipe);
            break;

            default:
                # code...
            break;
        }
    }

    function afficher_master($db,$idequipe){
        $sql = "SELECT * FROM pfemaster WHERE codepro IN (
            SELECT codepro FROM validationproduction WHERE idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe IN (
                    SELECT idequipe FROM equipe WHERE idequipe ='".$idequipe."'
                )
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="content">
            <table class="table table-hover">
                <thead>
                    <th>n projet</th>
                    <th>Lieu</th>
                    <th>Domaine</th>
                    <th>Spécialités</th>
                    <th>Mots-clè</th>
                    <th>Encadreur</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Projet</th>
                    <th>Posté par</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $titre = $row["titre"];
                $nproj = $row["nproj"];
                $lieusout = $row["lieusout"];
                $idencadreur = $encadreur = $row["encadreur"];
                $sql = "SELECT * FROM chercheur WHERE idcher='".$encadreur."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $encadreur = mysqli_fetch_array($result2)["nom"]; 
                }
                $idspe = $row["idspe"];
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomDomaine = mysqli_fetch_array($result2)["nom"];
                }
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];
                }
                $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $motscles = array();
                    while($row = mysqli_fetch_array($result2)){
                        $motscles[] = $row["mot"];
                    }
                }
                $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $date = $row2["date"]; 
                    if(isset($row2['codeproj']))
                        $codeproj = $row2['codeproj'];
                }
                echo    '<tr>';
                echo    '<td>'.$nproj.'</td>';
                echo    '<td>'.$lieusout.'</td>';
                echo    '<td>'.$nomDomaine.'</td>';
                echo    '<td>'.$nomspe.'</td>'; 
                echo    '<td>';
                foreach ($motscles as $mot) {
                    echo $mot.', ';
                }   
                echo    '</td>';
                echo    '<td>'.$encadreur.'</td>';
                echo    '<td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codepro.'">'.$titre.'</button></td>';
                echo    '<td>'.$date.'</td>';
                if(isset($codeproj))
                    echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">'.$codeproj.'</button></td>';
                    else    
                    echo '<td></td>';
                echo    '<td><button postedBy="postedBy" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$idencadreur.'">'.$encadreur.'</button></td>';
                echo   '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<button value="'.$codepro.'" title="valider" class="btn btn-fill btn-success">Valider</button>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codepro.'" title="supprimer" class="btn-fill btn btn-danger">Supprimer</button>';
                echo    '</div>';
                echo    '</div>';
                echo   '</td>';
                echo    '</tr>';
            }
            echo '</tbody></table></div>';
        }
    }

    function afficher_doctorat($db,$idequipe){
        $sql = "SELECT * FROM these WHERE codepro IN (
            SELECT codepro FROM validationproduction WHERE idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe ='".$idequipe."'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="content">
            <table class="table table-hover">
                <thead>
                    <th>N Ordre</th>
                    <th>Lieu</th>
                    <th>Domaine</th>
                    <th>Spécialités</th>
                    <th>Mots-clè</th>
                    <th>Encadreur</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Projet</th>
                    <th>URL</th>
                    <th>Posté par</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $titre = $row["titre"];
                $lieusout = $row["lieusout"];
                $nordre = $row["nordre"];
                $url = $row["url"];
                $idencadreur = $encadreur = $row["encadreur"];
                $sql = "SELECT * FROM chercheur WHERE idcher='".$encadreur."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $encadreur = mysqli_fetch_array($result2)["nom"]; 
                }
                $idspe = $row["idspe"];
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomDomaine = mysqli_fetch_array($result2)["nom"];
                }
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];
                }
                $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $motscles = array();
                    while($row = mysqli_fetch_array($result2)){
                        $motscles[] = $row["mot"];
                    }
                }
                $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $date = $row2["date"]; 
                    if(isset($row2['codeproj']))
                        $codeproj = $row2['codeproj'];
                }
                echo    '<tr>';
                echo    '<td>'.$nordre.'</td>';
                echo    '<td>'.$lieusout.'</td>';
                echo    '<td>'.$nomDomaine.'</td>';
                echo    '<td>'.$nomspe.'</td>'; 
                echo    '<td>';
                foreach ($motscles as $mot) {
                    echo $mot.', ';
                }   
                echo    '</td>';
                echo    '<td>'.$encadreur.'</td>';
                echo    '<td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codepro.'">'.$titre.'</button></td>';
                echo    '<td>'.$date.'</td>';
                if(isset($codeproj))
                    echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">'.$codeproj.'</button></td>';
                    else    
                    echo '<td></td>';
                    if(strpos($url,'http') === false)
                    echo    '<td><a target="_blank" href="http://'.$url.'">lien</a></td>';
                else
                    echo    '<td><a target="_blank" href="'.$url.'">lien</a></td>';
                echo    '<td><button postedBy="postedBy" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$idencadreur.'">'.$encadreur.'</button></td>';
                echo    '</tr>';
            }
            echo '</tbody></table></div>';
        }        
    }

    function afficher_chapitreOuvrage($db,$idequipe){
        $sql = "SELECT * FROM chapitredouvrage WHERE codepro IN (
            SELECT codepro FROM validationproduction WHERE idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe ='".$idequipe."'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="content">
            <table class="table table-hover">
                <thead>
                    <th>Editeur</th>
                    <th>Pages</th>
                    <th>Volume</th>
                    <th>Domaine</th>
                    <th>Spécialités</th>
                    <th>Mots-clè</th>
                    <th>Auteur principal</th>
                    <th>Co-auteurs</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Projet</th>
                    <th>ISBN</th>
                    <th>URL</th>
                    <th>Posté par</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $sql = "SELECT * FROM validationproduction WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $idpostedBy = mysqli_fetch_array($result2)["idcher"];
                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idpostedBy."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $postedBy = mysqli_fetch_array($result2)["nom"];
                    }
                }
                /*-------------------------*/
                $idspe = $row["idspe"];
                $titre = $row["titre"];
                $isbn = $row['isbn'];
                $pages = $row["pages"];
                $pages = str_replace(","," ",$pages);
                $pages = str_replace("-"," ",$pages);
                $editeur = $row["editeur"];
                $volume = $row["volume"];
                $url = $row["url"];
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomDomaine = mysqli_fetch_array($result2)["nom"];
                }
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];
                }
                $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $motscles = array();
                    while($row = mysqli_fetch_array($result2)){
                        $motscles[] = $row["mot"];
                    }
                }
                $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $date = $row2["date"]; 
                    if(isset($row2['codeproj']))
                        $codeproj = $row2['codeproj'];
                }
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $auteurprinc = mysqli_fetch_array($result2)["nom"];
                }
                else{
                    $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $auteurprinc = mysqli_fetch_array($result2)["nom"];
                    }
                }
                $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $coauteurs = array();
                    while($row2 = mysqli_fetch_array($result2)){
                        if($row2["idcher"] == 0){
                            $coauteurs[] = $row2["nom"];
                        }
                        else{
                            $idcherco = $row2["idcher"];
                            $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                            $result3 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result3) > 0){
                                $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                            }
                        }
                    }
                }
                echo    '<tr>';
                echo    '<td>'.$editeur.'</td>';
                echo    '<td>'.$pages.'</td>';
                echo    '<td>'.$volume.'</td>';
                echo    '<td>'.$nomDomaine.'</td>';
                echo    '<td>'.$nomspe.'</td>'; 
                echo    '<td>';
                foreach ($motscles as $mot) {
                    echo $mot.' ';
                }   
                echo    '</td>';
                echo    '<td>'.$auteurprinc.'</td>';
                echo    '<td>';
                foreach ($coauteurs as $auteur) {
                    echo $auteur.' ';
                }
                echo    '</td>';
                echo    '<td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codepro.'">'.$titre.'</button></td>';
                echo    '<td>'.$date.'</td>';
                if(isset($codeproj))
                    echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">'.$codeproj.'</button></td>';
                    else    
                    echo '<td></td>';
                echo    '<td>'.$isbn.'</td>';
                if(strpos($url,'http') === false)
                    echo    '<td><a target="_blank" href="http://'.$url.'">lien</a></td>';
                else
                    echo    '<td><a target="_blank" href="'.$url.'">lien</a></td>';
                echo    '<td><button postedBy="postedBy" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$idpostedBy.'">'.$postedBy.'</button></td>';
                echo   '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<button value="'.$codepro.'" title="valider" class="btn btn-fill btn-success">Valider</button>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codepro.'" title="supprimer" class="btn-fill btn btn-danger">Supprimer</button>';
                echo    '</div>';
                echo    '</div>';
                echo   '</td>';
                echo    '</tr>';
            }
            echo '</tbody></table></div>';
        }        
    }

    function afficher_ouvrage($db,$idequipe){
        $sql = "SELECT * FROM ouvrage WHERE codepro IN (
            SELECT codepro FROM validationproduction WHERE idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe ='".$idequipe."'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="content">
            <table class="table table-hover">
                <thead>
                    <th>Editeur</th>
                    <th>Nombres de pages</th>
                    <th>Domaine</th>
                    <th>Spécialités</th>
                    <th>Mots-clè</th>
                    <th>Auteur principal</th>
                    <th>Co-auteurs</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Projet</th>
                    <th>ISBN</th>
                    <th>URL</th>
                    <th>Posté par</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $sql = "SELECT * FROM validationproduction WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $idpostedBy = mysqli_fetch_array($result2)["idcher"];
                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idpostedBy."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $postedBy = mysqli_fetch_array($result2)["nom"];
                    }
                }
                /* ----------------------------------------------------------- */
                $idspe = $row["idspe"];
                $titre = $row["titre"];
                $isbn = $row['isbn'];
                $nbpages = $row["nbpages"];
                $editeur = $row["editeur"];
                $url = $row["url"];
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomDomaine = mysqli_fetch_array($result2)["nom"];
                }
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];
                }
                $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $motscles = array();
                    while($row = mysqli_fetch_array($result2)){
                        $motscles[] = $row["mot"];
                    }
                }
                $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $date = $row2["date"]; 
                    if(isset($row2['codeproj']))
                        $codeproj = $row2['codeproj'];
                }
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $auteurprinc = mysqli_fetch_array($result2)["nom"];
                }
                else{
                    $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $auteurprinc = mysqli_fetch_array($result2)["nom"];
                    }
                }
                $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $coauteurs = array();
                    while($row2 = mysqli_fetch_array($result2)){
                        if($row2["idcher"] == 0){
                            $coauteurs[] = $row2["nom"];
                        }
                        else{
                            $idcherco = $row2["idcher"];
                            $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                            $result3 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result3) > 0){
                                $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                            }
                        }
                    }
                }
                echo    '<tr>';
                echo    '<td>'.$editeur.'</td>';
                echo    '<td>'.$nbpages.'</td>';
                echo    '<td>'.$nomDomaine.'</td>';
                echo    '<td>'.$nomspe.'</td>'; 
                echo    '<td>';
                foreach ($motscles as $mot) {
                    echo $mot.' ';
                }   
                echo    '</td>';
                echo    '<td>'.$auteurprinc.'</td>';
                echo    '<td>';
                foreach ($coauteurs as $auteur) {
                    echo $auteur.' ';
                }
                echo    '</td>';
                echo    '<td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codepro.'">'.$titre.'</button></td>';
                echo    '<td>'.$date.'</td>';
                if(isset($codeproj))
                    echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">'.$codeproj.'</button></td>';
                    else    
                    echo '<td></td>';
                echo    '<td>'.$isbn.'</td>';
                if(strpos($url,'http') === false)
                    echo    '<td><a target="_blank" href="http://'.$url.'">lien</a></td>';
                else
                    echo    '<td><a target="_blank" href="'.$url.'">lien</a></td>';
                echo    '<td><button postedBy="postedBy" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$idpostedBy.'">'.$postedBy.'</button></td>';
                echo   '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<button value="'.$codepro.'" title="valider" class="btn btn-fill btn-success">Valider</button>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codepro.'" title="supprimer" class="btn-fill btn btn-danger">Supprimer</button>';
                echo    '</div>';
                echo    '</div>';
                echo   '</td>';
                echo    '</tr>';
            }
            echo '</tbody></table></div>';
        }
    }

    function afficher_communication($db,$idequipe){
        $sql = "SELECT * FROM communication WHERE codepro IN (
            SELECT codepro FROM validationproduction WHERE idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe ='".$idequipe."'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="content">
            <table class="table table-hover">
                <thead>
                    <th>Domaine</th>
                    <th>Spécialités</th>
                    <th>Mots-clè</th>
                    <th>Auteur principal</th>
                    <th>Co-auteurs</th>
                    <th>Abréviation</th>
                    <th>Année</th>
                    <th>Thème</th>
                    <th>Périodicité</th>
                    <th>Type</th>
                    <th>Classe</th>
                    <th>Pays</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Projet</th>
                    <th>Conférence</th>
                    <th>URL</th>
                    <th>Posté par</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $sql = "SELECT * FROM validationproduction WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $idpostedBy = mysqli_fetch_array($result2)["idcher"];
                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idpostedBy."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $postedBy = mysqli_fetch_array($result2)["nom"];
                    }
                }
                /* -------------------------------------------------------------- */
                $codeconf = $row["codeconf"];
                $titre = $row["titre"];
                $url = $row["url"];
                $idspe = $row["idspe"];
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomDomaine = mysqli_fetch_array($result2)["nom"];
                }
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];
                }
                $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $motscles = array();
                    while($row = mysqli_fetch_array($result2)){
                        $motscles[] = $row["mot"];
                    }
                }
                $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $date = $row2["date"]; 
                    if(isset($row2['codeproj']))
                        $codeproj = $row2['codeproj'];
                }
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $auteurprinc = mysqli_fetch_array($result2)["nom"];
                }
                else{
                    $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $auteurprinc = mysqli_fetch_array($result2)["nom"];
                    }
                }
                $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $coauteurs = array();
                    while($row2 = mysqli_fetch_array($result2)){
                        if($row2["idcher"] == 0){
                            $coauteurs[] = $row2["nom"];
                        }
                        else{
                            $idcherco = $row2["idcher"];
                            $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                            $result3 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result3) > 0){
                                $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                            }
                        }
                    }
                }
                /* ---------- PARTIE CONFERENCE ------------ */
                $sql = "SELECT * FROM conference WHERE codeconf='".$codeconf."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $nomconf = $row2["nomconf"];
                    $abrvconf = $row2["abrv"];
                    $annee = $row2["annee"];
                    $theme = $row2["theme"];
                    $periodicite = $row2["periodicite"];
                    $type = $row2["type"];
                    $classe = $row2["classe"];
                    $pays = $row2["pays"];
                }
                /* ------------- LE TABLEAU ---------------- */
                echo    '<tr>';
                echo    '<td>'.$nomDomaine.'</td>';
                echo    '<td>'.$nomspe.'</td>'; 
                echo    '<td>';
                foreach ($motscles as $mot) {
                    echo $mot.' ';
                }   
                echo    '</td>';
                echo    '<td>'.$auteurprinc.'</td>';
                echo    '<td>';
                foreach ($coauteurs as $auteur) {
                    echo $auteur.' ';
                }
                echo    '</td>';
                echo    '<td>'.$abrvconf.'</td>';
                echo    '<td>'.$annee.'</td>';
                echo    '<td>'.$theme.'</td>';
                echo    '<td>'.$periodicite.'</td>';
                echo    '<td>'.$type.'</td>';
                echo    '<td>'.$classe.'</td>';
                echo    '<td>'.$pays.'</td>';
                echo    '<td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codepro.'">'.$titre.'</button></td>';
                echo    '<td>'.$date.'</td>';
                if(isset($codeproj))
                    echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">'.$codeproj.'</button></td>';
                    else    
                    echo '<td></td>';
                echo    '<td><button codeconf="codeconf" class="btn btn-primary" style="border:0px;font-size:16px;"  value="'.$codeconf.'">'.$nomconf.'</button></td>';
                if(strpos($url,'http') === false)
                    echo    '<td><a target="_blank" href="http://'.$url.'">lien</a></td>';
                else
                    echo    '<td><a target="_blank" href="'.$url.'">lien</a></td>';
                echo    '<td><button postedBy="postedBy" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$idpostedBy.'">'.$postedBy.'</button></td>';
                echo   '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<button value="'.$codepro.'" title="valider" class="btn btn-fill btn-success">Valider</button>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codepro.'" title="supprimer" class="btn-fill btn btn-danger">Supprimer</button>';
                echo    '</div>';
                echo    '</div>';
                echo   '</td>';
                echo    '</tr>';
            }
            echo '</tbody></table></div>';
        }
    }

    if(isset($_GET["codeconf"]) && $_GET["codeconf"]){
        $codeconf = mysqli_real_escape_string($db,$_GET["codeconf"]);
        $sql = "SELECT * FROM conference WHERE codeconf='".$codeconf."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $nomconf = $row["nomconf"];
            $abrvconf = $row["abrv"];
            $annee = $row["annee"];
            $theme = $row["theme"];
            $periodicite = $row["periodicite"];
            $type = $row["type"];
            $classe = $row["classe"];
            $pays = $row["pays"];
            $idspe = $row["idspe"];
            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
            )";
            $result2 = mysqli_query($db,$sql);
            if(mysqli_num_rows($result2) > 0){
                $nomDomaine = mysqli_fetch_array($result2)["nom"];
            }
            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
            $result2 = mysqli_query($db,$sql);
            if(mysqli_num_rows($result2) > 0){
                $nomspe = mysqli_fetch_array($result2)["nomspe"];
            }
            echo '<span class="text-info">Nom: </span>'.$nomconf.'<br>';
            echo '<span class="text-info">Abréviation: </span>'.$abrvconf.'<br>';
            echo '<span class="text-info">Périodicité: </span>'.$periodicite.'<br>';
            echo '<span class="text-info">Année: </span>'.$annee.'<br>';
            echo '<span class="text-info">Thème: </span>'.$theme.'<br>';
            echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
            echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
            echo '<span class="text-info">Type: </span>'.$type.'<br>';
            if($type == "nationale"){
                echo '<span class="text-info">Pays: </span>'.$pays.'<br>';
            }
            else{
                if($classe == "AA") echo '<span class="text-info">Classe: </span>A*<br>';
                else echo '<span class="text-info">Classe: </span>'.$classe.'<br>';
            }
        }
        else{
            echo '<div class="text-danger">Informations indisponibles !</div>';
        }
    }

    function afficher_publication($db,$idequipe){
        $sql = "SELECT * FROM publication WHERE codepro IN (
            SELECT codepro FROM validationproduction WHERE idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe ='".$idequipe."'
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<div class="content">
            <table class="table table-hover">
                <thead>
                    <th>Doi</th>
                    <th>Volume</th>
                    <th>N ISSUE</th>
                    <th>Mots-clès</th>
                    <th>Auteur principal</th>
                    <th>Co-auteurs</th>
                    <th>Périodicité</th>
                    <th>E-ISSN</th>
                    <th>ISSN PRINT</th>
                    <th>Editeur</th>
                    <th>Année</th>
                    <th>Thème</th>
                    <th>Domaine</th>
                    <th>Spécialités</th>
                    <th>Type</th>
                    <th>Classe</th>
                    <th>Pays</th>
                    <th>Titre</th>
                    <th>Date</th>
                    <th>Projet</th>
                    <th>Revue</th>
                    <th>URL</th>
                    <th>Posté par</th>
                    <th>Action</th>
                </thead>
            <tbody>';
            while($row = mysqli_fetch_array($result)){
                $codepro = $row["codepro"];
                $sql = "SELECT * FROM validationproduction WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $idpostedBy = mysqli_fetch_array($result2)["idcher"];
                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idpostedBy."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $postedBy = mysqli_fetch_array($result2)["nom"];
                    }
                }
                /*----------------------------------------------------------------------*/
                $titre = $row["titre"];
                $doi = $row["doi"];
                $nvol = $row["nvol"];
                $nissue = $row["nissue"];
                $coderevue = $row["coderevue"];
                $url = $row["url"];
                $idspe = $row["idspe"];
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomDomaine = mysqli_fetch_array($result2)["nom"];
                }
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];
                }
                $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $date = $row2["date"]; 
                    if(isset($row2['codeproj']))
                        $codeproj = $row2['codeproj'];
                }
                $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $motscles = array();
                    while($row = mysqli_fetch_array($result2)){
                        $motscles[] = $row["mot"];
                    }
                }
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                )";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $auteurprinc = mysqli_fetch_array($result2)["nom"];
                }
                else{
                    $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                    $result2 = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result2) > 0){
                        $auteurprinc = mysqli_fetch_array($result2)["nom"];
                    }
                }
                $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $coauteurs = array();
                    while($row2 = mysqli_fetch_array($result2)){
                        if($row2["idcher"] == 0){
                            $coauteurs[] = $row2["nom"];
                        }
                        else{
                            $idcherco = $row2["idcher"];
                            $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                            $result3 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result3) > 0){
                                $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                            }
                        }
                    }
                }
                /* ---------- PARTIE REVUE ------------ */
                $sql = "SELECT * FROM revue WHERE coderevue='".$coderevue."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_array($result2);
                    $nomrevue = $row2["nom"];
                    $periodicite = $row2["periodicite"];
                    $issnonline = $row2["issnonline"];
                    $issnprint = $row2["issnprint"];
                    $editeur = $row2["editeur"];
                    $annee = $row2["annee"];
                    $theme = $row2["theme"];
                    $classe = $row2["classe"];
                    $type = $row2["type"];
                    $pays = $row2["pays"];
                }
                echo    '<tr>';
                echo    '<td>'.$doi.'</td>';
                echo    '<td>'.$nvol.'</td>';
                echo    '<td>'.$nissue.'</td>';
                echo    '<td>';
                foreach ($motscles as $mot) {
                    echo $mot.' ';
                }   
                echo    '</td>';
                echo    '<td>'.$auteurprinc.'</td>';
                echo    '<td>';
                foreach ($coauteurs as $auteur) {
                    echo $auteur.' ';
                }
                echo    '</td>';
                echo    '<td>'.$periodicite.'</td>';
                echo    '<td>'.$issnonline.'</td>';
                echo    '<td>'.$issnprint.'</td>';
                echo    '<td>'.$editeur.'</td>';
                echo    '<td>'.$annee.'</td>';
                echo    '<td>'.$theme.'</td>';
                echo    '<td>'.$nomDomaine.'</td>';
                echo    '<td>'.$nomspe.'</td>';
                echo    '<td>'.$type.'</td>';
                echo    '<td>'.$classe.'</td>';
                echo    '<td>'.$pays.'</td>';
                echo    '<td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codepro.'">'.$titre.'</button></td>';
                echo    '<td>'.$date.'</td>';
                if(isset($codeproj))
                    echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">'.$codeproj.'</button></td>';
                    else    
                    echo '<td></td>';
                echo    '<td><button coderevue="coderevue" class="btn btn-primary" style="border:0px;font-size:16px;"  value="'.$coderevue.'">'.$nomrevue.'</button></td>';
                if(strpos($url,'http') === false)
                    echo    '<td><a target="_blank" href="http://'.$url.'">lien</a></td>';
                else
                    echo    '<td><a target="_blank" href="'.$url.'">lien</a></td>';
                echo    '<td><button postedBy="postedBy" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$idpostedBy.'">'.$postedBy.'</button></td>';
                echo   '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<button value="'.$codepro.'" title="valider" class="btn btn-fill btn-success">Valider</button>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codepro.'" title="supprimer" class="btn-fill btn btn-danger">Supprimer</button>';
                echo    '</div>';
                echo    '</div>';
                echo   '</td>';
                echo    '</tr>';
            }
            echo '</tbody>
            </table>
            </div>';
        }
    }

    if(isset($_GET["coderevue"]) && $_GET["coderevue"] != ""){
        $coderevue = mysqli_real_escape_string($db,$_GET["coderevue"]);
        $sql = "SELECT * FROM revue WHERE coderevue='".$coderevue."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $nomrevue = $row["nom"];
            $periodicite = $row["periodicite"];
            $issnonline = $row["issnonline"];
            $issnprint = $row["issnprint"];
            $editeur = $row["editeur"];
            $annee = $row["annee"];
            $theme = $row["theme"];
            $classe = $row["classe"];
            $type = $row["type"];
            $pays = $row["pays"];
            $idspe = $row["idspe"];
            $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                $nomDomaine = mysqli_fetch_array($result)["nom"];
            }
            $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                $nomspe = mysqli_fetch_array($result)["nomspe"];
            }
            echo '<span class="text-info">Nom: </span>'.$nomrevue.'<br>';
            echo '<span class="text-info">Périodicité: </span>'.$periodicite.'<br>';
            echo '<span class="text-info">E-ISSN: </span>'.$issnonline.'<br>';
            echo '<span class="text-info">ISSN PRINT: </span>'.$issnprint.'<br>';
            echo '<span class="text-info">editeur: </span>'.$editeur.'<br>';
            echo '<span class="text-info">Année: </span>'.$annee.'<br>';
            echo '<span class="text-info">Thème: </span>'.$theme.'<br>';
            echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
            echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
            echo '<span class="text-info">Type: </span>'.$type.'<br>';
            if($type == "nationale"){
                echo '<span class="text-info">Pays: </span>'.$pays.'<br>';
            }
            else{
                if($classe == "AA") echo '<span class="text-info">Classe: </span>A*<br>';
                else echo '<span class="text-info">Classe: </span>'.$classe.'<br>';
            }
        }
        else{
            echo '<div class="text-danger">Informations indisponibles !</div>';
        }
    }

    if(isset($_GET["codepro"]) && $_GET["codepro"] != ""){
        $codepro = mysqli_real_escape_string($db,$_GET["codepro"]);
        $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $date = $row["date"];
            $typeProduction = $row["type"];
            switch ($typeProduction) {
                case 'publication':
                    $sql = "SELECT * FROM publication WHERE codepro='".$codepro."'";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        $titre = $row["titre"];
                        $doi = $row["doi"];
                        $nvol = $row["nvol"];
                        $nissue = $row["nissue"];
                        $idspe = $row["idspe"];
                        $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                            SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomDomaine = mysqli_fetch_array($result2)["nom"];
                        }
                        $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomspe = mysqli_fetch_array($result2)["nomspe"];
                        }
                        echo '<span class="text-info">Titre: </span>'.$titre.'<br>';
                        echo '<span class="text-info">Date: </span>'.$date.'<br>';
                        echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
                        echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
                        echo '<span class="text-info">DOI: </span>'.$doi.'<br>';
                        echo '<span class="text-info">Volume: </span>'.$nvol.'<br>';
                        echo '<span class="text-info">N° ISSUE: </span>'.$nissue.'<br>';
                        echo '<span class="text-info">Mots-clés: </span>';
                        $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_array($result2)){
                                $mot = $row["mot"];
                                echo $mot.', ';
                            }
                        }
                        echo '<br>';
                        $sql = "SELECT * FROM chercheur WHERE idcher IN (
                            SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                        }
                        else{
                            $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            }
                        }
                        echo '<span class="text-info">Auteur principal: </span>'.$auteurprinc.'<br>';
                        $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $coauteurs = array();
                            while($row2 = mysqli_fetch_array($result2)){
                                if($row2["idcher"] == 0){
                                    $coauteurs[] = $row2["nom"];
                                }
                                else{
                                    $idcherco = $row2["idcher"];
                                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                    $result3 = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result3) > 0){
                                        $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                                    }
                                }
                            }
                        }
                        echo '<span class="text-info">Co-auteurs: </span>';
                        foreach ($coauteurs as $auteur) {
                            echo $auteur.', ';
                        }
                        echo '<br>';
                    }
                    else{
                        echo '<div class="text-danger">Informations indisponibles !</div>';
                    }
                break;

                case 'communication':
                    $sql = "SELECT * FROM communication WHERE codepro='".$codepro."'";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        $titre = $row["titre"];
                        $idspe = $row["idspe"];
                        $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                            SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomDomaine = mysqli_fetch_array($result2)["nom"];
                        }
                        $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomspe = mysqli_fetch_array($result2)["nomspe"];
                        }
                        echo '<span class="text-info">Titre: </span>'.$titre.'<br>';
                        echo '<span class="text-info">Date: </span>'.$date.'<br>';
                        echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
                        echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
                        echo '<span class="text-info">Mots-clés: </span>';
                        $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_array($result2)){
                                $mot = $row["mot"];
                                echo $mot.', ';
                            }
                        }
                        echo '<br>';
                        $sql = "SELECT * FROM chercheur WHERE idcher IN (
                            SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                        }
                        else{
                            $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            }
                        }
                        echo '<span class="text-info">Auteur principal: </span>'.$auteurprinc.'<br>';
                        $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $coauteurs = array();
                            while($row2 = mysqli_fetch_array($result2)){
                                if($row2["idcher"] == 0){
                                    $coauteurs[] = $row2["nom"];
                                }
                                else{
                                    $idcherco = $row2["idcher"];
                                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                    $result3 = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result3) > 0){
                                        $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                                    }
                                }
                            }
                        }
                        echo '<span class="text-info">Co-auteurs: </span>';
                        foreach ($coauteurs as $auteur) {
                            echo $auteur.', ';
                        }
                        echo '<br>';
                    }
                    else{
                        echo '<div class="text-danger">Informations indisponibles !</div>';
                    }
                break;

                case 'ouvrage':
                    $sql = "SELECT * FROM ouvrage WHERE codepro='".$codepro."'";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        $idspe = $row["idspe"];
                        $titre = $row["titre"];
                        $isbn = $row['isbn'];
                        $nbpages = $row["nbpages"];
                        $editeur = $row["editeur"];
                        $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                            SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomDomaine = mysqli_fetch_array($result2)["nom"];
                        }
                        $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomspe = mysqli_fetch_array($result2)["nomspe"];
                        }
                        $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $date = mysqli_fetch_array($result2)["date"]; 
                        }
                        echo '<span class="text-info">Titre: </span>'.$titre.'<br>';
                        echo '<span class="text-info">Date: </span>'.$date.'<br>';
                        echo '<span class="text-info">ISBN: </span>'.$isbn.'<br>';
                        echo '<span class="text-info">Editeur: </span>'.$editeur.'<br>';
                        echo '<span class="text-info">Nombre de pages: </span>'.$nbpages.'<br>';
                        echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
                        echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
                        /*-------------------------------------------*/
                        echo '<span class="text-info">Mots-clés: </span>';
                        $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_array($result2)){
                                $mot = $row["mot"];
                                echo $mot.', ';
                            }
                        }
                        echo '<br>';
                        $sql = "SELECT * FROM chercheur WHERE idcher IN (
                            SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                        }
                        else{
                            $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            }
                        }
                        echo '<span class="text-info">Auteur principal: </span>'.$auteurprinc.'<br>';
                        $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $coauteurs = array();
                            while($row2 = mysqli_fetch_array($result2)){
                                if($row2["idcher"] == 0){
                                    $coauteurs[] = $row2["nom"];
                                }
                                else{
                                    $idcherco = $row2["idcher"];
                                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                    $result3 = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result3) > 0){
                                        $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                                    }
                                }
                            }
                        }
                        echo '<span class="text-info">Co-auteurs: </span>';
                        foreach ($coauteurs as $auteur) {
                            echo $auteur.', ';
                        }
                        echo '<br>';
                    }
                    else{
                        echo '<div class="text-danger">Informations indisponibles !</div>';
                    }
                break;

                case 'chapitreOuvrage':
                    $sql = "SELECT * FROM chapitredouvrage WHERE codepro='".$codepro."'";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        $idspe = $row["idspe"];
                        $titre = $row["titre"];
                        $isbn = $row["isbn"];
                        $pages = $row["pages"];
                        $volume = $row["volume"];
                        $editeur = $row["editeur"];
                        $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                            SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomDomaine = mysqli_fetch_array($result2)["nom"];
                        }
                        $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomspe = mysqli_fetch_array($result2)["nomspe"];
                        }
                        $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $date = mysqli_fetch_array($result2)["date"]; 
                        }
                        echo '<span class="text-info">Titre: </span>'.$titre.'<br>';
                        echo '<span class="text-info">Date: </span>'.$date.'<br>';
                        echo '<span class="text-info">ISBN: </span>'.$isbn.'<br>';
                        echo '<span class="text-info">Editeur: </span>'.$editeur.'<br>';
                        echo '<span class="text-info">Volume: </span>'.$volume.'<br>';
                        echo '<span class="text-info">N° de pages: </span>'.$pages.'<br>';
                        echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
                        echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
                        /*-------------------------------------------*/
                        echo '<span class="text-info">Mots-clés: </span>';
                        $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_array($result2)){
                                $mot = $row["mot"];
                                echo $mot.', ';
                            }
                        }
                        echo '<br>';
                        $sql = "SELECT * FROM chercheur WHERE idcher IN (
                            SELECT idcher FROM auteurprinc WHERE codepro='".$codepro."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $auteurprinc = mysqli_fetch_array($result2)["nom"];
                        }
                        else{
                            $sql = "SELECT * FROM auteurprinc WHERE codepro='".$codepro."'";
                            $result2 = mysqli_query($db,$sql);
                            if(mysqli_num_rows($result2) > 0){
                                $auteurprinc = mysqli_fetch_array($result2)["nom"];
                            }
                        }
                        echo '<span class="text-info">Auteur principal: </span>'.$auteurprinc.'<br>';
                        $sql = "SELECT * FROM coauteurs WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $coauteurs = array();
                            while($row2 = mysqli_fetch_array($result2)){
                                if($row2["idcher"] == 0){
                                    $coauteurs[] = $row2["nom"];
                                }
                                else{
                                    $idcherco = $row2["idcher"];
                                    $sql = "SELECT * FROM chercheur WHERE idcher='".$idcherco."'";
                                    $result3 = mysqli_query($db,$sql);
                                    if(mysqli_num_rows($result3) > 0){
                                        $coauteurs[] = mysqli_fetch_array($result3)["nom"];
                                    }
                                }
                            }
                        }
                        echo '<span class="text-info">Co-auteurs: </span>';
                        foreach ($coauteurs as $auteur) {
                            echo $auteur.', ';
                        }
                        echo '<br>';
                    }
                    else{
                        echo '<div class="text-danger">Informations indisponibles !</div>';
                    }
                break;
                
                case 'doctorat':
                    $sql = "SELECT * FROM these WHERE codepro='".$codepro."'";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        $titre = $row["titre"];
                        $lieusout = $row["lieusout"];
                        $nordre = $row["nordre"];
                        $encadreur = $row["encadreur"];
                        $sql = "SELECT * FROM chercheur WHERE idcher='".$encadreur."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $encadreur = mysqli_fetch_array($result2)["nom"]; 
                        }
                        $idspe = $row["idspe"];
                        $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                            SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomDomaine = mysqli_fetch_array($result2)["nom"];
                        }
                        $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomspe = mysqli_fetch_array($result2)["nomspe"];
                        }
                        $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $date = mysqli_fetch_array($result2)["date"]; 
                        }
                        echo '<span class="text-info">Titre: </span>'.$titre.'<br>';
                        echo '<span class="text-info">Date de soutenance: </span>'.$date.'<br>';
                        echo '<span class="text-info">N° d\'ordre: </span>'.$nordre.'<br>';
                        echo '<span class="text-info">Lieu: </span>'.$lieusout.'<br>';
                        echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
                        echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
                        /*-------------------------------------------*/
                        echo '<span class="text-info">Mots-clés: </span>';
                        $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_array($result2)){
                                $mot = $row["mot"];
                                echo $mot.', ';
                            }
                        }
                        echo '<br>';
                        echo '<span class="text-info">Encadreur: </span>'.$encadreur.'<br>';
                    }
                    else{
                        echo '<div class="text-danger">Informations indisponibles !</div>';
                    }
                break;

                case 'master':
                    $sql = "SELECT * FROM pfemaster WHERE codepro='".$codepro."'";
                    $result = mysqli_query($db,$sql);
                    if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_array($result);
                        $titre = $row["titre"];
                        $nproj = $row["nproj"];
                        $lieusout = $row["lieusout"];
                        $encadreur = $row["encadreur"];
                        $sql = "SELECT * FROM chercheur WHERE idcher='".$encadreur."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $encadreur = mysqli_fetch_array($result2)["nom"]; 
                        }
                        $idspe = $row["idspe"];
                        $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                            SELECT codeDomaine FROM specialite WHERE idspe='".$idspe."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomDomaine = mysqli_fetch_array($result2)["nom"];
                        }
                        $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $nomspe = mysqli_fetch_array($result2)["nomspe"];
                        }
                        $sql = "SELECT * FROM production WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            $date = mysqli_fetch_array($result2)["date"]; 
                        }
                        echo '<span class="text-info">Titre: </span>'.$titre.'<br>';
                        echo '<span class="text-info">N° Projet: </span>'.$nproj.'<br>';
                        echo '<span class="text-info">Date de soutenance: </span>'.$date.'<br>';
                        echo '<span class="text-info">Lieu: </span>'.$lieusout.'<br>';
                        echo '<span class="text-info">Domaine: </span>'.$nomDomaine.'<br>';
                        echo '<span class="text-info">Spécialités: </span>'.$nomspe.'<br>';
                        /*-------------------------------------------*/
                        echo '<span class="text-info">Mots-clés: </span>';
                        $sql = "SELECT * FROM motscle WHERE codepro='".$codepro."'";
                        $result2 = mysqli_query($db,$sql);
                        if(mysqli_num_rows($result2) > 0){
                            while($row = mysqli_fetch_array($result2)){
                                $mot = $row["mot"];
                                echo $mot.', ';
                            }
                        }
                        echo '<br>';
                        echo '<span class="text-info">Encadreur: </span>'.$encadreur.'<br>';
                    }
                    else{
                        echo '<div class="text-danger">Informations indisponibles !</div>';
                    }
                break;

                default:
                    # code...
                    break;
            }
        }
        else{
            echo '<div class="text-danger">Informations indisponibles !</div>';
        } 
    }

    if(isset($_GET["idcher"]) && $_GET["idcher"] != ""){
        $idcher = mysqli_real_escape_string($db,$_GET["idcher"]);
        $sql = "SELECT * FROM chercheur WHERE idcher='".$idcher."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $nom = $row["nom"];
            $mail = $row["mail"];
            $grade = $row["grade"];
            $gradeC = $row["gradeC"];
            $profil = $row["profil"];
            $sql = "SELECT * FROM equipe WHERE idequipe IN (
                SELECT idequipe FROM menbrequip WHERE idcher='".$idcher."'
            ) OR idequipe IN (
                SELECT idequipe FROM chefequip WHERE idcher='".$idcher."'
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0) $nomequip = mysqli_fetch_array($result)["nomequip"];
            echo '<span class="text-info">Nom: </span>'.$nom.'<br>';
            echo '<span class="text-info">Mail: </span>'.$mail.'<br>';
            echo '<span class="text-info">Profil: </span>'.$profil.'<br>';
            echo '<span class="text-info">Grade: </span>'.$grade.'<br>';
            echo '<span class="text-info">Grade C: </span>'.$gradeC.'<br>';
            echo '<span class="text-info">Equipe: </span>'.$nomequip.'<br>';
        }
        else{
            echo '<div class="text-danger">Informations indisponibles !</div>';
        }
    }

    if(isset($_GET["supprimer"])){
        $codepro = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "DELETE FROM production WHERE codepro='".$codepro."'";
        if(mysqli_query($db,$sql)) echo "true";
    }

    if(isset($_GET["valider"])){
        $codepro = mysqli_real_escape_string($db,$_GET["valider"]);
        $sql = "DELETE FROM validationproduction WHERE codepro='".$codepro."'";
        if(mysqli_query($db,$sql)) echo "true";
    }
?>