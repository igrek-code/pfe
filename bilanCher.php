<?php
    require_once("config.php");
    session_start();
    
    $session = false;
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
                    require_once('menu.php');
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Bilan</h4>
                                <div id="filters"></div>
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

            $('#filters').html(`
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
                        <input value="2020" min="1991" max="<?php echo date('Y'); ?>" id="periodeY" class="form-control" type="number">
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
                        <input min="1991" max="<?php echo date('Y'); ?>" id="periodeDebY" class="form-control" type="number">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>et</label>
                        <input min="1991" max="<?php echo date('Y'); ?>" id="periodeFinY" class="form-control" type="number">
                    </div>
                </div>
            </div>
            `);
            
            $('#stats').hide();
            var update = false;
            var graph = undefined;
            var pie = undefined;

            updateCher();

            function updateCher(){
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
                var idcher = <?php echo $_SESSION['idcher']; ?>;
                var format = /^\d{4}[\/\-](0?[1-9]|1[012])$/;

                if( idcher != "" && format.test(deb) && format.test(fin) && typeProduction != ""){
                    $.get("ajax/bilanAjax.php",{bilancher: idcher, deb: deb, fin: fin, typeProduction: typeProduction},function(data){
                        var productions = JSON.parse(data.slice(2,-1)+"]");
                        graph = drawChart(productions,deb,fin,affichage,graph,update,typeProduction);
                        pie = drawPie(productions,pie,update,typeProduction);
                        getPoints(productions,typeProduction);
                        update = true;
                    });

                    $('#stats').show();
                }
                else{
                    $('#stats').hide();
                }
            }

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
                updateCher();
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
                updateCher();
            });

            $('#periodeDebM').change(function(){
                var min = $(this).val();
                var finM = $('#periodeFinM');
                finM.prop('min',min);
                if(parseInt(min) > parseInt(finM.val()))
                    finM.val(min);
                updateCher();
            });
            $('#periodeFinM').change(function(){
                var max = $(this).val();
                var debM = $('#periodeDebM');
                debM.prop('max',max);
                if(parseInt(max) < parseInt(debM.val()))
                    debM.val(max);
                updateCher();
            });
            $('#periodeDebY').change(function(){
                var min = $(this).val();
                $('#periodeFinY').prop('min',min);
                if(min>$('#periodeFinY').val())
                $('#periodeFinY').val(min);
                updateCher();
            });
            $('#periodeFinY').change(function(){
                var max = $(this).val();
                $('#periodeDeb').prop('max',max);
                if(max<$('#periodeDeb').val())
                $('#periodeDeb').val(max);
                updateCher();
            });

            $('#typeProduction').change(function(){
                updateCher();
            });

            $('.selectpicker').selectpicker('refresh');

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
                                        }
                                    }
                                break;

                                case 'chapitreOuvrage':
                                    tempo += notes.chapitreOuvrage;
                                break;

                                case 'ouvrage':
                                    tempo += notes.ouvrage;
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
        });
    </script>

</html>
