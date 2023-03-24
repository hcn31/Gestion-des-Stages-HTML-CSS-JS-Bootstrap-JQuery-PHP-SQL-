<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJOUTER Entreprise</title>
</head>
<body>

<form action="lien1.php" method="POST" enctype="multipart/form-data">
<div class="modal" id="myModal1">
 <div class="modal-dialog">
<div class="modal-content">
<div class="modal-header  text-black" >
<h5 class="modal-title">Nouvelle Entreprise</h5>
 <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
</div>
 <div class="modal-body">
<!---   Nom --->
<label class="form-label">Identifiant Commun de L'Entreprise (ICE)</label>
<input class="form-control" name="idEntr">
<br>
<!---   Nom --->
<label class="form-label">Nom</label>
<input class="form-control" name="nameEntr">
<br>
<!--- Adresse --->
<label  class="form-label">Adresse</label>
<input class="form-control" name="adr">
<br>

<!--- Email & Tel--->
<div class="row g-1">
  <div class="col" style="margin-right: 12px;">
    <label  class="form-label">Email</label>
    <input type="email" class="form-control" name="em"> 
  </div>
  <div class="col">
    <label  class="form-label">Tel</label>
    <input type="close-link" class="form-control" name="tel"> 
  </div>
</div>
<br>
<!--- logo & site --->
<div class="row g-1">
  <div class="col" style="margin-right: 12px;">
    <label  class="form-label">Logo</label>
    <input type="file" class="form-control" name="logo"> 
  </div>
  <div class="col">
    <label  class="form-label">Site</label>
    <input type="close-link" class="form-control" name="site"> 
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


    
</body>
</html>


































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