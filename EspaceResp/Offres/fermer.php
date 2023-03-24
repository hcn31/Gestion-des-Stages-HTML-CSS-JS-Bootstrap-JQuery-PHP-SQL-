<?php
require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
$id=$_GET['idOffre'];

$req5="UPDATE offre SET State='ferme' WHERE ID_OFFRE='$id';";
$bdd->exec($req5);

header('location: offre.php');



?>