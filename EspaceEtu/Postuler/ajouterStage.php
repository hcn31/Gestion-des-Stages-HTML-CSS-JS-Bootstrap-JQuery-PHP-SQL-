<?php
   require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
   require_once dirname( __FILE__ ) . '/' . '../../session.php';
  $sujet=$_POST['sujet'];
   $date1=$_POST['datedebut'];
   $date2=$_POST['datefin'];
   $id=$_POST['id'];
   $nom=$_POST['Nom'];
   $email=$_POST['emailEnt'];
   $adr=$_POST['adresse'];
   $tel=$_POST['phone'];

   
$req2="INSERT INTO entreprise (ID,NOM,ADRESSE,EMAIL,TEL) VALUES ('$id','$nom','$adr','$email','$tel')";
$bdd->exec($req2);
$cne1=$_SESSION['cne'];  
$req1="INSERT INTO stage (CNE,ID,SUJET,DATE_DEBUT,DATE_FIN,GENRE) VALUES ('$cne1','$id','$sujet','$date1','$date2','2')";
$bdd->exec($req1);
header('location: postuler.php');

?>