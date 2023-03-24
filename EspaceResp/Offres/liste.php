 <?php 
 require_once dirname( __FILE__ ) . '/' . '../../session.php';
 require_once dirname( __FILE__ ) . '/' . '../../connexion.php';



if(isset($_POST['principale']))
{

$delai=$_POST['delai'];

$current=date("Y-m-d");
$date1 = date("Y-m-d", strtotime($current.'+'.$delai.' days'));

$bdd->exec("UPDATE offre SET DELAI_REPONSE='$date1' WHERE ID_OFFRE='$id';");


   
$lis=$_POST['principale'];

 foreach($lis as $e)
 {
  $bdd->exec("UPDATE postuler SET STATUT='retenu' WHERE ID_OFFRE='$id' and CNE='$e';");
 }

 
$att1=$_POST['att1'];
$bdd->exec("UPDATE postuler SET STATUT='1 liste attente' WHERE ID_OFFRE='$id' and CNE='$att1';");
$att2=$_POST['att2'];
$bdd->exec("UPDATE postuler SET STATUT='2 liste attente' WHERE ID_OFFRE='$id' and CNE='$att2';");
$att3=$_POST['att3'];
$bdd->exec("UPDATE postuler SET STATUT='3 liste attente' WHERE ID_OFFRE='$id' and CNE='$att3';");
$bdd->exec("UPDATE postuler SET STATUT='Non retenu' WHERE ID_OFFRE='$id' and STATUT='postulé'");
$bdd->exec("UPDATE offre SET State='fermé' WHERE ID_OFFRE='$id'");


unset($_POST['principale']);
unset($lis);


}



?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<body>



<form action="" method="POST">
<div class="modal" id="myModal2" >
 <div class="modal-dialog" >
<div class="modal-content" >
<div class="modal-header  text-black" >
<h3 class="modal-title">Résultat Offre</h3>
 <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">

  <h4>Liste Pricipale</h4>
<select name="principale[]" class="selectpicker" multiple data-max-options="<?php echo $row5['Nombre']; ?>" data-live-search="true" title="Sélectionner les étudians retenus..." data-max-options-text="Cet offre comporte seulement <?php echo $row5['Nombre']; ?> stages">



 <?php 




 
 $OffEtu="SELECT * from etudiant,postuler where etudiant.CNE=postuler.CNE and postuler.ID_OFFRE='$id' and postuler.STATUT='postulé';";
$res10=$bdd->query($OffEtu);
  $row10=$res10->fetchall(PDO::FETCH_ASSOC);




foreach($row10 as $M): 

 ?>


<option value="<?php echo $M['CNE'];?>"><?php echo $M['CNE']." : ".$M['NOM']." ".$M['PRENOM'];   ?></option>
 <?php endforeach; ?>
</select>

<br>
<br>
<h4>Délai de réponse</h4>

  <input name="delai" type="number" class="form-control" />



  <hr />
  <h4>Liste d'Attente</h4>
<div style="margin-bottom: 10px;">
<select class="selectpicker"  data-live-search="true" title="1ér en liste d'attente" name="att1">
<?php
$OffEtu="SELECT * from etudiant,postuler where etudiant.CNE=postuler.CNE and postuler.ID_OFFRE='$id' and postuler.STATUT='postulé';";
$res10=$bdd->query($OffEtu);
  $row10=$res10->fetchall(PDO::FETCH_ASSOC);

 foreach($row10 as $M): ?>
<option  value="<?php echo $M['CNE'] ;?>"  ><?php echo $M['CNE']." : ".$M['NOM']." ".$M['PRENOM'];   ?></option> 
<?php endforeach; ?>
</select>
</div>

<div style="margin-bottom: 10px;">
<select   class="selectpicker"  data-live-search="true" title="2éme en liste d'attente" name="att2">
<?php
$OffEtu="SELECT * from etudiant,postuler where etudiant.CNE=postuler.CNE and postuler.ID_OFFRE='$id' and postuler.STATUT='postulé';";
$res10=$bdd->query($OffEtu);
  $row10=$res10->fetchall(PDO::FETCH_ASSOC);

 foreach($row10 as $M): ?>
<option  value="<?php echo $M['CNE'] ;?>"  ><?php echo $M['CNE']." : ".$M['NOM']." ".$M['PRENOM'];   ?></option> 
<?php endforeach; ?>
</select>
</div>

<div>
<select  class="selectpicker"  data-live-search="true" title="3éme en liste d'attente"  name="att3">
 <?php
$OffEtu="SELECT * from etudiant,postuler where etudiant.CNE=postuler.CNE and postuler.ID_OFFRE='$id' and postuler.STATUT='postulé';";
$res10=$bdd->query($OffEtu);
  $row10=$res10->fetchall(PDO::FETCH_ASSOC);

 foreach($row10 as $M): ?>
<option value="<?php echo $M['CNE'] ;?>" ><?php echo $M['CNE']." : ".$M['NOM']." ".$M['PRENOM'];   ?></option>
<?php endforeach; ?>
 </div> 
</select>
  
</div>



<div class="modal-footer">
    <button type="submit" class="btn btn-primary btn-rounded" id="enrg">Enregistrer</button>
    <button type="reset" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark" data-bs-dismiss="modal">Annuler</button>
</div>
</div>
</div>
</div>
</form>

</body>

</html>

























