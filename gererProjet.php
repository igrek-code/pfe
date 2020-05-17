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
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!-- J-CONFIRM CSS -->
    <link rel="stylesheet" href="assets/j-confirm/j-confirm.css">
    
    <!-- BOOTSTRAP SELECT CSS -->
    <link rel="stylesheet" href="assets/select/bootstrap-select.min.css">

    <!-- DATA TABLE CSS -->
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="assets/DataTables/fixed-col.css">

    <style>
        th, td { 
            white-space: nowrap;
        }
        #seDeconnecter:hover{
            color:red;
        }
        th, td { 
            white-space: nowrap;
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

        
        


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="padding-bottom:20px;">
                            <div class="header">
                                <h4 class="title">Liste des projets de recherche
                                    <a  class="btn btn-success btn-lg btn-fill pull-right" href="ajouterProjet.php" title="ajouter">+</a>
                                </h4>
                                <p class="category">Ajouter/modifier/supprimer</p>
                            </div>
                            <div id="theTable"></div>
                        </div>
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

    <!-- J-CONFIRM JS -->
    <script src="assets/j-confirm/j-confirm.js"></script>

    <!-- BOOTSTRAP SELECT JS -->
    <script src="assets/select/bootstrap-select.min.js"></script>

    <!-- DATA TABLE JS -->
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script src="assets/DataTables/fixed-cols.js"></script>
    
    <script>
        $(document).ready(function(){
            
            refresh_table();

            function refresh_table(){
                $("#theTable").html("");
                $.get("ajax/gererProjetAjax.php",{refresh: true},function(data){
                    $("#theTable").html(data.slice(2,-1));
                }).done(function(){
                    $("table").dataTable(fr_table());
                    init_buttons();
                });
            }

            function init_buttons(){

                /*$('tbody').on('click', 'button[membre="membre"]',function(){
                    var codeproj = $(this).val();
                    $.confirm({
                        content: function(){
                            var self = this;
                            self.setTitle('Membres du projet');
                            $.get("ajax/gererProjetAjax.php",{codeproj: codeproj},function(data){
                                self.setContent(data.slice(2,-1));
                            });
                        },
                        buttons:{
                            ok: {
                                text: "Fermer",
                                keys: ["enter"]
                            }
                        }
                    });
                });*/

                $('tbody').on('click', 'button[codeproj="codeproj"]',function(){
                    var codeproj = $(this).val();
                    $.confirm({
                        content: function(){
                            var self = this;
                            self.setTitle('Informations supplémentaires sur le projet');
                            $.get("ajax/gererProjetAjax.php",{codeproj: codeproj},function(data){
                                self.setContent(data.slice(2,-1));
                            });
                        },
                        buttons:{
                            ok: {
                                text: "Fermer",
                                keys: ["enter"]
                            }
                        }
                    });
                });

                $('tbody').on('click', 'button[title="supprimer"]', function(){
                    var val = $(this).val();
                    $.confirm({
                        title : "Opération de suppression !",
                        content : "Voulez-vous vraiment supprimer cet élément ?",
                        type : "red",
                        typeAnimated : true,
                        draggable : true,
                        buttons : {
                            supprimer : {
                                btnClass : 'btn-danger btn-fill',
                                action : function (){
                                    $.get("ajax/gererProjetAjax.php",{supprimer: val},function (data) {
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
            }

            function fr_table (){
                return {
                    //"scrollY" : "500px",
                    //"scrollCollapse": true,
                    "scrollX": true,
                    "columnDefs": [
                        {targets: -1, orderable: false, "width": "105px"}
                    ],
                    "language" : {
                        "sEmptyTable":     "Aucune donnée disponible dans le tableau",
                        "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                        "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
                        "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
                        "sInfoPostFix":    "",
                        "sInfoThousands":  ",",
                        "sLengthMenu":     "Afficher _MENU_ éléments",
                        "sLoadingRecords": "Chargement...",
                        "sProcessing":     "Traitement...",
                        "sSearch":         "Rechercher :",
                        "sZeroRecords":    "Aucun élément correspondant trouvé",
                        "oPaginate": {
                            "sFirst":    "Premier",
                            "sLast":     "Dernier",
                            "sNext":     "Suivant",
                            "sPrevious": "Précédent"
                        },
                        "oAria": {
                            "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                            "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
                        },
                        "select": {
                                "rows": {
                                    "_": "%d lignes sélectionnées",
                                    "0": "Aucune ligne sélectionnée",
                                    "1": "1 ligne sélectionnée"
                                } 
                        }
                    }

                };
            }

        });
    </script>

</html>
