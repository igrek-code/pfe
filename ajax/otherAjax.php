<?php
    require_once('../config.php');
    if(isset($_GET['idetab']) && $_GET['idetab'] != '' && !isset($_GET['nomDomaine'])){
        $idetab = mysqli_real_escape_string($db,$_GET['idetab']);
        $sql = "SELECT nom FROM domaine WHERE codeDomaine IN (
            SELECT codeDomaine FROM projrecher WHERE codeproj IN (
                SELECT codeproj FROM chefproj WHERE idcher IN (
                    SELECT idcher FROM cheflabo WHERE idlabo IN (
                        SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                    )
                )
                OR idcher IN (
                    SELECT idcher FROM chefequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo IN (
                            SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                        )
                    )
                )
                OR idcher IN (
                    SELECT idcher FROM menbrequip WHERE idequipe IN (
                        SELECT idequipe FROM equipe WHERE idlabo IN (
                            SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                        )
                    )
                )
            )
        ) GROUP BY nom";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $nom = $row['nom'];
                echo '<option>'.$nom.'</option>';
            }
        }
    }

    if(isset($_GET['nomDomaine']) && $_GET['nomDomaine'] != '' && isset($_GET['idetab']) && $_GET['idetab'] != ''){
        $nomDomaine = mysqli_real_escape_string($db,$_GET['nomDomaine']);
        $idetab = mysqli_real_escape_string($db,$_GET['idetab']);
        $sql = "SELECT * FROM projrecher WHERE codeDomaine IN (
            SELECT codeDomaine FROM domaine WHERE nom='".$nomDomaine."'
        ) AND codeproj IN (
            SELECT codeproj FROM chefproj WHERE idcher IN (
                SELECT idcher FROM cheflabo WHERE idlabo IN (
                    SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                )
            )
            OR idcher IN (
                SELECT idcher FROM chefequip WHERE idequipe IN (
                    SELECT idequipe FROM equipe WHERE idlabo IN (
                        SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                    )
                )
            )
            OR idcher IN (
                SELECT idcher FROM menbrequip WHERE idequipe IN (
                    SELECT idequipe FROM equipe WHERE idlabo IN (
                        SELECT idlabo FROM laboratoire WHERE idetab='".$idetab."'
                    )
                )
            )
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $codeproj2 = $row['codeproj'];
                $intitule = $row['intitule'];
                $date = $row['date'];
                $duree = $row['duree'];
                echo '<option dateDeb="'.$date.'" duree="'.$duree.'" data-tokens="'.$codeproj2.'" value="'.$codeproj2.'">'.$intitule.'</option>';
            }
        }
    }

    if(isset($_GET['codeproj']) && $_GET['codeproj'] != ''){
        $codeproj = mysqli_real_escape_string($db,$_GET['codeproj']);
        $sql = "SELECT idcher, nom FROM chercheur WHERE idcher IN (
            SELECT idcher FROM chefproj WHERE codeproj = '".$codeproj."'
        )
        OR idcher IN (
            SELECT idcher FROM membreproj WHERE codeproj ='".$codeproj."'
        )";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $nom = $row['nom'];
                $idcher = $row['idcher'];
                echo '<option value="'.$idcher.'">'.$nom.'</option>';
            }
        }
    }

?>