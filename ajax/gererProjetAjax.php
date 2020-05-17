<?php
    session_start();
    require_once("../config.php");
    if(isset($_GET["refresh"]) && $_GET["refresh"]){
        $idcher = $_SESSION["idcher"];
        echo '<div class="content">
        <table class="table table-hover">
            <thead>
                <th>Code</th>
                <th>Intitulé</th>
                <th>Date</th>
                <th>Etat</th>
                <th>Action</th>
            </thead>
        <tbody>';
        $sql = "SELECT * FROM projrecher WHERE codeproj IN (
            SELECT codeproj FROM chefproj WHERE idcher='".$idcher."'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $intitule = $row['intitule'];
                $date = $row['date'];
                $duree = $row['duree']; 
                $etat = $row['etat']; 
                $fichier = $row['fichier'];
                $codeproj = $row['codeproj'];
                /*$idspe = $row["idspe"];
                $sql = "SELECT * FROM specialite WHERE idspe='".$idspe."'";
                $result2 = mysqli_query($db,$sql);
                if(mysqli_num_rows($result2) > 0){    
                    $nomspe = mysqli_fetch_array($result2)["nomspe"];*/
                echo    '<tr>';
                echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">'.$codeproj.'</button></td>';
                echo    '<td>'.$intitule.'</td>';
                echo    '<td>'.$date.'</td>';
                switch ($etat) {
                    case 'en cours':
                        echo    '<td class="text-success">'.$etat.'</td>';
                    break;
                    
                    case 'reconduit':
                        echo    '<td class="text-warning">'.$etat.'</td>';
                    break;
                    
                    default:
                    echo    '<td class="text-danger">'.$etat.'</td>';
                        break;
                }
                //echo    '<td>'.$duree.'</td>';
                //echo    '<td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">Description</button></td>';
                //echo    '<td><button membre="membre" class="btn btn-primary" style="border:0px;font-size:16px;" value="'.$codeproj.'">Membres</button></td>';
                //echo '<td><a href="ajax/gererProjetAjax.php?file='.$fichier.'">Télécharger</a></td>';
                echo    '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<a href="modifierProjet.php?modifier='.$codeproj.'" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$codeproj.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                echo    '</div>';
                echo    '</div>';
                echo    '</td>';
                echo    '</tr>';
                //}
                
            }
        }
        echo '</tbody>
            </table>
        </div>';
    }

    if(isset($_GET["codeproj"]) && $_GET["codeproj"] != ""){
        $codeproj = mysqli_real_escape_string($db,$_GET["codeproj"]);
        $sql = "SELECT * FROM projrecher WHERE codeproj='".$codeproj."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $intitule = $row['intitule'];
            $date = $row['date'];
            $description = $row['description'];
            $duree = $row['duree'];
            $etat = $row['etat'];
            $fichier = $row['fichier'];
            $codeDomaine = $row['codeDomaine'];
            $sql = "SELECT nom FROM domaine WHERE codeDomaine ='".$codeDomaine."'";
            $result = mysqli_query($db,$sql);
            $nomDomaine = mysqli_fetch_array($result)['nom'];
            echo '<span class="text-info">Code du projet: </span>'.$codeproj.'<br>';
            echo '<span class="text-info">Intitulé: </span>'.$intitule.'<br>';
            echo '<span class="text-info">Date: </span>'.$date.'<br>';
            echo '<span class="text-info">Durée: </span>'.$duree.' mois<br>';
            switch ($etat) {
                case 'en cours':
                    echo '<span class="text-info">Etat: </span><span class="text-success">'.$etat.'</span><br>';
                break;
                
                case 'reconduit':
                    echo '<span class="text-info">Etat: </span><span class="text-warning">'.$etat.'</span><br>';
                break;
                
                default:
                    echo '<span class="text-info">Etat: </span><span class="text-danger">'.$etat.'</span><br>';
                break;
            }
            echo '<span class="text-info">Mots-clés: </span>';
            $sql = "SELECT * FROM motscler WHERE codeproj='".$codeproj."'";
            $result2 = mysqli_query($db,$sql);
            if(mysqli_num_rows($result2) > 0){
                while($row = mysqli_fetch_array($result2)){
                    $mot = $row["mot"];
                    echo $mot.', ';
                }
            }
            echo '<br>';
            $nom = $_SESSION["nom"];
            echo '<span class="text-info">Chef du projet: </span>'.$nom.'<br>';

            $sql = "SELECT nom FROM chercheur WHERE idcher IN (
                SELECT idcher FROM membreproj WHERE codeproj = '".$codeproj."'
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                echo '<span class="text-info">Membres: </span>';
                while($row = mysqli_fetch_array($result)){
                    $nom = $row['nom'];
                    echo $nom.', ';
                }
                echo '<br>';
            }
            else{
                echo '<div class="text-danger">Membres indisponibles !</div>';
            }
            echo '<span class="text-info">Description: </span>'.$description.'<br>';
            echo '<a href="ajax/gererProjetAjax.php?file='.$fichier.'">Télécharger la déscription complète</a>';
        }
        else{
            echo '<div class="text-danger">Informations indisponibles !</div>';
        }
    }  

    if(isset($_GET['file']) && $_GET['file'] != ''){
        $file = '../uploads/'.$_GET['file'];
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $codeproj = mysqli_real_escape_string($db,$_GET["supprimer"]);

        $sql = "SELECT fichier FROM projrecher WHERE codeproj='".$codeproj."'";
        $result = mysqli_query($db,$sql);
        $fileName = mysqli_fetch_array($result)['fichier'];
        unlink("../uploads/".$fileName);
        
        $sql = "DELETE FROM domaine WHERE codeDomaine IN (
            SELECT codeDomaine FROM projrecher WHERE codeproj='".$codeproj."'
        )";
        mysqli_query($db,$sql);
        $sql = "DELETE FROM projrecher WHERE codeproj='".$codeproj."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>