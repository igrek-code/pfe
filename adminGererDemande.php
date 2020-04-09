<?php
    
    require_once("config.php");
    session_start();

    if(!isset($_SESSION['loggedinadmin']) || !$_SESSION['loggedinadmin'])
        {   
            session_destroy();
            header("location: index.php");
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
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!-- DATA TABLE CSS -->
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>

    <!-- J-CONFIRM CSS -->
    <link rel="stylesheet" href="assets/j-confirm/j-confirm.css">
    

    <style>
        #seDeconnecter:hover{
            color:red;
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
                <li class="active">
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
                    <div class="navbar-brand" href="#">Admin</div>
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

        
        


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Demandes en attente (chef de labo)</h4>
                                <p class="category">Accepter/Supprimer</p>      
                            </div>

                            

                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover" id="myTable" >
                                    <thead>
                                        <th>Nom</th>
                                        <th>Profil</th>
                                        <th>Grade</th>
                                        <th>Email</th>
                                        <th>Laboratoire</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                
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


    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <!-- DATA TABLE JS -->
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>

    <!-- J-CONFIRM JS -->
    <script src="assets/j-confirm/j-confirm.js"></script>

    <script>
        $(document).ready(function(){
            
            refresh_table();

            function refresh_table() {
                $.get("ajax/adminGererDemandeAjax.php",{refresh: true},function(data){
                    $("tbody").html(data.slice(2,-1));
                }).done(function(){
                    $('button[title="supprimer"]').click(function(){
                        var idcher = $(this).val();
                        $.confirm({
                            title : "Opération de suppression !",
                            content : "Voulez vous vraiment supprimer cet élément",
                            type : "red",
                            typeAnimated : true,
                            draggable : true,
                            buttons : {
                                supprimer : {
                                    btnClass : 'btn-danger btn-fill',
                                    action : function (){
                                        $.get("ajax/adminGererDemandeAjax.php",{idcher: idcher, action: "supprimer"},function (data) {
                                            if(data == "?>true"){
                                                $.notify({
                                                        icon : "pe-7s-angle-down-circle",
                                                        title : "Succès !",
                                                        message : "Opération de suppression effectuée avec succès"
                                                    },{
                                                        type : "success",
                                                        allow_dismiss : true,
                                                        placement: {
                                                            from: "top",
                                                            align: "center"
                                                        },
                                                        timer : 2000
                                                    });
                                                    refresh_table();
                                            }
                                            else{
                                                $.notify({
                                                    icon : "pe-7s-close-circle",
                                                    title : "Echoué !",
                                                    message : "Opération de suppression a échoué"
                                                },{
                                                    type : "danger",
                                                    allow_dismiss : true,
                                                    placement: {
                                                        from: "top",
                                                        align: "center"
                                                    },
                                                    timer : 5000
                                                });

                                            }
                                        });  
                                    }
                                },
                                retour : {
                                    btnClass : 'btn-secondary',
                                    
                                }
                            }
                        });
                    });

                    $('button[title="accepter"]').click(function(){
                        var idcher = $(this).val();
                        $.confirm({
                            title : "Opération d'ajout !",
                            content : "Voulez vous vraiment accepter cette demande ?",
                            type : "green",
                            typeAnimated : true,
                            draggable : true,
                            buttons : {
                                accepter : {
                                    btnClass : 'btn-success btn-fill',
                                    action : function (){
                                        $.get("ajax/adminGererDemandeAjax.php",{idcher: idcher, action: "accepter"},function (data) {
                                            if(data == "?>true"){
                                                $.notify({
                                                        icon : "pe-7s-angle-down-circle",
                                                        title : "Succès !",
                                                        message : "Opération d'ajout effectuée avec succès"
                                                    },{
                                                        type : "success",
                                                        allow_dismiss : true,
                                                        placement: {
                                                            from: "top",
                                                            align: "center"
                                                        },
                                                        timer : 2000
                                                    });
                                                    refresh_table();
                                            }
                                            else{
                                                $.notify({
                                                    icon : "pe-7s-close-circle",
                                                    title : "Echoué !",
                                                    message : "Opération d'ajout a échoué"
                                                },{
                                                    type : "danger",
                                                    allow_dismiss : true,
                                                    placement: {
                                                        from: "top",
                                                        align: "center"
                                                    },
                                                    timer : 5000
                                                });

                                            }
                                        });  
                                    }
                                },
                                retour : {
                                    btnClass : 'btn-secondary',
                                    
                                }
                            }
                        });
                    });
                });    
            }
            
        });
    </script>

</html>
