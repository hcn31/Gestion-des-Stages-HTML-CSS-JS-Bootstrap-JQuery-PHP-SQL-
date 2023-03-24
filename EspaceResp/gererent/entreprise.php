<?php 

require_once dirname( __FILE__ ) . '/' . '../../session.php';
require_once dirname( __FILE__ ) . '/' . '../../connexion.php';


      $resp=$_SESSION['cne'];
       $r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
        $f=$ro['ID_FORMATION'];

      

  ?>



<!DOCTYPE html>
<html lang="en" >
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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
   

<!----------------->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<style>
  .box {
        display: flex;
        flex-wrap: wrap;
    }
    .box>* {
        flex: 1 1 50px;
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
  <a  href="" type="button" class="btn btn-outline-primary btn-rounded " data-mdb-ripple-color="dark" data-bs-target="#myModal1" data-bs-toggle="modal" style="margin-right: 40px;"><i class="fas fa-plus"></i> ENTREPRISE</a>
  </div>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


<article style="margin:80px 0 0 100px;">
 <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Gestion Des Entreprises</h5>
        <p>
      <?php 
        $e=$bdd->query("SELECT * from formation where ID_FORMATION='$f'"); 
       $m=$e->fetch(PDO::FETCH_ASSOC);

       echo $m['LIBELLE'];

      ?></p>
      </div>
    </div>

    <div class='class="col-12 mt-3 mb-1"'>
  <?php
   $annee=date("Y");
$req="SELECT * from entreprise where ID  in(select entreprise.ID from entreprise,collaborer,formation where entreprise.ID=collaborer.ID AND collaborer.ID_FORMATION=formation.ID_FORMATION   AND formation.ID_FORMATION='$f')";
$d=$bdd->query($req);
$row=$d->fetchAll(2); ?>
<div class="container my-5"  style="margin-left: 5%; width :80% !important; margin-top: 10px !important;">
            <div class="shadow-4 rounded-5" style="width:100%">
<table id="example" class='table align-middle mb-0 bg-white table table-striped' align='center' style="width:100%;border-radius:50%;">

<?php if(!empty($row))?> 
      <thead class='bg-light' >  
        <tr align='center'>
          <th >entreprise</th>
          <th>ADRESSE</th>
          <th>TELEPHONE</th>
          <th>EMAIL </th>
          <th>SITE </th>
          <th></th>
        </tr>
      </thead>
<tbody>
 
      <?php
foreach ($row as $V):
?>

      <tr>
        <td align="center">
            <div class="d-flex ">
            <img src="../../EspaceEtu/img/LOGOENTRE/<?php echo $V['LOGO']?>" alt="photo d'etu"style="width: 45px; height: 45px" class="rounded-circle" />
            <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $V['NOM'] ?></p>
            <p class="text-muted mb-0"><?php echo $V['ID'] ?> </p>
            </div>
            </div>
        </td>      
        <td align="center">
          <span class="badge badge-info rounded-pill"><?php echo $V['ADRESSE'] ?></span>
        </td>
        <td align="center">
          <span class="badge badge-info rounded-pill"><?php echo $V['TEL'] ?></span>
        </td>
        <td align="center">
          <a href="mailto:<?php echo $V['EMAIL'] ?>"><?php echo $V['EMAIL'] ?></span>
        </td>
        <td align="center">
          <a style="color:black;text-decoration:none" href="<?php echo $V['SITE'] ?>" target="_link"><?php echo $V['SITE'] ?></a>
        </td>
        <td>
        <a href="modifierentr.php?id=<?php echo $V['ID']?>"><i class="bi bi-pencil-square" style="float:left"></i></a><br>  
        </td>    
    </tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</article>

<!-- partial -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>
  <script src="valider.js"></script>

  <?php require_once dirname( __FILE__ ) . '/' . './../Offres/ajoutEntr.php';?>


 
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

</body>
</html>
