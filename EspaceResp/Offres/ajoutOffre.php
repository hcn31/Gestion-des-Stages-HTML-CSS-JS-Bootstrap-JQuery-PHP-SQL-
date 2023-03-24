
<form action="lien.php" method="POST">
<div class="modal" id="myModal">
 <div class="modal-dialog">
<div class="modal-content">
<div class="modal-header  text-black" >
<h5 class="modal-title">Nouveau Offre</h5>
 <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
</div>
 <div class="modal-body">
<!--- Sujet --->
<label for="message" class="form-label">Sujet</label>
<textarea class="form-control" name="sjt"></textarea>
<br>
<!--- Entreprise --->
<div class="row g-1">
  <div class="col" >
<label for="message" class="form-label">Entreprise</label>
<!-------
<a data-mdb-ripple-color="dark" data-bs-target="#myModal1" data-bs-toggle="modal"><i class="fas fa-exclamation-circle trailing pe-auto" style='cursor: pointer' id="plusEntr" ></i></a>
<input type="text" id="hid2">
--->
<select name="entr" class="form-control">
        <option selected>--- Choisir ---</option>
          <?php 
          $nb3="SELECT * from entreprise";
          $r33=$bdd->query($nb3);
          $row33=$r33->fetchAll(PDO::FETCH_ASSOC);
          foreach($row33 as $s3):
              ?>
        
        <option value="<?php echo $s3['ID']; ?>"><?php echo $s3['NOM']; ?></option>
        <?php endforeach; ?>
</select>
</div>


</div>















<br>
<!--- Date --->
<div class="row g-1">
  <div class="col" style="margin-right: 12px;">
    <label  class="form-label">Date début</label>
    <input type="date" class="form-control" name="date1"> 
  </div>
  <div class="col">
    <label  class="form-label">Date fin</label>
    <input type="date" class="form-control" name="date2"> 
  </div>
</div>

<br>
<!--- max date--->
<div class="row g-1">
  <div class="col" style="margin-right: 12px;">
    <label  class="form-label"> Fin d'Offre</label>
    <input type="date" class="form-control" name="date3"> 
  </div>
</div>
<!--- Nivau & nombre--->
<div class="row g-1" style="margin-top: 20px; ">
  <div class="col" style="margin-right: 12px;">
      <label  class="form-label">Niveau</label>
    <select name="niv" class="form-control">
        <option selected >--- Choisir ---</option>
          <?php 
         foreach($row3 as $s):
              ?>
        
        <option value="<?php echo $s['NIVEAU']; ?>"><?php echo $s['parcour']; ?></option>
        <?php endforeach; ?>
      </select>
  </div>
  <div class="col">
    <label  class="form-label">Le nombre de stages</label>
    <input type="number" class="form-control" name="nbr"> 
  </div>
</div>
 </div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
    <button type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark" data-bs-dismiss="modal">Annuler</button>
</div>
</div>
</div>
</div>
</form>



































<!---

        <div class="modal" id="secondModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header alert alert-success">
                        <h5 class="modal-title">Second Modal</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Message Received</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->