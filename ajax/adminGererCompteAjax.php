<?php
    require_once("../config.php");
    if(isset($_GET["statuscher"]) && $_GET["statuscher"] != ""){
        switch ($_GET["statuscher"]) {
            case 'chercheur':
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM users
                ) AND idcher NOT IN (
                    SELECT idcher FROM cheflabo
                ) AND idcher NOT IN (
                    SELECT idcher FROM chefequip
                )";
                if($result = mysqli_query($db,$sql)){
                    while($row = mysqli_fetch_array($result)){
                        $idcher = $row["idcher"];
                        $sql = "SELECT * FROM equipe WHERE idequip IN (
                            SELECT idequip FROM membrequip WHERE idcher ='".$idcher."'
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
                                    $profilcher = $row["profil"];
                                    echo    '<tr>';
                                    echo    '<td>'.$nomcher.'</td>';
                                    echo    '<td>'.$mailcher.'</td>';
                                    echo    '<td>'.$gradecher.'</td>';
                                    echo    '<td>'.$profilcher.'</td>';
                                    echo    '<td>'.$nomequip.'</td>';
                                    echo    '<td>'.$nomLabo.'</td>';
                                    echo    '<td>'.$nometab.'</td>';
                                    echo    '<td>';
                                    echo    '<div class="btn-toolbar">';
                                    echo    '<div class="btn-group">';
                                    echo    '<button  value="'.$idcher.'" title="bloquer" class="btn-fill btn btn-warning ">Bloquer</button>';
                                    echo    '</div>';
                                    //echo    '<div class="btn-group">';
                                    //echo    '<button  value="'.$idcher.'" title="supprimer" class="btn-fill btn btn-danger ">Supprimer</button>';
                                    //echo    '</div>';
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
                    SELECT idcher FROM users
                )AND idcher IN (
                    SELECT idcher FROM chefequip
                )";
                if($result = mysqli_query($db,$sql)){
                    while($row = mysqli_fetch_array($result)){
                        $idcher = $row["idcher"];
                        $sql = "SELECT * FROM equipe WHERE idequip IN (
                            SELECT idequip FROM chefequip WHERE idcher ='".$idcher."'
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
                                    $profilcher = $row["profil"];
                                    echo    '<tr>';
                                    echo    '<td>'.$nomcher.'</td>';
                                    echo    '<td>'.$mailcher.'</td>';
                                    echo    '<td>'.$gradecher.'</td>';
                                    echo    '<td>'.$profilcher.'</td>';
                                    echo    '<td>'.$nomequip.'</td>';
                                    echo    '<td>'.$nomLabo.'</td>';
                                    echo    '<td>'.$nometab.'</td>';
                                    echo    '<td>';
                                    echo    '<div class="btn-toolbar">';
                                    echo    '<div class="btn-group">';
                                    echo    '<button  value="'.$idcher.'" title="bloquer" class="btn-fill btn btn-warning ">Bloquer</button>';
                                    echo    '</div>';
                                    //echo    '<div class="btn-group">';
                                    //echo    '<button  value="'.$idcher.'" title="supprimer" class="btn-fill btn btn-danger ">Supprimer</button>';
                                    //echo    '</div>';
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
                    SELECT idcher FROM users
                )AND idcher IN (
                    SELECT idcher FROM cheflabo
                )";
                if($result = mysqli_query($db,$sql)){
                    while($row = mysqli_fetch_array($result)){
                        $idcher = $row["idcher"];
                        $sql = "SELECT * FROM equipe WHERE idequip IN (
                            SELECT idequip FROM chefequip WHERE idcher ='".$idcher."'
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
                                    $profilcher = $row["profil"];
                                    echo    '<tr>';
                                    echo    '<td>'.$nomcher.'</td>';
                                    echo    '<td>'.$mailcher.'</td>';
                                    echo    '<td>'.$gradecher.'</td>';
                                    echo    '<td>'.$profilcher.'</td>';
                                    echo    '<td>'.$nomequip.'</td>';
                                    echo    '<td>'.$nomLabo.'</td>';
                                    echo    '<td>'.$nometab.'</td>';
                                    echo    '<td>';
                                    echo    '<div class="btn-toolbar">';
                                    echo    '<div class="btn-group">';
                                    echo    '<button  value="'.$idcher.'" title="bloquer" class="btn-fill btn btn-warning ">Bloquer</button>';
                                    echo    '</div>';
                                    //echo    '<div class="btn-group">';
                                    //echo    '<button  value="'.$idcher.'" title="supprimer" class="btn-fill btn btn-danger ">Supprimer</button>';
                                    //echo    '</div>';
                                    echo    '</div>';
                                    echo    '</td>';
                                    echo    '</tr>';
                                }
                            }
                        }
                    }
                }
            break;
        }   
    } 

    if(isset($_GET["supprimer"]) && $_GET["supprimer"] != ""){
        $idcher = mysqli_real_escape_string($db,$_GET["supprimer"]);
        $sql = "DELETE FROM users WHERE idcher='".$idcher."'";
        if(mysqli_query($db,$sql))
            echo 'true';
    }
?>