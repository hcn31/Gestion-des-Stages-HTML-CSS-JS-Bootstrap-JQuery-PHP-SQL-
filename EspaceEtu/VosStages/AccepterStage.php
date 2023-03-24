<?php 
require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
require_once dirname( __FILE__ ) . '/' . '../../session.php';
?>

  
  <?php

$i=$_GET['idd'];//id offre
$NV=$_GET['niv'];// niveau
$sta=$_GET['Stat'];// statut

 $cne=$_SESSION['cne'];

if(!strcmp($sta,"retenu")){
/*$supp="DELETE from postuler where cne='$cne' and id_offre<>'$i' ";
$bdd->exec("$supp");*/

$req2="UPDATE postuler SET STATUT='Accepter'  WHERE cne='$cne' and id_offre='$i'";
$bdd->exec("$req2");

//$reqstage="SELECT * from offre,entreprise,postuler where id_offre='$i' ";
$reqstage="SELECT * from offre where offre.ID_OFFRE='$i'";
$stat=$bdd->query($reqstage);

$resstage1=$stat->fetchAll(PDO::FETCH_ASSOC);
$resstage=$resstage1[0];
  


$idS=$resstage['ID'];
$idOffre=$resstage['ID_OFFRE'];
$Sujet=$resstage['SUJET'];
$DateDEb=$resstage['DATE_DEBUT'];
$DateFIN=$resstage['DATE_FIN'];


//echo $idS.' '. $idOffre .' '. $idSujet.' '.$cne.' '.$DateDEb.' '.$DateFIN;

 $req_inserer_stage="INSERT INTO stage (CNE,ID,ID_OFFRE,SUJET,DATE_DEBUT,DATE_FIN,GENRE) VALUES ('$cne',
'$idS','$idOffre','$Sujet','$DateDEb','$DateFIN','1')";

$bdd->exec("$req_inserer_stage"); 




}
header("Location: Vosstage.php");   

?>

