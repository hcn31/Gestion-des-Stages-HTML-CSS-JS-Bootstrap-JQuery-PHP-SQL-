<?php require_once dirname( __FILE__ ) . '/' . '../../session.php'; ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Rapprot</title>
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

</head>
<body>
  
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>


  <article style="margin-top:40px"> 

  <?php require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
      $resp=$_SESSION['cne'];
       $r="SELECT * FROM formation,responsable WHERE USERNAME='$resp' and 
       formation.ID_FORMATION=responsable.ID_FORMATION ";
       $Smt1=$bdd->query($r); 
       $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
      $f=$ro['LIBELLE'];
      $niveau=$ro['ID_FORMATION'];
   ?>

   <div class="row" align="center">
      <div class="col-12 mt-3 mb-1">
        <h5 class="text-uppercase">Affecter Jury & Uploder Rapport</h5>
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

    


    <table class='table align-middle mb-0 bg-white' align='center'>
   <?php  echo "<thead class='bg-light' >  
        <tr align='center'>
          <th>CNE</th>
          <th>Entreprise</th>
          <th>Sujet</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>"; ?>

 <?php
 require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
 ?>
      <tbody >
          <?php   while($tab=$res->fetch()){
                        $Note=0;

            $reqNote="SELECT * FROM juger WHERE NUM='$tab[NUM]'";
            $ResNote=$bdd->query($reqNote);

            $reqNote1="SELECT * FROM stage WHERE NUM='$tab[NUM]'";
            $ResNote1=$bdd->query($reqNote1);
            $tabNote1=$ResNote1->fetch();
            if(empty($tabNote1["NOTEENT"])) $Note=1;

            while($tabNote=$ResNote->fetch())
            {
              if(empty($tabNote["NOTE"])) $Note=1;
            }
            ?>
           
        <tr>
          <td>
            <div class="d-flex ">
            <p class="text-muted mb-0"><?php echo $tab["CNE"];?></p>
            </div>
          </td>
        
          <td>
            <img src="<?php  echo "../../EspaceEtu/img/LOGOENTRE/".$tab["LOGO"];?>" alt="entreprise" 
            style="width: 60px; height: 30px;display: block; margin-left: auto; margin-right: auto;"
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
               
            <?php if($Note==1){
            if(empty($tab["CONTRAT"])){ ?>
            <p style="  font-weight: bold; ">
              Il faut Tout d'abord renseigner le contrat...
            </p>
            <?php } 
            
         
            else{ 
              
              ?>
              <a  href="Uploder.php?idd=<?php echo $tab['NUM'];?>"  
              type="button" class="btn  btn-warning btn-sm" style="    font-size: 10px;
" > 
<i class='fas fa-edit'></i>
 Affecter Jury et Uploader Rapport
             </a> 

            <?php if(!empty($tab["RAPPORT"])) { ?>
              <a  href="Notes.php?idd=<?php echo $tab['NUM'];?>"  
              type="button" class="btn  btn-primary btn-sm" style="font-size: 10px;margin-top:5px" > 
            <i class='fas fa-marker'></i>
              Saisir les Notes...
             </a> 
             </div>
             <?php } } }
             else{
              $Tot="SELECT count(*) as total FROM juger WHERE NUM='$tab[NUM]'";
              $ResTot=$bdd->query($Tot);
              $tabTot= $ResTot->fetch();
              $divby=$tabTot['total'];
              $divby++;
              $somme=0;
              $reqNote="SELECT * FROM juger WHERE NUM='$tab[NUM]'";
              $ResNote=$bdd->query($reqNote);
              $reqNote1="SELECT * FROM stage WHERE NUM='$tab[NUM]'";
              $ResNote1=$bdd->query($reqNote1);
              $tabNote1=$ResNote1->fetch();
              $somme+=$tabNote1["NOTEENT"];  
              while($tabNote=$ResNote->fetch())
              {
                $somme+=$tabNote["NOTE"];
              }
              $somme/=$divby;
              $number =$somme;
              $number1 = number_format($number, 2);


             ?>
       
                <span  style="font-size: 15px;"><?php echo "<b>Note Finale:<b>".$number1;?></span>

               <?php }?>
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
  
</body>
</html>