<?php
    require_once dirname( __FILE__ ) . '/' . '../../session.php';

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8"> 
  <title> Postuler </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link rel="stylesheet" href="../menu/style.css">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- zyada pour icone -->
<link href="http://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link rel="icon" href="../../Interface/img/logosite.png">
</head>
<body>

<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <div style="float : right; padding-right: 7%;">
  <a  href="" type="button" class="btn btn-outline-primary btn-rounded " data-mdb-ripple-color="dark" data-bs-target="#myModal" data-bs-toggle="modal" style="margin-right: 40px;">Ajouter Stage</a>
</div>
  <?php require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>

<article style="margin-top:50px !important">

<div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Offres disponibles</h5>
      </div>
    </div>

<?php
   require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
  $annee=date("Y");
  $cne=$_SESSION['cne'];
  $req="SELECT * from niveau,offre,entreprise WHERE  offre.ID=entreprise.ID AND niveau.NIVEAU=offre.NIVEAU AND offre.ID_OFFRE  not in(select ID_OFFRE from postuler where cne='$cne') AND offre.NIVEAU= (select NIVEAU from niveau where parcour=(select parcour from appartient,niveau where appartient.NIVEAU=niveau.NIVEAU and appartient.cne='$cne' AND appartient.DATEtu like '$annee%'))";
  $res=$bdd->query($req);
   $row=$res->fetchAll(PDO::FETCH_ASSOC);
   $req1="SELECT * from etudiant WHERE  CNE='$cne'";
   $res1=$bdd->query($req1);
    $row1=$res1->fetch(2);

   $reqa="SELECT *from postuler where cne='$cne' ";
   $resa=$bdd->query($reqa);
   $test="SELECT *from stage where cne='$cne' and GENRE='1' ";
   $test1=$bdd->query($test);
   $test3=$test1->fetch(2);
   if(empty($row1['CV'])){
    
    ?>
  
  
  <script>
  alert("vous n'avez pas de CV");
  window.location.href="../Modifier/modifier.php";

</script>;
  <?php 
   exit();
}


   ?>   
   
   <?php 
     $tem=0;
    while($tab=$resa->fetch())
    { 
            if(!strcmp($tab['STATUT'],"Accepter"))   $tem=1;  }
      
     

 if(($tem==0) && empty($test2)) { ?>
   <center>
   <section id="team" class="pb-5">
    <div class="container">
    <div class="row"> 
   <?php
 foreach($row as $V): 
 if(!strcmp($V['State'],"new")) { ?>
            <div class="col-xs-2 col-sm-8 col-md-4 col-lg-3">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                <i class="bi bi-info-circle-fill card-title" style="float:right"></i><br>
                                    <img class=" img-fluid" src="../img/LOGOENTRE/<?php echo $V['LOGO']?>" alt="logo d'entreprise">
                                    <h6 class="card-title" style="margin-left: -10px ; color:black !important;"><i class="bi bi-tag-fill"></i><?php echo $V['NOM']?></h6>
                                    <p class="card-title"  style="margin-left: -100px ;">Sujet de stage:</p>
                                    <p class="card-text"><?php echo $V['SUJET']?></p>
                                    <p class="card-title" style="margin-left: -80px ;"><i class="bi bi-hourglass-split"></i>Duree de stage:</p>
                                    <span class="badge badge-info rounded-pill"><?php echo $V['DATE_DEBUT']?></span>
                                    <span class="badge badge-info rounded-pill"><?php echo $V['DATE_FIN']?></span>
                                </div>
                            </div>
                        </div>
                        <center>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <p class="card-title" style="margin-left: -60px ; margin-top:-30px !important"><i class="bi bi-geo-alt-fill"></i>Adresse d'entreprise:</p>
                                    <p class="card-text"><?php echo $V['ADRESSE'] ?></p>
                                    <p class="card-title" style="margin-left: -50px ;"><i class="bi bi-telephone"></i>Telephone d'entreprise:</p>
                                    <p class="card-text"><?php echo $V['TEL'] ?></p>
                                    <p class="card-title" style="margin-left: -60px ;"><i class="bi bi-envelope"></i>EMAIL d'entreprise:</p>
                                    <p class="card-text"><a style="color: black ;font-weight: bold;" href="mailto:<?php echo $V['EMAIL'] ?>"><?php echo $V['EMAIL'] ?></a></p>
                                    <p class="card-title" style="margin-left: -80px ;"><i class="bi bi-link-45deg"></i>Site d'entreprise:</p>
                                    <a  href="<?php echo $V['SITE'] ?>" style="text-decoration:none;color:black" target="_blank"><?php echo $V['NOM'] ?></a>
                                    
                  
                                      <a href="ooo.php?cc=<?php echo $V['ID_OFFRE']?>"><button style="margin-bottom:0px !important;" class="btn btn-outline-info btn-rounded"  data-mdb-ripple-color="dark">postuler</button></a>                    
                                      
                                  
                                    </div>
                            </div>
                        </div>
                        </center>
                    </div>
                </div>
            </div>    
        <?php
        }        
 endforeach; ?>
</div>
</div>
</center>
<!---------- Ajouter New offre --------------------->


<form action="ajouterStage.php" method="POST">
<div class="modal" id="myModal">
 <div class="modal-dialog">
<div class="modal-content">
<div class="modal-header  text-black" >
<h5 class="modal-title">Ajouter Stage</h5>
 <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
</div>
 <div class="modal-body" style="display:block;">
<!--- Sujet --->
<label class="form-label">Sujet</label>
<input class="form-control" name="sujet">
<!---   Dates --->
<div class="row g-1">
  <div class="col" style="margin-right: 12px;">
    <label  class="form-label">Date début</label>
    <input type="date" class="form-control" name="datedebut"> 
  </div>
  <div class="col">
    <label  class="form-label">Date fin</label>
    <input type="date" class="form-control" name="datefin"> 
  </div>
</div>
<hr>
<!---   Id--->

<label class="form-label">Identifiant Commun de L'Entreprise (ICE)</label>
<input class="form-control" name="id">

<!---   Nom --->
<label class="form-label">Nom</label>
<input class="form-control" name="Nom">
<!--- Adresse --->
<label  class="form-label" >Adresse</label>
<input class="form-control" name="adresse">


<!--- Email & Tel--->
<div class="row g-1">
  <div class="col" style="margin-right: 12px;">
    <label  class="form-label">Email</label>
    <input type="email" class="form-control" name="emailEnt"> 
  </div>
  <div class="col">
    <label  class="form-label">Tel</label>
    <input type="close-link" class="form-control" name="phone"> 
  </div>
</div>

<!--fin de body-->

 </div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary btn-rounded">Enregistrer</button>
    <button type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark" data-bs-dismiss="modal">Annuler</button>
</div>
</div>
</div>
</div>
</form>
<?php 
} else{
  echo"<div style='display:flex;justify-content:center;font-size:30px;color:red'><b>Vouz avez Deja un Stage</b></div>";
}
?>
</article>
</section>

<!-- Script  -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

