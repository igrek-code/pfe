<?php
    require_once("config.php");
    session_start();
    if(!isset($_SESSION['loggedinadmin']) || !$_SESSION['loggedinadmin']){   
        session_destroy();
        header("location: index.php");
    }
    
    $sql = "SELECT * FROM systemeNotes WHERE id = '1' ";
    if($result = mysqli_query($db,$sql)){
        $row = mysqli_fetch_array($result);
        $revueInterAA = $row["revueInterAA"];
        $revueInterA = $row["revueInterA"];
        $revueInterB = $row["revueInterB"];
        $revueInterC = $row["revueInterC"];
        $revueNat = $row["revueNat"];
        $autre = $row["autre"];
        $comInterA = $row["comInterA"];
        $comInterB = $row["comInterB"];
        $comInterC = $row["comInterC"];
        $comNat = $row["comNat"];
        $chapitreOuvrage = $row["chapitreOuvrage"];
        $ouvrage = $row["ouvrage"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $display_notif = true;
        $error = false;
        if($_POST["revueInterAA"] != $revueInterAA){
            $revueInterAA = mysqli_real_escape_string($db,$_POST["revueInterAA"]);
            $sql = "UPDATE systemeNotes SET revueInterAA='".$revueInterAA."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["revueInterA"] != $revueInterA){
            $revueInterA = mysqli_real_escape_string($db,$_POST["revueInterA"]);
            $sql = "UPDATE systemeNotes SET revueInterA='".$revueInterA."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["revueInterB"] != $revueInterB){
            $revueInterB = mysqli_real_escape_string($db,$_POST["revueInterB"]);
            $sql = "UPDATE systemeNotes SET revueInterB='".$revueInterB."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["revueInterC"] != $revueInterC){
            $revueInterC = mysqli_real_escape_string($db,$_POST["revueInterC"]);
            $sql = "UPDATE systemeNotes SET revueInterC='".$revueInterC."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["revueNat"] != $revueNat){
            $revueNat = mysqli_real_escape_string($db,$_POST["revueNat"]);
            $sql = "UPDATE systemeNotes SET revueNat='".$revueNat."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["autre"] != $autre){
            $autre = mysqli_real_escape_string($db,$_POST["autre"]);
            $sql = "UPDATE systemeNotes SET autre='".$autre."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["comInterA"] != $comInterA){
            $comInterA = mysqli_real_escape_string($db,$_POST["comInterA"]);
            $sql = "UPDATE systemeNotes SET comInterA='".$comInterA."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["comInterB"] != $comInterB){
            $comInterB = mysqli_real_escape_string($db,$_POST["comInterB"]);
            $sql = "UPDATE systemeNotes SET comInterB='".$comInterB."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["comInterC"] != $comInterC){
            $comInterC = mysqli_real_escape_string($db,$_POST["comInterC"]);
            $sql = "UPDATE systemeNotes SET comInterC='".$comInterC."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["comNat"] != $comNat){
            $comNat = mysqli_real_escape_string($db,$_POST["comNat"]);
            $sql = "UPDATE systemeNotes SET comNat='".$comNat."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["ouvrage"] != $ouvrage){
            $ouvrage = mysqli_real_escape_string($db,$_POST["ouvrage"]);
            $sql = "UPDATE systemeNotes SET ouvrage='".$ouvrage."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["chapitreOuvrage"] != $chapitreOuvrage){
            $chapitreOuvrage = mysqli_real_escape_string($db,$_POST["chapitreOuvrage"]);
            $sql = "UPDATE systemeNotes SET chapitreOuvrage='".$chapitreOuvrage."'WHERE id='1'";
            if(!mysqli_query($db,$sql)) $error = true;
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

	<title>MySite</title>

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
        .inline-label { 
            white-space: nowrap;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            float:left;     
        }
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
                    <a href="adminGererDemande.php">
                        <i class="pe-7s-id"></i>
                        <p>Demande inscriptions</p>
                    </a>
                </li>
                <li>
                    <a href="adminGererEtab.php">
                        <i class="pe-7s-culture"></i>
                        <p>Gerer Etablissement</p>
                    </a>
                </li>
                <li>
                    <a href="adminGererLabo.php">
                        <i class="pe-7s-science"></i>
                        <p>Gerer Laboratoire</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="pe-7s-users"></i>
                        <p>Gerer Compte</p>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-news-paper"></i>
                        <p>Fixer Notation</p>
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
                    <div class="navbar-brand" >Admin</div>
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
                            <a href="adminCompte.php">
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
                        <h4 class="title">Modifier Notes
                        <a id="revenir" href="adminGererDemande.php" class="pull-right text-muted"><i class="pe-7s-back"></i> page d'acceuil </a> </h4>
                    </div>

                    <div class="content">
                        <form action="" id="mainForm" method="post">
                            <p class="category">Revue Internationelle</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="inline-label">classe A*</label>
                                        <input onClick="this.select();" value="<?php echo $revueInterAA;?>" class="form-control" type="text" name="revueInterAA" required>
                                    </div>  
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="inline-label">classe A</label>
                                        <input onClick="this.select();" value="<?php echo $revueInterA;?>" class="form-control" type="text" name="revueInterA" required>
                                    </div>  
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="inline-label">classe b</label>
                                        <input onClick="this.select();" value="<?php echo $revueInterB;?>" class="form-control" type="text" name="revueInterB" required>
                                    </div>  
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="inline-label">classe C</label>
                                        <input onClick="this.select();" value="<?php echo $revueInterC;?>" class="form-control" type="text" name="revueInterC" required>
                                    </div>  
                                </div>
                            </div>

                            

                            <p class="category">Revue nationalle</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input onClick="this.select();" value="<?php echo $revueNat;?>" class="form-control" type="text" name="revueNat" required>
                                    </div>  
                                </div>
                            </div>

                            <div style="background:grey;width:100%;height:1px;margin-bottom:5px;"></div>

                            <p class="category">Communication internationalle</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="inline-label">classe a</label>
                                        <input onClick="this.select();" value="<?php echo $comInterA;?>" class="form-control" type="text" name="comInterA" required>
                                    </div>  
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="inline-label">classe b</label>
                                        <input onClick="this.select();" value="<?php echo $comInterB;?>" class="form-control" type="text" name="comInterB" required>
                                    </div>  
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="inline-label">classe c</label>
                                        <input onClick="this.select();" value="<?php echo $comInterC;?>" class="form-control" type="text" name="comInterC" required>
                                    </div>  
                                </div>
                            </div>

                            <p class="category">Communication nationalle</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input onClick="this.select();" value="<?php echo $comNat;?>" class="form-control" type="text" name="comNat" required>
                                    </div>  
                                </div>
                            </div>

                            <div style="background:grey;width:100%;height:1px;margin-bottom:5px;"></div>

                            <p class="category">Ouvrage</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="inline-label">complet</label>
                                        <input onClick="this.select();" value="<?php echo $ouvrage;?>" class="form-control" type="text" name="ouvrage" required>
                                    </div>  
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="inline-label">chapitre</label>
                                        <input onClick="this.select();" value="<?php echo $chapitreOuvrage;?>" class="form-control" type="text" name="chapitreOuvrage" required>
                                    </div>  
                                </div>
                            </div>

                            <div style="background:grey;width:100%;height:1px;margin-bottom:5px;"></div>

                            <p class="category">Autre</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <input onClick="this.select();" value="<?php echo $autre;?>" class="form-control" type="text" name="autre" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button style="width:20%;" type="submit" class="btn btn-fill btn-info pull-right ">Modifier</button>
                                    <button id="clearBtn" style="width:auto;" class="btn btn-fill btn-danger pull-left ">Réinitialiser</button>
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
                            message : "Opération de modification a échoué"
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
            });

        });
    </script>

</html>
