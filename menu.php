<?php
    if(isset($_SESSION["loggedinlabo"]) && $_SESSION["loggedinlabo"]){
        function menu($i){
            if($i == -1){
                echo '<li>
                <a href="laboGererDemande.php">
                    <i class="pe-7s-id"></i>
                    <p style="font-size:11px">Demandes d\'inscription</p>
                </a>
            </li>
    
            <li>
                <a href="laboValiderProduction.php">
                    <i class="pe-7s-check"></i>
                    <p>Valider Production</p>
                </a>
            </li>
    
            <li>
                <a href="gererProduction.php">
                    <i class="pe-7s-notebook"></i>
                    <p>gerer production</p>
                </a>
            </li>
            <li>
                <a href="recherche.php">
                    <i class="pe-7s-search"></i>
                    <p>recherche</p>
                </a>
            </li>
            <li>
                <a href="laboGererEquipe.php">
                    <i class="pe-7s-network"></i>
                    <p>Gerer Equipe</p>
                </a>
            </li>
            <li>
                <a href="equipeGererMembre.php">
                    <i class="pe-7s-users"></i>
                    <p>Gerer Membre Equipe</p>
                </a>
            </li>
            <li>
                <a href="bilanLabo.php">
                    <i class="pe-7s-graph3"></i>
                    <p>Bilan</p>
                </a>
            </li>';
            }else{
                for ($j=0; $j < $i; $j++) { 
                    $class[$j] =  "";
                 }
                 $class[$i] =  'class="active"';
                 for ($j=$i+1; $j < 7; $j++) { 
                     $class[$j] =  "";
                 }
                 $db = mysqli_connect('localhost','root','','projetfetud');
                 $sql = "SELECT count(*) FROM notification WHERE admin=1";
                 $result = mysqli_query($db,$sql);
                 $count = mysqli_fetch_array($result)['count(*)'];
                 echo '
                 <li '.$class[0].'>
                 <a href="notification.php">
                     <i class="pe-7s-bell"></i>
                     <p>Notifications <span style="position: absolute;
                     background-color: #FB404B;
                     text-align: center;
                     border-radius: 10px;
                     min-width: 18px;
                     padding: 0 5px;
                     height: 18px;
                     font-size: 12px;
                     color: #FFFFFF;
                     font-weight: bold;
                     line-height: 18px;
                     top: 6px;
                     left: 10px;">'.$count.'</span></p>
                 </a>
             </li>
                 <li>
                 <a href="laboGererDemande.php">
                     <i class="pe-7s-id"></i>
                     <p style="font-size:11px">Demandes d\'inscription</p>
                 </a>
             </li>
     
             <li '.$class[1].'>
                 <a href="laboValiderProduction.php">
                     <i class="pe-7s-check"></i>
                     <p>Valider Production</p>
                 </a>
             </li>
     
             <li '.$class[2].'>
                 <a href="gererProduction.php">
                     <i class="pe-7s-notebook"></i>
                     <p>gerer production</p>
                 </a>
             </li>
             <li '.$class[3].'>
                 <a href="recherche.php">
                     <i class="pe-7s-search"></i>
                     <p>recherche</p>
                 </a>
             </li>
             <li '.$class[4].'>
                 <a href="laboGererEquipe.php">
                     <i class="pe-7s-network"></i>
                     <p>Gerer Equipe</p>
                 </a>
             </li>
             <li '.$class[5].'>
                 <a href="equipeGererMembre.php">
                     <i class="pe-7s-users"></i>
                     <p>Gerer Membre Equipe</p>
                 </a>
             </li>
             <li '.$class[6].'>
                 <a href="bilanLabo.php">
                     <i class="pe-7s-graph3"></i>
                     <p>Bilan</p>
                 </a>
             </li>';
            }


        }
    }

    if(isset($_SESSION["loggedinequipe"]) && $_SESSION["loggedinequipe"]){
        function menu($i){
            if($i == -1){
                echo '<li>
                <a href="laboGererDemande.php">
                    <i class="pe-7s-id"></i>
                    <p style="font-size:11px">Demandes d\'inscription</p>
                </a>
            </li>
    
            <li>
                <a href="laboValiderProduction.php">
                    <i class="pe-7s-check"></i>
                    <p>Valider Production</p>
                </a>
            </li>

            <li>
                <a href="gererProduction.php">
                    <i class="pe-7s-notebook"></i>
                    <p>gerer production</p>
                </a>
            </li>
            <li>
                <a href="recherche.php">
                    <i class="pe-7s-search"></i>
                    <p>recherche</p>
                </a>
            </li>
            <li>
                <a href="laboModifierEquipe.php">
                    <i class="pe-7s-network"></i>
                    <p>Modifier Equipe</p>
                </a>
            </li>
            <li>
                <a href="equipeGererMembre.php">
                    <i class="pe-7s-users"></i>
                    <p>Gerer Membre Equipe</p>
                </a>
            </li>
            <li>
                <a href="bilanEquipe.php">
                    <i class="pe-7s-graph3"></i>
                    <p>Bilan</p>
                </a>
            </li>';
            }else{
                for ($j=0; $j < $i; $j++) { 
                    $class[$j] =  "";
                 }
                 $class[$i] =  'class="active"';
                 for ($j=$i+1; $j < 6; $j++) { 
                     $class[$j] =  "";
                 }
     
                 echo '<li '.$class[0].'>
                 <a href="laboGererDemande.php">
                     <i class="pe-7s-id"></i>
                     <p style="font-size:11px">Demandes d\'inscription</p>
                 </a>
             </li>

             <li '.$class[1].'>
                <a href="laboValiderProduction.php">
                    <i class="pe-7s-check"></i>
                    <p>Valider Production</p>
                </a>
            </li>
     
             <li '.$class[2].'>
                 <a href="gererProduction.php">
                     <i class="pe-7s-notebook"></i>
                     <p>gerer production</p>
                 </a>
             </li>
             <li '.$class[3].'>
                 <a href="recherche.php">
                     <i class="pe-7s-search"></i>
                     <p>recherche</p>
                 </a>
             </li>
             <li '.$class[4].'>
                 <a href="laboModifierEquipe.php">
                     <i class="pe-7s-network"></i>
                     <p>Modifier Equipe</p>
                 </a>
             </li>
             <li '.$class[5].'>
                 <a href="equipeGererMembre.php">
                     <i class="pe-7s-users"></i>
                     <p>Gerer Membre Equipe</p>
                 </a>
             </li>
             <li '.$class[6].'>
                 <a href="bilanEquipe.php">
                     <i class="pe-7s-graph3"></i>
                     <p>Bilan</p>
                 </a>
             </li>';
            }


        }
    }

    if(isset($_SESSION["loggedinchercheur"]) && $_SESSION["loggedinchercheur"]){
        function menu($i){
            if($i == -1){
                echo '
    
            <li>
                <a href="gererProduction.php">
                    <i class="pe-7s-notebook"></i>
                    <p>gerer production</p>
                </a>
            </li>
            <li>
                <a href="recherche.php">
                    <i class="pe-7s-search"></i>
                    <p>recherche</p>
                </a>
            </li>
            <li>
                <a href="bilanCher.php">
                    <i class="pe-7s-graph3"></i>
                    <p>Bilan</p>
                </a>
            </li>';
            }else{
                for ($j=0; $j < $i; $j++) { 
                    $class[$j] =  "";
                 }
                 $class[$i] =  'class="active"';
                 for ($j=$i+1; $j < 3; $j++) { 
                     $class[$j] =  "";
                 }
     
                 echo '
     
             <li '.$class[0].'>
                 <a href="gererProduction.php">
                     <i class="pe-7s-notebook"></i>
                     <p>gerer production</p>
                 </a>
             </li>
             <li '.$class[1].'>
                 <a href="recherche.php">
                     <i class="pe-7s-search"></i>
                     <p>recherche</p>
                 </a>
             </li>
             <li '.$class[2].'>
                 <a href="bilanCher.php">
                     <i class="pe-7s-graph3"></i>
                     <p>Bilan</p>
                 </a>
             </li>';
            }


        }
    }

?>