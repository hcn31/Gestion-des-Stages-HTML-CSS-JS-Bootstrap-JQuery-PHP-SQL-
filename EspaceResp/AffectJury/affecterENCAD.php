<?php

require_once dirname( __FILE__ ) . '/' . '../../session.php';
require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 

$num=$_POST["numStage"];
$rapport_name=$_FILES['Raaaport']['name'];

$motcle=$_POST['MCLEE'];

if(!empty($rapport_name))
{
    $file_tmp_name=$_FILES['Raaaport']['tmp_name'];
move_uploaded_file($file_tmp_name,"Rapport/$rapport_name");
$ReqINSRpp="UPDATE stage SET RAPPORT='$rapport_name',MOTS='$motcle' WHERE NUM='$num'";      
$bdd->exec($ReqINSRpp);
}
$reqISModifable="SELECT * FROM stage WHERE NUM='$num'";
$reS=$bdd->query($reqISModifable);
$taBModif=$reS->fetch();

if(empty($taBModif["RAPPORT"]))
{
 $ReqDelete="DELETE FROM juger where NUM='$num' and ID_PROF NOT IN (SELECT ID_PROF FROM stage where NUM='$num')";
$bdd->exec($ReqDelete);

if(!empty($_POST['PROFENC']))
 {
    $selected = $_POST['PROFENC'];
    foreach($selected as $selectValue){
        $ReqINS="INSERT INTO juger (ID_PROF,NUM)
        VALUES ($selectValue,$num) ";      
        $bdd->exec($ReqINS);
        
 }
} 

}

else
{  $ReqINSRpp="UPDATE stage SET MOTS='$motcle' WHERE NUM='$num'"; 
    $bdd->exec($ReqINSRpp);
}
header('location: JuryAndRapp.php'); 

?>
