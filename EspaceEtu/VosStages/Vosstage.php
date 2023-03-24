<?php require_once dirname( __FILE__ ) . '/' . '../../session.php'; ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Vos Stages</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
<link rel="icon" href="../../Interface/img/logosite.png">
     <!-- Bootstrap -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"
/>
   
</head>
<body>
 <?php
  require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 

  ?>
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <div style="float : right; padding-right: 7%;">
  </div>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


  <article style="margin-top:50px">
  <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Vos stage</h5>
      </div>
    </div>
  <div class='class="col-12 mt-3 mb-1"'>
  <?php
  $cn=$_SESSION['cne'];
$req="SELECT * from postuler,offre,entreprise where postuler.ID_OFFRE=offre.ID_OFFRE AND offre.ID=entreprise.ID AND cne='$cn'";
$d=$bdd->query($req);
$row=$d->fetchAll(2); ?>
<center>
<div class="container my-5" style="margin-left: 5%; width :80% !important; margin-top: 10px !important;">
<div class="shadow-4 rounded-5 overflow-hidden">
<table class='table align-middle mb-0 bg-white' align='center' style="width:100%;border-radius:50%;">
  <?php if(!empty($row)) echo "<thead class='bg-light' >  
        <tr align='center'>
          <th>Entreprise</th>
          <th>Sujet</th>
          <th>Durée</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>"; ?>
      </center>
      <?php
foreach ($row as $V):
?>
      <tbody >
    <tbody >
      <tr>
        <td>
          <div class="d-flex ">
            <img src="../img/LOGOENTRE/<?php echo $V['LOGO']?>" alt="LOGO d'entreprise"style="width: 45px; height: 45px" class="rounded-circle" />
            <div class="ms-3">
          <p class="fw-bold mb-1"><?php echo $V['NOM'] ?></p>
          <p class="text-muted mb-0"><?php echo $V['EMAIL'] ?></p>
          <p class="text-muted mb-0"><?php echo $V['ADRESSE'] ?></p>
          <p class="text-muted mb-0"><?php echo $V['TEL'] ?></p>
            </div>
          </div>
      
        </td>
        <td align="center"><?php echo $V['SUJET'] ?></td>
        <td align="center">
          <span class="badge badge-info rounded-pill"><?php echo $V['DATE_DEBUT'] ?></span>
          <span class="badge badge-info rounded-pill"><?php echo $V['DATE_FIN'] ?></span>
        </td>
        <td align="center">
          <span class="badge badge-info rounded-pill"><?php echo $V['STATUT'] ?></span>
        </td>
   

                 <td align="center">
                  <?php if(!strcmp($V['STATUT'],"retenu"))
                   {
                    ?>
          <a  href="AccepterStage.php?idd=<?php echo $V['ID_OFFRE']?>&amp;niv=<?php echo $V['NIVEAU'];?>
          &amp;Stat=<?php echo $V['STATUT'];?>"  type="button" class="btn btn-link btn-sm btn-rounded" 
                 style="background: #f9f8f8; margin-bottom: 3px; text-transform: unset;"> 
                <i class="fas fa-check"></i> Accepter
          </a> 
          <a  href="Refuser.php?idd=<?php echo $V['ID_OFFRE'];?>&amp;niv=<?php echo $V['NIVEAU'];?>
          &amp;Stat=<?php echo $V['STATUT'];?>" 
          type="button" class="btn btn-link btn-sm btn-rounded" style="background: #f9f8f8; margin-bottom: 3px; text-transform: unset;"> 
                <i class="fas fa-times"></i> Refuser
          </a> 
          <?php }?>
         </div>
        </td>
      </tr>

<?php endforeach; ?>
</div>
</table>
</div>
</div>
</article>
</section>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>
</body>
</html>


