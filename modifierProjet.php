<?php
    require_once("config.php");
    session_start();

    $session = false;
    if(isset($_SESSION['loggedinlabo']) && $_SESSION['loggedinlabo']) $session = true;
    if(isset($_SESSION['loggedinequipe']) && $_SESSION['loggedinequipe']) $session = true;
    if(isset($_SESSION['loggedinchercheur']) && $_SESSION['loggedinchercheur']) $session = true;
    if(!isset($_SESSION['ddr']) || !$_SESSION['ddr']) $session = false;
    if(!$session){   
        session_destroy();
        header("location: index.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $codeproj = mysqli_real_escape_string($db,$_GET['modifier']);
        $idcher = $_SESSION['idcher'];
        $display_notif = true;
        $error = true;

        $intitule = mysqli_real_escape_string($db,$_POST['intitule']);
        $description = mysqli_real_escape_string($db,$_POST['description']);
        $date = mysqli_real_escape_string($db,$_POST['date']);
        $duree = mysqli_real_escape_string($db,$_POST['duree']);
        $newCode = mysqli_real_escape_string($db,$_POST['codeproj']);
        $etat = mysqli_real_escape_string($db,$_POST['etat']);
        $domaine = mysqli_real_escape_string($db,$_POST['domaine']);


        
        $targetDir = "uploads/";
        $fileName = basename($_FILES["newFile"]["name"]);
        $fileName = $newCode.'.rar';
        $targetFilePath = $targetDir . $newCode.'.rar';
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        if(!empty($_FILES["newFile"]["name"])){
            // Allow certain file formats
            $allowTypes = array('rar');
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                move_uploaded_file($_FILES["newFile"]["tmp_name"], $targetFilePath);
            }
        }



        if($newCode != $codeproj){
            rename('uploads/'.$codeproj.'.rar','uploads/'.$newCode.'.rar');
        }
        
        $sql = "UPDATE domaine SET nom ='".$domaine."' WHERE codeDomaine IN (
            SELECT codeDomaine FROM projrecher WHERE codeproj='".$codeproj."'
        )";
        mysqli_query($db,$sql);
        
        $sql = "DELETE FROM motscler WHERE codeproj = '".$codeproj."'";
        mysqli_query($db,$sql);

        $mots = explode(',',mysqli_real_escape_string($db,$_POST['cles']));
        for ($i=0; $i < count($mots); $i++) { 
            $mot = $mots[$i];
            $sql = "INSERT INTO motscler (codeproj,mot) VALUES ('".$codeproj."','".$mot."')";
            mysqli_query($db,$sql);
        }

        $sql = "UPDATE projrecher SET etat='".$etat."', codeproj='".$newCode."', intitule='".$intitule."', description='".$description."', date='".$date."', duree='".$duree."' WHERE codeproj='".$codeproj."'";
        if(mysqli_query($db,$sql)){
            $codeproj = $newCode;
            $sql = "DELETE FROM membreproj WHERE codeproj='".$codeproj."'";
            if(mysqli_query($db,$sql)){
                $error = false;
                if(isset($_POST['membreproj'])){
                    for ($i=0; $i < count($_POST['membreproj']); $i++) { 
                        $membre = $_POST['membreproj'][$i];
                        $sql = "INSERT INTO membreproj (idcher,codeproj) VALUES ('".$membre."','".$codeproj."')";
                        if(!mysqli_query($db,$sql)) $error = true;
                    }
                }
            }
        }

        header('location: modifierProjet.php?modifier='.$newCode);

        if(!$error) $display_type = "success";
        else $display_type = "error";
    }

    if(isset($_GET['modifier']) && $_GET['modifier'] != ''){
        $idcher = $_SESSION['idcher'];
        if(!isset($error))
            $codeproj = mysqli_real_escape_string($db,$_GET['modifier']);
        $sql = "SELECT * FROM chefproj WHERE codeproj='".$codeproj."'";
        $result = mysqli_query($db,$sql);
        if(mysqli_num_rows($result) > 0){
            if(mysqli_fetch_array($result)['idcher'] != $idcher) header("location: gererProjet.php");
            $sql = "SELECT * FROM projrecher WHERE codeproj='".$codeproj."'";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $intitule = $row['intitule'];
                $date = $row['date'];
                $duree = $row['duree'];
                $etat = $row['etat'];
                $codeDomaine = $row['codeDomaine'];
                $description = $row['description'];
                $sql = "SELECT * FROM membreproj WHERE codeproj='".$codeproj."'";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $membres = array();
                    while($row = mysqli_fetch_array($result)){
                        $membres[] = $row['idcher'];
                    }
                }
                $sql = "SELECT nom FROM domaine WHERE codeDomaine ='".$codeDomaine."'";
                $result = mysqli_query($db,$sql);
                $nomDomaine = mysqli_fetch_array($result)['nom'];
                $sql = "SELECT mot FROM motscler WHERE codeproj ='".$codeproj."'";
                $result = mysqli_query($db,$sql);
                $mots = '';
                while($row = mysqli_fetch_array($result)){
                    $mots = $mots.$row['mot'].','; 
                }
                $mots = substr($mots, 0, -1);
            }
        }else{
            header("location: gererProjet.php");
        }
    }else{
        header("location: gererProjet.php");
    }


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Plateforme Scientifique</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> -->
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <!-- SELECT CSS -->
    <link rel="stylesheet" href="assets/select/bootstrap-select.min.css">

    <style>
        #revenir{
            font-size : 17px;
            text-decoration : underline;
        }
        #seDeconnecter:hover{
            color : red;
        }
    </style>

</head>
<body>


    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Menu
                </a>
            </div>

            <ul class="nav">

            <?php 
                require_once("menu.php");
                if(isset($_SESSION['loggedinlabo'])) menu(8);
                if(isset($_SESSION['loggedinequipe'])) menu(8);
                if(isset($_SESSION['loggedinchercheur'])) menu(4);
            ?>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div style="font-size:18px;" class="navbar-brand">
                        <?php 
                            echo $_SESSION["nom"];
                            if(isset($_SESSION["nomequip"])) echo ' Equipe: '.$_SESSION["nomequip"];
                            if(isset($_SESSION["nomlabo"])) echo ' Labo: '.$_SESSION["nomlabo"];
                        ?> 
                    </div>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                    
                    
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        
                    <li>
                            <a href="chercheurCompte.php">
                                <p>Compte</p>
                            </a>
                        </li>
                        <li>
                            <a id="seDeconnecter" href="index.php?logout=1">
                                <p>Se déconnecter</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        
        


        <div style="position:relative; width:60%; left:20%; right:20%;" class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Nouveau projet
                        <a id="revenir" href="gererProjet.php" class="pull-right text-muted"><i class="pe-7s-back"></i> liste des projets </a> </h4>
                    </div>

                    <div class="content">
                        <form enctype="multipart/form-data" action="" id="mainForm" method="post">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>code</label>
                                        <input value="<?php echo $codeproj; ?>" type="text" name="codeproj" class="form-control" placeholder="Code du projet" required>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>intitulé</label>
                                        <input value="<?php echo $intitule; ?>" minlength="5" maxlength="50" type="text" name="intitule" class="form-control" placeholder="Intitulé du projet" required>
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>état</label>
                                        <select class="form-control selectpicker" name="etat" required>
                                            <option <?php if($etat == 'en cours') echo 'selected'; ?> >en cours</option>
                                            <option <?php if($etat == 'reconduit') echo 'selected'; ?> >reconduit</option>
                                            <option <?php if($etat == 'clôturé') echo 'selected'; ?> >clôturé</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Domaine</label>
                                        <input value="<?php echo $nomDomaine; ?>" required name="domaine" placeholder="Domaine du projet" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>mots-clès (séparé par une virgule)</label>
                                        <input value="<?php echo $mots; ?>" required name="cles" placeholder="Mots-clès du projet" class="form-control" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>date</label>
                                        <input value="<?php echo $date; ?>" min="2000-01" max="<?php echo date('Y-m'); ?>" type="month" name="date" class="form-control" placeholder="Date de début du projet" required>
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>durée (en mois)</label>
                                        <input value="<?php echo $duree; ?>" min="1" max="9999" type="number" name="duree" class="form-control" placeholder="Durée du projet" required>
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>description (brève)</label>
                                        <textarea rows="5" name="description" class="form-control" placeholder="Description du projet..." required><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>description (fichier .rar)</label>
                                        <input accept=".rar" class="form-group" type="file" name="newFile">
                                    </div>
                                </div>
                            </div>

                            <div id="auteurs">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Chef de projet</label>
                                            <select disabled required class="form-control selectpicker">
                                                <option><?php echo $_SESSION["nom"];?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    if(isset($membres)){
                                        $position = 0;
                                        foreach ($membres as $membre) {
                                           $position++;
                                        
                                
                                        echo'<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                                    <label>membre '.$position.'</label>
                                                    <select required data-live-search="true" class="form-control selectpicker" name="membreproj[]" title="Membre '.$position.'" membre="'.$position.'">
                                                    <!--<option value="autre">Autre</option>-->';
                                                    
                                                        $idequipe = $_SESSION['idequipe'];
                                                        $idcher = $_SESSION['idcher'];
                                                        $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                                            SELECT idcher FROM users WHERE actif=1
                                                        ) AND (
                                                            idcher IN (
                                                                SELECT idcher FROM menbrequip WHERE idequipe ='".$idequipe."'
                                                            )
                                                            OR
                                                            idcher IN (
                                                                SELECT idcher FROM chefequip WHERE idequipe ='".$idequipe."'
                                                            )
                                                        ) AND idcher <> '".$idcher."'";
                                                        $result = mysqli_query($db,$sql);
                                                        if(mysqli_num_rows($result) > 0){
                                                            while($row = mysqli_fetch_array($result)){
                                                                $nomcher = $row["nom"];
                                                                $idcher = $row["idcher"];
                                                                if($idcher == $membre)
                                                                    echo '<option selected value="'.$idcher.'">'.$nomcher.'</option>';
                                                                else echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                                            }
                                                        }
                                                    
                                                    echo'</select>
                                                </div>
                                            </div>
                                        </div>';
                                   } } ?>
                                <button value="<?php if(isset($position)) echo $position; else echo 0;?>" type="button" class="btn btn-info btn-fill">Ajouter membre</button>
                            </div>

                            <!--<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Domaine</label>
                                        <input placeholder="Domaine de l'équipe" disabled class="form-control" value="<?php if(isset($nomDomaine)) echo $nomDomaine;?>" type="text">
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>spécialités</label>
                                        <input name="nomspe" maxlength="255" required placeholder="Spécialités de l'équipe" class="form-control" type="text">
                                    </div>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-md-12">
                                    <button style="width:20%;" type="submit" class="btn btn-fill btn-info pull-right">Modifier</button>
                                    <button type="button" id="clearBtn" style="width:auto;" class="btn btn-fill btn-danger pull-left ">Réinitialiser</button>
                                </div>
                            </div>
                            
                            <div class="clearfix"></div>
                        </form>  
                              
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/select/bootstrap-select.min.js"></script>
    <!-- Auto fill Javascript -->
    <script src="assets/form-autofill/autofill.js"></script>
    
    <script>
        $(document).ready(function(){
            <?php
                if(isset($display_notif) && $display_notif == true)
                {
                    if($display_type == "success")
                        echo '$.notify({
                            icon : "pe-7s-angle-down-circle",
                            title : "Succès !",
                            message : "Opération de modification effectuée avec succès"
                        },{
                            type : "success",
                            allow_dismiss : true,
                            placement: {
                                from: "top",
                                align: "center"
                            },
                            timer : 2000
                        });';
                    else
                        echo '$.notify({
                            icon : "pe-7s-close-circle",
                            title : "Echoué !",
                            message : "L\'opération de modification a échoué"
                        },{
                            type : "danger",
                            allow_dismiss : true,
                            placement: {
                                from: "top",
                                align: "center"
                            },
                            timer : 5000
                        });';
                }
            ?>

            $("#clearBtn").click(function(){
                $(".form-control").val("");
                $(".selectpicker").selectpicker("refresh");
            });

            init_auteur();

            function init_auteur(){

                $('.form-group .btn-danger').click(function(){
                    var button = $(this);
                    $(".row").has(button).remove();
                });
                $(".selectpicker").selectpicker("refresh");

                $('.btn-info[type="button"]').click(function(){
                    var position = $(this).val();
                    if($('#auteurs > .row').length < 7){
                        position++;
                        $(this).val(position);
                        $(this).before(`<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                    <label>membre</label>
                                    <select required data-live-search="true" class="form-control selectpicker" name="membreproj[]" title="Membre...">
                                    <!--<option value="autre">Autre</option>-->
                                    <?php
                                        $idequipe = $_SESSION['idequipe'];
                                        $idcher = $_SESSION['idcher'];
                                        $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                            SELECT idcher FROM users WHERE actif=1
                                        ) AND (
                                            idcher IN (
                                                SELECT idcher FROM menbrequip WHERE idequipe ='".$idequipe."'
                                            )
                                            OR
                                            idcher IN (
                                                SELECT idcher FROM chefequip WHERE idequipe ='".$idequipe."'
                                            )
                                        ) AND idcher <> '".$idcher."'";
                                        $result = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                                                $nomcher = $row["nom"];
                                                $idcher = $row["idcher"];
                                                echo '<option value="'.$idcher.'">'.$nomcher.'</option>';
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>`);

                        $(".selectpicker").selectpicker("resfresh");

                        /*$('select[name="auteurSelect[]"]').change(function(){
                            var position = $(this).attr("auteur");
                            $('.row:has(input[auteur="'+position+'"])').not(':has(.bootstrap-select)').remove();
                            if($(this).val() == "autre"){
                                $(".bootstrap-select").has(this).after(`<div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <input required auteur="`+position+`" class="form-control" name="auteurInput[]" type="text" placeholder="Nom de l'auteur `+position+`">
                                        </div>
                                    </div>
                                </div>`);
                            }
                        });*/

                        $('.form-group .btn-danger').click(function(){
                            var button = $(this);
                            $(".row").has(button).remove();
                        });
                        $(".selectpicker").selectpicker("refresh");
                    }
                });
            }

        });
    </script>

</html>
