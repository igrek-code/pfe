<?php
    function ajouter_publication($db){
        if(isset($_POST["coderevue"]) && $_POST["coderevue"] == "autre"){
            $nomrevue = mysqli_real_escape_string($db,$_POST["nomrevue"]);
            $issnonline = mysqli_real_escape_string($db,$_POST["issnonline"]);
            $issnprint = mysqli_real_escape_string($db,$_POST["issnprint"]);
            $editeur = mysqli_real_escape_string($db,$_POST["editeur"]);
            $theme = mysqli_real_escape_string($db,$_POST["theme"]);
            $codeDomaineRevue = mysqli_real_escape_string($db,$_POST["codeDomaineRevue"]);
            $idspeRevue = mysqli_real_escape_string($db,$_POST["idspeRevue"]);
            $anneeRevue = mysqli_real_escape_string($db,$_POST["anneeRevue"]);
            $periodiciteRevue = mysqli_real_escape_string($db,$_POST["periodiciteRevue"]);
            $typeRevue = mysqli_real_escape_string($db,$_POST["typeRevue"]);
            if($typeRevue == "nationale"){
                $paysRevue = mysqli_real_escape_string($db,$_POST["paysRevue"]);
                $classeRevue = "";
            }
            else{
                $classeRevue = mysqli_real_escape_string($db,$_POST["classeRevue"]);
                $paysRevue = "";
            }
            $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineRevue."')";
            if(!mysqli_query($db,$sql)) return true;
            $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
            if(!($result = mysqli_query($db,$sql))) return true;
            $codeDomaineRevue = mysqli_fetch_array($result)["codeDomaine"];
            $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeRevue."','".$codeDomaineRevue."')";
            if(!mysqli_query($db,$sql)) return true;
            $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
            if(!($result = mysqli_query($db,$sql))) return true;
            $idspeRevue = mysqli_fetch_array($result)["idspe"];
            $sql = "INSERT INTO revue (nom,periodicite,issnonline,issnprint,editeur,annee,theme,idspe,classe,type,pays) VALUES ('".$nomrevue."','".$periodiciteRevue."','".$issnonline."','".$issnprint."','".$editeur."','".$anneeRevue."','".$theme."','".$idspeRevue."','".$classeRevue."','".$typeRevue."','".$paysRevue."')";
            if(!mysqli_query($db,$sql)) return true;
            $sql = "SELECT * FROM revue ORDER BY coderevue DESC";
            if(!($result = mysqli_query($db,$sql))) return true;
            $coderevue = mysqli_fetch_array($result)["coderevue"];
        }else{
            if(isset($_POST["coderevue"]) && $_POST["coderevue"] != ""){
                $coderevue = mysqli_real_escape_string($db,$_POST["coderevue"]);
            }
        }

        $titreProduction = mysqli_real_escape_string($db,$_POST["titreProduction"]);
        $doiProduction = mysqli_real_escape_string($db,$_POST["doiProduction"]);
        $urlProduction = mysqli_real_escape_string($db,$_POST["urlProduction"]);
        $nissueProduction = mysqli_real_escape_string($db,$_POST["nissueProduction"]);
        $nvolProduction = mysqli_real_escape_string($db,$_POST["nvolProduction"]);
        $codeDomaineProduction = mysqli_real_escape_string($db,$_POST["codeDomaineProduction"]);
        $idspeProduction = mysqli_real_escape_string($db,$_POST["idspeProduction"]);
        $motsclesProduction = explode(',',$_POST["motsclesProduction"]);
        $dateProduction = mysqli_real_escape_string($db,$_POST["dateProduction"]);
        $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codeDomaineProduction = mysqli_fetch_array($result)["codeDomaine"];
        $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeProduction."','".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $idspeProduction = mysqli_fetch_array($result)["idspe"];
        $sql = "INSERT INTO production (date,type) VALUES ('".$dateProduction."','publication')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM production ORDER BY codepro DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codepro = mysqli_fetch_array($result)["codepro"];
        $sql = "INSERT INTO publication (codepro,titre,coderevue,doi,nvol,nissue,url,idspe) VALUES ('".$codepro."','".$titreProduction."','".$coderevue."','".$doiProduction."','".$nvolProduction."','".$nissueProduction."','".$urlProduction."','".$idspeProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        for ($i=0; $i < count($motsclesProduction); $i++) { 
            $motcle = mysqli_real_escape_string($db,$motsclesProduction[$i]);
            $sql = "INSERT INTO motscle (codepro,mot) VALUES ('".$codepro."','".$motcle."')";
            if(!mysqli_query($db,$sql)) return true;
        }
        if($_POST["auteurprincSelect"] == "autre"){
            $auteurprinc =  mysqli_real_escape_string($db,$_POST["auteurprincInput"]);
            $sql = "INSERT INTO auteurprinc (nom,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        } 
        else {
            $auteurprinc = mysqli_real_escape_string($db,$_POST["auteurprincSelect"]);
            $sql = "INSERT INTO auteurprinc (idcher,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        }
        if(!mysqli_query($db,$sql)) return true;
        $j=0;
        for ($i=0; $i < count($_POST["auteurSelect"]); $i++) { 
            if($_POST["auteurSelect"][$i] == "autre"){
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurInput"][$j]);
                $j++;
                $sql = "INSERT INTO coauteurs (nom,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            else{
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurSelect"][$i]);
                $sql = "INSERT INTO coauteurs (idcher,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            if(!mysqli_query($db,$sql)) return true;
        }
        return false;
    }

    function ajouter_communication($db){
        if(isset($_POST["codeconf"]) && $_POST["codeconf"] == "autre"){
            $nomconf = mysqli_real_escape_string($db,$_POST["nomconf"]);
            $abrvConf = mysqli_real_escape_string($db,$_POST["abrvConf"]);
            $themeConf = mysqli_real_escape_string($db,$_POST["themeConf"]);
            $codeDomaineConf = mysqli_real_escape_string($db,$_POST["codeDomaineConf"]);
            $idspeConf = mysqli_real_escape_string($db,$_POST["idspeConf"]);
            $anneeConf = mysqli_real_escape_string($db,$_POST["anneeConf"]);
            $periodiciteConf = mysqli_real_escape_string($db,$_POST["periodiciteConf"]);
            $typeConf = mysqli_real_escape_string($db,$_POST["typeConf"]);
            if($typeConf == "nationale"){
                $paysConf = mysqli_real_escape_string($db,$_POST["paysConf"]);
                $classeConf = "";
            }
            else{
                $classeConf = mysqli_real_escape_string($db,$_POST["classeConf"]);
                $paysConf = "";
            }
            $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineConf."')";
            if(!mysqli_query($db,$sql)) return true;
            $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
            if(!($result = mysqli_query($db,$sql))) return true;
            $codeDomaineConf = mysqli_fetch_array($result)["codeDomaine"];
            $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeConf."','".$codeDomaineConf."')";
            if(!mysqli_query($db,$sql)) return true;
            $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
            if(!($result = mysqli_query($db,$sql))) return true;
            $idspeConf = mysqli_fetch_array($result)["idspe"];
            $sql = "INSERT INTO conference (nomconf,periodicite,abrv,annee,theme,idspe,classe,type,pays) VALUES ('".$nomconf."','".$periodiciteConf."','".$abrvConf."','".$anneeConf."','".$themeConf."','".$idspeConf."','".$classeConf."','".$typeConf."','".$paysConf."')";
            if(!mysqli_query($db,$sql)) return true;
            $sql = "SELECT * FROM conference ORDER BY codeconf DESC";
            if(!($result = mysqli_query($db,$sql))) return true;
            $codeconf = mysqli_fetch_array($result)["codeconf"];
        }else{
            if(isset($_POST["codeconf"]) && $_POST["codeconf"] != ""){
                $codeconf = mysqli_real_escape_string($db,$_POST["codeconf"]);
            }
        }

        $titreProduction = mysqli_real_escape_string($db,$_POST["titreProduction"]);
        $urlProduction = mysqli_real_escape_string($db,$_POST["urlProduction"]);
        $codeDomaineProduction = mysqli_real_escape_string($db,$_POST["codeDomaineProduction"]);
        $idspeProduction = mysqli_real_escape_string($db,$_POST["idspeProduction"]);
        $motsclesProduction = explode(',',$_POST["motsclesProduction"]);
        $dateProduction = mysqli_real_escape_string($db,$_POST["dateProduction"]);
        $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codeDomaineProduction = mysqli_fetch_array($result)["codeDomaine"];
        $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeProduction."','".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $idspeProduction = mysqli_fetch_array($result)["idspe"];
        $sql = "INSERT INTO production (date,type) VALUES ('".$dateProduction."','communication')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM production ORDER BY codepro DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codepro = mysqli_fetch_array($result)["codepro"];
        $sql = "INSERT INTO communication (codepro,titre,codeconf,url,idspe) VALUES ('".$codepro."','".$titreProduction."','".$codeconf."','".$urlProduction."','".$idspe."')";
        if(!mysqli_query($db,$sql)) return true;
        for ($i=0; $i < count($motsclesProduction); $i++) { 
            $motcle = mysqli_real_escape_string($db,$motsclesProduction[$i]);
            $sql = "INSERT INTO motscle (codepro,mot) VALUES ('".$codepro."','".$motcle."')";
            if(!mysqli_query($db,$sql)) return true;
        }
        if($_POST["auteurprincSelect"] == "autre"){
            $auteurprinc =  mysqli_real_escape_string($db,$_POST["auteurprincInput"]);
            $sql = "INSERT INTO auteurprinc (nom,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        } 
        else {
            $auteurprinc = mysqli_real_escape_string($db,$_POST["auteurprincSelect"]);
            $sql = "INSERT INTO auteurprinc (idcher,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        }
        if(!mysqli_query($db,$sql)) return true;
        $j=0;
        for ($i=0; $i < count($_POST["auteurSelect"]); $i++) { 
            if($_POST["auteurSelect"][$i] == "autre"){
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurInput"][$j]);
                $j++;
                $sql = "INSERT INTO coauteurs (nom,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            else{
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurSelect"][$i]);
                $sql = "INSERT INTO coauteurs (idcher,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            if(!mysqli_query($db,$sql)) return true;
        }
        return false;
    }

    function ajouter_ouvrage($db){
        $titreProduction = mysqli_real_escape_string($db,$_POST["titreProduction"]);
        $editeurProduction = mysqli_real_escape_string($db,$_POST["editeurProduction"]);
        $urlProduction = mysqli_real_escape_string($db,$_POST["urlProduction"]);
        $nbrePagesProduction = mysqli_real_escape_string($db,$_POST["nbrePagesProduction"]);
        $codeDomaineProduction = mysqli_real_escape_string($db,$_POST["codeDomaineProduction"]);
        $idspeProduction = mysqli_real_escape_string($db,$_POST["idspeProduction"]);
        $motsclesProduction = explode(',',$_POST["motsclesProduction"]);
        $dateProduction = mysqli_real_escape_string($db,$_POST["dateProduction"]);
        $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codeDomaineProduction = mysqli_fetch_array($result)["codeDomaine"];
        $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeProduction."','".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $idspeProduction = mysqli_fetch_array($result)["idspe"];
        $sql = "INSERT INTO production (date,type) VALUES ('".$dateProduction."','ouvrage')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM production ORDER BY codepro DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codepro = mysqli_fetch_array($result)["codepro"];
        $sql = "INSERT INTO ouvrage (codepro,titre,nbpages,editeur,url,idspe) VALUES ('".$codepro."','".$titreProduction."','".$nbrePagesProduction."','".$editeurProduction."','".$urlProduction."','".$idspeProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        for ($i=0; $i < count($motsclesProduction); $i++) { 
            $motcle = mysqli_real_escape_string($db,$motsclesProduction[$i]);
            $sql = "INSERT INTO motscle (codepro,mot) VALUES ('".$codepro."','".$motcle."')";
            if(!mysqli_query($db,$sql)) return true;
        }
        if($_POST["auteurprincSelect"] == "autre"){
            $auteurprinc =  mysqli_real_escape_string($db,$_POST["auteurprincInput"]);
            $sql = "INSERT INTO auteurprinc (nom,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        } 
        else {
            $auteurprinc = mysqli_real_escape_string($db,$_POST["auteurprincSelect"]);
            $sql = "INSERT INTO auteurprinc (idcher,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        }
        if(!mysqli_query($db,$sql)) return true;
        $j=0;
        for ($i=0; $i < count($_POST["auteurSelect"]); $i++) { 
            if($_POST["auteurSelect"][$i] == "autre"){
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurInput"][$j]);
                $j++;
                $sql = "INSERT INTO coauteurs (nom,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            else{
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurSelect"][$i]);
                $sql = "INSERT INTO coauteurs (idcher,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            if(!mysqli_query($db,$sql)) return true;
        }
        return false;
    }

    function ajouter_chapitreOuvrage($db){
        $titreProduction = mysqli_real_escape_string($db,$_POST["titreProduction"]);
        $editeurProduction = mysqli_real_escape_string($db,$_POST["editeurProduction"]);
        $urlProduction = mysqli_real_escape_string($db,$_POST["urlProduction"]);
        $pagesProduction = mysqli_real_escape_string($db,$_POST["pagesProduction"]);
        $volumeProduction = mysqli_real_escape_string($db,$_POST["volumeProduction"]);
        $codeDomaineProduction = mysqli_real_escape_string($db,$_POST["codeDomaineProduction"]);
        $idspeProduction = mysqli_real_escape_string($db,$_POST["idspeProduction"]);
        $motsclesProduction = explode(',',$_POST["motsclesProduction"]);
        $dateProduction = mysqli_real_escape_string($db,$_POST["dateProduction"]);
        $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codeDomaineProduction = mysqli_fetch_array($result)["codeDomaine"];
        $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeProduction."','".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $idspeProduction = mysqli_fetch_array($result)["idspe"];
        $sql = "INSERT INTO production (date,type) VALUES ('".$dateProduction."','chapitreOuvrage')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM production ORDER BY codepro DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codepro = mysqli_fetch_array($result)["codepro"];
        $sql = "INSERT INTO chapitredouvrage (codepro,titre,editeur,volume,url,idspe,pages) VALUES ('".$codepro."','".$titreProduction."','".$editeurProduction."','".$volumeProduction."','".$urlProduction."','".$idspeProduction."','".$pagesProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        for ($i=0; $i < count($motsclesProduction); $i++) { 
            $motcle = mysqli_real_escape_string($db,$motsclesProduction[$i]);
            $sql = "INSERT INTO motscle (codepro,mot) VALUES ('".$codepro."','".$motcle."')";
            if(!mysqli_query($db,$sql)) return true;
        }
        if($_POST["auteurprincSelect"] == "autre"){
            $auteurprinc =  mysqli_real_escape_string($db,$_POST["auteurprincInput"]);
            $sql = "INSERT INTO auteurprinc (nom,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        } 
        else {
            $auteurprinc = mysqli_real_escape_string($db,$_POST["auteurprincSelect"]);
            $sql = "INSERT INTO auteurprinc (idcher,codepro) VALUES ('".$auteurprinc."','".$codepro."')";
        }
        if(!mysqli_query($db,$sql)) return true;
        $j=0;
        for ($i=0; $i < count($_POST["auteurSelect"]); $i++) { 
            if($_POST["auteurSelect"][$i] == "autre"){
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurInput"][$j]);
                $j++;
                $sql = "INSERT INTO coauteurs (nom,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            else{
                $coauteur = mysqli_real_escape_string($db,$_POST["auteurSelect"][$i]);
                $sql = "INSERT INTO coauteurs (idcher,codepro) VALUES ('".$coauteur."','".$codepro."')";
            }
            if(!mysqli_query($db,$sql)) return true;
        }
        return false;
    }

    function ajouter_doctorat($db){
        $titreProduction = mysqli_real_escape_string($db,$_POST["titreProduction"]);
        $encadreurProduction = mysqli_real_escape_string($db,$_POST["encadreurProduction"]);
        $nordreProduction = mysqli_real_escape_string($db,$_POST["nordreProduction"]);
        $lieusoutProduction = mysqli_real_escape_string($db,$_POST["lieusoutProduction"]);
        $urlProduction = mysqli_real_escape_string($db,$_POST["urlProduction"]);
        $codeDomaineProduction = mysqli_real_escape_string($db,$_POST["codeDomaineProduction"]);
        $idspeProduction = mysqli_real_escape_string($db,$_POST["idspeProduction"]);
        $motsclesProduction = explode(',',$_POST["motsclesProduction"]);
        $dateProduction = mysqli_real_escape_string($db,$_POST["dateProduction"]);
        $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codeDomaineProduction = mysqli_fetch_array($result)["codeDomaine"];
        $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeProduction."','".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $idspeProduction = mysqli_fetch_array($result)["idspe"];
        $sql = "INSERT INTO production (date,type) VALUES ('".$dateProduction."','doctorat')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM production ORDER BY codepro DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codepro = mysqli_fetch_array($result)["codepro"];
        $sql = "INSERT INTO these (codepro,titre,encadreur,lieusout,nordre,url,idspe) VALUES ('".$codepro."','".$titreProduction."','".$encadreurProduction."','".$lieusoutProduction."','".$nordreProduction."','".$urlProduction."','".$idspeProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        for ($i=0; $i < count($motsclesProduction); $i++) { 
            $motcle = mysqli_real_escape_string($db,$motsclesProduction[$i]);
            $sql = "INSERT INTO motscle (codepro,mot) VALUES ('".$codepro."','".$motcle."')";
            if(!mysqli_query($db,$sql)) return true;
        }
        return false;
    }

    function ajouter_master($db){
        $titreProduction = mysqli_real_escape_string($db,$_POST["titreProduction"]);
        $encadreurProduction = mysqli_real_escape_string($db,$_POST["encadreurProduction"]);
        $lieusoutProduction = mysqli_real_escape_string($db,$_POST["lieusoutProduction"]);
        $codeDomaineProduction = mysqli_real_escape_string($db,$_POST["codeDomaineProduction"]);
        $idspeProduction = mysqli_real_escape_string($db,$_POST["idspeProduction"]);
        $motsclesProduction = explode(',',$_POST["motsclesProduction"]);
        $dateProduction = mysqli_real_escape_string($db,$_POST["dateProduction"]);
        $sql = "INSERT INTO domaine (nom) VALUES ('".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM domaine ORDER BY codeDomaine DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codeDomaineProduction = mysqli_fetch_array($result)["codeDomaine"];
        $sql = "INSERT INTO specialite (nomspe,codeDomaine) VALUES ('".$idspeProduction."','".$codeDomaineProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $idspeProduction = mysqli_fetch_array($result)["idspe"];
        $sql = "INSERT INTO production (date,type) VALUES ('".$dateProduction."','master')";
        if(!mysqli_query($db,$sql)) return true;
        $sql = "SELECT * FROM production ORDER BY codepro DESC";
        if(!($result = mysqli_query($db,$sql))) return true;
        $codepro = mysqli_fetch_array($result)["codepro"];
        $sql = "INSERT INTO pfemaster (codepro,titre,encadreur,lieusout,idspe) VALUES ('".$codepro."','".$titreProduction."','".$encadreurProduction."','".$lieusoutProduction."','".$idspeProduction."')";
        if(!mysqli_query($db,$sql)) return true;
        for ($i=0; $i < count($motsclesProduction); $i++) { 
            $motcle = mysqli_real_escape_string($db,$motsclesProduction[$i]);
            $sql = "INSERT INTO motscle (codepro,mot) VALUES ('".$codepro."','".$motcle."')";
            if(!mysqli_query($db,$sql)) return true;
        }
        return false;
    }
?>