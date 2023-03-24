
<form  method="POST">
<div class="modal" id="myModal">
 <div class="modal-dialog">
<div class="modal-content">
<div class="modal-header  text-black" >
<h5 class="modal-title">Nouveau Enseignant</h5>
 <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
</div>
 <div class="modal-body">
    
     <!-- image -->
<!--- row1 --->
<div class="row g-1">

  <div class="col">
    <label  class="form-label">ID</label>
    <input type="text" class="form-control" name="id" required> 
  </div>
  <div class="col">
    <label  class="form-label">EMAIL</label>
    <input type="text" class="form-control" name="email" required> 
  </div>

</div>
<br>
<!--- row2 --->
<div class="row g-1">
<div class="col">
    <label  class="form-label">Nom</label>
    <input type="text" class="form-control" name="nom" required> 
  </div>
  <div class="col">
    <label  class="form-label">Prenom</label>
    <input type="text" class="form-control" name="prenom" required> 
  </div>
</div>
<br>

<!--- row3 --->
<div class="row g-1">
<div class="col">
    <label  class="form-label">ADRESSE</label>
    <input type="text" class="form-control" name="add" required> 
  </div>
  <div class="col">
    <label  class="form-label">PHONE</label>
    <input type="text" class="form-control" name="tel" required> 
  </div>
</div>
<br>

<!--- row4 --->
<div class="row g-1">
  
<div class="col">
    <label  class="form-label">Date de naissane</label>
    <input type="date" class="form-control" name="naissance" required> 
  </div>
  <div class="col">
    <label  class="form-label">Date de nommination </label>
    <input type="date" class="form-control" name="daten" required> 
 
  </div>
</div>
<br>
 </div>
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
