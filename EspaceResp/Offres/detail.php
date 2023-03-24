 <?php 
 require_once dirname( __FILE__ ) . '/' . '../../session.php';
 require_once dirname( __FILE__ ) . '/' . '../../connexion.php';

$id=$_GET['idOffre'];


 if(isset($_POST['sjt']))
{

$tab=array($_POST['sjt'],$_POST['d1'], $_POST['d2'], $_POST['n'], $_POST['niveau']);


$bdd->exec("UPDATE offre SET  SUJET='$tab[0]',DATE_DEBUT='$tab[1]',DATE_FIN='$tab[2]',Nombre='$tab[3]',NIVEAU='$tab[4]'  WHERE ID_OFFRE='$id'");




}


$req8="SELECT * from entreprise,offre where offre.ID=entreprise.ID and offre.ID_OFFRE='$id'";
$res8=$bdd->query($req8);
$row5=$res8->fetch(PDO::FETCH_ASSOC);



$resp=$_SESSION['cne'];
       $r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $f=$ro['ID_FORMATION'];

?>

<!DOCTYPE html>
<html>
<head>
  
  <meta charset="UTF-8">
  <title>Détail</title>
  
  
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

     <!-- Bootstrap -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"/>
  
 <!--------- For select modal ----->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<link rel="stylesheet" href="styleDetail.css">
<style type="text/css">
  .bootstrap-select {
width: 100% !important;
}
</style>
  


</head>
<body>
  
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <div style="float : right; padding-right: 7%;">
  <a href="" type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark" data-bs-target="#myModal2" data-bs-toggle="modal"><i class="fas fa-plus"></i> Résultats</a>
  </div>
  
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


  <article style="margin-top:16%;">




  <div class="main-content">

    <div class="container-fluid mt--7">
      <div class="row">

<div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="../../EspaceEtu/img/LOGOENTRE/<?php echo $row5['LOGO']?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            
            <div class="card-body pt-0 pt-md-4" style="margin-top:23%;">
            
              <div class="text-center">
                
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?php echo $row5['NOM']; ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i> <?php echo $row5['SUJET']; ?>
                </div>
                
              </div>

                <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-2">
                    <div>
                      <span class="heading">
                        <?php 
                         $nbr="SELECT * from postuler where ID_OFFRE='$id'"; 
                      $q=$bdd->query($nbr); 
                    $to=$q->fetchAll(PDO::FETCH_ASSOC); 
                      echo count($to);

                         ?>
  
                      </span>
                      <span class="description">Candidats</span>
                    </div>
                    <div>
                      <span class="heading"><?php echo $row5['Nombre']; ?></span>
                      <span class="description">Offres de stage</span>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>


          </div>




</div>


     
        <div class="col-xl-8 order-xl-2">
         
          <div class="card bg-secondary shadow">
            <form action="" method="POST"> 
            <div class="card-header bg-white border-0">

              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Informations de l'Offre</h3>
                </div>

                <div class="col-4 text-right">
                  <button type="submit"  class="btn btn-sm btn-primary"> Enregistrer</button> 
                </div>
              </div>
            </div>
            <div class="card-body">

              
    
                <div class="pl-lg-4">

                  <div class="row">
                   
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Sujet</label>
                        <input type="text" name="sjt" class="form-control form-control-alternative" value="<?php echo $row5['SUJET']; ?>">
                      </div>
                  
                    
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Date début</label>
                        <input type="date" name="d1" class="form-control form-control-alternative" value="<?php echo $row5['DATE_DEBUT']; ?>" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Date fin</label>
                        <input type="date" name="d2"class="form-control form-control-alternative" value="<?php echo $row5['DATE_FIN']; ?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Niveau</label>
                        
                        <select  name="niveau" class="form-control form-control-alternative">
          <?php 
          $nb="SELECT parcour,NIVEAU from niveau Where ID_FORMATION='$f' GROUP BY parcour;";
          $r3=$bdd->query($nb);
          $row3=$r3->fetchAll(PDO::FETCH_ASSOC);
          foreach($row3 as $s):
              ?>
        
        <option value="<?php echo $s['NIVEAU']; ?>"><?php echo $s['parcour']; ?></option>
        <?php endforeach; ?>
                          
                        </select>
                      </div>
                    </div>
                     <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Nombre</label>
                        <input type="number" name="n"class="form-control form-control-alternative" value="<?php echo $row5['Nombre']; ?>">
                      </div>
                    </div>
                    
                  </div>
                </div>
            
              
            </div>
          </form>
          </div>

              <br>
            <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Etudiants Postulés</h3>
                </div>

               
              </div>
            </div>
            <div class="card-body">
              
              
              <table class="table">
            <?php   

$req="SELECT * FROM etudiant,postuler WHERE etudiant.CNE=postuler.CNE and postuler.ID_OFFRE='$id'";
$re=$bdd->query($req);
   $ro=$re->fetchAll(PDO::FETCH_ASSOC);
   
            ?>
  <thead>
    <tr>
      <th scope="col">CNE</th>
      <th scope="col">NOM</th>
      <th scope="col">Prénom</th>
      <th scope="col">Date de soumission</th>
    </tr>
  </thead>
  <tbody>
 
  <?php  foreach ($ro as $t) :?>
    <tr>
      <th scope="row"><?php echo $t['CNE'];?></th>
      <td><?php echo $t['NOM'];?></td>
      <td><?php echo $t['PRENOM'];?></td>
      <td><?php echo $t['SOUMMISSION'];?></td>
    </tr>
    <?php endforeach ;?>
  </tbody>

</table>






            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


       
  </article >
</section>

<!-- partial -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>


<!--------- For select modal ----->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  
<?php   require_once dirname( __FILE__ ) . '/' . 'liste.php'; ?> 

</body>
</html>
