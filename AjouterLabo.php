<?php
    
    require_once("config.php");
    session_start();
    if(!isset($_SESSION['loggedinadmin']) || !$_SESSION['loggedinadmin'])
        {   
            session_destroy();
            header("location: index.php");
        }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $display_notif = true;
        $display_type = "error";
        $idetab = mysqli_real_escape_string($db,$_POST["idetab"]);
        $structure = mysqli_real_escape_string($db,$_POST["structure"]);
        $nomLabo = mysqli_real_escape_string($db,$_POST["nomLabo"]);
        $abrvLabo = mysqli_real_escape_string($db,$_POST["abrvLabo"]);
        $anneecrea = mysqli_real_escape_string($db,$_POST["anneecrea"]);
        $etatLabo = mysqli_real_escape_string($db,$_POST["etatLabo"]);
        $mailLabo = mysqli_real_escape_string($db,$_POST["mailLabo"]);
        $adresseLabo = mysqli_real_escape_string($db,$_POST["adresseLabo"]);
        $telLabo = mysqli_real_escape_string($db,$_POST["telLabo"]);
        $faxLabo = mysqli_real_escape_string($db,$_POST["faxLabo"]);
        
        

        $sql = "INSERT INTO laboratoire (idetab,structure,nom,abrv,anneecrea,etat,mail,addresse,tel,fax) VALUES ('".$idetab."','".$structure."','".$nomLabo."','".$abrvLabo."','".$anneecrea."','".$etatLabo."','".$mailLabo."','".$adresseLabo."','".$telLabo."','".$faxLabo."')";
        if(mysqli_query($db,$sql)){
            $sql = "SELECT * FROM laboratoire ORDER BY idlabo DESC LIMIT 1";
            if($result = mysqli_query($db,$sql)){
                $display_type = "success";
                $idLabo = mysqli_fetch_array($result)["idlabo"];
                foreach ($_POST["idspe"] as $idspe) {
                    $sql = "INSERT INTO specialitelabo (idspe,idlabo) VALUES ('".$idspe."','".$idLabo."')";
                    if(!mysqli_query($db,$sql)) $display_type = "error";
                }
            }
            
            /*if(isset($_POST["idcher"])){

            }*/  
        }
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
    <!-- JCONFIRM CSS -->
    <link rel="stylesheet" href="assets/j-confirm/j-confirm.css">

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
                <li class="active">
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
                <li>
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

        
        


        <div style="position:relative; width:80%; left:10%; right:10%;" class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ajouter Laboratoire 
                            <a id="revenir" href="adminGererLabo.php" class="pull-right text-muted"><i class="pe-7s-back"></i> liste laboratoires </a> 
                        </h4>
                    </div>

                    <div class="content">
                        <form action="" id="mainForm" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>établissement</label>
                                        <select required id="etablissement" name="idetab" class="selectpicker form-control" data-live-search="true" title="Etablissement...">
                                            
                                            <?php
                                                $sql = "SELECT * FROM etablissement";
                                                $result = mysqli_query($db,$sql);
                                                while($row = mysqli_fetch_array($result)){
                                                    $idetab = $row["idetab"];
                                                    $nometab = $row["nom"];
                                                    echo '<option value="'.$idetab.'">'.$nometab.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>structure</label>
                                        <input type="text" name="structure" class="form-control" placeholder="Structure d'affiliation">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>nom</label>
                                        <input required class="form-control" type="text" name="nomLabo" placeholder="Nom du laboratoire">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>abreviation</label>
                                        <input class="form-control" type="text" name="abrvLabo" placeholder="Abréviation du laboratoire">
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>année de création</label>
                                        <input class="form-control" type="text" name="anneecrea" placeholder="Année de création du labo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>état</label>
                                        <select class="form-control selectpicker" name="etatLabo" id="etatLabo" title="état..." required>
                                                <option value="actif">Actif</option>
                                                <option  value="inactif">Inactif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>email</label>
                                        <input type="text" class="form-control" name="mailLabo" placeholder="Email du laboratoire">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Adresse</label>
                                        <input class="form-control" type="text" name="adresseLabo" placeholder="Adresse du laboratoire">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>tél. laboratoire</label>
                                        <input class="form-control" type="text" name="telLabo" placeholder="Numéro téléphone labo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">fax. laboratoire</label>
                                        <input class="form-control" type="text" name="faxLabo" placeholder="fax laboratoire">
                                    </div>
                                </div>
                            </div>   

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>domaine</label>
                                        <select class="selectpicker form-control" data-live-search="true" name="codeDomaine" title="Domaine..." id="codeDomaine" >
                                             <?php
                                                $sql = "SELECT * from domaine";
                                                if($result = mysqli_query($db,$sql)){
                                                    while($row = mysqli_fetch_array($result)){
                                                        $nomDomaine = $row["nom"];
                                                        $codeDomaine = $row["codeDomaine"];
                                                        echo '<option value="'.$codeDomaine.'">'.$nomDomaine.'</option>';
                                                    }
                                                }
                                             ?>   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>spécialité</label>
                                       <select multiple  required class="selectpicker form-control" data-live-search="true" name="idspe[ ]" title="Spécialité..." id="idspe">
                                                
                                        </select>
                                        <!--<input type="text" class="form-control" name="specialiteLabo" placeholder="Spécialité du laboratoire">-->
                                    </div>
                                </div>
                                
                            </div> 
                            
                            <!--<div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="ajouterChef" id="ajouterChef" value="true">
                                        <label style="text-decoration:underline;" class="form-check-label">Assigner un chef de labo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">                   
                                <div class="col-md-6">
                                    <div class="form-group" id="chefLabo">
                                        
                                    </div>
                                </div>
                            </div>-->

                            <div class="row">
                                <div class="col-md-12">
                                    <button style="width:20%;" type="submit" class="btn btn-fill btn-success pull-right ">Ajouter</button>
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
    <!-- JCONFIRM JS -->
    <script src="assets/j-confirm/j-confirm.js"></script>                                            

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

            /*$(":checkbox").change(function(){
                if(this.checked) {
                    $.get("ajax/ajouterLaboAjax.php",{all: "all"},function(data){
                        $("#chefLabo").html(data.slice(2,-1));
                        $("#idcher").selectpicker("refresh");
                    });
                }
                else
                    $("#chefLabo").html("");
            });*/

            $("#codeDomaine").change(function(){
                $("#idspe").html("");
                $("#idspe").selectpicker("refresh");
                var values = $("#codeDomaine").val();
                for (var i=0;i<values.length;i++) {
                    var nomDomaine = $('#codeDomaine option[value="'+values[i]+'"]').html();
                    var codeDomaine = values[i];
                    $.get("ajax/ajouterLaboAjax.php",{codeDomaine : codeDomaine, nomDomaine : nomDomaine},function(data){
                        $("#idspe").html($("#idspe").html()+data); 
                        $("#idspe").selectpicker("refresh");
                    });
                }
            });

            $("#clearBtn").click(function(){
                $(".form-control").val("");
                $(":checkbox").prop("checked",false);
                $(":checkbox").trigger("change");
                $(".selectpicker").selectpicker("refresh");
            });

        });
    </script>

</html>
