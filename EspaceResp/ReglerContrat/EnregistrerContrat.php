<?php 
require_once dirname( __FILE__ ) . '/' . '../../session.php';
require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 

$numStage=$_POST["numStage"];

$reqE="SELECT * from stage,etudiant where stage.CNE=etudiant.CNE and NUM='$numStage'";
$resE=$bdd->query($reqE); 
$tabE=$resE->fetch();

$id_professeur=$_POST["Encadrant"];
$datedeb=$_POST["DateDeb"];
$datefiin=$_POST["DateF"];

$time1 = strtotime($tabE['DATE_DEBUT']); 
$time11 = strtotime($datedeb); 

$time2 = strtotime($tabE['DATE_FIN']); 
$time22 = strtotime($datefiin); 

if($time1!=$time11) 
            {
                $reqUpDD="UPDATE stage set DATE_DEBUT='$datedeb' WHERE NUM='$numStage'";
                $bdd->exec($reqUpDD);
            }
if($time2!=$time22) 
            {
                $reqUpDD="UPDATE stage set DATE_FIN='$datefiin' WHERE NUM='$numStage'";
                $bdd->exec($reqUpDD);
            }


$CNT=$tabE['NOM'].'_'.$tabE['PRENOM'].'_'.$tabE['CNE'].'.pdf';


$req="UPDATE stage set ID_PROF='$id_professeur', CONTRAT='$CNT' WHERE NUM='$numStage'";
            $bdd->exec($req);
            
$reqInsJury="INSERT INTO juger (ID_PROF,NUM) VALUE ('$id_professeur','$numStage')";
$bdd->exec($reqInsJury);
            header('location:Contrat.php');


?>




   

 
    


  
 