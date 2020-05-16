<?php

   require_once("config.php");
   session_start();
   
   if(isset($_GET["logout"]) && $_GET["logout"] == 1)
        session_unset();

   if (isset($_SESSION["loggedinadmin"]) && $_SESSION["loggedinadmin"] == true)
        header("location: adminGererDemande.php");
    if (isset($_SESSION["loggedinlabo"]) && $_SESSION["loggedinlabo"] == true)
        header("location: laboGererDemande.php");
    if (isset($_SESSION["loggedinequipe"]) && $_SESSION["loggedinequipe"] == true)
        header("location: laboGererDemande.php");
    if (isset($_SESSION["loggedinchercheur"]) && $_SESSION["loggedinchercheur"] == true)
        header("location: gererProduction.php");
    
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = mysqli_real_escape_string($db,$_POST["login"]);
    $password = mysqli_real_escape_string($db,$_POST["password"]);

    switch($_POST["profil"]) {
        case 'admin':
            $sql = " SELECT * FROM admin WHERE login = '".$login."' AND password = '".$password."'";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) == 1) {
                $_SESSION["mail"] = $login;
                $_SESSION["loggedinadmin"] = true;
                header("location: adminGererDemande.php");
            }
            else $erreurLogin = '<div id="incorrect">Email ou mot de passe incorrect</div>';  
        break;
        case 'chefLabo':
            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                SELECT idcher FROM users WHERE mail = '".$login."' AND password = '".$password."' AND actif='1'
            ) AND idcher IN (
                SELECT idcher FROM cheflabo
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                if($row['gradeC'] == 'Directeur de recherche')
                    $_SESSION['ddr'] = true;
                $_SESSION["idcher"]= $idcher = $row["idcher"];
                $_SESSION["nom"] = $row["nom"];
                $_SESSION["loggedinlabo"] = true;
                $sql = "SELECT * FROM equipe WHERE idequipe IN (
                    SELECT idequipe FROM chefequip WHERE idcher='".$idcher."'
                )";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $_SESSION["idequipe"] = $row["idequipe"];
                    $_SESSION["nomequip"] = $row["nomequip"]; 
                }
                $sql = "SELECT * FROM laboratoire WHERE idlabo IN (
                    SELECT idlabo FROM cheflabo WHERE idcher='".$idcher."'
                )";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $_SESSION["idlabo"] = $row["idlabo"];
                    $_SESSION["nomlabo"] = $row["nom"]; 
                }
                header("location: laboGererDemande.php");
            }
            else $erreurLogin = '<div id="incorrect">Email ou mot de passe incorrect</div>';
        break;

        case 'chefEquipe':
            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                SELECT idcher FROM users WHERE mail = '".$login."' AND password = '".$password."' AND actif='1'
            ) AND idcher IN (
                SELECT idcher FROM chefequip
            )AND idcher NOT IN (
                SELECT idcher FROM cheflabo
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                if($row['gradeC'] == 'Directeur de recherche')
                    $_SESSION['ddr'] = true;
                $_SESSION["idcher"]= $idcher = $row["idcher"];
                $_SESSION["nom"] = $row["nom"];
                $_SESSION["loggedinequipe"] = true;
                $sql = "SELECT * FROM equipe WHERE idequipe IN (
                    SELECT idequipe FROM chefequip WHERE idcher='".$idcher."'
                )";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $_SESSION["idequipe"] = $row["idequipe"];
                    $_SESSION["nomequip"] = $row["nomequip"]; 
                }
                $sql = "SELECT * FROM laboratoire WHERE idlabo IN (
                    SELECT idlabo FROM equipe WHERE idequipe IN (
                        SELECT idequipe FROM chefequip WHERE idcher='".$idcher."'
                    )
                )";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $_SESSION["idlabo"] = $row["idlabo"];
                    $_SESSION["nomlabo"] = $row["nom"]; 
                }
                header("location: laboGererDemande.php");
            }
            else $erreurLogin = '<div id="incorrect">Email ou mot de passe incorrect</div>';
        break;

        case 'chercheur':
            $sql = "SELECT * FROM chercheur WHERE idcher IN (
                SELECT idcher FROM users WHERE mail = '".$login."' AND password = '".$password."' AND actif='1'
            ) AND idcher IN (
                SELECT idcher FROM menbrequip
            )";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                if($row['gradeC'] == 'Directeur de recherche')
                    $_SESSION['ddr'] = true;
                $_SESSION["idcher"]= $idcher = $row["idcher"];
                $_SESSION["nom"] = $row["nom"];
                $_SESSION["loggedinchercheur"] = true;
                $sql = "SELECT * FROM equipe WHERE idequipe IN (
                    SELECT idequipe FROM menbrequip WHERE idcher='".$idcher."'
                )";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $_SESSION["idequipe"] = $row["idequipe"];
                    $_SESSION["nomequip"] = $row["nomequip"]; 
                }
                $sql = "SELECT * FROM laboratoire WHERE idlabo IN (
                    SELECT idlabo FROM equipe WHERE idequipe IN (
                        SELECT idequipe FROM menbrequip WHERE idcher='".$idcher."'
                    )
                )";
                $result = mysqli_query($db,$sql);
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $_SESSION["idlabo"] = $row["idlabo"];
                    $_SESSION["nomlabo"] = $row["nom"]; 
                }
                header("location: gererProduction.php");
            }
            else $erreurLogin = '<div id="incorrect">Email ou mot de passe incorrect</div>';
        break;

        default:
        break;
    }     
   
}
  
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS 
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->

    <title>Plateforme Scientifique</title>
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /><link rel="canonical" href="https://codepen.io/frytyler/pen/EGdtg" />

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'><script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
<style class="cp-pen-styles">@import url(https://fonts.googleapis.com/css?family=Open+Sans);
.btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
.btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
.btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
.btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
.btn-primary.active { color: rgba(255, 255, 255, 0.75); }
.btn-primary { background-color: #4a77d4; background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4); background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4)); background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4); background-image: -o-linear-gradient(top, #6eb6de, #4a77d4); background-image: linear-gradient(top, #6eb6de, #4a77d4); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);  border: 1px solid #3762bc; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #4a77d4; }
.btn-block { width: 100%; display:block; }

* { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

html { width: 100%; height:100%; overflow:hidden; }

body { 
	width: 100%;
	height:100%;
	font-family: 'Open Sans', sans-serif;
	background: #092756;
	background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
}
.login { 
	position: absolute;
	top: 45%;
	left: 45%;
	margin: -150px 0 0 -150px;
	width:400px;
	height:300px;
}
.login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }

input ,select{ 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus, select:focus  { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }

option{
    width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.5);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 15px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;   
}

#incorrect{
    color: #ff4d4d;
}
#erreur-profil{
    position : relative;
    color : #ff4d4d;
    line-height: 1.15;
    margin-bottom : 10px;
}
#mdp-oublie{
    margin-bottom : 5px;
}
#inscrire{
    position : relative;
    left : 40%;
    color : #79aaf7;
}
</style></head><body>
<div class="login">
	<h1>Connexion</h1>
    <form action="" method="post">
    	<input type="text" name="login" placeholder="Email" required="required" />
        <input type="password" name="password" placeholder="Mot de passe" required="required" />
        <select name="profil" required class="form-control" class="selectpicker">
            <option value="" selected>Choisir</option>
            <option value="admin">Admin</option>
            <option value="chefLabo">Chef de labo</option>
            <option value="chefEquipe">Chef d'équipe</option>
            <option value="chercheur">Chercheur</option>
        </select>
       <!-- <div id="erreur-profil">Veuillez choisir un des profils</div> -->
       <?php if(isset($erreurProfil)) echo $erreurProfil; ?>
        <button type="submit" class="btn btn-primary btn-block btn-large">Se connecter</button>
   
    </form>
    <div style="margin-bottom : 10px;" ><a id="mdp-oublie" style="color:grey;" href="mdpoublie.php">Mot de passe oublié ?</a> <a id="inscrire" href="inscription.php">S'inscrire</a></div>
    <?php if(isset($erreurLogin)) echo $erreurLogin; ?>
</div>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="assets/js/jquery.3.2.1.min.js"></script>
<!--<script src="js/popper.js"></script>-->
<script src="assets/js/bootstrap.min.js"></script>
  </body>
  </html>