<?php
    require_once("config.php");
    session_start();
    if(!isset($_SESSION['loggedinadmin']) || !$_SESSION['loggedinadmin'])
        {   
            session_destroy();
            header("location: index.php");
        }
    
    if(isset($_GET["modifier"]) && $_GET["modifier"] != ""){
        $idlabo = mysqli_real_escape_string($db,$_GET["modifier"]);
        $sql = "SELECT * FROM laboratoire WHERE idlabo='".$idlabo."'";
        if($result = mysqli_query($db,$sql)){
            if($row = mysqli_fetch_array($result)){
                $nomLabo = $row["nom"];
                $abrvLabo = $row["abrv"];
                $adresseLabo = $row["addresse"];
                $anneecreaLabo = $row["anneecrea"];
                $telLabo = $row["tel"];
                $etatLabo = $row["etat"];
                $idetabLabo = $row["idetab"];
                $structureLabo = $row["structure"];
                $faxLabo = $row["fax"];
                $mailLabo = $row["mail"];
                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                    SELECT idcher FROM cheflabo WHERE idlabo ='".$idlabo."'
                ) AND idcher IN (
                    SELECT idcher FROM users
                )";
                if($result = mysqli_query($db,$sql)){
                    if($row = mysqli_fetch_array($result)){
                        $idChef = $row["idcher"];
                    }
                }
            }
        }
    }
    else header("location: adminGererEtab.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $display_notif = true;
        $error = false;
        if($_POST["idetab"] != $idetabLabo){
            $idetabLabo = mysqli_real_escape_string($db,$_POST["idetab"]);
            $sql = "UPDATE laboratoire SET idetab='".$idetabLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["structure"] != $structureLabo){
            $structureLabo = mysqli_real_escape_string($db,$_POST["structure"]);
            $sql = "UPDATE laboratoire SET structure='".$structureLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        }

        if($_POST["nomLabo"] != $nomLabo){
            $nomLabo = mysqli_real_escape_string($db,$_POST["nomLabo"]);
            $sql = "UPDATE laboratoire SET nom='".$nomLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if($_POST["abrvLabo"] != $abrvLabo){
            $abrvLabo = mysqli_real_escape_string($db,$_POST["abrvLabo"]);
            $sql = "UPDATE laboratoire SET abrv='".$abrvLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if($_POST["anneecrea"] != $anneecreaLabo){
            $anneecreaLabo = mysqli_real_escape_string($db,$_POST["anneecrea"]);
            $sql = "UPDATE laboratoire SET anneecrea='".$anneecreaLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if($_POST["etatLabo"] != $etatLabo){
            $etatLabo = mysqli_real_escape_string($db,$_POST["etatLabo"]);
            $sql = "UPDATE laboratoire SET etat='".$etatLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if($_POST["mailLabo"] != $mailLabo){
            $mailLabo = mysqli_real_escape_string($db,$_POST["mailLabo"]);
            $sql = "UPDATE laboratoire SET mail='".$mailLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if($_POST["adresseLabo"] != $adresseLabo){
            $adresseLabo = mysqli_real_escape_string($db,$_POST["adresseLabo"]);
            $sql = "UPDATE laboratoire SET addresse='".$adresseLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if($_POST["telLabo"] != $telLabo){
            $telLabo = mysqli_real_escape_string($db,$_POST["telLabo"]);
            $sql = "UPDATE laboratoire SET tel='".$telLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if($_POST["faxLabo"] != $faxLabo){
            $faxLabo = mysqli_real_escape_string($db,$_POST["faxLabo"]);
            $sql = "UPDATE laboratoire SET fax='".$faxLabo."'WHERE idlabo='".$idlabo."'";
            if(!mysqli_query($db,$sql)) $error = true;
        } 

        if(isset($_POST["idcher"]) && isset($idChef)){
            $newidChef = mysqli_real_escape_string($db,$_POST["idcher"]);
            $sql = "UPDATE cheflabo SET idcher='".$newidChef."' WHERE idcher='".$idChef."'";
            if(!mysqli_query($db,$sql)) $error = true;
        }else {
            if(isset($_POST["idcher"]) && $_POST["idcher"] != "" && !isset($idChef)){
                $newidChef = mysqli_real_escape_string($db,$_POST["idcher"]);
                $sql = "INSERT INTO cheflabo VALUES(idlabo,idcher) ('".$idlabo."','".$newidChef."')";
                if(!mysqli_query($db,$sql)) $error = true;
            } 
        }
        
        $sql = "DELETE FROM specialitelabo WHERE idlabo='".$idlabo."'";
        if(mysqli_query($db,$sql)){
            for($i = 0 ; $i < count($_POST["idspe"]) ; $i++){
                $idspe = mysqli_real_escape_string($db,$_POST["idspe"][$i]);
                $sql = "INSERT INTO specialitelabo (idspe,idlabo) VALUES ('".$idspe."','".$idlabo."')";
                if(!mysqli_query($db,$sql)){
                    $error = true;
                    break;
                }
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
                        <h4 class="title">Modifier Laboratoire 
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
                                                    if($idetab == $idetabLabo)
                                                        echo '<option selected value="'.$idetab.'">'.$nometab.'</option>';
                                                    else 
                                                        echo '<option selected value="'.$idetab.'">'.$nometab.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>structure</label>
                                        <input type="text" value ="<?php echo $structureLabo;?>" name="structure" class="form-control" placeholder="Structure d'affiliation">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>nom</label>
                                        <input required value ="<?php echo $nomLabo;?>" class="form-control" type="text" name="nomLabo" placeholder="Nom du laboratoire">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>abreviation</label>
                                        <input value ="<?php echo $abrvLabo;?>" class="form-control" type="text" name="abrvLabo" placeholder="Abréviation du laboratoire">
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>année de création</label>
                                        <input value ="<?php echo $anneecreaLabo;?>" class="form-control" type="text" name="anneecrea" placeholder="Année de création du labo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>état</label>
                                        <select class="form-control selectpicker" name="etatLabo" id="etatLabo" title="état..." required>
                                            <?php
                                                switch ($etatLabo) {
                                                    case 'actif':
                                                        echo '<option selected value="actif">Actif</option>';
                                                        echo '<option  value="inactif">Inactif</option>';
                                                        break;
                                                    
                                                    default:
                                                        echo '<option value="actif">Actif</option>';
                                                        echo '<option selected  value="inactif">Inactif</option>';
                                                        break;
                                                }
                                            ?>  
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>email</label>
                                        <input value ="<?php echo $mailLabo;?>" type="text" class="form-control" name="mailLabo" placeholder="Email du laboratoire">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Adresse</label>
                                        <input value ="<?php echo $adresseLabo;?>" class="form-control" type="text" name="adresseLabo" placeholder="Adresse du laboratoire">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>tél. laboratoire</label>
                                        <input value ="<?php echo $telLabo;?>" class="form-control" type="text" name="telLabo" placeholder="Numéro téléphone labo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">fax. laboratoire</label>
                                        <input value ="<?php echo $faxLabo;?>" class="form-control" type="text" name="faxLabo" placeholder="fax laboratoire">
                                    </div>
                                </div>
                            </div>   

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>domaine</label>
                                        <select class="selectpicker form-control" data-live-search="true" name="codeDomaine" title="Domaine..." id="codeDomaine" multiple>
                                             <?php
                                                $sql = "SELECT * from domaine";
                                                if($result = mysqli_query($db,$sql)){
                                                    $sql = "SELECT * FROM specialite WHERE idspe IN (
                                                        SELECT idspe FROM specialitelabo WHERE idlabo ='".$idlabo."'
                                                    )";
                                                    if($result2 = mysqli_query($db,$sql)){
                                                        $domaines = array();
                                                        while($domaines[] = mysqli_fetch_array($result2)["codeDomaine"]);
                                                        while($row = mysqli_fetch_array($result)){
                                                            $nomDomaine = $row["nom"];
                                                            $codeDomaine = $row["codeDomaine"];
                                                            $sameDomaine = false;
                                                            foreach ($domaines as $domaine) {
                                                                if($domaine == $codeDomaine){
                                                                    $sameDomaine = true;
                                                                    break;
                                                                }
                                                            }
                                                            if($sameDomaine)
                                                                echo '<option selected value="'.$codeDomaine.'">'.$nomDomaine.'</option>';
                                                            else   
                                                                echo '<option value="'.$codeDomaine.'">'.$nomDomaine.'</option>';
                                                        }
                                                    }
                                                }
                                             ?>   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>spécialité</label>
                                       <select multiple class="selectpicker form-control" data-live-search="true" name="idspe[ ]" title="Spécialité..." id="idspe">
                                                
                                        </select>
                                        <!--<input type="text" class="form-control" name="specialiteLabo" placeholder="Spécialité du laboratoire">-->
                                    </div>
                                </div>
                                
                            </div> 
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chef de laboratoire</label>
                                        <select class="form-control selectpicker" name="idcher" id="idcher" data-live-search="true" title="Chef d'équipe...">
                                            <?php
                                                $sql = "SELECT * FROM chercheur WHERE idcher IN (
                                                    SELECT idcher FROM chefequip WHERE idequip IN (
                                                        SELECT idequip FROM equipe WHERE idlabo ='".$idlabo."'
                                                    )
                                                ) AND idcher IN (
                                                    SELECT idcher FROM users WHERE actif='1'
                                                )";
                                                $result = mysqli_query($db,$sql);
                                                if(mysqli_num_rows($result) > 0){
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $idcher =  $row["idcher"]; 
                                                        $nomcher = $row["nom"];
                                                        if($idcher = $idChef)
                                                            echo '<option selected value="'.$idcher.'">.'.$nomcher.'.</option>';
                                                        else
                                                            echo '<option value="'.$idcher.'">.'.$nomcher.'.</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
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
    <!-- SELECT BOOTSTRAP JS -->
    <script src="assets/select/bootstrap-select.min.js"></script>
    
    <script>
        $(document).ready(function(){
            refresh_spe();
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
                    $.get("ajax/adminModifierLaboAjax.php",{all: "all"},function(data){
                        $("#chefLabo").html(data.slice(2,-1));
                        $("#idcher").selectpicker("refresh");
                    });
                }
                else
                    $("#chefLabo").html("");
            });*/

            $("#codeDomaine").change(function(){
                refresh_spe();
            });

            $("#clearBtn").click(function(){
                $(".form-control").val("");
                $(":checkbox").prop("checked",false);
                $(":checkbox").trigger("change");
                $(".selectpicker").selectpicker("refresh");
            });

            function refresh_spe(){
                $("#idspe").html("");
                $("#idspe").selectpicker("resfresh");
                var values = $("#codeDomaine").val();
                for (var i=0;i<values.length;i++) {
                    var nomDomaine = $('#codeDomaine option[value="'+values[i]+'"]').html();
                    var codeDomaine = values[i];
                    $.get("ajax/adminModifierLaboAjax.php",{codeDomaine : codeDomaine, nomDomaine : nomDomaine, idlabo : <?php echo $idlabo;?>},function(data){
                        $("#idspe").html($("#idspe").html()+data); 
                        $("#idspe").selectpicker("refresh");
                    });
                }
            } 
            $("#idcher").has("option").prop("required",true);   

        });
    </script>

</html>
