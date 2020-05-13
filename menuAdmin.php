<?php 
    function menu($i){
        if($i == -1){
            echo '<li>
            <a href="adminGererDemande.php">
                <i class="pe-7s-id"></i>
                <p style="font-size:11px">Demandes d\'inscription</p>
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
                    <p style="font-size:9px">Fixer le barème de notation</p>
                </a>
            </li>
            <li>
                <a href="bilan.php">
                    <i class="pe-7s-graph3"></i>
                    <p>Bilan</p>
                </a>
            </li>';
        }
        else{
            $class = array();
            for ($j=0; $j < $i; $j++) { 
                $class[$j] = ''; 
            }
            $class[$i] = 'class="active"';
            for ($j=++$i; $j < 6; $j++) { 
                $class[$j] = ''; 
            }
            echo '<li '.$class[0].'>
            <a href="adminGererDemande.php">
                <i class="pe-7s-id"></i>
                <p style="font-size:11px">Demandes d\'inscription</p>
            </a>
            </li>
            <li '.$class[1].'>
                <a href="adminGererEtab.php">
                    <i class="pe-7s-culture"></i>
                    <p>Gerer Etablissement</p>
                </a>
            </li>
            <li '.$class[2].'>
                <a href="adminGererLabo.php">
                    <i class="pe-7s-science"></i>
                    <p>Gerer Laboratoire</p>
                </a>
            </li>
            <li '.$class[3].'>
                <a href="adminGererCompte.php">
                    <i class="pe-7s-users"></i>
                    <p>Gerer Compte</p>
                </a>
            </li>
            <li '.$class[4].'>
                <a href="adminFixerNotation.php">
                    <i class="pe-7s-news-paper"></i>
                    <p style="font-size:9px">Fixer le barème de notation</p>
                </a>
            </li>
            <li '.$class[5].'>
                <a href="bilan.php">
                    <i class="pe-7s-graph3"></i>
                    <p>Bilan</p>
                </a>
            </li>';
        }
    }
?>