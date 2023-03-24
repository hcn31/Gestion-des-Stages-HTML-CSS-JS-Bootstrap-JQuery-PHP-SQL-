
<?php
require_once dirname(__FILE__) . '/' . '../../connexion.php';
require_once dirname(__FILE__) . '/' . '../../session.php';


$cne = $_GET['cne'];
$r = "SELECT ACTIVE FROM etudiant WHERE CNE='$cne' ";
$Smt1 = $bdd->query($r);
$ro = $Smt1->fetch(PDO::FETCH_ASSOC);
$v = 1 - $ro['ACTIVE'];
$req1 = "UPDATE etudiant set ACTIVE='$v' WHERE CNE='$cne'";
$bdd->exec($req1);
header('location:etudiant.php');


?>