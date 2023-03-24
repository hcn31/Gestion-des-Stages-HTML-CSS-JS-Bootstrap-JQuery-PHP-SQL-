<?php 
 require_once dirname( __FILE__ ) . '/' . '../../session.php';
 require_once dirname( __FILE__ ) . '/' . '../../connexion.php';

 if(isset($_GET['id'])) 
 $_SESSION['test']=$_GET['id'];
 $cne=$_SESSION['test'];


 if(isset($_POST['ice']))
 { 
     $ice=$_POST['ice'];
     $nom=$_POST['nom'];
     $site=$_POST['site'];
     $add=$_POST['add'];
     $email=$_POST['email'];
     $tel=$_POST['tel'];
         $req="UPDATE entreprise set ID='$ice',NOM='$nom',SITE='$site',ADRESSE='$add',EMAIL='$email',TEL='$tel' WHERE ID='$cne'";
         $bdd->exec($req); 
         header('location:modifierentr.php');
 }
 $req="SELECT * from entreprise where ID='$cne'";
 $res=$bdd->query($req);
 $row5=$res->fetch(2); 
 

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
      window.location.href='modifier.php';
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
    
    move_uploaded_file($tmpName,  '../img/ETUDIMG/'  . $newImageName);
    
  header('location:modifier.php');
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
                        $image = $row5["LOGO"];
                        ?>
                                <img src="../../EspaceEtu/img/LOGOENTRE/<?php echo $image; ?>" class="rounded-circle" title="<?php echo $image; ?>">
                                <div class="round">
                                <input type="hidden" name="id" value="<?php echo $row5["ID"]; ?>">
                                <input type="hidden" name="name" value="<?php echo $row5["NOM"]; ?>">
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
                        <b class="description"> <?php echo $row5['ID'].("<br> ").$row5['NOM']?></b>
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
            <form action="" method="POST"> 
            <div class="card-header bg-white border-0">

              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Modifier Entreprise</h3>
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
                        <label class="form-control-label" for="input-username">ICE</label>
                        <input type="text" name="ice" class="form-control form-control-alternative" value="<?php echo $row5['ID']; ?>">
                      </div>
                      </div>
                      <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">LEBELE</label>
                        <input type="text" name="nom" class="form-control form-control-alternative" value="<?php echo $row5['NOM']; ?>" >
                      </div>
                    </div>
                    
                  </div>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">SITE</label>
                        <input type="text" name="site" class="form-control form-control-alternative" value="<?php echo $row5['SITE']; ?>" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">ADRESSE</label>
                        <input type="text" name="add"class="form-control form-control-alternative" value="<?php echo $row5['ADRESSE']; ?>" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">EMAIL</label>
                        <input type="text" name="email" class="form-control form-control-alternative" value="<?php echo $row5['EMAIL']; ?>" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">TELEPHONE</label>
                        <input type="text" name="tel"class="form-control form-control-alternative" value="<?php echo $row5['TEL']; ?>" >
                      </div>
                    </div>
                  </div>              
            </div>
          </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


       
  </article >
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




