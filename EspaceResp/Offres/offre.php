 <?php require_once dirname( __FILE__ ) . '/' . '../../session.php';

require_once dirname( __FILE__ ) . '/' . '../../connexion.php';

 


      $resp=$_SESSION['cne'];
       $r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $f=$ro['ID_FORMATION'];
   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['select']))
    {
      $c=$_POST['select'];
      $req="SELECT * from entreprise,offre,niveau WHERE offre.ID=entreprise.ID AND offre.NIVEAU=niveau.NIVEAU  and niveau.ID_FORMATION='$f' AND niveau.NIVEAU='$c';";
   

    }else
    {
      $req="SELECT * from entreprise,offre,niveau WHERE offre.ID=entreprise.ID AND offre.NIVEAU=niveau.NIVEAU  and niveau.ID_FORMATION='$f';";
    }
    $res=$bdd->query($req);
   $row=$res->fetchAll(PDO::FETCH_ASSOC);

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gérer les Offres</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
  
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

     <!-- Bootstrap -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"/>
   
 <!--------- For select modal ----->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



 <!----------------->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<style type="text/css">
  .bootstrap-select {
width: 100% !important;
}
span{
           color:black !important;
        }


</style>
  


</head>
<body>
  
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <div style="float : right; padding-right: 7%;">
  <a  href="" type="button" class="btn btn-outline-primary btn-rounded " data-mdb-ripple-color="dark" data-bs-target="#myModal" data-bs-toggle="modal" style="margin-right: 40px;"><i class="fas fa-plus"></i> Offre</a>
  <a href="" type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark" data-bs-target="#myModal1" data-bs-toggle="modal"><i class="fas fa-plus"></i> Entreprise</a>
  </div>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


  <article style="margin-top:50px;">

  
 <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Gestion Des Offres</h5>
        <p>
      <?php 
        $e=$bdd->query("SELECT * from formation where ID_FORMATION='$f'"); 
       $m=$e->fetch(PDO::FETCH_ASSOC);

       echo $m['LIBELLE'];

      ?></p>
      </div>
    </div>

<?php
 $k=$bdd->query("SELECT COUNT(*),niveau.parcour from offre,niveau where offre.NIVEAU=niveau.NIVEAU AND offre.NIVEAU in (SELECT NIVEAU from niveau Where ID_FORMATION='$f') GROUP BY offre.NIVEAU ;"); 
       $d=$k->fetchAll(PDO::FETCH_ASSOC);
 

 ?>
<div style="width:90% !important ; ">
<div style="margin-left: 15%;">
  <div class='row' style="display: flex; justify-content: center;">
  <?php foreach($d as $g): 
echo "
      <div class='col-xl-3 col-sm-6 col-12 mb-4'>
        <div class='card'>
          <div class='card-body'>
            <div class='d-flex justify-content-between px-md-1'>
              <div class='align-self-center'>
                 <i class='fas fa-chart-line text-success fa-3x'></i>
              </div>
              <div class='text-end'>
                <h3>".$g['COUNT(*)']."</h3>
                <p class='mb-0'>".$g['parcour']."</p>
              </div>
            </div>
          </div>
        </div>
      </div>
 ";

 endforeach; ?>
 </div>
</div>
</div>


<div style="width: 100% ; margin-top: 20px;">
<div class="form-group col-md-4" style="margin: auto ;">
      <form action="offre.php" method="POST">
      <select name="select" class="form-control" onchange="this.form.submit()">
        <option>Chercher Par Niveau....</option>
          <?php 
          $nb="SELECT parcour,NIVEAU from niveau Where ID_FORMATION='$f' GROUP BY parcour;";
          $r3=$bdd->query($nb);
          $row3=$r3->fetchAll(PDO::FETCH_ASSOC);
          foreach($row3 as $s):
              ?>
        
        <option value="<?php echo $s['NIVEAU']; ?>"><?php echo $s['parcour']; ?></option>
        <?php endforeach; ?>
      </select>
      </form>
    </div>
</div>    
  <div class="container my-5" style="margin-left: 5%; width :80% !important; margin-top: 10px !important;">

  <div class="shadow-4 rounded-5 overflow-hidden">
  <table id="example" class='table align-middle mb-0 bg-white table table-striped' align='center'>
   <?php if(!empty($row)) ?> <thead class='bg-light' >  
        <tr align='center'>
          <th>Entreprise</th>
          <th>Sujet</th>
          <th>Durée</th>
          <th>Nombres Postulés</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody >

 <?php
 foreach($row as $V):

 

?>
        <tr>
          <td>
            <div class="d-flex ">
              <img
                   src="<?php echo "../../EspaceEtu/img/LOGOENTRE/".$V['LOGO'] ; ?>"
                   alt="Entreprise"
                   style="width: 45px; height: 45px"
                   class="rounded-circle"
                   />
              <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $V["NOM"];?></p>
            <p class="text-muted mb-0"><?php echo $V["EMAIL"];?></p>
            <p class="text-muted mb-0"><?php echo $V["ADRESSE"];?></p>
            <p class="text-muted mb-0"><?php echo $V["TEL"];?></p>
              </div>
            </div>
        
          </td>
          <td align="center"><?php echo $V["SUJET"];?></td>
          <td align="center">
            <span class="badge badge-info rounded-pill"><?php echo $V["DATE_DEBUT"];?></span>
            <span class="badge badge-info rounded-pill"><?php echo $V["DATE_FIN"];?></span>
          </td>
          <td align="center">
            <span class="badge badge-info rounded-pill">
              <?php 
              require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
              $id=$V["ID_OFFRE"];
               $nbr="SELECT * from postuler where ID_OFFRE='$id'"; 
          $q=$bdd->query($nbr); 
        $to=$q->fetchAll(PDO::FETCH_ASSOC); 
           echo count($to);

          ?></span>
          </td>
          

          <td align="center">
            <span class="badge badge-info rounded-pill"><?php echo $V["State"];?></span>
          </td>
          <td align="center">
            <div>
            <a href="fermer.php?idOffre=<?php echo $V['ID_OFFRE']; ?>" type="button" class="btn btn-link btn-sm btn-rounded" style="background: #f9f8f8; text-transform: unset;"> 
                  <i class="fas fa-times"></i> Fermer</a> 
            <a href="detail.php?idOffre=<?php echo $V['ID_OFFRE']; ?>"  type="button" class="btn btn-link btn-sm btn-rounded" style="background: #f9f8f8; text-transform: unset;"><i class="fas fa-plus"></i> Détail</a>
            </div>
          </td>
        </tr>
     <?php 

   endforeach; ?>
  
      </tbody>
    </table>

  </div>
 </div>


<?php   require_once dirname( __FILE__ ) . '/' . 'ajoutOffre.php'; ?>  
<?php   require_once dirname( __FILE__ ) . '/' . 'ajoutEntr.php'; ?>     
 

  </article >
</section>

<!-- partial -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>
  <script  src="EntrPlus.js"></script>

<!--------- For select modal ----->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
           $('.search select').selectpicker({
  size: false
           });
      });




      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

  </script>
    
</body>
</html>
