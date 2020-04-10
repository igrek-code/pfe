<?php
    require_once("../config.php");

    

    if(isset($_GET["idetab"]) && $_GET["idetab"] != "") {
        $idetab = mysqli_real_escape_string($db,$_GET["idetab"]);
        if(isset($_GET["codeDomaine"])){
            if($_GET["codeDomaine"] == "all"){
                
                $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
                    SELECT codeDomaine FROM specialite WHERE idspe IN (
                        SELECT idspe FROM specialitelabo WHERE idlabo IN (
                            SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                        ) 
                    )
                )";
                if($result = mysqli_query($db,$sql)){
                    while ($row = mysqli_fetch_array($result)) {
                        $nomDomaine = $row["nom"];
                        $codeDomaine = $row["codeDomaine"];
                        echo '
                        <div class="row">
                        <div class="col-md-12">
                        <div class="card" style="padding-top:0px;">
                        <div style="color:grey;margin-top:0px;padding-top:1px;border-bottom:black;" class="header">
                            <h4 style="text-transform:capitalize;">'.$nomDomaine.'</h4>
                        </div>
                        <div class="content table-responsive ">
                        <table class="table table-hover">
                            <thead>
                                <th>Nom</th>
                                <th>Abréviation</th>
                                <th>Structure</th>
                                <th>Année de créa.</th>
                                <th>Etat</th>
                                <th>Tél.</th>
                                <th>Fax.</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Action</th>
                            </thead>
                        ';

                        $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idlabo IN (
                            SELECT idlabo from specialitelabo WHERE idspe IN (
                                SELECT idspe FROM specialite WHERE codeDomaine ='".$codeDomaine."'
                            )
                        )"; 
                        if($result2 = mysqli_query($db,$sql)){
                            echo '<tbody>';
                            while ($row2 = mysqli_fetch_array($result2)) {
                                $nomLabo = $row2["nom"];
                                $idLabo = $row2["idlabo"];
                                $abrvLabo = $row2["abrv"];
                                $etatLabo = $row2["etat"];
                                $structure = $row2["structure"];
                                $anneedecrea = $row2["anneecrea"];
                                $telLabo = $row2["tel"];
                                $faxLabo = $row2["fax"];
                                $mailLabo = $row2["mail"];
                                $adresseLabo = $row2["addresse"];

                                
                                echo    '<tr>';
                                echo    '<td>'.$nomLabo.'</td>';
                                echo    '<td>'.$abrvLabo.'</td>';
                                echo    '<td>'.$structure.'</td>';
                                echo    '<td>'.$anneedecrea.'</td>';
                                if($etatLabo == "actif")    
                                    echo    '<td class="text-success">Actif</td>';
                                else
                                    echo    '<td class="text-danger">Inactif</td>';
                                echo    '<td>'.$telLabo.'</td>';
                                echo    '<td>'.$faxLabo.'</td>';
                                echo    '<td>'.$mailLabo.'</td>';
                                echo    '<td>'.$adresseLabo.'</td>';
                                //echo    '<td><a rel="external" target="_blank" href="http://www.'.$siteweb.'">'.$siteweb.'</a></td>';
                                echo    '<td>';
                                echo    '<div class="btn-toolbar">';
                                echo    '<div class="btn-group">';
                                echo    '<a href="adminModifierLabo.php?modifier='.$idLabo.'" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
                                echo    '</div>';
                                echo    '<div class="btn-group">';
                                echo    '<button  value="'.$idLabo.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                                echo    '</div>';
                                echo    '</div>';
                                echo    '</td>';
                                echo    '</tr>';
                                
                            }
                                echo    '</tbody>';
                                echo    '</table>';
                                echo    '</div>';
                                echo    '</div>';
                                echo    '</div>';
                                echo    '</div>';
                        } 

                    }
                } 

                

            }    
            else{
                $codeDomaine = mysqli_real_escape_string($db,$_GET["codeDomaine"]);
                $sql = "SELECT * FROM laboratoire WHERE idetab='".$idetab."' AND idlabo IN (
                    SELECT idlabo FROM specialitelabo WHERE idspe IN (
                        SELECT idspe FROM specialite WHERE codeDomaine ='".$codeDomaine."'
                    )
                )";
                if($result = mysqli_query($db,$sql)){
                    echo '
                        <div class="row">
                        <div class="col-md-12">
                        <div class="card" style="padding-top:0px;">
                        <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>Nom</th>
                                <th>Abréviation</th>
                                <th>Structure</th>
                                <th>Année de créa.</th>
                                <th>Etat</th>
                                <th>Tél.</th>
                                <th>Fax.</th>
                                <th>Email</th>
                                <th>Adresse</th>
                                <th>Action</th>
                            </thead>
                        ';
                    echo    '<tbody>';
                    while ($row = mysqli_fetch_array($result)) {
                        $nomLabo = $row["nom"];
                        $idLabo = $row["idlabo"];
                        $abrvLabo = $row["abrv"];
                        $etatLabo = $row["etat"];
                        $structure = $row["structure"];
                        $anneedecrea = $row["anneecrea"];
                        $telLabo = $row["tel"];
                        $faxLabo = $row["fax"];
                        $mailLabo = $row["mail"];
                        $adresseLabo = $row["addresse"];
                        
                        echo    '<tr>';
                        echo    '<td>'.$nomLabo.'</td>';
                        echo    '<td>'.$abrvLabo.'</td>';
                        echo    '<td>'.$structure.'</td>';
                        echo    '<td>'.$anneedecrea.'</td>';
                        if($etatLabo == "actif")    
                            echo    '<td class="text-success">Actif</td>';
                        else
                            echo    '<td class="text-danger">Inactif</td>';
                        echo    '<td>'.$telLabo.'</td>';
                        echo    '<td>'.$faxLabo.'</td>';
                        echo    '<td>'.$mailLabo.'</td>';
                        echo    '<td>'.$adresseLabo.'</td>';
                        //echo    '<td><a rel="external" target="_blank" href="http://www.'.$siteweb.'">'.$siteweb.'</a></td>';
                        echo    '<td>';
                        echo    '<div class="btn-toolbar">';
                        echo    '<div class="btn-group">';
                        echo    '<a href="adminModifierLabo.php?modifier='.$idLabo.'" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
                        echo    '</div>';
                        echo    '<div class="btn-group">';
                        echo    '<button  value="'.$idLabo.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                        echo    '</div>';
                        echo    '</div>';
                        echo    '</td>';
                        echo    '</tr>';
                        
                    }
                    echo    '</tbody>';
                    echo    '</table>';
                    echo    '</div>';
                    echo    '</div>';
                    echo    '</div>';
                    echo    '</div>';
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
                while ($row = mysqli_fetch_array($result)) {
                    $codeDomaine = $row["codeDomaine"];
                    $nomDomaine = $row["nom"];
                    echo '<option value="'.$codeDomaine.'">'.$nomDomaine.'</option>';
                }
            }
        }
    }

    if(isset($_GET["supprimerLabo"]) && $_GET["supprimerLabo"] != ""){
        $codeLabo = mysqli_real_escape_string($db,$_GET["supprimerLabo"]);
        $sql = "DELETE FROM laboratoire WHERE idlabo='".$codeLabo."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>