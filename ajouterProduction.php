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
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once("ajouterProductionFunc.php");
        $display_notif = true;
        $error = false;
        $postedBy = $_SESSION["idcher"];
        $needsValidation = false;
        if(isset($_SESSION['loggedinequipe']) || isset($_SESSION['loggedinchercheur'])) $needsValidation = true;
        if(isset($_POST["typeProduction"]) && $_POST["typeProduction"] != "") 
            switch ($_POST["typeProduction"]) {
                case 'publication':
                    $error = ajouter_publication($db,$needsValidation,$postedBy);
                break;
                
                case 'communication':
                    $error = ajouter_communication($db,$needsValidation,$postedBy);
                break;
                case 'ouvrage':
                    $error = ajouter_ouvrage($db,$needsValidation,$postedBy);
                break;

                case 'chapitreOuvrage':
                    $error = ajouter_chapitreOuvrage($db,$needsValidation,$postedBy);
                break;

                case 'doctorat':
                    $error = ajouter_doctorat($db,$needsValidation,$postedBy);
                break;

                default:
                    $error = ajouter_master($db,$needsValidation,$postedBy);
                break;
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

            <?php require_once("menu.php");
                    if(isset($_SESSION['loggedinlabo'])) menu(2);
                    if(isset($_SESSION['loggedinequipe'])) menu(1);
                    if(isset($_SESSION['loggedinchercheur'])) menu(0);
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
                        <h4 class="title">Ajouter Production
                        <a id="revenir" href="gererProduction.php" class="pull-right text-muted"><i class="pe-7s-back"></i> liste productions </a> </h4>
                    </div>

                    <div class="content">
                        <form action="" id="mainForm" method="post">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="typeProduction">Type production</label>
                                        <select required class="form-control selectpicker" name="typeProduction" id="typeProduction" title="Type de la production...">
                                            <option value="publication">Publication</option>
                                            <option value="communication">Communication</option>
                                            <option value="ouvrage">Ouvrage</option>
                                            <option value="chapitreOuvrage">Chapitre d'ouvrage</option>
                                            <option value="doctorat">Thèse de doctorat</option>
                                            <option value="master">PFE Master</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="saisirInfo">
                                
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
                $(".form-control").val("");
                $(".selectpicker").selectpicker("refresh");
                $("#saisirInfo").html("");
            });

            $("#typeProduction").change(function(){
                $("#saisirInfo").html("");
                var typeProduction = $(this).val();
                $.get("ajax/ajouterProductionAjax.php",{typeProduction: typeProduction},function(data){
                    $("#saisirInfo").html(data.slice(2,-1));
                    $(".selectpicker").selectpicker("refresh");
                    switch (typeProduction) {
                        case 'publication':
                            init_publication();
                        break;

                        case 'communication':
                            init_communication();
                        break;

                        case 'ouvrage':
                            init_ouvrage();
                        break;

                        case 'chapitreOuvrage':
                            init_chapitreOuvrage();
                        break;

                        case 'doctorat':
                            init_doctorat();
                        break;

                        default:
                            init_master();
                        break;
                    }
                });
            });

            function init_publication(){

                init_auteur();

                $("#coderevue").change(function(){
                    $("#infoRevue").html("");
                    var coderevue = $(this).val();
                    if(coderevue == "autre"){
                        $.get("ajax/ajouterProductionAjax.php",{coderevue: coderevue},function(data){
                            $("#infoRevue").html(data.slice(2,-1));
                            init_click_revue();
                            $("#periodiciteRevue").selectpicker("refresh");
                            $('input[name="typeRevue"]').trigger("click");
                        });
                    }
                });

                function init_click_revue(){
                    $('input[name="typeRevue"]').click(function(){
                        var typeRevue = $(this).val();
                        $.get("ajax/ajouterProductionAjax.php",{typeRevue: typeRevue},function(data){
                            $("#infoType").html(data.slice(2,-1));
                            if(typeRevue == "internationale") $("#classeRevue").selectpicker("refresh");
                        });
                    });
                }
            }

            function init_communication(){

                init_auteur();

                $("#codeconf").change(function(){
                    $("#infoConf").html("");
                    var codeconf = $(this).val();
                    if(codeconf == "autre"){
                        $.get("ajax/ajouterProductionAjax.php",{codeconf: codeconf},function(data){
                            $("#infoConf").html(data.slice(2,-1));
                            init_click_conf();
                            $("#periodiciteConf").selectpicker("refresh");
                            $('input[name="typeConf"]').trigger("click");
                        });
                    }
                });

                function init_click_conf(){
                    $('input[name="typeConf"]').click(function(){
                        var typeConf = $(this).val();
                        $.get("ajax/ajouterProductionAjax.php",{typeConf: typeConf},function(data){
                            $("#infoType").html(data.slice(2,-1));
                            if(typeConf == "internationale") $("#classeConf").selectpicker("refresh");
                        });
                    });
                }
            }

            function init_ouvrage(){
                init_auteur();
            }

            function init_chapitreOuvrage(){
                init_auteur();
            }

            function init_doctorat(){
                //nothing
            }

            function init_master(){
                //nothing
            }

            function init_auteur(){
                $("#auteurprinc").change(function(){
                    $('.row').has('input[name="auteurprincInput"]').not(':has(.bootstrap-select)').remove();
                    if($(this).val() == "autre"){
                        $(".bootstrap-select").has(this).after(`<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required class="form-control" name="auteurprincInput" type="text" placeholder="Nom de l'auteur principale">
                                </div>
                            </div>
                        </div>`);
                    }
                    $(".selectpicker").selectpicker("refresh");
                });

                $('.btn-info').click(function(){
                    var position = $(this).val();
                    position++;
                    $(this).val(position);
                    $(this).before(`<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger text-danger" style="margin-bottom:2px;padding:3px;font-size:15px;" >x</button>
                                <label>auteur `+position+`</label>
                                <select required data-live-search="true" class="form-control selectpicker" name="auteurSelect[]" title="Auteur`+position+`" auteur="`+position+`">
                                <option value="autre">Autre</option>
                                <?php
                                    $sql = "SELECT * FROM chercheur";
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

                    $('select[name="auteurSelect[]"]').change(function(){
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
                    });

                    $('.form-group .btn-danger').click(function(){
                        var button = $(this);
                        $(".row").has(button).remove();
                    });
                    $(".selectpicker").selectpicker("refresh");
                    
                });
            }

        });
    </script>

</html>
