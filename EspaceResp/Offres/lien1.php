<?php
    
require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
require_once dirname( __FILE__ ) . '/' . '../../session.php';

$resp=$_SESSION['cne'];
       $r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $f=$ro['ID_FORMATION'];
     
 

$logo_nom=$_FILES['logo']['name'];
$file_tmp_name=$_FILES['logo']['tmp_name'];
move_uploaded_file($file_tmp_name,"../../EspaceEtu/img/LOGOENTRE/$logo_nom");

$idenr=$_POST['idEntr'];

$tab=array($_POST['idEntr'],$_POST['nameEntr'],$_POST['adr'],$_POST['em'],$_POST['tel'],$logo_nom,$_POST['site']);
$rr="INSERT INTO entreprise (ID,NOM,ADRESSE,EMAIL,TEL,LOGO,SITE) VALUES ('$tab[0]','$tab[1]','$tab[2]','$tab[3]',
'$tab[4]','$tab[5]','$tab[6]')";
$bdd->exec($rr);
$rq3="INSERT INTO collaborer (ID_FORMATION,ID) VALUES ('$f','$idenr');";
$bdd->exec($rq3);

header('location: offre.php');

    
?>