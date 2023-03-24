<?php
require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
$n=$_GET['num'];
  $req1="DELETE FROM `stage` WHERE NUM='$n'";
   $res1=$bdd->exec($req1);
   header('location: VerifStages.php');

?>