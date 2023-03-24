<?php

require_once dirname( __FILE__ ) . '/' . '../../session.php';
require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 


$num=$_POST["numStage"];
$noteent=$_POST["ENTNOTE"];

$reqIns="UPDATE stage SET NOTEENT='$noteent' WHERE NUM='$num'";
$bdd->exec($reqIns);

$req="SELECT * FROM juger WHERE NUM='$num'";
$res=$bdd->query($req);

while($tab=$res->fetch()){
$nt=$_POST[$tab['ID_PROF']];
    $reqIns="UPDATE juger SET NOTE='$nt' WHERE NUM='$num' and ID_PROF='$tab[ID_PROF]' ";
    $bdd->exec($reqIns);

}
header('location: JuryAndRapp.php'); 


?>
