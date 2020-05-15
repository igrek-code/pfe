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
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Plateforme scientifique</title>

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
        /*  th, td { 
            white-space: nowrap;
        }*/
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
                
            <?php require_once("menu.php");
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type de production</label>
                                            <select class="form-control selectpicker" name="typeProduction" id="typeProduction">
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
                            </div>

                            <div class="header">
                                <h4 class="title">Liste des productions</h4>
                                <p style="padding-left:0px;border:0px;text-decoration:underline;" class="btn category">options de recherche<i class="pe-7s-angle-up"></i></p>
                                <p id="searchInfo" hidden style="margin-bottom:10px;" class="category"></p>
                                <div id="searchBox"></div>
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

            $("p.btn.category").click(function(){
                var next = $(this).next();
                if(next.prop("hidden") == false) {
                    next.prop("hidden",true);
                    $(this).children('i').removeClass("pe-7s-angle-down").addClass("pe-7s-angle-up");
                }
                else {
                    next.prop("hidden",false);
                    $(this).children('i').removeClass("pe-7s-angle-up").addClass("pe-7s-angle-down");
                }
            });

            $("#typeProduction").change(function(){
                $('#searchInfo').html('');
                $('#searchBox').html('');
                var typeProduction = $(this).val();
                $.get("ajax/laboValiderProductionAjax.php",{typeProduction: typeProduction},function(data){
                    $("#theTable").html(data.slice(2,-1));
                    var table = $("table").DataTable(fr_table());
                    $('.dataTables_filter').hide();
                    switch (typeProduction) {
                        case 'publication':
                            init_publication(table);    
                        break;
                        
                        case 'communication':
                            init_communication(table);
                        break;

                        case 'ouvrage':
                            init_ouvrage(table);
                        break;

                        case 'chapitreOuvrage':
                            init_chapitreOuvrage(table);
                        break;

                        case 'doctorat':
                            init_doctorat(table);
                        break;

                        case 'master':
                            init_master(table);
                        break;

                        default:
                        break;
                    }
                    setTimeout(init_action(),100);
                });
            });

            $("#typeProduction").trigger("change");

            function init_ouvrage(table){

                $('#searchInfo').html(`
                    OUVRAGE: <br>
                    -Titre, date, éditeur, nombre de pages, domaine, spécialités, mots-clés, (co)auteurs
                `);

                $('#searchBox').html(`
                <div class="form-group form-inline">
                    <label>Ouvrage: </label>
                    <select id="searchOuv" class="form-control selectpicker" title="Ouvrage...">
                        <option value="titre">Titre</option>
                        <option value="date">Date</option>
                        <option value="editeur">Editeur</option>
                        <option value="nbrepages">Nombre de pages</option>
                        <option value="nomDomaine">Domaine</option>
                        <option value="nomspe">Spécialités</option>
                        <option value="motscle">Mots-clés</option>
                        <option value="auteur">Auteur principal</option>
                        <option value="coauteur">Co-auteurs</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                `);

                $('.selectpicker').selectpicker("refresh");

                $('#searchOuv').change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'titre':
                            column = 7;
                        break;
                        
                        case 'date':
                            column = 8;
                        break;

                        case 'editeur':
                            column = 0;
                        break;

                        case 'nbrepages':
                            column = 1;
                        break;

                        case 'nomDomaine':
                            column = 2;
                        break;

                        case 'nomspe':
                            column = 3;
                        break;

                        case 'motscle':
                            column = 4;
                        break;  

                        case 'auteur':
                            column = 5;
                        break;

                        case 'coauteur':
                            column = 6;
                        break;

                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });

                init_codepro();
                init_cher();
            }

            function init_chapitreOuvrage(table){
                $('#searchInfo').html(`
                    CHAPITRE D'OUVRAGE: <br>
                    -Titre, date, éditeur, pages, volume, domaine, spécialités, mots-clés, (co)auteurs
                `);

                $('#searchBox').html(`
                <div class="form-group form-inline">
                    <label>Chapitre d'ouvrage: </label>
                    <select id="searchOuv" class="form-control selectpicker" title="Chapitre...">
                        <option value="titre">Titre</option>
                        <option value="date">Date</option>
                        <option value="editeur">Editeur</option>
                        <option value="pages">Pages</option>
                        <option value="volume">Volume</option>
                        <option value="nomDomaine">Domaine</option>
                        <option value="nomspe">Spécialités</option>
                        <option value="motscle">Mots-clés</option>
                        <option value="auteur">Auteur principal</option>
                        <option value="coauteur">Co-auteurs</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                `);

                $('.selectpicker').selectpicker("refresh");

                $('#searchOuv').change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'titre':
                            column = 8;
                        break;
                        
                        case 'date':
                            column = 9;
                        break;

                        case 'editeur':
                            column = 0;
                        break;

                        case 'pages':
                            column = 1;
                        break;

                        case 'volume':
                            column = 2;
                        break;

                        case 'nomDomaine':
                            column = 3;
                        break;

                        case 'nomspe':
                            column = 4;
                        break;

                        case 'motscle':
                            column = 5;
                        break;  

                        case 'auteur':
                            column = 6;
                        break;

                        case 'coauteur':
                            column = 7;
                        break;

                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });
                init_codepro();
                init_cher();
            }

            function init_doctorat(table){

                $('#searchInfo').html(`
                    THESE DE DOCTORAT: <br>
                    -Titre, date, n° d'ordre,lieu, domaine, spécialités, mots-clés, encadreur
                `);

                $('#searchBox').html(`
                <div class="form-group form-inline">
                    <label>Thèse de doctorat: </label>
                    <select id="searchOuv" class="form-control selectpicker" title="Thèse...">
                        <option value="titre">Titre</option>
                        <option value="date">Date</option>
                        <option value="nordre">N° d'ordre</option>
                        <option value="lieusout">Lieu</option>
                        <option value="nomDomaine">Domaine</option>
                        <option value="nomspe">Spécialités</option>
                        <option value="motscle">Mots-clés</option>
                        <option value="encadreur">Encadreur</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                `);

                $('.selectpicker').selectpicker("refresh");

                $('#searchOuv').change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'titre':
                            column = 6;
                        break;
                        
                        case 'date':
                            column = 7;
                        break;

                        case 'nordre':
                            column = 0;
                        break;

                        case 'lieusout':
                            column = 1;
                        break;

                        case 'nomDomaine':
                            column = 2;
                        break;

                        case 'nomspe':
                            column = 3;
                        break;

                        case 'motscle':
                            column = 4;
                        break;  

                        case 'encadreur':
                            column = 5;
                        break;

                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });

                init_codepro();
                init_cher();
            }

            function init_master(table){ 

                $('#searchInfo').html(`
                    PFE MASTER: <br>
                    -Titre, date, lieu, domaine, spécialités, mots-clés, encadreur
                `);

                $('#searchBox').html(`
                <div class="form-group form-inline">
                    <label>PFE Master: </label>
                    <select id="searchOuv" class="form-control selectpicker" title="PFE...">
                        <option value="titre">Titre</option>
                        <option value="date">Date</option>
                        <option value="lieusout">Lieu</option>
                        <option value="nomDomaine">Domaine</option>
                        <option value="nomspe">Spécialités</option>
                        <option value="motscle">Mots-clés</option>
                        <option value="encadreur">Encadreur</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                `);

                $('.selectpicker').selectpicker("refresh");

                $('#searchOuv').change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'titre':
                            column = 5;
                        break;
                        
                        case 'date':
                            column = 6;
                        break;

                        case 'lieusout':
                            column = 0;
                        break;

                        case 'nomDomaine':
                            column = 1;
                        break;

                        case 'nomspe':
                            column = 2;
                        break;

                        case 'motscle':
                            column = 3;
                        break;  

                        case 'encadreur':
                            column = 4;
                        break;

                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });

                init_codepro();
                init_cher();
            }

            function init_communication(table){

                $('#searchInfo').html(`
                    COMMUNICATION: <br>
                    -Titre, date, domaine, spécialités, mots-clés, (co)auteurs <br>
                    CONFERENCE: <br>
                    -Nom, abréviation, année, thème, périodicité, type, classe, pays
                `);

                $('#searchBox').html(`
                <div class="form-group form-inline">
                    <label>Communication: </label>
                    <select id="searchCom" class="form-control selectpicker" title="Communication...">
                        <option value="titre">Titre</option>
                        <option value="date">Date</option>
                        <option value="nomDomaine">Domaine</option>
                        <option value="nomspe">Spécialités</option>
                        <option value="motscle">Mots-clés</option>
                        <option value="auteur">Auteur principal</option>
                        <option value="coauteur">Co-auteurs</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group form-inline">
                    <label>Conférence: </label>
                    <select id="searchConf" class="form-control selectpicker" title="Conférence...">
                        <option value="nom">Nom</option>
                        <option value="abrv">Abréviation</option>
                        <option value="annee">Année</option>
                        <option value="theme">Thème</option>
                        <option value="periodicite">Périodicité</option>
                        <option value="type">Type</option>
                        <option value="classe">Classe</option>
                        <option value="pays">Pays</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                `);

                $('.selectpicker').selectpicker("refresh");

                $("#searchConf").change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'nom':
                            column = 14;
                        break;

                        case 'abrv':
                            column = 5;
                        break;

                        case 'annee':
                            column = 6;
                        break;

                        case 'theme':
                            column = 7;
                        break;

                        case 'periodicite':
                            column = 8;
                        break;

                        case 'type':
                            column = 9;
                        break;

                        case 'classe':
                            column = 10;
                        break;

                        case 'pays':
                            column = 11;
                        break;
                    
                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });

                $('#searchCom').change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'titre':
                            column = 12;
                        break;
                        
                        case 'date':
                            column = 13;
                        break;

                        case 'nomDomaine':
                            column = 0;
                        break;

                        case 'nomspe':
                            column = 1;
                        break;

                        case 'motscle':
                            column = 2;
                        break;  

                        case 'auteur':
                            column = 3;
                        break;

                        case 'coauteur':
                            column = 4;
                        break;

                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });

                $('#theTable tbody').on('click', 'button[codeconf="codeconf"]', function(){
                    var codeconf = $(this).val();
                    $.confirm({
                        content: function(){
                            var self = this;
                            self.setTitle("Informations supplémentaires sur la conférence");
                            $.get("ajax/laboValiderProductionAjax.php",{codeconf: codeconf},function(data){
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

                init_codepro();
                init_cher();
            }

            function init_publication(table){

                $('#searchInfo').html(`
                    PUBLICATION: <br>
                    -Titre, date, doi, volume, issue, domaine, spécialités, mots-clés, (co)auteurs <br>
                    REVUE: <br>
                    -Nom, e-issn, issn print, éditeur, année, thème, périodicité, type, classe, pays
                `);

                $('#searchBox').html(`
                <div class="form-group form-inline">
                    <label>Publication: </label>
                    <select id="searchPub" class="form-control selectpicker" title="Publication...">
                        <option value="titre">Titre</option>
                        <option value="date">Date</option>
                        <option value="doi">Doi</option>
                        <option value="volume">Volume</option>
                        <option value="issue">N Issue</option>
                        <option value="nomDomaine">Domaine</option>
                        <option value="nomspe">Spécialités</option>
                        <option value="motscle">Mots-clés</option>
                        <option value="auteur">Auteur principal</option>
                        <option value="coauteur">Co-auteurs</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group form-inline">
                    <label>Revue: </label>
                    <select id="searchRevue" class="form-control selectpicker" title="Revue...">
                        <option value="nom">Nom</option>
                        <option value="eissn">E-ISSN</option>
                        <option value="issnprint">ISSN PRINT</option>
                        <option value="editeur">Editeur</option>
                        <option value="annee">Année</option>
                        <option value="theme">Thème</option>
                        <option value="periodicite">Périodicité</option>
                        <option value="type">Type</option>
                        <option value="classe">Classe</option>
                        <option value="pays">Pays</option>
                    </select>
                    <input class="form-control" type="text">
                </div>
                `);

                $('.selectpicker').selectpicker("refresh");

                $("#searchRevue").change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'nom':
                            column = 19;
                        break;

                        case 'eissn':
                            column = 7;
                        break;

                        case 'issnprint':
                            column = 8;
                        break;

                        case 'editeur':
                            column = 9;
                        break;

                        case 'annee':
                            column = 10;
                        break;

                        case 'theme':
                            column = 11;
                        break;

                        case 'periodicite':
                            column = 6;
                        break;

                        case 'type':
                            column = 14;
                        break;

                        case 'classe':
                            column = 15;
                        break;

                        case 'pays':
                            column = 16;
                        break;
                    
                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });

                $('#searchPub').change(function(){
                    var value = $(this).val();
                    var input = $(this).parent().next();
                    switch (value) {
                        case 'titre':
                            column = 17;
                        break;
                        
                        case 'date':
                            column = 18;
                        break;

                        case 'doi':
                            column = 0;
                        break;

                        case 'volume':
                            column = 1;
                        break;

                        case 'issue':
                            column = 2;
                        break;

                        case 'nomDomaine':
                            column = 12;
                        break;

                        case 'nomspe':
                            column = 13;
                        break;

                        case 'motscle':
                            column = 3;
                        break;  

                        case 'auteur':
                            column = 4;
                        break;

                        case 'coauteur':
                            column = 5;
                        break;

                        default:
                            break;
                    }
                    input.keyup(function(){
                        var data = $(this).val();
                        table.column(column).search(data).draw();
                    });
                });

                $('#theTable tbody').on('click', 'button[coderevue="coderevue"]',function(){
                    var coderevue = $(this).val();
                    $.confirm({
                        content: function(){
                            var self = this;
                            self.setTitle("Informations supplémentaires sur la revue");
                            $.get("ajax/laboValiderProductionAjax.php",{coderevue: coderevue},function(data){
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

                init_codepro();
                init_cher();
            }

            function init_codepro(){
                $('#theTable tbody').on('click', 'button[codepro="codepro"]', function(){
                    var codepro = $(this).val();
                    $.confirm({
                        content: function(){
                            var self = this;
                            self.setTitle("Informations supplémentaires sur la production");
                            $.get("ajax/laboValiderProductionAjax.php",{codepro: codepro},function(data){
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

            }

            function init_cher(){
                $('#theTable tbody').on('click', 'button[postedBy="postedBy"]', function(){
                    var idcher = $(this).val();
                    $.confirm({
                        content: function(){
                            var self = this;
                            self.setTitle("Informations supplémentaires sur le chercheur");
                            $.get("ajax/laboValiderProductionAjax.php",{idcher: idcher},function(data){
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
            }

            function fr_table (){
                var typeProduction = $("#typeProduction").val();
                var columnDefs = [];
                switch (typeProduction) {
                    case 'publication':
                        columnDefs=[
                            {targets: [-1,-3], orderable: false},
                            {targets: Array.from({length: 17}, (x,i) => i), visible: false}
                        ]
                    break;

                    case 'communication':
                        columnDefs=[
                            {targets: [-1,-3], orderable: false},
                            {targets: Array.from({length: 12}, (x,i) => i), visible: false}
                        ]    
                    break;

                    case 'ouvrage':
                        columnDefs=[
                            {targets: [-1,-3], orderable: false},
                            {targets: Array.from({length: 7}, (x,i) => i), visible: false}
                        ]    
                    break;

                    case 'chapitreOuvrage':
                        columnDefs=[
                            {targets: [-1,-3], orderable: false},
                            {targets: Array.from({length: 8}, (x,i) => i), visible: false}
                        ]    
                    break;

                    case 'doctorat':
                        columnDefs=[
                            {targets: [-1,-3], orderable: false},
                            {targets: Array.from({length: 6}, (x,i) => i), visible: false}
                        ]    
                    break;

                    case 'master':
                        columnDefs=[
                            {targets: [-1,-3], orderable: false},
                            {targets: Array.from({length: 5}, (x,i) => i), visible: false}
                        ]    
                    break;

                    default:
                        break;
                }
                return {
                    //"scrollY" : "500px",
                    //"scrollCollapse": true,
                    //"scrollX": true,  
                    "columnDefs": columnDefs,
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

            function init_action(){
                $('.btn-danger').click(function(){
                        var codepro = $(this).val();
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
                                        $.get("ajax/laboValiderProductionAjax.php",{supprimer: codepro},function (data) {
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
                                                    $("#typeProduction").trigger("change");
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

                    $('.btn-success').click(function(){
                        var codepro = $(this).val();
                        $.confirm({
                            title : "Opération de validation !",
                            content : "Voulez-vous vraiment valider cette production ?",
                            type : "green",
                            typeAnimated : true,
                            draggable : true,
                            buttons : {
                                valider : {
                                    btnClass : 'btn-success btn-fill',
                                    action : function (){
                                        $.get("ajax/laboValiderProductionAjax.php",{valider: codepro},function (data) {
                                            if(data == "?>true"){
                                                $.notify({
                                                        icon : "pe-7s-angle-down-circle",
                                                        title : "Succès !",
                                                        message : "Opération de validation effectuée avec succès"
                                                    },{
                                                        type : "success",
                                                        allow_dismiss : true,
                                                        placement: {
                                                            from: "top",
                                                            align: "center"
                                                        },
                                                        timer : 2000
                                                    });
                                                    $("#typeProduction").trigger("change");
                                            }
                                            else{
                                                $.notify({
                                                    icon : "pe-7s-close-circle",
                                                    title : "Echoué !",
                                                    message : "Opération de validation a échoué"
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

        });
    </script>

</html>
