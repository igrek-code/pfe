<?php
    require_once('../config.php');
    session_start();

    if(isset($_GET['refresh']) && $_GET['refresh'] == 'true'){
        echo '<div class="content">
        <table class="table table-hover" id="myTable" >
            <thead>
                <th>Titre</th>
                <th>Dérnier délai</th>
                <th>Type</th>
            </thead>
            <tbody>';

        if(isset($_SESSION['loggedinchercheur'])){
            $idequipe = $_SESSION['idequipe'];
            $sql = "SELECT * FROM notification WHERE idcher IN (
                SELECT idcher FROM chefequip WHERE idequipe = '".$idequipe."'
            ) AND forEquipe = 0";
        }
        if(isset($_SESSION['loggedinlabo'])){
            $sql = "SELECT * FROM notification WHERE admin=1";
        }
        if(isset($_SESSION['loggedinequipe'])){
            $idlabo = $_SESSION['idlabo'];
            $sql = "SELECT * FROM notification WHERE idcher IN (
                SELECT idcher FROM cheflabo WHERE idlabo = '".$idlabo."'
            ) AND forEquipe = 1";
        }
        
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)) {
                $titre = $row['titre'];
                $date = $row['date'];
                $type = $row['type'];
                if($type == 'urgent')
                    {$alert = 'danger';$textType = 'Urgent';}
                else 
                    {$alert = 'warning';$textType = 'Pas urgent';}
                echo '<tr>';
                //echo '<td class="alert alert-'.$alert.'"><input value="row" type="checkbox"></td>';
                echo '<td class="alert alert-'.$alert.'">'.$titre.'</td>';
                echo '<td class="alert alert-'.$alert.'">'.$date.'</td>';
                echo '<td class="alert alert-'.$alert.'">'.$textType.'</td>';
                echo '</tr>';
            }
        }
    }

    if(isset($_GET['refresh1']) && $_GET['refresh1'] == 'true'){
        echo '<div class="content">
        <table class="table table-hover" id="myTable1" >
            <thead>
                <th>Titre</th>
                <th>Dérnier délai</th>
                <th>Type</th>';
        if(isset($_SESSION['loggedinlabo']))
            echo '<th>Pour</th>';
        echo '<th>Action</th>
            </thead>
            <tbody>';
        if(isset($_SESSION['idcher'])){
            $idcher = $_SESSION['idcher'];
            $sql = "SELECT * FROM notification WHERE idcher = '".$idcher."' AND admin=0";
        }
        else{
            $sql = "SELECT * FROM notification WHERE admin=1";
        }
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)) {
                $titre = $row['titre'];
                $date = $row['date'];
                $type = $row['type'];
                $forEquipe = $row['forEquipe'];
                if($type == 'urgent')
                    {$alert = 'danger';$textType = 'Urgent';}
                else 
                    {$alert = 'warning';$textType = 'Pas urgent';}
                echo '<tr>';
                //echo '<td class="alert alert-'.$alert.'"><input value="row" type="checkbox"></td>';
                echo '<td class="alert alert-'.$alert.'">'.$titre.'</td>';
                echo '<td class="alert alert-'.$alert.'">'.$date.'</td>';
                echo '<td class="alert alert-'.$alert.'">'.$textType.'</td>';
                if(isset($_SESSION['loggedinlabo']))
                {
                    if($forEquipe == 0)
                        echo '<td class="alert alert-'.$alert.'">Chefs d\'équipes</td>';
                    else
                        echo '<td class="alert alert-'.$alert.'">Chercheurs</td>';
                }
                echo    '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<button value="'.$titre.','.$date.','.$type.'" title="modifier" class="btn-fill btn btn-info"><i class="pe-7s-file"></i></button>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$titre.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                echo    '</div>';
                echo    '</div>';
                echo    '</td>';
                echo '</tr>';
            }
        }
    }

    if(isset($_GET['oldTitre'])){
        $oldTitre = mysqli_real_escape_string($db,$_GET['oldTitre']);
        $titre = mysqli_real_escape_string($db,$_GET['titre']);
        $type = mysqli_real_escape_string($db,$_GET['type']);
        $date = mysqli_real_escape_string($db,$_GET['date']);
        $idcher = mysqli_real_escape_string($db,$_GET['idcher']);
        if($idcher == 0)
            $sql = "UPDATE notification SET titre='".$titre."', type='".$type."', date='".$date."' WHERE admin=1 AND titre='".$oldTitre."'";
        else
            $sql = "UPDATE notification SET titre='".$titre."', type='".$type."', date='".$date."' WHERE admin=0 AND idcher='".$idcher."' AND titre='".$oldTitre."'";
        
        if(mysqli_query($db,$sql)) echo 'true';
        else echo 'false';
    }

    if(!isset($_GET['oldTitre']) && isset($_GET['idcher']) && isset($_GET['titre'])){
        $idcher = mysqli_real_escape_string($db,$_GET['idcher']);
        $titre = mysqli_real_escape_string($db,$_GET['titre']);
        if($idcher == 0)
            $sql = "DELETE FROM notification WHERE admin=0 AND idcher='".$idcher."' AND titre='".$titre."'";
        else
            $sql = "DELETE FROM notification WHERE admin=1 AND titre='".$titre."'";

        if(mysqli_query($db,$sql)) echo 'true';
        else echo 'false';
    }
?>