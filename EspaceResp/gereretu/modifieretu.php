
<?php 
require_once dirname( __FILE__ ) . '/' . '../../connexion.php';
require_once dirname( __FILE__ ) . '/' . '../../session.php';

if(isset($_GET['cne'])) 
  $_SESSION['test']=$_GET['cne'];


  $resp=$_SESSION['cne'];
  $r="SELECT * FROM responsable WHERE USERNAME='$resp' ";
  $Smt1=$bdd->query($r); 
  $ro=$Smt1->fetch(PDO::FETCH_ASSOC);
 $f=$ro['ID_FORMATION'];

  $cne=$_SESSION['test'];


    if(isset($_POST['ADRESSE']))
    { 
        $ADD=$_POST['ADRESSE'];
        $TEL=$_POST['TEL'];
        $niveau=$_POST['niveau'];
        $cne1=$_POST['cne'];
        $email=$_POST['email'];
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
            $req="UPDATE etudiant set ADR='$ADD',PHONE='$TEL',CNE='$cne1',EMAIL='$email',NOM='$nom',PRENOM='$prenom' WHERE cne='$cne'";
            $bdd->exec($req); 
            header('location:modifieretu.php');
            $bdd->exec("UPDATE appartient set NIVEAU='$niveau' WHERE appartient.cne='$cne'");
            header('location:modifieretu.php');
    }



   $annee=date("Y");
   $req="SELECT * from etudiant,appartient,niveau,formation where etudiant.cne=appartient.cne AND appartient.NIVEAU=niveau.NIVEAU AND niveau.ID_FORMATION=formation.ID_FORMATION AND etudiant.cne='$cne' AND  appartient.DATEtu like '$annee%' ";
   $res=$bdd->query($req);
   $V=$res->fetch(2); 



   if(isset($_FILES["image"]["name"])){
    $id = $_POST["id"];
    $name = $_POST["id"];
  
    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];
  
    // Image validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)){
      echo
      "
      <script>
        alert('Invalid Image Extension');
        window.location.href='modifieretu.php';
      </script>
      ";
      

      exit();
    }
    elseif ($imageSize > 1200000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
        window.location.href='modifieretu.php';             
        </script>
      ";
    }
    else{
      $newImageName = $name; // Generate new image name
      $newImageName .= '.' . $imageExtension;
      $bdd->exec("UPDATE etudiant SET PHOTO = '$newImageName' WHERE CNE = '$id'");
      
      move_uploaded_file($tmpName,  '../../EspaceEtu/img/ETUDIMG/'  . $newImageName);
      
    header('location:modifieretu.php');
    }
  }
    ?>
  





  
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Détail</title>
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


<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 

<link rel="stylesheet" href="styleDetail.css">
<style type="text/css">
  .bootstrap-select {
width: 100% !important;
}
</style>
  


</head>
<body>
  
<header>
  <span class="menu"><i class="material-icons">menu</i></span>
  <div style="float : right; padding-right: 7%;">
  </div>
  
  <?php require_once dirname( __FILE__ ) . '/' . '../menu/menu.php';?>
</header>

<article style="margin-top:16%;">

   
<!-----form 1----->
<div class="main-content">
<div class="container-fluid mt--7">
<form id ="form"  enctype="multipart/form-data" method="POST">
<div class="row">
<div class="col-xl-4 order-xl-1 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
               <center>
                 <div class="upload">
                        <?php  
                        $image = $V["PHOTO"];
                        ?>
                                <img src="../../EspaceEtu/img/ETUDIMG/<?php echo $image ?>" class="rounded-circle" title="<?php echo $image; ?>">
                                <div class="round">
                                <input type="hidden" name="id" value="<?php echo $V['CNE']; ?>">
                                <input type="hidden" name="name" value="<?php echo $V['NOM']; ?>">
                                <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                                <i class = "fa fa-camera" style = "color: #fff;"></i>
                                </div>
                 </div>                    
              </div>
        </div>
    </div>
        <div class="card-body pt-0 pt-md-4" style="margin-top:23%;">
            <div class="row">
                <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center mt-md-2">
                        <div>                      
                        <b class="description"> <?php echo $V['NOM'].("<br> ").$V['PRENOM']?></b>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
        

</div>
</div>
</form>
<div class="col-xl-8 order-xl-2">
    <div class="card bg-secondary shadow">
<form method="POST"  >
<div class="card-header bg-white border-0">

              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Modifier Etudiant</h3>
                </div>

                <div class="col-4 text-right">
                  <button type="submit"  class="btn btn-sm btn-primary"> Enregistrer</button> 
                </div>
              </div>
            </div>
            <div class="card-body">

              
    
            <div class="pl-lg-4">

            <div class="row">
            <div class="col-lg-6">
            <div class="form-group focused">
            <label class="form-control-label" for="input-username">CNE</label>
            <input type="text" class="form-control form-control-alternative" value="<?php echo $V['CNE'] ?>" name="cne" >
            </div>
            </div>
            <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">FORMATION</label>
                        <input type="text"  class="form-control form-control-alternative" value="<?php echo $V['LIBELLE']; ?> " readonly="readonly" >
                      </div>
                    </div>                   
                  </div>


                  <div class="row">
            <div class="col-lg-6">
            <div class="form-group focused">
            <label class="form-control-label" for="input-username">NOM</label>
            <input type="text" class="form-control form-control-alternative" value="<?php echo $V['NOM'] ?>" name="nom" >
            </div>
            </div>
            <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">PRENOM</label>
                        <input type="text"  class="form-control form-control-alternative" value="<?php echo $V['PRENOM']; ?> " name="prenom" >
                      </div>
                    </div>                   
                  </div>



                  <div class="row">
            <div class="col-lg-6">
            <div class="form-group focused">
            <label class="form-control-label" for="input-username">NIVEAU</label>
            <select class="form-select" aria-label="Default select example" name="niveau" >

            <option value="<?phpecho $V['niveau']?>" selected><?php echo $V['parcour'] ?></option>
            <?php
$req22="SELECT parcour,niveau from niveau where ID_FORMATION='$f' AND niveau.NIVEAU>(SELECT niveau.NIVEAU from appartient,niveau where appartient.NIVEAU=niveau.NIVEAU AND appartient.cne='$cne') ";
$res22=$bdd->query($req22);
$V22=$res22->fetchAll(2);  
foreach ($V22 as $ta):?>
  <option value="<?php echo $ta['niveau']?>"><?php echo $ta['parcour']; ?></option>     
 <?php endforeach;     ?>
  </select>
            </div>
            </div>
            <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">EMAIL</label>
                        <input type="text" class="form-control form-control-alternative" value="<?php echo $V['EMAIL']; ?>" name="email" >
                      </div>
                    </div>                   
                  </div>



                  <div class="row">
            <div class="col-lg-6">
            <div class="form-group focused">
            <label class="form-control-label" for="input-username">ADRESSE</label>
            <input type="text" class="form-control form-control-alternative" value="<?php echo $V['ADR'] ?>" name="ADRESSE" >
            </div>
            </div>
            <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">TELEPHONE</label>
                        <input type="text" class="form-control form-control-alternative" name="TEL" value="<?php echo $V['PHONE']; ?>" >
                      </div>
                    </div>                   
                  </div>

         
          
          </div>
   
       

        </div>

      </form>
    </div>
   </div>

</article>
</section> 

<!-- partial -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script  src="../menu/script.js"></script>


<!--------- For select modal ----->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
</script>

</body>
</html>