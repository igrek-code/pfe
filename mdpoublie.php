<?php
    require_once("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $display_notif = true;
        $error = true;
        if(isset($_POST["mail"]) && $_POST["mail"] != ""){
            $mail = mysqli_real_escape_string($db,$_POST["mail"]);
            $sql = "SELECT * from users WHERE mail='".$mail."'";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0){
                $pwd = randomPassword();
                $sql = "UPDATE users SET password='".$pwd."' WHERE mail='".$mail."'";
                if(mysqli_query($db,$sql)) {
                    // the message
                    //$msg = "Votre nouveau mot de passe:\n".$pwd;
                    //$subject = "Mot de passe réinitialiser (Plateforme scientifique)";
                    // use wordwrap() if lines are longer than 70 characters
                    //$msg = wordwrap($msg,70);

                    // send email
                    //mail($mail,$subject,$msg);
                    $error = false;
                }
            }
        }

        if(!$error) $display_type = "success";
        else $display_type = "error";
    }

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
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
<div style="width:100%;height:100%;background: #d4c4f2;">
    <div style="position:relative; width:50%; left:25%; right:25%;height:80%;top:10%;bottom:10%;" class="content">
        <div class="container-fluid">
            <div class="card" style="padding:2%;padding-bottom:0px;background:#fcfcfc;">
                <div class="header">
                    <h4 class="title">Mot de passe oublié
                        <a id="revenir" href="index.php" class="pull-right text-muted"><i class="pe-7s-back"></i> page de connexion</a> 
                    </h4>
                    <p class="category">Un nouveau mot de passe vous sera envoyé</p>
                </div>

                <div class="content">
                    <form action="" id="mainForm" method="post">
                        <!--<label style="margin-bottom: 10px;" class="category">Information personelles</label>-->
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="mail" type="email" class="form-control" required placeholder="Votre Email" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom:0px;margin-top:10px;">
                            <div class="col-md-12">
                                <button style="width:30%;" type="submit" class="btn btn-fill btn-info pull-right ">Envoyer</button>
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
            
            $("#clearBtn").click(function(){
                $("input").val("");
            });

            <?php
                if(isset($display_notif) && $display_notif == true)
                {
                    if($display_type == "success")
                        echo '$.notify({
                            icon : "pe-7s-angle-down-circle",
                            title : "Succès !",
                            message : "Votre mot de passe a été réinitialiser !"
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
                            message : "Votre mot de passe n\'a pas pu être réinitialiser !"
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
