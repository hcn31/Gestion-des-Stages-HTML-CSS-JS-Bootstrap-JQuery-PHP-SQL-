<?php
    
require_once dirname(__FILE__) . '/' . '../../connexion.php';

$tab=array($_POST['sjt'],$_POST['entr'],$_POST['date1'],$_POST['date2'],$_POST['niv'],$_POST['nbr'],$_POST['date3'],);
var_dump($tab);
$rr="INSERT INTO offre (ID,SUJET,DATE_DEBUT,DATE_FIN,NIVEAU,Nombre,State,FIN) VALUES ('$tab[1]','$tab[0]','$tab[2]','$tab[3]','$tab[4]','$tab[5]','new','$tab[6]')";
$bdd->exec($rr);

header('location: offre.php');

    
?>