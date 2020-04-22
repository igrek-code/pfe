<?php
    require_once("config.php");
    session_start();
    if(!isset($_SESSION['loggedinlabo']) || !$_SESSION['loggedinlabo']){   
        session_destroy();
        header("location: index.php");
    }
    
    $idlabo = $_SESSION["idlabo"];
    $sql = "SELECT * FROM domaine WHERE codeDomaine IN (
        SELECT codeDomaine FROM specialite WHERE idspe IN (
            SELECT idspe FROM laboratoire WHERE idlabo='".$idlabo."'
        )
    )";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $nomDomaine = $row["nom"];
        $codeDomaine = $row["codeDomaine"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $display_notif = true;
        $error = true;
        $nomEquipe = mysqli_real_escape_string($db,$_POST["nomEquipe"]);
        $nomspe = mysqli_real_escape_string($db,$_POST["nomspe"]);
        $sql = "INSERT INTO specialite (codeDomaine,nomspe) VALUES ('".$codeDomaine."','".$nomspe."')";
        if(mysqli_query($db,$sql)){
            $sql = "SELECT * FROM specialite ORDER BY idspe DESC";
            if($result = mysqli_query($db,$sql)){
                $idspe = mysqli_fetch_array($result)["idspe"];
                $sql = "INSERT INTO equipe (nomequip,idspe,idlabo) VALUES ('".$nomEquipe."','".$idspe."','".$idlabo."')";
                if(mysqli_query($db,$sql)) $error = false;
            }
        }

        if(!$error) $display_type = "success";
        else $display_type = "error";
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

            <li>
                    <a href="laboGererDemande.php">
                        <i class="pe-7s-id"></i>
                        <p>Demande inscriptions</p>
                    </a>
                </li>
                <li>
                    <a href="gererProduction.php">
                        <i class="pe-7s-notebook"></i>
                        <p>gerer production</p>
                    </a>
                </li>
                <li>
                    <a href="recherche.php">
                        <i class="pe-7s-search"></i>
                        <p>recherche</p>
                    </a>
                </li>
                <li class="active">
                    <a href="laboGererEquipe.php">
                        <i class="pe-7s-network"></i>
                        <p>Gerer Equipe</p>
                    </a>
                </li>
                <li>
                    <a href="equipeGererMembre.php">
                        <i class="pe-7s-users"></i>
                        <p>Gerer Membre Equipe</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-graph3"></i>
                        <p>Bilan</p>
                    </a>
                </li>

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
                                <p>Se deconnecter</p>
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
                        <h4 class="title">Ajouter Équipe
                        <a id="revenir" href="laboGererEquipe.php" class="pull-right text-muted"><i class="pe-7s-back"></i> liste équipes </a> </h4>
                    </div>

                    <div class="content">
                        <form action="" id="mainForm" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>nom</label>
                                        <input type="text" name="nomEquipe" class="form-control" placeholder="Nom de l'équipe" required>
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
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
                            </div> 

                            <div class="row">
                                <div class="col-md-12">
                                    <button style="width:20%;" type="submit" class="btn btn-fill btn-success pull-right ">Ajouter</button>
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
                            message : "Opération d\'ajout effectuée avec succès"
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
                            message : "Opération d\'ajout a échoué"
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
                $(".form-control").has(':not[name="nomDomaine"]').val("");
                $(".selectpicker").selectpicker("refresh");
            });

        });
    </script>

</html>
