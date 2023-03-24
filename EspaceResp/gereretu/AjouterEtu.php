<?php
function generate_password($length){
  $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
            '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';

  $str = '';
  $max = strlen($chars) - 1;

  for ($i=0; $i < $length; $i++)
    $str .= $chars[random_int(0, $max)];

  return $str;
}
$pass=generate_password(8);

?>
<form  method="POST" enctype="multipart/form-data">
<div class="modal" id="myModal">
 <div class="modal-dialog">
<div class="modal-content">
<div class="modal-header  text-black" >
<h5 class="modal-title">Nouveau Etudiant</h5>
 <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
</div>
 <div class="modal-body">
    
     <!-- image -->
<!--- row1 --->
<div class="row g-1">

  <div class="col">
    <label  class="form-label">Cne</label>
    <input type="text" class="form-control" name="cne1" required> 
  </div>
  <div class="col">
    <label  class="form-label">Date de naissane</label>
    <input type="date" class="form-control" name="naissane1" required> 
  </div>
</div>
<br>
<!--- row2 --->
<div class="row g-1">
<div class="col">
    <label  class="form-label">Nom</label>
    <input type="text" class="form-control" name="nom1" required> 
  </div>
  <div class="col">
    <label  class="form-label">Prenom</label>
    <input type="text" class="form-control" name="prenom1" required> 
  </div>
</div>
<br>


<!--- row4 --->
<!--- Nivau & nombre--->
<div class="row g-1">
  <div class="col" >
      <label  class="form-label">Niveau</label>
      <select name="niv1" class="form-control" required>
        <option  >--- Choisir ---</option>
        <?php 
          $nb3="SELECT * from niveau where id_formation='$f'";
          $r33=$bdd->query($nb3);
          $row33=$r33->fetchAll(2);
          foreach($row33 as $s3):
              ?>
        
        <option value="<?php echo $s3['NIVEAU']?>"><?php echo $s3['parcour']?></option>
        <?php endforeach; ?>
      </select>
  </div>
 <div class="col">
    <label  class="form-label">Date </label>
    <input type="date" class="form-control" name="dates1" required> 
  </div>
  
</div>
<br>
<!--- row5 --->
<div class="row g-1">
<div class="col">
    <label  class="form-label">ADRESSE</label>
    <input type="text" class="form-control" name="add1" required> 
  </div>
  <div class="col">
    <label  class="form-label">PHONE</label>
    <input type="text" class="form-control" name="tel1" required> 
  </div>
</div>
<br>

<!--- row6 --->
<div class="row g-1">
<div class="col" style="margin-right: 12px;">
    <label  class="form-label">PHOTO</label>
    <input type="file" class="form-control" name="logo"> 
  </div>
<div class="col">
    <label  class="form-label">EMAIL</label>
    <input type="text" class="form-control" name="email1" required> 
  </div> 
</div>
<br>
 </div>
 <input type="hidden" value="<?php echo ($pass)?>" name="pass"> 


<div class="modal-footer">
    <button type="submit" id="lolo" class="btn btn-primary btn-rounded">Enregistrer</button>
    <button type="reset" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark" data-bs-dismiss="modal">Annuler</button>
</div>
</div>
</div>
</div>
</form>

  </article >
</section>


<!-- partial -->
