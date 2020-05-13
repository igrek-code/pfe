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
            $error = true;
    
            $oldmail = mysqli_real_escape_string($db,$_SESSION["mail"]);
            $newmail = mysqli_real_escape_string($db,$_POST["mailCompte"]);
            $pwd = mysqli_real_escape_string($db,$_POST["mdpCompte"]);
            $newpwd = mysqli_real_escape_string($db,$_POST["mdpCompteNv"]);
            $newpwdconf = mysqli_real_escape_string($db,$_POST["mdpCompteNvConf"]);
    
            $sql = "SELECT * FROM admin WHERE login='".$oldmail."'";
            if($result = mysqli_query($db,$sql)){
                $row = mysqli_fetch_array($result);
                if($row["password"] == $_POST["mdpCompte"]){
                    $error = false;
                    if($newpwd!=""){
                        if($newpwd == $newpwdconf){
                            $sql = "UPDATE admin SET password='".$newpwd."' WHERE login ='".$oldmail."'";
                            if(!mysqli_query($db,$sql)) $error = true;
                        }else $error = true;
                    }
                    if($oldmail != $newmail && !$error){
                        $sql = "UPDATE admin SET login='".$newmail."' WHERE login ='".$oldmail."'";
                        if(!mysqli_query($db,$sql)) $error = true;
                    }
                    
                }
            }
            if($error) $display_type = "error";
            else{
                $_SESSION["loggedinadmin"] = false;
                header("location: index.php");
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
                        <a id="revenir" href="adminGererDemande.php" class="pull-right text-muted"><i class="pe-7s-back"></i> page d'accueil </a> </h4>
                    </div>

                    <div class="content">
                        <form action="" id="mainForm" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nom d'utilisateur</label>
                                        <input value="<?php echo $_SESSION["mail"];?>" type="text" name="mailCompte" class="form-control" placeholder="Votre Nom d'utilisateur" required>
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
            });

            $('input[name="mdpCompteNvConf"]').keyup(function(){
                if($('input[name="mdpCompteNv"]').val()!=$(this).val())
                    $("#msgConfMdp").prop("hidden",false);
                else
                    $("#msgConfMdp").prop("hidden",true);
            });  

            $('input[name="mdpCompteNv"]').keyup(function(){
                if($(this).val() != "") $('input[name="mdpCompteNvConf"]').prop("required",true);
                else $('input[name="mdpCompteNvConf"]').prop("required",false);
            });
        });
    </script>

</html>
