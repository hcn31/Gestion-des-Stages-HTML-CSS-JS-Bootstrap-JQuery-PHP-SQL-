<?php
require_once dirname( __FILE__ ) . '/' . '../../session.php';
require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
$NumStage = $_GET['idd'];

$resp=$_SESSION['cne'];
       $r="SELECT * FROM formation,responsable WHERE USERNAME='$resp' ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $niveau=$ro['ID_FORMATION'];
      $reqProf="SELECT * from enseignant where ID_FORMATION='$niveau'";
      $resProf=$bdd->query($reqProf);

 $reqEtud="SELECT * from stage,etudiant where stage.CNE=etudiant.CNE and NUM=' $NumStage'";
 $resETud=$bdd->query($reqEtud); 
 $tab1=$resETud->fetch();

$reqEntre="SELECT * from stage,entreprise where  NUM=' $NumStage' AND stage.ID=entreprise.ID";
$resENTRE=$bdd->query($reqEntre); 
$tab2=$resENTRE->fetch();

$reqInfoEtud="SELECT * from appartient,niveau,formation where CNE='$tab1[CNE]' 
   and appartient.NIVEAU=niveau.NIVEAU and niveau.ID_FORMATION=formation.ID_FORMATION";
   $resINFOETU=$bdd->query($reqInfoEtud); 
   $tab4=$resINFOETU->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

     <!-- Bootstrap -->
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"
  rel="stylesheet"
/>

    <!-- Title Page-->
    <title>Contrat</title>

    <!-- Icons font CSS-->
    <link href="style/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="style/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="style/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="style/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="style/css/main.css" rel="stylesheet" media="all">
    <style>
        p{
  margin-bottom: 6px;
}
    </style>
</head>

<body>
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>
<article style="margin-top:40px"> 

    <div class="page-wrapper  p-t-100 p-b-100 font-robo" 
>
        <div class="wrapper wrapper--w680" >
            <div class="card card-1" >
                <div style="margin-bottom:0px">
                    <img src="../../EspaceEtu/img/LOGOENTRE/<?php echo $tab2['LOGO']; ?>" alt="LogoEntreprise"
                    width="100%" height="230px"  >
                </div>
                <h2 class="title"style="font-family: Pinyon Script, serif;color: #FFA33E;font-style: italic;
    text-align: center;     padding: 0;" >Générer Contrat</h2>
                    <h5 class="title" style=
                    "font-family: Pinyon Script, serif;color: gray;  text-decoration: underline;
    font-weight: bold;
    text-align: center;"> CONTRAT DE STAGE DE FORMATION AU SEIN DE L'ENTREPRISE </h5>
                <div class="card-body" style="    padding-top: 0;
" >
                    
                     <p> L'entreprise :  <?php echo $tab2['NOM']; ?> 
                     (ICE :<?php echo $tab2['ID']; ?> )
                      </p>
                     <p>
                        L'étudiant : <?php  echo strtoupper($tab1['NOM']).' '.strtoupper($tab1['PRENOM']);?>
                     </p>
                     <p>
                     Né (e) Le :  <?php  echo $tab1['NAISSANCE'];?>
                     </p>
                     <p>
                     Adressre :  <?php  echo strtoupper($tab1['ADR']);?>
                     </p>
                     <p>
                     CNE : <?php  echo $tab1['CNE'];?>
                     </p>
                     <p>
                     N° de tél : <?php  echo $tab1['PHONE'];?>
                     </p>
                     <p>
                     Filière :<?php  echo $tab4['LIBELLE'];?>
                     </p>
                     <p>
                     Niveau de formation : <?php  echo $tab4['parcour'];?>
                     </p>
                     <p>
                     Sujet du stage : <?php  echo mb_strtoupper($tab1['SUJET'],'UTF-8');?>
                     </p>
                     <form action="EnregistrerContrat.php" method="post">
                        <div class="row row-space" style=" margin-top: 20px;">
                            <div class="col-2">
                            <label for="DateDeb" style=" color: black; text-shadow: 2px 2px 4px pink;font-size: 16px;">
                            Date Début du stage... </label>
                                <div class="input-group">
                                    <input class="input--style-1 " type="date" name="DateDeb" value="<?php  echo $tab1['DATE_DEBUT']?>"
                                     placeholder="Date Début du stage..."  >
                                </div>
                            </div>
                            <div class="col-2">
                            <label for="DateF" style=" color: black; text-shadow: 2px 2px 4px pink;font-size: 16px;">Date Fin du stage... </label>
                                <div class="input-group">
                                    <input class="input--style-1 " type="date" placeholder="Date Fin du stage..."
                                    value="<?php  echo $tab1['DATE_FIN']; ?>" name="DateF">
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                            <label for="Encadrant" style=" color: black; text-shadow: 2px 2px 4px pink;font-size: 16px;">
                            Choisir un Encadrant... </label>
                                <select name="Encadrant" required >
                                <?php while($TABPROF=$resProf->fetch()){ ?>
                                <option value="<?php echo $TABPROF["ID_PROF"]; ?>">
                             <?php echo strtoupper($TABPROF["NOM"]).' '.strtoupper($TABPROF["PRENOM"]) ; ?></option>
                                     <?php } ?>
                                </select>
                                <input type="hidden" name="numStage" value="<?php echo $NumStage;?>">

                                <div class="select-dropdown"></div>
                            </div>
                        </div>

                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                            <button class="btn btn--radius " style="  background-color: red;  margin-left: 25px;"
                             type="reset">Anuuler</button>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
    <!-- Jquery JS-->
    <script src="style/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="style/vendor/select2/select2.min.js"></script>
    <script src="style/vendor/datepicker/moment.min.js"></script>
    <script src="style/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>

</body>

</html>
