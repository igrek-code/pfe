<?php
    require_once("../config.php");
    if(isset($_GET["statuscher"]) && $_GET["statuscher"] != ""){
        echo '<div class="content table-responsive">
        <table class="table table-hover">
            <thead>
                <th>Nom</th>
                <th>Mail</th>
                <th>Grade</th>
                <th>Grade C</th>
                <th>Profil</th>';
                if($_GET["statuscher"] != "cheflabo")
                    echo '<th>Equipe</th>';
                echo'<th>Laboratoire</th>
                <th>Etablissement</th>
                <th>Action</th>
            </thead>
            <tbody>';
        switch ($_GET["statuscher"]) {
            case 'chercheur':
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                ) AND idcher NOT IN (
                    SELECT idcher FROM cheflabo
                ) AND idcher NOT IN (
                    SELECT idcher FROM chefequip
                )";
                if($result = mysqli_query($db,$sql)){
                    while($row = mysqli_fetch_array($result)){
                        $idcher = $row["idcher"];
                        $sql = "SELECT * FROM equipe WHERE idequipe IN (
                            SELECT idequipe FROM menbrequip WHERE idcher ='".$idcher."'
                        )";
                        if($result2 = mysqli_query($db,$sql)){
                            $row2 = mysqli_fetch_array($result2);
                            $nomequip = $row2["nomequip"];
                            $idlabo = $row2["idlabo"];
                            $sql = "SELECT * FROM laboratoire WHERE idlabo='".$idlabo."'";
                            if($result2 = mysqli_query($db,$sql)){
                                $row2 = mysqli_fetch_array($result2);
                                $nomLabo = $row2["nom"];
                                $idetab = $row2["idetab"];
                                $sql = "SELECT * FROM etablissement WHERE idetab='".$idetab."'";
                                if($result2 = mysqli_query($db,$sql)){
                                    $row2 = mysqli_fetch_array($result2);
                                    $nometab = $row2["nom"];
                                    $nomcher = $row["nom"];
                                    $mailcher = $row["mail"];
                                    $gradecher = $row["grade"];
                                    $gradecherC = $row["gradeC"];
                                    $profilcher = $row["profil"];
                                    echo    '<tr>';
                                    echo    '<td>'.$nomcher.'</td>';
                                    echo    '<td>'.$mailcher.'</td>';
                                    echo    '<td>'.$gradecher.'</td>';
                                    echo    '<td>'.$gradecherC.'</td>';
                                    echo    '<td>'.$profilcher.'</td>';
                                    echo    '<td>'.$nomequip.'</td>';
                                    echo    '<td>'.$nomLabo.'</td>';
                                    echo    '<td>'.$nometab.'</td>';
                                    echo    '<td>';
                                    echo    '<div class="btn-toolbar">';
                                    //echo    '<div class="btn-group">';
                                    //echo    '<button  value="'.$idcher.'" title="bloquer" class="btn-fill btn btn-warning ">Bloquer</button>';
                                    //echo    '</div>';
                                    echo    '<div class="btn-group">';
                                    echo    '<button  value="'.$idcher.'" title="supprimer" class="btn-fill btn btn-danger ">Supprimer</button>';
                                    echo    '</div>';
                                    echo    '</div>';
                                    echo    '</td>';
                                    echo    '</tr>';
                                }
                            }
                        }
                    }
                }
            break;

            case 'chefequipe':
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )AND idcher IN (
                    SELECT idcher FROM chefequip
                )";
                if($result = mysqli_query($db,$sql)){
                    while($row = mysqli_fetch_array($result)){
                        $idcher = $row["idcher"];
                        $sql = "SELECT * FROM equipe WHERE idequipe IN (
                            SELECT idequipe FROM chefequip WHERE idcher ='".$idcher."'
                        )";
                        if($result2 = mysqli_query($db,$sql)){
                            $row2 = mysqli_fetch_array($result2);
                            $nomequip = $row2["nomequip"];
                            $idlabo = $row2["idlabo"];
                            $sql = "SELECT * FROM laboratoire WHERE idlabo='".$idlabo."'";
                            if($result2 = mysqli_query($db,$sql)){
                                $row2 = mysqli_fetch_array($result2);
                                $nomLabo = $row2["nom"];
                                $idetab = $row2["idetab"];
                                $sql = "SELECT * FROM etablissement WHERE idetab='".$idetab."'";
                                if($result2 = mysqli_query($db,$sql)){
                                    $row2 = mysqli_fetch_array($result2);
                                    $nometab = $row2["nom"];
                                    $nomcher = $row["nom"];
                                    $mailcher = $row["mail"];
                                    $gradecher = $row["grade"];
                                    $gradecherC = $row["gradeC"];
                                    $profilcher = $row["profil"];
                                    echo    '<tr>';
                                    echo    '<td>'.$nomcher.'</td>';
                                    echo    '<td>'.$mailcher.'</td>';
                                    echo    '<td>'.$gradecher.'</td>';
                                    echo    '<td>'.$gradecherC.'</td>';
                                    echo    '<td>'.$profilcher.'</td>';
                                    echo    '<td>'.$nomequip.'</td>';
                                    echo    '<td>'.$nomLabo.'</td>';
                                    echo    '<td>'.$nometab.'</td>';
                                    echo    '<td>';
                                    echo    '<div class="btn-toolbar">';
                                    //echo    '<div class="btn-group">';
                                    //echo    '<button  value="'.$idcher.'" title="bloquer" class="btn-fill btn btn-warning ">Bloquer</button>';
                                    //echo    '</div>';
                                    echo    '<div class="btn-group">';
                                    echo    '<button  value="'.$idcher.'" title="supprimer" class="btn-fill btn btn-danger ">Supprimer</button>';
                                    echo    '</div>';
                                    echo    '</div>';
                                    echo    '</td>';
                                    echo    '</tr>';
                                }
                            }
                        }
                    }
                }
            break;
            
            default:
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM users WHERE actif='1'
                )AND idcher IN (
                    SELECT idcher FROM cheflabo
                )";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $idcher = $row["idcher"];
                        $sql = "SELECT * FROM etablissement WHERE idetab IN (
                            SELECT idetab FROM laboratoire WHERE idlabo IN (
                                SELECT idlabo FROM cheflabo WHERE idcher='".$idcher."'
                            )
                        )";
                        $result2 = mysqli_query($db,$sql);
                        $nometab = mysqli_fetch_array($result2)["nom"];
                        
                        $sql = "SELECT * FROM laboratoire WHERE idlabo IN (
                            SELECT idlabo FROM cheflabo WHERE idcher='".$idcher."'
                        )";
                        $result2 = mysqli_query($db,$sql);
                        $nomLabo = mysqli_fetch_array($result2)["nom"];
                        $nomcher = $row["nom"];
                        $mailcher = $row["mail"];
                        $gradecher = $row["grade"];
                        $gradecherC = $row["gradeC"];
                        $profilcher = $row["profil"];

                        echo    '<tr>';
                        echo    '<td>'.$nomcher.'</td>';
                        echo    '<td>'.$mailcher.'</td>';
                        echo    '<td>'.$gradecher.'</td>';
                        echo    '<td>'.$gradecherC.'</td>';
                        echo    '<td>'.$profilcher.'</td>';
                        echo    '<td>'.$nomLabo.'</td>';
                        echo    '<td>'.$nometab.'</td>';
                        echo    '<td>';
                        echo    '<div class="btn-toolbar">';
                        //echo    '<div class="btn-group">';
                        //echo    '<button  value="'.$idcher.'" title="bloquer" class="btn-fill btn btn-warning ">Bloquer</button>';
                        //echo    '</div>';
                        echo    '<div class="btn-group">';
                        echo    '<button  value="'.$idcher.'" title="supprimer" class="btn-fill btn btn-danger ">Supprimer</button>';
                        echo    '</div>';
                        echo    '</div>';
                        echo    '</td>';
                        echo    '</tr>';
                    }
                }
            break;
        }   
        echo '</tbody>
            </table>
        </div>';
    } 

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $idcher = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "DELETE FROM users WHERE idcher='".$idcher."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>