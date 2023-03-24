 <?php require_once dirname( __FILE__ ) . '/' . '../../session.php'; ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Verifier Stage</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

     <!-- Bootstrap -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"
/>
   


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
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


  <article style="margin-top:40px"> 

  <?php require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
      $resp=$_SESSION['cne'];
       $r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $f=$ro['ID_FORMATION'];

   if($_SERVER['REQUEST_METHOD']=='POST')
    {
      $c=$_POST['select'];

      $req="SELECT * from entreprise,stage WHERE entreprise.ID=stage.ID AND stage.GENRE='2' AND stage.CNE in(SELECT appartient.CNE from appartient,niveau where appartient.NIVEAU=niveau.NIVEAU and niveau.ID_FORMATION='$f' AND niveau.NIVEAU='$c');";
   

    }else
    {
      $req="SELECT * from entreprise,stage WHERE entreprise.ID=stage.ID AND stage.GENRE='2' AND stage.CNE in(SELECT appartient.CNE from appartient,niveau where appartient.NIVEAU=niveau.NIVEAU and niveau.ID_FORMATION='$f');";
    }
    $res=$bdd->query($req);
   $row=$res->fetchAll(PDO::FETCH_ASSOC);

   ?>

   <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Vérification Des Stages</h5>
        <p>
      <?php 
        $e=$bdd->query("SELECT * from formation where ID_FORMATION='$f'"); 
       $m=$e->fetch(PDO::FETCH_ASSOC);

       echo $m['LIBELLE'];

      ?></p>
      </div>
    </div>

<div style="width: 100% ;">
<div class="form-group col-md-4" style="margin: auto ;">
      <label for="inputState">Niveau</label>
      <form action="" method="POST">
      <select name="select" class="form-control" onchange="this.form.submit()">
        <option>--- Choisir ---</option>
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
  <div class="container my-5" style="margin-left: 5%; width :80% !important;">

  <div class="shadow-4 rounded-5 overflow-hidden">
  
     


    <table  id="example" class='table align-middle mb-0 bg-white table table-striped' align='center'>
   <?php if(!empty($row)){?> 
   <thead class='bg-light' >  
        <tr align='center'>
          <th>Etudiant</th>
          <th>Entreprise</th>
          <th>Sujet</th>
          <th>Date</th>
          <th>Decision</th>
        </tr>
          </thead>

    <?php } else echo "</tr><td align='center'><div style='width: 100% ;''>
<div class='form-group col-md-4' style='margin: auto ;'> 
Pas de Stages à Vérifier
</div>
</div> </td> </tr>
";
?>
      <tbody >

 <?php
 foreach($row as $V):
 $cne=$V['CNE'];
 require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
  $req1="SELECT * from etudiant WHERE CNE='$cne'";
   $res1=$bdd->query($req1);
   $row1=$res1->fetch(PDO::FETCH_ASSOC);

?>
        <tr>
          <td>
            <div class="d-flex ">
              <img
                   src="<?php echo "../../EspaceEtu/img/ETUDIMG/".$row1['PHOTO'] ; ?>"
                   alt=""
                   style="width: 45px; height: 45px"
                   class="rounded-circle"
                   />
              <div class="ms-3">
                <p class="fw-bold mb-1"><?php echo $row1["NOM"]." ".$row1["PRENOM"];?></p>
                <p class="text-muted mb-0"><?php echo $row1["EMAIL"];?></p>
                <p class="text-muted mb-0"><?php echo $row1["PHONE"];?></p>
              </div>
            </div>
          </td>
          <td>
            <p class="fw-bold mb-1"><?php echo $V["NOM"];?></p>
            <p class="text-muted mb-0"><?php echo $V["EMAIL"];?></p>
            <p class="text-muted mb-0"><?php echo $V["ADRESSE"];?></p>
            <p class="text-muted mb-0"><?php echo $V["TEL"];?></p>
          </td>
          <td align="center"><?php echo $V["SUJET"];?></td>
          <td align="center">
            <span class="badge badge-info rounded-pill"><?php echo $V["DATE_DEBUT"];?></span>
            <span class="badge badge-info rounded-pill"><?php echo $V["DATE_FIN"];?></span>
          </td>
          
          <td align="center">
            <a  href="valider.php?num=<?php echo $V['NUM'];?>" type="button" class="btn btn-link btn-sm btn-rounded" style="background: #f9f8f8; margin-bottom: 3px; text-transform: unset;"> 
                  <i class="fas fa-check"></i> Valider
            </a> 
            <a type="button" href="refuser.php?num=<?php echo $V['NUM'];?>" class="btn btn-link btn-sm btn-rounded" style="background: #f9f8f8; text-transform: unset;"> 
                  <i class="fas fa-ban"></i> Refuser 
            </a>
           </div>
          </td>
        </tr>

           
        
     <?php endforeach; ?>
  
      </tbody>
    </table>

  </div>
 </div>




    
  </article>
</section>


<!-- partial -->
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
