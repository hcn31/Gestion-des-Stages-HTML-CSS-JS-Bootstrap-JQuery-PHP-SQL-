<?php
try{
    $bdd= new PDO("mysql:host=localhost;dbname=projet6","root","");
}
    catch(PDOException $e)
    {
        echo "votre connection n'est pas reussi ". $e->getMessage();
    }



    $ccu=date("Y-m-d");
    $fer="UPDATE offre SET STATE='fermé' WHERE FIN <= '$ccu'";
    $bdd->exec($fer);
    
    
    
    
    /// test completed 
    $req10="SELECT * from offre ";
    $r20=$bdd->query($req10);
       $res20=$r20->fetchAll(PDO::FETCH_ASSOC);
       /// Pour chaque offre 
       foreach($res20 as $g) :
           $id=$g['ID_OFFRE'];
    
           $req11="SELECT count(*) from postuler WHERE ID_OFFRE='$id' and STATUT='Accepter'";
    
    $r21=$bdd->query($req11);
       $res21=$r21->fetch(2);
       if($res21['count(*)']== $g['Nombre']) /// Si ona atteint le nombre dans l'offre x mettre offre comme completé
       {
    
           $fer="UPDATE offre SET offre.State = 'completed'  where offre.ID_OFFRE = '$id' ";
         $bdd->exec($fer);
       }
    
       endforeach ;
    
    /// test rouvrir
    
       $op1="SELECT COUNT(*),ID_OFFRE from postuler WHERE STATUT='Refuse' GROUP BY ID_OFFRE" ;
    $open1=$bdd->query($op1);
     $open=$open1->fetchAll(PDO::FETCH_ASSOC);
    
       foreach($open as $o) :
    
    $ido=$o['ID_OFFRE'];
    
    
    $ope="SELECT * from offre WHERE ID_OFFRE='$ido'";
    $open2=$bdd->query($ope);
       $open3=$open2->fetch(2);
    
    
    $acc="SELECT COUNT(*) from postuler WHERE STATUT='Accepter' and ID_OFFRE = '$ido'";
    $acc1=$bdd->query($acc);
       $acc3=$acc1->fetch(2);
    
       $var3=$open3['Nombre']-$acc3['COUNT(*)'];
       
           
   $op5="SELECT COUNT(*),ID_OFFRE from postuler WHERE STATUT='1 liste attente' OR STATUT='2 liste attente' OR STATUT='3 liste attente' and ID_OFFRE = '$ido' " ;
   $open7=$bdd->query($op5);
    $open5=$open7->fetch(PDO::FETCH_ASSOC);

    
    $var1=$o['COUNT(*)'];
    $var=$open3['Nombre']+$open5['COUNT(*)']-$var1 ;
           
    
       if($var < $open3['Nombre'] && $open3['State'] !='completed' ) 
       {
    
           $ouv="UPDATE offre SET offre.State = 'new',offre.Nombre=".$var3." where offre.ID_OFFRE = '$ido' ";
         $bdd->exec($ouv);
       }
    endforeach;
    
    
    
    


    /*//////////////////////////////
// test ferme
$ccu=date("Y-m-d");
$fer="UPDATE offre SET STATE='fermé' WHERE FIN <= '2022-06-13'";
$bdd->exec($fer);




/// test completed 
$AA="SELECT * from offre ";
$AA2=$bdd->query($AA);
   $AA3=$AA2->fetchAll(PDO::FETCH_ASSOC);
   /// Pour chaque offre 
   foreach($AA3 as $g1) :
   	$id11=$g1['ID_OFFRE'];

   	$BB="SELECT count(*) from postuler WHERE ID_OFFRE='$id11' and STATUT='Accepter'";

$BB2=$bdd->query($BB);
   $BB3=$BB2->fetch(2);
   if($BB3['count(*)']== $g1['Nombre']) /// Si ona atteint le nombre dans l'offre x mettre offre comme completé
   {

   	$fer1="UPDATE offre SET offre.State = 'completed'  where offre.ID_OFFRE = '$id11' ";
     $bdd->exec($fer1);
   }

   endforeach ;

/// test rouvrir

   $CC="SELECT COUNT(*),ID_OFFRE from postuler WHERE STATUT='Refuse' GROUP BY ID_OFFRE" ;
$CC2=$bdd->query($CC);
 $CC3=$CC2->fetchAll(PDO::FETCH_ASSOC);

   foreach($CC3 as $o1) :

$ido1=$o1['ID_OFFRE'];


$ope="SELECT * from offre WHERE ID_OFFRE='$ido1'";
$open2=$bdd->query($ope);
   $open3=$open2->fetch(2);


$acc="SELECT COUNT(*) from postuler WHERE STATUT='Accepter' and ID_OFFRE = '$ido1'";
$acc1=$bdd->query($acc);
   $acc3=$acc1->fetch(2);

   $var3=$open3['Nombre']-$acc3['COUNT(*)'];

   $op5="SELECT COUNT(*),ID_OFFRE from postuler WHERE STATUT='1 liste attente' OR STATUT='2 liste attente' OR STATUT='3 liste attente' and ID_OFFRE = '$ido1' " ;
$open5=$bdd->query($op5);
 $open5=$open5->fetch(PDO::FETCH_ASSOC);
   	
$var11=$open5['COUNT(*)'];
$var2=$open3['Nombre']+$open5['COUNT(*)']-$var11 ;
   	

   if($var2 < $open3['Nombre'] && $open3['State'] !='completed' ) 
   {

   	$ouv="UPDATE offre SET offre.State = 'new',offre.Nombre=".$var3." where offre.ID_OFFRE = '$ido1' ";
     $bdd->exec($ouv);
	 $n="DELETE FROM postuler WHERE ID_OFFRE='$ido1'";
	 $bdd->exec($n);
   }
endforeach;
*/
?>