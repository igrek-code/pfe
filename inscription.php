<?php
    require_once("config.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
            $display_notif = true;
            $error = true;
            $execute = true;
            if(isset($_POST["mailcher"]) && $_POST["mailcher"] != ""){
                $mailcher = mysqli_real_escape_string($db,$_POST["mailcher"]);
            }else $execute = false;
            if(isset($_POST["nomcher"]) && $_POST["nomcher"] != ""){
                $nomcher = mysqli_real_escape_string($db,$_POST["nomcher"]);
            }else $execute = false;
            if(isset($_POST["gradecher"]) && $_POST["gradecher"] != ""){
                $gradecher = mysqli_real_escape_string($db,$_POST["gradecher"]);
            }else $execute = false;
            if(isset($_POST["profilcher"]) && $_POST["profilcher"] != ""){
                $profilcher = mysqli_real_escape_string($db,$_POST["profilcher"]);
            }else $execute = false;
            if(isset($_POST["idlabo"]) && $_POST["idlabo"] != ""){
                $idlabo = mysqli_real_escape_string($db,$_POST["idlabo"]);
            }else $execute = false;
            if(isset($_POST["pwdcher"]) && isset($_POST["pwdcherconf"]) && $_POST["pwdcher"] != "" && $_POST["pwdcher"] == $_POST["pwdcherconf"]){
                $pwdcher = mysqli_real_escape_string($db,$_POST["pwdcher"]);
            }else $execute = false;
            if(isset($_POST["statuscher"]) && $_POST["statuscher"] != ""){
                $statuscher = mysqli_real_escape_string($db,$_POST["statuscher"]);
            }else $execute = false;
            if(isset($_POST["idequip"]) && $_POST["idequip"] != ""){
                $idequipe = mysqli_real_escape_string($db,$_POST["idequip"]);
            }

            if($execute){
                $sql = "INSERT INTO chercheur (mail,nom,grade,profil) VALUES ('".$mailcher."','".$nomcher."','".$gradecher."','".$profilcher."')";
                if(mysqli_query($db,$sql)){
                    $sql = "SELECT * FROM chercheur ORDER BY idcher DESC";
                    if($result = mysqli_query($db,$sql)){
                        $idcher = mysqli_fetch_array($result)["idcher"];
                        switch ($statuscher) {
                            case 'cheflabo':
                                $sql = "INSERT INTO cheflabo (idlabo,idcher) VALUES ('".$idlabo."','".$idcher."')";
                            break;
                            case 'chefequipe':
                                $sql = "INSERT INTO chefequip (idequipe,idcher) VALUES ('".$idequipe."','".$idcher."')";
                            break;
                            default:
                                $sql = "INSERT INTO menbrequip (idequipe,idcher) VALUES ('".$idequipe."','".$idcher."')";
                            break;
                        }
                        
                        if(mysqli_query($db,$sql)){
                            $sql = "INSERT INTO users (idcher,mail,password) VALUES ('".$idcher."','".$mailcher."','".$pwdcher."')";
                            if(mysqli_query($db,$sql))
                                $error = false;
                        }  
                    }
                }
                if(!$error)
                    $display_type = "success";
                else
                    $display_type = "error";
            }
            else
                $display_type = "error";
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

    <!-- J-CONFIRM CSS -->
    <link rel="stylesheet" href="assets/j-confirm/j-confirm.css">

    <!-- BOOTSTRAP SELECT CSS -->
    <link rel="stylesheet" href="assets/select/bootstrap-select.min.css">
    
    <style>
        #revenir{
            font-size : 15px;
            text-decoration : underline;
        }
    </style>
</head>
<body>
<div style="width:100%;height:200%;background: #d4c4f2;">
    <div style="position:relative; width:50%; left:25%; right:25%;height:80%;top:10%;bottom:10%;" class="content">
        <div class="container-fluid">
            <div class="card" style="padding:2%;padding-bottom:0px;background:#fcfcfc;">
                <div class="header">
                    <h4 class="title">Inscription
                        <a id="revenir" href="index.php" class="pull-right text-muted"><i class="pe-7s-back"></i> page de connexion</a> 
                    </h4>
                    <p class="category">* Tous les champs sont obligatoire</p>
                </div>

                <div class="content">
                    <form action="" id="mainForm" method="post">
                        <!--<label style="margin-bottom: 10px;" class="category">Information personelles</label>-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>email</label>
                                    <input type="email" name="mailcher" class="form-control" placeholder="Votre email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>mot de passe</label>
                                    <input type="password" name="pwdcher" class="form-control" placeholder="Mot de passe" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>confirmer mot de passe</label>
                                    <input type="password" name="pwdcherconf" class="form-control" placeholder="Confirmer mot de passe" required>
                                    <div style="margin-top:5px;margin-left:2px;" id="msgConfMdp" class="text-danger" hidden>Veuillez saisir le même mot de passe</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>nom</label>
                                    <input type="text" name="nomcher" class="form-control" placeholder="Votre Nom" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>grade</label>
                                    <select required class="form-control selectpicker" name="gradecher" id="gradecher">
                                        <option value="doc">Doc.</option>
                                        <option value="mab">MAB</option>
                                        <option value="maa">MAA</option>
                                        <option value="mcb">MCB</option>
                                        <option value="mca">MCA</option>
                                        <option value="prof">PROF.</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input" type="radio" name="profilcher" value="permanent">
                                    <label class="form-check-label">Permanent</label>
                                    <input required style="margin-left:10px;" class="form-check-input" type="radio" name="profilcher" value="doctorant">
                                    <label class="form-check-label">Doctorant</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>status</label>
                                    <select required class="form-control selectpicker" name="statuscher" id="statuscher">
                                        <option selected value="chercheur">Chercheur</option>
                                        <option value="chefequipe">Chef d'équipe</option>
                                        <option value="cheflabo">Chef de labo</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--<p style="margin-top:10px;margin-bottom: 10px;" class="category">Information d'affiliation</p>-->
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>établissement</label>
                                    <select required class="selectpicker form-control" data-live-search="true" name="etabcher" id="etabcher" title="Etablissement...">
                                        <?php
                                            $sql = "SELECT * FROM etablissement";
                                            if($result = mysqli_query($db,$sql)){
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $idetab = $row["idetab"];
                                                    $nometab = $row["nom"];
                                                    echo '<option value="'.$idetab.'">'.$nometab.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Domaine</label>
                                    <select required class="form-control selectpicker"  name="codeDomaine" id="codeDomaine">
                                        <option selected value="all">Tous les domaines</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Laboratoire</label>
                                    <select required class="form-control selectpicker" data-live-search="true"  name="idlabo" id="idlabo" title="Laboratoire...">
                                            
                                    </select>
                                </div>
                            </div>
                        </div>
                       <div id="champEquipe" class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>équipe</label>
                                    <select required class="form-control selectpicker" name="idequip" id="idequip" title="Equipe...">
                                            
                                    </select>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row" style="margin-bottom:0px;margin-top:10px;">
                            <div class="col-md-12">
                                <button style="width:30%;" type="submit" class="btn btn-fill btn-info pull-right ">S'inscrire</button>
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


    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <!-- J-CONFIRM JS -->
    <script src="assets/j-confirm/j-confirm.js"></script>

    <!-- BOOTSTRAP SELECT JS -->
    <script src="assets/select/bootstrap-select.min.js"></script>
    
    <script>
        $(document).ready(function(){
            
            $("#etabcher").change(function(){
                $("#codeDomaine").html('<option selected value="all">Tous les domaines</option>');
                $("#codeDomaine").selectpicker("refresh");
                var idetab = $(this).val();
                $.get("ajax/inscriptionAjax.php",{idetab: idetab},function(data){
                    $("#codeDomaine").html($("#codeDomaine").html()+data);
                    $("#codeDomaine").selectpicker("refresh");
                }).done(function(){
                    $("#codeDomaine").trigger("change");
                });
            });

            $("#codeDomaine").change(function(){
                var codeDomaine = $(this).val();
                var nomDomaine = $('#codeDomaine option[value="'+codeDomaine+'"]').text();
                var idetab = $("#etabcher").val();
                if(codeDomaine != "all"){
                    $.get("ajax/inscriptionAjax.php",{idetab: idetab, codeDomaine: codeDomaine, nomDomaine: nomDomaine},function(data){
                        $("#idlabo").html(data);
                        $("#idlabo").selectpicker("refresh");
                    });
                }
                else{
                    $.get("ajax/inscriptionAjax.php",{idetab: idetab, codeDomaine: "all"},function(data){
                        $("#idlabo").html(data);
                        $("#idlabo").selectpicker("refresh");
                    });
                }
            });

            $("#idlabo").change(function(){
                var idlabo = $(this).val();
                $.get("ajax/inscriptionAjax.php",{idlabo: idlabo},function(data){
                    $("#idequip").html(data);
                    $("#idequip").selectpicker("refresh");
                });
            });
            
            $("#statuscher").change(function(){
                if($(this).val() == "cheflabo"){
                    $("#champEquipe").hide();
                    $("#idequip").prop("required",false);
                }
                else{
                    $("#champEquipe").show();
                    $("#idequip").prop("required",false);
                }
            });

            $("#clearBtn").click(function(){
                $(".form-control").val("");
                $(".selectpicker").selectpicker("refresh");
                $(".form-check-input").prop("checked",false);
            });

            $('input[name="pwdcherconf"]').keyup(function(){
                if($('input[name="pwdcher"]').val()!=$(this).val())
                    $("#msgConfMdp").prop("hidden",false);
                else
                    $("#msgConfMdp").prop("hidden",true);
            }); 

            <?php
                if(isset($display_notif) && $display_notif == true)
                {
                    if($display_type == "success")
                        echo '$.notify({
                            icon : "pe-7s-angle-down-circle",
                            title : "Succès !",
                            message : "Demande d\'inscription envoyée avec succès"
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
                            message : "Envoie de la demande d\'inscription a échoué"
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
        });
    </script>
</html>
