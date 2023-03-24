<?php require_once dirname( __FILE__ ) . '/' . '../../session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <title>Affecter Jury & Uploader Rapport</title>

    <link href="Style/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="Style/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="Style/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="Style/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link href="Style/css/main.css" rel="stylesheet" media="all">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Signika:400,600'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'><link rel="stylesheet" href="../menu/style.css">
     <link rel='Icons' href='../../Interface/img/logosite.png'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css"rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
</head>

<body >
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <?php   require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>

<?php require_once dirname( __FILE__ ) . '/' . '../../connexion.php'; 
  $NumStage = $_GET['idd'];

  $resp=$_SESSION['cne'];
         
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

   $PrfENC="SELECT * from stage,enseignant where stage.NUM='$NumStage' and stage.ID_PROF=enseignant.ID_PROF";
   $PrfREs=$bdd->query($PrfENC);
   $TabPRF=$PrfREs->fetch();

    //   $ReqENS="SELECT * from enseignant where
    //   ID_FORMATION='$tab4[ID_FORMATION]' and ID_PROF not in (SELECT ID_PROF FROM juger where NUM='$NumStage')";
    //   $ResENS=$bdd->query($ReqENS); 
    //   $TabENCF=$ResENS->fetch();

      $ReqENS="SELECT * from enseignant where
      ID_FORMATION='$tab4[ID_FORMATION]' and ID_PROF not in (SELECT ID_PROF FROM juger where NUM='$NumStage')";
      $ResENS=$bdd->query($ReqENS); 


      $REqSElect="SELECT * FROM juger,enseignant WHERE NUM='$NumStage' and juger.ID_PROF=enseignant.ID_PROF and 
      juger.ID_PROF NOT IN (SELECT ID_PROF FROM stage
       WHERE NUM='$NumStage')";
       $REsSElect=$bdd->query($REqSElect);

  ?>
<article style="margin-left:30%;width:600px; justify-content: center;
    align-items: center;" > 

<div class="page-wrapper p-t-45 p-b-50" style="margin-top:0%;" >
        <div class="wrapper wrapper--w790">
            <div class="card card-5">

                <div class="card-heading">
                    <h6 class="title">Affecter Jury & Uploader Rapport</h6>
                </div>
                
                <div class="card-body">
                    <form method="post" action="affecterENCAD.php" enctype="multipart/form-data">

                        <div class="form-row m-b-55">
                                <div class="name">CNE :</div>
                            <div class="value" style="padding-top:7px">
                                <div class="row row-space" style="padding-top:7px">  
                                <h6  ><?php  echo strtoupper($tab1['CNE']);?>  </h6>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                                <div class="name">NOM PRENOM :</div>
                            <div class="value" style="padding-top:7px">
                                <div class="row row-space" style="padding-top:7px">  
                                <h6  ><?php  echo strtoupper($tab1['NOM'])." ".strtoupper($tab1['PRENOM']);?>  </h6>
                            </div>
                        </div>
                    
                                <div class="name">L'entreprise :</div>
                            <div class="value" style="padding-top:7px">
                                <div class="row row-space" style="padding-top:7px">
                                <h6><?php echo $tab2['NOM']; ?> (ICE :<?php echo $tab2['ID']; ?> )</h6></div>
                        </div>
                        
                        
                            <div class="name">Sujet du stage:</div>
                            <div class="value" style="padding-top:7px">
                            <div class="row row-space" style="padding-top:7px">
                                <h6> <?php  echo mb_strtoupper($tab1['SUJET'],'UTF-8');?></h6>
                            </div>
                        </div>

                        <div class="name" style="width:160px;   display: inline;"> Niveau de formation :</div>
                            <div class="value" style="width:70px;  padding-top:7px; padding-left: 15px; display: inline;">
                            <div class="row row-space" style="padding-top:7px">
                            <h6>
                            <?php  echo $tab4['parcour'];?></h6>
                            </div>
                        </div>
                        </div>

                        

                        
                      
                        <div class="form-row" >
                            <div class="name" style="width:200px;">Les jurys :</div>
                            <div class="value" style="  padding-left: 20%; display: inline;">
                                <div class="input-group">
                                <div class="col-md-4" style="margin-left:20px;width:300px;" >
                <select name="PROFENC[]" id="skills" class="form-control selectpicker "
                                     data-live-search="true" multiple 
             <?php if(!empty($tab1['RAPPORT'])){?> disabled      <?php }  ?>                      >
        <option  selected disabled > <?php echo $TabPRF['NOM'].' '.$TabPRF['PRENOM'];?></option>

             <?php while($TABSElect=$REsSElect->fetch())
                { ?>
        <option selected value="<?php echo $TABSElect['ID_PROF']?>"><?php echo $TABSElect['NOM'].' '. $TABSElect['PRENOM'];?></option>
           <?php }   ?>
           <?php while($TabENCF=$ResENS->fetch()){  ?>
            <option value="<?php echo $TabENCF ['ID_PROF']?>"><?php echo $TabENCF ['NOM'].' '.$TabENCF ['PRENOM'];?></option>
            <?php } ?>
      </select>
                                  </div>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                                <br> <br>

                                <div class="name"></div>
                            <div class="value">
                                <br>
                                 <label for="RApp">Uploader Votre Rapport :</label>
                                <input type="hidden" name="numStage" value="<?php echo $NumStage;?>">
                                  <?php
                                  $reqNbrENCD="SELECT COUNT(*) from juger where NUM=$NumStage";
                                  $reSNbrENCD=$bdd->query($reqNbrENCD);
                                  $count=$reSNbrENCD->fetchColumn();
                                  if($count>=2){
                                  ?>
                                  <div class="input-group ">
                                  <input type="file" class="input--style-5 input-sm"  id="RApp"
                                   name="Raaaport" 
                                    >
                                  </div>
                                  
                                <div class="name"></div>
                            <div class="value">
                                <br>
                                 <label for="MCLEE">Les Mots Clé  :</label>
                                
                                  <div class="input-group ">
                                  <input type="text" class="input--style-5 input-sm"  
                                   name="MCLEE" maxlength="100" style="width: 310px;"
                                  value="<?php  echo $tab1['MOTS'];?>"
                                   >
                                  </div>
                                </div>

                                  <?php } else {?>
                                    <p class="text-center lead fw-bolder lh-1" style="margin-left:25%;width:100%; " > Veuillez sélectionner les jurys </p>
                                    <?php } ?>
                                </div>





                            </div>
                    
                            
                        
                            <div>
                            <button class="btn btn--radius-2 btn--red  btn-success" type="submit">Enregistrer</button>
                            <button class="btn btn--radius-2 btn--red  btn-danger" type="reset">Annuler</button>
                        </div>
                      

                    </form>

                </div>
            </div>
        </div>
    </div>
    </article>

    <!-- Jquery JS-->
    <script src="Style/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="Style/vendor/select2/select2.min.js"></script>
    <script src="Style/vendor/datepicker/moment.min.js"></script>
    <script src="Style/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="Style/js/global.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>

  <script>
    $(document).ready(function(){
     $('.selectpicker').selectpicker();
     
     $('#skills').change(function(){
      $('#hidden_skills').val($('#skills').val());
     });
     
     $('#multiple_select_form').on('submit', function(event){
      event.preventDefault();
      if($('#skills').val() != '')
      {
       var form_data = $(this).serialize();
       $.ajax({
        url:"insert.php",
        method:"POST",
        data:form_data,
        success:function(data)
        {
         //console.log(data);
         $('#hidden_skills').val('');
         $('.selectpicker').selectpicker('val', '');
         alert(data);
        }
       })
      }
      else
      {
       alert("Please select framework");
       return false;
      }
     });
    });
    </script>

</body>
</html>

