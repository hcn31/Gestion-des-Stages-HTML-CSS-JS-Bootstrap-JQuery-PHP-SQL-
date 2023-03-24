<?php 
require_once dirname( __FILE__ ) . '/' . '../../session.php'; 
require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
?>

  
  <?php

$i=$_GET['idd'];//id offre
$NV=$_GET['niv'];// niveau
$sta=$_GET['Stat'];// statut

 $cne=$_SESSION['cne'];


$supp="UPDATE postuler SET STATUT='Refuse'  WHERE cne='$cne' and id_offre='$i' ";
$bdd->exec("$supp");
if(!strcmp($sta,"retenu"))
{
$req="SELECT * from postuler,offre where postuler.id_offre='$i' and niveau='$NV'";
$res=$bdd->query($req);

$tem=0;
while($tab=$res->fetch())
{
 if (!strcmp($tab["STATUT"],"1 liste attente")) 
                {
    $req2="UPDATE postuler SET STATUT='retenu'  WHERE cne='$tab[CNE]' and id_offre='$i'";
    $tem=1;
               } 
               
else {
    if (!strcmp($tab["STATUT"],"2 liste attente"))
          {
        $req2="UPDATE postuler SET statut='1 liste attente'   WHERE cne='$tab[CNE]' and id_offre='$i'";
        $tem=1;
          }
     else 
     {
    if (!strcmp($tab["STATUT"],"3 liste attente") ) {
        $req2="UPDATE postuler SET statut='2 liste attente'   WHERE cne='$tab[CNE]' and id_offre='$i'";
        $tem=1;
                                  }
    } 
    
    }
    if($tem==1){    $bdd->exec("$req2"); }
}
}
header("Location: Vosstage.php");   

?>

