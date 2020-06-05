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

    <!-- DATA TABLE CSS -->
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-1.6.2/b-html5-1.6.2/datatables.min.css"/>-->


    <!-- J-CONFIRM CSS -->
    <link rel="stylesheet" href="assets/j-confirm/j-confirm.css">

    <!-- SELECT BOOTSTRAP -->
    <link rel="stylesheet" href="assets/select/bootstrap-select.min.css">
    <!--  Charts Plugin -->
    <link rel="stylesheet" href="assets/css/chartist.min.css">
    
    <style>
        th, td { 
            white-space: nowrap;
        }
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
            <?php
                    require_once('menuAdmin.php');
                    menu(6);
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Bilan</h4>
                                <div style="margin-top:10px;" class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control selectpicker" id="natureBilan">
                                                <option value="activite">Bilan d'activité</option>
                                                <option selected value="projet">Bilan de projet</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 

                                <div id="allFilters">
                                    <div style="margin-top:10px;" class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select title="Type..." class="form-control selectpicker" id="typeBilan">
                                                    <option selected value="chercheur">Chercheur</option>
                                                    <option value="equipe">Equipe</option>
                                                    <option value="laboratoire">Laboratoire</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div id="filters"></div>
                                </div> 
                            </div>

                                
                            <div id="stats" class="content">
                                <div style="margin-bottom:20px;" class="row">
                                    <div class="col-md-12">
                                        <canvas id="graph"></canvas>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <canvas id="pie"></canvas>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card text-center">
                                            <div class="header">
                                                <h4 class="title">Total des points</h4>
                                            </div>
                                            <div class="content">
                                                <div id="notes"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="table"></div>
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

    <!-- BOOTSTRAP SELECT -->
    <script src="assets/select/bootstrap-select.min.js"></script>

    <!-- CHART JS -->
    <script src="assets/chartjs/chartjs.js"></script>
    
    <script>
        $(document).ready(function(){
            
            var color = Chart.helpers.color;
            var colors = ['#f58442','#f542bc','#eb4034','#4287f5','#32a852','#fcba03','#b342f5'];
            var update = false;
            var graph = undefined;
            var pie = undefined;

            $('#natureBilan').change(function(){
                var natureBilan = $(this).val();
                if(natureBilan == 'activite') init_activite();
                else init_projet();
            });

            $('#natureBilan').trigger('change');

            function init_projet(){
                $('#allFilters').html(`
                <div id="filters">
                <div style="" class="row">
                        <div style="margin-top:10px;" class="col-md-6">
                            <div class="form-group">
                                <label>établissement</label>
                                <select data-live-search="true" title="Etablissement..." class="form-control selectpicker" id="idetab">
                                    <?php
                                        $sql = "SELECT * FROM etablissement";
                                        $result = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while ($row = mysqli_fetch_array($result)) {
                                                $idetab = $row['idetab'];
                                                $nom = $row['nom'];
                                                echo '<option value="'.$idetab.'">'.$nom.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div style="" class="row">
                        <div style="margin-top:10px;" class="col-md-3">
                            <div class="form-group">
                                <label>domaine</label>
                                <select data-live-search="true" title="Domaine..." class="form-control selectpicker" id="codeDomaine">
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div style="" class="row">
                        <div style="margin-top:10px;" class="col-md-6">
                            <div class="form-group">
                                <label>Projet (recherche par intitulé ou code)</label>
                                <select data-live-search="true" title="Projet..." class="form-control selectpicker" id="codeproj">
                                    <?php
                                        /*$sql = "SELECT * FROM projrecher";
                                        $result = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while ($row = mysqli_fetch_array($result)) {
                                                $codeproj2 = $row['codeproj'];
                                                $intitule = $row['intitule'];
                                                $date = $row['date'];
                                                $duree = $row['duree'];
                                                echo '<option dateDeb="'.$date.'" duree="'.$duree.'" data-tokens="'.$codeproj2.'" value="'.$codeproj2.'">'.$intitule.'</option>';
                                            }
                                        }*/
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div style="padding-bottom:10px;" class="row">
                        <div style="margin-top:10px;" class="col-md-2">
                            <div class="form-group">
                            <label>Type</label>
                                <select class="form-control selectpicker" id="type">
                                    <option value="equipe">Equipe</option>
                                    <option value="chercheur">Individuel</option>
                                </select>
                            </div>
                        </div>
                        <div id="idcher" style="margin-top:10px;"  class="col-md-4">
                            <div class="form-group">
                                <label>Chercheur</label>
                                <select class="form-control selectpicker" id="idcher">
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div style="padding-bottom:10px;" class="row">
                        <div style="margin-top:10px;" class="col-md-3">
                            <div class="form-group">
                                <label>Période</label>
                                <select title="Période..." class="form-control selectpicker" id="periodeProj">
                                    <option value="annuel">Annuel</option>
                                    <option value="biannuel">Bi-annuel</option>
                                    <option value="final">Final</option>
                                </select>
                            </div>
                        </div>
                        <div id="an" style="margin-top:10px;"  class="col-md-2">
                            <div class="form-group">
                                <label>Année</label>
                                <input class="form-control" id="anneeproj" type="number">
                            </div>
                        </div>
                        <div id="bi" style="margin-top:10px;" class="col-md-3">
                            <div class="form-group">
                                <label>Semstre</label>
                                <select title="Semestre..." class="form-control selectpicker" id="semestreProj">
                                    <option selected value="1">Semestre 1</option>
                                    <option value="2">Semestre 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                `);

                $('#idcher').hide();

                $('#idetab').change(function(){
                    var idetab = $(this).val();
                    $.get('ajax/otherAjax.php',{idetab: idetab},function(data){
                        $('#codeDomaine').html('');
                        $('#codeDomaine').html(data);
                        $('#codeproj').html('');
                        $('.selectpicker').selectpicker('refresh');
                    });
                });

                $('#codeDomaine').change(function(){
                    var nomDomaine = $(this).val();
                    var idetab = $('#idetab').val();
                    $.get('ajax/otherAjax.php',{nomDomaine: nomDomaine, idetab: idetab},function(data){
                        $('#codeproj').html('');
                        $('#codeproj').html(data);
                        $('#codeproj').selectpicker('refresh');
                    });
                });

                $('#bi').hide();
                $('#an').hide();
                $('#stats').hide();

                $('#codeproj').change(function(){
                    var periodeProjet = $('#periodeProj').val();
                    var codeproj = $(this).val();
                    var option = $('option[value="'+codeproj+'"]');

                    $('button[infoproj="infoproj"]').remove();
                    if(codeproj != '') {
                        $('#filters').before(`<button infoproj="infoproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="`+codeproj+`">Plus d'info sur le projet</button>`);
                        $('button[infoproj="infoproj"]').click(function(){
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
                    }
                    var dateDeb = new Date(option.attr('dateDeb'));
                    var date = new Date(dateDeb);
                    var duree = option.attr('duree');
                    dateDeb.setMonth(dateDeb.getMonth()+duree);
                    var dateFin = dateDeb;
                    dateDeb = date;

                    $('#anneeproj').prop('min',dateDeb.getFullYear());
                    $('#anneeproj').prop('max',dateFin.getFullYear());

                    switch (periodeProjet) {
                        case 'final':
                            var month = dateDeb.getMonth();
                            if(month < 10) var deb = dateDeb.getFullYear()+'-0'+month;
                            else var deb = dateDeb.getFullYear()+'-'+month;
                            var month = dateFin.getMonth();
                            if(month < 10) var fin = dateFin.getFullYear()+'-0'+dateFin.getMonth();
                            else var fin = dateFin.getFullYear()+'-'+dateFin.getMonth();
                            var affichage = 'annee';
                        break;
                    
                        case 'biannuel':
                            var affichage = 'mois';
                            var annee = $('#anneeproj').val();
                            var semestre = $('#semestreProj').val();
                            if(semestre == '1') {
                                var deb = annee+'-01';
                                var fin = annee+'-06';
                            }else{
                                var deb = annee+'-07';
                                var fin = annee+'-12';  
                            }
                        break;

                        case 'annuel':
                            var affichage = 'mois';
                            var annee = $('#anneeproj').val();
                            var deb = annee+'-01';
                            var fin = annee+'-12';
                        break;
                    }

                    var format = /^\d{4}[\/\-](0?[1-9]|1[012])$/;
                    var type = $('#type').val();
                    if( codeproj != "" && format.test(deb) && format.test(fin) && type != ''){
                        var input = {export: 'false', codeproj: codeproj, deb: deb, fin: fin, typeProduction: 'all'};
                        if(type == 'chercheur') {
                            var idcher = $('select[id="idcher"]').val();
                            input = {idcher: idcher, export: 'false', codeproj: codeproj, deb: deb, fin: fin, typeProduction: 'all'};
                        }
                        $.get("ajax/bilanAjax.php",input,function(data){
                            var productions = JSON.parse(data.slice(2,-1)+"]");
                            graph = drawChart(productions,deb,fin,affichage,graph,update,'all');
                            pie = drawPie(productions,pie,update,'all');
                            getPoints(productions,'all');
                            update = true;
                            $('#table').html('');
                            $('#table').html(`
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="header">
                                        <h4 class="title">Liste des productions</h4>
                                    </div>

                                    <div class="content">
                                    <p><button type="button" class="btn btn-info" style="border:0px;font-size:16px;" exporter="exporter">Exporter</button></p>
                                        <table id="showTable" class="table table-hover">
                                            <thead>
                                                <th>Titre</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Projet</th>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            `);
                            productions.forEach(production => {
                                if(production.codeproj == undefined) production.codeproj = '';
                                $('tbody').append(`
                                    <tr>
                                    <td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codepro}">${production.titre}</button></td>
                                    <td>${production.date}</td>
                                    <td>${production.type}</td>
                                    <td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codeproj}">${production.codeproj}</button></td>
                                    </tr>
                                `);                    
                            });
                            $('#showTable').DataTable(fr_table())
                            init_codepro();
                            $('button[exporter="exporter"]').click(function(){
                                var exporter = $(this);
                                $.get("ajax/bilanAjax.php",{export: 'true', bilancher: idcher, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                                    if($('a[download="production"]').length == 0)
                                        exporter.after(` =>  <a download="production" target="_blank" href="ajax/tempo/productions.xlsx">Télécharger</a>`);
                                });
                            });
                        });

                        $('#stats').show();
                    }
                    else{
                        $('#stats').hide();
                    }
                });

                $('select[id="idcher"]').change(function(){
                    $('#codeproj').trigger('change');
                });

                $('#type').change(function(){
                    var type = $(this).val();
                    var codeproj = $('#codeproj').val();
                    if(type == 'chercheur'){
                        $.get('ajax/otherAjax.php',{codeproj: codeproj},function(data){
                            $('#idcher').show();
                            $('select[id="idcher"]').html(data);
                            $('select[id="idcher"]').selectpicker('refresh');
                        });
                        $('select[id="idcher"]').trigger('change');
                    }
                    else{
                        $('#idcher').hide();
                        $('#codeproj').trigger('change');
                    }
                });

                $('#anneeproj').change(function(){
                    $('#codeproj').trigger('change');
                });

                $('#semestreProj').change(function(){
                    $('#codeproj').trigger('change');
                });

                $('#periodeProj').change(function(){
                    var periode = $(this).val();

                    switch (periode) {
                        case 'final':
                            $('#bi').hide();
                            $('#an').hide();
                        break;
                    
                        case 'annuel':
                            $('#bi').hide();
                            $('#an').show();
                        break;

                        case 'biannuel':
                            $('#bi').show();
                            $('#an').show();
                        break;
                    }
                        
                    $('#codeproj').trigger('change');
                });
                
                

                $('.selectpicker').selectpicker('refresh');
                //TODO: here
            }

            function init_activite(){

                $('#allFilters').html(`
                <div style="margin-top:10px;" class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type</label>
                            <select title="Type..." class="form-control selectpicker" id="typeBilan">
                                <option selected value="chercheur">Chercheur</option>
                                <option value="equipe">Equipe</option>
                                <option value="laboratoire">Laboratoire</option>
                            </select>
                        </div>
                    </div>
                </div> 
                <div id="filters"></div>`);

                $('#typeBilan').change(function(){
                    var typeBilan = $(this).val();
                    switch (typeBilan) {
                        case 'chercheur':
                            $('#filters').html(`
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>établissement</label>
                                        <select data-live-search="true" title="Etablissement..." class="form-control selectpicker" id="idetab">
                                        <?php
                                            $sql = "SELECT * FROM etablissement";
                                            $result = mysqli_query($db,$sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_array($result)){
                                                    $idetab = $row["idetab"];
                                                    $nom = $row["nom"];
                                                    echo '<option value="'.$idetab.'">'.$nom.'</option>';
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>laboratoire</label>
                                        <select data-live-search="true" title="Laboratoire..." class="form-control selectpicker" id="idlabo">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>équipe</label>
                                        <select data-live-search="true" title="Equipe..." class="form-control selectpicker" id="idequipe">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Chercheur</label>
                                        <select data-live-search="true" title="Chercheur..." class="form-control selectpicker" id="idcher">
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div style="margin-top:5px;padding-bottom:10px;" class="row form-inline">
                                <div style="margin-top:10px;" class="col-md-3">
                                    <div class="form-check form-check-inline">
                                        <label>Afficher par: </label>
                                        <input name="affiche" class="form-check-input" type="radio" value="annee">
                                        <label class="form-check-label">Année</label>
                                        <input name="affiche" style="margin-left:10px;" class="form-check-input" checked type="radio" value="mois">
                                        <label class="form-check-label">Mois</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>type de production</label>
                                        <select class="form-control selectpicker" id="typeProduction">
                                            <option value="all">Toutes</option>
                                            <option value="publication">Publication</option>
                                            <option value="communication">Communication</option>
                                            <option value="ouvrage">Ouvrage</option>
                                            <option value="chapitreOuvrage">Chapitre d'ouvrage</option>
                                            <option value="doctorat">Thèse</option>
                                            <option value="master">PFE Master</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="byMonth" style="padding-bottom:10px;" class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Année</label>
                                        <input value="2020" min="2000" max="<?php echo date('Y'); ?>" id="periodeY" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Entre</label>
                                        <input value="01" min="1" max="<?php echo date('m'); ?>" id="periodeDebM" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>et</label>
                                        <input value="<?php echo date('m'); ?>" min="1" max="<?php echo date('m'); ?>" id="periodeFinM" class="form-control" type="number">
                                        <!--<select id="periodeFinM" class="form-group selectpicker">
                                            <option selected value="01">Janvier</option>
                                            <option value="02">Février</option>
                                            <option value="03">Mars</option>
                                            <option value="04">Avril</option>
                                            <option value="05">Mai</option>
                                            <option value="06">Juin</option>
                                            <option value="07">Juillet</option>
                                            <option value="08">Aout</option>
                                            <option value="09">Septembre</option>
                                            <option value="10">Octobre</option>
                                            <option value="11">Novembre</option>
                                            <option value="12">Décembre</option>
                                        </select>-->
                                    </div>
                                </div>
                            </div>
                            <div id="byYear" style="padding-bottom:10px;" class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Entre</label>
                                        <input min="2000" max="<?php echo date('Y'); ?>" id="periodeDebY" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>et</label>
                                        <input min="2000" max="<?php echo date('Y'); ?>" id="periodeFinY" class="form-control" type="number">
                                    </div>
                                </div>
                            </div>
                            `);
                            
                            $('#stats').hide();

                            $('#idetab').change(function(){
                                var idetab = $(this).val();
                                $.get("ajax/bilanAjax.php",{idetab: idetab},function(data){
                                    $('#idlabo').html(data.slice(2,-1));
                                    $('.selectpicker').selectpicker('refresh');
                                });
                            });
                            $('#idlabo').change(function(){
                                var idlabo = $(this).val();
                                $.get("ajax/bilanAjax.php",{idlabo: idlabo},function(data){
                                    $('#idequipe').html(data.slice(2,-1));
                                    $('.selectpicker').selectpicker('refresh');
                                });
                            });
                            $('#idequipe').change(function(){
                                var idequipe = $(this).val();
                                $.get("ajax/bilanAjax.php",{idequipe: idequipe},function(data){
                                    $('#idcher').html(data.slice(2,-1));
                                    $('.selectpicker').selectpicker('refresh');
                                });
                            });

                            $('#idcher').change(function(){
                                var typeProduction = $('#typeProduction').val();
                                var affichage = $('input[type="radio"]:checked').val();
                                if(affichage == "mois"){
                                    var year = parseInt($('#periodeY').val());
                                    var deb = parseInt($('#periodeDebM').val());
                                    var fin = parseInt($('#periodeFinM').val());
                                    if(deb < 10) deb = "0"+deb;
                                    if(fin < 10) fin = "0"+fin;
                                    deb = year+"-"+deb;
                                    fin = year+"-"+fin;
                                }else{
                                    var deb = parseInt($('#periodeDebY').val())+"-01";
                                    var fin = parseInt($('#periodeFinY').val())+"-12";
                                }
                                var idcher = $('#idcher').val();
                                var format = /^\d{4}[\/\-](0?[1-9]|1[012])$/;

                                if( idcher != "" && format.test(deb) && format.test(fin) && typeProduction != ""){
                                    $.get("ajax/bilanAjax.php",{export: 'false', bilancher: idcher, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                                        var productions = JSON.parse(data.slice(2,-1)+"]");
                                        console.log(productions);
                                        graph = drawChart(productions,deb,fin,affichage,graph,update,typeProduction);
                                        pie = drawPie(productions,pie,update,typeProduction);
                                        getPoints(productions,typeProduction);
                                        update = true;
                                        $('#table').html('');
                                        $('#table').html(`
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="header">
                                                    <h4 class="title">Liste des productions</h4>
                                                    <p><button type="button" class="btn btn-info" style="border:0px;font-size:16px;" exporter="exporter">Exporter</button></p>
                                                </div>

                                                <div class="content">
                                                    <table id="showTable" class="table table-hover">
                                                        <thead>
                                                            <th>Titre</th>
                                                            <th>Date</th>
                                                            <th>Type</th>
                                                            <th>Projet</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        `);
                                        productions.forEach(production => {
                                            if(production.codeproj == undefined) production.codeproj = ''; 
                                            $('tbody').append(`
                                                <tr>
                                                <td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codepro}">${production.titre}</button></td>
                                                <td>${production.date}</td>
                                                <td>${production.type}</td>
                                                <td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codeproj}">${production.codeproj}</button></td>
                                                </tr>
                                            `);                    
                                        });
                                        $('#showTable').DataTable(fr_table());
                                        init_codepro();
                                        $('button[exporter="exporter"]').click(function(){
                                            var exporter = $(this);
                                            $.get("ajax/bilanAjax.php",{export: 'true', bilancher: idcher, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                                                if($('a[download="production"]').length == 0)
                                                    exporter.after(` =>  <a download="production" target="_blank" href="ajax/tempo/productions.xlsx">Télécharger</a>`);
                                            });
                                        });
                                    });

                                    $('#stats').show();
                                }
                                else{
                                    $('#stats').hide();
                                }
                            });

                            $('#byYear').hide();

                            $('input[type="radio"]').click(function(){
                                var val = $(this).val();
                                if(val == "annee"){
                                    $('#byYear').show();
                                    $('#byMonth').hide();
                                }
                                else{
                                    $('#byYear').hide();
                                    $('#byMonth').show();
                                }
                                $('#idcher').trigger('change');
                            });
                            
                            $('#periodeY').change(function(){
                                var finM = $('#periodeFinM');
                                var year = $(this).val();
                                var maxMonth = <?php echo date('m');?>;
                                var currentYear = <?php echo date('Y');?>;
                                if(year == currentYear){
                                    finM.prop('max',maxMonth);
                                    if(parseInt(finM.val()) > parseInt(maxMonth))
                                        finM.val(maxMonth);
                                }
                                else{
                                    finM.prop('max',12);
                                }
                                $('#idcher').trigger('change');
                            });

                            $('#periodeDebM').change(function(){
                                var min = $(this).val();
                                var finM = $('#periodeFinM');
                                finM.prop('min',min);
                                if(parseInt(min) > parseInt(finM.val()))
                                    finM.val(min);
                                $('#idcher').trigger("change");
                            });
                            $('#periodeFinM').change(function(){
                                var max = $(this).val();
                                var debM = $('#periodeDebM');
                                debM.prop('max',max);
                                if(parseInt(max) < parseInt(debM.val()))
                                    debM.val(max);
                                $('#idcher').trigger("change");
                            });
                            $('#periodeDebY').change(function(){
                                var min = $(this).val();
                                $('#periodeFinY').prop('min',min);
                                if(min>$('#periodeFinY').val())
                                $('#periodeFinY').val(min);
                                $('#idcher').trigger("change");
                            });
                            $('#periodeFinY').change(function(){
                                var max = $(this).val();
                                $('#periodeDeb').prop('max',max);
                                if(max<$('#periodeDeb').val())
                                $('#periodeDeb').val(max);
                                $('#idcher').trigger("change");
                            });

                            $('#typeProduction').change(function(){
                                $('#idcher').trigger('change');
                            });
                        break;
                    
                        case 'equipe':
                            $('#filters').html(`
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>établissement</label>
                                        <select data-live-search="true" title="Etablissement..." class="form-control selectpicker" id="idetab">
                                        <?php
                                            $sql = "SELECT * FROM etablissement";
                                            $result = mysqli_query($db,$sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_array($result)){
                                                    $idetab = $row["idetab"];
                                                    $nom = $row["nom"];
                                                    echo '<option value="'.$idetab.'">'.$nom.'</option>';
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>laboratoire</label>
                                        <select data-live-search="true" title="Laboratoire..." class="form-control selectpicker" id="idlabo">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>équipe</label>
                                        <select data-live-search="true" title="Equipe..." class="form-control selectpicker" id="idequipe">
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div style="margin-top:5px;padding-bottom:10px;" class="row form-inline">
                                <div style="margin-top:10px;" class="col-md-3">
                                    <div class="form-check form-check-inline">
                                        <label>Afficher par: </label>
                                        <input name="affiche" class="form-check-input" type="radio" value="annee">
                                        <label class="form-check-label">Année</label>
                                        <input name="affiche" style="margin-left:10px;" class="form-check-input" checked type="radio" value="mois">
                                        <label class="form-check-label">Mois</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>type de production</label>
                                        <select class="form-control selectpicker" id="typeProduction">
                                            <option value="all">Toutes</option>
                                            <option value="publication">Publication</option>
                                            <option value="communication">Communication</option>
                                            <option value="ouvrage">Ouvrage</option>
                                            <option value="chapitreOuvrage">Chapitre d'ouvrage</option>
                                            <option value="doctorat">Thèse</option>
                                            <option value="master">PFE Master</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="byMonth" style="padding-bottom:10px;" class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Année</label>
                                        <input value="2020" min="2000" max="<?php echo date('Y'); ?>" id="periodeY" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Entre</label>
                                        <input value="01" min="1" max="<?php echo date('m'); ?>" id="periodeDebM" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>et</label>
                                        <input value="<?php echo date('m'); ?>" min="1" max="<?php echo date('m'); ?>" id="periodeFinM" class="form-control" type="number">
                                        <!--<select id="periodeFinM" class="form-group selectpicker">
                                            <option selected value="01">Janvier</option>
                                            <option value="02">Février</option>
                                            <option value="03">Mars</option>
                                            <option value="04">Avril</option>
                                            <option value="05">Mai</option>
                                            <option value="06">Juin</option>
                                            <option value="07">Juillet</option>
                                            <option value="08">Aout</option>
                                            <option value="09">Septembre</option>
                                            <option value="10">Octobre</option>
                                            <option value="11">Novembre</option>
                                            <option value="12">Décembre</option>
                                        </select>-->
                                    </div>
                                </div>
                            </div>
                            <div id="byYear" style="padding-bottom:10px;" class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Entre</label>
                                        <input min="2000" max="<?php echo date('Y'); ?>" id="periodeDebY" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>et</label>
                                        <input min="2000" max="<?php echo date('Y'); ?>" id="periodeFinY" class="form-control" type="number">
                                    </div>
                                </div>
                            </div>
                            `);
                            $('#stats').hide();

                            $('#idetab').change(function(){
                                var idetab = $(this).val();
                                $.get("ajax/bilanAjax.php",{idetab: idetab},function(data){
                                    $('#idlabo').html(data.slice(2,-1));
                                    $('.selectpicker').selectpicker('refresh');
                                });
                            });
                            $('#idlabo').change(function(){
                                var idlabo = $(this).val();
                                $.get("ajax/bilanAjax.php",{idlabo: idlabo},function(data){
                                    $('#idequipe').html(data.slice(2,-1));
                                    $('.selectpicker').selectpicker('refresh');
                                });
                            });
                            $('#idequipe').change(function(){
                                var typeProduction = $('#typeProduction').val();
                                var affichage = $('input[type="radio"]:checked').val();
                                if(affichage == "mois"){
                                    var year = parseInt($('#periodeY').val());
                                    var deb = parseInt($('#periodeDebM').val());
                                    var fin = parseInt($('#periodeFinM').val());
                                    if(deb < 10) deb = "0"+deb;
                                    if(fin < 10) fin = "0"+fin;
                                    deb = year+"-"+deb;
                                    fin = year+"-"+fin;
                                }else{
                                    var deb = parseInt($('#periodeDebY').val())+"-01";
                                    var fin = parseInt($('#periodeFinY').val())+"-12";
                                }
                                var idequipe = $(this).val();
                                var format = /^\d{4}[\/\-](0?[1-9]|1[012])$/;

                                if( idequipe != "" && format.test(deb) && format.test(fin) && typeProduction != ""){
                                    $.get("ajax/bilanAjax.php",{export: 'false', bilanequipe: idequipe, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                                        var productions = JSON.parse(data.slice(2,-1)+"]");
                                        graph = drawChart(productions,deb,fin,affichage,graph,update,typeProduction);
                                        pie = drawPie(productions,pie,update,typeProduction);
                                        getPoints(productions,typeProduction);
                                        update = true;
                                        $('#table').html('');
                                        $('#table').html(`
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="header">
                                                    <h4 class="title">Liste des productions</h4>
                                                <p><button type="button" class="btn btn-info" style="border:0px;font-size:16px;" exporter="exporter">Exporter</button></p>
                                                </div>

                                                <div class="content">
                                                    <table id="showTable" class="table table-hover">
                                                        <thead>
                                                            <th>Titre</th>
                                                            <th>Date</th>
                                                            <th>Type</th>
                                                            <th>Projet</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        `);
                                        productions.forEach(production => {
                                            if(production.codeproj == undefined) production.codeproj = ''; 
                                            $('tbody').append(`
                                                <tr>
                                                <td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codepro}">${production.titre}</button></td>
                                                <td>${production.date}</td>
                                                <td>${production.type}</td>
                                                <td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codeproj}">${production.codeproj}</button></td>
                                                </tr>
                                            `);                    
                                        });
                                        $('#showTable').DataTable(fr_table());
                                        init_codepro();
                                        $('button[exporter="exporter"]').click(function(){
                                            var exporter = $(this);
                                            $.get("ajax/bilanAjax.php",{export: 'true', bilanequipe: idequipe, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                                                if($('a[download="production"]').length == 0)
                                                    exporter.after(` =>  <a download="production" target="_blank" href="ajax/tempo/productions.xlsx">Télécharger</a>`);
                                            });
                                        });
                                    });

                                    $('#stats').show();
                                }
                                else{
                                    $('#stats').hide();
                                }
                            });

                            $('#byYear').hide();

                            $('input[type="radio"]').click(function(){
                                var val = $(this).val();
                                if(val == "annee"){
                                    $('#byYear').show();
                                    $('#byMonth').hide();
                                }
                                else{
                                    $('#byYear').hide();
                                    $('#byMonth').show();
                                }
                                $('#idequipe').trigger('change');
                            });
                            
                            $('#periodeY').change(function(){
                                var finM = $('#periodeFinM');
                                var year = $(this).val();
                                var maxMonth = <?php echo date('m');?>;
                                var currentYear = <?php echo date('Y');?>;
                                if(year == currentYear){
                                    finM.prop('max',maxMonth);
                                    if(parseInt(finM.val()) > parseInt(maxMonth))
                                        finM.val(maxMonth);
                                }
                                else{
                                    finM.prop('max',12);
                                }
                                $('#idequipe').trigger('change');
                            });

                            $('#periodeDebM').change(function(){
                                var min = $(this).val();
                                var finM = $('#periodeFinM');
                                finM.prop('min',min);
                                if(parseInt(min) > parseInt(finM.val()))
                                    finM.val(min);
                                $('#idequipe').trigger("change");
                            });
                            $('#periodeFinM').change(function(){
                                var max = $(this).val();
                                var debM = $('#periodeDebM');
                                debM.prop('max',max);
                                if(parseInt(max) < parseInt(debM.val()))
                                    debM.val(max);
                                $('#idequipe').trigger("change");
                            });
                            $('#periodeDebY').change(function(){
                                var min = $(this).val();
                                $('#periodeFinY').prop('min',min);
                                if(min>$('#periodeFinY').val())
                                $('#periodeFinY').val(min);
                                $('#idequipe').trigger("change");
                            });
                            $('#periodeFinY').change(function(){
                                var max = $(this).val();
                                $('#periodeDeb').prop('max',max);
                                if(max<$('#periodeDeb').val())
                                $('#periodeDeb').val(max);
                                $('#idequipe').trigger("change");
                            });

                            $('#typeProduction').change(function(){
                                $('#idequipe').trigger('change');
                            });
                        break;

                        default:
                        $('#filters').html(`
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>établissement</label>
                                        <select data-live-search="true" title="Etablissement..." class="form-control selectpicker" id="idetab">
                                        <?php
                                            $sql = "SELECT * FROM etablissement";
                                            $result = mysqli_query($db,$sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_array($result)){
                                                    $idetab = $row["idetab"];
                                                    $nom = $row["nom"];
                                                    echo '<option value="'.$idetab.'">'.$nom.'</option>';
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>laboratoire</label>
                                        <select data-live-search="true" title="Laboratoire..." class="form-control selectpicker" id="idlabo">
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div style="margin-top:5px;padding-bottom:10px;" class="row form-inline">
                                <div style="margin-top:10px;" class="col-md-3">
                                    <div class="form-check form-check-inline">
                                        <label>Afficher par: </label>
                                        <input name="affiche" class="form-check-input" type="radio" value="annee">
                                        <label class="form-check-label">Année</label>
                                        <input name="affiche" style="margin-left:10px;" class="form-check-input" checked type="radio" value="mois">
                                        <label class="form-check-label">Mois</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>type de production</label>
                                        <select class="form-control selectpicker" id="typeProduction">
                                            <option value="all">Toutes</option>
                                            <option value="publication">Publication</option>
                                            <option value="communication">Communication</option>
                                            <option value="ouvrage">Ouvrage</option>
                                            <option value="chapitreOuvrage">Chapitre d'ouvrage</option>
                                            <option value="doctorat">Thèse</option>
                                            <option value="master">PFE Master</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="byMonth" style="padding-bottom:10px;" class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Année</label>
                                        <input value="2020" min="2000" max="<?php echo date('Y'); ?>" id="periodeY" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Entre</label>
                                        <input value="01" min="1" max="<?php echo date('m'); ?>" id="periodeDebM" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>et</label>
                                        <input value="<?php echo date('m'); ?>" min="1" max="<?php echo date('m'); ?>" id="periodeFinM" class="form-control" type="number">
                                        <!--<select id="periodeFinM" class="form-group selectpicker">
                                            <option selected value="01">Janvier</option>
                                            <option value="02">Février</option>
                                            <option value="03">Mars</option>
                                            <option value="04">Avril</option>
                                            <option value="05">Mai</option>
                                            <option value="06">Juin</option>
                                            <option value="07">Juillet</option>
                                            <option value="08">Aout</option>
                                            <option value="09">Septembre</option>
                                            <option value="10">Octobre</option>
                                            <option value="11">Novembre</option>
                                            <option value="12">Décembre</option>
                                        </select>-->
                                    </div>
                                </div>
                            </div>
                            <div id="byYear" style="padding-bottom:10px;" class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Entre</label>
                                        <input min="2000" max="<?php echo date('Y'); ?>" id="periodeDebY" class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>et</label>
                                        <input min="2000" max="<?php echo date('Y'); ?>" id="periodeFinY" class="form-control" type="number">
                                    </div>
                                </div>
                            </div>
                            `);
                            $('#stats').hide();

                            $('#idetab').change(function(){
                                var idetab = $(this).val();
                                $.get("ajax/bilanAjax.php",{idetab: idetab},function(data){
                                    $('#idlabo').html(data.slice(2,-1));
                                    $('.selectpicker').selectpicker('refresh');
                                });
                            });
                            $('#idlabo').change(function(){
                                var typeProduction = $('#typeProduction').val();
                                var affichage = $('input[type="radio"]:checked').val();
                                if(affichage == "mois"){
                                    var year = parseInt($('#periodeY').val());
                                    var deb = parseInt($('#periodeDebM').val());
                                    var fin = parseInt($('#periodeFinM').val());
                                    if(deb < 10) deb = "0"+deb;
                                    if(fin < 10) fin = "0"+fin;
                                    deb = year+"-"+deb;
                                    fin = year+"-"+fin;
                                }else{
                                    var deb = parseInt($('#periodeDebY').val())+"-01";
                                    var fin = parseInt($('#periodeFinY').val())+"-12";
                                }
                                var idlabo = $(this).val();
                                var format = /^\d{4}[\/\-](0?[1-9]|1[012])$/;

                                if( idlabo != "" && format.test(deb) && format.test(fin) && typeProduction != ""){
                                    $.get("ajax/bilanAjax.php",{export: 'false', bilanlabo: idlabo, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                                        var productions = JSON.parse(data.slice(2,-1)+"]");
                                        graph = drawChart(productions,deb,fin,affichage,graph,update,typeProduction);
                                        pie = drawPie(productions,pie,update,typeProduction);
                                        getPoints(productions,typeProduction);
                                        update = true;
                                        $('#table').html('');
                                        $('#table').html(`
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="header">
                                                    <h4 class="title">Liste des productions</h4>
                                                    <p><button type="button" class="btn btn-info" style="border:0px;font-size:16px;" exporter="exporter">Exporter</button></p>
                                                </div>

                                                <div class="content">
                                                    <table id="showTable" class="table table-hover">
                                                        <thead>
                                                            <th>Titre</th>
                                                            <th>Date</th>
                                                            <th>Type</th>
                                                            <th>Projet</th>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        `);
                                        productions.forEach(production => {
                                            if(production.codeproj == undefined) production.codeproj = ''; 
                                            $('tbody').append(`
                                                <tr>
                                                <td><button codepro="codepro" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codepro}">${production.titre}</button></td>
                                                <td>${production.date}</td>
                                                <td>${production.type}</td>
                                                <td><button codeproj="codeproj" class="btn btn-primary" style="border:0px;font-size:16px;" value="${production.codeproj}">${production.codeproj}</button></td>
                                                </tr>
                                            `);                    
                                        });
                                        $('#showTable').DataTable(fr_table());
                                        init_codepro();
                                        $('button[exporter="exporter"]').click(function(){
                                            var exporter = $(this);
                                            $.get("ajax/bilanAjax.php",{export: 'true', bilanlabo: idlabo, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                                                if($('a[download="production"]').length == 0)
                                                    exporter.after(` =>  <a download="production" target="_blank" href="ajax/tempo/productions.xlsx">Télécharger</a>`);
                                            });
                                        });
                                    });

                                    $('#stats').show();
                                }
                                else{
                                    $('#stats').hide();
                                }
                            });

                            $('#byYear').hide();

                            $('input[type="radio"]').click(function(){
                                var val = $(this).val();
                                if(val == "annee"){
                                    $('#byYear').show();
                                    $('#byMonth').hide();
                                }
                                else{
                                    $('#byYear').hide();
                                    $('#byMonth').show();
                                }
                                $('#idlabo').trigger('change');
                            });
                            
                            $('#periodeY').change(function(){
                                var finM = $('#periodeFinM');
                                var year = $(this).val();
                                var maxMonth = <?php echo date('m');?>;
                                var currentYear = <?php echo date('Y');?>;
                                if(year == currentYear){
                                    finM.prop('max',maxMonth);
                                    if(parseInt(finM.val()) > parseInt(maxMonth))
                                        finM.val(maxMonth);
                                }
                                else{
                                    finM.prop('max',12);
                                }
                                $('#idlabo').trigger('change');
                            });

                            $('#periodeDebM').change(function(){
                                var min = $(this).val();
                                var finM = $('#periodeFinM');
                                finM.prop('min',min);
                                if(parseInt(min) > parseInt(finM.val()))
                                    finM.val(min);
                                $('#idlabo').trigger("change");
                            });
                            $('#periodeFinM').change(function(){
                                var max = $(this).val();
                                var debM = $('#periodeDebM');
                                debM.prop('max',max);
                                if(parseInt(max) < parseInt(debM.val()))
                                    debM.val(max);
                                $('#idlabo').trigger("change");
                            });
                            $('#periodeDebY').change(function(){
                                var min = $(this).val();
                                $('#periodeFinY').prop('min',min);
                                if(min>$('#periodeFinY').val())
                                $('#periodeFinY').val(min);
                                $('#idlabo').trigger("change");
                            });
                            $('#periodeFinY').change(function(){
                                var max = $(this).val();
                                $('#periodeDeb').prop('max',max);
                                if(max<$('#periodeDeb').val())
                                $('#periodeDeb').val(max);
                                $('#idlabo').trigger("change");
                            });

                            $('#typeProduction').change(function(){
                                $('#idlabo').trigger('change');
                            });
                        break;
                    }
                    $('.selectpicker').selectpicker('refresh');
                });

                $('#typeBilan').trigger('change');
            }

            function getPoints(productions,typeProduction){
                var affichage = $('#notes');
                affichage.html('');
                var notes;
                $.get("ajax/bilanAjax.php",{sysNotes: 'true'},function(data){
                    notes = JSON.parse(data.slice(2,-1)+'}');
                    var results = {};
                    if(typeProduction == 'publication' || typeProduction == 'communication'){
                        productions.forEach((production) => {
                            var tempo = '';
                            switch (production.type) {
                                case 'publication':
                                    if(production.inter == 'nationale'){
                                        tempo += notes.revueNat;
                                    }
                                    else{
                                        switch (production.classe) {
                                            case 'A*':
                                                tempo += notes.revueInterAA;
                                            break;
                                            case 'A':
                                                tempo += notes.revueInterA;
                                            break;
                                            case 'B':
                                                tempo += notes.revueInterB;
                                            break;
                                            case 'C':
                                                tempo += notes.revueInterC;
                                            break;
                                            default:
                                                tempo += notes.revueInterAutre;
                                            break;
                                        }
                                    }
                                break;
                                
                                case 'communication':
                                    if(production.inter == 'nationale'){
                                        tempo += notes.comNat;
                                    }
                                    else{
                                        switch (production.classe) {
                                            case 'A':
                                                tempo += notes.comInterA;
                                            break;
                                            case 'B':
                                                tempo += notes.comInterB;
                                            break;
                                            case 'C':
                                                tempo += notes.comInterC;
                                            break;
                                            default:
                                                tempo += notes.comInterAutre;
                                            break;
                                        }
                                    }
                                break;
                            }
                            if(production.inter == 'internationale'){
                                if(production.type+' internationale '+production.classe in results)
                                    results[production.type+' internationale '+production.classe] += parseInt(tempo);
                                else 
                                    results[production.type+' internationale '+production.classe] = parseInt(tempo);
                            }
                            else{
                                if(production.type+' nationale' in results)
                                    results[production.type+' nationale'] += parseInt(tempo);
                                else 
                                    results[production.type+' nationale'] = parseInt(tempo);
                            }
                        });
                    }
                    else{
                        productions.forEach((production) => {
                            var tempo = '';
                            switch (production.type) {
                                case 'publication':
                                    if(production.inter == 'nationale'){
                                        tempo += notes.revueNat;
                                    }
                                    else{
                                        switch (production.classe) {
                                            case 'A*':
                                                tempo += notes.revueInterAA;
                                            break;
                                            case 'A':
                                                tempo += notes.revueInterA;
                                            break;
                                            case 'B':
                                                tempo += notes.revueInterB;
                                            break;
                                            case 'C':
                                                tempo += notes.revueInterC;
                                            break;
                                            default:
                                                tempo += notes.revueInterAutre;
                                            break;
                                        }
                                    }
                                break;
                                
                                case 'communication':
                                    if(production.inter == 'nationale'){
                                        tempo += notes.comNat;
                                    }
                                    else{
                                        switch (production.classe) {
                                            case 'A':
                                                tempo += notes.comInterA;
                                            break;
                                            case 'B':
                                                tempo += notes.comInterB;
                                            break;
                                            case 'C':
                                                tempo += notes.comInterC;
                                            break;
                                            default:
                                                tempo += notes.comInterAutre;
                                            break;
                                        }
                                    }
                                break;

                                case 'chapitreOuvrage':
                                    tempo += notes.chapitreOuvrage;
                                break;

                                case 'ouvrage':
                                    tempo += notes.ouvrage;
                                break;

                                case 'doctorat':
                                    tempo += notes.doctorat;
                                break;

                                case 'master':
                                    tempo += notes.master;
                                break;

                                default:
                                    tempo += notes.autre;
                                break;
                            }
                            if(production.type in results)
                                results[production.type] += parseInt(tempo);
                            else 
                                results[production.type] = parseInt(tempo);
                        });
                    }
                    
                    var total = 0;
                    affichage.append('<div class="text-center" style="margin-top:10px;">');
                    for(result in results){
                        affichage.append('<p class="category">'+result+': <span style="font-weight:bold;color:black">'+results[result]+'</span><p>');
                        total += results[result];
                    }
                    affichage.append('<h4 class="title">Total: <span style="font-weight:bold">'+total+'</span></h4></div>');
                });

            }

            function drawPie(productions,pie,update,typeProduction){
                var labels = [];
                var output = [];
                var backgroundColor = [];
                var series = {};
                var i = 0;

                if(typeProduction == 'publication' || typeProduction == 'communication'){
                    productions.forEach(production => {
                        if(production.inter == 'internationale'){
                            if(production.type+' internationale '+production.classe in series){
                                series[production.type+' internationale '+production.classe] += 1;
                            }
                            else{
                                series[production.type+' internationale '+production.classe] = 1;
                            }
                        }
                        else{
                            if(production.type+' nationale' in series){
                                series[production.type+' nationale'] += 1;
                            }
                            else{
                                series[production.type+' nationale'] = 1;
                            }
                        }
                    });
                }
                else{
                    productions.forEach(production => {
                        if(production.type in series){
                            series[production.type] += 1;
                        }
                        else{
                            series[production.type] = 1;
                        }
                    });
                }

                for(production in series){
                    labels.push(production);
                    output.push(series[production]);
                    backgroundColor.push(colors[i]);
                    i++;
                }

                if(update){
                    pie.data.labels = labels;
                    pie.data.datasets[0].data = output;
                    pie.data.datasets[0].backgroundColor = backgroundColor;
                    pie.update();
                }
                else{
                    pie = new Chart($('#pie'),{
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: output,
                                backgroundColor: backgroundColor
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                }
                return pie;
            }

            function drawChart(productions,deb,fin,affichage,graph,update,typeProduction) {
                deb = new Date(deb);
                fin = new Date(fin);
                var labels = [];
                if(affichage == "mois"){
                    for(var d= new Date(deb); (d.getFullYear()<fin.getFullYear())||(d.getFullYear()==fin.getFullYear() && d.getMonth()<=fin.getMonth()); d.setMonth(d.getMonth()+1)){
                        var label = new Date(d);
                        var month = label.toLocaleString('fr', { month: 'short' });
                        var year = label.getFullYear();
                        labels.push(month+" "+year);
                    }
                    
                    var series = {};
                    if(typeProduction == 'publication' || typeProduction == 'communication'){
                        productions.forEach(production => {
                            var d = new Date(production.date);
                            var month = d.toLocaleString('fr', { month: 'short' });
                            var year = d.getFullYear();
                            if(production.inter == 'internationale'){
                                if(!(production.type+' internationale '+production.classe in series))
                                    series[production.type+' internationale '+production.classe] = {};
                                if(month+" "+year in series[production.type+' internationale '+production.classe])
                                    series[production.type+' internationale '+production.classe][month+" "+year] += 1;
                                else
                                    series[production.type+' internationale '+production.classe][month+" "+year] = 1;
                            }
                            else{
                                if(!(production.type+' nationale' in series))
                                    series[production.type+' nationale'] = {};
                                if(month+" "+year in series[production.type+' nationale'])
                                    series[production.type+' nationale'][month+" "+year] += 1;
                                else
                                    series[production.type+' nationale'][month+" "+year] = 1;
                            }
                        });
                    }
                    else{
                        productions.forEach(production => {
                            var d = new Date(production.date);
                            var month = d.toLocaleString('fr', { month: 'short' });
                            var year = d.getFullYear();
                            if(!(production.type in series))
                                series[production.type] = {};
                            if(month+" "+year in series[production.type])
                                series[production.type][month+" "+year] += 1;
                            else
                                series[production.type][month+" "+year] = 1;
                        });
                    }
                    
                }
                else{
                    for(var d= new Date(deb); d.getFullYear()<= fin.getFullYear(); d.setFullYear(d.getFullYear()+1)){
                        var year = d.getFullYear();
                        labels.push(year);
                    }
                    labels.sort();
                    labels = Array.from(new Set(labels));
                    
                    var series = {};
                    if(typeProduction == 'publication' || typeProduction == 'communication'){
                        productions.forEach(production => {
                            var d = new Date(production.date);
                            var year = d.getFullYear();
                            if(production.inter == 'internationale'){
                                if(!(production.type+' internationale '+production.classe in series))
                                    series[production.type+' internationale '+production.classe] = {};
                                if(year in series[production.type+' internationale '+production.classe])
                                    series[production.type+' internationale '+production.classe][year] += 1;
                                else
                                    series[production.type+' internationale '+production.classe][year] = 1;
                            }
                            else{
                                if(!(production.type+' nationale' in series))
                                    series[production.type+' nationale'] = {};
                                if(year in series[production.type+' nationale'])
                                    series[production.type+' nationale'][year] += 1;
                                else
                                    series[production.type+' nationale'][year] = 1;
                            }
                        });
                    }
                    else{
                        productions.forEach(production => {
                            var d = new Date(production.date);
                            var year = d.getFullYear();
                            if(!(production.type in series))
                                series[production.type] = {};
                            if(year in series[production.type])
                                series[production.type][year] += 1;
                            else
                                series[production.type][year] = 1;
                        });
                    }
                    
                }

                var output = [];
                var i = 0;
                for (serie in series){
                    var tempo = [];
                    labels.forEach(label => {
                        if(label in series[serie]){
                            tempo.push({
                                x: label,
                                y: series[serie][label]
                            });
                        }
                        else{
                            tempo.push({
                                x: label,
                                y: 0
                            });
                        }
                    });
                    output.push({
                        label: serie,
                        backgroundColor: color(colors[i]).alpha(0.5).rgbString(),
                        borderColor: colors[i],
                        borderWidth: 1,
                        data: tempo,
                        fill: false
                    });
                    i++;
                }
                
                var barChartData = {
                    labels: labels,
                    datasets: output
                }

                var type = 'line';
                if(typeProduction == 'publication' || typeProduction == 'communication' || typeProduction == 'all'){
                    type = 'bar';
                }

                var titre = 'Production';
                if(typeProduction != 'all')
                    titre = typeProduction.charAt(0).toUpperCase() + typeProduction.slice(1);

                var xlabel = 'Année';
                if(affichage == 'mois')
                    xlabel = 'Mois';

                var config = {
                        type: type,
                        data: barChartData,
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: titre
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function(value) {if (value % 1 === 0) {return value;}}
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Nombre'
                                    }
                                }],
                                xAxes: [{
                                    scaleLabel: {
                                        display: true,
                                        labelString: xlabel
                                    }
                                }]
                            }
                        }
                    };

                if(update){
                    graph.destroy(); 
                }
                graph = new Chart($('#graph'), config);
                return graph;
            }

            function fr_table (){
                
                return {
                    //"scrollY" : "500px",
                    //"scrollCollapse": true,
                    "scrollX": true,
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

            function init_codepro(){

                $('#showTable tbody').on('click', 'button[codeproj="codeproj"]',function(){
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

                $('#showTable tbody').on('click', 'button[codepro="codepro"]',function(){
                    var codepro = $(this).val();
                    $.confirm({
                        content: function(){
                            var self = this;
                            self.setTitle("Informations supplémentaires sur la production");
                            $.get("ajax/rechercheAjax.php",{codepro: codepro},function(data){
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


        });
    </script>

</html>
