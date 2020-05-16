<?php
    require_once("config.php");
    session_start();
    
    $session = false;
    if(isset($_SESSION['loggedinlabo']) && $_SESSION['loggedinlabo']) $session = true;
    if(isset($_SESSION['loggedinequipe']) && $_SESSION['loggedinequipe']) $session = true;
    if(isset($_SESSION['loggedinchercheur']) && $_SESSION['loggedinchercheur']) $session = true;
    if(!$session){
        session_destroy();
        header("location: index.php");
    }
    $idcher = $_SESSION["idcher"];
    $sql = "SELECT * FROM chercheur WHERE idcher ='".$idcher."'";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $nomcher = $row["nom"];
        $mailcher = $row["mail"];
        $gradecher = $row["grade"];
        $gradecherC = $row["gradeC"];
        $profilcher = $row["profil"];
    }
    $sql = "SELECT * FROM users WHERE idcher='".$idcher."'";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) > 0) $pwd = mysqli_fetch_array($result)["password"];
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $display_notif = true;
        $error = false;
        if(isset($_POST["mdpCompte"]) && isset($pwd) && $_POST["mdpCompte"] != "" && $_POST["mdpCompte"] == $pwd){
            if(isset($_POST["mailcher"]) && $_POST["mailcher"] != ""){
                $mailcher = mysqli_real_escape_string($db,$_POST["mailcher"]);
                $sql = "UPDATE users SET mail='".$mailcher."' WHERE idcher='".$idcher."'";
                if(!mysqli_query($db,$sql)) $error = true;
                $sql = "UPDATE chercheur SET mail='".$mailcher."' WHERE idcher='".$idcher."'";
                if(!mysqli_query($db,$sql)) $error = true;
            }
            if(isset($_POST["nomcher"]) && $_POST["nomcher"] != ""){
                $nomcher = mysqli_real_escape_string($db,$_POST["nomcher"]);
                $_SESSION["nom"] = $nomcher;
                $sql = "UPDATE chercheur SET nom='".$nomcher."' WHERE idcher='".$idcher."'";
                if(!mysqli_query($db,$sql)) $error = true;
                else $_SESSION["nom"] = $nomcher;
            }
            if(isset($_POST["gradecher"]) && $_POST["gradecher"] != ""){
                $gradecher = mysqli_real_escape_string($db,$_POST["gradecher"]);
                $sql = "UPDATE chercheur SET grade='".$gradecher."' WHERE idcher='".$idcher."'";
                if(!mysqli_query($db,$sql)) $error = true;
            }
            if(isset($_POST["gradecherC"]) && $_POST["gradecherC"] != ""){
                $gradecherC = mysqli_real_escape_string($db,$_POST["gradecherC"]);
                $sql = "UPDATE chercheur SET gradeC='".$gradecherC."' WHERE idcher='".$idcher."'";
                if(!mysqli_query($db,$sql)) $error = true;
                else {
                    if($gradecherC == 'Directeur de recherche')
                        $_SESSION['ddr'] = true;
                    else
                        unset($_SESSION['ddr']);
                }
            }
            if(isset($_POST["profilcher"]) && $_POST["profilcher"] != ""){
                $profilcher = mysqli_real_escape_string($db,$_POST["profilcher"]);
                $sql = "UPDATE chercheur SET profil='".$profilcher."' WHERE idcher='".$idcher."'";
                if(!mysqli_query($db,$sql)) $error = true;
            }
            if(isset($_POST["mdpCompteNv"]) && isset($_POST["mdpCompteNvConf"]) && $_POST["mdpCompteNvConf"] != "" && $_POST["mdpCompteNvConf"] == $_POST["mdpCompteNv"]){
                $newpwd = mysqli_real_escape_string($db,$_POST["mdpCompteNv"]);
                $sql = "UPDATE users SET password='".$newpwd."' WHERE idcher='".$idcher."'";
                if(!mysqli_query($db,$sql)) $error = true;
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
                <?php 
                    require_once("menu.php");
                    menu(-1);
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
                            <a style="color:#1DC7EA;" href="adminCompte.php">
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
                        <h4 class="title">Modifier mon compte
                        <a id="revenir" href="<?php if(isset($_SESSION["loggedinchercheur"])) echo "gererProduction.php"; else echo "laboGererDemande.php";?>" class="pull-right text-muted"><i class="pe-7s-back"></i> page d'accueil </a> </h4>
                    </div>

                    <div class="content">
                        <form action="" id="mainForm" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input value="<?php echo $mailcher;?>" type="text" name="mailcher" class="form-control" placeholder="Votre email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>nom</label>
                                        <input value="<?php echo $nomcher;?>" type="text" name="nomcher" class="form-control" placeholder="Votre nom" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="top:30px;">
                                    <div class="form-check form-check-inline">
                                        <input required class="form-check-input" type="radio" name="profilcher" <?php if($profilcher == "permanent") echo 'checked';?> value="permanent">
                                        <label class="form-check-label">Permanent</label>
                                        <input required style="margin-left:10px;" class="form-check-input" <?php if($profilcher == "doctorant") echo 'checked';?> type="radio" name="profilcher" value="doctorant">
                                        <label class="form-check-label">Doctorant</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>grade</label>
                                        <select required class="form-control selectpicker" name="gradecher" id="gradecher">
                                            <option <?php if($gradecher == "DOC") echo 'selected';?> value="DOC">Doc.</option>
                                            <option <?php if($gradecher == "MAB") echo 'selected';?> value="MAB">MAB</option>
                                            <option <?php if($gradecher == "MAA") echo 'selected';?> value="MAA">MAA</option>
                                            <option <?php if($gradecher == "MCB") echo 'selected';?> value="MCB">MCB</option>
                                            <option <?php if($gradecher == "MCA") echo 'selected';?> value="MCA">MCA</option>
                                            <option <?php if($gradecher == "PROF") echo 'selected';?> value="PROF">PROF.</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>grade C</label>
                                    <select required class="form-control selectpicker" name="gradecherC" id="gradecherC">
                                        <option <?php if($gradecherC == "Directeur de recherche") echo 'selected';?> >Directeur de recherche</option>
                                        <option <?php if($gradecherC == "Maitre de recherche") echo 'selected';?> >Maitre de recherche</option>
                                        <option <?php if($gradecherC == "Chargé de recherche") echo 'selected';?> >Chargé de recherche</option>
                                        <option <?php if($gradecherC == "Attaché de recherche") echo 'selected';?> >Attaché de recherche</option>
                                        <option <?php if($gradecherC == "Docteur") echo 'selected';?> >Docteur</option>
                                        <option <?php if($gradecherC == "Doctorant") echo 'selected';?> >Doctorant</option>
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>mot de passe (actuel)</label>
                                        <input  type="password" name="mdpCompte" class="form-control" placeholder="Mote de passe actuel (obligatoire)" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nouveau mot de passe (optionnel)</label>
                                        <input  type="password" name="mdpCompteNv" class="form-control" placeholder="Nouveau mot de passe (optionnel)" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Confirmer nouveau mot de passe</label>
                                        <input type="password" name="mdpCompteNvConf" class="form-control" placeholder="Confirmer nouveau mot de passe">
                                    </div>
                                    <div id="msgConfMdp" style="color:red;" hidden>Veuillez saisir le même mot de passe !</div>
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
                $(".selectpicker").selectpicker("refresh");
                $(".form-check-input").prop("checked",false);
            });
            
            $('input[name="mdpCompteNv"]').keyup(function(){
                if($(this).val() != "") $('input[name="mdpCompteNvConf"]').prop("required",true);
                else $('input[name="mdpCompteNvConf"]').prop("required",false);
            });

            $('input[name="mdpCompteNvConf"]').keyup(function(){
                if($('input[name="mdpCompteNv"]').val()!=$(this).val())
                    $("#msgConfMdp").prop("hidden",false);
                else
                    $("#msgConfMdp").prop("hidden",true);
            });

        });
    </script>

</html>