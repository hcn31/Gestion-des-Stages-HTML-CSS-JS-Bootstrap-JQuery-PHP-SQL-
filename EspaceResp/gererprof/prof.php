<?php 

require_once dirname( __FILE__ ) . '/' . '../../session.php';
require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
$resp=$_SESSION['cne'];
$r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
$Smt1=$bdd->query($r); 
$ro=$Smt1->fetch(PDO::FETCH_ASSOC);
 $f=$ro['ID_FORMATION'];

if($_SERVER['REQUEST_METHOD']=='POST'){
  $id=$_POST['id'];
  $email=$_POST['email'];
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $add=$_POST['add'];
  $tel=$_POST['tel'];
  $naiss=$_POST['naissance'];
  $nomi=$_POST['daten'];
  $req11="INSERT INTO enseignant  VALUES('$id','$f','$nom','$prenom','$add','$tel','$email','$naiss','$nomi')";
  $bdd->exec($req11);
   header('location:prof.php');
}

    
      

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
  span{
           color:black !important;
        }


</style>
</head>
<body>
  
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <div style="float : right; padding-right: 7%;">
  <a  href="" type="button" class="btn btn-outline-primary btn-rounded " data-mdb-ripple-color="dark" data-bs-target="#myModal" data-bs-toggle="modal" style="margin-right: 40px;"><i class="fas fa-plus"></i> Enseignant</a>
  </div>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


  <article style="margin:80px 0 0 100px;">

  <div>
<a href="../gereretu/etudiant.php"><button  type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
Gestion des etudiants</button></a>
<a href="prof.php"><button  style="background-color:white;color:black"  type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
Gestion des Enseignant
</button></a>
</div>
 <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
      <h5 class="text-uppercase">Gestion Des Enseignant</h5>
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
   $req="SELECT * from enseignant where ID_FORMATION='$f'";
   $d=$bdd->query($req);
   $row=$d->fetchAll(2); ?>
<div class="container my-5" style="margin-left: 5%; width :80% !important; margin-top: 10px !important;">
<div class="shadow-4 rounded-5 overflow-hidden">
<table id="example" class='table align-middle mb-0 bg-white table table-striped' align='center' style="width:100%;border-radius:50%;">
  <?php if(!empty($row)) 
  ?><thead class='bg-light' >  
        <tr align='center'>
        <th>NOM</th>
        <th>Prenom</th>
        <th>email</th>
        <th>phone</th>
        <th>NOMINATION</th>
      </tr>
      </thead>
      <tbody >
      <?php
foreach ($row as $V):
?>
  
    <tr>
      <td align="center">
        <p class="text-muted mb-0"><?php echo $V['NOM'] ?></p>        
      </td> 
      <td align="center">
        <p class="text-muted mb-0"><?php echo $V['PRENOM'] ?></p>        
      </td>        
      <td align="center">
        <a href="mailto:<?php echo $V['EMAIL'] ?>" style="color:black;text-decoration:none"><?php echo $V['EMAIL'] ?></a>
      </td>
      <td align="center">
        <span class="badge badge-info rounded-pill"><?php echo $V['TEL'] ?></span>
      </td>
      <td align="center">
        <span class="badge badge-info rounded-pill"><?php echo $V['nomination'] ?></span>
        <a style="float:right"   href="modifierprof.php?id=<?php echo $V['ID_PROF']?>" ><i class="bi bi-pencil-square"></i> </a>
      </td>
      </tr>

<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</article>
<?php   require_once dirname( __FILE__ ) . '/' . 'Ajouterprof.php'; ?>

<!-- partial -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>
 
 
 
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
