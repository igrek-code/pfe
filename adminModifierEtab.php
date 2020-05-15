<?php
    require_once("config.php");
    session_start();
    if(!isset($_SESSION['loggedinadmin']) || !$_SESSION['loggedinadmin'])
        {   
            session_destroy();
            header("location: index.php");
        }
    
    if(isset($_GET["modifier"]) && $_GET["modifier"] != ""){
        $idetab = mysqli_real_escape_string($db,$_GET["modifier"]);
        $sql = "SELECT * FROM etablissement WHERE idetab='".$idetab."'";
        if($result = mysqli_query($db,$sql)){
            $row = mysqli_fetch_array($result);
            $nomEtab = $row["nom"];
            $abrvEtab = $row["abrv"];
            $typeEtab = $row["type"];
            $sitewebEtab = $row["siteweb"];
            $addresseEtab = $row["addresse"];
            $telEtab = $row["tel"];
            $faxEtab = $row["fax"];
        }
    }
    else header("location: adminGererEtab.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $display_notif = true;
        $error = false;
        if($_POST["nomEtab"] != $nomEtab){
            $nomEtab = mysqli_real_escape_string($db,$_POST["nomEtab"]);
            $sql = "UPDATE etablissement SET nom='".$nomEtab."'WHERE idetab='".$idetab."'";
            if(!mysqli_query($db,$sql)) $error = true;
         }
         if($_POST["abrvEtab"] != $abrvEtab){
            $abrvEtab = mysqli_real_escape_string($db,$_POST["abrvEtab"]);
            $sql = "UPDATE etablissement SET abrv='".$abrvEtab."'WHERE idetab='".$idetab."'";
            if(!mysqli_query($db,$sql)) $error = true;
         }
         if($_POST["typeEtab"] != $typeEtab){
            $typeEtab = mysqli_real_escape_string($db,$_POST["typeEtab"]);
            $sql = "UPDATE etablissement SET type='".$typeEtab."'WHERE idetab='".$idetab."'";
            if(!mysqli_query($db,$sql)) $error = true;
         }
         if($_POST["sitewebEtab"] != $sitewebEtab){
            $sitewebEtab = mysqli_real_escape_string($db,$_POST["sitewebEtab"]);
            $sql = "UPDATE etablissement SET siteweb='".$sitewebEtab."'WHERE idetab='".$idetab."'";
            if(!mysqli_query($db,$sql)) $error = true;
         }
         if($_POST["addresseEtab"] != $addresseEtab){
            $addresseEtab = mysqli_real_escape_string($db,$_POST["addresseEtab"]);
            $sql = "UPDATE etablissement SET addresse='".$addresseEtab."'WHERE idetab='".$idetab."'";
            if(!mysqli_query($db,$sql)) $error = true;
         }
         if($_POST["telEtab"] != $telEtab){
            $telEtab = mysqli_real_escape_string($db,$_POST["telEtab"]);
            $sql = "UPDATE etablissement SET tel='".$telEtab."'WHERE idetab='".$idetab."'";
            if(!mysqli_query($db,$sql)) $error = true;
         }
         if($_POST["faxEtab"] != $faxEtab){
            $faxEtab = mysqli_real_escape_string($db,$_POST["faxEtab"]);
            $sql = "UPDATE etablissement SET fax='".$faxEtab."'WHERE idetab='".$idetab."'";
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
        /*.btn-success{
           position : relative;
           margin-left : 25%;
            /*top : 22px;
            left : 60px;
            width : 50%;
        }*/
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
                    require_once('menuAdmin.php');
                    menu(2);
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
                                <p>Se déconnecter</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        
        


        <div style="position:relative; width:80%; left:10%; right:10%;" class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Modifier Établissement
                        <a id="revenir" href="adminGererEtab.php" class="pull-right text-muted"><i class="pe-7s-back"></i> liste des établissements </a> </h4>
                    </div>

                    <div class="content">
                        <form action="" id="mainForm" method="post">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>nom</label>
                                        <input maxlength="255" value="<?php echo $nomEtab;?>" type="text" name="nomEtab" class="form-control" placeholder="Nom de l'établissement" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">abréviation</label>
                                        <input maxlength="20" value="<?php echo $abrvEtab;?>" type="text" name="abrvEtab" class="form-control" placeholder="ex: USTHB">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">type</label>
                                        <select name="typeEtab" id="typeEtab" class="form-control selectpicker" title="Type..." required>
                                            <?php
                                                switch ($typeEtab) {
                                                    case 'université':
                                                        echo '<option value="universite" selected>Université</option>
                                                        <option value="centre de recherche">Centre de recherche</option>';
                                                        break;
                                                    
                                                    default:
                                                        echo '<option value="universite" >Université</option>
                                                        <option value="centre de recherche" selected>Centre de recherche</option>';
                                                        break;
                                                }
                                            ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Site Web</label>
                                        <input maxlength="40" value="<?php echo $sitewebEtab;?>" type="text" name="sitewebEtab"  class="form-control" placeholder="ex: usthb.dz">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">adresse</label>
                                        <input maxlength="255" value="<?php echo $addresseEtab;?>" type="text" name="addresseEtab"  class="form-control" placeholder="Adresse de l'établissement">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tél.</label>
                                        <input maxlength="12" value="<?php echo $telEtab;?>" type="text" name="telEtab"  class="form-control" placeholder="Téléphone de l'établissement">
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">fax.</label>
                                        <input maxlength="12" value="<?php echo $faxEtab;?>" type="text" name="faxEtab"  class="form-control" placeholder="Fax de l'établissement">
                                    </div>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button style="width:20%;" type="submit" class="btn btn-fill btn-info pull-right ">Modifier</button>
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
                $("#typeEtab").selectpicker("refresh");
            });

            $("#etablissement").change(function(){
                var value = $(this).val();
                if(value.length!=0){
                    $.get("ajax/ajouterLaboAjax.php",{term : value},function(data){
                        $("#faculte").html(data);
                        $("#faculte").selectpicker("refresh");
                    });
                }
            });

            $("#faculte").change(function(){
                var value = $(this).val();
                if(value.length!=0){
                    $.get("ajax/ajouterLaboAjax.php",{codeFaculte : value},function(data){
                        $("#domaine").html(data);
                        $("#domaine").selectpicker("refresh");
                    });
                }
            });

            /*$("#domaine").change(function(){
                var value = $(this).val();
                if(value.length!=0){
                    $.get("ajax/ajouterLaboAjax.php",{codeDomaine : value},function(data){
                        $("#specialite").html(data);
                        $("#specialite").selectpicker("refresh");
                    });
                }
            });*/

           /* $("#ajouterChef").click(function(){
                alert("IM IN");
                if($(this).val() === "true"){
                    $("#infoChef").html(<div>HELLLO</div>);
                }else{
                    $("#infoChef").empty();
                }
            });*/

           /* $("#mailChercheur").blur(function(){
                var value = $(this).val();
                if(value.length!=0){
                    $.get("ajax/ajouterLaboAjax.php"),{mailChercheur : value},function(data){
                        autofill(data);
                    }
                }
            })*/
        });
    </script>

</html>
