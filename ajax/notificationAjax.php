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
        $idcher = $_SESSION['idcher'];

        $sql = "SELECT * FROM notification WHERE admin = 1";
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
                <th>Type</th>
                <th>Action</th>
            </thead>
            <tbody>';
        $idcher = $_SESSION['idcher'];

        $sql = "SELECT * FROM notification WHERE idcher = '".$idcher."' AND admin=0";
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
                echo    '<td>';
                echo    '<div class="btn-toolbar">';
                echo    '<div class="btn-group">';
                echo    '<a href="adminModifierEtab.php?modifier=" title="modifier"><i class="pe-7s-file  btn-fill btn btn-info"></i></a>';
                echo    '</div>';
                echo    '<div class="btn-group">';
                echo    '<button  value="'.$titre.'" title="supprimer" class="supprimer btn-fill btn btn-danger "><i class="pe-7s-trash  "></i></button>';
                echo    '</div>';
                echo    '</div>';
                echo    '</td>';
                echo '</tr>';
            }
            echo 'im in file';

            if(isset($_GET['idcher']) && isset($_GET['titre'])){
                echo 'im in if';
                $idcher = mysqli_real_escape_string($db,$_GET['idcher']);
                $titre = mysqli_real_escape_string($db,$_GET['titre']);
                
                $sql = "DELETE FROM notification WHERE idcher='".$idcher."' AND titre='".$titre."'";
                if(mysqli_query($db,$sql)) echo 'true';
                else echo 'false';
            }
        }
    }
?>