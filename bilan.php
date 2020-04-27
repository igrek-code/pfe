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
                <li>
                    <a href="adminGererLabo.php">
                        <i class="pe-7s-science"></i>
                        <p>Gerer Laboratoire</p>
                    </a>
                </li>
                <li>
                    <a href="adminGererCompte.php">
                        <i class="pe-7s-users"></i>
                        <p>Gerer Compte</p>
                    </a>
                </li>
                <li>
                    <a href="adminFixerNotation.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Fixer Notation</p>
                    </a>
                </li>
                <li class="active">
                    <a href="bilan.php">
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
                                <h4 class="title">Bilan</h4>   
                                <div style="margin-top:10px;" class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select title="Bilan..." class="form-control selectpicker" id="typeBilan">
                                                <option selected value="chercheur">Chercheur</option>
                                                <option value="equipe">Equipe</option>
                                                <option value="laboratoire">Laboratoire</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>  
                                <div id="filters"></div>
                                <canvas id="graph"></canvas>
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
                        <div style="padding-bottom:10px;" class="row form-inline">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Entre</label>
                                    <input min="1991-01" max="<?php echo date('Y-m'); ?>" id="periodeDeb" class="form-control" type="month">
                                    <input disabled min="1991" max="<?php echo date('Y'); ?>" id="periodeDebY" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>et</label>
                                    <input min="1991-01" max="<?php echo date('Y-m'); ?>" id="periodeFin" class="form-control" type="month">
                                    <input disabled min="1991" max="<?php echo date('Y'); ?>" id="periodeFinY" class="form-control" type="number">
                                </div>
                            </div>
                        </div>
                        `);
                        
                        var update = false;
                        var graph = undefined;

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
                            var affichage = $('input[type="radio"]:checked').val();
                            if(affichage == "mois"){
                                var deb = $('#periodeDeb').val();
                                var fin = $('#periodeFin').val();
                            }else{
                                var deb = $('#periodeDebY').val();
                                var fin = $('#periodeFinY').val();
                            }
                            var idcher = $('#idcher').val();
                            if(idcher != "" && deb != "" && fin != ""){
                                $.get("ajax/bilanAjax.php",{bilancher: idcher,deb: deb, fin: fin},function(data){
                                    graph = drawChart(data,deb,fin,affichage,graph,update);
                                    update = true;
                                });
                            }
                        });

                        $('#periodeDebY').hide();
                        $('#periodeFinY').hide();

                        $('input[type="radio"]').click(function(){
                            var val = $(this).val();
                            var deb = $('#periodeDeb');
                            var fin = $('#periodeFin');
                            var debY = $('#periodeDebY');
                            var finY = $('#periodeFinY');
                            if(val == "annee"){
                                deb.prop("disabled",true);
                                deb.hide();
                                fin.prop("disabled",true);
                                fin.hide();
                                debY.prop("disabled",false);
                                debY.show();
                                finY.prop("disabled",false);
                                finY.show();
                            }
                            else{
                                deb.prop("disabled",false);
                                deb.show();
                                fin.prop("disabled",false);
                                fin.show();
                                debY.prop("disabled",true);
                                debY.hide();
                                finY.prop("disabled",true);
                                finY.hide();
                            }
                        });
                        
                        $('#periodeDeb').change(function(){
                            var min = $(this).val();
                            $('#periodeFin').prop('min',min);
                            if(min>$('#periodeFin').val())
                                $('#periodeFin').val(min);
                            $('#idcher').trigger("change");
                        });
                        $('#periodeFin').change(function(){
                            var max = $(this).val();
                            $('#periodeDeb').prop('max',max);
                            if(max<$('#periodeDeb').val())
                            $('#periodeDeb').val(max);
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

                    break;
                
                    case 'equipe':

                    break;

                    default:

                    break;
                }
                $('.selectpicker').selectpicker('refresh');
            });

            $('#typeBilan').trigger('change');

            function drawChart(data,deb,fin,affichage,graph,update) {
                var productions = JSON.parse(data.slice(2,-1)+"]");
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

                    var output = [];
                    var tempo = [];
                    for (serie in series){
                        labels.forEach(label => {
                            if(label in series[serie])
                                tempo.push(series[serie][label]);
                            else
                                tempo.push(0);
                        });
                        output.push(tempo);
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
                    console.log(series);

                   /* var labels = [];
                    for(serie in series){
                        for(label in series[serie]){
                            if(!(label in labels)) labels.push(label);
                        }
                    }
                    labels.sort();
                    labels = Array.from(new Set(labels));
                    console.log(labels);*/

                    var output = [];
                    var i = 0;
                    for (serie in series){
                        console.log("production: "+serie);
                        var tempo = [];
                        labels.forEach(label => {
                            console.log("anée: "+label);
                            if(label in series[serie]){
                                console.log("nbre: "+series[serie][label]);
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
                            data: tempo
                        });
                        i++;
                    }
                    console.log(output);
                }

                var barChartData = {
                    labels: labels,
                    datasets: output
                }

                if(update){
                    graph['data'] = barChartData;
                    graph.update(); 
                }
                else{
                    graph = new Chart($('#graph'), {
                        type: 'bar',
                        data: barChartData,
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Production'
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        callback: function(value) {if (value % 1 === 0) {return value;}}
                                    }
                                }]
                            }
                        }
                    });
                }
                return graph;
            }
        });
    </script>

</html>
