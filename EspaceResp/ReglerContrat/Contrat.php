<?php require_once dirname( __FILE__ ) . '/' . '../../session.php'; ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Uploder Contrat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">
<link rel='Icons' href='../../Interface/img/logosite.png'>

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
       $r="SELECT * FROM formation,responsable WHERE USERNAME='$resp' and formation.ID_FORMATION=responsable.ID_FORMATION ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $f=$ro['LIBELLE'];
      $niveau=$ro['ID_FORMATION'];
   ?>

   <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Régler Contrat</h5>
        <p><?php echo $f; ?> </p>
      </div>
    </div>


  <div class="container my-5" style="margin-left: 5%; width :80% !important;">
  <div class="shadow-4 rounded-5 overflow-hidden">
  
    <?php 
    $req="SELECT * FROM stage,entreprise,offre,niveau where
    stage.ID=entreprise.ID  and stage.ID_OFFRE=offre.ID_OFFRE and
     offre.NIVEAU=niveau.NIVEAU and niveau.ID_FORMATION='$niveau'";
    $res=$bdd->query($req); 
    if(empty($res)) echo " <p> aucun stage ici</p>  ";
       
      else { ?>

    


    <table  id="example" class='table align-middle mb-0 bg-white table table-striped' align='center'>
     <thead class='bg-light' >  
        <tr align='center'>
          <th>CNE</th>
          <th>Entreprise</th>
          <th>Sujet</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>

 <?php
 require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
 ?>
      <tbody >
          <?php   while($tab=$res->fetch()){ ?>

        <tr>
          <td>
            <div class="d-flex ">
            <p class="text-muted mb-0"><?php echo $tab["CNE"];?></p>
            </div>
          </td>
        
          <td>
            <img src="<?php  echo "../../EspaceEtu/img/LOGOENTRE/".$tab["LOGO"];?>" alt="entreprise" 
            style="width: 40px; height: 40px;display: block; margin-left: auto; margin-right: auto;"
                   class="rounded-circle"
                   >
            <p class="fw-bold mb-1" style="  text-align: center;" ><?php echo $tab["NOM"];?>
          </p>
          </td>
          <td align="center"><?php echo $tab["SUJET"];?></td>
          <td align="center"> De <?php echo $tab["DATE_DEBUT"];?>
             à <?php echo $tab["DATE_FIN"];?>
            </td>
          
         
          <td align="center">

            <?php if(empty($tab["CONTRAT"])){ ?>
            <a  href="RemplirContrat.php?idd=<?php echo $tab['NUM'];?>" type="button" class="btn btn-link btn-sm btn-rounded"
             style="background: #f9f8f8; margin-bottom: 3px; text-transform: unset;"> <i class="fas fa-edit"></i> Remplir Contrat
            </a> 
            <?php } else{ ?>
              <a  href="fpdf/TelechargerContrat.php?idd=<?php echo $tab['NUM'];?>" target="_blank" type="button" class="btn btn-link btn-sm btn-rounded"
              style="background: #f9f8f8; margin-bottom: 3px; text-transform: unset;"> <i class="fas fa-download"></i>Uploder contrat
             </a> 
             <?php } ?>

           </div>
          </td>

        </tr>
        <?php }}?>

           
        
  
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